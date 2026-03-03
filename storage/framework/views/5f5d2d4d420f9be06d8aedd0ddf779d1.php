

<?php $__env->startSection('title', 'Tambah Section Beranda - Admin Panel'); ?>

<?php $__env->startSection('content'); ?>
    
    <div class="mb-6">
        <div class="flex items-center gap-2 text-sm text-slate-500 mb-2">
            <a href="<?php echo e(route('admin.beranda.index')); ?>" class="hover:text-[#4276A3]">Kelola Beranda</a>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
            <span>Tambah Baru</span>
        </div>
        <h1 class="text-lg font-semibold text-slate-800">Tambah Section Beranda</h1>
    </div>

    
    <?php if($errors->any()): ?>
    <div class="mb-4 p-3 bg-[#991B1B]/10 border border-[#991B1B]/20 text-[#991B1B] rounded-lg text-sm">
        <p class="font-medium mb-1">Terdapat kesalahan:</p>
        <ul class="list-disc list-inside text-xs">
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
    <?php endif; ?>

    
    <div class="card p-6 max-w-3xl">
        <form action="<?php echo e(route('admin.beranda.store')); ?>" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                
                <div>
                    <label for="tipe" class="block text-sm font-medium text-slate-700 mb-1">
                        Tipe Section <span class="text-[#991B1B]">*</span>
                    </label>
                    <select id="tipe" name="tipe" required
                            class="w-full px-3 py-2 text-sm border border-slate-300 rounded-md focus:outline-none focus:border-[#4276A3] focus:ring-1 focus:ring-[#4276A3] bg-white">
                        <?php $__currentLoopData = $tipeList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($key); ?>" <?php echo e(old('tipe', request('tipe')) == $key ? 'selected' : ''); ?>><?php echo e($label); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                
                <div>
                    <label for="urutan" class="block text-sm font-medium text-slate-700 mb-1">
                        Urutan <span class="text-[#991B1B]">*</span>
                    </label>
                    <input type="number" id="urutan" name="urutan" 
                           value="<?php echo e(old('urutan', 0)); ?>" required min="0"
                           class="w-full px-3 py-2 text-sm border border-slate-300 rounded-md focus:outline-none focus:border-[#4276A3] focus:ring-1 focus:ring-[#4276A3]">
                    <p class="text-xs text-slate-500 mt-1">Angka kecil = tampil lebih awal</p>
                </div>
            </div>

            <div class="mt-4">
                <label for="judul" class="block text-sm font-medium text-slate-700 mb-1">
                    Judul <span class="text-[#991B1B]">*</span>
                </label>
                <input type="text" id="judul" name="judul" 
                       value="<?php echo e(old('judul')); ?>" required
                       placeholder="Contoh: Selamat Datang di SMK Al-Hidayah"
                       class="w-full px-3 py-2 text-sm border border-slate-300 rounded-md focus:outline-none focus:border-[#4276A3] focus:ring-1 focus:ring-[#4276A3]">
            </div>

            <div class="mt-4">
                <label for="subjudul" class="block text-sm font-medium text-slate-700 mb-1">
                    Subjudul
                </label>
                <input type="text" id="subjudul" name="subjudul" 
                       value="<?php echo e(old('subjudul')); ?>"
                       placeholder="Contoh: Sekolah Unggul Berakhlak"
                       class="w-full px-3 py-2 text-sm border border-slate-300 rounded-md focus:outline-none focus:border-[#4276A3] focus:ring-1 focus:ring-[#4276A3]">
            </div>

            <div class="mt-4">
                <label for="konten" class="block text-sm font-medium text-slate-700 mb-1">
                    Konten
                </label>
                <textarea id="konten" name="konten" rows="4"
                          placeholder="Isi konten section..."
                          class="w-full px-3 py-2 text-sm border border-slate-300 rounded-md focus:outline-none focus:border-[#4276A3] focus:ring-1 focus:ring-[#4276A3]"><?php echo e(old('konten')); ?></textarea>
            </div>

            <div class="mt-4">
                <label for="gambar" class="block text-sm font-medium text-slate-700 mb-1">
                    Gambar
                </label>
                <input type="file" id="gambar" name="gambar" accept="image/*"
                       class="block w-full text-sm text-slate-500
                              file:mr-4 file:py-2 file:px-4
                              file:rounded file:border-0
                              file:text-sm file:font-medium
                              file:bg-[#4276A3]/10 file:text-[#4276A3]
                              hover:file:bg-[#4276A3]/20
                              cursor-pointer">
                <p class="text-xs text-slate-500 mt-1">Format: JPG, PNG, WebP. Max 2MB.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                
                <div>
                    <label for="tombol_teks" class="block text-sm font-medium text-slate-700 mb-1">
                        Teks Tombol
                    </label>
                    <input type="text" id="tombol_teks" name="tombol_teks" 
                           value="<?php echo e(old('tombol_teks')); ?>"
                           placeholder="Contoh: Daftar Sekarang"
                           class="w-full px-3 py-2 text-sm border border-slate-300 rounded-md focus:outline-none focus:border-[#4276A3] focus:ring-1 focus:ring-[#4276A3]">
                </div>

                
                <div>
                    <label for="tombol_link" class="block text-sm font-medium text-slate-700 mb-1">
                        Link Tombol
                    </label>
                    <input type="text" id="tombol_link" name="tombol_link" 
                           value="<?php echo e(old('tombol_link')); ?>"
                           placeholder="Contoh: /spmb/register"
                           class="w-full px-3 py-2 text-sm border border-slate-300 rounded-md focus:outline-none focus:border-[#4276A3] focus:ring-1 focus:ring-[#4276A3]">
                </div>
            </div>

            <div class="mt-4">
                <label for="warna_latar" class="block text-sm font-medium text-slate-700 mb-1">
                    Warna Latar (Tailwind Class)
                </label>
                <input type="text" id="warna_latar" name="warna_latar" 
                       value="<?php echo e(old('warna_latar')); ?>"
                       placeholder="Contoh: bg-white, bg-slate-50, bg-blue-50"
                       class="w-full px-3 py-2 text-sm border border-slate-300 rounded-md focus:outline-none focus:border-[#4276A3] focus:ring-1 focus:ring-[#4276A3]">
                <p class="text-xs text-slate-500 mt-1">Kosongkan untuk default</p>
            </div>

            <div class="mt-4 p-3 bg-slate-50 rounded-lg border border-slate-200">
                <label class="flex items-start gap-3 cursor-pointer">
                    <input type="checkbox" name="is_active" value="1" <?php echo e(old('is_active', true) ? 'checked' : ''); ?>

                           class="mt-0.5 w-4 h-4 text-[#4276A3] border-slate-300 rounded focus:ring-[#4276A3]">
                    <div>
                        <span class="text-sm font-medium text-slate-700">Aktifkan section ini</span>
                        <p class="text-xs text-slate-500 mt-0.5">Section yang tidak aktif tidak akan ditampilkan</p>
                    </div>
                </label>
            </div>

            
            <div class="mt-6 flex justify-end gap-2 pt-4 border-t border-slate-200">
                <a href="<?php echo e(route('admin.beranda.index')); ?>" class="btn btn-secondary">
                    Batal
                </a>
                <button type="submit" class="btn btn-primary">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Simpan
                </button>
            </div>
        </form>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\eka\.gemini\antigravity\scratch\smk-alstar\resources\views\admin\beranda\create.blade.php ENDPATH**/ ?>