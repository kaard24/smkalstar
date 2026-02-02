@extends('layouts.app')

@section('title', 'Jurusan - SMK Al-Hidayah Lestari')

@section('content')
    <!-- Header Page -->
    <div class="bg-green-50 py-12 border-b border-green-100">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-2">Kompetensi Keahlian</h1>
            <p class="text-gray-600">Pilihlah jurusan masa depan sesuai dengan minat dan bakatmu</p>
        </div>
    </div>

    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid gap-12">
                @php
                    $colorSchemes = [
                        ['bg' => 'bg-blue-50', 'text' => 'text-blue-600', 'border' => 'border-blue-100', 'icon_bg' => 'bg-blue-100'],
                        ['bg' => 'bg-purple-50', 'text' => 'text-purple-600', 'border' => 'border-purple-100', 'icon_bg' => 'bg-purple-100'],
                        ['bg' => 'bg-green-50', 'text' => 'text-green-600', 'border' => 'border-green-100', 'icon_bg' => 'bg-green-100'],
                        ['bg' => 'bg-orange-50', 'text' => 'text-orange-600', 'border' => 'border-orange-100', 'icon_bg' => 'bg-orange-100'],
                    ];
                @endphp
                
                @forelse($jurusan as $index => $item)
                @php
                    $color = $colorSchemes[$index % count($colorSchemes)];
                    $isReverse = $index % 2 !== 0;
                @endphp
                <div class="flex flex-col {{ $isReverse ? 'lg:flex-row-reverse' : 'lg:flex-row' }} gap-8 lg:gap-12 items-center bg-white rounded-3xl shadow-sm border border-gray-100 p-6 lg:p-10 hover:shadow-xl transition-all duration-300 group">
                    <div class="w-full lg:w-5/12 h-64 lg:h-80 relative rounded-2xl overflow-hidden shadow-md">
                        @if($item->gambar_url)
                        <img src="{{ $item->gambar_url }}" alt="{{ $item->nama }}" class="absolute inset-0 w-full h-full object-cover group-hover:scale-110 transition duration-700" loading="lazy" decoding="async">
                        @else
                        <div class="absolute inset-0 w-full h-full bg-gray-100 flex items-center justify-center text-gray-300">
                            <svg class="w-20 h-20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                        </div>
                        @endif
                        <div class="absolute inset-0 bg-black/10 group-hover:bg-transparent transition"></div>
                    </div>
                    <div class="w-full lg:w-7/12">
                        <div class="flex flex-col items-start gap-4 mb-6">
                            @if($item->kategori)
                            <span class="{{ $color['bg'] }} {{ $color['text'] }} {{ $color['border'] }} border font-semibold px-4 py-1.5 rounded-full text-sm tracking-wide">{{ $item->kategori }}</span>
                            @endif
                            <h2 class="text-3xl font-bold text-gray-900 font-heading">{{ $item->nama }}</h2>
                        </div>
                        
                        @if($item->deskripsi)
                        <p class="text-gray-600 mb-8 leading-relaxed text-lg">
                            {{ $item->deskripsi }}
                        </p>
                        @endif

                        @if($item->peluang_karir && count($item->peluang_karir) > 0)
                        <div>
                            <h3 class="font-bold text-gray-900 mb-4 flex items-center gap-2">
                                <svg class="w-5 h-5 {{ $color['text'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                Peluang Karir
                            </h3>
                            <div class="flex flex-wrap gap-2">
                                @foreach($item->peluang_karir as $karir)
                                <span class="bg-white border border-gray-200 text-gray-700 px-4 py-2 rounded-lg text-sm font-medium hover:border-gray-300 transition">{{ $karir }}</span>
                                @endforeach
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
                @empty
                <div class="text-center py-20 bg-white rounded-3xl border border-gray-100">
                    <svg class="w-16 h-16 mx-auto mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                    <p class="text-gray-500 text-lg">Data jurusan belum tersedia saat ini.</p>
                </div>
                @endforelse
            </div>
        </div>
    </section>
@endsection
