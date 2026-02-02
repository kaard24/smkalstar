@extends('layouts.admin')

@section('title', isset($jurusan) ? 'Edit Jurusan' : 'Tambah Jurusan' . ' - Admin Panel')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="mb-8">
        <a href="{{ route('admin.jurusan.index') }}" class="inline-flex items-center text-sm text-slate-500 hover:text-[#4276A3] mb-4">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Kembali
        </a>
        <h1 class="text-2xl font-bold text-slate-800">{{ isset($jurusan) ? 'Edit Jurusan' : 'Tambah Jurusan Baru' }}</h1>
    </div>

    @if($errors->any())
    <div class="mb-6 p-4 bg-[#991B1B]/10 border border-[#991B1B]/20 text-[#991B1B] rounded-xl">
        <ul class="list-disc pl-5 space-y-1">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ isset($jurusan) ? route('admin.jurusan.update', $jurusan) : route('admin.jurusan.store') }}" 
          method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @if(isset($jurusan))
            @method('PUT')
        @endif

        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-200 bg-slate-50">
                <h2 class="font-semibold text-slate-800">Informasi Dasar</h2>
            </div>
            <div class="p-6 space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="kode" class="block text-sm font-medium text-slate-700 mb-2">Kode Jurusan <span class="text-[#991B1B]">*</span></label>
                        <input type="text" id="kode" name="kode" value="{{ old('kode', $jurusan->kode ?? '') }}" required
                            class="w-full px-4 py-3 border border-slate-300 rounded-xl focus:ring-2 focus:ring-[#4276A3] focus:border-[#4276A3] transition"
                            placeholder="TKJ">
                    </div>
                    <div>
                        <label for="kategori" class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
                        <input type="text" id="kategori" name="kategori" value="{{ old('kategori', $jurusan->kategori ?? '') }}"
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition"
                            placeholder="Teknologi, Manajemen, Keuangan, Bisnis">
                    </div>
                </div>

                <div>
                    <label for="nama" class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap <span class="text-red-500">*</span></label>
                    <input type="text" id="nama" name="nama" value="{{ old('nama', $jurusan->nama ?? '') }}" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition"
                        placeholder="Teknik Komputer dan Jaringan">
                </div>

                <div>
                    <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                    <textarea id="deskripsi" name="deskripsi" rows="4"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition"
                        placeholder="Deskripsi singkat tentang jurusan ini...">{{ old('deskripsi', $jurusan->deskripsi ?? '') }}</textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Gambar</label>
                    @if(isset($jurusan) && $jurusan->gambar_url)
                    <div class="mb-3">
                        <img src="{{ $jurusan->gambar_url }}" alt="{{ $jurusan->nama }}" class="w-48 h-32 object-cover rounded-lg border" loading="lazy" decoding="async">
                    </div>
                    @endif
                    <input type="file" id="gambar" name="gambar" accept="image/*"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-[#4276A3]/10 file:text-[#4276A3] hover:file:bg-[#4276A3]/20">
                    <p class="mt-1 text-xs text-slate-500">Format: JPG, PNG, WebP. Maks. 2MB.</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
                <h2 class="font-semibold text-gray-900">Peluang Karir</h2>
            </div>
            <div class="p-6" x-data="{ items: {{ json_encode(old('peluang_karir', $jurusan->peluang_karir ?? [''])) }} }">
                <div class="space-y-3">
                    <template x-for="(item, index) in items" :key="index">
                        <div class="flex items-center gap-3">
                            <input type="text" :name="'peluang_karir[' + index + ']'" x-model="items[index]"
                                class="flex-1 px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition"
                                placeholder="Contoh: Network Engineer">
                            <button type="button" @click="items.splice(index, 1)" class="text-[#991B1B] hover:text-[#7F1D1D] p-2" x-show="items.length > 1">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            </button>
                        </div>
                    </template>
                </div>
                <button type="button" @click="items.push('')" class="mt-4 inline-flex items-center gap-2 text-[#4276A3] hover:text-[#334155] font-medium text-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                    Tambah Peluang Karir
                </button>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
                <h2 class="font-semibold text-gray-900">Pengaturan</h2>
            </div>
            <div class="p-6 space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="urutan" class="block text-sm font-medium text-gray-700 mb-2">Urutan Tampil</label>
                        <input type="number" id="urutan" name="urutan" value="{{ old('urutan', $jurusan->urutan ?? 0) }}"
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition">
                        <p class="mt-1 text-xs text-gray-500">Semakin kecil angka, semakin atas posisinya.</p>
                    </div>
                    <div class="flex items-center pt-8">
                        <label class="flex items-center cursor-pointer">
                            <input type="checkbox" name="aktif" value="1" {{ old('aktif', $jurusan->aktif ?? true) ? 'checked' : '' }}
                                class="w-5 h-5 text-[#4276A3] border-slate-300 rounded focus:ring-[#4276A3]">
                            <span class="ml-3 text-sm font-medium text-gray-700">Tampilkan di Website</span>
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex justify-end gap-4">
            <a href="{{ route('admin.jurusan.index') }}" class="btn btn-secondary btn-lg">
                Batal
            </a>
            <button type="submit" class="btn btn-primary btn-lg shadow-sm hover:shadow-md">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                {{ isset($jurusan) ? 'Simpan Perubahan' : 'Tambah Jurusan' }}
            </button>
        </div>
    </form>
</div>

<script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
@endsection
