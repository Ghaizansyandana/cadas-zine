@extends('layouts.main')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4 border-b border-zinc-800 pb-4">
        <div>
            <h1 class="text-2xl font-black uppercase text-accent tracking-tight">Scene Index / Band Directory</h1>
            <p class="text-xs text-zinc-500 uppercase mt-1">Daftar roster band cadas yang terdata di sistem</p>
        </div>
        <a href="{{ route('admin.bands.create') }}" class="bg-accent hover:bg-zinc-800 text-white font-black text-xs uppercase px-4 py-2 transition text-center">
            + Tambah Band Baru
        </a>
    </div>

    <!-- Search Bar -->
    <form method="GET" action="{{ route('admin.bands.index') }}" class="flex gap-2">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama band, genre, atau kota..." class="bg-zinc-950 border border-zinc-800 p-2.5 text-xs text-white outline-none w-full md:w-80 focus:border-accent">
        <button type="submit" class="bg-zinc-800 hover:bg-zinc-700 text-white text-xs px-4 py-2.5 font-bold uppercase">Cari</button>
    </form>

    @if(session('success'))
        <div class="bg-emerald-950/80 border border-emerald-800 text-emerald-400 text-xs p-3 font-bold uppercase">
            {{ session('success') }}
        </div>
    @endif

    <!-- Table -->
    <div class="bg-zinc-900 border border-zinc-800 overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="border-b border-zinc-800 text-[10px] uppercase text-zinc-500 bg-zinc-950">
                    <th class="p-3">Band</th>
                    <th class="p-3">Genre</th>
                    <th class="p-3">Kota</th>
                    <th class="p-3">Links</th>
                    <th class="p-3 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-zinc-800 text-xs">
                @forelse($bands as $band)
                    <tr class="hover:bg-zinc-950/50">
                        <td class="p-3 font-black text-white uppercase flex items-center gap-3">
                            @if($band->logo_or_photo)
                                <img src="{{ asset('storage/' . $band->logo_or_photo) }}" class="w-8 h-8 object-cover border border-zinc-800">
                            @else
                                <div class="w-8 h-8 bg-zinc-800 flex items-center justify-center text-[10px] text-zinc-500 font-bold">NO PIC</div>
                            @endif
                            {{ $band->name }}
                        </td>
                        <td class="p-3 text-zinc-400 font-bold uppercase text-[10px]">{{ $band->genre }}</td>
                        <td class="p-3 text-zinc-400 font-bold uppercase text-[10px]">{{ $band->city }}</td>
                        <td class="p-3 text-zinc-400 space-x-1 text-[10px]">
                            @if($band->instagram_url) <a href="{{ $band->instagram_url }}" target="_blank" class="hover:text-white">IG</a> @endif
                            @if($band->bandcamp_url) <a href="{{ $band->bandcamp_url }}" target="_blank" class="hover:text-white">BC</a> @endif
                            @if($band->spotify_url) <a href="{{ $band->spotify_url }}" target="_blank" class="hover:text-white">SP</a> @endif
                        </td>
                        <td class="p-3 text-right">
                            @if(auth()->user()->role === 'super-admin')
                                <form action="{{ route('admin.bands.destroy', $band->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin mau hapus band ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-rose-500 hover:text-rose-400 font-bold text-[10px] uppercase">Hapus</button>
                                </form>
                            @else
                                <span class="text-zinc-600 text-[10px] uppercase">-</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="p-6 text-center text-zinc-500 font-bold uppercase">Belum ada data band di Scene Index.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div>
        {{ $bands->links() }}
    </div>
</div>
@endsection