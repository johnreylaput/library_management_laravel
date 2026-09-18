<?php

namespace Database\Seeders;

use App\Models\Thesis;
use Illuminate\Database\Seeder;

class ThesisSeeder extends Seeder
{
    public function run(): void
    {
        $theses = [
            [
                'author' => 'Ian Goodfellow',
                'research' => 'Doctoral Thesis',
                'date_published' => '2015-06-15',
                'subjects_keywords' => 'Machine Learning, Predictive Maintenance, Manufacturing',
                'summary' => 'This thesis presents novel machine learning approaches for predictive maintenance in manufacturing environments.',
                'availability' => 'Available',
                'status' => 'Available',
            ],
            [
                'author' => 'Rachel Carson',
                'research' => 'Masteral Thesis',
                'date_published' => '2018-08-20',
                'subjects_keywords' => 'Climate Change, Coastal Ecosystems, Marine Biology',
                'summary' => 'An analysis of climate change impacts on coastal ecosystems and biodiversity.',
                'availability' => 'Available',
                'status' => 'Available',
            ],
            [
                'author' => 'James Kurose',
                'research' => 'Doctoral Thesis',
                'date_published' => '2016-07-10',
                'subjects_keywords' => 'Renewable Energy, Smart Grids, Engineering',
                'summary' => 'A study on integrating renewable energy sources into smart grid infrastructure.',
                'availability' => 'Available',
                'status' => 'Available',
            ],
            [
                'author' => 'Daniel Kahneman',
                'research' => 'Masteral Thesis',
                'date_published' => '2019-05-12',
                'subjects_keywords' => 'Mindfulness, Stress Reduction, Psychology',
                'summary' => 'An investigation into the effects of mindfulness meditation on stress reduction and well-being.',
                'availability' => 'Available',
                'status' => 'Available',
            ],
            [
                'author' => 'Stuart Russell',
                'research' => 'Doctoral Thesis',
                'date_published' => '2020-03-25',
                'subjects_keywords' => 'Blockchain, Supply Chain, Security',
                'summary' => 'A comprehensive study on applying blockchain technology to secure supply chain management.',
                'availability' => 'Available',
                'status' => 'Available',
            ],
            [
                'author' => 'Yuval Noah Harari',
                'research' => 'Masteral Thesis',
                'date_published' => '2017-09-18',
                'subjects_keywords' => 'Urban Planning, Sustainability, Cities',
                'summary' => 'An exploration of urban planning strategies that promote sustainable city development.',
                'availability' => 'Available',
                'status' => 'Available',
            ],
            [
                'author' => 'Abraham Silberschatz',
                'research' => 'Doctoral Thesis',
                'date_published' => '2018-11-30',
                'subjects_keywords' => 'Artificial Intelligence, Healthcare, Diagnostics',
                'summary' => 'A study on the application of artificial intelligence in healthcare diagnostics.',
                'availability' => 'Available',
                'status' => 'Available',
            ],
            [
                'author' => 'Mary Jane A. Intao',
                'research' => 'Masteral Thesis',
                'date_published' => '2025-01-15',
                'subjects_keywords' => 'Self-Efficacy, Work Satisfaction, Non-Teaching Personnel',
                'summary' => 'This study aimed to determine the level of self-efficacy and the work satisfaction of Non-Teaching personnel of St. Vincent College all located in Panay, Philippines for the academic year 2024-2025.',
                'availability' => 'Available',
                'status' => 'Available',
            ],
        ];

        foreach ($theses as $thesisData) {
            Thesis::updateOrCreate(
                [
                    'author' => $thesisData['author'],
                    'research' => $thesisData['research'],
                ],
                $thesisData
            );
        }
    }
}
