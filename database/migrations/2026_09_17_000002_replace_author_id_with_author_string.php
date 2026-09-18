<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasColumn('books', 'author_id')) {
            Schema::table('books', function (Blueprint $table) {
                $table->dropForeign(['author_id']);
                $table->dropColumn('author_id');
            });
        }
        if (!Schema::hasColumn('books', 'author')) {
            Schema::table('books', function (Blueprint $table) {
                $table->string('author', 150)->nullable()->after('title');
            });
        }
    }

    public function down(): void
    {
        if (!Schema::hasColumn('books', 'author_id')) {
            Schema::table('books', function (Blueprint $table) {
                $table->foreignId('author_id')->nullable()->constrained()->nullOnDelete()->after('title');
            });
        }
        if (Schema::hasColumn('books', 'author')) {
            Schema::table('books', function (Blueprint $table) {
                $table->dropColumn('author');
            });
        }
    }
};
