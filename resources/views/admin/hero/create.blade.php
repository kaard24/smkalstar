@extends('layouts.admin')

@section('title', 'Tambah Hero Section - Admin Panel')

@section('content')
    {{-- Header Section --}}
    <div class="mb-6">
        <div class="flex items-center gap-2 mb-2">
            <a href="{{ route('admin.hero.index') }}" class="text-slate-500 hover:text-slate-700">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
            </a>
            <h1 class="text-lg font-semibold text-slate-800">Tambah Hero Section</h1>
        </div>
        <p class="text-xs text-slate-500">Buat tampilan hero baru untuk beranda</p>
    </div>

    @if($errors->any())
    <div class="mb-4 p-4 bg-[#991B1B]/10 border border-[#991B1B]/20 text-[#991B1B] rounded-lg text-sm">
        <p class="font-medium mb-1">Terdapat kesalahan:</p>
        <ul class="list-disc list-inside text-xs">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('admin.hero.store') }}" method="POST" enctype="multipart/form-data" class="max-w-4xl">
        @csrf

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            {{-- Left Column --}}
            <div class="space-y-4">
                {{-- Badge Text --}}
                <div class="bg-white rounded-xl border border-slate-200 p-4">
                    <label class="block text-xs font-medium text-slate-600 mb-1">Badge Text <span class="text-[#991B1B]">*</span></label>
                    <input type="text" name="badge_text" value="{{ old('badge_text', 'Pendaftaran 2026/2027 Dibuka') }}" required
                           class="w-full px-3 py-2 text-sm border border-slate-300 rounded-md focus:outline-none focus:border-[#4276A3] focus:ring-1 focus:ring-[#4276A3]">
                    <p class="text-xs text-slate-500 mt-1">Teks badge di atas judul (contoh: Pendaftaran 2026/2027 Dibuka)</p>
                </div>

                {{-- Title --}}
                <div class="bg-white rounded-xl border border-slate-200 p-4 space-y-3">
                    <h3 class="font-semibold text-sm text-slate-800 pb-2 border-b border-slate-100">Judul</h3>
                    
                    <div>
                        <label class="block text-xs font-medium text-slate-600 mb-1">Baris 1 <span class="text-[#991B1B]">*</span></label>
                        <input type="text" name="title_line1" value="{{ old('title_line1', 'SPMB 2026/2027') }}" required
                               class="w-full px-3 py-2 text-sm border border-slate-300 rounded-md focus:outline-none focus:border-[#4276A3] focus:ring-1 focus:ring-[#4276A3]">
                    </div>
                    
                    <div>
                        <label class="block text-xs font-medium text-slate-600 mb-1">Highlight <span class="text-[#991B1B]">*</span></label>
                        <input type="text" name="title_highlight" value="{{ old('title_highlight', 'Telah') }}" required
                               class="w-full px-3 py-2 text-sm border border-slate-300 rounded-md focus:outline-none focus:border-[#4276A3] focus:ring-1 focus:ring-[#4276A3]">
                        <p class="text-xs text-slate-500 mt-1">Akan ditampilkan dengan warna biru</p>
                    </div>
                    
                    <div>
                        <label class="block text-xs font-medium text-slate-600 mb-1">Baris 2 <span class="text-[#991B1B]">*</span></label>
                        <input type="text" name="title_line2" value="{{ old('title_line2', 'Dibuka!') }}" required
                               class="w-full px-3 py-2 text-sm border border-slate-300 rounded-md focus:outline-none focus:border-[#4276A3] focus:ring-1 focus:ring-[#4276A3]">
                        <p class="text-xs text-slate-500 mt-1">Akan ditampilkan dengan warna cyan</p>
                    </div>
                </div>

                {{-- Description --}}
                <div class="bg-white rounded-xl border border-slate-200 p-4">
                    <label class="block text-xs font-medium text-slate-600 mb-1">Deskripsi <span class="text-[#991B1B]">*</span></label>
                    <textarea name="description" rows="3" required
                              class="w-full px-3 py-2 text-sm border border-slate-300 rounded-md focus:outline-none focus:border-[#4276A3] focus:ring-1 focus:ring-[#4276A3]">{{ old('description', 'Daftarkan diri Anda sekarang dan jadilah bagian dari generasi unggul dan berakhlak di SMK Al-Hidayah Lestari.') }}</textarea>
                </div>
            </div>

            {{-- Right Column --}}
            <div class="space-y-4">
                {{-- Buttons --}}
                <div class="bg-white rounded-xl border border-slate-200 p-4 space-y-3">
                    <h3 class="font-semibold text-sm text-slate-800 pb-2 border-b border-slate-100">Tombol</h3>
                    
                    <div>
                        <label class="block text-xs font-medium text-slate-600 mb-1">Tombol Primary <span class="text-[#991B1B]">*</span></label>
                        <div class="grid grid-cols-2 gap-2">
                            <input type="text" name="button_primary_text" value="{{ old('button_primary_text', 'Daftar Sekarang') }}" required placeholder="Teks"
                                   class="w-full px-3 py-2 text-sm border border-slate-300 rounded-md focus:outline-none focus:border-[#4276A3] focus:ring-1 focus:ring-[#4276A3]">
                            <input type="text" name="button_primary_url" value="{{ old('button_primary_url', '/spmb/register') }}" required placeholder="URL"
                                   class="w-full px-3 py-2 text-sm border border-slate-300 rounded-md focus:outline-none focus:border-[#4276A3] focus:ring-1 focus:ring-[#4276A3]">
                        </div>
                    </div>
                    
                    <div>
                        <label class="block text-xs font-medium text-slate-600 mb-1">Tombol Secondary <span class="text-[#991B1B]">*</span></label>
                        <div class="grid grid-cols-2 gap-2">
                            <input type="text" name="button_secondary_text" value="{{ old('button_secondary_text', 'Info Lebih Lanjut') }}" required placeholder="Teks"
                                   class="w-full px-3 py-2 text-sm border border-slate-300 rounded-md focus:outline-none focus:border-[#4276A3] focus:ring-1 focus:ring-[#4276A3]">
                            <input type="text" name="button_secondary_url" value="{{ old('button_secondary_url', '/spmb/info') }}" required placeholder="URL"
                                   class="w-full px-3 py-2 text-sm border border-slate-300 rounded-md focus:outline-none focus:border-[#4276A3] focus:ring-1 focus:ring-[#4276A3]">
                        </div>
                    </div>
                </div>

                {{-- Hero Image --}}
                <div class="bg-white rounded-xl border border-slate-200 p-4">
                    <label class="block text-xs font-medium text-slate-600 mb-1">Gambar Hero</label>
                    <input type="file" name="hero_image" accept="image/*"
                           class="w-full px-3 py-2 text-sm border border-slate-300 rounded-md focus:outline-none focus:border-[#4276A3] focus:ring-1 focus:ring-[#4276A3]">
                    <p class="text-xs text-slate-500 mt-1">Format: JPG, PNG, WebP. Max: 2MB. Default: images/b1.webp</p>
                </div>

                {{-- Status --}}
                <div class="bg-white rounded-xl border border-slate-200 p-4">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active') ? 'checked' : '' }}
                               class="w-4 h-4 text-[#4276A3] border-slate-300 rounded focus:ring-[#4276A3]">
                        <span class="text-sm text-slate-700">Aktifkan hero section ini</span>
                    </label>
                    <p class="text-xs text-slate-500 mt-1 ml-6">Hanya satu hero section yang aktif pada satu waktu</p>
                </div>
            </div>
        </div>

        {{-- Actions --}}
        <div class="flex gap-3 mt-6">
            <a href="{{ route('admin.hero.index') }}" class="btn btn-secondary">
                Batal
            </a>
            <button type="submit" class="btn btn-primary">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                Simpan
            </button>
        </div>
    </form>
@endsection
