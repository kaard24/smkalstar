@extends('layouts.admin')

@section('title', 'Edit Data Siswa - Admin Panel')

@section('content')
    {{-- Breadcrumb --}}
    <div class="mb-4">
        <a href="{{ route('admin.pendaftar.index') }}" class="inline-flex items-center gap-1.5 text-sm text-slate-500 hover:text-[#4276A3] transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Kembali ke Daftar Pendaftar
        </a>
    </div>

    {{-- Header --}}
    <div class="mb-6">
        <h1 class="text-xl font-bold text-slate-800">Edit Data Calon Siswa</h1>
        <div class="flex items-center gap-2 mt-1">
            <span class="text-sm text-slate-600">{{ $siswa->nama }}</span>
            <span class="px-2 py-0.5 bg-slate-100 text-slate-600 rounded text-xs font-mono">{{ $siswa->nisn }}</span>
        </div>
    </div>

    {{-- Alerts --}}
    @if(session('error'))
    <div class="mb-4 p-3 bg-[#991B1B]/10 border border-[#991B1B]/20 text-[#991B1B] rounded-lg text-sm">
        {{ session('error') }}
    </div>
    @endif

    @if(session('success'))
    <div class="mb-4 p-3 bg-[#4276A3]/10 border border-[#4276A3]/20 text-[#4276A3] rounded-lg text-sm">
        {{ session('success') }}
    </div>
    @endif

    @if($errors->any())
    <div class="mb-4 p-3 bg-[#991B1B]/10 border border-[#991B1B]/20 text-[#991B1B] rounded-lg text-sm">
        <p class="font-medium mb-1">Terdapat kesalahan:</p>
        <ul class="list-disc list-inside text-xs">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('admin.pendaftar.update', $siswa->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
            {{-- Data Siswa --}}
            <div class="card p-4">
                <h3 class="font-semibold text-sm text-slate-800 mb-4 flex items-center gap-2 pb-2 border-b border-slate-100">
                    <svg class="w-4 h-4 text-[#4276A3]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    Data Siswa
                </h3>
                <div class="space-y-3">
                    {{-- NISN (Read Only) --}}
                    <div>
                        <label class="block text-xs font-medium text-slate-600 mb-1">NISN</label>
                        <input type="text" value="{{ $siswa->nisn }}" disabled 
                               class="w-full px-3 py-2 text-sm border border-slate-200 rounded-md bg-slate-50 text-slate-500 font-mono">
                    </div>

                    {{-- NIK --}}
                    <div>
                        <label class="block text-xs font-medium text-slate-600 mb-1">
                            NIK <span class="text-[#991B1B]">*</span>
                        </label>
                        <input type="text" name="nik" maxlength="16" 
                               value="{{ old('nik', $siswa->nik) }}" required
                               placeholder="16 digit NIK"
                               class="w-full px-3 py-2 text-sm border border-slate-300 rounded-md focus:outline-none focus:border-[#4276A3] focus:ring-1 focus:ring-[#4276A3]">
                    </div>

                    {{-- No KK --}}
                    <div>
                        <label class="block text-xs font-medium text-slate-600 mb-1">
                            Nomor KK <span class="text-[#991B1B]">*</span>
                        </label>
                        <input type="text" name="no_kk" maxlength="16" 
                               value="{{ old('no_kk', $siswa->no_kk) }}" required
                               placeholder="16 digit Nomor KK"
                               class="w-full px-3 py-2 text-sm border border-slate-300 rounded-md focus:outline-none focus:border-[#4276A3] focus:ring-1 focus:ring-[#4276A3]">
                    </div>

                    {{-- Nama --}}
                    <div>
                        <label class="block text-xs font-medium text-slate-600 mb-1">
                            Nama Lengkap <span class="text-[#991B1B]">*</span>
                        </label>
                        <input type="text" name="nama" value="{{ old('nama', $siswa->nama) }}" required 
                               class="w-full px-3 py-2 text-sm border border-slate-300 rounded-md focus:outline-none focus:border-[#4276A3] focus:ring-1 focus:ring-[#4276A3]">
                    </div>

                    {{-- Tempat Lahir --}}
                    <div>
                        <label class="block text-xs font-medium text-slate-600 mb-1">Tempat Lahir</label>
                        <input type="text" name="tempat_lahir" value="{{ old('tempat_lahir', $siswa->tempat_lahir) }}" 
                               class="w-full px-3 py-2 text-sm border border-slate-300 rounded-md focus:outline-none focus:border-[#4276A3] focus:ring-1 focus:ring-[#4276A3]">
                    </div>

                    {{-- Tanggal Lahir --}}
                    <div>
                        <label class="block text-xs font-medium text-slate-600 mb-1">Tanggal Lahir</label>
                        <input type="date" name="tgl_lahir" value="{{ old('tgl_lahir', $siswa->tgl_lahir?->format('Y-m-d')) }}" 
                               class="w-full px-3 py-2 text-sm border border-slate-300 rounded-md focus:outline-none focus:border-[#4276A3] focus:ring-1 focus:ring-[#4276A3]">
                    </div>

                    {{-- Jenis Kelamin --}}
                    <div>
                        <label class="block text-xs font-medium text-slate-600 mb-1">
                            Jenis Kelamin <span class="text-[#991B1B]">*</span>
                        </label>
                        <div class="flex gap-4 mt-1">
                            <label class="flex items-center cursor-pointer">
                                <input type="radio" name="jk" value="L" 
                                    {{ old('jk', $siswa->jk) === 'L' ? 'checked' : '' }}
                                    class="w-4 h-4 text-[#4276A3] border-slate-300 focus:ring-[#4276A3]">
                                <span class="ml-2 text-sm text-slate-700">Laki-laki</span>
                            </label>
                            <label class="flex items-center cursor-pointer">
                                <input type="radio" name="jk" value="P" 
                                    {{ old('jk', $siswa->jk) === 'P' ? 'checked' : '' }}
                                    class="w-4 h-4 text-[#4276A3] border-slate-300 focus:ring-[#4276A3]">
                                <span class="ml-2 text-sm text-slate-700">Perempuan</span>
                            </label>
                        </div>
                    </div>

                    {{-- No WA --}}
                    <div>
                        <label class="block text-xs font-medium text-slate-600 mb-1">No. WhatsApp</label>
                        <input type="text" name="no_wa" value="{{ old('no_wa', $siswa->no_wa) }}" 
                               placeholder="081234567890"
                               class="w-full px-3 py-2 text-sm border border-slate-300 rounded-md focus:outline-none focus:border-[#4276A3] focus:ring-1 focus:ring-[#4276A3]">
                    </div>

                    {{-- Asal Sekolah --}}
                    <div>
                        <label class="block text-xs font-medium text-slate-600 mb-1">Asal Sekolah</label>
                        <input type="text" name="asal_sekolah" value="{{ old('asal_sekolah', $siswa->asal_sekolah) }}" 
                               placeholder="Nama SMP/MTs"
                               class="w-full px-3 py-2 text-sm border border-slate-300 rounded-md focus:outline-none focus:border-[#4276A3] focus:ring-1 focus:ring-[#4276A3]">
                    </div>

                    {{-- Alamat Sekolah --}}
                    <div>
                        <label class="block text-xs font-medium text-slate-600 mb-1">Alamat Sekolah Asal</label>
                        <textarea name="alamat_sekolah" rows="2" placeholder="Alamat lengkap sekolah asal..."
                                  class="w-full px-3 py-2 text-sm border border-slate-300 rounded-md focus:outline-none focus:border-[#4276A3] focus:ring-1 focus:ring-[#4276A3]">{{ old('alamat_sekolah', $siswa->alamat_sekolah) }}</textarea>
                    </div>

                    {{-- Alamat --}}
                    <div>
                        <label class="block text-xs font-medium text-slate-600 mb-1">Alamat</label>
                        <textarea name="alamat" rows="3" placeholder="Alamat lengkap..."
                                  class="w-full px-3 py-2 text-sm border border-slate-300 rounded-md focus:outline-none focus:border-[#4276A3] focus:ring-1 focus:ring-[#4276A3]">{{ old('alamat', $siswa->alamat) }}</textarea>
                    </div>
                </div>
            </div>

            {{-- Data Pendaftaran & Orang Tua/Wali & Tes/Wawancara --}}
            <div class="space-y-4">
                {{-- Data Pendaftaran --}}
                <div class="card p-4">
                    <h3 class="font-semibold text-sm text-slate-800 mb-4 flex items-center gap-2 pb-2 border-b border-slate-100">
                        <svg class="w-4 h-4 text-[#4276A3]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        Data Pendaftaran
                    </h3>
                    <div class="space-y-3">
                        <div>
                            <label class="block text-xs font-medium text-slate-600 mb-1">Jurusan</label>
                            <select name="jurusan_id" class="w-full px-3 py-2 text-sm border border-slate-300 rounded-md focus:outline-none focus:border-[#4276A3] focus:ring-1 focus:ring-[#4276A3] bg-white">
                                <option value="">-- Pilih Jurusan --</option>
                                @foreach($jurusan as $j)
                                <option value="{{ $j->id }}" {{ old('jurusan_id', $siswa->pendaftaran?->jurusan_id) == $j->id ? 'selected' : '' }}>
                                    {{ $j->nama }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-slate-600 mb-1">Gelombang</label>
                            <input type="text" name="gelombang" value="{{ old('gelombang', $siswa->pendaftaran?->gelombang) }}" 
                                   placeholder="Gelombang 1"
                                   class="w-full px-3 py-2 text-sm border border-slate-300 rounded-md focus:outline-none focus:border-[#4276A3] focus:ring-1 focus:ring-[#4276A3]">
                        </div>
                    </div>
                </div>

                {{-- Status Wawancara & Minat Bakat --}}
                <div class="card p-4 border-l-4 border-[#4276A3]">
                    <h3 class="font-semibold text-sm text-slate-800 mb-4 flex items-center gap-2 pb-2 border-b border-slate-100">
                        <svg class="w-4 h-4 text-[#4276A3]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                        </svg>
                        Status Tes & Wawancara
                    </h3>
                    <div class="space-y-3">
                        {{-- Status Wawancara --}}
                        <div>
                            <label class="block text-xs font-medium text-slate-600 mb-1">
                                Status Wawancara <span class="text-[#991B1B]">*</span>
                            </label>
                            <select name="status_wawancara" required
                                    class="w-full px-3 py-2 text-sm border border-slate-300 rounded-md focus:outline-none focus:border-[#4276A3] focus:ring-1 focus:ring-[#4276A3] bg-white">
                                <option value="belum" {{ old('status_wawancara', $siswa->pendaftaran?->tes?->status_wawancara ?? 'belum') == 'belum' ? 'selected' : '' }}>
                                    Belum
                                </option>
                                <option value="sudah" {{ old('status_wawancara', $siswa->pendaftaran?->tes?->status_wawancara) == 'sudah' ? 'selected' : '' }}>
                                    Sudah
                                </option>
                            </select>
                            <p class="text-xs text-slate-500 mt-1">
                                * Jika diubah ke "Sudah", siswa otomatis dinyatakan <strong>LULUS</strong>
                            </p>
                        </div>

                        {{-- Nilai Minat Bakat --}}
                        <div>
                            <label class="block text-xs font-medium text-slate-600 mb-1">
                                Minat dan Bakat
                            </label>
                            <textarea name="nilai_minat_bakat" rows="3"
                                   placeholder="Deskripsikan minat dan bakat siswa..."
                                   class="w-full px-3 py-2 text-sm border border-slate-300 rounded-md focus:outline-none focus:border-[#4276A3] focus:ring-1 focus:ring-[#4276A3]">{{ old('nilai_minat_bakat', $siswa->pendaftaran?->tes?->nilai_minat_bakat) }}</textarea>
                            <p class="text-xs text-slate-500 mt-1">Isi secara manual berdasarkan hasil tes</p>
                        </div>

                        {{-- Status Saat Ini --}}
                        @if($siswa->pendaftaran?->tes)
                        <div class="p-3 bg-slate-50 rounded-lg mt-3">
                            <p class="text-xs text-slate-600">Status Saat Ini:</p>
                            <div class="flex items-center gap-2 mt-1">
                                <span class="px-2 py-1 text-xs rounded font-medium 
                                    {{ $siswa->pendaftaran->tes->status_wawancara === 'sudah' ? 'bg-[#4276A3]/10 text-[#4276A3]' : 'bg-[#B45309]/10 text-[#B45309]' }}">
                                    Wawancara: {{ $siswa->pendaftaran->tes->status_wawancara === 'sudah' ? 'Sudah' : 'Belum' }}
                                </span>
                                @if($siswa->pendaftaran->tes->status_kelulusan)
                                <span class="px-2 py-1 text-xs rounded font-medium 
                                    {{ $siswa->pendaftaran->tes->status_kelulusan === 'Lulus' ? 'bg-[#4276A3]/10 text-[#4276A3]' : 'bg-[#991B1B]/10 text-[#991B1B]' }}">
                                    {{ $siswa->pendaftaran->tes->status_kelulusan }}
                                </span>
                                @endif
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

                {{-- Data Orang Tua / Wali --}}
                <div class="card p-4">
                    <h3 class="font-semibold text-sm text-slate-800 mb-4 flex items-center gap-2 pb-2 border-b border-slate-100">
                        <svg class="w-4 h-4 text-[#4276A3]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                        Data Orang Tua / Wali
                    </h3>
                    
                    {{-- Pilihan Jenis --}}
                    <div class="mb-4">
                        <label class="block text-xs font-medium text-slate-600 mb-2">Pilih Jenis <span class="text-[#991B1B]">*</span></label>
                        <div class="flex gap-4">
                            <label class="flex items-center cursor-pointer">
                                <input type="radio" name="jenis" value="orang_tua" 
                                    {{ old('jenis', $siswa->orangTua?->jenis ?? 'orang_tua') === 'orang_tua' ? 'checked' : '' }}
                                    class="jenis-radio w-4 h-4 text-[#4276A3] border-slate-300 focus:ring-[#4276A3]"
                                    onchange="toggleJenis()">
                                <span class="ml-2 text-sm text-slate-700">Orang Tua</span>
                            </label>
                            <label class="flex items-center cursor-pointer">
                                <input type="radio" name="jenis" value="wali" 
                                    {{ old('jenis', $siswa->orangTua?->jenis) === 'wali' ? 'checked' : '' }}
                                    class="jenis-radio w-4 h-4 text-[#4276A3] border-slate-300 focus:ring-[#4276A3]"
                                    onchange="toggleJenis()">
                                <span class="ml-2 text-sm text-slate-700">Wali</span>
                            </label>
                        </div>
                    </div>

                    {{-- Form Orang Tua --}}
                    <div id="form-orang-tua" class="space-y-3">
                        <div class="grid grid-cols-2 gap-3">
                            {{-- Nama Ayah --}}
                            <div>
                                <label class="block text-xs font-medium text-slate-600 mb-1">Nama Ayah <span class="text-[#991B1B]">*</span></label>
                                <input type="text" id="nama_ayah" name="nama_ayah" 
                                       value="{{ old('nama_ayah', $siswa->orangTua?->nama_ayah) }}"
                                       class="w-full px-3 py-2 text-sm border border-slate-300 rounded-md focus:outline-none focus:border-[#4276A3] focus:ring-1 focus:ring-[#4276A3]">
                            </div>
                            {{-- NIK Ayah --}}
                            <div>
                                <label class="block text-xs font-medium text-slate-600 mb-1">NIK Ayah <span class="text-[#991B1B]">*</span></label>
                                <input type="text" id="nik_ayah" name="nik_ayah" maxlength="16"
                                       value="{{ old('nik_ayah', $siswa->orangTua?->nik_ayah) }}"
                                       placeholder="16 digit NIK"
                                       class="w-full px-3 py-2 text-sm border border-slate-300 rounded-md focus:outline-none focus:border-[#4276A3] focus:ring-1 focus:ring-[#4276A3]">
                            </div>
                        </div>

                        {{-- Status Ayah --}}
                        <div>
                            <label class="block text-xs font-medium text-slate-600 mb-1">Status Ayah <span class="text-[#991B1B]">*</span></label>
                            <div class="flex gap-4 mt-1">
                                <label class="flex items-center cursor-pointer">
                                    <input type="radio" name="status_ayah" value="hidup" 
                                        {{ old('status_ayah', $siswa->orangTua?->status_ayah ?? 'hidup') === 'hidup' ? 'checked' : '' }}
                                        class="w-4 h-4 text-[#4276A3] border-slate-300 focus:ring-[#4276A3]">
                                    <span class="ml-2 text-sm text-slate-700">Masih Hidup</span>
                                </label>
                                <label class="flex items-center cursor-pointer">
                                    <input type="radio" name="status_ayah" value="meninggal" 
                                        {{ old('status_ayah', $siswa->orangTua?->status_ayah) === 'meninggal' ? 'checked' : '' }}
                                        class="w-4 h-4 text-[#4276A3] border-slate-300 focus:ring-[#4276A3]">
                                    <span class="ml-2 text-sm text-slate-700">Meninggal</span>
                                </label>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-3">
                            {{-- Nama Ibu --}}
                            <div>
                                <label class="block text-xs font-medium text-slate-600 mb-1">Nama Ibu <span class="text-[#991B1B]">*</span></label>
                                <input type="text" id="nama_ibu" name="nama_ibu" 
                                       value="{{ old('nama_ibu', $siswa->orangTua?->nama_ibu) }}"
                                       class="w-full px-3 py-2 text-sm border border-slate-300 rounded-md focus:outline-none focus:border-[#4276A3] focus:ring-1 focus:ring-[#4276A3]">
                            </div>
                            {{-- NIK Ibu --}}
                            <div>
                                <label class="block text-xs font-medium text-slate-600 mb-1">NIK Ibu <span class="text-[#991B1B]">*</span></label>
                                <input type="text" id="nik_ibu" name="nik_ibu" maxlength="16"
                                       value="{{ old('nik_ibu', $siswa->orangTua?->nik_ibu) }}"
                                       placeholder="16 digit NIK"
                                       class="w-full px-3 py-2 text-sm border border-slate-300 rounded-md focus:outline-none focus:border-[#4276A3] focus:ring-1 focus:ring-[#4276A3]">
                            </div>
                        </div>

                        {{-- Status Ibu --}}
                        <div>
                            <label class="block text-xs font-medium text-slate-600 mb-1">Status Ibu <span class="text-[#991B1B]">*</span></label>
                            <div class="flex gap-4 mt-1">
                                <label class="flex items-center cursor-pointer">
                                    <input type="radio" name="status_ibu" value="hidup" 
                                        {{ old('status_ibu', $siswa->orangTua?->status_ibu ?? 'hidup') === 'hidup' ? 'checked' : '' }}
                                        class="w-4 h-4 text-[#4276A3] border-slate-300 focus:ring-[#4276A3]">
                                    <span class="ml-2 text-sm text-slate-700">Masih Hidup</span>
                                </label>
                                <label class="flex items-center cursor-pointer">
                                    <input type="radio" name="status_ibu" value="meninggal" 
                                        {{ old('status_ibu', $siswa->orangTua?->status_ibu) === 'meninggal' ? 'checked' : '' }}
                                        class="w-4 h-4 text-[#4276A3] border-slate-300 focus:ring-[#4276A3]">
                                    <span class="ml-2 text-sm text-slate-700">Meninggal</span>
                                </label>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-3">
                            {{-- Pekerjaan Ayah --}}
                            <div>
                                <label class="block text-xs font-medium text-slate-600 mb-1">Pekerjaan Ayah <span class="text-[#991B1B]">*</span></label>
                                <input type="text" id="pekerjaan_ayah" name="pekerjaan_ayah" 
                                       value="{{ old('pekerjaan_ayah', $siswa->orangTua?->pekerjaan_ayah) }}"
                                       placeholder="Contoh: Wiraswasta"
                                       class="w-full px-3 py-2 text-sm border border-slate-300 rounded-md focus:outline-none focus:border-[#4276A3] focus:ring-1 focus:ring-[#4276A3]">
                            </div>
                            {{-- Pekerjaan Ibu --}}
                            <div>
                                <label class="block text-xs font-medium text-slate-600 mb-1">Pekerjaan Ibu <span class="text-[#991B1B]">*</span></label>
                                <input type="text" id="pekerjaan_ibu" name="pekerjaan_ibu" 
                                       value="{{ old('pekerjaan_ibu', $siswa->orangTua?->pekerjaan_ibu) }}"
                                       placeholder="Contoh: Ibu Rumah Tangga"
                                       class="w-full px-3 py-2 text-sm border border-slate-300 rounded-md focus:outline-none focus:border-[#4276A3] focus:ring-1 focus:ring-[#4276A3]">
                            </div>
                        </div>

                        <div>
                            {{-- No WA Ortu --}}
                            <label class="block text-xs font-medium text-slate-600 mb-1">No. WA Ortu <span class="text-[#991B1B]">*</span></label>
                            <input type="text" id="no_wa_ortu" name="no_wa_ortu" 
                                   value="{{ old('no_wa_ortu', $siswa->orangTua?->no_wa_ortu) }}"
                                   placeholder="081234567890"
                                   class="w-full px-3 py-2 text-sm border border-slate-300 rounded-md focus:outline-none focus:border-[#4276A3] focus:ring-1 focus:ring-[#4276A3]">
                        </div>
                    </div>

                    {{-- Form Wali (Hidden by default) --}}
                    <div id="form-wali" class="hidden space-y-3">
                        <div class="grid grid-cols-2 gap-3">
                            {{-- Nama Wali --}}
                            <div>
                                <label class="block text-xs font-medium text-slate-600 mb-1">Nama Wali <span class="text-[#991B1B]">*</span></label>
                                <input type="text" id="nama_wali" name="nama_wali" 
                                       value="{{ old('nama_wali', $siswa->orangTua?->nama_wali) }}"
                                       class="w-full px-3 py-2 text-sm border border-slate-300 rounded-md focus:outline-none focus:border-[#4276A3] focus:ring-1 focus:ring-[#4276A3]">
                            </div>
                            {{-- Pekerjaan Wali --}}
                            <div>
                                <label class="block text-xs font-medium text-slate-600 mb-1">Pekerjaan Wali <span class="text-[#991B1B]">*</span></label>
                                <input type="text" id="pekerjaan_wali" name="pekerjaan_wali" 
                                       value="{{ old('pekerjaan_wali', $siswa->orangTua?->pekerjaan_wali) }}"
                                       placeholder="Contoh: PNS"
                                       class="w-full px-3 py-2 text-sm border border-slate-300 rounded-md focus:outline-none focus:border-[#4276A3] focus:ring-1 focus:ring-[#4276A3]">
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-3">
                            {{-- No HP Wali --}}
                            <div>
                                <label class="block text-xs font-medium text-slate-600 mb-1">No. HP Wali <span class="text-[#991B1B]">*</span></label>
                                <input type="text" id="no_hp_wali" name="no_hp_wali" 
                                       value="{{ old('no_hp_wali', $siswa->orangTua?->no_hp_wali) }}"
                                       placeholder="081234567890"
                                       class="w-full px-3 py-2 text-sm border border-slate-300 rounded-md focus:outline-none focus:border-[#4276A3] focus:ring-1 focus:ring-[#4276A3]">
                            </div>
                            {{-- Hubungan Wali --}}
                            <div>
                                <label class="block text-xs font-medium text-slate-600 mb-1">Hubungan <span class="text-[#991B1B]">*</span></label>
                                <input type="text" id="hubungan_wali" name="hubungan_wali" 
                                       value="{{ old('hubungan_wali', $siswa->orangTua?->hubungan_wali) }}"
                                       placeholder="Contoh: Paman, Bibi"
                                       class="w-full px-3 py-2 text-sm border border-slate-300 rounded-md focus:outline-none focus:border-[#4276A3] focus:ring-1 focus:ring-[#4276A3]">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Berkas Siswa --}}
            <div class="card p-4">
                <h3 class="font-semibold text-sm text-slate-800 mb-4 flex items-center gap-2 pb-2 border-b border-slate-100">
                    <svg class="w-4 h-4 text-[#4276A3]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    Berkas Pendaftaran
                </h3>
                
                @php
                    $berkasList = \App\Models\BerkasPendaftaran::getJenisBerkas();
                    $berkasUploaded = $siswa->berkasPendaftaran()->get()->keyBy('jenis_berkas');
                @endphp

                <div class="space-y-3">
                    @foreach($berkasList as $key => $label)
                        @php
                            $berkas = $berkasUploaded->get($key);
                            $hasFile = $berkas && $berkas->path_file && \Illuminate\Support\Facades\Storage::exists($berkas->path_file);
                        @endphp
                        <div class="p-3 border rounded-lg {{ $hasFile ? 'border-[#4276A3]/20 bg-blue-50' : 'border-slate-200 bg-slate-50' }}">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-xs font-medium {{ $hasFile ? 'text-blue-800' : 'text-slate-600' }}">{{ $label }}</span>
                                @if($hasFile)
                                    <span class="text-xs text-[#4276A3] flex items-center gap-1">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                        </svg>
                                        Sudah Upload
                                    </span>
                                @else
                                    <span class="text-xs text-gray-400">Belum Upload</span>
                                @endif
                            </div>
                            
                            @if($hasFile)
                                <div class="flex gap-2">
                                    <a href="{{ route('admin.berkas.download', $berkas->id) }}" 
                                       class="btn btn-sm btn-info w-full">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                                        </svg>
                                        Download
                                    </a>
                                </div>
                            @else
                                <p class="text-xs text-gray-400 italic">Tidak ada file</p>
                            @endif
                        </div>
                    @endforeach
                </div>

                {{-- Progress --}}
                @php
                    $progress = \App\Models\BerkasPendaftaran::getUploadProgress($siswa->id);
                @endphp
                <div class="mt-4 pt-4 border-t border-slate-100">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-xs font-medium text-slate-600">Progress Berkas</span>
                        <span class="text-xs font-semibold {{ $progress['is_complete'] ? 'text-[#4276A3]' : 'text-slate-600' }}">{{ $progress['uploaded'] }}/{{ $progress['total'] }}</span>
                    </div>
                    <div class="w-full bg-slate-200 rounded-full h-2">
                        <div class="bg-primary h-2 rounded-full transition-all" style="width: {{ $progress['percentage'] }}%"></div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Action Buttons --}}
        <div class="mt-6 flex justify-end gap-2 pt-4 border-t border-slate-200">
            <a href="{{ route('admin.pendaftar.index') }}" 
               class="btn btn-secondary">
                Batal
            </a>
            <button type="submit" class="btn btn-primary shadow-md hover:shadow-lg">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                Simpan Perubahan
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

// Initialize on page load
document.addEventListener('DOMContentLoaded', toggleJenis);
</script>
@endsection
