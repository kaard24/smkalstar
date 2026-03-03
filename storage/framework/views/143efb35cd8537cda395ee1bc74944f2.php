<?php $__env->startSection('title', 'Edit Profil - Admin Panel'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-5xl mx-auto">
    
    <div class="mb-6">
        <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-3">
            <div>
                <h1 class="text-2xl font-bold text-slate-800">Profil Admin</h1>
                <p class="text-sm text-slate-500 mt-1">Perbarui informasi akun dan keamanan login Anda.</p>
            </div>
            <a href="<?php echo e(route('admin.dashboard')); ?>" class="btn btn-secondary self-start">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                Kembali ke Dashboard
            </a>
        </div>
    </div>

    <?php if(session('success')): ?>
        <div class="mb-4 p-3 rounded-lg border border-emerald-200 bg-emerald-50 text-emerald-700 text-sm flex items-center gap-2">
            <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
            </svg>
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <?php if($errors->any()): ?>
        <div class="mb-4 p-3 rounded-lg border border-red-200 bg-red-50 text-red-700 text-sm">
            <p class="font-semibold mb-1">Periksa kembali input Anda:</p>
            <ul class="list-disc list-inside space-y-0.5">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    
    <form action="<?php echo e(route('admin.profil.update')); ?>" method="POST" class="grid grid-cols-1 lg:grid-cols-3 gap-5">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <div class="lg:col-span-2 space-y-5">
                <div class="card p-5">
                    <div class="mb-4">
                        <h2 class="text-base font-semibold text-slate-800">Informasi Akun</h2>
                        <p class="text-xs text-slate-500 mt-1">Data ini digunakan untuk identitas akun admin.</p>
                    </div>

                    <div class="space-y-4">
                        <div>
                            <label for="name" class="form-label">Nama Lengkap</label>
                            <input
                                id="name"
                                type="text"
                                name="name"
                                value="<?php echo e(old('name', $admin->name)); ?>"
                                class="form-input <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-300 focus:border-red-400 focus:ring-red-200 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                placeholder="Masukkan nama lengkap"
                                required
                            >
                            <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="form-error"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div>
                            <label for="username" class="form-label">Username</label>
                            <input
                                id="username"
                                type="text"
                                name="username"
                                value="<?php echo e(old('username', $admin->username)); ?>"
                                class="form-input <?php $__errorArgs = ['username'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-300 focus:border-red-400 focus:ring-red-200 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                placeholder="Masukkan username"
                                required
                            >
                            <?php $__errorArgs = ['username'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="form-error"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>
                </div>

                <div class="card p-5">
                    <div class="mb-4">
                        <h2 class="text-base font-semibold text-slate-800">Keamanan</h2>
                        <p class="text-xs text-slate-500 mt-1">Kosongkan jika tidak ingin mengganti password.</p>
                    </div>

                    <div class="space-y-4">
                        <div>
                            <label for="current_password" class="form-label">Password Saat Ini</label>
                            <input
                                id="current_password"
                                type="password"
                                name="current_password"
                                class="form-input <?php $__errorArgs = ['current_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-300 focus:border-red-400 focus:ring-red-200 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                placeholder="Masukkan password saat ini"
                            >
                            <?php $__errorArgs = ['current_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="form-error"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div>
                            <label for="password" class="form-label">Password Baru</label>
                            <input
                                id="password"
                                type="password"
                                name="password"
                                class="form-input <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-300 focus:border-red-400 focus:ring-red-200 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                placeholder="Minimal 6 karakter"
                            >
                            <p class="text-xs text-slate-500 mt-1">Gunakan kombinasi huruf dan angka agar lebih aman.</p>
                            <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="form-error"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div>
                            <label for="password_confirmation" class="form-label">Konfirmasi Password Baru</label>
                            <input
                                id="password_confirmation"
                                type="password"
                                name="password_confirmation"
                                class="form-input"
                                placeholder="Ulangi password baru"
                            >
                        </div>
                    </div>
                </div>

                <div class="card p-4 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                    <p class="text-xs text-slate-500">Pastikan username dan password baru sudah benar sebelum menyimpan.</p>
                    <div class="flex flex-wrap gap-2">
                        <a href="<?php echo e(route('admin.dashboard')); ?>" class="btn btn-secondary">
                            Batal
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            Simpan Perubahan
                        </button>
                    </div>
                </div>
            </div>

            <div class="space-y-5">
                <div class="card p-5">
                    <h3 class="text-sm font-semibold text-slate-800 mb-3">Ringkasan Akun</h3>
                    <div class="space-y-3 text-sm">
                        <div>
                            <p class="text-xs text-slate-500">Nama saat ini</p>
                            <p class="font-medium text-slate-800"><?php echo e($admin->name); ?></p>
                        </div>
                        <div>
                            <p class="text-xs text-slate-500">Username saat ini</p>
                            <p class="font-mono text-slate-700"><?php echo e($admin->username); ?></p>
                        </div>
                    </div>
                </div>

                <div class="card p-4 bg-slate-50">
                    <h3 class="text-sm font-semibold text-slate-800 mb-2">Tips Keamanan</h3>
                    <ul class="text-xs text-slate-600 list-disc list-inside space-y-1">
                        <li>Jangan gunakan password yang sama dengan akun lain.</li>
                        <li>Ganti password secara berkala.</li>
                        <li>Simpan kredensial di tempat yang aman.</li>
                    </ul>
                </div>
            </div>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\eka\.gemini\antigravity\scratch\smk-alstar\resources\views\admin\profil\edit.blade.php ENDPATH**/ ?>