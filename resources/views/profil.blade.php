@extends('layouts.app')

@section('title', 'Profil Sekolah - SMK Al-Hidayah Lestari')

@section('content')
    <!-- Header Page -->
    <div class="relative bg-gray-900 py-24 overflow-hidden">
        <div class="absolute inset-0 opacity-20">
            <img src="{{ asset('images/b1.jpg') }}" class="w-full h-full object-cover">
        </div>
        <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-gray-900/50 to-transparent"></div>
        <div class="container relative z-10 mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-4 font-heading">Profil Sekolah</h1>
            <p class="text-gray-300 text-lg max-w-2xl mx-auto font-light">Mengenal lebih dekat sejarah, visi, dan orang-orang hebat di balik SMK Al-Hidayah Lestari</p>
        </div>
    </div>

    <!-- Sejarah -->
    <section id="sejarah" class="py-20 bg-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row gap-12 items-center">
                <div class="md:w-1/2">
                    @php
                        $sejarahGambarUrls = $profil->sejarah_gambar_urls;
                        if (empty($sejarahGambarUrls)) {
                            $sejarahGambarUrls = ['https://images.unsplash.com/photo-1544531586-fde5298cdd40?ixlib=rb-1.2.1&auto=format&fit=crop&w=1000&q=80'];
                        }
                    @endphp
                    
                    <div x-data="{ 
                            activeSlide: 0, 
                            slides: {{ json_encode($sejarahGambarUrls) }},
                            autoSlideInterval: null,
                            startAutoSlide() {
                                this.autoSlideInterval = setInterval(() => {
                                    this.activeSlide = (this.activeSlide + 1) % this.slides.length;
                                }, 3000); 
                            },
                            stopAutoSlide() {
                                clearInterval(this.autoSlideInterval);
                            }
                        }" 
                        x-init="startAutoSlide()"
                        @mouseenter="stopAutoSlide()" 
                        @mouseleave="startAutoSlide()"
                        class="relative w-full rounded-3xl overflow-hidden shadow-2xl aspect-video group border border-gray-100">
                        
                        <!-- Slides -->
                        <template x-for="(slide, index) in slides" :key="index">
                            <div x-show="activeSlide === index" 
                                 x-transition:enter="transition ease-out duration-500"
                                 x-transition:enter-start="opacity-0 transform scale-105"
                                 x-transition:enter-end="opacity-100 transform scale-100"
                                 class="absolute inset-0 w-full h-full cursor-pointer"
                                 @click="openLightbox(slide, 'Sejarah Sekolah')">
                                <img :src="slide" alt="Sejarah Sekolah" class="w-full h-full object-cover">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
                            </div>
                        </template>

                        <!-- Navigation Dots -->
                        <div class="absolute bottom-6 left-0 right-0 flex justify-center gap-2 z-10" x-show="slides.length > 1">
                            <template x-for="(slide, index) in slides" :key="index">
                                <button @click="activeSlide = index" 
                                    :class="activeSlide === index ? 'bg-white w-8' : 'bg-white/50 w-2 hover:bg-white/80'"
                                    class="h-2 rounded-full transition-all duration-300"></button>
                            </template>
                        </div>
                    </div>
                </div>
                <div class="md:w-1/2">
                    <span class="text-primary font-bold tracking-wider uppercase text-sm mb-3 block">Tentang Kami</span>
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6 font-heading">{{ $profil->sejarah_judul }}</h2>
                    <div class="prose prose-lg prose-gray text-gray-600 leading-relaxed text-justify">
                        @foreach(explode("\n", $profil->sejarah_konten) as $paragraph)
                            @if(trim($paragraph))
                            <p class="mb-4">{{ $paragraph }}</p>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Visi Misi -->
    <section id="visi-misi" class="py-20 bg-gray-50">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-5xl mx-auto">
                <div class="grid md:grid-cols-2 gap-8">
                    <!-- Visi -->
                    <div class="bg-white p-10 rounded-3xl shadow-sm hover:shadow-xl transition duration-300 border border-gray-100">
                        <div class="flex items-center gap-4 mb-6">
                            <div class="w-12 h-12 bg-green-100 rounded-2xl flex items-center justify-center text-primary">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-900 font-heading">Visi</h3>
                        </div>
                        <p class="text-gray-700 text-lg font-medium italic leading-relaxed">
                            "{{ $profil->visi }}"
                        </p>
                    </div>

                    <!-- Misi -->
                    <div class="bg-white p-10 rounded-3xl shadow-sm hover:shadow-xl transition duration-300 border border-gray-100">
                        <div class="flex items-center gap-4 mb-6">
                            <div class="w-12 h-12 bg-yellow-100 rounded-2xl flex items-center justify-center text-yellow-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-900 font-heading">Misi</h3>
                        </div>
                        <ul class="space-y-4">
                            @foreach($profil->misi ?? [] as $index => $misi)
                            <li class="flex items-start gap-4">
                                <span class="flex-shrink-0 w-6 h-6 rounded-full bg-green-100 text-primary text-xs font-bold flex items-center justify-center mt-0.5">{{ $index + 1 }}</span>
                                <span class="text-gray-600 leading-relaxed">{{ $misi }}</span>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Struktur Organisasi -->
    <section id="struktur-organisasi" class="py-20 bg-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <span class="text-primary font-bold tracking-wider uppercase text-sm mb-3 block">Manajemen & Staff</span>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 font-heading">Struktur Organisasi</h2>
            </div>
            
            @php
                $strukturSections = \App\Models\StrukturOrganisasiSection::aktif()
                    ->urut()
                    ->with(['activeMembers' => fn($q) => $q->orderBy('urutan')])
                    ->get();
            @endphp

            @if($strukturSections->isEmpty())
                @if($profil->struktur_organisasi_gambar)
                    @php
                        $strukturGambar = $profil->struktur_organisasi_gambar;
                        if (!str_starts_with($strukturGambar, 'http')) {
                            $strukturGambar = asset('storage/' . $strukturGambar);
                        }
                    @endphp
                    <div class="max-w-5xl mx-auto p-4 bg-gray-50 rounded-3xl border border-gray-100">
                        <img src="{{ $strukturGambar }}" alt="Struktur Organisasi" class="w-full rounded-2xl shadow-sm">
                    </div>
                @else
                    <div class="max-w-3xl mx-auto bg-gray-50 border-2 border-dashed border-gray-200 rounded-3xl p-16 flex flex-col items-center justify-center text-center">
                        <svg class="w-16 h-16 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        <p class="text-gray-500 font-medium text-lg">Dokumen Struktur Organisasi Belum Tersedia</p>
                    </div>
                @endif
            @else
                <div class="space-y-16">
                    @foreach($strukturSections as $section)
                    <div class="relative">
                        <div class="text-center mb-10">
                            <h4 class="text-xl font-bold text-gray-800 inline-block px-6 py-2 bg-gray-50 rounded-full border border-gray-100 font-heading">
                                {{ $section->nama }}
                            </h4>
                        </div>
                        
                        @if($section->activeMembers->isNotEmpty())
                        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-x-8 gap-y-12 max-w-6xl mx-auto">
                            @foreach($section->activeMembers as $member)
                            <div class="text-center group">
                                <div class="w-32 h-32 md:w-40 md:h-40 mx-auto mb-6 rounded-3xl overflow-hidden bg-white shadow-xl rotate-3 group-hover:rotate-0 transition-transform duration-300 ring-4 ring-white border border-gray-100">
                                    @if($member->foto_url)
                                    <img src="{{ $member->foto_url }}" alt="{{ $member->nama }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                    @else
                                    <div class="w-full h-full flex items-center justify-center bg-gray-100 text-gray-300">
                                        <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                    </div>
                                    @endif
                                </div>
                                <h5 class="font-bold text-gray-900 text-lg mb-1 font-heading">{{ $member->nama }}</h5>
                                @if($member->keterangan)
                                <p class="text-primary text-sm font-medium tracking-wide uppercase">{{ $member->keterangan }}</p>
                                @endif
                            </div>
                            @endforeach
                        </div>
                        @endif
                    </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    <!-- Lightbox Modal (Simplified for Modern Feel) -->
    <div id="lightbox" class="fixed inset-0 z-[60] hidden bg-black/95 backdrop-blur-xl flex items-center justify-center p-4" onclick="closeLightbox()">
        <button class="absolute top-6 right-6 text-white/50 hover:text-white transition" onclick="closeLightbox()">
            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>
        <div class="max-w-6xl max-h-[90vh]" onclick="event.stopPropagation()">
            <img id="lightbox-img" src="" alt="" class="max-h-[85vh] w-auto mx-auto rounded-lg shadow-2xl">
            <p id="lightbox-caption" class="text-center text-white/80 mt-4 text-lg font-light tracking-wide"></p>
        </div>
    </div>

    <script>
        function openLightbox(src, caption) {
            const lightbox = document.getElementById('lightbox');
            const img = document.getElementById('lightbox-img');
            const cap = document.getElementById('lightbox-caption');
            
            img.src = src;
            cap.textContent = caption;
            lightbox.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
            
            // Animate In
            img.style.opacity = 0;
            img.style.transform = 'scale(0.95)';
            setTimeout(() => {
                img.style.transition = 'all 0.3s ease-out';
                img.style.opacity = 1;
                img.style.transform = 'scale(1)';
            }, 10);
        }

        function closeLightbox() {
            const lightbox = document.getElementById('lightbox');
            lightbox.classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') closeLightbox();
        });
    </script>
@endsection
