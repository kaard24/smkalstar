@extends('layouts.admin')

@section('title', 'Tambah Berita - Admin Panel')

@section('content')
<div class="max-w-4xl mx-auto">
    {{-- Breadcrumb --}}
    <div class="mb-6">
        <a href="{{ route('admin.berita.index') }}" class="inline-flex items-center gap-2 text-gray-600 hover:text-primary font-semibold text-lg">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Kembali ke Daftar Berita
        </a>
    </div>

    {{-- Header --}}
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-2">Tambah Berita Baru</h1>
        <p class="text-lg text-gray-600">Buat artikel berita untuk ditampilkan di website sekolah</p>
    </div>

    {{-- Error Messages --}}
    @if($errors->any())
    <div class="mb-6 p-5 bg-red-50 border-2 border-red-300 text-red-800 rounded-xl">
        <p class="font-bold mb-2 text-lg">Terdapat kesalahan:</p>
        <ul class="list-disc list-inside text-base">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('admin.berita.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <div class="bg-white rounded-xl card-solid overflow-hidden">
            <div class="px-6 py-4 border-b-2 border-gray-200 bg-gray-50">
                <h2 class="font-bold text-xl text-gray-900 flex items-center gap-2">
                    <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                    Isi Berita
                </h2>
            </div>
            <div class="p-6 space-y-6">
                {{-- Judul --}}
                <div>
                    <label for="judul" class="block text-lg font-bold text-gray-800 mb-3">
                        Judul Berita <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="judul" name="judul" value="{{ old('judul') }}" required
                           placeholder="Masukkan judul berita yang menarik"
                           class="w-full px-4 input-large border-2 border-gray-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary">
                    <p class="text-base text-gray-500 mt-2">Tips: Gunakan judul yang jelas dan menarik pembaca</p>
                </div>

                {{-- Isi Berita --}}
                <div>
                    <label for="isi" class="block text-lg font-bold text-gray-800 mb-3">
                        Isi Berita <span class="text-red-500">*</span>
                    </label>
                    <textarea id="isi" name="isi" rows="12" required
                              class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary text-lg tinymce-editor"
                              placeholder="Tulis isi berita lengkap di sini...">{{ old('isi') }}</textarea>
                    <p class="text-base text-gray-500 mt-2">
                        <span class="font-semibold">Petunjuk:</span> Gunakan toolbar di atas untuk memformat teks (bold, list, dll). 
                        Bisa juga menambahkan gambar di dalam artikel.
                    </p>
                </div>

                {{-- Gambar --}}
                <div>
                    <label for="gambar" class="block text-lg font-bold text-gray-800 mb-3">
                        Gambar Berita <span class="text-gray-500 font-normal">(Opsional)</span>
                    </label>
                    <div class="border-2 border-dashed border-gray-300 rounded-xl p-6 bg-gray-50">
                        <input type="file" id="gambar" name="gambar[]" accept="image/*" multiple
                               class="w-full text-base text-gray-700 file:mr-4 file:py-3 file:px-6 file:rounded-lg file:border-0 file:text-base file:font-bold file:bg-primary file:text-white hover:file:bg-green-800 cursor-pointer">
                        <p class="text-base text-gray-500 mt-3">
                            Format yang diterima: JPG, PNG, WebP. Maksimal 2MB per file.<br>
                            Bisa pilih lebih dari satu gambar sekaligus.
                        </p>
                    </div>
                </div>

                {{-- Tanggal Publish --}}
                <div>
                    <label for="published_at" class="block text-lg font-bold text-gray-800 mb-3">
                        Tanggal Publish <span class="text-gray-500 font-normal">(Opsional)</span>
                    </label>
                    <input type="datetime-local" id="published_at" name="published_at" 
                           value="{{ old('published_at', now()->format('Y-m-d\TH:i')) }}"
                           class="w-full px-4 input-large border-2 border-gray-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary">
                    <p class="text-base text-gray-500 mt-2">Jika dikosongkan, berita akan dipublikasikan sekarang</p>
                </div>
            </div>
        </div>

        {{-- Action Buttons --}}
        <div class="flex flex-col sm:flex-row gap-4 justify-end">
            <a href="{{ route('admin.berita.index') }}" 
               class="btn-large bg-gray-200 text-gray-700 hover:bg-gray-300 text-center flex items-center justify-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
                Batal
            </a>
            <button type="submit" 
                    class="btn-large bg-primary text-white hover:bg-green-800 flex items-center justify-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                Simpan & Publikasikan
            </button>
        </div>
    </form>
</div>

{{-- TinyMCE Rich Text Editor --}}
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: '.tinymce-editor',
        height: 500,
        plugins: [
            'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
            'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
            'insertdatetime', 'media', 'table', 'help', 'wordcount'
        ],
        toolbar: 'undo redo | blocks | bold italic forecolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media table | removeformat code help',
        menubar: 'file edit view insert format tools table help',
        content_style: 'body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif; font-size: 18px; line-height: 1.8; }',
        branding: false,
        promotion: false,
        setup: function (editor) {
            editor.on('change', function () {
                editor.save();
            });
        }
    });
</script>
@endsection
