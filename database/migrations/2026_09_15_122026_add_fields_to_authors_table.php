<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('authors', function (Blueprint $table) {
            $table->string('title', 255)->nullable()->after('author_name');
            $table->string('edition', 100)->nullable()->after('title');
            $table->string('year', 10)->nullable()->after('edition');
            $table->string('subject', 255)->nullable()->after('year');
            $table->enum('publication', ['Foreign', 'Local'])->nullable()->after('subject');
        });
    }

    public function down(): void
    {
        Schema::table('authors', function (Blueprint $table) {
            $table->dropColumn(['title', 'edition', 'year', 'subject', 'publication']);
        });
    }
};