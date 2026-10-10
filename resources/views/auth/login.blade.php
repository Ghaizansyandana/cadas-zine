@extends('layouts.main')

@section('content')
<div class="max-w-md mx-auto my-12 bg-zinc-900 border border-zinc-800 p-6 space-y-4">
    <h1 class="text-2xl font-black text-white uppercase text-center border-b border-zinc-800 pb-3">Login Redaksi</h1>

    @if($errors->any())
    <div class="bg-red-600/20 border border-red-600 text-red-500 p-2 text-xs font-bold uppercase">
        {{ $errors->first() }}
    </div>
    @endif

    <form action="{{ route('login') }}" method="POST" class="space-y-4">
        @csrf
        <div>
            <label class="block text-xs font-bold uppercase text-zinc-400 mb-1">Email</label>
            <input type="email" name="email" required class="w-full bg-zinc-950 border border-zinc-800 text-xs text-white px-3 py-2 focus:border-accent focus:outline-none">
        </div>

        <div>
            <label class="block text-xs font-bold uppercase text-zinc-400 mb-1">Password</label>
            <input type="password" name="password" required class="w-full bg-zinc-950 border border-zinc-800 text-xs text-white px-3 py-2 focus:border-accent focus:outline-none">
        </div>

        <button type="submit" class="w-full bg-accent hover:bg-zinc-800 text-white font-black text-xs uppercase py-3 transition">
            Masuk Pit Admin
        </button>
    </form>
</div>
@endsection