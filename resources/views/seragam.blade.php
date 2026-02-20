@extends('layouts.app')

@section('title', 'Info Seragam - SMK Al-Hidayah Lestari')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 py-8 md:py-12" 
     x-data="seragamSkinSelector()"
     x-init="init()">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header -->
        <div class="text-center mb-8 md:mb-12 animate-fade-in-up">
            <h1 class="text-3xl md:text-5xl font-bold text-white mb-3">Info Seragam</h1>
            <p class="text-slate-400 text-lg max-w-2xl mx-auto">Pilih hari untuk melihat seragam yang dikenakan. Seperti ganti skin di game!</p>
        </div>

        @if($seragam->isEmpty())
        <!-- Empty State -->
        <div class="text-center py-16">
            <div class="w-24 h-24 bg-slate-800 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-12 h-12 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                </svg>
            </div>
            <h3 class="text-xl font-semibold text-white mb-2">Belum Ada Data Seragam</h3>
            <p class="text-slate-400">Data seragam akan segera ditambahkan.</p>
        </div>
        @else
        <!-- Day Selector (Skin Slots) -->
        <div class="mb-8 md:mb-10">
            <div class="flex justify-center gap-2 md:gap-4 flex-wrap">
                @foreach($seragam as $index => $item)
                <button @click="selectDay({{ $index }})" 
                        class="group relative px-4 md:px-6 py-3 rounded-xl font-semibold text-sm md:text-base transition-all duration-300 transform hover:scale-105"
                        :class="currentIndex === {{ $index }} 
                            ? 'bg-gradient-to-r {{ $item->gradient_class }} text-white shadow-lg scale-105 ring-2 ring-white/30' 
                            : 'bg-slate-800/80 text-slate-400 hover:bg-slate-700 hover:text-white border border-slate-700'">
                    <span class="relative z-10">{{ $item->hari }}</span>
                    
                    <!-- Active Indicator -->
                    <div x-show="currentIndex === {{ $index }}" 
                         x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0 scale-0"
                         x-transition:enter-end="opacity-100 scale-100"
                         class="absolute -bottom-1 left-1/2 -translate-x-1/2 w-1.5 h-1.5 bg-white rounded-full">
                    </div>
                    
                    <!-- Hover Glow -->
                    <div x-show="currentIndex !== {{ $index }}"
                         class="absolute inset-0 rounded-xl bg-gradient-to-r {{ $item->gradient_class }} opacity-0 group-hover:opacity-20 transition-opacity">
                    </div>
                </button>
                @endforeach
            </div>
        </div>

        <!-- Main Preview Area (Skin Showcase) -->
        <div class="relative">
            <!-- Navigation Arrows -->
            <button @click="prev()" 
                    class="absolute left-0 md:-left-4 lg:-left-12 top-1/2 -translate-y-1/2 z-20 w-10 h-10 md:w-12 md:h-12 bg-white/10 hover:bg-white/20 backdrop-blur rounded-full flex items-center justify-center transition-all duration-300 hover:scale-110 border border-white/20 group hidden md:flex"
                    :class="{ 'opacity-50 cursor-not-allowed': currentIndex === 0 }"
                    :disabled="currentIndex === 0">
                <svg class="w-5 h-5 md:w-6 md:h-6 text-white group-hover:-translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
            </button>

            <button @click="next()" 
                    class="absolute right-0 md:-right-4 lg:-right-12 top-1/2 -translate-y-1/2 z-20 w-10 h-10 md:w-12 md:h-12 bg-white/10 hover:bg-white/20 backdrop-blur rounded-full flex items-center justify-center transition-all duration-300 hover:scale-110 border border-white/20 group hidden md:flex"
                    :class="{ 'opacity-50 cursor-not-allowed': currentIndex === totalSlides - 1 }"
                    :disabled="currentIndex === totalSlides - 1">
                <svg class="w-5 h-5 md:w-6 md:h-6 text-white group-hover:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </button>

            <!-- Cards Container -->
            <div class="overflow-hidden px-0 md:px-8">
                <div class="flex transition-transform duration-500 ease-out" 
                     :style="`transform: translateX(-${currentIndex * 100}%)`">
                    
                    @foreach($seragam as $index => $item)
                    <div class="w-full flex-shrink-0 px-2 md:px-4">
                        <div class="bg-gradient-to-br from-slate-800/80 to-slate-900/80 backdrop-blur rounded-3xl p-6 md:p-10 border border-slate-700/50 shadow-2xl">
                            
                            <!-- Day Badge -->
                            <div class="flex justify-center mb-6 md:mb-8">
                                <div class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r {{ $item->gradient_class }} rounded-full text-white shadow-lg">
                                    <span class="font-bold text-lg">{{ $item->hari }}</span>
                                </div>
                            </div>

                            <!-- Gender Toggle -->
                            <div class="flex justify-center mb-6 md:mb-8">
                                <div class="inline-flex bg-slate-900/80 rounded-full p-1 border border-slate-700">
                                    <button @click="gender = 'laki'" 
                                            class="px-6 py-2 rounded-full text-sm font-medium transition-all duration-300"
                                            :class="gender === 'laki' 
                                                ? 'bg-gradient-to-r from-blue-500 to-blue-600 text-white shadow-md' 
                                                : 'text-slate-400 hover:text-white'">
                                        <span class="flex items-center gap-2">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                            </svg>
                                            Laki-laki
                                        </span>
                                    </button>
                                    <button @click="gender = 'perempuan'" 
                                            class="px-6 py-2 rounded-full text-sm font-medium transition-all duration-300"
                                            :class="gender === 'perempuan' 
                                                ? 'bg-gradient-to-r from-pink-500 to-pink-600 text-white shadow-md' 
                                                : 'text-slate-400 hover:text-white'">
                                        <span class="flex items-center gap-2">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                            </svg>
                                            Perempuan
                                        </span>
                                    </button>
                                </div>
                            </div>

                            <!-- Photo Display (Skin Preview) -->
                            <div class="relative mb-6 md:mb-8">
                                <div class="bg-slate-900/50 rounded-2xl p-4 md:p-6 border border-slate-700/50 relative min-h-[400px]">
                                    {{-- Laki-laki Photo --}}
                                    @if($item->foto_laki_url)
                                    <div class="absolute inset-4 md:inset-6 transition-opacity duration-300"
                                         :class="gender === 'laki' ? 'opacity-100 z-10' : 'opacity-0 z-0'">
                                        <img src="{{ $item->foto_laki_url }}" 
                                             alt="Seragam Laki-laki {{ $item->hari }}" 
                                             class="w-full h-full object-contain rounded-xl">
                                    </div>
                                    @else
                                    <div class="absolute inset-0 flex items-center justify-center transition-opacity duration-300"
                                         :class="gender === 'laki' ? 'opacity-100 z-10' : 'opacity-0 z-0'">
                                        <div class="text-center">
                                            <div class="w-32 h-32 bg-slate-800 rounded-full flex items-center justify-center mx-auto mb-4">
                                                <span class="text-6xl">👔</span>
                                            </div>
                                            <p class="text-slate-500">Foto belum tersedia</p>
                                        </div>
                                    </div>
                                    @endif

                                    {{-- Perempuan Photo --}}
                                    @if($item->foto_perempuan_url)
                                    <div class="absolute inset-4 md:inset-6 transition-opacity duration-300"
                                         :class="gender === 'perempuan' ? 'opacity-100 z-10' : 'opacity-0 z-0'">
                                        <img src="{{ $item->foto_perempuan_url }}" 
                                             alt="Seragam Perempuan {{ $item->hari }}" 
                                             class="w-full h-full object-contain rounded-xl">
                                    </div>
                                    @else
                                    <div class="absolute inset-0 flex items-center justify-center transition-opacity duration-300"
                                         :class="gender === 'perempuan' ? 'opacity-100 z-10' : 'opacity-0 z-0'">
                                        <div class="text-center">
                                            <div class="w-32 h-32 bg-slate-800 rounded-full flex items-center justify-center mx-auto mb-4">
                                                <span class="text-6xl">👗</span>
                                            </div>
                                            <p class="text-slate-500">Foto belum tersedia</p>
                                        </div>
                                    </div>
                                    @endif
                                </div>

                            </div>
                            
                            <!-- Decorative Elements (outside photo container) -->
                            <div class="absolute -top-3 -left-3 w-20 h-20 bg-gradient-to-br {{ $item->gradient_class }} opacity-20 rounded-full blur-2xl pointer-events-none"></div>
                            <div class="absolute -bottom-3 -right-3 w-20 h-20 bg-gradient-to-br {{ $item->gradient_class }} opacity-20 rounded-full blur-2xl pointer-events-none"></div>

                            <!-- Description -->
                            <div class="bg-slate-900/50 rounded-xl p-4 md:p-6 border border-slate-700/50">
                                <h3 class="text-lg md:text-xl font-bold text-white mb-2 flex items-center gap-2">
                                    <span class="w-2 h-2 rounded-full bg-gradient-to-r {{ $item->gradient_class }}"></span>
                                    {{ $item->hari }}
                                </h3>
                                <p class="text-slate-300 text-sm md:text-base leading-relaxed">
                                    {{ $item->keterangan ?? 'Tidak ada keterangan' }}
                                </p>
                            </div>


                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Dots Indicator -->
            <div class="flex justify-center gap-2 mt-8">
                @foreach($seragam as $index => $item)
                <button @click="selectDay({{ $index }})" 
                        class="h-2 rounded-full transition-all duration-300"
                        :class="currentIndex === {{ $index }} 
                            ? 'w-8 bg-gradient-to-r {{ $item->gradient_class }}' 
                            : 'w-2 bg-slate-600 hover:bg-slate-500'">
                </button>
                @endforeach
            </div>
        </div>
        @endif

    </div>
</div>

<script>
function seragamSkinSelector() {
    return {
        currentIndex: 0,
        totalSlides: {{ $seragam->count() }},
        gender: 'laki',
        touchStartX: 0,
        touchEndX: 0,
        
        init() {
            // Keyboard navigation
            document.addEventListener('keydown', (e) => {
                if (e.key === 'ArrowLeft') this.prev();
                if (e.key === 'ArrowRight') this.next();
            });
            
            // Touch/swipe support
            const slider = this.$el.querySelector('.overflow-hidden');
            
            slider.addEventListener('touchstart', (e) => {
                this.touchStartX = e.changedTouches[0].screenX;
            }, {passive: true});
            
            slider.addEventListener('touchend', (e) => {
                this.touchEndX = e.changedTouches[0].screenX;
                this.handleSwipe();
            }, {passive: true});
        },
        
        selectDay(index) {
            this.currentIndex = index;
        },
        
        next() {
            if (this.currentIndex < this.totalSlides - 1) {
                this.currentIndex++;
            }
        },
        
        prev() {
            if (this.currentIndex > 0) {
                this.currentIndex--;
            }
        },
        
        handleSwipe() {
            const diff = this.touchStartX - this.touchEndX;
            const threshold = 50;
            
            if (Math.abs(diff) > threshold) {
                if (diff > 0) {
                    this.next();
                } else {
                    this.prev();
                }
            }
        }
    }
}
</script>

<style>
/* Custom animations */
@keyframes fade-in-up {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.animate-fade-in-up {
    animation: fade-in-up 0.6s ease-out forwards;
}

/* Ensure images are visible */
img {
    max-width: 100%;
    height: auto;
}
</style>
@endsection
