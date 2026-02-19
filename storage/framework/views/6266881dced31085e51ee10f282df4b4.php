<?php $__env->startSection('title', 'Berita - SMK Al-Hidayah Lestari'); ?>

<?php $__env->startSection('content'); ?>
    <!-- Header Page - Unique Design -->
    <div class="relative bg-gradient-to-br from-cyan-50 via-sky-50 to-blue-50 py-16 md:py-24 border-b border-cyan-100 overflow-hidden">
        <!-- Decorative Elements -->
        <div class="absolute inset-0">
            <div class="absolute top-0 left-1/4 w-96 h-96 bg-cyan-300/20 rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 right-1/4 w-72 h-72 bg-sky-300/20 rounded-full blur-3xl"></div>
            <!-- News Pattern -->
            <div class="absolute inset-0 opacity-10" style="background-image: repeating-linear-gradient(45deg, #06b6d4 0, #06b6d4 1px, transparent 0, transparent 50%); background-size: 20px 20px;"></div>
        </div>
        
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
            <div class="inline-flex items-center gap-2 bg-white/80 backdrop-blur-sm border border-cyan-200 px-4 py-1.5 rounded-full text-sm font-medium text-cyan-700 mb-6">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                Update Terkini
            </div>
            <h1 class="text-3xl md:text-4xl lg:text-5xl xl:text-6xl font-bold text-gray-900 mb-4 font-heading">
                Berita & <span class="text-transparent bg-clip-text bg-gradient-to-r from-cyan-500 to-blue-600">Informasi</span>
            </h1>
            <p class="text-gray-600 text-lg md:text-xl max-w-3xl mx-auto leading-relaxed">Ikuti perkembangan terbaru, kegiatan, dan informasi penting seputar SMK Al-Hidayah Lestari</p>
            
            <!-- Search Form -->
            <form action="<?php echo e(route('berita.index')); ?>" method="GET" class="mt-8 max-w-2xl mx-auto">
                <div class="relative flex items-center">
                    <input type="text" name="search" value="<?php echo e(request('search')); ?>" 
                           placeholder="Cari berita..." 
                           class="w-full px-6 py-4 pr-32 rounded-full border border-gray-200 shadow-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent outline-none transition text-gray-700"
                           aria-label="Cari berita">
                    <button type="submit" 
                            class="absolute right-2 top-1/2 -translate-y-1/2 bg-gradient-to-r from-cyan-500 to-blue-600 text-white px-6 py-2.5 rounded-full font-medium hover:shadow-lg hover:scale-105 transition duration-200">
                        Cari
                    </button>
                </div>
                <?php if(request('search')): ?>
                <div class="mt-3 flex items-center justify-center gap-2 text-sm text-gray-600">
                    <span>Hasil pencarian untuk: <strong class="text-cyan-600">"<?php echo e(request('search')); ?>"</strong></span>
                    <a href="<?php echo e(route('berita.index')); ?>" class="text-red-500 hover:text-red-600 flex items-center gap-1 ml-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        Reset
                    </a>
                </div>
                <?php endif; ?>
            </form>
        </div>
    </div>

    <!-- Berita List Section -->
    <section class="py-12 md:py-16 bg-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <?php if($berita->isEmpty()): ?>
            <!-- Enhanced Empty State -->
            <div class="max-w-2xl mx-auto">
                <div class="relative bg-gradient-to-br from-slate-50 to-gray-50 border border-gray-200 rounded-3xl p-12 md:p-16 text-center overflow-hidden">
                    <!-- Decorative Background -->
                    <div class="absolute inset-0 opacity-50">
                        <div class="absolute top-0 right-0 w-64 h-64 bg-gradient-to-br from-cyan-200/30 to-blue-200/30 rounded-full blur-3xl -translate-y-1/2 translate-x-1/2"></div>
                        <div class="absolute bottom-0 left-0 w-48 h-48 bg-gradient-to-tr from-purple-200/30 to-pink-200/30 rounded-full blur-3xl translate-y-1/2 -translate-x-1/2"></div>
                    </div>
                    
                    <!-- Content -->
                    <div class="relative z-10">
                        <div class="w-24 h-24 mx-auto mb-6 bg-gradient-to-br from-cyan-100 to-blue-100 rounded-2xl flex items-center justify-center shadow-lg">
                            <svg class="w-12 h-12 text-cyan-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                                <circle cx="12" cy="12" r="3" class="animate-pulse" style="transform-origin: center;" />
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-3">Belum Ada Berita</h3>
                        <p class="text-gray-500 mb-6 max-w-md mx-auto">Nantikan update terbaru dari kami. Berita, pengumuman, dan informasi penting akan segera hadir di sini.</p>
                        <a href="<?php echo e(url('/spmb/info')); ?>" class="inline-flex items-center gap-2 text-cyan-600 hover:text-cyan-700 font-medium transition">
                            <span>Lihat Info SPMB</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                        </a>
                    </div>
                </div>
            </div>
            <?php else: ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
                <?php $__currentLoopData = $berita; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <article class="bg-white rounded-2xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden group border border-gray-100">
                    <a href="<?php echo e(route('berita.show', $item->slug)); ?>">
                        <div class="aspect-video overflow-hidden bg-gray-100">
                            <?php if($item->gambar_utama): ?>
                            <img src="<?php echo e($item->gambar_utama); ?>" alt="<?php echo e($item->judul); ?>" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" loading="lazy" decoding="async">
                            <?php else: ?>
                            <div class="w-full h-full flex items-center justify-center">
                                <svg class="w-16 h-16 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                            </div>
                            <?php endif; ?>
                        </div>
                        <div class="p-6">
                            <div class="flex items-center gap-2 text-xs text-gray-500 mb-3">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                <?php echo e($item->published_at ? $item->published_at->format('d M Y') : '-'); ?>

                            </div>
                            <h3 class="font-bold text-lg text-gray-900 mb-2 group-hover:text-primary transition line-clamp-2"><?php echo e($item->judul); ?></h3>
                            <p class="text-gray-600 text-sm line-clamp-3"><?php echo e($item->excerpt); ?></p>
                            <div class="mt-4 flex items-center text-primary font-medium text-sm group-hover:gap-2 transition-all">
                                Baca Selengkapnya
                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                            </div>
                        </div>
                    </a>
                </article>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <!-- Pagination -->
            <?php if($berita->hasPages()): ?>
            <div class="mt-12 flex justify-center">
                <?php echo e($berita->links()); ?>

            </div>
            <?php endif; ?>
            <?php endif; ?>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\user\.gemini\antigravity\scratch\smkalstar\smkalstar\resources\views/berita/index.blade.php ENDPATH**/ ?>