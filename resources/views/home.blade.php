@extends('layouts.app')

@section('title', 'Beranda - SMK Al-Hidayah Lestari')

@section('content')
    <!-- Hero Section -->
    <section class="relative min-h-[90vh] flex items-center bg-white overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-slate-50 to-blue-50"></div>
        <div class="absolute top-0 right-0 w-1/2 h-full bg-gradient-to-l from-blue-100/30 to-transparent"></div>
        
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <!-- Left Content -->
                <div class="max-w-xl">
                    <div class="inline-flex items-center gap-2 bg-blue-100 text-blue-700 px-4 py-2 rounded-full text-sm font-medium mb-6">
                        <span class="w-2 h-2 bg-blue-500 rounded-full animate-pulse"></span>
                        {{ $hero->badge_text }}
                    </div>
                    
                    <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold text-slate-900 leading-tight mb-6">
                        {{ $hero->title_line1 }} 
                        <span class="text-blue-600">{{ $hero->title_highlight }}</span> 
                        <span class="text-cyan-600">{{ $hero->title_line2 }}</span>
                    </h1>
                    
                    <p class="text-lg text-slate-600 mb-8 leading-relaxed">
                        {{ $hero->description }}
                    </p>
                    
                    <div class="flex flex-wrap gap-4">
                        <a href="{{ url($hero->button_primary_url) }}" class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold px-8 py-4 rounded-xl transition-all shadow-lg hover:shadow-xl hover:-translate-y-0.5">
                            {{ $hero->button_primary_text }}
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                        </a>
                        <a href="{{ url($hero->button_secondary_url) }}" class="inline-flex items-center gap-2 bg-white hover:bg-gray-50 text-slate-700 font-semibold px-8 py-4 rounded-xl border border-gray-200 transition-all">
                            {{ $hero->button_secondary_text }}
                        </a>
                    </div>
                </div>
                
                <!-- Right Image -->
                <div class="relative hidden lg:block">
                    <div class="relative rounded-3xl overflow-hidden shadow-2xl">
                        <img src="{{ asset($hero->hero_image) }}" alt="SMK Al-Hidayah" class="w-full h-auto">
                    </div>

                </div>
            </div>
        </div>
    </section>

    <!-- Tentang Kami Section -->
    <section id="sejarah" class="py-20 bg-slate-50">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="relative">
                    @php
                        $sejarahGambarUrls = $profil->sejarah_gambar_urls ?? [];
                        if (empty($sejarahGambarUrls)) {
                            $sejarahGambarUrls = [asset('images/b1.webp')];
                        }
                    @endphp
                    
                    <div x-data="{ 
                            activeSlide: 0, 
                            slides: {{ json_encode($sejarahGambarUrls) }},
                            startAutoSlide() {
                                setInterval(() => {
                                    this.activeSlide = (this.activeSlide + 1) % this.slides.length;
                                }, 5000); 
                            }
                        }" 
                        x-init="startAutoSlide()"
                        class="relative rounded-3xl overflow-hidden shadow-xl aspect-[4/3]">
                        
                        <template x-for="(slide, index) in slides" :key="index">
                            <div x-show="activeSlide === index" 
                                 x-transition:enter="transition ease-out duration-700"
                                 x-transition:enter-start="opacity-0"
                                 x-transition:enter-end="opacity-100"
                                 x-transition:leave="transition ease-in duration-500"
                                 x-transition:leave-start="opacity-100"
                                 x-transition:leave-end="opacity-0"
                                 class="absolute inset-0">
                                <img :src="slide" alt="Tentang Kami" class="w-full h-full object-cover">
                            </div>
                        </template>

                        <div class="absolute bottom-4 left-0 right-0 flex justify-center gap-2" x-show="slides.length > 1">
                            <template x-for="(slide, index) in slides" :key="index">
                                <button @click="activeSlide = index" 
                                    :class="activeSlide === index ? 'bg-white w-6' : 'bg-white/50'"
                                    class="h-1.5 rounded-full transition-all"></button>
                            </template>
                        </div>
                    </div>
                </div>
                
                <div>
                    <span class="text-blue-600 font-semibold text-sm uppercase tracking-wide">Tentang Kami</span>
                    <h2 class="text-3xl lg:text-4xl font-bold text-slate-900 mt-2 mb-6">{{ $profil->sejarah_judul ?? 'SMK Al-Hidayah Lestari' }}</h2>
                    <div class="prose prose-lg text-gray-600">
                        @if($profil && $profil->sejarah_konten)
                            @foreach(explode("\n", $profil->sejarah_konten) as $paragraph)
                                @if(trim($paragraph))
                                <p class="mb-4">{{ $paragraph }}</p>
                                @endif
                            @endforeach
                        @else
                            <p class="mb-4">SMK Al-Hidayah Lestari didirikan dengan visi untuk mencetak generasi unggul yang memiliki kompetensi di bidang teknologi dan bisnis, serta berakhlak mulia.</p>
                        @endif
                    </div>
                    <a href="{{ url('/profil') }}" class="inline-flex items-center gap-2 text-blue-600 font-semibold mt-6 hover:text-blue-700">
                        Pelajari Lebih Lanjut
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Jurusan Section -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-2xl mx-auto mb-16">
                <span class="text-blue-600 font-semibold text-sm uppercase tracking-wide">Program Keahlian</span>
                <h2 class="text-3xl lg:text-4xl font-bold text-slate-900 mt-2 mb-4">Pilih Jurusan Favoritmu</h2>
                <p class="text-gray-600">Empat program keahlian unggulan yang siap menyiapkanmu untuk dunia kerja dan industri.</p>
            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @php
                    $jurusanList = [
                        ['kode' => 'TKJ', 'nama' => 'Teknik Komputer & Jaringan', 'warna' => 'blue', 'bg' => 'bg-blue-50', 'text' => 'text-blue-600'],
                        ['kode' => 'MPLB', 'nama' => 'Manajemen Perkantoran', 'warna' => 'green', 'bg' => 'bg-green-50', 'text' => 'text-green-600'],
                        ['kode' => 'AKL', 'nama' => 'Akuntansi & Keuangan', 'warna' => 'purple', 'bg' => 'bg-purple-50', 'text' => 'text-purple-600'],
                        ['kode' => 'BR', 'nama' => 'Bisnis Ritel', 'warna' => 'orange', 'bg' => 'bg-orange-50', 'text' => 'text-orange-600'],
                    ];
                @endphp

                @foreach($jurusanList as $j)
                @php
                    $logoFile = $j['kode'] === 'MPLB' ? 'mplb1.jpeg' : strtolower($j['kode']) . '.jpeg';
                @endphp
                <a href="{{ url('/jurusan/' . strtolower($j['kode'])) }}" class="group bg-white border border-gray-100 rounded-2xl p-6 hover:shadow-xl transition-all hover:-translate-y-1">
                    <div class="w-full aspect-square {{ $j['bg'] }} rounded-xl flex items-center justify-center mb-6 overflow-hidden">
                        <img src="{{ asset('images/logo/' . $logoFile) }}" alt="{{ $j['kode'] }}" class="w-3/4 h-3/4 object-contain group-hover:scale-110 transition-transform duration-300">
                    </div>
                    <h3 class="font-bold text-slate-900 mb-1">{{ $j['kode'] }}</h3>
                    <p class="text-sm text-gray-600 mb-4">{{ $j['nama'] }}</p>
                    <span class="inline-flex items-center gap-1 {{ $j['text'] }} font-semibold text-sm">
                        Detail
                        <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </span>
                </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Fasilitas Section -->
    @if($fasilitas->isNotEmpty())
    <section class="py-20 bg-slate-50">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-4 mb-12">
                <div>
                    <span class="text-blue-600 font-semibold text-sm uppercase tracking-wide">Fasilitas</span>
                    <h2 class="text-3xl lg:text-4xl font-bold text-slate-900 mt-2">Sarana & Prasarana</h2>
                </div>
                <a href="{{ url('/fasilitas') }}" class="inline-flex items-center gap-2 text-blue-600 font-semibold hover:text-blue-700">
                    Lihat Semua
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($fasilitas as $item)
                <div class="group bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all">
                    <div class="aspect-[16/10] overflow-hidden bg-gray-100">
                        @if($item->gambar_url)
                        <img src="{{ $item->gambar_url }}" alt="{{ $item->nama }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        @else
                        <div class="w-full h-full flex items-center justify-center">
                            <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                        </div>
                        @endif
                    </div>
                    <div class="p-5">
                        <h3 class="font-bold text-slate-900">{{ $item->nama }}</h3>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- Galeri Section -->
    @if($galeri->isNotEmpty())
    <section class="py-20 bg-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-4 mb-12">
                <div>
                    <span class="text-blue-600 font-semibold text-sm uppercase tracking-wide">Galeri</span>
                    <h2 class="text-3xl lg:text-4xl font-bold text-slate-900 mt-2">Momen Berkesan</h2>
                </div>
                <a href="{{ url('/galeri') }}" class="inline-flex items-center gap-2 text-blue-600 font-semibold hover:text-blue-700">
                    Lihat Semua
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                @foreach($galeri->take(8) as $index => $item)
                <div class="relative group overflow-hidden rounded-xl cursor-pointer {{ $index === 0 ? 'md:col-span-2 md:row-span-2' : 'aspect-square' }}" onclick="openImageModal('{{ $item->gambar_url }}')">
                    <img src="{{ $item->gambar_url }}" alt="{{ $item->keterangan ?? 'Galeri' }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"/></svg>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- Berita Section -->
    @if($berita->isNotEmpty())
    <section class="py-20 bg-slate-50">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-4 mb-12">
                <div>
                    <span class="text-blue-600 font-semibold text-sm uppercase tracking-wide">Berita</span>
                    <h2 class="text-3xl lg:text-4xl font-bold text-slate-900 mt-2">Update Terbaru</h2>
                </div>
                <a href="{{ url('/berita') }}" class="inline-flex items-center gap-2 text-blue-600 font-semibold hover:text-blue-700">
                    Lihat Semua
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                @foreach($berita as $item)
                <article class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all">
                    <a href="{{ route('berita.show', $item->slug) }}">
                        <div class="aspect-[16/10] overflow-hidden bg-gray-100">
                            @if($item->gambar_utama)
                            <img src="{{ $item->gambar_utama }}" alt="{{ $item->judul }}" class="w-full h-full object-cover hover:scale-105 transition-transform duration-500">
                            @else
                            <div class="w-full h-full flex items-center justify-center">
                                <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                            </div>
                            @endif
                        </div>
                        <div class="p-6">
                            <p class="text-sm text-gray-500 mb-2">{{ $item->published_at ? $item->published_at->format('d M Y') : '-' }}</p>
                            <h3 class="font-bold text-lg text-slate-900 mb-3 hover:text-blue-600 transition-colors">{{ $item->judul }}</h3>
                            <p class="text-gray-600 text-sm line-clamp-2">{{ $item->excerpt }}</p>
                        </div>
                    </a>
                </article>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- Image Modal -->
    <div id="imageModal" class="fixed inset-0 z-50 hidden bg-black/90 flex items-center justify-center p-4" onclick="closeImageModal()">
        <button class="absolute top-6 right-6 text-white/70 hover:text-white" onclick="event.stopPropagation(); closeImageModal()">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>
        <img id="modalImage" src="" alt="Galeri" class="max-w-full max-h-[85vh] object-contain rounded-lg" onclick="event.stopPropagation()">
    </div>
@endsection

@push('scripts')
<script>
    function openImageModal(src) {
        document.getElementById('modalImage').src = src;
        document.getElementById('imageModal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeImageModal() {
        document.getElementById('imageModal').classList.add('hidden');
        document.body.style.overflow = '';
    }

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') closeImageModal();
    });
</script>
@endpush
