@extends('layouts.app')

@section('title', 'Upload Berkas - SPMB SMK Al-Hidayah Lestari')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-primary/5 to-green-50 py-8 px-4">
    <div class="max-w-4xl mx-auto">
        {{-- Header --}}
        <div class="mb-8">
            <nav class="text-sm text-gray-500 mb-4">
                <a href="{{ route('ppdb.dashboard') }}" class="hover:text-primary">Dashboard</a>
                <span class="mx-2">/</span>
                <span class="text-gray-700">Upload Berkas</span>
            </nav>
            <h1 class="text-3xl font-bold text-gray-900">Upload Berkas Pendaftaran</h1>
            <p class="text-gray-600 mt-2">Upload dokumen-dokumen yang diperlukan untuk verifikasi pendaftaran</p>
        </div>

        {{-- Alert Messages --}}
        @if(session('success'))
        <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-700 rounded-xl text-sm flex items-center gap-3">
            <svg class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
            </svg>
            {{ session('success') }}
        </div>
        @endif

        @if(session('error'))
        <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-700 rounded-xl text-sm flex items-center gap-3">
            <svg class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
            </svg>
            {{ session('error') }}
        </div>
        @endif

        {{-- Info Box --}}
        <div class="mb-6 bg-blue-50 border border-blue-200 rounded-xl p-4">
            <div class="flex items-start gap-3">
                <svg class="w-5 h-5 text-blue-600 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                </svg>
                <div class="text-sm text-blue-700">
                    <p class="font-semibold mb-1">Ketentuan Upload Berkas:</p>
                    <ul class="list-disc list-inside space-y-1">
                        <li>Format file: PDF, JPG, JPEG, atau PNG</li>
                        <li>Ukuran maksimal: 2MB per file</li>
                        <li>Pastikan file dapat dibaca dengan jelas</li>
                        <li>Berkas yang sudah diverifikasi Valid tidak dapat diubah</li>
                    </ul>
                </div>
            </div>
        </div>

        {{-- Berkas Cards --}}
        <div class="grid gap-6">
            @foreach($jenisBerkas as $kode => $nama)
            @php
                $berkasItem = $berkas[$kode] ?? null;
                $statusClass = 'bg-gray-100 text-gray-600';
                $statusText = 'Belum Upload';
                
                if ($berkasItem) {
                    if ($berkasItem->isTidakValid()) {
                        $statusClass = 'bg-red-100 text-red-700';
                        $statusText = 'Perbaiki Berkas';
                    } else {
                        // Untuk semua status lainnya (Pending & Valid), 
                        // tampilkan "Berhasil Upload" agar siswa tenang.
                        $statusClass = 'bg-green-100 text-green-700';
                        $statusText = 'Berhasil Upload';
                    }
                }
            @endphp
            
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                    {{-- Info --}}
                    <div class="flex-1">
                        <div class="flex items-center gap-3 mb-2">
                            <div class="w-10 h-10 bg-primary/10 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900">{{ $nama }}</h3>
                                <span class="inline-block px-2 py-0.5 text-xs font-medium rounded-full {{ $statusClass }}">
                                    {{ $statusText }}
                                </span>
                            </div>
                        </div>
                        
                        @if($berkasItem)
                        <p class="text-sm text-gray-500 ml-13">
                            File: {{ $berkasItem->nama_file }}
                        </p>
                        @if($berkasItem->catatan_admin)
                        <p class="text-sm text-gray-600 mt-2 ml-13 p-2 bg-gray-50 rounded-lg">
                            <span class="font-medium">Catatan Admin:</span> {{ $berkasItem->catatan_admin }}
                        </p>
                        @endif
                        @endif
                    </div>

                    {{-- Actions --}}
                    <div class="flex items-center gap-2">
                        @if($berkasItem)
                            {{-- Download Button --}}
                            <a href="{{ route('ppdb.berkas.download', $berkasItem) }}" 
                               class="inline-flex items-center gap-2 px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition text-sm font-medium">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                                </svg>
                                Lihat
                            </a>
                            
                            @if(!$berkasItem->isValid())
                            {{-- Delete Form --}}
                            <form action="{{ route('ppdb.berkas.destroy', $berkasItem) }}" method="POST" 
                                  onsubmit="return confirm('Yakin ingin menghapus berkas ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="inline-flex items-center gap-2 px-4 py-2 bg-red-50 text-red-600 rounded-lg hover:bg-red-100 transition text-sm font-medium">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                    Hapus
                                </button>
                            </form>
                            @endif
                        @endif

                        @if(!$berkasItem || !$berkasItem->isValid())
                        {{-- Upload Button --}}
                        <button type="button" 
                                onclick="openUploadModal('{{ $kode }}', '{{ $nama }}')"
                                class="inline-flex items-center gap-2 px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary/90 transition text-sm font-medium shadow-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                            </svg>
                            {{ $berkasItem ? 'Upload Ulang' : 'Upload' }}
                        </button>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        {{-- Back Button --}}
        <div class="mt-8 text-center">
            <a href="{{ route('ppdb.dashboard') }}" class="text-gray-500 hover:text-primary transition">
                ← Kembali ke Dashboard
            </a>
        </div>
    </div>
</div>

{{-- Upload Modal with Drag & Drop --}}
<div id="uploadModal" class="fixed inset-0 z-50 hidden">
    <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" onclick="closeUploadModal()"></div>
    <div class="absolute inset-0 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-2xl max-w-lg w-full p-6 relative transform transition-all">
            <button type="button" onclick="closeUploadModal()" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>

            <div class="text-center mb-6">
                <div class="w-14 h-14 bg-primary/10 rounded-full flex items-center justify-center mx-auto mb-3">
                    <svg class="w-7 h-7 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900">Upload Berkas</h3>
                <p id="modalBerkasNama" class="text-sm text-gray-500 mt-1"></p>
            </div>

            <form action="{{ route('ppdb.berkas.upload') }}" method="POST" enctype="multipart/form-data" id="uploadForm">
                @csrf
                <input type="hidden" name="jenis_berkas" id="modalJenisBerkas">

                {{-- Drag & Drop Zone --}}
                <div id="dropZone" 
                     class="relative border-2 border-dashed border-gray-300 rounded-2xl p-8 text-center transition-all duration-200 hover:border-primary/50 bg-gray-50/50">
                    
                    {{-- Upload State --}}
                    <div id="uploadState">
                        <div class="mb-4">
                            <svg class="w-16 h-16 mx-auto text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                            </svg>
                        </div>
                        <p class="text-gray-600 font-medium mb-2">Drag & drop file di sini</p>
                        <p class="text-gray-400 text-sm mb-4">atau</p>
                        <button type="button" onclick="document.getElementById('fileInput').click()"
                                class="px-6 py-2.5 bg-white border-2 border-primary text-primary rounded-xl font-medium hover:bg-primary hover:text-white transition shadow-sm">
                            Pilih File
                        </button>
                        <p class="mt-4 text-xs text-gray-400">PDF, JPG, PNG (Maks. 2MB)</p>
                    </div>

                    {{-- File Selected State --}}
                    <div id="fileSelectedState" class="hidden">
                        <div class="flex items-center justify-center mb-4">
                            <div id="filePreviewIcon" class="w-16 h-16 bg-green-100 rounded-2xl flex items-center justify-center">
                                {{-- Icon will be set by JS --}}
                            </div>
                        </div>
                        <p id="selectedFileName" class="text-gray-800 font-medium mb-1 truncate px-4"></p>
                        <p id="selectedFileSize" class="text-gray-400 text-sm mb-4"></p>
                        <button type="button" onclick="resetFileInput()"
                                class="text-red-500 hover:text-red-600 text-sm font-medium flex items-center gap-1 mx-auto">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                            Hapus & Pilih Ulang
                        </button>
                    </div>

                    {{-- Loading State --}}
                    <div id="loadingState" class="hidden">
                        <div class="mb-4">
                            <svg class="w-16 h-16 mx-auto text-primary animate-spin" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                        </div>
                        <p class="text-gray-600 font-medium">Mengupload file...</p>
                        <p class="text-gray-400 text-sm mt-1">Mohon tunggu sebentar</p>
                    </div>

                    <input type="file" name="file" id="fileInput" accept=".pdf,.jpg,.jpeg,.png" class="hidden" required>
                </div>

                @error('file')
                <p class="mt-2 text-sm text-red-500 text-center">{{ $message }}</p>
                @enderror

                <div class="flex gap-3 mt-6">
                    <button type="button" onclick="closeUploadModal()" 
                            class="flex-1 px-4 py-3 border border-gray-300 text-gray-700 rounded-xl hover:bg-gray-50 transition font-medium">
                        Batal
                    </button>
                    <button type="submit" id="submitBtn" disabled
                            class="flex-1 px-4 py-3 bg-primary text-white rounded-xl hover:bg-primary/90 transition font-medium shadow-sm disabled:opacity-50 disabled:cursor-not-allowed flex items-center justify-center gap-2">
                        <span>Upload</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
t['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
    dropZone.addEventListener(eventName, preventDefaults, false);
    document.body.addEventListener(eventName, preventDefaults, false);
});

// Highlight drop zone when dragging over
t['dragenter', 'dragover'].forEach(eventName => {
    dropZone.addEventListener(eventName, highlight, false);
});

t['dragleave', 'drop'].forEach(eventName => {
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
            <svg class="w-8 h-8 text-red-500" fill="currentColor" viewBox="0 0 24 24">
                <path d="M7 3C5.895 3 5 3.895 5 5v14c0 1.105.895 2 2 2h10c1.105 0 2-.895 2-2V9l-6-6H7zm6 1.5L17.5 9H13V4.5z"/>
            </svg>
        `;
        filePreviewIcon.className = 'w-16 h-16 bg-red-100 rounded-2xl flex items-center justify-center';
    } else {
        filePreviewIcon.innerHTML = `
            <svg class="w-8 h-8 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
        `;
        filePreviewIcon.className = 'w-16 h-16 bg-green-100 rounded-2xl flex items-center justify-center';
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
        <svg class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24">
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
@endsection
