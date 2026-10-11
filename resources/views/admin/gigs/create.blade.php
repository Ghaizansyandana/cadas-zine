@extends('layouts.main')

@section('content')
<div class="max-w-xl mx-auto space-y-6">
    <div class="border-b border-zinc-800 pb-4">
        <h1 class="text-2xl font-black uppercase text-accent">Submit Gig Radar</h1>
        <p class="text-xs text-zinc-500 uppercase mt-1">Kirim pamflet & info acara ke database INFOMUSIKCADAS</p>
    </div>

    <form action="{{ route('admin.gigs.store') }}" method="POST" enctype="multipart/form-data" class="bg-zinc-900 border border-zinc-800 p-6 space-y-4">
        @csrf
        <div>
            <label class="block text-xs font-bold uppercase text-zinc-400 mb-1">Nama Acara / Gig</label>
            <input type="text" name="event_name" required class="w-full bg-zinc-950 border border-zinc-800 p-3 text-sm text-white focus:border-accent outline-none">
        </div>

        <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
            <div>
                <label class="block text-xs font-bold uppercase text-zinc-400 mb-1">Tanggal Acara</label>
                <input type="date" name="event_date" required class="w-full bg-zinc-950 border border-zinc-800 p-3 text-sm text-white focus:border-accent outline-none">
            </div>
            <div>
                <label class="block text-xs font-bold uppercase text-zinc-400 mb-1">Kota</label>
                <input type="text" name="city" required placeholder="Contoh: Bandung" class="w-full bg-zinc-950 border border-zinc-800 p-3 text-sm text-white focus:border-accent outline-none">
            </div>
            <div>
                <label class="block text-xs font-bold uppercase text-zinc-400 mb-1">Venue</label>
                <input type="text" name="venue" required placeholder="Nama tempat acara" class="w-full bg-zinc-950 border border-zinc-800 p-3 text-sm text-white focus:border-accent outline-none">
            </div>
        </div>

        <div>
            <label class="block text-xs font-bold uppercase text-zinc-400 mb-1">Harga Tiket</label>
            <input type="text" name="ticket_price" placeholder="Contoh: Rp 50.000 / Free" class="w-full bg-zinc-950 border border-zinc-800 p-3 text-sm text-white focus:border-accent outline-none">
        </div>

        <div>
            <label class="block text-xs font-bold uppercase text-zinc-400 mb-1">Upload Flyer / Poster</label>
            <input type="file" name="flyer" required accept="image/*" class="w-full bg-zinc-950 border border-zinc-800 p-2 text-xs text-zinc-400">
        </div>

        <button type="submit" class="w-full bg-accent hover:bg-zinc-800 text-white font-black text-xs uppercase py-3 transition">
            Submit Ke Gig Radar &rarr;
        </button>
    </form>
</div>
@endsection