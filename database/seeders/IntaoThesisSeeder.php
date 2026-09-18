<?php

namespace Database\Seeders;

use App\Models\Thesis;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IntaoThesisSeeder extends Seeder
{
    public function run(): void
    {
        $thesisData = [
            'author' => 'Mary Jane A. Intao',
            'research' => 'Masteral Thesis',
            'date_published' => '2025-01-15',
            'subjects_keywords' => 'Self-Efficacy, Work Satisfaction, Non-Teaching Personnel',
            'summary' => 'This study aimed to determine the level of self-efficacy and the work satisfaction of Non-Teaching personnel of St. Vincent College all located in Panay, Philippines for the academic year 2024-2025.',
            'availability' => 'Available',
            'status' => 'Available',
        ];

        Thesis::updateOrCreate(
            [
                'author' => $thesisData['author'],
                'research' => $thesisData['research'],
            ],
            $thesisData
        );
    }
}
