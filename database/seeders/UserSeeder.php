<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::firstOrCreate(
            ['username' => 'admin'],
            [
                'full_name' => 'Admin User',
                'email' => 'admin@library.com',
                'password' => Hash::make('admin123'),
                'role' => 'Admin',
                'status' => 'Active',
            ]
        );

        // Librarians
        $librarians = [
            ['full_name' => 'Maria Santos', 'username' => 'maria.librarian', 'email' => 'maria@library.com', 'password' => 'maria123!'],
            ['full_name' => 'Juan Dela Cruz', 'username' => 'juan.librarian', 'email' => 'juan@library.com', 'password' => 'librarian123'],
            ['full_name' => 'Ana Reyes', 'username' => 'ana.librarian', 'email' => 'ana@library.com', 'password' => 'librarian123'],
        ];

        foreach ($librarians as $librarian) {
            User::updateOrCreate(
                ['username' => $librarian['username']],
                [
                    'full_name' => $librarian['full_name'],
                    'email' => $librarian['email'],
                    'password' => Hash::make($librarian['password']),
                    'role' => 'Librarian',
                    'status' => 'Active',
                ]
            );
        }

        // Working-Students
        $workingStudents = [
            ['full_name' => 'Working.Student', 'username' => 'Work.stud', 'email' => 'carlos@library.com', 'password' => 'workingstud!!!'],
        ];

        foreach ($workingStudents as $ws) {
            User::firstOrCreate(
                ['username' => $ws['username']],
                [
                    'full_name' => $ws['full_name'],
                    'email' => $ws['email'],
                    'password' => Hash::make($ws['password']),
                    'role' => 'Working-Student',
                    'status' => 'Active',
                ]
            );
        }

        // Members
        $members = [
            ['full_name' => 'John Smith', 'username' => 'john.smith', 'email' => 'john@example.com'],
            ['full_name' => 'Jane Doe', 'username' => 'jane.doe', 'email' => 'jane@example.com'],
            ['full_name' => 'Bob Johnson', 'username' => 'bob.johnson', 'email' => 'bob@example.com'],
            ['full_name' => 'Alice Brown', 'username' => 'alice.brown', 'email' => 'alice@example.com'],
            ['full_name' => 'Charlie Davis', 'username' => 'charlie.davis', 'email' => 'charlie@example.com'],
            ['full_name' => 'Diana Evans', 'username' => 'diana.evans', 'email' => 'diana@example.com'],
            ['full_name' => 'Evan Foster', 'username' => 'evan.foster', 'email' => 'evan@example.com'],
            ['full_name' => 'Fiona Green', 'username' => 'fiona.green', 'email' => 'fiona@example.com'],
            ['full_name' => 'George Hill', 'username' => 'george.hill', 'email' => 'george@example.com'],
            ['full_name' => 'Hannah Ingram', 'username' => 'hannah.ingram', 'email' => 'hannah@example.com'],
        ];

        foreach ($members as $member) {
            User::firstOrCreate(
                ['username' => $member['username']],
                [
                    'full_name' => $member['full_name'],
                    'email' => $member['email'],
                    'password' => Hash::make('member123'),
                    'role' => 'Member',
                    'status' => 'Active',
                ]
            );
        }
    }
}
