

<?php $__env->startSection('title', 'Edit Seragam - Admin Panel'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-3xl mx-auto" x-data="seragamForm()">
    
    <div class="mb-8">
        <a href="<?php echo e(route('admin.seragam.index')); ?>" class="inline-flex items-center text-sm text-slate-500 hover:text-[#4276A3] mb-4 transition-colors">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Kembali ke Daftar Seragam
        </a>
        <h1 class="text-2xl font-bold text-slate-800">Edit Seragam <?php echo e($seragam->hari); ?></h1>
        <p class="text-slate-600">Perbarui informasi dan foto seragam.</p>
    </div>

    
    <?php if($errors->any()): ?>
    <div class="mb-6 p-4 bg-rose-50 border border-rose-200 text-rose-700 rounded-xl">
        <div class="flex items-center gap-2 mb-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <span class="font-medium">Terjadi kesalahan:</span>
        </div>
        <ul class="list-disc pl-5 space-y-1 text-sm">
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
    <?php endif; ?>

    <form action="<?php echo e(route('admin.seragam.update', $seragam)); ?>" method="POST" enctype="multipart/form-data" class="space-y-6">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-200 bg-slate-50">
                <h2 class="font-semibold text-slate-800">Informasi Seragam</h2>
            </div>
            <div class="p-6 space-y-6">
                
                <div>
                    <label for="hari" class="form-label">Hari <span class="text-rose-600">*</span></label>
                    <select id="hari" name="hari" required
                            class="form-input <?php $__errorArgs = ['hari'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-rose-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                        <?php $__currentLoopData = $hariList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $hari): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($hari); ?>" <?php echo e(old('hari', $seragam->hari) == $hari ? 'selected' : ''); ?>><?php echo e($hari); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                
                <div>
                    <label class="form-label mb-3">Warna Tema <span class="text-rose-600">*</span></label>
                    <div class="grid grid-cols-4 sm:grid-cols-7 gap-3">
                        <?php $__currentLoopData = $warnaList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <label class="cursor-pointer group">
                            <input type="radio" name="warna_tema" value="<?php echo e($key); ?>" 
                                   class="sr-only peer" <?php echo e(old('warna_tema', $seragam->warna_tema) == $key ? 'checked' : ''); ?>>
                            <div class="flex flex-col items-center gap-2 p-3 rounded-lg border-2 border-slate-200 peer-checked:border-[#4276A3] peer-checked:bg-[#4276A3]/5 hover:border-slate-300 transition-all">
                                <div class="w-8 h-8 rounded-full bg-gradient-to-br
                                    <?php if($key == 'blue'): ?> from-blue-500 to-blue-600
                                    <?php elseif($key == 'gray'): ?> from-slate-500 to-slate-600
                                    <?php elseif($key == 'green'): ?> from-emerald-500 to-emerald-600
                                    <?php elseif($key == 'red'): ?> from-rose-500 to-rose-600
                                    <?php elseif($key == 'purple'): ?> from-violet-500 to-violet-600
                                    <?php elseif($key == 'orange'): ?> from-orange-500 to-orange-600
                                    <?php elseif($key == 'brown'): ?> from-amber-700 to-amber-800
                                    <?php endif; ?>
                                "></div>
                                <span class="text-xs text-slate-600 peer-checked:text-[#4276A3] peer-checked:font-medium"><?php echo e($label); ?></span>
                            </div>
                        </label>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <?php $__errorArgs = ['warna_tema'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="mt-1 text-sm text-rose-600"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                
                <div>
                    <label for="keterangan" class="form-label">Keterangan</label>
                    <textarea id="keterangan" name="keterangan" rows="3"
                              class="form-input <?php $__errorArgs = ['keterangan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-rose-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                              placeholder="Deskripsi seragam (opsional)"><?php echo e(old('keterangan', $seragam->keterangan)); ?></textarea>
                    <p class="mt-1 text-xs text-slate-500">Maksimal 500 karakter.</p>
                </div>

                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="urutan" class="form-label">Urutan Tampil</label>
                        <input type="number" id="urutan" name="urutan" min="0" value="<?php echo e(old('urutan', $seragam->urutan)); ?>"
                               class="form-input <?php $__errorArgs = ['urutan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-rose-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                        <p class="mt-1 text-xs text-slate-500">Urutan menampilkan di halaman user.</p>
                    </div>
                    <div class="flex items-center pt-8">
                        <label class="flex items-center cursor-pointer">
                            <input type="checkbox" name="aktif" value="1" <?php echo e(old('aktif', $seragam->aktif) ? 'checked' : ''); ?>

                                   class="w-5 h-5 text-[#4276A3] border-slate-300 rounded focus:ring-[#4276A3]">
                            <span class="ml-3 text-sm font-medium text-slate-700">Tampilkan di Website</span>
                        </label>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-200 bg-slate-50">
                <h2 class="font-semibold text-slate-800">Foto Seragam</h2>
                <p class="text-xs text-slate-500 mt-1">Upload foto dan tambahkan keterangan (opsional)</p>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    
                    <div x-data="photoManager('laki', <?php echo e(json_encode($seragam->foto_laki_with_captions ?? [])); ?>)">
                        <label class="form-label flex items-center justify-between">
                            <span>Foto Laki-laki</span>
                            <span class="text-xs text-slate-500" x-text="photos.length + ' foto'"></span>
                        </label>
                        
                        
                        <div class="mb-3 space-y-3">
                            <?php $__currentLoopData = $seragam->foto_laki_with_captions ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $foto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="relative group bg-slate-50 rounded-lg p-3 border border-slate-200">
                                <div class="flex gap-3">
                                    <img src="<?php echo e($foto['url']); ?>" class="w-20 h-24 object-cover rounded-lg border">
                                    <div class="flex-1 min-w-0">
                                        <label class="text-xs text-slate-500 block mb-1">Keterangan:</label>
                                        <input type="text" name="keterangan_foto_laki[<?php echo e($index); ?>]" 
                                               value="<?php echo e($foto['caption'] ?? ''); ?>"
                                               class="w-full text-sm border-slate-200 rounded-lg focus:border-blue-500 focus:ring-blue-500"
                                               placeholder="Contoh: Tampak depan">
                                        <?php if($index === 0): ?>
                                        <span class="inline-block mt-2 text-xs bg-blue-100 text-blue-700 px-2 py-0.5 rounded">Foto Utama</span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <label class="absolute top-2 right-2 bg-red-500 text-white p-1.5 rounded-lg cursor-pointer opacity-0 group-hover:opacity-100 transition-opacity shadow-lg">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                    <input type="checkbox" name="hapus_foto_laki[]" value="<?php echo e($foto['path']); ?>" class="hidden" 
                                           @change="markForDelete($event, $refs['laki-photo-<?php echo e($index); ?>'])">
                                </label>
                                <div x-ref="laki-photo-<?php echo e($index); ?>"></div>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        
                        
                        <div class="relative">
                            <div class="border-2 border-dashed border-slate-300 rounded-xl p-6 text-center hover:bg-slate-50 transition cursor-pointer"
                                 @click="$refs.inputLaki.click()">
                                <svg class="w-10 h-10 text-slate-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                </svg>
                                <p class="text-sm text-slate-600 font-medium">Tambah Foto</p>
                                <p class="text-xs text-slate-400 mt-1">Bisa pilih lebih dari satu</p>
                            </div>
                            <input type="file" x-ref="inputLaki" name="foto_laki[]" accept="image/*" multiple class="hidden"
                                   @change="handleFileSelect($event)">
                        </div>
                        <?php $__errorArgs = ['foto_laki.*'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="mt-1 text-sm text-rose-600"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    
                    <div x-data="photoManager('perempuan', <?php echo e(json_encode($seragam->foto_perempuan_with_captions ?? [])); ?>)">
                        <label class="form-label flex items-center justify-between">
                            <span>Foto Perempuan</span>
                            <span class="text-xs text-slate-500" x-text="photos.length + ' foto'"></span>
                        </label>
                        
                        
                        <div class="mb-3 space-y-3">
                            <?php $__currentLoopData = $seragam->foto_perempuan_with_captions ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $foto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="relative group bg-slate-50 rounded-lg p-3 border border-slate-200">
                                <div class="flex gap-3">
                                    <img src="<?php echo e($foto['url']); ?>" class="w-20 h-24 object-cover rounded-lg border">
                                    <div class="flex-1 min-w-0">
                                        <label class="text-xs text-slate-500 block mb-1">Keterangan:</label>
                                        <input type="text" name="keterangan_foto_perempuan[<?php echo e($index); ?>]" 
                                               value="<?php echo e($foto['caption'] ?? ''); ?>"
                                               class="w-full text-sm border-slate-200 rounded-lg focus:border-pink-500 focus:ring-pink-500"
                                               placeholder="Contoh: Tampak depan">
                                        <?php if($index === 0): ?>
                                        <span class="inline-block mt-2 text-xs bg-pink-100 text-pink-700 px-2 py-0.5 rounded">Foto Utama</span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <label class="absolute top-2 right-2 bg-red-500 text-white p-1.5 rounded-lg cursor-pointer opacity-0 group-hover:opacity-100 transition-opacity shadow-lg">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                    <input type="checkbox" name="hapus_foto_perempuan[]" value="<?php echo e($foto['path']); ?>" class="hidden"
                                           @change="markForDelete($event, $refs['perempuan-photo-<?php echo e($index); ?>'])">
                                </label>
                                <div x-ref="perempuan-photo-<?php echo e($index); ?>"></div>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        
                        
                        <div class="mb-3 space-y-3" x-show="newPhotos.length > 0">
                            <p class="text-xs text-slate-500 font-medium">Foto baru:</p>
                            <template x-for="(photo, index) in newPhotos" :key="index">
                                <div class="relative bg-slate-50 rounded-lg p-3 border border-slate-200">
                                    <div class="flex gap-3">
                                        <img :src="photo.preview" class="w-20 h-24 object-cover rounded-lg border">
                                        <div class="flex-1">
                                            <label class="text-xs text-slate-500 block mb-1">Keterangan:</label>
                                            <input type="text" :name="'keterangan_foto_perempuan_baru[' + index + ']'" 
                                                   class="w-full text-sm border-slate-200 rounded-lg focus:border-pink-500 focus:ring-pink-500"
                                                   placeholder="Contoh: Tampak depan">
                                        </div>
                                    </div>
                                    <button type="button" @click="removeNewPhoto(index)" 
                                            class="absolute top-2 right-2 bg-red-500 text-white p-1.5 rounded-lg shadow-lg">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                        </svg>
                                    </button>
                                </div>
                            </template>
                        </div>
                        
                        
                        <div class="relative">
                            <div class="border-2 border-dashed border-slate-300 rounded-xl p-6 text-center hover:bg-slate-50 transition cursor-pointer"
                                 @click="$refs.inputPerempuan.click()">
                                <svg class="w-10 h-10 text-slate-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                </svg>
                                <p class="text-sm text-slate-600 font-medium">Tambah Foto</p>
                                <p class="text-xs text-slate-400 mt-1">Bisa pilih lebih dari satu</p>
                            </div>
                            <input type="file" x-ref="inputPerempuan" name="foto_perempuan[]" accept="image/*" multiple class="hidden"
                                   @change="handleFileSelect($event)">
                        </div>
                        <?php $__errorArgs = ['foto_perempuan.*'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="mt-1 text-sm text-rose-600"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="flex justify-end gap-4">
            <a href="<?php echo e(route('admin.seragam.index')); ?>" class="btn btn-secondary btn-lg">
                Batal
            </a>
            <button type="submit" class="btn btn-primary btn-lg shadow-sm hover:shadow-md">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>

<script>
function seragamForm() {
    return {}
}

function photoManager(type, existingPhotos = []) {
    return {
        photos: existingPhotos,
        newPhotos: [],
        files: [],
        
        handleFileSelect(event) {
            const selectedFiles = Array.from(event.target.files);
            
            selectedFiles.forEach(file => {
                if (file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        this.newPhotos.push({
                            preview: e.target.result,
                            name: file.name
                        });
                    };
                    reader.readAsDataURL(file);
                    this.files.push(file);
                }
            });
            
            // Update file list untuk form submission
            const dataTransfer = new DataTransfer();
            this.files.forEach(file => dataTransfer.items.add(file));
            event.target.files = dataTransfer.files;
        },
        
        removeNewPhoto(index) {
            this.newPhotos.splice(index, 1);
            this.files.splice(index, 1);
        },
        
        markForDelete(event, containerRef) {
            const checkbox = event.target;
            const container = checkbox.closest('.relative.group');
            
            if (checkbox.checked) {
                container.classList.add('opacity-50', 'grayscale');
                checkbox.closest('label').classList.add('opacity-100');
            } else {
                container.classList.remove('opacity-50', 'grayscale');
                checkbox.closest('label').classList.remove('opacity-100');
            }
        }
    }
}
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\eka\.gemini\antigravity\scratch\smk-alstar\resources\views\admin\seragam\edit.blade.php ENDPATH**/ ?>