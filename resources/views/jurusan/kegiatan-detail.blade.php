@php
    $defaultThemes = [
        'TKJ' => [
            'bg' => 'bg-blue-900', 'bg_light' => 'bg-blue-50', 'text' => 'text-blue-900',
        ],
        'MPLB' => [
            'bg' => 'bg-green-600', 'bg_light' => 'bg-green-50', 'text' => 'text-green-700',
        ],
        'AKL' => [
            'bg' => 'bg-purple-600', 'bg_light' => 'bg-purple-50', 'text' => 'text-purple-700',
        ],
        'BR' => [
            'bg' => 'bg-cyan-600', 'bg_light' => 'bg-cyan-50', 'text' => 'text-cyan-700',
        ],
    ];

    $theme = $defaultThemes[$jurusanDetail->kode] ?? $defaultThemes['TKJ'];
@endphp

@extends('layouts.app')

@section('title', $kegiatan->judul . ' - ' . $jurusanDetail->nama)

@section('content')
    <div class="relative {{ $theme['bg'] }} py-10 sm:py-14 overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <svg class="w-full h-full" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <pattern id="dots-kegiatan" x="0" y="0" width="40" height="40" patternUnits="userSpaceOnUse">
                        <circle cx="20" cy="20" r="2" fill="white"/>
                    </pattern>
                </defs>
                <rect width="100%" height="100%" fill="url(#dots-kegiatan)"/>
            </svg>
        </div>
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <a href="{{ route('jurusan.detail', strtolower($jurusanDetail->kode)) }}" class="inline-flex items-center gap-2 text-white/90 hover:text-white text-sm font-medium mb-4">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                Kembali ke {{ $jurusanDetail->nama }}
            </a>
            <h1 class="text-2xl sm:text-3xl md:text-4xl font-bold text-white font-heading">{{ $kegiatan->judul }}</h1>
        </div>
    </div>

    <section class="py-8 sm:py-12 bg-gray-50">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-4xl mx-auto space-y-6">
                <div class="bg-white rounded-2xl p-5 sm:p-6 md:p-8 shadow-sm">
                    <h2 class="text-lg sm:text-xl font-bold text-gray-900 mb-3">Deskripsi Kegiatan</h2>
                    <p class="text-gray-600 text-sm sm:text-base leading-relaxed">
                        {{ $kegiatan->deskripsi ?: 'Belum ada deskripsi kegiatan.' }}
                    </p>
                </div>

                @if($kegiatan->gambar->count() > 0)
                <div class="bg-white rounded-2xl p-5 sm:p-6 md:p-8 shadow-sm">
                    <h2 class="text-lg sm:text-xl font-bold text-gray-900 mb-4">Galeri Kegiatan</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-3 sm:gap-4">
                        @foreach($kegiatan->gambar as $g)
                        <div class="rounded-xl overflow-hidden border border-gray-100 bg-gray-100">
                            <img src="{{ $g->gambar_url }}" alt="{{ $kegiatan->judul }}" class="w-full h-44 object-cover">
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
        </div>
    </section>
@endsection
