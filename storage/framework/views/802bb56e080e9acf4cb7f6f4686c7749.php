<?php $__env->startSection('title', 'Pembayaran - SPMB ALSTAR'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-4xl mx-auto">
    
    <?php
        use App\Models\Pembayaran;
        
        $statusColors = [
            Pembayaran::STATUS_PENDING => 'bg-yellow-50 text-yellow-700 border-yellow-200',
            Pembayaran::STATUS_VERIFIED => 'bg-green-50 text-green-700 border-green-200',
            Pembayaran::STATUS_REJECTED => 'bg-red-50 text-red-700 border-red-200',
        ];
        $statusLabels = [
            Pembayaran::STATUS_PENDING => 'Menunggu Verifikasi Admin',
            Pembayaran::STATUS_VERIFIED => 'Pembayaran Diterima',
            Pembayaran::STATUS_REJECTED => 'Pembayaran Ditolak',
        ];
        $currentStatus = $pembayaran?->status ?? null;
    ?>

    <div class="bg-white rounded-xl shadow-sm border border-slate-100 overflow-hidden mb-6">
        <div class="p-6 <?php echo e($currentStatus ? $statusColors[$currentStatus] : 'bg-gray-50 text-gray-700 border-gray-200'); ?>">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-lg font-bold">Status Pembayaran</h2>
                    <p class="text-2xl font-bold mt-1"><?php echo e($currentStatus ? $statusLabels[$currentStatus] : 'Belum Bayar'); ?></p>
                </div>
                <div class="w-16 h-16 rounded-full bg-white/30 flex items-center justify-center">
                    <?php if(!$currentStatus): ?>
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                    <?php elseif($currentStatus == Pembayaran::STATUS_PENDING): ?>
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <?php elseif($currentStatus == Pembayaran::STATUS_VERIFIED): ?>
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <?php else: ?>
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        
        <?php if($currentStatus == Pembayaran::STATUS_VERIFIED): ?>
        <div class="p-6 bg-green-50 border-t border-green-100">
            <div class="flex items-start">
                <svg class="w-5 h-5 text-green-600 mt-0.5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <div>
                    <h4 class="font-semibold text-green-800">Pembayaran Anda Telah Diterima!</h4>
                    <p class="text-sm text-green-700 mt-1">Selamat, pembayaran pendaftaran Anda telah diverifikasi oleh admin. Anda dapat melanjutkan ke tahap selanjutnya.</p>
                    <a href="<?php echo e(route('spmb.status')); ?>" class="mt-3 inline-flex items-center px-4 py-2 bg-green-600 text-white text-sm font-medium rounded-lg hover:bg-green-700">
                        Lihat Status Pendaftaran
                    </a>
                </div>
            </div>
        </div>
        <?php endif; ?>

        
        <?php if($currentStatus == Pembayaran::STATUS_REJECTED): ?>
        <div class="p-6 bg-red-50 border-t border-red-100">
            <div class="flex items-start">
                <svg class="w-5 h-5 text-red-600 mt-0.5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <div>
                    <h4 class="font-semibold text-red-800">Pembayaran Anda Ditolak</h4>
                    <p class="text-sm text-red-700 mt-1">Maaf, pembayaran Anda ditolak oleh admin.</p>
                    <?php if($pembayaran->catatan_admin): ?>
                    <div class="mt-2 p-3 bg-red-100 rounded">
                        <span class="text-xs font-semibold text-red-800">Alasan Penolakan:</span>
                        <p class="text-sm text-red-700 mt-1"><?php echo e($pembayaran->catatan_admin); ?></p>
                    </div>
                    <?php endif; ?>
                    <p class="text-sm text-red-700 mt-3">Silakan upload ulang bukti pembayaran yang valid di bawah.</p>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>

    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        
        <div class="bg-white rounded-xl shadow-sm border border-slate-100 p-6">
            <h3 class="font-bold text-slate-800 mb-4">Informasi Pembayaran</h3>
            
            <div class="space-y-4">
                <div class="p-4 bg-blue-50 rounded-lg border border-blue-100">
                    <p class="text-sm text-blue-600 font-medium">Total Biaya Pendaftaran</p>
                    <p class="text-2xl font-bold text-blue-800">Rp <?php echo e(number_format($biayaPendaftaran, 0, ',', '.')); ?></p>
                </div>

                <div>
                    <p class="text-sm font-medium text-slate-700 mb-2">Transfer ke:</p>
                    <div class="space-y-2">
                        <?php $__currentLoopData = config('spmb.rekening_tujuan', []); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rekening): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="p-3 border border-slate-200 rounded-lg">
                            <div class="flex items-start gap-3">
                                <div class="w-10 h-10 bg-slate-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <span class="text-xs font-bold text-slate-600"><?php echo e(substr($rekening['nama_bank'], 0, 2)); ?></span>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="font-medium text-slate-800"><?php echo e($rekening['nama_bank']); ?></p>
                                    <div class="flex items-center gap-2 mt-1">
                                        <p class="text-sm text-slate-600 font-mono bg-slate-50 px-2 py-1 rounded select-all"><?php echo e($rekening['no_rekening']); ?></p>
                                        <button onclick="copyRekening('<?php echo e($rekening['no_rekening']); ?>', this)" 
                                                class="inline-flex items-center gap-1 text-xs bg-blue-100 text-blue-700 px-2 py-1 rounded hover:bg-blue-200 transition-colors"
                                                title="Salin nomor rekening">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                                            </svg>
                                            <span class="copy-text">Salin</span>
                                        </button>
                                    </div>
                                    <p class="text-xs text-slate-500 mt-1">a.n. <?php echo e($rekening['atas_nama']); ?></p>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
        </div>

        
        <?php if($currentStatus != Pembayaran::STATUS_VERIFIED): ?>
        <div class="bg-white rounded-xl shadow-sm border border-slate-100 p-6">
            <h3 class="font-bold text-slate-800 mb-4">Upload Bukti Pembayaran</h3>

            <?php if($pembayaran && $pembayaran->bukti_pembayaran): ?>
            <div class="mb-4">
                <p class="text-sm text-slate-600 mb-2">Bukti pembayaran sebelumnya:</p>
                <div class="relative">
                    <img src="<?php echo e(route('spmb.pembayaran.preview', $pembayaran->id)); ?>" alt="Bukti Pembayaran" class="w-full h-48 object-cover rounded-lg border">
                    <div class="absolute top-2 right-2">
                        <span class="px-2 py-1 bg-yellow-100 text-yellow-700 text-xs font-medium rounded">
                            <?php echo e($statusLabels[$pembayaran->status]); ?>

                        </span>
                    </div>
                </div>
                <p class="text-sm text-slate-500 mt-2">Upload ulang untuk mengganti bukti pembayaran.</p>
            </div>
            <?php endif; ?>

            <form action="<?php echo e(route('spmb.pembayaran.store')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                
                <div class="mb-4">
                    <label class="block text-sm font-medium text-slate-700 mb-1">Bukti Pembayaran</label>
                    <input type="file" name="bukti_pembayaran" accept="image/jpeg,image/png,image/jpg" 
                        class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-[#4276A3] focus:border-[#4276A3] <?php $__errorArgs = ['bukti_pembayaran'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                        <?php echo e(!$pembayaran || $pembayaran->status == Pembayaran::STATUS_REJECTED ? 'required' : ''); ?>>
                    <p class="text-xs text-slate-500 mt-1">Format: JPG, PNG (Maksimal 2MB)</p>
                    <?php $__errorArgs = ['bukti_pembayaran'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-slate-700 mb-1">Catatan (opsional)</label>
                    <textarea name="catatan" rows="2" class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-[#4276A3] focus:border-[#4276A3]" placeholder="Contoh: Transfer dari Bank BCA"><?php echo e(old('catatan', $pembayaran?->catatan_admin)); ?></textarea>
                </div>

                <button type="submit" class="w-full px-4 py-2 bg-[#4276A3] text-white font-medium rounded-lg hover:bg-[#3a6a94] focus:outline-none focus:ring-2 focus:ring-[#4276A3] focus:ring-offset-2">
                    <?php echo e($pembayaran ? 'Upload Ulang Bukti Pembayaran' : 'Upload Bukti Pembayaran'); ?>

                </button>
            </form>
        </div>
        <?php else: ?>
        <div class="bg-white rounded-xl shadow-sm border border-slate-100 p-6">
            <h3 class="font-bold text-slate-800 mb-4">Detail Pembayaran</h3>
            
            <div class="space-y-3">
                <div>
                    <span class="text-sm text-slate-500">Jumlah Pembayaran</span>
                    <p class="font-medium text-slate-800">Rp <?php echo e(number_format($pembayaran->jumlah, 0, ',', '.')); ?></p>
                </div>
                <div>
                    <span class="text-sm text-slate-500">Tanggal Upload</span>
                    <p class="font-medium text-slate-800"><?php echo e($pembayaran->created_at?->format('d M Y H:i')); ?></p>
                </div>
                <?php if($pembayaran->verified_at): ?>
                <div>
                    <span class="text-sm text-slate-500">Tanggal Verifikasi</span>
                    <p class="font-medium text-slate-800"><?php echo e($pembayaran->verified_at?->format('d M Y H:i')); ?></p>
                </div>
                <?php endif; ?>
                <div>
                    <span class="text-sm text-slate-500 block mb-2">Bukti Pembayaran</span>
                    <a href="<?php echo e(route('spmb.pembayaran.preview', $pembayaran->id)); ?>" target="_blank" class="inline-flex items-center text-[#4276A3] hover:underline">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                        Lihat Bukti Pembayaran
                    </a>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>

    
    <div class="bg-white rounded-xl shadow-sm border border-slate-100 p-6">
        <h3 class="font-bold text-slate-800 mb-4">Panduan Pembayaran</h3>
        <ol class="space-y-2 text-sm text-slate-600 list-decimal list-inside">
            <li>Transfer biaya pendaftaran sebesar <strong>Rp <?php echo e(number_format($biayaPendaftaran, 0, ',', '.')); ?></strong> ke salah satu rekening di atas.</li>
            <li>Simpan bukti transfer (screenshot atau foto struk).</li>
            <li>Upload bukti pembayaran melalui form di atas.</li>
            <li>Tunggu verifikasi dari admin (maksimal 1x24 jam).</li>
            <li>Setelah terverifikasi, Anda akan mendapatkan notifikasi dan dapat melanjutkan ke tahap selanjutnya.</li>
        </ol>
    </div>
</div>

<?php $__env->startPush('scripts'); ?>
<script>
function copyRekening(noRekening, btn) {
    navigator.clipboard.writeText(noRekening).then(function() {
        // Ubah teks button menjadi "Tersalin"
        const copyText = btn.querySelector('.copy-text');
        const originalText = copyText.textContent;
        copyText.textContent = 'Tersalin!';
        btn.classList.remove('bg-blue-100', 'text-blue-700');
        btn.classList.add('bg-green-100', 'text-green-700');
        
        // Kembalikan ke teks semula setelah 2 detik
        setTimeout(function() {
            copyText.textContent = originalText;
            btn.classList.remove('bg-green-100', 'text-green-700');
            btn.classList.add('bg-blue-100', 'text-blue-700');
        }, 2000);
    }).catch(function(err) {
        console.error('Gagal menyalin:', err);
        alert('Gagal menyalin nomor rekening. Silakan salin manual.');
    });
}
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\user\.gemini\antigravity\scratch\smkalstar\smkalstar\resources\views/spmb/pembayaran.blade.php ENDPATH**/ ?>