<?php $__env->startSection('title', 'Prestasi - SMK Al-Hidayah Lestari'); ?>

<?php $__env->startSection('content'); ?>
    <!-- Header Page - Unique Design -->
    <div class="relative bg-gradient-to-br from-blue-50 via-sky-50 to-cyan-50 py-16 md:py-24 border-b border-blue-100 overflow-hidden">
        <!-- Decorative Elements -->
        <div class="absolute inset-0">
            <div class="absolute top-0 right-1/3 w-96 h-96 bg-blue-300/30 rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 left-1/3 w-72 h-72 bg-sky-300/30 rounded-full blur-3xl"></div>
            <!-- Trophy Sparkles -->
            <div class="absolute top-20 right-20 text-blue-400/30 text-6xl animate-pulse">✦</div>
            <div class="absolute bottom-20 left-20 text-sky-400/30 text-4xl animate-pulse" style="animation-delay: 0.5s;">✦</div>
            <div class="absolute top-1/2 right-1/4 text-blue-400/20 text-3xl animate-pulse" style="animation-delay: 1s;">★</div>
        </div>
        
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
            <div class="inline-flex items-center gap-2 bg-gradient-to-r from-blue-400 to-cyan-500 text-white px-4 py-1.5 rounded-full text-sm font-bold mb-6 shadow-lg">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/></svg>
                Pencapaian Gemilang
            </div>
            <h1 class="text-3xl md:text-4xl lg:text-5xl xl:text-6xl font-bold text-gray-900 mb-4 font-heading">
                Prestasi <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-500 via-sky-500 to-cyan-500">Sekolah</span>
            </h1>
            <p class="text-gray-600 text-lg md:text-xl max-w-3xl mx-auto leading-relaxed">Catatan kebanggaan dan bukti nyata kualitas pendidikan yang telah menghasilkan lulusan berprestasi</p>
        </div>
    </div>

    <section class="py-20 bg-gray-50" x-data="createLightboxData()" @keydown.escape.window="closeLightbox()">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <?php if($prestasi->count() > 0): ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php $__currentLoopData = $prestasi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    $images = $item->gambar_urls;
                ?>
                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-2xl transition-all duration-300 group cursor-pointer flex flex-col"
                     @click="openLightbox(<?php echo e(json_encode($images)); ?>, '<?php echo e(addslashes($item->judul)); ?>')">
                    <div class="relative h-64 overflow-hidden">
                        <?php if($item->gambar_url): ?>
                        <img src="<?php echo e($item->gambar_url); ?>" alt="<?php echo e($item->judul); ?>" class="w-full h-full object-cover group-hover:scale-110 transition duration-700" loading="lazy" decoding="async">
                        <?php else: ?>
                        <div class="w-full h-full bg-yellow-50 flex items-center justify-center text-yellow-500 group-hover:bg-yellow-100 transition duration-300">
                            <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path></svg>
                        </div>
                        <?php endif; ?>
                        
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-80 group-hover:opacity-60 transition duration-300"></div>

                        <div class="absolute top-4 left-4">
                            <span class="px-3 py-1 bg-white/90 backdrop-blur-sm text-primary rounded-full text-xs font-bold shadow-sm uppercase tracking-wider border border-white/50"><?php echo e($item->tahun); ?></span>
                        </div>
                        
                        <div class="absolute top-4 right-4">
                            <span class="px-3 py-1 bg-yellow-400/90 backdrop-blur-sm text-white rounded-full text-xs font-bold shadow-sm uppercase tracking-wider"><?php echo e($item->tingkat); ?></span>
                        </div>

                         <!-- Multiple items indicator -->
                         <?php if(count($images) > 1): ?>
                         <div class="absolute bottom-4 right-4 bg-black/60 backdrop-blur-md text-white text-xs font-bold px-2.5 py-1 rounded-full flex items-center gap-1 border border-white/10">
                             <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                             <?php echo e(count($images)); ?>

                         </div>
                         <?php endif; ?>
                    </div>
                    
                    <div class="p-8 flex-1 flex flex-col">
                        <h3 class="font-bold text-gray-900 text-xl font-heading mb-3 group-hover:text-primary transition leading-tight"><?php echo e($item->judul); ?></h3>
                        <?php if($item->deskripsi): ?>
                        <p class="text-sm text-gray-500 leading-relaxed line-clamp-3 mb-4"><?php echo e($item->deskripsi); ?></p>
                        <?php endif; ?>
                        
                        <div class="mt-auto pt-4 border-t border-gray-50 flex items-center text-primary text-sm font-medium gap-1 group-hover:translate-x-2 transition duration-300">
                            Lihat Detail
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                        </div>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <?php else: ?>
            <!-- Enhanced Empty State -->
            <div class="max-w-2xl mx-auto">
                <div class="relative bg-gradient-to-br from-amber-50 via-yellow-50 to-orange-50 border border-amber-100 rounded-3xl p-12 md:p-16 text-center overflow-hidden">
                    <div class="absolute inset-0">
                        <div class="absolute top-5 right-20 w-32 h-32 bg-yellow-300/30 rounded-full blur-2xl animate-pulse"></div>
                        <div class="absolute bottom-5 left-20 w-24 h-24 bg-orange-300/30 rounded-full blur-2xl animate-pulse" style="animation-delay: 0.5s;"></div>
                    </div>
                    
                    <div class="relative z-10">
                        <div class="w-28 h-28 mx-auto mb-6 bg-gradient-to-br from-amber-100 to-yellow-100 rounded-3xl flex items-center justify-center shadow-xl">
                            <svg class="w-14 h-14 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-3">Prestasi Akan Segera Diperbarui</h3>
                        <p class="text-gray-500">Kami sedang mengumpulkan data prestasi terbaru. Segera lihat pencapaian gemilang siswa-siswi kami!</p>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>

        <!-- Lightbox Modal -->
        <div x-show="lightboxOpen" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 backdrop-blur-none"
             x-transition:enter-end="opacity-100 backdrop-blur-xl"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 backdrop-blur-xl"
             x-transition:leave-end="opacity-0 backdrop-blur-none"
             class="fixed inset-0 z-[60] bg-black/95 backdrop-blur-xl flex items-center justify-center p-4"
             style="display: none;">
            
            <div class="absolute inset-0" @click="closeLightbox()"></div>

            <button class="absolute top-6 right-6 text-white/50 hover:text-white transition z-50 transform hover:scale-110 duration-200" @click="closeLightbox()">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>

            <!-- Navigation Buttons -->
            <button x-show="activeImages.length > 1" 
                    @click.stop="prevImage()" 
                    class="absolute left-4 md:left-8 top-1/2 -translate-y-1/2 text-white/70 hover:text-white transition p-3 hover:bg-white/10 rounded-full z-50">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
            </button>
            
            <button x-show="activeImages.length > 1" 
                    @click.stop="nextImage()" 
                    class="absolute right-4 md:right-8 top-1/2 -translate-y-1/2 text-white/70 hover:text-white transition p-3 hover:bg-white/10 rounded-full z-50">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            </button>

            <div class="max-w-7xl max-h-[90vh] w-full flex flex-col items-center relative z-40 pointer-events-none">
                <div class="relative w-full h-full flex items-center justify-center pointer-events-auto">
                    <img :src="activeImages.length > 0 ? activeImages[activeIndex] : ''" class="max-w-full max-h-[80vh] object-contain rounded-lg shadow-2xl transition-all duration-300">
                </div>
                <div class="text-white text-center mt-6 pointer-events-auto">
                    <h3 class="text-2xl font-bold font-heading mb-2" x-text="activeCaption"></h3>
                    <div x-show="activeImages.length > 1" class="inline-flex gap-1.5 mt-2">
                        <template x-for="(img, idx) in activeImages" :key="idx">
                            <button @click="activeIndex = idx" 
                                    class="h-1.5 rounded-full transition-all duration-300"
                                    :class="activeIndex === idx ? 'w-8 bg-white' : 'w-2 bg-white/30 hover:bg-white/50'">
                            </button>
                        </template>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\user\.gemini\antigravity\scratch\smkalstar\smkalstar\resources\views/prestasi.blade.php ENDPATH**/ ?>