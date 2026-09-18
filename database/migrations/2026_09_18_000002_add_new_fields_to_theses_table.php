<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('theses', function (Blueprint $table) {
            $table->string('author', 255)->nullable()->after('title');
            $table->string('research', 100)->nullable()->after('author');
            $table->date('date_published')->nullable()->after('institution');
            $table->string('subjects_keywords', 500)->nullable()->after('availability');
            $table->text('summary')->nullable()->after('link');
        });
    }

    public function down(): void
    {
        Schema::table('theses', function (Blueprint $table) {
            $table->dropColumn(['author', 'research', 'date_published', 'subjects_keywords', 'summary']);
        });
    }
};
