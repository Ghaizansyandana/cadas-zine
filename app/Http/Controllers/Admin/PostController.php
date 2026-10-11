<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Support\ArticleContentSanitizer;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class PostController extends Controller
{
    public function index(): View
    {
        $posts = Post::query()
            ->when(
                ! auth()->user()->isSuperAdmin(),
                fn ($query) => $query->where('user_id', auth()->id()),
            )
            ->latest()
            ->paginate(10);

        return view('admin.posts.index', compact('posts'));
    }

    public function create(): View
    {
        return view('admin.posts.create');
    }

    public function store(Request $request, ArticleContentSanitizer $sanitizer): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'category' => ['required', Rule::in(['news', 'review', 'interview', 'editorial'])],
            'excerpt' => ['required', 'string', 'max:65535'],
            'content' => ['required', 'string'],
            'cover_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'audio_embed_url' => ['nullable', 'url', 'max:255'],
        ]);

        $validated['content'] = $sanitizer->sanitize($validated['content']);
        $coverPath = $request->file('cover_image')?->store('posts', 'public');

        $post = new Post([
            ...$validated,
            'slug' => $this->uniqueSlug($validated['title']),
            'user_id' => $request->user()->id,
            'is_approved' => $request->user()->isSuperAdmin(),
            'cover_image' => $coverPath,
        ]);
        $post->save();

        $message = $post->is_approved
            ? 'Artikel berhasil diterbitkan!'
            : 'Artikel berhasil dikirim! Menunggu approval Super Admin.';

        return redirect()->route('admin.posts.index')->with('success', $message);
    }

    public function edit(Post $post): View
    {
        $this->authorizePost($post);

        return view('admin.posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post, ArticleContentSanitizer $sanitizer): RedirectResponse
    {
        $this->authorizePost($post);

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'category' => ['required', Rule::in(['news', 'review', 'interview', 'editorial'])],
            'excerpt' => ['required', 'string', 'max:65535'],
            'content' => ['required', 'string'],
            'cover_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'audio_embed_url' => ['nullable', 'url', 'max:255'],
        ]);

        $validated['content'] = $sanitizer->sanitize($validated['content']);
        $validated['slug'] = $this->uniqueSlug($validated['title'], $post);

        if ($request->hasFile('cover_image')) {
            if ($post->cover_image) {
                Storage::disk('public')->delete($post->cover_image);
            }

            $validated['cover_image'] = $request->file('cover_image')->store('posts', 'public');
        }

        if (! $request->user()->isSuperAdmin()) {
            $post->is_approved = false;
        }

        $post->fill($validated)->save();

        return redirect()->route('admin.posts.index')->with('success', 'Artikel berhasil diperbarui!');
    }

    public function destroy(Post $post): RedirectResponse
    {
        $this->authorizePost($post);

        if ($post->cover_image) {
            Storage::disk('public')->delete($post->cover_image);
        }

        $post->delete();

        return redirect()->route('admin.posts.index')->with('success', 'Artikel berhasil dihapus!');
    }

    public function approve(Post $post): RedirectResponse
    {
        $post->update(['is_approved' => true]);

        return back()->with('success', 'Artikel berhasil di-approve!');
    }

    public function pendingPosts(): View
    {
        $pendingPosts = Post::with('user')
            ->where('is_approved', false)
            ->latest()
            ->paginate(10);

        return view('admin.approvals.posts', compact('pendingPosts'));
    }

    private function authorizePost(Post $post): void
    {
        abort_unless(
            auth()->user()->isSuperAdmin() || $post->user_id === auth()->id(),
            403,
        );
    }

    private function uniqueSlug(string $title, ?Post $post = null): string
    {
        $baseSlug = Str::slug($title) ?: 'post';
        $slug = $baseSlug;
        $suffix = 2;

        while (Post::query()
            ->where('slug', $slug)
            ->when($post, fn ($query) => $query->whereKeyNot($post->getKey()))
            ->exists()) {
            $slug = $baseSlug.'-'.$suffix++;
        }

        return $slug;
    }
}
