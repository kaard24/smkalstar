<?php $__env->startSection('title', 'Profil Saya - SMK Al-Hidayah Lestari'); ?>

<?php $__env->startSection('content'); ?>
<div class="min-h-screen bg-gray-50 py-12">
    <div class="container mx-auto px-4 max-w-4xl">
        <!-- Header -->
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Profil Pendaftaran</h1>
                <p class="text-gray-600">Kelola data pendaftaran SPMB Anda</p>
            </div>
            <div class="flex items-center gap-4">
                <div class="text-right">
                    <p class="font-medium text-gray-900"><?php echo e($calonSiswa->nama); ?></p>
                    <p class="text-sm text-gray-500"><?php echo e($calonSiswa->nisn); ?></p>
                </div>
                <div class="flex items-center justify-center w-12 h-12 bg-primary rounded-full text-white font-bold text-xl">
                    <?php echo e(substr($calonSiswa->nama, 0, 1)); ?>

                </div>
            </div>
        </div>

        <?php if(session('success')): ?>
        <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-700 rounded-lg">
            <?php echo e(session('success')); ?>

        </div>
        <?php endif; ?>

        <div class="grid md:grid-cols-3 gap-6">
            <!-- Status Card -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h3 class="font-bold text-gray-900 mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    Status Pendaftaran
                </h3>
                <?php if($calonSiswa->pendaftaran): ?>
                    <?php
                        $status = $calonSiswa->pendaftaran->status_pendaftaran;
                        $statusColor = match($status) {
                            'Terdaftar' => 'yellow',
                            'Diverifikasi' => 'blue',
                            'Menunggu Tes' => 'purple',
                            'Selesai Tes' => 'green',
                            default => 'gray'
                        };
                    ?>
                    <span class="inline-flex px-3 py-1 bg-<?php echo e($statusColor); ?>-100 text-<?php echo e($statusColor); ?>-700 rounded-full text-sm font-bold">
                        <?php echo e($status); ?>

                    </span>
                    
                    <?php if($calonSiswa->pendaftaran->tes && $calonSiswa->pendaftaran->tes->status_kelulusan != 'Pending'): ?>
                    <div class="mt-4 p-3 rounded-lg <?php echo e($calonSiswa->pendaftaran->tes->status_kelulusan == 'Lulus' ? 'bg-green-50 border border-green-200' : 'bg-red-50 border border-red-200'); ?>">
                        <p class="font-bold <?php echo e($calonSiswa->pendaftaran->tes->status_kelulusan == 'Lulus' ? 'text-green-700' : 'text-red-700'); ?>">
                            <?php echo e($calonSiswa->pendaftaran->tes->status_kelulusan == 'Lulus' ? 'LULUS' : 'TIDAK LULUS'); ?>

                        </p>
                    </div>
                    <?php endif; ?>
                <?php else: ?>
                    <span class="text-gray-500">Belum mendaftar</span>
                <?php endif; ?>

                <div class="mt-4 pt-4 border-t border-gray-100">
                    <p class="text-sm text-gray-600">Jurusan Pilihan:</p>
                    <p class="font-bold text-primary"><?php echo e($calonSiswa->pendaftaran->jurusan->nama ?? '-'); ?></p>
                </div>
            </div>

            <!-- Biodata Card -->
            <div class="md:col-span-2 bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="font-bold text-gray-900 flex items-center gap-2">
                        <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        Data Diri
                    </h3>
                    <a href="<?php echo e(route('ppdb.profil.edit')); ?>" class="text-primary hover:text-green-700 text-sm font-medium flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                        Edit
                    </a>
                </div>
                
                <div class="grid md:grid-cols-2 gap-4 text-sm">
                    <div>
                        <span class="text-gray-500">NISN</span>
                        <p class="font-medium text-gray-900"><?php echo e($calonSiswa->nisn); ?></p>
                    </div>
                    <div>
                        <span class="text-gray-500">Nama Lengkap</span>
                        <p class="font-medium text-gray-900"><?php echo e($calonSiswa->nama); ?></p>
                    </div>
                    <div>
                        <span class="text-gray-500">Jenis Kelamin</span>
                        <p class="font-medium text-gray-900"><?php echo e($calonSiswa->jk == 'L' ? 'Laki-laki' : 'Perempuan'); ?></p>
                    </div>
                    <div>
                        <span class="text-gray-500">Tanggal Lahir</span>
                        <p class="font-medium text-gray-900"><?php echo e(\Carbon\Carbon::parse($calonSiswa->tgl_lahir)->format('d M Y')); ?></p>
                    </div>
                    <div>
                        <span class="text-gray-500">No. WhatsApp</span>
                        <p class="font-medium text-gray-900"><?php echo e($calonSiswa->no_wa); ?></p>
                    </div>
                    <div>
                        <span class="text-gray-500">Asal Sekolah</span>
                        <p class="font-medium text-gray-900"><?php echo e($calonSiswa->asal_sekolah); ?></p>
                    </div>
                    <div class="md:col-span-2">
                        <span class="text-gray-500">Alamat</span>
                        <p class="font-medium text-gray-900"><?php echo e($calonSiswa->alamat); ?></p>
                    </div>
                </div>
            </div>

            <!-- Orang Tua Card -->
            <div class="md:col-span-3 bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h3 class="font-bold text-gray-900 mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    Data Orang Tua
                </h3>
                
                <?php if($calonSiswa->orangTua): ?>
                <div class="grid md:grid-cols-4 gap-4 text-sm">
                    <div>
                        <span class="text-gray-500">Nama Ayah</span>
                        <p class="font-medium text-gray-900"><?php echo e($calonSiswa->orangTua->nama_ayah); ?></p>
                    </div>
                    <div>
                        <span class="text-gray-500">Nama Ibu</span>
                        <p class="font-medium text-gray-900"><?php echo e($calonSiswa->orangTua->nama_ibu); ?></p>
                    </div>
                    <div>
                        <span class="text-gray-500">No. WA Orang Tua</span>
                        <p class="font-medium text-gray-900"><?php echo e($calonSiswa->orangTua->no_wa_ortu); ?></p>
                    </div>
                    <div>
                        <span class="text-gray-500">Pekerjaan</span>
                        <p class="font-medium text-gray-900"><?php echo e($calonSiswa->orangTua->pekerjaan); ?></p>
                    </div>
                </div>
                <?php else: ?>
                <p class="text-gray-500">Data orang tua belum dilengkapi.</p>
                <?php endif; ?>
            </div>
        </div>

        <!-- Actions -->
        <div class="mt-6 flex justify-between items-center">
            <a href="<?php echo e(url('/')); ?>" class="text-gray-500 hover:text-gray-700 text-sm flex items-center gap-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                Kembali ke Website
            </a>
            <form action="<?php echo e(route('logout')); ?>" method="POST" class="inline">
                <?php echo csrf_field(); ?>
                <button type="submit" class="text-red-600 hover:text-red-800 text-sm font-medium border border-red-200 px-4 py-2 rounded-lg hover:bg-red-50 transition">
                    Logout
                </button>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\user\.gemini\antigravity\scratch\smkalstar\smkalstar\resources\views/ppdb/profil.blade.php ENDPATH**/ ?>