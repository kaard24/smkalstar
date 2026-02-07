<?php $__env->startSection('title', 'Status Pendaftaran - SPMB SMK Al-Hidayah Lestari'); ?>

<?php $__env->startSection('content'); ?>
<div class="min-h-screen bg-slate-50">
    


    <?php
        $totalSteps = 7;
        $completedSteps = 1;
        if($biodataComplete) $completedSteps++;
        if($orangTuaComplete) $completedSteps++;
        if($jurusanComplete) $completedSteps++;
        if($progress['is_complete']) $completedSteps++;
        if($wawancaraComplete) $completedSteps++;
        if($kelulusanStatus === 'Lulus') $completedSteps++;
        $overallProgress = ($completedSteps / $totalSteps) * 100;
        
        $labelOrtu = ($jenisOrtu === 'wali') ? 'Data Wali' : 'Data Orang Tua';
    ?>

    <!-- Main Content -->
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-6 max-w-4xl">
        
        <!-- Progress Overview -->
        <div class="bg-white rounded-xl border border-slate-200 p-6 mb-6">
            <div class="flex flex-col sm:flex-row sm:items-center gap-6">
                <div class="flex items-center gap-4">
                    <div class="w-20 h-20 relative">
                        <svg class="w-full h-full transform -rotate-90" viewBox="0 0 36 36">
                            <path class="text-slate-100" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" fill="none" stroke="currentColor" stroke-width="3"/>
                            <path class="<?php echo e($overallProgress >= 100 ? 'text-emerald-500' : ($overallProgress >= 70 ? 'text-blue-500' : ($overallProgress >= 40 ? 'text-amber-500' : 'text-slate-400'))); ?>" 
                                  stroke-dasharray="<?php echo e($overallProgress); ?>, 100" 
                                  d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" 
                                  fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round"/>
                        </svg>
                        <div class="absolute inset-0 flex items-center justify-center">
                            <span class="text-xl font-bold <?php echo e($overallProgress >= 100 ? 'text-emerald-600' : ($overallProgress >= 70 ? 'text-blue-600' : ($overallProgress >= 40 ? 'text-amber-600' : 'text-slate-600'))); ?>"><?php echo e(round($overallProgress)); ?>%</span>
                        </div>
                    </div>
                    <div>
                        <h2 class="text-lg font-semibold text-slate-800">Progres Pendaftaran</h2>
                        <p class="text-sm text-slate-500"><?php echo e($completedSteps); ?> dari <?php echo e($totalSteps); ?> langkah</p>
                    </div>
                </div>
                <div class="flex-1 sm:text-right">
                    <?php if($kelulusanStatus === 'Lulus'): ?>
                        <span class="inline-flex items-center gap-1.5 text-sm font-bold text-emerald-600 bg-emerald-50 px-4 py-2 rounded-lg">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            LULUS
                        </span>
                    <?php elseif($overallProgress >= 85): ?>
                        <span class="inline-flex items-center gap-1.5 text-sm font-medium text-blue-600 bg-blue-50 px-3 py-1.5 rounded-lg">Hampir Selesai</span>
                    <?php elseif($overallProgress >= 50): ?>
                        <span class="inline-flex items-center gap-1.5 text-sm font-medium text-amber-600 bg-amber-50 px-3 py-1.5 rounded-lg">Dalam Proses</span>
                    <?php else: ?>
                        <span class="inline-flex items-center gap-1.5 text-sm font-medium text-slate-600 bg-slate-100 px-3 py-1.5 rounded-lg">Memulai</span>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Student Profile -->
        <div class="bg-white rounded-xl border border-slate-200 p-5 mb-6">
            <div class="flex flex-col sm:flex-row sm:items-center gap-4">
                <div class="w-16 h-16 rounded-xl overflow-hidden <?php echo e($siswa->foto ? '' : 'bg-blue-500'); ?>">
                    <?php if($siswa->foto): ?>
                        <img src="<?php echo e(asset('storage/foto/' . $siswa->foto)); ?>" alt="Foto" class="w-full h-full object-cover">
                    <?php else: ?>
                        <div class="w-full h-full flex items-center justify-center">
                            <span class="text-xl font-bold text-white"><?php echo e(substr($siswa->nama, 0, 1)); ?></span>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="flex-1 min-w-0">
                    <h3 class="text-lg font-semibold text-slate-800 truncate"><?php echo e($siswa->nama); ?></h3>
                    <p class="text-sm text-slate-500">NISN: <?php echo e($siswa->nisn); ?></p>
                    <?php if($siswa->pendaftaran?->jurusan): ?>
                        <div class="mt-2 inline-flex items-center gap-2 text-sm">
                            <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"/>
                            </svg>
                            <span class="text-blue-600 font-medium"><?php echo e($siswa->pendaftaran->jurusan->nama); ?></span>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="flex gap-4 text-center">
                    <div>
                        <p class="text-xl font-bold text-slate-800"><?php echo e($totalSteps - $completedSteps); ?></p>
                        <p class="text-xs text-slate-500">Tersisa</p>
                    </div>
                    <div class="w-px bg-slate-200"></div>
                    <div>
                        <p class="text-xl font-bold <?php echo e($progress['is_complete'] ? 'text-emerald-600' : 'text-amber-600'); ?>"><?php echo e($progress['uploaded']); ?>/<?php echo e($progress['total']); ?></p>
                        <p class="text-xs text-slate-500">Berkas</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Steps Timeline -->
        <div class="bg-white rounded-xl border border-slate-200 p-5">
            <h3 class="font-semibold text-slate-800 mb-5">Detail Langkah</h3>
            
            <div class="relative">
                <div class="absolute left-5 top-3 bottom-3 w-0.5 bg-slate-200"></div>
                
                <div class="space-y-4">
                    
                    <!-- Step 1: Pendaftaran -->
                    <div class="relative flex gap-4">
                        <div class="w-10 h-10 rounded-full bg-blue-500 flex items-center justify-center flex-shrink-0 z-10">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                        <div class="flex-1 pt-1">
                            <div class="flex items-center justify-between mb-1">
                                <h4 class="font-medium text-slate-800">Pendaftaran Akun</h4>
                                <span class="text-xs text-blue-600 bg-blue-50 px-2 py-0.5 rounded">Selesai</span>
                            </div>
                            <p class="text-sm text-slate-500">Akun berhasil dibuat pada <?php echo e($siswa->created_at->format('d M Y')); ?></p>
                        </div>
                    </div>

                    <!-- Step 2: Biodata -->
                    <div class="relative flex gap-4">
                        <div class="w-10 h-10 rounded-full flex items-center justify-center flex-shrink-0 z-10 <?php echo e($biodataComplete ? 'bg-blue-500' : 'bg-slate-200'); ?>">
                            <?php if($biodataComplete): ?>
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                                </svg>
                            <?php else: ?>
                                <span class="text-sm font-bold text-slate-600">2</span>
                            <?php endif; ?>
                        </div>
                        <div class="flex-1 pt-1">
                            <div class="flex items-center justify-between mb-1">
                                <h4 class="font-medium <?php echo e($biodataComplete ? 'text-slate-800' : 'text-slate-600'); ?>">Data Diri Lengkap</h4>
                                <?php if($biodataComplete): ?>
                                    <span class="text-xs text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded">Selesai</span>
                                <?php else: ?>
                                    <a href="<?php echo e(route('spmb.lengkapi-data')); ?>" class="text-xs text-white bg-blue-500 hover:bg-blue-600 px-3 py-1 rounded transition-colors">Lengkapi</a>
                                <?php endif; ?>
                            </div>
                            <p class="text-sm text-slate-500"><?php echo e($biodataComplete ? 'Data diri sudah lengkap' : 'Silakan lengkapi NIK, alamat, dan data diri lainnya'); ?></p>
                        </div>
                    </div>

                    <!-- Step 3: Orang Tua -->
                    <div class="relative flex gap-4">
                        <div class="w-10 h-10 rounded-full flex items-center justify-center flex-shrink-0 z-10 <?php echo e($orangTuaComplete ? 'bg-blue-500' : 'bg-slate-200'); ?>">
                            <?php if($orangTuaComplete): ?>
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                                </svg>
                            <?php else: ?>
                                <span class="text-sm font-bold text-slate-600">3</span>
                            <?php endif; ?>
                        </div>
                        <div class="flex-1 pt-1">
                            <div class="flex items-center justify-between mb-1">
                                <h4 class="font-medium <?php echo e($orangTuaComplete ? 'text-slate-800' : 'text-slate-600'); ?>"><?php echo e($labelOrtu); ?></h4>
                                <?php if($orangTuaComplete): ?>
                                    <span class="text-xs text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded">Selesai</span>
                                <?php else: ?>
                                    <a href="<?php echo e(route('spmb.lengkapi-data')); ?>" class="text-xs text-white bg-blue-500 hover:bg-blue-600 px-3 py-1 rounded transition-colors">Lengkapi</a>
                                <?php endif; ?>
                            </div>
                            <p class="text-sm text-slate-500">
                                <?php if($orangTuaComplete): ?>
                                    <?php echo e($jenisOrtu === 'wali' ? 'Data wali sudah lengkap' : 'Data orang tua sudah lengkap'); ?>

                                <?php else: ?>
                                    Silakan lengkapi data <?php echo e($jenisOrtu === 'wali' ? 'wali' : 'ayah dan ibu'); ?>

                                <?php endif; ?>
                            </p>
                        </div>
                    </div>

                    <!-- Step 4: Jurusan -->
                    <div class="relative flex gap-4">
                        <div class="w-10 h-10 rounded-full flex items-center justify-center flex-shrink-0 z-10 <?php echo e($jurusanComplete ? 'bg-blue-500' : 'bg-slate-200'); ?>">
                            <?php if($jurusanComplete): ?>
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                                </svg>
                            <?php else: ?>
                                <span class="text-sm font-bold text-slate-600">4</span>
                            <?php endif; ?>
                        </div>
                        <div class="flex-1 pt-1">
                            <div class="flex items-center justify-between mb-1">
                                <h4 class="font-medium <?php echo e($jurusanComplete ? 'text-slate-800' : 'text-slate-600'); ?>">Jurusan Dipilih</h4>
                                <?php if($jurusanComplete): ?>
                                    <span class="text-xs text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded">Selesai</span>
                                <?php else: ?>
                                    <a href="<?php echo e(route('spmb.lengkapi-data')); ?>" class="text-xs text-white bg-blue-500 hover:bg-blue-600 px-3 py-1 rounded transition-colors">Pilih</a>
                                <?php endif; ?>
                            </div>
                            <p class="text-sm text-slate-500">
                                <?php if($jurusanComplete): ?>
                                    <span class="inline-flex items-center gap-1.5">
                                        <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"/>
                                        </svg>
                                        <span class="text-blue-600 font-medium"><?php echo e($siswa->pendaftaran->jurusan->nama ?? ''); ?></span>
                                    </span>
                                <?php else: ?>
                                    Silakan pilih jurusan yang diminati
                                <?php endif; ?>
                            </p>
                        </div>
                    </div>

                    <!-- Step 5: Upload Berkas -->
                    <div class="relative flex gap-4">
                        <div class="w-10 h-10 rounded-full flex items-center justify-center flex-shrink-0 z-10 <?php echo e($progress['is_complete'] ? 'bg-blue-500' : ($progress['uploaded'] > 0 ? 'bg-amber-400' : 'bg-slate-200')); ?>">
                            <?php if($progress['is_complete']): ?>
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                                </svg>
                            <?php else: ?>
                                <span class="text-sm font-bold <?php echo e($progress['uploaded'] > 0 ? 'text-white' : 'text-slate-600'); ?>"><?php echo e($progress['uploaded']); ?></span>
                            <?php endif; ?>
                        </div>
                        <div class="flex-1 pt-1">
                            <div class="flex items-center justify-between mb-1">
                                <h4 class="font-medium <?php echo e($progress['is_complete'] ? 'text-slate-800' : 'text-slate-600'); ?>">Upload Berkas (<?php echo e($progress['uploaded']); ?>/<?php echo e($progress['total']); ?>)</h4>
                                <a href="<?php echo e(route('spmb.berkas')); ?>" class="text-xs <?php echo e($progress['is_complete'] ? 'text-blue-600 bg-blue-50' : 'text-white bg-blue-500 hover:bg-blue-600'); ?> px-3 py-1 rounded transition-colors">
                                    <?php echo e($progress['is_complete'] ? 'Kelola' : ($progress['uploaded'] > 0 ? 'Lanjut' : 'Upload')); ?>

                                </a>
                            </div>
                            <p class="text-sm text-slate-500 mb-3"><?php echo e($progress['is_complete'] ? 'Semua berkas lengkap' : 'Upload dokumen yang diperlukan'); ?></p>
                            
                            <!-- Detail Checklist Berkas -->
                            <div class="bg-slate-50 rounded-lg p-3 space-y-2">
                                <?php $__currentLoopData = $progress['detail']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="flex items-center gap-2 text-sm">
                                        <?php if($item['uploaded']): ?>
                                            <svg class="w-4 h-4 text-emerald-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                            </svg>
                                            <span class="text-slate-700"><?php echo e($item['label']); ?></span>
                                            <span class="text-xs text-emerald-600 bg-emerald-50 px-1.5 py-0.5 rounded ml-auto">Selesai</span>
                                        <?php else: ?>
                                            <svg class="w-4 h-4 text-slate-300 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <circle cx="12" cy="12" r="10" stroke-width="2"/>
                                            </svg>
                                            <span class="text-slate-500"><?php echo e($item['label']); ?></span>
                                            <span class="text-xs text-amber-600 bg-amber-50 px-1.5 py-0.5 rounded ml-auto">Kurang</span>
                                        <?php endif; ?>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>

                    <!-- Step 6: Tes & Wawancara -->
                    <div class="relative flex gap-4">
                        <div class="w-10 h-10 rounded-full flex items-center justify-center flex-shrink-0 z-10 <?php echo e($wawancaraComplete ? 'bg-blue-500' : ($progress['is_complete'] ? 'bg-blue-100 border-2 border-blue-500' : 'bg-slate-200')); ?>">
                            <?php if($wawancaraComplete): ?>
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                                </svg>
                            <?php elseif($progress['is_complete']): ?>
                                <span class="w-2 h-2 bg-blue-500 rounded-full"></span>
                            <?php else: ?>
                                <span class="text-sm font-bold text-slate-600">6</span>
                            <?php endif; ?>
                        </div>
                        <div class="flex-1 pt-1">
                            <div class="flex items-center justify-between mb-1">
                                <h4 class="font-medium <?php echo e($wawancaraComplete ? 'text-slate-800' : ($progress['is_complete'] ? 'text-blue-600' : 'text-slate-600')); ?>">Tes & Wawancara</h4>
                                <?php if($wawancaraComplete): ?>
                                    <span class="text-xs text-blue-600 bg-blue-50 px-2 py-0.5 rounded">Selesai</span>
                                <?php elseif($progress['is_complete']): ?>
                                    <span class="text-xs text-blue-600 bg-blue-50 px-2 py-0.5 rounded">Menunggu</span>
                                <?php endif; ?>
                            </div>
                            <p class="text-sm text-slate-500">
                                <?php if($wawancaraComplete): ?>
                                    Tes dan wawancara telah selesai
                                <?php elseif($progress['is_complete']): ?>
                                    Menunggu jadwal via WhatsApp
                                <?php else: ?>
                                    Lengkapi upload berkas terlebih dahulu
                                <?php endif; ?>
                            </p>
                        </div>
                    </div>

                    <!-- Step 7: Kelulusan -->
                    <div class="relative flex gap-4">
                        <div class="w-10 h-10 rounded-full flex items-center justify-center flex-shrink-0 z-10 <?php echo e($kelulusanStatus === 'Lulus' ? 'bg-emerald-500' : ($kelulusanStatus === 'Tidak Lulus' ? 'bg-red-500' : ($wawancaraComplete ? 'bg-blue-100 border-2 border-blue-500' : 'bg-slate-200'))); ?>">
                            <?php if($kelulusanStatus === 'Lulus'): ?>
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                                </svg>
                            <?php elseif($kelulusanStatus === 'Tidak Lulus'): ?>
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            <?php elseif($wawancaraComplete): ?>
                                <span class="w-2 h-2 bg-blue-500 rounded-full"></span>
                            <?php else: ?>
                                <span class="text-sm font-bold text-slate-600">7</span>
                            <?php endif; ?>
                        </div>
                        <div class="flex-1 pt-1">
                            <div class="flex items-center justify-between mb-1">
                                <h4 class="font-medium <?php echo e($kelulusanStatus === 'Lulus' ? 'text-emerald-700' : ($kelulusanStatus === 'Tidak Lulus' ? 'text-red-700' : ($wawancaraComplete ? 'text-blue-600' : 'text-slate-600'))); ?>">Kelulusan</h4>
                                <?php if($kelulusanStatus === 'Lulus'): ?>
                                    <span class="text-xs text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded font-bold">LULUS</span>
                                <?php elseif($kelulusanStatus === 'Tidak Lulus'): ?>
                                    <span class="text-xs text-red-600 bg-red-50 px-2 py-0.5 rounded font-bold">Tidak Lulus</span>
                                <?php elseif($wawancaraComplete): ?>
                                    <span class="text-xs text-blue-600 bg-blue-50 px-2 py-0.5 rounded">Diproses</span>
                                <?php endif; ?>
                            </div>
                            <p class="text-sm <?php echo e($kelulusanStatus === 'Lulus' ? 'text-emerald-600' : ($kelulusanStatus === 'Tidak Lulus' ? 'text-red-600' : 'text-slate-500')); ?>">
                                <?php if($kelulusanStatus === 'Lulus'): ?>
                                    Selamat! Anda dinyatakan LULUS.
                                <?php elseif($kelulusanStatus === 'Tidak Lulus'): ?>
                                    Anda dinyatakan tidak lulus. Tetap semangat!
                                <?php elseif($wawancaraComplete): ?>
                                    Status kelulusan sedang diproses.
                                <?php else: ?>
                                    Menunggu selesainya tes dan wawancara
                                <?php endif; ?>
                            </p>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- Info Card -->
        <?php if($kelulusanStatus === 'Lulus' && $progress['is_complete']): ?>
            
            <div class="mt-6 bg-emerald-50 border border-emerald-200 rounded-xl p-5">
                <div class="flex flex-col sm:flex-row sm:items-center gap-4">
                    <div class="w-12 h-12 bg-emerald-500 rounded-lg flex items-center justify-center flex-shrink-0">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h3 class="font-semibold text-emerald-900">Selamat! Anda Lulus!</h3>
                        <p class="text-sm text-emerald-700">Anda telah berhasil menyelesaikan semua tahapan dan dinyatakan LULUS.</p>
                    </div>
                    <a href="<?php echo e(route('spmb.pengumuman')); ?>" class="inline-flex items-center gap-2 px-5 py-2.5 bg-emerald-500 text-white rounded-lg font-medium hover:bg-emerald-600 transition-colors">
                        Lihat Pengumuman
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                        </svg>
                    </a>
                </div>
            </div>
        <?php elseif($kelulusanStatus === 'Lulus' && !$progress['is_complete']): ?>
            
            <div class="mt-6 bg-emerald-50 border border-emerald-200 rounded-xl p-5">
                <div class="flex flex-col sm:flex-row sm:items-center gap-4">
                    <div class="w-12 h-12 bg-emerald-500 rounded-lg flex items-center justify-center flex-shrink-0">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h3 class="font-semibold text-emerald-900">Selamat atas kelulusan anda!</h3>
                        <p class="text-sm text-emerald-700">Mohon untuk lengkapi berkas Anda. Silakan upload berkas yang masih kurang.</p>
                    </div>
                    <a href="<?php echo e(route('spmb.berkas')); ?>" class="inline-flex items-center gap-2 px-5 py-2.5 bg-emerald-500 text-white rounded-lg font-medium hover:bg-emerald-600 transition-colors">
                        Lengkapi Berkas
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                        </svg>
                    </a>
                </div>
            </div>
        <?php elseif(!$progress['is_complete']): ?>
            
            <div class="mt-6 bg-amber-50 border border-amber-200 rounded-xl p-5">
                <div class="flex flex-col sm:flex-row sm:items-center gap-4">
                    <div class="w-12 h-12 bg-amber-500 rounded-lg flex items-center justify-center flex-shrink-0">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h3 class="font-semibold text-amber-900">Hampir Selesai!</h3>
                        <p class="text-sm text-amber-700">Upload semua berkas. Tes dan wawancara akan diinformasikan via WhatsApp.</p>
                    </div>
                    <a href="<?php echo e(route('spmb.berkas')); ?>" class="inline-flex items-center gap-2 px-5 py-2.5 bg-amber-500 text-white rounded-lg font-medium hover:bg-amber-600 transition-colors">
                        Upload Berkas
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                        </svg>
                    </a>
                </div>
            </div>
        <?php elseif($overallProgress >= 85): ?>
            
            <div class="mt-6 bg-blue-50 border border-blue-200 rounded-xl p-5">
                <div class="flex flex-col sm:flex-row sm:items-center gap-4">
                    <div class="w-12 h-12 bg-blue-500 rounded-lg flex items-center justify-center flex-shrink-0">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h3 class="font-semibold text-blue-900">Hampir Selesai!</h3>
                        <p class="text-sm text-blue-700">Semua data Anda sudah lengkap. Tes dan wawancara akan diinformasikan via WhatsApp.</p>
                    </div>
                </div>
            </div>
        <?php elseif($overallProgress < 50): ?>
            <div class="mt-6 bg-slate-50 border border-slate-200 rounded-xl p-5">
                <div class="flex flex-col sm:flex-row sm:items-center gap-4">
                    <div class="w-12 h-12 bg-slate-200 rounded-lg flex items-center justify-center flex-shrink-0">
                        <svg class="w-6 h-6 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h3 class="font-semibold text-slate-800">Mulai Perjalanan Anda</h3>
                        <p class="text-sm text-slate-600">Silakan lengkapi semua data dan upload dokumen yang diperlukan.</p>
                    </div>
                    <a href="<?php echo e(route('spmb.lengkapi-data')); ?>" class="inline-flex items-center gap-2 px-5 py-2.5 bg-blue-500 text-white rounded-lg font-medium hover:bg-blue-600 transition-colors">
                        Mulai
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </a>
                </div>
            </div>
        <?php endif; ?>

    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\user\.gemini\antigravity\scratch\smkalstar\smkalstar\resources\views/spmb/status.blade.php ENDPATH**/ ?>