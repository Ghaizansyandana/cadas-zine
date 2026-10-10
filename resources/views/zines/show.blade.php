@extends('layouts.main')

@section('content')
<div class="space-y-6 my-4">
    <!-- Header Zine -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center border-b border-zinc-800 pb-4 gap-4">
        <div>
            <div class="flex items-center space-x-2 mb-1">
                <span class="bg-red-600 text-white font-black text-[10px] px-2 py-0.5 uppercase tracking-widest">
                    {{ $zine->issue_number }}
                </span>
                <span class="text-xs font-bold text-zinc-500 uppercase">Oleh: {{ $zine->author }}</span>
            </div>
            <h1 class="text-2xl md:text-3xl font-black uppercase text-white">{{ $zine->title }}</h1>
        </div>

        <div class="flex space-x-3">
            <a href="{{ route('zines.index') }}" class="bg-zinc-800 hover:bg-zinc-700 text-white font-bold text-xs uppercase px-4 py-2 transition">
                ← Kembali
            </a>
            <a href="{{ Str::startsWith($zine->pdf_file, 'http') ? $zine->pdf_file : asset('storage/' . $zine->pdf_file) }}" download target="_blank" class="bg-red-600 hover:bg-red-700 text-white font-bold text-xs uppercase px-4 py-2 transition">
                Download PDF
            </a>
        </div>
    </div>

    <!-- PDF EMBED READER -->
    <div class="bg-zinc-900 border border-zinc-800 p-2 rounded">
        <iframe 
            src="{{ Str::startsWith($zine->pdf_file, 'http') ? $zine->pdf_file : asset('storage/' . $zine->pdf_file) }}" 
            class="w-full h-[75vh] bg-zinc-950 border border-zinc-800 rounded"
            frameborder="0">
        </iframe>
    </div>
</div>
@endsection