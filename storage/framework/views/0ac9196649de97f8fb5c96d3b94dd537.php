

<?php $__env->startSection('title', 'Formulir Pendaftaran - SMK Al-Hidayah Lestari'); ?>

<?php $__env->startSection('content'); ?>
<div class="min-h-screen bg-gray-50 py-12 px-4" x-data="{ isSubmitting: false }">
    <div class="w-full max-w-2xl mx-auto">
        <!-- Logo & Title -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-white rounded-2xl shadow-md mb-4">
                <img src="<?php echo e(asset('images/logo.webp')); ?>" alt="Logo" class="w-12 h-12 object-contain rounded-lg" loading="lazy" decoding="async">
            </div>
            <h1 class="text-2xl font-bold text-gray-900">Formulir Pendaftaran</h1>
            <p class="text-gray-500 mt-1 text-sm">SPMB 2026/2027 SMK Al-Hidayah Lestari</p>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8">
            <?php if(session('error')): ?>
            <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl">
                <p class="text-red-700 text-sm"><?php echo e(session('error')); ?></p>
            </div>
            <?php endif; ?>

            <?php if($errors->any()): ?>
            <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl">
                <ul class="text-red-700 text-sm space-y-1 list-disc list-inside">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
            <?php endif; ?>

            <form action="<?php echo e(route('spmb.store')); ?>" method="POST" @submit="isSubmitting = true">
                <?php echo csrf_field(); ?>

                <!-- Data Diri -->
                <div class="mb-8">
                    <h2 class="text-lg font-bold text-gray-900 mb-4 pb-2 border-b border-gray-100">Data Pribadi</h2>
                    <div class="grid md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">NISN <span class="text-red-500">*</span></label>
                            <input type="text" name="nisn" value="<?php echo e(old('nisn')); ?>" 
                                class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all"
                                placeholder="00xxxxxxxx" maxlength="10" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap <span class="text-red-500">*</span></label>
                            <input type="text" name="nama" value="<?php echo e(old('nama')); ?>" 
                                class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all"
                                placeholder="Sesuai ijazah" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Lahir <span class="text-red-500">*</span></label>
                            <input type="date" name="tgl_lahir" value="<?php echo e(old('tgl_lahir')); ?>" 
                                class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all"
                                required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Kelamin <span class="text-red-500">*</span></label>
                            <select name="jk" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all" required>
                                <option value="">Pilih</option>
                                <option value="L" <?php echo e(old('jk') == 'L' ? 'selected' : ''); ?>>Laki-laki</option>
                                <option value="P" <?php echo e(old('jk') == 'P' ? 'selected' : ''); ?>>Perempuan</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">No. WhatsApp <span class="text-red-500">*</span></label>
                            <input type="text" name="no_wa" value="<?php echo e(old('no_wa')); ?>" 
                                class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all"
                                placeholder="08xxxxxxxxxx" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Asal Sekolah <span class="text-red-500">*</span></label>
                            <input type="text" name="asal_sekolah" value="<?php echo e(old('asal_sekolah')); ?>" 
                                class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all"
                                placeholder="SMP/MTs..." required>
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Alamat Lengkap <span class="text-red-500">*</span></label>
                            <textarea name="alamat" rows="3" 
                                class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all resize-none"
                                placeholder="Masukkan alamat lengkap" required><?php echo e(old('alamat')); ?></textarea>
                        </div>
                    </div>
                </div>

                <!-- Data Ortu -->
                <div class="mb-8">
                    <h2 class="text-lg font-bold text-gray-900 mb-4 pb-2 border-b border-gray-100">Data Orang Tua</h2>
                    <div class="grid md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nama Ayah <span class="text-red-500">*</span></label>
                            <input type="text" name="nama_ayah" value="<?php echo e(old('nama_ayah')); ?>" 
                                class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all"
                                required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nama Ibu <span class="text-red-500">*</span></label>
                            <input type="text" name="nama_ibu" value="<?php echo e(old('nama_ibu')); ?>" 
                                class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all"
                                required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Pekerjaan <span class="text-red-500">*</span></label>
                            <input type="text" name="pekerjaan" value="<?php echo e(old('pekerjaan')); ?>" 
                                class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all"
                                required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">No. WhatsApp Ortu <span class="text-red-500">*</span></label>
                            <input type="text" name="no_wa_ortu" value="<?php echo e(old('no_wa_ortu')); ?>" 
                                class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all"
                                placeholder="08xxxxxxxxxx" required>
                        </div>
                    </div>
                </div>

                <!-- Jurusan -->
                <div class="mb-8">
                    <h2 class="text-lg font-bold text-gray-900 mb-4 pb-2 border-b border-gray-100">Pilihan Jurusan</h2>
                    <div class="space-y-3 mb-5">
                        <?php $__currentLoopData = $jurusan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $j): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <label class="flex items-center p-4 border-2 border-gray-200 rounded-xl cursor-pointer hover:border-primary/50 transition-all has-[:checked]:border-primary has-[:checked]:bg-primary/5">
                            <input type="radio" name="jurusan_id" value="<?php echo e($j->id); ?>" class="w-5 h-5 text-primary border-gray-300 focus:ring-primary" <?php echo e(old('jurusan_id') == $j->id ? 'checked' : ''); ?> required>
                            <div class="ml-4">
                                <p class="font-semibold text-gray-900"><?php echo e($j->nama); ?></p>
                                <p class="text-sm text-gray-500"><?php echo e($j->kode); ?></p>
                            </div>
                        </label>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Gelombang <span class="text-red-500">*</span></label>
                        <select name="gelombang" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all" required>
                            <option value="Gelombang 1" <?php echo e(old('gelombang') == 'Gelombang 1' ? 'selected' : ''); ?>>Gelombang 1 (Januari - 23 Mei 2026)</option>
                            <option value="Gelombang 2" <?php echo e(old('gelombang') == 'Gelombang 2' ? 'selected' : ''); ?>>Gelombang 2 (24 Mei - 4 Juli 2026)</option>
                        </select>
                    </div>
                </div>

                <!-- Konfirmasi -->
                <div class="mb-8">
                    <h2 class="text-lg font-bold text-gray-900 mb-4 pb-2 border-b border-gray-100">Konfirmasi</h2>
                    <div class="space-y-3">
                        <label class="flex items-start gap-3 cursor-pointer">
                            <input type="checkbox" class="mt-1 w-4 h-4 rounded border-gray-300 text-primary focus:ring-primary" required>
                            <span class="text-sm text-gray-600">Saya menyatakan data yang diisi adalah benar dan dapat dipertanggungjawabkan.</span>
                        </label>
                        <label class="flex items-start gap-3 cursor-pointer">
                            <input type="checkbox" class="mt-1 w-4 h-4 rounded border-gray-300 text-primary focus:ring-primary" required>
                            <span class="text-sm text-gray-600">Saya bersedia mematuhi peraturan dan ketentuan sekolah.</span>
                        </label>
                    </div>
                </div>

                <!-- Submit Button -->
                <button 
                    type="submit" 
                    class="w-full flex items-center justify-center gap-2 bg-primary text-white px-6 py-3.5 rounded-xl font-semibold hover:bg-primary-dark transition shadow-lg shadow-primary/20 disabled:opacity-70"
                    :disabled="isSubmitting"
                >
                    <svg x-show="isSubmitting" class="w-5 h-5 animate-spin" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <span x-text="isSubmitting ? 'Mengirim...' : 'Kirim Pendaftaran'"></span>
                </button>
            </form>
        </div>

        <!-- Info -->
        <div class="mt-6 bg-yellow-50 border border-yellow-200 rounded-xl p-4">
            <p class="text-yellow-800 text-sm">
                <strong>Catatan:</strong> Dokumen dapat diunggah setelah pendaftaran berhasil melalui dashboard siswa.
            </p>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\eka\.gemini\antigravity\scratch\smk-alstar\resources\views\spmb\register.blade.php ENDPATH**/ ?>