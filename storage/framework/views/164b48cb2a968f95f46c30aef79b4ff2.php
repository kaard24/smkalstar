<?php $__env->startSection('title', 'Daftar - SMK Al-Hidayah Lestari'); ?>

<?php ($hide_footer = true); ?>
<?php ($hide_bottom_nav = true); ?>

<?php $__env->startSection('content'); ?>
<div class="min-h-screen flex" x-data="{
    showPassword: false,
    showConfirmPassword: false,
    isLoading: false,
    step: 1,
    totalSteps: 2,
    formData: {
        nisn: '<?php echo e(old('nisn')); ?>',
        nama_lengkap: '<?php echo e(old('nama_lengkap')); ?>',
        jurusan_id: '<?php echo e(old('jurusan_id')); ?>',
        tempat_lahir: '<?php echo e(old('tempat_lahir')); ?>',
        tgl_lahir: '<?php echo e(old('tgl_lahir')); ?>',
        asal_sekolah: '<?php echo e(old('asal_sekolah')); ?>',
        no_wa: '<?php echo e(old('no_wa')); ?>'
    },
    nextStep() {
        if (this.step < this.totalSteps) this.step++
    },
    prevStep() {
        if (this.step > 1) this.step--
    }
}">
    <!-- Left Side - Branding -->
    <div class="hidden lg:flex lg:w-2/5 xl:w-1/3 relative overflow-hidden">
        <!-- Gradient Background -->
        <div class="absolute inset-0 bg-gradient-to-br from-primary via-blue-600 to-indigo-700"></div>
        
        <!-- Animated Shapes -->
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute -top-40 -right-40 w-96 h-96 bg-white/10 rounded-full blur-3xl animate-pulse"></div>
            <div class="absolute top-1/2 -left-20 w-72 h-72 bg-cyan-400/20 rounded-full blur-3xl"></div>
            <div class="absolute -bottom-20 right-1/4 w-80 h-80 bg-purple-500/20 rounded-full blur-3xl"></div>
        </div>
        
        <!-- Pattern Overlay -->
        <div class="absolute inset-0 opacity-10" style="background-image: url('data:image/svg+xml,%3Csvg width=&quot;60&quot; height=&quot;60&quot; viewBox=&quot;0 0 60 60&quot; xmlns=&quot;http://www.w3.org/2000/svg&quot;%3E%3Cg fill=&quot;none&quot; fill-rule=&quot;evenodd&quot;%3E%3Cg fill=&quot;%23ffffff&quot; fill-opacity=&quot;1&quot;%3E%3Cpath d=&quot;M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z&quot;/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
        
        <!-- Content -->
        <div class="relative z-10 flex flex-col justify-center px-12 xl:px-16">
            <div class="mb-8">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-white/20 backdrop-blur-sm rounded-xl mb-6 ring-1 ring-white/30">
                    <img src="<?php echo e(asset('images/logo.webp')); ?>" alt="Logo" class="w-11 h-11 object-contain rounded-lg">
                </div>
                <h1 class="text-3xl xl:text-4xl font-bold text-white mb-4 leading-tight">
                    Bergabung<br>Bersama <span class="text-cyan-300">Kami</span>
                </h1>
                <p class="text-white/80 leading-relaxed">
                    Daftarkan dirimu sekarang dan mulai perjalanan menuju masa depan yang cerah.
                </p>
            </div>
            
            <!-- Progress Steps -->
            <div class="mt-8 space-y-4">
                <div class="flex items-center gap-4" :class="step >= 1 ? 'opacity-100' : 'opacity-50'">
                    <div class="w-10 h-10 rounded-full flex items-center justify-center font-bold transition-all duration-300" 
                         :class="step >= 1 ? 'bg-white text-primary' : 'bg-white/30 text-white'">1</div>
                    <div>
                        <p class="text-white font-semibold">Data Pribadi</p>
                        <p class="text-white/60 text-sm">Informasi dasar siswa</p>
                    </div>
                </div>
                <div class="flex items-center gap-4" :class="step >= 2 ? 'opacity-100' : 'opacity-50'">
                    <div class="w-10 h-10 rounded-full flex items-center justify-center font-bold transition-all duration-300" 
                         :class="step >= 2 ? 'bg-white text-primary' : 'bg-white/30 text-white'">2</div>
                    <div>
                        <p class="text-white font-semibold">Akun & Kontak</p>
                        <p class="text-white/60 text-sm">Password dan WhatsApp</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Bottom Text -->
        <div class="absolute bottom-8 left-12 xl:left-16 text-white/60 text-sm">
            © <?php echo e(date('Y')); ?> SMK Al-Hidayah Lestari
        </div>
    </div>

    <!-- Right Side - Form -->
    <div class="w-full lg:w-3/5 xl:w-2/3 flex items-center justify-center p-6 sm:p-8 lg:p-12 bg-gray-50/50">
        <div class="w-full max-w-2xl">
            <!-- Mobile Logo -->
            <div class="lg:hidden text-center mb-6">
                <div class="inline-flex items-center justify-center w-14 h-14 bg-gradient-to-br from-primary to-blue-600 rounded-xl shadow-lg mb-3">
                    <img src="<?php echo e(asset('images/logo.webp')); ?>" alt="Logo" class="w-10 h-10 object-contain rounded-lg">
                </div>
                <h1 class="text-xl font-bold text-gray-900">SMK Al-Hidayah Lestari</h1>
            </div>

            <!-- Register Card -->
            <div class="bg-white rounded-3xl shadow-xl shadow-gray-200/50 border border-gray-100 p-8 sm:p-10">
                <div class="mb-8">
                    <div class="flex items-center justify-between mb-2">
                        <h2 class="text-2xl font-bold text-gray-900">Buat Akun Baru</h2>
                        <span class="text-sm text-gray-500 bg-gray-100 px-3 py-1 rounded-full">Langkah <span x-text="step"></span> dari <span x-text="totalSteps"></span></span>
                    </div>
                    <p class="text-gray-500">Lengkapi data Anda dengan benar</p>
                </div>

                <?php if(session('error')): ?>
                <div class="mb-6 p-4 bg-red-50 border border-red-100 rounded-xl flex items-start gap-3">
                    <svg class="w-5 h-5 text-red-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <p class="text-red-700 text-sm"><?php echo e(session('error')); ?></p>
                </div>
                <?php endif; ?>

                <?php if($errors->any()): ?>
                <div class="mb-6 p-4 bg-red-50 border border-red-100 rounded-xl">
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

                <form action="<?php echo e(route('register.submit')); ?>" method="POST" @submit="isLoading = true">
                    <?php echo csrf_field(); ?>
                    
                    <!-- Step 1: Data Pribadi -->
                    <div x-show="step === 1" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-x-4" x-transition:enter-end="opacity-100 translate-x-0">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <!-- NISN -->
                            <div class="md:col-span-2">
                                <label for="nisn" class="block text-sm font-semibold text-gray-700 mb-2">
                                    NISN <span class="text-red-500">*</span>
                                </label>
                                <div class="relative group">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400 group-focus-within:text-primary transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"/>
                                        </svg>
                                    </div>
                                    <input 
                                        type="text" 
                                        id="nisn" 
                                        name="nisn"
                                        x-model="formData.nisn"
                                        placeholder="Masukkan 10 digit NISN"
                                        maxlength="10"
                                        pattern="[0-9]{10}"
                                        required
                                        class="w-full pl-11 pr-4 py-3.5 bg-gray-50 border-2 border-gray-200 rounded-xl focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all"
                                    >
                                </div>
                            </div>

                            <!-- Nama Lengkap -->
                            <div class="md:col-span-2">
                                <label for="nama_lengkap" class="block text-sm font-semibold text-gray-700 mb-2">
                                    Nama Lengkap <span class="text-red-500">*</span>
                                </label>
                                <div class="relative group">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400 group-focus-within:text-primary transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                        </svg>
                                    </div>
                                    <input 
                                        type="text" 
                                        id="nama_lengkap" 
                                        name="nama_lengkap"
                                        x-model="formData.nama_lengkap"
                                        placeholder="Nama lengkap sesuai ijazah"
                                        minlength="3"
                                        required
                                        class="w-full pl-11 pr-4 py-3.5 bg-gray-50 border-2 border-gray-200 rounded-xl focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all"
                                    >
                                </div>
                            </div>

                            <!-- Jurusan -->
                            <div class="md:col-span-2">
                                <label for="jurusan_id" class="block text-sm font-semibold text-gray-700 mb-2">
                                    Pilihan Jurusan <span class="text-red-500">*</span>
                                </label>
                                <div class="relative group">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400 group-focus-within:text-primary transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                        </svg>
                                    </div>
                                    <select 
                                        id="jurusan_id" 
                                        name="jurusan_id"
                                        x-model="formData.jurusan_id"
                                        required
                                        class="w-full pl-11 pr-10 py-3.5 bg-gray-50 border-2 border-gray-200 rounded-xl focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all appearance-none cursor-pointer"
                                    >
                                        <option value="">-- Pilih Jurusan --</option>
                                        <?php $__currentLoopData = $jurusan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $j): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($j->id); ?>"><?php echo e($j->nama); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            <!-- Tempat Lahir -->
                            <div>
                                <label for="tempat_lahir" class="block text-sm font-semibold text-gray-700 mb-2">
                                    Tempat Lahir <span class="text-red-500">*</span>
                                </label>
                                <div class="relative group">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400 group-focus-within:text-primary transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        </svg>
                                    </div>
                                    <input 
                                        type="text" 
                                        id="tempat_lahir" 
                                        name="tempat_lahir"
                                        x-model="formData.tempat_lahir"
                                        placeholder="Kota kelahiran"
                                        required
                                        class="w-full pl-11 pr-4 py-3.5 bg-gray-50 border-2 border-gray-200 rounded-xl focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all"
                                    >
                                </div>
                            </div>

                            <!-- Tanggal Lahir -->
                            <div>
                                <label for="tgl_lahir" class="block text-sm font-semibold text-gray-700 mb-2">
                                    Tanggal Lahir <span class="text-red-500">*</span>
                                </label>
                                <div class="relative group">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400 group-focus-within:text-primary transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                    <input 
                                        type="date" 
                                        id="tgl_lahir" 
                                        name="tgl_lahir"
                                        x-model="formData.tgl_lahir"
                                        required
                                        class="w-full pl-11 pr-4 py-3.5 bg-gray-50 border-2 border-gray-200 rounded-xl focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all"
                                    >
                                </div>
                            </div>

                            <!-- Asal Sekolah -->
                            <div class="md:col-span-2">
                                <label for="asal_sekolah" class="block text-sm font-semibold text-gray-700 mb-2">
                                    Asal Sekolah (SMP/MTs) <span class="text-red-500">*</span>
                                </label>
                                <div class="relative group">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400 group-focus-within:text-primary transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                        </svg>
                                    </div>
                                    <input 
                                        type="text" 
                                        id="asal_sekolah" 
                                        name="asal_sekolah"
                                        x-model="formData.asal_sekolah"
                                        placeholder="Contoh: SMPN 1 Jakarta"
                                        required
                                        class="w-full pl-11 pr-4 py-3.5 bg-gray-50 border-2 border-gray-200 rounded-xl focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all"
                                    >
                                </div>
                            </div>
                        </div>

                        <!-- Next Button -->
                        <button 
                            type="button"
                            @click="nextStep()"
                            class="w-full mt-6 flex items-center justify-center gap-2 bg-gradient-to-r from-primary to-blue-600 text-white px-6 py-4 rounded-xl font-semibold hover:shadow-lg hover:shadow-primary/30 hover:-translate-y-0.5 transition-all duration-200"
                        >
                            Lanjutkan
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                            </svg>
                        </button>
                    </div>

                    <!-- Step 2: Akun & Kontak -->
                    <div x-show="step === 2" x-cloak x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-x-4" x-transition:enter-end="opacity-100 translate-x-0">
                        <div class="space-y-5">
                            <!-- No WhatsApp -->
                            <div x-data="{ 
                                noWa: '<?php echo e(old('no_wa')); ?>',
                                isValid: null,
                                formatWA(value) {
                                    // Hapus semua karakter non-digit
                                    let cleaned = value.replace(/\D/g, '');
                                    
                                    // Auto-format: jika diawali dengan 0, ganti dengan 62
                                    if (cleaned.startsWith('0')) {
                                        cleaned = '62' + cleaned.substring(1);
                                    }
                                    // Jika diawali dengan 8, tambahkan 62 di depan
                                    else if (cleaned.startsWith('8')) {
                                        cleaned = '62' + cleaned;
                                    }
                                    
                                    return cleaned;
                                },
                                validateWA(value) {
                                    const formatted = this.formatWA(value);
                                    this.noWa = formatted;
                                    // Validasi: harus diawali 62 dan panjang 10-14 digit setelah 62
                                    const regex = /^62[0-9]{9,12}$/;
                                    this.isValid = regex.test(formatted);
                                }
                            }">
                                <label for="no_wa" class="block text-sm font-semibold text-gray-700 mb-2">
                                    Nomor WhatsApp <span class="text-red-500">*</span>
                                </label>
                                <div class="relative group">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400 group-focus-within:text-primary transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                        </svg>
                                    </div>
                                    <input 
                                        type="tel" 
                                        id="no_wa" 
                                        name="no_wa"
                                        x-model="noWa"
                                        @input="validateWA($event.target.value)"
                                        @blur="validateWA($event.target.value)"
                                        placeholder="6281234567890"
                                        minlength="11"
                                        maxlength="14"
                                        required
                                        :class="{
                                            'w-full pl-11 pr-10 py-3.5 bg-gray-50 border-2 rounded-xl focus:bg-white focus:ring-4 transition-all': true,
                                            'border-gray-200 focus:border-primary focus:ring-primary/10': isValid === null,
                                            'border-emerald-500 focus:border-emerald-500 focus:ring-emerald-500/10 bg-emerald-50': isValid === true,
                                            'border-red-500 focus:border-red-500 focus:ring-red-500/10 bg-red-50': isValid === false
                                        }"
                                    >
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
                                <p class="mt-1.5 text-xs flex items-center gap-1" :class="{
                                    'text-gray-500': isValid === null,
                                    'text-emerald-600': isValid === true,
                                    'text-red-600': isValid === false
                                }">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    <span x-text="isValid === false ? 'Format salah. Contoh: 628123456789' : 'Format: diawali 62 (min 11 digit, max 14 digit)'"></span>
                                </p>
                            </div>

                            <!-- Password -->
                            <div>
                                <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">
                                    Password <span class="text-red-500">*</span>
                                </label>
                                <div class="relative group">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400 group-focus-within:text-primary transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                        </svg>
                                    </div>
                                    <input 
                                        :type="showPassword ? 'text' : 'password'" 
                                        id="password" 
                                        name="password" 
                                        value="<?php echo e(old('password', session('password', ''))); ?>"
                                        placeholder="Minimal 8 karakter"
                                        minlength="8"
                                        required
                                        class="w-full pl-11 pr-12 py-3.5 bg-gray-50 border-2 border-gray-200 rounded-xl focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all"
                                    >
                                    <button 
                                        type="button" 
                                        @click="showPassword = !showPassword" 
                                        class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 transition p-1 rounded-lg hover:bg-gray-100"
                                    >
                                        <svg x-show="!showPassword" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                        <svg x-show="showPassword" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display: none;">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            <!-- Confirm Password -->
                            <div>
                                <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-2">
                                    Konfirmasi Password <span class="text-red-500">*</span>
                                </label>
                                <div class="relative group">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400 group-focus-within:text-primary transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                    </div>
                                    <input 
                                        :type="showConfirmPassword ? 'text' : 'password'" 
                                        id="password_confirmation" 
                                        name="password_confirmation" 
                                        value="<?php echo e(old('password_confirmation', session('password_confirmation', ''))); ?>"
                                        placeholder="Ulangi password"
                                        required
                                        class="w-full pl-11 pr-12 py-3.5 bg-gray-50 border-2 border-gray-200 rounded-xl focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all"
                                    >
                                    <button 
                                        type="button" 
                                        @click="showConfirmPassword = !showConfirmPassword" 
                                        class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 transition p-1 rounded-lg hover:bg-gray-100"
                                    >
                                        <svg x-show="!showConfirmPassword" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                        <svg x-show="showConfirmPassword" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display: none;">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Buttons -->
                        <div class="flex gap-3 mt-6">
                            <button 
                                type="button"
                                @click="prevStep()"
                                class="flex-shrink-0 flex items-center justify-center gap-2 px-6 py-4 border-2 border-gray-200 text-gray-700 rounded-xl font-semibold hover:bg-gray-50 hover:border-gray-300 transition-all duration-200"
                            >
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                                </svg>
                            </button>
                            <button 
                                type="submit" 
                                class="flex-1 flex items-center justify-center gap-2 bg-gradient-to-r from-primary to-blue-600 text-white px-6 py-4 rounded-xl font-semibold hover:shadow-lg hover:shadow-primary/30 hover:-translate-y-0.5 transition-all duration-200 disabled:opacity-70 disabled:hover:translate-y-0"
                                :disabled="isLoading"
                            >
                                <svg x-show="isLoading" class="w-5 h-5 animate-spin" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                <span x-text="isLoading ? 'Mendaftar...' : 'Daftar Sekarang'"></span>
                                <svg x-show="!isLoading" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </form>

                <!-- Divider -->
                <div class="relative my-8">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-200"></div>
                    </div>
                    <div class="relative flex justify-center">
                        <span class="px-4 bg-white text-sm text-gray-400">atau</span>
                    </div>
                </div>

                <!-- Login Link -->
                <p class="text-center text-gray-600">
                    Sudah punya akun?
                    <a href="<?php echo e(route('login')); ?>" class="text-primary font-bold hover:text-primary-dark transition ml-1 inline-flex items-center gap-1 group">
                        Masuk di sini
                        <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </a>
                </p>
            </div>
            
            
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\user\.gemini\antigravity\scratch\smkalstar\smkalstar\resources\views/auth/register.blade.php ENDPATH**/ ?>