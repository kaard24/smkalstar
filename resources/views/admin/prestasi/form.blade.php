@extends('layouts.admin')

@section('title', isset($prestasi) ? 'Edit Prestasi' : 'Tambah Prestasi' . ' - Admin Panel')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="mb-8">
        <a href="{{ route('admin.prestasi.index') }}" class="inline-flex items-center text-sm text-gray-500 hover:text-primary mb-4">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Kembali
        </a>
        <h1 class="text-2xl font-bold text-gray-900">{{ isset($prestasi) ? 'Edit Prestasi' : 'Tambah Prestasi Baru' }}</h1>
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

    <form action="{{ isset($prestasi) ? route('admin.prestasi.update', $prestasi) : route('admin.prestasi.store') }}" 
          method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @if(isset($prestasi))
            @method('PUT')
        @endif

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
                <h2 class="font-semibold text-gray-900">Informasi Prestasi</h2>
            </div>
            <div class="p-6 space-y-6">
                <div>
                    <label for="judul" class="block text-sm font-medium text-gray-700 mb-2">Judul Prestasi <span class="text-red-500">*</span></label>
                    <input type="text" id="judul" name="judul" value="{{ old('judul', $prestasi->judul ?? '') }}" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition"
                        placeholder="Contoh: Juara 1 Lomba Debat Bahasa Inggris">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="tingkat" class="block text-sm font-medium text-gray-700 mb-2">Tingkat <span class="text-red-500">*</span></label>
                        <select id="tingkat" name="tingkat" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition">
                            <option value="">Pilih Tingkat</option>
                            <option value="Sekolah" {{ old('tingkat', $prestasi->tingkat ?? '') == 'Sekolah' ? 'selected' : '' }}>Sekolah</option>
                            <option value="Kecamatan" {{ old('tingkat', $prestasi->tingkat ?? '') == 'Kecamatan' ? 'selected' : '' }}>Kecamatan</option>
                            <option value="Kabupaten" {{ old('tingkat', $prestasi->tingkat ?? '') == 'Kabupaten' ? 'selected' : '' }}>Kabupaten/Kota</option>
                            <option value="Provinsi" {{ old('tingkat', $prestasi->tingkat ?? '') == 'Provinsi' ? 'selected' : '' }}>Provinsi</option>
                            <option value="Nasional" {{ old('tingkat', $prestasi->tingkat ?? '') == 'Nasional' ? 'selected' : '' }}>Nasional</option>
                            <option value="Internasional" {{ old('tingkat', $prestasi->tingkat ?? '') == 'Internasional' ? 'selected' : '' }}>Internasional</option>
                        </select>
                    </div>
                    <div>
                        <label for="tahun" class="block text-sm font-medium text-gray-700 mb-2">Tahun <span class="text-red-500">*</span></label>
                        <input type="number" id="tahun" name="tahun" value="{{ old('tahun', $prestasi->tahun ?? date('Y')) }}" required min="2000" max="2100"
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition"
                            placeholder="{{ date('Y') }}">
                    </div>
                </div>

                <div>
                    <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                    <textarea id="deskripsi" name="deskripsi" rows="3"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition"
                        placeholder="Deskripsi singkat mengenai prestasi ini">{{ old('deskripsi', $prestasi->deskripsi ?? '') }}</textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Galeri Dokumentsi</label>
                    @if(isset($prestasi) && !empty($prestasi->gambar_urls))
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4 mb-4">
                        @foreach($prestasi->gambar_urls as $index => $url)
                        <div class="relative group">
                            <img src="{{ $url }}" alt="{{ $prestasi->judul }} {{ $index + 1 }}" class="w-full h-32 object-cover rounded-lg border">
                            <label class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center cursor-pointer rounded-lg">
                                <input type="checkbox" name="hapus_gambar[]" value="{{ $index }}" class="peer sr-only">
                                <div class="text-white text-sm bg-red-600 px-3 py-1 rounded shadow peer-checked:bg-red-800">
                                    <span class="peer-checked:hidden">Hapus</span>
                                    <span class="hidden peer-checked:inline">Akan Dihapus</span>
                                </div>
                            </label>
                            <div class="absolute top-2 right-2">
                                <input type="checkbox" name="hapus_gambar[]" value="{{ $index }}" class="w-5 h-5 text-red-600 rounded border-gray-300 focus:ring-red-500">
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <p class="mb-3 text-xs text-gray-500">Centang kotak pada gambar yang ingin dihapus.</p>
                    @endif

                    <div class="border-2 border-dashed border-gray-300 rounded-xl p-6 text-center hover:bg-gray-50 transition cursor-pointer" onclick="document.getElementById('gambar').click()">
                        <svg class="w-10 h-10 text-gray-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        <p class="text-sm text-gray-600 font-medium">Klik untuk upload gambar baru</p>
                        <p class="text-xs text-gray-400 mt-1">Bisa pilih lebih dari satu gambar (JPG, PNG. Max 2MB)</p>
                    </div>
                    <input type="file" id="gambar" name="gambar[]" accept="image/*" multiple class="hidden">
                    <div id="file-count" class="mt-2 text-sm text-primary font-medium hidden"></div>
                </div>

                <script>
                    document.getElementById('gambar').addEventListener('change', function(e) {
                        const count = e.target.files.length;
                        const display = document.getElementById('file-count');
                        if (count > 0) {
                            display.textContent = count + ' file dipilih untuk diupload';
                            display.classList.remove('hidden');
                        } else {
                            display.classList.add('hidden');
                        }
                    });
                </script>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="urutan" class="block text-sm font-medium text-gray-700 mb-2">Urutan Tampil</label>
                        <input type="number" id="urutan" name="urutan" value="{{ old('urutan', $prestasi->urutan ?? 0) }}"
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition">
                    </div>
                    <div class="flex items-center pt-8">
                        <label class="flex items-center cursor-pointer">
                            <input type="checkbox" name="aktif" value="1" {{ old('aktif', $prestasi->aktif ?? true) ? 'checked' : '' }}
                                class="w-5 h-5 text-primary border-gray-300 rounded focus:ring-primary">
                            <span class="ml-3 text-sm font-medium text-gray-700">Tampilkan di Website</span>
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex justify-end gap-4">
            <a href="{{ route('admin.prestasi.index') }}" class="px-6 py-3 border border-gray-300 text-gray-700 rounded-xl font-semibold hover:bg-gray-50 transition">
                Batal
            </a>
            <button type="submit" class="px-8 py-3 bg-primary text-white rounded-xl font-semibold hover:bg-secondary transition shadow-lg shadow-primary/25">
                {{ isset($prestasi) ? 'Simpan Perubahan' : 'Tambah Prestasi' }}
            </button>
        </div>
    </form>
</div>
@endsection
