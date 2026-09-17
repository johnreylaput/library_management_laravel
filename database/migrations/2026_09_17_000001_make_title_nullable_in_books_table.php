<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * The Books module was refactored so a book record is identified by
     * author / subject / year / publication only (see migrations
     * 2026_09_15_125336 and 2026_09_15_131550). The legacy `title` column
     * was left behind as NOT NULL without a default, so every INSERT made
     * from the Add Book / Edit Book forms failed with:
     *
     *   SQLSTATE[23000]: Integrity constraint violation:
     *   19 NOT NULL constraint failed: books.title
     *
     * Making it nullable keeps the historical titles of existing rows while
     * allowing new rows to be saved without a title.
     */
    public function up(): void
    {
        if (Schema::hasColumn('books', 'title')) {
            Schema::table('books', function (Blueprint $table) {
                $table->string('title', 255)->nullable()->change();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('books', 'title')) {
            // Backfill so the NOT NULL constraint can be re-applied.
            DB::table('books')->whereNull('title')->update(['title' => '']);

            Schema::table('books', function (Blueprint $table) {
                $table->string('title', 255)->nullable(false)->change();
            });
        }
    }
};