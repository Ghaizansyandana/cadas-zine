<?php

namespace App\Http\Controllers;

use App\Models\Band;
use App\Models\Gig;
use App\Models\LostAndFound;
use App\Models\PhysicalRelease;
use App\Models\Post;

use App\Models\Zine;
use App\Support\ArticleContentSanitizer;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class WebController extends Controller
{
    public function index(Request $request)
    {
        $filters = $request->validate([
            'search' => ['nullable', 'string', 'max:100'],
            'category' => ['nullable', Rule::in(['all', 'news', 'review', 'interview', 'editorial'])],
        ]);

        $postsQuery = Post::query()->where('is_approved', true);

        if (! empty($filters['search'])) {
            $search = $filters['search'];

            $postsQuery->where(function ($query) use ($search) {
                $query->where('title', 'LIKE', "%{$search}%")
                    ->orWhere('excerpt', 'LIKE', "%{$search}%")
                    ->orWhere('content', 'LIKE', "%{$search}%");
            });
        }

        if (! empty($filters['category']) && $filters['category'] !== 'all') {
            $postsQuery->where('category', $filters['category']);
        }

        $posts = $postsQuery->latest()->take(6)->get();
        $gigs = Gig::where('is_approved', true)
            ->where('event_date', '>=', now())
            ->orderBy('event_date')
            ->take(4)
            ->get();

        return view('home', compact('posts', 'gigs'));
    }

    public function showPost(string $slug, ArticleContentSanitizer $sanitizer)
    {
        $post = Post::where('slug', $slug)
            ->where('is_approved', true)
            ->firstOrFail();
        $post->content = $sanitizer->sanitize($post->content);

        return view('post-detail', compact('post'));
    }

    public function gigs()
    {
        $gigs = Gig::where('is_approved', true)
            ->orderBy('event_date')
            ->get();

        return view('gigs', compact('gigs'));
    }

    public function submitGigForm()
    {
        return view('submit-gig');
    }

    public function storeGig(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'city' => 'required|string|max:100',
            'venue' => 'required|string|max:255',
            'event_date' => 'required|date',
            'ticket_price' => 'required|string|max:50',
            'poster_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('poster_image')) {
            $validated['poster_image'] = $request->file('poster_image')->store('gigs-posters', 'public');
        }

        Gig::create([
            ...$validated,
            'is_approved' => false,
        ]);

        return back()->with('success', 'Agenda gig & poster berhasil dikirim!');
    }


    public function vault()
    {
        $releases = PhysicalRelease::latest()->get();
        return view('vault', compact('releases'));
    }


    public function zines()
    {
        $zines = Zine::latest()->get();
        return view('zines.index', compact('zines'));
    }

    public function showZine($id)
    {
        $zine = Zine::findOrFail($id);
        return view('zines.show', compact('zine'));
    }

    public function bands(Request $request)
    {
        $filters = $request->validate([
            'search' => ['nullable', 'string', 'max:100'],
            'genre' => ['nullable', Rule::in(['all', 'Metal', 'Grindcore', 'Hardcore', 'Sludge', 'Death Metal'])],
        ]);

        $query = Band::query();

        if (! empty($filters['search'])) {
            $search = $filters['search'];

            $query->where(function ($query) use ($search) {
                $query->where('name', 'LIKE', "%{$search}%")
                    ->orWhere('city', 'LIKE', "%{$search}%");
            });
        }

        if (! empty($filters['genre']) && $filters['genre'] !== 'all') {
            $query->where('genre', $filters['genre']);
        }

        $bands = $query->orderBy('name', 'asc')->get();

        return view('bands.index', compact('bands'));
    }

    public function pitLostFound()
    {
        $items = LostAndFound::where('is_approved', true)->latest()->get();

        return view('pit-lost-found', compact('items'));
    }

    public function storePitItem(Request $request)
    {
        $validated = $request->validate([
            'item_name' => 'required|string|max:255',
            'type' => 'required|in:lost,found',
            'gig_name' => 'required|string|max:255',
            'city' => 'required|string|max:100',
            'description' => 'nullable|string',
            'contact_person' => 'required|string|max:255',
        ]);

        LostAndFound::create([
            ...$validated,
            'is_approved' => false,
        ]);

        return back()->with('success', 'Laporan berhasil terbit di Pit Board!');
    }

    public function guide()
    {
        return view('guide');
    }
}