<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Journal;
use App\Models\Thesis;
use App\Models\Category;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = trim($request->get('q', ''));
        $categoryId = $request->get('category');
        $type = $request->get('type', 'all');

        $books = collect();
        $journals = collect();
        $theses = collect();
        $relatedBooks = collect();
        $exactUnavailable = null;
        $noResult = false;

        $categories = Category::all();

        if (!empty($query)) {
            if ($type === 'all' || $type === 'books') {
                $bookQuery = Book::with(['category', 'author', 'publisher']);

                $bookQuery->where(function ($q) use ($query) {
                    $q->where('title', 'like', "%{$query}%")
                      ->orWhereHas('author', function ($q2) use ($query) {
                          $q2->where('author_name', 'like', "%{$query}%");
                      })
                      ->orWhere('isbn', 'like', "%{$query}%")
                      ->orWhereHas('category', function ($q2) use ($query) {
                          $q2->where('category_name', 'like', "%{$query}%");
                      });
                });

                if ($categoryId) {
                    $bookQuery->where('category_id', $categoryId);
                }

                $books = $bookQuery->get();

                foreach ($books as $book) {
                    if ($book->status !== 'Available' || $book->available_quantity <= 0) {
                        $exactUnavailable = $book;
                        $relatedBooks = Book::where('category_id', $book->category_id)
                            ->where('id', '!=', $book->id)
                            ->where('status', 'Available')
                            ->where('available_quantity', '>', 0)
                            ->limit(5)
                            ->get();
                        break;
                    }
                }

                if ($books->isEmpty()) {
                    $noResult = true;
                    $words = explode(' ', strtoupper($query));
                    foreach ($words as $word) {
                        if (strlen($word) >= 3) {
                            $partialQuery = Book::with(['category', 'author', 'publisher'])
                                ->where('title', 'like', "%{$word}%")
                                ->orWhereHas('category', function ($q2) use ($word) {
                                    $q2->where('category_name', 'like', "%{$word}%");
                                });

                            if ($categoryId) {
                                $partialQuery->where('category_id', $categoryId);
                            }

                            $partial = $partialQuery->first();
                            if ($partial) {
                                $books->push($partial);
                                $relatedBooks = Book::where('category_id', $partial->category_id)
                                    ->where('id', '!=', $partial->id)
                                    ->where('status', 'Available')
                                    ->where('available_quantity', '>', 0)
                                    ->limit(5)
                                    ->get();
                                break;
                            }
                        }
                    }
                }
            }

            if ($type === 'all' || $type === 'journals') {
                $journalQuery = Journal::with(['category', 'publisher']);

                $journalQuery->where(function ($q) use ($query) {
                    $q->where('title', 'like', "%{$query}%")
                      ->orWhere('authors', 'like', "%{$query}%")
                      ->orWhere('journal_name', 'like', "%{$query}%")
                      ->orWhere('doi', 'like', "%{$query}%")
                      ->orWhere('issn', 'like', "%{$query}%")
                      ->orWhere('volume', 'like', "%{$query}%")
                      ->orWhere('issue', 'like', "%{$query}%")
                      ->orWhere('pages', 'like', "%{$query}%")
                      ->orWhere('subjects', 'like', "%{$query}%")
                      ->orWhere('database_collection', 'like', "%{$query}%");
                });

                if ($categoryId) {
                    $journalQuery->where('category_id', $categoryId);
                }

                $journals = $journalQuery->get();
            }

            if ($type === 'all' || $type === 'theses') {
                $thesisQuery = Thesis::with(['category', 'author', 'publisher']);

                $thesisQuery->where(function ($q) use ($query) {
                    $q->where('title', 'like', "%{$query}%")
                      ->orWhere('authors', 'like', "%{$query}%")
                      ->orWhere('institution', 'like', "%{$query}%")
                      ->orWhere('thesis_type', 'like', "%{$query}%")
                      ->orWhere('year', 'like', "%{$query}%")
                      ->orWhere('subjects', 'like', "%{$query}%")
                      ->orWhere('database_collection', 'like', "%{$query}%");
                });

                if ($categoryId) {
                    $thesisQuery->where('category_id', $categoryId);
                }

                $theses = $thesisQuery->get();
            }

            $totalResults = ($books->count() ?? 0) + ($journals->count() ?? 0) + ($theses->count() ?? 0);

            ActivityLog::create([
                'user_id' => Auth::id(),
                'username' => Auth::user()?->username ?? 'Guest',
                'role' => Auth::user()?->role ?? 'Guest',
                'action' => 'Search',
                'description' => "Searched for: {$query} ({$totalResults} results)",
                'ip_address' => $request->ip(),
            ]);
        } elseif ($categoryId) {
            if ($type === 'all' || $type === 'books') {
                $books = Book::with(['category', 'author', 'publisher'])
                    ->where('category_id', $categoryId)
                    ->get();
            }
            if ($type === 'all' || $type === 'journals') {
                $journals = Journal::with(['category', 'publisher'])
                    ->where('category_id', $categoryId)
                    ->get();
            }
            if ($type === 'all' || $type === 'theses') {
                $theses = Thesis::with(['category', 'author', 'publisher'])
                    ->where('category_id', $categoryId)
                    ->get();
            }
        } else {
            if ($type === 'all' || $type === 'books') {
                $books = Book::with(['category', 'author', 'publisher'])->get();
            }
            if ($type === 'all' || $type === 'journals') {
                $journals = Journal::with(['category', 'publisher'])->get();
            }
            if ($type === 'all' || $type === 'theses') {
                $theses = Thesis::with(['category', 'author', 'publisher'])->get();
            }
        }

        return view('admin.search.index', compact('books', 'journals', 'theses', 'relatedBooks', 'query', 'categories', 'categoryId', 'type', 'exactUnavailable', 'noResult'));
    }

    public function ePeriodicalIndex(Request $request)
    {
        $query = trim($request->get('q', ''));
        $categoryId = $request->get('category');
        $type = $request->get('type', 'all');
        $searchField = in_array($request->get('search_field'), ['all', 'title', 'authors', 'journal_name', 'keyword', 'subjects', 'doi', 'issn', 'isbn'], true)
            ? $request->get('search_field')
            : 'all';
        $view = $request->get('view');

        $journals = collect();
        $theses = collect();
        $books = collect();
        $categories = Category::all();
        $allJournals = collect();
        $editingJournal = null;

        if (in_array($view, ['all-journals', 'edit-journal', 'delete-journal'], true)) {
            $allJournals = Journal::with(['category', 'publisher'])->get();
        }

        if ($view === 'edit-journal' && $request->filled('id')) {
            $editingJournal = Journal::with(['category', 'publisher'])->findOrFail($request->get('id'));
        }

        if (!empty($query)) {
            if ($type === 'all' || $type === 'journals') {
                $journalQuery = Journal::with(['category', 'publisher']);

                if ($searchField === 'all') {
                    $journalQuery->where(function ($q) use ($query) {
                        $q->where('title', 'like', "%{$query}%")
                          ->orWhere('authors', 'like', "%{$query}%")
                          ->orWhere('journal_name', 'like', "%{$query}%")
                          ->orWhere('doi', 'like', "%{$query}%")
                          ->orWhere('issn', 'like', "%{$query}%")
                          ->orWhere('volume', 'like', "%{$query}%")
                          ->orWhere('issue', 'like', "%{$query}%")
                          ->orWhere('pages', 'like', "%{$query}%")
                          ->orWhere('subjects', 'like', "%{$query}%")
                          ->orWhere('keyword', 'like', "%{$query}%")
                          ->orWhere('database_collection', 'like', "%{$query}%");
                    });
                } elseif ($searchField === 'doi') {
                    $journalQuery->where(function ($q) use ($query) {
                        $q->where('doi', 'like', "%{$query}%")
                          ->orWhere('issn', 'like', "%{$query}%");
                    });
                } else {
                    $journalQuery->where($searchField, 'like', "%{$query}%");
                }

                if ($categoryId) {
                    $journalQuery->where('category_id', $categoryId);
                }

                $journals = $journalQuery->get();
            }

            if ($type === 'all' || $type === 'books') {
                $bookQuery = Book::with(['category', 'author', 'publisher']);

                if ($searchField === 'all') {
                    $bookQuery->where(function ($q) use ($query) {
                        $q->where('title', 'like', "%{$query}%")
                          ->orWhere('isbn', 'like', "%{$query}%")
                          ->orWhereHas('author', function ($q2) use ($query) {
                              $q2->where('author_name', 'like', "%{$query}%");
                          });
                    });
                } elseif ($searchField === 'isbn') {
                    $bookQuery->where('isbn', 'like', "%{$query}%");
                } elseif ($searchField === 'authors') {
                    $bookQuery->whereHas('author', function ($q2) use ($query) {
                        $q2->where('author_name', 'like', "%{$query}%");
                    });
                } else {
                    $bookQuery->where($searchField, 'like', "%{$query}%");
                }

                if ($categoryId) {
                    $bookQuery->where('category_id', $categoryId);
                }

                $books = $bookQuery->get();
            }

            if ($type === 'all' || $type === 'theses') {
                $thesisQuery = Thesis::with(['category', 'author', 'publisher']);

                $thesisQuery->where(function ($q) use ($query) {
                    $q->where('title', 'like', "%{$query}%")
                      ->orWhere('authors', 'like', "%{$query}%")
                      ->orWhere('institution', 'like', "%{$query}%")
                      ->orWhere('thesis_type', 'like', "%{$query}%")
                      ->orWhere('year', 'like', "%{$query}%")
                      ->orWhere('subjects', 'like', "%{$query}%")
                      ->orWhere('database_collection', 'like', "%{$query}%");
                });

                if ($categoryId) {
                    $thesisQuery->where('category_id', $categoryId);
                }

                $theses = $thesisQuery->get();
            }
        } elseif ($categoryId) {
            if ($type === 'all' || $type === 'journals') {
                $journals = Journal::with(['category', 'publisher'])
                    ->where('category_id', $categoryId)
                    ->get();
            }
            if ($type === 'all' || $type === 'books') {
                $books = Book::with(['category', 'author', 'publisher'])
                    ->where('category_id', $categoryId)
                    ->get();
            }
            if ($type === 'all' || $type === 'theses') {
                $theses = Thesis::with(['category', 'author', 'publisher'])
                    ->where('category_id', $categoryId)
                    ->get();
            }
        }

        $totalResults = $journals->count() + $theses->count() + $books->count();

        return view('admin.search.e-periodical-index', compact('journals', 'theses', 'books', 'query', 'categories', 'categoryId', 'type', 'totalResults', 'view', 'allJournals', 'editingJournal', 'searchField'));
    }
}
