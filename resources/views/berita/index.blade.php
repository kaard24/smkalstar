@extends('layouts.app')

@section('title', 'Berita - SMK Al-Hidayah Lestari')

@section('content')
    <!-- Header Page -->
    <div class="bg-sky-50 py-12 border-b border-sky-100">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-2">Berita & Informasi</h1>
            <p class="text-gray-600">Berita terbaru dari SMK Al-Hidayah Lestari</p>
        </div>
    </div>

    <!-- Berita List Section -->
    <section class="py-12 md:py-16 bg-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            @if($berita->isEmpty())
            <div class="max-w-2xl mx-auto bg-gray-50 border-2 border-dashed border-gray-300 rounded-2xl p-12 flex flex-col items-center justify-center">
                <svg class="w-16 h-16 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                <p class="text-gray-500 font-medium text-lg">Belum Ada Berita</p>
                <p class="text-gray-400 text-sm mt-2">Berita akan segera tersedia</p>
            </div>
            @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
                @foreach($berita as $item)
                <article class="bg-white rounded-2xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden group border border-gray-100">
                    <a href="{{ route('berita.show', $item->slug) }}">
                        <div class="aspect-video overflow-hidden bg-gray-100">
                            @if($item->gambar_utama)
                            <img src="{{ $item->gambar_utama }}" alt="{{ $item->judul }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" loading="lazy" decoding="async">
                            @else
                            <div class="w-full h-full flex items-center justify-center">
                                <svg class="w-16 h-16 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                            </div>
                            @endif
                        </div>
                        <div class="p-6">
                            <div class="flex items-center gap-2 text-xs text-gray-500 mb-3">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                {{ $item->published_at ? $item->published_at->format('d M Y') : '-' }}
                            </div>
                            <h3 class="font-bold text-lg text-gray-900 mb-2 group-hover:text-primary transition line-clamp-2">{{ $item->judul }}</h3>
                            <p class="text-gray-600 text-sm line-clamp-3">{{ $item->excerpt }}</p>
                            <div class="mt-4 flex items-center text-primary font-medium text-sm group-hover:gap-2 transition-all">
                                Baca Selengkapnya
                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                            </div>
                        </div>
                    </a>
                </article>
                @endforeach
            </div>

            <!-- Pagination -->
            @if($berita->hasPages())
            <div class="mt-12 flex justify-center">
                {{ $berita->links() }}
            </div>
            @endif
            @endif
        </div>
    </section>
@endsection
