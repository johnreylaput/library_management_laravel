<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LibrarianController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:Admin');
    }

    public function index()
    {
        $librarians = User::where('role', 'Librarian')->get();
        return view('admin.librarians.index', compact('librarians'));
    }

    public function create()
    {
        return view('admin.librarians.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:150',
            'username' => 'required|string|max:50|unique:users,username',
            'email' => 'required|email|max:100|unique:users,email',
            'password' => 'required|string|min:8',
            'status' => 'required|in:Active,Inactive',
        ]);

        $validated['password'] = Hash::make($validated['password']);
        $validated['role'] = 'Librarian';

        User::create($validated);

        return redirect()->route('librarians.index')->with('success', 'Librarian created successfully.');
    }

    public function show($id)
    {
        $librarian = User::where('role', 'Librarian')->findOrFail($id);
        return view('admin.librarians.show', compact('librarian'));
    }

    public function edit($id)
    {
        $librarian = User::where('role', 'Librarian')->findOrFail($id);
        return view('admin.librarians.edit', compact('librarian'));
    }

    public function update(Request $request, $id)
    {
        $librarian = User::where('role', 'Librarian')->findOrFail($id);
        $validated = $request->validate([
            'full_name' => 'required|string|max:150',
            'username' => 'required|string|max:50|unique:users,username,' . $librarian->id,
            'email' => 'required|email|max:100|unique:users,email,' . $librarian->id,
            'password' => 'nullable|string|min:8',
            'status' => 'required|in:Active,Inactive',
        ]);

        if (empty($validated['password'])) {
            unset($validated['password']);
        } else {
            $validated['password'] = Hash::make($validated['password']);
        }

        $librarian->update($validated);

        return redirect()->route('librarians.index')->with('success', 'Librarian updated successfully.');
    }

    public function destroy($id)
    {
        $librarian = User::where('role', 'Librarian')->findOrFail($id);
        $librarian->delete();

        return redirect()->route('librarians.index')->with('success', 'Librarian deleted successfully.');
    }
}
