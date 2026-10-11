@extends('layouts.main')

@section('content')
<div class="max-w-2xl mx-auto space-y-6">
    <div class="flex justify-between items-center border-b border-zinc-800 pb-4">
        <div>
            <h1 class="text-2xl font-black uppercase text-accent tracking-tight">Tambah Band / Scene Index</h1>
            <p class="text-xs text-zinc-500 uppercase mt-1">Daftarin roster/band underground ke database</p>
        </div>
        <a href="{{ route('admin.bands.index') }}" class="text-xs font-bold text-zinc-500 hover:text-white uppercase">← Kembali</a>
    </div>

    <form action="{{ route('admin.bands.store') }}" method="POST" enctype="multipart/form-data" class="bg-zinc-900 border border-zinc-800 p-6 space-y-4">
        @csrf
        
        <div>
            <label class="block text-xs font-bold uppercase text-zinc-400 mb-1">Nama Band</label>
            <input type="text" name="name" required placeholder="Contoh: Warmouth" class="w-full bg-zinc-950 border border-zinc-800 p-3 text-sm text-white focus:border-accent outline-none">
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-bold uppercase text-zinc-400 mb-1">Asal Kota</label>
                <input type="text" name="city" required placeholder="Contoh: Bandung" class="w-full bg-zinc-950 border border-zinc-800 p-3 text-sm text-white focus:border-accent outline-none">
            </div>
            <div>
                <label class="block text-xs font-bold uppercase text-zinc-400 mb-1">Genre / Subgenre</label>
                <input type="text" name="genre" required placeholder="Contoh: Powerviolence / Hardcore" class="w-full bg-zinc-950 border border-zinc-800 p-3 text-sm text-white focus:border-accent outline-none">
            </div>
        </div>

        <div>
            <label class="block text-xs font-bold uppercase text-zinc-400 mb-1">Biografi / Profil Band</label>
            <textarea name="bio" rows="4" placeholder="Cerita singkat perjalanan band..." class="w-full bg-zinc-950 border border-zinc-800 p-3 text-sm text-white focus:border-accent outline-none"></textarea>
        </div>

        <div>
            <label class="block text-xs font-bold uppercase text-zinc-400 mb-1">Diskografi / Rilisan Album</label>
            <textarea name="discography" rows="3" placeholder="Misal: Demo 2023 (Cassette), Self-Titled EP (2024)" class="w-full bg-zinc-950 border border-zinc-800 p-3 text-sm text-white focus:border-accent outline-none"></textarea>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label class="block text-xs font-bold uppercase text-zinc-400 mb-1">Instagram URL</label>
                <input type="url" name="instagram_url" placeholder="https://instagram.com/..." class="w-full bg-zinc-950 border border-zinc-800 p-2.5 text-xs text-white focus:border-accent outline-none">
            </div>
            <div>
                <label class="block text-xs font-bold uppercase text-zinc-400 mb-1">Bandcamp URL</label>
                <input type="url" name="bandcamp_url" placeholder="https://....bandcamp.com" class="w-full bg-zinc-950 border border-zinc-800 p-2.5 text-xs text-white focus:border-accent outline-none">
            </div>
            <div>
                <label class="block text-xs font-bold uppercase text-zinc-400 mb-1">Spotify URL</label>
                <input type="url" name="spotify_url" placeholder="https://open.spotify.com/..." class="w-full bg-zinc-950 border border-zinc-800 p-2.5 text-xs text-white focus:border-accent outline-none">
            </div>
        </div>

        <div>
            <label class="block text-xs font-bold uppercase text-zinc-400 mb-1">Logo / Foto Band</label>
            <input type="file" name="logo_or_photo" accept="image/*" class="w-full bg-zinc-950 border border-zinc-800 p-2 text-xs text-zinc-400">
        </div>

        <button type="submit" class="w-full bg-accent hover:bg-zinc-800 text-white font-black text-xs uppercase py-3 transition">
            Simpan Ke Scene Index &rarr;
        </button>
    </form>
</div>
@endsection