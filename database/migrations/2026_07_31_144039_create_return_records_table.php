<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('return_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('borrow_id')->unique()->constrained('borrow_records')->cascadeOnDelete();
            $table->foreignId('returned_by')->nullable()->constrained('users')->nullOnDelete();
            $table->date('return_date')->nullable();
            $table->enum('condition_status', ['Good', 'Damaged', 'Lost'])->default('Good');
            $table->text('remarks')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('return_records');
    }
};
