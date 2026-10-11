<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Default Meta Tags -->
    <title>INFOMUSIKCADAS - Portal Musik Keras</title>
    <meta name="description" content="Portal media underground, ulasan album, wawancara, dan agenda gig musik keras lokal.">

    <!-- Open Graph / Social Media Meta Tags (Dinamis dari Halaman View) -->
    @yield('og_tags')

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-zinc-950 text-zinc-100 font-sans selection:bg-red-600 selection:text-white">

    <header class="border-b border-zinc-800 bg-zinc-900/90 sticky top-0 z-50 backdrop-blur p-4">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <a href="{{ route('home') }}" class="flex items-center">
                <img 
                    src="{{ asset('images/logo.png') }}" 
                    alt="INFOMUSIKCADAS" 
                    class="h-15 w-auto object-contain hover:opacity-80 transition"
                >
                
            </a>

            <!-- Navbar Brutalist -->
            <nav class="bg-zinc-950 border-b-2 border-zinc-800 sticky top-0 z-50" x-data="{ mobileMenuOpen: false }">
                <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
                    <!-- Logo -->
                    

                    <!-- Desktop Menu -->
                    <div class="hidden md:flex items-center gap-6 text-xs font-bold uppercase text-zinc-400">
                        <a href="{{ route('home') }}" class="hover:text-white transition">Home</a>
                        <a href="{{ route('gigs') }}" class="hover:text-white transition">Gigs Radar</a>
                        <a href="{{ route('bands.index') }}" class="hover:text-white transition">Scene Index</a>
                        <a href="{{ route('pit.index') }}" class="hover:text-white transition">Pit Board</a>
                        <a href="{{ route('vault.index') }}" class="hover:text-white transition">Vault</a>
                        <a href="{{ route('zines.index') }}" class="hover:text-white transition">Zines</a>
                        <a href="{{ route('guide') }}" class="hover:text-white transition">Panduan & Rules</a>
                    </div>

                    <!-- Desktop Login/Dashboard Button -->
                    <div class="hidden md:block">
                        @auth
                            <a href="{{ route('admin.dashboard') }}" class="bg-accent text-white px-3 py-1.5 text-xs font-black uppercase">Dashboard &rarr;</a>
                        @else
                            <a href="{{ route('login') }}" class="border border-zinc-700 text-zinc-300 px-3 py-1.5 text-xs font-bold uppercase hover:bg-zinc-900">Login</a>
                        @endauth
                    </div>

                    <!-- Mobile Hamburger Button -->
                    <button @click="mobileMenuOpen = !mobileMenuOpen" class="md:hidden text-white p-2 focus:outline-none">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path x-show="!mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                            <path x-show="mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <!-- Mobile Menu Dropdown -->
                <div x-show="mobileMenuOpen" @click.away="mobileMenuOpen = false" class="md:hidden bg-zinc-900 border-b-2 border-zinc-800 px-4 pt-2 pb-6 space-y-3 text-xs font-bold uppercase">
                    <a href="{{ route('home') }}" class="block text-zinc-300 hover:text-white py-1">Home</a>
                    <a href="{{ route('gigs') }}" class="block text-zinc-300 hover:text-white py-1">Gigs Radar</a>
                    <a href="{{ route('bands.index') }}" class="block text-zinc-300 hover:text-white py-1">Scene Index</a>
                    <a href="{{ route('pit.index') }}" class="block text-zinc-300 hover:text-white py-1">Pit Board</a>
                    <a href="{{ route('vault.index') }}" class="block text-zinc-300 hover:text-white py-1">Vault</a>
                    <a href="{{ route('zines.index') }}" class="block text-zinc-300 hover:text-white py-1">Zines</a>
                    <a href="{{ route('guide') }}" class="block text-zinc-300 hover:text-white py-1">Panduan & Rules</a>
                    <div class="pt-3 border-t border-zinc-800">
                        @auth
                            <a href="{{ route('admin.dashboard') }}" class="block text-center bg-accent text-white py-2 font-black">Dashboard &rarr;</a>
                        @else
                            <a href="{{ route('login') }}" class="block text-center border border-zinc-700 text-zinc-300 py-2">Login Kontributor</a>
                        @endauth
                    </div>
                </div>
            </nav>

        </div>
    </header>

    <main class="max-w-7xl mx-auto p-6">
        @yield('content')
    </main>
<footer class="bg-zinc-950 border-t-2 border-zinc-800 mt-20 pt-10 pb-12 text-zinc-400 text-xs uppercase">
    <div class="max-w-7xl mx-auto px-4 grid grid-cols-1 md:grid-cols-4 gap-8">
        <!-- Kolom 1: About Zine -->
        <div class="space-y-3">
            <h3 class="text-white font-black text-sm tracking-wider">INFOMUSIKCADAS</h3>
            <p class="text-[11px] text-zinc-500 leading-relaxed normal-case">
                Media independen & portal arsip skena musik cadas underground. Merekam kebisingan dari Bandung untuk perlawanan global. No compromise, DIY or die.
            </p>
        </div>

        <!-- Kolom 2: Quick Links -->
        <div class="space-y-3">
            <h3 class="text-white font-black text-xs tracking-wider border-b border-zinc-800 pb-1">Navigasi Skena</h3>
            <ul class="space-y-1.5 text-[11px]">
                <li><a href="{{ route('home') }}" class="hover:text-white transition">&rarr; Beranda Utama</a></li>
                <li><a href="{{ route('gigs') }}" class="hover:text-white transition">&rarr; Gig Radar</a></li>
                <li><a href="{{ route('bands.index') }}" class="hover:text-white transition">&rarr; Scene Index</a></li>
                <li><a href="{{ route('guide') }}" class="hover:text-white transition">&rarr; Panduan & Rules</a></li>
            </ul>
        </div>

        <!-- Kolom 3: Underground Networks -->
        <div class="space-y-3">
            <h3 class="text-white font-black text-xs tracking-wider border-b border-zinc-800 pb-1">Jaringan Skena</h3>
            <ul class="space-y-1.5 text-[11px]">
                <li><a href="#" target="_blank" class="hover:text-accent transition">Instagram Infomusikcadas</a></li>
                <li><a href="#" target="_blank" class="hover:text-accent transition">Bandcamp Archive</a></li>
                <li><a href="#" target="_blank" class="hover:text-accent transition">Submission Email</a></li>
                <li><a href="{{ route('login') }}" class="text-amber-400 hover:underline font-bold">Contributor Login &rarr;</a></li>
            </ul>
        </div>

        <!-- Kolom 4: Manifesto -->
        <div class="space-y-3">
            <h3 class="text-white font-black text-xs tracking-wider border-b border-zinc-800 pb-1">Manifesto</h3>
            <p class="text-[10px] text-zinc-500 normal-case leading-relaxed">
                Segala bentuk rilisan, pamflet, dan artikel di dalam portal ini dilindungi oleh semangat kolektif pergerakan bawah tanah. Sebarkan seluas-luasnya!
            </p>
        </div>
    </div>

    <!-- Copyright Bar -->
    <div class="max-w-7xl mx-auto px-4 mt-10 pt-6 border-t border-zinc-900 flex flex-col sm:flex-row justify-between items-center text-[10px] text-zinc-600 font-mono">
        <div>&copy; 2026 INFOMUSIKCADAS. ALL RIGHTS RESERVED.</div>
        <div class="mt-2 sm:mt-0 text-zinc-500">CRAFTED WITH BRUTALIST & DIY ETHOS</div>
    </div>
</footer>

</body>
</html>