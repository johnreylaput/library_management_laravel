<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\BorrowRecord;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        $member = Member::where('user_id', $user->id)->first();
        $borrowRecords = BorrowRecord::with('book')
            ->where('member_id', $member->id ?? 0)
            ->get();

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
            ->latest()
            ->take(5)
            ->get();

        return view('profile.index', compact('user', 'member', 'borrowRecords', 'dueNotifications', 'receivedNotifications'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $validated = $request->validate([
            'full_name' => 'required|string|max:150',
            'email' => 'required|email|max:100|unique:users,email,' . $user->id,
        ]);

        $user->update($validated);

        return redirect()->route('profile.index')->with('success', 'Profile updated successfully.');
    }
}
