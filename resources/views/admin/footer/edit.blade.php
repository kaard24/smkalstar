@extends('layouts.admin')

@section('title', 'Pengaturan Footer')

@section('content')
<div class="px-4 sm:px-6 lg:px-8 py-8">
    <!-- Header -->
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-slate-800">Pengaturan Footer</h1>
        <p class="text-slate-500 mt-1">Kelola konten dan informasi yang ditampilkan di footer website</p>
    </div>

    @if(session('success'))
        <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('admin.footer.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <!-- Brand Info -->
        <div class="bg-white rounded-xl shadow-sm border border-[#E2E8F0] overflow-hidden">
            <div class="px-6 py-4 border-b border-[#E2E8F0] bg-[#F8FAFC]">
                <h2 class="text-lg font-semibold text-slate-800">Informasi Brand</h2>
            </div>
            <div class="p-6 space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Nama Sekolah</label>
                        <input type="text" name="nama_sekolah" value="{{ old('nama_sekolah', $footer->nama_sekolah) }}" 
                               class="w-full px-4 py-2 border border-[#E2E8F0] rounded-lg focus:ring-2 focus:ring-[#4276A3] focus:border-transparent @error('nama_sekolah') border-red-500 @enderror">
                        @error('nama_sekolah')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Logo</label>
                        <div class="flex items-center gap-4">
                            @if($footer->logo)
                                <img src="{{ $footer->logo_url }}" alt="Logo" class="h-12 w-12 rounded-full object-cover ring-2 ring-[#4276A3]/30">
                            @endif
                            <input type="file" name="logo" accept="image/*" 
                                   class="flex-1 px-4 py-2 border border-[#E2E8F0] rounded-lg focus:ring-2 focus:ring-[#4276A3] focus:border-transparent @error('logo') border-red-500 @enderror">
                        </div>
                        @error('logo')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Tagline</label>
                    <textarea name="tagline" rows="2" 
                              class="w-full px-4 py-2 border border-[#E2E8F0] rounded-lg focus:ring-2 focus:ring-[#4276A3] focus:border-transparent @error('tagline') border-red-500 @enderror">{{ old('tagline', $footer->tagline) }}</textarea>
                    @error('tagline')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                </div>
            </div>
        </div>

        <!-- Contact Info -->
        <div class="bg-white rounded-xl shadow-sm border border-[#E2E8F0] overflow-hidden">
            <div class="px-6 py-4 border-b border-[#E2E8F0] bg-[#F8FAFC]">
                <h2 class="text-lg font-semibold text-slate-800">Informasi Kontak</h2>
            </div>
            <div class="p-6 space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Alamat</label>
                        <textarea name="alamat" rows="2" 
                                  class="w-full px-4 py-2 border border-[#E2E8F0] rounded-lg focus:ring-2 focus:ring-[#4276A3] focus:border-transparent @error('alamat') border-red-500 @enderror">{{ old('alamat', $footer->alamat) }}</textarea>
                        @error('alamat')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Telepon</label>
                        <input type="text" name="telepon" value="{{ old('telepon', $footer->telepon) }}" 
                               class="w-full px-4 py-2 border border-[#E2E8F0] rounded-lg focus:ring-2 focus:ring-[#4276A3] focus:border-transparent @error('telepon') border-red-500 @enderror">
                        @error('telepon')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Label WhatsApp</label>
                        <input type="text" name="whatsapp" value="{{ old('whatsapp', $footer->whatsapp) }}" placeholder="Chat Pak Kaffa"
                               class="w-full px-4 py-2 border border-[#E2E8F0] rounded-lg focus:ring-2 focus:ring-[#4276A3] focus:border-transparent @error('whatsapp') border-red-500 @enderror">
                        @error('whatsapp')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Link WhatsApp</label>
                        <input type="text" name="whatsapp_link" value="{{ old('whatsapp_link', $footer->whatsapp_link) }}" placeholder="https://wa.me/6288123456789"
                               class="w-full px-4 py-2 border border-[#E2E8F0] rounded-lg focus:ring-2 focus:ring-[#4276A3] focus:border-transparent @error('whatsapp_link') border-red-500 @enderror">
                        @error('whatsapp_link')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                    </div>
                </div>
            </div>
        </div>

        <!-- SPMB CTA -->
        <div class="bg-white rounded-xl shadow-sm border border-[#E2E8F0] overflow-hidden">
            <div class="px-6 py-4 border-b border-[#E2E8F0] bg-[#F8FAFC] flex items-center justify-between">
                <h2 class="text-lg font-semibold text-slate-800">Section SPMB (CTA)</h2>
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="show_spmb" value="1" {{ old('show_spmb', $footer->show_spmb) ? 'checked' : '' }}
                           class="w-4 h-4 text-[#4276A3] border-[#E2E8F0] rounded focus:ring-[#4276A3]">
                    <span class="text-sm text-slate-600">Tampilkan</span>
                </label>
            </div>
            <div class="p-6 space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Judul</label>
                        <input type="text" name="spmb_title" value="{{ old('spmb_title', $footer->spmb_title) }}" 
                               class="w-full px-4 py-2 border border-[#E2E8F0] rounded-lg focus:ring-2 focus:ring-[#4276A3] focus:border-transparent @error('spmb_title') border-red-500 @enderror">
                        @error('spmb_title')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Text Tombol</label>
                        <input type="text" name="spmb_button_text" value="{{ old('spmb_button_text', $footer->spmb_button_text) }}" 
                               class="w-full px-4 py-2 border border-[#E2E8F0] rounded-lg focus:ring-2 focus:ring-[#4276A3] focus:border-transparent @error('spmb_button_text') border-red-500 @enderror">
                        @error('spmb_button_text')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Deskripsi</label>
                    <textarea name="spmb_description" rows="2" 
                              class="w-full px-4 py-2 border border-[#E2E8F0] rounded-lg focus:ring-2 focus:ring-[#4276A3] focus:border-transparent @error('spmb_description') border-red-500 @enderror">{{ old('spmb_description', $footer->spmb_description) }}</textarea>
                    @error('spmb_description')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Link Tombol</label>
                    <input type="text" name="spmb_button_link" value="{{ old('spmb_button_link', $footer->spmb_button_link) }}" 
                           class="w-full px-4 py-2 border border-[#E2E8F0] rounded-lg focus:ring-2 focus:ring-[#4276A3] focus:border-transparent @error('spmb_button_link') border-red-500 @enderror">
                    @error('spmb_button_link')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                </div>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="flex justify-end">
            <button type="submit" class="px-6 py-3 bg-[#4276A3] text-white font-medium rounded-lg hover:bg-[#356285] transition shadow-lg shadow-[#4276A3]/25">
                <span class="flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Simpan Perubahan
                </span>
            </button>
        </div>
    </form>
</div>
@endsection
