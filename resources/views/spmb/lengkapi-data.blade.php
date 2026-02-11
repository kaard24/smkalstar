@extends('layouts.app')

@section('title', 'Lengkapi Data - SMK Al-Hidayah Lestari')

@section('content')
<div class="min-h-screen bg-gray-50 py-8" x-data="{
    step: 1,
    totalSteps: 2,
    isLoading: false,
    jenis: '{{ old('jenis', $siswa->orangTua?->jenis ?? 'orang_tua') }}',
    nextStep() {
        // Validasi step 1 sebelum lanjut
        const step1Form = document.getElementById('step1-fields');
        const requiredFields = step1Form.querySelectorAll('[required]');
        let isValid = true;
        
        requiredFields.forEach(field => {
            if (!field.value.trim()) {
                isValid = false;
                field.classList.add('border-red-500');
                field.classList.remove('border-gray-200');
            } else {
                field.classList.remove('border-red-500');
                field.classList.add('border-gray-200');
            }
        });
        
        if (!isValid) {
            // Scroll ke field pertama yang error
            const firstError = step1Form.querySelector('.border-red-500');
            if (firstError) {
                firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
                firstError.focus();
            }
            return;
        }
        
        if (this.step < this.totalSteps) {
            this.step++;
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }
    },
    prevStep() {
        if (this.step > 1) {
            this.step--;
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }
    }
}">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8 text-center sm:text-left">
            <h1 class="text-2xl sm:text-3xl font-bold text-gray-900">Lengkapi Data Pendaftaran</h1>
            <p class="text-gray-600 mt-2">Silakan lengkapi data yang masih diperlukan untuk melanjutkan proses pendaftaran.</p>
        </div>

        <!-- Progress Steps -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-4 flex-1">
                    <!-- Step 1 -->
                    <div class="flex items-center gap-3 flex-1" :class="step >= 1 ? 'opacity-100' : 'opacity-50'">
                        <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-full flex items-center justify-center font-bold transition-all duration-300 flex-shrink-0" 
                             :class="step >= 1 ? 'bg-primary text-white shadow-lg shadow-primary/30' : 'bg-gray-200 text-gray-500'">1</div>
                        <div class="hidden sm:block">
                            <p class="font-semibold text-sm" :class="step >= 1 ? 'text-gray-900' : 'text-gray-500'">Data Diri</p>
                            <p class="text-xs text-gray-500">Informasi pribadi</p>
                        </div>
                    </div>
                    <div class="flex-1 h-1.5 mx-2 sm:mx-4 rounded-full transition-all duration-300" 
                         :class="step >= 2 ? 'bg-primary' : 'bg-gray-200'"></div>
                    <!-- Step 2 -->
                    <div class="flex items-center gap-3 flex-1" :class="step >= 2 ? 'opacity-100' : 'opacity-50'">
                        <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-full flex items-center justify-center font-bold transition-all duration-300 flex-shrink-0" 
                             :class="step >= 2 ? 'bg-primary text-white shadow-lg shadow-primary/30' : 'bg-gray-200 text-gray-500'">2</div>
                        <div class="hidden sm:block">
                            <p class="font-semibold text-sm" :class="step >= 2 ? 'text-gray-900' : 'text-gray-500'">Orang Tua/Wali</p>
                            <p class="text-xs text-gray-500">Data keluarga</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if(session('error'))
        <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl flex items-start gap-3">
            <svg class="w-5 h-5 text-red-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <p class="text-red-700 text-sm">{{ session('error') }}</p>
        </div>
        @endif

        @if($errors->any())
        <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl">
            <ul class="text-red-700 text-sm space-y-1">
                @foreach($errors->all() as $error)
                <li class="flex items-center gap-2">
                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01"/></svg>
                    {{ $error }}
                </li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('spmb.lengkapi-data.store') }}" method="POST" @submit.prevent="isLoading = true; $el.submit();" novalidate>
            @csrf

            <!-- Step 1: Data Diri -->
            <div x-show="step === 1" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-x-4" x-transition:enter-end="opacity-100 translate-x-0">
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden mb-6">
                    <div class="px-6 py-5 border-b border-gray-200 bg-gradient-to-r from-amber-50 to-orange-50">
                        <h2 class="font-bold text-lg text-gray-900 flex items-center gap-3">
                            <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            Data Diri Calon Siswa
                        </h2>
                        <p class="text-sm text-gray-600 mt-1">Lengkapi informasi pribadi Anda dengan data yang valid</p>
                    </div>
                    <div class="p-6 space-y-6" id="step1-fields">
                        <!-- Baris 1: NIK dan No KK -->
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
                                        value="{{ old('nik', $siswa->nik) }}" required
                                        placeholder="16 digit NIK"
                                        pattern="[0-9]{16}"
                                        title="NIK harus 16 digit angka"
                                        oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                        class="w-full pl-12 pr-4 py-3.5 bg-gray-50 border-2 border-gray-200 rounded-xl focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all @error('nik') border-red-500 @enderror">
                                </div>
                                @error('nik')
                                <p class="text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- No KK -->
                            <div class="space-y-2">
                                <label for="no_kk" class="block text-sm font-semibold text-gray-700">
                                    Nomor Kartu Keluarga <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                                        </svg>
                                    </div>
                                    <input type="text" id="no_kk" name="no_kk" maxlength="16"
                                        value="{{ old('no_kk', $siswa->no_kk) }}" required
                                        placeholder="16 digit Nomor KK"
                                        pattern="[0-9]{16}"
                                        title="Nomor KK harus 16 digit angka"
                                        oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                        class="w-full pl-12 pr-4 py-3.5 bg-gray-50 border-2 border-gray-200 rounded-xl focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all @error('no_kk') border-red-500 @enderror">
                                </div>
                                @error('no_kk')
                                <p class="text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Baris 2: Jenis Kelamin -->
                        <div class="space-y-3">
                            <label class="block text-sm font-semibold text-gray-700">
                                Jenis Kelamin <span class="text-red-500">*</span>
                            </label>
                            <div class="flex flex-wrap gap-6">
                                <label class="flex items-center gap-3 cursor-pointer group bg-gray-50 px-5 py-3 rounded-xl border-2 border-gray-200 hover:border-primary/50 transition">
                                    <input type="radio" name="jk" value="L" {{ old('jk', $siswa->jk) === 'L' ? 'checked' : '' }} required
                                        class="w-5 h-5 text-primary border-gray-300 focus:ring-primary cursor-pointer">
                                    <span class="text-gray-700 font-medium group-hover:text-gray-900 transition">Laki-laki</span>
                                </label>
                                <label class="flex items-center gap-3 cursor-pointer group bg-gray-50 px-5 py-3 rounded-xl border-2 border-gray-200 hover:border-primary/50 transition">
                                    <input type="radio" name="jk" value="P" {{ old('jk', $siswa->jk) === 'P' ? 'checked' : '' }} required
                                        class="w-5 h-5 text-primary border-gray-300 focus:ring-primary cursor-pointer">
                                    <span class="text-gray-700 font-medium group-hover:text-gray-900 transition">Perempuan</span>
                                </label>
                            </div>
                            @error('jk')
                            <p class="text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Baris 3: Alamat -->
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
                                    minlength="10"
                                    maxlength="255"
                                    pattern="^[a-zA-Z0-9\s.,\-\/\(\)]+$"
                                    title="Alamat hanya boleh mengandung huruf, angka, spasi, dan karakter . , - / ( )"
                                    oninput="this.value = this.value.replace(/[^a-zA-Z0-9\s.,\-\/\(\)]/g, '')"
                                    class="w-full pl-12 pr-4 py-3.5 bg-gray-50 border-2 border-gray-200 rounded-xl focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all @error('alamat') border-red-500 @enderror">{{ old('alamat', $siswa->alamat) }}</textarea>
                            </div>
                            @error('alamat')
                            <p class="text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Baris 4: Data Sekolah -->
                        <div class="bg-blue-50/50 rounded-xl p-5 border border-blue-100">
                            <h3 class="text-sm font-bold text-gray-900 mb-4 flex items-center gap-2">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                </svg>
                                Data Sekolah Asal
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Alamat Sekolah -->
                                <div class="md:col-span-2 space-y-2">
                                    <label for="alamat_sekolah" class="block text-sm font-semibold text-gray-700">
                                        Alamat Sekolah Asal <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <div class="absolute top-3.5 left-4 pointer-events-none">
                                            <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                            </svg>
                                        </div>
                                        <textarea id="alamat_sekolah" name="alamat_sekolah" rows="3" required
                                            placeholder="Masukkan alamat lengkap sekolah asal"
                                            minlength="10"
                                            maxlength="255"
                                            pattern="^[a-zA-Z0-9\s.,\-\/\(\)]+$"
                                            title="Alamat sekolah hanya boleh mengandung huruf, angka, spasi, dan karakter . , - / ( )"
                                            oninput="this.value = this.value.replace(/[^a-zA-Z0-9\s.,\-\/\(\)]/g, '')"
                                            class="w-full pl-12 pr-4 py-3.5 bg-white border-2 border-gray-200 rounded-xl focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all @error('alamat_sekolah') border-red-500 @enderror">{{ old('alamat_sekolah', $siswa->alamat_sekolah) }}</textarea>
                                    </div>
                                    @error('alamat_sekolah')
                                    <p class="text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- NPSN Sekolah -->
                                <div class="space-y-2">
                                    <label for="npsn" class="block text-sm font-semibold text-gray-700">
                                        NPSN Sekolah Asal <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                            <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0"/>
                                            </svg>
                                        </div>
                                        <input type="text" id="npsn" name="npsn" maxlength="8"
                                            value="{{ old('npsn', $siswa->npsn_sekolah) }}" required
                                            placeholder="8 digit NPSN"
                                            pattern="[0-9]{8}"
                                            title="NPSN harus 8 digit angka"
                                            oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                            class="w-full pl-12 pr-4 py-3.5 bg-white border-2 border-gray-200 rounded-xl focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all @error('npsn') border-red-500 @enderror">
                                    </div>
                                    @error('npsn')
                                    <p class="text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Baris 5: Agama dan Golongan Darah -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
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
                                        class="w-full pl-12 pr-10 py-3.5 bg-gray-50 border-2 border-gray-200 rounded-xl focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all appearance-none cursor-pointer @error('agama') border-red-500 @enderror">
                                        <option value="">-- Pilih Agama --</option>
                                        <option value="Islam" {{ old('agama', $siswa->agama) === 'Islam' ? 'selected' : '' }}>Islam</option>
                                        <option value="Kristen" {{ old('agama', $siswa->agama) === 'Kristen' ? 'selected' : '' }}>Kristen</option>
                                        <option value="Katolik" {{ old('agama', $siswa->agama) === 'Katolik' ? 'selected' : '' }}>Katolik</option>
                                        <option value="Hindu" {{ old('agama', $siswa->agama) === 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                        <option value="Buddha" {{ old('agama', $siswa->agama) === 'Buddha' ? 'selected' : '' }}>Buddha</option>
                                        <option value="Konghucu" {{ old('agama', $siswa->agama) === 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
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
                                        class="w-full pl-12 pr-10 py-3.5 bg-gray-50 border-2 border-gray-200 rounded-xl focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all appearance-none cursor-pointer @error('golongan_darah') border-red-500 @enderror">
                                        <option value="">-- Pilih Golongan Darah --</option>
                                        <option value="A" {{ old('golongan_darah', $siswa->golongan_darah) === 'A' ? 'selected' : '' }}>A</option>
                                        <option value="B" {{ old('golongan_darah', $siswa->golongan_darah) === 'B' ? 'selected' : '' }}>B</option>
                                        <option value="AB" {{ old('golongan_darah', $siswa->golongan_darah) === 'AB' ? 'selected' : '' }}>AB</option>
                                        <option value="O" {{ old('golongan_darah', $siswa->golongan_darah) === 'O' ? 'selected' : '' }}>O</option>
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
                        </div>

                        <!-- Baris 6: Data Keluarga -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
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
                                        value="{{ old('anak_ke', $siswa->anak_ke) }}" required
                                        placeholder="Contoh: 1"
                                        title="Anak ke hanya boleh diisi angka 1-10"
                                        class="w-full pl-12 pr-4 py-3.5 bg-gray-50 border-2 border-gray-200 rounded-xl focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all @error('anak_ke') border-red-500 @enderror">
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
                                        value="{{ old('jumlah_saudara', $siswa->jumlah_saudara) }}" required
                                        placeholder="Contoh: 2"
                                        title="Jumlah saudara hanya boleh diisi angka 0-10"
                                        class="w-full pl-12 pr-4 py-3.5 bg-gray-50 border-2 border-gray-200 rounded-xl focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all @error('jumlah_saudara') border-red-500 @enderror">
                                </div>
                                @error('jumlah_saudara')
                                <p class="text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Baris 7: Fisik -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Tinggi Badan -->
                            <div class="space-y-2">
                                <label for="tinggi_badan" class="block text-sm font-semibold text-gray-700">
                                    Tinggi Badan (cm) <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
                                        </svg>
                                    </div>
                                    <input type="number" id="tinggi_badan" name="tinggi_badan" min="100" max="200"
                                        value="{{ old('tinggi_badan', $siswa->tinggi_badan) }}" required
                                        placeholder="Contoh: 165"
                                        title="Tinggi badan harus antara 100-200 cm"
                                        class="w-full pl-12 pr-4 py-3.5 bg-gray-50 border-2 border-gray-200 rounded-xl focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all @error('tinggi_badan') border-red-500 @enderror">
                                </div>
                                @error('tinggi_badan')
                                <p class="text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Berat Badan -->
                            <div class="space-y-2">
                                <label for="berat_badan" class="block text-sm font-semibold text-gray-700">
                                    Berat Badan (kg) <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"/>
                                        </svg>
                                    </div>
                                    <input type="number" id="berat_badan" name="berat_badan" min="20" max="120"
                                        value="{{ old('berat_badan', $siswa->berat_badan) }}" required
                                        placeholder="Contoh: 55"
                                        title="Berat badan harus antara 20-120 kg"
                                        class="w-full pl-12 pr-4 py-3.5 bg-gray-50 border-2 border-gray-200 rounded-xl focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all @error('berat_badan') border-red-500 @enderror">
                                </div>
                                @error('berat_badan')
                                <p class="text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Baris 8: Riwayat Penyakit -->
                        <div class="space-y-2">
                            <label for="riwayat_penyakit" class="block text-sm font-semibold text-gray-700">
                                Riwayat Penyakit yang Diderita
                            </label>
                            <div class="relative">
                                <div class="absolute top-3.5 left-4 pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                    </svg>
                                </div>
                                <textarea id="riwayat_penyakit" name="riwayat_penyakit" rows="2"
                                    placeholder="Isi jika pernah menderita penyakit serius, kosongkan jika tidak ada"
                                    maxlength="500"
                                    pattern="^[a-zA-Z0-9\s,\.\-\/\(\)]*$"
                                    title="Riwayat penyakit hanya boleh mengandung huruf, angka, spasi, dan karakter , . - / ( )"
                                    oninput="this.value = this.value.replace(/[^a-zA-Z0-9\s,\.\-\/\(\)]/g, '')"
                                    class="w-full pl-12 pr-4 py-3.5 bg-gray-50 border-2 border-gray-200 rounded-xl focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all @error('riwayat_penyakit') border-red-500 @enderror">{{ old('riwayat_penyakit', $siswa->riwayat_penyakit) }}</textarea>
                            </div>
                            <p class="text-xs text-gray-500">Kosongkan jika tidak ada riwayat penyakit</p>
                            @error('riwayat_penyakit')
                            <p class="text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Navigation Buttons Step 1 -->
                <div class="flex flex-col sm:flex-row justify-end gap-4">
                    <a href="{{ route('spmb.dashboard') }}" 
                        class="px-6 py-3.5 border-2 border-gray-300 text-gray-700 rounded-xl font-semibold hover:bg-gray-50 hover:border-gray-400 transition text-center">
                        Batal
                    </a>
                    <button type="button" @click="nextStep()" 
                        class="px-6 py-3.5 bg-gradient-to-r from-primary to-blue-600 text-white rounded-xl font-semibold hover:shadow-lg hover:shadow-primary/30 transition flex items-center justify-center gap-2">
                        Lanjutkan
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Step 2: Data Orang Tua / Wali -->
            <div x-show="step === 2" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 -translate-x-4" x-transition:enter-end="opacity-100 translate-x-0" style="display: none;">
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden mb-6">
                    <div class="px-6 py-5 border-b border-gray-200 bg-gradient-to-r from-primary/10 to-blue-100">
                        <h2 class="font-bold text-lg text-gray-900 flex items-center gap-3">
                            <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                            Data Orang Tua / Wali
                        </h2>
                        <p class="text-sm text-gray-600 mt-1">Pilih dan lengkapi data keluarga Anda</p>
                    </div>
                    <div class="p-6 space-y-8">
                        <!-- Pilihan Jenis -->
                        <div class="bg-gray-50 rounded-xl p-5 border border-gray-200">
                            <label class="block text-sm font-bold text-gray-900 mb-4">
                                Pilih Jenis <span class="text-red-500">*</span>
                            </label>
                            <div class="flex flex-wrap gap-4">
                                <label class="flex items-center gap-3 cursor-pointer bg-white px-5 py-4 rounded-xl border-2 transition-all flex-1 min-w-[140px]"
                                    :class="jenis === 'orang_tua' ? 'border-primary ring-2 ring-primary/20' : 'border-gray-200 hover:border-primary/50'">
                                    <input type="radio" name="jenis" value="orang_tua" x-model="jenis" required
                                        class="w-5 h-5 text-primary border-gray-300 focus:ring-primary cursor-pointer">
                                    <div>
                                        <span class="text-gray-900 font-semibold block">Orang Tua</span>
                                        <span class="text-xs text-gray-500">Ayah & Ibu kandung</span>
                                    </div>
                                </label>
                                <label class="flex items-center gap-3 cursor-pointer bg-white px-5 py-4 rounded-xl border-2 transition-all flex-1 min-w-[140px]"
                                    :class="jenis === 'wali' ? 'border-primary ring-2 ring-primary/20' : 'border-gray-200 hover:border-primary/50'">
                                    <input type="radio" name="jenis" value="wali" x-model="jenis" required
                                        class="w-5 h-5 text-primary border-gray-300 focus:ring-primary cursor-pointer">
                                    <div>
                                        <span class="text-gray-900 font-semibold block">Wali</span>
                                        <span class="text-xs text-gray-500">Keluarga/kerabat lain</span>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <!-- Form Orang Tua -->
                        <div x-show="jenis === 'orang_tua'" x-transition class="space-y-8">
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
                                                value="{{ old('nama_ayah', $siswa->orangTua?->nama_ayah) }}"
                                                x-bind:required="jenis === 'orang_tua'"
                                                placeholder="Nama lengkap ayah"
                                                class="w-full pl-12 pr-4 py-3.5 bg-white border-2 border-gray-200 rounded-xl focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all @error('nama_ayah') border-red-500 @enderror">
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
                                                value="{{ old('nik_ayah', $siswa->orangTua?->nik_ayah) }}"
                                                placeholder="16 digit NIK"
                                                pattern="[0-9]{16}"
                                                title="NIK ayah harus 16 digit angka"
                                                oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                                x-bind:required="jenis === 'orang_tua'"
                                                class="w-full pl-12 pr-4 py-3.5 bg-white border-2 border-gray-200 rounded-xl focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all @error('nik_ayah') border-red-500 @enderror">
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
                                                    {{ old('status_ayah', $siswa->orangTua?->status_ayah ?? 'hidup') === 'hidup' ? 'checked' : '' }}
                                                    class="w-5 h-5 text-primary border-gray-300 focus:ring-primary cursor-pointer">
                                                <span class="text-gray-700">Masih Hidup</span>
                                            </label>
                                            <label class="flex items-center gap-2 cursor-pointer">
                                                <input type="radio" name="status_ayah" value="meninggal" 
                                                    {{ old('status_ayah', $siswa->orangTua?->status_ayah) === 'meninggal' ? 'checked' : '' }}
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
                                                value="{{ old('pekerjaan_ayah', $siswa->orangTua?->pekerjaan_ayah) }}"
                                                placeholder="Contoh: Wiraswasta, PNS, Petani"
                                                x-bind:required="jenis === 'orang_tua'"
                                                class="w-full pl-12 pr-4 py-3.5 bg-white border-2 border-gray-200 rounded-xl focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all @error('pekerjaan_ayah') border-red-500 @enderror">
                                        </div>
                                        @error('pekerjaan_ayah')
                                        <p class="text-sm text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Pendidikan Ayah -->
                                    <div class="space-y-2">
                                        <label for="pendidikan_ayah" class="block text-sm font-semibold text-gray-700">
                                            Pendidikan Terakhir Ayah <span class="text-red-500">*</span>
                                        </label>
                                        <div class="relative">
                                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                                <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"/>
                                                </svg>
                                            </div>
                                            <select id="pendidikan_ayah" name="pendidikan_ayah" 
                                                x-bind:required="jenis === 'orang_tua'"
                                                class="w-full pl-12 pr-10 py-3.5 bg-white border-2 border-gray-200 rounded-xl focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all appearance-none cursor-pointer @error('pendidikan_ayah') border-red-500 @enderror">
                                                <option value="">-- Pilih Pendidikan --</option>
                                                <option value="Tidak Sekolah" {{ old('pendidikan_ayah', $siswa->orangTua?->pendidikan_ayah) === 'Tidak Sekolah' ? 'selected' : '' }}>Tidak Sekolah</option>
                                                <option value="SD" {{ old('pendidikan_ayah', $siswa->orangTua?->pendidikan_ayah) === 'SD' ? 'selected' : '' }}>SD</option>
                                                <option value="SMP" {{ old('pendidikan_ayah', $siswa->orangTua?->pendidikan_ayah) === 'SMP' ? 'selected' : '' }}>SMP</option>
                                                <option value="SMA" {{ old('pendidikan_ayah', $siswa->orangTua?->pendidikan_ayah) === 'SMA' ? 'selected' : '' }}>SMA/SMK</option>
                                                <option value="D1" {{ old('pendidikan_ayah', $siswa->orangTua?->pendidikan_ayah) === 'D1' ? 'selected' : '' }}>D1</option>
                                                <option value="D2" {{ old('pendidikan_ayah', $siswa->orangTua?->pendidikan_ayah) === 'D2' ? 'selected' : '' }}>D2</option>
                                                <option value="D3" {{ old('pendidikan_ayah', $siswa->orangTua?->pendidikan_ayah) === 'D3' ? 'selected' : '' }}>D3</option>
                                                <option value="S1" {{ old('pendidikan_ayah', $siswa->orangTua?->pendidikan_ayah) === 'S1' ? 'selected' : '' }}>S1</option>
                                                <option value="S2" {{ old('pendidikan_ayah', $siswa->orangTua?->pendidikan_ayah) === 'S2' ? 'selected' : '' }}>S2</option>
                                                <option value="S3" {{ old('pendidikan_ayah', $siswa->orangTua?->pendidikan_ayah) === 'S3' ? 'selected' : '' }}>S3</option>
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
                                            Penghasilan Ayah / Bulan <span class="text-red-500">*</span>
                                        </label>
                                        <div class="relative">
                                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                                <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a1 1 0 11-2 0 1 1 0 012 0z"/>
                                                </svg>
                                            </div>
                                            <select id="penghasilan_ayah" name="penghasilan_ayah" 
                                                x-bind:required="jenis === 'orang_tua'"
                                                class="w-full pl-12 pr-10 py-3.5 bg-white border-2 border-gray-200 rounded-xl focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all appearance-none cursor-pointer @error('penghasilan_ayah') border-red-500 @enderror">
                                                <option value="">-- Pilih Penghasilan --</option>
                                                <option value="<1jt" {{ old('penghasilan_ayah', $siswa->orangTua?->penghasilan_ayah) === '<1jt' ? 'selected' : '' }}>Kurang dari Rp 1.000.000</option>
                                                <option value="1jt-3jt" {{ old('penghasilan_ayah', $siswa->orangTua?->penghasilan_ayah) === '1jt-3jt' ? 'selected' : '' }}>Rp 1.000.000 - Rp 3.000.000</option>
                                                <option value="3jt-5jt" {{ old('penghasilan_ayah', $siswa->orangTua?->penghasilan_ayah) === '3jt-5jt' ? 'selected' : '' }}>Rp 3.000.000 - Rp 5.000.000</option>
                                                <option value="5jt-10jt" {{ old('penghasilan_ayah', $siswa->orangTua?->penghasilan_ayah) === '5jt-10jt' ? 'selected' : '' }}>Rp 5.000.000 - Rp 10.000.000</option>
                                                <option value=">10jt" {{ old('penghasilan_ayah', $siswa->orangTua?->penghasilan_ayah) === '>10jt' ? 'selected' : '' }}>Lebih dari Rp 10.000.000</option>
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
                                                value="{{ old('nama_ibu', $siswa->orangTua?->nama_ibu) }}"
                                                placeholder="Nama lengkap ibu"
                                                x-bind:required="jenis === 'orang_tua'"
                                                class="w-full pl-12 pr-4 py-3.5 bg-white border-2 border-gray-200 rounded-xl focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all @error('nama_ibu') border-red-500 @enderror">
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
                                                value="{{ old('nik_ibu', $siswa->orangTua?->nik_ibu) }}"
                                                placeholder="16 digit NIK"
                                                pattern="[0-9]{16}"
                                                title="NIK ibu harus 16 digit angka"
                                                oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                                x-bind:required="jenis === 'orang_tua'"
                                                class="w-full pl-12 pr-4 py-3.5 bg-white border-2 border-gray-200 rounded-xl focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all @error('nik_ibu') border-red-500 @enderror">
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
                                                    {{ old('status_ibu', $siswa->orangTua?->status_ibu ?? 'hidup') === 'hidup' ? 'checked' : '' }}
                                                    class="w-5 h-5 text-primary border-gray-300 focus:ring-primary cursor-pointer">
                                                <span class="text-gray-700">Masih Hidup</span>
                                            </label>
                                            <label class="flex items-center gap-2 cursor-pointer">
                                                <input type="radio" name="status_ibu" value="meninggal" 
                                                    {{ old('status_ibu', $siswa->orangTua?->status_ibu) === 'meninggal' ? 'checked' : '' }}
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
                                                value="{{ old('pekerjaan_ibu', $siswa->orangTua?->pekerjaan_ibu) }}"
                                                placeholder="Contoh: Ibu Rumah Tangga, Guru, Wiraswasta"
                                                x-bind:required="jenis === 'orang_tua'"
                                                class="w-full pl-12 pr-4 py-3.5 bg-white border-2 border-gray-200 rounded-xl focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all @error('pekerjaan_ibu') border-red-500 @enderror">
                                        </div>
                                        @error('pekerjaan_ibu')
                                        <p class="text-sm text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Pendidikan Ibu -->
                                    <div class="space-y-2">
                                        <label for="pendidikan_ibu" class="block text-sm font-semibold text-gray-700">
                                            Pendidikan Terakhir Ibu <span class="text-red-500">*</span>
                                        </label>
                                        <div class="relative">
                                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                                <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"/>
                                                </svg>
                                            </div>
                                            <select id="pendidikan_ibu" name="pendidikan_ibu" 
                                                x-bind:required="jenis === 'orang_tua'"
                                                class="w-full pl-12 pr-10 py-3.5 bg-white border-2 border-gray-200 rounded-xl focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all appearance-none cursor-pointer @error('pendidikan_ibu') border-red-500 @enderror">
                                                <option value="">-- Pilih Pendidikan --</option>
                                                <option value="Tidak Sekolah" {{ old('pendidikan_ibu', $siswa->orangTua?->pendidikan_ibu) === 'Tidak Sekolah' ? 'selected' : '' }}>Tidak Sekolah</option>
                                                <option value="SD" {{ old('pendidikan_ibu', $siswa->orangTua?->pendidikan_ibu) === 'SD' ? 'selected' : '' }}>SD</option>
                                                <option value="SMP" {{ old('pendidikan_ibu', $siswa->orangTua?->pendidikan_ibu) === 'SMP' ? 'selected' : '' }}>SMP</option>
                                                <option value="SMA" {{ old('pendidikan_ibu', $siswa->orangTua?->pendidikan_ibu) === 'SMA' ? 'selected' : '' }}>SMA/SMK</option>
                                                <option value="D1" {{ old('pendidikan_ibu', $siswa->orangTua?->pendidikan_ibu) === 'D1' ? 'selected' : '' }}>D1</option>
                                                <option value="D2" {{ old('pendidikan_ibu', $siswa->orangTua?->pendidikan_ibu) === 'D2' ? 'selected' : '' }}>D2</option>
                                                <option value="D3" {{ old('pendidikan_ibu', $siswa->orangTua?->pendidikan_ibu) === 'D3' ? 'selected' : '' }}>D3</option>
                                                <option value="S1" {{ old('pendidikan_ibu', $siswa->orangTua?->pendidikan_ibu) === 'S1' ? 'selected' : '' }}>S1</option>
                                                <option value="S2" {{ old('pendidikan_ibu', $siswa->orangTua?->pendidikan_ibu) === 'S2' ? 'selected' : '' }}>S2</option>
                                                <option value="S3" {{ old('pendidikan_ibu', $siswa->orangTua?->pendidikan_ibu) === 'S3' ? 'selected' : '' }}>S3</option>
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
                                            Penghasilan Ibu / Bulan <span class="text-red-500">*</span>
                                        </label>
                                        <div class="relative">
                                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                                <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a1 1 0 11-2 0 1 1 0 012 0z"/>
                                                </svg>
                                            </div>
                                            <select id="penghasilan_ibu" name="penghasilan_ibu" 
                                                x-bind:required="jenis === 'orang_tua'"
                                                class="w-full pl-12 pr-10 py-3.5 bg-white border-2 border-gray-200 rounded-xl focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all appearance-none cursor-pointer @error('penghasilan_ibu') border-red-500 @enderror">
                                                <option value="">-- Pilih Penghasilan --</option>
                                                <option value="<1jt" {{ old('penghasilan_ibu', $siswa->orangTua?->penghasilan_ibu) === '<1jt' ? 'selected' : '' }}>Kurang dari Rp 1.000.000</option>
                                                <option value="1jt-3jt" {{ old('penghasilan_ibu', $siswa->orangTua?->penghasilan_ibu) === '1jt-3jt' ? 'selected' : '' }}>Rp 1.000.000 - Rp 3.000.000</option>
                                                <option value="3jt-5jt" {{ old('penghasilan_ibu', $siswa->orangTua?->penghasilan_ibu) === '3jt-5jt' ? 'selected' : '' }}>Rp 3.000.000 - Rp 5.000.000</option>
                                                <option value="5jt-10jt" {{ old('penghasilan_ibu', $siswa->orangTua?->penghasilan_ibu) === '5jt-10jt' ? 'selected' : '' }}>Rp 5.000.000 - Rp 10.000.000</option>
                                                <option value=">10jt" {{ old('penghasilan_ibu', $siswa->orangTua?->penghasilan_ibu) === '>10jt' ? 'selected' : '' }}>Lebih dari Rp 10.000.000</option>
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
                            <div class="bg-gray-50 rounded-xl p-5 border border-gray-200" x-data="{
                                noWaOrtu: '{{ old('no_wa_ortu', $siswa->orangTua?->no_wa_ortu) }}',
                                isValid: null,
                                formatWA(value) {
                                    let cleaned = value.replace(/\D/g, '');
                                    if (cleaned.startsWith('0')) {
                                        cleaned = '62' + cleaned.substring(1);
                                    } else if (!cleaned.startsWith('62') && cleaned.startsWith('8')) {
                                        cleaned = '62' + cleaned;
                                    }
                                    return cleaned;
                                },
                                validateWA(value) {
                                    const formatted = this.formatWA(value);
                                    this.noWaOrtu = formatted;
                                    const regex = /^62[0-9]{9,12}$/;
                                    this.isValid = regex.test(formatted);
                                }
                            }">
                                <label for="no_wa_ortu" class="block text-sm font-semibold text-gray-700 mb-3">
                                    No. WhatsApp Orang Tua <span class="text-red-500">*</span>
                                </label>
                                <div class="relative max-w-md">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                        </svg>
                                    </div>
                                    <input type="tel" id="no_wa_ortu" name="no_wa_ortu" 
                                        x-model="noWaOrtu"
                                        @input="validateWA($event.target.value)"
                                        @blur="validateWA($event.target.value)"
                                        placeholder="6281234567890"
                                        x-bind:required="jenis === 'orang_tua'"
                                        :class="{
                                            'w-full pl-12 pr-10 py-3.5 border-2 rounded-xl focus:bg-white focus:ring-4 transition-all': true,
                                            'border-gray-200 focus:border-primary focus:ring-primary/10 bg-white': isValid === null || noWaOrtu === '',
                                            'border-emerald-500 focus:border-emerald-500 focus:ring-emerald-500/10 bg-emerald-50': isValid === true && noWaOrtu !== '',
                                            'border-red-500 focus:border-red-500 focus:ring-red-500/10 bg-red-50': isValid === false && noWaOrtu !== ''
                                        }">
                                    <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                                        <svg x-show="isValid === true && noWaOrtu !== ''" class="h-5 w-5 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                        </svg>
                                        <svg x-show="isValid === false && noWaOrtu !== ''" class="h-5 w-5 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                        </svg>
                                    </div>
                                </div>
                                <p class="mt-2 text-xs" :class="{
                                    'text-gray-500': isValid === null || noWaOrtu === '',
                                    'text-emerald-600': isValid === true && noWaOrtu !== '',
                                    'text-red-600': isValid === false && noWaOrtu !== ''
                                }">
                                    <span x-text="isValid === false && noWaOrtu !== '' ? 'Format salah. Contoh: 628123456789' : 'Format: 62xxxxxxxxxx (11-14 digit)'"></span>
                                </p>
                            </div>
                        </div>

                        <!-- Form Wali -->
                        <div x-show="jenis === 'wali'" x-transition style="display: none;" class="space-y-6">
                            <div class="bg-amber-50/50 rounded-xl p-5 border border-amber-100">
                                <h3 class="text-sm font-bold text-gray-900 mb-4 flex items-center gap-2">
                                    <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                    Data Wali
                                </h3>
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
                                                value="{{ old('nama_wali', $siswa->orangTua?->nama_wali) }}"
                                                placeholder="Nama lengkap wali"
                                                x-bind:required="jenis === 'wali'"
                                                class="w-full pl-12 pr-4 py-3.5 bg-white border-2 border-gray-200 rounded-xl focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all @error('nama_wali') border-red-500 @enderror">
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
                                                value="{{ old('pekerjaan_wali', $siswa->orangTua?->pekerjaan_wali) }}"
                                                placeholder="Contoh: Wiraswasta, PNS, Petani"
                                                x-bind:required="jenis === 'wali'"
                                                class="w-full pl-12 pr-4 py-3.5 bg-white border-2 border-gray-200 rounded-xl focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all @error('pekerjaan_wali') border-red-500 @enderror">
                                        </div>
                                        @error('pekerjaan_wali')
                                        <p class="text-sm text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- No HP Wali -->
                                    <div class="space-y-2" x-data="{
                                        noHpWali: '{{ old('no_hp_wali', $siswa->orangTua?->no_hp_wali) }}',
                                        isValid: null,
                                        formatWA(value) {
                                            let cleaned = value.replace(/\D/g, '');
                                            if (cleaned.startsWith('0')) {
                                                cleaned = '62' + cleaned.substring(1);
                                            } else if (!cleaned.startsWith('62') && cleaned.startsWith('8')) {
                                                cleaned = '62' + cleaned;
                                            }
                                            return cleaned;
                                        },
                                        validateWA(value) {
                                            const formatted = this.formatWA(value);
                                            this.noHpWali = formatted;
                                            const regex = /^62[0-9]{9,12}$/;
                                            this.isValid = regex.test(formatted);
                                        }
                                    }">
                                        <label for="no_hp_wali" class="block text-sm font-semibold text-gray-700">
                                            No. HP Wali <span class="text-red-500">*</span>
                                        </label>
                                        <div class="relative">
                                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                                <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                                </svg>
                                            </div>
                                            <input type="tel" id="no_hp_wali" name="no_hp_wali" 
                                                x-model="noHpWali"
                                                @input="validateWA($event.target.value)"
                                                @blur="validateWA($event.target.value)"
                                                placeholder="6281234567890"
                                                x-bind:required="jenis === 'wali'"
                                                :class="{
                                                    'w-full pl-12 pr-10 py-3.5 border-2 rounded-xl focus:bg-white focus:ring-4 transition-all': true,
                                                    'border-gray-200 focus:border-primary focus:ring-primary/10 bg-white': isValid === null || noHpWali === '',
                                                    'border-emerald-500 focus:border-emerald-500 focus:ring-emerald-500/10 bg-emerald-50': isValid === true && noHpWali !== '',
                                                    'border-red-500 focus:border-red-500 focus:ring-red-500/10 bg-red-50': isValid === false && noHpWali !== ''
                                                }">
                                            <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                                                <svg x-show="isValid === true && noHpWali !== ''" class="h-5 w-5 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                                </svg>
                                                <svg x-show="isValid === false && noHpWali !== ''" class="h-5 w-5 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                                </svg>
                                            </div>
                                        </div>
                                        <p class="mt-1 text-xs" :class="{
                                            'text-gray-500': isValid === null || noHpWali === '',
                                            'text-emerald-600': isValid === true && noHpWali !== '',
                                            'text-red-600': isValid === false && noHpWali !== ''
                                        }">
                                            <span x-text="isValid === false && noHpWali !== '' ? 'Format salah. Contoh: 628123456789' : 'Format: 62xxxxxxxxxx (11-14 digit)'"></span>
                                        </p>
                                        @error('no_hp_wali')
                                        <p class="text-sm text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Hubungan dengan Wali -->
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
                                                value="{{ old('hubungan_wali', $siswa->orangTua?->hubungan_wali) }}"
                                                placeholder="Contoh: Paman, Bibi, Kakek, Nenek"
                                                x-bind:required="jenis === 'wali'"
                                                class="w-full pl-12 pr-4 py-3.5 bg-white border-2 border-gray-200 rounded-xl focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all @error('hubungan_wali') border-red-500 @enderror">
                                        </div>
                                        @error('hubungan_wali')
                                        <p class="text-sm text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Navigation Buttons Step 2 -->
                <div class="flex flex-col sm:flex-row justify-between gap-4">
                    <button type="button" @click="prevStep()" 
                        class="px-6 py-3.5 border-2 border-gray-300 text-gray-700 rounded-xl font-semibold hover:bg-gray-50 hover:border-gray-400 transition flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        Kembali
                    </button>
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="{{ route('spmb.dashboard') }}" 
                            class="px-6 py-3.5 border-2 border-gray-300 text-gray-700 rounded-xl font-semibold hover:bg-gray-50 hover:border-gray-400 transition text-center">
                            Batal
                        </a>
                        <button type="submit" 
                            class="px-8 py-3.5 bg-gradient-to-r from-primary to-blue-600 text-white rounded-xl font-semibold hover:shadow-lg hover:shadow-primary/30 transition flex items-center justify-center gap-2 disabled:opacity-70 disabled:cursor-not-allowed"
                            :disabled="isLoading">
                            <svg x-show="isLoading" class="w-5 h-5 animate-spin" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            <span x-text="isLoading ? 'Menyimpan...' : 'Simpan Data'"></span>
                            <svg x-show="!isLoading" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- Auto-save Notification Toast --}}
<div id="autosave-toast" class="fixed bottom-4 right-4 z-50 transform translate-y-20 opacity-0 transition-all duration-300" style="display: none;">
    <div class="bg-gray-800 text-white px-4 py-3 rounded-xl shadow-lg flex items-center gap-3">
        <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
        </svg>
        <div>
            <p class="text-sm font-medium">Data tersimpan otomatis</p>
            <p class="text-xs text-gray-400" id="autosave-time">Terakhir disimpan: -</p>
        </div>
    </div>
</div>

{{-- Restore Confirmation Modal --}}
<div id="restore-modal" class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm" style="display: none;">
    <div class="bg-white rounded-2xl p-6 max-w-md mx-4 shadow-2xl">
        <div class="flex items-center gap-3 mb-4">
            <div class="w-12 h-12 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <div>
                <h3 class="text-lg font-bold text-gray-900">Pulihkan Data?</h3>
                <p class="text-sm text-gray-500">Ada data yang belum tersimpan</p>
            </div>
        </div>
        <p class="text-gray-600 mb-6">Kami menemukan data formulir yang tersimpan secara otomatis. Apakah Anda ingin memulihkan data tersebut?</p>
        <div class="flex gap-3">
            <button onclick="clearSavedData()" class="flex-1 px-4 py-2.5 border border-gray-200 text-gray-700 rounded-xl font-medium hover:bg-gray-50 transition">
                Hapus Data
            </button>
            <button onclick="restoreFormData()" class="flex-1 px-4 py-2.5 bg-primary text-white rounded-xl font-medium hover:bg-primary/90 transition">
                Pulihkan
            </button>
        </div>
    </div>
</div>

@push('scripts')
<script>
(function() {
    'use strict';
    
    const STORAGE_KEY = 'spmb_form_data_lengkapi';
    const TIMESTAMP_KEY = 'spmb_form_timestamp';
    const SAVE_INTERVAL = 5000; // 5 detik
    
    const form = document.querySelector('form');
    const toast = document.getElementById('autosave-toast');
    const toastTime = document.getElementById('autosave-time');
    const restoreModal = document.getElementById('restore-modal');
    
    // Fungsi untuk mengumpulkan data form
    function collectFormData() {
        const formData = new FormData(form);
        const data = {};
        
        // Simpan semua input text, textarea, select
        form.querySelectorAll('input[type="text"], input[type="email"], input[type="tel"], textarea, select').forEach(input => {
            if (input.name && !input.name.startsWith('_')) {
                data[input.name] = input.value;
            }
        });
        
        // Simpan radio buttons
        form.querySelectorAll('input[type="radio"]:checked').forEach(radio => {
            if (radio.name) {
                data[radio.name] = radio.value;
            }
        });
        
        // Simpan checkbox
        form.querySelectorAll('input[type="checkbox"]').forEach(checkbox => {
            if (checkbox.name) {
                data[checkbox.name] = checkbox.checked;
            }
        });
        
        // Simpan step yang aktif
        const stepElement = document.querySelector('[x-data]');
        if (stepElement) {
            const alpineData = Alpine.getData(stepElement);
            if (alpineData && alpineData.step) {
                data._currentStep = alpineData.step;
            }
        }
        
        return data;
    }
    
    // Fungsi untuk menyimpan ke localStorage
    function saveToLocalStorage() {
        const data = collectFormData();
        localStorage.setItem(STORAGE_KEY, JSON.stringify(data));
        localStorage.setItem(TIMESTAMP_KEY, new Date().toISOString());
        showToast();
    }
    
    // Fungsi untuk menampilkan toast
    function showToast() {
        const now = new Date();
        const timeStr = now.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit', second: '2-digit' });
        toastTime.textContent = 'Terakhir disimpan: ' + timeStr;
        
        toast.style.display = 'block';
        setTimeout(() => {
            toast.classList.remove('translate-y-20', 'opacity-0');
        }, 10);
        
        setTimeout(() => {
            toast.classList.add('translate-y-20', 'opacity-0');
            setTimeout(() => {
                toast.style.display = 'none';
            }, 300);
        }, 3000);
    }
    
    // Fungsi untuk memulihkan data form
    function restoreFormData() {
        const saved = localStorage.getItem(STORAGE_KEY);
        if (!saved) return;
        
        try {
            const data = JSON.parse(saved);
            
            // Restore text inputs, textareas, selects
            Object.keys(data).forEach(key => {
                if (key.startsWith('_')) return; // Skip metadata
                
                const input = form.querySelector(`[name="${key}"]`);
                if (input) {
                    if (input.type === 'radio') {
                        const radio = form.querySelector(`[name="${key}"][value="${data[key]}"]`);
                        if (radio) radio.checked = true;
                    } else if (input.type === 'checkbox') {
                        input.checked = data[key];
                    } else {
                        input.value = data[key];
                    }
                }
            });
            
            // Restore step
            if (data._currentStep) {
                const stepElement = document.querySelector('[x-data]');
                if (stepElement) {
                    const alpineData = Alpine.getData(stepElement);
                    if (alpineData && alpineData.step !== undefined) {
                        alpineData.step = parseInt(data._currentStep);
                    }
                }
            }
            
            // Trigger change events untuk Alpine.js
            form.querySelectorAll('input, select, textarea').forEach(el => {
                el.dispatchEvent(new Event('input', { bubbles: true }));
                el.dispatchEvent(new Event('change', { bubbles: true }));
            });
            
        } catch (e) {
            console.error('Error restoring form data:', e);
        }
        
        closeRestoreModal();
    }
    
    // Fungsi untuk menghapus data tersimpan
    function clearSavedData() {
        localStorage.removeItem(STORAGE_KEY);
        localStorage.removeItem(TIMESTAMP_KEY);
        closeRestoreModal();
    }
    
    // Fungsi untuk menutup modal
    function closeRestoreModal() {
        restoreModal.style.display = 'none';
    }
    
    // Fungsi untuk memeriksa data yang tersimpan
    function checkSavedData() {
        const saved = localStorage.getItem(STORAGE_KEY);
        const timestamp = localStorage.getItem(TIMESTAMP_KEY);
        
        if (saved && timestamp) {
            const savedTime = new Date(timestamp);
            const now = new Date();
            const hoursDiff = (now - savedTime) / (1000 * 60 * 60);
            
            // Tampilkan modal jika data kurang dari 24 jam
            if (hoursDiff < 24) {
                restoreModal.style.display = 'flex';
            } else {
                // Hapus data yang terlalu lama
                clearSavedData();
            }
        }
    }
    
    // Event listeners
    if (form) {
        // Auto-save setiap 5 detik
        setInterval(saveToLocalStorage, SAVE_INTERVAL);
        
        // Save saat input berubah (debounced)
        let debounceTimer;
        form.addEventListener('input', function() {
            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(saveToLocalStorage, 1000);
        });
        
        // Hapus localStorage saat form berhasil disubmit
        form.addEventListener('submit', function() {
            localStorage.removeItem(STORAGE_KEY);
            localStorage.removeItem(TIMESTAMP_KEY);
        });
    }
    
    // Periksa data tersimpan saat halaman dimuat
    document.addEventListener('DOMContentLoaded', function() {
        checkSavedData();
    });
    
    // Expose fungsi ke global scope untuk onclick handlers
    window.restoreFormData = restoreFormData;
    window.clearSavedData = clearSavedData;
})();
</script>
@endpush
@endsection
