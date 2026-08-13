<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

return new class extends Migration
{
    public function up(): void
    {
        $user = DB::table('users')->where('username', 'Work.stud')->first();
        if ($user && $user->password !== null && !str_starts_with($user->password, '$2y$')) {
            DB::table('users')
                ->where('username', 'Work.stud')
                ->update(['password' => Hash::make('workingstud!!!')]);
        }
    }

    public function down(): void
    {
    }
};
