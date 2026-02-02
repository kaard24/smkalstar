

<?php $__env->startSection('title', 'Edit Foto Galeri - Admin Panel'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-2xl mx-auto">
    <div class="mb-8">
        <a href="<?php echo e(route('admin.galeri.index')); ?>" class="text-[#4276A3] hover:text-[#334155] inline-flex items-center gap-1 mb-4">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali ke Galeri
        </a>
        <h1 class="text-2xl font-bold text-slate-800">Edit Foto Galeri</h1>
        <p class="text-slate-600">Perbarui informasi foto galeri.</p>
    </div>

    <?php if($errors->any()): ?>
    <div class="mb-6 p-4 bg-[#991B1B]/10 border border-[#991B1B]/20 text-[#991B1B] rounded-xl">
        <ul class="list-disc pl-5 space-y-1">
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
    <?php endif; ?>

    <form action="<?php echo e(route('admin.galeri.update', $galeri->id)); ?>" method="POST" enctype="multipart/form-data" class="space-y-6">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-200 bg-slate-50">
                <h2 class="font-semibold text-gray-900">Detail Foto</h2>
            </div>
            <div class="p-6 space-y-4">
                
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Foto Saat Ini</label>
                    <div class="w-48 h-48 rounded-xl overflow-hidden bg-slate-100">
                        <img src="<?php echo e($galeri->gambar_url); ?>" alt="<?php echo e($galeri->keterangan ?? 'Galeri'); ?>" class="w-full h-full object-cover" loading="lazy" decoding="async">
                    </div>
                </div>

                <div>
                    <label for="gambar" class="block text-sm font-medium text-gray-700 mb-1">Ganti Foto</label>
                    <input type="file" id="gambar" name="gambar" accept="image/*"
                        class="w-full px-4 py-3 border border-slate-300 rounded-xl focus:ring-2 focus:ring-[#4276A3] focus:border-[#4276A3] transition file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-[#4276A3]/10 file:text-[#4276A3] hover:file:bg-[#4276A3]/20">
                    <p class="mt-1 text-xs text-gray-500">Kosongkan jika tidak ingin mengganti foto. Format: JPG, PNG, WebP. Maks. 2MB.</p>
                </div>

                <div>
                    <label for="keterangan" class="block text-sm font-medium text-gray-700 mb-1">Keterangan</label>
                    <input type="text" id="keterangan" name="keterangan" value="<?php echo e(old('keterangan', $galeri->keterangan)); ?>"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition"
                        placeholder="Keterangan singkat tentang foto ini">
                </div>

                <div>
                    <label for="urutan" class="block text-sm font-medium text-gray-700 mb-1">Urutan</label>
                    <input type="number" id="urutan" name="urutan" value="<?php echo e(old('urutan', $galeri->urutan)); ?>" min="0"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition"
                        placeholder="0">
                </div>
            </div>
        </div>

        <div class="flex gap-4 justify-end">
            <a href="<?php echo e(route('admin.galeri.index')); ?>" class="btn btn-secondary btn-lg">
                Batal
            </a>
            <button type="submit" class="btn btn-primary btn-lg shadow-sm hover:shadow-md">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\eka\.gemini\antigravity\scratch\smk-alstar\resources\views/admin/galeri/edit.blade.php ENDPATH**/ ?>