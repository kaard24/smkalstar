@extends('layouts.admin')

@section('title', 'Galeri - Admin Panel')

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="mb-8 flex flex-wrap items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Galeri</h1>
            <p class="text-gray-600">Kelola foto galeri sekolah.</p>
        </div>
        <a href="{{ route('admin.galeri.create') }}" class="px-4 py-2 bg-primary text-white rounded-xl font-semibold hover:bg-secondary transition shadow-lg shadow-primary/25 flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
            Tambah Foto
        </a>
    </div>

    @if(session('success'))
    <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-700 rounded-xl flex items-center gap-2">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
        {{ session('success') }}
    </div>
    @endif

    @if($galeri->isEmpty())
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-12 text-center">
        <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
        <h3 class="text-lg font-semibold text-gray-700 mb-2">Belum Ada Foto</h3>
        <p class="text-gray-500 mb-4">Mulai dengan menambahkan foto pertama ke galeri.</p>
        <a href="{{ route('admin.galeri.create') }}" class="inline-block px-6 py-2 bg-primary text-white rounded-xl font-semibold hover:bg-secondary transition">
            Tambah Foto Pertama
        </a>
    </div>
    @else
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
        @foreach($galeri as $item)
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden group relative">
            <div class="aspect-square overflow-hidden">
                <img src="{{ $item->gambar_url }}" alt="{{ $item->keterangan ?? 'Galeri' }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300" loading="lazy" decoding="async">
            </div>
            @if($item->keterangan)
            <div class="p-3 border-t border-gray-100">
                <p class="text-sm text-gray-700 line-clamp-2">{{ $item->keterangan }}</p>
            </div>
            @endif
            
            {{-- Actions Overlay --}}
            <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center gap-2">
                <a href="{{ route('admin.galeri.edit', $item->id) }}" class="p-2 bg-white text-blue-600 rounded-lg hover:bg-blue-50 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                </a>
                <form action="{{ route('admin.galeri.destroy', $item->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus foto ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="p-2 bg-white text-red-600 rounded-lg hover:bg-red-50 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                    </button>
                </form>
            </div>
        </div>
        @endforeach
    </div>
    @endif

    <div class="mt-6 flex justify-end">
        <a href="{{ url('/galeri') }}" target="_blank" class="px-6 py-3 border border-gray-300 text-gray-700 rounded-xl font-semibold hover:bg-gray-50 transition">
            Lihat Halaman Publik
        </a>
    </div>
</div>
@endsection
