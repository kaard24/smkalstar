

<?php $__env->startSection('title', 'Status Pendaftaran - SMK Al-Hidayah Lestari'); ?>

<?php $__env->startSection('content'); ?>
    <div class="min-h-screen bg-gray-50 py-6 md:py-12">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-3xl">
            <!-- Header Page - Konsisten dengan halaman lain -->
            <div class="bg-sky-50 py-8 md:py-12 border border-sky-100 rounded-2xl mb-6 md:mb-8 text-center">
                <span class="inline-block py-1 px-3 rounded-full bg-primary/10 text-primary text-xs md:text-sm font-bold mb-3 border border-primary/20">Portal SPMB Online</span>
                <h1 class="text-2xl md:text-3xl font-bold text-gray-900 font-heading mb-2">Status Pendaftaran</h1>
                <p class="text-gray-600 text-sm md:text-base max-w-xl mx-auto">Pantau progres pendaftaran Anda secara real-time.</p>
            </div>

            <!-- Student Info Card -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden mb-6 md:mb-8">
                <div class="p-6 md:p-8">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-16 h-16 bg-primary/10 rounded-full flex items-center justify-center">
                            <svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-lg md:text-xl font-bold text-gray-900"><?php echo e($siswa->nama ?? 'Calon Siswa'); ?></h2>
                            <p class="text-gray-500 text-sm">NISN: <?php echo e($siswa->nisn); ?></p>
                        </div>
                    </div>
                    
                    <?php if($siswa->pendaftaran && $siswa->pendaftaran->jurusan): ?>
                    <div class="flex items-center gap-2 mt-4 p-3 bg-primary/5 rounded-lg border border-primary/10">
                        <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                        </svg>
                        <span class="text-sm text-gray-700">Jurusan: <strong class="text-primary"><?php echo e($siswa->pendaftaran->jurusan->nama); ?></strong></span>
                    </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Progress Overview -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden mb-6 md:mb-8">
                <div class="p-6 md:p-8">
                    <h3 class="font-bold text-gray-900 text-lg mb-4">Progress Pendaftaran</h3>
                    
                    <?php
                        $totalSteps = 7;
                        $completedSteps = 1; // Pendaftaran akun selalu selesai
                        if($biodataComplete) $completedSteps++;
                        if($orangTuaComplete) $completedSteps++;
                        if($jurusanComplete) $completedSteps++;
                        if($progress['is_complete']) $completedSteps++;
                        if($wawancaraComplete) $completedSteps++;
                        if($kelulusanStatus === 'Lulus') $completedSteps++;
                        $overallProgress = ($completedSteps / $totalSteps) * 100;
                    ?>
                    <div class="w-full bg-gray-200 rounded-full h-3 mb-4">
                        <div class="bg-primary h-3 rounded-full transition-all duration-500" style="width: <?php echo e($overallProgress); ?>%"></div>
                    </div>
                    
                    <p class="text-sm text-gray-600 text-center"><?php echo e($completedSteps); ?> dari <?php echo e($totalSteps); ?> langkah selesai (<?php echo e(round($overallProgress)); ?>%)</p>
                </div>
            </div>

            <!-- Steps Status -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-800/10">
                <div class="p-6 md:p-8">
                    <h3 class="font-bold text-gray-900 text-lg mb-6 flex items-center gap-2">
                        <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                        Detail Progres
                    </h3>
                    
                    <div class="space-y-4">
                        <!-- Step 1: Pendaftaran Akun -->
                        <div class="flex items-center gap-4 p-4 rounded-xl bg-sky-50 border border-sky-100">
                            <div class="w-10 h-10 rounded-full flex items-center justify-center flex-shrink-0 bg-[#0EA5E9] text-white">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <h4 class="font-semibold text-gray-900">Pendaftaran Akun</h4>
                                <p class="text-sm text-gray-600">Akun berhasil dibuat pada <?php echo e($siswa->created_at->format('d M Y')); ?></p>
                            </div>
                        </div>
                        
                        <!-- Step 2: Biodata -->
                        <div class="flex items-center gap-4 p-4 rounded-xl <?php echo e($biodataComplete ? 'bg-sky-50 border border-sky-100' : 'bg-gray-50 border border-gray-100'); ?>">
                            <div class="w-10 h-10 rounded-full flex items-center justify-center flex-shrink-0 <?php echo e($biodataComplete ? 'bg-[#0EA5E9] text-white' : 'bg-gray-200 text-gray-800'); ?>">
                                <?php if($biodataComplete): ?>
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                <?php else: ?>
                                    <span class="text-sm font-bold">2</span>
                                <?php endif; ?>
                            </div>
                            <div class="flex-1">
                                <h4 class="font-semibold text-gray-900">Data Diri</h4>
                                <p class="text-sm text-gray-600"><?php echo e($biodataComplete ? 'Lengkap' : 'Belum lengkap'); ?></p>
                            </div>
                            <?php if(!$biodataComplete): ?>
                                <a href="<?php echo e(route('ppdb.lengkapi-data')); ?>" class="text-primary text-sm font-medium hover:underline">Lengkapi</a>
                            <?php endif; ?>
                        </div>
                        
                        <!-- Step 3: Orang Tua -->
                        <div class="flex items-center gap-4 p-4 rounded-xl <?php echo e($orangTuaComplete ? 'bg-sky-50 border border-sky-100' : 'bg-gray-50 border border-gray-100'); ?>">
                            <div class="w-10 h-10 rounded-full flex items-center justify-center flex-shrink-0 <?php echo e($orangTuaComplete ? 'bg-[#0EA5E9] text-white' : 'bg-gray-200 text-gray-800'); ?>">
                                <?php if($orangTuaComplete): ?>
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                <?php else: ?>
                                    <span class="text-sm font-bold">3</span>
                                <?php endif; ?>
                            </div>
                            <div class="flex-1">
                                <h4 class="font-semibold text-gray-900">Data Orang Tua</h4>
                                <p class="text-sm text-gray-600"><?php echo e($orangTuaComplete ? 'Lengkap' : 'Belum lengkap'); ?></p>
                            </div>
                            <?php if(!$orangTuaComplete): ?>
                                <a href="<?php echo e(route('ppdb.lengkapi-data')); ?>" class="text-primary text-sm font-medium hover:underline">Lengkapi</a>
                            <?php endif; ?>
                        </div>
                        
                        <!-- Step 4: Jurusan -->
                        <div class="flex items-center gap-4 p-4 rounded-xl <?php echo e($jurusanComplete ? 'bg-sky-50 border border-sky-100' : 'bg-gray-50 border border-gray-100'); ?>">
                            <div class="w-10 h-10 rounded-full flex items-center justify-center flex-shrink-0 <?php echo e($jurusanComplete ? 'bg-[#0EA5E9] text-white' : 'bg-gray-200 text-gray-800'); ?>">
                                <?php if($jurusanComplete): ?>
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                <?php else: ?>
                                    <span class="text-sm font-bold">4</span>
                                <?php endif; ?>
                            </div>
                            <div class="flex-1">
                                <h4 class="font-semibold text-gray-900">Pilihan Jurusan</h4>
                                <p class="text-sm text-gray-600"><?php echo e($jurusanComplete ? ($siswa->pendaftaran->jurusan->nama ?? 'Terpilih') : 'Belum memilih'); ?></p>
                            </div>
                            <?php if(!$jurusanComplete): ?>
                                <a href="<?php echo e(route('ppdb.lengkapi-data')); ?>" class="text-primary text-sm font-medium hover:underline">Pilih</a>
                            <?php endif; ?>
                        </div>
                        
                        <!-- Step 5: Berkas -->
                        <div class="flex items-center gap-4 p-4 rounded-xl <?php echo e($progress['is_complete'] ? 'bg-sky-50 border border-sky-100' : ($progress['uploaded'] > 0 ? 'bg-yellow-50 border border-yellow-100' : 'bg-gray-50 border border-gray-100')); ?>">
                            <div class="w-10 h-10 rounded-full flex items-center justify-center flex-shrink-0 <?php echo e($progress['is_complete'] ? 'bg-[#0EA5E9] text-white' : ($progress['uploaded'] > 0 ? 'bg-yellow-400 text-gray-800' : 'bg-gray-200 text-gray-800')); ?>">
                                <?php if($progress['is_complete']): ?>
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                <?php else: ?>
                                    <span class="text-sm font-bold">5</span>
                                <?php endif; ?>
                            </div>
                            <div class="flex-1">
                                <h4 class="font-semibold text-gray-900">Upload Berkas</h4>
                                <p class="text-sm text-gray-600"><?php echo e($progress['uploaded']); ?>/<?php echo e($progress['total']); ?> dokumen</p>
                            </div>
                            <a href="<?php echo e(route('ppdb.berkas')); ?>" class="text-primary text-sm font-medium hover:underline">
                                <?php echo e($progress['is_complete'] ? 'Kelola' : 'Upload'); ?>

                            </a>
                        </div>
                        
                        <!-- Step 6: Tes & Wawancara -->
                        <div class="flex items-center gap-4 p-4 rounded-xl <?php echo e($wawancaraComplete ? 'bg-sky-50 border border-sky-100' : ($progress['is_complete'] ? 'bg-blue-50 border border-blue-100' : 'bg-gray-50 border border-gray-100')); ?>">
                            <div class="w-10 h-10 rounded-full flex items-center justify-center flex-shrink-0 <?php echo e($wawancaraComplete ? 'bg-[#0EA5E9] text-white' : ($progress['is_complete'] ? 'bg-primary text-white' : 'bg-gray-200 text-gray-800')); ?>">
                                <?php if($wawancaraComplete): ?>
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                <?php else: ?>
                                    <span class="text-sm font-bold">6</span>
                                <?php endif; ?>
                            </div>
                            <div class="flex-1">
                                <h4 class="font-semibold text-gray-900">Tes &amp; Wawancara</h4>
                                <p class="text-sm text-gray-600">
                                    <?php if($wawancaraComplete): ?>
                                        Selesai dilaksanakan
                                        <?php if($tes?->nilai_minat_bakat): ?>
                                            <br><span class="text-xs text-gray-500 mt-1">Minat Bakat: <?php echo e(Str::limit($tes->nilai_minat_bakat, 50)); ?></span>
                                        <?php endif; ?>
                                    <?php elseif($progress['is_complete']): ?>
                                        Menunggu pelaksanaan
                                    <?php else: ?>
                                        Lengkapi upload berkas terlebih dahulu
                                    <?php endif; ?>
                                </p>
                            </div>
                        </div>
                        
                        <!-- Step 7: Kelulusan -->
                        <div class="flex items-center gap-4 p-4 rounded-xl <?php echo e($kelulusanStatus === 'Lulus' ? 'bg-sky-50 border border-sky-100' : ($wawancaraComplete ? 'bg-blue-50 border border-blue-100' : 'bg-gray-50 border border-gray-100')); ?>">
                            <div class="w-10 h-10 rounded-full flex items-center justify-center flex-shrink-0 <?php echo e($kelulusanStatus === 'Lulus' ? 'bg-[#0EA5E9] text-white' : ($wawancaraComplete ? 'bg-primary text-white' : 'bg-gray-200 text-gray-800')); ?>">
                                <?php if($kelulusanStatus === 'Lulus'): ?>
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                <?php else: ?>
                                    <span class="text-sm font-bold">7</span>
                                <?php endif; ?>
                            </div>
                            <div class="flex-1">
                                <h4 class="font-semibold text-gray-900">Kelulusan</h4>
                                <p class="text-sm text-gray-600">
                                    <?php if($kelulusanStatus === 'Lulus'): ?>
                                        <span class="text-[#0EA5E9] font-medium">Selamat! Anda dinyatakan LULUS</span>
                                    <?php elseif($wawancaraComplete): ?>
                                        Sedang diproses
                                    <?php else: ?>
                                        Menunggu selesainya tes dan wawancara
                                    <?php endif; ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Next Steps Info -->
            <?php if($progress['is_complete'] && $biodataComplete && $orangTuaComplete && $jurusanComplete): ?>
                <?php if($wawancaraComplete): ?>
                    <!-- Sudah selesai wawancara -->
                    <div class="mt-6 bg-sky-50 border border-sky-200 rounded-xl p-6">
                        <div class="flex items-start gap-3">
                            <svg class="w-6 h-6 text-[#0EA5E9] mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <div>
                                <h4 class="font-semibold text-sky-900">Tes dan Wawancara Selesai!</h4>
                                <p class="text-sm text-[#0284C7] mt-1">
                                    <?php if($kelulusanStatus === 'Lulus'): ?>
                                        Selamat! Anda dinyatakan <strong>LULUS</strong>. Silakan cek pengumuman untuk informasi lebih lanjut.
                                    <?php else: ?>
                                        Status kelulusan Anda sedang diproses. Silakan tunggu pengumuman resmi.
                                    <?php endif; ?>
                                </p>
                                <?php if($tes?->nilai_minat_bakat): ?>
                                <div class="mt-3 p-3 bg-white rounded-lg border border-sky-200">
                                    <p class="text-xs text-gray-600 mb-1">Catatan Minat dan Bakat:</p>
                                    <p class="text-sm text-gray-800"><?php echo e($tes->nilai_minat_bakat); ?></p>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php else: ?>
                    <!-- Data lengkap, menunggu wawancara -->
                    <div class="mt-6 bg-blue-50 border border-blue-200 rounded-xl p-6">
                        <div class="flex items-start gap-3">
                            <svg class="w-6 h-6 text-blue-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <div>
                                <h4 class="font-semibold text-blue-900">Selamat! Semua data lengkap</h4>
                                <p class="text-sm text-blue-700 mt-1">
                                    Anda telah menyelesaikan semua langkah pendaftaran. Tes dan wawancara akan diinformasikan melalui WhatsApp Anda.
                                </p>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            <?php else: ?>
                <div class="mt-6 bg-yellow-50 border border-yellow-200 rounded-xl p-6">
                    <div class="flex items-start gap-3">
                        <svg class="w-6 h-6 text-yellow-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                        </svg>
                        <div>
                            <h4 class="font-semibold text-yellow-900">Lengkapi Data Anda</h4>
                            <p class="text-sm text-yellow-700 mt-1">
                                Silakan lengkapi semua data dan upload dokumen yang diperlukan untuk melanjutkan proses pendaftaran.
                            </p>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\eka\.gemini\antigravity\scratch\smk-alstar\resources\views/ppdb/status.blade.php ENDPATH**/ ?>