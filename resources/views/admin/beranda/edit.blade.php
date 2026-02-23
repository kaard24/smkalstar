@extends('layouts.admin')

@section('title', 'Edit Section Beranda - Admin Panel')

@section('content')
    {{-- Header --}}
    <div class="mb-6">
        <div class="flex items-center gap-2 text-sm text-slate-500 mb-2">
            <a href="{{ route('admin.beranda.index') }}" class="hover:text-[#4276A3]">Kelola Beranda</a>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
            <span>Edit</span>
        </div>
        <h1 class="text-lg font-semibold text-slate-800">Edit Section Beranda</h1>
    </div>

    {{-- Alerts --}}
    @if($errors->any())
    <div class="mb-4 p-3 bg-[#991B1B]/10 border border-[#991B1B]/20 text-[#991B1B] rounded-lg text-sm">
        <p class="font-medium mb-1">Terdapat kesalahan:</p>
        <ul class="list-disc list-inside text-xs">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    {{-- Form --}}
    <div class="card p-6 max-w-3xl">
        <form action="{{ route('admin.beranda.update', $beranda) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                {{-- Tipe Section --}}
                <div>
                    <label for="tipe" class="block text-sm font-medium text-slate-700 mb-1">
                        Tipe Section <span class="text-[#991B1B]">*</span>
                    </label>
                    <select id="tipe" name="tipe" required
                            class="w-full px-3 py-2 text-sm border border-slate-300 rounded-md focus:outline-none focus:border-[#4276A3] focus:ring-1 focus:ring-[#4276A3] bg-white">
                        @foreach($tipeList as $key => $label)
                        <option value="{{ $key }}" {{ old('tipe', $beranda->tipe) == $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Urutan --}}
                <div>
                    <label for="urutan" class="block text-sm font-medium text-slate-700 mb-1">
                        Urutan <span class="text-[#991B1B]">*</span>
                    </label>
                    <input type="number" id="urutan" name="urutan" 
                           value="{{ old('urutan', $beranda->urutan) }}" required min="0"
                           class="w-full px-3 py-2 text-sm border border-slate-300 rounded-md focus:outline-none focus:border-[#4276A3] focus:ring-1 focus:ring-[#4276A3]">
                    <p class="text-xs text-slate-500 mt-1">Angka kecil = tampil lebih awal</p>
                </div>
            </div>

            <div class="mt-4">
                <label for="judul" class="block text-sm font-medium text-slate-700 mb-1">
                    Judul <span class="text-[#991B1B]">*</span>
                </label>
                <input type="text" id="judul" name="judul" 
                       value="{{ old('judul', $beranda->judul) }}" required
                       placeholder="Contoh: Selamat Datang di SMK Al-Hidayah"
                       class="w-full px-3 py-2 text-sm border border-slate-300 rounded-md focus:outline-none focus:border-[#4276A3] focus:ring-1 focus:ring-[#4276A3]">
            </div>

            <div class="mt-4">
                <label for="subjudul" class="block text-sm font-medium text-slate-700 mb-1">
                    Subjudul
                </label>
                <input type="text" id="subjudul" name="subjudul" 
                       value="{{ old('subjudul', $beranda->subjudul) }}"
                       placeholder="Contoh: Sekolah Unggul Berakhlak"
                       class="w-full px-3 py-2 text-sm border border-slate-300 rounded-md focus:outline-none focus:border-[#4276A3] focus:ring-1 focus:ring-[#4276A3]">
            </div>

            <div class="mt-4">
                <label for="konten" class="block text-sm font-medium text-slate-700 mb-1">
                    Konten
                </label>
                <textarea id="konten" name="konten" rows="4"
                          placeholder="Isi konten section..."
                          class="w-full px-3 py-2 text-sm border border-slate-300 rounded-md focus:outline-none focus:border-[#4276A3] focus:ring-1 focus:ring-[#4276A3]">{{ old('konten', $beranda->konten) }}</textarea>
            </div>

            <div class="mt-4">
                <label for="gambar" class="block text-sm font-medium text-slate-700 mb-1">
                    Gambar
                </label>
                @if($beranda->gambar)
                <div class="mb-3 aspect-video rounded-lg overflow-hidden bg-slate-100 max-w-sm">
                    <img src="{{ $beranda->gambar_url }}" alt="{{ $beranda->judul }}" class="w-full h-full object-cover">
                </div>
                <label class="flex items-center gap-2 mb-2">
                    <input type="checkbox" name="hapus_gambar" value="1" class="w-4 h-4 text-[#991B1B] border-slate-300 rounded focus:ring-[#991B1B]">
                    <span class="text-sm text-[#991B1B]">Hapus gambar saat ini</span>
                </label>
                @endif
                <input type="file" id="gambar" name="gambar" accept="image/*"
                       class="block w-full text-sm text-slate-500
                              file:mr-4 file:py-2 file:px-4
                              file:rounded file:border-0
                              file:text-sm file:font-medium
                              file:bg-[#4276A3]/10 file:text-[#4276A3]
                              hover:file:bg-[#4276A3]/20
                              cursor-pointer">
                <p class="text-xs text-slate-500 mt-1">Format: JPG, PNG, WebP. Max 2MB. Kosongkan jika tidak ingin mengubah gambar.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                {{-- Tombol Teks --}}
                <div>
                    <label for="tombol_teks" class="block text-sm font-medium text-slate-700 mb-1">
                        Teks Tombol
                    </label>
                    <input type="text" id="tombol_teks" name="tombol_teks" 
                           value="{{ old('tombol_teks', $beranda->tombol_teks) }}"
                           placeholder="Contoh: Daftar Sekarang"
                           class="w-full px-3 py-2 text-sm border border-slate-300 rounded-md focus:outline-none focus:border-[#4276A3] focus:ring-1 focus:ring-[#4276A3]">
                </div>

                {{-- Tombol Link --}}
                <div>
                    <label for="tombol_link" class="block text-sm font-medium text-slate-700 mb-1">
                        Link Tombol
                    </label>
                    <input type="text" id="tombol_link" name="tombol_link" 
                           value="{{ old('tombol_link', $beranda->tombol_link) }}"
                           placeholder="Contoh: /spmb/register"
                           class="w-full px-3 py-2 text-sm border border-slate-300 rounded-md focus:outline-none focus:border-[#4276A3] focus:ring-1 focus:ring-[#4276A3]">
                </div>
            </div>

            <div class="mt-4">
                <label for="warna_latar" class="block text-sm font-medium text-slate-700 mb-1">
                    Warna Latar (Tailwind Class)
                </label>
                <input type="text" id="warna_latar" name="warna_latar" 
                       value="{{ old('warna_latar', $beranda->warna_latar) }}"
                       placeholder="Contoh: bg-white, bg-slate-50, bg-blue-50"
                       class="w-full px-3 py-2 text-sm border border-slate-300 rounded-md focus:outline-none focus:border-[#4276A3] focus:ring-1 focus:ring-[#4276A3]">
                <p class="text-xs text-slate-500 mt-1">Kosongkan untuk default</p>
            </div>

            <div class="mt-4 p-3 bg-slate-50 rounded-lg border border-slate-200">
                <label class="flex items-start gap-3 cursor-pointer">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $beranda->is_active) ? 'checked' : '' }}
                           class="mt-0.5 w-4 h-4 text-[#4276A3] border-slate-300 rounded focus:ring-[#4276A3]">
                    <div>
                        <span class="text-sm font-medium text-slate-700">Aktifkan section ini</span>
                        <p class="text-xs text-slate-500 mt-0.5">Section yang tidak aktif tidak akan ditampilkan</p>
                    </div>
                </label>
            </div>

            {{-- Buttons --}}
            <div class="mt-6 flex justify-end gap-2 pt-4 border-t border-slate-200">
                <a href="{{ route('admin.beranda.index') }}" class="btn btn-secondary">
                    Batal
                </a>
                <button type="submit" class="btn btn-primary">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
@endsection
