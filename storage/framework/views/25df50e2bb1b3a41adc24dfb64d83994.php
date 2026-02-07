<?php $__env->startSection('title', $berita->judul . ' - SMK Al-Hidayah Lestari'); ?>

<?php $__env->startSection('content'); ?>
    <!-- Header Page -->
    <div class="bg-sky-50 py-8 border-b border-sky-100">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <a href="<?php echo e(route('berita.index')); ?>" class="text-primary hover:text-secondary inline-flex items-center gap-1 mb-4">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali ke Berita
            </a>
        </div>
    </div>

    <!-- Article Content -->
    <article class="py-12 md:py-16">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-4xl mx-auto">
                <!-- Article Header -->
                <header class="mb-8">
                    <h1 class="text-2xl md:text-4xl font-bold text-gray-900 mb-4"><?php echo e($berita->judul); ?></h1>
                    <div class="flex items-center gap-4 text-sm text-gray-500">
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            <?php echo e($berita->published_at ? $berita->published_at->format('d M Y') : '-'); ?>

                        </div>
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                            <?php echo e($berita->approvedKomentar->count()); ?> Komentar
                        </div>
                    </div>
                </header>

                <!-- Image Gallery -->
                <?php if(!empty($berita->gambar_urls)): ?>
                <div class="mb-8">
                    <?php if(count($berita->gambar_urls) == 1): ?>
                    <img src="<?php echo e($berita->gambar_urls[0]); ?>" alt="<?php echo e($berita->judul); ?>" class="w-full rounded-2xl shadow-lg" fetchpriority="high" decoding="async">
                    <?php else: ?>
                    <div class="grid grid-cols-2 gap-4">
                        <?php $__currentLoopData = $berita->gambar_urls; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="<?php echo e($index === 0 ? 'col-span-2' : ''); ?>">
                            <img src="<?php echo e($url); ?>" alt="<?php echo e($berita->judul); ?> - Gambar <?php echo e($index + 1); ?>" 
                                 class="w-full <?php echo e($index === 0 ? 'h-80 md:h-96' : 'h-48'); ?> object-cover rounded-xl shadow-md cursor-pointer hover:opacity-90 transition"
                                 onclick="openImageModal('<?php echo e($url); ?>')" <?php echo e($index === 0 ? 'fetchpriority="high"' : 'loading="lazy"'); ?> decoding="async">
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <?php endif; ?>
                </div>
                <?php endif; ?>

                <!-- Article Body -->
                <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed">
                    <?php echo $berita->isi; ?>

                </div>

                <!-- Share Section -->
                <div class="mt-12 pt-8 border-t border-gray-200">
                    <p class="text-sm font-medium text-gray-600 mb-3">Bagikan berita ini:</p>
                    <div class="flex gap-2">
                        <a href="https://wa.me/?text=<?php echo e(urlencode($berita->judul . ' - ' . url()->current())); ?>" target="_blank" 
                           class="px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition text-sm font-medium">
                            WhatsApp
                        </a>
                        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo e(urlencode(url()->current())); ?>" target="_blank"
                           class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition text-sm font-medium">
                            Facebook
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </article>

    <!-- Comments Section -->
    <section class="py-12 bg-gray-50">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-4xl mx-auto">
                <h2 class="text-2xl font-bold text-gray-900 mb-8">Komentar (<?php echo e($berita->approvedKomentar->count()); ?>)</h2>

                <?php if(session('success')): ?>
                <div class="mb-6 p-4 bg-sky-50 border border-sky-200 text-[#0EA5E9] rounded-xl flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    <?php echo e(session('success')); ?>

                </div>
                <?php endif; ?>

                <!-- Comment Form -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-8">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Tulis Komentar</h3>
                    <form action="<?php echo e(route('berita.komentar', $berita->slug)); ?>" method="POST" class="space-y-4">
                        <?php echo csrf_field(); ?>
                        <?php if(auth()->guard('spmb')->check()): ?>
                        <div>
                            <p class="text-sm font-medium text-gray-700 mb-1">Berkomentar sebagai:</p>
                            <p class="text-lg font-bold text-primary"><?php echo e(auth('spmb')->user()->nama); ?></p>
                            <input type="hidden" name="username" value="<?php echo e(auth('spmb')->user()->nama); ?>">
                        </div>
                        <?php else: ?>
                        <div>
                            <label for="username" class="block text-sm font-medium text-gray-700 mb-1">Nama Anda <span class="text-red-500">*</span></label>
                            <input type="text" id="username" name="username" required maxlength="100"
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition"
                                placeholder="Masukkan nama Anda">
                        </div>
                        <?php endif; ?>
                        <div>
                            <label for="komentar" class="block text-sm font-medium text-gray-700 mb-1">Komentar <span class="text-red-500" aria-hidden="true">*</span></label>
                            <textarea id="komentar" name="komentar" rows="4" required maxlength="1000"
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition"
                                placeholder="Tulis komentar Anda..."
                                aria-required="true"></textarea>
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

                <!-- Comments List -->
                <?php if($berita->approvedKomentar->isEmpty()): ?>
                <div class="text-center py-12">
                    <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                    <p class="text-gray-500">Belum ada komentar. Jadilah yang pertama berkomentar!</p>
                </div>
                <?php else: ?>
                <div class="space-y-4">
                    <?php $__currentLoopData = $berita->approvedKomentar; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $komentar): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 bg-primary/10 rounded-full flex items-center justify-center flex-shrink-0">
                                <?php if($komentar->show_username): ?>
                                <span class="text-primary font-bold text-lg"><?php echo e(strtoupper(substr($komentar->username, 0, 1))); ?></span>
                                <?php else: ?>
                                <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                <?php endif; ?>
                            </div>
                            <div class="flex-1">
                                <div class="flex items-center gap-2 mb-1">
                                    <h4 class="font-semibold text-gray-900"><?php echo e($komentar->display_name); ?></h4>
                                    <span class="text-xs text-gray-400">•</span>
                                    <span class="text-xs text-gray-500"><?php echo e($komentar->created_at->diffForHumans()); ?></span>
                                </div>
                                <p class="text-gray-600"><?php echo e($komentar->komentar); ?></p>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- Related Articles -->
    <?php if($related->isNotEmpty()): ?>
    <section class="py-12 bg-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-6xl mx-auto">
                <h2 class="text-2xl font-bold text-gray-900 mb-8">Berita Lainnya</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <?php $__currentLoopData = $related; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <article class="bg-white rounded-xl shadow-sm hover:shadow-lg transition-all duration-300 overflow-hidden group border border-gray-100">
                        <a href="<?php echo e(route('berita.show', $item->slug)); ?>">
                            <div class="aspect-video overflow-hidden bg-gray-100">
                                <?php if($item->gambar_utama): ?>
                                <img src="<?php echo e($item->gambar_utama); ?>" alt="<?php echo e($item->judul); ?>" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" loading="lazy" decoding="async">
                                <?php else: ?>
                                <div class="w-full h-full flex items-center justify-center">
                                    <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                                </div>
                                <?php endif; ?>
                            </div>
                            <div class="p-4">
                                <p class="text-xs text-gray-500 mb-2"><?php echo e($item->published_at ? $item->published_at->format('d M Y') : '-'); ?></p>
                                <h3 class="font-semibold text-gray-900 group-hover:text-primary transition line-clamp-2"><?php echo e($item->judul); ?></h3>
                            </div>
                        </a>
                    </article>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- Image Modal -->
    <div id="imageModal" class="fixed inset-0 z-50 hidden bg-black/90 flex items-center justify-center p-4" onclick="closeImageModal()">
        <button class="absolute top-4 right-4 text-white hover:text-gray-300 transition">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>
        <img id="modalImage" src="" alt="Gambar berita - tampilan penuh" class="max-w-full max-h-[90vh] object-contain rounded-lg" onclick="event.stopPropagation()">
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\user\.gemini\antigravity\scratch\smkalstar\smkalstar\resources\views/berita/show.blade.php ENDPATH**/ ?>