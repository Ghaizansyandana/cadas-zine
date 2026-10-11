@extends('layouts.main')

@section('content')
<div class="space-y-6">
    <div class="flex justify-between items-center border-b border-zinc-800 pb-4">
        <div>
            <h1 class="text-2xl font-black uppercase text-accent tracking-tight">Antrean Approval Artikel</h1>
            <p class="text-xs text-zinc-500 uppercase mt-1">Review tulisan dari kontributor sebelum terbit ke publik</p>
        </div>
        <a href="{{ route('admin.dashboard') }}" class="text-xs font-bold text-zinc-500 hover:text-white uppercase">← Dashboard</a>
    </div>

    @if(session('success'))
        <div class="bg-emerald-950/80 border border-emerald-800 text-emerald-400 text-xs p-3 font-bold uppercase">
            {{ session('success') }}
        </div>
    @endif

    <div class="space-y-4">
        @forelse($pendingPosts as $post)
            <div class="bg-zinc-900 border border-zinc-800 p-5 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                <div class="space-y-1 max-w-xl">
                    <div class="flex items-center gap-2">
                        <span class="bg-zinc-800 text-zinc-300 text-[9px] font-black uppercase px-2 py-0.5">{{ $post->category }}</span>
                        <span class="text-[10px] text-zinc-500 uppercase font-bold">Oleh: {{ $post->user->name ?? 'Kontributor' }}</span>
                    </div>
                    <h3 class="text-base font-black text-white uppercase">{{ $post->title }}</h3>
                    <p class="text-xs text-zinc-400 line-clamp-2">{{ $post->excerpt }}</p>
                </div>

                <!-- Tombol Aksi -->
                <div class="flex items-center gap-2 w-full md:w-auto">
                    <!-- Tombol Approve -->
                    <form action="{{ route('admin.posts.approve', $post->id) }}" method="POST" class="w-full md:w-auto">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="w-full md:w-auto bg-emerald-600 hover:bg-emerald-500 text-white font-black text-xs uppercase px-4 py-2 transition">
                            ✓ Approve
                        </button>
                    </form>

                    <!-- Tombol Preview (Opsional) -->
                    <a href="#" target="_blank" class="bg-zinc-800 hover:bg-zinc-700 text-zinc-300 font-bold text-xs uppercase px-3 py-2 transition">
                        Cek
                    </a>
                </div>
            </div>
        @empty
            <div class="bg-zinc-900 border border-zinc-800 p-8 text-center text-zinc-500 font-bold text-xs uppercase">
                Gak ada antrean artikel. Semua aman terkendali!
            </div>
        @endforelse

        <div class="mt-4">
            {{ $pendingPosts->links() }}
        </div>
    </div>
</div>
@endsection