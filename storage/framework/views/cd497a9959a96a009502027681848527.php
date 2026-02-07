<?php $__env->startSection('title', 'Dashboard SPMB - SMK Al-Hidayah Lestari'); ?>

<?php $__env->startSection('content'); ?>
<div class="min-h-screen bg-gray-50">
    <!-- Header - Compact for mobile -->
    <div class="bg-gradient-to-r from-primary to-green-600 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 md:py-6">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-2">
                <div>
                    <h1 class="text-xl md:text-2xl font-bold">Dashboard SPMB</h1>
                    <p class="text-sm text-green-100">Selamat datang, <?php echo e($siswa->nama ?: 'Calon Siswa'); ?>!</p>
                </div>
                <div class="flex items-center gap-2 md:gap-4">
                    <span class="bg-white/20 px-3 py-1.5 rounded-lg text-xs md:text-sm">
                        NISN: <?php echo e($siswa->nisn); ?>

                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 md:py-6">
        
        <?php if(session('error')): ?>
        <div class="mb-4 p-3 bg-red-50 border border-red-200 text-red-700 rounded-lg text-sm">
            <?php echo e(session('error')); ?>

        </div>
        <?php endif; ?>

        <?php if(session('success')): ?>
        <div class="mb-4 p-3 bg-green-50 border border-green-200 text-green-700 rounded-lg text-sm">
            <?php echo e(session('success')); ?>

        </div>
        <?php endif; ?>

        <!-- Progress Bar Mobile-Optimized -->
        <div class="mb-4 md:mb-6 bg-white rounded-xl p-4 shadow-sm border border-gray-100">
            <div class="flex items-center justify-between mb-2">
                <span class="text-sm font-medium text-gray-700">Progress Pendaftaran</span>
                <span class="text-sm font-bold text-primary"><?php echo e($completeness['percentage']); ?>%</span>
            </div>
            <div class="w-full bg-gray-200 rounded-full h-2.5">
                <div class="bg-primary h-2.5 rounded-full transition-all duration-500" style="width: <?php echo e($completeness['percentage']); ?>%"></div>
            </div>
            <?php if($completeness['percentage'] < 100): ?>
            <p class="text-xs text-gray-500 mt-2">Lengkapi semua data untuk melanjutkan</p>
            <?php else: ?>
            <p class="text-xs text-green-600 mt-2 font-medium flex items-center gap-1">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                Semua data lengkap! Tunggu jadwal tes via WhatsApp
                            </p>
            <?php endif; ?>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 md:gap-6">
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-4 md:space-y-6">
                
                <!-- Status Cards - 2 columns on mobile -->
                <div class="grid grid-cols-2 gap-3 md:gap-4">
                    <!-- Biodata -->
                    <div class="bg-white rounded-xl p-3 md:p-4 shadow-sm border border-gray-100">
                        <div class="flex items-center gap-2 md:gap-3">
                            <div class="w-8 h-8 md:w-10 md:h-10 rounded-lg <?php echo e($completeness['biodata'] ? 'bg-green-100' : 'bg-gray-100'); ?> flex items-center justify-center flex-shrink-0">
                                <svg class="w-4 h-4 md:w-5 md:h-5 <?php echo e($completeness['biodata'] ? 'text-green-600' : 'text-gray-400'); ?>" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                            <div class="min-w-0">
                                <p class="text-xs text-gray-500">Biodata</p>
                                <p class="font-semibold text-xs md:text-sm <?php echo e($completeness['biodata'] ? 'text-green-600' : 'text-gray-900'); ?> truncate">
                                    <?php echo e($completeness['biodata'] ? 'Lengkap' : 'Belum'); ?>

                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Orang Tua -->
                    <div class="bg-white rounded-xl p-3 md:p-4 shadow-sm border border-gray-100">
                        <div class="flex items-center gap-2 md:gap-3">
                            <div class="w-8 h-8 md:w-10 md:h-10 rounded-lg <?php echo e($completeness['orang_tua'] ? 'bg-green-100' : 'bg-gray-100'); ?> flex items-center justify-center flex-shrink-0">
                                <svg class="w-4 h-4 md:w-5 md:h-5 <?php echo e($completeness['orang_tua'] ? 'text-green-600' : 'text-gray-400'); ?>" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                            <div class="min-w-0">
                                <p class="text-xs text-gray-500">Orang Tua</p>
                                <p class="font-semibold text-xs md:text-sm <?php echo e($completeness['orang_tua'] ? 'text-green-600' : 'text-gray-900'); ?> truncate">
                                    <?php echo e($completeness['orang_tua'] ? 'Lengkap' : 'Belum'); ?>

                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Jurusan -->
                    <div class="bg-white rounded-xl p-3 md:p-4 shadow-sm border border-gray-100">
                        <div class="flex items-center gap-2 md:gap-3">
                            <div class="w-8 h-8 md:w-10 md:h-10 rounded-lg <?php echo e($completeness['jurusan'] ? 'bg-green-100' : 'bg-gray-100'); ?> flex items-center justify-center flex-shrink-0">
                                <svg class="w-4 h-4 md:w-5 md:h-5 <?php echo e($completeness['jurusan'] ? 'text-green-600' : 'text-gray-400'); ?>" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                                </svg>
                            </div>
                            <div class="min-w-0">
                                <p class="text-xs text-gray-500">Jurusan</p>
                                <p class="font-semibold text-xs md:text-sm <?php echo e($completeness['jurusan'] ? 'text-green-600' : 'text-gray-900'); ?> truncate">
                                    <?php echo e($completeness['jurusan'] ? 'Terpilih' : 'Belum'); ?>

                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Berkas -->
                    <div class="bg-white rounded-xl p-3 md:p-4 shadow-sm border border-gray-100">
                        <div class="flex items-center gap-2 md:gap-3">
                            <div class="w-8 h-8 md:w-10 md:h-10 rounded-lg <?php echo e($completeness['berkas'] ? 'bg-green-100' : 'bg-yellow-100'); ?> flex items-center justify-center flex-shrink-0">
                                <svg class="w-4 h-4 md:w-5 md:h-5 <?php echo e($completeness['berkas'] ? 'text-green-600' : 'text-yellow-600'); ?>" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                            <div class="min-w-0">
                                <p class="text-xs text-gray-500">Berkas</p>
                                <p class="font-semibold text-xs md:text-sm <?php echo e($completeness['berkas'] ? 'text-green-600' : 'text-yellow-600'); ?> truncate">
                                    <?php echo e($berkasProgress['uploaded']); ?>/<?php echo e($berkasProgress['total']); ?>

                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Biodata Card -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="px-4 md:px-6 py-3 md:py-4 border-b border-gray-100 flex items-center justify-between">
                        <h2 class="font-semibold text-sm md:text-base text-gray-900">Biodata Siswa</h2>
                        <a href="<?php echo e(route('ppdb.lengkapi-data')); ?>" class="text-xs md:text-sm text-primary hover:underline">Edit</a>
                    </div>
                    <div class="p-4 md:p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3 md:gap-4">
                            <div>
                                <p class="text-xs text-gray-500">Nama Lengkap</p>
                                <p class="font-medium text-sm text-gray-900"><?php echo e($siswa->nama ?: '-'); ?></p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500">NISN</p>
                                <p class="font-medium text-sm text-gray-900"><?php echo e($siswa->nisn); ?></p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500">Jenis Kelamin</p>
                                <p class="font-medium text-sm text-gray-900"><?php echo e($siswa->jk === 'L' ? 'Laki-laki' : ($siswa->jk === 'P' ? 'Perempuan' : '-')); ?></p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500">Tanggal Lahir</p>
                                <p class="font-medium text-sm text-gray-900"><?php echo e($siswa->tgl_lahir ? $siswa->tgl_lahir->format('d F Y') : '-'); ?></p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500">No. WhatsApp</p>
                                <p class="font-medium text-sm text-gray-900"><?php echo e($siswa->no_wa ?: '-'); ?></p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500">Asal Sekolah</p>
                                <p class="font-medium text-sm text-gray-900"><?php echo e($siswa->asal_sekolah ?: '-'); ?></p>
                            </div>
                            <div class="md:col-span-2">
                                <p class="text-xs text-gray-500">Alamat</p>
                                <p class="font-medium text-sm text-gray-900"><?php echo e($siswa->alamat ?: '-'); ?></p>
                            </div>
                            <?php if($pendaftaran?->jurusan): ?>
                            <div class="md:col-span-2 pt-2 border-t border-gray-100">
                                <p class="text-xs text-gray-500">Jurusan Pilihan</p>
                                <p class="font-medium text-sm text-primary"><?php echo e($pendaftaran->jurusan->nama); ?></p>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <!-- Upload Progress Detail -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="px-4 md:px-6 py-3 md:py-4 border-b border-gray-100">
                        <h2 class="font-semibold text-sm md:text-base text-gray-900">Progress Upload Berkas</h2>
                    </div>
                    <div class="p-4 md:p-6">
                        <div class="space-y-3">
                            <?php $__currentLoopData = $berkasProgress['detail']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="flex items-start justify-between p-3 rounded-lg <?php echo e($item['uploaded'] ? 'bg-green-50 border border-green-100' : 'bg-gray-50 border border-gray-100'); ?>">
                                <div class="flex items-start gap-3">
                                    <div class="w-8 h-8 rounded-full <?php echo e($item['uploaded'] ? 'bg-green-500' : 'bg-gray-300'); ?> flex items-center justify-center flex-shrink-0 mt-0.5">
                                        <?php if($item['uploaded']): ?>
                                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        <?php else: ?>
                                        <span class="text-xs text-white font-bold"><?php echo e($loop->iteration); ?></span>
                                        <?php endif; ?>
                                    </div>
                                    <div>
                                        <span class="text-sm font-medium <?php echo e($item['uploaded'] ? 'text-green-800' : 'text-gray-600'); ?>"><?php echo e($item['label']); ?></span>
                                        <?php if(isset($item['keterangan']) && $item['keterangan']): ?>
                                        <p class="text-xs text-gray-500 mt-0.5"><?php echo e($item['keterangan']); ?></p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <?php if($item['uploaded']): ?>
                                <span class="text-xs font-medium text-green-600 flex items-center gap-1"><svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> Uploaded</span>
                                <?php else: ?>
                                <span class="text-xs text-gray-400">Belum</span>
                                <?php endif; ?>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <?php if(!$completeness['berkas']): ?>
                        <a href="<?php echo e(route('ppdb.berkas')); ?>" class="mt-4 block w-full text-center bg-primary text-white py-2.5 rounded-lg text-sm font-medium hover:bg-green-700 transition">
                            Upload Berkas Sekarang
                        </a>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Info Tes -->
                <?php if($completeness['berkas']): ?>
                <div class="bg-blue-50 border border-blue-200 rounded-xl p-4 md:p-6">
                    <div class="flex items-start gap-3">
                        <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-semibold text-blue-900 text-sm md:text-base">Menunggu Jadwal Tes</h3>
                            <p class="text-xs md:text-sm text-blue-700 mt-1">
                                Terima kasih telah melengkapi semua dokumen. Jadwal tes dan wawancara akan diinformasikan melalui WhatsApp Anda.
                            </p>
                            <p class="text-xs text-blue-600 mt-2">
                                Pastikan nomor WhatsApp Anda aktif: <strong><?php echo e($siswa->no_wa ?: 'Belum diisi'); ?></strong>
                            </p>
                        </div>
                    </div>
                </div>
                <?php endif; ?>

                <!-- Pengumuman -->
                <?php if($pengumuman): ?>
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="px-4 md:px-6 py-3 md:py-4 border-b border-gray-100">
                        <h2 class="font-semibold text-sm md:text-base text-gray-900">Pengumuman Terbaru</h2>
                    </div>
                    <div class="p-4 md:p-6">
                        <h3 class="font-semibold text-sm md:text-base text-gray-900"><?php echo e($pengumuman->judul); ?></h3>
                        <p class="text-xs text-gray-500 mt-1"><?php echo e($pengumuman->created_at->format('d M Y')); ?></p>
                        <div class="mt-3 text-gray-700 text-sm">
                            <?php echo nl2br(e($pengumuman->isi)); ?>

                        </div>
                    </div>
                </div>
                <?php endif; ?>
            </div>

            <!-- Sidebar -->
            <div class="space-y-4 md:space-y-6">
                <!-- Progress Timeline -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="px-4 md:px-6 py-3 md:py-4 border-b border-gray-100">
                        <h2 class="font-semibold text-sm md:text-base text-gray-900">Timeline</h2>
                    </div>
                    <div class="p-4 md:p-6">
                        <div class="space-y-4">
                            <?php $__currentLoopData = $timeline; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="flex gap-3">
                                <div class="flex flex-col items-center">
                                    <div class="w-7 h-7 md:w-8 md:h-8 rounded-full flex items-center justify-center flex-shrink-0
                                        <?php if($item['status'] === 'completed'): ?> bg-green-100 text-green-600
                                        <?php elseif($item['status'] === 'current'): ?> bg-primary text-white
                                        <?php else: ?> bg-gray-100 text-gray-400
                                        <?php endif; ?>">
                                        <?php if($item['status'] === 'completed'): ?>
                                        <svg class="w-3.5 h-3.5 md:w-4 md:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        <?php else: ?>
                                        <span class="text-xs font-bold"><?php echo e($index + 1); ?></span>
                                        <?php endif; ?>
                                    </div>
                                    <?php if($index < count($timeline) - 1): ?>
                                    <div class="w-0.5 h-full bg-gray-200 my-1"></div>
                                    <?php endif; ?>
                                </div>
                                <div class="pb-4">
                                    <p class="font-medium text-xs md:text-sm text-gray-900"><?php echo e($item['title']); ?></p>
                                    <p class="text-xs text-gray-500"><?php echo e($item['description']); ?></p>
                                    <?php if($item['date']): ?>
                                    <p class="text-xs text-gray-400 mt-0.5"><?php echo e($item['date']); ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="px-4 md:px-6 py-3 md:py-4 border-b border-gray-100">
                        <h2 class="font-semibold text-sm md:text-base text-gray-900">Menu Cepat</h2>
                    </div>
                    <div class="p-3 md:p-4 space-y-1">
                        <a href="<?php echo e(route('ppdb.lengkapi-data')); ?>" class="flex items-center gap-3 p-2.5 rounded-lg hover:bg-gray-50 transition">
                            <div class="w-8 h-8 rounded-lg bg-blue-100 flex items-center justify-center flex-shrink-0">
                                <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                            </div>
                            <div class="min-w-0">
                                <p class="font-medium text-xs md:text-sm text-gray-900">Lengkapi Data</p>
                                <p class="text-xs text-gray-500 truncate">Isi biodata lengkap</p>
                            </div>
                        </a>
                        <a href="<?php echo e(route('ppdb.berkas')); ?>" class="flex items-center gap-3 p-2.5 rounded-lg hover:bg-gray-50 transition">
                            <div class="w-8 h-8 rounded-lg bg-purple-100 flex items-center justify-center flex-shrink-0">
                                <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
                                </svg>
                            </div>
                            <div class="min-w-0">
                                <p class="font-medium text-xs md:text-sm text-gray-900">Upload Berkas</p>
                                <p class="text-xs text-gray-500 truncate">KK, Akta, Ijazah</p>
                            </div>
                        </a>
                    </div>
                </div>

                <!-- Contact Support -->
                <div class="bg-gradient-to-br from-primary to-green-600 rounded-xl p-4 md:p-5 text-white">
                    <h3 class="font-semibold text-sm md:text-base mb-1">Butuh Bantuan?</h3>
                    <p class="text-xs text-green-100 mb-3">Hubungi panitia SPMB jika ada kendala.</p>
                    <a href="https://wa.me/6281234567890" target="_blank" class="inline-flex items-center gap-2 bg-white text-green-700 px-3 py-2 rounded-lg text-xs font-semibold hover:bg-green-100 transition" style="color: #15803d !important;">
                        <svg class="w-3.5 h-3.5" fill="#15803d" viewBox="0 0 24 24">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                        </svg>
                        <span style="color: #15803d !important;">Hubungi via WA</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\user\.gemini\antigravity\scratch\smkalstar\smkalstar\resources\views/ppdb/dashboard.blade.php ENDPATH**/ ?>