<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up(): void
    {
        // Users table already created by 0001_01_01_000000 and recreated by 2026_08_17_225818_recreate_users_table.
        // This migration is kept as a no-op to avoid conflicts.
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Intentionally left empty.
    }
};
