@extends('layouts.main')

@section('content')
<div class="space-y-8">
    <!-- Header -->
    <div class="border-b border-zinc-800 pb-4">
        <h1 class="text-3xl font-black uppercase text-accent tracking-tight">Admin Control Center</h1>
        <p class="text-xs text-zinc-500 uppercase mt-1">Ringkasan statistik & moderasi portal INFOMUSIKCADAS</p>
    </div>

    <!-- Stat Widgets Grid (3 Kolom Utama) -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        
        <!-- Total Posts -->
        <div class="bg-zinc-900 border border-zinc-800 p-5 relative overflow-hidden group">
            <div class="text-xs text-zinc-500 font-bold uppercase tracking-wider">Total Posts / Zines</div>
            <div class="text-4xl font-black text-white mt-2">{{ $totalPosts }}</div>
            <div class="text-[10px] text-zinc-600 mt-2 uppercase font-bold">Artikel, Review & Vault</div>
            <div class="absolute -right-4 -bottom-4 text-zinc-800/20 font-black text-7xl select-none group-hover:text-accent/10 transition">POST</div>
        </div>

        <!-- Total Bands -->
        <div class="bg-zinc-900 border border-zinc-800 p-5 relative overflow-hidden group">
            <div class="text-xs text-zinc-500 font-bold uppercase tracking-wider">Scene Index / Bands</div>
            <div class="text-4xl font-black text-white mt-2">{{ $totalBands }}</div>
            <div class="text-[10px] text-zinc-600 mt-2 uppercase font-bold">Terdaftar di Database</div>
            <div class="absolute -right-4 -bottom-4 text-zinc-800/20 font-black text-7xl select-none group-hover:text-accent/10 transition">BAND</div>
        </div>

        <!-- Pending Approvals -->
        <div class="bg-zinc-900 border {{ $totalPending > 0 ? 'border-red-600/50' : 'border-zinc-800' }} p-5 relative overflow-hidden group">
            <div class="flex justify-between items-center">
                <span class="text-xs text-zinc-500 font-bold uppercase tracking-wider">Pending Moderasi</span>
                @if($totalPending > 0)
                    <span class="bg-red-600 text-white text-[9px] font-black px-2 py-0.5 animate-pulse">ACTION NEEDED</span>
                @endif
            </div>
            <div class="text-4xl font-black {{ $totalPending > 0 ? 'text-red-500' : 'text-white' }} mt-2">{{ $totalPending }}</div>
            <div class="text-[10px] text-zinc-400 mt-2 font-bold uppercase">
                {{ $pendingPosts }} Artikel &bull; {{ $pendingGigs }} Gig Radar &bull; {{ $pendingPits }} Pit Board
            </div>
            <div class="mt-3 flex flex-wrap gap-4 text-[10px] font-black uppercase">
                <a href="{{ route('admin.approvals.posts') }}" class="text-accent hover:underline">
                    Review Artikel &rarr;
                </a>
                <a href="{{ route('admin.approvals.index') }}" class="text-accent hover:underline">
                    Review Gig & Pit &rarr;
                </a>
            </div>
        </div>

    </div>

    <!-- Grid Bawah: Quick Actions & Grafik Aktivitas Scene -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        
        <!-- Quick Actions Card -->
        <div class="bg-zinc-900 border border-zinc-800 p-6 space-y-6">
            <div>
                <h3 class="text-sm font-black text-white uppercase tracking-wider border-b border-zinc-800 pb-2">Quick Actions</h3>
                <p class="text-[10px] text-zinc-500 uppercase mt-1">Jalur cepat akses kontrol menu utama</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                <a href="{{ route('admin.posts.create') }}" class="bg-zinc-950 border border-zinc-800 hover:border-accent text-zinc-300 hover:text-white font-bold text-xs uppercase p-3 text-center transition flex items-center justify-center">
                    tulis artikel baru
                </a>
                <a href="{{ route('admin.posts.index') }}" class="bg-zinc-950 border border-zinc-800 hover:border-accent text-zinc-300 hover:text-white font-bold text-xs uppercase p-3 text-center transition flex items-center justify-center">
                    edit / kelola artikel 
                </a>
                <a href="{{ route('admin.posts.index') }}" class="bg-zinc-950 border border-zinc-800 hover:border-accent text-zinc-300 hover:text-white font-bold text-xs uppercase p-3 text-center transition flex items-center justify-center">
                    Kelola Berita & Zines
                </a>
                <a href="{{ route('admin.gigs.create') }}" class="bg-zinc-950 border border-zinc-800 hover:border-accent text-zinc-300 hover:text-white font-bold text-xs uppercase p-3 text-center transition flex items-center justify-center">
                    Submit Gig Radar
                </a>
                <a href="{{ route('admin.approvals.index') }}" class="bg-zinc-950 border border-zinc-800 hover:border-accent text-zinc-300 hover:text-white font-bold text-xs uppercase p-3 text-center transition flex items-center justify-center">
                    Moderasikan Gigs
                </a>
                {{-- <a href="{{ route('admin.gigs.index') }}" class="bg-zinc-950 border border-zinc-800 hover:border-accent text-zinc-300 hover:text-white font-bold text-xs uppercase p-3 text-center transition flex items-center justify-center">
                    kelola gigs
                </a> --}}
                <a href="{{ route('admin.users.index') }}" class="bg-zinc-950 border border-zinc-800 hover:border-accent text-zinc-300 hover:text-white font-bold text-xs uppercase p-3 text-center transition flex items-center justify-center">
                    Kelola User
                </a>
                <a href="{{ route('admin.users.create') }}" class="bg-zinc-950 border border-zinc-800 hover:border-accent text-zinc-300 hover:text-white font-bold text-xs uppercase p-3 text-center transition flex items-center justify-center">
                    Tambah User
                </a>
                <a href="{{ route('admin.dashboard') }}" class="bg-zinc-950 border border-zinc-800 hover:border-accent text-zinc-300 hover:text-white font-bold text-xs uppercase p-3 text-center transition flex items-center justify-center">
                    Refresh System
                </a>
            </div>

            <!-- Panduan Singkat Admin / Kontributor -->
            <!-- Panduan Khusus Admin / SOP Singkat -->
            <div class="bg-zinc-900 border border-zinc-800 p-6 space-y-4">
                <div class="border-b border-zinc-800 pb-2">
                    <h3 class="text-sm font-black text-accent uppercase tracking-wider">🛡️ SOP & Panduan Operasional Admin</h3>
                    <p class="text-[10px] text-zinc-500 uppercase mt-1">Standar penanganan sistem & moderasi konten portal</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-xs text-zinc-300">
                    <!-- Kolom 1 -->
                    <div class="space-y-3 bg-zinc-950 p-4 border border-zinc-800">
                        <div class="font-black uppercase text-white text-[11px]">1. Moderasi Konten Publik (Gigs & Pit Board)</div>
                        <ul class="list-disc list-inside space-y-1 text-[10px] text-zinc-400">
                            <li>Cek menu <strong class="text-white">Pending Moderasi</strong> secara berkala di dashboard.</li>
                            <li>Pastikan poster gigs tidak mengandung SARA atau promosi palsu sebelum disetujui.</li>
                            <li>Gunakan tombol <strong class="text-emerald-500">Approve</strong> untuk meloloskan kiriman ke halaman publik.</li>
                        </ul>
                    </div>

                    <!-- Kolom 2 -->
                    <div class="space-y-3 bg-zinc-950 p-4 border border-zinc-800">
                        <div class="font-black uppercase text-white text-[11px]">2. Publikasi Artikel & Zines</div>
                        <ul class="list-disc list-inside space-y-1 text-[10px] text-zinc-400">
                            <li>Gunakan kategori yang sesuai (Review, News, Interview, Editorial).</li>
                            <li>Wajib lampirkan cover gambar beresolusi tajam dan link embed audio yang valid (Spotify/Bandcamp).</li>
                            <li>Manfaatkan fitur editor visual dengan benar (stabilo, link biru, bold).</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Grafik Aktivitas Scene -->
        <div class="bg-zinc-900 border border-zinc-800 p-6 flex flex-col justify-between space-y-4">
            <div>
                <h3 class="text-sm font-black text-white uppercase tracking-wider border-b border-zinc-800 pb-2">Grafik Aktivitas Scene</h3>
                <p class="text-[10px] text-zinc-500 uppercase mt-1">Statistik publikasi mingguan underground scene</p>
            </div>

            <!-- Simulating Brutalist Activity Bars / Chart Container -->
            <div class="space-y-3 py-4">
                <div>
                    <div class="flex justify-between text-[10px] font-bold text-zinc-400 uppercase mb-1">
                        <span>Review Album & Zines</span>
                        <span class="text-accent">78%</span>
                    </div>
                    <div class="w-full bg-zinc-950 h-3 border border-zinc-800 overflow-hidden">
                        <div class="bg-accent h-full w-[78%]"></div>
                    </div>
                </div>

                <div>
                    <div class="flex justify-between text-[10px] font-bold text-zinc-400 uppercase mb-1">
                        <span>Gig Radar Submissions</span>
                        <span class="text-white">54%</span>
                    </div>
                    <div class="w-full bg-zinc-950 h-3 border border-zinc-800 overflow-hidden">
                        <div class="bg-zinc-200 h-full w-[54%]"></div>
                    </div>
                </div>

                <div>
                    <div class="flex justify-between text-[10px] font-bold text-zinc-400 uppercase mb-1">
                        <span>Pit Board & Lost Items</span>
                        <span class="text-zinc-500">32%</span>
                    </div>
                    <div class="w-full bg-zinc-950 h-3 border border-zinc-800 overflow-hidden">
                        <div class="bg-zinc-700 h-full w-[32%]"></div>
                    </div>
                </div>
            </div>

            <div class="border-t border-zinc-800 pt-3 flex justify-between items-center text-[10px] text-zinc-500 font-bold uppercase">
                <span>Status Server: <span class="text-emerald-500">Online / Stable</span></span>
                <span>DB: MySQL 127.0.0.1</span>
            </div>
        </div>

    </div>
</div>
@endsection