@extends('layouts.admin')

@section('title', 'Tambah Calon Siswa - Admin Panel')

@section('content')
    {{-- Breadcrumb --}}
    <div class="mb-4">
        <a href="{{ route('admin.pendaftar.index') }}" class="inline-flex items-center gap-1.5 text-sm text-gray-500 hover:text-primary transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Kembali ke Daftar Pendaftar
        </a>
    </div>

    {{-- Header --}}
    <div class="mb-6">
        <h1 class="text-xl font-bold text-gray-900">Tambah Calon Siswa Baru</h1>
        <p class="text-sm text-gray-500 mt-1">Isi data lengkap calon siswa untuk pendaftaran PPDB</p>
    </div>

    {{-- Alerts --}}
    @if(session('error'))
    <div class="mb-4 p-3 bg-red-50 border border-red-200 text-red-700 rounded-lg text-sm">
        {{ session('error') }}
    </div>
    @endif

    @if($errors->any())
    <div class="mb-4 p-3 bg-red-50 border border-red-200 text-red-700 rounded-lg text-sm">
        <p class="font-medium mb-1">Terdapat kesalahan:</p>
        <ul class="list-disc list-inside text-xs">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('admin.pendaftar.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
            {{-- Data Siswa --}}
            <div class="card p-4">
                <h3 class="font-semibold text-sm text-gray-800 mb-4 flex items-center gap-2 pb-2 border-b border-gray-100">
                    <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    Data Siswa <span class="text-red-500">*</span>
                </h3>
                <div class="space-y-3">
                    {{-- NISN --}}
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1">
                            NISN <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="nisn" value="{{ old('nisn') }}" required maxlength="10"
                               class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary font-mono"
                               placeholder="10 digit NISN">
                    </div>

                    {{-- NIK --}}
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1">
                            NIK <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="nik" value="{{ old('nik') }}" required maxlength="16"
                               class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary font-mono"
                               placeholder="16 digit NIK">
                    </div>

                    {{-- No KK --}}
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1">
                            Nomor KK <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="no_kk" value="{{ old('no_kk') }}" required maxlength="16"
                               class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary font-mono"
                               placeholder="16 digit Nomor KK">
                    </div>

                    {{-- Nama --}}
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1">
                            Nama Lengkap <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="nama" value="{{ old('nama') }}" required 
                               class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary">
                    </div>

                    {{-- Tempat Lahir --}}
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1">Tempat Lahir</label>
                        <input type="text" name="tempat_lahir" value="{{ old('tempat_lahir') }}" 
                               class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary">
                    </div>

                    {{-- Tanggal Lahir --}}
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1">Tanggal Lahir</label>
                        <input type="date" name="tgl_lahir" value="{{ old('tgl_lahir') }}" 
                               class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary">
                    </div>

                    {{-- Jenis Kelamin --}}
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1">
                            Jenis Kelamin <span class="text-red-500">*</span>
                        </label>
                        <div class="flex gap-4 mt-1">
                            <label class="flex items-center cursor-pointer">
                                <input type="radio" name="jk" value="L" 
                                    {{ old('jk') === 'L' ? 'checked' : '' }}
                                    class="w-4 h-4 text-primary border-gray-300 focus:ring-primary">
                                <span class="ml-2 text-sm text-gray-700">Laki-laki</span>
                            </label>
                            <label class="flex items-center cursor-pointer">
                                <input type="radio" name="jk" value="P" 
                                    {{ old('jk') === 'P' ? 'checked' : '' }}
                                    class="w-4 h-4 text-primary border-gray-300 focus:ring-primary">
                                <span class="ml-2 text-sm text-gray-700">Perempuan</span>
                            </label>
                        </div>
                    </div>

                    {{-- No WA --}}
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1">No. WhatsApp</label>
                        <input type="text" name="no_wa" value="{{ old('no_wa') }}" 
                               placeholder="081234567890"
                               class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary">
                    </div>

                    {{-- Asal Sekolah --}}
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1">Asal Sekolah</label>
                        <input type="text" name="asal_sekolah" value="{{ old('asal_sekolah') }}" 
                               placeholder="Nama SMP/MTs"
                               class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary">
                    </div>

                    {{-- Alamat Sekolah --}}
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1">Alamat Sekolah Asal <span class="text-red-500">*</span></label>
                        <textarea name="alamat_sekolah" rows="2" required placeholder="Alamat lengkap sekolah..."
                                  class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary">{{ old('alamat_sekolah') }}</textarea>
                    </div>

                    {{-- Alamat --}}
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1">Alamat Rumah <span class="text-red-500">*</span></label>
                        <textarea name="alamat" rows="3" required placeholder="Alamat lengkap..."
                                  class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary">{{ old('alamat') }}</textarea>
                    </div>

                    {{-- Password --}}
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

            {{-- Data Pendaftaran & Orang Tua/Wali & Tes/Wawancara --}}
            <div class="space-y-4">
                {{-- Data Pendaftaran --}}
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
                                @foreach($jurusan as $j)
                                <option value="{{ $j->id }}" {{ old('jurusan_id') == $j->id ? 'selected' : '' }}>
                                    {{ $j->nama }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-600 mb-1">Gelombang</label>
                            <input type="text" name="gelombang" value="{{ old('gelombang', 'Gelombang 1') }}" 
                                   placeholder="Gelombang 1"
                                   class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary">
                        </div>
                    </div>
                </div>

                {{-- Status Wawancara & Minat Bakat --}}
                <div class="card p-4 border-l-4 border-primary">
                    <h3 class="font-semibold text-sm text-gray-800 mb-4 flex items-center gap-2 pb-2 border-b border-gray-100">
                        <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                        </svg>
                        Status Tes & Wawancara
                    </h3>
                    <div class="space-y-3">
                        {{-- Status Wawancara --}}
                        <div>
                            <label class="block text-xs font-medium text-gray-600 mb-1">
                                Status Wawancara
                            </label>
                            <select name="status_wawancara" 
                                    class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary bg-white">
                                <option value="belum" {{ old('status_wawancara', 'belum') == 'belum' ? 'selected' : '' }}>
                                    Belum
                                </option>
                                <option value="sudah" {{ old('status_wawancara') == 'sudah' ? 'selected' : '' }}>
                                    Sudah
                                </option>
                            </select>
                            <p class="text-xs text-gray-500 mt-1">
                                * Jika diubah ke "Sudah", siswa otomatis dinyatakan <strong>LULUS</strong>
                            </p>
                        </div>

                        {{-- Minat Bakat --}}
                        <div>
                            <label class="block text-xs font-medium text-gray-600 mb-1">
                                Minat dan Bakat
                            </label>
                            <textarea name="nilai_minat_bakat" rows="3"
                                   placeholder="Deskripsikan minat dan bakat siswa..."
                                   class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary">{{ old('nilai_minat_bakat') }}</textarea>
                            <p class="text-xs text-gray-500 mt-1">Isi secara manual berdasarkan hasil tes</p>
                        </div>
                    </div>
                </div>

                {{-- Data Orang Tua / Wali --}}
                <div class="card p-4">
                    <h3 class="font-semibold text-sm text-gray-800 mb-4 flex items-center gap-2 pb-2 border-b border-gray-100">
                        <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                        Data Orang Tua / Wali
                    </h3>
                    
                    {{-- Pilihan Jenis --}}
                    <div class="mb-4">
                        <label class="block text-xs font-medium text-gray-600 mb-2">Pilih Jenis <span class="text-red-500">*</span></label>
                        <div class="flex gap-4">
                            <label class="flex items-center cursor-pointer">
                                <input type="radio" name="jenis" value="orang_tua" 
                                    {{ old('jenis', 'orang_tua') === 'orang_tua' ? 'checked' : '' }}
                                    class="jenis-radio w-4 h-4 text-primary border-gray-300 focus:ring-primary"
                                    onchange="toggleJenis()">
                                <span class="ml-2 text-sm text-gray-700">Orang Tua</span>
                            </label>
                            <label class="flex items-center cursor-pointer">
                                <input type="radio" name="jenis" value="wali" 
                                    {{ old('jenis') === 'wali' ? 'checked' : '' }}
                                    class="jenis-radio w-4 h-4 text-primary border-gray-300 focus:ring-primary"
                                    onchange="toggleJenis()">
                                <span class="ml-2 text-sm text-gray-700">Wali</span>
                            </label>
                        </div>
                    </div>

                    {{-- Form Orang Tua --}}
                    <div id="form-orang-tua" class="space-y-3">
                        <div class="grid grid-cols-2 gap-3">
                            {{-- Nama Ayah --}}
                            <div>
                                <label class="block text-xs font-medium text-gray-600 mb-1">Nama Ayah <span class="text-red-500">*</span></label>
                                <input type="text" id="nama_ayah" name="nama_ayah" 
                                       value="{{ old('nama_ayah') }}"
                                       class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary">
                            </div>
                            {{-- NIK Ayah --}}
                            <div>
                                <label class="block text-xs font-medium text-gray-600 mb-1">NIK Ayah <span class="text-red-500">*</span></label>
                                <input type="text" id="nik_ayah" name="nik_ayah" maxlength="16"
                                       value="{{ old('nik_ayah') }}"
                                       placeholder="16 digit NIK"
                                       class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary font-mono">
                            </div>
                        </div>

                        {{-- Status Ayah --}}
                        <div>
                            <label class="block text-xs font-medium text-gray-600 mb-1">Status Ayah <span class="text-red-500">*</span></label>
                            <div class="flex gap-4 mt-1">
                                <label class="flex items-center cursor-pointer">
                                    <input type="radio" name="status_ayah" value="hidup" 
                                        {{ old('status_ayah', 'hidup') === 'hidup' ? 'checked' : '' }}
                                        class="w-4 h-4 text-primary border-gray-300 focus:ring-primary">
                                    <span class="ml-2 text-sm text-gray-700">Masih Hidup</span>
                                </label>
                                <label class="flex items-center cursor-pointer">
                                    <input type="radio" name="status_ayah" value="meninggal" 
                                        {{ old('status_ayah') === 'meninggal' ? 'checked' : '' }}
                                        class="w-4 h-4 text-primary border-gray-300 focus:ring-primary">
                                    <span class="ml-2 text-sm text-gray-700">Meninggal</span>
                                </label>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-3">
                            {{-- Nama Ibu --}}
                            <div>
                                <label class="block text-xs font-medium text-gray-600 mb-1">Nama Ibu <span class="text-red-500">*</span></label>
                                <input type="text" id="nama_ibu" name="nama_ibu" 
                                       value="{{ old('nama_ibu') }}"
                                       class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary">
                            </div>
                            {{-- NIK Ibu --}}
                            <div>
                                <label class="block text-xs font-medium text-gray-600 mb-1">NIK Ibu <span class="text-red-500">*</span></label>
                                <input type="text" id="nik_ibu" name="nik_ibu" maxlength="16"
                                       value="{{ old('nik_ibu') }}"
                                       placeholder="16 digit NIK"
                                       class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary font-mono">
                            </div>
                        </div>

                        {{-- Status Ibu --}}
                        <div>
                            <label class="block text-xs font-medium text-gray-600 mb-1">Status Ibu <span class="text-red-500">*</span></label>
                            <div class="flex gap-4 mt-1">
                                <label class="flex items-center cursor-pointer">
                                    <input type="radio" name="status_ibu" value="hidup" 
                                        {{ old('status_ibu', 'hidup') === 'hidup' ? 'checked' : '' }}
                                        class="w-4 h-4 text-primary border-gray-300 focus:ring-primary">
                                    <span class="ml-2 text-sm text-gray-700">Masih Hidup</span>
                                </label>
                                <label class="flex items-center cursor-pointer">
                                    <input type="radio" name="status_ibu" value="meninggal" 
                                        {{ old('status_ibu') === 'meninggal' ? 'checked' : '' }}
                                        class="w-4 h-4 text-primary border-gray-300 focus:ring-primary">
                                    <span class="ml-2 text-sm text-gray-700">Meninggal</span>
                                </label>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-3">
                            {{-- Pekerjaan --}}
                            <div>
                                <label class="block text-xs font-medium text-gray-600 mb-1">Pekerjaan <span class="text-red-500">*</span></label>
                                <input type="text" id="pekerjaan" name="pekerjaan" 
                                       value="{{ old('pekerjaan') }}"
                                       placeholder="Contoh: Wiraswasta"
                                       class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary">
                            </div>
                            {{-- No WA Ortu --}}
                            <div>
                                <label class="block text-xs font-medium text-gray-600 mb-1">No. WA Ortu <span class="text-red-500">*</span></label>
                                <input type="text" id="no_wa_ortu" name="no_wa_ortu" 
                                       value="{{ old('no_wa_ortu') }}"
                                       placeholder="081234567890"
                                       class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary">
                            </div>
                        </div>
                    </div>

                    {{-- Form Wali (Hidden by default) --}}
                    <div id="form-wali" class="hidden space-y-3">
                        <div class="grid grid-cols-2 gap-3">
                            {{-- Nama Wali --}}
                            <div>
                                <label class="block text-xs font-medium text-gray-600 mb-1">Nama Wali <span class="text-red-500">*</span></label>
                                <input type="text" id="nama_wali" name="nama_wali" 
                                       value="{{ old('nama_wali') }}"
                                       class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary">
                            </div>
                            {{-- Pekerjaan Wali --}}
                            <div>
                                <label class="block text-xs font-medium text-gray-600 mb-1">Pekerjaan Wali <span class="text-red-500">*</span></label>
                                <input type="text" id="pekerjaan_wali" name="pekerjaan_wali" 
                                       value="{{ old('pekerjaan_wali') }}"
                                       placeholder="Contoh: PNS"
                                       class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary">
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-3">
                            {{-- No HP Wali --}}
                            <div>
                                <label class="block text-xs font-medium text-gray-600 mb-1">No. HP Wali <span class="text-red-500">*</span></label>
                                <input type="text" id="no_hp_wali" name="no_hp_wali" 
                                       value="{{ old('no_hp_wali') }}"
                                       placeholder="081234567890"
                                       class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary">
                            </div>
                            {{-- Hubungan Wali --}}
                            <div>
                                <label class="block text-xs font-medium text-gray-600 mb-1">Hubungan <span class="text-red-500">*</span></label>
                                <input type="text" id="hubungan_wali" name="hubungan_wali" 
                                       value="{{ old('hubungan_wali') }}"
                                       placeholder="Contoh: Paman, Bibi"
                                       class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Upload Berkas --}}
            <div class="card p-4">
                <h3 class="font-semibold text-sm text-gray-800 mb-4 flex items-center gap-2 pb-2 border-b border-gray-100">
                    <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    Upload Berkas Pendaftaran
                </h3>
                
                <div class="space-y-4">
                    @foreach($berkasList as $key => $label)
                        <div class="p-3 border border-gray-200 rounded-lg bg-gray-50 hover:border-primary/50 transition group">
                            <label class="block text-xs font-medium text-gray-700 mb-2">
                                {{ $label }} <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <input type="file" name="berkas[{{ $key }}]" id="berkas_{{ $key }}"
                                       accept=".pdf,.jpg,.jpeg,.png" required
                                       class="hidden"
                                       onchange="updateFileLabel(this, '{{ $key }}')">
                                <label for="berkas_{{ $key }}" 
                                       class="flex items-center gap-3 cursor-pointer">
                                    <div class="flex-1 px-3 py-2 bg-white border border-gray-300 rounded-md text-sm text-gray-500 truncate group-hover:border-primary/50 transition"
                                         id="label_{{ $key }}">
                                        <span class="file-placeholder">Pilih file...</span>
                                    </div>
                                    <div class="px-3 py-2 bg-primary text-white rounded-md text-xs font-medium hover:bg-blue-700 transition whitespace-nowrap">
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
                            <div id="preview_{{ $key }}" class="mt-2 hidden">
                                <div class="flex items-center gap-2 p-2 bg-blue-50 border border-blue-200 rounded-md">
                                    <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    <span class="text-xs text-blue-700 font-medium file-name">File terpilih</span>
                                    <button type="button" onclick="clearFile('{{ $key }}')" class="ml-auto text-xs text-red-500 hover:text-red-700">
                                        Hapus
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
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

        {{-- Action Buttons --}}
        <div class="mt-6 flex justify-end gap-2 pt-4 border-t border-gray-200">
            <a href="{{ route('admin.pendaftar.index') }}" 
               class="px-4 py-2 bg-gray-100 text-gray-700 text-sm font-medium rounded-md hover:bg-gray-200 transition">
                Batal
            </a>
            <button type="submit" class="px-4 py-2 bg-primary text-white text-sm font-medium rounded-md hover:bg-blue-700 transition flex items-center gap-1.5">
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
        document.getElementById('pekerjaan').required = true;
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
        document.getElementById('pekerjaan').required = false;
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
@endsection
