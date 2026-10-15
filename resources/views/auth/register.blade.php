@extends('layouts.main')

@section('content')
<div class="max-w-md mx-auto bg-zinc-900 border border-zinc-800 p-8 space-y-6 my-12">
    <div>
        <span class="bg-accent text-white text-[9px] font-black uppercase px-2 py-0.5">Join The Movement</span>
        <h1 class="text-2xl font-black uppercase text-white mt-1 tracking-tight">Daftar Akun Kontributor</h1>
        <p class="text-xs text-zinc-500 uppercase mt-0.5">Bikin akun buat kirim artikel & pamflet gig</p>
    </div>

    @if ($errors->any())
        <div class="bg-rose-950/80 border border-rose-800 text-rose-400 text-xs p-3 font-bold uppercase">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>- {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('register.store') }}" method="POST" class="space-y-4">
        @csrf
        <div>
            <label class="block text-xs font-bold uppercase text-zinc-400 mb-1">Nama / Panggilan Skena</label>
            <input type="text" name="name" value="{{ old('name') }}" required class="w-full bg-zinc-950 border border-zinc-800 p-3 text-xs text-white outline-none focus:border-accent">
        </div>

        <div>
            <label class="block text-xs font-bold uppercase text-zinc-400 mb-1">Email Aktif</label>
            <input type="email" name="email" value="{{ old('email') }}" required class="w-full bg-zinc-950 border border-zinc-800 p-3 text-xs text-white outline-none focus:border-accent">
        </div>

        <div>
            <label class="block text-xs font-bold uppercase text-zinc-400 mb-1">Password</label>
            <input type="password" name="password" required class="w-full bg-zinc-950 border border-zinc-800 p-3 text-xs text-white outline-none focus:border-accent">
        </div>

        <div>
            <label class="block text-xs font-bold uppercase text-zinc-400 mb-1">Konfirmasi Password</label>
            <input type="password" name="password_confirmation" required class="w-full bg-zinc-950 border border-zinc-800 p-3 text-xs text-white outline-none focus:border-accent">
        </div>

        <button type="submit" class="w-full bg-accent hover:bg-zinc-800 text-white font-black text-xs uppercase py-3 transition">
            Daftar Sekarang &rarr;
        </button>
    </form>

    <div class="text-center pt-2 border-t border-zinc-800 text-xs text-zinc-500">
        Udah punya akun? <a href="{{ route('login') }}" class="text-white font-bold hover:underline">Masuk di sini</a>
    </div>
</div>
@endsection