<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Zine;
use App\Models\Band;
use App\Models\Gig;
use App\Models\LostAndFound;
use App\Models\PhysicalRelease;

class WebController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->take(6)->get();
        $gigs = Gig::where('event_date', '>=', now())->orderBy('event_date', 'asc')->take(4)->get();
        return view('home', compact('posts', 'gigs'));

        $query = Post::query();

    // Filter Search Keyword
    if ($request->filled('search')) {
        $query->where(function ($q) use ($request) {
            $q->where('title', 'LIKE', '%' . $request->search . '%')
              ->orWhere('content', 'LIKE', '%' . $request->search . '%');
        });
    }

    // Filter Category
    if ($request->filled('category') && $request->category !== 'all') {
        $query->where('category', $request->category);
    }

    $posts = $query->latest()->get();
    $gigs = Gig::where('event_date', '>=', now())->orderBy('event_date', 'asc')->take(4)->get();

    return view('home', compact('posts', 'gigs'));
    }

    public function showPost($slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();
        return view('post-detail', compact('post'));
    }

    public function gigs()
    {
        $gigs = Gig::orderBy('event_date', 'asc')->get();
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

        Gig::create($validated);

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
        $query = Band::query();

        if ($request->filled('search')) {
            $query->where('name', 'LIKE', '%' . $request->search . '%')
                ->orWhere('city', 'LIKE', '%' . $request->search . '%');
        }

        if ($request->filled('genre') && $request->genre !== 'all') {
            $query->where('genre', $request->genre);
        }

        $bands = $query->orderBy('name', 'asc')->get();

        return view('bands.index', compact('bands'));
    }

    public function pitLostFound()
    {
        $items = LostAndFound::latest()->get();
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

        LostAndFound::create($validated);

        return back()->with('success', 'Laporan berhasil terbit di Pit Board!');
    }
}