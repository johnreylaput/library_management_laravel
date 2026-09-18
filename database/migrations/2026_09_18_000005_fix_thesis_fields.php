<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('theses', function (Blueprint $table) {
            $table->date('date_published')->nullable()->change();
        });

        Schema::table('theses', function (Blueprint $table) {
            $table->enum('research', [
                'Thesis',
                'Capstone',
                'Feasibility Study',
                'Marketing Research',
                'Undergraduate Thesis',
                'Masteral Thesis',
                'Doctoral Thesis',
                'University Research',
            ])->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('theses', function (Blueprint $table) {
            $table->year('date_published')->nullable()->change();
        });

        Schema::table('theses', function (Blueprint $table) {
            $table->string('research', 100)->nullable()->change();
        });
    }
};
