@extends('layouts.main')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="border-b border-zinc-800 pb-4">
        <h1 class="text-3xl font-black uppercase text-accent tracking-tight">Band Directory & Local Scene Index</h1>
        <p class="text-xs text-zinc-500 uppercase mt-1">Database Band Underground Lokal Per Kota & Subgenre</p>
    </div>

    <!-- Filter Form -->
    <form action="{{ route('bands.index') }}" method="GET" class="flex flex-col sm:flex-row gap-3 bg-zinc-900 p-4 border border-zinc-800">
        <input 
            type="text" 
            name="search" 
            value="{{ request('search') }}" 
            placeholder="Cari nama band / kota..." 
            class="flex-1 bg-zinc-950 border border-zinc-800 text-xs font-bold text-white px-3 py-2 uppercase focus:border-accent focus:outline-none"
        >

        <select name="genre" class="bg-zinc-950 border border-zinc-800 text-xs font-bold text-white px-3 py-2 uppercase focus:border-accent focus:outline-none">
            <option value="all">Semua Subgenre</option>
            <option value="Metal" {{ request('genre') == 'Metal' ? 'selected' : '' }}>Metal</option>
            <option value="Grindcore" {{ request('genre') == 'Grindcore' ? 'selected' : '' }}>Grindcore</option>
            <option value="Hardcore" {{ request('genre') == 'Hardcore' ? 'selected' : '' }}>Hardcore</option>
            <option value="Sludge" {{ request('genre') == 'Sludge' ? 'selected' : '' }}>Sludge</option>
            <option value="Death Metal" {{ request('genre') == 'Death Metal' ? 'selected' : '' }}>Death Metal</option>
        </select>

        <button type="submit" class="bg-accent hover:bg-zinc-800 text-white font-black text-xs uppercase px-5 py-2 transition">
            Filter
        </button>
    </form>

    <!-- Grid Band -->
    <div class="grid sm:grid-cols-2 md:grid-cols-3 gap-6">
        @forelse($bands as $band)
        <div class="bg-zinc-900 border border-zinc-800 p-5 space-y-4 hover:border-accent transition flex flex-col justify-between">
            <div class="space-y-2">
                <div class="flex justify-between items-center text-xs font-bold uppercase">
                    <span class="text-accent">📍 {{ $band->city }}</span>
                    <span class="bg-zinc-800 text-zinc-300 px-2 py-0.5 text-[10px]">{{ $band->genre }}</span>
                </div>

                <h3 class="text-2xl font-black text-white uppercase tracking-wide">{{ $band->name }}</h3>
                <p class="text-xs text-zinc-400 leading-relaxed">{{ $band->bio }}</p>

                @if($band->discography)
                <div class="pt-2 border-t border-zinc-800/60">
                    <p class="text-[10px] font-bold text-zinc-500 uppercase">Diskografi:</p>
                    <p class="text-xs text-zinc-300 font-medium italic">{{ $band->discography }}</p>
                </div>
                @endif
            </div>

            <!-- Social Links -->
            <div class="flex gap-2 pt-3 border-t border-zinc-800/80 text-[10px] font-black uppercase">
                @if($band->instagram_url)
                <a href="{{ $band->instagram_url }}" target="_blank" class="bg-zinc-800 hover:bg-accent text-white px-2.5 py-1 transition">IG</a>
                @endif
                @if($band->bandcamp_url)
                <a href="{{ $band->bandcamp_url }}" target="_blank" class="bg-zinc-800 hover:bg-accent text-white px-2.5 py-1 transition">Bandcamp</a>
                @endif
                @if($band->spotify_url)
                <a href="{{ $band->spotify_url }}" target="_blank" class="bg-zinc-800 hover:bg-accent text-white px-2.5 py-1 transition">Spotify</a>
                @endif
            </div>
        </div>
        @empty
        <p class="text-xs text-zinc-500 uppercase col-span-3 py-8 text-center border border-dashed border-zinc-800">
            Band belum terdaftar di direktori.
        </p>
        @endforelse
    </div>
</div>
@endsection