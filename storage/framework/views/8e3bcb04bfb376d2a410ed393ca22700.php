<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - SMK Al-Hidayah Lestari</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        /* Set B: Modern Enterprise Palette */
                        primary: '#4276A3',       // Steel Blue - satu accent
                        'primary-dark': '#365f85',
                        slate: {
                            50: '#F8FAFC',
                            100: '#F1F5F9',
                            200: '#E2E8F0',
                            300: '#CBD5E1',
                            400: '#94A3B8',
                            500: '#64748B',
                            600: '#475569',
                            700: '#334155',
                            800: '#1E293B',
                            900: '#0F172A',
                        }
                    }
                }
            }
        }
    </script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        * { font-family: 'Inter', system-ui, sans-serif; }
        
        body {
            background: #F8FAFC;  /* Slate-50 */
        }
        
        .form-input:focus {
            border-color: #4276A3;
            box-shadow: 0 0 0 3px rgba(66, 118, 163, 0.1);
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4">

    <div class="w-full max-w-md">
        
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
            
            <div class="bg-[#334155] px-6 py-6 text-center">
                <div class="w-16 h-16 mx-auto rounded-full border-2 border-white/20 bg-white p-1 mb-3">
                    <img src="<?php echo e(asset('images/logo.webp')); ?>" alt="Logo Sekolah" class="w-full h-full rounded-full object-cover" loading="lazy" decoding="async">
                </div>
                <h1 class="text-xl font-semibold text-white">Admin Panel</h1>
                <p class="text-slate-400 text-sm mt-0.5">SMK Al-Hidayah Lestari</p>
            </div>

            
            <div class="p-6">
                <?php if(session('error')): ?>
                <div class="mb-4 p-3 bg-[#991B1B]/10 border border-[#991B1B]/20 text-[#991B1B] rounded-lg text-sm">
                    <?php echo e(session('error')); ?>

                </div>
                <?php endif; ?>

                <?php if(session('success')): ?>
                <div class="mb-4 p-3 bg-[#047857]/10 border border-[#047857]/20 text-[#047857] rounded-lg text-sm">
                    <?php echo e(session('success')); ?>

                </div>
                <?php endif; ?>

                <h2 class="text-base font-medium text-slate-800 mb-4 text-center">Masuk ke Akun Admin</h2>

                <form action="<?php echo e(route('admin.login.submit')); ?>" method="POST" class="space-y-4">
                    <?php echo csrf_field(); ?>
                    
                    
                    <div>
                        <label for="username" class="block text-sm font-medium text-slate-700 mb-1">
                            Username
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-4 w-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            </div>
                            <input 
                                type="text" 
                                id="username" 
                                name="username" 
                                value="<?php echo e(old('username')); ?>"
                                placeholder="Masukkan username"
                                required
                                autofocus
                                class="form-input w-full pl-9 pr-3 py-2.5 text-sm border border-slate-200 rounded-lg focus:outline-none <?php $__errorArgs = ['username'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                            >
                        </div>
                        <?php $__errorArgs = ['username'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="mt-1 text-xs text-[#991B1B]"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    
                    <div>
                        <label for="password" class="block text-sm font-medium text-slate-700 mb-1">
                            Password
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-4 w-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                </svg>
                            </div>
                            <input 
                                type="password" 
                                id="password" 
                                name="password" 
                                placeholder="Masukkan password"
                                required
                                class="form-input w-full pl-9 pr-3 py-2.5 text-sm border border-slate-200 rounded-lg focus:outline-none <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                            >
                        </div>
                        <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="mt-1 text-xs text-[#991B1B]"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    
                    <button 
                        type="submit" 
                        class="w-full py-2.5 bg-[#4276A3] text-white text-sm font-medium rounded-lg hover:bg-[#365f85] transition focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#4276A3]"
                    >
                        Masuk
                    </button>
                </form>

            </div>
        </div>
        
        
        <p class="text-center text-xs text-slate-400 mt-6">
            © <?php echo e(date('Y')); ?> SMK Al-Hidayah Lestari
        </p>
    </div>

</body>
</html>
<?php /**PATH C:\Users\eka\.gemini\antigravity\scratch\smk-alstar\resources\views/admin/login.blade.php ENDPATH**/ ?>