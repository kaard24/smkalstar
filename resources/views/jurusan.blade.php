@extends('layouts.app')

@section('title', 'Jurusan - SMK Al-Hidayah Lestari')

@section('content')
    <!-- Header Page - Unique Design -->
    <div class="relative bg-gradient-to-br from-violet-50 via-purple-50 to-pink-50 py-16 md:py-24 border-b border-violet-100 overflow-hidden">
        <!-- Decorative Elements -->
        <div class="absolute top-0 left-0 w-full h-full overflow-hidden">
            <div class="absolute top-10 left-10 w-64 h-64 bg-violet-300/20 rounded-full blur-3xl animate-pulse"></div>
            <div class="absolute bottom-10 right-10 w-80 h-80 bg-pink-300/20 rounded-full blur-3xl animate-pulse" style="animation-delay: 1s;"></div>
            <!-- Grid Pattern -->
            <div class="absolute inset-0 opacity-20" style="background-image: radial-gradient(circle at 1px 1px, #8b5cf6 1px, transparent 0); background-size: 40px 40px;"></div>
        </div>
        
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
            <div class="inline-flex items-center gap-2 bg-white/80 backdrop-blur-sm border border-violet-200 px-4 py-1.5 rounded-full text-sm font-medium text-violet-700 mb-6">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/></svg>
                Program Keahlian
            </div>
            <h1 class="text-3xl md:text-4xl lg:text-5xl xl:text-6xl font-bold text-gray-900 mb-4 font-heading">
                Kompetensi <span class="text-transparent bg-clip-text bg-gradient-to-r from-violet-500 to-pink-500">Keahlian</span>
            </h1>
            <p class="text-gray-600 text-lg md:text-xl max-w-3xl mx-auto leading-relaxed">Pilihlah jurusan masa depan sesuai dengan minat dan bakatmu. Masing-masing program dilengkapi fasilitas modern dan instruktur berpengalaman.</p>
            
            <!-- Stats -->
            <div class="mt-10 flex justify-center gap-8 md:gap-16">
                <div class="text-center">
                    <div class="text-3xl md:text-4xl font-bold text-violet-600">4</div>
                    <div class="text-sm text-gray-600 mt-1">Jurusan</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl md:text-4xl font-bold text-pink-500">50+</div>
                    <div class="text-sm text-gray-600 mt-1">Tenaga Ahli</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl md:text-4xl font-bold text-violet-500">98%</div>
                    <div class="text-sm text-gray-600 mt-1">Penyerapan</div>
                </div>
            </div>
        </div>
    </div>

    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid gap-12">
                @php
                    $colorSchemes = [
                        ['bg' => 'bg-blue-50', 'text' => 'text-blue-600', 'border' => 'border-blue-100', 'icon_bg' => 'bg-blue-100'],
                        ['bg' => 'bg-purple-50', 'text' => 'text-purple-600', 'border' => 'border-purple-100', 'icon_bg' => 'bg-purple-100'],
                        ['bg' => 'bg-sky-50', 'text' => 'text-sky-600', 'border' => 'border-sky-100', 'icon_bg' => 'bg-sky-100'],
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
                <!-- Enhanced Empty State -->
                <div class="max-w-2xl mx-auto">
                    <div class="relative bg-gradient-to-br from-violet-50 via-purple-50 to-pink-50 border border-violet-100 rounded-3xl p-12 md:p-16 text-center overflow-hidden">
                        <div class="absolute inset-0">
                            <div class="absolute top-10 left-10 w-40 h-40 bg-violet-300/20 rounded-full blur-3xl animate-pulse"></div>
                            <div class="absolute bottom-10 right-10 w-32 h-32 bg-pink-300/20 rounded-full blur-3xl animate-pulse" style="animation-delay: 0.5s;"></div>
                        </div>
                        
                        <div class="relative z-10">
                            <div class="w-28 h-28 mx-auto mb-6 bg-gradient-to-br from-violet-100 to-purple-100 rounded-3xl flex items-center justify-center shadow-xl">
                                <svg class="w-14 h-14 text-violet-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                                </svg>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-900 mb-3">Program Keahlian Segera Hadir</h3>
                            <p class="text-gray-500">Informasi lengkap tentang kompetensi keahlian sedang dipersiapkan. Nantikan program-program unggulan kami!</p>
                        </div>
                    </div>
                </div>
                @endforelse
            </div>
        </div>
    </section>
@endsection
