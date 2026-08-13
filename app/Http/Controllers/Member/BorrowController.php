<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Journal;
use App\Models\Thesis;
use App\Models\BorrowRecord;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BorrowController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:Member,Admin,Librarian');
    }

    public function index(Request $request)
    {
        $selectedBookId = $request->query('book_id');
        $selectedBook = null;

        if ($selectedBookId) {
            $selectedBook = Book::with(['category', 'author', 'publisher'])->findOrFail($selectedBookId);
        }

        $books = Book::with(['category', 'author', 'publisher'])
            ->orderBy('title')
            ->get();

        return view('member.borrow.index', compact('books', 'selectedBook'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'book_id' => 'nullable|exists:books,id',
            'journal_id' => 'nullable|exists:journals,id',
            'thesis_id' => 'nullable|exists:theses,id',
            'borrow_date' => 'required|date',
            'due_date' => 'required|date|after:borrow_date',
            'remarks' => 'nullable|string',
        ]);

        $user = Auth::user();
        $member = Member::where('user_id', $user->id)->first();

        if (!$member) {
            return back()->with('error', 'Member profile not found.');
        }

        $type = null;
        $title = null;
        $item = null;

        if ($request->book_id) {
            $type = 'book';
            $item = Book::with(['category', 'author', 'publisher'])->findOrFail($request->book_id);
            $title = $item->title;
        } elseif ($request->journal_id) {
            $type = 'journal';
            $item = Journal::with(['category', 'publisher'])->findOrFail($request->journal_id);
            $title = $item->title;
        } elseif ($request->thesis_id) {
            $type = 'thesis';
            $item = Thesis::with(['category', 'author', 'publisher'])->findOrFail($request->thesis_id);
            $title = $item->title;
        } else {
            return back()->with('error', 'No item selected for borrowing.');
        }

        BorrowRecord::create([
            'member_id' => $member->id,
            'book_id' => $type === 'book' ? $item->id : null,
            'journal_id' => $type === 'journal' ? $item->id : null,
            'thesis_id' => $type === 'thesis' ? $item->id : null,
            'borrowed_by' => $user->id,
            'borrow_date' => $request->borrow_date,
            'due_date' => $request->due_date,
            'status' => 'Pending',
            'remarks' => $request->remarks,
        ]);

        return redirect()->route('member.borrow.index')->with('success', "Your borrow request for \"{$title}\" has been submitted to the librarian for approval.");
    }
}
