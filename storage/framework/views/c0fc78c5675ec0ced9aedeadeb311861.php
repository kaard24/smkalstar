<?php $__env->startSection('title', 'Lengkapi Data - SMK Al-Hidayah Lestari'); ?>

<?php $__env->startSection('content'); ?>
<div class="min-h-screen bg-gray-50 py-8" x-data="{
    step: 1,
    totalSteps: 2,
    isLoading: false,
    jenis: '<?php echo e(old('jenis', $siswa->orangTua?->jenis ?? 'orang_tua')); ?>',
    nextStep() {
        if (this.step < this.totalSteps) {
            this.step++;
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }
    },
    prevStep() {
        if (this.step > 1) {
            this.step--;
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }
    }
}">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-gray-900">Lengkapi Data Pendaftaran</h1>
            <p class="text-gray-600 mt-1">Silakan lengkapi data yang masih diperlukan untuk melanjutkan proses pendaftaran.</p>
        </div>

        <!-- Progress Steps -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-4 flex-1">
                    <!-- Step 1 -->
                    <div class="flex items-center gap-3" :class="step >= 1 ? 'opacity-100' : 'opacity-50'">
                        <div class="w-10 h-10 rounded-full flex items-center justify-center font-bold transition-all duration-300" 
                             :class="step >= 1 ? 'bg-primary text-white shadow-lg shadow-primary/30' : 'bg-gray-200 text-gray-500'">1</div>
                        <div class="hidden sm:block">
                            <p class="font-semibold text-sm" :class="step >= 1 ? 'text-gray-900' : 'text-gray-500'">Data Diri</p>
                            <p class="text-xs text-gray-500">Informasi pribadi</p>
                        </div>
                    </div>
                    <div class="flex-1 h-1 mx-4 rounded-full transition-all duration-300" 
                         :class="step >= 2 ? 'bg-primary' : 'bg-gray-200'"></div>
                    <!-- Step 2 -->
                    <div class="flex items-center gap-3" :class="step >= 2 ? 'opacity-100' : 'opacity-50'">
                        <div class="w-10 h-10 rounded-full flex items-center justify-center font-bold transition-all duration-300" 
                             :class="step >= 2 ? 'bg-primary text-white shadow-lg shadow-primary/30' : 'bg-gray-200 text-gray-500'">2</div>
                        <div class="hidden sm:block">
                            <p class="font-semibold text-sm" :class="step >= 2 ? 'text-gray-900' : 'text-gray-500'">Orang Tua/Wali</p>
                            <p class="text-xs text-gray-500">Data keluarga</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php if(session('error')): ?>
        <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl flex items-start gap-3">
            <svg class="w-5 h-5 text-red-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <p class="text-red-700 text-sm"><?php echo e(session('error')); ?></p>
        </div>
        <?php endif; ?>

        <?php if($errors->any()): ?>
        <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl">
            <ul class="text-red-700 text-sm space-y-1">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="flex items-center gap-2">
                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01"/></svg>
                    <?php echo e($error); ?>

                </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
        <?php endif; ?>

        <form action="<?php echo e(route('spmb.lengkapi-data.store')); ?>" method="POST" @submit="isLoading = true">
            <?php echo csrf_field(); ?>

            <!-- Step 1: Data yang Perlu Dilengkapi -->
            <div x-show="step === 1" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-x-4" x-transition:enter-end="opacity-100 translate-x-0">
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden mb-6">
                    <div class="px-6 py-4 border-b border-gray-100 bg-yellow-50">
                        <h2 class="font-semibold text-gray-900 flex items-center gap-2">
                            <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                            </svg>
                            Data yang Perlu Dilengkapi
                        </h2>
                    </div>
                    <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- NIK -->
                        <div>
                            <label for="nik" class="block text-sm font-semibold text-gray-700 mb-2">
                                NIK <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"/>
                                    </svg>
                                </div>
                                <input type="text" id="nik" name="nik" maxlength="16"
                                    value="<?php echo e(old('nik', $siswa->nik)); ?>" required
                                    placeholder="16 digit NIK"
                                    class="w-full pl-11 pr-4 py-3.5 bg-gray-50 border-2 border-gray-200 rounded-xl focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all <?php $__errorArgs = ['nik'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                            </div>
                            <?php $__errorArgs = ['nik'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="mt-1.5 text-sm text-red-500"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <!-- No KK -->
                        <div>
                            <label for="no_kk" class="block text-sm font-semibold text-gray-700 mb-2">
                                Nomor Kartu Keluarga <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                                    </svg>
                                </div>
                                <input type="text" id="no_kk" name="no_kk" maxlength="16"
                                    value="<?php echo e(old('no_kk', $siswa->no_kk)); ?>" required
                                    placeholder="16 digit Nomor KK"
                                    class="w-full pl-11 pr-4 py-3.5 bg-gray-50 border-2 border-gray-200 rounded-xl focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all <?php $__errorArgs = ['no_kk'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                            </div>
                            <?php $__errorArgs = ['no_kk'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="mt-1.5 text-sm text-red-500"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <!-- Jenis Kelamin -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-3">
                                Jenis Kelamin <span class="text-red-500">*</span>
                            </label>
                            <div class="flex gap-6">
                                <label class="flex items-center gap-2 cursor-pointer group">
                                    <input type="radio" name="jk" value="L" <?php echo e(old('jk', $siswa->jk) === 'L' ? 'checked' : ''); ?>

                                        class="w-5 h-5 text-primary border-gray-300 focus:ring-primary cursor-pointer">
                                    <span class="text-gray-700 group-hover:text-gray-900 transition">Laki-laki</span>
                                </label>
                                <label class="flex items-center gap-2 cursor-pointer group">
                                    <input type="radio" name="jk" value="P" <?php echo e(old('jk', $siswa->jk) === 'P' ? 'checked' : ''); ?>

                                        class="w-5 h-5 text-primary border-gray-300 focus:ring-primary cursor-pointer">
                                    <span class="text-gray-700 group-hover:text-gray-900 transition">Perempuan</span>
                                </label>
                            </div>
                            <?php $__errorArgs = ['jk'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="mt-1.5 text-sm text-red-500"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <!-- Alamat -->
                        <div class="md:col-span-2">
                            <label for="alamat" class="block text-sm font-semibold text-gray-700 mb-2">
                                Alamat Lengkap <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute top-3.5 left-4 pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                </div>
                                <textarea id="alamat" name="alamat" rows="3" required
                                    placeholder="Masukkan alamat lengkap (RT/RW, Kelurahan, Kecamatan, Kota)"
                                    class="w-full pl-11 pr-4 py-3.5 bg-gray-50 border-2 border-gray-200 rounded-xl focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all <?php $__errorArgs = ['alamat'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"><?php echo e(old('alamat', $siswa->alamat)); ?></textarea>
                            </div>
                            <?php $__errorArgs = ['alamat'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="mt-1.5 text-sm text-red-500"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <!-- Alamat Sekolah -->
                        <div class="md:col-span-2">
                            <label for="alamat_sekolah" class="block text-sm font-semibold text-gray-700 mb-2">
                                Alamat Sekolah Asal <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute top-3.5 left-4 pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                    </svg>
                                </div>
                                <textarea id="alamat_sekolah" name="alamat_sekolah" rows="3" required
                                    placeholder="Masukkan alamat lengkap sekolah asal"
                                    class="w-full pl-11 pr-4 py-3.5 bg-gray-50 border-2 border-gray-200 rounded-xl focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all <?php $__errorArgs = ['alamat_sekolah'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"><?php echo e(old('alamat_sekolah', $siswa->alamat_sekolah)); ?></textarea>
                            </div>
                            <?php $__errorArgs = ['alamat_sekolah'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="mt-1.5 text-sm text-red-500"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>
                </div>

                <!-- Navigation Buttons -->
                <div class="flex justify-end gap-4">
                    <a href="<?php echo e(route('spmb.dashboard')); ?>" 
                        class="px-6 py-3 border-2 border-gray-200 text-gray-700 rounded-xl font-semibold hover:bg-gray-50 hover:border-gray-300 transition">
                        Batal
                    </a>
                    <button type="button" @click="nextStep()" 
                        class="px-6 py-3 bg-gradient-to-r from-primary to-blue-600 text-white rounded-xl font-semibold hover:shadow-lg hover:shadow-primary/30 transition flex items-center gap-2">
                        Lanjutkan
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Step 2: Data Orang Tua / Wali -->
            <div x-show="step === 2" x-cloak x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-x-4" x-transition:enter-end="opacity-100 translate-x-0">
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden mb-6">
                    <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
                        <h2 class="font-semibold text-gray-900 flex items-center gap-2">
                            <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                            Data Orang Tua/Wali
                        </h2>
                    </div>
                    <div class="p-6 space-y-6">
                        <!-- Pilihan Jenis -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-3">
                                Pilih Jenis <span class="text-red-500">*</span>
                            </label>
                            <div class="flex gap-6">
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="radio" name="jenis" value="orang_tua" x-model="jenis"
                                        class="w-5 h-5 text-primary border-gray-300 focus:ring-primary cursor-pointer">
                                    <span class="text-gray-700">Orang Tua</span>
                                </label>
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="radio" name="jenis" value="wali" x-model="jenis"
                                        class="w-5 h-5 text-primary border-gray-300 focus:ring-primary cursor-pointer">
                                    <span class="text-gray-700">Wali</span>
                                </label>
                            </div>
                        </div>

                        <!-- Form Orang Tua -->
                        <div x-show="jenis === 'orang_tua'" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Nama Ayah -->
                            <div>
                                <label for="nama_ayah" class="block text-sm font-semibold text-gray-700 mb-2">
                                    Nama Ayah <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                        </svg>
                                    </div>
                                    <input type="text" id="nama_ayah" name="nama_ayah" 
                                        value="<?php echo e(old('nama_ayah', $siswa->orangTua?->nama_ayah)); ?>"
                                        x-bind:required="jenis === 'orang_tua'"
                                        class="w-full pl-11 pr-4 py-3.5 bg-gray-50 border-2 border-gray-200 rounded-xl focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all <?php $__errorArgs = ['nama_ayah'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                </div>
                                <?php $__errorArgs = ['nama_ayah'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="mt-1.5 text-sm text-red-500"><?php echo e($message); ?></p>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <!-- NIK Ayah -->
                            <div>
                                <label for="nik_ayah" class="block text-sm font-semibold text-gray-700 mb-2">
                                    NIK Ayah <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"/>
                                        </svg>
                                    </div>
                                    <input type="text" id="nik_ayah" name="nik_ayah" maxlength="16"
                                        value="<?php echo e(old('nik_ayah', $siswa->orangTua?->nik_ayah)); ?>"
                                        placeholder="16 digit NIK"
                                        x-bind:required="jenis === 'orang_tua'"
                                        class="w-full pl-11 pr-4 py-3.5 bg-gray-50 border-2 border-gray-200 rounded-xl focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all <?php $__errorArgs = ['nik_ayah'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                </div>
                                <?php $__errorArgs = ['nik_ayah'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="mt-1.5 text-sm text-red-500"><?php echo e($message); ?></p>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <!-- Status Ayah -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-3">
                                    Status Ayah <span class="text-red-500">*</span>
                                </label>
                                <div class="flex gap-6">
                                    <label class="flex items-center gap-2 cursor-pointer">
                                        <input type="radio" name="status_ayah" value="hidup" 
                                            <?php echo e(old('status_ayah', $siswa->orangTua?->status_ayah ?? 'hidup') === 'hidup' ? 'checked' : ''); ?>

                                            class="w-5 h-5 text-primary border-gray-300 focus:ring-primary cursor-pointer">
                                        <span class="text-gray-700">Masih Hidup</span>
                                    </label>
                                    <label class="flex items-center gap-2 cursor-pointer">
                                        <input type="radio" name="status_ayah" value="meninggal" 
                                            <?php echo e(old('status_ayah', $siswa->orangTua?->status_ayah) === 'meninggal' ? 'checked' : ''); ?>

                                            class="w-5 h-5 text-primary border-gray-300 focus:ring-primary cursor-pointer">
                                        <span class="text-gray-700">Meninggal</span>
                                    </label>
                                </div>
                                <?php $__errorArgs = ['status_ayah'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="mt-1.5 text-sm text-red-500"><?php echo e($message); ?></p>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <!-- Nama Ibu -->
                            <div>
                                <label for="nama_ibu" class="block text-sm font-semibold text-gray-700 mb-2">
                                    Nama Ibu <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                        </svg>
                                    </div>
                                    <input type="text" id="nama_ibu" name="nama_ibu" 
                                        value="<?php echo e(old('nama_ibu', $siswa->orangTua?->nama_ibu)); ?>"
                                        x-bind:required="jenis === 'orang_tua'"
                                        class="w-full pl-11 pr-4 py-3.5 bg-gray-50 border-2 border-gray-200 rounded-xl focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all <?php $__errorArgs = ['nama_ibu'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                </div>
                                <?php $__errorArgs = ['nama_ibu'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="mt-1.5 text-sm text-red-500"><?php echo e($message); ?></p>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <!-- NIK Ibu -->
                            <div>
                                <label for="nik_ibu" class="block text-sm font-semibold text-gray-700 mb-2">
                                    NIK Ibu <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"/>
                                        </svg>
                                    </div>
                                    <input type="text" id="nik_ibu" name="nik_ibu" maxlength="16"
                                        value="<?php echo e(old('nik_ibu', $siswa->orangTua?->nik_ibu)); ?>"
                                        placeholder="16 digit NIK"
                                        x-bind:required="jenis === 'orang_tua'"
                                        class="w-full pl-11 pr-4 py-3.5 bg-gray-50 border-2 border-gray-200 rounded-xl focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all <?php $__errorArgs = ['nik_ibu'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                </div>
                                <?php $__errorArgs = ['nik_ibu'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="mt-1.5 text-sm text-red-500"><?php echo e($message); ?></p>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <!-- Status Ibu -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-3">
                                    Status Ibu <span class="text-red-500">*</span>
                                </label>
                                <div class="flex gap-6">
                                    <label class="flex items-center gap-2 cursor-pointer">
                                        <input type="radio" name="status_ibu" value="hidup" 
                                            <?php echo e(old('status_ibu', $siswa->orangTua?->status_ibu ?? 'hidup') === 'hidup' ? 'checked' : ''); ?>

                                            class="w-5 h-5 text-primary border-gray-300 focus:ring-primary cursor-pointer">
                                        <span class="text-gray-700">Masih Hidup</span>
                                    </label>
                                    <label class="flex items-center gap-2 cursor-pointer">
                                        <input type="radio" name="status_ibu" value="meninggal" 
                                            <?php echo e(old('status_ibu', $siswa->orangTua?->status_ibu) === 'meninggal' ? 'checked' : ''); ?>

                                            class="w-5 h-5 text-primary border-gray-300 focus:ring-primary cursor-pointer">
                                        <span class="text-gray-700">Meninggal</span>
                                    </label>
                                </div>
                                <?php $__errorArgs = ['status_ibu'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="mt-1.5 text-sm text-red-500"><?php echo e($message); ?></p>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <!-- Pekerjaan Ayah -->
                            <div>
                                <label for="pekerjaan_ayah" class="block text-sm font-semibold text-gray-700 mb-2">
                                    Pekerjaan Ayah <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                    <input type="text" id="pekerjaan_ayah" name="pekerjaan_ayah" 
                                        value="<?php echo e(old('pekerjaan_ayah', $siswa->orangTua?->pekerjaan_ayah)); ?>"
                                        placeholder="Contoh: Wiraswasta, PNS, Petani"
                                        x-bind:required="jenis === 'orang_tua'"
                                        class="w-full pl-11 pr-4 py-3.5 bg-gray-50 border-2 border-gray-200 rounded-xl focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all <?php $__errorArgs = ['pekerjaan_ayah'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                </div>
                                <?php $__errorArgs = ['pekerjaan_ayah'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="mt-1.5 text-sm text-red-500"><?php echo e($message); ?></p>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <!-- Pekerjaan Ibu -->
                            <div>
                                <label for="pekerjaan_ibu" class="block text-sm font-semibold text-gray-700 mb-2">
                                    Pekerjaan Ibu <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                    <input type="text" id="pekerjaan_ibu" name="pekerjaan_ibu" 
                                        value="<?php echo e(old('pekerjaan_ibu', $siswa->orangTua?->pekerjaan_ibu)); ?>"
                                        placeholder="Contoh: Ibu Rumah Tangga, Guru, Wiraswasta"
                                        x-bind:required="jenis === 'orang_tua'"
                                        class="w-full pl-11 pr-4 py-3.5 bg-gray-50 border-2 border-gray-200 rounded-xl focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all <?php $__errorArgs = ['pekerjaan_ibu'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                </div>
                                <?php $__errorArgs = ['pekerjaan_ibu'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="mt-1.5 text-sm text-red-500"><?php echo e($message); ?></p>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <!-- No WA Ortu -->
                            <div x-data="{
                                noWaOrtu: '<?php echo e(old('no_wa_ortu', $siswa->orangTua?->no_wa_ortu)); ?>',
                                isValid: null,
                                formatWA(value) {
                                    let cleaned = value.replace(/\D/g, '');
                                    if (cleaned.startsWith('0')) {
                                        cleaned = '62' + cleaned.substring(1);
                                    } else if (cleaned.startsWith('8')) {
                                        cleaned = '62' + cleaned;
                                    }
                                    return cleaned;
                                },
                                validateWA(value) {
                                    const formatted = this.formatWA(value);
                                    this.noWaOrtu = formatted;
                                    const regex = /^62[0-9]{9,12}$/;
                                    this.isValid = regex.test(formatted);
                                }
                            }">
                                <label for="no_wa_ortu" class="block text-sm font-semibold text-gray-700 mb-2">
                                    No. WhatsApp Orang Tua <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                        </svg>
                                    </div>
                                    <input type="tel" id="no_wa_ortu" name="no_wa_ortu" 
                                        x-model="noWaOrtu"
                                        @input="validateWA($event.target.value)"
                                        @blur="validateWA($event.target.value)"
                                        placeholder="6281234567890"
                                        x-bind:required="jenis === 'orang_tua'"
                                        :class="{
                                            'w-full pl-11 pr-10 py-3.5 bg-gray-50 border-2 rounded-xl focus:bg-white focus:ring-4 transition-all': true,
                                            'border-gray-200 focus:border-primary focus:ring-primary/10': isValid === null,
                                            'border-emerald-500 focus:border-emerald-500 focus:ring-emerald-500/10 bg-emerald-50': isValid === true,
                                            'border-red-500 focus:border-red-500 focus:ring-red-500/10 bg-red-50': isValid === false
                                        }">
                                    <!-- Icon Valid/Invalid -->
                                    <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                                        <svg x-show="isValid === true" class="h-5 w-5 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                        </svg>
                                        <svg x-show="isValid === false" class="h-5 w-5 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                        </svg>
                                    </div>
                                </div>
                                <p class="mt-1.5 text-xs" :class="{
                                    'text-gray-500': isValid === null,
                                    'text-emerald-600': isValid === true,
                                    'text-red-600': isValid === false
                                }">
                                    <span x-text="isValid === false ? 'Format salah. Contoh: 628123456789' : 'Format: 62xxxxxxxxxx (11-14 digit)'"></span>
                                </p>
                            </div>
                        </div>

                        <!-- Form Wali -->
                        <div x-show="jenis === 'wali'" x-cloak class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Nama Wali -->
                            <div>
                                <label for="nama_wali" class="block text-sm font-semibold text-gray-700 mb-2">
                                    Nama Wali <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                        </svg>
                                    </div>
                                    <input type="text" id="nama_wali" name="nama_wali" 
                                        value="<?php echo e(old('nama_wali', $siswa->orangTua?->nama_wali)); ?>"
                                        x-bind:required="jenis === 'wali'"
                                        class="w-full pl-11 pr-4 py-3.5 bg-gray-50 border-2 border-gray-200 rounded-xl focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all <?php $__errorArgs = ['nama_wali'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                </div>
                                <?php $__errorArgs = ['nama_wali'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="mt-1.5 text-sm text-red-500"><?php echo e($message); ?></p>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <!-- Pekerjaan Wali -->
                            <div>
                                <label for="pekerjaan_wali" class="block text-sm font-semibold text-gray-700 mb-2">
                                    Pekerjaan Wali <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                    <input type="text" id="pekerjaan_wali" name="pekerjaan_wali" 
                                        value="<?php echo e(old('pekerjaan_wali', $siswa->orangTua?->pekerjaan_wali)); ?>"
                                        placeholder="Contoh: Wiraswasta, PNS, Petani"
                                        x-bind:required="jenis === 'wali'"
                                        class="w-full pl-11 pr-4 py-3.5 bg-gray-50 border-2 border-gray-200 rounded-xl focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all <?php $__errorArgs = ['pekerjaan_wali'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                </div>
                                <?php $__errorArgs = ['pekerjaan_wali'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="mt-1.5 text-sm text-red-500"><?php echo e($message); ?></p>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <!-- No HP Wali -->
                            <div x-data="{
                                noHpWali: '<?php echo e(old('no_hp_wali', $siswa->orangTua?->no_hp_wali)); ?>',
                                isValid: null,
                                formatWA(value) {
                                    let cleaned = value.replace(/\D/g, '');
                                    if (cleaned.startsWith('0')) {
                                        cleaned = '62' + cleaned.substring(1);
                                    } else if (cleaned.startsWith('8')) {
                                        cleaned = '62' + cleaned;
                                    }
                                    return cleaned;
                                },
                                validateWA(value) {
                                    const formatted = this.formatWA(value);
                                    this.noHpWali = formatted;
                                    const regex = /^62[0-9]{9,12}$/;
                                    this.isValid = regex.test(formatted);
                                }
                            }">
                                <label for="no_hp_wali" class="block text-sm font-semibold text-gray-700 mb-2">
                                    No. HP Wali <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                        </svg>
                                    </div>
                                    <input type="tel" id="no_hp_wali" name="no_hp_wali" 
                                        x-model="noHpWali"
                                        @input="validateWA($event.target.value)"
                                        @blur="validateWA($event.target.value)"
                                        placeholder="6281234567890"
                                        x-bind:required="jenis === 'wali'"
                                        :class="{
                                            'w-full pl-11 pr-10 py-3.5 bg-gray-50 border-2 rounded-xl focus:bg-white focus:ring-4 transition-all': true,
                                            'border-gray-200 focus:border-primary focus:ring-primary/10': isValid === null,
                                            'border-emerald-500 focus:border-emerald-500 focus:ring-emerald-500/10 bg-emerald-50': isValid === true,
                                            'border-red-500 focus:border-red-500 focus:ring-red-500/10 bg-red-50': isValid === false
                                        }">
                                    <!-- Icon Valid/Invalid -->
                                    <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                                        <svg x-show="isValid === true" class="h-5 w-5 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                        </svg>
                                        <svg x-show="isValid === false" class="h-5 w-5 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                        </svg>
                                    </div>
                                </div>
                                <p class="mt-1.5 text-xs" :class="{
                                    'text-gray-500': isValid === null,
                                    'text-emerald-600': isValid === true,
                                    'text-red-600': isValid === false
                                }">
                                    <span x-text="isValid === false ? 'Format salah. Contoh: 628123456789' : 'Format: 62xxxxxxxxxx (11-14 digit)'"></span>
                                </p>
                            </div>

                            <!-- Hubungan dengan Wali -->
                            <div>
                                <label for="hubungan_wali" class="block text-sm font-semibold text-gray-700 mb-2">
                                    Hubungan dengan Wali <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                        </svg>
                                    </div>
                                    <input type="text" id="hubungan_wali" name="hubungan_wali" 
                                        value="<?php echo e(old('hubungan_wali', $siswa->orangTua?->hubungan_wali)); ?>"
                                        placeholder="Contoh: Paman, Bibi, Kakek, Nenek"
                                        x-bind:required="jenis === 'wali'"
                                        class="w-full pl-11 pr-4 py-3.5 bg-gray-50 border-2 border-gray-200 rounded-xl focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all <?php $__errorArgs = ['hubungan_wali'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                </div>
                                <?php $__errorArgs = ['hubungan_wali'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="mt-1.5 text-sm text-red-500"><?php echo e($message); ?></p>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Navigation Buttons -->
                <div class="flex justify-between gap-4">
                    <button type="button" @click="prevStep()" 
                        class="px-6 py-3 border-2 border-gray-200 text-gray-700 rounded-xl font-semibold hover:bg-gray-50 hover:border-gray-300 transition flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        Kembali
                    </button>
                    <div class="flex gap-4">
                        <a href="<?php echo e(route('spmb.dashboard')); ?>" 
                            class="px-6 py-3 border-2 border-gray-200 text-gray-700 rounded-xl font-semibold hover:bg-gray-50 hover:border-gray-300 transition">
                            Batal
                        </a>
                        <button type="submit" 
                            class="px-6 py-3 bg-gradient-to-r from-primary to-blue-600 text-white rounded-xl font-semibold hover:shadow-lg hover:shadow-primary/30 transition flex items-center gap-2 disabled:opacity-70"
                            :disabled="isLoading">
                            <svg x-show="isLoading" class="w-5 h-5 animate-spin" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            <span x-text="isLoading ? 'Menyimpan...' : 'Simpan Data'"></span>
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>


<div id="autosave-toast" class="fixed bottom-4 right-4 z-50 transform translate-y-20 opacity-0 transition-all duration-300" style="display: none;">
    <div class="bg-gray-800 text-white px-4 py-3 rounded-xl shadow-lg flex items-center gap-3">
        <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
        </svg>
        <div>
            <p class="text-sm font-medium">Data tersimpan otomatis</p>
            <p class="text-xs text-gray-400" id="autosave-time">Terakhir disimpan: -</p>
        </div>
    </div>
</div>


<div id="restore-modal" class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm" style="display: none;">
    <div class="bg-white rounded-2xl p-6 max-w-md mx-4 shadow-2xl">
        <div class="flex items-center gap-3 mb-4">
            <div class="w-12 h-12 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <div>
                <h3 class="text-lg font-bold text-gray-900">Pulihkan Data?</h3>
                <p class="text-sm text-gray-500">Ada data yang belum tersimpan</p>
            </div>
        </div>
        <p class="text-gray-600 mb-6">Kami menemukan data formulir yang tersimpan secara otomatis. Apakah Anda ingin memulihkan data tersebut?</p>
        <div class="flex gap-3">
            <button onclick="clearSavedData()" class="flex-1 px-4 py-2 border border-gray-200 text-gray-700 rounded-xl font-medium hover:bg-gray-50 transition">
                Hapus Data
            </button>
            <button onclick="restoreFormData()" class="flex-1 px-4 py-2 bg-primary text-white rounded-xl font-medium hover:bg-primary/90 transition">
                Pulihkan
            </button>
        </div>
    </div>
</div>

<?php $__env->startPush('scripts'); ?>
<script>
(function() {
    'use strict';
    
    const STORAGE_KEY = 'spmb_form_data_lengkapi';
    const TIMESTAMP_KEY = 'spmb_form_timestamp';
    const SAVE_INTERVAL = 5000; // 5 detik
    
    const form = document.querySelector('form');
    const toast = document.getElementById('autosave-toast');
    const toastTime = document.getElementById('autosave-time');
    const restoreModal = document.getElementById('restore-modal');
    
    // Fungsi untuk mengumpulkan data form
    function collectFormData() {
        const formData = new FormData(form);
        const data = {};
        
        // Simpan semua input text, textarea, select
        form.querySelectorAll('input[type="text"], input[type="email"], input[type="tel"], textarea, select').forEach(input => {
            if (input.name && !input.name.startsWith('_')) {
                data[input.name] = input.value;
            }
        });
        
        // Simpan radio buttons
        form.querySelectorAll('input[type="radio"]:checked').forEach(radio => {
            if (radio.name) {
                data[radio.name] = radio.value;
            }
        });
        
        // Simpan checkbox
        form.querySelectorAll('input[type="checkbox"]').forEach(checkbox => {
            if (checkbox.name) {
                data[checkbox.name] = checkbox.checked;
            }
        });
        
        // Simpan step yang aktif
        const stepElement = document.querySelector('[x-data]');
        if (stepElement) {
            const alpineData = Alpine.getData(stepElement);
            if (alpineData && alpineData.step) {
                data._currentStep = alpineData.step;
            }
        }
        
        return data;
    }
    
    // Fungsi untuk menyimpan ke localStorage
    function saveToLocalStorage() {
        const data = collectFormData();
        localStorage.setItem(STORAGE_KEY, JSON.stringify(data));
        localStorage.setItem(TIMESTAMP_KEY, new Date().toISOString());
        showToast();
    }
    
    // Fungsi untuk menampilkan toast
    function showToast() {
        const now = new Date();
        const timeStr = now.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit', second: '2-digit' });
        toastTime.textContent = 'Terakhir disimpan: ' + timeStr;
        
        toast.style.display = 'block';
        setTimeout(() => {
            toast.classList.remove('translate-y-20', 'opacity-0');
        }, 10);
        
        setTimeout(() => {
            toast.classList.add('translate-y-20', 'opacity-0');
            setTimeout(() => {
                toast.style.display = 'none';
            }, 300);
        }, 3000);
    }
    
    // Fungsi untuk memulihkan data form
    function restoreFormData() {
        const saved = localStorage.getItem(STORAGE_KEY);
        if (!saved) return;
        
        try {
            const data = JSON.parse(saved);
            
            // Restore text inputs, textareas, selects
            Object.keys(data).forEach(key => {
                if (key.startsWith('_')) return; // Skip metadata
                
                const input = form.querySelector(`[name="${key}"]`);
                if (input) {
                    if (input.type === 'radio') {
                        const radio = form.querySelector(`[name="${key}"][value="${data[key]}"]`);
                        if (radio) radio.checked = true;
                    } else if (input.type === 'checkbox') {
                        input.checked = data[key];
                    } else {
                        input.value = data[key];
                    }
                }
            });
            
            // Restore step
            if (data._currentStep) {
                const stepElement = document.querySelector('[x-data]');
                if (stepElement) {
                    const alpineData = Alpine.getData(stepElement);
                    if (alpineData && alpineData.step !== undefined) {
                        alpineData.step = parseInt(data._currentStep);
                    }
                }
            }
            
            // Trigger change events untuk Alpine.js
            form.querySelectorAll('input, select, textarea').forEach(el => {
                el.dispatchEvent(new Event('input', { bubbles: true }));
                el.dispatchEvent(new Event('change', { bubbles: true }));
            });
            
        } catch (e) {
            console.error('Error restoring form data:', e);
        }
        
        closeRestoreModal();
    }
    
    // Fungsi untuk menghapus data tersimpan
    function clearSavedData() {
        localStorage.removeItem(STORAGE_KEY);
        localStorage.removeItem(TIMESTAMP_KEY);
        closeRestoreModal();
    }
    
    // Fungsi untuk menutup modal
    function closeRestoreModal() {
        restoreModal.style.display = 'none';
    }
    
    // Fungsi untuk memeriksa data yang tersimpan
    function checkSavedData() {
        const saved = localStorage.getItem(STORAGE_KEY);
        const timestamp = localStorage.getItem(TIMESTAMP_KEY);
        
        if (saved && timestamp) {
            const savedTime = new Date(timestamp);
            const now = new Date();
            const hoursDiff = (now - savedTime) / (1000 * 60 * 60);
            
            // Tampilkan modal jika data kurang dari 24 jam
            if (hoursDiff < 24) {
                restoreModal.style.display = 'flex';
            } else {
                // Hapus data yang terlalu lama
                clearSavedData();
            }
        }
    }
    
    // Event listeners
    if (form) {
        // Auto-save setiap 5 detik
        setInterval(saveToLocalStorage, SAVE_INTERVAL);
        
        // Save saat input berubah (debounced)
        let debounceTimer;
        form.addEventListener('input', function() {
            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(saveToLocalStorage, 1000);
        });
        
        // Hapus localStorage saat form berhasil disubmit
        form.addEventListener('submit', function() {
            localStorage.removeItem(STORAGE_KEY);
            localStorage.removeItem(TIMESTAMP_KEY);
        });
    }
    
    // Periksa data tersimpan saat halaman dimuat
    document.addEventListener('DOMContentLoaded', function() {
        checkSavedData();
    });
    
    // Expose fungsi ke global scope untuk onclick handlers
    window.restoreFormData = restoreFormData;
    window.clearSavedData = clearSavedData;
})();
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\user\.gemini\antigravity\scratch\smkalstar\smkalstar\resources\views/spmb/lengkapi-data.blade.php ENDPATH**/ ?>