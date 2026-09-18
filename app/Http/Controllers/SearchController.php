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
                $bookQuery = Book::query();

                $bookQuery->where(function ($q) use ($query) {
                    $q->where('author', 'like', "%{$query}%")
                      ->orWhere('title', 'like', "%{$query}%")
                      ->orWhere('edition', 'like', "%{$query}%")
                      ->orWhere('subject', 'like', "%{$query}%")
                      ->orWhere('year', 'like', "%{$query}%")
                      ->orWhere('publication', 'like', "%{$query}%");
                });

                $books = $bookQuery->get();

                foreach ($books as $book) {
                    $exactUnavailable = $book;
                    $relatedBooks = Book::where('subject', $book->subject)
                        ->where('id', '!=', $book->id)
                        ->limit(5)
                        ->get();
                    break;
                }

                if ($books->isEmpty()) {
                    $noResult = true;
                    $words = explode(' ', strtoupper($query));
                    foreach ($words as $word) {
                        if (strlen($word) >= 3) {
                            $partialQuery = Book::query()
                                ->where('author', 'like', "%{$word}%")
                                ->orWhere('title', 'like', "%{$word}%")
                                ->orWhere('edition', 'like', "%{$word}%")
                                ->orWhere('subject', 'like', "%{$word}%")
                                ->orWhere('year', 'like', "%{$word}%")
                                ->orWhere('publication', 'like', "%{$word}%");

                            $partial = $partialQuery->first();
                            if ($partial) {
                                $books->push($partial);
                                $relatedBooks = Book::where('subject', $partial->subject)
                                    ->where('id', '!=', $partial->id)
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
                $thesisQuery = Thesis::query();

                $thesisQuery->where(function ($q) use ($query) {
                    $q->where('author', 'like', "%{$query}%")
                      ->orWhere('research', 'like', "%{$query}%")
                      ->orWhere('subjects_keywords', 'like', "%{$query}%")
                      ->orWhere('database_collection', 'like', "%{$query}%");
                });

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
                $books = Book::all();
            }
            if ($type === 'all' || $type === 'journals') {
                $journals = Journal::with(['category', 'publisher'])
                    ->where('category_id', $categoryId)
                    ->get();
            }
            if ($type === 'all' || $type === 'theses') {
                $theses = Thesis::get();
            }
        } else {
            if ($type === 'all' || $type === 'books') {
                $books = Book::all();
            }
            if ($type === 'all' || $type === 'journals') {
                $journals = Journal::with(['category', 'publisher'])->get();
            }
            if ($type === 'all' || $type === 'theses') {
                $theses = Thesis::get();
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

            if ($type === 'all' || $type === 'theses') {
                $thesisQuery = Thesis::query();

                $thesisQuery->where(function ($q) use ($query) {
                    $q->where('author', 'like', "%{$query}%")
                      ->orWhere('research', 'like', "%{$query}%")
                      ->orWhere('subjects_keywords', 'like', "%{$query}%")
                      ->orWhere('database_collection', 'like', "%{$query}%");
                });

                $theses = $thesisQuery->get();
            }
        } elseif ($categoryId) {
            if ($type === 'all' || $type === 'journals') {
                $journals = Journal::with(['category', 'publisher'])
                    ->where('category_id', $categoryId)
                    ->get();
            }
            if ($type === 'all' || $type === 'theses') {
                $theses = Thesis::get();
            }
        }

        $totalResults = $journals->count() + $theses->count();

        return view('admin.search.e-periodical-index', compact('journals', 'theses', 'query', 'categories', 'categoryId', 'type', 'totalResults', 'view', 'allJournals', 'editingJournal', 'searchField'));
    }
}
