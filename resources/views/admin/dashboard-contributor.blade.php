@extends('layouts.main')

@section('content')
<div class="space-y-6">
    <div class="border-b border-zinc-800 pb-4 flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-black uppercase text-accent tracking-tight">Dashboard Kontributor</h1>
            <p class="text-xs text-zinc-500 uppercase mt-1">Area tulis & pantau status artikel kiriman lu</p>
        </div>
        <div class="flex flex-wrap gap-2">
            <a href="{{ route('admin.posts.create') }}" class="bg-accent hover:bg-zinc-800 text-white font-black text-xs uppercase px-4 py-2 transition">
                + Tulis Artikel
            </a>
            <a href="{{ route('admin.gigs.create') }}" class="border border-zinc-700 bg-zinc-900 hover:border-accent text-white font-black text-xs uppercase px-4 py-2 transition">
                + Kirim Info Gig
            </a>
        </div>
    </div>
    
    <!-- Panduan Khusus Kontributor / Editor -->
    <div class="bg-zinc-900 border border-zinc-800 p-6 space-y-4">
        <div class="border-b border-zinc-800 pb-2">
            <h3 class="text-sm font-black text-accent uppercase tracking-wider">✍️ Panduan & Alur Kirim Artikel Kontributor</h3>
            <p class="text-[10px] text-zinc-500 uppercase mt-1">Standar penulisan & aturan main publikasi zines underground</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-xs text-zinc-300">
            <!-- Kolom 1: Alur Artikel -->
            <div class="space-y-3 bg-zinc-950 p-4 border border-zinc-800">
                <div class="font-black uppercase text-white text-[11px]">1. Alur Publikasi Tulisan</div>
                <ul class="list-disc list-inside space-y-1 text-[10px] text-zinc-400">
                    <li>Artikel yang baru lu buat otomatis berstatus <strong class="text-yellow-500">Pending Review</strong>.</li>
                    <li>Super Admin bakal nge-cek isi tulisan lu (pastikan sesuai skena & gak ngawur).</li>
                    <li>Kalau udah di-approve, statusnya berubah jadi <strong class="text-emerald-500">Published</strong> dan otomatis naik ke beranda utama!</li>
                </ul>
            </div>

            <!-- Kolom 2: Tips Editor Quill -->
            <div class="space-y-3 bg-zinc-950 p-4 border border-zinc-800">
                <div class="font-black uppercase text-white text-[11px]">2. Tips Pakai Editor Teks</div>
                <ul class="list-disc list-inside space-y-1 text-[10px] text-zinc-400">
                    <li><strong class="text-white">Stabilo Teks:</strong> Pilih warna stabilo. Untuk <span class="text-accent">mematikan stabilo</span> saat mau lanjut ngetik, klik kotak putih di ujung kanan palet atau klik ikon <strong class="text-white">Tₓ</strong>.</li>
                    <li><strong class="text-white">Format & Link:</strong> Gunakan bold/italic seperlunya buat penekanan, dan sematkan link dari sumber valid.</li>
                    <li>Wajib sertakan cover gambar yang proper dan enak dilihat.</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
        <div class="border border-zinc-800 bg-zinc-900 p-5">
            <p class="text-xs font-bold uppercase tracking-wider text-zinc-500">Total Artikel</p>
            <p class="mt-2 text-4xl font-black text-white">{{ $myTotalPosts }}</p>
            <p class="mt-2 text-[10px] font-bold uppercase text-zinc-600">Semua artikel kiriman lu</p>
        </div>

        <div class="border border-yellow-900 bg-zinc-900 p-5">
            <p class="text-xs font-bold uppercase tracking-wider text-yellow-500">Menunggu Review</p>
            <p class="mt-2 text-4xl font-black text-yellow-400">{{ $myPendingPosts }}</p>
            <p class="mt-2 text-[10px] font-bold uppercase text-zinc-600">Belum disetujui redaksi</p>
        </div>

        <div class="border border-emerald-900 bg-zinc-900 p-5">
            <p class="text-xs font-bold uppercase tracking-wider text-emerald-500">Disetujui</p>
            <p class="mt-2 text-4xl font-black text-emerald-400">{{ $myApprovedPosts }}</p>
            <p class="mt-2 text-[10px] font-bold uppercase text-zinc-600">Lolos proses review</p>
        </div>
    </div>

    <!-- List Artikel Sendiri -->
    <div class="bg-zinc-900 border border-zinc-800 p-6 space-y-4">
        <h3 class="text-sm font-black text-white uppercase border-b border-zinc-800 pb-2">Draf & Artikel Kiriman Lu</h3>

        <div class="space-y-3">
            @forelse($myPosts as $post)
                <div class="bg-zinc-950 border border-zinc-800 p-4 flex flex-col gap-3 sm:flex-row sm:justify-between sm:items-center">
                    <div class="min-w-0">
                        <h4 class="text-xs font-bold text-white uppercase">{{ $post->title }}</h4>
                        <span class="text-[10px] text-zinc-500 uppercase">{{ $post->category }} &bull; Dibuat: {{ $post->created_at->diffForHumans() }}</span>
                    </div>
                    <div class="shrink-0">
                        @if($post->is_approved)
                            <span class="bg-emerald-950 text-emerald-400 text-[10px] font-black px-2 py-1 uppercase border border-emerald-800">Published</span>
                        @else
                            <span class="bg-yellow-950 text-yellow-400 text-[10px] font-black px-2 py-1 uppercase border border-yellow-800">Pending Review</span>
                        @endif
                    </div>
                </div>
            @empty
                <div class="text-center py-6 text-zinc-500 text-xs uppercase font-bold">
                    Lu belom pernah nulis artikel, cuy. Sikat bikin satu!
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection