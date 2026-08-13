<?php

namespace Database\Seeders;

use App\Models\Thesis;
use App\Models\Category;
use App\Models\Author;
use App\Models\Publisher;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IntaoThesisSeeder extends Seeder
{
    public function run(): void
    {
        $categories = Category::all()->keyBy('category_name');
        $authors = Author::all()->keyBy('author_name');
        $publishers = Publisher::all()->keyBy('publisher_name');

        $thesisData = [
            'title' => 'Self-Efficacy and Work Satisfaction of Non-Teaching Personnel',
            'authors' => 'Mary Jane A. Intao',
            'thesis_type' => 'Masters',
            'institution' => 'Guimaras State University',
            'year' => 2025,
            'pages' => '1-502',
            'category' => 'Psychology',
            'author' => 'Mary Jane A. Intao',
            'publisher' => 'Cambridge University Press',
                    'link' => 'https://scholar.google.com/scholar?q=Self-Efficacy+and+Work+Satisfaction+of+Non-Teaching+Personnel+Mary+Jane+A.+Intao',
            'abstract' => 'This study aimed to determine the level of self-efficacy and the work satisfaction of Non-Teaching personnel of St. Vincent College all located in Panay, Philippines for the academic year 2024-2025.',
            'description' => 'The study utilized a descriptive research design to investigate the level of self-efficacy and work satisfaction among 42 non-teaching personnel from three campuses of St. Vincent College in Panay Island, Philippines.',
            'database_collection' => 'Guimaras State University Repository',
            'availability' => 'Available',
            'subjects' => 'Self-Efficacy, Work Satisfaction, Non-Teaching Personnel',
            'status' => 'Available',
        ];

        $category = $categories->get($thesisData['category']);
        $author = $authors->get($thesisData['author']);
        $publisher = $publishers->get($thesisData['publisher']);

        if ($category && $author && $publisher) {
            Thesis::updateOrCreate(
                [
                    'title' => $thesisData['title'],
                    'institution' => $thesisData['institution'],
                ],
                [
                    'authors' => $thesisData['authors'],
                    'thesis_type' => $thesisData['thesis_type'],
                    'year' => $thesisData['year'],
                    'pages' => $thesisData['pages'],
                    'category_id' => $category->id,
                    'author_id' => $author->id,
                    'publisher_id' => $publisher->id,
                    'link' => $thesisData['link'],
                    'abstract' => $thesisData['abstract'],
                    'description' => $thesisData['description'],
                    'database_collection' => $thesisData['database_collection'],
                    'availability' => $thesisData['availability'],
                    'subjects' => $thesisData['subjects'],
                    'status' => $thesisData['status'],
                ]
            );
        }
    }
}
