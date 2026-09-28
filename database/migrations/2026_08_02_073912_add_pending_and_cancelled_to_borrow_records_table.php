<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // The borrow_records table already has the full status enum
        // (Pending, Borrowed, Returned, Overdue,Cancelled) from the original
        // create_borrow_records_table migration. This migration is a no-op.
    }

    public function down(): void
    {
        // Intentionally left empty.
    }
};