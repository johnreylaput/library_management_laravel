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
                'authors' => 'Ian Goodfellow',
                'thesis_type' => 'PhD',
                'institution' => 'Stanford University',
                'year' => 2015,
                'pages' => '1-180',
                'category' => 'Computer Science',
                'author' => 'Ian Goodfellow',
                'publisher' => 'MIT Press',
                'link' => 'https://scholar.google.com/scholar?q=Machine+Learning+Approaches+for+Predictive+Maintenance+in+Manufacturing',
                'abstract' => 'This thesis presents novel machine learning approaches for predictive maintenance in manufacturing environments.',
                'description' => 'The research develops deep learning models for anomaly detection and failure prediction in industrial equipment.',
                'database_collection' => 'Stanford Digital Repository',
                'availability' => 'Available',
                'subjects' => 'Machine Learning, Predictive Maintenance, Manufacturing',
                'status' => 'Available',
            ],
            [
                'title' => 'Climate Change Impact on Coastal Ecosystems: A Comprehensive Analysis',
                'authors' => 'Rachel Carson',
                'thesis_type' => 'Masters',
                'institution' => 'University of California, Berkeley',
                'year' => 2018,
                'pages' => '1-95',
                'category' => 'Science',
                'author' => 'Rachel Carson',
                'publisher' => 'Oxford University Press',
                'link' => 'https://scholar.google.com/scholar?q=Climate+Change+Impact+on+Coastal+Ecosystems',
                'abstract' => 'An analysis of climate change impacts on coastal ecosystems and biodiversity.',
                'description' => 'This thesis examines sea level rise, ocean acidification, and their effects on marine biodiversity.',
                'database_collection' => 'UC Berkeley eScholarship',
                'availability' => 'Available',
                'subjects' => 'Climate Change, Coastal Ecosystems, Marine Biology',
                'status' => 'Available',
            ],
            [
                'title' => 'Renewable Energy Integration: Challenges and Opportunities in Smart Grids',
                'authors' => 'James Kurose',
                'thesis_type' => 'PhD',
                'institution' => 'MIT',
                'year' => 2016,
                'pages' => '1-210',
                'category' => 'Engineering',
                'author' => 'James Kurose',
                'publisher' => 'MIT Press',
                'link' => 'https://scholar.google.com/scholar?q=Renewable+Energy+Integration+Challenges+and+Opportunities+in+Smart+Grids',
                'abstract' => 'A study on integrating renewable energy sources into smart grid infrastructure.',
                'description' => 'This thesis proposes optimization algorithms for balancing renewable energy supply and demand in smart grids.',
                'database_collection' => 'MIT DSpace',
                'availability' => 'Available',
                'subjects' => 'Renewable Energy, Smart Grids, Engineering',
                'status' => 'Available',
            ],
            [
                'title' => 'The Effects of Mindfulness Meditation on Stress Reduction',
                'authors' => 'Daniel Kahneman',
                'thesis_type' => 'Masters',
                'institution' => 'Harvard University',
                'year' => 2019,
                'pages' => '1-78',
                'category' => 'Psychology',
                'author' => 'Daniel Kahneman',
                'publisher' => 'Harvard University Press',
                'link' => 'https://scholar.google.com/scholar?q=Effects+of+Mindfulness+Meditation+on+Stress+Reduction',
                'abstract' => 'An investigation into the effects of mindfulness meditation on stress reduction and well-being.',
                'description' => 'This thesis presents empirical evidence from a randomized controlled trial on mindfulness interventions.',
                'database_collection' => 'Harvard DASH',
                'availability' => 'Available',
                'subjects' => 'Mindfulness, Stress Reduction, Psychology',
                'status' => 'Available',
            ],
            [
                'title' => 'Blockchain Technology for Secure Supply Chain Management',
                'authors' => 'Stuart Russell',
                'thesis_type' => 'PhD',
                'institution' => 'UC Berkeley',
                'year' => 2020,
                'pages' => '1-245',
                'category' => 'Computer Science',
                'author' => 'Stuart Russell',
                'publisher' => 'University of California Press',
                'link' => 'https://scholar.google.com/scholar?q=Blockchain+Technology+for+Secure+Supply+Chain+Management',
                'abstract' => 'A comprehensive study on applying blockchain technology to secure supply chain management.',
                'description' => 'This thesis develops a blockchain-based framework for transparency and traceability in supply chains.',
                'database_collection' => 'UC Berkeley eScholarship',
                'availability' => 'Available',
                'subjects' => 'Blockchain, Supply Chain, Security',
                'status' => 'Available',
            ],
            [
                'title' => 'Urban Planning Strategies for Sustainable City Development',
                'authors' => 'Yuval Noah Harari',
                'thesis_type' => 'Masters',
                'institution' => 'University of Oxford',
                'year' => 2017,
                'pages' => '1-120',
                'category' => 'History',
                'author' => 'Yuval Noah Harari',
                'publisher' => 'Oxford University Press',
                'link' => 'https://scholar.google.com/scholar?q=Urban+Planning+Strategies+for+Sustainable+City+Development',
                'abstract' => 'An exploration of urban planning strategies that promote sustainable city development.',
                'description' => 'This thesis analyzes successful sustainable urban development projects and proposes frameworks for future cities.',
                'database_collection' => 'Oxford Research Archive',
                'availability' => 'Available',
                'subjects' => 'Urban Planning, Sustainability, Cities',
                'status' => 'Available',
            ],
            [
                'title' => 'Artificial Intelligence in Healthcare: Diagnostic Applications',
                'authors' => 'Abraham Silberschatz',
                'thesis_type' => 'PhD',
                'institution' => 'Carnegie Mellon University',
                'year' => 2018,
                'pages' => '1-195',
                'category' => 'Computer Science',
                'author' => 'Abraham Silberschatz',
                'publisher' => 'MIT Press',
                'link' => 'https://scholar.google.com/scholar?q=Artificial+Intelligence+in+Healthcare+Diagnostic+Applications',
                'abstract' => 'A study on the application of artificial intelligence in healthcare diagnostics.',
                'description' => 'This thesis develops deep learning models for medical image analysis and disease prediction.',
                'database_collection' => 'CMU Digital Library',
                'availability' => 'Available',
                'subjects' => 'Artificial Intelligence, Healthcare, Diagnostics',
                'status' => 'Available',
            ],
            [
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
}
