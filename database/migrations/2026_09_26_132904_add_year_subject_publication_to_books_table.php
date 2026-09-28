<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
/**
      * Run the migrations.
      */
    public function up(): void
    {
        Schema::table('books', function (Blueprint $table) {
            $table->string('year', 10)->nullable()->after('edition');
            $table->string('subject', 255)->nullable()->after('year');
            $table->string('publication', 50)->nullable()->after('subject');
        });
    }

    /**
      * Reverse the migrations.
      */
    public function down(): void
    {
        Schema::table('books', function (Blueprint $table) {
            $table->dropColumn(['year', 'subject', 'publication']);
        });
    }
};
