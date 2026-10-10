@extends('layouts.main')

@section('og_tags')
    <!-- Facebook / WhatsApp / Instagram -->
    <meta property="og:type" content="article">
    <meta property="og:title" content="{{ $post->title }} - INFOMUSIKCADAS">
    <meta property="og:description" content="{{ $post->excerpt }}">
    <meta property="og:url" content="{{ request()->fullUrl() }}">
    <meta property="og:site_name" content="INFOMUSIKCADAS">
    <meta property="og:image" content="{{ $post->cover_image ? asset('storage/' . $post->cover_image) : asset('images/default-share.jpg') }}">

    <!-- Twitter / X -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $post->title }} - INFOMUSIKCADAS">
    <meta name="twitter:description" content="{{ $post->excerpt }}">
    <meta name="twitter:image" content="{{ $post->cover_image ? asset('storage/' . $post->cover_image) : asset('images/default-share.jpg') }}">
@endsection

@section('content')
<article class="max-w-3xl mx-auto space-y-6 my-6">
    <div class="space-y-3 border-b border-zinc-800 pb-6">
        <div class="flex items-center space-x-3">
            <span class="bg-red-600 text-white font-black text-xs px-2.5 py-1 uppercase tracking-widest">
                {{ $post->category }}
            </span>
            <span class="text-xs text-zinc-500 font-bold uppercase">
                {{ $post->created_at->format('d M Y') }}
            </span>
        </div>
        <h1 class="text-3xl md:text-4xl font-black uppercase leading-tight text-white tracking-tight">
            {{ $post->title }}
        </h1>
        <p class="text-zinc-400 text-sm font-medium italic border-l-2 border-red-600 pl-3">
            {{ $post->excerpt }}
        </p>
    </div>

    @if($post->audio_embed_url)
    <div class="bg-zinc-900 border border-zinc-800 p-2 rounded space-y-2">
        <p class="text-[10px] font-black uppercase text-red-500 tracking-wider px-1">
            🎧 Listen While Reading:
        </p>
        <div class="overflow-hidden rounded bg-black">
            <iframe 
                src="{{ $post->audio_embed_url }}" 
                width="100%" 
                height="152" 
                frameborder="0" 
                allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" 
                loading="lazy"
                class="w-full">
            </iframe>
        </div>
    </div>
    @endif

    <div class="text-zinc-300 leading-relaxed space-y-4 text-sm md:text-base">
        {!! $post->content !!}
    </div>
</article>
@endsection