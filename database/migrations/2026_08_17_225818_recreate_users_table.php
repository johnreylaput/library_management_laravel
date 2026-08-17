<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('users')) {
            Schema::create('users', function (Blueprint $table) {
                $table->id();
                $table->string('full_name', 150);
                $table->string('username', 50)->unique();
                $table->string('email', 100)->unique();
                $table->string('password', 255);
                $table->enum('role', ['Admin', 'Librarian', 'Member']);
                $table->enum('status', ['Active', 'Inactive'])->default('Active');
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        // Intentionally left empty to avoid accidentally deleting users.
    }
};