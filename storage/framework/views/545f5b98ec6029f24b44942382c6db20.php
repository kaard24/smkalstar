<?php $__env->startSection('title', 'Detail Calon Siswa - Admin Panel'); ?>

<?php $__env->startSection('content'); ?>
    
    <div class="mb-6">
        <h1 class="text-lg font-semibold text-slate-800">Detail Calon Siswa</h1>
        <div class="flex items-center gap-2 mt-0.5">
            <span class="text-sm text-slate-600"><?php echo e($siswa->nama); ?></span>
            <span class="px-2 py-0.5 bg-slate-100 text-slate-600 rounded text-xs font-mono"><?php echo e($siswa->nisn); ?></span>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
        
        <div class="card p-4">
            <h3 class="font-semibold text-sm text-slate-800 mb-4 flex items-center gap-2 pb-2 border-b border-slate-100">
                <svg class="w-4 h-4 text-[#4276A3]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
                Data Siswa
            </h3>
            <div class="space-y-3 text-sm">
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <span class="block text-xs text-slate-500">NISN</span>
                        <span class="font-medium text-slate-800 font-mono"><?php echo e($siswa->nisn); ?></span>
                    </div>
                    <div>
                        <span class="block text-xs text-slate-500">NIK</span>
                        <span class="font-medium text-slate-800 font-mono"><?php echo e($siswa->nik ?? '-'); ?></span>
                    </div>
                </div>
                <div>
                    <span class="block text-xs text-slate-500">No. Kartu Keluarga</span>
                    <span class="font-medium text-slate-800 font-mono"><?php echo e($siswa->no_kk ?? '-'); ?></span>
                </div>
                <div>
                    <span class="block text-xs text-slate-500">Nama Lengkap</span>
                    <span class="font-medium text-slate-800"><?php echo e($siswa->nama); ?></span>
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <span class="block text-xs text-slate-500">Tempat Lahir</span>
                        <span class="font-medium text-slate-800"><?php echo e($siswa->tempat_lahir ?? '-'); ?></span>
                    </div>
                    <div>
                        <span class="block text-xs text-slate-500">Tanggal Lahir</span>
                        <span class="font-medium text-slate-800"><?php echo e($siswa->tgl_lahir?->format('d M Y') ?? '-'); ?></span>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <span class="block text-xs text-slate-500">Jenis Kelamin</span>
                        <span class="font-medium text-slate-800"><?php echo e($siswa->jk == 'L' ? 'Laki-laki' : ($siswa->jk == 'P' ? 'Perempuan' : '-')); ?></span>
                    </div>
                    <div>
                        <span class="block text-xs text-slate-500">Agama</span>
                        <span class="font-medium text-slate-800"><?php echo e($siswa->agama ?? '-'); ?></span>
                    </div>
                </div>
                <div>
                    <span class="block text-xs text-slate-500">No. WhatsApp</span>
                    <span class="font-medium text-slate-800"><?php echo e($siswa->no_wa ?? '-'); ?></span>
                </div>
                <div>
                    <span class="block text-xs text-slate-500">Asal Sekolah</span>
                    <span class="font-medium text-slate-800"><?php echo e($siswa->asal_sekolah ?? '-'); ?></span>
                </div>
                <div>
                    <span class="block text-xs text-slate-500">NPSN Sekolah</span>
                    <span class="font-medium text-slate-800 font-mono"><?php echo e($siswa->npsn_sekolah ?? '-'); ?></span>
                </div>
                <div>
                    <span class="block text-xs text-slate-500">Alamat Sekolah</span>
                    <span class="font-medium text-slate-800"><?php echo e($siswa->alamat_sekolah ?? '-'); ?></span>
                </div>
                <div>
                    <span class="block text-xs text-slate-500">Alamat</span>
                    <span class="font-medium text-slate-800"><?php echo e($siswa->alamat ?? '-'); ?></span>
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <span class="block text-xs text-slate-500">Golongan Darah</span>
                        <span class="font-medium text-slate-800"><?php echo e($siswa->golongan_darah ?? '-'); ?></span>
                    </div>
                    <div>
                        <span class="block text-xs text-slate-500">Riwayat Penyakit</span>
                        <span class="font-medium text-slate-800"><?php echo e($siswa->riwayat_penyakit ?? '-'); ?></span>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <span class="block text-xs text-slate-500">Anak Ke</span>
                        <span class="font-medium text-slate-800"><?php echo e($siswa->anak_ke ?? '-'); ?></span>
                    </div>
                    <div>
                        <span class="block text-xs text-slate-500">Jumlah Saudara</span>
                        <span class="font-medium text-slate-800"><?php echo e($siswa->jumlah_saudara ?? '-'); ?></span>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <span class="block text-xs text-slate-500">Tinggi (cm)</span>
                        <span class="font-medium text-slate-800"><?php echo e($siswa->tinggi ?? '-'); ?></span>
                    </div>
                    <div>
                        <span class="block text-xs text-slate-500">Berat (kg)</span>
                        <span class="font-medium text-slate-800"><?php echo e($siswa->berat ?? '-'); ?></span>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="space-y-4">
            <div class="card p-4">
                <h3 class="font-semibold text-sm text-slate-800 mb-4 flex items-center gap-2 pb-2 border-b border-slate-100">
                    <svg class="w-4 h-4 text-[#4276A3]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    Data Pendaftaran
                </h3>
                <div class="space-y-3 text-sm">
                    <?php if($siswa->pendaftaran): ?>
                    <div>
                        <span class="block text-xs text-slate-500">Jurusan Pilihan</span>
                        <span class="font-medium text-[#4276A3]"><?php echo e($siswa->pendaftaran->jurusan->nama ?? '-'); ?></span>
                    </div>
                    <div>
                        <span class="block text-xs text-slate-500">Gelombang</span>
                        <span class="font-medium text-slate-800"><?php echo e($siswa->pendaftaran->gelombang ?? '-'); ?></span>
                    </div>
                    <div>
                        <span class="block text-xs text-slate-500">Tanggal Daftar</span>
                        <span class="font-medium text-slate-800"><?php echo e($siswa->pendaftaran->created_at->format('d M Y H:i')); ?></span>
                    </div>
                    <div>
                        <span class="block text-xs text-slate-500">Status</span>
                        <span class="inline-flex px-2 py-1 bg-[#4276A3]/10 text-[#4276A3] rounded text-xs font-medium"><?php echo e($siswa->pendaftaran->status_pendaftaran); ?></span>
                    </div>
                    <?php else: ?>
                    <p class="text-xs text-slate-500 italic">Belum melengkapi data pendaftaran.</p>
                    <?php endif; ?>
                </div>
            </div>

            <?php if($siswa->orangTua): ?>
            <div class="card p-4">
                <h3 class="font-semibold text-sm text-slate-800 mb-4 flex items-center gap-2 pb-2 border-b border-slate-100">
                    <svg class="w-4 h-4 text-[#4276A3]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                    Data <?php echo e($siswa->orangTua->jenis === 'wali' ? 'Wali' : 'Orang Tua'); ?>

                </h3>
                <div class="space-y-3 text-sm">
                    <?php if($siswa->orangTua->jenis === 'wali'): ?>
                        
                        <div>
                            <span class="block text-xs text-slate-500">Nama Wali</span>
                            <span class="font-medium text-slate-800"><?php echo e($siswa->orangTua->nama_wali ?? '-'); ?></span>
                        </div>
                        <div>
                            <span class="block text-xs text-slate-500">Pekerjaan Wali</span>
                            <span class="font-medium text-slate-800"><?php echo e($siswa->orangTua->pekerjaan_wali ?? '-'); ?></span>
                        </div>
                        <div>
                            <span class="block text-xs text-slate-500">No. HP Wali</span>
                            <span class="font-medium text-slate-800"><?php echo e($siswa->orangTua->no_hp_wali ?? '-'); ?></span>
                        </div>
                        <div>
                            <span class="block text-xs text-slate-500">Hubungan</span>
                            <span class="font-medium text-slate-800"><?php echo e($siswa->orangTua->hubungan_wali ?? '-'); ?></span>
                        </div>
                    <?php else: ?>
                        
                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <span class="block text-xs text-slate-500">Nama Ayah</span>
                                <span class="font-medium text-slate-800"><?php echo e($siswa->orangTua->nama_ayah ?? '-'); ?></span>
                            </div>
                            <div>
                                <span class="block text-xs text-slate-500">NIK Ayah</span>
                                <span class="font-medium text-slate-800 font-mono"><?php echo e($siswa->orangTua->nik_ayah ?? '-'); ?></span>
                            </div>
                        </div>
                        <div>
                            <span class="block text-xs text-slate-500">Status Ayah</span>
                            <span class="font-medium text-slate-800"><?php echo e($siswa->orangTua->status_ayah === 'meninggal' ? 'Meninggal' : 'Masih Hidup'); ?></span>
                        </div>
                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <span class="block text-xs text-slate-500">Pekerjaan Ayah</span>
                                <span class="font-medium text-slate-800"><?php echo e($siswa->orangTua->pekerjaan_ayah ?? '-'); ?></span>
                            </div>
                            <div>
                                <span class="block text-xs text-slate-500">Pendidikan Ayah</span>
                                <span class="font-medium text-slate-800"><?php echo e($siswa->orangTua->pendidikan_ayah ?? '-'); ?></span>
                            </div>
                        </div>
                        <div>
                            <span class="block text-xs text-slate-500">Penghasilan Ayah</span>
                            <span class="font-medium text-slate-800"><?php echo e($siswa->orangTua->penghasilan_ayah ?? '-'); ?></span>
                        </div>
                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <span class="block text-xs text-slate-500">Nama Ibu</span>
                                <span class="font-medium text-slate-800"><?php echo e($siswa->orangTua->nama_ibu ?? '-'); ?></span>
                            </div>
                            <div>
                                <span class="block text-xs text-slate-500">NIK Ibu</span>
                                <span class="font-medium text-slate-800 font-mono"><?php echo e($siswa->orangTua->nik_ibu ?? '-'); ?></span>
                            </div>
                        </div>
                        <div>
                            <span class="block text-xs text-slate-500">Status Ibu</span>
                            <span class="font-medium text-slate-800"><?php echo e($siswa->orangTua->status_ibu === 'meninggal' ? 'Meninggal' : 'Masih Hidup'); ?></span>
                        </div>
                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <span class="block text-xs text-slate-500">Pekerjaan Ibu</span>
                                <span class="font-medium text-slate-800"><?php echo e($siswa->orangTua->pekerjaan_ibu ?? '-'); ?></span>
                            </div>
                            <div>
                                <span class="block text-xs text-slate-500">Pendidikan Ibu</span>
                                <span class="font-medium text-slate-800"><?php echo e($siswa->orangTua->pendidikan_ibu ?? '-'); ?></span>
                            </div>
                        </div>
                        <div>
                            <span class="block text-xs text-slate-500">Penghasilan Ibu</span>
                            <span class="font-medium text-slate-800"><?php echo e($siswa->orangTua->penghasilan_ibu ?? '-'); ?></span>
                        </div>
                        <div>
                            <span class="block text-xs text-slate-500">No. WA Ortu</span>
                            <span class="font-medium text-slate-800"><?php echo e($siswa->orangTua->no_wa_ortu ?? '-'); ?></span>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <?php endif; ?>
        </div>

        
        <div class="space-y-4">
            
            <div class="card p-4">
                <?php
                    $berkasProgress = \App\Models\BerkasPendaftaran::getUploadProgress($siswa->id);
                ?>
                
                <h3 class="font-semibold text-sm text-slate-800 mb-4 flex items-center gap-2 pb-2 border-b border-slate-100">
                    <svg class="w-4 h-4 text-[#4276A3]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    Progress Upload Berkas
                </h3>
                
                
                <div class="mb-4">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-xs text-slate-600">Progress</span>
                        <span class="text-xs font-semibold <?php echo e($berkasProgress['is_complete'] ? 'text-[#4276A3]' : 'text-[#B45309]'); ?>">
                            <?php echo e($berkasProgress['uploaded']); ?>/<?php echo e($berkasProgress['total']); ?>

                        </span>
                    </div>
                    <div class="w-full bg-slate-200 rounded-full h-2">
                        <div class="bg-[#4276A3] h-2 rounded-full" style="width: <?php echo e($berkasProgress['percentage']); ?>%"></div>
                    </div>
                </div>
                
                
                <h4 class="font-semibold text-xs text-slate-700 mb-3">Detail Berkas</h4>
                <div class="space-y-2">
                    <?php $__currentLoopData = $berkasProgress['detail']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="flex items-start justify-between p-2 rounded border <?php echo e($item['uploaded'] ? 'border-[#4276A3]/30 bg-blue-50/50' : 'border-slate-200 bg-slate-50'); ?>">
                        <div class="flex items-start gap-2">
                            <div class="w-5 h-5 rounded-full <?php echo e($item['uploaded'] ? 'bg-[#4276A3]' : 'bg-gray-300'); ?> flex items-center justify-center flex-shrink-0 mt-0.5">
                                <?php if($item['uploaded']): ?>
                                <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <?php else: ?>
                                <span class="text-xs text-white font-bold"><?php echo e($loop->iteration); ?></span>
                                <?php endif; ?>
                            </div>
                            <div>
                                <span class="text-xs <?php echo e($item['uploaded'] ? 'text-[#4276A3] font-medium' : 'text-slate-600'); ?>"><?php echo e($item['label']); ?></span>
                            </div>
                        </div>
                        <?php if($item['uploaded']): ?>
                            <?php
                                $berkasFile = $siswa->berkasPendaftaran->where('jenis_berkas', $key)->first();
                            ?>
                            <?php if($berkasFile): ?>
                            <a href="<?php echo e(route('admin.berkas.download', $berkasFile->id)); ?>" target="_blank" class="text-xs text-[#4276A3] hover:underline">Unduh</a>
                            <?php endif; ?>
                        <?php else: ?>
                            <span class="text-xs text-slate-400">Belum</span>
                        <?php endif; ?>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>

            
            <?php if($siswa->pendaftaran?->tes): ?>
            <div class="card p-4 border-l-4 border-[#4276A3]">
                <h3 class="font-semibold text-sm text-slate-800 mb-4 flex items-center gap-2 pb-2 border-b border-slate-100">
                    <svg class="w-4 h-4 text-[#4276A3]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                    </svg>
                    Status Tes & Wawancara
                </h3>
                <div class="space-y-3 text-sm">
                    <div>
                        <span class="block text-xs text-slate-500">Status Wawancara</span>
                        <span class="inline-flex px-2 py-1 text-xs rounded font-medium <?php echo e($siswa->pendaftaran->tes->status_wawancara === 'sudah' ? 'bg-[#4276A3]/10 text-[#4276A3]' : 'bg-[#B45309]/10 text-[#B45309]'); ?>">
                            <?php echo e($siswa->pendaftaran->tes->status_wawancara === 'sudah' ? 'Sudah' : 'Belum'); ?>

                        </span>
                    </div>
                    <?php if($siswa->pendaftaran->tes->nilai_minat_bakat): ?>
                    <div>
                        <span class="block text-xs text-slate-500">Minat dan Bakat</span>
                        <p class="font-medium text-slate-800 text-xs mt-1"><?php echo e($siswa->pendaftaran->tes->nilai_minat_bakat); ?></p>
                    </div>
                    <?php endif; ?>
                    <?php if($siswa->pendaftaran->tes->status_kelulusan): ?>
                    <div>
                        <span class="block text-xs text-slate-500">Status Kelulusan</span>
                        <span class="inline-flex px-2 py-1 text-xs rounded font-medium <?php echo e($siswa->pendaftaran->tes->status_kelulusan === 'Lulus' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700'); ?>">
                            <?php echo e($siswa->pendaftaran->tes->status_kelulusan); ?>

                        </span>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            <?php endif; ?>

            
            <?php
                $pembayaran = $siswa->pembayaranPendaftaran;
                $statusColors = [
                    'belum_bayar' => 'bg-gray-100 text-gray-700',
                    'menunggu_verifikasi' => 'bg-yellow-100 text-yellow-700',
                    'diterima' => 'bg-green-100 text-green-700',
                    'ditolak' => 'bg-red-100 text-red-700',
                ];
                $statusLabels = [
                    'belum_bayar' => 'Belum Bayar',
                    'menunggu_verifikasi' => 'Menunggu Verifikasi',
                    'diterima' => 'Diterima',
                    'ditolak' => 'Ditolak',
                ];
            ?>
            <div class="card p-4">
                <h3 class="font-semibold text-sm text-slate-800 mb-4 flex items-center gap-2 pb-2 border-b border-slate-100">
                    <svg class="w-4 h-4 text-[#4276A3]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                    Status Pembayaran
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                    <div>
                        <span class="block text-xs text-slate-500">Status</span>
                        <span class="inline-flex px-2 py-1 rounded text-xs font-medium <?php echo e($statusColors[$pembayaran?->status] ?? 'bg-gray-100 text-gray-700'); ?>">
                            <?php echo e($statusLabels[$pembayaran?->status] ?? 'Belum Bayar'); ?>

                        </span>
                    </div>
                    <div>
                        <span class="block text-xs text-slate-500">Metode Pembayaran</span>
                        <span class="font-medium text-slate-800"><?php echo e($pembayaran?->metode_pembayaran ?? '-'); ?></span>
                    </div>
                    <div>
                        <span class="block text-xs text-slate-500">Tanggal Bayar</span>
                        <span class="font-medium text-slate-800"><?php echo e($pembayaran?->tanggal_bayar?->format('d M Y') ?? '-'); ?></span>
                    </div>
                </div>
                <?php if($pembayaran && $pembayaran->bukti_pembayaran): ?>
                <div class="mt-3 pt-3 border-t border-slate-100">
                    <span class="block text-xs text-slate-500 mb-2">Bukti Pembayaran</span>
                    <a href="<?php echo e(route('admin.pembayaran.preview', $pembayaran->id)); ?>" target="_blank" class="inline-flex items-center text-sm text-[#4276A3]">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                        Lihat Bukti Pembayaran
                    </a>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    
    <div class="mt-6 flex justify-end gap-2 pt-4 border-t border-slate-200">
        <a href="<?php echo e(route('admin.pendaftar.index')); ?>" 
           class="btn btn-secondary">
            Kembali
        </a>
        <a href="<?php echo e(route('admin.pendaftar.edit', $siswa->id)); ?>" class="btn btn-primary">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
            </svg>
            Edit Data
        </a>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\eka\.gemini\antigravity\scratch\smk-alstar\resources\views/admin/pendaftar-show.blade.php ENDPATH**/ ?>