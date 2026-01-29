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

{{-- Upload Modal --}}
<div id="uploadModal" class="fixed inset-0 z-50 hidden">
    <div class="absolute inset-0 bg-black/50" onclick="closeUploadModal()"></div>
    <div class="absolute inset-0 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-xl max-w-md w-full p-6 relative">
            <button type="button" onclick="closeUploadModal()" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>

            <h3 class="text-lg font-semibold text-gray-900 mb-1">Upload Berkas</h3>
            <p id="modalBerkasNama" class="text-sm text-gray-500 mb-6"></p>

            <form action="{{ route('ppdb.berkas.upload') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="jenis_berkas" id="modalJenisBerkas">

                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Pilih File</label>
                    <div class="border-2 border-dashed border-gray-300 rounded-xl p-6 text-center hover:border-primary transition cursor-pointer"
                         onclick="document.getElementById('fileInput').click()">
                        <svg class="w-12 h-12 mx-auto text-gray-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                        </svg>
                        <p class="text-sm text-gray-600 mb-1">Klik untuk memilih file</p>
                        <p class="text-xs text-gray-400">PDF, JPG, PNG (Maks. 2MB)</p>
                        <p id="selectedFileName" class="text-sm text-primary font-medium mt-2 hidden"></p>
                    </div>
                    <input type="file" name="file" id="fileInput" accept=".pdf,.jpg,.jpeg,.png" class="hidden" required
                           onchange="updateFileName(this)">
                    @error('file')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex gap-3">
                    <button type="button" onclick="closeUploadModal()" 
                            class="flex-1 px-4 py-3 border border-gray-300 text-gray-700 rounded-xl hover:bg-gray-50 transition font-medium">
                        Batal
                    </button>
                    <button type="submit" 
                            class="flex-1 px-4 py-3 bg-primary text-white rounded-xl hover:bg-primary/90 transition font-medium shadow-sm">
                        Upload
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function openUploadModal(jenis, nama) {
    document.getElementById('modalJenisBerkas').value = jenis;
    document.getElementById('modalBerkasNama').textContent = nama;
    document.getElementById('uploadModal').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closeUploadModal() {
    document.getElementById('uploadModal').classList.add('hidden');
    document.body.style.overflow = '';
    document.getElementById('fileInput').value = '';
    document.getElementById('selectedFileName').classList.add('hidden');
}

function updateFileName(input) {
    const fileName = input.files[0]?.name;
    const display = document.getElementById('selectedFileName');
    if (fileName) {
        display.textContent = fileName;
        display.classList.remove('hidden');
    }
}
</script>
@endsection
