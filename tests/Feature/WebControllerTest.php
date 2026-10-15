<?php

namespace Tests\Feature;

use App\Models\Band;
use App\Models\Gig;
use App\Models\LostAndFound;
use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class WebControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_home_search_and_category_only_show_matching_approved_posts(): void
    {
        $matchingPost = $this->createPost('Noise review', 'review', true);
        $this->createPost('Noise interview', 'interview', true);
        $this->createPost('Noise pending review', 'review', false);

        $this->get('/?search=Noise&category=review')
            ->assertOk()
            ->assertSee($matchingPost->title)
            ->assertDontSee('Noise interview')
            ->assertDontSee('Noise pending review');
    }

    public function test_homepage_renders_uploaded_post_cover_image(): void
    {
        $post = $this->createPost('Featured article', 'news', true);
        $post->update(['cover_image' => 'posts/featured-cover.jpg']);

        $this->get('/')
            ->assertOk()
            ->assertSee('storage/posts/featured-cover.jpg');
    }

    public function test_unapproved_posts_gigs_and_pit_reports_are_not_public(): void
    {
        $post = $this->createPost('Pending article', 'review', false);
        Gig::create([
            'title' => 'Pending show',
            'city' => 'Bandung',
            'venue' => 'Venue',
            'event_date' => now()->addDay(),
            'ticket_price' => 'Free',
            'is_approved' => false,
        ]);
        LostAndFound::create([
            'item_name' => 'Pending item',
            'type' => 'lost',
            'gig_name' => 'Pending show',
            'city' => 'Bandung',
            'contact_person' => 'test@example.test',
            'is_approved' => false,
        ]);

        $this->get('/')
            ->assertOk()
            ->assertDontSee($post->title)
            ->assertDontSee('Pending show');
        $this->get(route('post.show', $post->slug))->assertNotFound();
        $this->get(route(''))->assertOk()->assertDontSee('Pending show');
        $this->get(route('pit.index'))->assertOk()->assertDontSee('Pending item');
    }

    public function test_public_submissions_are_saved_as_pending_and_hidden(): void
    {
        $this->post(route('gigs.store'), [
            'title' => 'Submitted gig',
            'city' => 'Jakarta',
            'venue' => 'Test venue',
            'event_date' => now()->addDay()->toDateTimeString(),
            'ticket_price' => 'Free',
        ])->assertRedirect();

        $this->assertDatabaseHas('gigs', [
            'title' => 'Submitted gig',
            'is_approved' => false,
        ]);
        $this->get(route(''))->assertDontSee('Submitted gig');

        $this->post(route('pit.store'), [
            'item_name' => 'Submitted item',
            'type' => 'found',
            'gig_name' => 'Test gig',
            'city' => 'Jakarta',
            'contact_person' => 'test@example.test',
        ])->assertRedirect();

        $this->assertDatabaseHas('lost_and_founds', [
            'item_name' => 'Submitted item',
            'is_approved' => false,
        ]);
        $this->get(route('pit.index'))->assertDontSee('Submitted item');
    }

    public function test_band_search_and_genre_filters_are_applied_together(): void
    {
        Band::create([
            'name' => 'Noise Makers',
            'slug' => 'noise-makers',
            'city' => 'Bandung',
            'genre' => 'Metal',
        ]);
        Band::create([
            'name' => 'Other Band',
            'slug' => 'other-band',
            'city' => 'Bandung',
            'genre' => 'Hardcore',
        ]);

        $this->get(route('bands.index', ['search' => 'Bandung', 'genre' => 'Metal']))
            ->assertOk()
            ->assertSee('Noise Makers')
            ->assertDontSee('Other Band');
    }

    private function createPost(string $title, string $category, bool $approved): Post
    {
        return Post::create([
            'title' => $title,
            'slug' => str($title)->slug()->toString(),
            'category' => $category,
            'excerpt' => "{$title} excerpt",
            'content' => "{$title} content",
            'is_approved' => $approved,
        ]);
    }
}
