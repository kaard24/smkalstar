@extends('layouts.app')

@section('title', 'Info Seragam - SMK Al-Hidayah Lestari')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 py-8" x-data="seragamSlider()">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header -->
        <div class="text-center mb-8">
            <h1 class="text-3xl md:text-4xl font-bold text-white mb-2">👔 Info Seragam</h1>
            <p class="text-gray-400">Geser untuk melihat seragam setiap hari</p>
        </div>

        <!-- Slider Container -->
        <div class="relative">
            <!-- Left Button -->
            <button @click="prev()" 
                    class="absolute left-0 top-1/2 -translate-y-1/2 -translate-x-2 md:-translate-x-6 z-20 w-12 h-12 md:w-14 md:h-14 bg-white/10 hover:bg-white/20 backdrop-blur rounded-full flex items-center justify-center transition-all duration-300 hover:scale-110 border border-white/20 group">
                <svg class="w-6 h-6 md:w-8 md:h-8 text-white group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
            </button>

            <!-- Right Button -->
            <button @click="next()" 
                    class="absolute right-0 top-1/2 -translate-y-1/2 translate-x-2 md:translate-x-6 z-20 w-12 h-12 md:w-14 md:h-14 bg-white/10 hover:bg-white/20 backdrop-blur rounded-full flex items-center justify-center transition-all duration-300 hover:scale-110 border border-white/20 group">
                <svg class="w-6 h-6 md:w-8 md:h-8 text-white group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </button>

            <!-- Cards Container -->
            <div class="overflow-hidden px-4 md:px-12">
                <div class="flex transition-transform duration-500 ease-out" 
                     :style="`transform: translateX(-${currentIndex * 100}%)`">
                    
                    @foreach($seragam as $index => $item)
                    <div class="w-full flex-shrink-0 px-2 md:px-4">
                        <div class="bg-gradient-to-br {{ $item['warna_bg'] }} rounded-3xl p-6 md:p-10 shadow-2xl transform transition-all duration-500 hover:scale-[1.02]">
                            
                            <!-- Day Badge -->
                            <div class="flex justify-between items-start mb-6">
                                <span class="inline-flex items-center gap-2 px-4 py-2 bg-white/80 backdrop-blur rounded-full text-sm font-bold {{ $item['warna_text'] }}">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    Hari {{ $item['hari'] }}
                                </span>
                                <span class="text-5xl md:text-6xl">{{ $item['icon'] }}</span>
                            </div>

                            <!-- Content -->
                            <div class="text-center mb-8">
                                <h2 class="text-2xl md:text-3xl font-bold {{ $item['warna_text'] }} mb-2">{{ $item['nama'] }}</h2>
                                <p class="text-lg {{ $item['warna_text'] }} opacity-80 font-medium">{{ $item['warna'] }}</p>
                            </div>

                            <!-- Illustration Placeholder -->
                            <div class="bg-white/50 backdrop-blur rounded-2xl p-6 md:p-8 mb-6 text-center">
                                <div class="w-32 h-32 md:w-40 md:h-40 mx-auto bg-white/80 rounded-full flex items-center justify-center shadow-lg mb-4">
                                    <span class="text-6xl md:text-7xl">{{ $item['icon'] }}</span>
                                </div>
                                <p class="text-gray-700 text-sm md:text-base leading-relaxed">{{ $item['deskripsi'] }}</p>
                            </div>

                            <!-- Features -->
                            <div class="grid grid-cols-3 gap-3">
                                <div class="bg-white/60 backdrop-blur rounded-xl p-3 text-center">
                                    <svg class="w-5 h-5 mx-auto mb-1 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    <p class="text-xs text-gray-600 font-medium">Pagi - Sore</p>
                                </div>
                                <div class="bg-white/60 backdrop-blur rounded-xl p-3 text-center">
                                    <svg class="w-5 h-5 mx-auto mb-1 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                    <p class="text-xs text-gray-600 font-medium">Wajib</p>
                                </div>
                                <div class="bg-white/60 backdrop-blur rounded-xl p-3 text-center">
                                    <svg class="w-5 h-5 mx-auto mb-1 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    <p class="text-xs text-gray-600 font-medium">Rapi</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Dots Indicator -->
            <div class="flex justify-center gap-2 mt-6">
                @foreach($seragam as $index => $item)
                <button @click="goTo({{ $index }})" 
                        class="w-3 h-3 rounded-full transition-all duration-300"
                        :class="currentIndex === {{ $index }} ? 'bg-white w-8' : 'bg-white/30 hover:bg-white/50'">
                </button>
                @endforeach
            </div>

            <!-- Day Labels -->
            <div class="flex justify-center gap-2 md:gap-4 mt-6 flex-wrap">
                @foreach($seragam as $index => $item)
                <button @click="goTo({{ $index }})" 
                        class="px-3 py-1.5 md:px-4 md:py-2 rounded-lg text-xs md:text-sm font-medium transition-all duration-300"
                        :class="currentIndex === {{ $index }} ? 'bg-white text-gray-900' : 'bg-white/10 text-white/70 hover:bg-white/20'">
                    {{ $item['hari'] }}
                </button>
                @endforeach
            </div>
        </div>

    </div>
</div>

<script>
function seragamSlider() {
    return {
        currentIndex: 0,
        totalSlides: {{ count($seragam) }},
        
        next() {
            this.currentIndex = (this.currentIndex + 1) % this.totalSlides;
        },
        
        prev() {
            this.currentIndex = (this.currentIndex - 1 + this.totalSlides) % this.totalSlides;
        },
        
        goTo(index) {
            this.currentIndex = index;
        },
        
        init() {
            // Keyboard navigation
            document.addEventListener('keydown', (e) => {
                if (e.key === 'ArrowLeft') this.prev();
                if (e.key === 'ArrowRight') this.next();
            });
            
            // Touch/swipe support
            let touchStartX = 0;
            let touchEndX = 0;
            
            const slider = this.$el.querySelector('.overflow-hidden');
            
            slider.addEventListener('touchstart', (e) => {
                touchStartX = e.changedTouches[0].screenX;
            }, {passive: true});
            
            slider.addEventListener('touchend', (e) => {
                touchEndX = e.changedTouches[0].screenX;
                this.handleSwipe(touchStartX, touchEndX);
            }, {passive: true});
        },
        
        handleSwipe(startX, endX) {
            const diff = startX - endX;
            if (Math.abs(diff) > 50) {
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
@endsection
