@extends('layouts.main')

@section('content')
<div class="space-y-6">
    <div class="border-b border-zinc-800 pb-4">
        <h1 class="text-3xl font-black uppercase text-red-600 tracking-tight">Digital Zine Library</h1>
        <p class="text-xs text-zinc-500 uppercase mt-1">Arsip & Bacaan Zine Underground Format Digital</p>
    </div>

    <div class="grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @forelse($zines as $item)
        <div class="bg-zinc-900 border border-zinc-800 p-4 space-y-3 hover:border-red-600 transition flex flex-col justify-between">
            <div class="space-y-2">
                <span class="bg-red-600 text-white font-black text-[10px] px-2 py-0.5 uppercase tracking-widest">
                    {{ $item->issue_number }}
                </span>
                
                <h3 class="font-black text-xl text-white uppercase leading-snug pt-1">{{ $item->title }}</h3>
                <p class="text-xs font-bold text-red-500 uppercase">By: {{ $item->author }}</p>
                <p class="text-xs text-zinc-400 line-clamp-3">{{ $item->description }}</p>
            </div>

            <a href="{{ route('zines.show', $item->id) }}" class="block w-full text-center bg-zinc-800 hover:bg-red-600 text-white font-black text-xs uppercase py-2 transition tracking-wider">
                Baca Zine →
            </a>
        </div>
        @empty
        <p class="text-xs text-zinc-500 uppercase col-span-4 py-8 text-center border border-dashed border-zinc-800">
            Belum ada zine digital di perpustakaan.
        </p>
        @endforelse
    </div>
</div>
@endsection