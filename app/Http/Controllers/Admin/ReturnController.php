<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BorrowRecord;
use App\Models\ReturnRecord;
use App\Models\User;
use Illuminate\Http\Request;

class ReturnController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:Admin,Librarian,Working-Student');
    }

    public function index()
    {
        $returns = ReturnRecord::with(['borrow.member.user', 'borrow.book'])->get();
        return view('admin.return.index', compact('returns'));
    }

    public function create()
    {
        $borrows = BorrowRecord::where('status', '!=', 'Returned')->with(['member.user', 'book'])->get();
        $users = User::whereIn('role', ['Admin', 'Librarian'])->get();
        return view('admin.return.create', compact('borrows', 'users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'borrow_id' => 'required|exists:borrow_records,id|unique:return_records,borrow_id',
            'returned_by' => 'nullable|exists:users,id',
            'return_date' => 'nullable|date',
            'condition_status' => 'required|in:Good,Damaged,Lost',
            'remarks' => 'nullable|string',
        ]);

        $borrow = BorrowRecord::findOrFail($validated['borrow_id']);

        ReturnRecord::create([
            'borrow_id' => $validated['borrow_id'],
            'returned_by' => $validated['returned_by'],
            'return_date' => $validated['return_date'] ?? now()->toDateString(),
            'condition_status' => $validated['condition_status'],
            'remarks' => $validated['remarks'],
        ]);

        $borrow->update(['status' => 'Returned']);

        $book = $borrow->book;
        if ($book && $validated['condition_status'] === 'Good') {
            $book->increment('available_quantity');
            if ($book->available_quantity > 0) {
                $book->update(['status' => 'Available']);
            }
        }

        return redirect()->route('return.index')->with('success', 'Book returned successfully.');
    }

    public function show($id)
    {
        $return = ReturnRecord::with(['borrow.member.user', 'borrow.book'])->findOrFail($id);
        return view('admin.return.show', compact('return'));
    }

    public function edit($id)
    {
        $return = ReturnRecord::with('borrow.member.user', 'borrow.book')->findOrFail($id);
        $users = User::whereIn('role', ['Admin', 'Librarian'])->get();
        return view('admin.return.edit', compact('return', 'users'));
    }

    public function update(Request $request, $id)
    {
        $return = ReturnRecord::findOrFail($id);
        $validated = $request->validate([
            'returned_by' => 'nullable|exists:users,id',
            'return_date' => 'nullable|date',
            'condition_status' => 'required|in:Good,Damaged,Lost',
            'remarks' => 'nullable|string',
        ]);

        $return->update($validated);

        return redirect()->route('return.index')->with('success', 'Return record updated successfully.');
    }

    public function destroy($id)
    {
        $return = ReturnRecord::findOrFail($id);
        $return->delete();

        return redirect()->route('return.index')->with('success', 'Return record deleted successfully.');
    }
}
