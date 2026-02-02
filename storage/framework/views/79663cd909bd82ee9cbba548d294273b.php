

<?php $__env->startSection('title', 'Profil Sekolah - SMK Al-Hidayah Lestari'); ?>

<?php $__env->startSection('content'); ?>
    <!-- Header Page -->
    <div class="bg-sky-50 py-12 border-b border-sky-100">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-2">Profil Sekolah</h1>
            <p class="text-gray-600">Mengenal lebih dekat sejarah, visi, dan orang-orang hebat di balik SMK Al-Hidayah Lestari</p>
        </div>
    </div>

    <!-- Sejarah -->
    <section id="sejarah" class="py-12 md:py-20 bg-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row gap-8 md:gap-12 items-center">
                <div class="w-full md:w-1/2">
                    <?php
                        $sejarahGambarUrls = $profil->sejarah_gambar_urls;
                        if (empty($sejarahGambarUrls)) {
                            $sejarahGambarUrls = [asset('images/b1.webp')];
                        }
                    ?>
                    
                    <div x-data="{ 
                            activeSlide: 0, 
                            slides: <?php echo e(json_encode($sejarahGambarUrls)); ?>,
                            autoSlideInterval: null,
                            startAutoSlide() {
                                this.autoSlideInterval = setInterval(() => {
                                    this.activeSlide = (this.activeSlide + 1) % this.slides.length;
                                }, 3000); 
                            },
                            stopAutoSlide() {
                                clearInterval(this.autoSlideInterval);
                            }
                        }" 
                        x-init="startAutoSlide()"
                        @mouseenter="stopAutoSlide()" 
                        @mouseleave="startAutoSlide()"
                        class="relative w-full rounded-2xl md:rounded-3xl overflow-hidden shadow-xl md:shadow-2xl aspect-video group border border-gray-100">
                        
                        <!-- Slides -->
                        <template x-for="(slide, index) in slides" :key="index">
                            <div x-show="activeSlide === index" 
                                 x-transition:enter="transition ease-out duration-500"
                                 x-transition:enter-start="opacity-0 transform scale-105"
                                 x-transition:enter-end="opacity-100 transform scale-100"
                                 class="absolute inset-0 w-full h-full cursor-pointer"
                                 @click="openLightbox(slide, 'Sejarah Sekolah')">
                                <img :src="slide" alt="Sejarah Sekolah" class="w-full h-full object-cover" loading="lazy" decoding="async">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
                            </div>
                        </template>

                        <!-- Navigation Dots -->
                        <div class="absolute bottom-4 md:bottom-6 left-0 right-0 flex justify-center gap-2 z-10" x-show="slides.length > 1">
                            <template x-for="(slide, index) in slides" :key="index">
                                <button @click="activeSlide = index" 
                                    :class="activeSlide === index ? 'bg-white w-6 md:w-8' : 'bg-white/50 w-2 hover:bg-white/80'"
                                    class="h-1.5 md:h-2 rounded-full transition-all duration-300"></button>
                            </template>
                        </div>
                    </div>
                </div>
                <div class="w-full md:w-1/2">
                    <span class="text-primary font-bold tracking-wider uppercase text-xs md:text-sm mb-2 md:mb-3 block">Tentang Kami</span>
                    <h2 class="text-xl sm:text-2xl md:text-4xl font-bold text-gray-900 mb-4 md:mb-6 font-heading"><?php echo e($profil->sejarah_judul); ?></h2>
                    <div class="prose prose-sm md:prose-lg prose-gray text-gray-600 leading-relaxed text-justify">
                        <?php $__currentLoopData = explode("\n", $profil->sejarah_konten); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $paragraph): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if(trim($paragraph)): ?>
                            <p class="mb-3 md:mb-4"><?php echo e($paragraph); ?></p>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Visi Misi -->
    <section id="visi-misi" class="py-12 md:py-20 bg-gray-50">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-5xl mx-auto">
                <div class="grid md:grid-cols-2 gap-4 md:gap-8">
                    <!-- Visi -->
                    <div class="bg-white p-6 md:p-10 rounded-2xl md:rounded-3xl shadow-sm hover:shadow-xl transition duration-300 border border-gray-100">
                        <div class="flex items-center gap-3 md:gap-4 mb-4 md:mb-6">
                            <div class="w-10 h-10 md:w-12 md:h-12 bg-sky-100 rounded-xl md:rounded-2xl flex items-center justify-center text-[#0EA5E9]">
                                <svg class="w-5 h-5 md:w-6 md:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            </div>
                            <h3 class="text-xl md:text-2xl font-bold text-gray-900 font-heading">Visi</h3>
                        </div>
                        <p class="text-gray-700 text-sm md:text-lg font-medium italic leading-relaxed">
                            "<?php echo e($profil->visi); ?>"
                        </p>
                    </div>

                    <!-- Misi -->
                    <div class="bg-white p-6 md:p-10 rounded-2xl md:rounded-3xl shadow-sm hover:shadow-xl transition duration-300 border border-gray-100">
                        <div class="flex items-center gap-3 md:gap-4 mb-4 md:mb-6">
                            <div class="w-10 h-10 md:w-12 md:h-12 bg-yellow-100 rounded-xl md:rounded-2xl flex items-center justify-center text-yellow-600">
                                <svg class="w-5 h-5 md:w-6 md:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                            </div>
                            <h3 class="text-xl md:text-2xl font-bold text-gray-900 font-heading">Misi</h3>
                        </div>
                        <ul class="space-y-3 md:space-y-4">
                            <?php $__currentLoopData = $profil->misi ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $misi): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="flex items-start gap-3 md:gap-4">
                                <span class="flex-shrink-0 w-5 h-5 md:w-6 md:h-6 rounded-full bg-sky-100 text-[#0EA5E9] text-xs font-bold flex items-center justify-center mt-0.5"><?php echo e($index + 1); ?></span>
                                <span class="text-gray-600 text-sm md:text-base leading-relaxed"><?php echo e($misi); ?></span>
                            </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Struktur Organisasi -->
    <section id="struktur-organisasi" class="py-12 md:py-20 bg-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-10 md:mb-16">
                <span class="text-primary font-bold tracking-wider uppercase text-xs md:text-sm mb-2 md:mb-3 block">Manajemen & Staff</span>
                <h2 class="text-xl sm:text-2xl md:text-4xl font-bold text-gray-900 font-heading">Struktur Organisasi</h2>
            </div>
            
            <?php
                $strukturSections = \App\Models\StrukturOrganisasiSection::aktif()
                    ->urut()
                    ->with(['activeMembers' => fn($q) => $q->orderBy('urutan')])
                    ->get();
            ?>

            <?php if($strukturSections->isEmpty()): ?>
                <?php if($profil->struktur_organisasi_gambar): ?>
                    <?php
                        $strukturGambar = $profil->struktur_organisasi_gambar;
                        if (!str_starts_with($strukturGambar, 'http')) {
                            $strukturGambar = asset('storage/' . $strukturGambar);
                        }
                    ?>
                    <div class="max-w-5xl mx-auto p-3 md:p-4 bg-gray-50 rounded-2xl md:rounded-3xl border border-gray-100">
                        <img src="<?php echo e($strukturGambar); ?>" alt="Struktur Organisasi" class="w-full rounded-xl md:rounded-2xl shadow-sm" loading="lazy" decoding="async">
                    </div>
                <?php else: ?>
                    <div class="max-w-3xl mx-auto bg-gray-50 border-2 border-dashed border-gray-200 rounded-2xl md:rounded-3xl p-8 md:p-16 flex flex-col items-center justify-center text-center">
                        <svg class="w-12 h-12 md:w-16 md:h-16 text-gray-300 mb-3 md:mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                        <p class="text-gray-500 font-medium text-sm md:text-lg">Dokumen Struktur Organisasi Belum Tersedia</p>
                    </div>
                <?php endif; ?>
            <?php else: ?>
                <div class="space-y-10 md:space-y-16">
                    <?php $__currentLoopData = $strukturSections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="relative">
                        <div class="text-center mb-6 md:mb-10">
                            <h4 class="text-base md:text-xl font-bold text-gray-800 inline-block px-4 md:px-6 py-2 bg-gray-50 rounded-full border border-gray-100 font-heading">
                                <?php echo e($section->nama); ?>

                            </h4>
                        </div>
                        
                        <?php if($section->activeMembers->isNotEmpty()): ?>
                        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4 md:gap-x-8 md:gap-y-12 max-w-6xl mx-auto">
                            <?php $__currentLoopData = $section->activeMembers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="text-center group">
                                <div class="w-24 h-24 md:w-32 md:h-32 lg:w-40 lg:h-40 mx-auto mb-3 md:mb-6 rounded-xl md:rounded-3xl overflow-hidden bg-white shadow-lg md:shadow-xl rotate-2 md:rotate-3 group-hover:rotate-0 transition-transform duration-300 ring-2 md:ring-4 ring-white border border-gray-100">
                                    <?php if($member->foto_url): ?>
                                    <img src="<?php echo e($member->foto_url); ?>" alt="<?php echo e($member->nama); ?>" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" loading="lazy" decoding="async">
                                    <?php else: ?>
                                    <div class="w-full h-full flex items-center justify-center bg-gray-100 text-gray-300">
                                        <svg class="w-10 h-10 md:w-16 md:h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                    </div>
                                    <?php endif; ?>
                                </div>
                                <h5 class="font-bold text-gray-900 text-sm md:text-lg mb-0.5 md:mb-1 font-heading"><?php echo e($member->nama); ?></h5>
                                <?php if($member->keterangan): ?>
                                <p class="text-primary text-xs md:text-sm font-medium tracking-wide uppercase"><?php echo e($member->keterangan); ?></p>
                                <?php endif; ?>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <?php endif; ?>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <!-- Lightbox Modal -->
    <div id="lightbox" class="fixed inset-0 z-[60] hidden bg-black/95 backdrop-blur-xl flex items-center justify-center p-4" onclick="closeLightbox()">
        <button class="absolute top-4 right-4 md:top-6 md:right-6 text-white/50 hover:text-white transition" onclick="closeLightbox()">
            <svg class="w-8 h-8 md:w-10 md:h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>
        <div class="max-w-5xl md:max-w-6xl max-h-[90vh]" onclick="event.stopPropagation()">
            <img id="lightbox-img" src="" alt="" class="max-h-[80vh] md:max-h-[85vh] w-auto mx-auto rounded-lg shadow-2xl">
            <p id="lightbox-caption" class="text-center text-white/80 mt-3 md:mt-4 text-sm md:text-lg font-light tracking-wide"></p>
        </div>
    </div>

    <script>
        function openLightbox(src, caption) {
            const lightbox = document.getElementById('lightbox');
            const img = document.getElementById('lightbox-img');
            const cap = document.getElementById('lightbox-caption');
            
            img.src = src;
            cap.textContent = caption;
            lightbox.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
            
            img.style.opacity = 0;
            img.style.transform = 'scale(0.95)';
            setTimeout(() => {
                img.style.transition = 'all 0.3s ease-out';
                img.style.opacity = 1;
                img.style.transform = 'scale(1)';
            }, 10);
        }

        function closeLightbox() {
            const lightbox = document.getElementById('lightbox');
            lightbox.classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') closeLightbox();
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\eka\.gemini\antigravity\scratch\smk-alstar\resources\views/profil.blade.php ENDPATH**/ ?>