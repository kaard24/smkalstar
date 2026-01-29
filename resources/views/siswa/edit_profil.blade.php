@extends('layouts.app')

@section('title', 'Edit Profil - SMK Al-Hidayah Lestari')

@section('content')
<div class="min-h-screen bg-gray-50 py-12">
    <div class="container mx-auto px-4 max-w-3xl">
        <div class="mb-6">
            <a href="{{ route('siswa.profil') }}" class="inline-flex items-center text-gray-600 hover:text-primary transition">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali ke Profil
            </a>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-6 border-b border-gray-100">
                <h1 class="text-xl font-bold text-gray-900">Edit Biodata</h1>
                <p class="text-gray-500 text-sm">Perbarui informasi data diri dan orang tua Anda.</p>
            </div>

            <form action="{{ route('siswa.profil.update') }}" method="POST" class="p-6">
                @csrf
                @method('PUT')

                @if($errors->any())
                <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-700 rounded-lg">
                    <ul class="list-disc list-inside text-sm">
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <!-- Data Siswa -->
                <h2 class="font-bold text-gray-900 mb-4">Data Diri</h2>
                <div class="grid md:grid-cols-2 gap-4 mb-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">NISN</label>
                        <input type="text" value="{{ $calonSiswa->nisn }}" class="w-full rounded-lg border-gray-300 bg-gray-100 cursor-not-allowed" disabled>
                        <p class="text-xs text-gray-500 mt-1">NISN tidak dapat diubah</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                        <input type="text" name="nama" value="{{ old('nama', $calonSiswa->nama) }}" class="w-full rounded-lg border-gray-300 focus:border-primary focus:ring focus:ring-primary/20" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">No. WhatsApp</label>
                        <input type="text" name="no_wa" value="{{ old('no_wa', $calonSiswa->no_wa) }}" class="w-full rounded-lg border-gray-300 focus:border-primary focus:ring focus:ring-primary/20" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Asal Sekolah</label>
                        <input type="text" name="asal_sekolah" value="{{ old('asal_sekolah', $calonSiswa->asal_sekolah) }}" class="w-full rounded-lg border-gray-300 focus:border-primary focus:ring focus:ring-primary/20" required>
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Alamat</label>
                        <textarea name="alamat" rows="2" class="w-full rounded-lg border-gray-300 focus:border-primary focus:ring focus:ring-primary/20" required>{{ old('alamat', $calonSiswa->alamat) }}</textarea>
                    </div>
                </div>

                <!-- Data Orang Tua -->
                <h2 class="font-bold text-gray-900 mb-4 pt-4 border-t">Data Orang Tua</h2>
                <div class="grid md:grid-cols-2 gap-4 mb-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Ayah</label>
                        <input type="text" name="nama_ayah" value="{{ old('nama_ayah', $calonSiswa->orangTua->nama_ayah ?? '') }}" class="w-full rounded-lg border-gray-300 focus:border-primary focus:ring focus:ring-primary/20" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Ibu</label>
                        <input type="text" name="nama_ibu" value="{{ old('nama_ibu', $calonSiswa->orangTua->nama_ibu ?? '') }}" class="w-full rounded-lg border-gray-300 focus:border-primary focus:ring focus:ring-primary/20" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">No. WA Orang Tua</label>
                        <input type="text" name="no_wa_ortu" value="{{ old('no_wa_ortu', $calonSiswa->orangTua->no_wa_ortu ?? '') }}" class="w-full rounded-lg border-gray-300 focus:border-primary focus:ring focus:ring-primary/20" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Pekerjaan</label>
                        <input type="text" name="pekerjaan" value="{{ old('pekerjaan', $calonSiswa->orangTua->pekerjaan ?? '') }}" class="w-full rounded-lg border-gray-300 focus:border-primary focus:ring focus:ring-primary/20" required>
                    </div>
                </div>

                <div class="flex justify-end gap-4 pt-4 border-t">
                    <a href="{{ route('siswa.profil') }}" class="px-6 py-2 bg-gray-100 text-gray-700 rounded-lg font-medium hover:bg-gray-200 transition">Batal</a>
                    <button type="submit" class="px-6 py-2 bg-primary text-white rounded-lg font-bold hover:bg-green-700 transition shadow-lg">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
