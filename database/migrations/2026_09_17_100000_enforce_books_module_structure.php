<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Remove any legacy columns left by an older Books migration. The current
     * migration chain has already converted production records to the six
     * active catalog fields, so this is intentionally conditional: it is safe
     * for both upgraded databases and clean installs.
     */
    public function up(): void
    {
        $legacyColumns = array_values(array_filter([
            'accession_no',
            'isbn',
            'category_id',
            'publisher_id',
            'quantity',
            'description',
        ], fn (string $column): bool => Schema::hasColumn('books', $column)));

        if ($legacyColumns !== []) {
            Schema::table('books', function ($table) use ($legacyColumns): void {
                $table->dropColumn($legacyColumns);
            });
        }
    }

    /**
     * Legacy values cannot be reconstructed after removal, so rollback is a
     * no-op rather than adding empty columns that could be mistaken for data.
     */
    public function down(): void
    {
    }
};
