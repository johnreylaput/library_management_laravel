<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('journals')) {
            DB::statement("UPDATE journals SET availability = 'Available' WHERE availability IS NULL OR availability = ''");
        }
    }

    public function down(): void
    {
    }
};
