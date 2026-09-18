<?php

namespace Database\Seeders;

use App\Models\Thesis;
use App\Models\Category;
use App\Models\Author;
use App\Models\Publisher;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ThesisSeeder extends Seeder
{
    public function run(): void
    {
        $categories = Category::all()->keyBy('category_name');
        $authors = Author::all()->keyBy('author_name');
        $publishers = Publisher::all()->keyBy('publisher_name');

        $theses = [
            [
                'title' => 'Machine Learning Approaches for Predictive Maintenance in Manufacturing',
                'author' => 'Ian Goodfellow',
                'research' => 'Doctoral Thesis',
                'institution' => 'Stanford University',
                'date_published' => '2015-06-15',
                'pages' => '1-180',
                'category' => 'Computer Science',
                'publisher' => 'MIT Press',
                'link' => 'https://scholar.google.com/scholar?q=Machine+Learning+Approaches+for+Predictive+Maintenance+in+Manufacturing',
                'summary' => 'This thesis presents novel machine learning approaches for predictive maintenance in manufacturing environments.',
                'description' => 'The research develops deep learning models for anomaly detection and failure prediction in industrial equipment.',
                'database_collection' => 'Stanford Digital Repository',
                'availability' => 'Available',
                'subjects_keywords' => 'Machine Learning, Predictive Maintenance, Manufacturing',
                'status' => 'Available',
            ],
            [
                'title' => 'Climate Change Impact on Coastal Ecosystems: A Comprehensive Analysis',
                'author' => 'Rachel Carson',
                'research' => 'Masteral Thesis',
                'institution' => 'University of California, Berkeley',
                'date_published' => '2018-08-20',
                'pages' => '1-95',
                'category' => 'Science',
                'publisher' => 'Oxford University Press',
                'link' => 'https://scholar.google.com/scholar?q=Climate+Change+Impact+on+Coastal+Ecosystems',
                'summary' => 'An analysis of climate change impacts on coastal ecosystems and biodiversity.',
                'description' => 'This thesis examines sea level rise, ocean acidification, and their effects on marine biodiversity.',
                'database_collection' => 'UC Berkeley eScholarship',
                'availability' => 'Available',
                'subjects_keywords' => 'Climate Change, Coastal Ecosystems, Marine Biology',
                'status' => 'Available',
            ],
            [
                'title' => 'Renewable Energy Integration: Challenges and Opportunities in Smart Grids',
                'author' => 'James Kurose',
                'research' => 'Doctoral Thesis',
                'institution' => 'MIT',
                'date_published' => '2016-07-10',
                'pages' => '1-210',
                'category' => 'Engineering',
                'publisher' => 'MIT Press',
                'link' => 'https://scholar.google.com/scholar?q=Renewable+Energy+Integration+Challenges+and+Opportunities+in+Smart+Grids',
                'summary' => 'A study on integrating renewable energy sources into smart grid infrastructure.',
                'description' => 'This thesis proposes optimization algorithms for balancing renewable energy supply and demand in smart grids.',
                'database_collection' => 'MIT DSpace',
                'availability' => 'Available',
                'subjects_keywords' => 'Renewable Energy, Smart Grids, Engineering',
                'status' => 'Available',
            ],
            [
                'title' => 'The Effects of Mindfulness Meditation on Stress Reduction',
                'author' => 'Daniel Kahneman',
                'research' => 'Masteral Thesis',
                'institution' => 'Harvard University',
                'date_published' => '2019-05-12',
                'pages' => '1-78',
                'category' => 'Psychology',
                'publisher' => 'Harvard University Press',
                'link' => 'https://scholar.google.com/scholar?q=Effects+of+Mindfulness+Meditation+on+Stress+Reduction',
                'summary' => 'An investigation into the effects of mindfulness meditation on stress reduction and well-being.',
                'description' => 'This thesis presents empirical evidence from a randomized controlled trial on mindfulness interventions.',
                'database_collection' => 'Harvard DASH',
                'availability' => 'Available',
                'subjects_keywords' => 'Mindfulness, Stress Reduction, Psychology',
                'status' => 'Available',
            ],
            [
                'title' => 'Blockchain Technology for Secure Supply Chain Management',
                'author' => 'Stuart Russell',
                'research' => 'Doctoral Thesis',
                'institution' => 'UC Berkeley',
                'date_published' => '2020-03-25',
                'pages' => '1-245',
                'category' => 'Computer Science',
                'publisher' => 'University of California Press',
                'link' => 'https://scholar.google.com/scholar?q=Blockchain+Technology+for+Secure+Supply+Chain+Management',
                'summary' => 'A comprehensive study on applying blockchain technology to secure supply chain management.',
                'description' => 'This thesis develops a blockchain-based framework for transparency and traceability in supply chains.',
                'database_collection' => 'UC Berkeley eScholarship',
                'availability' => 'Available',
                'subjects_keywords' => 'Blockchain, Supply Chain, Security',
                'status' => 'Available',
            ],
            [
                'title' => 'Urban Planning Strategies for Sustainable City Development',
                'author' => 'Yuval Noah Harari',
                'research' => 'Masteral Thesis',
                'institution' => 'University of Oxford',
                'date_published' => '2017-09-18',
                'pages' => '1-120',
                'category' => 'History',
                'publisher' => 'Oxford University Press',
                'link' => 'https://scholar.google.com/scholar?q=Urban+Planning+Strategies+for+Sustainable+City+Development',
                'summary' => 'An exploration of urban planning strategies that promote sustainable city development.',
                'description' => 'This thesis analyzes successful sustainable urban development projects and proposes frameworks for future cities.',
                'database_collection' => 'Oxford Research Archive',
                'availability' => 'Available',
                'subjects_keywords' => 'Urban Planning, Sustainability, Cities',
                'status' => 'Available',
            ],
            [
                'title' => 'Artificial Intelligence in Healthcare: Diagnostic Applications',
                'author' => 'Abraham Silberschatz',
                'research' => 'Doctoral Thesis',
                'institution' => 'Carnegie Mellon University',
                'date_published' => '2018-11-30',
                'pages' => '1-195',
                'category' => 'Computer Science',
                'publisher' => 'MIT Press',
                'link' => 'https://scholar.google.com/scholar?q=Artificial+Intelligence+in+Healthcare+Diagnostic+Applications',
                'summary' => 'A study on the application of artificial intelligence in healthcare diagnostics.',
                'description' => 'This thesis develops deep learning models for medical image analysis and disease prediction.',
                'database_collection' => 'CMU Digital Library',
                'availability' => 'Available',
                'subjects_keywords' => 'Artificial Intelligence, Healthcare, Diagnostics',
                'status' => 'Available',
            ],
            [
                'title' => 'Self-Efficacy and Work Satisfaction of Non-Teaching Personnel',
                'author' => 'Mary Jane A. Intao',
                'research' => 'Masteral Thesis',
                'institution' => 'Guimaras State University',
                'date_published' => '2025-01-15',
                'pages' => '1-502',
                'category' => 'Psychology',
                'publisher' => 'Cambridge University Press',
                'link' => 'https://scholar.google.com/scholar?q=Self-Efficacy+and+Work+Satisfaction+of+Non-Teaching+Personnel+Mary+Jane+A.+Intao',
                'summary' => 'This study aimed to determine the level of self-efficacy and the work satisfaction of Non-Teaching personnel of St. Vincent College all located in Panay, Philippines for the academic year 2024-2025.',
                'description' => 'The study utilized a descriptive research design to investigate the level of self-efficacy and work satisfaction among 42 non-teaching personnel from three campuses of St. Vincent College in Panay Island, Philippines.',
                'database_collection' => 'Guimaras State University Repository',
                'availability' => 'Available',
                'subjects_keywords' => 'Self-Efficacy, Work Satisfaction, Non-Teaching Personnel',
                'status' => 'Available',
            ],
        ];

        foreach ($theses as $thesisData) {
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
                        'author' => $thesisData['author'],
                        'research' => $thesisData['research'],
                        'date_published' => $thesisData['date_published'],
                        'pages' => $thesisData['pages'],
                        'category_id' => $category->id,
                        'author_id' => $author->id,
                        'publisher_id' => $publisher->id,
                        'link' => $thesisData['link'],
                        'summary' => $thesisData['summary'],
                        'description' => $thesisData['description'],
                        'database_collection' => $thesisData['database_collection'],
                        'availability' => $thesisData['availability'],
                        'subjects_keywords' => $thesisData['subjects_keywords'],
                        'status' => $thesisData['status'],
                    ]
                );
            }
        }
    }
}
