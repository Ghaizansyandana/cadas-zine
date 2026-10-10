@extends('layouts.main')

@section('content')
<div class="space-y-8">
    <div class="border-b border-zinc-800 pb-4">
        <h1 class="text-3xl font-black uppercase text-accent tracking-tight">Moderasi Publik</h1>
        <p class="text-xs text-zinc-500 uppercase mt-1">Review Submit Gig & Pit Board Sebelum Tampil di Web</p>
    </div>

    @if(session('success'))
    <div class="bg-zinc-900 border border-accent text-accent p-3 text-xs font-bold uppercase">
        {{ session('success') }}
    </div>
    @endif

    <!-- Pending Gigs -->
    <div class="space-y-4">
        <h2 class="text-xl font-black uppercase text-white border-l-4 border-accent pl-2">Pending Gigs Radar ({{ $pendingGigs->count() }})</h2>
        <div class="bg-zinc-900 border border-zinc-800 overflow-x-auto">
            <table class="w-full text-left text-xs uppercase">
                <thead class="bg-zinc-950 text-zinc-400 border-b border-zinc-800">
                    <tr>
                        <th class="p-3">Nama Event</th>
                        <th class="p-3">Kota / Venue</th>
                        <th class="p-3">HTM</th>
                        <th class="p-3 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-800 text-zinc-300 font-bold">
                    @forelse($pendingGigs as $gig)
                    <tr class="hover:bg-zinc-800/50 transition">
                        <td class="p-3 text-white font-black">{{ $gig->title }}</td>
                        <td class="p-3">{{ $gig->city }} @ {{ $gig->venue }}</td>
                        <td class="p-3 text-accent">{{ $gig->ticket_price }}</td>
                        <td class="p-3 text-right space-x-2">
                            <form action="{{ route('admin.approvals.gigs.approve', $gig->id) }}" method="POST" class="inline">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="bg-accent text-white px-3 py-1 font-black text-[10px]">Approve</button>
                            </form>
                            <form action="{{ route('admin.approvals.gigs.reject', $gig->id) }}" method="POST" class="inline" onsubmit="return confirm('Tolak gig ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-zinc-800 text-red-500 px-3 py-1 font-black text-[10px]">Tolak</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="p-4 text-center text-zinc-500">Antrean gig bersih dari spam.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pending Pit Board -->
    <div class="space-y-4">
        <h2 class="text-xl font-black uppercase text-white border-l-4 border-accent pl-2">Pending Pit Board ({{ $pendingPits->count() }})</h2>
        <div class="bg-zinc-900 border border-zinc-800 overflow-x-auto">
            <table class="w-full text-left text-xs uppercase">
                <thead class="bg-zinc-950 text-zinc-400 border-b border-zinc-800">
                    <tr>
                        <th class="p-3">Barang / Tipe</th>
                        <th class="p-3">Gig / Kota</th>
                        <th class="p-3">Kontak</th>
                        <th class="p-3 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-800 text-zinc-300 font-bold">
                    @forelse($pendingPits as $pit)
                    <tr class="hover:bg-zinc-800/50 transition">
                        <td class="p-3 text-white font-black">
                            <span class="{{ $pit->type === 'lost' ? 'text-red-500' : 'text-green-500' }}">[{{ strtoupper($pit->type) }}]</span>
                            {{ $pit->item_name }}
                        </td>
                        <td class="p-3">{{ $pit->gig_name }} ({{ $pit->city }})</td>
                        <td class="p-3 text-zinc-400">{{ $pit->contact_person }}</td>
                        <td class="p-3 text-right space-x-2">
                            <form action="{{ route('admin.approvals.pits.approve', $pit->id) }}" method="POST" class="inline">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="bg-accent text-white px-3 py-1 font-black text-[10px]">Approve</button>
                            </form>
                            <form action="{{ route('admin.approvals.pits.reject', $pit->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus laporan ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-zinc-800 text-red-500 px-3 py-1 font-black text-[10px]">Tolak</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="p-4 text-center text-zinc-500">Antrean laporan pit kosong.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection