<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // The users table already has Working.Student in the role enum
        // from the original 0001_01_01_000000_create_users_table migration.
        // This migration is a no-op.
    }

    public function down(): void
    {
        // Intentionally left empty.
    }
};