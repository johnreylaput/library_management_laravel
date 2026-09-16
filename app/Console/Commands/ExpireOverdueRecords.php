<?php

namespace App\Console\Commands;

use App\Models\BorrowRecord;
use App\Models\Reservation;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

class ExpireOverdueRecords extends Command
{
    protected $signature = 'records:expire-overdue';

    protected $description = 'Auto-disappear overdue borrows and expired pending reservations (3+ days past due)';

    public function handle(): void
    {
        $cutoff = Carbon::now()->subDays(3);

        $expiredBorrows = BorrowRecord::whereIn('status', ['Borrowed', 'Overdue'])
            ->where('due_date', '<', $cutoff->toDateString())
            ->update(['status' => 'Cancelled']);

        $expiredReservations = Reservation::where('status', 'Pending')
            ->where('due_date', '<', $cutoff->toDateString())
            ->update(['status' => 'Cancelled']);

        $this->info("Auto-disappeared {$expiredBorrows} overdue borrow(s) and {$expiredReservations} expired pending reservation(s) older than 3 days.");
    }
}
