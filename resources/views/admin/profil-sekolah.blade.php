@extends('layouts.admin')

@section('title', 'Edit Profil Sekolah - Admin Panel')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-900">Edit Profil Sekolah</h1>
        <p class="text-gray-600">Kelola konten halaman profil sekolah yang ditampilkan ke publik.</p>
    </div>

    @if(session('success'))
    <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-700 rounded-xl flex items-center gap-2">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
        {{ session('success') }}
    </div>
    @endif

    @if($errors->any())
    <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-700 rounded-xl">
        <ul class="list-disc pl-5 space-y-1">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('admin.profil-sekolah.update') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
        @csrf
        @method('PUT')

        {{-- Sejarah Section --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
                <h2 class="font-semibold text-gray-900 flex items-center gap-2">
                    <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13c-1.168-.776-2.754-1.253-4.5-1.253-1.746 0-3.332.477-4.5 1.253"></path></svg>
                    Sejarah Sekolah
                </h2>
            </div>
            <div class="p-6 space-y-6">
                <div>
                    <label for="sejarah_judul" class="block text-sm font-medium text-gray-700 mb-2">Judul Sejarah</label>
                    <input type="text" id="sejarah_judul" name="sejarah_judul" value="{{ old('sejarah_judul', $profil->sejarah_judul) }}" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition">
                </div>

                <div>
                    <label for="sejarah_konten" class="block text-sm font-medium text-gray-700 mb-2">Konten Sejarah</label>
                    <textarea id="sejarah_konten" name="sejarah_konten" rows="8" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition">{{ old('sejarah_konten', $profil->sejarah_konten) }}</textarea>
                    <p class="mt-1 text-xs text-gray-500">Gunakan baris baru untuk memisahkan paragraf.</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Gambar Sejarah</label>
                    @if($profil->sejarah_gambar)
                    <div class="mb-3">
                        <img src="{{ str_starts_with($profil->sejarah_gambar, 'http') ? $profil->sejarah_gambar : asset('storage/' . $profil->sejarah_gambar) }}" loading="lazy" decoding="async" 
                             alt="Gambar Sejarah" class="w-48 h-32 object-cover rounded-lg border">
                    </div>
                    @endif
                    <input type="file" id="sejarah_gambar" name="sejarah_gambar" accept="image/*"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-primary/10 file:text-primary hover:file:bg-primary/20">
                    <p class="mt-1 text-xs text-gray-500">Format: JPG, PNG, WebP. Maks. 2MB.</p>
                </div>
            </div>
        </div>

        {{-- Visi Section --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
                <h2 class="font-semibold text-gray-900 flex items-center gap-2">
                    <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                    Visi
                </h2>
            </div>
            <div class="p-6">
                <textarea id="visi" name="visi" rows="3" required
                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition">{{ old('visi', $profil->visi) }}</textarea>
            </div>
        </div>

        {{-- Misi Section --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
                <h2 class="font-semibold text-gray-900 flex items-center gap-2">
                    <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                    Misi
                </h2>
            </div>
            <div class="p-6" x-data="{ misiItems: {{ json_encode(old('misi', $profil->misi ?? [])) }} }">
                <div class="space-y-3" id="misi-list">
                    <template x-for="(item, index) in misiItems" :key="index">
                        <div class="flex items-center gap-3">
                            <span class="bg-green-100 text-primary rounded-full w-6 h-6 flex items-center justify-center text-xs font-bold flex-shrink-0" x-text="index + 1"></span>
                            <input type="text" :name="'misi[' + index + ']'" x-model="misiItems[index]" required
                                class="flex-1 px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition">
                            <button type="button" @click="misiItems.splice(index, 1)" class="text-red-500 hover:text-red-700 p-2" x-show="misiItems.length > 1">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            </button>
                        </div>
                    </template>
                </div>
                <button type="button" @click="misiItems.push('')" class="mt-4 inline-flex items-center gap-2 text-primary hover:text-secondary font-medium text-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                    Tambah Misi
                </button>
            </div>
        </div>

        {{-- Struktur Organisasi Section --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
                <h2 class="font-semibold text-gray-900 flex items-center gap-2">
                    <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    Struktur Organisasi
                </h2>
            </div>
            <div class="p-6">
                @if($profil->struktur_organisasi_gambar)
                <div class="mb-4 relative inline-block">
                    <img src="{{ str_starts_with($profil->struktur_organisasi_gambar, 'http') ? $profil->struktur_organisasi_gambar : asset('storage/' . $profil->struktur_organisasi_gambar) }}" loading="lazy" decoding="async" 
                         alt="Struktur Organisasi" class="max-w-full h-auto rounded-lg border">
                    <form action="{{ route('admin.profil-sekolah.delete-struktur') }}" method="POST" class="inline absolute top-2 right-2">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Hapus gambar struktur organisasi?')" 
                            class="bg-red-500 hover:bg-red-600 text-white p-2 rounded-lg shadow-lg">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                        </button>
                    </form>
                </div>
                @else
                <div class="bg-gray-50 border-2 border-dashed border-gray-300 rounded-xl p-8 text-center mb-4">
                    <svg class="w-12 h-12 text-gray-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    <p class="text-gray-500 text-sm">Belum ada gambar struktur organisasi</p>
                </div>
                @endif
                <input type="file" id="struktur_organisasi_gambar" name="struktur_organisasi_gambar" accept="image/*"
                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-primary/10 file:text-primary hover:file:bg-primary/20">
                <p class="mt-1 text-xs text-gray-500">Format: JPG, PNG, WebP. Maks. 2MB. Rekomendasi ukuran: 1200x800px.</p>
            </div>
        </div>

        {{-- Submit Button --}}
        <div class="flex justify-end gap-4">
            <a href="{{ url('/profil') }}" target="_blank" class="px-6 py-3 border border-gray-300 text-gray-700 rounded-xl font-semibold hover:bg-gray-50 transition">
                Lihat Halaman Profil
            </a>
            <button type="submit" class="px-8 py-3 bg-primary text-white rounded-xl font-semibold hover:bg-secondary transition shadow-lg shadow-primary/25">
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>

<script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
@endsection
