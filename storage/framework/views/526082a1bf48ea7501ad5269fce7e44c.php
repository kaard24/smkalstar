

<?php
use App\Models\Pembayaran;
?>

<?php $__env->startSection('title', 'Detail Pembayaran - Admin Panel'); ?>

<?php $__env->startSection('content'); ?>
    
    <div class="mb-6">
        <a href="<?php echo e(route('admin.pembayaran.index')); ?>" class="inline-flex items-center text-slate-500 hover:text-[#4276A3]">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Kembali ke Daftar
        </a>
    </div>

    <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">Detail Pembayaran</h1>
            <p class="text-slate-600">Verifikasi pembayaran dari <?php echo e($pembayaran->calonSiswa->nama); ?></p>
        </div>
    </div>

    <?php
        $statusColors = [
            Pembayaran::STATUS_PENDING => 'bg-yellow-100 text-yellow-700',
            Pembayaran::STATUS_VERIFIED => 'bg-green-100 text-green-700',
            Pembayaran::STATUS_REJECTED => 'bg-red-100 text-red-700',
        ];
        $statusLabels = [
            Pembayaran::STATUS_PENDING => 'Menunggu Verifikasi',
            Pembayaran::STATUS_VERIFIED => 'Diterima',
            Pembayaran::STATUS_REJECTED => 'Ditolak',
        ];
    ?>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <div class="bg-white rounded-xl shadow-sm border border-slate-100 p-6">
            <h3 class="font-bold text-slate-800 mb-4 border-b pb-2">Data Siswa</h3>
            <div class="space-y-3 text-sm">
                <div>
                    <span class="block text-slate-500">Nama Lengkap</span>
                    <span class="font-medium text-slate-800"><?php echo e($pembayaran->calonSiswa->nama); ?></span>
                </div>
                <div>
                    <span class="block text-slate-500">NISN</span>
                    <span class="font-medium text-slate-800 font-mono"><?php echo e($pembayaran->calonSiswa->nisn); ?></span>
                </div>
                <div>
                    <span class="block text-slate-500">Jurusan</span>
                    <span class="font-medium text-slate-800"><?php echo e($pembayaran->calonSiswa->pendaftaran->jurusan->nama ?? '-'); ?></span>
                </div>
                <div>
                    <span class="block text-slate-500">Gelombang</span>
                    <span class="font-medium text-slate-800"><?php echo e($pembayaran->calonSiswa->pendaftaran->gelombang ?? '-'); ?></span>
                </div>
                <div>
                    <a href="<?php echo e(route('admin.pendaftar.show', $pembayaran->calonSiswa->id)); ?>" class="inline-flex items-center text-[#4276A3] hover:underline text-sm">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                        </svg>
                        Lihat Detail Siswa
                    </a>
                </div>
            </div>
        </div>

        
        <div class="bg-white rounded-xl shadow-sm border border-slate-100 p-6">
            <h3 class="font-bold text-slate-800 mb-4 border-b pb-2">Detail Pembayaran</h3>
            <div class="space-y-3 text-sm">
                <div>
                    <span class="block text-slate-500">Status</span>
                    <span class="inline-flex px-2 py-1 text-xs font-medium rounded <?php echo e($statusColors[$pembayaran->status]); ?>">
                        <?php echo e($statusLabels[$pembayaran->status]); ?>

                    </span>
                </div>
                <div>
                    <span class="block text-slate-500">Jumlah Bayar</span>
                    <span class="font-medium text-slate-800"><?php echo e($pembayaran->jumlah_formatted); ?></span>
                </div>
                <div>
                    <span class="block text-slate-500">Tanggal Upload</span>
                    <span class="font-medium text-slate-800"><?php echo e($pembayaran->created_at?->format('d M Y H:i') ?? '-'); ?></span>
                </div>
                <?php if($pembayaran->verified_at): ?>
                <div>
                    <span class="block text-slate-500">Tanggal Verifikasi</span>
                    <span class="font-medium text-slate-800"><?php echo e($pembayaran->verified_at?->format('d M Y H:i')); ?></span>
                </div>
                <?php endif; ?>
                <?php if($pembayaran->catatan_admin): ?>
                <div>
                    <span class="block text-slate-500">Catatan Admin</span>
                    <p class="font-medium text-slate-800"><?php echo e($pembayaran->catatan_admin); ?></p>
                </div>
                <?php endif; ?>
            </div>
        </div>

        
        <div class="bg-white rounded-xl shadow-sm border border-slate-100 p-6">
            <h3 class="font-bold text-slate-800 mb-4 border-b pb-2">Verifikasi</h3>

            <?php if($pembayaran->status == Pembayaran::STATUS_PENDING): ?>
            <div class="space-y-4">
                <p class="text-sm text-slate-600">Silakan verifikasi pembayaran ini:</p>
                
                <form action="<?php echo e(route('admin.pembayaran.verify', $pembayaran->id)); ?>" method="POST" class="space-y-3">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PATCH'); ?>
                    
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Catatan (opsional)</label>
                        <textarea name="catatan_admin" rows="3" class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-[#4276A3] focus:border-[#4276A3]" placeholder="Tambahkan catatan jika diperlukan..."></textarea>
                    </div>

                    <div class="flex gap-3">
                        <button type="submit" name="status" value="<?php echo e(Pembayaran::STATUS_VERIFIED); ?>" class="flex-1 px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 flex items-center justify-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            Terima
                        </button>
                        <button type="submit" name="status" value="<?php echo e(Pembayaran::STATUS_REJECTED); ?>" class="flex-1 px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 flex items-center justify-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                            Tolak
                        </button>
                    </div>
                </form>
            </div>
            <?php elseif($pembayaran->status == Pembayaran::STATUS_VERIFIED): ?>
            <div class="p-4 bg-green-50 rounded-lg border border-green-100">
                <div class="flex items-center gap-2 text-green-700">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span class="font-medium">Pembayaran telah diterima</span>
                </div>
                <p class="text-sm text-green-600 mt-2">Pembayaran ini telah diverifikasi dan diterima.</p>
            </div>
            <?php elseif($pembayaran->status == Pembayaran::STATUS_REJECTED): ?>
            <div class="p-4 bg-red-50 rounded-lg border border-red-100">
                <div class="flex items-center gap-2 text-red-700">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span class="font-medium">Pembayaran ditolak</span>
                </div>
                <p class="text-sm text-red-600 mt-2">Pembayaran ini telah ditolak.</p>
                <?php if($pembayaran->catatan_admin): ?>
                <div class="mt-3 p-3 bg-red-100 rounded">
                    <span class="text-xs font-semibold text-red-800">Alasan:</span>
                    <p class="text-sm text-red-700 mt-1"><?php echo e($pembayaran->catatan_admin); ?></p>
                </div>
                <?php endif; ?>
            </div>
            <?php endif; ?>
        </div>
    </div>

    
    <?php if($pembayaran->bukti_pembayaran): ?>
    <div class="mt-6 bg-white rounded-xl shadow-sm border border-slate-100 p-6">
        <h3 class="font-bold text-slate-800 mb-4 border-b pb-2">Bukti Pembayaran</h3>
        <div class="max-w-lg">
            <img src="<?php echo e(route('admin.pembayaran.preview', $pembayaran->id)); ?>" alt="Bukti Pembayaran" class="w-full rounded-lg border">
        </div>
        <div class="mt-4 flex gap-3">
            <a href="<?php echo e(route('admin.pembayaran.preview', $pembayaran->id)); ?>" target="_blank" class="inline-flex items-center px-4 py-2 border border-slate-300 text-slate-700 rounded-lg hover:bg-slate-50">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                </svg>
                Lihat di Tab Baru
            </a>
            <a href="<?php echo e(route('admin.pembayaran.download', $pembayaran->id)); ?>" class="inline-flex items-center px-4 py-2 bg-[#4276A3] text-white rounded-lg hover:bg-[#3a6a94]">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                </svg>
                Download
            </a>
        </div>
    </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\eka\.gemini\antigravity\scratch\smk-alstar\resources\views/admin/pembayaran-show.blade.php ENDPATH**/ ?>