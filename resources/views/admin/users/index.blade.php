@extends('layouts.main')

@section('content')
<div class="space-y-6">
    <!-- Header + Tombol Tambah User -->
    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4 border-b border-zinc-800 pb-4">
        <div>
            <h1 class="text-2xl font-black uppercase text-accent tracking-tight">Manajemen User & Skena Role</h1>
            <p class="text-xs text-zinc-500 uppercase mt-1">Atur hak akses akun kontributor, editor, dan super admin</p>
        </div>
        <a href="{{ route('admin.users.create') }}" class="bg-accent hover:bg-zinc-800 text-white font-black text-xs uppercase px-4 py-2 transition text-center">
            + Tambah User Baru
        </a>
    </div>

    @if(session('success'))
        <div class="bg-emerald-950/80 border border-emerald-800 text-emerald-400 text-xs p-3 font-bold uppercase">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="bg-rose-950/80 border border-rose-800 text-rose-400 text-xs p-3 font-bold uppercase">
            {{ $errors->first() }}
        </div>
    @endif

    <div class="bg-zinc-900 border border-zinc-800 overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="border-b border-zinc-800 text-[10px] uppercase text-zinc-500 bg-zinc-950">
                    <th class="p-3">Nama</th>
                    <th class="p-3">Email</th>
                    <th class="p-3">Role Saat Ini</th>
                    <th class="p-3">Ubah Role</th>
                    <th class="p-3 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-zinc-800 text-xs">
                @foreach($users as $user)
                    <tr class="hover:bg-zinc-950/50">
                        <td class="p-3 font-black text-white uppercase">{{ $user->name }}</td>
                        <td class="p-3 text-zinc-400">{{ $user->email }}</td>
                        <td class="p-3">
                            <span class="px-2 py-0.5 text-[9px] font-black uppercase 
                                @if($user->role === 'super-admin') bg-rose-900 text-rose-200 
                                @elseif($user->role === 'editor') bg-amber-900 text-amber-200 
                                @else bg-zinc-800 text-zinc-300 @endif">
                                {{ $user->role ?? 'contributor' }}
                            </span>
                        </td>
                        <td class="p-3">
                            <form action="{{ route('admin.users.updateRole', $user->id) }}" method="POST" class="flex gap-2 items-center">
                                @csrf
                                @method('PATCH')
                                <select name="role" class="bg-zinc-950 border border-zinc-800 text-[11px] text-white p-1.5 outline-none focus:border-accent">
                                    <option value="super-admin" {{ $user->role === 'super-admin' ? 'selected' : '' }}>Super Admin</option>
                                    <option value="editor" {{ $user->role === 'editor' ? 'selected' : '' }}>Editor</option>
                                    <option value="contributor" {{ $user->role === 'contributor' ? 'selected' : '' }}>Contributor</option>
                                </select>
                                <button type="submit" class="bg-zinc-800 hover:bg-zinc-700 text-white text-[10px] px-2 py-1.5 font-bold uppercase">Update</button>
                            </form>
                        </td>
                        <td class="p-3 text-right">
                            @if($user->id !== auth()->id())
                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin mau hapus user ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-rose-500 hover:text-rose-400 font-bold text-[10px] uppercase">Hapus</button>
                                </form>
                            @else
                                <span class="text-zinc-600 text-[10px] uppercase font-mono">Lu Sendiri</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div>
        {{ $users->links() }}
    </div>
</div>
@endsection