

<?php $__env->startSection('title', 'Edit Program Keahlian SPMB - Admin Panel'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-4xl mx-auto">
    
    <div class="mb-8">
        <a href="<?php echo e(route('admin.spmb.jurusan.index')); ?>" class="text-slate-500 hover:text-slate-700 flex items-center gap-1 mb-4">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Kembali
        </a>
        <h1 class="text-2xl font-bold text-slate-800">Edit Program Keahlian</h1>
        <p class="text-slate-600">Edit jurusan <?php echo e($jurusan->nama); ?>.</p>
    </div>

    
    <form action="<?php echo e(route('admin.spmb.jurusan.update', $jurusan)); ?>" method="POST" enctype="multipart/form-data" class="space-y-6">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
            <h2 class="text-lg font-semibold text-slate-800 mb-4">Informasi Dasar</h2>
            <div class="grid md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Kode Jurusan</label>
                    <input type="text" name="kode" value="<?php echo e(old('kode', $jurusan->kode)); ?>" 
                        class="w-full rounded-lg border-slate-300 focus:border-blue-500 focus:ring-blue-500 uppercase"
                        placeholder="Contoh: TKJ">
                    <?php $__errorArgs = ['kode'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Nama Jurusan</label>
                    <input type="text" name="nama" value="<?php echo e(old('nama', $jurusan->nama)); ?>" 
                        class="w-full rounded-lg border-slate-300 focus:border-blue-500 focus:ring-blue-500"
                        placeholder="Contoh: Teknik Komputer dan Jaringan">
                    <?php $__errorArgs = ['nama'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Urutan</label>
                    <input type="number" name="urutan" value="<?php echo e(old('urutan', $jurusan->urutan)); ?>" min="0"
                        class="w-full rounded-lg border-slate-300 focus:border-blue-500 focus:ring-blue-500">
                    <?php $__errorArgs = ['urutan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            </div>
        </div>

        
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
            <h2 class="text-lg font-semibold text-slate-800 mb-4">Warna Tema</h2>
            <div class="grid md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Border Color</label>
                    <select name="warna_border" class="w-full rounded-lg border-slate-300 focus:border-blue-500 focus:ring-blue-500">
                        <option value="border-blue-900" <?php echo e(old('warna_border', $jurusan->warna_border) == 'border-blue-900' ? 'selected' : ''); ?>>Biru Tua (Blue-900)</option>
                        <option value="border-green-500" <?php echo e(old('warna_border', $jurusan->warna_border) == 'border-green-500' ? 'selected' : ''); ?>>Hijau (Green-500)</option>
                        <option value="border-purple-500" <?php echo e(old('warna_border', $jurusan->warna_border) == 'border-purple-500' ? 'selected' : ''); ?>>Ungu (Purple-500)</option>
                        <option value="border-cyan-500" <?php echo e(old('warna_border', $jurusan->warna_border) == 'border-cyan-500' ? 'selected' : ''); ?>>Cyan (Cyan-500)</option>
                        <option value="border-orange-500" <?php echo e(old('warna_border', $jurusan->warna_border) == 'border-orange-500' ? 'selected' : ''); ?>>Oranye (Orange-500)</option>
                        <option value="border-red-500" <?php echo e(old('warna_border', $jurusan->warna_border) == 'border-red-500' ? 'selected' : ''); ?>>Merah (Red-500)</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Background Color</label>
                    <select name="warna_bg" class="w-full rounded-lg border-slate-300 focus:border-blue-500 focus:ring-blue-500">
                        <option value="bg-blue-50" <?php echo e(old('warna_bg', $jurusan->warna_bg) == 'bg-blue-50' ? 'selected' : ''); ?>>Biru Muda (Blue-50)</option>
                        <option value="bg-green-50" <?php echo e(old('warna_bg', $jurusan->warna_bg) == 'bg-green-50' ? 'selected' : ''); ?>>Hijau Muda (Green-50)</option>
                        <option value="bg-purple-50" <?php echo e(old('warna_bg', $jurusan->warna_bg) == 'bg-purple-50' ? 'selected' : ''); ?>>Ungu Muda (Purple-50)</option>
                        <option value="bg-cyan-50" <?php echo e(old('warna_bg', $jurusan->warna_bg) == 'bg-cyan-50' ? 'selected' : ''); ?>>Cyan Muda (Cyan-50)</option>
                        <option value="bg-orange-50" <?php echo e(old('warna_bg', $jurusan->warna_bg) == 'bg-orange-50' ? 'selected' : ''); ?>>Oranye Muda (Orange-50)</option>
                        <option value="bg-red-50" <?php echo e(old('warna_bg', $jurusan->warna_bg) == 'bg-red-50' ? 'selected' : ''); ?>>Merah Muda (Red-50)</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Text Color</label>
                    <select name="warna_text" class="w-full rounded-lg border-slate-300 focus:border-blue-500 focus:ring-blue-500">
                        <option value="text-blue-900" <?php echo e(old('warna_text', $jurusan->warna_text) == 'text-blue-900' ? 'selected' : ''); ?>>Biru Tua (Blue-900)</option>
                        <option value="text-green-600" <?php echo e(old('warna_text', $jurusan->warna_text) == 'text-green-600' ? 'selected' : ''); ?>>Hijau (Green-600)</option>
                        <option value="text-purple-600" <?php echo e(old('warna_text', $jurusan->warna_text) == 'text-purple-600' ? 'selected' : ''); ?>>Ungu (Purple-600)</option>
                        <option value="text-cyan-600" <?php echo e(old('warna_text', $jurusan->warna_text) == 'text-cyan-600' ? 'selected' : ''); ?>>Cyan (Cyan-600)</option>
                        <option value="text-orange-600" <?php echo e(old('warna_text', $jurusan->warna_text) == 'text-orange-600' ? 'selected' : ''); ?>>Oranye (Orange-600)</option>
                        <option value="text-red-600" <?php echo e(old('warna_text', $jurusan->warna_text) == 'text-red-600' ? 'selected' : ''); ?>>Merah (Red-600)</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Hover Color</label>
                    <select name="warna_hover" class="w-full rounded-lg border-slate-300 focus:border-blue-500 focus:ring-blue-500">
                        <option value="group-hover:bg-blue-900" <?php echo e(old('warna_hover', $jurusan->warna_hover) == 'group-hover:bg-blue-900' ? 'selected' : ''); ?>>Biru Tua (Blue-900)</option>
                        <option value="group-hover:bg-green-600" <?php echo e(old('warna_hover', $jurusan->warna_hover) == 'group-hover:bg-green-600' ? 'selected' : ''); ?>>Hijau (Green-600)</option>
                        <option value="group-hover:bg-purple-600" <?php echo e(old('warna_hover', $jurusan->warna_hover) == 'group-hover:bg-purple-600' ? 'selected' : ''); ?>>Ungu (Purple-600)</option>
                        <option value="group-hover:bg-cyan-600" <?php echo e(old('warna_hover', $jurusan->warna_hover) == 'group-hover:bg-cyan-600' ? 'selected' : ''); ?>>Cyan (Cyan-600)</option>
                        <option value="group-hover:bg-orange-600" <?php echo e(old('warna_hover', $jurusan->warna_hover) == 'group-hover:bg-orange-600' ? 'selected' : ''); ?>>Oranye (Orange-600)</option>
                        <option value="group-hover:bg-red-600" <?php echo e(old('warna_hover', $jurusan->warna_hover) == 'group-hover:bg-red-600' ? 'selected' : ''); ?>>Merah (Red-600)</option>
                    </select>
                </div>
            </div>
        </div>

        
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
            <h2 class="text-lg font-semibold text-slate-800 mb-4">Media (Logo & Gambar)</h2>
            <div class="grid md:grid-cols-2 gap-6">
                
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Logo Jurusan</label>
                    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-slate-300 border-dashed rounded-xl hover:border-blue-400 transition cursor-pointer relative" onclick="document.getElementById('logo').click()">
                        <div class="space-y-1 text-center <?php echo e($jurusan->logo ? 'hidden' : ''); ?>">
                            <svg class="mx-auto h-12 w-12 text-slate-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <div class="flex text-sm text-slate-600 justify-center">
                                <span class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500">Ganti file</span>
                            </div>
                            <p class="text-xs text-slate-500">PNG, JPG, WEBP up to 2MB</p>
                        </div>
                        <?php if($jurusan->logo): ?>
                        <img id="logo-preview" src="<?php echo e($jurusan->logo_url); ?>" class="absolute inset-0 w-full h-full object-contain p-2 bg-white rounded-xl">
                        <?php else: ?>
                        <img id="logo-preview" class="absolute inset-0 w-full h-full object-contain p-2 hidden bg-white rounded-xl">
                        <?php endif; ?>
                    </div>
                    <input id="logo" name="logo" type="file" accept="image/*" class="sr-only" onchange="previewImage(this, 'logo-preview')">
                    <?php $__errorArgs = ['logo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Gambar Jurusan</label>
                    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-slate-300 border-dashed rounded-xl hover:border-blue-400 transition cursor-pointer relative" onclick="document.getElementById('gambar').click()">
                        <div class="space-y-1 text-center <?php echo e($jurusan->gambar ? 'hidden' : ''); ?>">
                            <svg class="mx-auto h-12 w-12 text-slate-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <div class="flex text-sm text-slate-600 justify-center">
                                <span class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500">Ganti file</span>
                            </div>
                            <p class="text-xs text-slate-500">PNG, JPG, WEBP up to 5MB</p>
                        </div>
                        <?php if($jurusan->gambar): ?>
                        <img id="gambar-preview" src="<?php echo e($jurusan->gambar_url); ?>" class="absolute inset-0 w-full h-full object-contain p-2 bg-white rounded-xl">
                        <?php else: ?>
                        <img id="gambar-preview" class="absolute inset-0 w-full h-full object-contain p-2 hidden bg-white rounded-xl">
                        <?php endif; ?>
                    </div>
                    <input id="gambar" name="gambar" type="file" accept="image/*" class="sr-only" onchange="previewImage(this, 'gambar-preview')">
                    <?php $__errorArgs = ['gambar'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            </div>
        </div>

        
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
            <h2 class="text-lg font-semibold text-slate-800 mb-4">Pengaturan</h2>
            <label class="flex items-center gap-3 cursor-pointer">
                <input type="checkbox" name="aktif" value="1" <?php echo e(old('aktif', $jurusan->aktif) ? 'checked' : ''); ?>

                    class="rounded border-slate-300 text-blue-600 focus:ring-blue-500 w-5 h-5">
                <span class="text-slate-700">Aktifkan jurusan ini (tampil di halaman SPMB)</span>
            </label>
        </div>

        
        <div class="flex gap-4">
            <button type="submit" class="btn btn-primary shadow-lg hover:shadow-xl">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                Simpan Perubahan
            </button>
            <a href="<?php echo e(route('admin.spmb.jurusan.index')); ?>" class="btn btn-secondary">
                Batal
            </a>
        </div>
    </form>
</div>

<?php $__env->startPush('scripts'); ?>
<script>
function previewImage(input, previewId) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const preview = document.getElementById(previewId);
            preview.src = e.target.result;
            preview.classList.remove('hidden');
            const placeholder = preview.previousElementSibling;
            if (placeholder) placeholder.classList.add('hidden');
        }
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\eka\.gemini\antigravity\scratch\smk-alstar\resources\views\admin\spmb\jurusan\edit.blade.php ENDPATH**/ ?>