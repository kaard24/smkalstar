@extends('layouts.app')

@section('title', 'Fasilitas - SMK Al-Hidayah Lestari')

@section('content')
    <!-- Header Page - Unique Design -->
    <div class="relative bg-gradient-to-br from-blue-50 via-indigo-50 to-cyan-50 py-16 md:py-24 border-b border-blue-100 overflow-hidden">
        <!-- Decorative Elements -->
        <div class="absolute inset-0">
            <div class="absolute top-0 left-1/3 w-96 h-96 bg-blue-300/20 rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 right-1/4 w-72 h-72 bg-indigo-300/20 rounded-full blur-3xl"></div>
            <!-- Dots Pattern -->
            <div class="absolute inset-0 opacity-30" style="background-image: radial-gradient(#3b82f6 1px, transparent 1px); background-size: 24px 24px;"></div>
        </div>
        
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
            <div class="inline-flex items-center gap-2 bg-white/80 backdrop-blur-sm border border-blue-200 px-4 py-1.5 rounded-full text-sm font-medium text-blue-700 mb-6">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                Sarana & Prasarana
            </div>
            <h1 class="text-3xl md:text-4xl lg:text-5xl xl:text-6xl font-bold text-gray-900 mb-4 font-heading">
                Fasilitas <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-500 to-indigo-600">Sekolah</span>
            </h1>
            <p class="text-gray-600 text-lg md:text-xl max-w-3xl mx-auto leading-relaxed">Sarana dan prasarana modern untuk mendukung kegiatan belajar mengajar yang efektif dan nyaman</p>
        </div>
    </div>

    <section class="py-20 bg-gray-50" x-data="createLightboxData()" @keydown.escape.window="closeLightbox()">
        
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
                @forelse($fasilitas as $item)
                @php
                    $images = $item->gambar_urls;
                @endphp
                <div class="group cursor-pointer bg-white rounded-3xl shadow-sm hover:shadow-2xl transition-all duration-300 border border-gray-100 overflow-hidden" @click="openLightbox({{ json_encode($images) }}, '{{ addslashes($item->nama) }}')">
                    <div class="relative h-64 overflow-hidden">
                        @if($item->gambar_url)
                        <img src="{{ $item->gambar_urls[0] }}" alt="{{ $item->nama }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-700" loading="lazy" decoding="async">
                        @else
                        <div class="w-full h-full bg-gray-100 flex items-center justify-center text-gray-300 group-hover:bg-gray-200 transition">
                            <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                        </div>
                        @endif
                        
                        <!-- Multiple items indicator -->
                        @if(count($images) > 1)
                        <div class="absolute top-4 right-4 bg-black/60 backdrop-blur-md text-white text-xs font-bold px-3 py-1.5 rounded-full flex items-center gap-1.5 border border-white/10">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            {{ count($images) }} Foto
                        </div>
                        @endif

                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-90 group-hover:opacity-75 transition duration-300"></div>
                        
                        <div class="absolute bottom-0 left-0 right-0 p-6 transform translate-y-2 group-hover:translate-y-0 transition duration-300">
                            <h3 class="text-white font-bold text-xl mb-1 font-heading">{{ $item->nama }}</h3>
                            <p class="text-gray-300 text-sm opacity-0 group-hover:opacity-100 transition duration-300 delay-100 flex items-center gap-1">
                                Lihat Galeri 
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            </p>
                        </div>
                    </div>
                </div>
                @empty
                <!-- Enhanced Empty State -->
                <div class="col-span-full">
                    <div class="relative bg-gradient-to-br from-blue-50 via-indigo-50 to-cyan-50 border border-blue-100 rounded-3xl p-12 md:p-20 text-center overflow-hidden">
                        <!-- Decorative Elements -->
                        <div class="absolute inset-0">
                            <div class="absolute top-0 left-1/4 w-64 h-64 bg-blue-300/20 rounded-full blur-3xl"></div>
                            <div class="absolute bottom-0 right-1/4 w-48 h-48 bg-indigo-300/20 rounded-full blur-3xl"></div>
                        </div>
                        
                        <div class="relative z-10">
                            <div class="w-32 h-32 mx-auto mb-8 bg-gradient-to-br from-blue-100 to-indigo-100 rounded-3xl flex items-center justify-center shadow-xl">
                                <svg class="w-16 h-16 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                            </div>
                            <h3 class="text-3xl font-bold text-gray-900 mb-4">Fasilitas Sedang Dipersiapkan</h3>
                            <p class="text-gray-600 text-lg max-w-xl mx-auto leading-relaxed">Kami sedang menyiapkan informasi lengkap tentang sarana dan prasarana modern yang akan mendukung proses belajar mengajar Anda.</p>
                            <div class="mt-8 flex justify-center gap-3">
                                <div class="w-2 h-2 rounded-full bg-blue-400 animate-bounce" style="animation-delay: 0s;"></div>
                                <div class="w-2 h-2 rounded-full bg-blue-400 animate-bounce" style="animation-delay: 0.2s;"></div>
                                <div class="w-2 h-2 rounded-full bg-blue-400 animate-bounce" style="animation-delay: 0.4s;"></div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforelse
            </div>
        </div>

        <!-- Lightbox Modal -->
        <div x-show="lightboxOpen" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 backdrop-blur-none"
             x-transition:enter-end="opacity-100 backdrop-blur-xl"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 backdrop-blur-xl"
             x-transition:leave-end="opacity-0 backdrop-blur-none"
             class="fixed inset-0 z-[60] bg-black/95 backdrop-blur-xl flex items-center justify-center p-4"
             style="display: none;">
            
            <div class="absolute inset-0" @click="closeLightbox()"></div>

            <button class="absolute top-6 right-6 text-white/50 hover:text-white transition z-50 transform hover:scale-110 duration-200" @click="closeLightbox()">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>

            <!-- Navigation Buttons -->
            <button x-show="activeImages.length > 1" 
                    @click.stop="prevImage()" 
                    class="absolute left-4 md:left-8 top-1/2 -translate-y-1/2 text-white/70 hover:text-white transition p-3 hover:bg-white/10 rounded-full z-50">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
            </button>
            
            <button x-show="activeImages.length > 1" 
                    @click.stop="nextImage()" 
                    class="absolute right-4 md:right-8 top-1/2 -translate-y-1/2 text-white/70 hover:text-white transition p-3 hover:bg-white/10 rounded-full z-50">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            </button>

            <div class="max-w-7xl max-h-[90vh] w-full flex flex-col items-center relative z-40 pointer-events-none">
                <div class="relative w-full h-full flex items-center justify-center pointer-events-auto">
                    <img :src="activeImages.length > 0 ? activeImages[activeIndex] : ''" class="max-w-full max-h-[80vh] object-contain rounded-lg shadow-2xl transition-all duration-300">
                </div>
                <div class="text-white text-center mt-6 pointer-events-auto">
                    <h3 class="text-2xl font-bold font-heading mb-2" x-text="activeCaption"></h3>
                    <div x-show="activeImages.length > 1" class="inline-flex gap-1.5 mt-2">
                        <template x-for="(img, idx) in activeImages" :key="idx">
                            <button @click="activeIndex = idx" 
                                    class="h-1.5 rounded-full transition-all duration-300"
                                    :class="activeIndex === idx ? 'w-8 bg-white' : 'w-2 bg-white/30 hover:bg-white/50'">
                            </button>
                        </template>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
