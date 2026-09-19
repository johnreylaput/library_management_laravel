<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Thesis;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ThesisSearchTest extends TestCase
{
    use RefreshDatabase;

    private function adminUser(): User
    {
        $user = User::factory()->create([
            'role' => 'Admin',
            'status' => 'Active',
        ]);

        $this->actingAs($user);

        return $user;
    }

    private function createTestTheses(): void
    {
        Thesis::create([
            'author' => 'John Smith',
            'research' => 'Thesis',
            'date_published' => '2024-05-15',
            'subjects_keywords' => 'Computer Science, Artificial Intelligence',
            'summary' => 'This is a study on computer vision and machine learning.',
            'status' => 'Available',
        ]);

        Thesis::create([
            'author' => 'Jane Doe',
            'research' => 'Capstone',
            'date_published' => '2024-03-20',
            'subjects_keywords' => 'Web Development, Database Design',
            'summary' => 'A capstone project on full-stack web development.',
            'status' => 'Available',
        ]);

        Thesis::create([
            'author' => 'Bob Wilson',
            'research' => 'Feasibility Study',
            'date_published' => '2023-11-10',
            'subjects_keywords' => 'Mobile App, UI/UX Design',
            'summary' => 'Research on mobile application feasibility.',
            'status' => 'Available',
        ]);
    }

    public function test_thesis_search_by_author_returns_results(): void
    {
        $this->adminUser();
        $this->createTestTheses();

        $response = $this->get('/e-periodical-index?type=theses&q=Smith');

        $response->assertStatus(200);
        $response->assertSee('John Smith');
        $response->assertDontSee('Jane Doe');
        $response->assertDontSee('Bob Wilson');
    }

    public function test_thesis_search_by_research_returns_results(): void
    {
        $this->adminUser();
        $this->createTestTheses();

        $response = $this->get('/e-periodical-index?type=theses&q=Capstone');

        $response->assertStatus(200);
        $response->assertSee('Jane Doe');
    }

    public function test_thesis_search_by_subjects_keywords_returns_results(): void
    {
        $this->adminUser();
        $this->createTestTheses();

        $response = $this->get('/e-periodical-index?type=theses&q=Mobile');

        $response->assertStatus(200);
        $response->assertSee('Bob Wilson');
    }

    public function test_thesis_search_by_summary_returns_results(): void
    {
        $this->adminUser();
        $this->createTestTheses();

        $response = $this->get('/e-periodical-index?type=theses&q=computer');

        $response->assertStatus(200);
        $response->assertSee('John Smith');
    }

    public function test_thesis_search_partial_keyword_returns_results(): void
    {
        $this->adminUser();
        $this->createTestTheses();

        $response = $this->get('/e-periodical-index?type=theses&q=web');

        $response->assertStatus(200);
        $response->assertSee('Jane Doe');
    }

    public function test_thesis_search_case_insensitive_returns_results(): void
    {
        $this->adminUser();
        $this->createTestTheses();

        $response = $this->get('/e-periodical-index?type=theses&q=SMITH');

        $response->assertStatus(200);
        $response->assertSee('John Smith');
    }

    public function test_thesis_search_empty_query_does_not_error(): void
    {
        $this->adminUser();
        $this->createTestTheses();

        $response = $this->get('/e-periodical-index?type=theses&q=');

        $response->assertStatus(200);
    }

    public function test_thesis_search_nonexistent_keyword_shows_no_results(): void
    {
        $this->adminUser();
        $this->createTestTheses();

        $response = $this->get('/e-periodical-index?type=theses&q=nonexistentkeyword');

        $response->assertStatus(200);
        $response->assertSee('No theses found.');
    }

    public function test_thesis_search_all_types_includes_theses(): void
    {
        $this->adminUser();
        $this->createTestTheses();

        $response = $this->get('/e-periodical-index?type=all&q=Smith');

        $response->assertStatus(200);
        $response->assertSee('John Smith');
    }
}
