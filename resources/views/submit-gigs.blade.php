@extends('layouts.main')

@section('content')
<div class="max-w-xl mx-auto space-y-6 my-6">
    <div class="border-b border-zinc-800 pb-4">
        <h1 class="text-2xl font-black uppercase text-red-600">Submit Gig / Event Flyer</h1>
        <p class="text-xs text-zinc-500 uppercase mt-1">Kirim info gig kolektif atau show band kamu di sini.</p>
    </div>

    @if(session('success'))
    <div class="bg-red-950 border border-red-600 text-red-200 p-3 text-xs font-bold uppercase">
        {{ session('success') }}
    </div>
    @endif

    <form action="{{ route('gigs.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4 bg-zinc-900 p-6 border border-zinc-800">
        @csrf
        <div>
            <label class="block text-xs font-bold uppercase text-zinc-400 mb-1">Nama Event / Show</label>
            <input type="text" name="title" required class="w-full bg-zinc-950 border border-zinc-800 text-sm text-white px-3 py-2 focus:border-red-600 focus:outline-none">
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-bold uppercase text-zinc-400 mb-1">Kota</label>
                <input type="text" name="city" placeholder="Contoh: Bandung" required class="w-full bg-zinc-950 border border-zinc-800 text-sm text-white px-3 py-2 focus:border-red-600 focus:outline-none">
            </div>
            <div>
                <label class="block text-xs font-bold uppercase text-zinc-400 mb-1">HTM / Tiket</label>
                <input type="text" name="ticket_price" placeholder="Contoh: 35K / Free" required class="w-full bg-zinc-950 border border-zinc-800 text-sm text-white px-3 py-2 focus:border-red-600 focus:outline-none">
            </div>
        </div>

        <div>
            <label class="block text-xs font-bold uppercase text-zinc-400 mb-1">Venue / Lokasi</label>
            <input type="text" name="venue" required class="w-full bg-zinc-950 border border-zinc-800 text-sm text-white px-3 py-2 focus:border-red-600 focus:outline-none">
        </div>

        <div>
            <label class="block text-xs font-bold uppercase text-zinc-400 mb-1">Tanggal & Waktu</label>
            <input type="datetime-local" name="event_date" required class="w-full bg-zinc-950 border border-zinc-800 text-sm text-white px-3 py-2 focus:border-red-600 focus:outline-none">
        </div>

        <div>
            <label class="block text-xs font-bold uppercase text-zinc-400 mb-1">Upload Flyer / Poster Event</label>
            <input type="file" name="poster_image" accept="image/*" class="w-full bg-zinc-950 border border-zinc-800 text-xs text-zinc-400 px-3 py-2 focus:border-red-600 focus:outline-none file:mr-4 file:py-1 file:px-2 file:border-0 file:text-xs file:font-bold file:bg-red-600 file:text-white uppercase">
        </div>

        <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white font-black text-xs uppercase tracking-widest py-3 transition">
            Kirim Info Gig
        </button>
    </form>
</div>
@endsection