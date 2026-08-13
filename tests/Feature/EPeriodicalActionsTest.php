<?php

namespace Tests\Feature;

use App\Models\Journal;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EPeriodicalActionsTest extends TestCase
{
    use RefreshDatabase;

    public function test_edit_and_delete_views_load_journal_entries(): void
    {
        $user = User::factory()->create([
            'role' => 'Admin',
        ]);

        Journal::create([
            'journal_name' => 'Journal of Testing',
            'title' => 'Feature Test Journal',
            'authors' => 'Jane Doe',
            'source' => 'Journal of Testing',
            'abstract' => 'Sample abstract.',
            'subjects' => 'Education',
            'status' => 'Available',
        ]);

        $this->actingAs($user);

        $editResponse = $this->get('/e-periodical-index?view=edit-journal');
        $editResponse->assertStatus(200)
            ->assertSee('Select a Journal Article to Edit')
            ->assertSee('Feature Test Journal')
            ->assertSee('Edit');

        $deleteResponse = $this->get('/e-periodical-index?view=delete-journal');
        $deleteResponse->assertStatus(200)
            ->assertSee('Select a Journal Article to Delete')
            ->assertSee('Feature Test Journal')
            ->assertSee('Delete');
    }

    public function test_librarian_and_working_student_can_add_journal_to_database(): void
    {
        $librarian = User::factory()->create(['role' => 'Librarian']);
        $workingStudent = User::factory()->create(['role' => 'Working-Student']);

        $this->actingAs($librarian)
            ->post('/journals', [
                'journal_name' => 'Journal of Applied Research',
                'title' => 'Research Workflow Journal',
                'authors' => 'Jane Smith',
                'abstract' => 'This is a test abstract.',
                'subjects' => 'Research',
                'keyword' => 'workflow, research',
                'status' => 'Available',
            ])
            ->assertRedirect('/e-periodical-index');

        $this->assertDatabaseHas('journals', [
            'title' => 'Research Workflow Journal',
            'journal_name' => 'Journal of Applied Research',
        ]);

        $this->actingAs($workingStudent)
            ->post('/journals', [
                'journal_name' => 'Journal of Student Learning',
                'title' => 'Student Learning Journal',
                'authors' => 'John Cruz',
                'abstract' => 'Learning journal abstract.',
                'subjects' => 'Education',
                'keyword' => 'students, education',
                'status' => 'Available',
            ])
            ->assertRedirect('/e-periodical-index');

        $this->assertDatabaseHas('journals', [
            'title' => 'Student Learning Journal',
            'journal_name' => 'Journal of Student Learning',
        ]);
    }
}
