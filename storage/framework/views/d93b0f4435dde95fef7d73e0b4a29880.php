

<?php $__env->startSection('title', 'Jadwal Seragam - SMK Al-Hidayah Lestari'); ?>

<?php $__env->startPush('styles'); ?>
<style>
/* Swipe Container */
.swipe-container {
    overflow: hidden;
    position: relative;
    touch-action: pan-y;
    user-select: none;
}

.swipe-wrapper {
    display: flex;
    transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    will-change: transform;
}

.swipe-slide {
    flex: 0 0 100%;
    width: 100%;
    padding: 0 1rem;
}

@media (min-width: 768px) {
    .swipe-slide {
        padding: 0 2rem;
    }
}

/* Day Indicator */
.day-indicator {
    display: flex;
    justify-content: center;
    gap: 0.5rem;
    margin-top: 1rem;
}

.day-dot {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background: rgba(255,255,255,0.4);
    transition: all 0.3s ease;
}

.day-dot.active {
    background: white;
    width: 24px;
    border-radius: 4px;
}

/* Photo Card */
.photo-card {
    background: white;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.photo-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 30px rgba(0,0,0,0.12);
}

.photo-container {
    position: relative;
    aspect-ratio: 3/4;
    overflow: hidden;
    background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
}

.photo-container img {
    width: 100%;
    height: 100%;
    object-fit: contain;
    transition: transform 0.3s ease;
}

.photo-container:hover img {
    transform: scale(1.02);
}

/* Photo Navigation */
.photo-nav {
    position: absolute;
    bottom: 12px;
    left: 50%;
    transform: translateX(-50%);
    display: flex;
    gap: 6px;
    padding: 6px 12px;
    background: rgba(0,0,0,0.5);
    border-radius: 20px;
    backdrop-filter: blur(4px);
}

.photo-dot {
    width: 6px;
    height: 6px;
    border-radius: 50%;
    background: rgba(255,255,255,0.5);
    transition: all 0.2s ease;
}

.photo-dot.active {
    background: white;
    width: 16px;
    border-radius: 3px;
}

/* Swipe Arrows */
.swipe-arrow {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    width: 44px;
    height: 44px;
    background: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 4px 15px rgba(0,0,0,0.15);
    cursor: pointer;
    transition: all 0.2s ease;
    z-index: 10;
}

.swipe-arrow:hover {
    background: #f8fafc;
    transform: translateY(-50%) scale(1.1);
}

.swipe-arrow:active {
    transform: translateY(-50%) scale(0.95);
}

.swipe-arrow.prev { left: 0.5rem; }
.swipe-arrow.next { right: 0.5rem; }

@media (min-width: 768px) {
    .swipe-arrow.prev { left: 1rem; }
    .swipe-arrow.next { right: 1rem; }
}

/* Lightbox */
.lightbox {
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,0.95);
    z-index: 100;
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    visibility: hidden;
    transition: all 0.3s ease;
}

.lightbox.active {
    opacity: 1;
    visibility: visible;
}

.lightbox img {
    max-width: 90%;
    max-height: 80vh;
    object-fit: contain;
    border-radius: 8px;
}

.lightbox-caption {
    position: absolute;
    bottom: 80px;
    left: 0;
    right: 0;
    text-align: center;
    color: white;
    padding: 1rem;
    background: linear-gradient(to top, rgba(0,0,0,0.8), transparent);
}

.lightbox-close {
    position: absolute;
    top: 20px;
    right: 20px;
    width: 44px;
    height: 44px;
    background: rgba(255,255,255,0.1);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    cursor: pointer;
    transition: background 0.2s ease;
}

.lightbox-close:hover {
    background: rgba(255,255,255,0.2);
}

.lightbox-nav {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    width: 50px;
    height: 50px;
    background: rgba(255,255,255,0.1);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    cursor: pointer;
    transition: background 0.2s ease;
}

.lightbox-nav:hover {
    background: rgba(255,255,255,0.2);
}

.lightbox-nav.prev { left: 20px; }
.lightbox-nav.next { right: 20px; }

/* Caption Badge */
.caption-badge {
    position: absolute;
    top: 12px;
    left: 12px;
    background: rgba(0,0,0,0.6);
    color: white;
    padding: 4px 10px;
    border-radius: 20px;
    font-size: 11px;
    backdrop-filter: blur(4px);
}

/* Gender Badge */
.gender-badge {
    position: absolute;
    top: 12px;
    right: 12px;
    width: 32px;
    height: 32px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 14px;
}

.gender-badge.male {
    background: linear-gradient(135deg, #3b82f6, #1d4ed8);
}

.gender-badge.female {
    background: linear-gradient(135deg, #ec4899, #be185d);
}

/* Empty State */
.empty-photo {
    aspect-ratio: 3/4;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%);
    color: #94a3b8;
}

.empty-photo svg {
    width: 48px;
    height: 48px;
    margin-bottom: 12px;
    opacity: 0.5;
}

/* Swipe Hint Animation */
@keyframes swipeHint {
    0%, 100% { transform: translateX(0); }
    50% { transform: translateX(10px); }
}

.swipe-hint {
    animation: swipeHint 1.5s ease-in-out infinite;
}

/* Dragging State */
.swipe-wrapper.dragging {
    transition: none;
}
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<!-- Header -->
<section class="bg-gradient-to-br from-[#4276A3] to-[#295286] py-12 md:py-16">
    <div class="max-w-4xl mx-auto px-4 text-center">
        <h1 class="text-3xl md:text-4xl font-bold text-white mb-3">
            Jadwal Seragam
        </h1>
        <p class="text-blue-100 text-lg">
            Informasi penggunaan seragam harian
        </p>
        
        <?php if($seragam->count() > 1): ?>
        <div class="mt-4 flex items-center justify-center gap-2 text-blue-200 text-sm">
            <svg class="w-5 h-5 swipe-hint" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18"/>
            </svg>
            <span>Swipe atau geser untuk melihat hari lain</span>
            <svg class="w-5 h-5 swipe-hint" style="animation-direction: reverse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
            </svg>
        </div>
        <?php endif; ?>
    </div>
</section>

<!-- Main Content -->
<section class="py-8 md:py-12 bg-gray-50" 
         x-data="seragamSwipe(<?php echo e($seragam->count()); ?>)"
         x-init="init()">
    <div class="max-w-5xl mx-auto px-4">
        
        <?php if($seragam->count() > 0): ?>
            <!-- Day Tabs -->
            <div class="flex justify-center mb-6 overflow-x-auto pb-2 scrollbar-hide">
                <div class="flex gap-2">
                    <?php $__currentLoopData = $seragam; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <button @click="goToSlide(<?php echo e($index); ?>)" 
                            :class="currentSlide === <?php echo e($index); ?> ? 'bg-[#4276A3] text-white' : 'bg-white text-slate-600 hover:bg-slate-50'"
                            class="px-4 py-2 rounded-full text-sm font-medium transition-all whitespace-nowrap border border-slate-200">
                        <?php echo e($item->hari); ?>

                    </button>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>

            <!-- Swipe Container -->
            <div class="swipe-container relative"
                 @touchstart="touchStart($event)"
                 @touchmove="touchMove($event)"
                 @touchend="touchEnd()"
                 @mousedown="mouseDown($event)"
                 @mousemove="mouseMove($event)"
                 @mouseup="mouseUp()"
                 @mouseleave="mouseUp()">
                
                <!-- Navigation Arrows -->
                <?php if($seragam->count() > 1): ?>
                <button @click="prev()" 
                        x-show="currentSlide > 0"
                        x-transition
                        class="swipe-arrow prev">
                    <svg class="w-5 h-5 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                </button>
                <button @click="next()" 
                        x-show="currentSlide < <?php echo e($seragam->count() - 1); ?>"
                        x-transition
                        class="swipe-arrow next">
                    <svg class="w-5 h-5 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </button>
                <?php endif; ?>

                <!-- Slides Wrapper -->
                <div class="swipe-wrapper" 
                     :class="{ 'dragging': isDragging }"
                     :style="`transform: translateX(calc(-${currentSlide * 100}% + ${dragOffset}px))`">
                    
                    <?php $__currentLoopData = $seragam; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $fotoLaki = $item->foto_laki_data ?? [];
                        $fotoPerempuan = $item->foto_perempuan_data ?? [];
                    ?>
                    <div class="swipe-slide">
                        <!-- Day Header -->
                        <div class="text-center mb-6">
                            <div class="inline-flex items-center gap-3 px-6 py-3 rounded-full bg-white shadow-sm border border-slate-100">
                                <span class="text-2xl"><?php echo e($item->icon); ?></span>
                                <div class="text-left">
                                    <h2 class="text-lg font-bold text-slate-800"><?php echo e($item->hari); ?></h2>
                                    <?php if($item->keterangan): ?>
                                        <p class="text-sm text-slate-500"><?php echo e($item->keterangan); ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <!-- Photos Grid -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Laki-laki -->
                            <div x-data="photoGallery(<?php echo e(json_encode($fotoLaki)); ?>, 'laki')">
                                <div class="photo-card">
                                    <div class="p-4 bg-gradient-to-r from-blue-50 to-blue-100 border-b border-blue-100">
                                        <div class="flex items-center gap-2">
                                            <span class="text-xl">👔</span>
                                            <span class="font-semibold text-blue-900">Laki-laki</span>
                                            <?php if(count($fotoLaki) > 1): ?>
                                                <span class="ml-auto text-xs bg-blue-200 text-blue-700 px-2 py-1 rounded-full">
                                                    <?php echo e(count($fotoLaki)); ?> foto
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    
                                    <?php if(count($fotoLaki) > 0): ?>
                                        <div class="photo-container cursor-pointer" @click="openLightbox(currentIndex)">
                                            <img :src="`/storage/${photos[currentIndex].foto}`" 
                                                 :alt="`Seragam <?php echo e($item->hari); ?> Laki-laki`">
                                            
                                            <?php if(count($fotoLaki) > 1): ?>
                                            <div class="photo-nav">
                                                <template x-for="(photo, idx) in photos" :key="idx">
                                                    <div class="photo-dot" :class="{ 'active': currentIndex === idx }"></div>
                                                </template>
                                            </div>
                                            <?php endif; ?>

                                            <?php if($fotoLaki[0]['keterangan'] ?? false): ?>
                                            <div class="caption-badge" x-text="photos[currentIndex]?.keterangan || ''"></div>
                                            <?php endif; ?>
                                        </div>
                                        
                                        <!-- Photo Navigation Buttons (if multiple) -->
                                        <?php if(count($fotoLaki) > 1): ?>
                                        <div class="p-3 flex justify-between items-center bg-slate-50">
                                            <button @click="prevPhoto()" class="p-2 hover:bg-slate-200 rounded-lg transition">
                                                <svg class="w-5 h-5 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                                                </svg>
                                            </button>
                                            <span class="text-sm text-slate-500">
                                                <span x-text="currentIndex + 1"></span> / <?php echo e(count($fotoLaki)); ?>

                                            </span>
                                            <button @click="nextPhoto()" class="p-2 hover:bg-slate-200 rounded-lg transition">
                                                <svg class="w-5 h-5 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                                </svg>
                                            </button>
                                        </div>
                                        <?php else: ?>
                                            <?php if($fotoLaki[0]['keterangan'] ?? false): ?>
                                            <div class="p-3 bg-blue-50 border-t border-blue-100">
                                                <p class="text-sm text-blue-800 text-center">
                                                    <?php echo e($fotoLaki[0]['keterangan']); ?>

                                                </p>
                                            </div>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <div class="empty-photo">
                                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                            <span class="text-sm">Belum ada foto</span>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <!-- Lightbox -->
                                <div class="lightbox" :class="{ 'active': lightboxOpen }" x-cloak>
                                    <button class="lightbox-close" @click="closeLightbox()">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                        </svg>
                                    </button>
                                    <button class="lightbox-nav prev" @click="prevPhoto()" x-show="photos.length > 1">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                                        </svg>
                                    </button>
                                    <img :src="lightboxOpen ? `/storage/${photos[currentIndex].foto}` : ''" 
                                         :alt="'Foto seragam'">
                                    <button class="lightbox-nav next" @click="nextPhoto()" x-show="photos.length > 1">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                        </svg>
                                    </button>
                                    <div class="lightbox-caption" x-show="photos[currentIndex]?.keterangan" x-text="photos[currentIndex]?.keterangan"></div>
                                </div>
                            </div>

                            <!-- Perempuan -->
                            <div x-data="photoGallery(<?php echo e(json_encode($fotoPerempuan)); ?>, 'perempuan')">
                                <div class="photo-card">
                                    <div class="p-4 bg-gradient-to-r from-pink-50 to-pink-100 border-b border-pink-100">
                                        <div class="flex items-center gap-2">
                                            <span class="text-xl">👗</span>
                                            <span class="font-semibold text-pink-900">Perempuan</span>
                                            <?php if(count($fotoPerempuan) > 1): ?>
                                                <span class="ml-auto text-xs bg-pink-200 text-pink-700 px-2 py-1 rounded-full">
                                                    <?php echo e(count($fotoPerempuan)); ?> foto
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    
                                    <?php if(count($fotoPerempuan) > 0): ?>
                                        <div class="photo-container cursor-pointer" @click="openLightbox(currentIndex)">
                                            <img :src="`/storage/${photos[currentIndex].foto}`" 
                                                 :alt="`Seragam <?php echo e($item->hari); ?> Perempuan`">
                                            
                                            <?php if(count($fotoPerempuan) > 1): ?>
                                            <div class="photo-nav">
                                                <template x-for="(photo, idx) in photos" :key="idx">
                                                    <div class="photo-dot" :class="{ 'active': currentIndex === idx }"></div>
                                                </template>
                                            </div>
                                            <?php endif; ?>

                                            <?php if($fotoPerempuan[0]['keterangan'] ?? false): ?>
                                            <div class="caption-badge" x-text="photos[currentIndex]?.keterangan || ''"></div>
                                            <?php endif; ?>
                                        </div>
                                        
                                        <!-- Photo Navigation Buttons (if multiple) -->
                                        <?php if(count($fotoPerempuan) > 1): ?>
                                        <div class="p-3 flex justify-between items-center bg-slate-50">
                                            <button @click="prevPhoto()" class="p-2 hover:bg-slate-200 rounded-lg transition">
                                                <svg class="w-5 h-5 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                                                </svg>
                                            </button>
                                            <span class="text-sm text-slate-500">
                                                <span x-text="currentIndex + 1"></span> / <?php echo e(count($fotoPerempuan)); ?>

                                            </span>
                                            <button @click="nextPhoto()" class="p-2 hover:bg-slate-200 rounded-lg transition">
                                                <svg class="w-5 h-5 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                                </svg>
                                            </button>
                                        </div>
                                        <?php else: ?>
                                            <?php if($fotoPerempuan[0]['keterangan'] ?? false): ?>
                                            <div class="p-3 bg-pink-50 border-t border-pink-100">
                                                <p class="text-sm text-pink-800 text-center">
                                                    <?php echo e($fotoPerempuan[0]['keterangan']); ?>

                                                </p>
                                            </div>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <div class="empty-photo">
                                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                            <span class="text-sm">Belum ada foto</span>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <!-- Lightbox -->
                                <div class="lightbox" :class="{ 'active': lightboxOpen }" x-cloak>
                                    <button class="lightbox-close" @click="closeLightbox()">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                        </svg>
                                    </button>
                                    <button class="lightbox-nav prev" @click="prevPhoto()" x-show="photos.length > 1">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                                        </svg>
                                    </button>
                                    <img :src="lightboxOpen ? `/storage/${photos[currentIndex].foto}` : ''" 
                                         :alt="'Foto seragam'">
                                    <button class="lightbox-nav next" @click="nextPhoto()" x-show="photos.length > 1">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                        </svg>
                                    </button>
                                    <div class="lightbox-caption" x-show="photos[currentIndex]?.keterangan" x-text="photos[currentIndex]?.keterangan"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>

            <!-- Day Indicator Dots -->
            <?php if($seragam->count() > 1): ?>
            <div class="day-indicator">
                <?php $__currentLoopData = $seragam; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <button @click="goToSlide(<?php echo e($index); ?>)" 
                        class="day-dot" 
                        :class="{ 'active': currentSlide === <?php echo e($index); ?> }">
                </button>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <?php endif; ?>

        <?php else: ?>
            <!-- Empty State -->
            <div class="text-center py-16">
                <div class="w-24 h-24 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-12 h-12 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-slate-700 mb-2">Belum ada data seragam</h3>
                <p class="text-slate-500">Data jadwal seragam akan segera ditampilkan.</p>
            </div>
        <?php endif; ?>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
// Main Swipe Controller
function seragamSwipe(totalSlides) {
    return {
        currentSlide: 0,
        totalSlides: totalSlides,
        isDragging: false,
        startX: 0,
        currentX: 0,
        dragOffset: 0,
        threshold: 50,
        
        init() {
            // Keyboard navigation
            document.addEventListener('keydown', (e) => {
                if (e.key === 'ArrowLeft') this.prev();
                if (e.key === 'ArrowRight') this.next();
            });
        },
        
        next() {
            if (this.currentSlide < this.totalSlides - 1) {
                this.currentSlide++;
            }
        },
        
        prev() {
            if (this.currentSlide > 0) {
                this.currentSlide--;
            }
        },
        
        goToSlide(index) {
            this.currentSlide = index;
        },
        
        // Touch Events
        touchStart(e) {
            this.isDragging = true;
            this.startX = e.touches[0].clientX;
            this.currentX = this.startX;
        },
        
        touchMove(e) {
            if (!this.isDragging) return;
            this.currentX = e.touches[0].clientX;
            this.dragOffset = this.currentX - this.startX;
        },
        
        touchEnd() {
            if (!this.isDragging) return;
            this.isDragging = false;
            
            const diff = this.currentX - this.startX;
            
            if (Math.abs(diff) > this.threshold) {
                if (diff > 0 && this.currentSlide > 0) {
                    this.prev();
                } else if (diff < 0 && this.currentSlide < this.totalSlides - 1) {
                    this.next();
                }
            }
            
            this.dragOffset = 0;
        },
        
        // Mouse Events
        mouseDown(e) {
            this.isDragging = true;
            this.startX = e.clientX;
            this.currentX = this.startX;
        },
        
        mouseMove(e) {
            if (!this.isDragging) return;
            this.currentX = e.clientX;
            this.dragOffset = this.currentX - this.startX;
        },
        
        mouseUp() {
            if (!this.isDragging) return;
            this.isDragging = false;
            
            const diff = this.currentX - this.startX;
            
            if (Math.abs(diff) > this.threshold) {
                if (diff > 0 && this.currentSlide > 0) {
                    this.prev();
                } else if (diff < 0 && this.currentSlide < this.totalSlides - 1) {
                    this.next();
                }
            }
            
            this.dragOffset = 0;
        }
    }
}

// Photo Gallery Controller
function photoGallery(photos, type) {
    return {
        photos: photos,
        currentIndex: 0,
        lightboxOpen: false,
        
        nextPhoto() {
            if (this.photos.length > 1) {
                this.currentIndex = (this.currentIndex + 1) % this.photos.length;
            }
        },
        
        prevPhoto() {
            if (this.photos.length > 1) {
                this.currentIndex = (this.currentIndex - 1 + this.photos.length) % this.photos.length;
            }
        },
        
        openLightbox(index) {
            this.currentIndex = index;
            this.lightboxOpen = true;
            document.body.style.overflow = 'hidden';
        },
        
        closeLightbox() {
            this.lightboxOpen = false;
            document.body.style.overflow = '';
        }
    }
}
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\eka\.gemini\antigravity\scratch\smk-alstar\resources\views/seragam.blade.php ENDPATH**/ ?>