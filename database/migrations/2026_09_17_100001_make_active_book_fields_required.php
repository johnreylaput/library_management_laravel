<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $hasIncompleteRecords = DB::table('books')
            ->whereNull('title')
            ->orWhereNull('edition')
            ->orWhereNull('year')
            ->orWhereNull('subject')
            ->orWhereNull('publication')
            ->orWhereRaw("TRIM(title) = ''")
            ->orWhereRaw("TRIM(edition) = ''")
            ->orWhereRaw("TRIM(year) = ''")
            ->orWhereRaw("TRIM(subject) = ''")
            ->orWhereNotIn('publication', ['Foreign', 'Local'])
            ->exists();

        // Preserve incomplete legacy rows for manual review instead of
        // replacing missing metadata with guessed values or recording a
        // partially completed migration.
        if ($hasIncompleteRecords) {
            throw new \RuntimeException(
                'Books contains incomplete legacy records. Fill in title, edition, year, subject, and publication before running this migration.'
            );
        }

        Schema::table('books', function (Blueprint $table): void {
            $table->string('title', 255)->nullable(false)->change();
            $table->string('edition', 100)->nullable(false)->change();
            $table->string('year', 10)->nullable(false)->change();
            $table->string('subject', 255)->nullable(false)->change();
            $table->enum('publication', ['Foreign', 'Local'])->nullable(false)->change();
        });
    }

    public function down(): void
    {
        Schema::table('books', function (Blueprint $table): void {
            $table->string('title', 255)->nullable()->change();
            $table->string('edition', 100)->nullable()->change();
            $table->string('year', 10)->nullable()->change();
            $table->string('subject', 255)->nullable()->change();
            $table->enum('publication', ['Foreign', 'Local'])->nullable()->change();
        });
    }
};
