@extends('layouts.admin')

@section('title', 'Edit Data Siswa - Admin Panel')

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
        <h1 class="text-xl font-bold text-gray-900">Edit Data Calon Siswa</h1>
        <div class="flex items-center gap-2 mt-1">
            <span class="text-sm text-gray-600">{{ $siswa->nama }}</span>
            <span class="px-2 py-0.5 bg-gray-100 text-gray-600 rounded text-xs font-mono">{{ $siswa->nisn }}</span>
        </div>
    </div>

    {{-- Alerts --}}
    @if(session('error'))
    <div class="mb-4 p-3 bg-red-50 border border-red-200 text-red-700 rounded-lg text-sm">
        {{ session('error') }}
    </div>
    @endif

    @if(session('success'))
    <div class="mb-4 p-3 bg-green-50 border border-green-200 text-green-700 rounded-lg text-sm">
        {{ session('success') }}
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

    <form action="{{ route('admin.pendaftar.update', $siswa->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
            {{-- Data Siswa --}}
            <div class="card p-4">
                <h3 class="font-semibold text-sm text-gray-800 mb-4 flex items-center gap-2 pb-2 border-b border-gray-100">
                    <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    Data Siswa
                </h3>
                <div class="space-y-3">
                    {{-- NISN (Read Only) --}}
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1">NISN</label>
                        <input type="text" value="{{ $siswa->nisn }}" disabled 
                               class="w-full px-3 py-2 text-sm border border-gray-200 rounded-md bg-gray-50 text-gray-500 font-mono">
                    </div>

                    {{-- Nama --}}
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1">
                            Nama Lengkap <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="nama" value="{{ old('nama', $siswa->nama) }}" required 
                               class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary">
                    </div>

                    {{-- Jenis Kelamin --}}
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1">Jenis Kelamin</label>
                        <select name="jk" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary bg-white">
                            <option value="">-- Pilih --</option>
                            <option value="L" {{ old('jk', $siswa->jk) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="P" {{ old('jk', $siswa->jk) == 'P' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>

                    {{-- Tanggal Lahir --}}
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1">Tanggal Lahir</label>
                        <input type="date" name="tgl_lahir" value="{{ old('tgl_lahir', $siswa->tgl_lahir?->format('Y-m-d')) }}" 
                               class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary">
                    </div>

                    {{-- No WA --}}
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1">No. WhatsApp</label>
                        <input type="text" name="no_wa" value="{{ old('no_wa', $siswa->no_wa) }}" 
                               placeholder="081234567890"
                               class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary">
                    </div>

                    {{-- Asal Sekolah --}}
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1">Asal Sekolah</label>
                        <input type="text" name="asal_sekolah" value="{{ old('asal_sekolah', $siswa->asal_sekolah) }}" 
                               placeholder="Nama SMP/MTs"
                               class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary">
                    </div>

                    {{-- Alamat --}}
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1">Alamat</label>
                        <textarea name="alamat" rows="3" placeholder="Alamat lengkap..."
                                  class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary">{{ old('alamat', $siswa->alamat) }}</textarea>
                    </div>
                </div>
            </div>

            {{-- Data Pendaftaran & Orang Tua --}}
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
                                <option value="{{ $j->id }}" {{ old('jurusan_id', $siswa->pendaftaran?->jurusan_id) == $j->id ? 'selected' : '' }}>
                                    {{ $j->nama }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-600 mb-1">Gelombang</label>
                            <input type="text" name="gelombang" value="{{ old('gelombang', $siswa->pendaftaran?->gelombang) }}" 
                                   placeholder="Gelombang 1"
                                   class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary">
                        </div>
                    </div>
                </div>

                {{-- Data Orang Tua --}}
                <div class="card p-4">
                    <h3 class="font-semibold text-sm text-gray-800 mb-4 flex items-center gap-2 pb-2 border-b border-gray-100">
                        <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                        Data Orang Tua
                    </h3>
                    <div class="space-y-3">
                        <div>
                            <label class="block text-xs font-medium text-gray-600 mb-1">Nama Ayah</label>
                            <input type="text" name="nama_ayah" value="{{ old('nama_ayah', $siswa->orangTua?->nama_ayah) }}" 
                                   class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary">
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-600 mb-1">Nama Ibu</label>
                            <input type="text" name="nama_ibu" value="{{ old('nama_ibu', $siswa->orangTua?->nama_ibu) }}" 
                                   class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary">
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-600 mb-1">Pekerjaan</label>
                            <input type="text" name="pekerjaan" value="{{ old('pekerjaan', $siswa->orangTua?->pekerjaan) }}" 
                                   class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary">
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-600 mb-1">No. WA Ortu</label>
                            <input type="text" name="no_wa_ortu" value="{{ old('no_wa_ortu', $siswa->orangTua?->no_wa_ortu) }}" 
                                   placeholder="081234567890"
                                   class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary">
                        </div>
                    </div>
                </div>
            </div>

            {{-- Berkas Siswa --}}
            <div class="card p-4">
                <h3 class="font-semibold text-sm text-gray-800 mb-4 flex items-center gap-2 pb-2 border-b border-gray-100">
                    <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                        <div class="p-3 border rounded-lg {{ $hasFile ? 'border-green-200 bg-green-50' : 'border-gray-200 bg-gray-50' }}">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-xs font-medium {{ $hasFile ? 'text-green-800' : 'text-gray-600' }}">{{ $label }}</span>
                                @if($hasFile)
                                    <span class="text-xs text-green-600 flex items-center gap-1">
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
                                       class="flex-1 px-2 py-1.5 bg-white border border-green-300 text-green-700 text-xs rounded hover:bg-green-50 transition text-center flex items-center justify-center gap-1">
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
                <div class="mt-4 pt-4 border-t border-gray-100">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-xs font-medium text-gray-600">Progress Berkas</span>
                        <span class="text-xs font-semibold {{ $progress['is_complete'] ? 'text-green-600' : 'text-gray-600' }}">{{ $progress['uploaded'] }}/{{ $progress['total'] }}</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-primary h-2 rounded-full transition-all" style="width: {{ $progress['percentage'] }}%"></div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Action Buttons --}}
        <div class="mt-6 flex justify-end gap-2 pt-4 border-t border-gray-200">
            <a href="{{ route('admin.pendaftar.index') }}" 
               class="px-4 py-2 bg-gray-100 text-gray-700 text-sm font-medium rounded-md hover:bg-gray-200 transition">
                Batal
            </a>
            <button type="submit" class="px-4 py-2 bg-primary text-white text-sm font-medium rounded-md hover:bg-green-800 transition flex items-center gap-1.5">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                Simpan Perubahan
            </button>
        </div>
    </form>
@endsection
