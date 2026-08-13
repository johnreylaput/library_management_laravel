<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('journals', function (Blueprint $table) {
            $table->string('issn', 20)->nullable()->after('doi');
            $table->string('database_collection', 255)->nullable()->after('issn');
            $table->string('availability', 100)->nullable()->after('database_collection');
            $table->string('subjects', 500)->nullable()->after('availability');
        });

        Schema::table('theses', function (Blueprint $table) {
            $table->string('database_collection', 255)->nullable()->after('link');
            $table->string('availability', 100)->nullable()->after('database_collection');
            $table->string('subjects', 500)->nullable()->after('availability');
        });
    }

    public function down(): void
    {
        Schema::table('journals', function (Blueprint $table) {
            $table->dropColumn(['issn', 'database_collection', 'availability', 'subjects']);
        });

        Schema::table('theses', function (Blueprint $table) {
            $table->dropColumn(['database_collection', 'availability', 'subjects']);
        });
    }
};
