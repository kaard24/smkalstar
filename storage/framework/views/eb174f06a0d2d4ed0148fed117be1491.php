<?php $__env->startSection('title', 'Komentar Berita - Admin Panel'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-4xl mx-auto">
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-900">Komentar Berita</h1>
        <p class="text-gray-600"><?php echo e($berita->judul); ?></p>
    </div>

    <?php if(session('success')): ?>
    <div class="mb-6 p-4 bg-blue-50 border border-blue-200 text-blue-700 rounded-xl flex items-center gap-2">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
        <?php echo e(session('success')); ?>

    </div>
    <?php endif; ?>

    <?php if($berita->komentar->isEmpty()): ?>
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-12 text-center">
        <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
        <h3 class="text-lg font-semibold text-gray-700 mb-2">Belum Ada Komentar</h3>
        <p class="text-gray-500">Berita ini belum memiliki komentar.</p>
    </div>
    <?php else: ?>
    <div class="space-y-4">
        <?php $__currentLoopData = $berita->komentar; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $komentar): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <div class="flex items-start justify-between gap-4">
                <div class="flex-1">
                    <div class="flex items-center gap-2 mb-2">
                        <div class="w-10 h-10 bg-primary/10 rounded-full flex items-center justify-center">
                            <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-900"><?php echo e($komentar->display_name); ?></h4>
                            <p class="text-xs text-gray-500"><?php echo e($komentar->created_at->format('d M Y, H:i')); ?></p>
                        </div>
                        <?php if(!$komentar->show_username): ?>
                        <span class="text-xs bg-gray-100 text-gray-600 px-2 py-1 rounded">Username: <?php echo e($komentar->username); ?></span>
                        <?php endif; ?>
                    </div>
                    <p class="text-gray-600"><?php echo e($komentar->komentar); ?></p>
                </div>
                <form action="<?php echo e(route('admin.berita.komentar.destroy', $komentar->id)); ?>" method="POST" onsubmit="return confirm('Hapus komentar ini?')">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button type="submit" class="btn-icon btn-icon-delete btn-icon-sm" title="Hapus Komentar">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                    </button>
                </form>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\eka\.gemini\antigravity\scratch\smk-alstar\resources\views\admin\berita\komentar.blade.php ENDPATH**/ ?>