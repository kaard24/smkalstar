@extends('layouts.admin')

@section('title', 'Tambah Program Keahlian - Admin Panel')

@section('content')
<div class="max-w-4xl mx-auto">
    {{-- Header --}}
    <div class="mb-8">
        <a href="{{ route('admin.jurusan.index') }}" class="text-slate-500 hover:text-slate-700 flex items-center gap-1 mb-4">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Kembali
        </a>
        <h1 class="text-2xl font-bold text-slate-800">Tambah Program Keahlian</h1>
        <p class="text-slate-600">Tambah data jurusan baru dengan logo dan gambar.</p>
    </div>

    {{-- Form --}}
    <form action="{{ route('admin.jurusan.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        {{-- Informasi Dasar --}}
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
            <h2 class="text-lg font-semibold text-slate-800 mb-4 flex items-center gap-2">
                <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                Informasi Dasar
            </h2>
            <div class="grid md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Kode Jurusan</label>
                    <input type="text" name="kode" value="{{ old('kode') }}" 
                        class="w-full rounded-lg border-slate-300 focus:border-blue-500 focus:ring-blue-500 uppercase"
                        placeholder="Contoh: TKJ">
                    @error('kode')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Nama Jurusan</label>
                    <input type="text" name="nama" value="{{ old('nama') }}" 
                        class="w-full rounded-lg border-slate-300 focus:border-blue-500 focus:ring-blue-500"
                        placeholder="Contoh: Teknik Komputer dan Jaringan">
                    @error('nama')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Urutan</label>
                    <input type="number" name="urutan" value="{{ old('urutan', 1) }}" min="0"
                        class="w-full rounded-lg border-slate-300 focus:border-blue-500 focus:ring-blue-500">
                    @error('urutan')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        {{-- Deskripsi Singkat --}}
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
            <h2 class="text-lg font-semibold text-slate-800 mb-4 flex items-center gap-2">
                <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"/>
                </svg>
                Deskripsi Singkat
            </h2>
            <div>
                <textarea name="deskripsi" rows="3" 
                    class="w-full rounded-lg border-slate-300 focus:border-blue-500 focus:ring-blue-500"
                    placeholder="Deskripsi singkat tentang jurusan (tampil di hero & list)...">{{ old('deskripsi') }}</textarea>
                @error('deskripsi')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        {{-- Deskripsi Lengkap --}}
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
            <h2 class="text-lg font-semibold text-slate-800 mb-4 flex items-center gap-2">
                <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                Deskripsi Lengkap
            </h2>
            <div>
                <textarea name="deskripsi_lengkap" rows="6" 
                    class="w-full rounded-lg border-slate-300 focus:border-blue-500 focus:ring-blue-500"
                    placeholder="Deskripsi lengkap tentang jurusan (tampil di halaman detail)...">{{ old('deskripsi_lengkap') }}</textarea>
                @error('deskripsi_lengkap')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        {{-- Kompetensi --}}
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-semibold text-slate-800 flex items-center gap-2">
                    <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                    </svg>
                    Kompetensi Utama
                </h2>
                <button type="button" onclick="addDetailItem('kompetensi')" class="text-sm text-blue-600 hover:text-blue-800 font-medium flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                    </svg>
                    Tambah Kompetensi
                </button>
            </div>
            <div id="kompetensi-container" class="space-y-3">
                {{-- Default item --}}
                <div class="detail-item-kompetensi border border-slate-200 rounded-lg p-3">
                    <div class="flex justify-between items-start mb-2">
                        <input type="text" name="kompetensi_judul[]" 
                            class="flex-1 rounded-lg border-slate-300 focus:border-blue-500 focus:ring-blue-500 text-sm font-medium"
                            placeholder="Judul kompetensi (contoh: Teknik Jaringan)">
                        <button type="button" onclick="removeDetailItem(this, 'kompetensi')" class="text-red-500 hover:text-red-700 p-1 ml-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>
                    <textarea name="kompetensi_deskripsi[]" rows="2" 
                        class="w-full rounded-lg border-slate-300 focus:border-blue-500 focus:ring-blue-500 text-sm"
                        placeholder="Deskripsi kompetensi (opsional)..."></textarea>
                </div>
            </div>
        </div>

        {{-- Mata Pelajaran --}}
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-semibold text-slate-800 flex items-center gap-2">
                    <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                    Mata Pelajaran Produk
                </h2>
                <button type="button" onclick="addDetailItem('mapel')" class="text-sm text-blue-600 hover:text-blue-800 font-medium flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                    </svg>
                    Tambah Mapel
                </button>
            </div>
            <div id="mapel-container" class="space-y-3">
                {{-- Default item --}}
                <div class="detail-item-mapel border border-slate-200 rounded-lg p-3">
                    <div class="flex justify-between items-start mb-2">
                        <input type="text" name="mapel_judul[]" 
                            class="flex-1 rounded-lg border-slate-300 focus:border-blue-500 focus:ring-blue-500 text-sm font-medium"
                            placeholder="Judul mata pelajaran (contoh: Matematika)">
                        <button type="button" onclick="removeDetailItem(this, 'mapel')" class="text-red-500 hover:text-red-700 p-1 ml-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>
                    <textarea name="mapel_deskripsi[]" rows="2" 
                        class="w-full rounded-lg border-slate-300 focus:border-blue-500 focus:ring-blue-500 text-sm"
                        placeholder="Deskripsi mata pelajaran (opsional)..."></textarea>
                </div>
            </div>
        </div>

        {{-- Info Program Dinamis --}}
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-semibold text-slate-800 flex items-center gap-2">
                    <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Info Program
                </h2>
                <button type="button" onclick="addInfoProgram()" class="text-sm text-blue-600 hover:text-blue-800 font-medium flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                    </svg>
                    Tambah Info
                </button>
            </div>
            <div id="info-program-container" class="space-y-3">
                {{-- Default items --}}
                <div class="flex gap-3 info-program-item">
                    <div class="flex-1">
                        <input type="text" name="info_label[]" value="Durasi" 
                            class="w-full rounded-lg border-slate-300 focus:border-blue-500 focus:ring-blue-500 text-sm"
                            placeholder="Label (contoh: Durasi)">
                    </div>
                    <div class="flex-1">
                        <input type="text" name="info_value[]" value="3 Tahun" 
                            class="w-full rounded-lg border-slate-300 focus:border-blue-500 focus:ring-blue-500 text-sm"
                            placeholder="Value (contoh: 3 Tahun)">
                    </div>
                    <button type="button" onclick="removeInfoProgram(this)" class="text-red-500 hover:text-red-700 p-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                    </button>
                </div>
                <div class="flex gap-3 info-program-item">
                    <div class="flex-1">
                        <input type="text" name="info_label[]" value="Sertifikasi" 
                            class="w-full rounded-lg border-slate-300 focus:border-blue-500 focus:ring-blue-500 text-sm"
                            placeholder="Label (contoh: Sertifikasi)">
                    </div>
                    <div class="flex-1">
                        <input type="text" name="info_value[]" value="BNSP / LSP" 
                            class="w-full rounded-lg border-slate-300 focus:border-blue-500 focus:ring-blue-500 text-sm"
                            placeholder="Value (contoh: BNSP / LSP)">
                    </div>
                    <button type="button" onclick="removeInfoProgram(this)" class="text-red-500 hover:text-red-700 p-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                    </button>
                </div>
                <div class="flex gap-3 info-program-item">
                    <div class="flex-1">
                        <input type="text" name="info_label[]" value="Prakerin" 
                            class="w-full rounded-lg border-slate-300 focus:border-blue-500 focus:ring-blue-500 text-sm"
                            placeholder="Label (contoh: Prakerin)">
                    </div>
                    <div class="flex-1">
                        <input type="text" name="info_value[]" value="Di Industri" 
                            class="w-full rounded-lg border-slate-300 focus:border-blue-500 focus:ring-blue-500 text-sm"
                            placeholder="Value (contoh: Di Industri)">
                    </div>
                    <button type="button" onclick="removeInfoProgram(this)" class="text-red-500 hover:text-red-700 p-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                    </button>
                </div>
            </div>
            <p class="text-xs text-slate-500 mt-3">Klik "Tambah Info" untuk menambahkan item info program lainnya (Biaya, Fasilitas, dll)</p>
        </div>

        {{-- Peluang Karir --}}
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-semibold text-slate-800 flex items-center gap-2">
                    <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                    Peluang Karir
                </h2>
                <button type="button" onclick="addDetailItem('karir')" class="text-sm text-blue-600 hover:text-blue-800 font-medium flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                    </svg>
                    Tambah Karir
                </button>
            </div>
            <div id="karir-container" class="space-y-3">
                {{-- Default item --}}
                <div class="detail-item-karir border border-slate-200 rounded-lg p-3">
                    <div class="flex justify-between items-start mb-2">
                        <input type="text" name="karir_judul[]" 
                            class="flex-1 rounded-lg border-slate-300 focus:border-blue-500 focus:ring-blue-500 text-sm font-medium"
                            placeholder="Judul karir (contoh: Network Engineer)">
                        <button type="button" onclick="removeDetailItem(this, 'karir')" class="text-red-500 hover:text-red-700 p-1 ml-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>
                    <textarea name="karir_deskripsi[]" rows="2" 
                        class="w-full rounded-lg border-slate-300 focus:border-blue-500 focus:ring-blue-500 text-sm"
                        placeholder="Deskripsi karir (opsional)..."></textarea>
                </div>
            </div>
        </div>

        {{-- Kegiatan --}}
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-semibold text-slate-800 flex items-center gap-2">
                    <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Kegiatan
                </h2>
                <button type="button" onclick="addKegiatan()" class="text-sm text-blue-600 hover:text-blue-800 font-medium flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                    </svg>
                    Tambah Kegiatan
                </button>
            </div>
            <div id="kegiatan-container" class="space-y-4">
                {{-- Default item --}}
                <div class="kegiatan-item border border-slate-200 rounded-xl p-4" data-index="0">
                    <input type="hidden" name="kegiatan_id[]" value="new">
                    <div class="flex justify-between items-start mb-3">
                        <input type="text" name="kegiatan_judul[]" 
                            class="flex-1 rounded-lg border-slate-300 focus:border-blue-500 focus:ring-blue-500 text-sm font-medium mr-2"
                            placeholder="Judul kegiatan (contoh: Praktek di Lab)">
                        <button type="button" onclick="removeKegiatan(this)" class="text-red-500 hover:text-red-700 p-1">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                        </button>
                    </div>
                    <textarea name="kegiatan_deskripsi[]" rows="2" 
                        class="w-full rounded-lg border-slate-300 focus:border-blue-500 focus:ring-blue-500 text-sm mb-3"
                        placeholder="Deskripsi kegiatan (opsional)..."></textarea>
                    
                    {{-- Gambar Kegiatan --}}
                    <div class="mb-2">
                        <label class="block text-xs font-medium text-slate-600 mb-2">Gambar Kegiatan (bisa lebih dari satu)</label>
                        <div class="flex items-center gap-2">
                            <label class="flex items-center gap-2 px-4 py-2 bg-slate-100 hover:bg-slate-200 rounded-lg cursor-pointer transition text-sm text-slate-700">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                Tambah Gambar
                                <input type="file" name="kegiatan_gambar_0[]" multiple accept="image/*" class="hidden" onchange="previewKegiatanGambar(this, 0)">
                            </label>
                            <span class="text-xs text-slate-500">PNG, JPG, WEBP up to 2MB per gambar</span>
                        </div>
                        <div id="preview-kegiatan-0" class="flex flex-wrap gap-2 mt-2"></div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Media --}}
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
            <h2 class="text-lg font-semibold text-slate-800 mb-4 flex items-center gap-2">
                <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                Media (Logo & Gambar)
            </h2>
            <div class="grid md:grid-cols-2 gap-6">
                {{-- Logo --}}
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Logo Jurusan</label>
                    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-slate-300 border-dashed rounded-xl hover:border-blue-400 transition cursor-pointer relative" onclick="document.getElementById('logo').click()">
                        <div class="space-y-1 text-center">
                            <svg class="mx-auto h-12 w-12 text-slate-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <div class="flex text-sm text-slate-600 justify-center">
                                <span class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500">Upload file</span>
                            </div>
                            <p class="text-xs text-slate-500">PNG, JPG, WEBP up to 2MB</p>
                        </div>
                        <img id="logo-preview" class="absolute inset-0 w-full h-full object-contain p-2 hidden bg-white rounded-xl">
                    </div>
                    <input id="logo" name="logo" type="file" accept="image/*" class="sr-only" onchange="previewImage(this, 'logo-preview')">
                    @error('logo')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Gambar --}}
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Gambar Jurusan</label>
                    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-slate-300 border-dashed rounded-xl hover:border-blue-400 transition cursor-pointer relative" onclick="document.getElementById('gambar').click()">
                        <div class="space-y-1 text-center">
                            <svg class="mx-auto h-12 w-12 text-slate-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <div class="flex text-sm text-slate-600 justify-center">
                                <span class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500">Upload file</span>
                            </div>
                            <p class="text-xs text-slate-500">PNG, JPG, WEBP up to 5MB</p>
                        </div>
                        <img id="gambar-preview" class="absolute inset-0 w-full h-full object-contain p-2 hidden bg-white rounded-xl">
                    </div>
                    <input id="gambar" name="gambar" type="file" accept="image/*" class="sr-only" onchange="previewImage(this, 'gambar-preview')">
                    @error('gambar')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        {{-- Actions --}}
        <div class="flex gap-4">
            <button type="submit" class="btn btn-primary shadow-lg hover:shadow-xl">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                Simpan Jurusan
            </button>
            <a href="{{ route('admin.jurusan.index') }}" class="btn btn-secondary">
                Batal
            </a>
        </div>
    </form>
</div>

@push('scripts')
<script>
function previewImage(input, previewId) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const preview = document.getElementById(previewId);
            preview.src = e.target.result;
            preview.classList.remove('hidden');
        }
        reader.readAsDataURL(input.files[0]);
    }
}

function addInfoProgram() {
    const container = document.getElementById('info-program-container');
    const item = document.createElement('div');
    item.className = 'flex gap-3 info-program-item';
    item.innerHTML = `
        <div class="flex-1">
            <input type="text" name="info_label[]" 
                class="w-full rounded-lg border-slate-300 focus:border-blue-500 focus:ring-blue-500 text-sm"
                placeholder="Label (contoh: Biaya)">
        </div>
        <div class="flex-1">
            <input type="text" name="info_value[]" 
                class="w-full rounded-lg border-slate-300 focus:border-blue-500 focus:ring-blue-500 text-sm"
                placeholder="Value (contoh: Rp 500.000)">
        </div>
        <button type="button" onclick="removeInfoProgram(this)" class="text-red-500 hover:text-red-700 p-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
            </svg>
        </button>
    `;
    container.appendChild(item);
}

function removeInfoProgram(button) {
    const items = document.querySelectorAll('.info-program-item');
    if (items.length > 1) {
        button.closest('.info-program-item').remove();
    } else {
        alert('Minimal harus ada 1 info program');
    }
}

function addDetailItem(tipe) {
    const container = document.getElementById(tipe + '-container');
    const item = document.createElement('div');
    item.className = 'detail-item-' + tipe + ' border border-slate-200 rounded-lg p-3';
    
    let placeholderJudul = '';
    if (tipe === 'kompetensi') placeholderJudul = 'Judul kompetensi (contoh: Teknik Jaringan)';
    else if (tipe === 'mapel') placeholderJudul = 'Judul mata pelajaran (contoh: Matematika)';
    else if (tipe === 'karir') placeholderJudul = 'Judul karir (contoh: Network Engineer)';
    
    item.innerHTML = `
        <div class="flex justify-between items-start mb-2">
            <input type="text" name="${tipe}_judul[]" 
                class="flex-1 rounded-lg border-slate-300 focus:border-blue-500 focus:ring-blue-500 text-sm font-medium"
                placeholder="${placeholderJudul}">
            <button type="button" onclick="removeDetailItem(this, '${tipe}')" class="text-red-500 hover:text-red-700 p-1 ml-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
        <textarea name="${tipe}_deskripsi[]" rows="2" 
            class="w-full rounded-lg border-slate-300 focus:border-blue-500 focus:ring-blue-500 text-sm"
            placeholder="Deskripsi ${tipe} (opsional)..."></textarea>
    `;
    container.appendChild(item);
}

function removeDetailItem(button, tipe) {
    const items = document.querySelectorAll('.detail-item-' + tipe);
    if (items.length > 1) {
        button.closest('.detail-item-' + tipe).remove();
    } else {
        alert('Minimal harus ada 1 item ' + tipe);
    }
}

// Kegiatan Functions
let kegiatanIndex = 1;

function addKegiatan() {
    const container = document.getElementById('kegiatan-container');
    const item = document.createElement('div');
    item.className = 'kegiatan-item border border-slate-200 rounded-xl p-4';
    item.setAttribute('data-index', kegiatanIndex);
    item.innerHTML = `
        <input type="hidden" name="kegiatan_id[]" value="new">
        <div class="flex justify-between items-start mb-3">
            <input type="text" name="kegiatan_judul[]" 
                class="flex-1 rounded-lg border-slate-300 focus:border-blue-500 focus:ring-blue-500 text-sm font-medium mr-2"
                placeholder="Judul kegiatan (contoh: Praktek di Lab)">
            <button type="button" onclick="removeKegiatan(this)" class="text-red-500 hover:text-red-700 p-1">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                </svg>
            </button>
        </div>
        <textarea name="kegiatan_deskripsi[]" rows="2" 
            class="w-full rounded-lg border-slate-300 focus:border-blue-500 focus:ring-blue-500 text-sm mb-3"
            placeholder="Deskripsi kegiatan (opsional)..."></textarea>
        
        <div class="mb-2">
            <label class="block text-xs font-medium text-slate-600 mb-2">Gambar Kegiatan (bisa lebih dari satu)</label>
            <div class="flex items-center gap-2">
                <label class="flex items-center gap-2 px-4 py-2 bg-slate-100 hover:bg-slate-200 rounded-lg cursor-pointer transition text-sm text-slate-700">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    Tambah Gambar
                    <input type="file" name="kegiatan_gambar_${kegiatanIndex}[]" multiple accept="image/*" class="hidden" onchange="previewKegiatanGambar(this, ${kegiatanIndex})">
                </label>
                <span class="text-xs text-slate-500">PNG, JPG, WEBP up to 2MB per gambar</span>
            </div>
            <div id="preview-kegiatan-${kegiatanIndex}" class="flex flex-wrap gap-2 mt-2"></div>
        </div>
    `;
    container.appendChild(item);
    kegiatanIndex++;
}

function removeKegiatan(button) {
    const items = document.querySelectorAll('.kegiatan-item');
    if (items.length > 1) {
        button.closest('.kegiatan-item').remove();
    } else {
        alert('Minimal harus ada 1 kegiatan');
    }
}

function previewKegiatanGambar(input, index) {
    const previewContainer = document.getElementById('preview-kegiatan-' + index);
    previewContainer.innerHTML = '';
    
    if (input.files) {
        Array.from(input.files).forEach(file => {
            const reader = new FileReader();
            reader.onload = function(e) {
                const div = document.createElement('div');
                div.className = 'relative';
                div.innerHTML = `
                    <img src="${e.target.result}" class="w-20 h-20 object-cover rounded-lg border border-slate-200">
                `;
                previewContainer.appendChild(div);
            }
            reader.readAsDataURL(file);
        });
    }
}
</script>
@endpush
@endsection
