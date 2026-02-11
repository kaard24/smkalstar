

<?php $__env->startSection('title', 'Galeri - SMK Al-Hidayah Lestari'); ?>

<?php $__env->startSection('content'); ?>
    <!-- Header Page - Unique Design -->
    <div class="relative bg-gradient-to-br from-blue-50 via-sky-50 to-cyan-50 py-16 md:py-24 border-b border-blue-100 overflow-hidden">
        <!-- Decorative Elements -->
        <div class="absolute inset-0">
            <div class="absolute top-1/2 left-0 w-96 h-96 bg-blue-300/20 rounded-full blur-3xl -translate-y-1/2"></div>
            <div class="absolute top-0 right-1/4 w-72 h-72 bg-sky-300/20 rounded-full blur-3xl"></div>
            <!-- Camera/Photo Pattern -->
            <div class="absolute inset-0 opacity-10" style="background-image: url('data:image/svg+xml,%3Csvg width=&quot;32&quot; height=&quot;32&quot; viewBox=&quot;0 0 32 32&quot; xmlns=&quot;http://www.w3.org/2000/svg&quot;%3E%3Ccircle cx=&quot;16&quot; cy=&quot;16&quot; r=&quot;2&quot; fill=&quot;%233b82f6&quot; fill-opacity=&quot;0.4&quot;/%3E%3C/svg%3E');"></div>
        </div>
        
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
            <div class="inline-flex items-center gap-2 bg-white/80 backdrop-blur-sm border border-blue-200 px-4 py-1.5 rounded-full text-sm font-medium text-blue-700 mb-6">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                Dokumentasi
            </div>
            <h1 class="text-3xl md:text-4xl lg:text-5xl xl:text-6xl font-bold text-gray-900 mb-4 font-heading">
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-500 via-sky-500 to-cyan-500">Galeri</span> Kegiatan
            </h1>
            <p class="text-gray-600 text-lg md:text-xl max-w-3xl mx-auto leading-relaxed">Dokumentasi momen-momen berharga dan kegiatan seru di SMK Al-Hidayah Lestari</p>
        </div>
    </div>

    <!-- Gallery Section -->
    <section class="py-12 md:py-16 bg-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <?php if($galeri->isEmpty()): ?>
            <!-- Enhanced Empty State -->
            <div class="max-w-2xl mx-auto">
                <div class="relative bg-gradient-to-br from-fuchsia-50 via-purple-50 to-pink-50 border border-fuchsia-100 rounded-3xl p-12 md:p-16 text-center overflow-hidden">
                    <!-- Decorative Background -->
                    <div class="absolute inset-0">
                        <div class="absolute top-10 right-10 w-32 h-32 bg-fuchsia-300/20 rounded-full blur-2xl animate-pulse"></div>
                        <div class="absolute bottom-10 left-10 w-24 h-24 bg-purple-300/20 rounded-full blur-2xl animate-pulse" style="animation-delay: 0.5s;"></div>
                    </div>
                    
                    <!-- Camera Illustration -->
                    <div class="relative z-10">
                        <div class="w-28 h-28 mx-auto mb-6 bg-gradient-to-br from-fuchsia-100 to-purple-100 rounded-3xl flex items-center justify-center shadow-xl rotate-3 hover:rotate-0 transition-transform duration-500">
                            <svg class="w-14 h-14 text-fuchsia-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-3">Galeri Masih Kosong</h3>
                        <p class="text-gray-500 mb-2 max-w-md mx-auto">Dokumentasi kegiatan sekolah akan segera ditampilkan di sini.</p>
                        <p class="text-fuchsia-500 text-sm font-medium">✨ Stay tuned for amazing moments!</p>
                    </div>
                </div>
            </div>
            <?php else: ?>
            <div class="columns-2 md:columns-3 lg:columns-4 gap-4 space-y-4">
                <?php $__currentLoopData = $galeri; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="group relative overflow-hidden rounded-2xl shadow-md hover:shadow-xl transition-all duration-300 cursor-pointer break-inside-avoid mb-4" 
                     onclick="openLightbox('<?php echo e($item->gambar_url); ?>', '<?php echo e(addslashes($item->keterangan ?? '')); ?>')">
                    <div class="w-full">
                        <img src="<?php echo e($item->gambar_url); ?>" alt="<?php echo e($item->keterangan ?? 'Galeri'); ?>" 
                             class="w-full h-auto object-cover group-hover:scale-110 transition-transform duration-500" loading="lazy" decoding="async">
                    </div>
                    <?php if($item->keterangan): ?>
                    <div class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-black/70 to-transparent p-4 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <p class="text-white text-sm font-medium line-clamp-3"><?php echo e($item->keterangan); ?></p>
                    </div>
                    <?php endif; ?>
                    <div class="absolute inset-0 bg-primary/20 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center pointer-events-none">
                        <span class="bg-white/90 p-3 rounded-full shadow-lg transform scale-0 group-hover:scale-100 transition-transform duration-300">
                            <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"></path></svg>
                        </span>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <?php endif; ?>
        </div>
    </section>

    <!-- Lightbox Modal -->
    <div id="lightbox" class="fixed inset-0 z-50 hidden bg-black/90 flex items-center justify-center p-4" onclick="closeLightbox()">
        <button class="absolute top-4 right-4 text-white hover:text-gray-300 transition" onclick="closeLightbox()">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>
        <div class="max-w-5xl max-h-[90vh] flex flex-col items-center" onclick="event.stopPropagation()">
            <img id="lightbox-img" src="" alt="Foto galeri - tampilan penuh" class="max-w-full max-h-[80vh] object-contain rounded-lg shadow-2xl">
            <p id="lightbox-caption" class="text-white text-center mt-4 text-lg"></p>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\eka\.gemini\antigravity\scratch\smk-alstar\resources\views/galeri.blade.php ENDPATH**/ ?>