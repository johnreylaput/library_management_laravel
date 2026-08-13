<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:Admin,Librarian,Working-Student');
    }

    public function index()
    {
        $authors = Author::all();
        return view('admin.authors.index', compact('authors'));
    }

    public function create()
    {
        $this->middleware('role:Admin');
        return view('admin.authors.create');
    }

    public function store(Request $request)
    {
        $this->middleware('role:Admin');
        $validated = $request->validate([
            'author_name' => 'required|string|max:150',
            'biography' => 'nullable|string',
        ]);

        Author::create($validated);

        return redirect()->route('authors.index')->with('success', 'Author created successfully.');
    }

    public function show($id)
    {
        $author = Author::findOrFail($id);
        return view('admin.authors.show', compact('author'));
    }

    public function edit($id)
    {
        $this->middleware('role:Admin');
        $author = Author::findOrFail($id);
        return view('admin.authors.edit', compact('author'));
    }

    public function update(Request $request, $id)
    {
        $this->middleware('role:Admin');
        $author = Author::findOrFail($id);
        $validated = $request->validate([
            'author_name' => 'required|string|max:150',
            'biography' => 'nullable|string',
        ]);

        $author->update($validated);

        return redirect()->route('authors.index')->with('success', 'Author updated successfully.');
    }

    public function destroy($id)
    {
        $this->middleware('role:Admin');
        $author = Author::findOrFail($id);
        $author->delete();

        return redirect()->route('authors.index')->with('success', 'Author deleted successfully.');
    }
}
