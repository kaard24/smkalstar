

<?php $__env->startSection('title', 'Daftar Berkas - Admin SPMB'); ?>

<?php $__env->startSection('content'); ?>
        
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-slate-800">Daftar Berkas Pendaftaran</h1>
            <p class="text-slate-600 mt-2">Lihat berkas yang diupload oleh calon siswa (tidak perlu verifikasi)</p>
        </div>

        
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-4 mb-6">
            <form action="<?php echo e(route('admin.berkas.index')); ?>" method="GET" class="flex flex-wrap gap-4 items-end">
                <div class="flex-1 min-w-[200px]">
                    <label class="block text-sm font-medium text-slate-700 mb-1">Cari NISN</label>
                    <input type="text" name="nisn" value="<?php echo e(request('nisn')); ?>" 
                           placeholder="Masukkan NISN"
                           class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-[#4276A3] focus:border-[#4276A3]">
                </div>
                <div class="min-w-[150px]">
                    <label class="block text-sm font-medium text-slate-700 mb-1">Jenis Berkas</label>
                    <select name="jenis" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-[#4276A3] focus:border-[#4276A3]">
                        <option value="">Semua Jenis</option>
                        <?php $__currentLoopData = \App\Models\BerkasPendaftaran::getJenisBerkas(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($key); ?>" <?php echo e(request('jenis') === $key ? 'selected' : ''); ?>><?php echo e($label); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    Filter
                </button>
                <a href="<?php echo e(route('admin.berkas.index')); ?>" class="btn btn-secondary">
                    Reset
                </a>
            </form>
        </div>

        
        <?php if(session('success')): ?>
        <div class="mb-6 p-4 bg-[#047857]/10 border border-[#047857]/20 text-[#047857] rounded-xl text-sm">
            <?php echo e(session('success')); ?>

        </div>
        <?php endif; ?>

        <?php if(session('error')): ?>
        <div class="mb-6 p-4 bg-[#991B1B]/10 border border-[#991B1B]/20 text-[#991B1B] rounded-xl text-sm">
            <?php echo e(session('error')); ?>

        </div>
        <?php endif; ?>

        
        <div class="mb-6 bg-slate-50 border border-slate-200 rounded-xl p-4">
            <div class="flex items-start gap-3">
                <svg class="w-5 h-5 text-[#4276A3] mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                </svg>
                <div class="text-sm text-slate-700">
                    <p class="font-semibold">Informasi:</p>
                    <ul class="list-disc list-inside mt-1 space-y-1">
                        <li>Siswa cukup upload <strong>3 jenis berkas</strong>: KK, Akta, dan SKL/Ijazah</li>
                        <li>SKL atau Ijazah dipilih salah satu (tidak perlu keduanya)</li>
                        <li>Tidak perlu verifikasi admin - berkas langsung tersimpan</li>
                    </ul>
                </div>
            </div>
        </div>

        
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-slate-50 border-b border-slate-200">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">NISN / Nama</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Jenis Berkas</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">File</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Tanggal Upload</th>
                            <th class="px-6 py-4 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        <?php $__empty_1 = true; $__currentLoopData = $berkasList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $berkas): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="hover:bg-slate-50 transition">
                            <td class="px-6 py-4">
                                <div class="font-medium text-gray-900"><?php echo e($berkas->calonSiswa->nisn); ?></div>
                                <div class="text-sm text-slate-500"><?php echo e($berkas->calonSiswa->nama); ?></div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-[#4276A3]/10 text-[#4276A3]">
                                    <?php echo e($berkas->nama_jenis); ?>

                                </span>
                                <?php if($berkas->jenis_berkas === 'SKL_IJAZAH'): ?>
                                <p class="text-xs text-gray-500 mt-1">SKL atau Ijazah</p>
                                <?php endif; ?>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-sm text-gray-600"><?php echo e(Str::limit($berkas->nama_file, 25)); ?></span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-600">
                                <?php echo e($berkas->created_at->format('d/m/Y H:i')); ?>

                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="<?php echo e(route('admin.berkas.download', $berkas)); ?>" 
                                       class="btn btn-sm btn-info"
                                       target="_blank">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                                        </svg>
                                        Unduh
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                                <svg class="w-16 h-16 mx-auto text-slate-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                <p class="text-lg font-medium">Tidak ada berkas</p>
                                <p class="text-sm">Belum ada berkas yang diupload oleh calon siswa</p>
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            
            <?php if($berkasList->hasPages()): ?>
            <div class="px-6 py-4 border-t border-slate-200">
                <?php echo e($berkasList->withQueryString()->links()); ?>

            </div>
            <?php endif; ?>
        </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\eka\.gemini\antigravity\scratch\smk-alstar\resources\views\admin\berkas-verifikasi.blade.php ENDPATH**/ ?>