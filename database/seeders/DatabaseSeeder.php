<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            CategorySeeder::class,
            AuthorSeeder::class,
            PublisherSeeder::class,
            BookSeeder::class,
            MemberSeeder::class,
            JournalSeeder::class,
            ThesisSeeder::class,
            IntaoThesisSeeder::class,
        ]);

        User::factory()->create([
            'full_name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}
