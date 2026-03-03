

<?php $__env->startSection('title', 'Beranda - SMK Al-Hidayah Lestari'); ?>

<?php $__env->startSection('content'); ?>
    <!-- Hero Section -->
    <section class="relative min-h-[60vh] lg:min-h-[72vh] flex items-center bg-white overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-slate-50 to-blue-50"></div>
        <div class="absolute top-0 right-0 w-1/2 h-full bg-gradient-to-l from-blue-100/30 to-transparent"></div>
        
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid lg:grid-cols-2 gap-6 lg:gap-10 items-center py-8 lg:py-14">
                <!-- Left Content -->
                <div class="max-w-lg">
                    <div class="inline-flex items-center gap-2 bg-blue-100 text-blue-700 px-3 py-1.5 rounded-full text-xs sm:text-sm font-medium mb-3">
                        <span class="w-2 h-2 bg-blue-500 rounded-full animate-pulse"></span>
                        <?php echo e($hero->badge_text); ?>

                    </div>
                    
                    <h1 class="text-2xl sm:text-4xl lg:text-5xl font-bold text-slate-900 leading-tight mb-3">
                        <?php echo e($hero->title_line1); ?> 
                        <span class="text-blue-600"><?php echo e($hero->title_highlight); ?></span> 
                        <span class="text-cyan-600"><?php echo e($hero->title_line2); ?></span>
                    </h1>

                    <!-- Mobile Hero Image -->
                    <?php if(!empty($hero->hero_image)): ?>
                    <div class="lg:hidden mb-4">
                        <div class="relative rounded-2xl overflow-hidden shadow-md border border-slate-100 bg-white">
                            <img src="<?php echo e(asset($hero->hero_image)); ?>" alt="SMK Al-Hidayah" class="w-full aspect-[16/10] object-cover">
                        </div>
                    </div>
                    <?php endif; ?>
                    
                    <p class="text-sm sm:text-base lg:text-lg text-slate-600 mb-4 leading-relaxed">
                        <?php echo e($hero->description); ?>

                    </p>
                    
                    <div class="flex flex-col sm:flex-row gap-3">
                        <a href="<?php echo e(url($hero->button_primary_url)); ?>" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded-xl transition-all shadow-md hover:shadow-lg hover:-translate-y-0.5">
                            <?php echo e($hero->button_primary_text); ?>

                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                        </a>
                        <a href="<?php echo e(url($hero->button_secondary_url)); ?>" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 bg-white hover:bg-gray-50 text-slate-700 font-semibold px-6 py-3 rounded-xl border border-gray-200 transition-all">
                            <?php echo e($hero->button_secondary_text); ?>

                        </a>
                    </div>
                </div>
                
                <!-- Right Image -->
                <?php if(!empty($hero->hero_image)): ?>
                <div class="relative hidden lg:block">
                    <div class="relative rounded-3xl overflow-hidden shadow-xl max-w-xl ml-auto">
                        <img src="<?php echo e(asset($hero->hero_image)); ?>" alt="SMK Al-Hidayah" class="w-full aspect-[4/3] object-cover">
                    </div>

                </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- Tentang Kami Section -->
    <section id="sejarah" class="py-16 lg:py-20 bg-slate-50 pb-24 lg:pb-20">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-8 lg:gap-12 items-center">
                <div class="relative">
                    <?php
                        $sejarahGambarUrls = $profil->sejarah_gambar_urls ?? [];
                    ?>

                    <?php if(!empty($sejarahGambarUrls)): ?>
                        <div x-data="{ 
                                activeSlide: 0, 
                                slides: <?php echo e(json_encode($sejarahGambarUrls)); ?>,
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
                    <?php else: ?>
                        <div class="rounded-3xl border border-slate-200 bg-white/70 aspect-[4/3] flex items-center justify-center text-slate-400 text-sm">
                            Belum ada gambar
                        </div>
                    <?php endif; ?>
                </div>
                
                <div>
                    <span class="text-blue-600 font-semibold text-sm uppercase tracking-wide">Tentang Kami</span>
                    <h2 class="text-2xl lg:text-3xl font-bold text-slate-900 mt-2 mb-5"><?php echo e($profil->sejarah_judul ?? 'SMK Al-Hidayah Lestari'); ?></h2>
                    <div class="prose prose-base text-gray-600">
                        <?php if($profil && $profil->sejarah_konten): ?>
                            <?php
                                $sejarahParagraphs = collect(explode("\n", $profil->sejarah_konten))
                                    ->map(fn ($p) => trim($p))
                                    ->filter()
                                    ->values();
                            ?>

                            <div class="md:hidden">
                                <p class="mb-4"><?php echo e($sejarahParagraphs->first()); ?></p>
                            </div>

                            <div class="hidden md:block">
                                <?php $__currentLoopData = $sejarahParagraphs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $paragraph): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <p class="mb-4"><?php echo e($paragraph); ?></p>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        <?php else: ?>
                            <p class="mb-4">SMK Al-Hidayah Lestari didirikan dengan visi untuk mencetak generasi unggul yang memiliki kompetensi di bidang teknologi dan bisnis, serta berakhlak mulia.</p>
                        <?php endif; ?>
                    </div>
                    <a href="<?php echo e(url('/profil')); ?>" class="inline-flex items-center gap-2 text-blue-600 font-semibold mt-6 hover:text-blue-700">
                        Pelajari Lebih Lanjut
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Jurusan Section -->
    <section class="py-16 lg:py-20 bg-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-2xl mx-auto mb-10">
                <span class="text-blue-600 font-semibold text-sm uppercase tracking-wide">Program Keahlian</span>
                <h2 class="text-xl sm:text-2xl lg:text-3xl font-bold text-slate-900 mt-2 mb-3">Pilih Jurusan Favoritmu</h2>
                <p class="text-gray-600">Program keahlian unggulan yang siap menyiapkanmu untuk dunia kerja dan industri.</p>
            </div>

            <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-6">
                <?php
                    $jurusanThemes = [
                        ['bg' => 'bg-blue-50', 'text' => 'text-blue-600'],
                        ['bg' => 'bg-green-50', 'text' => 'text-green-600'],
                        ['bg' => 'bg-purple-50', 'text' => 'text-purple-600'],
                        ['bg' => 'bg-orange-50', 'text' => 'text-orange-600'],
                    ];
                ?>

                <?php $__empty_1 = true; $__currentLoopData = $jurusanHome; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $j): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <?php
                    $theme = $jurusanThemes[$index % count($jurusanThemes)];
                ?>
                <a href="<?php echo e(url('/jurusan/' . strtolower($j->kode))); ?>" class="group h-full min-w-0 bg-white border border-gray-100 rounded-xl sm:rounded-2xl p-3 sm:p-5 shadow-sm hover:shadow-lg transition-all hover:-translate-y-1 flex flex-col">
                    <div class="w-full aspect-square <?php echo e($theme['bg']); ?> rounded-lg sm:rounded-xl flex items-center justify-center mb-3 sm:mb-5 overflow-hidden">
                        <img src="<?php echo e($j->logo_url ?? asset('images/logo/default.jpeg')); ?>" alt="<?php echo e($j->kode); ?>" class="w-3/4 h-3/4 object-contain group-hover:scale-110 transition-transform duration-300">
                    </div>
                    <h3 class="font-bold text-slate-900 mb-1 text-sm sm:text-base"><?php echo e($j->kode); ?></h3>
                    <p class="text-xs sm:text-sm text-gray-600 mb-2 sm:mb-4 leading-snug flex-1"><?php echo e($j->nama); ?></p>
                    <span class="inline-flex items-center gap-1 <?php echo e($theme['text']); ?> font-semibold text-xs sm:text-sm">
                        Detail
                        <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </span>
                </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="col-span-2 lg:col-span-4 rounded-xl border border-dashed border-slate-300 p-6 text-center text-sm text-slate-500">
                    Data jurusan belum tersedia.
                </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- Fasilitas Section -->
    <?php if($fasilitas->isNotEmpty()): ?>
    <section class="py-16 lg:py-20 bg-slate-50">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-4 mb-10">
                <div>
                    <span class="text-blue-600 font-semibold text-sm uppercase tracking-wide">Fasilitas</span>
                    <h2 class="text-xl sm:text-2xl lg:text-3xl font-bold text-slate-900 mt-2">Sarana & Prasarana</h2>
                </div>
                <a href="<?php echo e(url('/fasilitas')); ?>" class="inline-flex items-center gap-2 text-blue-600 font-semibold hover:text-blue-700">
                    Lihat Semua
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
            </div>

            <div class="grid grid-cols-2 lg:grid-cols-3 gap-3 sm:gap-6">
                <?php $__currentLoopData = $fasilitas->take(6); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="group bg-white rounded-xl sm:rounded-2xl overflow-hidden shadow-sm hover:shadow-lg transition-all <?php echo e($index >= 4 ? 'hidden md:block' : ''); ?>">
                    <div class="aspect-[16/10] overflow-hidden bg-gray-100">
                        <?php if($item->gambar_url): ?>
                        <img src="<?php echo e($item->gambar_url); ?>" alt="<?php echo e($item->nama); ?>" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <?php else: ?>
                        <div class="w-full h-full flex items-center justify-center">
                            <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                        </div>
                        <?php endif; ?>
                    </div>
                    <div class="p-4">
                        <h3 class="font-bold text-slate-900"><?php echo e($item->nama); ?></h3>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- Galeri Section -->
    <?php if($galeri->isNotEmpty()): ?>
    <section class="py-16 lg:py-20 bg-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-4 mb-10">
                <div>
                    <span class="text-blue-600 font-semibold text-sm uppercase tracking-wide">Galeri</span>
                    <h2 class="text-xl sm:text-2xl lg:text-3xl font-bold text-slate-900 mt-2">Momen Berkesan</h2>
                </div>
                <a href="<?php echo e(url('/galeri')); ?>" class="inline-flex items-center gap-2 text-blue-600 font-semibold hover:text-blue-700">
                    Lihat Semua
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <?php $__currentLoopData = $galeri->take(8); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="relative group overflow-hidden rounded-xl cursor-pointer <?php echo e($index === 0 ? 'md:col-span-2 md:row-span-2' : 'aspect-square'); ?>" onclick="openImageModal('<?php echo e($item->gambar_url); ?>')">
                    <img src="<?php echo e($item->gambar_url); ?>" alt="<?php echo e($item->keterangan ?? 'Galeri'); ?>" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"/></svg>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- Berita Section -->
    <?php if($berita->isNotEmpty()): ?>
    <section class="py-16 lg:py-20 bg-slate-50">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-4 mb-10">
                <div>
                    <span class="text-blue-600 font-semibold text-sm uppercase tracking-wide">Berita</span>
                    <h2 class="text-xl sm:text-2xl lg:text-3xl font-bold text-slate-900 mt-2">Update Terbaru</h2>
                </div>
                <a href="<?php echo e(url('/berita')); ?>" class="inline-flex items-center gap-2 text-blue-600 font-semibold hover:text-blue-700">
                    Lihat Semua
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
            </div>

            <div class="grid md:grid-cols-3 gap-4 sm:gap-8">
                <?php $__currentLoopData = $berita; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <article class="bg-white rounded-xl sm:rounded-2xl overflow-hidden shadow-sm hover:shadow-lg transition-all">
                    <a href="<?php echo e(route('berita.show', $item->slug)); ?>">
                        <div class="aspect-[16/10] overflow-hidden bg-gray-100">
                            <?php if($item->gambar_utama): ?>
                            <img src="<?php echo e($item->gambar_utama); ?>" alt="<?php echo e($item->judul); ?>" class="w-full h-full object-cover hover:scale-105 transition-transform duration-500">
                            <?php else: ?>
                            <div class="w-full h-full flex items-center justify-center">
                                <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                            </div>
                            <?php endif; ?>
                        </div>
                        <div class="p-5">
                            <p class="text-sm text-gray-500 mb-2"><?php echo e($item->published_at ? $item->published_at->format('d M Y') : '-'); ?></p>
                            <h3 class="font-bold text-base sm:text-lg text-slate-900 mb-2 hover:text-blue-600 transition-colors"><?php echo e($item->judul); ?></h3>
                            <p class="text-gray-600 text-sm line-clamp-2"><?php echo e($item->excerpt); ?></p>
                        </div>
                    </a>
                </article>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- Beranda Dinamis (dari admin/beranda) -->
    <?php if(isset($berandaSections) && $berandaSections->isNotEmpty()): ?>
    <section class="py-16 lg:py-20 bg-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <?php $__currentLoopData = $berandaSections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type => $items): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($items->isEmpty()): ?>
                    <?php continue; ?>
                <?php endif; ?>
                <div class="mb-10 last:mb-0">
                    <h2 class="text-xl sm:text-2xl font-bold text-slate-900 mb-4 capitalize"><?php echo e($type); ?></h2>
                    <div class="grid md:grid-cols-2 gap-4 sm:gap-6">
                        <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <article class="bg-slate-50 border border-slate-100 rounded-xl sm:rounded-2xl p-5">
                            <?php if($section->gambar_url): ?>
                            <img src="<?php echo e($section->gambar_url); ?>" alt="<?php echo e($section->judul); ?>" class="w-full h-44 object-cover rounded-lg mb-4">
                            <?php endif; ?>
                            <h3 class="text-base sm:text-lg font-bold text-slate-900"><?php echo e($section->judul); ?></h3>
                            <?php if($section->subjudul): ?>
                            <p class="text-sm text-slate-500 mt-1"><?php echo e($section->subjudul); ?></p>
                            <?php endif; ?>
                            <?php if($section->konten): ?>
                            <p class="text-sm text-slate-600 mt-3 leading-relaxed"><?php echo e(\Illuminate\Support\Str::limit(strip_tags($section->konten), 180)); ?></p>
                            <?php endif; ?>
                            <?php if($section->tombol_teks && $section->tombol_link): ?>
                            <a href="<?php echo e(url($section->tombol_link)); ?>" class="inline-flex items-center gap-2 mt-4 text-sm font-semibold text-blue-600 hover:text-blue-700">
                                <?php echo e($section->tombol_teks); ?>

                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                            </a>
                            <?php endif; ?>
                        </article>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </section>
    <?php endif; ?>

    <!-- Image Modal -->
    <div id="imageModal" class="fixed inset-0 z-50 hidden bg-black/90 flex items-center justify-center p-4" onclick="closeImageModal()">
        <button class="absolute top-6 right-6 text-white/70 hover:text-white" onclick="event.stopPropagation(); closeImageModal()">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>
        <img id="modalImage" src="" alt="Galeri" class="max-w-full max-h-[85vh] object-contain rounded-lg" onclick="event.stopPropagation()">
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
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
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\eka\.gemini\antigravity\scratch\smk-alstar\resources\views/home.blade.php ENDPATH**/ ?>