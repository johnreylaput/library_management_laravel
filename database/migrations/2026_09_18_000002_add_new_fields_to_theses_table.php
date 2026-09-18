<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('theses', function (Blueprint $table) {
            $table->string('author', 255)->nullable()->after('authors');
            $table->string('research', 100)->nullable()->after('thesis_type');
            $table->year('date_published')->nullable()->after('year');
            $table->string('subjects_keywords', 500)->nullable()->after('subjects');
            $table->text('summary')->nullable()->after('abstract');
        });

        $theses = DB::table('theses')->get();
        foreach ($theses as $thesis) {
            $updateData = [];
            if ($thesis->authors) {
                $updateData['author'] = $thesis->authors;
            }
            if ($thesis->thesis_type) {
                $updateData['research'] = $thesis->thesis_type;
            }
            if ($thesis->year) {
                $updateData['date_published'] = $thesis->year;
            }
            if ($thesis->subjects) {
                $updateData['subjects_keywords'] = $thesis->subjects;
            }
            if ($thesis->abstract) {
                $updateData['summary'] = $thesis->abstract;
            }
            if (!empty($updateData)) {
                DB::table('theses')->where('id', $thesis->id)->update($updateData);
            }
        }
    }

    public function down(): void
    {
        Schema::table('theses', function (Blueprint $table) {
            $table->dropColumn(['author', 'research', 'date_published', 'subjects_keywords', 'summary']);
        });
    }
};
