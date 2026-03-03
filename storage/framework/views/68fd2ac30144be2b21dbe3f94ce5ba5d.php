

<?php $__env->startSection('title', 'Tambah Kepala Jurusan - Admin Panel'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-2xl mx-auto">
    
    <div class="mb-8">
        <a href="<?php echo e(route('admin.kajur.index')); ?>" class="text-slate-500 hover:text-slate-700 flex items-center gap-1 mb-4">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Kembali
        </a>
        <h1 class="text-2xl font-bold text-slate-800">Tambah Kepala Jurusan</h1>
        <p class="text-slate-600">Buat akun baru untuk kepala jurusan.</p>
    </div>

    
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
        <form action="<?php echo e(route('admin.kajur.store')); ?>" method="POST" class="space-y-6">
            <?php echo csrf_field(); ?>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-2">Nama Lengkap</label>
                <input type="text" name="nama" value="<?php echo e(old('nama')); ?>" 
                    class="w-full rounded-lg border-slate-300 focus:border-[#4276A3] focus:ring-[#4276A3]"
                    placeholder="Contoh: Budi Santoso" required>
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
                <label class="block text-sm font-medium text-slate-700 mb-2">Username</label>
                <input type="text" name="username" value="<?php echo e(old('username')); ?>" 
                    class="w-full rounded-lg border-slate-300 focus:border-[#4276A3] focus:ring-[#4276A3]"
                    placeholder="Contoh: kajur.tkj" required>
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
                    class="w-full rounded-lg border-slate-300 focus:border-[#4276A3] focus:ring-[#4276A3]"
                    placeholder="Minimal 6 karakter" required>
                <?php $__errorArgs = ['password'];
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
                <label class="block text-sm font-medium text-slate-700 mb-2">Jurusan yang Diampu</label>
                <select name="jurusan_id" class="w-full rounded-lg border-slate-300 focus:border-[#4276A3] focus:ring-[#4276A3]" required>
                    <option value="">Pilih Jurusan</option>
                    <?php $__currentLoopData = $jurusan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $j): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($j->id); ?>" <?php echo e(old('jurusan_id') == $j->id ? 'selected' : ''); ?>><?php echo e($j->nama); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <?php $__errorArgs = ['jurusan_id'];
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
                <label class="flex items-center gap-3 cursor-pointer">
                    <input type="checkbox" name="aktif" value="1" checked
                        class="rounded border-slate-300 text-[#4276A3] focus:ring-[#4276A3] w-5 h-5">
                    <span class="text-slate-700">Aktifkan akun ini</span>
                </label>
            </div>

            <div class="flex gap-4 pt-4">
                <button type="submit" class="inline-flex items-center gap-2 px-6 py-3 bg-[#4276A3] hover:bg-[#365f85] text-white font-semibold rounded-xl transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Simpan
                </button>
                <a href="<?php echo e(route('admin.kajur.index')); ?>" class="inline-flex items-center gap-2 px-6 py-3 bg-slate-200 hover:bg-slate-300 text-slate-700 font-semibold rounded-xl transition">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\eka\.gemini\antigravity\scratch\smk-alstar\resources\views\admin\kajur\create.blade.php ENDPATH**/ ?>