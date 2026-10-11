<?php

namespace Tests\Feature\Admin;

use App\Models\Post;
use App\Models\User;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_contributor_dashboard_and_post_list_only_show_their_own_posts(): void
    {
        $contributor = $this->createUser('contributor');
        $otherUser = $this->createUser('contributor');
        $ownPost = $this->createPost($contributor, 'My submission');
        $otherPost = $this->createPost($otherUser, 'Other submission');

        $this->actingAs($contributor)
            ->get(route('admin.dashboard'))
            ->assertOk()
            ->assertSee($ownPost->title)
            ->assertDontSee($otherPost->title);

        $this->get(route('admin.posts.index'))
            ->assertOk()
            ->assertSee($ownPost->title)
            ->assertDontSee($otherPost->title);
    }

    public function test_contributor_submission_is_owned_and_waits_for_approval(): void
    {
        $contributor = $this->createUser('contributor');

        $this->actingAs($contributor)
            ->post(route('admin.posts.store'), [
                'title' => 'Contributor article',
                'category' => 'review',
                'excerpt' => 'Short summary',
                'content' => '<p onclick="alert(1)">Article content</p><script>alert(2)</script><a href="javascript:alert(3)" onclick="alert(4)">unsafe link</a><a href="https://example.test" target="_blank">safe link</a>',
            ])
            ->assertRedirect(route('admin.posts.index'));

        $this->assertDatabaseHas('posts', [
            'title' => 'Contributor article',
            'user_id' => $contributor->id,
            'is_approved' => false,
            'content' => '<p>Article content</p><a>unsafe link</a><a href="https://example.test">safe link</a>',
        ]);
    }

    public function test_public_article_rendering_sanitizes_legacy_content(): void
    {
        $post = $this->createPost($this->createUser('super-admin'), 'Legacy article');
        $post->forceFill([
            'is_approved' => true,
            'content' => '<p onclick="alert(1)">Safe text</p><script>alert(2)</script><a href="javascript:alert(3)">unsafe link</a>',
        ])->save();

        $this->get(route('post.show', $post->slug))
            ->assertOk()
            ->assertSee('Safe text')
            ->assertDontSee('alert(1)')
            ->assertDontSee('alert(2)')
            ->assertDontSee('onclick')
            ->assertDontSee('javascript:');
    }

    public function test_contributor_cannot_edit_another_users_post_or_access_approvals(): void
    {
        $contributor = $this->createUser('contributor');
        $otherUser = $this->createUser('contributor');
        $otherPost = $this->createPost($otherUser, 'Private post');

        $this->actingAs($contributor)
            ->get(route('admin.posts.edit', $otherPost))
            ->assertForbidden();

        $this->get(route('admin.approvals.posts'))->assertForbidden();
        $this->patch(route('admin.posts.approve', $otherPost))->assertForbidden();
    }

    public function test_super_admin_can_approve_a_pending_post(): void
    {
        $superAdmin = $this->createUser('super-admin');
        $post = $this->createPost($this->createUser('contributor'), 'Pending post');

        $this->actingAs($superAdmin)
            ->get(route('admin.approvals.posts'))
            ->assertOk()
            ->assertSee($post->title);

        $this->patch(route('admin.posts.approve', $post))
            ->assertRedirect();

        $this->assertDatabaseHas('posts', [
            'id' => $post->id,
            'is_approved' => true,
        ]);
    }

    public function test_user_seeder_creates_a_super_admin_that_can_access_admin_routes(): void
    {
        $this->seed(UserSeeder::class);
        $superAdmin = User::where('email', 'superadmin@infomusikcadas.test')->firstOrFail();

        $this->assertSame('super-admin', $superAdmin->role);
        $this->assertTrue($superAdmin->is_admin);

        $this->post(route('login'), [
            'email' => 'superadmin@infomusikcadas.test',
            'password' => 'password',
        ])->assertRedirect('/admin/dashboard');

        $this
            ->get(route('admin.dashboard'))
            ->assertOk()
            ->assertSee(route('admin.approvals.posts'));
    }

    public function test_admin_routes_redirect_guests_to_login(): void
    {
        $this->get(route('admin.dashboard'))
            ->assertRedirect(route('login'));
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

    private function createPost(User $user, string $title): Post
    {
        return Post::create([
            'user_id' => $user->id,
            'title' => $title,
            'slug' => str($title)->slug()->toString(),
            'category' => 'review',
            'excerpt' => 'Short summary',
            'content' => '<p>Article content</p>',
            'is_approved' => false,
        ]);
    }
}
