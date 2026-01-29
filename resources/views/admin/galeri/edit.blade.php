@extends('layouts.admin')

@section('title', 'Edit Foto Galeri - Admin Panel')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="mb-8">
        <a href="{{ route('admin.galeri.index') }}" class="text-primary hover:text-secondary inline-flex items-center gap-1 mb-4">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali ke Galeri
        </a>
        <h1 class="text-2xl font-bold text-gray-900">Edit Foto Galeri</h1>
        <p class="text-gray-600">Perbarui informasi foto galeri.</p>
    </div>

    @if($errors->any())
    <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-700 rounded-xl">
        <ul class="list-disc pl-5 space-y-1">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('admin.galeri.update', $galeri->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
                <h2 class="font-semibold text-gray-900">Detail Foto</h2>
            </div>
            <div class="p-6 space-y-4">
                {{-- Current Image Preview --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Foto Saat Ini</label>
                    <div class="w-48 h-48 rounded-xl overflow-hidden bg-gray-100">
                        <img src="{{ $galeri->gambar_url }}" alt="{{ $galeri->keterangan ?? 'Galeri' }}" class="w-full h-full object-cover">
                    </div>
                </div>

                <div>
                    <label for="gambar" class="block text-sm font-medium text-gray-700 mb-1">Ganti Foto</label>
                    <input type="file" id="gambar" name="gambar" accept="image/*"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-primary/10 file:text-primary hover:file:bg-primary/20">
                    <p class="mt-1 text-xs text-gray-500">Kosongkan jika tidak ingin mengganti foto. Format: JPG, PNG, WebP. Maks. 2MB.</p>
                </div>

                <div>
                    <label for="keterangan" class="block text-sm font-medium text-gray-700 mb-1">Keterangan</label>
                    <input type="text" id="keterangan" name="keterangan" value="{{ old('keterangan', $galeri->keterangan) }}"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition"
                        placeholder="Keterangan singkat tentang foto ini">
                </div>

                <div>
                    <label for="urutan" class="block text-sm font-medium text-gray-700 mb-1">Urutan</label>
                    <input type="number" id="urutan" name="urutan" value="{{ old('urutan', $galeri->urutan) }}" min="0"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition"
                        placeholder="0">
                </div>
            </div>
        </div>

        <div class="flex gap-4 justify-end">
            <a href="{{ route('admin.galeri.index') }}" class="px-6 py-3 border border-gray-300 text-gray-700 rounded-xl font-semibold hover:bg-gray-50 transition">
                Batal
            </a>
            <button type="submit" class="px-8 py-3 bg-primary text-white rounded-xl font-semibold hover:bg-secondary transition shadow-lg shadow-primary/25">
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection
