<?php

namespace App\Console\Commands;

use App\Models\DeletionRequest;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

class ExpirePendingDeletionRequests extends Command
{
    protected $signature = 'deletion-requests:expire';

    protected $description = 'Expire pending deletion requests older than 3 days';

    public function handle(): void
    {
        $cutoff = Carbon::now()->subDays(3);

        $count = DeletionRequest::where('status', 'Pending')
            ->where('created_at', '<', $cutoff)
            ->update(['status' => 'Expired']);

        $this->info("Expired {$count} pending deletion request(s) older than 3 days.");
    }
}
