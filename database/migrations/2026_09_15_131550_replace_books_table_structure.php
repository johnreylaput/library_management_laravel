<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('books', function (Blueprint $table) {
            // Drop foreign keys first
            $table->dropForeign(['category_id']);
            $table->dropForeign(['author_id']);
            $table->dropForeign(['publisher_id']);
            
            // Drop remaining old columns
            $table->dropColumn([
                'category_id',
                'author_id',
                'publisher_id',
                'publication_year',
                'language',
                'pages',
                'quantity',
                'available_quantity',
                'shelf_location',
                'book_cover',
                'description',
                'status',
                'added_by',
                'edited_by',
            ]);
            
            // Add new columns matching Author structure (if not exist)
            if (!Schema::hasColumn('books', 'author')) {
                $table->string('author', 255)->after('title');
            }
            if (!Schema::hasColumn('books', 'edition')) {
                $table->string('edition', 100)->nullable()->after('author');
            }
            if (!Schema::hasColumn('books', 'year')) {
                $table->string('year', 10)->nullable()->after('edition');
            }
        });
    }

    public function down(): void
    {
        Schema::table('books', function (Blueprint $table) {
            $table->dropColumn(['author', 'edition', 'year', 'subject', 'publication']);
        });
    }
};