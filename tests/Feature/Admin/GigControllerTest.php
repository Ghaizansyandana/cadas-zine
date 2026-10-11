<?php

namespace Tests\Feature\Admin;

use App\Models\Gig;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class GigControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_contributor_gig_submission_is_saved_for_approval(): void
    {
        Storage::fake('public');
        $contributor = $this->createUser('contributor');

        $this->actingAs($contributor)
            ->post(route('admin.gigs.store'), [
                'event_name' => 'Underground show',
                'event_date' => '2026-11-01',
                'city' => 'Bandung',
                'venue' => 'Test venue',
                'ticket_price' => 'Rp 50.000',
                'flyer' => UploadedFile::fake()->image('flyer.jpg'),
            ])
            ->assertRedirect(route('admin.dashboard'));

        $gig = Gig::where('title', 'Underground show')->firstOrFail();

        $this->assertSame('Bandung', $gig->city);
        $this->assertSame('Test venue', $gig->venue);
        $this->assertSame('Rp 50.000', $gig->ticket_price);
        $this->assertFalse($gig->is_approved);
        $this->assertNotEmpty($gig->poster_image);
        Storage::disk('public')->assertExists($gig->poster_image);
    }

    public function test_super_admin_gig_submission_is_published(): void
    {
        Storage::fake('public');
        $superAdmin = $this->createUser('super-admin');

        $this->actingAs($superAdmin)
            ->post(route('admin.gigs.store'), [
                'event_name' => 'Approved show',
                'event_date' => '2026-11-02',
                'city' => 'Jakarta',
                'venue' => 'Test venue',
                'flyer' => UploadedFile::fake()->image('flyer.jpg'),
            ])
            ->assertRedirect(route('admin.dashboard'));

        $this->assertDatabaseHas('gigs', [
            'title' => 'Approved show',
            'city' => 'Jakarta',
            'is_approved' => true,
        ]);
    }

    public function test_contributor_can_open_the_gig_submission_form(): void
    {
        $this->actingAs($this->createUser('contributor'))
            ->get(route('admin.gigs.create'))
            ->assertOk()
            ->assertSee('name="city"', false)
            ->assertSee('name="flyer"', false);
    }

    private function createUser(string $role): User
    {
        $user = User::factory()->create();
        $user->forceFill([
            'role' => $role,
            'is_admin' => $role === 'super-admin',
        ])->save();

        return $user;
    }
}
