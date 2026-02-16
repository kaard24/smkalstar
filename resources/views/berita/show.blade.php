@extends('layouts.app')

@section('title', $berita->judul . ' - SMK Al-Hidayah Lestari')

@section('content')
    <!-- Article Content -->
    <article class="py-12 md:py-16">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-4xl mx-auto">
                <!-- Article Header -->
                <header class="mb-8">
                    <h1 class="text-2xl md:text-4xl font-bold text-gray-900 mb-4">{{ $berita->judul }}</h1>
                    <div class="flex items-center gap-4 text-sm text-gray-500">
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            {{ $berita->published_at ? $berita->published_at->format('d M Y') : '-' }}
                        </div>
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                            {{ $berita->approvedKomentar->count() }} Komentar
                        </div>
                    </div>
                </header>

                <!-- Image Gallery -->
                @if(!empty($berita->gambar_urls))
                <div class="mb-8">
                    @if(count($berita->gambar_urls) == 1)
                    <img src="{{ $berita->gambar_urls[0] }}" alt="{{ $berita->judul }}" class="w-full rounded-2xl shadow-lg" fetchpriority="high" decoding="async">
                    @else
                    <div class="grid grid-cols-2 gap-4">
                        @foreach($berita->gambar_urls as $index => $url)
                        <div class="{{ $index === 0 ? 'col-span-2' : '' }}">
                            <img src="{{ $url }}" alt="{{ $berita->judul }} - Gambar {{ $index + 1 }}" 
                                 class="w-full {{ $index === 0 ? 'h-80 md:h-96' : 'h-48' }} object-cover rounded-xl shadow-md cursor-pointer hover:opacity-90 transition"
                                 onclick="openImageModal('{{ $url }}')" {{ $index === 0 ? 'fetchpriority="high"' : 'loading="lazy"' }} decoding="async">
                        </div>
                        @endforeach
                    </div>
                    @endif
                </div>
                @endif

                <!-- Article Body -->
                <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed">
                    {!! $berita->isi !!}
                </div>


            </div>
        </div>
    </article>

    <!-- Comments Section -->
    <section class="py-12 bg-gray-50">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-4xl mx-auto">
                <h2 class="text-2xl font-bold text-gray-900 mb-8">Komentar ({{ $berita->approvedKomentar->count() }})</h2>

                @if(session('success'))
                <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-700 rounded-xl flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    {{ session('success') }}
                </div>
                @endif

                @if(session('error'))
                <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-700 rounded-xl flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    {{ session('error') }}
                </div>
                @endif

                @if($errors->any())
                <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-700 rounded-xl">
                    <ul class="list-disc list-inside space-y-1">
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <!-- Comment Form -->
                @if($hasCommented)
                <div class="bg-blue-50 rounded-2xl border border-blue-200 p-6 mb-8">
                    <div class="flex items-center gap-3">
                        <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <div>
                            <h3 class="font-semibold text-blue-900">Anda sudah berkomentar</h3>
                            <p class="text-sm text-blue-700">Terima kasih! Anda hanya dapat memberikan 1 komentar per berita.</p>
                        </div>
                    </div>
                </div>
                @else
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-8">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Tulis Komentar</h3>
                    <form action="{{ route('berita.komentar', $berita->slug) }}" method="POST" class="space-y-4" id="commentForm">
                        @csrf
                        @auth('spmb')
                        <div>
                            <p class="text-sm font-medium text-gray-700 mb-1">Berkomentar sebagai:</p>
                            <p class="text-lg font-bold text-primary">{{ auth('spmb')->user()->nama }}</p>
                            <input type="hidden" name="username" value="{{ auth('spmb')->user()->nama }}">
                        </div>
                        @else
                        <div>
                            <label for="username" class="block text-sm font-medium text-gray-700 mb-1">
                                Nama Anda <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="username" name="username" required 
                                maxlength="50" pattern="[a-zA-Z\s]+" title="Hanya huruf dan spasi yang diperbolehkan"
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition @error('username') border-red-500 @enderror"
                                placeholder="Masukkan nama Anda (hanya huruf)"
                                oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '')">
                            <p class="text-xs text-gray-500 mt-1">* Hanya huruf dan spasi, maksimal 50 karakter</p>
                        </div>
                        @endauth
                        <div>
                            <label for="komentar" class="block text-sm font-medium text-gray-700 mb-1">
                                Komentar <span class="text-red-500" aria-hidden="true">*</span>
                            </label>
                            <textarea id="komentar" name="komentar" rows="3" required 
                                maxlength="100" pattern="[a-zA-Z\s]+" title="Hanya huruf dan spasi yang diperbolehkan"
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition @error('komentar') border-red-500 @enderror"
                                placeholder="Tulis komentar Anda (hanya huruf, tanpa link)..."
                                aria-required="true"
                                oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, ''); updateCharCount(this);"></textarea>
                            <div class="flex justify-between mt-1">
                                <p class="text-xs text-gray-500">* Hanya huruf dan spasi, tanpa angka/simbol/link</p>
                                <p class="text-xs text-gray-500"><span id="charCount">0</span>/100</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-2">
                            <input type="checkbox" id="show_username" name="show_username" value="1" checked
                                class="w-4 h-4 text-primary rounded border-gray-300 focus:ring-primary">
                            <label for="show_username" class="text-sm text-gray-600">Tampilkan nama saya (jika tidak dicentang, akan ditampilkan sebagai "Anonim")</label>
                        </div>
                        <div>
                            <button type="submit" class="px-6 py-3 bg-primary text-white rounded-xl font-semibold hover:bg-secondary transition shadow-lg shadow-primary/25">
                                Kirim Komentar
                            </button>
                        </div>
                    </form>
                </div>
                @endif

                <!-- Comments List -->
                @if($berita->approvedKomentar->isEmpty())
                <div class="text-center py-12">
                    <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                    <p class="text-gray-500">Belum ada komentar. Jadilah yang pertama berkomentar!</p>
                </div>
                @else
                <div class="space-y-4">
                    @foreach($berita->approvedKomentar as $komentar)
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 bg-primary/10 rounded-full flex items-center justify-center flex-shrink-0">
                                @if($komentar->show_username)
                                <span class="text-primary font-bold text-lg">{{ strtoupper(substr($komentar->username, 0, 1)) }}</span>
                                @else
                                <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                @endif
                            </div>
                            <div class="flex-1">
                                <div class="flex items-center gap-2 mb-1">
                                    <h4 class="font-semibold text-gray-900">{{ $komentar->display_name }}</h4>
                                    <span class="text-xs text-gray-400">•</span>
                                    <span class="text-xs text-gray-500">{{ $komentar->created_at->diffForHumans() }}</span>
                                </div>
                                <p class="text-gray-600">{{ $komentar->komentar }}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif
            </div>
        </div>
    </section>

    <!-- Related Articles -->
    @if($related->isNotEmpty())
    <section class="py-12 bg-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-6xl mx-auto">
                <h2 class="text-2xl font-bold text-gray-900 mb-8">Berita Lainnya</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach($related as $item)
                    <article class="bg-white rounded-xl shadow-sm hover:shadow-lg transition-all duration-300 overflow-hidden group border border-gray-100">
                        <a href="{{ route('berita.show', $item->slug) }}">
                            <div class="aspect-video overflow-hidden bg-gray-100">
                                @if($item->gambar_utama)
                                <img src="{{ $item->gambar_utama }}" alt="{{ $item->judul }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" loading="lazy" decoding="async">
                                @else
                                <div class="w-full h-full flex items-center justify-center">
                                    <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                                </div>
                                @endif
                            </div>
                            <div class="p-4">
                                <p class="text-xs text-gray-500 mb-2">{{ $item->published_at ? $item->published_at->format('d M Y') : '-' }}</p>
                                <h3 class="font-semibold text-gray-900 group-hover:text-primary transition line-clamp-2">{{ $item->judul }}</h3>
                            </div>
                        </a>
                    </article>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    @endif

    <!-- Image Modal -->
    <div id="imageModal" class="fixed inset-0 z-50 hidden bg-black/90 flex items-center justify-center p-4" onclick="closeImageModal()">
        <button class="absolute top-4 right-4 text-white hover:text-gray-300 transition">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>
        <img id="modalImage" src="" alt="Gambar berita - tampilan penuh" class="max-w-full max-h-[90vh] object-contain rounded-lg" onclick="event.stopPropagation()">
    </div>

    @push('scripts')
    <script>
        // Character counter for comment textarea
        function updateCharCount(textarea) {
            const count = textarea.value.length;
            document.getElementById('charCount').textContent = count;
        }
        
        // Initialize character count on page load
        document.addEventListener('DOMContentLoaded', function() {
            const textarea = document.getElementById('komentar');
            if (textarea) {
                updateCharCount(textarea);
            }
        });
    </script>
    @endpush

@endsection
