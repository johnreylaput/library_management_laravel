<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('journals', function (Blueprint $table) {
            $table->string('publisher_text', 255)->nullable()->after('publisher_id');
            $table->string('category_text', 255)->nullable()->after('category_id');
        });
    }

    public function down(): void
    {
        Schema::table('journals', function (Blueprint $table) {
            $table->dropColumn(['publisher_text', 'category_text']);
        });
    }
};
