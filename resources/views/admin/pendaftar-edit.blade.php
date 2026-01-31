@extends('layouts.admin')

@section('title', 'Edit Data Siswa - Admin Panel')

@section('content')
    {{-- Breadcrumb --}}
    <div class="mb-6">
        <a href="{{ route('admin.pendaftar.index') }}" class="inline-flex items-center gap-2 text-gray-600 hover:text-primary font-semibold text-lg">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Kembali ke Daftar Pendaftar
        </a>
    </div>

    {{-- Header --}}
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-2">Edit Data Calon Siswa</h1>
        <div class="flex items-center gap-3">
            <span class="text-xl text-gray-600 font-semibold">{{ $siswa->nama }}</span>
            <span class="px-3 py-1 bg-gray-200 text-gray-700 rounded-lg font-mono text-base">{{ $siswa->nisn }}</span>
        </div>
    </div>

    {{-- Error Alert --}}
    @if(session('error'))
    <div class="mb-6 p-5 bg-red-50 border-2 border-red-300 text-red-800 rounded-xl text-lg">
        {{ session('error') }}
    </div>
    @endif

    @if($errors->any())
    <div class="mb-6 p-5 bg-red-50 border-2 border-red-300 text-red-800 rounded-xl">
        <p class="font-bold mb-2">Terdapat kesalahan:</p>
        <ul class="list-disc list-inside">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('admin.pendaftar.update', $siswa->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            {{-- Data Siswa --}}
            <div class="bg-white rounded-xl card-solid p-6">
                <h3 class="font-bold text-xl text-gray-900 mb-6 border-b-2 border-gray-200 pb-3 flex items-center gap-2">
                    <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    Data Siswa
                </h3>
                <div class="space-y-5">
                    {{-- NISN (Read Only) --}}
                    <div>
                        <label class="block text-base font-bold text-gray-700 mb-2">NISN</label>
                        <input type="text" value="{{ $siswa->nisn }}" disabled 
                               class="w-full px-4 input-large border-2 border-gray-300 rounded-xl bg-gray-100 text-gray-600 font-mono">
                        <p class="text-sm text-gray-500 mt-1">NISN tidak dapat diubah</p>
                    </div>

                    {{-- Nama --}}
                    <div>
                        <label class="block text-base font-bold text-gray-700 mb-2">
                            Nama Lengkap <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="nama" value="{{ old('nama', $siswa->nama) }}" required 
                               class="w-full px-4 input-large border-2 border-gray-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary">
                    </div>

                    {{-- Jenis Kelamin --}}
                    <div>
                        <label class="block text-base font-bold text-gray-700 mb-2">Jenis Kelamin</label>
                        <select name="jk" class="w-full px-4 input-large border-2 border-gray-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary bg-white">
                            <option value="">-- Pilih Jenis Kelamin --</option>
                            <option value="L" {{ old('jk', $siswa->jk) == 'L' ? 'selected' : '' }}>👦 Laki-laki</option>
                            <option value="P" {{ old('jk', $siswa->jk) == 'P' ? 'selected' : '' }}>👧 Perempuan</option>
                        </select>
                    </div>

                    {{-- Tanggal Lahir --}}
                    <div>
                        <label class="block text-base font-bold text-gray-700 mb-2">Tanggal Lahir</label>
                        <input type="date" name="tgl_lahir" value="{{ old('tgl_lahir', $siswa->tgl_lahir?->format('Y-m-d')) }}" 
                               class="w-full px-4 input-large border-2 border-gray-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary">
                    </div>

                    {{-- No WA --}}
                    <div>
                        <label class="block text-base font-bold text-gray-700 mb-2">Nomor WhatsApp</label>
                        <input type="text" name="no_wa" value="{{ old('no_wa', $siswa->no_wa) }}" 
                               placeholder="Contoh: 081234567890"
                               class="w-full px-4 input-large border-2 border-gray-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary">
                    </div>

                    {{-- Asal Sekolah --}}
                    <div>
                        <label class="block text-base font-bold text-gray-700 mb-2">Asal Sekolah</label>
                        <input type="text" name="asal_sekolah" value="{{ old('asal_sekolah', $siswa->asal_sekolah) }}" 
                               placeholder="Nama SMP/MTs"
                               class="w-full px-4 input-large border-2 border-gray-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary">
                    </div>

                    {{-- Alamat --}}
                    <div>
                        <label class="block text-base font-bold text-gray-700 mb-2">Alamat Lengkap</label>
                        <textarea name="alamat" rows="4" placeholder="Masukkan alamat lengkap..."
                                  class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary text-lg">{{ old('alamat', $siswa->alamat) }}</textarea>
                    </div>
                </div>
            </div>

            {{-- Data Pendaftaran & Orang Tua --}}
            <div class="space-y-8">
                {{-- Data Pendaftaran --}}
                <div class="bg-white rounded-xl card-solid p-6">
                    <h3 class="font-bold text-xl text-gray-900 mb-6 border-b-2 border-gray-200 pb-3 flex items-center gap-2">
                        <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        Data Pendaftaran
                    </h3>
                    <div class="space-y-5">
                        <div>
                            <label class="block text-base font-bold text-gray-700 mb-2">Jurusan Pilihan</label>
                            <select name="jurusan_id" class="w-full px-4 input-large border-2 border-gray-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary bg-white">
                                <option value="">-- Pilih Jurusan --</option>
                                @foreach($jurusan as $j)
                                <option value="{{ $j->id }}" {{ old('jurusan_id', $siswa->pendaftaran?->jurusan_id) == $j->id ? 'selected' : '' }}>
                                    {{ $j->nama }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-base font-bold text-gray-700 mb-2">Gelombang Pendaftaran</label>
                            <input type="text" name="gelombang" value="{{ old('gelombang', $siswa->pendaftaran?->gelombang) }}" 
                                   placeholder="Contoh: Gelombang 1"
                                   class="w-full px-4 input-large border-2 border-gray-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary">
                        </div>
                    </div>
                </div>

                {{-- Data Orang Tua --}}
                <div class="bg-white rounded-xl card-solid p-6">
                    <h3 class="font-bold text-xl text-gray-900 mb-6 border-b-2 border-gray-200 pb-3 flex items-center gap-2">
                        <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                        Data Orang Tua / Wali
                    </h3>
                    <div class="space-y-5">
                        <div>
                            <label class="block text-base font-bold text-gray-700 mb-2">Nama Ayah</label>
                            <input type="text" name="nama_ayah" value="{{ old('nama_ayah', $siswa->orangTua?->nama_ayah) }}" 
                                   class="w-full px-4 input-large border-2 border-gray-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary">
                        </div>
                        <div>
                            <label class="block text-base font-bold text-gray-700 mb-2">Nama Ibu</label>
                            <input type="text" name="nama_ibu" value="{{ old('nama_ibu', $siswa->orangTua?->nama_ibu) }}" 
                                   class="w-full px-4 input-large border-2 border-gray-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary">
                        </div>
                        <div>
                            <label class="block text-base font-bold text-gray-700 mb-2">Pekerjaan Orang Tua</label>
                            <input type="text" name="pekerjaan" value="{{ old('pekerjaan', $siswa->orangTua?->pekerjaan) }}" 
                                   class="w-full px-4 input-large border-2 border-gray-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary">
                        </div>
                        <div>
                            <label class="block text-base font-bold text-gray-700 mb-2">Nomor WhatsApp Orang Tua</label>
                            <input type="text" name="no_wa_ortu" value="{{ old('no_wa_ortu', $siswa->orangTua?->no_wa_ortu) }}" 
                                   placeholder="Contoh: 081234567890"
                                   class="w-full px-4 input-large border-2 border-gray-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Action Buttons --}}
        <div class="mt-10 flex flex-col sm:flex-row justify-end gap-4 pt-6 border-t-2 border-gray-200">
            <a href="{{ route('admin.pendaftar.index') }}" 
               class="btn-large bg-gray-200 text-gray-700 hover:bg-gray-300 text-center flex items-center justify-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
                Batal / Kembali
            </a>
            <button type="submit" 
                    class="btn-large bg-primary text-white hover:bg-green-800 flex items-center justify-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                Simpan Perubahan
            </button>
        </div>
    </form>
@endsection
