@extends('layouts.main')

@section('content')
<div class="max-w-4xl mx-auto space-y-10 pb-16">
    <!-- Header Utama -->
    <div class="border-b-4 border-white pb-6 pt-4">
        <span class="bg-accent text-white font-black text-[10px] uppercase px-2 py-1 tracking-widest">Documentation & Rules</span>
        <h1 class="text-3xl md:text-5xl font-black uppercase tracking-tighter text-white mt-2">PANDUAN & BANTUAN INFOMUSIKCADAS</h1>
        <p class="text-xs text-zinc-400 uppercase mt-1 tracking-wider">Aturan main portal, alur kontribusi, & panduan akses khusus Editor/Kontributor</p>
    </div>

    <!-- Section 1: Aturan Umum Skena -->
    <div class="bg-zinc-900 border border-zinc-800 p-6 space-y-4">
        <h2 class="text-lg font-black text-white uppercase border-b border-zinc-800 pb-2">🌐 1. Penggunaan Umum Portal</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-xs text-zinc-400">
            <div class="space-y-1">
                <h3 class="font-bold text-white uppercase text-[11px]">⚡ Gig Radar & Pit Board</h3>
                <p>Siapa aja bisa kirim pamflet gig atau laporan barang hilang/ketemu di pit. Semua kiriman umum wajib lewat proses kurasi admin sebelum terbit.</p>
            </div>
            <div class="space-y-1">
                <h3 class="font-bold text-white uppercase text-[11px]">💀 Scene Index (Band Database)</h3>
                <p>Direktori terbuka untuk memetakan band underground lokal. Band harus punya karya rilisan resmi atau rekam jejak panggung yang jelas.</p>
            </div>
        </div>
    </div>

    <!-- Section 2: Advanced Access (Panduan Khusus Editor / Contributor) -->
    <div class="bg-zinc-900 border-2 border-accent p-6 space-y-6">
        <div class="border-b border-zinc-800 pb-3 flex justify-between items-center">
            <div>
                <span class="bg-amber-500 text-black font-black text-[9px] uppercase px-2 py-0.5">Advanced Access</span>
                <h2 class="text-xl font-black text-white uppercase mt-1">✒️ 2. Panduan Akses Khusus Editor & Kontributor</h2>
            </div>
            <span class="text-xs font-mono text-zinc-500">ROLE: EDITOR / CONTRIBUTOR</span>
        </div>

        <div class="space-y-4 text-xs text-zinc-300">
            <!-- Akses & Hak Akses -->
            <div class="bg-zinc-950 p-4 border border-zinc-800 space-y-2">
                <h3 class="font-black text-accent uppercase text-xs">A. Hak Akses & Kewenangan Editor</h3>
                <ul class="list-disc list-inside space-y-1 text-zinc-400 text-[11px]">
                    <li>Editor punya akses ke <strong class="text-white">Contributor Desk</strong> via portal login (`/login`).</li>
                    <li>Editor dapat menulis, mengedit, dan mengelola draf tulisan milik sendiri.</li>
                    <li>Editor <strong class="text-amber-400">tidak bisa</strong> langsung mempublikasikan tulisan ke halaman depan secara mandiri (wajib approval Super Admin).</li>
                    <li>Editor dapat memantau status tulisan: <span class="text-yellow-500 font-bold">Pending Review</span> atau <span class="text-emerald-400 font-bold">Published</span>.</li>
                </ul>
            </div>

            <!-- Standar Penulisan Quill Editor -->
            <div class="bg-zinc-950 p-4 border border-zinc-800 space-y-2">
                <h3 class="font-black text-accent uppercase text-xs">B. Panduan Format & Rich-Text Editor (Quill.js)</h3>
                <ul class="list-disc list-inside space-y-1 text-zinc-400 text-[11px]">
                    <li><strong class="text-white">Judul & Excerpt:</strong> Gunakan judul yang tajam, provokatif, dan tidak misleading. Excerpt wajib diisi singkat (max 150 karakter).</li>
                    <li><strong class="text-white">Fitur Stabilo / Highlight Text:</strong> Gunakan warna stabilo untuk kutipan penting atau lirik. <span class="text-amber-400">Untuk mematikan warna stabilo</span> agar bisa ngetik normal lagi, klik ikon kotak putih/ujung kanan di palet warna atau tekan tombol reset formatting (<strong class="text-white">Tₓ</strong>).</li>
                    <li><strong class="text-white">Gambar Cover:</strong> Rasio minimal 16:9, format JPG/PNG/WEBP, maksimal ukuran 2MB. Gambar resolusi rendah bakal ditolak Super Admin.</li>
                </ul>
            </div>

            <!-- Etika Content -->
            <div class="bg-zinc-950 p-4 border border-zinc-800 space-y-2">
                <h3 class="font-black text-accent uppercase text-xs">C. Kode Etik Penulisan Zine Underground</h3>
                <p class="text-zinc-400 text-[11px]">Dilarang keras menyebarkan ujaran kebencian berunsur SARA, persekusi personal tanpa bukti, fitnah, atau konten komersial sponsor berselubung tanpa izin editorial.</p>
            </div>
        </div>
    </div>

    <!-- Section 3: FAQ / Helpdesk -->
    <div class="bg-zinc-900 border border-zinc-800 p-6 space-y-4">
        <h2 class="text-lg font-black text-white uppercase border-b border-zinc-800 pb-2">❓ 3. Frequently Asked Questions (FAQ)</h2>
        <div class="space-y-3 text-xs">
            <div>
                <h4 class="font-bold text-white uppercase">Q: Berapa lama proses review artikel kontributor?</h4>
                <p class="text-zinc-400 text-[11px]">A: Maksimal 1x24 jam. Kalau lewat dari itu, kontak Super Admin via channel resmi infomusikcadas.</p>
            </div>
            <div>
                <h4 class="font-bold text-white uppercase">Q: Gimana cara upgrade akun jadi Editor/Kontributor?</h4>
                <p class="text-zinc-400 text-[11px]">A: Kirim portofolio tulisan atau contoh zine lokal yang pernah lu bikin ke email redaksi untuk dikasih hak akses khusus dari Super Admin.</p>
            </div>
        </div>
    </div>
</div>
@endsection