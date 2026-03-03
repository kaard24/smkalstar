<?php $__env->startSection('title', 'Tambah Berita - Admin Panel'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-3xl mx-auto">
    
    <?php if($errors->any()): ?>
    <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-700 rounded-lg">
        <div class="flex items-start gap-3">
            <svg class="w-5 h-5 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <div>
                <p class="font-medium">Terdapat kesalahan:</p>
                <ul class="mt-1 list-disc list-inside text-sm">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <form action="<?php echo e(route('admin.berita.store')); ?>" method="POST" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>

        
        <div class="mb-6">
            <label for="judul" class="block text-sm font-semibold text-slate-700 mb-2">
                Judul Berita <span class="text-red-500">*</span>
            </label>
            <input type="text" id="judul" name="judul" value="<?php echo e(old('judul')); ?>" required
                   placeholder="Masukkan judul berita"
                   class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:ring-2 focus:ring-[#4276A3] focus:border-[#4276A3] transition-colors"
                   autofocus>
        </div>

        
        <div class="mb-6">
            <label for="isi" class="block text-sm font-semibold text-slate-700 mb-2">
                Isi Berita <span class="text-red-500">*</span>
            </label>
            <textarea id="isi" name="isi" rows="12" required
                      class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:ring-2 focus:ring-[#4276A3] focus:border-[#4276A3] transition-colors resize-y"
                      placeholder="Tulis isi berita di sini..."><?php echo e(old('isi')); ?></textarea>
            <p class="text-xs text-slate-500 mt-1.5">Gunakan enter untuk membuat paragraf baru.</p>
        </div>

        
        <div class="mb-6">
            <label for="gambar" class="block text-sm font-semibold text-slate-700 mb-2">
                Gambar <span class="text-slate-400 font-normal">(Opsional)</span>
            </label>
            <div class="border border-slate-300 border-dashed rounded-lg p-4 bg-slate-50 hover:bg-slate-100 transition-colors">
                <input type="file" id="gambar" name="gambar[]" accept="image/*" multiple
                       class="block w-full text-sm text-slate-600 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-medium file:bg-[#4276A3] file:text-white hover:file:bg-[#365f85] file:transition-colors cursor-pointer">
            </div>
            <p class="text-xs text-slate-500 mt-1.5">Format: JPG, PNG, WebP. Maksimal 2MB per file.</p>
        </div>

        
        <div class="mb-8">
            <label for="published_at" class="block text-sm font-semibold text-slate-700 mb-2">
                Tanggal Publish <span class="text-slate-400 font-normal">(Opsional)</span>
            </label>
            <input type="datetime-local" id="published_at" name="published_at" 
                   value="<?php echo e(old('published_at', now()->format('Y-m-d\TH:i'))); ?>"
                   class="w-full sm:w-auto px-4 py-2.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-[#4276A3] focus:border-[#4276A3] transition-colors">
            <p class="text-xs text-slate-500 mt-1.5">Kosongkan untuk mempublikasikan sekarang.</p>
        </div>

        
        <div class="flex items-center justify-end gap-3 pt-4 border-t border-slate-200">
            <a href="<?php echo e(route('admin.berita.index')); ?>" 
               class="px-5 py-2.5 text-sm font-medium text-slate-600 bg-white border border-slate-300 rounded-lg hover:bg-slate-50 transition-colors">
                Batal
            </a>
            <button type="submit" 
                    class="px-5 py-2.5 text-sm font-medium text-white bg-[#4276A3] rounded-lg hover:bg-[#365f85] transition-colors flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                Simpan
            </button>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\eka\.gemini\antigravity\scratch\smk-alstar\resources\views\admin\berita\create.blade.php ENDPATH**/ ?>