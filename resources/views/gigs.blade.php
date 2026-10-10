@extends('layouts.main')

@section('content')
<div x-data="{ selectedCity: 'ALL' }" class="space-y-6">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-end border-b border-zinc-800 pb-4 gap-4">
        <div>
            <h1 class="text-3xl font-black uppercase text-red-600 tracking-tight">Gigs & Pit Radar</h1>
            <p class="text-xs text-zinc-500 uppercase mt-1">Agenda Panggung & Konser Musik Cadas</p>
        </div>

        <!-- Tombol Filter Kota -->
        <div class="flex items-center space-x-2">
            <span class="text-xs font-bold text-zinc-500 uppercase">Filter:</span>
            <select x-model="selectedCity" class="bg-zinc-900 border border-zinc-800 text-xs font-bold uppercase text-white px-3 py-2 focus:border-red-600 focus:outline-none">
                <option value="ALL">Semua Kota</option>
                @foreach($gigs->pluck('city')->unique() as $city)
                    <option value="{{ strtoupper($city) }}">{{ strtoupper($city) }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <!-- Grid Cards -->
    <div class="grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @forelse($gigs as $gig)
        <div 
            x-show="selectedCity === 'ALL' || selectedCity === '{{ strtoupper($gig->city) }}'"
            class="bg-zinc-900 border border-zinc-800 overflow-hidden hover:border-red-600 transition flex flex-col justify-between"
        >
            <div>
                <!-- Display Poster -->
                @if($gig->poster_image)
                <div class="aspect-[3/4] bg-zinc-950 overflow-hidden">
                    <img src="{{ asset('storage/' . $gig->poster_image) }}" alt="{{ $gig->title }}" class="w-full h-full object-cover grayscale hover:grayscale-0 transition duration-300">
                </div>
                @endif

                <div class="p-4 space-y-3">
                    <div class="flex justify-between items-center text-xs font-bold text-red-500 uppercase">
                        <span>📍 {{ $gig->city }}</span>
                        <span>{{ $gig->ticket_price }}</span>
                    </div>
                    
                    <h3 class="font-black text-xl text-white uppercase leading-snug">{{ $gig->title }}</h3>
                    
                    <div class="text-xs text-zinc-400 space-y-1">
                        <p>Venue: <span class="text-zinc-200 font-semibold">{{ $gig->venue }}</span></p>
                        <p>Tanggal: <span class="text-zinc-200 font-semibold">{{ \Carbon\Carbon::parse($gig->event_date)->format('d M Y, H:i') }}</span></p>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <p class="text-xs text-zinc-500 uppercase col-span-4 py-8 text-center border border-dashed border-zinc-800">Belum ada agenda gig terdaftar.</p>
        @endforelse
    </div>
</div>
@endsection