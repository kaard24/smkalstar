@extends('layouts.app')

@section('title', 'Ekstrakurikuler - SMK Al-Hidayah Lestari')

@section('content')
    <!-- Header Page - Unique Design -->
    <div class="relative bg-gradient-to-br from-blue-50 via-sky-50 to-cyan-50 py-16 md:py-24 border-b border-blue-100 overflow-hidden">
        <!-- Decorative Elements -->
        <div class="absolute inset-0">
            <div class="absolute top-1/2 left-10 w-64 h-64 bg-blue-300/20 rounded-full blur-3xl -translate-y-1/2"></div>
            <div class="absolute top-1/4 right-20 w-80 h-80 bg-sky-300/20 rounded-full blur-3xl"></div>
            <!-- Stars Pattern -->
            <div class="absolute inset-0 opacity-20" style="background-image: url('data:image/svg+xml,%3Csvg width=&quot;24&quot; height=&quot;24&quot; viewBox=&quot;0 0 24 24&quot; xmlns=&quot;http://www.w3.org/2000/svg&quot;%3E%3Cpath d=&quot;M12 2l2.4 7.2h7.6l-6 4.8 2.4 7.2-6-4.8-6 4.8 2.4-7.2-6-4.8h7.6z&quot; fill=&quot;%233b82f6&quot; fill-opacity=&quot;0.3&quot;/%3E%3C/svg%3E'); background-size: 48px 48px;"></div>
        </div>
        
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
            <div class="inline-flex items-center gap-2 bg-white/80 backdrop-blur-sm border border-blue-200 px-4 py-1.5 rounded-full text-sm font-medium text-blue-700 mb-6">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
                Pengembangan Diri
            </div>
            <h1 class="text-3xl md:text-4xl lg:text-5xl xl:text-6xl font-bold text-gray-900 mb-4 font-heading">
                Ekstra<span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-500 to-cyan-600">kurikuler</span>
            </h1>
            <p class="text-gray-600 text-lg md:text-xl max-w-3xl mx-auto leading-relaxed">Wadah pengembangan bakat dan minat siswa di luar jam pelajaran untuk membentuk karakter yang unggul</p>
        </div>
    </div>

    <section class="py-20 bg-gray-50" x-data="createLightboxData()" @keydown.escape.window="closeLightbox()">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
             @if($ekstrakurikuler->count() > 0)
             <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                 @foreach($ekstrakurikuler as $item)
                 @php
                    $images = $item->gambar_urls;
                 @endphp
                 <div class="bg-white rounded-3xl shadow-sm border border-gray-100 hover:shadow-2xl transition-all duration-300 p-4 pb-8 text-center group cursor-pointer flex flex-col items-center"
                      @click="openLightbox({{ json_encode($images) }}, '{{ addslashes($item->nama) }}')">
                     
                     <div class="w-full h-48 mb-6 overflow-hidden rounded-2xl relative shadow-sm">
                         @if($item->gambar_url)
                         <img src="{{ $item->gambar_urls[0] }}" alt="{{ $item->nama }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-700" loading="lazy" decoding="async">
                         @else
                         <div class="w-full h-full bg-sky-50 flex items-center justify-center text-primary group-hover:bg-primary group-hover:text-white transition duration-300">
                            <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path></svg>
                         </div>
                         @endif

                         <!-- Multiple items indicator -->
                         @if(count($images) > 1)
                         <div class="absolute top-3 right-3 bg-black/60 backdrop-blur-md text-white text-xs font-bold px-2.5 py-1 rounded-full flex items-center gap-1">
                             <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                             {{ count($images) }}
                         </div>
                         @endif
                     </div>

                     <h3 class="font-bold text-gray-900 text-xl font-heading mb-2 group-hover:text-primary transition">{{ $item->nama }}</h3>
                     @if($item->deskripsi)
                     <p class="text-sm text-gray-500 leading-relaxed line-clamp-3 px-2">{{ $item->deskripsi }}</p>
                     @endif
                 </div>
                 @endforeach
             </div>
             @else
             <!-- Enhanced Empty State -->
             <div class="max-w-2xl mx-auto">
                 <div class="relative bg-gradient-to-br from-rose-50 via-pink-50 to-purple-50 border border-rose-100 rounded-3xl p-12 md:p-16 text-center overflow-hidden">
                     <div class="absolute inset-0">
                         <div class="absolute top-10 right-10 w-40 h-40 bg-rose-300/20 rounded-full blur-3xl animate-pulse"></div>
                         <div class="absolute bottom-10 left-10 w-32 h-32 bg-purple-300/20 rounded-full blur-3xl animate-pulse" style="animation-delay: 0.5s;"></div>
                     </div>
                     
                     <div class="relative z-10">
                         <div class="w-28 h-28 mx-auto mb-6 bg-gradient-to-br from-rose-100 to-pink-100 rounded-full flex items-center justify-center shadow-xl">
                             <svg class="w-14 h-14 text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                             </svg>
                         </div>
                         <h3 class="text-2xl font-bold text-gray-900 mb-3">Ekstrakurikuler Segera Hadir</h3>
                         <p class="text-gray-500">Kegiatan extracurricular yang menarik sedang dalam persiapan. Tunggu kejutan dari kami!</p>
                     </div>
                 </div>
             </div>
             @endif
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
