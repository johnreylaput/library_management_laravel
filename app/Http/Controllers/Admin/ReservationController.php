<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Book;
use App\Models\Member;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:Admin,Librarian,Working-Student');
    }

    public function index()
    {
        $reservations = Reservation::with(['member.user', 'book', 'journal', 'thesis'])->get();
        return view('admin.reservations.index', compact('reservations'));
    }

    public function create()
    {
        return view('admin.reservations.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'member_input' => 'required|string',
            'book_input' => 'required|string',
            'reservation_date' => 'nullable|date',
            'expiration_date' => 'nullable|date|after_or_equal:reservation_date',
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

        Reservation::create([
            'member_id' => $member->id,
            'book_id' => $book->id,
            'reservation_date' => $request->reservation_date,
            'expiration_date' => $request->expiration_date,
            'status' => 'Pending',
        ]);

        return redirect()->route('reservations.index')->with('success', 'Reservation created successfully.');
    }

    public function show($id)
    {
        $reservation = Reservation::with(['member.user', 'book', 'journal', 'thesis'])->findOrFail($id);
        return view('admin.reservations.show', compact('reservation'));
    }

    public function edit($id)
    {
        $reservation = Reservation::with('member.user', 'book')->findOrFail($id);
        return view('admin.reservations.edit', compact('reservation'));
    }

    public function update(Request $request, $id)
    {
        $reservation = Reservation::findOrFail($id);
        $validated = $request->validate([
            'member_input' => 'required|string',
            'book_input' => 'required|string',
            'reservation_date' => 'nullable|date',
            'expiration_date' => 'nullable|date|after_or_equal:reservation_date',
            'status' => 'required|in:Pending,Approved,Cancelled,Claimed',
        ]);

        $member = Member::whereHas('user', function ($q) use ($request) {
            $q->where('full_name', 'like', '%' . $request->member_input . '%');
        })->orWhere('member_no', 'like', '%' . $request->member_input . '%')->first();

        $book = Book::where('title', 'like', '%' . $request->book_input . '%')->first();

        $reservation->update([
            'member_id' => $member ? $member->id : $reservation->member_id,
            'book_id' => $book ? $book->id : $reservation->book_id,
            'reservation_date' => $validated['reservation_date'],
            'expiration_date' => $validated['expiration_date'],
            'status' => $validated['status'],
        ]);

        return redirect()->route('reservations.index')->with('success', 'Reservation updated successfully.');
    }

    public function destroy($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->delete();

        return redirect()->route('reservations.index')->with('success', 'Reservation deleted successfully.');
    }

    public function approve($id)
    {
        $reservation = Reservation::with(['member.user', 'book', 'journal', 'thesis'])->findOrFail($id);

        if ($reservation->status !== 'Pending') {
            return redirect()->route('reservations.index')->with('error', 'Only pending reservations can be approved.');
        }

        $reservation->update(['status' => 'Approved']);

        $itemTitle = $reservation->book?->title ?? $reservation->journal?->title ?? $reservation->thesis?->title ?? 'Unknown Item';

        ActivityLog::create([
            'user_id' => Auth::id(),
            'username' => Auth::user()?->username ?? 'Admin',
            'role' => Auth::user()?->role ?? 'Admin',
            'action' => 'Reservation Approved',
            'description' => "Approved reservation for {$itemTitle} (Member: {$reservation->member->user->full_name})",
            'ip_address' => request()->ip(),
        ]);

        return redirect()->route('reservations.index')->with('success', 'Reservation approved successfully.');
    }

    public function reject($id)
    {
        $reservation = Reservation::with(['member.user', 'book', 'journal', 'thesis'])->findOrFail($id);

        if ($reservation->status !== 'Pending') {
            return redirect()->route('reservations.index')->with('error', 'Only pending reservations can be rejected.');
        }

        $reservation->update(['status' => 'Cancelled']);

        $itemTitle = $reservation->book?->title ?? $reservation->journal?->title ?? $reservation->thesis?->title ?? 'Unknown Item';

        ActivityLog::create([
            'user_id' => Auth::id(),
            'username' => Auth::user()?->username ?? 'Admin',
            'role' => Auth::user()?->role ?? 'Admin',
            'action' => 'Reservation Rejected',
            'description' => "Rejected reservation for {$itemTitle} (Member: {$reservation->member->user->full_name})",
            'ip_address' => request()->ip(),
        ]);

        return redirect()->route('reservations.index')->with('success', 'Reservation rejected successfully.');
    }
}
