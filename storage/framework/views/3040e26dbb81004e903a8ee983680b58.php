<?php $__env->startSection('title', 'Kelola Ekstrakurikuler - Admin Panel'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-6xl mx-auto">
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">Kelola Ekstrakurikuler</h1>
            <p class="text-slate-600">Kelola data ekstrakurikuler sekolah</p>
        </div>
        <a href="<?php echo e(route('admin.ekstrakurikuler.create')); ?>" class="btn btn-primary shadow-md hover:shadow-lg">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
            Tambah Ekstrakurikuler
        </a>
    </div>

    <?php if(session('success')): ?>
    <div class="mb-6 p-4 bg-slate-50 border border-slate-200 text-emerald-700 rounded-xl flex items-center gap-2">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
        <?php echo e(session('success')); ?>

    </div>
    <?php endif; ?>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        <?php $__empty_1 = true; $__currentLoopData = $ekstrakurikuler; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="bg-white rounded-xl shadow-sm border border-slate-100 overflow-hidden group">
            <div class="relative h-48">
                <?php if($item->gambar_url): ?>
                <img src="<?php echo e($item->gambar_url); ?>" alt="<?php echo e($item->nama); ?>" class="w-full h-full object-cover" loading="lazy" decoding="async">
                <?php else: ?>
                <div class="w-full h-full bg-slate-100 flex items-center justify-center">
                    <svg class="w-12 h-12 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                </div>
                <?php endif; ?>
                <div class="absolute top-2 right-2">
                    <?php if($item->aktif): ?>
                    <span class="px-2 py-1 bg-[#4276A3] text-white rounded-full text-xs font-bold">Aktif</span>
                    <?php else: ?>
                    <span class="px-2 py-1 bg-slate-500 text-white rounded-full text-xs font-bold">Nonaktif</span>
                    <?php endif; ?>
                </div>
            </div>
            <div class="p-4">
                <div class="flex justify-between items-start mb-2">
                    <h3 class="font-bold text-slate-800"><?php echo e($item->nama); ?></h3>
                    <span class="text-xs text-slate-400">Urutan: <?php echo e($item->urutan); ?></span>
                </div>
                <?php if($item->deskripsi): ?>
                <p class="text-sm text-slate-500 mb-3 line-clamp-2"><?php echo e($item->deskripsi); ?></p>
                <?php endif; ?>
                <div class="flex gap-2 mt-3">
                    <a href="<?php echo e(route('admin.ekstrakurikuler.edit', $item)); ?>" class="btn btn-sm btn-warning flex-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                        Edit
                    </a>
                    <form action="<?php echo e(route('admin.ekstrakurikuler.destroy', $item)); ?>" method="POST" class="flex-1" onsubmit="return confirm('Hapus ekstrakurikuler ini?')">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="btn btn-sm btn-danger w-full">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <div class="col-span-full py-12 text-center text-slate-500">
            <svg class="w-12 h-12 mx-auto mb-3 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
            <p>Belum ada data ekstrakurikuler</p>
        </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\user\.gemini\antigravity\scratch\smkalstar\smkalstar\resources\views/admin/ekstrakurikuler/index.blade.php ENDPATH**/ ?>