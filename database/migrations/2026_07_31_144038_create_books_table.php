<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('accession_no', 50)->unique()->nullable();
            $table->string('isbn', 50)->nullable();
            $table->string('title', 255);
            $table->foreignId('category_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('author_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('publisher_id')->nullable()->constrained()->nullOnDelete();
            $table->year('publication_year')->nullable();
            $table->string('edition', 30)->nullable();
            $table->string('language', 50)->nullable();
            $table->integer('pages')->nullable();
            $table->integer('quantity')->default(1);
            $table->integer('available_quantity')->default(1);
            $table->string('shelf_location', 100)->nullable();
            $table->string('book_cover', 255)->nullable();
            $table->text('description')->nullable();
            $table->enum('status', ['Available', 'Unavailable', 'Archived'])->default('Available');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
