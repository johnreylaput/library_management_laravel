<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\BorrowRecord;
use App\Models\Fine;
use App\Models\Member;
use App\Models\Reservation;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:Admin,Librarian,Working-Student');
    }

    public function index()
    {
        $stats = [
            'total_books' => Book::count(),
            'total_members' => Member::count(),
            'total_borrowed' => BorrowRecord::where('status', 'Borrowed')->count(),
            'total_overdue' => BorrowRecord::where('status', 'Overdue')->count(),
            'total_fines' => Fine::count(),
            'total_reservations' => Reservation::where('status', 'Pending')->count(),
        ];

        $topBooks = BorrowRecord::select('book_id', \Illuminate\Support\Facades\DB::raw('COUNT(*) as borrow_count'))
            ->groupBy('book_id')
            ->orderByDesc('borrow_count')
            ->limit(10)
            ->get()
            ->map(function ($item) {
                return [
                    'book' => \App\Models\Book::find($item->book_id),
                    'count' => $item->borrow_count,
                ];
            });

        $overdueBorrows = BorrowRecord::where('status', 'Overdue')->with('member.user', 'book')->get();

        return view('admin.reports.index', compact('stats', 'topBooks', 'overdueBorrows'));
    }
}
