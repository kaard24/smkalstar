@extends('layouts.app')

@section('title', 'Lengkapi Data - SMK Al-Hidayah Lestari')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-gray-900">Lengkapi Data Pendaftaran</h1>
            <p class="text-gray-600 mt-1">Silakan lengkapi data yang masih diperlukan untuk melanjutkan proses pendaftaran.</p>
        </div>

        @if(session('error'))
        <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-700 rounded-xl">
            {{ session('error') }}
        </div>
        @endif

        <form action="{{ route('ppdb.lengkapi-data.store') }}" method="POST" class="space-y-6">
            @csrf
            
            <!-- Data Diri - Read Only (sudah diisi saat registrasi) -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 bg-green-50">
                    <h2 class="font-semibold text-gray-900 flex items-center gap-2">
                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Data Diri Siswa (Sudah Lengkap)
                    </h2>
                </div>
                <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- NISN (readonly) -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">NISN</label>
                        <input type="text" value="{{ $siswa->nisn }}" readonly
                            class="w-full px-4 py-3 border border-gray-200 rounded-xl bg-gray-50 text-gray-500">
                    </div>

                    <!-- Nama Lengkap (readonly) -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                        <input type="text" value="{{ $siswa->nama }}" readonly
                            class="w-full px-4 py-3 border border-gray-200 rounded-xl bg-gray-50 text-gray-500">
                    </div>

                    <!-- Tempat Lahir (readonly) -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tempat Lahir</label>
                        <input type="text" value="{{ $siswa->tempat_lahir }}" readonly
                            class="w-full px-4 py-3 border border-gray-200 rounded-xl bg-gray-50 text-gray-500">
                    </div>

                    <!-- Tanggal Lahir (readonly) -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Lahir</label>
                        <input type="text" value="{{ $siswa->tgl_lahir?->format('d/m/Y') }}" readonly
                            class="w-full px-4 py-3 border border-gray-200 rounded-xl bg-gray-50 text-gray-500">
                    </div>

                    <!-- Asal Sekolah (readonly) -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Asal Sekolah</label>
                        <input type="text" value="{{ $siswa->asal_sekolah }}" readonly
                            class="w-full px-4 py-3 border border-gray-200 rounded-xl bg-gray-50 text-gray-500">
                    </div>

                    <!-- No WhatsApp (readonly) -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">No. WhatsApp</label>
                        <input type="text" value="{{ $siswa->no_wa }}" readonly
                            class="w-full px-4 py-3 border border-gray-200 rounded-xl bg-gray-50 text-gray-500">
                    </div>

                    <!-- Jurusan (readonly) -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Pilihan Jurusan</label>
                        <input type="text" value="{{ $siswa->pendaftaran?->jurusan?->nama ?? 'Belum dipilih' }}" readonly
                            class="w-full px-4 py-3 border border-gray-200 rounded-xl bg-gray-50 text-gray-500">
                    </div>

                    <!-- Gelombang (readonly) -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Gelombang Pendaftaran</label>
                        <input type="text" value="{{ $siswa->pendaftaran?->gelombang ?? 'Gelombang 1' }}" readonly
                            class="w-full px-4 py-3 border border-gray-200 rounded-xl bg-gray-50 text-gray-500">
                    </div>
                </div>
            </div>

            <!-- Data Diri - Perlu Dilengkapi -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 bg-yellow-50">
                    <h2 class="font-semibold text-gray-900 flex items-center gap-2">
                        <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                        Data yang Perlu Dilengkapi
                    </h2>
                </div>
                <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- NIK -->
                    <div>
                        <label for="nik" class="block text-sm font-medium text-gray-700 mb-2">
                            NIK <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="nik" name="nik" maxlength="16"
                            value="{{ old('nik', $siswa->nik) }}" required
                            placeholder="Masukkan 16 digit NIK"
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition @error('nik') border-red-500 @enderror">
                        @error('nik')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- No KK -->
                    <div>
                        <label for="no_kk" class="block text-sm font-medium text-gray-700 mb-2">
                            Nomor Kartu Keluarga <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="no_kk" name="no_kk" maxlength="16"
                            value="{{ old('no_kk', $siswa->no_kk) }}" required
                            placeholder="Masukkan 16 digit Nomor KK"
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition @error('no_kk') border-red-500 @enderror">
                        @error('no_kk')
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

                    <!-- Alamat Sekolah -->
                    <div class="md:col-span-2">
                        <label for="alamat_sekolah" class="block text-sm font-medium text-gray-700 mb-2">
                            Alamat Sekolah Asal <span class="text-red-500">*</span>
                        </label>
                        <textarea id="alamat_sekolah" name="alamat_sekolah" rows="3" required
                            placeholder="Masukkan alamat lengkap sekolah asal"
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition @error('alamat_sekolah') border-red-500 @enderror">{{ old('alamat_sekolah', $siswa->alamat_sekolah) }}</textarea>
                        @error('alamat_sekolah')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Data Orang Tua / Wali -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
                    <h2 class="font-semibold text-gray-900">Data Orang Tua/Wali</h2>
                </div>
                <div class="p-6 space-y-6">
                    <!-- Pilihan Jenis -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-3">
                            Pilih Jenis <span class="text-red-500">*</span>
                        </label>
                        <div class="flex gap-6">
                            <label class="flex items-center cursor-pointer">
                                <input type="radio" name="jenis" value="orang_tua" 
                                    {{ old('jenis', $siswa->orangTua?->jenis ?? 'orang_tua') === 'orang_tua' ? 'checked' : '' }}
                                    class="jenis-radio w-4 h-4 text-primary border-gray-300 focus:ring-primary"
                                    onchange="toggleJenis()">
                                <span class="ml-2 text-gray-700">Orang Tua</span>
                            </label>
                            <label class="flex items-center cursor-pointer">
                                <input type="radio" name="jenis" value="wali" 
                                    {{ old('jenis', $siswa->orangTua?->jenis) === 'wali' ? 'checked' : '' }}
                                    class="jenis-radio w-4 h-4 text-primary border-gray-300 focus:ring-primary"
                                    onchange="toggleJenis()">
                                <span class="ml-2 text-gray-700">Wali</span>
                            </label>
                        </div>
                    </div>

                    <!-- Form Orang Tua -->
                    <div id="form-orang-tua" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Nama Ayah -->
                        <div>
                            <label for="nama_ayah" class="block text-sm font-medium text-gray-700 mb-2">
                                Nama Ayah <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="nama_ayah" name="nama_ayah" 
                                value="{{ old('nama_ayah', $siswa->orangTua?->nama_ayah) }}"
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition @error('nama_ayah') border-red-500 @enderror">
                            @error('nama_ayah')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- NIK Ayah -->
                        <div>
                            <label for="nik_ayah" class="block text-sm font-medium text-gray-700 mb-2">
                                NIK Ayah <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="nik_ayah" name="nik_ayah" maxlength="16"
                                value="{{ old('nik_ayah', $siswa->orangTua?->nik_ayah) }}"
                                placeholder="Masukkan 16 digit NIK"
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition @error('nik_ayah') border-red-500 @enderror">
                            @error('nik_ayah')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Status Ayah -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Status Ayah <span class="text-red-500">*</span>
                            </label>
                            <div class="flex gap-4">
                                <label class="flex items-center">
                                    <input type="radio" name="status_ayah" value="hidup" 
                                        {{ old('status_ayah', $siswa->orangTua?->status_ayah ?? 'hidup') === 'hidup' ? 'checked' : '' }}
                                        class="w-4 h-4 text-primary border-gray-300 focus:ring-primary">
                                    <span class="ml-2 text-gray-700">Masih Hidup</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="radio" name="status_ayah" value="meninggal" 
                                        {{ old('status_ayah', $siswa->orangTua?->status_ayah) === 'meninggal' ? 'checked' : '' }}
                                        class="w-4 h-4 text-primary border-gray-300 focus:ring-primary">
                                    <span class="ml-2 text-gray-700">Meninggal</span>
                                </label>
                            </div>
                            @error('status_ayah')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Nama Ibu -->
                        <div>
                            <label for="nama_ibu" class="block text-sm font-medium text-gray-700 mb-2">
                                Nama Ibu <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="nama_ibu" name="nama_ibu" 
                                value="{{ old('nama_ibu', $siswa->orangTua?->nama_ibu) }}"
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition @error('nama_ibu') border-red-500 @enderror">
                            @error('nama_ibu')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- NIK Ibu -->
                        <div>
                            <label for="nik_ibu" class="block text-sm font-medium text-gray-700 mb-2">
                                NIK Ibu <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="nik_ibu" name="nik_ibu" maxlength="16"
                                value="{{ old('nik_ibu', $siswa->orangTua?->nik_ibu) }}"
                                placeholder="Masukkan 16 digit NIK"
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition @error('nik_ibu') border-red-500 @enderror">
                            @error('nik_ibu')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Status Ibu -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Status Ibu <span class="text-red-500">*</span>
                            </label>
                            <div class="flex gap-4">
                                <label class="flex items-center">
                                    <input type="radio" name="status_ibu" value="hidup" 
                                        {{ old('status_ibu', $siswa->orangTua?->status_ibu ?? 'hidup') === 'hidup' ? 'checked' : '' }}
                                        class="w-4 h-4 text-primary border-gray-300 focus:ring-primary">
                                    <span class="ml-2 text-gray-700">Masih Hidup</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="radio" name="status_ibu" value="meninggal" 
                                        {{ old('status_ibu', $siswa->orangTua?->status_ibu) === 'meninggal' ? 'checked' : '' }}
                                        class="w-4 h-4 text-primary border-gray-300 focus:ring-primary">
                                    <span class="ml-2 text-gray-700">Meninggal</span>
                                </label>
                            </div>
                            @error('status_ibu')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Pekerjaan Orang Tua -->
                        <div>
                            <label for="pekerjaan" class="block text-sm font-medium text-gray-700 mb-2">
                                Pekerjaan Orang Tua <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="pekerjaan" name="pekerjaan" 
                                value="{{ old('pekerjaan', $siswa->orangTua?->pekerjaan) }}"
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
                                value="{{ old('no_wa_ortu', $siswa->orangTua?->no_wa_ortu) }}"
                                placeholder="Contoh: 6281234567890"
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition @error('no_wa_ortu') border-red-500 @enderror">
                            @error('no_wa_ortu')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Form Wali (Hidden by default) -->
                    <div id="form-wali" class="hidden grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Nama Wali -->
                        <div>
                            <label for="nama_wali" class="block text-sm font-medium text-gray-700 mb-2">
                                Nama Wali <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="nama_wali" name="nama_wali" 
                                value="{{ old('nama_wali', $siswa->orangTua?->nama_wali) }}"
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
                                value="{{ old('pekerjaan_wali', $siswa->orangTua?->pekerjaan_wali) }}"
                                placeholder="Contoh: Wiraswasta, PNS, Petani"
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
                                value="{{ old('no_hp_wali', $siswa->orangTua?->no_hp_wali) }}"
                                placeholder="Contoh: 6281234567890"
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition @error('no_hp_wali') border-red-500 @enderror">
                            @error('no_hp_wali')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Hubungan dengan Wali -->
                        <div>
                            <label for="hubungan_wali" class="block text-sm font-medium text-gray-700 mb-2">
                                Hubungan dengan Wali <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="hubungan_wali" name="hubungan_wali" 
                                value="{{ old('hubungan_wali', $siswa->orangTua?->hubungan_wali) }}"
                                placeholder="Contoh: Paman, Bibi, Kakek, Nenek"
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition @error('hubungan_wali') border-red-500 @enderror">
                            @error('hubungan_wali')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
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

// Initialize on page load
document.addEventListener('DOMContentLoaded', toggleJenis);
</script>
@endsection
