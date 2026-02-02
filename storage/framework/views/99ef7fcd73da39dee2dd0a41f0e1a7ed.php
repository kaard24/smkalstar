

<?php $__env->startSection('title', 'Ekstrakurikuler - SMK Al-Hidayah Lestari'); ?>

<?php $__env->startSection('content'); ?>
    <!-- Header Page -->
    <div class="bg-sky-50 py-12 border-b border-sky-100">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-2">Ekstrakurikuler</h1>
            <p class="text-gray-600">Wadah pengembangan bakat dan minat siswa di luar jam pelajaran</p>
        </div>
    </div>

    <section class="py-20 bg-gray-50" x-data="{
        lightboxOpen: false,
        activeImages: [],
        activeIndex: 0,
        activeCaption: '',
        openLightbox(images, caption) {
            this.activeImages = images;
            this.activeIndex = 0;
            this.activeCaption = caption;
            this.lightboxOpen = true;
            document.body.style.overflow = 'hidden';
        },
        closeLightbox() {
            this.lightboxOpen = false;
            document.body.style.overflow = 'auto';
            setTimeout(() => { this.activeImages = []; }, 300);
        },
        nextImage() {
            this.activeIndex = (this.activeIndex + 1) % this.activeImages.length;
        },
        prevImage() {
            this.activeIndex = this.activeIndex === 0 ? this.activeImages.length - 1 : this.activeIndex - 1;
        }
    }" @keydown.escape.window="closeLightbox()">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
             <?php if($ekstrakurikuler->count() > 0): ?>
             <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                 <?php $__currentLoopData = $ekstrakurikuler; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                 <?php
                    $images = $item->gambar_urls;
                    if (empty($images)) {
                        $images = ['https://via.placeholder.com/800x600?text=No+Image'];
                    }
                 ?>
                 <div class="bg-white rounded-3xl shadow-sm border border-gray-100 hover:shadow-2xl transition-all duration-300 p-4 pb-8 text-center group cursor-pointer flex flex-col items-center"
                      @click="openLightbox(<?php echo e(json_encode($images)); ?>, '<?php echo e(addslashes($item->nama)); ?>')">
                     
                     <div class="w-full h-48 mb-6 overflow-hidden rounded-2xl relative shadow-sm">
                         <?php if($item->gambar_url): ?>
                         <img src="<?php echo e($item->gambar_urls[0]); ?>" alt="<?php echo e($item->nama); ?>" class="w-full h-full object-cover group-hover:scale-110 transition duration-700" loading="lazy" decoding="async">
                         <?php else: ?>
                         <div class="w-full h-full bg-sky-50 flex items-center justify-center text-primary group-hover:bg-primary group-hover:text-white transition duration-300">
                            <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path></svg>
                         </div>
                         <?php endif; ?>

                         <!-- Multiple items indicator -->
                         <?php if(count($images) > 1): ?>
                         <div class="absolute top-3 right-3 bg-black/60 backdrop-blur-md text-white text-xs font-bold px-2.5 py-1 rounded-full flex items-center gap-1">
                             <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                             <?php echo e(count($images)); ?>

                         </div>
                         <?php endif; ?>
                     </div>

                     <h3 class="font-bold text-gray-900 text-xl font-heading mb-2 group-hover:text-primary transition"><?php echo e($item->nama); ?></h3>
                     <?php if($item->deskripsi): ?>
                     <p class="text-sm text-gray-500 leading-relaxed line-clamp-3 px-2"><?php echo e($item->deskripsi); ?></p>
                     <?php endif; ?>
                 </div>
                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
             </div>
             <?php else: ?>
             <div class="text-center py-20 bg-white rounded-3xl border border-gray-100">
                 <svg class="w-20 h-20 mx-auto text-gray-300 mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                 <p class="text-gray-500 text-xl font-light">Belum ada data ekstrakurikuler</p>
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

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\eka\.gemini\antigravity\scratch\smk-alstar\resources\views/ekstrakurikuler.blade.php ENDPATH**/ ?>