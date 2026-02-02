@extends('layouts.admin')

@section('title', 'Edit Sejarah - Admin Panel')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-900">Edit Sejarah Sekolah</h1>
        <p class="text-gray-600">Kelola konten sejarah sekolah yang ditampilkan ke publik.</p>
    </div>

    @if(session('success'))
    <div class="mb-6 p-4 bg-blue-50 border border-blue-200 text-blue-700 rounded-xl flex items-center gap-2">
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

    <form action="{{ route('admin.profil-sekolah.update-sejarah') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

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
                    <label class="block text-sm font-medium text-gray-700 mb-2">Galeri Gambar Sejarah</label>
                    
                    @if(!empty($profil->sejarah_gambar) && count($profil->sejarah_gambar_urls) > 0)
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4 mb-4">
                        @foreach($profil->sejarah_gambar_urls as $index => $url)
                        <div class="relative group">
                            <img src="{{ $url }}" alt="Gambar Sejarah {{ $index + 1 }}" class="w-full h-32 object-cover rounded-lg border" loading="lazy" decoding="async">
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

                    <div class="border-2 border-dashed border-gray-300 rounded-xl p-6 text-center hover:bg-gray-50 transition cursor-pointer" onclick="document.getElementById('sejarah_gambar').click()">
                        <svg class="w-10 h-10 text-gray-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        <p class="text-sm text-gray-600 font-medium">Klik untuk upload gambar baru</p>
                        <p class="text-xs text-gray-400 mt-1">Bisa pilih lebih dari satu gambar (JPG, PNG. Max 2MB)</p>
                    </div>
                    <input type="file" id="sejarah_gambar" name="sejarah_gambar[]" accept="image/*" multiple class="hidden">
                    <div id="file-count" class="mt-2 text-sm text-primary font-medium hidden"></div>
                </div>
            </div>
        </div>

        <div class="flex justify-end gap-4">
            <a href="{{ url('/profil') }}#sejarah" target="_blank" class="px-6 py-3 border border-gray-300 text-gray-700 rounded-xl font-semibold hover:bg-gray-50 transition">
                Lihat Halaman
            </a>
            <button type="submit" class="px-8 py-3 bg-primary text-white rounded-xl font-semibold hover:bg-secondary transition shadow-lg shadow-primary/25">
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>

<script>
    document.getElementById('sejarah_gambar').addEventListener('change', function(e) {
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
@endsection
