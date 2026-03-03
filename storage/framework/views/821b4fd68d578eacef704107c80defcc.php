

<?php $__env->startSection('title', 'Gelombang SPMB - Admin Panel'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-6xl mx-auto">
    
    <div class="mb-8 flex flex-wrap items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">Gelombang SPMB</h1>
            <p class="text-slate-600">Kelola jadwal gelombang pendaftaran.</p>
        </div>
        <a href="<?php echo e(route('admin.spmb.gelombang.create')); ?>" class="btn btn-primary shadow-md hover:shadow-lg">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
            </svg>
            Tambah Gelombang
        </a>
    </div>

    
    <?php if(session('success')): ?>
    <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-xl flex items-center gap-2">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
        </svg>
        <?php echo e(session('success')); ?>

    </div>
    <?php endif; ?>

    
    <?php if($gelombang->isEmpty()): ?>
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-12 text-center">
        <div class="w-20 h-20 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-4">
            <svg class="w-10 h-10 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
        </div>
        <h3 class="text-lg font-semibold text-slate-700 mb-2">Belum Ada Gelombang</h3>
        <p class="text-slate-500 mb-4">Mulai dengan menambahkan gelombang pertama.</p>
        <a href="<?php echo e(route('admin.spmb.gelombang.create')); ?>" class="btn btn-primary shadow-md hover:shadow-lg">
            Tambah Gelombang Pertama
        </a>
    </div>
    <?php else: ?>
    
    <div class="space-y-6">
        <?php $__currentLoopData = $gelombang; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $g): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php
            $colors = $g->status_color;
            $isAktif = $g->is_aktif;
        ?>
        <div class="bg-white rounded-xl shadow-sm border <?php echo e($isAktif ? 'border-blue-200 ring-2 ring-blue-100' : 'border-slate-200'); ?> overflow-hidden">
            
            <div class="p-6 border-b <?php echo e($isAktif ? 'bg-gradient-to-r from-blue-50 to-cyan-50 border-blue-100' : 'border-slate-100'); ?>">
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                    <div class="flex items-center gap-4">
                        <div class="w-14 h-14 rounded-2xl <?php echo e($isAktif ? 'bg-gradient-to-br from-blue-500 to-cyan-500 text-white' : 'bg-slate-100 text-slate-500'); ?> flex items-center justify-center text-2xl font-bold">
                            <?php echo e($g->nomor); ?>

                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-slate-800"><?php echo e($g->nama); ?></h3>
                            <p class="text-sm text-slate-500">Tahun Ajaran <?php echo e($g->tahun_ajaran); ?></p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <?php if($isAktif): ?>
                        <span class="inline-flex items-center gap-2 bg-gradient-to-r from-blue-500 to-cyan-500 text-white px-4 py-2 rounded-xl text-sm font-bold shadow-lg">
                            <span class="w-2 h-2 bg-white rounded-full animate-pulse"></span>
                            BERLANGSUNG
                        </span>
                        <?php else: ?>
                        <span class="badge <?php echo e($colors['bg']); ?> <?php echo e($colors['text']); ?>">
                            <?php echo e($g->status_pendaftaran); ?>

                        </span>
                        <?php endif; ?>
                        <div class="flex gap-2">
                            <a href="<?php echo e(route('admin.spmb.gelombang.edit', $g)); ?>" class="btn-icon btn-icon-edit" title="Edit">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                            </a>
                            <form action="<?php echo e(route('admin.spmb.gelombang.destroy', $g)); ?>" method="POST" class="inline" onsubmit="return confirm('Hapus gelombang ini?')">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="btn-icon btn-icon-delete" title="Hapus">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="p-6">
                <div class="grid md:grid-cols-3 gap-4">
                    
                    <div class="relative <?php echo e($colors['bg']); ?> rounded-2xl p-5 border <?php echo e($colors['border']); ?> <?php echo e($g->status_pendaftaran === 'BERLANGSUNG' ? 'ring-2 ring-blue-200' : ''); ?>">
                        <?php if($g->status_pendaftaran === 'BERLANGSUNG'): ?>
                        <div class="absolute -top-2 -right-2 w-6 h-6 bg-blue-500 rounded-full flex items-center justify-center">
                            <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                            </svg>
                        </div>
                        <?php endif; ?>
                        <div class="flex items-center gap-3 mb-3">
                            <div class="w-10 h-10 rounded-xl bg-white <?php echo e($colors['icon']); ?> flex items-center justify-center">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-slate-800">Pendaftaran</h4>
                                <span class="text-xs font-bold <?php echo e($colors['text']); ?>"><?php echo e($g->status_pendaftaran); ?></span>
                            </div>
                        </div>
                        <p class="text-sm text-slate-600">
                            <?php echo e($g->pendaftaran_start->translatedFormat('d M Y')); ?> - <?php echo e($g->pendaftaran_end->translatedFormat('d M Y')); ?>

                        </p>
                        <?php if($g->status_pendaftaran === 'BERLANGSUNG'): ?>
                        <div class="mt-3 pt-3 border-t <?php echo e($colors['border']); ?>">
                            <p class="text-sm <?php echo e($colors['text']); ?> font-medium">
                                Sisa: <?php echo e($g->sisa_hari_pendaftaran); ?> hari
                            </p>
                        </div>
                        <?php endif; ?>
                    </div>

                    
                    <div class="relative bg-white rounded-2xl p-5 border border-slate-200">
                        <div class="flex items-center gap-3 mb-3">
                            <div class="w-10 h-10 rounded-xl bg-slate-100 text-slate-500 flex items-center justify-center">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-slate-800">Tes Masuk</h4>
                                <span class="text-xs font-bold text-slate-500"><?php echo e($g->status_tes); ?></span>
                            </div>
                        </div>
                        <p class="text-sm text-slate-600">
                            <?php echo e($g->tes_mulai->translatedFormat('d M Y')); ?> - <?php echo e($g->tes_selesai->translatedFormat('d M Y')); ?>

                        </p>
                    </div>

                    
                    <div class="relative bg-white rounded-2xl p-5 border border-slate-200">
                        <div class="flex items-center gap-3 mb-3">
                            <div class="w-10 h-10 rounded-xl bg-slate-100 text-slate-500 flex items-center justify-center">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-slate-800">Pengumuman</h4>
                                <span class="text-xs font-bold text-slate-500"><?php echo e($g->status_pengumuman); ?></span>
                            </div>
                        </div>
                        <p class="text-sm text-slate-600">
                            <?php echo e($g->pengumuman->translatedFormat('d M Y')); ?>

                        </p>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\eka\.gemini\antigravity\scratch\smk-alstar\resources\views\admin\spmb\gelombang\index.blade.php ENDPATH**/ ?>