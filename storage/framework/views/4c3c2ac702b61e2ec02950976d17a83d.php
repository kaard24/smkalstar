<?php $__env->startSection('title', isset($fasilitas) ? 'Edit Fasilitas' : 'Tambah Fasilitas' . ' - Admin Panel'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-2xl mx-auto">
    <div class="mb-8">
        <a href="<?php echo e(route('admin.fasilitas.index')); ?>" class="inline-flex items-center text-sm text-slate-500 hover:text-[#4276A3] mb-4">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Kembali
        </a>
        <h1 class="text-2xl font-bold text-slate-800"><?php echo e(isset($fasilitas) ? 'Edit Fasilitas' : 'Tambah Fasilitas Baru'); ?></h1>
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

    <form action="<?php echo e(isset($fasilitas) ? route('admin.fasilitas.update', $fasilitas) : route('admin.fasilitas.store')); ?>" 
          method="POST" enctype="multipart/form-data" class="space-y-6">
        <?php echo csrf_field(); ?>
        <?php if(isset($fasilitas)): ?>
            <?php echo method_field('PUT'); ?>
        <?php endif; ?>

        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-200 bg-slate-50">
                <h2 class="font-semibold text-slate-800">Informasi Fasilitas</h2>
            </div>
            <div class="p-6 space-y-6">
                <div>
                    <label for="nama" class="block text-sm font-medium text-slate-700 mb-2">Nama Fasilitas <span class="text-[#991B1B]">*</span></label>
                    <input type="text" id="nama" name="nama" value="<?php echo e(old('nama', $fasilitas->nama ?? '')); ?>" required
                        class="w-full px-4 py-3 border border-slate-300 rounded-xl focus:ring-2 focus:ring-[#4276A3] focus:border-[#4276A3] transition"
                        placeholder="Lab Komputer TKJ">
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Galeri Gambar Fasilitas</label>
                    <?php if(isset($fasilitas) && !empty($fasilitas->gambar_urls)): ?>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4 mb-4">
                        <?php $__currentLoopData = $fasilitas->gambar_urls; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="relative group" id="gambar-<?php echo e($index); ?>">
                            <img src="<?php echo e($url); ?>" alt="<?php echo e($fasilitas->nama); ?> <?php echo e($index + 1); ?>" class="w-full h-32 object-cover rounded-lg border" loading="lazy" decoding="async">
                            <label class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center cursor-pointer rounded-lg">
                                <input type="checkbox" name="hapus_gambar[]" value="<?php echo e($index); ?>" class="peer sr-only" onchange="toggleDeleteMark(<?php echo e($index); ?>)">
                                <div class="text-white text-sm bg-[#991B1B] px-3 py-1 rounded shadow peer-checked:bg-[#7F1D1D]">
                                    <span id="label-text-<?php echo e($index); ?>">Hapus</span>
                                </div>
                            </label>
                            <div class="absolute top-2 right-2">
                                <input type="checkbox" name="hapus_gambar[]" value="<?php echo e($index); ?>" class="w-5 h-5 text-[#991B1B] rounded border-slate-300 focus:ring-[#991B1B]" onchange="syncCheckbox(this, <?php echo e($index); ?>)">
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <p class="mb-3 text-xs text-slate-500">Centang kotak pada gambar yang ingin dihapus.</p>
                    
                    <script>
                        function toggleDeleteMark(index) {
                            const checkboxes = document.querySelectorAll('input[name="hapus_gambar[]"][value="' + index + '"]');
                            const isChecked = checkboxes[0].checked;
                            checkboxes.forEach(cb => cb.checked = !isChecked);
                            updateLabel(index, !isChecked);
                        }
                        
                        function syncCheckbox(checkbox, index) {
                            const checkboxes = document.querySelectorAll('input[name="hapus_gambar[]"][value="' + index + '"]');
                            checkboxes.forEach(cb => cb.checked = checkbox.checked);
                            updateLabel(index, checkbox.checked);
                        }
                        
                        function updateLabel(index, isChecked) {
                            const label = document.getElementById('label-text-' + index);
                            if (label) {
                                label.textContent = isChecked ? 'Akan Dihapus' : 'Hapus';
                            }
                            const container = document.getElementById('gambar-' + index);
                            if (isChecked) {
                                container.classList.add('opacity-50');
                            } else {
                                container.classList.remove('opacity-50');
                            }
                        }
                    </script>
                    <?php endif; ?>

                    <div class="border-2 border-dashed border-slate-300 rounded-xl p-6 text-center hover:bg-slate-50 transition cursor-pointer" onclick="document.getElementById('gambar').click()">
                        <svg class="w-10 h-10 text-slate-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        <p class="text-sm text-slate-600 font-medium">Klik untuk upload gambar baru</p>
                        <p class="text-xs text-gray-400 mt-1">Bisa pilih lebih dari satu gambar (JPG, PNG. Max 2MB)</p>
                    </div>
                    <input type="file" id="gambar" name="gambar[]" accept="image/*" multiple class="hidden">
                    <div id="file-count" class="mt-2 text-sm text-[#4276A3] font-medium hidden"></div>
                </div>

                <script>
                    document.getElementById('gambar').addEventListener('change', function(e) {
                        const count = e.target.files.length;
                        const display = document.getElementById('file-count');
                        if (count > 0) {
                            display.textContent = count + ' file dipilih untuk diupload';
                            display.classList.remove('hidden');
                        } else {
                            display.classList.add('hidden');
                        }
                    });
                </script>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="urutan" class="block text-sm font-medium text-gray-700 mb-2">Urutan Tampil</label>
                        <input type="number" id="urutan" name="urutan" value="<?php echo e(old('urutan', $fasilitas->urutan ?? 0)); ?>"
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition">
                    </div>
                    <div class="flex items-center pt-8">
                        <label class="flex items-center cursor-pointer">
                            <input type="checkbox" name="aktif" value="1" <?php echo e(old('aktif', $fasilitas->aktif ?? true) ? 'checked' : ''); ?>

                                class="w-5 h-5 text-[#4276A3] border-slate-300 rounded focus:ring-[#4276A3]">
                            <span class="ml-3 text-sm font-medium text-gray-700">Tampilkan di Website</span>
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex justify-end gap-4">
            <a href="<?php echo e(route('admin.fasilitas.index')); ?>" class="btn btn-secondary btn-lg">
                Batal
            </a>
            <button type="submit" class="btn btn-primary btn-lg shadow-sm hover:shadow-md">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                <?php echo e(isset($fasilitas) ? 'Simpan Perubahan' : 'Tambah Fasilitas'); ?>

            </button>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\user\.gemini\antigravity\scratch\smkalstar\smkalstar\resources\views/admin/fasilitas/form.blade.php ENDPATH**/ ?>