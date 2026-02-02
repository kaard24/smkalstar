@extends('layouts.admin')

@section('title', 'Kelola Berita - Admin Panel')

@section('content')
<div class="max-w-6xl mx-auto">
    {{-- Header --}}
    <div class="mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Kelola Berita</h1>
            <p class="text-lg text-gray-600">Tambah, edit, atau hapus artikel berita di website</p>
        </div>
        <a href="{{ route('admin.berita.create') }}" 
           class="btn-large bg-primary text-white hover:bg-green-800 transition shadow-lg flex items-center justify-center gap-2">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
            </svg>
            Tambah Berita Baru
        </a>
    </div>

    {{-- Alert Messages --}}
    @if(session('success'))
    <div class="mb-6 p-5 bg-green-50 border-2 border-green-300 text-green-800 rounded-xl flex items-center gap-3 text-lg">
        <svg class="w-7 h-7 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
        </svg>
        {{ session('success') }}
    </div>
    @endif

    {{-- Empty State --}}
    @if($berita->isEmpty())
    <div class="bg-white rounded-2xl card-solid p-12 text-center">
        <svg class="w-20 h-20 text-gray-300 mx-auto mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
        </svg>
        <h3 class="text-2xl font-bold text-gray-700 mb-3">Belum Ada Berita</h3>
        <p class="text-lg text-gray-500 mb-6">Mulai dengan menambahkan berita pertama untuk website sekolah.</p>
        <a href="{{ route('admin.berita.create') }}" 
           class="btn-large bg-primary text-white hover:bg-green-800 inline-flex items-center gap-2">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
            </svg>
            Tambah Berita Pertama
        </a>
    </div>
    
    @else
    {{-- Berita Table --}}
    <div class="bg-white rounded-xl card-solid overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-100 border-b-2 border-gray-300">
                    <tr>
                        <th class="px-6 py-5 text-left font-bold text-gray-800 text-lg">Judul Berita</th>
                        <th class="px-6 py-5 text-center font-bold text-gray-800 text-lg">Komentar</th>
                        <th class="px-6 py-5 text-center font-bold text-gray-800 text-lg">Tanggal</th>
                        <th class="px-6 py-5 text-center font-bold text-gray-800 text-lg">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($berita as $item)
                    <tr class="hover:bg-green-50 transition">
                        <td class="px-6 py-5">
                            <div class="flex items-center gap-4">
                                @if($item->gambar_utama)
                                <img src="{{ $item->gambar_utama }}" alt="{{ $item->judul }}" class="w-20 h-20 object-cover rounded-lg border-2 border-gray-200" loading="lazy" decoding="async">
                                @else
                                <div class="w-20 h-20 bg-gray-100 rounded-lg flex items-center justify-center border-2 border-gray-200">
                                    <svg class="w-10 h-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                @endif
                                <div>
                                    <h4 class="font-bold text-gray-900 text-lg">{{ Str::limit($item->judul, 50) }}</h4>
                                    <p class="text-base text-gray-500 mt-1">{{ Str::limit(strip_tags($item->isi), 80) }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-5 text-center">
                            <a href="{{ route('admin.berita.komentar', $item->id) }}" 
                               class="inline-flex items-center gap-2 text-lg font-bold text-primary hover:text-green-800 bg-green-50 px-4 py-2 rounded-lg hover:bg-green-100 transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                                </svg>
                                {{ $item->komentar_count }} Komentar
                            </a>
                        </td>
                        <td class="px-6 py-5 text-center text-base text-gray-700 font-medium">
                            {{ $item->published_at ? $item->published_at->format('d M Y') : '-' }}
                        </td>
                        <td class="px-6 py-5">
                            <div class="flex items-center justify-center gap-2">
                                <a href="{{ route('berita.show', $item->slug) }}" target="_blank" 
                                   class="p-3 bg-blue-100 text-blue-800 rounded-lg hover:bg-blue-200 transition" title="Lihat di Website">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                </a>
                                <a href="{{ route('admin.berita.edit', $item->id) }}" 
                                   class="p-3 bg-yellow-100 text-yellow-800 rounded-lg hover:bg-yellow-200 transition" title="Edit Berita">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                </a>
                                <form action="{{ route('admin.berita.destroy', $item->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus berita ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-3 bg-red-100 text-red-800 rounded-lg hover:bg-red-200 transition" title="Hapus Berita">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif

    {{-- Bottom Action --}}
    <div class="mt-8 flex justify-end">
        <a href="{{ url('/berita') }}" target="_blank" 
           class="btn-large bg-white border-2 border-gray-300 text-gray-700 hover:bg-gray-50 transition flex items-center gap-2">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
            </svg>
            Lihat Halaman Berita di Website
        </a>
    </div>
</div>
@endsection
