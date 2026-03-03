

<?php $__env->startSection('title', 'Login Kepala Jurusan - SMK Al-Hidayah'); ?>

<?php $__env->startSection('content'); ?>
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-[#1E293B] to-[#0F172A] px-4">
    <div class="max-w-md w-full">
        
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-[#4276A3] rounded-2xl mb-4">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
            </div>
            <h1 class="text-2xl font-bold text-white">Login Kepala Jurusan</h1>
            <p class="text-slate-400 mt-2">Masukkan username dan password Anda</p>
        </div>

        
        <div class="bg-white rounded-2xl shadow-xl p-8">
            <form action="<?php echo e(route('kajur.login.submit')); ?>" method="POST" class="space-y-6">
                <?php echo csrf_field(); ?>
                
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Username</label>
                    <input type="text" name="username" value="<?php echo e(old('username')); ?>" 
                        class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:border-[#4276A3] focus:ring-2 focus:ring-[#4276A3]/20 outline-none transition"
                        placeholder="Masukkan username" required>
                    <?php $__errorArgs = ['username'];
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
                    <label class="block text-sm font-medium text-slate-700 mb-2">Password</label>
                    <input type="password" name="password" 
                        class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:border-[#4276A3] focus:ring-2 focus:ring-[#4276A3]/20 outline-none transition"
                        placeholder="Masukkan password" required>
                </div>

                <button type="submit" 
                    class="w-full py-3 bg-[#4276A3] hover:bg-[#365f85] text-white font-semibold rounded-xl transition shadow-lg shadow-[#4276A3]/30">
                    Masuk
                </button>
            </form>

            <div class="mt-6 text-center">
                <a href="<?php echo e(url('/')); ?>" class="text-sm text-slate-500 hover:text-[#4276A3] transition">
                    ← Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\eka\.gemini\antigravity\scratch\smk-alstar\resources\views\kajur\login.blade.php ENDPATH**/ ?>