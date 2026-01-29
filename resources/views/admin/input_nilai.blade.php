@extends('layouts.admin')

@section('title', 'Input Nilai Tes - PPDB Admin')

@section('content')
    <div class="max-w-4xl mx-auto">
        <a href="{{ route('admin.pendaftar.index') }}" class="inline-flex items-center text-gray-600 hover:text-primary mb-6 transition">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali ke Daftar
        </a>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="p-8 border-b border-gray-100">
                <h1 class="text-2xl font-bold text-gray-900 mb-2">Input Nilai Tes Seleksi</h1>
                <p class="text-gray-500">Formulir penilaian tes akademik dan wawancara calon siswa.</p>
            </div>

            <form action="{{ route('admin.simpan_nilai', $pendaftaran->id) }}" method="POST">
                @csrf
                <div class="p-8 grid md:grid-cols-2 gap-8">
                    <!-- Student Info -->
                    <div class="md:col-span-2 bg-blue-50/50 p-6 rounded-xl border border-blue-100 flex items-start gap-4 mb-4">
                        <div class="w-12 h-12 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center font-bold text-xl">
                            {{ substr($pendaftaran->calonSiswa->nama, 0, 1) }}
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-900 text-lg">{{ $pendaftaran->calonSiswa->nama }}</h3>
                            <div class="text-gray-600 space-y-1 text-sm mt-1">
                                <p><span class="font-medium mr-2">NISN:</span> {{ $pendaftaran->calonSiswa->nisn }}</p>
                                <p><span class="font-medium mr-2">Asal Sekolah:</span> {{ $pendaftaran->calonSiswa->asal_sekolah }}</p>
                                <p><span class="font-medium mr-2">Pilihan Jurusan:</span> <span class="bg-primary/10 text-primary px-2 py-0.5 rounded font-bold">{{ $pendaftaran->jurusan->nama }}</span></p>
                            </div>
                        </div>
                    </div>

                    <!-- Input Nilai -->
                    <div class="space-y-6">
                        <h3 class="font-bold text-gray-900 border-b pb-2 mb-4">1. Nilai Akademik & Skill</h3>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nilai BTQ (Baca Tulis Quran)</label>
                            <input type="number" name="nilai_btq" value="{{ old('nilai_btq', $pendaftaran->tes->nilai_btq ?? '') }}" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-primary focus:border-primary transition" min="0" max="100" required>
                            @error('nilai_btq') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nilai Minat & Bakat</label>
                            <input type="number" name="nilai_minat_bakat" value="{{ old('nilai_minat_bakat', $pendaftaran->tes->nilai_minat_bakat ?? '') }}" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-primary focus:border-primary transition" min="0" max="100" required>
                            @error('nilai_minat_bakat') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nilai Tes Kejuruan</label>
                            <input type="number" name="nilai_kejuruan" value="{{ old('nilai_kejuruan', $pendaftaran->tes->nilai_kejuruan ?? '') }}" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-primary focus:border-primary transition" min="0" max="100" required>
                            @error('nilai_kejuruan') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <!-- Status Kelulusan -->
                    <div class="space-y-6">
                        <h3 class="font-bold text-gray-900 border-b pb-2 mb-4">2. Keputusan Akhir</h3>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Status BTQ</label>
                            <select name="status_btq" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-primary focus:border-primary transition">
                                <option value="">Pilih Status...</option>
                                <option value="Lulus" {{ (old('status_btq', $pendaftaran->tes->status_btq ?? '') == 'Lulus') ? 'selected' : '' }}>Lulus</option>
                                <option value="Tidak Lulus" {{ (old('status_btq', $pendaftaran->tes->status_btq ?? '') == 'Tidak Lulus') ? 'selected' : '' }}>Tidak Lulus</option>
                            </select>
                            @error('status_btq') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Status Kelulusan PPDB</label>
                            <select name="status_kelulusan" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-primary focus:border-primary transition bg-gray-50 font-medium">
                                <option value="Pending" {{ (old('status_kelulusan', $pendaftaran->tes->status_kelulusan ?? '') == 'Pending') ? 'selected' : '' }}>Pending</option>
                                <option value="Lulus" {{ (old('status_kelulusan', $pendaftaran->tes->status_kelulusan ?? '') == 'Lulus') ? 'selected' : '' }}>Lulus</option>
                                <option value="Tidak Lulus" {{ (old('status_kelulusan', $pendaftaran->tes->status_kelulusan ?? '') == 'Tidak Lulus') ? 'selected' : '' }}>Tidak Lulus</option>
                            </select>
                            @error('status_kelulusan') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            <p class="text-xs text-gray-500 mt-2">
                                <span class="text-red-500 font-bold">*</span> Jika status dipilih <strong>Lulus/Tidak Lulus</strong>, notifikasi WhatsApp akan dikirimkan otomatis ke nomor siswa.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="px-8 py-6 bg-gray-50 flex justify-end gap-4 border-t border-gray-100">
                    <button type="button" onclick="history.back()" class="px-6 py-2.5 bg-white border border-gray-300 text-gray-700 rounded-lg font-medium hover:bg-gray-50 transition">Batal</button>
                    <button type="submit" class="px-6 py-2.5 bg-primary text-white rounded-lg font-bold hover:bg-green-700 transition shadow-lg shadow-green-500/30">Simpan Keputusan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
