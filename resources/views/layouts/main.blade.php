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
            <nav class="space-x-4 text-xs font-bold uppercase tracking-wider">
                <a href="{{ route('home') }}" class="hover:text-accent transition">Home</a>
                <a href="{{ route('gigs.index') }}" class="hover:text-accent transition">Gigs Radar</a>
                <a href="{{ route('bands.index') }}" class="hover:text-accent transition">Scene Index</a>
                <a href="{{ route('pit.index') }}" class="hover:text-accent transition">Pit Board</a>
                <a href="{{ route('vault.index') }}" class="hover:text-accent transition">Vault</a>
                <a href="{{ route('zines.index') }}" class="hover:text-accent transition">Zines</a>
            </nav>
        </div>
    </header>

    <main class="max-w-7xl mx-auto p-6">
        @yield('content')
    </main>

    <footer class="border-t border-zinc-800 bg-zinc-900 py-6 text-center text-xs text-zinc-500 font-bold uppercase mt-12">
        <p>&copy; {{ date('Y') }} INFOMUSIKCADAS. ALL RIGHTS RESERVED. BY CRUSHCODESTUDIO</p>
    </footer>

</body>
</html>