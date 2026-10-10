@extends('layouts.main')

@section('content')
<div class="space-y-12">
    <!-- Search & Filter Section -->
    <section class="bg-zinc-900 border border-zinc-800 p-4 space-y-4">
        <form action="{{ route('home') }}" method="GET" class="flex flex-col md:flex-row gap-3">
            <!-- Input Search -->
            <div class="relative flex-1">
                <input 
                    type="text" 
                    name="search" 
                    value="{{ request('search') }}" 
                    placeholder="CARI BAND, ALBUM, ATAU BERITA CADAS..." 
                    class="w-full bg-zinc-950 border border-zinc-800 text-xs font-bold text-white px-4 py-3 focus:border-red-600 focus:outline-none uppercase placeholder:text-zinc-600"
                >
            </div>

            <!-- Dropdown Category -->
            <select name="category" class="bg-zinc-950 border border-zinc-800 text-xs font-bold text-white px-4 py-3 focus:border-red-600 focus:outline-none uppercase">
                <option value="all" {{ request('category') == 'all' ? 'selected' : '' }}>Semua Kategori</option>
                <option value="review" {{ request('category') == 'review' ? 'selected' : '' }}>Review</option>
                <option value="news" {{ request('category') == 'news' ? 'selected' : '' }}>News</option>
                <option value="interview" {{ request('category') == 'interview' ? 'selected' : '' }}>Interview</option>
                <option value="editorial" {{ request('category') == 'editorial' ? 'selected' : '' }}>Editorial</option>
            </select>

            <!-- Submit Button -->
            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-black text-xs uppercase px-6 py-3 transition tracking-wider">
                Cari
            </button>

            @if(request('search') || (request('category') && request('category') !== 'all'))
            <a href="{{ route('home') }}" class="bg-zinc-800 hover:bg-zinc-700 text-zinc-300 font-black text-xs uppercase px-4 py-3 transition text-center flex items-center justify-center">
                Reset
            </a>
            @endif
        </form>

        <!-- Quick Category Pills -->
        <div class="flex flex-wrap gap-2 pt-2 border-t border-zinc-800/60 text-[10px] font-bold uppercase">
            <span class="text-zinc-500 py-1">Quick Tag:</span>
            @foreach(['review', 'news', 'interview', 'editorial'] as $cat)
                <a 
                    href="{{ route('home', ['category' => $cat, 'search' => request('search')]) }}" 
                    class="px-2.5 py-1 border transition {{ request('category') == $cat ? 'bg-red-600 border-red-600 text-white' : 'bg-zinc-950 border-zinc-800 text-zinc-400 hover:border-red-600 hover:text-white' }}"
                >
                    {{ $cat }}
                </a>
            @endforeach
        </div>
    </section>

    <!-- News Section -->
    <section>
        <div class="flex justify-between items-end border-b border-zinc-800 pb-2 mb-6">
            <h2 class="text-2xl font-black uppercase text-red-600">
                @if(request('search'))
                    Hasil Cari: "{{ request('search') }}"
                @elseif(request('category') && request('category') !== 'all')
                    Kategori: {{ strtoupper(request('category')) }}
                @else
                    Latest Noise
                @endif
            </h2>
            <span class="text-xs font-bold text-zinc-500 uppercase">{{ $posts->count() }} Artikel</span>
        </div>

        <div class="grid md:grid-cols-3 gap-6">
            @forelse($posts as $post)
            <article class="bg-zinc-900 border border-zinc-800 p-4 hover:border-red-600 transition flex flex-col justify-between space-y-3">
                <div class="space-y-2">
                    <span class="text-xs font-bold text-red-500 uppercase tracking-wider">{{ $post->category }}</span>
                    <h3 class="text-xl font-bold leading-snug">
                        <a href="{{ route('post.show', $post->slug) }}" class="hover:underline text-white">{{ $post->title }}</a>
                    </h3>
                    <p class="text-xs text-zinc-400 leading-relaxed">{{ $post->excerpt }}</p>
                </div>
                <span class="text-[10px] font-bold text-zinc-500 uppercase block pt-2 border-t border-zinc-800/50">
                    {{ $post->created_at->format('d M Y') }}
                </span>
            </article>
            @empty
            <div class="col-span-3 text-center py-12 bg-zinc-900/50 border border-dashed border-zinc-800 space-y-2">
                <p class="text-xs text-zinc-500 font-bold uppercase">Artikel tidak ditemukan.</p>
                <a href="{{ route('home') }}" class="inline-block text-xs text-red-500 font-bold uppercase underline">Tampilkan Semua Artikel</a>
            </div>
            @endforelse
        </div>
    </section>

    <!-- Gigs Radar -->
    <section>
        <div class="flex justify-between items-end border-b border-zinc-800 pb-2 mb-6">
            <h2 class="text-2xl font-black uppercase text-red-600">Gigs Radar</h2>
            <a href="{{ route('gigs.index') }}" class="text-xs font-bold uppercase text-red-500 hover:underline">Lihat Semua →</a>
        </div>
        
        <div class="grid sm:grid-cols-2 md:grid-cols-4 gap-4">
            @foreach($gigs as $gig)
            <div class="bg-zinc-900 p-4 border border-zinc-800 space-y-1">
                <p class="text-xs text-red-500 font-bold uppercase">📍 {{ $gig->city }}</p>
                <h4 class="font-bold text-lg text-white">{{ $gig->title }}</h4>
                <p class="text-xs text-zinc-400">@ {{ $gig->venue }}</p>
                <span class="inline-block mt-2 text-[10px] bg-red-600 text-white font-black px-2 py-0.5 uppercase">{{ $gig->ticket_price }}</span>
            </div>
            @endforeach
        </div>
    </section>
</div>
@endsection