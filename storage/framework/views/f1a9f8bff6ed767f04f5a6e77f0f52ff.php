

<?php $__env->startSection('title', 'Edit Hero SPMB - Admin Panel'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-4xl mx-auto">
    
    <div class="mb-8">
        <a href="<?php echo e(route('admin.spmb.hero.index')); ?>" class="text-slate-500 hover:text-slate-700 flex items-center gap-1 mb-4">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Kembali
        </a>
        <h1 class="text-2xl font-bold text-slate-800">Edit Hero / Banner</h1>
        <p class="text-slate-600">Ubah konten banner hero untuk halaman SPMB.</p>
    </div>

    
    <form action="<?php echo e(route('admin.spmb.hero.update', $hero)); ?>" method="POST" class="space-y-6">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
            <h2 class="text-lg font-semibold text-slate-800 mb-4 flex items-center gap-2">
                <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                </svg>
                Badge
            </h2>
            <div class="grid md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Teks Badge</label>
                    <input type="text" name="badge_text" value="<?php echo e(old('badge_text', $hero->badge_text)); ?>" 
                        class="w-full rounded-lg border-slate-300 focus:border-blue-500 focus:ring-blue-500"
                        placeholder="Contoh: Pendaftaran Dibuka!">
                    <?php $__errorArgs = ['badge_text'];
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
                    <label class="block text-sm font-medium text-slate-700 mb-2">Warna Badge</label>
                    <select name="badge_warna" class="w-full rounded-lg border-slate-300 focus:border-blue-500 focus:ring-blue-500">
                        <option value="blue" <?php echo e(old('badge_warna', $hero->badge_warna) == 'blue' ? 'selected' : ''); ?>>Biru (Blue)</option>
                        <option value="green" <?php echo e(old('badge_warna', $hero->badge_warna) == 'green' ? 'selected' : ''); ?>>Hijau (Green)</option>
                        <option value="orange" <?php echo e(old('badge_warna', $hero->badge_warna) == 'orange' ? 'selected' : ''); ?>>Oranye (Orange)</option>
                        <option value="purple" <?php echo e(old('badge_warna', $hero->badge_warna) == 'purple' ? 'selected' : ''); ?>>Ungu (Purple)</option>
                        <option value="red" <?php echo e(old('badge_warna', $hero->badge_warna) == 'red' ? 'selected' : ''); ?>>Merah (Red)</option>
                        <option value="indigo" <?php echo e(old('badge_warna', $hero->badge_warna) == 'indigo' ? 'selected' : ''); ?>>Indigo</option>
                    </select>
                    <?php $__errorArgs = ['badge_warna'];
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
            <h2 class="text-lg font-semibold text-slate-800 mb-4 flex items-center gap-2">
                <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
                Judul
            </h2>
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Baris 1</label>
                    <input type="text" name="judul_baris1" value="<?php echo e(old('judul_baris1', $hero->judul_baris1)); ?>" 
                        class="w-full rounded-lg border-slate-300 focus:border-blue-500 focus:ring-blue-500"
                        placeholder="Contoh: Sistem Penerimaan">
                    <?php $__errorArgs = ['judul_baris1'];
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
                    <label class="block text-sm font-medium text-slate-700 mb-2">Baris 2 (Diberi warna)</label>
                    <input type="text" name="judul_baris2" value="<?php echo e(old('judul_baris2', $hero->judul_baris2)); ?>" 
                        class="w-full rounded-lg border-slate-300 focus:border-blue-500 focus:ring-blue-500"
                        placeholder="Contoh: Murid Baru 2026/2027">
                    <?php $__errorArgs = ['judul_baris2'];
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
            <h2 class="text-lg font-semibold text-slate-800 mb-4 flex items-center gap-2">
                <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"/>
                </svg>
                Deskripsi
            </h2>
            <div>
                <textarea name="deskripsi" rows="3" 
                    class="w-full rounded-lg border-slate-300 focus:border-blue-500 focus:ring-blue-500"
                    placeholder="Deskripsi singkat tentang SPMB..."><?php echo e(old('deskripsi', $hero->deskripsi)); ?></textarea>
                <?php $__errorArgs = ['deskripsi'];
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

        
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
            <h2 class="text-lg font-semibold text-slate-800 mb-4 flex items-center gap-2">
                <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                Pengaturan
            </h2>
            <div class="grid md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Tahun Ajaran</label>
                    <input type="text" name="tahun_ajaran" value="<?php echo e(old('tahun_ajaran', $hero->tahun_ajaran)); ?>" 
                        class="w-full rounded-lg border-slate-300 focus:border-blue-500 focus:ring-blue-500"
                        placeholder="Contoh: 2026/2027">
                    <?php $__errorArgs = ['tahun_ajaran'];
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
                    <label class="block text-sm font-medium text-slate-700 mb-2">Jumlah Gelombang Ditampilkan</label>
                    <input type="number" name="jumlah_gelombang_tampil" value="<?php echo e(old('jumlah_gelombang_tampil', $hero->jumlah_gelombang_tampil)); ?>" min="1" max="5"
                        class="w-full rounded-lg border-slate-300 focus:border-blue-500 focus:ring-blue-500">
                    <?php $__errorArgs = ['jumlah_gelombang_tampil'];
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
                    <input type="number" name="urutan" value="<?php echo e(old('urutan', $hero->urutan)); ?>" min="0"
                        class="w-full rounded-lg border-slate-300 focus:border-blue-500 focus:ring-blue-500">
                    <p class="text-xs text-slate-500 mt-1">Hero dengan urutan terkecil yang aktif akan ditampilkan</p>
                </div>
            </div>
            
            
            <div class="mt-4 space-y-3">
                <label class="flex items-center gap-3 cursor-pointer">
                    <input type="checkbox" name="aktif" value="1" <?php echo e(old('aktif', $hero->aktif) ? 'checked' : ''); ?>

                        class="rounded border-slate-300 text-blue-600 focus:ring-blue-500">
                    <span class="text-slate-700">Aktifkan hero ini</span>
                </label>
                <label class="flex items-center gap-3 cursor-pointer">
                    <input type="checkbox" name="tampilkan_gelombang" value="1" <?php echo e(old('tampilkan_gelombang', $hero->tampilkan_gelombang) ? 'checked' : ''); ?>

                        class="rounded border-slate-300 text-blue-600 focus:ring-blue-500">
                    <span class="text-slate-700">Tampilkan info gelombang di hero</span>
                </label>
            </div>
        </div>

        
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6" x-data="{ bgType: '<?php echo e(old('bg_type', $hero->bg_type ?? 'default')); ?>' }">
            <h2 class="text-lg font-semibold text-slate-800 mb-4 flex items-center gap-2">
                <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                Background
            </h2>
            
            <div class="space-y-4">
                
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Tipe Background</label>
                    <select name="bg_type" x-model="bgType" class="w-full rounded-lg border-slate-300 focus:border-blue-500 focus:ring-blue-500">
                        <option value="default" <?php echo e(old('bg_type', $hero->bg_type) == 'default' ? 'selected' : ''); ?>>Default (Gradien Putih-Biru)</option>
                        <option value="color" <?php echo e(old('bg_type', $hero->bg_type) == 'color' ? 'selected' : ''); ?>>Warna Solid</option>
                        <option value="image" <?php echo e(old('bg_type', $hero->bg_type) == 'image' ? 'selected' : ''); ?>>Gambar</option>
                    </select>
                    <p class="text-xs text-slate-500 mt-1">Pilih tipe background untuk hero section</p>
                </div>

                
                <div x-show="bgType === 'color'" x-transition>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Warna Background</label>
                    <div class="flex items-center gap-3">
                        <input type="color" name="bg_value" value="<?php echo e(old('bg_value', $hero->bg_value ?? '#ffffff')); ?>" 
                            class="h-10 w-20 rounded border-slate-300">
                        <input type="text" name="bg_value" value="<?php echo e(old('bg_value', $hero->bg_value ?? '#ffffff')); ?>" 
                            class="flex-1 rounded-lg border-slate-300 focus:border-blue-500 focus:ring-blue-500"
                            placeholder="#ffffff atau linear-gradient(...)">
                    </div>
                    <p class="text-xs text-slate-500 mt-1">Pilih warna atau masukkan kode CSS (hex, rgb, gradient)</p>
                </div>

                
                <div x-show="bgType === 'image'" x-transition>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Gambar Background</label>
                    
                    
                    <?php if($hero->bg_value && $hero->bg_type === 'image'): ?>
                    <div class="mb-3">
                        <p class="text-xs text-slate-500 mb-1">Gambar saat ini:</p>
                        <img src="<?php echo e(asset($hero->bg_value)); ?>" alt="Background" class="h-32 rounded-lg object-cover border">
                    </div>
                    <?php endif; ?>
                    
                    <input type="file" name="bg_image" accept="image/*"
                        class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                    <p class="text-xs text-slate-500 mt-1">Format: JPG, PNG, WebP. Maksimal 2MB. Rekomendasi ukuran: 1920x1080px</p>
                    <?php $__errorArgs = ['bg_image'];
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

        
        <div class="flex gap-4">
            <button type="submit" class="btn btn-primary shadow-lg hover:shadow-xl">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                Simpan Perubahan
            </button>
            <a href="<?php echo e(route('admin.spmb.hero.index')); ?>" class="btn btn-secondary">
                Batal
            </a>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\eka\.gemini\antigravity\scratch\smk-alstar\resources\views\admin\spmb\hero\edit.blade.php ENDPATH**/ ?>