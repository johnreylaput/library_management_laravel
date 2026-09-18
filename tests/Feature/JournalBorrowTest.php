<?php

namespace Tests\Feature;

use App\Models\BorrowRecord;
use App\Models\Journal;
use App\Models\Member;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Tests\TestCase;

class JournalBorrowTest extends TestCase
{
    use RefreshDatabase;

    private function memberUser(): User
    {
        $user = User::factory()->create([
            'role' => 'Member',
            'status' => 'Active',
        ]);

        Member::create([
            'user_id' => $user->id,
            'member_no' => 'MEM-' . str_pad($user->id, 6, '0', STR_PAD_LEFT),
        ]);

        return $user;
    }

    public function test_periodical_detail_shows_an_enabled_borrow_button_for_available_journal(): void
    {
        $user = $this->memberUser();
        $journal = Journal::create([
            'journal_name' => 'Nature',
            'title' => 'CRISPR Review',
            'authors' => 'Jennifer Doudna',
            'availability' => 'Available',
            'status' => 'Available',
        ]);

        $this->actingAs($user);

        $response = $this->get(route('member.journals.show', $journal));

        $response->assertStatus(200);
        $response->assertSee('name="journal_id" value="' . $journal->id . '"', false);
        $response->assertSee('Request to borrow', false);
        $this->assertStringNotContainsString('disabled', $response->getContent());
    }

    public function test_member_can_borrow_a_journal_through_periodical_borrow_button(): void
    {
        $user = $this->memberUser();
        $journal = Journal::create([
            'journal_name' => 'Nature',
            'title' => 'CRISPR Review',
            'authors' => 'Jennifer Doudna',
            'availability' => 'Available',
            'status' => 'Available',
        ]);

        $this->actingAs($user);

        $response = $this->post(route('member.borrow.store'), [
            'journal_id' => $journal->id,
            'borrow_date' => Carbon::now()->toDateString(),
            'due_date' => Carbon::now()->addDays(3)->toDateString(),
        ]);

        $response->assertRedirect(route('member.borrow.index'));
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('borrow_records', [
            'member_id' => $user->member->id,
            'journal_id' => $journal->id,
            'borrowed_by' => $user->id,
            'status' => 'Pending',
        ]);

        $this->assertCount(1, BorrowRecord::all());
    }

    public function test_borrow_button_is_disabled_when_journal_is_not_available(): void
    {
        $user = $this->memberUser();
        $journal = Journal::create([
            'journal_name' => 'Nature',
            'title' => 'CRISPR Review',
            'authors' => 'Jennifer Doudna',
            'availability' => 'Unavailable',
            'status' => 'Available',
        ]);

        $this->actingAs($user);

        $response = $this->get(route('member.journals.show', $journal));

        $response->assertStatus(200);
        $this->assertStringContainsString('disabled', $response->getContent());
    }

    public function test_periodical_added_through_form_is_borrowable_by_default(): void
    {
        $admin = User::factory()->create([
            'role' => 'Admin',
            'status' => 'Active',
        ]);
        $this->actingAs($admin);

        $response = $this->post(route('journals.store'), [
            'journal_name' => 'Nature',
            'journal_name_source' => '',
            'title' => 'Form-Added Article',
            'authors' => 'Someone',
            'availability' => '',
        ]);

        $response->assertRedirect(route('e-periodical.index', ['view' => 'all-journals']));

        $journal = Journal::where('title', 'Form-Added Article')->firstOrFail();
        $this->assertSame('Available', $journal->availability);
    }
}
