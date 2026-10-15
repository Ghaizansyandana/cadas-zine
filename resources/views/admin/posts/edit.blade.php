@extends('layouts.main')

@section('content')
<!-- Quill CSS & JS -->
<link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>

<div class="max-w-3xl mx-auto space-y-6">
    <div class="flex justify-between items-center border-b border-zinc-800 pb-4">
        <div>
            <h1 class="text-2xl font-black uppercase text-accent tracking-tight">Edit Artikel / Berita</h1>
            <p class="text-xs text-zinc-500 uppercase mt-1">Revisi tulisan, ganti cover, atau perbarui format zine</p>
        </div>
        <a href="{{ route('admin.posts.index') }}" class="text-xs font-bold text-zinc-500 hover:text-white uppercase">&larr; Kembali</a>
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

    <form id="post-form" action="{{ route('admin.posts.update', $post->id) }}" method="POST" enctype="multipart/form-data" class="bg-zinc-900 border border-zinc-800 p-6 space-y-4">
        @csrf
        @method('PUT')

        <!-- Panduan Singkat Buat Editor -->
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
            <input type="text" name="title" value="{{ old('title', $post->title) }}" required class="w-full bg-zinc-950 border border-zinc-800 text-xs font-bold text-white px-3 py-2 uppercase focus:border-accent focus:outline-none">
        </div>

        <div>
            <label class="block text-xs font-bold uppercase text-zinc-400 mb-1">Kategori</label>
            <select name="category" class="w-full bg-zinc-950 border border-zinc-800 text-xs font-bold text-white px-3 py-2 uppercase focus:border-accent focus:outline-none">
                <option value="review" {{ old('category', $post->category) == 'review' ? 'selected' : '' }}>Review</option>
                <option value="news" {{ old('category', $post->category) == 'news' ? 'selected' : '' }}>News</option>
                <option value="interview" {{ old('category', $post->category) == 'interview' ? 'selected' : '' }}>Interview</option>
                <option value="editorial" {{ old('category', $post->category) == 'editorial' ? 'selected' : '' }}>Editorial</option>
            </select>
        </div>

        <div>
            <label class="block text-xs font-bold uppercase text-zinc-400 mb-1">Excerpt / Ringkasan Singkat</label>
            <textarea name="excerpt" rows="2" required class="w-full bg-zinc-950 border border-zinc-800 text-xs text-white px-3 py-2 focus:border-accent focus:outline-none">{{ old('excerpt', $post->excerpt) }}</textarea>
        </div>

        <!-- Preview Cover Lama -->
        @if($post->cover_image)
            <div class="space-y-1 bg-zinc-950 p-3 border border-zinc-800">
                <span class="block text-[10px] text-zinc-500 uppercase font-bold">Cover Saat Ini:</span>
                <img src="{{ asset('storage/' . $post->cover_image) }}" class="w-32 h-20 object-cover border border-zinc-700">
            </div>
        @endif

        <div>
            <label class="block text-xs font-bold uppercase text-zinc-400 mb-1">Ganti Cover Image / Poster (Opsional)</label>
            <input type="file" name="cover_image" accept="image/*" class="w-full bg-zinc-950 border border-zinc-800 p-2 text-xs text-zinc-400">
        </div>

        <div>
            <label class="block text-xs font-bold uppercase text-zinc-400 mb-1">Link Embed Audio (Spotify / Bandcamp)</label>
            <input type="url" name="audio_embed_url" value="{{ old('audio_embed_url', $post->audio_embed_url) }}" placeholder="https://open.spotify.com/embed/album/..." class="w-full bg-zinc-950 border border-zinc-800 text-xs text-white px-3 py-2 focus:border-accent focus:outline-none">
        </div>

        <!-- Editor Rich Text -->
        <div>
            <label class="block text-xs font-bold uppercase text-zinc-400 mb-2">Isi Artikel</label>
            
            <div id="editor-container" class="bg-zinc-950 text-white border border-zinc-800 min-h-[280px]">
            </div>

            <input type="hidden" name="content" id="hidden-content">
        </div>

        <button type="submit" class="w-full bg-accent hover:bg-zinc-800 text-white font-black text-xs uppercase py-3 transition">
            Simpan Perubahan Artikel &rarr;
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
        color: #000 !important;
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
    // Inisialisasi Quill dengan Toolbar Lengkap
    const quill = new Quill('#editor-container', {
        theme: 'snow',
        modules: {
            toolbar: [
                [{ 'header': [2, 3, false] }],
                ['bold', 'italic', 'underline', 'strike'],
                [{ 'background': ['#fef08a', '#bbf7d0', '#bfdbfe', '#fbcfe8', '#fed7aa', '#ffffff'] }],
                ['link', 'blockquote'],
                [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                ['clean']
            ]
        }
    });

    // Masukin konten lama artikel ke dalam Quill Editor
    quill.root.innerHTML = @js(old('content', $post->content));

    // Pindahin HTML hasil ketikan ke hidden input sebelum submit
    document.getElementById('post-form').onsubmit = function() {
        document.getElementById('hidden-content').value = quill.root.innerHTML;
    };
</script>
@endsection