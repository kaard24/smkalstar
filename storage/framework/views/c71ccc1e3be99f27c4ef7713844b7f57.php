

<?php $__env->startSection('title', 'Seragam - Admin Panel'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-6xl mx-auto">
    
    <div class="mb-8 flex flex-wrap items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">Seragam</h1>
            <p class="text-slate-600">Kelola jadwal seragam harian.</p>
        </div>
        <a href="<?php echo e(route('admin.seragam.create')); ?>" class="btn btn-primary shadow-md hover:shadow-lg">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
            </svg>
            Tambah Seragam
        </a>
    </div>

    
    <?php if(session('success')): ?>
    <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-xl flex items-center gap-2 animate-fade-in">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
        </svg>
        <?php echo e(session('success')); ?>

    </div>
    <?php endif; ?>

    
    <?php if($seragam->isEmpty()): ?>
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-12 text-center">
        <div class="w-20 h-20 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-4">
            <svg class="w-10 h-10 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
            </svg>
        </div>
        <h3 class="text-lg font-semibold text-slate-700 mb-2">Belum Ada Data Seragam</h3>
        <p class="text-slate-500 mb-4">Mulai dengan menambahkan seragam untuk hari pertama.</p>
        <a href="<?php echo e(route('admin.seragam.create')); ?>" class="btn btn-primary shadow-md hover:shadow-lg">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
            </svg>
            Tambah Seragam Pertama
        </a>
    </div>
    <?php else: ?>
    
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6" x-data="{ 
        deleting: null,
        confirmDelete(id) {
            this.deleting = id;
            if (confirm('Apakah Anda yakin ingin menghapus seragam ini?')) {
                document.getElementById('delete-form-' + id).submit();
            }
            this.deleting = null;
        }
    }">
        <?php $__currentLoopData = $seragam; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden group hover:shadow-md transition-all duration-300 hover:-translate-y-1">
            
            <div class="px-4 py-3 bg-gradient-to-r <?php echo e($item->gradient_class); ?>">
                <span class="text-white font-bold text-lg"><?php echo e($item->hari); ?></span>
            </div>

            
            <div class="p-4">
                <div class="grid grid-cols-2 gap-3 mb-4">
                    
                    <div class="relative aspect-[3/4] rounded-lg overflow-hidden bg-slate-100">
                        <?php
                            $lakiCount = count($item->foto_laki ?? []);
                            $lakiUrl = $item->foto_laki_url;
                        ?>
                        <?php if($lakiUrl): ?>
                        <img src="<?php echo e($lakiUrl); ?>" alt="Seragam Laki-laki <?php echo e($item->hari); ?>" 
                             class="w-full h-full object-cover" loading="lazy">
                        <?php if($lakiCount > 1): ?>
                        <div class="absolute top-2 right-2 bg-blue-500 text-white text-xs px-2 py-0.5 rounded-full">
                            <?php echo e($lakiCount); ?> foto
                        </div>
                        <?php endif; ?>
                        <?php else: ?>
                        <div class="w-full h-full flex items-center justify-center">
                            <svg class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <?php endif; ?>
                        <div class="absolute bottom-0 left-0 right-0 bg-black/50 text-white text-xs py-1 text-center">
                            Laki-laki
                        </div>
                    </div>

                    
                    <div class="relative aspect-[3/4] rounded-lg overflow-hidden bg-slate-100">
                        <?php
                            $perempuanCount = count($item->foto_perempuan ?? []);
                            $perempuanUrl = $item->foto_perempuan_url;
                        ?>
                        <?php if($perempuanUrl): ?>
                        <img src="<?php echo e($perempuanUrl); ?>" alt="Seragam Perempuan <?php echo e($item->hari); ?>" 
                             class="w-full h-full object-cover" loading="lazy">
                        <?php if($perempuanCount > 1): ?>
                        <div class="absolute top-2 right-2 bg-pink-500 text-white text-xs px-2 py-0.5 rounded-full">
                            <?php echo e($perempuanCount); ?> foto
                        </div>
                        <?php endif; ?>
                        <?php else: ?>
                        <div class="w-full h-full flex items-center justify-center">
                            <svg class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <?php endif; ?>
                        <div class="absolute bottom-0 left-0 right-0 bg-black/50 text-white text-xs py-1 text-center">
                            Perempuan
                        </div>
                    </div>
                </div>

                
                <div class="mb-4">
                    <p class="text-sm text-slate-600 line-clamp-2"><?php echo e($item->keterangan ?? 'Tidak ada keterangan'); ?></p>
                </div>

                
                <div class="flex items-center justify-between text-xs text-slate-500 mb-4">
                    <span>Urutan: <?php echo e($item->urutan); ?></span>
                    <span class="badge <?php echo e($item->aktif ? 'badge-success' : 'badge-secondary'); ?>">
                        <?php echo e($item->aktif ? 'Aktif' : 'Nonaktif'); ?>

                    </span>
                </div>

                
                <div class="flex gap-2">
                    <a href="<?php echo e(route('admin.seragam.edit', $item)); ?>" class="flex-1 btn btn-sm btn-secondary justify-center">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                        Edit
                    </a>
                    <button type="button" @click="confirmDelete(<?php echo e($item->id); ?>)" 
                            class="btn btn-sm btn-danger justify-center"
                            :disabled="deleting === <?php echo e($item->id); ?>">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                        Hapus
                    </button>
                    <form id="delete-form-<?php echo e($item->id); ?>" action="<?php echo e(route('admin.seragam.destroy', $item)); ?>" method="POST" class="hidden">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                    </form>
                </div>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\eka\.gemini\antigravity\scratch\smk-alstar\resources\views\admin\seragam\index.blade.php ENDPATH**/ ?>