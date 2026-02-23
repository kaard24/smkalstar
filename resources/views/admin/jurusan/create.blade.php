@extends('layouts.admin')

@section('title', 'Tambah Program Keahlian - Admin Panel')

@section('content')
<div class="max-w-4xl mx-auto">
    {{-- Header --}}
    <div class="mb-8">
        <a href="{{ route('admin.jurusan.index') }}" class="text-slate-500 hover:text-slate-700 flex items-center gap-1 mb-4">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Kembali
        </a>
        <h1 class="text-2xl font-bold text-slate-800">Tambah Program Keahlian</h1>
        <p class="text-slate-600">Tambah data jurusan baru dengan logo dan gambar.</p>
    </div>

    {{-- Form --}}
    <form action="{{ route('admin.jurusan.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        {{-- Informasi Dasar --}}
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
            <h2 class="text-lg font-semibold text-slate-800 mb-4 flex items-center gap-2">
                <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                Informasi Dasar
            </h2>
            <div class="grid md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Kode Jurusan</label>
                    <input type="text" name="kode" value="{{ old('kode') }}" 
                        class="w-full rounded-lg border-slate-300 focus:border-blue-500 focus:ring-blue-500 uppercase"
                        placeholder="Contoh: TKJ">
                    @error('kode')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Nama Jurusan</label>
                    <input type="text" name="nama" value="{{ old('nama') }}" 
                        class="w-full rounded-lg border-slate-300 focus:border-blue-500 focus:ring-blue-500"
                        placeholder="Contoh: Teknik Komputer dan Jaringan">
                    @error('nama')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Kategori</label>
                    <input type="text" name="kategori" value="{{ old('kategori') }}" 
                        class="w-full rounded-lg border-slate-300 focus:border-blue-500 focus:ring-blue-500"
                        placeholder="Contoh: Teknologi Informasi">
                    @error('kategori')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Urutan</label>
                    <input type="number" name="urutan" value="{{ old('urutan', 1) }}" min="0"
                        class="w-full rounded-lg border-slate-300 focus:border-blue-500 focus:ring-blue-500">
                    @error('urutan')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        {{-- Deskripsi --}}
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
            <h2 class="text-lg font-semibold text-slate-800 mb-4 flex items-center gap-2">
                <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"/>
                </svg>
                Deskripsi
            </h2>
            <div>
                <textarea name="deskripsi" rows="4" 
                    class="w-full rounded-lg border-slate-300 focus:border-blue-500 focus:ring-blue-500"
                    placeholder="Deskripsi singkat tentang jurusan...">{{ old('deskripsi') }}</textarea>
                @error('deskripsi')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        {{-- Peluang Karir --}}
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
            <h2 class="text-lg font-semibold text-slate-800 mb-4 flex items-center gap-2">
                <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
                Peluang Karir
            </h2>
            <div>
                <textarea name="peluang_karir" rows="4" 
                    class="w-full rounded-lg border-slate-300 focus:border-blue-500 focus:ring-blue-500"
                    placeholder="Peluang karir (satu per baris)...&#10;Contoh:&#10;Network Engineer&#10;System Administrator&#10;IT Support">{{ old('peluang_karir') }}</textarea>
                <p class="text-xs text-slate-500 mt-1">Tulis satu peluang karir per baris</p>
                @error('peluang_karir')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        {{-- Media --}}
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
            <h2 class="text-lg font-semibold text-slate-800 mb-4 flex items-center gap-2">
                <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                Media (Logo & Gambar)
            </h2>
            <div class="grid md:grid-cols-2 gap-6">
                {{-- Logo --}}
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Logo Jurusan</label>
                    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-slate-300 border-dashed rounded-xl hover:border-blue-400 transition cursor-pointer relative" onclick="document.getElementById('logo').click()">
                        <div class="space-y-1 text-center">
                            <svg class="mx-auto h-12 w-12 text-slate-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <div class="flex text-sm text-slate-600 justify-center">
                                <span class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500">Upload file</span>
                            </div>
                            <p class="text-xs text-slate-500">PNG, JPG, WEBP up to 2MB</p>
                        </div>
                        <img id="logo-preview" class="absolute inset-0 w-full h-full object-contain p-2 hidden bg-white rounded-xl">
                    </div>
                    <input id="logo" name="logo" type="file" accept="image/*" class="sr-only" onchange="previewImage(this, 'logo-preview')">
                    @error('logo')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Gambar --}}
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Gambar Jurusan</label>
                    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-slate-300 border-dashed rounded-xl hover:border-blue-400 transition cursor-pointer relative" onclick="document.getElementById('gambar').click()">
                        <div class="space-y-1 text-center">
                            <svg class="mx-auto h-12 w-12 text-slate-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <div class="flex text-sm text-slate-600 justify-center">
                                <span class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500">Upload file</span>
                            </div>
                            <p class="text-xs text-slate-500">PNG, JPG, WEBP up to 5MB</p>
                        </div>
                        <img id="gambar-preview" class="absolute inset-0 w-full h-full object-contain p-2 hidden bg-white rounded-xl">
                    </div>
                    <input id="gambar" name="gambar" type="file" accept="image/*" class="sr-only" onchange="previewImage(this, 'gambar-preview')">
                    @error('gambar')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        {{-- Pengaturan --}}
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
            <h2 class="text-lg font-semibold text-slate-800 mb-4 flex items-center gap-2">
                <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                Pengaturan
            </h2>
            <label class="flex items-center gap-3 cursor-pointer">
                <input type="checkbox" name="aktif" value="1" {{ old('aktif', true) ? 'checked' : '' }}
                    class="rounded border-slate-300 text-blue-600 focus:ring-blue-500 w-5 h-5">
                <span class="text-slate-700">Aktifkan jurusan ini (tampil di website)</span>
            </label>
        </div>

        {{-- Actions --}}
        <div class="flex gap-4">
            <button type="submit" class="btn btn-primary shadow-lg hover:shadow-xl">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                Simpan Jurusan
            </button>
            <a href="{{ route('admin.jurusan.index') }}" class="btn btn-secondary">
                Batal
            </a>
        </div>
    </form>
</div>

@push('scripts')
<script>
function previewImage(input, previewId) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const preview = document.getElementById(previewId);
            preview.src = e.target.result;
            preview.classList.remove('hidden');
        }
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endpush
@endsection
