@extends('layouts.main')

@section('content')
<div class="max-w-md mx-auto bg-zinc-900 border border-zinc-800 p-6 space-y-6">
    <div class="flex justify-between items-center border-b border-zinc-800 pb-4">
        <div>
            <h1 class="text-xl font-black uppercase text-accent tracking-tight">Tambah User Baru</h1>
            <p class="text-xs text-zinc-500 uppercase mt-0.5">Bikin akun internal dari admin panel</p>
        </div>
        <a href="{{ route('admin.users.index') }}" class="text-xs font-bold text-zinc-500 hover:text-white uppercase">← Kembali</a>
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

    <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-4">
        @csrf
        <div>
            <label class="block text-xs font-bold uppercase text-zinc-400 mb-1">Nama</label>
            <input type="text" name="name" value="{{ old('name') }}" required class="w-full bg-zinc-950 border border-zinc-800 p-3 text-xs text-white outline-none focus:border-accent">
        </div>

        <div>
            <label class="block text-xs font-bold uppercase text-zinc-400 mb-1">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" required class="w-full bg-zinc-950 border border-zinc-800 p-3 text-xs text-white outline-none focus:border-accent">
        </div>

        <div>
            <label class="block text-xs font-bold uppercase text-zinc-400 mb-1">Password</label>
            <input type="password" name="password" required class="w-full bg-zinc-950 border border-zinc-800 p-3 text-xs text-white outline-none focus:border-accent">
        </div>

        <div>
            <label class="block text-xs font-bold uppercase text-zinc-400 mb-1">Role Skena</label>
            <select name="role" required class="w-full bg-zinc-950 border border-zinc-800 p-3 text-xs text-white outline-none focus:border-accent">
                <option value="contributor">Contributor</option>
                <option value="editor">Editor</option>
                <option value="super-admin">Super Admin</option>
            </select>
        </div>

        <button type="submit" class="w-full bg-accent hover:bg-zinc-800 text-white font-black text-xs uppercase py-3 transition">
            Simpan User Baru &rarr;
        </button>
    </form>
</div>
@endsection