<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('borrow_records', function (Blueprint $table) {
            DB::statement("ALTER TABLE borrow_records MODIFY COLUMN status ENUM('Pending', 'Borrowed', 'Returned', 'Overdue', 'Cancelled') DEFAULT 'Borrowed'");
        });
    }

    public function down(): void
    {
        Schema::table('borrow_records', function (Blueprint $table) {
            DB::statement("ALTER TABLE borrow_records MODIFY COLUMN status ENUM('Borrowed', 'Returned', 'Overdue') DEFAULT 'Borrowed'");
        });
    }
};
