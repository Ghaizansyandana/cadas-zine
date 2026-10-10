@extends('layouts.main')

@section('content')
<div x-data="{ openForm: false }" class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center border-b border-zinc-800 pb-4 gap-4">
        <div>
            <h1 class="text-3xl font-black uppercase text-accent tracking-tight">Lost & Found at The Pit</h1>
            <p class="text-xs text-zinc-500 uppercase mt-1">Lapak Barang Hilang / Nemu Pas Moshpit Berantakan</p>
        </div>

        <button @click="openForm = !openForm" class="bg-accent hover:bg-zinc-800 text-white font-black text-xs uppercase px-4 py-2 transition">
            + Buat Laporan Baru
        </button>
    </div>

    @if(session('success'))
    <div class="bg-zinc-900 border border-accent text-accent p-3 text-xs font-bold uppercase">
        {{ session('success') }}
    </div>
    @endif

    <!-- Form Modal / Toggle Form -->
    <div x-show="openForm" x-transition class="bg-zinc-900 border border-zinc-800 p-6 space-y-4">
        <h2 class="text-xl font-black text-white uppercase border-b border-zinc-800 pb-2">Form Laporan Pit</h2>
        <form action="{{ route('pit.store') }}" method="POST" class="space-y-4">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold uppercase text-zinc-400 mb-1">Nama Barang</label>
                    <input type="text" name="item_name" placeholder="Contoh: Kacamata Minus / Kaset" required class="w-full bg-zinc-950 border border-zinc-800 text-xs text-white px-3 py-2 uppercase focus:border-accent focus:outline-none">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-zinc-400 mb-1">Tipe Laporan</label>
                    <select name="type" class="w-full bg-zinc-950 border border-zinc-800 text-xs text-white px-3 py-2 uppercase focus:border-accent focus:outline-none">
                        <option value="lost">BARANG HILANG (LOST)</option>
                        <option value="found">BARANG NEMU (FOUND)</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold uppercase text-zinc-400 mb-1">Nama Gig / Event</label>
                    <input type="text" name="gig_name" required class="w-full bg-zinc-950 border border-zinc-800 text-xs text-white px-3 py-2 uppercase focus:border-accent focus:outline-none">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-zinc-400 mb-1">Kota</label>
                    <input type="text" name="city" required class="w-full bg-zinc-950 border border-zinc-800 text-xs text-white px-3 py-2 uppercase focus:border-accent focus:outline-none">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold uppercase text-zinc-400 mb-1">Kontak Person (WA / IG)</label>
                <input type="text" name="contact_person" placeholder="@username_ig / 0812xxx" required class="w-full bg-zinc-950 border border-zinc-800 text-xs text-white px-3 py-2 uppercase focus:border-accent focus:outline-none">
            </div>

            <div>
                <label class="block text-xs font-bold uppercase text-zinc-400 mb-1">Keterangan Tambahan</label>
                <textarea name="description" rows="3" class="w-full bg-zinc-950 border border-zinc-800 text-xs text-white px-3 py-2 focus:border-accent focus:outline-none"></textarea>
            </div>

            <button type="submit" class="bg-accent text-white font-black text-xs uppercase px-6 py-3 transition w-full">
                Terbitkan Laporan
            </button>
        </form>
    </div>

    <!-- Items Grid -->
    <div class="grid sm:grid-cols-2 md:grid-cols-3 gap-6">
        @forelse($items as $item)
        <div class="bg-zinc-900 border border-zinc-800 p-5 space-y-3 hover:border-accent transition flex flex-col justify-between">
            <div class="space-y-2">
                <div class="flex justify-between items-center text-[10px] font-black uppercase">
                    <span class="{{ $item->type === 'lost' ? 'bg-red-600' : 'bg-green-600' }} text-white px-2 py-0.5 tracking-wider">
                        {{ $item->type === 'lost' ? 'LOST / HILANG' : 'FOUND / NEMU' }}
                    </span>
                    <span class="text-zinc-500">📍 {{ $item->city }}</span>
                </div>

                <h3 class="text-xl font-black text-white uppercase leading-snug pt-1">{{ $item->item_name }}</h3>
                <p class="text-xs font-bold text-accent uppercase">Event: {{ $item->gig_name }}</p>
                <p class="text-xs text-zinc-400 leading-relaxed">{{ $item->description }}</p>
            </div>

            <div class="pt-3 border-t border-zinc-800 text-xs font-bold uppercase">
                <span class="text-zinc-500 text-[10px] block">Kontak:</span>
                <span class="text-white">{{ $item->contact_person }}</span>
            </div>
        </div>
        @empty
        <p class="text-xs text-zinc-500 uppercase col-span-3 py-8 text-center border border-dashed border-zinc-800">
            Belum ada laporan barang hilang atau nemu.
        </p>
        @endforelse
    </div>
</div>
@endsection