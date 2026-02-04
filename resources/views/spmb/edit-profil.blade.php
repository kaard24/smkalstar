@extends('layouts.app')

@section('title', 'Edit Profil - SMK Al-Hidayah Lestari')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
 

        @if(session('error'))
        <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-700 rounded-xl">
            {{ session('error') }}
        </div>
        @endif

        @if(session('info'))
        <div class="mb-6 p-4 bg-blue-50 border border-blue-200 text-blue-700 rounded-xl">
            {{ session('info') }}
        </div>
        @endif

        <!-- Tampilkan semua error validasi -->
        @if($errors->any())
        <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-700 rounded-xl">
            <h3 class="font-semibold mb-2">Terjadi kesalahan:</h3>
            <ul class="list-disc list-inside text-sm">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('spmb.profil.update') }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')
            <input type="hidden" name="jenis" value="{{ $jenis }}">
            
            <!-- Info Pendaftaran -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
                    <h2 class="font-semibold text-gray-900">Info Pendaftaran</h2>
                </div>
                <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- No Pendaftaran (readonly) -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nomor Pendaftaran</label>
                        <input type="text" value="SPMB-{{ $calonSiswa->pendaftaran->id ?? $calonSiswa->id }}/{{ date('Y') }}" readonly
                            class="w-full px-4 py-3 border border-gray-200 rounded-xl bg-gray-50 text-gray-500">
                    </div>

                    <!-- Gelombang (readonly) -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Gelombang</label>
                        <input type="text" value="{{ $calonSiswa->pendaftaran->gelombang ?? 'Gelombang 1' }}" readonly
                            class="w-full px-4 py-3 border border-gray-200 rounded-xl bg-gray-50 text-gray-500">
                    </div>

                    <!-- Jurusan (readonly) -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Jurusan Pilihan</label>
                        <input type="text" 
                            value="{{ $calonSiswa->pendaftaran->jurusan->nama ?? 'Belum memilih jurusan' }}" 
                            readonly
                            class="w-full px-4 py-3 border border-gray-200 rounded-xl bg-gray-50 text-gray-500">
                        <div class="mt-2 flex items-start gap-2 text-xs text-amber-600 bg-amber-50 p-3 rounded-lg border border-amber-100">
                            <svg class="w-4 h-4 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span>Jika ingin mengubah jurusan, silakan hubungi admin melalui WhatsApp <a href="https://wa.me/628812489572" target="_blank" class="underline font-medium hover:text-amber-700">08812489572</a></span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Data Diri -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
                    <h2 class="font-semibold text-gray-900">Data Diri Siswa</h2>
                </div>
                <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- NISN (readonly) -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">NISN</label>
                        <input type="text" value="{{ $calonSiswa->nisn }}" readonly
                            class="w-full px-4 py-3 border border-gray-200 rounded-xl bg-gray-50 text-gray-500">
                        <p class="mt-1 text-xs text-gray-400">NISN tidak dapat diubah</p>
                    </div>

                    <!-- Nama Lengkap -->
                    <div>
                        <label for="nama" class="block text-sm font-medium text-gray-700 mb-2">
                            Nama Lengkap <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="nama" name="nama" value="{{ old('nama', $calonSiswa->nama) }}" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition @error('nama') border-red-500 @enderror">
                        @error('nama')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- NIK -->
                    <div>
                        <label for="nik" class="block text-sm font-medium text-gray-700 mb-2">
                            NIK <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="nik" name="nik" maxlength="16" value="{{ old('nik', $calonSiswa->nik) }}"
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition @error('nik') border-red-500 @enderror">
                        @error('nik')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- No KK -->
                    <div>
                        <label for="no_kk" class="block text-sm font-medium text-gray-700 mb-2">
                            Nomor KK <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="no_kk" name="no_kk" maxlength="16" value="{{ old('no_kk', $calonSiswa->no_kk) }}"
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition @error('no_kk') border-red-500 @enderror">
                        @error('no_kk')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Jenis Kelamin -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Kelamin <span class="text-red-500">*</span></label>
                        <div class="flex gap-4 mt-2">
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="radio" name="jk" value="L" {{ old('jk', $calonSiswa->jk) === 'L' ? 'checked' : '' }} required
                                    class="w-4 h-4 text-primary border-gray-300 focus:ring-primary">
                                <span class="text-gray-700">Laki-laki</span>
                            </label>
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="radio" name="jk" value="P" {{ old('jk', $calonSiswa->jk) === 'P' ? 'checked' : '' }} required
                                    class="w-4 h-4 text-primary border-gray-300 focus:ring-primary">
                                <span class="text-gray-700">Perempuan</span>
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
                            value="{{ old('tgl_lahir', $calonSiswa->tgl_lahir?->format('Y-m-d')) }}"
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition @error('tgl_lahir') border-red-500 @enderror">
                        @error('tgl_lahir')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tempat Lahir -->
                    <div>
                        <label for="tempat_lahir" class="block text-sm font-medium text-gray-700 mb-2">
                            Tempat Lahir <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="tempat_lahir" name="tempat_lahir" 
                            value="{{ old('tempat_lahir', $calonSiswa->tempat_lahir) }}"
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition @error('tempat_lahir') border-red-500 @enderror">
                        @error('tempat_lahir')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Asal Sekolah -->
                    <div>
                        <label for="asal_sekolah" class="block text-sm font-medium text-gray-700 mb-2">
                            Asal Sekolah <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="asal_sekolah" name="asal_sekolah" 
                            value="{{ old('asal_sekolah', $calonSiswa->asal_sekolah) }}" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition @error('asal_sekolah') border-red-500 @enderror">
                        @error('asal_sekolah')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- No WhatsApp -->
                    <div>
                        <label for="no_wa" class="block text-sm font-medium text-gray-700 mb-2">
                            No. WhatsApp <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="no_wa" name="no_wa" 
                            value="{{ old('no_wa', $calonSiswa->no_wa) }}" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition @error('no_wa') border-red-500 @enderror">
                        @error('no_wa')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Alamat -->
                    <div class="md:col-span-2">
                        <label for="alamat" class="block text-sm font-medium text-gray-700 mb-2">
                            Alamat Lengkap <span class="text-red-500">*</span>
                        </label>
                        <textarea id="alamat" name="alamat" rows="3" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition @error('alamat') border-red-500 @enderror">{{ old('alamat', $calonSiswa->alamat) }}</textarea>
                        @error('alamat')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Alamat Sekolah -->
                    <div class="md:col-span-2">
                        <label for="alamat_sekolah" class="block text-sm font-medium text-gray-700 mb-2">
                            Alamat Sekolah Asal <span class="text-red-500">*</span>
                        </label>
                        <textarea id="alamat_sekolah" name="alamat_sekolah" rows="3"
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition @error('alamat_sekolah') border-red-500 @enderror">{{ old('alamat_sekolah', $calonSiswa->alamat_sekolah) }}</textarea>
                        @error('alamat_sekolah')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Data Orang Tua - Hanya jika jenis = orang_tua -->
            @if($jenis === 'orang_tua')
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
                    <h2 class="font-semibold text-gray-900">Data Orang Tua</h2>
                </div>
                <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Nama Ayah -->
                    <div>
                        <label for="nama_ayah" class="block text-sm font-medium text-gray-700 mb-2">
                            Nama Ayah <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="nama_ayah" name="nama_ayah" 
                            value="{{ old('nama_ayah', $calonSiswa->orangTua?->nama_ayah) }}" required
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
                            value="{{ old('nama_ibu', $calonSiswa->orangTua?->nama_ibu) }}" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition @error('nama_ibu') border-red-500 @enderror">
                        @error('nama_ibu')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Pekerjaan Ayah -->
                    <div>
                        <label for="pekerjaan_ayah" class="block text-sm font-medium text-gray-700 mb-2">
                            Pekerjaan Ayah <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="pekerjaan_ayah" name="pekerjaan_ayah" 
                            value="{{ old('pekerjaan_ayah', $calonSiswa->orangTua?->pekerjaan_ayah) }}" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition @error('pekerjaan_ayah') border-red-500 @enderror">
                        @error('pekerjaan_ayah')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Pekerjaan Ibu -->
                    <div>
                        <label for="pekerjaan_ibu" class="block text-sm font-medium text-gray-700 mb-2">
                            Pekerjaan Ibu <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="pekerjaan_ibu" name="pekerjaan_ibu" 
                            value="{{ old('pekerjaan_ibu', $calonSiswa->orangTua?->pekerjaan_ibu) }}" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition @error('pekerjaan_ibu') border-red-500 @enderror">
                        @error('pekerjaan_ibu')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- No WA Ortu -->
                    <div>
                        <label for="no_wa_ortu" class="block text-sm font-medium text-gray-700 mb-2">
                            No. WhatsApp Orang Tua <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="no_wa_ortu" name="no_wa_ortu" 
                            value="{{ old('no_wa_ortu', $calonSiswa->orangTua?->no_wa_ortu) }}" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition @error('no_wa_ortu') border-red-500 @enderror">
                        @error('no_wa_ortu')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Switch ke Wali - Hanya muncul jika jenis = orang_tua -->
            <div class="bg-gradient-to-r from-amber-50 to-orange-50 rounded-xl shadow-sm border border-amber-100 overflow-hidden">
                <div class="p-6">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                        <div class="flex items-start gap-3">
                            <div class="w-10 h-10 bg-amber-100 rounded-full flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900">Ingin menggunakan data Wali?</h3>
                                <p class="text-sm text-gray-600 mt-1">Anda dapat mengubah data orang tua menjadi data wali</p>
                            </div>
                        </div>
                        <button type="button" onclick="document.getElementById('formSwitchWali').classList.toggle('hidden')" 
                            class="px-4 py-2 bg-amber-600 text-white rounded-lg font-medium hover:bg-amber-700 transition text-sm whitespace-nowrap">
                            + Tambah Data Wali
                        </button>
                    </div>

                    <!-- Form Data Wali (Hidden by default) -->
                    <div id="formSwitchWali" class="hidden mt-6 pt-6 border-t border-amber-200">
                        <div class="bg-white rounded-xl p-6 border border-amber-100">
                            <h4 class="font-medium text-gray-900 mb-4 flex items-center gap-2">
                                <svg class="w-4 h-4 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                Data Wali Baru
                            </h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Nama Wali -->
                                <div>
                                    <label for="nama_wali" class="block text-sm font-medium text-gray-700 mb-2">
                                        Nama Wali <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" id="nama_wali" name="nama_wali" 
                                        value="{{ old('nama_wali') }}"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition @error('nama_wali') border-red-500 @enderror">
                                    @error('nama_wali')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Pekerjaan Wali -->
                                <div>
                                    <label for="pekerjaan_wali" class="block text-sm font-medium text-gray-700 mb-2">
                                        Pekerjaan Wali <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" id="pekerjaan_wali" name="pekerjaan_wali" 
                                        value="{{ old('pekerjaan_wali') }}"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition @error('pekerjaan_wali') border-red-500 @enderror">
                                    @error('pekerjaan_wali')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- No HP Wali -->
                                <div>
                                    <label for="no_hp_wali" class="block text-sm font-medium text-gray-700 mb-2">
                                        No. HP Wali <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" id="no_hp_wali" name="no_hp_wali" 
                                        value="{{ old('no_hp_wali') }}"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition @error('no_hp_wali') border-red-500 @enderror">
                                    @error('no_hp_wali')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Hubungan Wali -->
                                <div>
                                    <label for="hubungan_wali" class="block text-sm font-medium text-gray-700 mb-2">
                                        Hubungan dengan Wali <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" id="hubungan_wali" name="hubungan_wali" 
                                        value="{{ old('hubungan_wali') }}"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition @error('hubungan_wali') border-red-500 @enderror">
                                    @error('hubungan_wali')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <input type="hidden" name="switch_to_wali" value="1">
                            <div class="mt-4 p-3 bg-yellow-50 rounded-lg border border-yellow-200">
                                <p class="text-xs text-yellow-700 flex items-start gap-2">
                                    <svg class="w-4 h-4 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    <span>Dengan mengisi data di atas, data orang tua akan diganti dengan data wali.</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <!-- Data Wali - Hanya jika jenis = wali -->
            @if($jenis === 'wali')
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
                    <h2 class="font-semibold text-gray-900">Data Wali</h2>
                </div>
                <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Nama Wali -->
                    <div>
                        <label for="nama_wali" class="block text-sm font-medium text-gray-700 mb-2">
                            Nama Wali <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="nama_wali" name="nama_wali" 
                            value="{{ old('nama_wali', $calonSiswa->orangTua?->nama_wali) }}" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition @error('nama_wali') border-red-500 @enderror">
                        @error('nama_wali')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Pekerjaan Wali -->
                    <div>
                        <label for="pekerjaan_wali" class="block text-sm font-medium text-gray-700 mb-2">
                            Pekerjaan Wali <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="pekerjaan_wali" name="pekerjaan_wali" 
                            value="{{ old('pekerjaan_wali', $calonSiswa->orangTua?->pekerjaan_wali) }}" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition @error('pekerjaan_wali') border-red-500 @enderror">
                        @error('pekerjaan_wali')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- No HP Wali -->
                    <div>
                        <label for="no_hp_wali" class="block text-sm font-medium text-gray-700 mb-2">
                            No. HP Wali <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="no_hp_wali" name="no_hp_wali" 
                            value="{{ old('no_hp_wali', $calonSiswa->orangTua?->no_hp_wali) }}" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition @error('no_hp_wali') border-red-500 @enderror">
                        @error('no_hp_wali')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Hubungan Wali -->
                    <div>
                        <label for="hubungan_wali" class="block text-sm font-medium text-gray-700 mb-2">
                            Hubungan dengan Wali <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="hubungan_wali" name="hubungan_wali" 
                            value="{{ old('hubungan_wali', $calonSiswa->orangTua?->hubungan_wali) }}" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition @error('hubungan_wali') border-red-500 @enderror">
                        @error('hubungan_wali')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
            @endif

            <!-- Switch ke Orang Tua - Hanya muncul jika jenis = wali -->
            @if($jenis === 'wali')
            <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl shadow-sm border border-blue-100 overflow-hidden">
                <div class="p-6">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                        <div class="flex items-start gap-3">
                            <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900">Ingin menggunakan data Orang Tua?</h3>
                                <p class="text-sm text-gray-600 mt-1">Anda dapat mengubah data wali menjadi data orang tua (Ayah & Ibu)</p>
                            </div>
                        </div>
                        <button type="button" onclick="document.getElementById('formSwitchOrtu').classList.toggle('hidden')" 
                            class="px-4 py-2 bg-blue-600 text-white rounded-lg font-medium hover:bg-blue-700 transition text-sm whitespace-nowrap">
                            + Tambah Data Orang Tua
                        </button>
                    </div>

                    <!-- Form Data Orang Tua (Hidden by default) -->
                    <div id="formSwitchOrtu" class="hidden mt-6 pt-6 border-t border-blue-200">
                        <div class="bg-white rounded-xl p-6 border border-blue-100">
                            <h4 class="font-medium text-gray-900 mb-4 flex items-center gap-2">
                                <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                Data Orang Tua Baru
                            </h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Nama Ayah -->
                                <div>
                                    <label for="nama_ayah" class="block text-sm font-medium text-gray-700 mb-2">
                                        Nama Ayah <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" id="nama_ayah" name="nama_ayah" 
                                        value="{{ old('nama_ayah') }}"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition @error('nama_ayah') border-red-500 @enderror">
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
                                        value="{{ old('nama_ibu') }}"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition @error('nama_ibu') border-red-500 @enderror">
                                    @error('nama_ibu')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Pekerjaan Ayah -->
                                <div>
                                    <label for="pekerjaan_ayah" class="block text-sm font-medium text-gray-700 mb-2">
                                        Pekerjaan Ayah <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" id="pekerjaan_ayah" name="pekerjaan_ayah" 
                                        value="{{ old('pekerjaan_ayah') }}"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition @error('pekerjaan_ayah') border-red-500 @enderror">
                                    @error('pekerjaan_ayah')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Pekerjaan Ibu -->
                                <div>
                                    <label for="pekerjaan_ibu" class="block text-sm font-medium text-gray-700 mb-2">
                                        Pekerjaan Ibu <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" id="pekerjaan_ibu" name="pekerjaan_ibu" 
                                        value="{{ old('pekerjaan_ibu') }}"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition @error('pekerjaan_ibu') border-red-500 @enderror">
                                    @error('pekerjaan_ibu')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- No WA Ortu -->
                                <div class="md:col-span-2">
                                    <label for="no_wa_ortu" class="block text-sm font-medium text-gray-700 mb-2">
                                        No. WhatsApp Orang Tua <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" id="no_wa_ortu" name="no_wa_ortu" 
                                        value="{{ old('no_wa_ortu') }}"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition @error('no_wa_ortu') border-red-500 @enderror">
                                    @error('no_wa_ortu')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <input type="hidden" name="switch_to_ortu" value="1">
                            <div class="mt-4 p-3 bg-yellow-50 rounded-lg border border-yellow-200">
                                <p class="text-xs text-yellow-700 flex items-start gap-2">
                                    <svg class="w-4 h-4 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    <span>Dengan mengisi data di atas, data wali akan diganti dengan data orang tua.</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <!-- Submit Button -->
            <div class="flex justify-end gap-4">
                <a href="{{ route('spmb.profil') }}" 
                    class="px-6 py-3 border border-gray-300 text-gray-700 rounded-xl font-semibold hover:bg-gray-50 transition">
                    Batal
                </a>
                <button type="submit" 
                    class="px-6 py-3 bg-primary text-white rounded-xl font-semibold hover:bg-primary/90 transition shadow-lg shadow-primary/25">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection