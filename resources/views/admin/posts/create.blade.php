@extends('layouts.main')

@section('content')
<!-- Quill CSS & JS -->
<link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>

<div class="max-w-3xl mx-auto space-y-6">
    
    <div class="flex justify-between items-center border-b border-zinc-800 pb-4">
        <h1 class="text-2xl font-black uppercase text-accent tracking-tight">Tulis Artikel Baru</h1>
        <a href="{{ route('admin.posts.index') }}" class="text-xs font-bold text-zinc-500 hover:text-white uppercase">← Batal</a>
    </div>

    <form id="post-form" action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data" class="bg-zinc-900 border border-zinc-800 p-6 space-y-4">
        @csrf
        <!-- Panduan Singkat Buat Kontributor -->
        <div class="bg-zinc-950 border border-zinc-800 p-4 text-xs text-zinc-400 space-y-2">
            <div class="font-black uppercase text-accent tracking-wider">💡 Panduan Cepat Format Artikel:</div>
            <ul class="list-disc list-inside space-y-1 text-[11px]">
                <li><strong class="text-white">Bold / Italic / Coret:</strong> Blok teks, lalu klik ikon <strong class="text-white">B</strong>, <strong class="text-white">I</strong>, atau <strong class="text-white">S</strong> di atas.</li>
                <li><strong class="text-white">Stabilo Teks:</strong> Klik ikon kotak warna, pilih warna stabilo. Untuk <span class="text-accent font-bold">mematikan stabilo</span> saat mau lanjut ngetik, klik kotak putih di ujung kanan palet warna atau klik ikon <strong class="text-white">Tₓ</strong>.</li>
                <li><strong class="text-white">Link (Tulisan Biru):</strong> Blok teks, klik ikon rantai (link), lalu masukkan URL tujuan.</li>
                <li><strong class="text-white">Reset Format:</strong> Kalau teks berantakan formatnya, blok teks tersebut lalu klik ikon <strong class="text-white">Tₓ</strong> (Clear Formatting) di ujung kanan toolbar.</li>
            </ul>
        </div>
        <div>
            <label class="block text-xs font-bold uppercase text-zinc-400 mb-1">Judul Artikel</label>
            <input type="text" name="title" value="{{ old('title') }}" required class="w-full bg-zinc-950 border border-zinc-800 text-xs font-bold text-white px-3 py-2 uppercase focus:border-accent focus:outline-none">
        </div>

        <div>
            <label class="block text-xs font-bold uppercase text-zinc-400 mb-1">Kategori</label>
            <select name="category" class="w-full bg-zinc-950 border border-zinc-800 text-xs font-bold text-white px-3 py-2 uppercase focus:border-accent focus:outline-none">
                <option value="review">Review</option>
                <option value="news">News</option>
                <option value="interview">Interview</option>
                <option value="editorial">Editorial</option>
            </select>
        </div>

        <div>
            <label class="block text-xs font-bold uppercase text-zinc-400 mb-1">Excerpt / Ringkasan Singkat</label>
            <textarea name="excerpt" rows="2" required class="w-full bg-zinc-950 border border-zinc-800 text-xs text-white px-3 py-2 focus:border-accent focus:outline-none">{{ old('excerpt') }}</textarea>
        </div>

        <div>
            <label class="block text-xs font-bold uppercase text-zinc-400 mb-1">Gambar Poster / Cover</label>
            <input type="file" name="cover_image" class="w-full bg-zinc-950 border border-zinc-800 text-xs text-zinc-400 px-3 py-2 focus:border-accent focus:outline-none">
        </div>

        <div>
            <label class="block text-xs font-bold uppercase text-zinc-400 mb-1">Link Embed Audio (Spotify / Bandcamp)</label>
            <input type="url" name="audio_embed_url" value="{{ old('audio_embed_url') }}" placeholder="https://open.spotify.com/embed/album/..." class="w-full bg-zinc-950 border border-zinc-800 text-xs text-white px-3 py-2 focus:border-accent focus:outline-none">
        </div>

        <!-- Editor Rich Text -->
        <div>
            <label class="block text-xs font-bold uppercase text-zinc-400 mb-2">Isi Artikel</label>
            
            <div id="editor-container" class="bg-zinc-950 text-white border border-zinc-800 min-h-[280px]">
            </div>

            <input type="hidden" name="content" id="hidden-content">
        </div>

        <button type="submit" class="w-full bg-accent hover:bg-zinc-800 text-white font-black text-xs uppercase py-3 transition">
            Terbitkan Artikel
        </button>
    </form>
</div>

<!-- Custom Styling Tema Gelap & Indikator Aktif -->
<style>
    /* Styling Toolbar & Editor */
    .ql-toolbar { background-color: #09090b !important; border-color: #27272a !important; }
    .ql-container { border-color: #27272a !important; font-size: 13px; font-family: sans-serif; }
    .ql-stroke { stroke: #a1a1aa !important; }
    .ql-fill { fill: #a1a1aa !important; }
    .ql-picker { color: #a1a1aa !important; }
    
    /* Styling Link Biru di Editor */
    .ql-editor a { color: #3b82f6 !important; text-decoration: underline !important; font-weight: bold; }

    /* Fix Stabilo biar kepotong pas di tiap kata */
    .ql-editor span[style*="background-color"] {
        display: inline;
        padding: 2px 4px;
        border-radius: 3px;
        color: #000 !important; /* Biar teks di atas stabilo tetep jelas/hitam */
        box-decoration-break: clone;
        -webkit-box-decoration-break: clone;
    }
    
    /* Indikator Tombol Aktif */
    .ql-toolbar button.ql-active,
    .ql-toolbar .ql-picker-label.ql-active {
        background-color: #dc2626 !important;
        border-radius: 2px;
    }
    .ql-toolbar button.ql-active .ql-stroke { stroke: #ffffff !important; }
    .ql-toolbar button.ql-active .ql-fill { fill: #ffffff !important; }
    .ql-toolbar .ql-picker-label.ql-active { color: #ffffff !important; }
</style>

<script>
    // Inisialisasi Quill dengan Toolbar Lengkap (Bold, Link, Stabilo / Background Color)
const quill = new Quill('#editor-container', {
    theme: 'snow',
    modules: {
        toolbar: [
            [{ 'header': [2, 3, false] }],
            ['bold', 'italic', 'underline', 'strike'],
            // Palette Stabilo + Opsi Matiin (Putih/Transparan di ujung)
            [{ 'background': ['#fef08a', '#bbf7d0', '#bfdbfe', '#fbcfe8', '#fed7aa', '#ffffff'] }],
            ['link', 'blockquote'],
            [{ 'list': 'ordered'}, { 'list': 'bullet' }],
            ['clean'] // <-- Ini tombol Tₓ buat hapus semua format
        ]
    }
});

quill.clipboard.dangerouslyPasteHTML(@js(app(\App\Support\ArticleContentSanitizer::class)->sanitize(old('content', ''))));

    // Pindahin HTML hasil ketikan ke hidden input sebelum submit
    document.getElementById('post-form').onsubmit = function() {
        document.getElementById('hidden-content').value = quill.root.innerHTML;
    };
</script>

@endsection