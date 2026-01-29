@extends('layouts.admin')

@section('title', 'Edit Berita - Admin Panel')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="mb-8">
        <a href="{{ route('admin.berita.index') }}" class="text-primary hover:text-secondary inline-flex items-center gap-1 mb-4">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali ke Daftar Berita
        </a>
        <h1 class="text-2xl font-bold text-gray-900">Edit Berita</h1>
        <p class="text-gray-600">Perbarui informasi berita.</p>
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

    <form action="{{ route('admin.berita.update', $berita->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
                <h2 class="font-semibold text-gray-900">Detail Berita</h2>
            </div>
            <div class="p-6 space-y-4">
                <div>
                    <label for="judul" class="block text-sm font-medium text-gray-700 mb-1">Judul Berita <span class="text-red-500">*</span></label>
                    <input type="text" id="judul" name="judul" value="{{ old('judul', $berita->judul) }}" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition"
                        placeholder="Masukkan judul berita">
                </div>

                <div>
                    <label for="isi" class="block text-sm font-medium text-gray-700 mb-1">Isi Berita <span class="text-red-500">*</span></label>
                    <textarea id="isi" name="isi" rows="10" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition"
                        placeholder="Tulis isi berita...">{{ old('isi', $berita->isi) }}</textarea>
                </div>

                {{-- Existing Images --}}
                @if(!empty($berita->gambar) && count($berita->gambar) > 0)
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Gambar Saat Ini</label>
                    <div class="grid grid-cols-3 gap-4">
                        @foreach($berita->gambar_urls as $index => $url)
                        <div class="relative group">
                            <img src="{{ $url }}" alt="Gambar {{ $index + 1 }}" class="w-full h-32 object-cover rounded-lg">
                            <label class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center cursor-pointer">
                                <input type="checkbox" name="hapus_gambar[]" value="{{ $index }}" class="sr-only peer">
                                <span class="text-white text-sm peer-checked:bg-red-500 px-3 py-1 rounded-lg bg-gray-800/80">
                                    <span class="peer-checked:hidden">Klik untuk hapus</span>
                                </span>
                            </label>
                            <div class="absolute top-2 right-2">
                                <input type="checkbox" name="hapus_gambar[]" value="{{ $index }}" id="hapus_{{ $index }}" class="w-4 h-4 text-red-600 rounded border-gray-300 focus:ring-red-500">
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <p class="mt-2 text-xs text-gray-500">Centang gambar yang ingin dihapus.</p>
                </div>
                @endif

                <div>
                    <label for="gambar" class="block text-sm font-medium text-gray-700 mb-1">Tambah Gambar Baru</label>
                    <input type="file" id="gambar" name="gambar[]" accept="image/*" multiple
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-primary/10 file:text-primary hover:file:bg-primary/20">
                    <p class="mt-1 text-xs text-gray-500">Format: JPG, PNG, WebP. Maks. 2MB per file.</p>
                </div>

                <div>
                    <label for="published_at" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Publish</label>
                    <input type="datetime-local" id="published_at" name="published_at" value="{{ old('published_at', $berita->published_at ? $berita->published_at->format('Y-m-d\TH:i') : '') }}"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition">
                </div>
            </div>
        </div>

        <div class="flex gap-4 justify-end">
            <a href="{{ route('admin.berita.index') }}" class="px-6 py-3 border border-gray-300 text-gray-700 rounded-xl font-semibold hover:bg-gray-50 transition">
                Batal
            </a>
            <button type="submit" class="px-8 py-3 bg-primary text-white rounded-xl font-semibold hover:bg-secondary transition shadow-lg shadow-primary/25">
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection
