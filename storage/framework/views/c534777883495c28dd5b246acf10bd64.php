<?php $__env->startSection('title', 'Profil Saya - SMK Al-Hidayah Lestari'); ?>

<?php $__env->startSection('content'); ?>
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-blue-50 py-8">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <?php if(session('success')): ?>
        <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-700 rounded-xl flex items-center gap-3 animate-fade-in">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <?php echo e(session('success')); ?>

        </div>
        <?php endif; ?>

        <?php if(session('error')): ?>
        <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-700 rounded-xl flex items-center gap-3">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <?php echo e(session('error')); ?>

        </div>
        <?php endif; ?>

        <!-- Error upload foto -->
        <?php if($errors->has('foto')): ?>
        <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-700 rounded-xl flex items-center gap-3">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <?php echo e($errors->first('foto')); ?>

        </div>
        <?php endif; ?>

        <div class="grid lg:grid-cols-3 gap-6">
            
            <!-- Left Column: Profile Card -->
            <div class="lg:col-span-1">
                <!-- Profile Card -->
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                    <div class="h-24 bg-gradient-to-r from-primary to-blue-600"></div>
                    <div class="px-6 pb-6">
                        <!-- Profile Photo -->
                        <div class="relative -mt-12 mb-4 flex justify-center">
                            <div class="relative group">
                                <div class="w-24 h-24 rounded-full border-4 border-white shadow-lg overflow-hidden bg-gray-100">
                                    <?php if($calonSiswa->foto && file_exists(public_path('storage/foto/' . $calonSiswa->foto))): ?>
                                    <img src="<?php echo e(asset('storage/foto/' . $calonSiswa->foto)); ?>?v=<?php echo e(time()); ?>" alt="Foto Profil" class="w-full h-full object-cover" id="previewFoto">
                                    <?php else: ?>
                                    <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-primary/20 to-blue-500/20" id="defaultFoto">
                                        <svg class="w-12 h-12 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                        </svg>
                                    </div>
                                    <?php endif; ?>
                                </div>
                                <!-- Upload Button -->
                                <label for="fotoInput" class="absolute bottom-0 right-0 w-8 h-8 bg-primary text-white rounded-full shadow-lg flex items-center justify-center hover:bg-primary/90 transition transform hover:scale-105 cursor-pointer">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                </label>
                            </div>
                        </div>

                        <!-- Hidden Form for Photo Upload -->
                        <form id="fotoForm" action="<?php echo e(route('spmb.profil.foto')); ?>" method="POST" enctype="multipart/form-data" class="hidden">
                            <?php echo csrf_field(); ?>
                            <input type="file" id="fotoInput" name="foto" accept="image/jpeg,image/png,image/jpg" onchange="uploadFoto(this)">
                        </form>

                        <!-- User Info -->
                        <div class="text-center mb-6">
                            <h1 class="text-xl font-bold text-gray-900"><?php echo e($calonSiswa->nama); ?></h1>
                            <p class="text-sm text-gray-500"><?php echo e($calonSiswa->nisn); ?></p>
                            <div class="mt-2 inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-medium
                                <?php echo e($calonSiswa->jk === 'L' ? 'bg-blue-100 text-blue-700' : 'bg-pink-100 text-pink-700'); ?>">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <?php if($calonSiswa->jk === 'L'): ?>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                    <?php else: ?>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                    <?php endif; ?>
                                </svg>
                                <?php echo e($calonSiswa->jk === 'L' ? 'Laki-laki' : 'Perempuan'); ?>

                            </div>
                        </div>

                        <!-- Quick Stats -->
                        <div class="grid grid-cols-2 gap-3 mb-6">
                            <div class="text-center p-3 bg-gray-50 rounded-xl">
                                <p class="text-xs text-gray-500 mb-1">Status</p>
                                <?php if($calonSiswa->pendaftaran?->tes?->status_kelulusan === 'Lulus'): ?>
                                <span class="inline-flex items-center gap-1 text-xs font-bold text-green-600">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4"/>
                                    </svg>
                                    LULUS
                                </span>
                                <?php elseif($calonSiswa->pendaftaran?->tes?->status_kelulusan === 'Tidak Lulus'): ?>
                                <span class="inline-flex items-center gap-1 text-xs font-bold text-red-600">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                    TIDAK LULUS
                                </span>
                                <?php else: ?>
                                <span class="inline-flex items-center gap-1 text-xs font-bold text-yellow-600">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    PROSES
                                </span>
                                <?php endif; ?>
                            </div>
                            <div class="text-center p-3 bg-gray-50 rounded-xl">
                                <p class="text-xs text-gray-500 mb-1">Gelombang</p>
                                <p class="text-xs font-bold text-primary"><?php echo e($calonSiswa->pendaftaran?->gelombang ?? 'Gelombang 1'); ?></p>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="space-y-2">
                            <a href="<?php echo e(route('spmb.profil.edit')); ?>" 
                                class="flex items-center justify-center gap-2 w-full px-4 py-2.5 bg-primary text-white rounded-xl font-medium hover:bg-primary/90 transition shadow-lg shadow-primary/25">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                                Edit Profil
                            </a>
                            <?php if($calonSiswa->foto): ?>
                            <form action="<?php echo e(route('spmb.profil.foto.hapus')); ?>" method="POST" class="block" onsubmit="return confirm('Yakin ingin menghapus foto profil?')">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit"
                                    class="flex items-center justify-center gap-2 w-full px-4 py-2.5 border border-red-200 text-red-600 rounded-xl font-medium hover:bg-red-50 transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                    Hapus Foto
                                </button>
                            </form>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <!-- Contact Support Card -->
                <div class="mt-6 bg-gradient-to-br from-primary to-blue-600 rounded-2xl p-5 text-white shadow-lg">
                    <h3 class="font-semibold text-sm mb-1">Butuh Bantuan?</h3>
                    <p class="text-xs text-white/80 mb-3">Hubungi panitia SPMB jika ada kendala</p>
                    <a href="https://wa.me/628812489572" target="_blank" 
                        class="inline-flex items-center gap-2 bg-white/20 hover:bg-white/30 px-3 py-2 rounded-lg text-xs font-medium transition">
                        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                        </svg>
                        Hubungi via WhatsApp
                    </a>
                </div>
            </div>

            <!-- Right Column: Details -->
            <div class="lg:col-span-2 space-y-6">
                
                <!-- Data Diri Section -->
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-100 bg-gray-50/50 flex items-center justify-between">
                        <h2 class="font-semibold text-gray-900 flex items-center gap-2">
                            <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            Data Diri Siswa
                        </h2>
                        <a href="<?php echo e(route('spmb.profil.edit')); ?>" class="text-primary hover:text-primary/80 text-sm font-medium">
                            Edit
                        </a>
                    </div>
                    <div class="p-6">
                        <div class="grid md:grid-cols-2 gap-6">
                            <div class="space-y-1">
                                <p class="text-xs text-gray-400 uppercase tracking-wider">NISN</p>
                                <p class="font-medium text-gray-900"><?php echo e($calonSiswa->nisn); ?></p>
                            </div>
                            <div class="space-y-1">
                                <p class="text-xs text-gray-400 uppercase tracking-wider">NIK</p>
                                <p class="font-medium text-gray-900"><?php echo e($calonSiswa->nik ?? '-'); ?></p>
                            </div>
                            <div class="space-y-1">
                                <p class="text-xs text-gray-400 uppercase tracking-wider">Nama Lengkap</p>
                                <p class="font-medium text-gray-900"><?php echo e($calonSiswa->nama); ?></p>
                            </div>
                            <div class="space-y-1">
                                <p class="text-xs text-gray-400 uppercase tracking-wider">Jenis Kelamin</p>
                                <p class="font-medium text-gray-900"><?php echo e($calonSiswa->jk == 'L' ? 'Laki-laki' : 'Perempuan'); ?></p>
                            </div>
                            <div class="space-y-1">
                                <p class="text-xs text-gray-400 uppercase tracking-wider">Tempat, Tanggal Lahir</p>
                                <p class="font-medium text-gray-900">
                                    <?php echo e($calonSiswa->tempat_lahir ?? '-'); ?>, <?php echo e($calonSiswa->tgl_lahir ? \Carbon\Carbon::parse($calonSiswa->tgl_lahir)->format('d F Y') : '-'); ?>

                                </p>
                            </div>
                            <div class="space-y-1">
                                <p class="text-xs text-gray-400 uppercase tracking-wider">No. WhatsApp</p>
                                <p class="font-medium text-gray-900"><?php echo e($calonSiswa->no_wa); ?></p>
                            </div>
                            <div class="space-y-1 md:col-span-2">
                                <p class="text-xs text-gray-400 uppercase tracking-wider">Alamat Lengkap</p>
                                <p class="font-medium text-gray-900"><?php echo e($calonSiswa->alamat ?? '-'); ?></p>
                            </div>
                            <div class="space-y-1 md:col-span-2">
                                <p class="text-xs text-gray-400 uppercase tracking-wider">Asal Sekolah</p>
                                <p class="font-medium text-gray-900"><?php echo e($calonSiswa->asal_sekolah); ?></p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Data Orang Tua / Wali Section -->
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-100 bg-gray-50/50 flex items-center justify-between">
                        <h2 class="font-semibold text-gray-900 flex items-center gap-2">
                            <?php if($calonSiswa->orangTua?->jenis === 'wali'): ?>
                            <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            Data Wali
                            <?php else: ?>
                            <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            Data Orang Tua
                            <?php endif; ?>
                        </h2>
                        <a href="<?php echo e(route('spmb.profil.edit')); ?>" class="text-primary hover:text-primary/80 text-sm font-medium">
                            Edit
                        </a>
                    </div>
                    <div class="p-6">
                        <?php if($calonSiswa->orangTua): ?>
                            <?php if($calonSiswa->orangTua->jenis === 'wali'): ?>
                            <!-- Data Wali -->
                            <div class="grid md:grid-cols-2 gap-6">
                                <div class="space-y-1">
                                    <p class="text-xs text-gray-400 uppercase tracking-wider">Nama Wali</p>
                                    <p class="font-medium text-gray-900"><?php echo e($calonSiswa->orangTua->nama_wali ?? '-'); ?></p>
                                </div>
                                <div class="space-y-1">
                                    <p class="text-xs text-gray-400 uppercase tracking-wider">Pekerjaan Wali</p>
                                    <p class="font-medium text-gray-900"><?php echo e($calonSiswa->orangTua->pekerjaan_wali ?? '-'); ?></p>
                                </div>
                                <div class="space-y-1">
                                    <p class="text-xs text-gray-400 uppercase tracking-wider">No. HP Wali</p>
                                    <p class="font-medium text-gray-900"><?php echo e($calonSiswa->orangTua->no_hp_wali ?? '-'); ?></p>
                                </div>
                                <div class="space-y-1">
                                    <p class="text-xs text-gray-400 uppercase tracking-wider">Hubungan</p>
                                    <p class="font-medium text-gray-900"><?php echo e($calonSiswa->orangTua->hubungan_wali ?? '-'); ?></p>
                                </div>
                            </div>
                            <?php else: ?>
                            <!-- Data Orang Tua -->
                            <div class="grid md:grid-cols-2 gap-6">
                                <div class="space-y-1">
                                    <p class="text-xs text-gray-400 uppercase tracking-wider">Nama Ayah</p>
                                    <p class="font-medium text-gray-900"><?php echo e($calonSiswa->orangTua->nama_ayah ?? '-'); ?></p>
                                </div>
                                <div class="space-y-1">
                                    <p class="text-xs text-gray-400 uppercase tracking-wider">Nama Ibu</p>
                                    <p class="font-medium text-gray-900"><?php echo e($calonSiswa->orangTua->nama_ibu ?? '-'); ?></p>
                                </div>
                                <div class="space-y-1">
                                    <p class="text-xs text-gray-400 uppercase tracking-wider">Pekerjaan Ayah</p>
                                    <p class="font-medium text-gray-900"><?php echo e($calonSiswa->orangTua->pekerjaan_ayah ?? '-'); ?></p>
                                </div>
                                <div class="space-y-1">
                                    <p class="text-xs text-gray-400 uppercase tracking-wider">Pekerjaan Ibu</p>
                                    <p class="font-medium text-gray-900"><?php echo e($calonSiswa->orangTua->pekerjaan_ibu ?? '-'); ?></p>
                                </div>
                                <div class="space-y-1 md:col-span-2">
                                    <p class="text-xs text-gray-400 uppercase tracking-wider">No. WhatsApp Orang Tua</p>
                                    <p class="font-medium text-gray-900"><?php echo e($calonSiswa->orangTua->no_wa_ortu ?? '-'); ?></p>
                                </div>
                            </div>
                            <?php endif; ?>
                        <?php else: ?>
                        <div class="text-center py-8">
                            <div class="w-16 h-16 mx-auto mb-4 bg-gray-100 rounded-full flex items-center justify-center">
                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                                </svg>
                            </div>
                            <p class="text-gray-500 mb-4">Data orang tua/wali belum dilengkapi</p>
                            <a href="<?php echo e(route('spmb.lengkapi-data')); ?>" class="inline-flex items-center gap-2 px-4 py-2 bg-primary text-white rounded-lg text-sm font-medium hover:bg-primary/90 transition">
                                Lengkapi Data
                            </a>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Pendaftaran Section -->
                <?php if($calonSiswa->pendaftaran): ?>
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-100 bg-gray-50/50">
                        <h2 class="font-semibold text-gray-900 flex items-center gap-2">
                            <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            Informasi Pendaftaran
                        </h2>
                    </div>
                    <div class="p-6">
                        <div class="grid md:grid-cols-2 gap-6">
                            <div class="space-y-1">
                                <p class="text-xs text-gray-400 uppercase tracking-wider">Jurusan Pilihan</p>
                                <p class="font-bold text-primary text-lg"><?php echo e($calonSiswa->pendaftaran->jurusan->nama ?? '-'); ?></p>
                            </div>
                            <div class="space-y-1">
                                <p class="text-xs text-gray-400 uppercase tracking-wider">Gelombang</p>
                                <p class="font-medium text-gray-900"><?php echo e($calonSiswa->pendaftaran->gelombang ?? 'Gelombang 1'); ?></p>
                            </div>
                            <div class="space-y-1">
                                <p class="text-xs text-gray-400 uppercase tracking-wider">Status Pendaftaran</p>
                                <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-medium
                                    <?php if($calonSiswa->pendaftaran->status_pendaftaran === 'Terdaftar'): ?> bg-green-100 text-green-700
                                    <?php elseif($calonSiswa->pendaftaran->status_pendaftaran === 'Diverifikasi'): ?> bg-blue-100 text-blue-700
                                    <?php else: ?> bg-yellow-100 text-yellow-700
                                    <?php endif; ?>">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4"/>
                                    </svg>
                                    <?php echo e($calonSiswa->pendaftaran->status_pendaftaran); ?>

                                </span>
                            </div>
                            <div class="space-y-1">
                                <p class="text-xs text-gray-400 uppercase tracking-wider">Tanggal Daftar</p>
                                <p class="font-medium text-gray-900"><?php echo e($calonSiswa->pendaftaran->created_at->format('d F Y')); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif; ?>

            </div>
        </div>
    </div>
</div>

<script>
function uploadFoto(input) {
    if (input.files && input.files[0]) {
        // Validate file size (max 2MB)
        if (input.files[0].size > 2 * 1024 * 1024) {
            alert('Ukuran foto maksimal 2MB');
            input.value = '';
            return;
        }
        
        // Validate file type
        const allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
        if (!allowedTypes.includes(input.files[0].type)) {
            alert('Format foto harus JPG, JPEG, atau PNG');
            input.value = '';
            return;
        }
        
        // Submit form
        document.getElementById('fotoForm').submit();
    }
}
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\user\.gemini\antigravity\scratch\smkalstar\smkalstar\resources\views/spmb/profil.blade.php ENDPATH**/ ?>