<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('journals', function (Blueprint $table) {
            $table->id();
            $table->string('journal_name', 255);
            $table->string('title', 255);
            $table->text('authors');
            $table->string('volume', 50)->nullable();
            $table->string('issue', 50)->nullable();
            $table->string('pages', 50)->nullable();
            $table->date('publication_date')->nullable();
            $table->string('doi', 255)->nullable();
            $table->string('link', 500)->nullable();
            $table->foreignId('category_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('publisher_id')->nullable()->constrained()->nullOnDelete();
            $table->text('abstract')->nullable();
            $table->text('description')->nullable();
            $table->enum('status', ['Available', 'Unavailable', 'Archived'])->default('Available');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('journals');
    }
};
