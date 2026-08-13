<?php

namespace Database\Seeders;

use App\Models\Member;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MemberSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::whereIn('role', ['Member'])->get();

        $courses = ['Computer Science', 'Information Technology', 'Engineering', 'Business Administration', 'Psychology', 'Biology', 'Physics', 'Mathematics', 'Literature', 'History'];
        $yearLevels = ['1st Year', '2nd Year', '3rd Year', '4th Year', 'Graduate'];
        $contactNumbers = ['09123456789', '09234567890', '09345678901', '09456789012', '09567890123', '09678901234', '09789012345', '09890123456', '09901234567', '09012345678'];
        $addresses = [
            '123 Main St, Quezon City',
            '456 Oak Ave, Manila',
            '789 Pine Rd, Makati',
            '321 Elm St, Pasig',
            '654 Maple Dr, Taguig',
            '987 Cedar Ln, Mandaluyong',
            '147 Birch Blvd, San Juan',
            '258 Walnut Way, Marikina',
            '369 Cherry Ct, Las Piñas',
            '741 Spruce St, Muntinlupa',
        ];

        foreach ($users as $index => $user) {
            Member::firstOrCreate(
                ['user_id' => $user->id],
                [
                    'member_no' => 'MEM-' . str_pad($index + 1, 5, '0', STR_PAD_LEFT),
                    'course' => $courses[array_rand($courses)],
                    'year_level' => $yearLevels[array_rand($yearLevels)],
                    'contact_number' => $contactNumbers[array_rand($contactNumbers)],
                    'address' => $addresses[array_rand($addresses)],
                ]
            );
        }
    }
}
