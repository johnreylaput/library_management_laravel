<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\BorrowRecord;
use App\Models\Book;
use App\Models\Member;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BorrowController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:Admin,Librarian,Working-Student');
    }

    public function index()
    {
        $borrows = BorrowRecord::with(['member.user', 'book', 'journal', 'thesis'])->get();
        return view('admin.borrow.index', compact('borrows'));
    }

    public function create()
    {
        $members = Member::with('user')->get();
        $users = User::whereIn('role', ['Admin', 'Librarian'])->get();
        return view('admin.borrow.create', compact('members', 'users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'member_input' => 'required|string',
            'book_input' => 'required|string',
            'borrowed_by' => 'nullable|exists:users,id',
            'borrow_date' => 'required|date',
            'due_date' => 'required|date|after:borrow_date',
            'remarks' => 'nullable|string',
        ]);

        $member = Member::whereHas('user', function ($q) use ($request) {
            $q->where('full_name', 'like', '%' . $request->member_input . '%');
        })->orWhere('member_no', 'like', '%' . $request->member_input . '%')->first();

        if (!$member) {
            return back()->with('error', 'Member not found.')->withInput();
        }

        $book = Book::where('title', 'like', '%' . $request->book_input . '%')->first();

        if (!$book) {
            return back()->with('error', 'Book not found.')->withInput();
        }

        if ($book->available_quantity <= 0 || $book->status !== 'Available') {
            $recommendations = Book::where('category_id', $book->category_id)
                ->where('id', '!=', $book->id)
                ->where('status', 'Available')
                ->where('available_quantity', '>', 0)
                ->take(5)
                ->get();

            if ($recommendations->isEmpty()) {
                return back()->with('error', 'The book "' . $book->title . '" is not available and no related books were found.')->withInput();
            }

            return back()->with('error', 'The book "' . $book->title . '" is currently unavailable. Here are some related books you may consider:')->with('recommendations', $recommendations)->withInput();
        }

        $book->decrement('available_quantity');

        if ($book->available_quantity <= 0) {
            $book->update(['status' => 'Unavailable']);
        }

        $borrowDate = \Carbon\Carbon::parse($validated['borrow_date']);
        $dueDate = \Carbon\Carbon::parse($validated['due_date']);

        if ($dueDate->greaterThan($borrowDate->copy()->addDays(3))) {
            $dueDate = $borrowDate->copy()->addDays(3);
        }

        BorrowRecord::create([
            'member_id' => $member->id,
            'book_id' => $book->id,
            'borrowed_by' => $validated['borrowed_by'],
            'borrow_date' => $validated['borrow_date'],
            'due_date' => $dueDate->toDateString(),
            'status' => 'Borrowed',
            'remarks' => $validated['remarks'],
        ]);

        return redirect()->route('borrow.index')->with('success', 'Book borrowed successfully.');
    }

    public function show($id)
    {
        $borrow = BorrowRecord::with(['member.user', 'book', 'journal', 'thesis'])->findOrFail($id);
        return view('admin.borrow.show', compact('borrow'));
    }

    public function edit($id)
    {
        $borrow = BorrowRecord::with(['member.user', 'book'])->findOrFail($id);
        $members = Member::with('user')->get();
        $books = Book::all();
        $users = User::whereIn('role', ['Admin', 'Librarian'])->get();
        return view('admin.borrow.edit', compact('borrow', 'members', 'books', 'users'));
    }

    public function update(Request $request, $id)
    {
        $borrow = BorrowRecord::findOrFail($id);
        $validated = $request->validate([
            'member_id' => 'required|exists:members,id',
            'book_id' => 'required|exists:books,id',
            'borrowed_by' => 'nullable|exists:users,id',
            'borrow_date' => 'required|date',
            'due_date' => 'required|date|after:borrow_date',
            'status' => 'required|in:Pending,Borrowed,Returned,Overdue,Cancelled',
            'remarks' => 'nullable|string',
        ]);

        $borrowDate = \Carbon\Carbon::parse($validated['borrow_date']);
        $dueDate = \Carbon\Carbon::parse($validated['due_date']);

        if ($dueDate->greaterThan($borrowDate->copy()->addDays(3))) {
            $validated['due_date'] = $borrowDate->copy()->addDays(3)->toDateString();
        }

        $borrow->update($validated);

        return redirect()->route('borrow.index')->with('success', 'Borrow record updated successfully.');
    }

    public function destroy($id)
    {
        $borrow = BorrowRecord::findOrFail($id);
        $borrow->delete();

        return redirect()->route('borrow.index')->with('success', 'Borrow record deleted successfully.');
    }

    public function approve($id)
    {
        $borrow = BorrowRecord::with(['member.user', 'book', 'journal', 'thesis'])->findOrFail($id);

        if ($borrow->status !== 'Pending') {
            return redirect()->route('borrow.index')->with('error', 'Only pending requests can be approved.');
        }

        $itemTitle = $borrow->book?->title ?? $borrow->journal?->title ?? $borrow->thesis?->title ?? 'Unknown Item';

        if ($borrow->book_id) {
            $book = $borrow->book;

            if ($book->available_quantity <= 0 || $book->status !== 'Available') {
                return redirect()->route('borrow.index')->with('error', 'The book "' . $book->title . '" is no longer available. Please handle the request manually.');
            }

            $book->decrement('available_quantity');

            if ($book->available_quantity <= 0) {
                $book->update(['status' => 'Unavailable']);
            }
        }

        $borrow->update(['status' => 'Borrowed']);

        ActivityLog::create([
            'user_id' => Auth::id(),
            'username' => Auth::user()?->username ?? 'Admin',
            'role' => Auth::user()?->role ?? 'Admin',
            'action' => 'Borrow Approved',
            'description' => "Approved borrow request for {$itemTitle} (Member: {$borrow->member->user->full_name})",
            'ip_address' => request()->ip(),
        ]);

        return redirect()->route('borrow.index')->with('success', 'Borrow request approved successfully.');
    }

    public function reject($id)
    {
        $borrow = BorrowRecord::with(['member.user', 'book', 'journal', 'thesis'])->findOrFail($id);

        if ($borrow->status !== 'Pending') {
            return redirect()->route('borrow.index')->with('error', 'Only pending requests can be rejected.');
        }

        $itemTitle = $borrow->book?->title ?? $borrow->journal?->title ?? $borrow->thesis?->title ?? 'Unknown Item';

        $borrow->update(['status' => 'Cancelled']);

        ActivityLog::create([
            'user_id' => Auth::id(),
            'username' => Auth::user()?->username ?? 'Admin',
            'role' => Auth::user()?->role ?? 'Admin',
            'action' => 'Borrow Rejected',
            'description' => "Rejected borrow request for {$itemTitle} (Member: {$borrow->member->user->full_name})",
            'ip_address' => request()->ip(),
        ]);

        return redirect()->route('borrow.index')->with('success', 'Borrow request rejected successfully.');
    }
}
