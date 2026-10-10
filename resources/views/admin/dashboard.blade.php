@extends('layouts.main')

@section('content')
<div class="space-y-6">
    <div class="flex justify-between items-center border-b border-zinc-800 pb-4">
        <div>
            <h1 class="text-3xl font-black uppercase text-accent tracking-tight">Admin Redaksi Board</h1>
            <p class="text-xs text-zinc-500 uppercase mt-1">Halo, {{ auth()->user()->name }}!</p>
        </div>
        
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="bg-zinc-800 hover:bg-red-600 text-white font-bold text-xs uppercase px-4 py-2 transition">
                Logout
            </button>
        </form>
    </div>

    <!-- Ringkasan Stats -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <div class="bg-zinc-900 border border-zinc-800 p-5 space-y-1">
            <span class="text-[10px] font-bold text-zinc-500 uppercase">Total Artikel</span>
            <p class="text-3xl font-black text-white">{{ $stats['posts'] }}</p>
        </div>
        <div class="bg-zinc-900 border border-zinc-800 p-5 space-y-1">
            <span class="text-[10px] font-bold text-zinc-500 uppercase">Agenda Gigs</span>
            <p class="text-3xl font-black text-white">{{ $stats['gigs'] }}</p>
        </div>
        <div class="bg-zinc-900 border border-zinc-800 p-5 space-y-1">
            <span class="text-[10px] font-bold text-zinc-500 uppercase">Band Directory</span>
            <p class="text-3xl font-black text-white">{{ $stats['bands'] }}</p>
        </div>
    </div>

    <!-- Quick Action -->
    <div class="bg-zinc-900 border border-zinc-800 p-6 space-y-4">
        <h3 class="text-lg font-black text-white uppercase border-b border-zinc-800 pb-2">Aksi Cepat</h3>
        <div class="flex flex-wrap gap-3">
            <a href="{{ route('admin.posts.create') }}" class="bg-accent hover:bg-zinc-800 text-white font-black text-xs uppercase px-4 py-2 transition">
                + Tulis Artikel Baru
            </a>
            <a href="{{ route('admin.posts.index') }}" class="bg-zinc-800 hover:bg-accent text-white font-black text-xs uppercase px-4 py-2 transition">
                Kelola Kelola Kelola Berita
            </a>
        </div>
    </div>
</div>
@endsection