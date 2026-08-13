<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Fiction',
            'Science Fiction',
            'Fantasy',
            'Mystery',
            'Thriller',
            'Romance',
            'Horror',
            'History',
            'Biography',
            'Self-Help',
            'Science',
            'Technology',
            'Engineering',
            'Mathematics',
            'Philosophy',
            'Psychology',
            'Sociology',
            'Economics',
            'Political Science',
            'Education',
            'Medicine',
            'Computer Science',
            'Art',
            'Music',
            'Poetry',
            'Drama',
            'Comics',
            'Travel',
            'Cooking',
            'Sports',
        ];

        foreach ($categories as $category) {
            Category::firstOrCreate(
                ['category_name' => $category]
            );
        }
    }
}
