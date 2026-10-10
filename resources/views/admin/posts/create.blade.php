@extends('layouts.main')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">
    <div class="flex justify-between items-center border-b border-zinc-800 pb-4">
        <h1 class="text-2xl font-black uppercase text-accent tracking-tight">Tulis Artikel Baru</h1>
        <a href="{{ route('admin.posts.index') }}" class="text-xs font-bold text-zinc-500 hover:text-white uppercase">← Batal</a>
    </div>

    <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data" class="bg-zinc-900 border border-zinc-800 p-6 space-y-4">
        @csrf
        <div>
            <label class="block text-xs font-bold uppercase text-zinc-400 mb-1">Judul Artikel</label>
            <input type="text" name="title" value="{{ old('title') }}" required class="w-full bg-zinc-950 border border-zinc-800 text-xs font-bold text-white px-3 py-2 uppercase focus:border-accent focus:outline-none">
        </div>

        <div>
            <label class="block text-xs font-bold uppercase text-zinc-400 mb-1">Kategori</label>
            <select name="category" class="w-full bg-zinc-950 border border-zinc-800 text-xs font-bold text-white px-3 py-2 uppercase focus:border-accent focus:outline-none">
                <option value="review">Review</option>
                <option value="news">News</option>
                <option value="interview">Interview</option>
                <option value="editorial">Editorial</option>
            </select>
        </div>

        <div>
            <label class="block text-xs font-bold uppercase text-zinc-400 mb-1">Excerpt / Ringkasan Singkat</label>
            <textarea name="excerpt" rows="2" required class="w-full bg-zinc-950 border border-zinc-800 text-xs text-white px-3 py-2 focus:border-accent focus:outline-none">{{ old('excerpt') }}</textarea>
        </div>

        <div>
            <label class="block text-xs font-bold uppercase text-zinc-400 mb-1">Gambar Poster / Cover</label>
            <input type="file" name="cover_image" class="w-full bg-zinc-950 border border-zinc-800 text-xs text-zinc-400 px-3 py-2 focus:border-accent focus:outline-none">
        </div>

        <div>
            <label class="block text-xs font-bold uppercase text-zinc-400 mb-1">Link Embed Audio (Spotify / Bandcamp)</label>
            <input type="url" name="audio_embed_url" value="{{ old('audio_embed_url') }}" placeholder="https://open.spotify.com/embed/album/..." class="w-full bg-zinc-950 border border-zinc-800 text-xs text-white px-3 py-2 focus:border-accent focus:outline-none">
        </div>

        <div>
            <label class="block text-xs font-bold uppercase text-zinc-400 mb-1">Isi Artikel (HTML Boleh)</label>
            <textarea name="content" rows="10" required class="w-full bg-zinc-950 border border-zinc-800 text-xs text-white p-3 font-mono focus:border-accent focus:outline-none">{{ old('content') }}</textarea>
        </div>

        <button type="submit" class="w-full bg-accent hover:bg-zinc-800 text-white font-black text-xs uppercase py-3 transition">
            Terbitkan Artikel
        </button>
    </form>
</div>
@endsection