<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Member;
use App\Models\BorrowRecord;
use App\Models\Fine;
use App\Models\Reservation;
use App\Models\ActivityLog;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:Admin,Librarian,Member,Working-Student');
    }

    public function index(Request $request)
    {
        $user = Auth::user();

        if (in_array($user->role, ['Member'])) {
            $member = Member::where('user_id', $user->id)->first();
            $stats = [
                'total_books' => Book::count(),
                'total_members' => Member::count(),
                'my_borrowed' => $member ? BorrowRecord::where('member_id', $member->id)->where('status', 'Borrowed')->count() : 0,
                'my_overdue' => $member ? BorrowRecord::where('member_id', $member->id)->where('status', 'Overdue')->count() : 0,
                'my_reservations' => $member ? Reservation::where('member_id', $member->id)->where('status', 'Pending')->count() : 0,
                'my_fines' => $member ? Fine::whereHas('borrow', function ($q) use ($member) {
                    $q->where('member_id', $member->id);
                })->count() : 0,
            ];
            $borrows = $member ? BorrowRecord::with('book')->where('member_id', $member->id)->latest()->take(5)->get() : collect();
            $reservations = $member ? Reservation::with('book')->where('member_id', $member->id)->latest()->take(5)->get() : collect();
            $fines = $member ? Fine::whereHas('borrow', function ($q) use ($member) {
                $q->where('member_id', $member->id);
            })->latest()->take(5)->get() : collect();

            $dueNotifications = collect();
            if ($member) {
                $today = now()->toDateString();
                $tomorrow = now()->addDay()->toDateString();

                $dueToday = BorrowRecord::with('book')->where('member_id', $member->id)
                    ->where('due_date', $today)
                    ->where('status', '!=', 'Returned')
                    ->get();

                $dueTomorrow = BorrowRecord::with('book')->where('member_id', $member->id)
                    ->where('due_date', $tomorrow)
                    ->where('status', '!=', 'Returned')
                    ->get();

                $overdue = BorrowRecord::with('book')->where('member_id', $member->id)
                    ->where('due_date', '<', $today)
                    ->where('status', '!=', 'Returned')
                    ->get();

                foreach ($dueToday as $record) {
                    $bookTitle = $record->book->title ?? 'Unknown';
                    $dueNotifications->push([
                        'type' => 'danger',
                        'icon' => 'bi-calendar-check',
                        'title' => 'Due Today',
                        'message' => "The book <strong>{$bookTitle}</strong> is due for return today.",
                    ]);
                }

                foreach ($dueTomorrow as $record) {
                    $bookTitle = $record->book->title ?? 'Unknown';
                    $dueNotifications->push([
                        'type' => 'warning',
                        'icon' => 'bi-exclamation-triangle',
                        'title' => 'Due Tomorrow',
                        'message' => "The book <strong>{$bookTitle}</strong> is due for return tomorrow.",
                    ]);
                }

                foreach ($overdue as $record) {
                    $bookTitle = $record->book->title ?? 'Unknown';
                    $dueNotifications->push([
                        'type' => 'danger',
                        'icon' => 'bi-x-circle',
                        'title' => 'Overdue',
                        'message' => "The book <strong>{$bookTitle}</strong> is overdue. Please return it as soon as possible.",
                    ]);
                }
            }

            $receivedNotifications = Notification::where('user_id', $user->id)
                ->where('is_read', false)
                ->where('created_at', '>=', now()->subHours(24))
                ->latest()
                ->take(5)
                ->get();

            $welcomeType = $request->session()->pull('welcome_type', 'returning');

            return view('member.dashboard', compact('stats', 'borrows', 'reservations', 'fines', 'dueNotifications', 'receivedNotifications', 'welcomeType'));
        }

        $stats = [
            'total_books' => Book::count(),
            'total_members' => Member::count(),
            'total_borrowed' => BorrowRecord::where('status', 'Borrowed')->count(),
            'total_overdue' => BorrowRecord::where('status', 'Overdue')->count(),
            'total_fines' => Fine::count(),
            'total_reservations' => Reservation::where('status', 'Pending')->count(),
            'pending_borrow_requests' => BorrowRecord::where('status', 'Pending')->count(),
            'pending_reservation_requests' => Reservation::where('status', 'Pending')->count(),
        ];

        $recentLogs = ActivityLog::latest()->take(10)->get();
        $pendingBorrows = BorrowRecord::with(['member.user', 'book', 'journal', 'thesis'])->where('status', 'Pending')->latest()->take(5)->get();
        $pendingReservations = Reservation::with(['member.user', 'book', 'journal', 'thesis'])->where('status', 'Pending')->latest()->take(5)->get();

        $today = now()->toDateString();
        $tomorrow = now()->addDay()->toDateString();

        $dueBorrows = BorrowRecord::with(['member.user', 'book'])
            ->whereIn('status', ['Borrowed', 'Overdue'])
            ->where('due_date', '<=', $tomorrow)
            ->get();

        $dueReservations = Reservation::with(['member.user', 'book'])
            ->where('status', 'Pending')
            ->where('due_date', '<=', $tomorrow)
            ->get();

        $showPendingAlert = false;
        if ($stats['pending_borrow_requests'] > 0 || $stats['pending_reservation_requests'] > 0) {
            $lastShown = session('pending_requests_alert_shown_at');
            if (!$lastShown || now()->parse($lastShown)->lt(now()->subHours(24))) {
                $showPendingAlert = true;
                session(['pending_requests_alert_shown_at' => now()]);
            }
        }

        return view('admin.dashboard', compact('stats', 'recentLogs', 'pendingBorrows', 'pendingReservations', 'dueBorrows', 'dueReservations', 'showPendingAlert'));
    }

    public function sendNotification(Request $request)
    {
        $request->validate([
            'type' => 'required|in:borrow,reservation',
            'record_id' => 'required|integer',
            'title' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        $type = $request->type;
        $recordId = $request->record_id;
        $userId = null;
        $borrowId = null;
        $reservationId = null;

        if ($type === 'borrow') {
            $borrow = BorrowRecord::with('member.user')->findOrFail($recordId);
            $userId = $borrow->member->user_id ?? $borrow->member_id;
            $borrowId = $borrow->id;
        } else {
            $reservation = Reservation::with('member.user')->findOrFail($recordId);
            $userId = $reservation->member->user_id ?? $reservation->member_id;
            $reservationId = $reservation->id;
        }

        $existingNotification = Notification::where('user_id', $userId)
            ->where('type', $type)
            ->where('is_read', false)
            ->when($borrowId, fn($q) => $q->where('borrow_id', $borrowId))
            ->when($reservationId, fn($q) => $q->where('reservation_id', $reservationId))
            ->exists();

        if ($existingNotification) {
            return back()->with('warning', 'A notification for this record has already been sent and is still unread.');
        }

        Notification::create([
            'user_id' => $userId,
            'type' => $type,
            'borrow_id' => $borrowId,
            'reservation_id' => $reservationId,
            'title' => $request->title,
            'message' => $request->message,
            'sent_by' => Auth::id(),
        ]);

        ActivityLog::create([
            'user_id' => Auth::id(),
            'username' => Auth::user()->username,
            'role' => Auth::user()->role,
            'action' => 'Send Notification',
            'description' => "Sent notification to user ID {$userId}: {$request->title}",
            'ip_address' => $request->ip(),
        ]);

        return back()->with('success', 'Notification sent successfully.');
    }
}
