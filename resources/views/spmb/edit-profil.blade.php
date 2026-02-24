@extends('layouts.app')

@section('title', 'Edit Profil - SMK Al-Hidayah Lestari')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8 text-center sm:text-left">
            <h1 class="text-2xl sm:text-3xl font-bold text-gray-900">Edit Profil</h1>
            <p class="text-gray-600 mt-2">Perbarui data pribadi dan informasi keluarga Anda</p>
        </div>

        @if(session('error'))
        <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl flex items-start gap-3">
            <svg class="w-5 h-5 text-red-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <p class="text-red-700 text-sm">{{ session('error') }}</p>
        </div>
        @endif

        @if(session('info'))
        <div class="mb-6 p-4 bg-blue-50 border border-blue-200 rounded-xl flex items-start gap-3">
            <svg class="w-5 h-5 text-blue-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <p class="text-blue-700 text-sm">{{ session('info') }}</p>
        </div>
        @endif

        @if($errors->any())
        <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl">
            <div class="flex items-start gap-3">
                <svg class="w-5 h-5 text-red-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <div>
                    <h3 class="font-semibold text-red-700 mb-2">Terjadi kesalahan:</h3>
                    <ul class="text-red-700 text-sm space-y-1">
                        @foreach($errors->all() as $error)
                            <li class="flex items-center gap-2">
                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"/></svg>
                                {{ $error }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        @endif

        <form action="{{ route('spmb.profil.update') }}" method="POST" class="space-y-6" novalidate>
            @csrf
            @method('PUT')
            <input type="hidden" name="jenis" value="{{ $jenis }}">
            
            <!-- Info Pendaftaran (Readonly) -->
            <div class="bg-gradient-to-r from-gray-50 to-slate-50 rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="font-bold text-gray-900 flex items-center gap-2">
                        <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        Info Pendaftaran
                    </h2>
                </div>
                <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- No Pendaftaran -->
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-gray-700">Nomor Pendaftaran</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"/>
                                </svg>
                            </div>
                            <input type="text" value="SPMB-{{ $calonSiswa->pendaftaran->id ?? $calonSiswa->id }}/{{ date('Y') }}" readonly
                                class="w-full pl-12 pr-4 py-3.5 border-2 border-gray-200 rounded-xl bg-gray-100 text-gray-500 cursor-not-allowed">
                        </div>
                    </div>

                    <!-- Gelombang -->
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-gray-700">Gelombang</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <input type="text" value="{{ $calonSiswa->pendaftaran->gelombang ?? 'Gelombang 1' }}" readonly
                                class="w-full pl-12 pr-4 py-3.5 border-2 border-gray-200 rounded-xl bg-gray-100 text-gray-500 cursor-not-allowed">
                        </div>
                    </div>

                    <!-- Jurusan Pilihan 1 -->
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-gray-700">Jurusan Pilihan 1</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                </svg>
                            </div>
                            <input type="text" value="{{ $calonSiswa->pendaftaran->jurusan->nama ?? 'Belum memilih jurusan' }}" readonly
                                class="w-full pl-12 pr-4 py-3.5 border-2 border-gray-200 rounded-xl bg-gray-100 text-gray-500 cursor-not-allowed">
                        </div>
                    </div>

                    <!-- Jurusan Pilihan 2 -->
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-gray-700">Jurusan Pilihan 2 (Alternatif)</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                </svg>
                            </div>
                            <input type="text" value="{{ $calonSiswa->pendaftaran->jurusan2->nama ?? 'Belum memilih jurusan' }}" readonly
                                class="w-full pl-12 pr-4 py-3.5 border-2 border-gray-200 rounded-xl bg-gray-100 text-gray-500 cursor-not-allowed">
                        </div>
                    </div>

                    <!-- Info Ubah Jurusan -->
                    <div class="md:col-span-2">
                        <div class="flex items-start gap-2 text-xs text-amber-700 bg-amber-50 p-3 rounded-lg border border-amber-200">
                            <svg class="w-4 h-4 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span>Jika ingin mengubah jurusan, silakan hubungi admin melalui WhatsApp <a href="https://wa.me/628812489572" target="_blank" class="underline font-semibold hover:text-amber-800">08812489572</a></span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Data Identitas Siswa -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="px-6 py-5 border-b border-gray-200 bg-gradient-to-r from-amber-50 to-orange-50">
                    <h2 class="font-bold text-lg text-gray-900 flex items-center gap-3">
                        <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0"/>
                        </svg>
                        Data Identitas Siswa
                    </h2>
                    <p class="text-sm text-gray-600 mt-1">Informasi identitas dan data pribadi</p>
                </div>
                <div class="p-6 space-y-6">
                    <!-- Baris 1: NISN dan Nama -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- NISN (readonly) -->
                        <div class="space-y-2">
                            <label class="block text-sm font-semibold text-gray-700">NISN</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0"/>
                                    </svg>
                                </div>
                                <input type="text" value="{{ $calonSiswa->nisn }}" readonly
                                    class="w-full pl-12 pr-4 py-3.5 border-2 border-gray-200 rounded-xl bg-gray-100 text-gray-500 cursor-not-allowed">
                            </div>
                            <p class="text-xs text-gray-500">NISN tidak dapat diubah</p>
                        </div>

                        <!-- Nama Lengkap -->
                        <div class="space-y-2">
                            <label for="nama" class="block text-sm font-semibold text-gray-700">
                                Nama Lengkap <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                </div>
                                <input type="text" id="nama" name="nama" 
                                    value="{{ old('nama', $calonSiswa->nama) }}" required
                                    minlength="3" maxlength="50"
                                    pattern="^[a-zA-Z\s'\-]+$"
                                    title="Nama hanya boleh berisi huruf, spasi, petik, dan tanda hubung"
                                    oninput="this.value = this.value.replace(/[^a-zA-Z\s'\-]/g, '')"
                                    class="w-full pl-12 pr-4 py-3.5 bg-gray-50 border-2 border-gray-200 rounded-xl focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 transition @error('nama') border-red-500 @enderror">
                            </div>
                            @error('nama')
                            <p class="text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Baris 2: NIK dan No KK -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- NIK -->
                        <div class="space-y-2">
                            <label for="nik" class="block text-sm font-semibold text-gray-700">
                                NIK <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"/>
                                    </svg>
                                </div>
                                <input type="text" id="nik" name="nik" maxlength="16" 
                                    value="{{ old('nik', $calonSiswa->nik) }}" required
                                    placeholder="16 digit NIK"
                                    pattern="[0-9]{16}"
                                    title="NIK harus 16 digit angka"
                                    oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                    class="w-full pl-12 pr-4 py-3.5 bg-gray-50 border-2 border-gray-200 rounded-xl focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 transition @error('nik') border-red-500 @enderror">
                            </div>
                            @error('nik')
                            <p class="text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- No KK -->
                        <div class="space-y-2">
                            <label for="no_kk" class="block text-sm font-semibold text-gray-700">
                                Nomor KK <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                                    </svg>
                                </div>
                                <input type="text" id="no_kk" name="no_kk" maxlength="16" 
                                    value="{{ old('no_kk', $calonSiswa->no_kk) }}" required
                                    placeholder="16 digit Nomor KK"
                                    pattern="[0-9]{16}"
                                    title="Nomor KK harus 16 digit angka"
                                    oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                    class="w-full pl-12 pr-4 py-3.5 bg-gray-50 border-2 border-gray-200 rounded-xl focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 transition @error('no_kk') border-red-500 @enderror">
                            </div>
                            @error('no_kk')
                            <p class="text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Baris 3: Jenis Kelamin -->
                    <div class="space-y-3">
                        <label class="block text-sm font-semibold text-gray-700">
                            Jenis Kelamin <span class="text-red-500">*</span>
                        </label>
                        <div class="flex flex-wrap gap-4">
                            <label class="flex items-center gap-3 cursor-pointer group bg-gray-50 px-5 py-3 rounded-xl border-2 border-gray-200 hover:border-primary/50 transition">
                                <input type="radio" name="jk" value="L" {{ old('jk', $calonSiswa->jk) === 'L' ? 'checked' : '' }} required
                                    class="w-5 h-5 text-primary border-gray-300 focus:ring-primary cursor-pointer">
                                <span class="text-gray-700 font-medium group-hover:text-gray-900 transition">Laki-laki</span>
                            </label>
                            <label class="flex items-center gap-3 cursor-pointer group bg-gray-50 px-5 py-3 rounded-xl border-2 border-gray-200 hover:border-primary/50 transition">
                                <input type="radio" name="jk" value="P" {{ old('jk', $calonSiswa->jk) === 'P' ? 'checked' : '' }} required
                                    class="w-5 h-5 text-primary border-gray-300 focus:ring-primary cursor-pointer">
                                <span class="text-gray-700 font-medium group-hover:text-gray-900 transition">Perempuan</span>
                            </label>
                        </div>
                        @error('jk')
                        <p class="text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Baris 4: TTL -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Tempat Lahir -->
                        <div class="space-y-2">
                            <label for="tempat_lahir" class="block text-sm font-semibold text-gray-700">
                                Tempat Lahir <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                </div>
                                <input type="text" id="tempat_lahir" name="tempat_lahir" 
                                    value="{{ old('tempat_lahir', $calonSiswa->tempat_lahir) }}" required
                                    placeholder="Kota/Kabupaten kelahiran"
                                    minlength="3" maxlength="50"
                                    pattern="^[a-zA-Z\s\-]+$"
                                    title="Tempat lahir hanya boleh berisi huruf, spasi, dan tanda hubung"
                                    oninput="this.value = this.value.replace(/[^a-zA-Z\s\-]/g, '')"
                                    class="w-full pl-12 pr-4 py-3.5 bg-gray-50 border-2 border-gray-200 rounded-xl focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 transition @error('tempat_lahir') border-red-500 @enderror">
                            </div>
                            @error('tempat_lahir')
                            <p class="text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Tanggal Lahir -->
                        <div class="space-y-2">
                            <label for="tgl_lahir" class="block text-sm font-semibold text-gray-700">
                                Tanggal Lahir <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                <input type="date" id="tgl_lahir" name="tgl_lahir" 
                                    value="{{ old('tgl_lahir', $calonSiswa->tgl_lahir?->format('Y-m-d')) }}" required
                                    class="w-full pl-12 pr-4 py-3.5 bg-gray-50 border-2 border-gray-200 rounded-xl focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 transition @error('tgl_lahir') border-red-500 @enderror">
                            </div>
                            @error('tgl_lahir')
                            <p class="text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Baris 5: Alamat -->
                    <div class="space-y-2">
                        <label for="alamat" class="block text-sm font-semibold text-gray-700">
                            Alamat Lengkap <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute top-3.5 left-4 pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </div>
                            <textarea id="alamat" name="alamat" rows="3" required
                                placeholder="Masukkan alamat lengkap (RT/RW, Kelurahan, Kecamatan, Kota)"
                                minlength="10" maxlength="255"
                                pattern="^[a-zA-Z0-9\s.,\-\/\(\)]+$"
                                title="Alamat hanya boleh mengandung huruf, angka, spasi, dan karakter . , - / ( )"
                                oninput="this.value = this.value.replace(/[^a-zA-Z0-9\s.,\-\/\(\)]/g, '')"
                                class="w-full pl-12 pr-4 py-3.5 bg-gray-50 border-2 border-gray-200 rounded-xl focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 transition @error('alamat') border-red-500 @enderror">{{ old('alamat', $calonSiswa->alamat) }}</textarea>
                        </div>
                        @error('alamat')
                        <p class="text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Baris 6: Data Kontak -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- No WhatsApp -->
                        <div class="space-y-2">
                            <label for="no_wa" class="block text-sm font-semibold text-gray-700">
                                No. WhatsApp <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                    </svg>
                                </div>
                                <input type="text" id="no_wa" name="no_wa" 
                                    value="{{ old('no_wa', $calonSiswa->no_wa) }}" required
                                    placeholder="6281234567890"
                                    minlength="11" maxlength="14"
                                    pattern="^62[0-9]{9,12}$"
                                    title="Nomor WhatsApp harus diawali dengan 62 (contoh: 6281234567890)"
                                    oninput="this.value = this.value.replace(/[^0-9]/g, ''); if(this.value.length > 0 && !this.value.startsWith('62')) this.value = '62' + this.value.replace(/^0+/, '').replace(/^62+/, '62');"
                                    class="w-full pl-12 pr-4 py-3.5 bg-gray-50 border-2 border-gray-200 rounded-xl focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 transition @error('no_wa') border-red-500 @enderror">
                            </div>
                            @error('no_wa')
                            <p class="text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Asal Sekolah -->
                        <div class="space-y-2">
                            <label for="asal_sekolah" class="block text-sm font-semibold text-gray-700">
                                Asal Sekolah <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                    </svg>
                                </div>
                                <input type="text" id="asal_sekolah" name="asal_sekolah" 
                                    value="{{ old('asal_sekolah', $calonSiswa->asal_sekolah) }}" required
                                    placeholder="Nama sekolah asal"
                                    minlength="5" maxlength="100"
                                    pattern="^[a-zA-Z0-9\s\-\.]+$"
                                    title="Asal sekolah hanya boleh berisi huruf, angka, spasi, titik, dan tanda hubung"
                                    oninput="this.value = this.value.replace(/[^a-zA-Z0-9\s\-\.]/g, '')"
                                    class="w-full pl-12 pr-4 py-3.5 bg-gray-50 border-2 border-gray-200 rounded-xl focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 transition @error('asal_sekolah') border-red-500 @enderror">
                            </div>
                            @error('asal_sekolah')
                            <p class="text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Baris 7: Data Sekolah -->
                    <div class="bg-blue-50/50 rounded-xl p-5 border border-blue-100">
                        <h3 class="text-sm font-bold text-gray-900 mb-4 flex items-center gap-2">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                            </svg>
                            Data Sekolah Asal
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <!-- Alamat Sekolah -->
                            <div class="md:col-span-2 space-y-2">
                                <label for="alamat_sekolah" class="block text-sm font-semibold text-gray-700">
                                    Alamat Sekolah Asal <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute top-3.5 left-4 pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        </svg>
                                    </div>
                                    <textarea id="alamat_sekolah" name="alamat_sekolah" rows="3" required
                                        placeholder="Masukkan alamat lengkap sekolah asal"
                                        minlength="10" maxlength="255"
                                        pattern="^[a-zA-Z0-9\s.,\-\/\(\)]+$"
                                        title="Alamat sekolah hanya boleh mengandung huruf, angka, spasi, dan karakter . , - / ( )"
                                        oninput="this.value = this.value.replace(/[^a-zA-Z0-9\s.,\-\/\(\)]/g, '')"
                                        class="w-full pl-12 pr-4 py-3.5 bg-white border-2 border-gray-200 rounded-xl focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 transition @error('alamat_sekolah') border-red-500 @enderror">{{ old('alamat_sekolah', $calonSiswa->alamat_sekolah) }}</textarea>
                                </div>
                                @error('alamat_sekolah')
                                <p class="text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- NPSN Sekolah -->
                            <div class="space-y-2">
                                <label for="npsn" class="block text-sm font-semibold text-gray-700">
                                    NPSN Sekolah <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0"/>
                                        </svg>
                                    </div>
                                    <input type="text" id="npsn" name="npsn" maxlength="8"
                                        value="{{ old('npsn', $calonSiswa->npsn_sekolah) }}" required
                                        placeholder="8 digit NPSN"
                                        pattern="[0-9]{8}"
                                        title="NPSN harus 8 digit angka"
                                        oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                        class="w-full pl-12 pr-4 py-3.5 bg-white border-2 border-gray-200 rounded-xl focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 transition @error('npsn') border-red-500 @enderror">
                                </div>
                                @error('npsn')
                                <p class="text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Baris 8: Data Tambahan -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- Agama -->
                        <div class="space-y-2">
                            <label for="agama" class="block text-sm font-semibold text-gray-700">
                                Agama <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                                    </svg>
                                </div>
                                <select id="agama" name="agama" required
                                    class="w-full pl-12 pr-10 py-3.5 bg-gray-50 border-2 border-gray-200 rounded-xl focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 transition appearance-none cursor-pointer @error('agama') border-red-500 @enderror">
                                    <option value="">-- Pilih Agama --</option>
                                    <option value="Islam" {{ old('agama', $calonSiswa->agama) === 'Islam' ? 'selected' : '' }}>Islam</option>
                                    <option value="Kristen" {{ old('agama', $calonSiswa->agama) === 'Kristen' ? 'selected' : '' }}>Kristen</option>
                                    <option value="Katolik" {{ old('agama', $calonSiswa->agama) === 'Katolik' ? 'selected' : '' }}>Katolik</option>
                                    <option value="Hindu" {{ old('agama', $calonSiswa->agama) === 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                    <option value="Buddha" {{ old('agama', $calonSiswa->agama) === 'Buddha' ? 'selected' : '' }}>Buddha</option>
                                    <option value="Konghucu" {{ old('agama', $calonSiswa->agama) === 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                    </svg>
                                </div>
                            </div>
                            @error('agama')
                            <p class="text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Golongan Darah -->
                        <div class="space-y-2">
                            <label for="golongan_darah" class="block text-sm font-semibold text-gray-700">
                                Golongan Darah
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>
                                    </svg>
                                </div>
                                <select id="golongan_darah" name="golongan_darah"
                                    class="w-full pl-12 pr-10 py-3.5 bg-gray-50 border-2 border-gray-200 rounded-xl focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 transition appearance-none cursor-pointer @error('golongan_darah') border-red-500 @enderror">
                                    <option value="">-- Pilih Golongan Darah --</option>
                                    <option value="A" {{ old('golongan_darah', $calonSiswa->golongan_darah) === 'A' ? 'selected' : '' }}>A</option>
                                    <option value="B" {{ old('golongan_darah', $calonSiswa->golongan_darah) === 'B' ? 'selected' : '' }}>B</option>
                                    <option value="AB" {{ old('golongan_darah', $calonSiswa->golongan_darah) === 'AB' ? 'selected' : '' }}>AB</option>
                                    <option value="O" {{ old('golongan_darah', $calonSiswa->golongan_darah) === 'O' ? 'selected' : '' }}>O</option>
                                    <option value="Tidak Tahu" {{ old('golongan_darah', $calonSiswa->golongan_darah) === 'Tidak Tahu' ? 'selected' : '' }}>Tidak Tahu</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                    </svg>
                                </div>
                            </div>
                            @error('golongan_darah')
                            <p class="text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Riwayat Penyakit -->
                        <div class="space-y-2 md:col-span-3">
                            <label for="riwayat_penyakit" class="block text-sm font-semibold text-gray-700">
                                Riwayat Penyakit
                            </label>
                            <div class="relative">
                                <div class="absolute top-3.5 left-4 pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                    </svg>
                                </div>
                                <textarea id="riwayat_penyakit" name="riwayat_penyakit" rows="2"
                                    placeholder="Kosongkan jika tidak ada riwayat penyakit"
                                    maxlength="500"
                                    pattern="^[a-zA-Z0-9\s,\.\-\(\)\/]*$"
                                    title="Riwayat penyakit hanya boleh mengandung huruf, angka, spasi, dan karakter , . - / ( )"
                                    oninput="this.value = this.value.replace(/[^a-zA-Z0-9\s,\.\-\(\)\/]/g, '')"
                                    class="w-full pl-12 pr-4 py-3.5 bg-gray-50 border-2 border-gray-200 rounded-xl focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 transition @error('riwayat_penyakit') border-red-500 @enderror">{{ old('riwayat_penyakit', $calonSiswa->riwayat_penyakit) }}</textarea>
                            </div>
                            @error('riwayat_penyakit')
                            <p class="text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Baris 9: Data Keluarga & Fisik -->
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                        <!-- Anak Ke -->
                        <div class="space-y-2">
                            <label for="anak_ke" class="block text-sm font-semibold text-gray-700">
                                Anak Ke <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                </div>
                                <input type="number" id="anak_ke" name="anak_ke" min="1" max="10"
                                    value="{{ old('anak_ke', $calonSiswa->anak_ke) }}" required
                                    title="Anak ke hanya boleh diisi angka 1-10"
                                    class="w-full pl-12 pr-4 py-3.5 bg-gray-50 border-2 border-gray-200 rounded-xl focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 transition @error('anak_ke') border-red-500 @enderror">
                            </div>
                            @error('anak_ke')
                            <p class="text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Jumlah Saudara -->
                        <div class="space-y-2">
                            <label for="jumlah_saudara" class="block text-sm font-semibold text-gray-700">
                                Jumlah Saudara <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                </div>
                                <input type="number" id="jumlah_saudara" name="jumlah_saudara" min="0" max="10"
                                    value="{{ old('jumlah_saudara', $calonSiswa->jumlah_saudara) }}" required
                                    title="Jumlah saudara hanya boleh diisi angka 0-10"
                                    class="w-full pl-12 pr-4 py-3.5 bg-gray-50 border-2 border-gray-200 rounded-xl focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 transition @error('jumlah_saudara') border-red-500 @enderror">
                            </div>
                            @error('jumlah_saudara')
                            <p class="text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Tinggi Badan -->
                        <div class="space-y-2">
                            <label for="tinggi_badan" class="block text-sm font-semibold text-gray-700">
                                Tinggi (cm) <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
                                    </svg>
                                </div>
                                <input type="number" id="tinggi_badan" name="tinggi_badan" min="100" max="200"
                                    value="{{ old('tinggi_badan', $calonSiswa->tinggi_badan) }}" required
                                    title="Tinggi badan harus antara 100-200 cm"
                                    class="w-full pl-12 pr-4 py-3.5 bg-gray-50 border-2 border-gray-200 rounded-xl focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 transition @error('tinggi_badan') border-red-500 @enderror">
                            </div>
                            @error('tinggi_badan')
                            <p class="text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Berat Badan -->
                        <div class="space-y-2">
                            <label for="berat_badan" class="block text-sm font-semibold text-gray-700">
                                Berat (kg) <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"/>
                                    </svg>
                                </div>
                                <input type="number" id="berat_badan" name="berat_badan" min="20" max="200"
                                    value="{{ old('berat_badan', $calonSiswa->berat_badan) }}" required
                                    title="Berat badan harus antara 20-200 kg"
                                    class="w-full pl-12 pr-4 py-3.5 bg-gray-50 border-2 border-gray-200 rounded-xl focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 transition @error('berat_badan') border-red-500 @enderror">
                            </div>
                            @error('berat_badan')
                            <p class="text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Data Orang Tua - Hanya jika jenis = orang_tua -->
            @if($jenis === 'orang_tua')
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="px-6 py-5 border-b border-gray-200 bg-gradient-to-r from-blue-50 to-blue-100">
                    <h2 class="font-bold text-lg text-gray-900 flex items-center gap-3">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        Data Orang Tua
                    </h2>
                </div>
                <div class="p-6 space-y-8">
                    <!-- Data Ayah -->
                    <div class="bg-blue-50/50 rounded-xl p-5 border border-blue-100">
                        <h3 class="text-sm font-bold text-gray-900 mb-4 flex items-center gap-2">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            Data Ayah
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <!-- Nama Ayah -->
                            <div class="space-y-2">
                                <label for="nama_ayah" class="block text-sm font-semibold text-gray-700">
                                    Nama Ayah <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                        </svg>
                                    </div>
                                    <input type="text" id="nama_ayah" name="nama_ayah" 
                                        value="{{ old('nama_ayah', $calonSiswa->orangTua?->nama_ayah) }}" required
                                        placeholder="Nama lengkap ayah"
                                        maxlength="100"
                                        pattern="^[a-zA-Z\s\.\']+$"
                                        title="Nama ayah hanya boleh mengandung huruf, spasi, titik, dan apostrof"
                                        oninput="this.value = this.value.replace(/[^a-zA-Z\s\.\']/g, '')"
                                        class="w-full pl-12 pr-4 py-3.5 bg-white border-2 border-gray-200 rounded-xl focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 transition @error('nama_ayah') border-red-500 @enderror">
                                </div>
                                @error('nama_ayah')
                                <p class="text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- NIK Ayah -->
                            <div class="space-y-2">
                                <label for="nik_ayah" class="block text-sm font-semibold text-gray-700">
                                    NIK Ayah <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0"/>
                                        </svg>
                                    </div>
                                    <input type="text" id="nik_ayah" name="nik_ayah" maxlength="16"
                                        value="{{ old('nik_ayah', $calonSiswa->orangTua?->nik_ayah) }}" required
                                        placeholder="16 digit NIK"
                                        pattern="[0-9]{16}"
                                        title="NIK ayah harus 16 digit angka"
                                        oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                        class="w-full pl-12 pr-4 py-3.5 bg-white border-2 border-gray-200 rounded-xl focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 transition @error('nik_ayah') border-red-500 @enderror">
                                </div>
                                @error('nik_ayah')
                                <p class="text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Status Ayah -->
                            <div class="space-y-3">
                                <label class="block text-sm font-semibold text-gray-700">
                                    Status Ayah <span class="text-red-500">*</span>
                                </label>
                                <div class="flex flex-wrap gap-4">
                                    <label class="flex items-center gap-2 cursor-pointer">
                                        <input type="radio" name="status_ayah" value="hidup" 
                                            {{ old('status_ayah', $calonSiswa->orangTua?->status_ayah ?? 'hidup') === 'hidup' ? 'checked' : '' }} required
                                            class="w-5 h-5 text-primary border-gray-300 focus:ring-primary cursor-pointer">
                                        <span class="text-gray-700">Masih Hidup</span>
                                    </label>
                                    <label class="flex items-center gap-2 cursor-pointer">
                                        <input type="radio" name="status_ayah" value="meninggal" 
                                            {{ old('status_ayah', $calonSiswa->orangTua?->status_ayah) === 'meninggal' ? 'checked' : '' }} required
                                            class="w-5 h-5 text-primary border-gray-300 focus:ring-primary cursor-pointer">
                                        <span class="text-gray-700">Meninggal</span>
                                    </label>
                                </div>
                                @error('status_ayah')
                                <p class="text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Pekerjaan Ayah -->
                            <div class="space-y-2">
                                <label for="pekerjaan_ayah" class="block text-sm font-semibold text-gray-700">
                                    Pekerjaan Ayah <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                    <input type="text" id="pekerjaan_ayah" name="pekerjaan_ayah" 
                                        value="{{ old('pekerjaan_ayah', $calonSiswa->orangTua?->pekerjaan_ayah) }}" required
                                        placeholder="Contoh: Wiraswasta, PNS, Petani"
                                        maxlength="100"
                                        pattern="^[a-zA-Z0-9\s,\.\-\/\&]+$"
                                        title="Pekerjaan hanya boleh mengandung huruf, angka, spasi, dan tanda baca"
                                        oninput="this.value = this.value.replace(/[^a-zA-Z0-9\s,\.\-\/\&]/g, '')"
                                        class="w-full pl-12 pr-4 py-3.5 bg-white border-2 border-gray-200 rounded-xl focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 transition @error('pekerjaan_ayah') border-red-500 @enderror">
                                </div>
                                @error('pekerjaan_ayah')
                                <p class="text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Pendidikan Ayah -->
                            <div class="space-y-2">
                                <label for="pendidikan_ayah" class="block text-sm font-semibold text-gray-700">
                                    Pendidikan Ayah <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"/>
                                        </svg>
                                    </div>
                                    <select id="pendidikan_ayah" name="pendidikan_ayah" required
                                        class="w-full pl-12 pr-10 py-3.5 bg-white border-2 border-gray-200 rounded-xl focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 transition appearance-none cursor-pointer @error('pendidikan_ayah') border-red-500 @enderror">
                                        <option value="">-- Pilih Pendidikan --</option>
                                        <option value="Tidak Sekolah" {{ old('pendidikan_ayah', $calonSiswa->orangTua?->pendidikan_ayah) === 'Tidak Sekolah' ? 'selected' : '' }}>Tidak Sekolah</option>
                                        <option value="SD" {{ old('pendidikan_ayah', $calonSiswa->orangTua?->pendidikan_ayah) === 'SD' ? 'selected' : '' }}>SD</option>
                                        <option value="SMP" {{ old('pendidikan_ayah', $calonSiswa->orangTua?->pendidikan_ayah) === 'SMP' ? 'selected' : '' }}>SMP</option>
                                        <option value="SMA" {{ old('pendidikan_ayah', $calonSiswa->orangTua?->pendidikan_ayah) === 'SMA' ? 'selected' : '' }}>SMA/SMK</option>
                                        <option value="D1" {{ old('pendidikan_ayah', $calonSiswa->orangTua?->pendidikan_ayah) === 'D1' ? 'selected' : '' }}>D1</option>
                                        <option value="D2" {{ old('pendidikan_ayah', $calonSiswa->orangTua?->pendidikan_ayah) === 'D2' ? 'selected' : '' }}>D2</option>
                                        <option value="D3" {{ old('pendidikan_ayah', $calonSiswa->orangTua?->pendidikan_ayah) === 'D3' ? 'selected' : '' }}>D3</option>
                                        <option value="S1" {{ old('pendidikan_ayah', $calonSiswa->orangTua?->pendidikan_ayah) === 'S1' ? 'selected' : '' }}>S1</option>
                                        <option value="S2" {{ old('pendidikan_ayah', $calonSiswa->orangTua?->pendidikan_ayah) === 'S2' ? 'selected' : '' }}>S2</option>
                                        <option value="S3" {{ old('pendidikan_ayah', $calonSiswa->orangTua?->pendidikan_ayah) === 'S3' ? 'selected' : '' }}>S3</option>
                                    </select>
                                    <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                        </svg>
                                    </div>
                                </div>
                                @error('pendidikan_ayah')
                                <p class="text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Penghasilan Ayah -->
                            <div class="space-y-2">
                                <label for="penghasilan_ayah" class="block text-sm font-semibold text-gray-700">
                                    Penghasilan Ayah <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a1 1 0 11-2 0 1 1 0 012 0z"/>
                                        </svg>
                                    </div>
                                    <select id="penghasilan_ayah" name="penghasilan_ayah" required
                                        class="w-full pl-12 pr-10 py-3.5 bg-white border-2 border-gray-200 rounded-xl focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 transition appearance-none cursor-pointer @error('penghasilan_ayah') border-red-500 @enderror">
                                        <option value="">-- Pilih Penghasilan --</option>
                                        <option value="<1jt" {{ old('penghasilan_ayah', $calonSiswa->orangTua?->penghasilan_ayah) === '<1jt' ? 'selected' : '' }}>Kurang dari Rp 1.000.000</option>
                                        <option value="1jt-3jt" {{ old('penghasilan_ayah', $calonSiswa->orangTua?->penghasilan_ayah) === '1jt-3jt' ? 'selected' : '' }}>Rp 1.000.000 - Rp 3.000.000</option>
                                        <option value="3jt-5jt" {{ old('penghasilan_ayah', $calonSiswa->orangTua?->penghasilan_ayah) === '3jt-5jt' ? 'selected' : '' }}>Rp 3.000.000 - Rp 5.000.000</option>
                                        <option value="5jt-10jt" {{ old('penghasilan_ayah', $calonSiswa->orangTua?->penghasilan_ayah) === '5jt-10jt' ? 'selected' : '' }}>Rp 5.000.000 - Rp 10.000.000</option>
                                        <option value=">10jt" {{ old('penghasilan_ayah', $calonSiswa->orangTua?->penghasilan_ayah) === '>10jt' ? 'selected' : '' }}>Lebih dari Rp 10.000.000</option>
                                    </select>
                                    <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                        </svg>
                                    </div>
                                </div>
                                @error('penghasilan_ayah')
                                <p class="text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Data Ibu -->
                    <div class="bg-pink-50/50 rounded-xl p-5 border border-pink-100">
                        <h3 class="text-sm font-bold text-gray-900 mb-4 flex items-center gap-2">
                            <svg class="w-5 h-5 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            Data Ibu
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <!-- Nama Ibu -->
                            <div class="space-y-2">
                                <label for="nama_ibu" class="block text-sm font-semibold text-gray-700">
                                    Nama Ibu <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                        </svg>
                                    </div>
                                    <input type="text" id="nama_ibu" name="nama_ibu" 
                                        value="{{ old('nama_ibu', $calonSiswa->orangTua?->nama_ibu) }}" required
                                        placeholder="Nama lengkap ibu"
                                        maxlength="100"
                                        pattern="^[a-zA-Z\s\.\']+$"
                                        title="Nama ibu hanya boleh mengandung huruf, spasi, titik, dan apostrof"
                                        oninput="this.value = this.value.replace(/[^a-zA-Z\s\.\']/g, '')"
                                        class="w-full pl-12 pr-4 py-3.5 bg-white border-2 border-gray-200 rounded-xl focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 transition @error('nama_ibu') border-red-500 @enderror">
                                </div>
                                @error('nama_ibu')
                                <p class="text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- NIK Ibu -->
                            <div class="space-y-2">
                                <label for="nik_ibu" class="block text-sm font-semibold text-gray-700">
                                    NIK Ibu <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0"/>
                                        </svg>
                                    </div>
                                    <input type="text" id="nik_ibu" name="nik_ibu" maxlength="16"
                                        value="{{ old('nik_ibu', $calonSiswa->orangTua?->nik_ibu) }}" required
                                        placeholder="16 digit NIK"
                                        pattern="[0-9]{16}"
                                        title="NIK ibu harus 16 digit angka"
                                        oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                        class="w-full pl-12 pr-4 py-3.5 bg-white border-2 border-gray-200 rounded-xl focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 transition @error('nik_ibu') border-red-500 @enderror">
                                </div>
                                @error('nik_ibu')
                                <p class="text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Status Ibu -->
                            <div class="space-y-3">
                                <label class="block text-sm font-semibold text-gray-700">
                                    Status Ibu <span class="text-red-500">*</span>
                                </label>
                                <div class="flex flex-wrap gap-4">
                                    <label class="flex items-center gap-2 cursor-pointer">
                                        <input type="radio" name="status_ibu" value="hidup" 
                                            {{ old('status_ibu', $calonSiswa->orangTua?->status_ibu ?? 'hidup') === 'hidup' ? 'checked' : '' }} required
                                            class="w-5 h-5 text-primary border-gray-300 focus:ring-primary cursor-pointer">
                                        <span class="text-gray-700">Masih Hidup</span>
                                    </label>
                                    <label class="flex items-center gap-2 cursor-pointer">
                                        <input type="radio" name="status_ibu" value="meninggal" 
                                            {{ old('status_ibu', $calonSiswa->orangTua?->status_ibu) === 'meninggal' ? 'checked' : '' }} required
                                            class="w-5 h-5 text-primary border-gray-300 focus:ring-primary cursor-pointer">
                                        <span class="text-gray-700">Meninggal</span>
                                    </label>
                                </div>
                                @error('status_ibu')
                                <p class="text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Pekerjaan Ibu -->
                            <div class="space-y-2">
                                <label for="pekerjaan_ibu" class="block text-sm font-semibold text-gray-700">
                                    Pekerjaan Ibu <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                    <input type="text" id="pekerjaan_ibu" name="pekerjaan_ibu" 
                                        value="{{ old('pekerjaan_ibu', $calonSiswa->orangTua?->pekerjaan_ibu) }}" required
                                        placeholder="Contoh: Ibu Rumah Tangga, Guru"
                                        maxlength="100"
                                        pattern="^[a-zA-Z0-9\s,\.\-\/\&]+$"
                                        title="Pekerjaan hanya boleh mengandung huruf, angka, spasi, dan tanda baca"
                                        oninput="this.value = this.value.replace(/[^a-zA-Z0-9\s,\.\-\/\&]/g, '')"
                                        class="w-full pl-12 pr-4 py-3.5 bg-white border-2 border-gray-200 rounded-xl focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 transition @error('pekerjaan_ibu') border-red-500 @enderror">
                                </div>
                                @error('pekerjaan_ibu')
                                <p class="text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Pendidikan Ibu -->
                            <div class="space-y-2">
                                <label for="pendidikan_ibu" class="block text-sm font-semibold text-gray-700">
                                    Pendidikan Ibu <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"/>
                                        </svg>
                                    </div>
                                    <select id="pendidikan_ibu" name="pendidikan_ibu" required
                                        class="w-full pl-12 pr-10 py-3.5 bg-white border-2 border-gray-200 rounded-xl focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 transition appearance-none cursor-pointer @error('pendidikan_ibu') border-red-500 @enderror">
                                        <option value="">-- Pilih Pendidikan --</option>
                                        <option value="Tidak Sekolah" {{ old('pendidikan_ibu', $calonSiswa->orangTua?->pendidikan_ibu) === 'Tidak Sekolah' ? 'selected' : '' }}>Tidak Sekolah</option>
                                        <option value="SD" {{ old('pendidikan_ibu', $calonSiswa->orangTua?->pendidikan_ibu) === 'SD' ? 'selected' : '' }}>SD</option>
                                        <option value="SMP" {{ old('pendidikan_ibu', $calonSiswa->orangTua?->pendidikan_ibu) === 'SMP' ? 'selected' : '' }}>SMP</option>
                                        <option value="SMA" {{ old('pendidikan_ibu', $calonSiswa->orangTua?->pendidikan_ibu) === 'SMA' ? 'selected' : '' }}>SMA/SMK</option>
                                        <option value="D1" {{ old('pendidikan_ibu', $calonSiswa->orangTua?->pendidikan_ibu) === 'D1' ? 'selected' : '' }}>D1</option>
                                        <option value="D2" {{ old('pendidikan_ibu', $calonSiswa->orangTua?->pendidikan_ibu) === 'D2' ? 'selected' : '' }}>D2</option>
                                        <option value="D3" {{ old('pendidikan_ibu', $calonSiswa->orangTua?->pendidikan_ibu) === 'D3' ? 'selected' : '' }}>D3</option>
                                        <option value="S1" {{ old('pendidikan_ibu', $calonSiswa->orangTua?->pendidikan_ibu) === 'S1' ? 'selected' : '' }}>S1</option>
                                        <option value="S2" {{ old('pendidikan_ibu', $calonSiswa->orangTua?->pendidikan_ibu) === 'S2' ? 'selected' : '' }}>S2</option>
                                        <option value="S3" {{ old('pendidikan_ibu', $calonSiswa->orangTua?->pendidikan_ibu) === 'S3' ? 'selected' : '' }}>S3</option>
                                    </select>
                                    <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                        </svg>
                                    </div>
                                </div>
                                @error('pendidikan_ibu')
                                <p class="text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Penghasilan Ibu -->
                            <div class="space-y-2">
                                <label for="penghasilan_ibu" class="block text-sm font-semibold text-gray-700">
                                    Penghasilan Ibu <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a1 1 0 11-2 0 1 1 0 012 0z"/>
                                        </svg>
                                    </div>
                                    <select id="penghasilan_ibu" name="penghasilan_ibu" required
                                        class="w-full pl-12 pr-10 py-3.5 bg-white border-2 border-gray-200 rounded-xl focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 transition appearance-none cursor-pointer @error('penghasilan_ibu') border-red-500 @enderror">
                                        <option value="">-- Pilih Penghasilan --</option>
                                        <option value="<1jt" {{ old('penghasilan_ibu', $calonSiswa->orangTua?->penghasilan_ibu) === '<1jt' ? 'selected' : '' }}>Kurang dari Rp 1.000.000</option>
                                        <option value="1jt-3jt" {{ old('penghasilan_ibu', $calonSiswa->orangTua?->penghasilan_ibu) === '1jt-3jt' ? 'selected' : '' }}>Rp 1.000.000 - Rp 3.000.000</option>
                                        <option value="3jt-5jt" {{ old('penghasilan_ibu', $calonSiswa->orangTua?->penghasilan_ibu) === '3jt-5jt' ? 'selected' : '' }}>Rp 3.000.000 - Rp 5.000.000</option>
                                        <option value="5jt-10jt" {{ old('penghasilan_ibu', $calonSiswa->orangTua?->penghasilan_ibu) === '5jt-10jt' ? 'selected' : '' }}>Rp 5.000.000 - Rp 10.000.000</option>
                                        <option value=">10jt" {{ old('penghasilan_ibu', $calonSiswa->orangTua?->penghasilan_ibu) === '>10jt' ? 'selected' : '' }}>Lebih dari Rp 10.000.000</option>
                                    </select>
                                    <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                        </svg>
                                    </div>
                                </div>
                                @error('penghasilan_ibu')
                                <p class="text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- No WA Ortu -->
                    <div class="bg-gray-50 rounded-xl p-5 border border-gray-200">
                        <div class="max-w-md space-y-2">
                            <label for="no_wa_ortu" class="block text-sm font-semibold text-gray-700">
                                No. WhatsApp Orang Tua <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                    </svg>
                                </div>
                                <input type="text" id="no_wa_ortu" name="no_wa_ortu" 
                                    value="{{ old('no_wa_ortu', $calonSiswa->orangTua?->no_wa_ortu) }}" required
                                    placeholder="6281234567890"
                                    minlength="10" maxlength="15"
                                    pattern="^[0-9]{10,15}$"
                                    title="Nomor WhatsApp hanya boleh berisi angka 10-15 digit"
                                    oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                    class="w-full pl-12 pr-4 py-3.5 bg-white border-2 border-gray-200 rounded-xl focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 transition @error('no_wa_ortu') border-red-500 @enderror">
                            </div>
                            @error('no_wa_ortu')
                            <p class="text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <!-- Data Wali - Hanya jika jenis = wali -->
            @if($jenis === 'wali')
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="px-6 py-5 border-b border-gray-200 bg-gradient-to-r from-amber-50 to-orange-50">
                    <h2 class="font-bold text-lg text-gray-900 flex items-center gap-3">
                        <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        Data Wali
                    </h2>
                </div>
                <div class="p-6">
                    <div class="bg-amber-50/50 rounded-xl p-5 border border-amber-100">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <!-- Nama Wali -->
                            <div class="space-y-2">
                                <label for="nama_wali" class="block text-sm font-semibold text-gray-700">
                                    Nama Wali <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                        </svg>
                                    </div>
                                    <input type="text" id="nama_wali" name="nama_wali" 
                                        value="{{ old('nama_wali', $calonSiswa->orangTua?->nama_wali) }}" required
                                        placeholder="Nama lengkap wali"
                                        maxlength="100"
                                        pattern="^[a-zA-Z\s\.\']+$"
                                        title="Nama wali hanya boleh mengandung huruf, spasi, titik, dan apostrof"
                                        oninput="this.value = this.value.replace(/[^a-zA-Z\s\.\']/g, '')"
                                        class="w-full pl-12 pr-4 py-3.5 bg-white border-2 border-gray-200 rounded-xl focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 transition @error('nama_wali') border-red-500 @enderror">
                                </div>
                                @error('nama_wali')
                                <p class="text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Pekerjaan Wali -->
                            <div class="space-y-2">
                                <label for="pekerjaan_wali" class="block text-sm font-semibold text-gray-700">
                                    Pekerjaan Wali <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                    <input type="text" id="pekerjaan_wali" name="pekerjaan_wali" 
                                        value="{{ old('pekerjaan_wali', $calonSiswa->orangTua?->pekerjaan_wali) }}" required
                                        placeholder="Contoh: Wiraswasta, PNS"
                                        maxlength="100"
                                        pattern="^[a-zA-Z0-9\s,\.\-\/\&]+$"
                                        title="Pekerjaan hanya boleh mengandung huruf, angka, spasi, dan tanda baca"
                                        oninput="this.value = this.value.replace(/[^a-zA-Z0-9\s,\.\-\/\&]/g, '')"
                                        class="w-full pl-12 pr-4 py-3.5 bg-white border-2 border-gray-200 rounded-xl focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 transition @error('pekerjaan_wali') border-red-500 @enderror">
                                </div>
                                @error('pekerjaan_wali')
                                <p class="text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- No HP Wali -->
                            <div class="space-y-2">
                                <label for="no_hp_wali" class="block text-sm font-semibold text-gray-700">
                                    No. HP Wali <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                        </svg>
                                    </div>
                                    <input type="text" id="no_hp_wali" name="no_hp_wali" 
                                        value="{{ old('no_hp_wali', $calonSiswa->orangTua?->no_hp_wali) }}" required
                                        placeholder="6281234567890"
                                        minlength="10" maxlength="15"
                                        pattern="^[0-9]{10,15}$"
                                        title="Nomor HP hanya boleh berisi angka 10-15 digit"
                                        oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                        class="w-full pl-12 pr-4 py-3.5 bg-white border-2 border-gray-200 rounded-xl focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 transition @error('no_hp_wali') border-red-500 @enderror">
                                </div>
                                @error('no_hp_wali')
                                <p class="text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Hubungan Wali -->
                            <div class="space-y-2">
                                <label for="hubungan_wali" class="block text-sm font-semibold text-gray-700">
                                    Hubungan dengan Wali <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                        </svg>
                                    </div>
                                    <input type="text" id="hubungan_wali" name="hubungan_wali" 
                                        value="{{ old('hubungan_wali', $calonSiswa->orangTua?->hubungan_wali) }}" required
                                        placeholder="Contoh: Paman, Bibi, Kakek"
                                        class="w-full pl-12 pr-4 py-3.5 bg-white border-2 border-gray-200 rounded-xl focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 transition @error('hubungan_wali') border-red-500 @enderror">
                                </div>
                                @error('hubungan_wali')
                                <p class="text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <!-- Submit Button -->
            <div class="flex flex-col sm:flex-row justify-end gap-4 pt-4">
                <a href="{{ route('spmb.profil') }}" 
                    class="px-6 py-3.5 border-2 border-gray-300 text-gray-700 rounded-xl font-semibold hover:bg-gray-50 hover:border-gray-400 transition text-center">
                    Batal
                </a>
                <button type="submit" 
                    class="px-8 py-3.5 bg-gradient-to-r from-primary to-blue-600 text-white rounded-xl font-semibold hover:shadow-lg hover:shadow-primary/30 transition flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
