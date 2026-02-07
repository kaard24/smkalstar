<?php $__env->startSection('title', 'Cek Pengumuman - SPMB SMK Al-Hidayah Lestari'); ?>

<?php $__env->startSection('content'); ?>
    <!-- Header Page -->
    <div class="bg-sky-50 py-8 md:py-12 border-b border-sky-100">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-xl sm:text-2xl md:text-3xl lg:text-4xl font-bold text-gray-900 mb-2">Pengumuman Kelulusan</h1>
            <p class="text-sm sm:text-base text-gray-600">Silakan masukkan NISN untuk melihat hasil seleksi Penerimaan Peserta Didik Baru</p>
        </div>
    </div>

    <section class="py-8 md:py-16 bg-gray-50">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-6xl">
            <div class="grid lg:grid-cols-3 gap-6 md:gap-8">
                <!-- Kolom Utama - Form Cek Hasil -->
                <div class="lg:col-span-2">
                    <!-- Search Card -->
                    <div class="bg-white rounded-2xl md:rounded-3xl shadow-xl overflow-hidden mb-6 md:mb-8 border border-gray-100">
                        <div class="p-5 sm:p-8 md:p-12">
                            <form action="<?php echo e(route('spmb.pengumuman.cek')); ?>" method="GET" class="space-y-4 md:space-y-6">
                                <div>
                                    <label for="nisn" class="block text-center text-xs sm:text-sm font-bold text-gray-500 uppercase tracking-wider mb-3 md:mb-4">Nomor Induk Siswa Nasional (NISN)</label>
                                    <div class="relative max-w-lg mx-auto">
                                        <input 
                                            type="text" 
                                            name="nisn" 
                                            id="nisn" 
                                            inputmode="numeric"
                                            pattern="[0-9]*"
                                            class="block w-full text-center text-2xl sm:text-3xl font-bold tracking-widest px-3 sm:px-4 py-3 sm:py-4 rounded-xl sm:rounded-2xl border-2 border-gray-200 focus:border-primary focus:ring-4 focus:ring-primary/10 transition placeholder-gray-300 touch-manipulation" 
                                            placeholder="00xxxxxxxx" 
                                            required
                                            style="-webkit-appearance: none; -moz-appearance: textfield;">
                                    </div>
                                </div>

                                <div class="text-center pt-2">
                                    <button type="submit" class="w-full sm:w-auto inline-flex items-center justify-center px-6 sm:px-10 py-3 sm:py-4 bg-primary text-white text-base sm:text-lg font-bold rounded-xl sm:rounded-2xl hover:bg-[#0284C7] transition shadow-lg hover:shadow-cyan-500/30 transform hover:-translate-y-1 active:scale-95">
                                        <svg class="w-5 h-5 sm:w-6 sm:h-6 mr-2 sm:mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                                        <span class="whitespace-nowrap">Cek Hasil Seleksi</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    
                    <!-- Result Area -->
                    <?php if(session('hasil')): ?>
                        <?php $hasil = session('hasil'); ?>
                        <div class="bg-white rounded-2xl md:rounded-3xl shadow-xl overflow-hidden animate-fade-in-up mb-6 md:mb-8">
                            <div class="p-6 sm:p-10 text-center">
                                <?php if($hasil->status_kelulusan == 'Lulus'): ?>
                                    <div class="w-20 h-20 sm:w-24 sm:h-24 bg-sky-100 text-[#0EA5E9] rounded-full flex items-center justify-center mx-auto mb-4 sm:mb-6 shadow-inner animate-bounce">
                                        <svg class="w-10 h-10 sm:w-12 sm:h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                    </div>
                                    <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold text-[#0EA5E9] mb-2 font-heading">SELAMAT!</h2>
                                    <p class="text-lg sm:text-xl text-gray-900 font-bold mb-2"><?php echo e($hasil->nama); ?></p>
                                    <p class="text-sm sm:text-base text-gray-600 mb-6 sm:mb-8 max-w-md mx-auto">
                                        Anda dinyatakan <strong class="text-[#0EA5E9] bg-sky-50 px-2 py-1 rounded">LULUS</strong> seleksi masuk SMK Al-Hidayah Lestari pada kompetensi keahlian:
                                    </p>
                                    
                                    <div class="bg-gray-50 rounded-xl sm:rounded-2xl p-4 sm:p-6 mb-6 sm:mb-8 border border-gray-100 inline-block w-full max-w-sm">
                                        <p class="text-xs text-gray-400 font-bold uppercase tracking-wider mb-1">Jurusan</p>
                                        <p class="text-xl sm:text-2xl font-bold text-primary"><?php echo e($hasil->jurusan); ?></p>
                                    </div>

                                <?php elseif($hasil->status_kelulusan == 'Tidak Lulus'): ?>
                                    <div class="w-20 h-20 sm:w-24 sm:h-24 bg-red-100 text-red-600 rounded-full flex items-center justify-center mx-auto mb-4 sm:mb-6 shadow-inner">
                                        <svg class="w-10 h-10 sm:w-12 sm:h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12"></path></svg>
                                    </div>
                                    <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold text-red-600 mb-2 font-heading">MOHON MAAF</h2>
                                    <p class="text-lg sm:text-xl text-gray-900 font-bold mb-2"><?php echo e($hasil->nama); ?></p>
                                    <p class="text-sm sm:text-base text-gray-600 max-w-md mx-auto">
                                        Anda dinyatakan <strong class="text-red-600 bg-red-50 px-2 py-1 rounded">TIDAK LULUS</strong> seleksi tahun ini. Tetap semangat dan jangan menyerah!
                                    </p>
                                <?php else: ?>
                                    <div class="w-20 h-20 sm:w-24 sm:h-24 bg-yellow-100 text-yellow-600 rounded-full flex items-center justify-center mx-auto mb-4 sm:mb-6 shadow-inner animate-pulse">
                                        <svg class="w-10 h-10 sm:w-12 sm:h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    </div>
                                    <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold text-yellow-600 mb-2 font-heading">DALAM PROSES</h2>
                                    <p class="text-lg sm:text-xl text-gray-900 font-bold mb-2"><?php echo e($hasil->nama); ?></p>
                                    <p class="text-sm sm:text-base text-gray-600 max-w-md mx-auto">
                                        Data Anda sedang dalam proses verifikasi dan seleksi oleh panitia. Silakan cek kembali secara berkala.
                                    </p>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if(session('error')): ?>
                        <div class="bg-red-50 border border-red-200 rounded-xl sm:rounded-2xl p-4 sm:p-6 text-center mb-6 md:mb-8">
                            <svg class="w-10 h-10 sm:w-12 sm:h-12 text-red-500 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <p class="text-red-700 font-medium text-sm sm:text-base"><?php echo e(session('error')); ?></p>
                        </div>
                    <?php endif; ?>

                    <!-- Tabel Pendaftar Terbaru -->
                    <?php if($pendaftarTerbaru->isNotEmpty()): ?>
                        <div class="bg-white rounded-2xl md:rounded-3xl shadow-lg overflow-hidden mb-6 md:mb-8 border border-gray-100">
                            <div class="p-4 sm:p-6">
                                <h4 class="text-sm sm:text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">
                                    <svg class="w-4 h-4 sm:w-5 sm:h-5 text-green-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span class="truncate">Pendaftar Terbaru</span>
                                </h4>
                                <div class="overflow-x-auto -mx-4 px-4 sm:mx-0 sm:px-0">
                                    <table class="w-full text-xs sm:text-sm min-w-[320px]">
                                        <thead>
                                            <tr class="border-b border-gray-200">
                                                <th class="text-left py-2 sm:py-3 px-2 sm:px-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Nama</th>
                                                <th class="text-left py-2 sm:py-3 px-2 sm:px-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Asal Sekolah</th>
                                                <th class="text-left py-2 sm:py-3 px-2 sm:px-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Jurusan</th>
                                                <th class="text-left py-2 sm:py-3 px-2 sm:px-3 text-xs font-semibold text-gray-500 uppercase tracking-wider whitespace-nowrap">Waktu</th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-gray-100">
                                            <?php $__currentLoopData = $pendaftarTerbaru; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pendaftar): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr class="hover:bg-gray-50 transition">
                                                    <td class="py-2 sm:py-3 px-2 sm:px-3">
                                                        <div class="flex items-center gap-2 sm:gap-3">
                                                            <div class="w-7 h-7 sm:w-9 sm:h-9 rounded-full bg-gradient-to-br from-primary to-cyan-500 text-white flex items-center justify-center text-xs sm:text-sm font-bold flex-shrink-0">
                                                                <?php echo e($pendaftar['inisial']); ?>

                                                            </div>
                                                            <span class="font-medium text-gray-900 truncate max-w-[80px] sm:max-w-none"><?php echo e($pendaftar['inisial']); ?></span>
                                                        </div>
                                                    </td>
                                                    <td class="py-2 sm:py-3 px-2 sm:px-3 text-gray-600">
                                                        <span class="truncate max-w-[100px] sm:max-w-[120px] inline-block" title="<?php echo e($pendaftar['asal_sekolah']); ?>">
                                                            <?php echo e($pendaftar['asal_sekolah']); ?>

                                                        </span>
                                                    </td>
                                                    <td class="py-2 sm:py-3 px-2 sm:px-3">
                                                        <span class="inline-flex items-center px-2 py-0.5 sm:px-2.5 sm:py-1 rounded-lg bg-blue-50 text-blue-700 text-[10px] sm:text-xs font-medium truncate max-w-[80px] sm:max-w-none">
                                                            <?php echo e($pendaftar['jurusan']); ?>

                                                        </span>
                                                    </td>
                                                    <td class="py-2 sm:py-3 px-2 sm:px-3 text-gray-500 text-[10px] sm:text-xs whitespace-nowrap">
                                                        <?php echo e($pendaftar['waktu']); ?>

                                                    </td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Sidebar - Statistik & Leaderboard -->
                <div class="lg:col-span-1 space-y-4 md:space-y-6">
                    <!-- Total Pendaftar Card -->
                    <div class="bg-gradient-to-br from-blue-500 to-cyan-600 rounded-2xl md:rounded-3xl p-4 sm:p-6 shadow-xl text-white relative overflow-hidden">
                        <div class="absolute top-0 right-0 w-24 sm:w-32 h-24 sm:h-32 bg-white/10 rounded-full blur-3xl transform translate-x-10 -translate-y-10"></div>
                        <div class="relative z-10">
                            <div class="flex items-center gap-2 sm:gap-3 mb-3 sm:mb-4">
                                <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-lg sm:rounded-xl bg-white/20 flex items-center justify-center flex-shrink-0">
                                    <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                    </svg>
                                </div>
                                <h3 class="text-base sm:text-lg font-bold font-heading">Total Pendaftar</h3>
                            </div>
                            <div class="text-3xl sm:text-4xl font-bold mb-1"><?php echo e(number_format($totalPendaftar, 0, ',', '.')); ?></div>
                            <p class="text-blue-100 text-xs sm:text-sm">Siswa telah mendaftar</p>
                        </div>
                    </div>

                    <!-- Jurusan Favorit -->
                    <div class="bg-white rounded-2xl md:rounded-3xl p-4 sm:p-6 shadow-lg border border-gray-100">
                        <h3 class="text-base sm:text-lg font-bold text-gray-900 mb-3 sm:mb-4 flex items-center gap-2 font-heading">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5 text-orange-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
                            </svg>
                            <span class="truncate">Jurusan Favorit</span>
                        </h3>
                        <div class="space-y-3 sm:space-y-4">
                            <?php $__empty_1 = true; $__currentLoopData = $statistikJurusan->take(4); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $jurusan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <div class="flex items-center gap-2 sm:gap-3">
                                    <div class="w-7 h-7 sm:w-8 sm:h-8 rounded-lg <?php echo e($index == 0 ? 'bg-yellow-100 text-yellow-600' : ($index == 1 ? 'bg-gray-100 text-gray-600' : ($index == 2 ? 'bg-orange-100 text-orange-600' : 'bg-blue-50 text-blue-500'))); ?> flex items-center justify-center text-xs sm:text-sm font-bold flex-shrink-0">
                                        <?php echo e($index + 1); ?>

                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center justify-between mb-1">
                                            <span class="text-xs sm:text-sm font-medium text-gray-700 truncate pr-2"><?php echo e($jurusan['nama']); ?></span>
                                            <span class="text-xs sm:text-sm font-bold text-gray-900 flex-shrink-0"><?php echo e($jurusan['total']); ?></span>
                                        </div>
                                        <div class="h-1.5 sm:h-2 bg-gray-100 rounded-full overflow-hidden">
                                            <div class="h-full <?php echo e($index == 0 ? 'bg-yellow-400' : ($index == 1 ? 'bg-gray-400' : ($index == 2 ? 'bg-orange-400' : 'bg-blue-400'))); ?> rounded-full transition-all duration-500" style="width: <?php echo e($jurusan['persentase']); ?>%"></div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <p class="text-gray-500 text-xs sm:text-sm text-center py-4">Belum ada data pendaftaran</p>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Statistik per Gelombang -->
                    <div class="bg-white rounded-2xl md:rounded-3xl p-4 sm:p-6 shadow-lg border border-gray-100">
                        <h3 class="text-base sm:text-lg font-bold text-gray-900 mb-3 sm:mb-4 flex items-center gap-2 font-heading">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5 text-primary flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                            <span class="truncate">Per Gelombang</span>
                        </h3>
                        <div class="grid grid-cols-2 sm:grid-cols-3 gap-2 sm:gap-3">
                            <?php $__currentLoopData = $statistikGelombang; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gelombang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="text-center p-2 sm:p-3 bg-gray-50 rounded-lg sm:rounded-xl">
                                    <div class="text-xl sm:text-2xl font-bold text-gray-900"><?php echo e($gelombang->total); ?></div>
                                    <div class="text-[10px] sm:text-xs text-gray-500">Gel. <?php echo e($gelombang->gelombang); ?></div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php if($statistikGelombang->isEmpty()): ?>
                                <div class="col-span-2 sm:col-span-3 text-center text-gray-500 text-xs sm:text-sm py-4">Belum ada data</div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Info Update -->
                    <div class="bg-gradient-to-r from-green-50 to-emerald-50 rounded-xl sm:rounded-2xl p-3 sm:p-4 border border-green-100">
                        <div class="flex items-start gap-2 sm:gap-3">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5 text-green-500 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <p class="text-xs sm:text-sm text-green-700 leading-relaxed">
                                Data statistik diperbarui secara real-time setiap ada pendaftaran baru.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-10 sm:py-16 bg-gradient-to-br from-blue-600 to-cyan-600 relative overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <svg class="w-full h-full" viewBox="0 0 100 100" preserveAspectRatio="none">
                <pattern id="cta-grid" width="10" height="10" patternUnits="userSpaceOnUse">
                    <circle cx="5" cy="5" r="1" fill="white"/>
                </pattern>
                <rect width="100" height="100" fill="url(#cta-grid)"/>
            </svg>
        </div>
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
            <h2 class="text-xl sm:text-2xl md:text-3xl font-bold text-white mb-3 sm:mb-4 font-heading">Belum Mendaftar?</h2>
            <p class="text-blue-100 mb-6 sm:mb-8 max-w-2xl mx-auto text-sm sm:text-base px-4">Bergabunglah dengan ribuan siswa lainnya yang sudah mendaftar di SMK Al-Hidayah Lestari. Pendaftaran gratis!</p>
            <div class="flex flex-col sm:flex-row flex-wrap justify-center gap-3 sm:gap-4">
                <a href="<?php echo e(route('register')); ?>" class="inline-flex items-center justify-center px-6 sm:px-8 py-3 sm:py-4 bg-white text-blue-600 font-bold rounded-xl sm:rounded-2xl hover:bg-gray-100 transition shadow-lg text-sm sm:text-base">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                    </svg>
                    <span class="whitespace-nowrap">Daftar Sekarang</span>
                </a>
                <a href="<?php echo e(route('spmb.info')); ?>" class="inline-flex items-center justify-center px-6 sm:px-8 py-3 sm:py-4 bg-blue-500/30 text-white font-bold rounded-xl sm:rounded-2xl hover:bg-blue-500/50 transition border border-white/30 text-sm sm:text-base">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span class="whitespace-nowrap">Info SPMB</span>
                </a>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\user\.gemini\antigravity\scratch\smkalstar\smkalstar\resources\views/spmb/pengumuman.blade.php ENDPATH**/ ?>