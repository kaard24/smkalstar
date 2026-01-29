@extends('layouts.app')

@section('title', 'Galeri - SMK Al-Hidayah Lestari')

@section('content')
    <!-- Header Page -->
    <div class="bg-green-50 py-12 border-b border-green-100">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-2">Galeri</h1>
            <p class="text-gray-600">Dokumentasi kegiatan SMK Al-Hidayah Lestari</p>
        </div>
    </div>

    <!-- Gallery Section -->
    <section class="py-12 md:py-16 bg-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            @if($galeri->isEmpty())
            <div class="max-w-2xl mx-auto bg-gray-50 border-2 border-dashed border-gray-300 rounded-2xl p-12 flex flex-col items-center justify-center">
                <svg class="w-16 h-16 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                <p class="text-gray-500 font-medium text-lg">Galeri Foto Sekolah</p>
                <p class="text-gray-400 text-sm mt-2">Belum ada foto dalam galeri</p>
            </div>
            @else
            <div class="columns-2 md:columns-3 lg:columns-4 gap-4 space-y-4">
                @foreach($galeri as $item)
                <div class="group relative overflow-hidden rounded-2xl shadow-md hover:shadow-xl transition-all duration-300 cursor-pointer break-inside-avoid mb-4" 
                     onclick="openLightbox('{{ $item->gambar_url }}', '{{ addslashes($item->keterangan ?? '') }}')">
                    <div class="w-full">
                        <img src="{{ $item->gambar_url }}" alt="{{ $item->keterangan ?? 'Galeri' }}" 
                             class="w-full h-auto object-cover group-hover:scale-110 transition-transform duration-500">
                    </div>
                    @if($item->keterangan)
                    <div class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-black/70 to-transparent p-4 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <p class="text-white text-sm font-medium line-clamp-3">{{ $item->keterangan }}</p>
                    </div>
                    @endif
                    <div class="absolute inset-0 bg-primary/20 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center pointer-events-none">
                        <span class="bg-white/90 p-3 rounded-full shadow-lg transform scale-0 group-hover:scale-100 transition-transform duration-300">
                            <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"></path></svg>
                        </span>
                    </div>
                </div>
                @endforeach
            </div>
            @endif
        </div>
    </section>

    <!-- Lightbox Modal -->
    <div id="lightbox" class="fixed inset-0 z-50 hidden bg-black/90 flex items-center justify-center p-4" onclick="closeLightbox()">
        <button class="absolute top-4 right-4 text-white hover:text-gray-300 transition" onclick="closeLightbox()">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>
        <div class="max-w-5xl max-h-[90vh] flex flex-col items-center" onclick="event.stopPropagation()">
            <img id="lightbox-img" src="" alt="" class="max-w-full max-h-[80vh] object-contain rounded-lg shadow-2xl">
            <p id="lightbox-caption" class="text-white text-center mt-4 text-lg"></p>
        </div>
    </div>

    <script>
        function openLightbox(src, caption) {
            document.getElementById('lightbox-img').src = src;
            document.getElementById('lightbox-caption').textContent = caption;
            document.getElementById('lightbox').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeLightbox() {
            document.getElementById('lightbox').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeLightbox();
            }
        });
    </script>
@endsection
