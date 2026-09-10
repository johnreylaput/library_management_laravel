<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\BorrowRecord;
use App\Models\Category;
use App\Models\Fine;
use App\Models\Journal;
use App\Models\Member;
use App\Models\Reservation;
use App\Models\Thesis;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:Admin,Librarian,Working.Student');
    }

    public function index()
    {
        $stats = [
            'total_books' => Book::count(),
            'total_periodicals' => Journal::count(),
            'total_theses' => Thesis::count(),
            'total_members' => Member::count(),
            'total_borrowed' => BorrowRecord::where('status', 'Borrowed')->count(),
            'total_overdue' => BorrowRecord::where('status', 'Overdue')->count(),
            'total_reservations' => Reservation::where('status', 'Pending')->count(),
            'total_fines' => Fine::count(),
            'total_pending_borrow_requests' => BorrowRecord::where('status', 'Pending')->count(),
            'total_returned' => BorrowRecord::where('status', 'Returned')->count(),
            'total_cancelled_reservations' => Reservation::where('status', 'Cancelled')->count(),
            'total_approved_deletions' => \App\Models\DeletionRequest::where('status', 'Approved')->count(),
        ];

        $topBooks = BorrowRecord::select('book_id', DB::raw('COUNT(*) as borrow_count'))
            ->whereNotNull('book_id')
            ->groupBy('book_id')
            ->orderByDesc('borrow_count')
            ->limit(10)
            ->get()
            ->map(function ($item) {
                $book = Book::with(['category', 'author', 'publisher'])->find($item->book_id);
                return [
                    'book' => $book,
                    'count' => $item->borrow_count,
                ];
            });

        $topPeriodicals = BorrowRecord::select('journal_id', DB::raw('COUNT(*) as borrow_count'))
            ->whereNotNull('journal_id')
            ->groupBy('journal_id')
            ->orderByDesc('borrow_count')
            ->limit(10)
            ->get()
            ->map(function ($item) {
                $journal = Journal::with(['category', 'publisher'])->find($item->journal_id);
                return [
                    'journal' => $journal,
                    'count' => $item->borrow_count,
                ];
            });

        $topTheses = BorrowRecord::select('thesis_id', DB::raw('COUNT(*) as borrow_count'))
            ->whereNotNull('thesis_id')
            ->groupBy('thesis_id')
            ->orderByDesc('borrow_count')
            ->limit(10)
            ->get()
            ->map(function ($item) {
                $thesis = Thesis::with(['category', 'author', 'publisher'])->find($item->thesis_id);
                return [
                    'thesis' => $thesis,
                    'count' => $item->borrow_count,
                ];
            });

        $overdueBorrows = BorrowRecord::where('status', 'Overdue')
            ->with(['member.user', 'book', 'journal', 'thesis'])
            ->orderByDesc('due_date')
            ->get();

        $recentBorrows = BorrowRecord::with(['member.user', 'book', 'journal', 'thesis'])
            ->latest()
            ->limit(15)
            ->get();

        $recentReturns = BorrowRecord::where('status', 'Returned')
            ->with(['member.user', 'book', 'journal', 'thesis'])
            ->latest('updated_at')
            ->limit(15)
            ->get();

        $recentReservations = Reservation::with(['member.user', 'book', 'journal', 'thesis'])
            ->latest()
            ->limit(15)
            ->get();

        $recentFines = Fine::with(['borrow.member.user', 'borrow.book', 'borrow.journal', 'borrow.thesis'])
            ->latest()
            ->limit(15)
            ->get();

        $categoryStats = Category::withCount('books')
            ->orderByDesc('books_count')
            ->get();

        $memberActivity = Member::with(['user'])
            ->withCount('borrowRecords')
            ->orderByDesc('borrow_records_count')
            ->limit(10)
            ->get();

        return view('admin.reports.index', compact(
            'stats',
            'topBooks',
            'topPeriodicals',
            'topTheses',
            'overdueBorrows',
            'recentBorrows',
            'recentReturns',
            'recentReservations',
            'recentFines',
            'categoryStats',
            'memberActivity'
        ));
    }
}
