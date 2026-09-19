<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\DeletionRequest;
use App\Models\User;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
                $q->where('author', 'like', "%{$search}%")
                  ->orWhere('title', 'like', "%{$search}%")
                  ->orWhere('edition', 'like', "%{$search}%")
                  ->orWhere('subject', 'like', "%{$search}%")
                  ->orWhere('year', 'like', "%{$search}%")
                  ->orWhere('publication', 'like', "%{$search}%");
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
        return view('admin.books.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate($this->bookRules());
        $auditUser = $this->auditUser();

        $data = array_merge($validated, [
            'added_by' => $auditUser,
            'edited_by' => $auditUser,
        ]);

        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $this->storeCoverImage($request->file('cover_image'));
        }

        Book::create($data);

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
        $validated = $request->validate($this->bookRules());

        $data = array_merge($validated, ['edited_by' => $this->auditUser()]);

        if ($request->hasFile('cover_image')) {
            $this->deleteCoverImage($book);
            $data['cover_image'] = $this->storeCoverImage($request->file('cover_image'));
        }

        $book->update($data);

        return redirect()->route('books.index')->with('success', 'Book updated successfully.');
    }

    private function bookRules(): array
    {
        return [
            'author' => ['bail', 'required', 'string', 'max:150', 'not_regex:/^\s*$/'],
            'title' => ['bail', 'required', 'string', 'max:255'],
            'edition' => ['bail', 'required', 'string', 'max:100'],
            'year' => ['bail', 'required', 'integer', 'between:1,' . now()->year],
            'subject' => ['bail', 'required', 'string', 'max:255', 'not_regex:/^\s*$/'],
            'publication' => ['bail', 'required', 'in:Foreign,Local'],
            'cover_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ];
    }

    private function storeCoverImage($file): string
    {
        return $file->store('books/covers', 'public');
    }

    private function deleteCoverImage(Book $book): void
    {
        if ($book->cover_image && Storage::disk('public')->exists($book->cover_image)) {
            Storage::disk('public')->delete($book->cover_image);
        }
    }

    private function auditUser(): int
    {
        return Auth::id();
    }

    public function destroy($id)
    {
        $book = Book::findOrFail($id);

        if (Auth::user()->role === 'Working.Student') {
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

            return back()->with('info', 'Deletion request for "' . $book->title . '" has been submitted and is awaiting librarian approval.');
        }

        $book->delete();

        return redirect()->route('books.index')->with('success', 'Book deleted successfully.');
    }
}
