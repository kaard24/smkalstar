<?php $__env->startSection('title', 'Dashboard - SPMB SMK Al-Hidayah Lestari'); ?>

<?php $__env->startSection('content'); ?>
<div class="min-h-screen bg-slate-50">
    
  

    <!-- Main Content -->
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-6">
        
        <!-- Welcome Card -->
        <div class="bg-white rounded-xl border border-slate-200 p-6 mb-6">
            <div class="flex flex-col sm:flex-row sm:items-center gap-4">
                <div class="w-16 h-16 rounded-xl overflow-hidden flex-shrink-0 <?php echo e($siswa->foto ? '' : 'bg-gradient-to-br from-amber-400 to-orange-500'); ?>">
                    <?php if($siswa->foto): ?>
                        <img src="<?php echo e(asset('storage/foto/' . $siswa->foto)); ?>" alt="Foto" class="w-full h-full object-cover">
                    <?php else: ?>
                        <div class="w-full h-full flex items-center justify-center">
                            <span class="text-xl font-bold text-white"><?php echo e(substr($siswa->nama, 0, 1)); ?></span>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm text-slate-500 mb-1">Selamat datang,</p>
                    <h2 class="text-xl font-bold text-slate-800 truncate"><?php echo e($siswa->nama ?: 'Calon Siswa'); ?></h2>
                    <?php if($pendaftaran?->jurusan): ?>
                        <p class="text-sm text-blue-600 mt-1">Pilihan Jurusan: <?php echo e($pendaftaran->jurusan->nama); ?></p>
                    <?php endif; ?>
                </div>
                <div class="flex items-center gap-3 pt-4 sm:pt-0 border-t sm:border-t-0 border-slate-100">
                    <div class="text-right">
                        <p class="text-2xl font-bold <?php echo e($completeness['percentage'] === 100 ? 'text-emerald-600' : 'text-blue-600'); ?>"><?php echo e($completeness['percentage']); ?>%</p>
                        <p class="text-xs text-slate-500">Progress</p>
                    </div>
                    <div class="w-12 h-12 relative">
                        <svg class="w-full h-full transform -rotate-90" viewBox="0 0 36 36">
                            <path class="text-slate-100" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" fill="none" stroke="currentColor" stroke-width="3"/>
                            <path class="<?php echo e($completeness['percentage'] === 100 ? 'text-emerald-500' : 'text-blue-500'); ?>" stroke-dasharray="<?php echo e($completeness['percentage']); ?>, 100" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Alert Messages -->
        <?php if(session('error')): ?>
        <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg flex items-start gap-3">
            <svg class="w-5 h-5 text-red-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <p class="text-sm text-red-700"><?php echo e(session('error')); ?></p>
        </div>
        <?php endif; ?>

        <?php if(session('success')): ?>
        <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 rounded-lg flex items-start gap-3">
            <svg class="w-5 h-5 text-emerald-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <p class="text-sm text-emerald-700"><?php echo e(session('success')); ?></p>
        </div>
        <?php endif; ?>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            
            <!-- Left Column -->
            <div class="lg:col-span-2 space-y-6">
                
                <!-- Progress Overview -->
                <div class="bg-white rounded-xl border border-slate-200 overflow-hidden">
                    <div class="p-4 border-b border-slate-100">
                        <h3 class="font-semibold text-slate-800">Status Pendaftaran</h3>
                    </div>
                    <div class="p-4">
                        <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
                            <?php
                                $statusItems = [
                                    ['key' => 'biodata', 'label' => 'Biodata', 'icon' => 'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z'],
                                    ['key' => 'orang_tua', 'label' => 'Orang Tua/Wali', 'icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z'],
                                    ['key' => 'jurusan', 'label' => 'Jurusan', 'icon' => 'M12 14l9-5-9-5-9 5 9 5z'],
                                    ['key' => 'berkas', 'label' => 'Berkas', 'icon' => 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z'],
                                    ['key' => 'pembayaran', 'label' => 'Pembayaran', 'icon' => 'M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a1 1 0 11-2 0 1 1 0 012 0z'],
                                ];
                            ?>
                            
                            <?php $__currentLoopData = $statusItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php 
                                $isComplete = $completeness[$item['key']];
                                $itemUrl = match($item['key']) {
                                    'berkas' => route('spmb.berkas'),
                                    'pembayaran' => route('spmb.pembayaran'),
                                    default => route('spmb.profil.edit'),
                                };
                            ?>
                            <a href="<?php echo e($itemUrl); ?>" 
                               class="block p-4 rounded-lg border <?php echo e($isComplete ? 'bg-emerald-50 border-emerald-200' : 'bg-slate-50 border-slate-200'); ?> hover:border-blue-300 transition-colors">
                                <div class="flex items-center justify-between mb-2">
                                    <div class="w-8 h-8 rounded-lg <?php echo e($isComplete ? 'bg-emerald-500' : 'bg-slate-300'); ?> flex items-center justify-center">
                                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="<?php echo e($item['icon']); ?>"/>
                                        </svg>
                                    </div>
                                    <?php if($isComplete): ?>
                                        <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                        </svg>
                                    <?php endif; ?>
                                </div>
                                <p class="text-xs text-slate-500"><?php echo e($item['label']); ?></p>
                                <p class="text-sm font-semibold <?php echo e($isComplete ? 'text-emerald-700' : 'text-slate-700'); ?>"><?php echo e($isComplete ? 'Lengkap' : 'Belum'); ?></p>
                            </a>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        
                        <!-- Progress Bar -->
                        <div class="mt-4">
                            <div class="flex items-center justify-between text-sm mb-2">
                                <span class="text-slate-600">Progress Keseluruhan</span>
                                <span class="font-semibold <?php echo e($completeness['percentage'] === 100 ? 'text-emerald-600' : 'text-blue-600'); ?>"><?php echo e($completeness['percentage']); ?>%</span>
                            </div>
                            <div class="h-2 bg-slate-100 rounded-full overflow-hidden">
                                <div class="h-full <?php echo e($completeness['percentage'] === 100 ? 'bg-emerald-500' : 'bg-blue-500'); ?> rounded-full transition-all duration-500" style="width: <?php echo e($completeness['percentage']); ?>%"></div>
                            </div>
                            <?php if($completeness['percentage'] < 100): ?>
                                <p class="text-xs text-amber-600 mt-2">Silakan lengkapi semua data untuk melanjutkan ke tahap selanjutnya.</p>
                            <?php else: ?>
                                <p class="text-xs text-emerald-600 mt-2">Selamat! Semua data telah lengkap.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <!-- Biodata Card -->
                <div class="bg-white rounded-xl border border-slate-200 overflow-hidden">
                    <div class="p-4 border-b border-slate-100 flex items-center justify-between">
                        <h3 class="font-semibold text-slate-800">Data Pribadi</h3>
                        <?php if($completeness['biodata']): ?>
                            <a href="<?php echo e(route('spmb.profil.edit')); ?>" class="text-sm text-blue-600 hover:text-blue-700 font-medium">Edit</a>
                        <?php else: ?>
                            <a href="<?php echo e(route('spmb.lengkapi-data')); ?>" class="text-sm text-blue-600 hover:text-blue-700 font-medium">Lengkapi</a>
                        <?php endif; ?>
                    </div>
                    <div class="p-4">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div class="flex items-start gap-3">
                                <div class="w-8 h-8 bg-blue-50 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                </div>
                                <div class="min-w-0">
                                    <p class="text-xs text-slate-500">Nama Lengkap</p>
                                    <p class="text-sm font-medium text-slate-800 truncate"><?php echo e($siswa->nama ?: '-'); ?></p>
                                </div>
                            </div>
                            
                            <div class="flex items-start gap-3">
                                <div class="w-8 h-8 bg-purple-50 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <svg class="w-4 h-4 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0"/>
                                    </svg>
                                </div>
                                <div class="min-w-0">
                                    <p class="text-xs text-slate-500">NISN</p>
                                    <p class="text-sm font-medium text-slate-800"><?php echo e($siswa->nisn); ?></p>
                                </div>
                            </div>
                            
                            <div class="flex items-start gap-3">
                                <div class="w-8 h-8 bg-pink-50 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <svg class="w-4 h-4 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                </div>
                                <div class="min-w-0">
                                    <p class="text-xs text-slate-500">Jenis Kelamin</p>
                                    <p class="text-sm font-medium text-slate-800"><?php echo e($siswa->jk === 'L' ? 'Laki-laki' : ($siswa->jk === 'P' ? 'Perempuan' : '-')); ?></p>
                                </div>
                            </div>
                            
                            <div class="flex items-start gap-3">
                                <div class="w-8 h-8 bg-green-50 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                <div class="min-w-0">
                                    <p class="text-xs text-slate-500">Tanggal Lahir</p>
                                    <p class="text-sm font-medium text-slate-800"><?php echo e($siswa->tgl_lahir ? $siswa->tgl_lahir->format('d M Y') : '-'); ?></p>
                                </div>
                            </div>
                            
                            <div class="flex items-start gap-3">
                                <div class="w-8 h-8 bg-emerald-50 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                    </svg>
                                </div>
                                <div class="min-w-0">
                                    <p class="text-xs text-slate-500">No. WhatsApp</p>
                                    <p class="text-sm font-medium text-slate-800"><?php echo e($siswa->no_wa ?: '-'); ?></p>
                                </div>
                            </div>
                            
                            <div class="flex items-start gap-3">
                                <div class="w-8 h-8 bg-amber-50 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <svg class="w-4 h-4 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                    </svg>
                                </div>
                                <div class="min-w-0">
                                    <p class="text-xs text-slate-500">Asal Sekolah</p>
                                    <p class="text-sm font-medium text-slate-800 truncate"><?php echo e($siswa->asal_sekolah ?: '-'); ?></p>
                                </div>
                            </div>
                            
                            <div class="sm:col-span-2 flex items-start gap-3">
                                <div class="w-8 h-8 bg-red-50 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                </div>
                                <div class="min-w-0 flex-1">
                                    <p class="text-xs text-slate-500">Alamat</p>
                                    <p class="text-sm font-medium text-slate-800"><?php echo e($siswa->alamat ?: '-'); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Document Upload Status -->
                <div class="bg-white rounded-xl border border-slate-200 overflow-hidden">
                    <div class="p-4 border-b border-slate-100 flex items-center justify-between">
                        <h3 class="font-semibold text-slate-800">Status Upload Berkas</h3>
                        <span class="text-xs px-2 py-1 <?php echo e($completeness['berkas'] ? 'bg-emerald-100 text-emerald-700' : 'bg-amber-100 text-amber-700'); ?> rounded-lg font-medium">
                            <?php echo e($berkasProgress['uploaded']); ?>/<?php echo e($berkasProgress['total']); ?>

                        </span>
                    </div>
                    <div class="p-4">
                        <div class="space-y-2">
                            <?php $__currentLoopData = $berkasProgress['detail']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="flex items-center gap-3 p-3 rounded-lg <?php echo e($item['uploaded'] ? 'bg-emerald-50 border border-emerald-100' : 'bg-slate-50 border border-slate-100'); ?>">
                                <div class="w-8 h-8 rounded-full flex items-center justify-center flex-shrink-0 <?php echo e($item['uploaded'] ? 'bg-emerald-500' : 'bg-slate-300'); ?>">
                                    <?php if($item['uploaded']): ?>
                                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                                        </svg>
                                    <?php else: ?>
                                        <span class="text-xs text-white font-medium"><?php echo e($loop->iteration); ?></span>
                                    <?php endif; ?>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium <?php echo e($item['uploaded'] ? 'text-slate-800' : 'text-slate-600'); ?>"><?php echo e($item['label']); ?></p>
                                    <?php if(isset($item['keterangan']) && $item['keterangan']): ?>
                                        <p class="text-xs text-slate-500"><?php echo e($item['keterangan']); ?></p>
                                    <?php endif; ?>
                                </div>
                                <?php if($item['uploaded']): ?>
                                    <span class="text-xs font-medium text-emerald-600">Uploaded</span>
                                <?php endif; ?>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <?php if(!$completeness['berkas']): ?>
                            <a href="<?php echo e(route('spmb.berkas')); ?>" class="mt-4 block w-full text-center bg-blue-500 hover:bg-blue-600 text-white py-2.5 rounded-lg text-sm font-medium transition-colors">
                                Upload Berkas Sekarang
                            </a>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Info Card: Tes & Wawancara -->
                <?php if($completeness['berkas']): ?>
                    <?php
                        $tes = $pendaftaran?->tes;
                        $wawancaraSelesai = $tes?->status_wawancara === 'sudah';
                    ?>
                    
                    <?php if(!$wawancaraSelesai): ?>
                    <div class="bg-blue-50 border border-blue-200 rounded-xl p-4">
                        <div class="flex items-start gap-3">
                            <div class="w-10 h-10 bg-blue-500 rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <h4 class="font-semibold text-slate-800 mb-1">Proses Tes dan Wawancara</h4>
                                <p class="text-sm text-slate-600 mb-3">Terima kasih telah melengkapi dokumen. Jadwal tes akan diinformasikan via WhatsApp.</p>
                                <div class="inline-flex items-center gap-2 text-sm text-slate-600 bg-white px-3 py-1.5 rounded-lg border border-slate-200">
                                    <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                    </svg>
                                    <?php echo e($siswa->no_wa ?: 'Belum diisi'); ?>

                                </div>
                            </div>
                        </div>
                    </div>
                    <?php else: ?>
                    <div class="bg-emerald-50 border border-emerald-200 rounded-xl p-4">
                        <div class="flex items-start gap-3">
                            <div class="w-10 h-10 bg-emerald-500 rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <h4 class="font-semibold text-slate-800 mb-1">Tes dan Wawancara Selesai</h4>
                                <p class="text-sm text-slate-600">
                                    <?php if($tes?->status_kelulusan === 'Lulus' || $tes?->status_kelulusan === null): ?>
                                        Selamat! Anda dinyatakan <strong class="text-emerald-700">LULUS</strong>.
                                    <?php else: ?>
                                        Anda dinyatakan <strong class="text-red-600">TIDAK LULUS</strong>.
                                    <?php endif; ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                <?php endif; ?>

            </div>

            <!-- Right Column -->
            <div class="space-y-6">
                
                <!-- Quick Menu -->
                <div class="bg-white rounded-xl border border-slate-200 overflow-hidden">
                    <div class="p-4 border-b border-slate-100">
                        <h3 class="font-semibold text-slate-800">Menu Cepat</h3>
                    </div>
                    <div class="p-2">
                        <a href="<?php echo e(route('spmb.lengkapi-data')); ?>" class="flex items-center gap-3 p-3 rounded-lg hover:bg-slate-50 transition-colors group">
                            <div class="w-10 h-10 bg-blue-100 text-blue-600 rounded-lg flex items-center justify-center group-hover:bg-blue-500 group-hover:text-white transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-slate-800">Lengkapi Data</p>
                                <p class="text-xs text-slate-500">Isi biodata lengkap</p>
                            </div>
                        </a>
                        
                        <a href="<?php echo e(route('spmb.berkas')); ?>" class="flex items-center gap-3 p-3 rounded-lg hover:bg-slate-50 transition-colors group">
                            <div class="w-10 h-10 bg-purple-100 text-purple-600 rounded-lg flex items-center justify-center group-hover:bg-purple-500 group-hover:text-white transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                                </svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-slate-800">Upload Berkas</p>
                                <p class="text-xs text-slate-500">KK, Akta, Ijazah</p>
                            </div>
                        </a>
                        
                        <?php
                            $pembayaranStatus = $completeness['pembayaran_status'] ?? null;
                            $pembayaranColor = match($pembayaranStatus) {
                                'verified' => 'emerald',
                                'rejected' => 'red',
                                'pending' => 'amber',
                                default => 'slate',
                            };
                            $pembayaranLabel = match($pembayaranStatus) {
                                'verified' => 'Pembayaran Terverifikasi',
                                'rejected' => 'Pembayaran Ditolak',
                                'pending' => 'Menunggu Verifikasi',
                                default => 'Belum Bayar',
                            };
                        ?>
                        <a href="<?php echo e(route('spmb.pembayaran')); ?>" class="flex items-center gap-3 p-3 rounded-lg hover:bg-slate-50 transition-colors group">
                            <div class="w-10 h-10 bg-<?php echo e($pembayaranColor); ?>-100 text-<?php echo e($pembayaranColor); ?>-600 rounded-lg flex items-center justify-center group-hover:bg-<?php echo e($pembayaranColor); ?>-500 group-hover:text-white transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a1 1 0 11-2 0 1 1 0 012 0z"/>
                                </svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-slate-800">Pembayaran</p>
                                <p class="text-xs text-<?php echo e($pembayaranColor); ?>-600"><?php echo e($pembayaranLabel); ?></p>
                            </div>
                        </a>
                        
                        <a href="<?php echo e(route('spmb.status')); ?>" class="flex items-center gap-3 p-3 rounded-lg hover:bg-slate-50 transition-colors group">
                            <div class="w-10 h-10 bg-emerald-100 text-emerald-600 rounded-lg flex items-center justify-center group-hover:bg-emerald-500 group-hover:text-white transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-slate-800">Status Pendaftaran</p>
                                <p class="text-xs text-slate-500">Cek pengumuman</p>
                            </div>
                        </a>
                        
                        <a href="<?php echo e(route('spmb.profil')); ?>" class="flex items-center gap-3 p-3 rounded-lg hover:bg-slate-50 transition-colors group">
                            <div class="w-10 h-10 bg-amber-100 text-amber-600 rounded-lg flex items-center justify-center group-hover:bg-amber-500 group-hover:text-white transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-slate-800">Profil Saya</p>
                                <p class="text-xs text-slate-500">Lihat detail profil</p>
                            </div>
                        </a>
                    </div>
                </div>

                <!-- Timeline -->
                <div class="bg-white rounded-xl border border-slate-200 overflow-hidden">
                    <div class="p-4 border-b border-slate-100">
                        <h3 class="font-semibold text-slate-800">Alur Pendaftaran</h3>
                    </div>
                    <div class="p-4">
                        <div class="relative">
                            <div class="absolute left-3.5 top-2 bottom-2 w-0.5 bg-slate-200"></div>
                            <div class="space-y-4">
                                <?php $__currentLoopData = $timeline; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="relative flex gap-3">
                                    <div class="w-7 h-7 rounded-full flex items-center justify-center flex-shrink-0 z-10 border-2
                                        <?php echo e($item['status'] === 'completed' ? 'bg-emerald-500 border-emerald-500 text-white' : ''); ?>

                                        <?php echo e($item['status'] === 'current' ? 'bg-blue-500 border-blue-500 text-white' : ''); ?>

                                        <?php echo e($item['status'] === 'upcoming' ? 'bg-white border-slate-300 text-slate-400' : ''); ?>">
                                        <?php if($item['status'] === 'completed'): ?>
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                                            </svg>
                                        <?php elseif($item['status'] === 'current'): ?>
                                            <span class="w-1.5 h-1.5 bg-white rounded-full"></span>
                                        <?php else: ?>
                                            <span class="text-xs"><?php echo e($index + 1); ?></span>
                                        <?php endif; ?>
                                    </div>
                                    <div class="flex-1 pt-0.5">
                                        <p class="text-sm font-medium <?php echo e($item['status'] === 'upcoming' ? 'text-slate-400' : 'text-slate-800'); ?>"><?php echo e($item['title']); ?></p>
                                        <p class="text-xs <?php echo e($item['status'] === 'upcoming' ? 'text-slate-400' : 'text-slate-500'); ?>"><?php echo e($item['description']); ?></p>
                                        <?php if($item['date']): ?>
                                            <p class="text-xs text-slate-400 mt-0.5"><?php echo e($item['date']); ?></p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Announcement -->
                <?php if($pengumuman): ?>
                <div class="bg-white rounded-xl border border-slate-200 overflow-hidden">
                    <div class="p-4 border-b border-slate-100 flex items-center justify-between">
                        <h3 class="font-semibold text-slate-800">Pengumuman</h3>
                        <span class="text-xs text-slate-400"><?php echo e($pengumuman->created_at->diffForHumans()); ?></span>
                    </div>
                    <div class="p-4">
                        <h4 class="font-medium text-slate-800 mb-2"><?php echo e($pengumuman->judul); ?></h4>
                        <div class="text-sm text-slate-600 leading-relaxed">
                            <?php echo nl2br(e(Str::limit($pengumuman->isi, 150))); ?>

                        </div>
                        <?php if(strlen($pengumuman->isi) > 150): ?>
                            <button onclick="this.previousElementSibling.innerHTML='<?php echo nl2br(e($pengumuman->isi)); ?>'; this.remove();" 
                                    class="mt-2 text-sm text-blue-600 hover:text-blue-700 font-medium">
                                Baca selengkapnya
                            </button>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endif; ?>

                <!-- Help Card -->
                <div class="bg-slate-800 rounded-xl p-4 text-white">
                    <div class="flex items-start gap-3">
                        <div class="w-10 h-10 bg-white/10 rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <h4 class="font-semibold mb-1">Butuh Bantuan?</h4>
                            <p class="text-sm text-slate-300 mb-3">Hubungi panitia SPMB jika ada kendala.</p>
                            <a href="https://wa.me/628812489572" target="_blank" 
                               class="inline-flex items-center gap-2 bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                                </svg>
                                Hubungi via WhatsApp
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\user\.gemini\antigravity\scratch\smkalstar\smkalstar\resources\views/spmb/dashboard.blade.php ENDPATH**/ ?>