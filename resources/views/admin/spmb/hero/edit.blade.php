@extends('layouts.admin')

@section('title', 'Edit Hero SPMB - Admin Panel')

@section('content')
<div class="max-w-4xl mx-auto">
    {{-- Header --}}
    <div class="mb-8">
        <a href="{{ route('admin.spmb.hero.index') }}" class="text-slate-500 hover:text-slate-700 flex items-center gap-1 mb-4">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Kembali
        </a>
        <h1 class="text-2xl font-bold text-slate-800">Edit Hero / Banner</h1>
        <p class="text-slate-600">Ubah konten banner hero untuk halaman SPMB.</p>
    </div>

    {{-- Form --}}
    <form action="{{ route('admin.spmb.hero.update', $hero) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        {{-- Badge Section --}}
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
            <h2 class="text-lg font-semibold text-slate-800 mb-4 flex items-center gap-2">
                <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                </svg>
                Badge
            </h2>
            <div class="grid md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Teks Badge</label>
                    <input type="text" name="badge_text" value="{{ old('badge_text', $hero->badge_text) }}" 
                        class="w-full rounded-lg border-slate-300 focus:border-blue-500 focus:ring-blue-500"
                        placeholder="Contoh: Pendaftaran Dibuka!">
                    @error('badge_text')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Warna Badge</label>
                    <select name="badge_warna" class="w-full rounded-lg border-slate-300 focus:border-blue-500 focus:ring-blue-500">
                        <option value="blue" {{ old('badge_warna', $hero->badge_warna) == 'blue' ? 'selected' : '' }}>Biru (Blue)</option>
                        <option value="green" {{ old('badge_warna', $hero->badge_warna) == 'green' ? 'selected' : '' }}>Hijau (Green)</option>
                        <option value="orange" {{ old('badge_warna', $hero->badge_warna) == 'orange' ? 'selected' : '' }}>Oranye (Orange)</option>
                        <option value="purple" {{ old('badge_warna', $hero->badge_warna) == 'purple' ? 'selected' : '' }}>Ungu (Purple)</option>
                        <option value="red" {{ old('badge_warna', $hero->badge_warna) == 'red' ? 'selected' : '' }}>Merah (Red)</option>
                        <option value="indigo" {{ old('badge_warna', $hero->badge_warna) == 'indigo' ? 'selected' : '' }}>Indigo</option>
                    </select>
                    @error('badge_warna')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        {{-- Judul Section --}}
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
            <h2 class="text-lg font-semibold text-slate-800 mb-4 flex items-center gap-2">
                <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
                Judul
            </h2>
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Baris 1</label>
                    <input type="text" name="judul_baris1" value="{{ old('judul_baris1', $hero->judul_baris1) }}" 
                        class="w-full rounded-lg border-slate-300 focus:border-blue-500 focus:ring-blue-500"
                        placeholder="Contoh: Sistem Penerimaan">
                    @error('judul_baris1')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Baris 2 (Diberi warna)</label>
                    <input type="text" name="judul_baris2" value="{{ old('judul_baris2', $hero->judul_baris2) }}" 
                        class="w-full rounded-lg border-slate-300 focus:border-blue-500 focus:ring-blue-500"
                        placeholder="Contoh: Murid Baru 2026/2027">
                    @error('judul_baris2')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        {{-- Deskripsi Section --}}
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
            <h2 class="text-lg font-semibold text-slate-800 mb-4 flex items-center gap-2">
                <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"/>
                </svg>
                Deskripsi
            </h2>
            <div>
                <textarea name="deskripsi" rows="3" 
                    class="w-full rounded-lg border-slate-300 focus:border-blue-500 focus:ring-blue-500"
                    placeholder="Deskripsi singkat tentang SPMB...">{{ old('deskripsi', $hero->deskripsi) }}</textarea>
                @error('deskripsi')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        {{-- Pengaturan Section --}}
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
            <h2 class="text-lg font-semibold text-slate-800 mb-4 flex items-center gap-2">
                <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                Pengaturan
            </h2>
            <div class="grid md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Tahun Ajaran</label>
                    <input type="text" name="tahun_ajaran" value="{{ old('tahun_ajaran', $hero->tahun_ajaran) }}" 
                        class="w-full rounded-lg border-slate-300 focus:border-blue-500 focus:ring-blue-500"
                        placeholder="Contoh: 2026/2027">
                    @error('tahun_ajaran')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Jumlah Gelombang Ditampilkan</label>
                    <input type="number" name="jumlah_gelombang_tampil" value="{{ old('jumlah_gelombang_tampil', $hero->jumlah_gelombang_tampil) }}" min="1" max="5"
                        class="w-full rounded-lg border-slate-300 focus:border-blue-500 focus:ring-blue-500">
                    @error('jumlah_gelombang_tampil')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Urutan</label>
                    <input type="number" name="urutan" value="{{ old('urutan', $hero->urutan) }}" min="0"
                        class="w-full rounded-lg border-slate-300 focus:border-blue-500 focus:ring-blue-500">
                    <p class="text-xs text-slate-500 mt-1">Hero dengan urutan terkecil yang aktif akan ditampilkan</p>
                </div>
            </div>
            
            {{-- Checkboxes --}}
            <div class="mt-4 space-y-3">
                <label class="flex items-center gap-3 cursor-pointer">
                    <input type="checkbox" name="aktif" value="1" {{ old('aktif', $hero->aktif) ? 'checked' : '' }}
                        class="rounded border-slate-300 text-blue-600 focus:ring-blue-500">
                    <span class="text-slate-700">Aktifkan hero ini</span>
                </label>
                <label class="flex items-center gap-3 cursor-pointer">
                    <input type="checkbox" name="tampilkan_gelombang" value="1" {{ old('tampilkan_gelombang', $hero->tampilkan_gelombang) ? 'checked' : '' }}
                        class="rounded border-slate-300 text-blue-600 focus:ring-blue-500">
                    <span class="text-slate-700">Tampilkan info gelombang di hero</span>
                </label>
            </div>
        </div>

        {{-- Actions --}}
        <div class="flex gap-4">
            <button type="submit" class="btn btn-primary shadow-lg hover:shadow-xl">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                Simpan Perubahan
            </button>
            <a href="{{ route('admin.spmb.hero.index') }}" class="btn btn-secondary">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection
