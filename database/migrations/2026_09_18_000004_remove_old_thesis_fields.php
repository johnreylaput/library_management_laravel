<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('theses', function (Blueprint $table) {
            $table->dropColumn([
                'authors',
                'thesis_type',
                'year',
                'subjects',
                'abstract',
            ]);
        });
    }

    public function down(): void
    {
        Schema::table('theses', function (Blueprint $table) {
            $table->text('authors')->nullable()->after('title');
            $table->string('thesis_type', 100)->nullable()->after('author');
            $table->year('year')->nullable()->after('institution');
            $table->string('subjects', 500)->nullable()->after('availability');
            $table->text('abstract')->nullable()->after('link');
        });
    }
};
