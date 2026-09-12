<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Category;
use App\Models\DeletionRequest;
use App\Models\User;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:Admin,Librarian,Working.Student')->except(['create', 'store', 'edit', 'update', 'destroy', 'show']);
        $this->middleware('role:Admin,Librarian,Working.Student')->only(['create', 'store', 'edit', 'update', 'destroy']);
    }

    public function index(Request $request)
    {
        $search = $request->get('q');
        $categoryId = $request->get('category');

        $query = Book::with(['category', 'author', 'publisher']);

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhereHas('author', function ($q2) use ($search) {
                      $q2->where('author_name', 'like', "%{$search}%");
                  })
                  ->orWhere('isbn', 'like', "%{$search}%");
            });
        }

        if ($categoryId) {
            $query->where('category_id', $categoryId);
        }

        $books = $query->get();
        $categories = Category::all();

        return view('admin.books.index', compact('books', 'categories', 'search', 'categoryId'));
    }

    public function show($id)
    {
        $book = Book::with(['category', 'author', 'publisher'])->findOrFail($id);
        $relatedBooks = Book::where('category_id', $book->category_id)
            ->where('id', '!=', $book->id)
            ->where('status', 'Available')
            ->where('available_quantity', '>', 0)
            ->limit(5)
            ->get();

        if (request()->query('ajax') == '1') {
            return view('admin.books.partials.detail', compact('book', 'relatedBooks'))->render();
        }

        return view('admin.books.show', compact('book', 'relatedBooks'));
    }

    public function create()
    {
        $categories = Category::all();
        $authors = \App\Models\Author::all();
        $publishers = \App\Models\Publisher::all();
        return view('admin.books.create', compact('categories', 'authors', 'publishers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'isbn' => 'nullable|string|max:50',
            'category_name' => 'nullable|string|max:255',
            'author_name' => 'nullable|string|max:255',
            'publisher_name' => 'nullable|string|max:255',
            'publication_year' => 'nullable|integer',
            'edition' => 'nullable|string|max:255',
            'language' => 'nullable|string|max:255',
            'pages' => 'nullable|integer',
            'quantity' => 'nullable|integer|min:1',
            'available_quantity' => 'nullable|integer|min:0',
            'shelf_location' => 'nullable|string|max:255',
            'status' => 'nullable|in:Available,Unavailable,Archived',
        ]);

        $validated['category_id'] = !empty($validated['category_name']) ? \App\Models\Category::firstOrCreate(['category_name' => $validated['category_name']])->id : null;
        $validated['author_id'] = !empty($validated['author_name']) ? \App\Models\Author::firstOrCreate(['author_name' => $validated['author_name']])->id : null;
        $validated['publisher_id'] = !empty($validated['publisher_name']) ? \App\Models\Publisher::firstOrCreate(['publisher_name' => $validated['publisher_name']])->id : null;

        unset($validated['category_name'], $validated['author_name'], $validated['publisher_name']);

        $validated['available_quantity'] = $validated['available_quantity'] ?? ($validated['quantity'] ?? 1);
        $validated['status'] = $validated['status'] ?? 'Available';

        Book::create(array_merge($validated, ['added_by' => Auth::user()->section]));

        return redirect()->route('books.index')->with('success', 'Book created successfully.');
    }

    public function edit($id)
    {
        $book = Book::findOrFail($id);
        $categories = Category::all();
        $authors = \App\Models\Author::all();
        $publishers = \App\Models\Publisher::all();
        return view('admin.books.edit', compact('book', 'categories', 'authors', 'publishers'));
    }

    public function update(Request $request, $id)
    {
        $book = Book::findOrFail($id);
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'isbn' => 'nullable|string|max:50',
            'category_name' => 'nullable|string|max:255',
            'author_name' => 'nullable|string|max:255',
            'publisher_name' => 'nullable|string|max:255',
            'publication_year' => 'nullable|integer',
            'edition' => 'nullable|string|max:255',
            'language' => 'nullable|string|max:255',
            'pages' => 'nullable|integer',
            'quantity' => 'nullable|integer|min:1',
            'available_quantity' => 'nullable|integer|min:0',
            'shelf_location' => 'nullable|string|max:255',
            'status' => 'nullable|in:Available,Unavailable,Archived',
        ]);

        $validated['category_id'] = !empty($validated['category_name']) ? \App\Models\Category::firstOrCreate(['category_name' => $validated['category_name']])->id : null;
        $validated['author_id'] = !empty($validated['author_name']) ? \App\Models\Author::firstOrCreate(['author_name' => $validated['author_name']])->id : null;
        $validated['publisher_id'] = !empty($validated['publisher_name']) ? \App\Models\Publisher::firstOrCreate(['publisher_name' => $validated['publisher_name']])->id : null;

        unset($validated['category_name'], $validated['author_name'], $validated['publisher_name']);

        $book->update(array_merge($validated, ['edited_by' => Auth::user()->full_name . ' (' . Auth::user()->role . ')']));

        return redirect()->route('books.index')->with('success', 'Book updated successfully.');
    }

    public function destroy($id)
    {
        if (Auth::user()->role === 'Working.Student') {
            $book = Book::findOrFail($id);

            $pendingRequest = DeletionRequest::where('item_type', Book::class)
                ->where('item_id', $book->id)
                ->where('status', 'Pending')
                ->exists();

            if ($pendingRequest) {
                return back()->with('error', 'A deletion request for this book is already pending librarian approval.');
            }

            DeletionRequest::create([
                'user_id' => Auth::id(),
                'item_type' => Book::class,
                'item_id' => $book->id,
                'title' => $book->title,
                'status' => 'Pending',
            ]);

            $librarians = User::where('role', 'Librarian')->get();

            foreach ($librarians as $librarian) {
                Notification::create([
                    'user_id' => $librarian->id,
                    'type' => 'deletion_request',
                    'title' => 'New Deletion Request',
                    'message' => Auth::user()->full_name . ' (Working.Student) requested deletion of book "' . $book->title . '" (ID: ' . $book->id . ')',
                    'sent_by' => Auth::id(),
                ]);
            }

            return back()->with('info', 'Deletion request for book "' . $book->title . '" has been submitted for librarian review.');
        }

        $book = Book::findOrFail($id);
        $book->delete();

        return redirect()->route('books.index')->with('success', 'Book moved to Recently Deleted successfully.');
    }
}
