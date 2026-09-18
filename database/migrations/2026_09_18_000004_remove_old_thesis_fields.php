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
        // Old fields are not restored
    }
};
