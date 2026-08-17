<?php

namespace App\Console\Commands;

use App\Mail\BorrowDueMail;
use App\Models\BorrowRecord;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class SendBorrowDueNotifications extends Command
{
    protected $signature = 'borrow:send-due-notifications';
    protected $description = 'Send email notifications for due and overdue borrow records';

    public function handle(): void
    {
        $today = Carbon::today();
        $nearDueThreshold = Carbon::today()->addDays(3);

        $borrows = BorrowRecord::with(['member.user'])
            ->whereIn('status', ['Borrowed', 'Pending'])
            ->get()
            ->filter(function ($borrow) use ($today, $nearDueThreshold) {
                $dueDate = Carbon::parse($borrow->due_date);
                return $dueDate->lessThanOrEqualTo($nearDueThreshold);
            });

        $sentCount = 0;

        foreach ($borrows as $borrow) {
            $dueDate = Carbon::parse($borrow->due_date);
            $user = $borrow->member->user;

            if (!$user || !$user->email) {
                continue;
            }

            $itemTitle = $borrow->book?->title ?? $borrow->journal?->title ?? $borrow->thesis?->title ?? 'Unknown Item';
            $status = $dueDate->lt($today) ? 'Overdue' : 'Due Soon';

            Mail::to($user->email)->send(new BorrowDueMail(
                userName: $user->full_name,
                itemTitle: $itemTitle,
                dueDate: $dueDate->format('F j, Y'),
                status: $status
            ));

            $sentCount++;
        }

        $this->info("Sent {$sentCount} borrow due notification(s).");
    }
}
