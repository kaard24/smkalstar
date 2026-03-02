<?php $__env->startSection('title', 'Daftar Pendaftar - Admin Panel'); ?>

<?php $__env->startSection('content'); ?>
    
    <div class="mb-6">
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
            <div>
                <h1 class="text-lg font-semibold text-slate-800">Data Calon Siswa</h1>
                <p class="text-xs text-slate-500 mt-0.5">Kelola data pendaftar SPMB SMK Al-Hidayah Lestari</p>
            </div>
            <div class="flex flex-wrap gap-2 items-center">
                <a href="<?php echo e(route('admin.pendaftar.create')); ?>" class="btn btn-primary">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Tambah Siswa
                </a>
                <a href="<?php echo e(route('admin.pendaftar.export', request()->query())); ?>" class="btn btn-success">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    Export Excel
                </a>
            </div>
        </div>
    </div>

    <?php if(session('success')): ?>
    <div class="mb-4 p-4 bg-[#047857]/10 border border-[#047857]/20 text-[#047857] rounded-lg flex items-center text-sm">
        <svg class="w-5 h-5 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
        </svg>
        <?php echo e(session('success')); ?>

    </div>
    <?php endif; ?>

    <?php if(session('error')): ?>
    <div class="mb-4 p-4 bg-[#991B1B]/10 border border-[#991B1B]/20 text-[#991B1B] rounded-lg flex items-center text-sm">
        <svg class="w-5 h-5 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
        </svg>
        <?php echo e(session('error')); ?>

    </div>
    <?php endif; ?>

    
    <div class="mb-4 bg-white rounded-xl border border-slate-200 p-4">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-sm font-semibold text-slate-800 flex items-center gap-2">
                <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                </svg>
                Filter Data Pendaftar
            </h3>
            <?php
                $hasFilter = request('search') || request('jurusan') || request('gender') || request('wawancara');
            ?>
            <?php if($hasFilter): ?>
            <span class="text-xs bg-[#4276A3]/10 text-[#4276A3] px-2 py-1 rounded-full font-medium">Filter Aktif</span>
            <?php endif; ?>
        </div>
        
        <form action="<?php echo e(route('admin.pendaftar.index')); ?>" method="GET">
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-3 mb-4">
                
                <div>
                    <label for="search" class="block text-xs font-medium text-slate-600 mb-1">Cari (Nama/NISN/No.WA)</label>
                    <div class="relative">
                        <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400 pointer-events-none z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        <input type="text" name="search" id="search" value="<?php echo e(request('search')); ?>" placeholder="Ketik untuk mencari..." style="padding-left: 2.5rem;" class="form-input w-full">
                    </div>
                </div>

                
                <div>
                    <label for="jurusan" class="block text-xs font-medium text-slate-600 mb-1">Jurusan</label>
                    <select name="jurusan" id="jurusan" class="form-input w-full">
                        <option value="">Semua Jurusan</option>
                        <?php $__currentLoopData = $jurusanList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $jurusan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($jurusan->id); ?>" <?php echo e(request('jurusan') == $jurusan->id ? 'selected' : ''); ?>><?php echo e($jurusan->nama); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                
                <div>
                    <label for="gender" class="block text-xs font-medium text-slate-600 mb-1">Gender</label>
                    <select name="gender" id="gender" class="form-input w-full">
                        <option value="">Semua</option>
                        <option value="L" <?php echo e(request('gender') == 'L' ? 'selected' : ''); ?>>Laki-laki</option>
                        <option value="P" <?php echo e(request('gender') == 'P' ? 'selected' : ''); ?>>Perempuan</option>
                    </select>
                </div>

                
                <div>
                    <label for="wawancara" class="block text-xs font-medium text-slate-600 mb-1">Status Wawancara</label>
                    <select name="wawancara" id="wawancara" class="form-input w-full">
                        <option value="">Semua</option>
                        <option value="belum" <?php echo e(request('wawancara') == 'belum' ? 'selected' : ''); ?>>Belum Wawancara</option>
                        <option value="sudah" <?php echo e(request('wawancara') == 'sudah' ? 'selected' : ''); ?>>Sudah Wawancara</option>
                    </select>
                </div>
            </div>

            
            <div class="flex flex-wrap gap-2 items-center pt-3 border-t border-slate-200">
                <button type="submit" class="btn btn-primary">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                    </svg>
                    Terapkan Filter
                </button>
                <?php if($hasFilter): ?>
                <a href="<?php echo e(route('admin.pendaftar.index')); ?>" class="btn btn-secondary">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                    Reset Filter
                </a>
                <?php endif; ?>
                
                
                <?php if($hasFilter): ?>
                <div class="flex flex-wrap gap-1 ml-auto">
                    <?php if(request('search')): ?>
                        <span class="text-xs bg-slate-100 text-slate-600 px-2 py-1 rounded">Cari: <?php echo e(Str::limit(request('search'), 15)); ?></span>
                    <?php endif; ?>
                    <?php if(request('jurusan')): ?>
                        <?php $jurusanNama = $jurusanList->firstWhere('id', request('jurusan'))?->nama ?? 'Jurusan'; ?>
                        <span class="text-xs bg-slate-100 text-slate-600 px-2 py-1 rounded"><?php echo e(Str::limit($jurusanNama, 15)); ?></span>
                    <?php endif; ?>
                    <?php if(request('gender')): ?>
                        <span class="text-xs bg-slate-100 text-slate-600 px-2 py-1 rounded"><?php echo e(request('gender') == 'L' ? 'Laki-laki' : 'Perempuan'); ?></span>
                    <?php endif; ?>

                </div>
                <?php endif; ?>
            </div>
        </form>
    </div>

    
    <div id="bulk-toolbar" class="mb-4 bg-[#4276A3]/5 border border-[#4276A3]/20 rounded-xl p-3 hidden">
        <div class="flex flex-wrap items-center justify-between gap-3">
            <div class="flex items-center gap-3">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" id="select-all-checkbox" class="w-4 h-4 text-[#4276A3] rounded border-slate-300 focus:ring-[#4276A3]">
                    <span class="text-sm font-medium text-slate-700">Pilih Semua</span>
                </label>
                <span class="text-sm text-slate-500">|</span>
                <span id="selected-count" class="text-sm font-medium text-[#4276A3]">0 item dipilih</span>
            </div>
            <div class="flex flex-wrap gap-2">
                <button type="button" onclick="bulkExport()" class="btn btn-sm btn-success">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    Export
                </button>
                <button type="button" onclick="openStatusModal()" class="btn btn-sm btn-info">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Update Status
                </button>
                <button type="button" onclick="openWAModal()" class="btn btn-sm btn-primary">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                    </svg>
                    Kirim WA
                </button>
                <button type="button" onclick="confirmBulkDelete()" class="btn btn-sm btn-danger">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                    </svg>
                    Hapus
                </button>
            </div>
        </div>
    </div>

    
    <div class="bg-white rounded-xl border border-slate-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="data-table">
                <thead>
                    <tr>
                        <th class="w-10 text-center">
                            <input type="checkbox" id="select-all-header" class="w-4 h-4 text-[#4276A3] rounded border-slate-300 focus:ring-[#4276A3]">
                        </th>
                        <th class="w-10 text-center">No</th>
                        <th>Nama</th>
                        <th>NISN</th>
                        <th>Jurusan</th>
                        <th>Berkas</th>
                        <th>Status</th>
                        <th class="text-center w-24">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $pendaftar; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $siswa): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <?php
                        $isComplete = $siswa->isRegistrationComplete();
                        $hasPendaftaran = $siswa->pendaftaran !== null;
                        $berkasProgress = \App\Models\BerkasPendaftaran::getUploadProgress($siswa->id);
                        $nomor = ($pendaftar->currentPage() - 1) * $pendaftar->perPage() + $index + 1;
                    ?>
                    <tr data-id="<?php echo e($siswa->id); ?>">
                        <td class="text-center" onclick="event.stopPropagation();">
                            <input type="checkbox" name="ids[]" value="<?php echo e($siswa->id); ?>" class="row-checkbox w-4 h-4 text-[#4276A3] rounded border-slate-300 focus:ring-[#4276A3]" onclick="event.stopPropagation(); updateSelection();">
                        </td>
                        <td class="text-center text-slate-500" onclick="window.location='<?php echo e(route('admin.pendaftar.show', $siswa->id)); ?>'"><?php echo e($nomor); ?></td>
                        <td onclick="window.location='<?php echo e(route('admin.pendaftar.show', $siswa->id)); ?>'">
                            <div class="font-medium text-slate-800"><?php echo e($siswa->nama); ?></div>
                            <div class="text-xs text-slate-400 mt-0.5"><?php echo e($siswa->no_wa ?? '-'); ?></div>
                        </td>
                        <td onclick="window.location='<?php echo e(route('admin.pendaftar.show', $siswa->id)); ?>'">
                            <span class="font-mono text-slate-600 text-xs"><?php echo e($siswa->nisn); ?></span>
                        </td>
                        <td onclick="window.location='<?php echo e(route('admin.pendaftar.show', $siswa->id)); ?>'">
                            <?php if($siswa->pendaftaran && $siswa->pendaftaran->jurusan): ?>
                                <span class="badge badge-info"><?php echo e($siswa->pendaftaran->jurusan->kode); ?></span>
                            <?php else: ?>
                                <span class="badge badge-secondary">Belum Pilih</span>
                            <?php endif; ?>
                        </td>
                        <td onclick="window.location='<?php echo e(route('admin.pendaftar.show', $siswa->id)); ?>'">
                            <div class="flex items-center gap-2">
                                <div class="flex-1 w-20 bg-slate-200 rounded-full h-1.5">
                                    <div class="bg-[#4276A3] h-1.5 rounded-full" style="width: <?php echo e($berkasProgress['percentage']); ?>%"></div>
                                </div>
                                <span class="text-xs font-medium text-slate-600 whitespace-nowrap"><?php echo e($berkasProgress['uploaded']); ?>/<?php echo e($berkasProgress['total']); ?></span>
                            </div>
                            <?php if($berkasProgress['is_complete']): ?>
                                <span class="text-xs text-[#047857] font-medium">Lengkap</span>
                            <?php elseif($berkasProgress['uploaded'] > 0): ?>
                                <span class="text-xs text-[#B45309]">Proses</span>
                            <?php else: ?>
                                <span class="text-xs text-slate-400">Belum Upload</span>
                            <?php endif; ?>
                        </td>
                        <td onclick="window.location='<?php echo e(route('admin.pendaftar.show', $siswa->id)); ?>'">
                            <?php if($hasPendaftaran && $isComplete && $berkasProgress['is_complete']): ?>
                                <span class="badge badge-success">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                    Siap Tes
                                </span>
                            <?php elseif($hasPendaftaran && $isComplete): ?>
                                <span class="badge badge-info">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4"/></svg>
                                    Data Lengkap
                                </span>
                            <?php elseif($hasPendaftaran): ?>
                                <span class="badge badge-warning">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    Proses
                                </span>
                            <?php else: ?>
                                <span class="badge badge-secondary">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                                    Baru
                                </span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <div class="flex gap-2 justify-center" onclick="event.stopPropagation();">
                                <a href="<?php echo e(route('admin.pendaftar.edit', $siswa->id)); ?>" class="btn btn-sm btn-secondary">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                    Edit
                                </a>
                                <form action="<?php echo e(route('admin.pendaftar.destroy', $siswa->id)); ?>" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="8" class="px-6 py-8 text-center text-slate-500">
                            <div class="flex flex-col items-center">
                                <svg class="w-12 h-12 text-slate-300 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <p class="text-sm font-medium">Tidak ada data ditemukan</p>
                            </div>
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <div class="px-4 py-3 border-t border-slate-200 bg-slate-50">
            <?php echo e($pendaftar->links()); ?>

        </div>
    </div>

    
    <div id="delete-modal" class="fixed inset-0 bg-black/50 z-50 hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-xl border border-slate-200 max-w-md w-full p-6">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center">
                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-slate-800">Konfirmasi Hapus</h3>
                    <p class="text-sm text-slate-500">Data yang dihapus tidak dapat dikembalikan</p>
                </div>
            </div>
            <p class="text-slate-600 mb-6">Anda yakin ingin menghapus <span id="delete-count" class="font-semibold text-red-600"></span> data yang dipilih?</p>
            <div class="flex gap-3 justify-end">
                <button type="button" onclick="closeDeleteModal()" class="btn btn-secondary">Batal</button>
                <form id="bulk-delete-form" action="<?php echo e(route('admin.pendaftar.bulk-delete')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div id="delete-ids-container"></div>
                    <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                </form>
            </div>
        </div>
    </div>

    
    <div id="status-modal" class="fixed inset-0 bg-black/50 z-50 hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-xl border border-slate-200 max-w-md w-full p-6">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-slate-800">Update Status Massal</h3>
                    <p class="text-sm text-slate-500">Pilih status baru untuk data terpilih</p>
                </div>
            </div>
            <form id="bulk-status-form" action="<?php echo e(route('admin.pendaftar.bulk-update-status')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <div id="status-ids-container"></div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-slate-700 mb-2">Status Baru</label>
                    <select name="status" class="form-input w-full">
                        <option value="baru">Baru Daftar</option>
                        <option value="proses_data">Proses Data</option>
                        <option value="proses_berkas">Proses Berkas</option>
                        <option value="lengkap">Data Lengkap</option>
                        <option value="lulus">Sudah Lulus</option>
                    </select>
                </div>
                <div class="flex gap-3 justify-end">
                    <button type="button" onclick="closeStatusModal()" class="btn btn-secondary">Batal</button>
                    <button type="submit" class="btn btn-primary">Update Status</button>
                </div>
            </form>
        </div>
    </div>

    
    <div id="wa-modal" class="fixed inset-0 bg-black/50 z-50 hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-xl border border-slate-200 max-w-lg w-full p-6">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                    <svg class="w-6 h-6 text-green-600" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-slate-800">Kirim Notifikasi WA Massal</h3>
                    <p class="text-sm text-slate-500">Kirim pesan WhatsApp ke data terpilih</p>
                </div>
            </div>
            <form id="bulk-wa-form" action="<?php echo e(route('admin.pendaftar.bulk-send-wa')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <div id="wa-ids-container"></div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-slate-700 mb-2">Template Pesan</label>
                    <textarea name="pesan" rows="4" class="form-input w-full" placeholder="Tulis pesan yang akan dikirim...">Assalamualaikum {nama}, ini adalah pemberitahuan dari SMK Al-Hidayah Lestari mengenai pendaftaran Anda. Status: {status}. Terima kasih.</textarea>
                    <p class="text-xs text-slate-500 mt-1">Variabel: {nama}, {nisn}, {jurusan}, {status}</p>
                </div>
                <div class="flex gap-3 justify-end">
                    <button type="button" onclick="closeWAModal()" class="btn btn-secondary">Batal</button>
                    <button type="submit" class="btn btn-success">Kirim Pesan</button>
                </div>
            </form>
        </div>
    </div>



    <?php $__env->startPush('scripts'); ?>
    <script>
        const bulkToolbar = document.getElementById('bulk-toolbar');
        const selectAllCheckbox = document.getElementById('select-all-checkbox');
        const selectAllHeader = document.getElementById('select-all-header');
        const selectedCountEl = document.getElementById('selected-count');
        const rowCheckboxes = document.querySelectorAll('.row-checkbox');

        function updateSelection() {
            const checkedBoxes = document.querySelectorAll('.row-checkbox:checked');
            const count = checkedBoxes.length;
            selectedCountEl.textContent = count + ' item dipilih';
            if (count > 0) {
                bulkToolbar.classList.remove('hidden');
            } else {
                bulkToolbar.classList.add('hidden');
            }
            const totalBoxes = rowCheckboxes.length;
            selectAllCheckbox.checked = count > 0 && count === totalBoxes;
            selectAllHeader.checked = count > 0 && count === totalBoxes;
            selectAllCheckbox.indeterminate = count > 0 && count < totalBoxes;
            selectAllHeader.indeterminate = count > 0 && count < totalBoxes;
        }

        function toggleSelectAll(checked) {
            rowCheckboxes.forEach(checkbox => { checkbox.checked = checked; });
            selectAllCheckbox.checked = checked;
            selectAllHeader.checked = checked;
            updateSelection();
        }

        selectAllCheckbox.addEventListener('change', function() { toggleSelectAll(this.checked); });
        selectAllHeader.addEventListener('change', function() { toggleSelectAll(this.checked); });

        function getSelectedIds() {
            const checkedBoxes = document.querySelectorAll('.row-checkbox:checked');
            return Array.from(checkedBoxes).map(cb => cb.value);
        }

        function bulkExport() {
            const ids = getSelectedIds();
            if (ids.length === 0) { alert('Pilih minimal satu data'); return; }
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '<?php echo e(route("admin.pendaftar.bulk-export")); ?>';
            const csrfInput = document.createElement('input');
            csrfInput.type = 'hidden';
            csrfInput.name = '_token';
            csrfInput.value = '<?php echo e(csrf_token()); ?>';
            form.appendChild(csrfInput);
            ids.forEach(id => {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'ids[]';
                input.value = id;
                form.appendChild(input);
            });
            document.body.appendChild(form);
            form.submit();
            document.body.removeChild(form);
        }

        function confirmBulkDelete() {
            const ids = getSelectedIds();
            if (ids.length === 0) { alert('Pilih minimal satu data'); return; }
            document.getElementById('delete-count').textContent = ids.length;
            const container = document.getElementById('delete-ids-container');
            container.innerHTML = '';
            ids.forEach(id => {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'ids[]';
                input.value = id;
                container.appendChild(input);
            });
            document.getElementById('delete-modal').classList.remove('hidden');
        }

        function closeDeleteModal() { document.getElementById('delete-modal').classList.add('hidden'); }

        function openStatusModal() {
            const ids = getSelectedIds();
            if (ids.length === 0) { alert('Pilih minimal satu data'); return; }
            const container = document.getElementById('status-ids-container');
            container.innerHTML = '';
            ids.forEach(id => {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'ids[]';
                input.value = id;
                container.appendChild(input);
            });
            document.getElementById('status-modal').classList.remove('hidden');
        }

        function closeStatusModal() { document.getElementById('status-modal').classList.add('hidden'); }

        function openWAModal() {
            const ids = getSelectedIds();
            if (ids.length === 0) { alert('Pilih minimal satu data'); return; }
            const container = document.getElementById('wa-ids-container');
            container.innerHTML = '';
            ids.forEach(id => {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'ids[]';
                input.value = id;
                container.appendChild(input);
            });
            document.getElementById('wa-modal').classList.remove('hidden');
        }

        function closeWAModal() { document.getElementById('wa-modal').classList.add('hidden'); }

        window.onclick = function(event) {
            if (event.target.id === 'delete-modal') closeDeleteModal();
            if (event.target.id === 'status-modal') closeStatusModal();
            if (event.target.id === 'wa-modal') closeWAModal();
        }

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeDeleteModal();
                closeStatusModal();
                closeWAModal();
            }
        });
    </script>
    <?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\eka\.gemini\antigravity\scratch\smk-alstar\resources\views/admin/pendaftar.blade.php ENDPATH**/ ?>