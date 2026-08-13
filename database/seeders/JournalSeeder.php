<?php

namespace Database\Seeders;

use App\Models\Journal;
use App\Models\Category;
use App\Models\Publisher;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JournalSeeder extends Seeder
{
    public function run(): void
    {
        $categories = Category::all()->keyBy('category_name');
        $publishers = Publisher::all()->keyBy('publisher_name');

        $journals = [
            [
                'journal_name' => 'Nature',
                'title' => 'CRISPR-Cas9 Gene Editing: A Comprehensive Review',
                'authors' => 'Jennifer Doudna, Emmanuelle Charpentier',
                'volume' => '578',
                'issue' => '7795',
                'pages' => '1-10',
                'publication_date' => '2020-02-13',
                'doi' => '10.1038/s41586-020-1932-1',
                'issn' => '0028-0836',
                'link' => 'https://www.nature.com/articles/s41586-020-1932-1',
                'category' => 'Computer Science',
                'publisher' => 'MIT Press',
                'abstract' => 'A comprehensive review of the CRISPR-Cas9 gene editing technology and its applications in modern biology.',
                'description' => 'This journal article provides an in-depth analysis of CRISPR-Cas9, discussing its mechanism, applications, and ethical considerations.',
                'database_collection' => 'Nature Research Journals',
                'availability' => 'Available',
                'subjects' => 'Gene Editing, Biotechnology, Genetics',
                'status' => 'Available',
            ],
            [
                'journal_name' => 'The Lancet',
                'title' => 'Global Health Challenges in the 21st Century',
                'authors' => 'Margaret Chan, Tedros Adhanom',
                'volume' => '395',
                'issue' => '10223',
                'pages' => '112-119',
                'publication_date' => '2020-01-18',
                'doi' => '10.1016/S0140-6736(19)32378-1',
                'issn' => '0140-6736',
                'link' => 'https://www.thelancet.com/journals/lancet/article/PIIS0140-6736(19)32378-1/fulltext',
                'category' => 'Medicine',
                'publisher' => 'HarperCollins',
                'abstract' => 'An overview of the major global health challenges facing humanity in the 21st century.',
                'description' => 'This article examines emerging infectious diseases, climate change impacts, and healthcare disparities worldwide.',
                'database_collection' => 'The Lancet Collection',
                'availability' => 'Available',
                'subjects' => 'Global Health, Public Health, Epidemiology',
                'status' => 'Available',
            ],
            [
                'journal_name' => 'Journal of Machine Learning Research',
                'title' => 'Deep Learning Approaches for Natural Language Processing',
                'authors' => 'Yoshua Bengio, Ian Goodfellow, Aaron Courville',
                'volume' => '21',
                'issue' => '3',
                'pages' => '1-37',
                'publication_date' => '2020-03-15',
                'doi' => '10.5555/3455716.3455721',
                'issn' => '1532-4435',
                'link' => 'https://jmlr.org/papers/v21/20-302.html',
                'category' => 'Computer Science',
                'publisher' => 'MIT Press',
                'abstract' => 'A survey of deep learning techniques applied to natural language processing tasks.',
                'description' => 'This paper reviews state-of-the-art deep learning models for NLP, including transformers, BERT, and GPT architectures.',
                'database_collection' => 'JMLR Archives',
                'availability' => 'Available',
                'subjects' => 'Deep Learning, NLP, Machine Learning',
                'status' => 'Available',
            ],
            [
                'journal_name' => 'Physical Review Letters',
                'title' => 'Quantum Computing: Recent Advances and Future Directions',
                'authors' => 'John Preskill, Scott Aaronson',
                'volume' => '123',
                'issue' => '14',
                'pages' => '140501-140508',
                'publication_date' => '2019-10-04',
                'doi' => '10.1103/PhysRevLett.123.140501',
                'issn' => '0031-9007',
                'link' => 'https://journals.aps.org/prl/abstract/10.1103/PhysRevLett.123.140501',
                'category' => 'Science',
                'publisher' => 'Harvard University Press',
                'abstract' => 'A review of recent advances in quantum computing and discussion of future research directions.',
                'description' => 'This article covers quantum error correction, quantum supremacy experiments, and potential applications of quantum computers.',
                'database_collection' => 'APS Physics Journals',
                'availability' => 'Available',
                'subjects' => 'Quantum Computing, Physics, Computer Science',
                'status' => 'Available',
            ],
            [
                'journal_name' => 'American Economic Review',
                'title' => 'Inequality in the Modern Economy: Causes and Policy Responses',
                'authors' => 'Thomas Piketty, Emmanuel Saez',
                'volume' => '109',
                'issue' => '9',
                'pages' => '2875-2920',
                'publication_date' => '2019-11-01',
                'doi' => '10.1257/aer.20190123',
                'issn' => '0002-8282',
                'link' => 'https://www.aeaweb.org/articles?id=10.1257/aer.20190123',
                'category' => 'Economics',
                'publisher' => 'W.W. Norton',
                'abstract' => 'An analysis of economic inequality trends and evaluation of policy interventions.',
                'description' => 'This paper examines the rise in income and wealth inequality and assesses various policy responses including taxation and social programs.',
                'database_collection' => 'American Economic Association Journals',
                'availability' => 'Available',
                'subjects' => 'Economics, Inequality, Policy',
                'status' => 'Available',
            ],
            [
                'journal_name' => 'Journal of Environmental Psychology',
                'title' => 'Climate Change Anxiety and Mental Health: A Global Perspective',
                'authors' => 'Susan Clayton, Ashlee Cunsolo',
                'volume' => '72',
                'issue' => '1',
                'pages' => '1-12',
                'publication_date' => '2020-06-01',
                'doi' => '10.1016/j.jenvp.2020.101502',
                'issn' => '0272-4944',
                'link' => 'https://www.sciencedirect.com/science/article/pii/S0272494420302142',
                'category' => 'Psychology',
                'publisher' => 'Wiley',
                'abstract' => 'An exploration of the psychological impacts of climate change on mental health worldwide.',
                'description' => 'This study investigates eco-anxiety, climate grief, and other psychological responses to environmental crises.',
                'database_collection' => 'ScienceDirect Psychology Collection',
                'availability' => 'Available',
                'subjects' => 'Climate Change, Mental Health, Psychology',
                'status' => 'Available',
            ],
            [
                'journal_name' => 'Review of Educational Research',
                'title' => 'Online Learning Effectiveness: A Meta-Analysis',
                'authors' => 'Barbara Means, Ya-Ling Chen',
                'volume' => '90',
                'issue' => '2',
                'pages' => '143-182',
                'publication_date' => '2020-04-01',
                'doi' => '10.3102/0034654320916423',
                'issn' => '0034-6543',
                'link' => 'https://journals.sagepub.com/doi/abs/10.3102/0034654320916423',
                'category' => 'Education',
                'publisher' => 'Cambridge University Press',
                'abstract' => 'A meta-analysis examining the effectiveness of online learning compared to traditional face-to-face instruction.',
                'description' => 'This comprehensive meta-analysis synthesizes findings from over 100 studies on online learning outcomes.',
                'database_collection' => 'SAGE Education Journals',
                'availability' => 'Available',
                'subjects' => 'Online Learning, Education, Meta-Analysis',
                'status' => 'Available',
            ],
        ];

        foreach ($journals as $journalData) {
            $category = $categories->get($journalData['category']);
            $publisher = $publishers->get($journalData['publisher']);

            if ($category && $publisher) {
                Journal::firstOrCreate(
                    [
                        'journal_name' => $journalData['journal_name'],
                        'title' => $journalData['title'],
                    ],
                    [
                        'authors' => $journalData['authors'],
                        'volume' => $journalData['volume'],
                        'issue' => $journalData['issue'],
                        'pages' => $journalData['pages'],
                        'publication_date' => $journalData['publication_date'],
                        'doi' => $journalData['doi'],
                        'issn' => $journalData['issn'],
                        'link' => $journalData['link'],
                        'category_id' => $category->id,
                        'publisher_id' => $publisher->id,
                        'abstract' => $journalData['abstract'],
                        'description' => $journalData['description'],
                        'database_collection' => $journalData['database_collection'],
                        'availability' => $journalData['availability'],
                        'subjects' => $journalData['subjects'],
                        'status' => $journalData['status'],
                    ]
                );
            }
        }
    }
}
