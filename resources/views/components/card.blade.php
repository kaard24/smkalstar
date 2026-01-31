@props([
    'title', 
    'description', 
    'image' => null, 
    'href' => '#', 
    'class' => '',
    'badge' => null,
    'date' => null,
    'footer' => null
])

<a href="{{ $href }}" class="group block bg-white rounded-2xl shadow-sm hover:shadow-xl border border-gray-100 overflow-hidden transition-all duration-300 hover:-translate-y-1 {{ $class }}">
    @if($image)
    <div class="aspect-video overflow-hidden relative">
        <img src="{{ $image }}" alt="{{ $title }}" loading="lazy" decoding="async"
            class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
        @if($badge)
        <div class="absolute top-3 left-3">
            <span class="px-3 py-1 bg-white/90 backdrop-blur-sm text-primary text-xs font-bold rounded-full shadow-sm">
                {{ $badge }}
            </span>
        </div>
        @endif
    </div>
    @endif
    <div class="p-6">
        @if($date)
        <div class="flex items-center gap-2 text-gray-400 text-xs mb-3">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
            {{ $date }}
        </div>
        @endif
        <h3 class="text-lg font-bold text-gray-900 mb-2 group-hover:text-primary transition font-heading line-clamp-2">
            {{ $title }}
        </h3>
        <p class="text-gray-600 text-sm leading-relaxed line-clamp-3">{{ $description }}</p>
        
        @if($footer)
        <div class="mt-4 pt-4 border-t border-gray-100">
            {{ $footer }}
        </div>
        @else
        <div class="mt-4 flex items-center text-primary text-sm font-medium gap-1 group-hover:gap-2 transition-all">
            Selengkapnya
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
            </svg>
        </div>
        @endif
    </div>
</a>
