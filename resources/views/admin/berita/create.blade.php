@extends('layouts.admin')

@section('title', 'Tambah Berita - Admin Panel')

@section('content')
<div class="max-w-3xl mx-auto">
    {{-- Error Messages --}}
    @if($errors->any())
    <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-700 rounded-lg">
        <div class="flex items-start gap-3">
            <svg class="w-5 h-5 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <div>
                <p class="font-medium">Terdapat kesalahan:</p>
                <ul class="mt-1 list-disc list-inside text-sm">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    @endif

    <form action="{{ route('admin.berita.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- Judul --}}
        <div class="mb-6">
            <label for="judul" class="block text-sm font-semibold text-slate-700 mb-2">
                Judul Berita <span class="text-red-500">*</span>
            </label>
            <input type="text" id="judul" name="judul" value="{{ old('judul') }}" required
                   placeholder="Masukkan judul berita"
                   class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:ring-2 focus:ring-[#4276A3] focus:border-[#4276A3] transition-colors"
                   autofocus>
        </div>

        {{-- Isi Berita --}}
        <div class="mb-6">
            <label for="isi" class="block text-sm font-semibold text-slate-700 mb-2">
                Isi Berita <span class="text-red-500">*</span>
            </label>
            <textarea id="isi" name="isi" rows="12" required
                      class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:ring-2 focus:ring-[#4276A3] focus:border-[#4276A3] transition-colors resize-y"
                      placeholder="Tulis isi berita di sini...">{{ old('isi') }}</textarea>
            <p class="text-xs text-slate-500 mt-1.5">Gunakan enter untuk membuat paragraf baru.</p>
        </div>

        {{-- Gambar --}}
        <div class="mb-6">
            <label for="gambar" class="block text-sm font-semibold text-slate-700 mb-2">
                Gambar <span class="text-slate-400 font-normal">(Opsional)</span>
            </label>
            <div class="border border-slate-300 border-dashed rounded-lg p-4 bg-slate-50 hover:bg-slate-100 transition-colors">
                <input type="file" id="gambar" name="gambar[]" accept="image/*" multiple
                       class="block w-full text-sm text-slate-600 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-medium file:bg-[#4276A3] file:text-white hover:file:bg-[#365f85] file:transition-colors cursor-pointer">
            </div>
            <p class="text-xs text-slate-500 mt-1.5">Format: JPG, PNG, WebP. Maksimal 2MB per file.</p>
        </div>

        {{-- Tanggal Publish --}}
        <div class="mb-8">
            <label for="published_at" class="block text-sm font-semibold text-slate-700 mb-2">
                Tanggal Publish <span class="text-slate-400 font-normal">(Opsional)</span>
            </label>
            <input type="datetime-local" id="published_at" name="published_at" 
                   value="{{ old('published_at', now()->format('Y-m-d\TH:i')) }}"
                   class="w-full sm:w-auto px-4 py-2.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-[#4276A3] focus:border-[#4276A3] transition-colors">
            <p class="text-xs text-slate-500 mt-1.5">Kosongkan untuk mempublikasikan sekarang.</p>
        </div>

        {{-- Action Buttons --}}
        <div class="flex items-center justify-end gap-3 pt-4 border-t border-slate-200">
            <a href="{{ route('admin.berita.index') }}" 
               class="px-5 py-2.5 text-sm font-medium text-slate-600 bg-white border border-slate-300 rounded-lg hover:bg-slate-50 transition-colors">
                Batal
            </a>
            <button type="submit" 
                    class="px-5 py-2.5 text-sm font-medium text-white bg-[#4276A3] rounded-lg hover:bg-[#365f85] transition-colors flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                Simpan
            </button>
        </div>
    </form>
</div>
@endsection
