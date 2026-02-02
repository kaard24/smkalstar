

<?php $__env->startSection('title', 'Upload Berkas - SPMB SMK Al-Hidayah Lestari'); ?>

<?php $__env->startSection('content'); ?>
<div class="min-h-screen bg-gradient-to-br from-primary/5 to-sky-50 py-4 md:py-8 px-4">
    <div class="max-w-4xl mx-auto">
        
        <div class="mb-4 md:mb-6">
            <h1 class="text-xl md:text-3xl font-bold text-gray-900">Upload Berkas Pendaftaran</h1>
        </div>

        
        <?php if(session('success')): ?>
        <div class="mb-4 p-3 bg-sky-50 border border-sky-200 text-[#0EA5E9] rounded-lg text-sm flex items-center gap-2">
            <svg class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
            </svg>
            <?php echo e(session('success')); ?>

        </div>
        <?php endif; ?>

        <?php if(session('error')): ?>
        <div class="mb-4 p-3 bg-red-50 border border-red-200 text-red-700 rounded-lg text-sm flex items-center gap-2">
            <svg class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
            </svg>
            <?php echo e(session('error')); ?>

        </div>
        <?php endif; ?>

        
        <div class="mb-4 md:mb-6 bg-blue-50 border border-blue-200 rounded-xl p-3 md:p-4">
            <div class="flex items-start gap-2 md:gap-3">
                <svg class="w-4 h-4 md:w-5 md:h-5 text-blue-600 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                </svg>
                <div class="text-xs md:text-sm text-blue-700">
                    <p class="font-semibold mb-1">Ketentuan Upload Berkas:</p>
                    <ul class="list-disc list-inside space-y-0.5">
                        <li>Format file: PDF, JPG, JPEG, atau PNG</li>
                        <li>Ukuran maksimal: 2MB per file</li>
                        <li>Pastikan file dapat dibaca dengan jelas</li>
                    </ul>
                </div>
            </div>
        </div>

        
        <?php
            $progress = \App\Models\BerkasPendaftaran::getUploadProgress(auth()->guard('ppdb')->user()->id);
        ?>
        <div class="mb-4 md:mb-6 bg-white rounded-xl p-4 shadow-sm border border-gray-100">
            <div class="flex items-center justify-between mb-2">
                <span class="text-sm font-medium text-gray-700">Progress Upload</span>
                <span class="text-sm font-bold <?php echo e($progress['is_complete'] ? 'text-[#0EA5E9]' : 'text-primary'); ?>">
                    <?php echo e($progress['uploaded']); ?>/<?php echo e($progress['total']); ?>

                </span>
            </div>
            <div class="w-full bg-gray-200 rounded-full h-2.5">
                <div class="bg-primary h-2.5 rounded-full transition-all duration-500" style="width: <?php echo e($progress['percentage']); ?>%"></div>
            </div>
            <?php if($progress['is_complete']): ?>
            <p class="text-xs text-[#0EA5E9] mt-2 font-medium flex items-center gap-1">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                Semua berkas telah diupload! Jadwal tes akan diinformasikan via WhatsApp.
                            </p>
            <?php endif; ?>
        </div>

        
        <div class="grid gap-3 md:gap-4">
            <?php $__currentLoopData = $jenisBerkas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kode => $nama): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
                $berkasItem = $berkas[$kode] ?? null;
                $isUploaded = $berkasItem !== null;
            ?>
            
            <div class="bg-white rounded-xl md:rounded-2xl shadow-sm border border-gray-100 p-4 md:p-6">
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-3 md:gap-4">
                    
                    <div class="flex-1">
                        <div class="flex items-center gap-2 md:gap-3 mb-1 md:mb-2">
                            <div class="w-8 h-8 md:w-10 md:h-10 <?php echo e($isUploaded ? 'bg-sky-100' : 'bg-primary/10'); ?> rounded-lg flex items-center justify-center flex-shrink-0">
                                <?php if($isUploaded): ?>
                                <svg class="w-4 h-4 md:w-5 md:h-5 text-[#0EA5E9]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <?php else: ?>
                                <svg class="w-4 h-4 md:w-5 md:h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                <?php endif; ?>
                            </div>
                            <div class="min-w-0">
                                <h3 class="font-semibold text-sm md:text-base text-gray-900 truncate"><?php echo e($nama); ?></h3>
                                <span class="inline-block px-2 py-0.5 text-xs font-medium rounded-full <?php echo e($isUploaded ? 'bg-sky-100 text-[#0EA5E9]' : 'bg-gray-100 text-gray-600'); ?>">
                                    <?php echo e($isUploaded ? 'Tersimpan' : 'Belum Upload'); ?>

                                </span>
                            </div>
                        </div>
                        
                        <?php
                            $keterangan = \App\Models\BerkasPendaftaran::getKeteranganJenis($kode);
                        ?>
                        <?php if($keterangan): ?>
                        <p class="text-xs text-gray-500 mt-1 flex items-center gap-1">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            <?php echo e($keterangan); ?>

                        </p>
                        <?php endif; ?>
                        
                        <?php if($berkasItem): ?>
                        <p class="text-xs text-gray-500 truncate mt-1">
                            File: <?php echo e($berkasItem->nama_file); ?>

                        </p>
                        <?php endif; ?>
                    </div>

                    
                    <div class="flex items-center gap-2">
                        <?php if($berkasItem): ?>
                            
                            <a href="<?php echo e(route('ppdb.berkas.download', $berkasItem)); ?>" 
                               class="flex-1 md:flex-none inline-flex items-center justify-center gap-1.5 px-3 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition text-xs md:text-sm font-medium">
                                <svg class="w-3.5 h-3.5 md:w-4 md:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                                </svg>
                                <span class="hidden md:inline">Lihat</span>
                            </a>
                            
                            
                            <form action="<?php echo e(route('ppdb.berkas.destroy', $berkasItem)); ?>" method="POST" 
                                  onsubmit="return confirm('Yakin ingin menghapus berkas ini?')" class="flex-1 md:flex-none">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" 
                                        class="w-full inline-flex items-center justify-center gap-1.5 px-3 py-2 bg-red-50 text-red-600 rounded-lg hover:bg-red-100 transition text-xs md:text-sm font-medium">
                                    <svg class="w-3.5 h-3.5 md:w-4 md:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                    <span class="hidden md:inline">Hapus</span>
                                </button>
                            </form>
                        <?php endif; ?>

                        
                        <button type="button" 
                                onclick="openUploadModal('<?php echo e($kode); ?>', '<?php echo e($nama); ?>')"
                                class="flex-1 md:flex-none inline-flex items-center justify-center gap-1.5 px-3 py-2 bg-primary text-white rounded-lg hover:bg-[#0284C7] transition text-xs md:text-sm font-medium shadow-sm">
                            <svg class="w-3.5 h-3.5 md:w-4 md:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                            </svg>
                            <?php echo e($berkasItem ? 'Ganti' : 'Upload'); ?>

                        </button>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

    </div>
</div>


<div id="uploadModal" class="fixed inset-0 z-50 hidden">
    <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" onclick="closeUploadModal()"></div>
    <div class="absolute inset-0 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-2xl max-w-lg w-full p-4 md:p-6 relative transform transition-all mx-4">
            <button type="button" onclick="closeUploadModal()" class="absolute top-3 right-3 md:top-4 md:right-4 text-gray-400 hover:text-gray-600 transition">
                <svg class="w-5 h-5 md:w-6 md:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>

            <div class="text-center mb-4 md:mb-6">
                <div class="w-12 h-12 md:w-14 md:h-14 bg-primary/10 rounded-full flex items-center justify-center mx-auto mb-2 md:mb-3">
                    <svg class="w-6 h-6 md:w-7 md:h-7 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                    </svg>
                </div>
                <h3 class="text-lg md:text-xl font-bold text-gray-900">Upload Berkas</h3>
                <p id="modalBerkasNama" class="text-xs md:text-sm text-gray-500 mt-1"></p>
                <p id="modalBerkasKeterangan" class="text-xs text-blue-600 mt-2 px-4"></p>
            </div>

            <form action="<?php echo e(route('ppdb.berkas.upload')); ?>" method="POST" enctype="multipart/form-data" id="uploadForm">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="jenis_berkas" id="modalJenisBerkas">

                
                <div id="dropZone" 
                     class="relative border-2 border-dashed border-gray-300 rounded-xl md:rounded-2xl p-4 md:p-8 text-center transition-all duration-200 hover:border-primary/50 bg-gray-50/50">
                    
                    
                    <div id="uploadState">
                        <div class="mb-3 md:mb-4">
                            <svg class="w-12 h-12 md:w-16 md:h-16 mx-auto text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                            </svg>
                        </div>
                        <p class="text-gray-600 font-medium mb-1 md:mb-2 text-sm md:text-base">Tap untuk pilih file</p>
                        <p class="text-gray-400 text-xs md:text-sm mb-3 md:mb-4">atau drag & drop di sini</p>
                        <button type="button" onclick="document.getElementById('fileInput').click()"
                                class="px-4 md:px-6 py-2 md:py-2.5 bg-white border-2 border-primary text-primary rounded-xl font-medium hover:bg-primary hover:text-white transition shadow-sm text-sm">
                            Pilih File
                        </button>
                        <p class="mt-3 md:mt-4 text-xs text-gray-400">PDF, JPG, PNG (Maks. 2MB)</p>
                    </div>

                    
                    <div id="fileSelectedState" class="hidden">
                        <div class="flex items-center justify-center mb-3 md:mb-4">
                            <div id="filePreviewIcon" class="w-12 h-12 md:w-16 md:h-16 bg-sky-100 rounded-xl md:rounded-2xl flex items-center justify-center">
                                
                            </div>
                        </div>
                        <p id="selectedFileName" class="text-gray-800 font-medium mb-1 text-sm truncate px-4"></p>
                        <p id="selectedFileSize" class="text-gray-400 text-xs md:text-sm mb-3 md:mb-4"></p>
                        <button type="button" onclick="resetFileInput()"
                                class="text-red-500 hover:text-red-600 text-xs md:text-sm font-medium flex items-center gap-1 mx-auto">
                            <svg class="w-3.5 h-3.5 md:w-4 md:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                            Hapus & Pilih Ulang
                        </button>
                    </div>

                    
                    <div id="loadingState" class="hidden">
                        <div class="mb-3 md:mb-4">
                            <svg class="w-12 h-12 md:w-16 md:h-16 mx-auto text-primary animate-spin" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                        </div>
                        <p class="text-gray-600 font-medium text-sm">Mengupload file...</p>
                        <p class="text-gray-400 text-xs mt-1">Mohon tunggu sebentar</p>
                    </div>

                    <input type="file" name="file" id="fileInput" accept=".pdf,.jpg,.jpeg,.png" class="hidden" required>
                </div>

                <?php $__errorArgs = ['file'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <p class="mt-2 text-xs md:text-sm text-red-500 text-center"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                <div class="flex gap-2 md:gap-3 mt-4 md:mt-6">
                    <button type="button" onclick="closeUploadModal()" 
                            class="flex-1 px-3 md:px-4 py-2.5 md:py-3 border border-gray-300 text-gray-700 rounded-xl hover:bg-gray-50 transition font-medium text-sm">
                        Batal
                    </button>
                    <button type="submit" id="submitBtn" disabled
                            class="flex-1 px-3 md:px-4 py-2.5 md:py-3 bg-primary text-white rounded-xl hover:bg-[#0284C7] transition font-medium shadow-sm disabled:opacity-50 disabled:cursor-not-allowed flex items-center justify-center gap-1.5 md:gap-2 text-sm">
                        <span>Upload</span>
                        <svg class="w-3.5 h-3.5 md:w-4 md:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                        </svg>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
const dropZone = document.getElementById('dropZone');
const fileInput = document.getElementById('fileInput');
const uploadState = document.getElementById('uploadState');
const fileSelectedState = document.getElementById('fileSelectedState');
const loadingState = document.getElementById('loadingState');
const selectedFileName = document.getElementById('selectedFileName');
const selectedFileSize = document.getElementById('selectedFileSize');
const filePreviewIcon = document.getElementById('filePreviewIcon');
const submitBtn = document.getElementById('submitBtn');
const uploadForm = document.getElementById('uploadForm');

// Prevent default drag behaviors
['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
    dropZone.addEventListener(eventName, preventDefaults, false);
    document.body.addEventListener(eventName, preventDefaults, false);
});

// Highlight drop zone when dragging over
['dragenter', 'dragover'].forEach(eventName => {
    dropZone.addEventListener(eventName, highlight, false);
});

['dragleave', 'drop'].forEach(eventName => {
    dropZone.addEventListener(eventName, unhighlight, false);
});

// Handle dropped files
dropZone.addEventListener('drop', handleDrop, false);

// Handle file input change
fileInput.addEventListener('change', handleFiles, false);

// Handle form submit
uploadForm.addEventListener('submit', handleSubmit, false);

function preventDefaults(e) {
    e.preventDefault();
    e.stopPropagation();
}

function highlight(e) {
    dropZone.classList.add('border-primary', 'bg-primary/5', 'scale-[1.02]');
    dropZone.classList.remove('border-gray-300');
}

function unhighlight(e) {
    dropZone.classList.remove('border-primary', 'bg-primary/5', 'scale-[1.02]');
    dropZone.classList.add('border-gray-300');
}

function handleDrop(e) {
    const dt = e.dataTransfer;
    const files = dt.files;
    
    if (files.length > 0) {
        fileInput.files = files;
        handleFiles();
    }
}

function handleFiles() {
    const file = fileInput.files[0];
    
    if (file) {
        // Validate file size (2MB)
        if (file.size > 2 * 1024 * 1024) {
            alert('Ukuran file terlalu besar. Maksimal 2MB.');
            resetFileInput();
            return;
        }
        
        // Validate file type
        const allowedTypes = ['application/pdf', 'image/jpeg', 'image/jpg', 'image/png'];
        if (!allowedTypes.includes(file.type)) {
            alert('Format file tidak didukung. Harap upload PDF, JPG, atau PNG.');
            resetFileInput();
            return;
        }
        
        // Show file selected state
        showFileSelected(file);
    }
}

function showFileSelected(file) {
    uploadState.classList.add('hidden');
    fileSelectedState.classList.remove('hidden');
    loadingState.classList.add('hidden');
    
    selectedFileName.textContent = file.name;
    selectedFileSize.textContent = formatFileSize(file.size);
    
    // Set appropriate icon based on file type
    if (file.type === 'application/pdf') {
        filePreviewIcon.innerHTML = `
            <svg class="w-6 h-6 md:w-8 md:h-8 text-red-500" fill="currentColor" viewBox="0 0 24 24">
                <path d="M7 3C5.895 3 5 3.895 5 5v14c0 1.105.895 2 2 2h10c1.105 0 2-.895 2-2V9l-6-6H7zm6 1.5L17.5 9H13V4.5z"/>
            </svg>
        `;
        filePreviewIcon.className = 'w-12 h-12 md:w-16 md:h-16 bg-red-100 rounded-xl md:rounded-2xl flex items-center justify-center';
    } else {
        filePreviewIcon.innerHTML = `
            <svg class="w-6 h-6 md:w-8 md:h-8 text-[#0EA5E9]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
        `;
        filePreviewIcon.className = 'w-12 h-12 md:w-16 md:h-16 bg-sky-100 rounded-xl md:rounded-2xl flex items-center justify-center';
    }
    
    submitBtn.disabled = false;
}

function resetFileInput() {
    fileInput.value = '';
    uploadState.classList.remove('hidden');
    fileSelectedState.classList.add('hidden');
    loadingState.classList.add('hidden');
    submitBtn.disabled = true;
}

function handleSubmit(e) {
    if (!fileInput.files[0]) {
        e.preventDefault();
        alert('Silakan pilih file terlebih dahulu.');
        return;
    }
    
    // Show loading state
    uploadState.classList.add('hidden');
    fileSelectedState.classList.add('hidden');
    loadingState.classList.remove('hidden');
    
    // Disable buttons
    submitBtn.disabled = true;
    submitBtn.innerHTML = `
        <svg class="w-3.5 h-3.5 md:w-4 md:h-4 animate-spin" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
        </svg>
        <span>Mengupload...</span>
    `;
}

function formatFileSize(bytes) {
    if (bytes === 0) return '0 Bytes';
    const k = 1024;
    const sizes = ['Bytes', 'KB', 'MB', 'GB'];
    const i = Math.floor(Math.log(bytes) / Math.log(k));
    return Math.round(bytes / Math.pow(k, i) * 100) / 100 + ' ' + sizes[i];
}

function openUploadModal(jenis, nama) {
    document.getElementById('modalJenisBerkas').value = jenis;
    document.getElementById('modalBerkasNama').textContent = nama;
    
    // Set keterangan khusus untuk SKL_IJAZAH
    const keteranganEl = document.getElementById('modalBerkasKeterangan');
    if (jenis === 'SKL_IJAZAH') {
        keteranganEl.textContent = 'Upload SKL (jika belum lulus) atau Ijazah (jika sudah lulus)';
        keteranganEl.classList.remove('hidden');
    } else {
        keteranganEl.textContent = '';
        keteranganEl.classList.add('hidden');
    }
    
    document.getElementById('uploadModal').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
    
    // Reset state
    resetFileInput();
}

function closeUploadModal() {
    document.getElementById('uploadModal').classList.add('hidden');
    document.body.style.overflow = '';
    resetFileInput();
}

// Close modal on Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape' && !document.getElementById('uploadModal').classList.contains('hidden')) {
        closeUploadModal();
    }
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\eka\.gemini\antigravity\scratch\smk-alstar\resources\views/ppdb/berkas.blade.php ENDPATH**/ ?>