<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('reservations', function (Blueprint $table) {
            $table->foreignId('journal_id')->nullable()->constrained()->nullOnDelete()->after('book_id');
            $table->foreignId('thesis_id')->nullable()->constrained()->nullOnDelete()->after('journal_id');
        });
    }

    public function down(): void
    {
        Schema::table('reservations', function (Blueprint $table) {
            $table->dropForeign(['journal_id']);
            $table->dropForeign(['thesis_id']);
            $table->dropColumn(['journal_id', 'thesis_id']);
        });
    }
};
