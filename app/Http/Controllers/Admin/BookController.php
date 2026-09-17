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
        $query = Book::query();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('author', 'like', "%{$search}%")
                  ->orWhere('subject', 'like', "%{$search}%");
            });
        }

        $books = $query->get();
        return view('admin.books.index', compact('books', 'search'));
    }

    public function show($id)
    {
        $book = Book::findOrFail($id);
        $relatedBooks = Book::where('id', '!=', $book->id)->take(5)->get();

        if (request()->query('ajax') == '1') {
            return view('admin.books.partials.detail', compact('book', 'relatedBooks'))->render();
        }

        return view('admin.books.show', compact('book', 'relatedBooks'));
    }

    public function create()
    {
        $authors = \App\Models\Author::orderBy('author_name')->get();
        return view('admin.books.create', compact('authors'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'edition' => 'nullable|string|max:100',
            'year' => 'nullable|string|max:10',
            'subject' => 'nullable|string|max:255',
            'publication' => 'required|in:Foreign,Local',
        ]);

        Book::create(array_merge($validated, ['added_by' => Auth::user()->full_name . ' (' . Auth::user()->role . ')']));

        return redirect()->route('books.index')->with('success', 'Book created successfully.');
    }

    public function edit($id)
    {
        $book = Book::findOrFail($id);
        $authors = \App\Models\Author::orderBy('author_name')->get();
        return view('admin.books.edit', compact('book', 'authors'));
    }

    public function update(Request $request, $id)
    {
        $book = Book::findOrFail($id);
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'edition' => 'nullable|string|max:100',
            'year' => 'nullable|string|max:10',
            'subject' => 'nullable|string|max:255',
            'publication' => 'required|in:Foreign,Local',
        ]);

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

            $staffUsers = User::whereIn('role', ['Admin', 'Librarian'])->get();
            foreach ($staffUsers as $staff) {
                Notification::create([
                    'user_id' => $staff->id,
                    'type' => 'deletion_request',
                    'title' => 'New Deletion Request',
                    'message' => Auth::user()->full_name . ' requested deletion of book "' . $book->title . '" (ID: ' . $book->id . ')',
                    'sent_by' => Auth::id(),
                ]);
            }

            return back()->with('info', 'Deletion request for book "' . $book->title . '" has been submitted and is awaiting librarian approval.');
        }

        $book = Book::findOrFail($id);
        $book->delete();

        return redirect()->route('books.index')->with('success', 'Book deleted successfully.');
    }
}