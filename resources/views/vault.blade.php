@extends('layouts.main')

@section('content')
<div class="space-y-6">
    <div class="border-b border-zinc-800 pb-4">
        <h1 class="text-3xl font-black uppercase text-red-600 tracking-tight">Physical Vault</h1>
        <p class="text-xs text-zinc-500 uppercase mt-1">Katalog Kaset, CD, Vinyl, & Zine Underground</p>
    </div>

    <div class="grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @forelse($releases as $item)
        <div class="bg-zinc-900 border border-zinc-800 p-4 space-y-3 hover:border-red-600 transition flex flex-col justify-between">
            <div class="space-y-2">
                <div class="flex justify-between items-center text-[10px] font-black uppercase">
                    <span class="bg-red-600 text-white px-2 py-0.5">{{ $item->format }}</span>
                    <span class="text-zinc-400 font-bold">{{ $item->price }}</span>
                </div>

                <div class="aspect-square bg-zinc-950 border border-zinc-800 flex items-center justify-center text-zinc-700 font-black text-2xl uppercase">
                    @if($item->cover_image)
                        <img src="{{ asset('storage/' . $item->cover_image) }}" class="w-full h-full object-cover">
                    @else
                        {{ $item->format }}
                    @endif
                </div>

                <p class="text-xs font-bold text-red-500 uppercase tracking-wide">{{ $item->band_name }}</p>
                <h3 class="font-black text-lg text-white uppercase leading-snug">{{ $item->title }}</h3>
            </div>

            @if($item->buy_link)
            <a href="{{ $item->buy_link }}" target="_blank" class="block w-full text-center bg-zinc-800 hover:bg-red-600 text-white font-black text-xs uppercase py-2 transition tracking-wider">
                Beli Rilisan →
            </a>
            @endif
        </div>
        @empty
        <p class="text-xs text-zinc-500 uppercase col-span-4 py-8 text-center border border-dashed border-zinc-800">
            Belum ada data rilisan fisik di vault.
        </p>
        @endforelse
    </div>
</div>
@endsection