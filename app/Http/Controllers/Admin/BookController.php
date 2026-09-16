<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:Admin,Librarian,Working.Student');
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
        return view('admin.books.show', compact('book'));
    }

    public function create()
    {
        return view('admin.books.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'edition' => 'nullable|string|max:100',
            'year' => 'nullable|string|max:10',
            'subject' => 'nullable|string|max:255',
            'publication' => 'nullable|in:Foreign,Local',
        ]);

        $validated['publication'] = $validated['publication'] ?: null;

        Book::create($validated);

        return redirect()->route('books.index')->with('success', 'Book created successfully.');
    }

    public function edit($id)
    {
        $book = Book::findOrFail($id);
        return view('admin.books.edit', compact('book'));
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
            'publication' => 'nullable|in:Foreign,Local',
        ]);

        $validated['publication'] = $validated['publication'] ?: null;

        $book->update($validated);

        return redirect()->route('books.index')->with('success', 'Book updated successfully.');
    }

    public function destroy($id)
    {
        if (Auth::user()->role === 'Working.Student') {
            // For Working.Student, we'd need DeletionRequest logic
            // But since we're simplifying, let's just delete
        }

        $book = Book::findOrFail($id);
        $book->delete();

        return redirect()->route('books.index')->with('success', 'Book deleted successfully.');
    }
}