

<?php $__env->startSection('title', 'Login - SMK Al-Hidayah Lestari'); ?>

<?php ($hide_footer = true); ?>
<?php ($hide_bottom_nav = true); ?>

<?php $__env->startSection('content'); ?>
<div class="min-h-screen flex" x-data="{ 
    showRegPopup: <?php echo e(session('registration_success') ? 'true' : 'false'); ?>,
    showPassword: false,
    isLoading: false,
    focusedField: null
}">
    <!-- Left Side - Branding -->
    <div class="hidden lg:flex lg:w-1/2 xl:w-3/5 relative overflow-hidden">
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
        <div class="relative z-10 flex flex-col justify-center px-16 xl:px-24">
            <div class="mb-8">
                <div class="inline-flex items-center justify-center w-20 h-20 bg-white/20 backdrop-blur-sm rounded-2xl mb-6 ring-1 ring-white/30">
                    <img src="<?php echo e(asset('images/logo.webp')); ?>" alt="Logo" class="w-14 h-14 object-contain rounded-xl">
                </div>
                <h1 class="text-4xl xl:text-5xl font-bold text-white mb-4 leading-tight">
                    Selamat Datang<br>di <span class="text-cyan-300">SMK Al-Hidayah</span>
                </h1>
                <p class="text-white/80 text-lg max-w-md leading-relaxed">
                    Platform pendaftaran siswa baru yang modern dan terintegrasi. Mulai perjalanan pendidikanmu bersama kami.
                </p>
            </div>
            
            <!-- Feature List -->
            <div class="space-y-4 mt-4">
                <div class="flex items-center gap-4 text-white/90">
                    <div class="w-10 h-10 rounded-lg bg-white/20 backdrop-blur-sm flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <span>Pendaftaran Online 24/7</span>
                </div>
                <div class="flex items-center gap-4 text-white/90">
                    <div class="w-10 h-10 rounded-lg bg-white/20 backdrop-blur-sm flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                    </div>
                    <span>Data Terlindungi & Aman</span>
                </div>
                
            </div>
        </div>
        
        <!-- Bottom Text -->
        <div class="absolute bottom-8 left-16 xl:left-24 text-white/60 text-sm">
            © <?php echo e(date('Y')); ?> SMK Al-Hidayah Lestari. All rights reserved.
        </div>
    </div>

    <!-- Right Side - Form -->
    <div class="w-full lg:w-1/2 xl:w-2/5 flex items-center justify-center p-6 sm:p-8 lg:p-12 bg-gray-50/50">
        <div class="w-full max-w-md">
            <!-- Mobile Logo -->
            <div class="lg:hidden text-center mb-8">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-br from-primary to-blue-600 rounded-2xl shadow-lg mb-4">
                    <img src="<?php echo e(asset('images/logo.webp')); ?>" alt="Logo" class="w-11 h-11 object-contain rounded-lg">
                </div>
                <h1 class="text-2xl font-bold text-gray-900">SMK Al-Hidayah Lestari</h1>
            </div>

            <!-- Login Card -->
            <div class="bg-white rounded-3xl shadow-xl shadow-gray-200/50 border border-gray-100 p-8 sm:p-10">
                <div class="mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-2">Masuk ke Akun</h2>
                    <p class="text-gray-500">Silakan masukkan data login Anda</p>
                </div>

                <?php if(session('error')): ?>
                <div class="mb-6 p-4 bg-red-50 border border-red-100 rounded-xl flex items-start gap-3 animate-pulse">
                    <svg class="w-5 h-5 text-red-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <p class="text-red-700 text-sm"><?php echo e(session('error')); ?></p>
                </div>
                <?php endif; ?>

                <form action="<?php echo e(route('login.submit')); ?>" method="POST" @submit="isLoading = true" class="space-y-5">
                    <?php echo csrf_field(); ?>
                    
                    <!-- Nama Lengkap (readonly, dari register) -->
                    <?php if(session('registered_nama_lengkap')): ?>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Lengkap</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            </div>
                            <input 
                                type="text" 
                                value="<?php echo e(session('registered_nama_lengkap')); ?>"
                                readonly
                                class="w-full pl-11 pr-4 py-3.5 bg-sky-50 border-2 border-sky-200 rounded-xl text-sky-800 font-semibold"
                            >
                        </div>
                    </div>
                    <?php endif; ?>

                    <!-- NISN -->
                    <div>
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
                                value="<?php echo e(session('registered_nisn', old('nisn'))); ?>"
                                placeholder="Masukkan 10 digit NISN"
                                maxlength="10"
                                pattern="[0-9]{10}"
                                required
                                @focus="focusedField = 'nisn'"
                                @blur="focusedField = null"
                                class="w-full pl-11 pr-4 py-3.5 bg-gray-50 border-2 border-gray-200 rounded-xl focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all duration-200"
                            >
                        </div>
                        <?php $__errorArgs = ['nisn'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="mt-1.5 text-sm text-red-500 flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01"/></svg>
                            <?php echo e($message); ?>

                        </p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <!-- Password -->
                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <label for="password" class="block text-sm font-semibold text-gray-700">
                                Password <span class="text-red-500">*</span>
                            </label>
                        </div>
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
                                value="<?php echo e(session('registered_password', '')); ?>"
                                placeholder="Masukkan password"
                                required
                                @focus="focusedField = 'password'"
                                @blur="focusedField = null"
                                class="w-full pl-11 pr-12 py-3.5 bg-gray-50 border-2 border-gray-200 rounded-xl focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all duration-200"
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
                        <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="mt-1.5 text-sm text-red-500 flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01"/></svg>
                            <?php echo e($message); ?>

                        </p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center justify-between">
                        <label class="flex items-center gap-2 cursor-pointer group">
                            <input type="checkbox" name="remember" id="remember" class="w-4 h-4 rounded-lg border-2 border-gray-300 text-primary focus:ring-primary focus:ring-offset-0 cursor-pointer">
                            <span class="text-sm text-gray-600 group-hover:text-gray-800 transition">Ingat saya</span>
                        </label>
                    </div>

                    <!-- Submit Button -->
                    <button 
                        type="submit" 
                        class="w-full flex items-center justify-center gap-2 bg-gradient-to-r from-primary to-blue-600 text-white px-6 py-4 rounded-xl font-semibold hover:shadow-lg hover:shadow-primary/30 hover:-translate-y-0.5 transition-all duration-200 disabled:opacity-70 disabled:hover:translate-y-0"
                        :disabled="isLoading"
                    >
                        <svg x-show="isLoading" class="w-5 h-5 animate-spin" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        <span x-text="isLoading ? 'Memuat...' : 'Masuk'"></span>
                        <svg x-show="!isLoading" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                        </svg>
                    </button>
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

                <!-- Register Link -->
                <p class="text-center text-gray-600">
                    Belum punya akun?
                    <a href="<?php echo e(route('register')); ?>" class="text-primary font-bold hover:text-primary-dark transition ml-1 inline-flex items-center gap-1 group">
                        Daftar Sekarang
                        <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </a>
                </p>
            </div>
            
            
        </div>
    </div>

    <!-- Success Modal -->
    <div 
        x-show="showRegPopup" 
        x-cloak 
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95"
        class="fixed inset-0 z-50 flex items-center justify-center p-4"
    >
        <div class="absolute inset-0 bg-black/60 backdrop-blur-sm" @click="showRegPopup = false"></div>
        <div class="relative bg-white rounded-3xl shadow-2xl p-8 max-w-sm w-full text-center overflow-hidden">
            <!-- Confetti Effect Background -->
            <div class="absolute inset-0 overflow-hidden pointer-events-none">
                <div class="absolute top-0 left-1/4 w-2 h-2 bg-yellow-400 rounded-full animate-ping"></div>
                <div class="absolute top-10 right-1/4 w-3 h-3 bg-pink-400 rounded-full animate-pulse"></div>
                <div class="absolute bottom-10 left-10 w-2 h-2 bg-blue-400 rounded-full animate-bounce"></div>
            </div>
            
            <div class="relative">
                <div class="w-20 h-20 bg-gradient-to-br from-green-400 to-emerald-500 rounded-full flex items-center justify-center mx-auto mb-6 shadow-lg shadow-green-500/30">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-2">Pendaftaran Berhasil!</h3>
                <p class="text-gray-600 mb-2">Selamat datang, <strong class="text-primary"><?php echo e(session('registered_nama_lengkap')); ?></strong>!</p>
                <p class="text-gray-500 text-sm mb-8">Akun Anda telah dibuat. Data login sudah terisi otomatis.</p>
                <button 
                    @click="showRegPopup = false" 
                    class="w-full bg-gradient-to-r from-primary to-blue-600 text-white px-6 py-3.5 rounded-xl font-semibold hover:shadow-lg hover:shadow-primary/30 transition-all duration-200"
                >
                    Mengerti
                </button>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\eka\.gemini\antigravity\scratch\smk-alstar\resources\views/auth/login.blade.php ENDPATH**/ ?>