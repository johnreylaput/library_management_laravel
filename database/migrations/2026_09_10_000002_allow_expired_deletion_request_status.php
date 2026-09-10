<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("
            ALTER TABLE deletion_requests
            MODIFY COLUMN status ENUM('Pending', 'Approved', 'Rejected', 'Expired') NOT NULL DEFAULT 'Pending'
        ");
    }

    public function down(): void
    {
        DB::table('deletion_requests')
            ->where('status', 'Expired')
            ->update(['status' => 'Rejected']);

        DB::statement("
            ALTER TABLE deletion_requests
            MODIFY COLUMN status ENUM('Pending', 'Approved', 'Rejected') NOT NULL DEFAULT 'Pending'
        ");
    }
};
