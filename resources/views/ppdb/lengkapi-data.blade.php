@extends('layouts.app')

@section('title', 'Lengkapi Data - SMK Al-Hidayah Lestari')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <a href="{{ route('ppdb.dashboard') }}" class="inline-flex items-center text-sm text-gray-500 hover:text-primary mb-4">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Kembali ke Dashboard
            </a>
            <h1 class="text-2xl font-bold text-gray-900">Lengkapi Data Pendaftaran</h1>
            <p class="text-gray-600 mt-1">Silakan lengkapi seluruh data untuk melanjutkan proses pendaftaran.</p>
        </div>

        @if(session('error'))
        <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-700 rounded-xl">
            {{ session('error') }}
        </div>
        @endif

        <form action="{{ route('ppdb.lengkapi-data.store') }}" method="POST" class="space-y-6">
            @csrf
            
            <!-- Data Diri -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
                    <h2 class="font-semibold text-gray-900">Data Diri Siswa</h2>
                </div>
                <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- NISN (readonly) -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">NISN</label>
                        <input type="text" value="{{ $siswa->nisn }}" readonly
                            class="w-full px-4 py-3 border border-gray-200 rounded-xl bg-gray-50 text-gray-500">
                    </div>

                    <!-- Nama Lengkap -->
                    <div>
                        <label for="nama" class="block text-sm font-medium text-gray-700 mb-2">
                            Nama Lengkap <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="nama" name="nama" value="{{ old('nama', $siswa->nama) }}" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition @error('nama') border-red-500 @enderror">
                        @error('nama')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Jenis Kelamin -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Jenis Kelamin <span class="text-red-500">*</span>
                        </label>
                        <div class="flex gap-4">
                            <label class="flex items-center">
                                <input type="radio" name="jk" value="L" {{ old('jk', $siswa->jk) === 'L' ? 'checked' : '' }}
                                    class="w-4 h-4 text-primary border-gray-300 focus:ring-primary">
                                <span class="ml-2 text-gray-700">Laki-laki</span>
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="jk" value="P" {{ old('jk', $siswa->jk) === 'P' ? 'checked' : '' }}
                                    class="w-4 h-4 text-primary border-gray-300 focus:ring-primary">
                                <span class="ml-2 text-gray-700">Perempuan</span>
                            </label>
                        </div>
                        @error('jk')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tanggal Lahir -->
                    <div>
                        <label for="tgl_lahir" class="block text-sm font-medium text-gray-700 mb-2">
                            Tanggal Lahir <span class="text-red-500">*</span>
                        </label>
                        <input type="date" id="tgl_lahir" name="tgl_lahir" 
                            value="{{ old('tgl_lahir', $siswa->tgl_lahir?->format('Y-m-d')) }}" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition @error('tgl_lahir') border-red-500 @enderror">
                        @error('tgl_lahir')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Asal Sekolah -->
                    <div>
                        <label for="asal_sekolah" class="block text-sm font-medium text-gray-700 mb-2">
                            Asal Sekolah (SMP/MTs) <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="asal_sekolah" name="asal_sekolah" 
                            value="{{ old('asal_sekolah', $siswa->asal_sekolah) }}" required
                            placeholder="Contoh: SMPN 1 Jakarta"
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition @error('asal_sekolah') border-red-500 @enderror">
                        @error('asal_sekolah')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- No WhatsApp (readonly) -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">No. WhatsApp</label>
                        <input type="text" value="{{ $siswa->no_wa }}" readonly
                            class="w-full px-4 py-3 border border-gray-200 rounded-xl bg-gray-50 text-gray-500">
                    </div>

                    <!-- Alamat -->
                    <div class="md:col-span-2">
                        <label for="alamat" class="block text-sm font-medium text-gray-700 mb-2">
                            Alamat Lengkap <span class="text-red-500">*</span>
                        </label>
                        <textarea id="alamat" name="alamat" rows="3" required
                            placeholder="Masukkan alamat lengkap (RT/RW, Kelurahan, Kecamatan, Kota)"
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition @error('alamat') border-red-500 @enderror">{{ old('alamat', $siswa->alamat) }}</textarea>
                        @error('alamat')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Data Orang Tua -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
                    <h2 class="font-semibold text-gray-900">Data Orang Tua/Wali</h2>
                </div>
                <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Nama Ayah -->
                    <div>
                        <label for="nama_ayah" class="block text-sm font-medium text-gray-700 mb-2">
                            Nama Ayah <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="nama_ayah" name="nama_ayah" 
                            value="{{ old('nama_ayah', $siswa->orangTua?->nama_ayah) }}" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition @error('nama_ayah') border-red-500 @enderror">
                        @error('nama_ayah')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Nama Ibu -->
                    <div>
                        <label for="nama_ibu" class="block text-sm font-medium text-gray-700 mb-2">
                            Nama Ibu <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="nama_ibu" name="nama_ibu" 
                            value="{{ old('nama_ibu', $siswa->orangTua?->nama_ibu) }}" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition @error('nama_ibu') border-red-500 @enderror">
                        @error('nama_ibu')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Pekerjaan -->
                    <div>
                        <label for="pekerjaan" class="block text-sm font-medium text-gray-700 mb-2">
                            Pekerjaan Orang Tua <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="pekerjaan" name="pekerjaan" 
                            value="{{ old('pekerjaan', $siswa->orangTua?->pekerjaan) }}" required
                            placeholder="Contoh: Wiraswasta, PNS, Petani"
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition @error('pekerjaan') border-red-500 @enderror">
                        @error('pekerjaan')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- No WA Ortu -->
                    <div>
                        <label for="no_wa_ortu" class="block text-sm font-medium text-gray-700 mb-2">
                            No. WhatsApp Orang Tua <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="no_wa_ortu" name="no_wa_ortu" 
                            value="{{ old('no_wa_ortu', $siswa->orangTua?->no_wa_ortu) }}" required
                            placeholder="Contoh: 6281234567890"
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition @error('no_wa_ortu') border-red-500 @enderror">
                        @error('no_wa_ortu')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Pilihan Jurusan -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
                    <h2 class="font-semibold text-gray-900">Pilihan Pendaftaran</h2>
                </div>
                <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Jurusan -->
                    <div>
                        <label for="jurusan_id" class="block text-sm font-medium text-gray-700 mb-2">
                            Pilihan Jurusan <span class="text-red-500">*</span>
                        </label>
                        <select id="jurusan_id" name="jurusan_id" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition @error('jurusan_id') border-red-500 @enderror">
                            <option value="">-- Pilih Jurusan --</option>
                            @foreach($jurusan as $j)
                            <option value="{{ $j->id }}" {{ old('jurusan_id', $siswa->pendaftaran?->jurusan_id) == $j->id ? 'selected' : '' }}>
                                {{ $j->nama }}
                            </option>
                            @endforeach
                        </select>
                        @error('jurusan_id')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Gelombang -->
                    <div>
                        <label for="gelombang" class="block text-sm font-medium text-gray-700 mb-2">
                            Gelombang Pendaftaran <span class="text-red-500">*</span>
                        </label>
                        <select id="gelombang" name="gelombang" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition @error('gelombang') border-red-500 @enderror">
                            <option value="Gelombang 1" {{ old('gelombang', $siswa->pendaftaran?->gelombang) === 'Gelombang 1' ? 'selected' : '' }}>
                                Gelombang 1
                            </option>
                            <option value="Gelombang 2" {{ old('gelombang', $siswa->pendaftaran?->gelombang) === 'Gelombang 2' ? 'selected' : '' }}>
                                Gelombang 2
                            </option>
                        </select>
                        @error('gelombang')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end gap-4">
                <a href="{{ route('ppdb.dashboard') }}" 
                    class="px-6 py-3 border border-gray-300 text-gray-700 rounded-xl font-semibold hover:bg-gray-50 transition">
                    Batal
                </a>
                <button type="submit" 
                    class="px-6 py-3 bg-primary text-white rounded-xl font-semibold hover:bg-primary/90 transition shadow-lg shadow-primary/25">
                    Simpan Data
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
