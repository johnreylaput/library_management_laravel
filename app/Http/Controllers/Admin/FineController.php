<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BorrowRecord;
use App\Models\Fine;
use Illuminate\Http\Request;

class FineController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:Admin,Librarian,Working-Student');
    }

    public function index()
    {
        $fines = Fine::with('borrow.member.user', 'borrow.book')->get();
        return view('admin.fines.index', compact('fines'));
    }

    public function create()
    {
        $borrows = BorrowRecord::where('status', 'Overdue')->with(['member.user', 'book'])->get();
        return view('admin.fines.create', compact('borrows'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'borrow_id' => 'required|exists:borrow_records,id|unique:fines,borrow_id',
            'amount' => 'required|numeric|min:0',
            'reason' => 'nullable|string|max:255',
            'paid' => 'required|in:Yes,No',
        ]);

        Fine::create($validated);

        return redirect()->route('fines.index')->with('success', 'Fine created successfully.');
    }

    public function show($id)
    {
        $fine = Fine::with('borrow.member.user', 'borrow.book')->findOrFail($id);
        return view('admin.fines.show', compact('fine'));
    }

    public function edit($id)
    {
        $fine = Fine::with('borrow')->findOrFail($id);
        $borrows = BorrowRecord::with(['member.user', 'book'])->get();
        return view('admin.fines.edit', compact('fine', 'borrows'));
    }

    public function update(Request $request, $id)
    {
        $fine = Fine::findOrFail($id);
        $validated = $request->validate([
            'amount' => 'required|numeric|min:0',
            'reason' => 'nullable|string|max:255',
            'paid' => 'required|in:Yes,No',
        ]);

        $fine->update($validated);

        return redirect()->route('fines.index')->with('success', 'Fine updated successfully.');
    }

    public function destroy($id)
    {
        $fine = Fine::findOrFail($id);
        $fine->delete();

        return redirect()->route('fines.index')->with('success', 'Fine deleted successfully.');
    }
}
