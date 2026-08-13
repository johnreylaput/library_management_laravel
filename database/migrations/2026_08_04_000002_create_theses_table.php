<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('theses', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255);
            $table->text('authors');
            $table->string('thesis_type', 100)->nullable();
            $table->string('institution', 255)->nullable();
            $table->year('year')->nullable();
            $table->string('pages', 50)->nullable();
            $table->foreignId('category_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('author_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('publisher_id')->nullable()->constrained()->nullOnDelete();
            $table->string('link', 500)->nullable();
            $table->text('abstract')->nullable();
            $table->text('description')->nullable();
            $table->enum('status', ['Available', 'Unavailable', 'Archived'])->default('Available');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('theses');
    }
};
