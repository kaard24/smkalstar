

<?php
use App\Models\Pembayaran;
?>

<?php $__env->startSection('title', 'Manajemen Pembayaran - Admin Panel'); ?>

<?php $__env->startSection('content'); ?>
    
    <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">Manajemen Pembayaran</h1>
            <p class="text-slate-600 mt-1">Kelola dan verifikasi pembayaran pendaftaran siswa.</p>
        </div>
    </div>

    
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
        <div class="bg-white rounded-xl shadow-sm border border-slate-100 p-4">
            <p class="text-sm text-slate-500">Total Pembayaran</p>
            <p class="text-2xl font-bold text-slate-800"><?php echo e($pembayaran->total()); ?></p>
        </div>
        <div class="bg-yellow-50 rounded-xl shadow-sm border border-yellow-100 p-4">
            <p class="text-sm text-yellow-600">Menunggu Verifikasi</p>
            <p class="text-2xl font-bold text-yellow-700">
                <?php echo e(Pembayaran::where('status', Pembayaran::STATUS_PENDING)->count()); ?>

            </p>
        </div>
        <div class="bg-green-50 rounded-xl shadow-sm border border-green-100 p-4">
            <p class="text-sm text-green-600">Diterima</p>
            <p class="text-2xl font-bold text-green-700">
                <?php echo e(Pembayaran::where('status', Pembayaran::STATUS_VERIFIED)->count()); ?>

            </p>
        </div>
        <div class="bg-red-50 rounded-xl shadow-sm border border-red-100 p-4">
            <p class="text-sm text-red-600">Ditolak</p>
            <p class="text-2xl font-bold text-red-700">
                <?php echo e(Pembayaran::where('status', Pembayaran::STATUS_REJECTED)->count()); ?>

            </p>
        </div>
    </div>

    
    <div class="bg-white rounded-xl shadow-sm border border-slate-100 p-4 mb-6">
        <form action="<?php echo e(route('admin.pembayaran.index')); ?>" method="GET" class="flex flex-wrap items-end gap-3">
            <div class="flex-1 min-w-[200px]">
                <label class="block text-sm font-medium text-slate-700 mb-1">Cari</label>
                <input type="text" name="search" value="<?php echo e(request('search')); ?>" placeholder="Nama atau NISN..." 
                    class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-[#4276A3] focus:border-[#4276A3]">
            </div>
            <div class="w-40">
                <label class="block text-sm font-medium text-slate-700 mb-1">Status</label>
                <select name="status" class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-[#4276A3] focus:border-[#4276A3]">
                    <option value="">Semua Status</option>
                    <option value="<?php echo e(Pembayaran::STATUS_PENDING); ?>" <?php echo e(request('status') == Pembayaran::STATUS_PENDING ? 'selected' : ''); ?>>Menunggu Verifikasi</option>
                    <option value="<?php echo e(Pembayaran::STATUS_VERIFIED); ?>" <?php echo e(request('status') == Pembayaran::STATUS_VERIFIED ? 'selected' : ''); ?>>Diterima</option>
                    <option value="<?php echo e(Pembayaran::STATUS_REJECTED); ?>" <?php echo e(request('status') == Pembayaran::STATUS_REJECTED ? 'selected' : ''); ?>>Ditolak</option>
                </select>
            </div>
            <div class="flex gap-2">
                <button type="submit" class="px-4 py-2 bg-[#4276A3] text-white rounded-lg hover:bg-[#3a6a94]">
                    Filter
                </button>
                <a href="<?php echo e(route('admin.pembayaran.index')); ?>" class="px-4 py-2 border border-slate-300 text-slate-600 rounded-lg hover:bg-slate-50">
                    Reset
                </a>
            </div>
        </form>
    </div>

    
    <div class="bg-white rounded-xl shadow-sm border border-slate-100 overflow-hidden">
        <?php if($pembayaran->count() > 0): ?>
        <div class="p-4 border-b border-slate-100 bg-slate-50 flex items-center gap-3" id="bulk-actions" style="display: none;">
            <span class="text-sm text-slate-600"><span id="selected-count">0</span> dipilih</span>
            <button type="button" onclick="bulkVerify('<?php echo e(Pembayaran::STATUS_VERIFIED); ?>')" class="px-3 py-1.5 bg-green-600 text-white text-sm rounded hover:bg-green-700">
                Terima
            </button>
            <button type="button" onclick="bulkVerify('<?php echo e(Pembayaran::STATUS_REJECTED); ?>')" class="px-3 py-1.5 bg-red-600 text-white text-sm rounded hover:bg-red-700">
                Tolak
            </button>
        </div>
        <?php endif; ?>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-100">
                        <th class="px-4 py-3 w-10">
                            <input type="checkbox" id="select-all" class="rounded border-slate-300 text-[#4276A3] focus:ring-[#4276A3]">
                        </th>
                        <th class="px-4 py-3 text-sm font-semibold text-slate-700">Siswa</th>
                        <th class="px-4 py-3 text-sm font-semibold text-slate-700">Jurusan</th>
                        <th class="px-4 py-3 text-sm font-semibold text-slate-700">Jumlah</th>
                        <th class="px-4 py-3 text-sm font-semibold text-slate-700">Tanggal Upload</th>
                        <th class="px-4 py-3 text-sm font-semibold text-slate-700">Status</th>
                        <th class="px-4 py-3 text-sm font-semibold text-slate-700 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    <?php $__empty_1 = true; $__currentLoopData = $pembayaran; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
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
                    <tr class="hover:bg-slate-50">
                        <td class="px-4 py-3">
                            <input type="checkbox" name="ids[]" value="<?php echo e($item->id); ?>" class="row-checkbox rounded border-slate-300 text-[#4276A3] focus:ring-[#4276A3]">
                        </td>
                        <td class="px-4 py-3">
                            <p class="font-medium text-slate-800"><?php echo e($item->calonSiswa->nama); ?></p>
                            <p class="text-xs text-slate-500 font-mono"><?php echo e($item->calonSiswa->nisn); ?></p>
                        </td>
                        <td class="px-4 py-3">
                            <span class="text-sm text-slate-600"><?php echo e($item->calonSiswa->pendaftaran->jurusan->nama ?? '-'); ?></span>
                        </td>
                        <td class="px-4 py-3">
                            <span class="text-sm text-slate-600"><?php echo e($item->jumlah_formatted); ?></span>
                        </td>
                        <td class="px-4 py-3">
                            <span class="text-sm text-slate-600"><?php echo e($item->created_at?->format('d M Y') ?? '-'); ?></span>
                        </td>
                        <td class="px-4 py-3">
                            <span class="inline-flex px-2 py-1 text-xs font-medium rounded <?php echo e($statusColors[$item->status]); ?>">
                                <?php echo e($statusLabels[$item->status]); ?>

                            </span>
                        </td>
                        <td class="px-4 py-3 text-center">
                            <div class="flex items-center justify-center gap-2">
                                <a href="<?php echo e(route('admin.pembayaran.show', $item->id)); ?>" class="p-1.5 text-blue-600 hover:bg-blue-50 rounded" title="Detail">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                </a>
                                <?php if($item->bukti_pembayaran): ?>
                                <a href="<?php echo e(route('admin.pembayaran.preview', $item->id)); ?>" target="_blank" class="p-1.5 text-green-600 hover:bg-green-50 rounded" title="Lihat Bukti">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </a>
                                <a href="<?php echo e(route('admin.pembayaran.download', $item->id)); ?>" class="p-1.5 text-slate-600 hover:bg-slate-100 rounded" title="Download">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                                    </svg>
                                </a>
                                <?php endif; ?>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="7" class="px-4 py-8 text-center text-slate-500">
                            <svg class="w-12 h-12 mx-auto text-slate-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            <p>Tidak ada data pembayaran</p>
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <?php if($pembayaran->hasPages()): ?>
        <div class="p-4 border-t border-slate-100">
            <?php echo e($pembayaran->links()); ?>

        </div>
        <?php endif; ?>
    </div>

    <?php $__env->startPush('scripts'); ?>
    <script>
        // Select all checkbox
        document.getElementById('select-all')?.addEventListener('change', function() {
            const checkboxes = document.querySelectorAll('.row-checkbox');
            checkboxes.forEach(cb => cb.checked = this.checked);
            updateBulkActions();
        });

        // Individual checkbox
        document.querySelectorAll('.row-checkbox').forEach(cb => {
            cb.addEventListener('change', updateBulkActions);
        });

        function updateBulkActions() {
            const checked = document.querySelectorAll('.row-checkbox:checked');
            const bulkActions = document.getElementById('bulk-actions');
            const countEl = document.getElementById('selected-count');
            
            if (checked.length > 0) {
                bulkActions.style.display = 'flex';
                countEl.textContent = checked.length;
            } else {
                bulkActions.style.display = 'none';
            }
        }

        function bulkVerify(status) {
            const checked = document.querySelectorAll('.row-checkbox:checked');
            if (checked.length === 0) return;

            const ids = Array.from(checked).map(cb => cb.value);
            const action = status === '<?php echo e(Pembayaran::STATUS_VERIFIED); ?>' ? 'menerima' : 'menolak';
            
            if (!confirm(`Yakin ingin ${action} ${ids.length} pembayaran terpilih?`)) return;

            fetch('<?php echo e(route('admin.pembayaran.bulk-verify')); ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
                },
                body: JSON.stringify({ ids, status })
            })
            .then(r => r.json())
            .then(data => {
                if (data.success) {
                    alert(data.message);
                    location.reload();
                } else {
                    alert('Terjadi kesalahan');
                }
            })
            .catch(() => alert('Terjadi kesalahan'));
        }
    </script>
    <?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\eka\.gemini\antigravity\scratch\smk-alstar\resources\views/admin/pembayaran.blade.php ENDPATH**/ ?>