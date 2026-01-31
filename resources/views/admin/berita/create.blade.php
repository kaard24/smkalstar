@extends('layouts.admin')

@section('title', 'Tambah Berita - Admin Panel')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="mb-8">
        <a href="{{ route('admin.berita.index') }}" class="text-primary hover:text-secondary inline-flex items-center gap-1 mb-4">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali ke Daftar Berita
        </a>
        <h1 class="text-2xl font-bold text-gray-900">Tambah Berita</h1>
        <p class="text-gray-600">Buat berita baru untuk website sekolah.</p>
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

    <form action="{{ route('admin.berita.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
                <h2 class="font-semibold text-gray-900">Detail Berita</h2>
            </div>
            <div class="p-6 space-y-4">
                <div>
                    <label for="judul" class="block text-sm font-medium text-gray-700 mb-1">Judul Berita <span class="text-red-500">*</span></label>
                    <input type="text" id="judul" name="judul" value="{{ old('judul') }}" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition"
                        placeholder="Masukkan judul berita">
                </div>

                <div>
                    <label for="isi" class="block text-sm font-medium text-gray-700 mb-1">Isi Berita <span class="text-red-500">*</span></label>
                    <textarea id="isi" name="isi" rows="10" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition tinymce-editor"
                        placeholder="Tulis isi berita...">{{ old('isi') }}</textarea>
                    <p class="mt-1 text-xs text-gray-500">Gunakan editor untuk memformat teks, menambahkan link, gambar, dan lainnya.</p>
                </div>

                <div>
                    <label for="gambar" class="block text-sm font-medium text-gray-700 mb-1">Gambar (bisa lebih dari satu)</label>
                    <input type="file" id="gambar" name="gambar[]" accept="image/*" multiple
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-primary/10 file:text-primary hover:file:bg-primary/20">
                    <p class="mt-1 text-xs text-gray-500">Format: JPG, PNG, WebP. Maks. 2MB per file. Pilih beberapa file sekaligus.</p>
                </div>

                <div>
                    <label for="published_at" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Publish</label>
                    <input type="datetime-local" id="published_at" name="published_at" value="{{ old('published_at', now()->format('Y-m-d\TH:i')) }}"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition">
                </div>
            </div>
        </div>

        <div class="flex gap-4 justify-end">
            <a href="{{ route('admin.berita.index') }}" class="px-6 py-3 border border-gray-300 text-gray-700 rounded-xl font-semibold hover:bg-gray-50 transition">
                Batal
            </a>
            <button type="submit" class="px-8 py-3 bg-primary text-white rounded-xl font-semibold hover:bg-secondary transition shadow-lg shadow-primary/25">
                Publikasikan Berita
            </button>
        </div>
    </form>
</div>

{{-- TinyMCE Rich Text Editor --}}
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: '.tinymce-editor',
        height: 400,
        plugins: [
            'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
            'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
            'insertdatetime', 'media', 'table', 'help', 'wordcount'
        ],
        toolbar: 'undo redo | blocks | bold italic forecolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media table | removeformat code help',
        menubar: 'file edit view insert format tools table help',
        content_style: 'body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif; font-size: 16px; }',
        branding: false,
        promotion: false,
        images_upload_url: '/upload-image',
        automatic_uploads: true,
        file_picker_types: 'image',
        images_file_types: 'jpg,jpeg,png,gif,webp',
        setup: function (editor) {
            editor.on('change', function () {
                editor.save();
            });
        }
    });
</script>
@endsection
