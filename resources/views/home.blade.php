@extends('layouts.main')

@section('content')
<div class="space-y-12 pb-16">
    <!-- Hero / Header Brutalist -->
    <div class="border-b-4 border-white pb-6 pt-4 flex flex-col md:flex-row justify-between items-start md:items-end gap-4">
        <div>
            <span class="bg-white text-black font-black text-xs uppercase px-2 py-1 tracking-widest">Independent Zine & Portal</span>
            <h1 class="text-4xl md:text-6xl font-black uppercase tracking-tighter text-white mt-2">INFOMUSIKCADAS</h1>
            <p class="text-xs text-zinc-400 uppercase mt-1 tracking-wider">Arsip skena, kabar cadas, gig radar, & direktori band underground lokal.</p>
        </div>
        <div class="text-right hidden md:block">
            <div class="text-[10px] text-zinc-500 uppercase font-bold">Est. Bandung Scene</div>
            <div class="text-accent text-sm font-black uppercase">No Compromise / DIY</div>
        </div>
    </div>

    <!-- 🔍 SEARCH BAR & FILTER KATEGORI -->
    <form method="GET" action="{{ route('home') }}" class="bg-zinc-900 border border-zinc-800 p-4 flex flex-col md:flex-row gap-3 items-center justify-between">
        <div class="w-full md:w-1/2 flex gap-2">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari artikel, review band, atau wawancara..." class="w-full bg-zinc-950 border border-zinc-800 p-3 text-xs text-white outline-none focus:border-accent">
            <button type="submit" class="bg-white text-black hover:bg-accent hover:text-white font-black text-xs uppercase px-5 py-3 transition">Cari</button>
        </div>

        <!-- Filter Kategori -->
        <div class="w-full md:w-auto flex flex-wrap gap-1 text-[10px] font-black uppercase">
            <a href="{{ route('home', ['category' => 'all']) }}" class="px-3 py-2 border {{ request('category', 'all') === 'all' ? 'bg-accent border-accent text-white' : 'bg-zinc-950 border-zinc-800 text-zinc-400 hover:text-white' }}">Semua</a>
            <a href="{{ route('home', ['category' => 'news']) }}" class="px-3 py-2 border {{ request('category') === 'news' ? 'bg-accent border-accent text-white' : 'bg-zinc-950 border-zinc-800 text-zinc-400 hover:text-white' }}">News</a>
            <a href="{{ route('home', ['category' => 'review']) }}" class="px-3 py-2 border {{ request('category') === 'review' ? 'bg-accent border-accent text-white' : 'bg-zinc-950 border-zinc-800 text-zinc-400 hover:text-white' }}">Review</a>
            <a href="{{ route('home', ['category' => 'interview']) }}" class="px-3 py-2 border {{ request('category') === 'interview' ? 'bg-accent border-accent text-white' : 'bg-zinc-950 border-zinc-800 text-zinc-400 hover:text-white' }}">Interview</a>
            <a href="{{ route('home', ['category' => 'editorial']) }}" class="px-3 py-2 border {{ request('category') === 'editorial' ? 'bg-accent border-accent text-white' : 'bg-zinc-950 border-zinc-800 text-zinc-400 hover:text-white' }}">Editorial</a>
        </div>
    </form>

    <!-- 🔥 HERO BANNER BERITA UTAMA -->
    @php
        $featuredPost = $posts->first(); 
        $otherPosts = $posts->skip(1);   
    @endphp

    @if($featuredPost)
        <div class="bg-zinc-900 border-2 border-white grid grid-cols-1 md:grid-cols-2 overflow-hidden hover:border-accent transition">
            <div class="relative min-h-[280px] bg-zinc-950 border-b md:border-b-0 md:border-r border-zinc-800">
                @if($featuredPost->cover_image)
                    <img src="{{ asset('storage/' . $featuredPost->cover_image) }}" class="w-full h-full object-cover">
                @else
                    <div class="w-full h-full flex items-center justify-center text-zinc-700 font-black uppercase text-xs">NO COVER IMAGE</div>
                @endif
                <span class="absolute top-3 left-3 bg-accent text-white font-black text-[10px] uppercase px-2.5 py-1">Featured News</span>
            </div>
            <div class="p-6 md:p-8 flex flex-col justify-between space-y-4">
                <div class="space-y-3">
                    <div class="flex items-center gap-2 text-[10px] text-zinc-500 font-bold uppercase">
                        <span>{{ $featuredPost->created_at->diffForHumans() }}</span>
                        <span>•</span>
                        <span class="text-accent font-black">{{ $featuredPost->category }}</span>
                    </div>
                    <h2 class="text-2xl md:text-3xl font-black text-white uppercase leading-tight tracking-tight">
                        <a href="{{ route('post.show', $featuredPost->slug) }}" class="hover:text-accent transition">{{ $featuredPost->title }}</a>
                    </h2>
                    <p class="text-xs text-zinc-400 leading-relaxed">{{ $featuredPost->excerpt }}</p>
                </div>
                <div>
                    <a href="{{ route('post.show', $featuredPost->slug) }}" class="inline-block bg-white text-black hover:bg-accent hover:text-white font-black text-xs uppercase px-4 py-2 transition">
                        Baca Berita Lengkap &rarr;
                    </a>
                </div>
            </div>
        </div>
    @endif

    <!-- Section: Berita Lainnya -->
    <div class="space-y-6">
        <div class="flex justify-between items-center border-b border-zinc-800 pb-2">
            <h2 class="text-xl font-black uppercase text-white tracking-tight">📰 Arsip Berita & Rilisan</h2>
            <span class="text-[10px] text-zinc-500 uppercase font-bold">Latest Feed</span>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @forelse($otherPosts as $post)
                <div class="bg-zinc-900 border border-zinc-800 overflow-hidden flex flex-col justify-between hover:border-accent transition">
                    <div>
                        @if($post->cover_image)
                            <img src="{{ asset('storage/' . $post->cover_image) }}" class="w-full h-40 object-cover border-b border-zinc-800">
                        @else
                            <div class="w-full h-40 bg-zinc-950 border-b border-zinc-800 flex items-center justify-center text-[10px] text-zinc-700 font-bold">NO IMAGE</div>
                        @endif
                        <div class="p-5 space-y-2">
                            <span class="bg-zinc-800 text-zinc-300 text-[9px] font-black uppercase px-2 py-0.5">{{ $post->category }}</span>
                            <h3 class="text-sm font-black text-white uppercase leading-snug">
                                <a href="{{ route('post.show', $post->slug) }}" class="hover:text-accent transition">{{ $post->title }}</a>
                            </h3>
                            <p class="text-xs text-zinc-400 line-clamp-2">{{ $post->excerpt }}</p>
                        </div>
                    </div>
                    <div class="px-5 pb-5 pt-2 flex justify-between items-center text-[10px] text-zinc-500 uppercase font-bold border-t border-zinc-800/60">
                        <span>{{ $post->created_at->diffForHumans() }}</span>
                        <a href="{{ route('post.show', $post->slug) }}" class="text-accent font-black hover:underline">Sikat &rarr;</a>
                    </div>
                </div>
            @empty
                @if(!$featuredPost)
                    <div class="col-span-3 text-center py-12 bg-zinc-900 border border-zinc-800 text-zinc-500 text-xs uppercase font-bold">
                        Belum ada berita atau hasil pencarian yang cocok, cuy.
                    </div>
                @endif
            @endforelse
        </div>
    </div>

    <!-- Section: Gig Radar -->
    <div class="space-y-6">
        <div class="flex justify-between items-center border-b border-zinc-800 pb-2">
            <h2 class="text-xl font-black uppercase text-white tracking-tight">⚡ Gig Radar / Jadwal Acara</h2>
            <span class="text-[10px] text-zinc-500 uppercase font-bold">Upcoming Gigs</span>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
            @forelse($gigs as $gig)
                <div class="bg-zinc-900 border border-zinc-800 overflow-hidden flex flex-col justify-between">
                    @if($gig->poster_image)
                        <img src="{{ asset('storage/' . $gig->poster_image) }}" class="w-full h-48 object-cover border-b border-zinc-800">
                    @elseif($gig->flyer)
                        <img src="{{ asset('storage/' . $gig->flyer) }}" class="w-full h-48 object-cover border-b border-zinc-800">
                    @endif
                    <div class="p-4 space-y-2 flex-1 flex flex-col justify-between">
                        <div>
                            <span class="text-[9px] text-accent font-black uppercase">{{ \Carbon\Carbon::parse($gig->event_date)->format('d M Y') }}</span>
                            <h4 class="text-sm font-black text-white uppercase mt-1">{{ $gig->title ?? $gig->event_name }}</h4>
                        </div>
                        <div class="text-[10px] text-zinc-400 uppercase pt-2 border-t border-zinc-800">
                            📍 {{ $gig->venue }} ({{ $gig->city }})
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-4 text-center py-8 bg-zinc-900 border border-zinc-800 text-zinc-500 text-xs uppercase font-bold">
                    Belum ada jadwal gig terdekat.
                </div>
            @endforelse
        </div>
    </div>

    <!-- Section: Scene Index -->
    <div class="space-y-6">
        <div class="flex justify-between items-center border-b border-zinc-800 pb-2">
            <h2 class="text-xl font-black uppercase text-white tracking-tight">💀 Scene Index / Direktori Band</h2>
            <span class="text-[10px] text-zinc-500 uppercase font-bold">Underground Roster</span>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
            @forelse($bands as $band)
                <div class="bg-zinc-900 border border-zinc-800 p-4 text-center space-y-2 hover:border-white transition">
                    @if($band->logo_or_photo)
                        <img src="{{ asset('storage/' . $band->logo_or_photo) }}" class="w-16 h-16 object-cover mx-auto border border-zinc-700">
                    @else
                        <div class="w-16 h-16 bg-zinc-800 mx-auto flex items-center justify-center text-[10px] font-bold text-zinc-500">BAND</div>
                    @endif
                    <div>
                        <h4 class="text-xs font-black text-white uppercase">{{ $band->name }}</h4>
                        <p class="text-[9px] text-zinc-500 uppercase font-bold mt-0.5">{{ $band->genre }} • {{ $band->city }}</p>
                    </div>
                </div>
            @empty
                <div class="col-span-4 text-center py-8 bg-zinc-900 border border-zinc-800 text-zinc-500 text-xs uppercase font-bold">
                    Direktori band masih kosong.
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection