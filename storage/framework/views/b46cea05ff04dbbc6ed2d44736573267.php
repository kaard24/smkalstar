<?php $__env->startSection('title', 'Berita - Admin Panel'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-6xl mx-auto">
    <div class="mb-8 flex flex-wrap items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Berita</h1>
            <p class="text-gray-600">Kelola berita dan informasi sekolah.</p>
        </div>
        <a href="<?php echo e(route('admin.berita.create')); ?>" class="px-4 py-2 bg-primary text-white rounded-xl font-semibold hover:bg-secondary transition shadow-lg shadow-primary/25 flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
            Tambah Berita
        </a>
    </div>

    <?php if(session('success')): ?>
    <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-700 rounded-xl flex items-center gap-2">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
        <?php echo e(session('success')); ?>

    </div>
    <?php endif; ?>

    <?php if($berita->isEmpty()): ?>
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-12 text-center">
        <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
        <h3 class="text-lg font-semibold text-gray-700 mb-2">Belum Ada Berita</h3>
        <p class="text-gray-500 mb-4">Mulai dengan menambahkan berita pertama.</p>
        <a href="<?php echo e(route('admin.berita.create')); ?>" class="inline-block px-6 py-2 bg-primary text-white rounded-xl font-semibold hover:bg-secondary transition">
            Tambah Berita Pertama
        </a>
    </div>
    <?php else: ?>
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-100">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">Berita</th>
                        <th class="px-6 py-4 text-center text-xs font-semibold text-gray-600 uppercase">Komentar</th>
                        <th class="px-6 py-4 text-center text-xs font-semibold text-gray-600 uppercase">Tanggal</th>
                        <th class="px-6 py-4 text-center text-xs font-semibold text-gray-600 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    <?php $__currentLoopData = $berita; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-4">
                                <?php if($item->gambar_utama): ?>
                                <img src="<?php echo e($item->gambar_utama); ?>" alt="<?php echo e($item->judul); ?>" class="w-16 h-16 object-cover rounded-lg">
                                <?php else: ?>
                                <div class="w-16 h-16 bg-gray-100 rounded-lg flex items-center justify-center">
                                    <svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                </div>
                                <?php endif; ?>
                                <div>
                                    <h4 class="font-semibold text-gray-900"><?php echo e(Str::limit($item->judul, 50)); ?></h4>
                                    <p class="text-sm text-gray-500"><?php echo e(Str::limit(strip_tags($item->isi), 80)); ?></p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <a href="<?php echo e(route('admin.berita.komentar', $item->id)); ?>" class="inline-flex items-center gap-1 text-sm text-primary hover:text-secondary">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                                <?php echo e($item->komentar_count); ?>

                            </a>
                        </td>
                        <td class="px-6 py-4 text-center text-sm text-gray-600">
                            <?php echo e($item->published_at ? $item->published_at->format('d M Y') : '-'); ?>

                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center gap-2">
                                <a href="<?php echo e(route('berita.show', $item->slug)); ?>" target="_blank" class="p-2 text-gray-600 hover:bg-gray-100 rounded-lg transition" title="Lihat">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                </a>
                                <a href="<?php echo e(route('admin.berita.edit', $item->id)); ?>" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition" title="Edit">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                </a>
                                <form action="<?php echo e(route('admin.berita.destroy', $item->id)); ?>" method="POST" class="inline" onsubmit="return confirm('Hapus berita ini?')">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition" title="Hapus">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php endif; ?>

    <div class="mt-6 flex justify-end">
        <a href="<?php echo e(url('/berita')); ?>" target="_blank" class="px-6 py-3 border border-gray-300 text-gray-700 rounded-xl font-semibold hover:bg-gray-50 transition">
            Lihat Halaman Berita
        </a>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\user\.gemini\antigravity\scratch\smkalstar\smkalstar\resources\views/admin/berita/index.blade.php ENDPATH**/ ?>