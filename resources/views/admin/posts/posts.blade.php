@extends('layouts.main')

@section('content')
<div class="space-y-6">
    <div class="flex justify-between items-center border-b border-zinc-800 pb-4">
        <div>
            <h1 class="text-3xl font-black uppercase text-accent tracking-tight">Kelola Berita & Review</h1>
            <p class="text-xs text-zinc-500 uppercase mt-1">Daftar Semua Artikel Redaksi</p>
        </div>
        <a href="{{ route('admin.posts.create') }}" class="bg-accent hover:bg-zinc-800 text-white font-black text-xs uppercase px-4 py-2 transition">
            + Tulis Artikel
        </a>
    </div>

    @if(session('success'))
    <div class="bg-zinc-900 border border-accent text-accent p-3 text-xs font-bold uppercase">
        {{ session('success') }}
    </div>
    @endif

    <div class="bg-zinc-900 border border-zinc-800 overflow-x-auto">
        <table class="w-full text-left text-xs uppercase">
            <thead class="bg-zinc-950 text-zinc-400 border-b border-zinc-800">
                <tr>
                    <th class="p-3">Judul</th>
                    <th class="p-3">Kategori</th>
                    <th class="p-3">Tanggal</th>
                    <th class="p-3 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-zinc-800 text-zinc-300 font-bold">
                @forelse($posts as $post)
                <tr class="hover:bg-zinc-800/50 transition">
                    <td class="p-3 text-white font-black">{{ $post->title }}</td>
                    <td class="p-3"><span class="text-accent">{{ $post->category }}</span></td>
                    <td class="p-3 text-zinc-500">{{ $post->created_at->format('d M Y') }}</td>
                    <td class="p-3 text-right space-x-2">
                        <a href="{{ route('admin.posts.edit', $post->id) }}" class="text-zinc-400 hover:text-white underline">Edit</a>
                        <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin mau dibantai artikel ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-400 underline">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="p-6 text-center text-zinc-500">Belum ada artikel.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="pt-2">
        {{ $posts->links() }}
    </div>
</div>
@endsection