<?php $__env->startSection('title', 'Detail Calon Siswa - Admin Panel'); ?>

<?php $__env->startSection('content'); ?>
    <div class="mb-6">
        <a href="<?php echo e(route('admin.pendaftar.index')); ?>" class="inline-flex items-center text-gray-500 hover:text-primary">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali ke Daftar
        </a>
    </div>

    <div class="mb-6 flex justify-between items-start">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Detail Calon Siswa</h1>
            <p class="text-gray-600"><?php echo e($siswa->nama); ?> - <?php echo e($siswa->nisn); ?></p>
        </div>
        <div class="flex gap-2">
            <a href="<?php echo e(route('admin.pendaftar.edit', $siswa->id)); ?>" class="px-4 py-2 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-100 font-medium transition">
                Edit Data
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <h3 class="font-bold text-gray-900 mb-4 border-b pb-2">Data Siswa</h3>
            <div class="space-y-3 text-sm">
                <div>
                    <span class="block text-gray-500">NISN</span>
                    <span class="font-medium text-gray-900 font-mono"><?php echo e($siswa->nisn); ?></span>
                </div>
                <div>
                    <span class="block text-gray-500">Nama Lengkap</span>
                    <span class="font-medium text-gray-900"><?php echo e($siswa->nama); ?></span>
                </div>
                <div>
                    <span class="block text-gray-500">Jenis Kelamin</span>
                    <span class="font-medium text-gray-900"><?php echo e($siswa->jk == 'L' ? 'Laki-laki' : ($siswa->jk == 'P' ? 'Perempuan' : '-')); ?></span>
                </div>
                <div>
                    <span class="block text-gray-500">Tanggal Lahir</span>
                    <span class="font-medium text-gray-900"><?php echo e($siswa->tgl_lahir?->format('d M Y') ?? '-'); ?></span>
                </div>
                <div>
                    <span class="block text-gray-500">No. WhatsApp</span>
                    <span class="font-medium text-gray-900"><?php echo e($siswa->no_wa ?? '-'); ?></span>
                </div>
                <div>
                    <span class="block text-gray-500">Asal Sekolah</span>
                    <span class="font-medium text-gray-900"><?php echo e($siswa->asal_sekolah ?? '-'); ?></span>
                </div>
                <div>
                    <span class="block text-gray-500">Alamat</span>
                    <span class="font-medium text-gray-900"><?php echo e($siswa->alamat ?? '-'); ?></span>
                </div>
            </div>
        </div>

        
        <div class="space-y-6">
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h3 class="font-bold text-gray-900 mb-4 border-b pb-2">Data Pendaftaran</h3>
                <div class="space-y-3 text-sm">
                    <?php if($siswa->pendaftaran): ?>
                    <div>
                        <span class="block text-gray-500">Jurusan Pilihan</span>
                        <span class="font-bold text-primary"><?php echo e($siswa->pendaftaran->jurusan->nama ?? '-'); ?></span>
                    </div>
                    <div>
                        <span class="block text-gray-500">Gelombang</span>
                        <span class="font-medium text-gray-900"><?php echo e($siswa->pendaftaran->gelombang ?? '-'); ?></span>
                    </div>
                    <div>
                        <span class="block text-gray-500">Tanggal Daftar</span>
                        <span class="font-medium text-gray-900"><?php echo e($siswa->pendaftaran->created_at->format('d M Y H:i')); ?></span>
                    </div>
                    <div>
                        <span class="block text-gray-500">Status</span>
                        <span class="inline-flex px-2 py-1 bg-green-100 text-green-700 rounded text-xs font-bold"><?php echo e($siswa->pendaftaran->status_pendaftaran); ?></span>
                    </div>
                    <?php else: ?>
                    <p class="text-gray-500 italic">Belum melengkapi data pendaftaran.</p>
                    <?php endif; ?>
                </div>
            </div>

            <?php if($siswa->orangTua): ?>
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h3 class="font-bold text-gray-900 mb-4 border-b pb-2">Data Orang Tua</h3>
                <div class="space-y-3 text-sm">
                    <div>
                        <span class="block text-gray-500">Nama Ayah</span>
                        <span class="font-medium text-gray-900"><?php echo e($siswa->orangTua->nama_ayah ?? '-'); ?></span>
                    </div>
                    <div>
                        <span class="block text-gray-500">Nama Ibu</span>
                        <span class="font-medium text-gray-900"><?php echo e($siswa->orangTua->nama_ibu ?? '-'); ?></span>
                    </div>
                    <div>
                        <span class="block text-gray-500">Pekerjaan</span>
                        <span class="font-medium text-gray-900"><?php echo e($siswa->orangTua->pekerjaan ?? '-'); ?></span>
                    </div>
                    <div>
                        <span class="block text-gray-500">No. WA Orang Tua</span>
                        <span class="font-medium text-gray-900"><?php echo e($siswa->orangTua->no_wa_ortu ?? '-'); ?></span>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>

        
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <h3 class="font-bold text-gray-900 mb-4 border-b pb-2">Berkas yang Diupload</h3>
            
            <?php if($siswa->berkasPendaftaran->count() > 0): ?>
            <div class="space-y-4">
                <?php $__currentLoopData = $siswa->berkasPendaftaran; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $berkas): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="p-4 rounded-lg border bg-gray-50 border-gray-200">
                    <div class="flex items-start justify-between">
                        <div>
                            <h4 class="font-bold text-sm text-gray-800"><?php echo e($berkas->nama_jenis); ?></h4>
                            <p class="text-xs text-gray-500 mt-1"><?php echo e($berkas->nama_file); ?></p>
                            <p class="text-xs text-gray-400 mt-1">Upload: <?php echo e($berkas->created_at->format('d M Y H:i')); ?></p>
                            <div class="mt-2">
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-green-100 text-green-800">Berhasil Upload</span>
                            </div>
                        </div>
                        <a href="<?php echo e(route('admin.berkas.download', $berkas->id)); ?>" target="_blank" class="flex items-center text-blue-600 hover:text-blue-800 text-sm font-medium">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                            Unduh
                        </a>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <?php else: ?>
            <div class="text-center py-8 text-gray-500">
                <svg class="w-12 h-12 mx-auto text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                <p>Belum ada berkas yang diupload.</p>
            </div>
            <?php endif; ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\user\.gemini\antigravity\scratch\smkalstar\smkalstar\resources\views/admin/pendaftar-show.blade.php ENDPATH**/ ?>