<?php $__env->startSection('title', 'Tambah Calon Siswa - Admin Panel'); ?>

<?php $__env->startSection('content'); ?>
    
    <div class="mb-4">
        <a href="<?php echo e(route('admin.pendaftar.index')); ?>" class="inline-flex items-center gap-1.5 text-sm text-gray-500 hover:text-primary transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Kembali ke Daftar Pendaftar
        </a>
    </div>

    
    <div class="mb-6">
        <h1 class="text-xl font-bold text-gray-900">Tambah Calon Siswa Baru</h1>
        <p class="text-sm text-gray-500 mt-1">Isi data lengkap calon siswa untuk pendaftaran SPMB</p>
    </div>

    
    <?php if(session('error')): ?>
    <div class="mb-4 p-3 bg-red-50 border border-red-200 text-red-700 rounded-lg text-sm">
        <?php echo e(session('error')); ?>

    </div>
    <?php endif; ?>

    <?php if($errors->any()): ?>
    <div class="mb-4 p-3 bg-red-50 border border-red-200 text-red-700 rounded-lg text-sm">
        <p class="font-medium mb-1">Terdapat kesalahan:</p>
        <ul class="list-disc list-inside text-xs">
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
    <?php endif; ?>

    <form action="<?php echo e(route('admin.pendaftar.store')); ?>" method="POST" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
            
            <div class="card p-4">
                <h3 class="font-semibold text-sm text-gray-800 mb-4 flex items-center gap-2 pb-2 border-b border-gray-100">
                    <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    Data Siswa <span class="text-red-500">*</span>
                </h3>
                <div class="space-y-3">
                    
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1">
                            NISN <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="nisn" value="<?php echo e(old('nisn')); ?>" required maxlength="10"
                               class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary font-mono"
                               placeholder="10 digit NISN">
                    </div>

                    
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1">
                            NIK <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="nik" value="<?php echo e(old('nik')); ?>" required maxlength="16"
                               class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary font-mono"
                               placeholder="16 digit NIK">
                    </div>

                    
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1">
                            Nomor KK <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="no_kk" value="<?php echo e(old('no_kk')); ?>" required maxlength="16"
                               class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary font-mono"
                               placeholder="16 digit Nomor KK">
                    </div>

                    
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1">
                            Nama Lengkap <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="nama" value="<?php echo e(old('nama')); ?>" required 
                               class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary">
                    </div>

                    
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1">Tempat Lahir</label>
                        <input type="text" name="tempat_lahir" value="<?php echo e(old('tempat_lahir')); ?>" 
                               class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary">
                    </div>

                    
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1">Tanggal Lahir</label>
                        <input type="date" name="tgl_lahir" value="<?php echo e(old('tgl_lahir')); ?>" 
                               class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary">
                    </div>

                    
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1">
                            Jenis Kelamin <span class="text-red-500">*</span>
                        </label>
                        <div class="flex gap-4 mt-1">
                            <label class="flex items-center cursor-pointer">
                                <input type="radio" name="jk" value="L" 
                                    <?php echo e(old('jk') === 'L' ? 'checked' : ''); ?>

                                    class="w-4 h-4 text-primary border-gray-300 focus:ring-primary">
                                <span class="ml-2 text-sm text-gray-700">Laki-laki</span>
                            </label>
                            <label class="flex items-center cursor-pointer">
                                <input type="radio" name="jk" value="P" 
                                    <?php echo e(old('jk') === 'P' ? 'checked' : ''); ?>

                                    class="w-4 h-4 text-primary border-gray-300 focus:ring-primary">
                                <span class="ml-2 text-sm text-gray-700">Perempuan</span>
                            </label>
                        </div>
                    </div>

                    
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1">No. WhatsApp</label>
                        <input type="text" name="no_wa" value="<?php echo e(old('no_wa')); ?>" 
                               placeholder="081234567890"
                               class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary">
                    </div>

                    
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1">Asal Sekolah</label>
                        <input type="text" name="asal_sekolah" value="<?php echo e(old('asal_sekolah')); ?>" 
                               placeholder="Nama SMP/MTs"
                               class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary">
                    </div>

                    
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1">Alamat Sekolah Asal <span class="text-red-500">*</span></label>
                        <textarea name="alamat_sekolah" rows="2" required placeholder="Alamat lengkap sekolah..."
                                  class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary"><?php echo e(old('alamat_sekolah')); ?></textarea>
                    </div>

                    
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1">Alamat Rumah <span class="text-red-500">*</span></label>
                        <textarea name="alamat" rows="3" required placeholder="Alamat lengkap..."
                                  class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary"><?php echo e(old('alamat')); ?></textarea>
                    </div>

                    
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1">
                            Password <span class="text-red-500">*</span>
                        </label>
                        <input type="password" name="password" required 
                               class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary"
                               placeholder="Min. 6 karakter">
                        <p class="text-xs text-gray-500 mt-1">Password untuk login siswa</p>
                    </div>
                </div>
            </div>

            
            <div class="space-y-4">
                
                <div class="card p-4">
                    <h3 class="font-semibold text-sm text-gray-800 mb-4 flex items-center gap-2 pb-2 border-b border-gray-100">
                        <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        Data Pendaftaran
                    </h3>
                    <div class="space-y-3">
                        <div>
                            <label class="block text-xs font-medium text-gray-600 mb-1">Jurusan</label>
                            <select name="jurusan_id" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary bg-white">
                                <option value="">-- Pilih Jurusan --</option>
                                <?php $__currentLoopData = $jurusan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $j): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($j->id); ?>" <?php echo e(old('jurusan_id') == $j->id ? 'selected' : ''); ?>>
                                    <?php echo e($j->nama); ?>

                                </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-600 mb-1">Gelombang</label>
                            <input type="text" name="gelombang" value="<?php echo e(old('gelombang', 'Gelombang 1')); ?>" 
                                   placeholder="Gelombang 1"
                                   class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary">
                        </div>
                    </div>
                </div>

                
                <div class="card p-4 border-l-4 border-primary">
                    <h3 class="font-semibold text-sm text-gray-800 mb-4 flex items-center gap-2 pb-2 border-b border-gray-100">
                        <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                        </svg>
                        Status Tes & Wawancara
                    </h3>
                    <div class="space-y-3">
                        
                        <div>
                            <label class="block text-xs font-medium text-gray-600 mb-1">
                                Status Wawancara
                            </label>
                            <select name="status_wawancara" 
                                    class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary bg-white">
                                <option value="belum" <?php echo e(old('status_wawancara', 'belum') == 'belum' ? 'selected' : ''); ?>>
                                    Belum
                                </option>
                                <option value="sudah" <?php echo e(old('status_wawancara') == 'sudah' ? 'selected' : ''); ?>>
                                    Sudah
                                </option>
                            </select>
                            <p class="text-xs text-gray-500 mt-1">
                                * Jika diubah ke "Sudah", siswa otomatis dinyatakan <strong>LULUS</strong>
                            </p>
                        </div>

                        
                        <div>
                            <label class="block text-xs font-medium text-gray-600 mb-1">
                                Minat dan Bakat
                            </label>
                            <textarea name="nilai_minat_bakat" rows="3"
                                   placeholder="Deskripsikan minat dan bakat siswa..."
                                   class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary"><?php echo e(old('nilai_minat_bakat')); ?></textarea>
                            <p class="text-xs text-gray-500 mt-1">Isi secara manual berdasarkan hasil tes</p>
                        </div>
                    </div>
                </div>

                
                <div class="card p-4">
                    <h3 class="font-semibold text-sm text-gray-800 mb-4 flex items-center gap-2 pb-2 border-b border-gray-100">
                        <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                        Data Orang Tua / Wali
                    </h3>
                    
                    
                    <div class="mb-4">
                        <label class="block text-xs font-medium text-gray-600 mb-2">Pilih Jenis <span class="text-red-500">*</span></label>
                        <div class="flex gap-4">
                            <label class="flex items-center cursor-pointer">
                                <input type="radio" name="jenis" value="orang_tua" 
                                    <?php echo e(old('jenis', 'orang_tua') === 'orang_tua' ? 'checked' : ''); ?>

                                    class="jenis-radio w-4 h-4 text-primary border-gray-300 focus:ring-primary"
                                    onchange="toggleJenis()">
                                <span class="ml-2 text-sm text-gray-700">Orang Tua</span>
                            </label>
                            <label class="flex items-center cursor-pointer">
                                <input type="radio" name="jenis" value="wali" 
                                    <?php echo e(old('jenis') === 'wali' ? 'checked' : ''); ?>

                                    class="jenis-radio w-4 h-4 text-primary border-gray-300 focus:ring-primary"
                                    onchange="toggleJenis()">
                                <span class="ml-2 text-sm text-gray-700">Wali</span>
                            </label>
                        </div>
                    </div>

                    
                    <div id="form-orang-tua" class="space-y-3">
                        <div class="grid grid-cols-2 gap-3">
                            
                            <div>
                                <label class="block text-xs font-medium text-gray-600 mb-1">Nama Ayah <span class="text-red-500">*</span></label>
                                <input type="text" id="nama_ayah" name="nama_ayah" 
                                       value="<?php echo e(old('nama_ayah')); ?>"
                                       class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary">
                            </div>
                            
                            <div>
                                <label class="block text-xs font-medium text-gray-600 mb-1">NIK Ayah <span class="text-red-500">*</span></label>
                                <input type="text" id="nik_ayah" name="nik_ayah" maxlength="16"
                                       value="<?php echo e(old('nik_ayah')); ?>"
                                       placeholder="16 digit NIK"
                                       class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary font-mono">
                            </div>
                        </div>

                        
                        <div>
                            <label class="block text-xs font-medium text-gray-600 mb-1">Status Ayah <span class="text-red-500">*</span></label>
                            <div class="flex gap-4 mt-1">
                                <label class="flex items-center cursor-pointer">
                                    <input type="radio" name="status_ayah" value="hidup" 
                                        <?php echo e(old('status_ayah', 'hidup') === 'hidup' ? 'checked' : ''); ?>

                                        class="w-4 h-4 text-primary border-gray-300 focus:ring-primary">
                                    <span class="ml-2 text-sm text-gray-700">Masih Hidup</span>
                                </label>
                                <label class="flex items-center cursor-pointer">
                                    <input type="radio" name="status_ayah" value="meninggal" 
                                        <?php echo e(old('status_ayah') === 'meninggal' ? 'checked' : ''); ?>

                                        class="w-4 h-4 text-primary border-gray-300 focus:ring-primary">
                                    <span class="ml-2 text-sm text-gray-700">Meninggal</span>
                                </label>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-3">
                            
                            <div>
                                <label class="block text-xs font-medium text-gray-600 mb-1">Nama Ibu <span class="text-red-500">*</span></label>
                                <input type="text" id="nama_ibu" name="nama_ibu" 
                                       value="<?php echo e(old('nama_ibu')); ?>"
                                       class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary">
                            </div>
                            
                            <div>
                                <label class="block text-xs font-medium text-gray-600 mb-1">NIK Ibu <span class="text-red-500">*</span></label>
                                <input type="text" id="nik_ibu" name="nik_ibu" maxlength="16"
                                       value="<?php echo e(old('nik_ibu')); ?>"
                                       placeholder="16 digit NIK"
                                       class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary font-mono">
                            </div>
                        </div>

                        
                        <div>
                            <label class="block text-xs font-medium text-gray-600 mb-1">Status Ibu <span class="text-red-500">*</span></label>
                            <div class="flex gap-4 mt-1">
                                <label class="flex items-center cursor-pointer">
                                    <input type="radio" name="status_ibu" value="hidup" 
                                        <?php echo e(old('status_ibu', 'hidup') === 'hidup' ? 'checked' : ''); ?>

                                        class="w-4 h-4 text-primary border-gray-300 focus:ring-primary">
                                    <span class="ml-2 text-sm text-gray-700">Masih Hidup</span>
                                </label>
                                <label class="flex items-center cursor-pointer">
                                    <input type="radio" name="status_ibu" value="meninggal" 
                                        <?php echo e(old('status_ibu') === 'meninggal' ? 'checked' : ''); ?>

                                        class="w-4 h-4 text-primary border-gray-300 focus:ring-primary">
                                    <span class="ml-2 text-sm text-gray-700">Meninggal</span>
                                </label>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-3">
                            
                            <div>
                                <label class="block text-xs font-medium text-gray-600 mb-1">Pekerjaan Ayah <span class="text-red-500">*</span></label>
                                <input type="text" id="pekerjaan_ayah" name="pekerjaan_ayah" 
                                       value="<?php echo e(old('pekerjaan_ayah')); ?>"
                                       placeholder="Contoh: Wiraswasta"
                                       class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary">
                            </div>
                            
                            <div>
                                <label class="block text-xs font-medium text-gray-600 mb-1">Pekerjaan Ibu <span class="text-red-500">*</span></label>
                                <input type="text" id="pekerjaan_ibu" name="pekerjaan_ibu" 
                                       value="<?php echo e(old('pekerjaan_ibu')); ?>"
                                       placeholder="Contoh: Ibu Rumah Tangga"
                                       class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary">
                            </div>
                        </div>

                        <div>
                            
                            <label class="block text-xs font-medium text-gray-600 mb-1">No. WA Ortu <span class="text-red-500">*</span></label>
                            <input type="text" id="no_wa_ortu" name="no_wa_ortu" 
                                   value="<?php echo e(old('no_wa_ortu')); ?>"
                                   placeholder="081234567890"
                                   class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary">
                        </div>
                    </div>

                    
                    <div id="form-wali" class="hidden space-y-3">
                        <div class="grid grid-cols-2 gap-3">
                            
                            <div>
                                <label class="block text-xs font-medium text-gray-600 mb-1">Nama Wali <span class="text-red-500">*</span></label>
                                <input type="text" id="nama_wali" name="nama_wali" 
                                       value="<?php echo e(old('nama_wali')); ?>"
                                       class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary">
                            </div>
                            
                            <div>
                                <label class="block text-xs font-medium text-gray-600 mb-1">Pekerjaan Wali <span class="text-red-500">*</span></label>
                                <input type="text" id="pekerjaan_wali" name="pekerjaan_wali" 
                                       value="<?php echo e(old('pekerjaan_wali')); ?>"
                                       placeholder="Contoh: PNS"
                                       class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary">
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-3">
                            
                            <div>
                                <label class="block text-xs font-medium text-gray-600 mb-1">No. HP Wali <span class="text-red-500">*</span></label>
                                <input type="text" id="no_hp_wali" name="no_hp_wali" 
                                       value="<?php echo e(old('no_hp_wali')); ?>"
                                       placeholder="081234567890"
                                       class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary">
                            </div>
                            
                            <div>
                                <label class="block text-xs font-medium text-gray-600 mb-1">Hubungan <span class="text-red-500">*</span></label>
                                <input type="text" id="hubungan_wali" name="hubungan_wali" 
                                       value="<?php echo e(old('hubungan_wali')); ?>"
                                       placeholder="Contoh: Paman, Bibi"
                                       class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="card p-4">
                <h3 class="font-semibold text-sm text-gray-800 mb-4 flex items-center gap-2 pb-2 border-b border-gray-100">
                    <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    Upload Berkas Pendaftaran
                </h3>
                
                <div class="space-y-4">
                    <?php $__currentLoopData = $berkasList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="p-3 border border-gray-200 rounded-lg bg-gray-50 hover:border-primary/50 transition group">
                            <label class="block text-xs font-medium text-gray-700 mb-2">
                                <?php echo e($label); ?> <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <input type="file" name="berkas[<?php echo e($key); ?>]" id="berkas_<?php echo e($key); ?>"
                                       accept=".pdf,.jpg,.jpeg,.png" required
                                       class="hidden"
                                       onchange="updateFileLabel(this, '<?php echo e($key); ?>')">
                                <label for="berkas_<?php echo e($key); ?>" 
                                       class="flex items-center gap-3 cursor-pointer">
                                    <div class="flex-1 px-3 py-2 bg-white border border-gray-300 rounded-md text-sm text-gray-500 truncate group-hover:border-primary/50 transition"
                                         id="label_<?php echo e($key); ?>">
                                        <span class="file-placeholder">Pilih file...</span>
                                    </div>
                                    <div class="px-3 py-2 bg-gradient-to-r from-primary to-primary-dark text-white rounded-md text-xs font-medium shadow-md whitespace-nowrap cursor-pointer hover:shadow-lg transition">
                                        Browse
                                    </div>
                                </label>
                            </div>
                            <p class="text-xs text-gray-500 mt-1.5 flex items-center gap-1">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                Format: PDF, JPG, PNG (Max 5MB)
                            </p>
                            <div id="preview_<?php echo e($key); ?>" class="mt-2 hidden">
                                <div class="flex items-center gap-2 p-2 bg-blue-50 border border-blue-200 rounded-md">
                                    <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    <span class="text-xs text-blue-700 font-medium file-name">File terpilih</span>
                                    <button type="button" onclick="clearFile('<?php echo e($key); ?>')" class="ml-auto text-xs text-red-500 hover:text-red-700">
                                        Hapus
                                    </button>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

                <div class="mt-4 p-3 bg-blue-50 border border-blue-200 rounded-lg">
                    <p class="text-xs text-blue-700 flex items-start gap-2">
                        <svg class="w-4 h-4 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span><strong>Catatan:</strong> Semua berkas yang diupload akan otomatis terverifikasi. Pastikan file yang diupload jelas dan sesuai format.</span>
                    </p>
                </div>
            </div>
        </div>

        
        <div class="mt-6 flex justify-end gap-2 pt-4 border-t border-gray-200">
            <a href="<?php echo e(route('admin.pendaftar.index')); ?>" 
               class="btn btn-secondary">
                Batal
            </a>
            <button type="submit" class="btn btn-primary shadow-md hover:shadow-lg">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Simpan Data Siswa
            </button>
        </div>
    </form>

<script>
function toggleJenis() {
    const jenis = document.querySelector('input[name="jenis"]:checked').value;
    const formOrangTua = document.getElementById('form-orang-tua');
    const formWali = document.getElementById('form-wali');
    
    if (jenis === 'orang_tua') {
        formOrangTua.classList.remove('hidden');
        formWali.classList.add('hidden');
        
        // Enable required untuk orang tua
        document.getElementById('nama_ayah').required = true;
        document.getElementById('nik_ayah').required = true;
        document.getElementById('nama_ibu').required = true;
        document.getElementById('nik_ibu').required = true;
        document.getElementById('pekerjaan_ayah').required = true;
        document.getElementById('pekerjaan_ibu').required = true;
        document.getElementById('no_wa_ortu').required = true;
        
        // Disable required untuk wali
        document.getElementById('nama_wali').required = false;
        document.getElementById('pekerjaan_wali').required = false;
        document.getElementById('no_hp_wali').required = false;
        document.getElementById('hubungan_wali').required = false;
    } else {
        formOrangTua.classList.add('hidden');
        formWali.classList.remove('hidden');
        
        // Disable required untuk orang tua
        document.getElementById('nama_ayah').required = false;
        document.getElementById('nik_ayah').required = false;
        document.getElementById('nama_ibu').required = false;
        document.getElementById('nik_ibu').required = false;
        document.getElementById('pekerjaan_ayah').required = false;
        document.getElementById('pekerjaan_ibu').required = false;
        document.getElementById('no_wa_ortu').required = false;
        
        // Enable required untuk wali
        document.getElementById('nama_wali').required = true;
        document.getElementById('pekerjaan_wali').required = true;
        document.getElementById('no_hp_wali').required = true;
        document.getElementById('hubungan_wali').required = true;
    }
}

function updateFileLabel(input, key) {
    const label = document.getElementById('label_' + key);
    const preview = document.getElementById('preview_' + key);
    const fileName = input.files[0]?.name;
    
    if (fileName) {
        label.innerHTML = '<span class="text-gray-700 truncate">' + fileName + '</span>';
        label.classList.add('border-blue-300', 'bg-blue-50');
        preview.classList.remove('hidden');
        preview.querySelector('.file-name').textContent = fileName;
    }
}

function clearFile(key) {
    const input = document.getElementById('berkas_' + key);
    const label = document.getElementById('label_' + key);
    const preview = document.getElementById('preview_' + key);
    
    input.value = '';
    label.innerHTML = '<span class="file-placeholder">Pilih file...</span>';
    label.classList.remove('border-blue-300', 'bg-blue-50');
    preview.classList.add('hidden');
}

// Initialize on page load
document.addEventListener('DOMContentLoaded', toggleJenis);
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\user\.gemini\antigravity\scratch\smkalstar\smkalstar\resources\views/admin/pendaftar-create.blade.php ENDPATH**/ ?>