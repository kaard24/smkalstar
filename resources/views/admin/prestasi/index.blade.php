@extends('layouts.admin')

@section('title', 'Kelola Prestasi - Admin Panel')

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Kelola Prestasi</h1>
            <p class="text-gray-600">Kelola data prestasi sekolah</p>
        </div>
        <a href="{{ route('admin.prestasi.create') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-primary text-white rounded-lg font-medium hover:bg-secondary transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
            Tambah Prestasi
        </a>
    </div>

    @if(session('success'))
    <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-700 rounded-xl flex items-center gap-2">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
        {{ session('success') }}
    </div>
    @endif

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @forelse($prestasi as $item)
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden group">
            <div class="relative h-48">
                @if($item->gambar_url)
                <img src="{{ $item->gambar_url }}" alt="{{ $item->judul }}" class="w-full h-full object-cover" loading="lazy" decoding="async">
                @else
                <div class="w-full h-full bg-gradient-to-br from-yellow-100 to-yellow-200 flex items-center justify-center">
                    <svg class="w-16 h-16 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path></svg>
                </div>
                @endif
                <div class="absolute top-2 right-2">
                    @if($item->aktif)
                    <span class="px-2 py-1 bg-green-500 text-white rounded-full text-xs font-bold">Aktif</span>
                    @else
                    <span class="px-2 py-1 bg-gray-500 text-white rounded-full text-xs font-bold">Nonaktif</span>
                    @endif
                </div>
                <div class="absolute bottom-2 left-2">
                    <span class="px-2 py-1 bg-primary text-white rounded-full text-xs font-bold">{{ $item->tahun }}</span>
                </div>
            </div>
            <div class="p-4">
                <div class="flex justify-between items-start mb-2">
                    <h3 class="font-bold text-gray-900 text-sm">{{ $item->judul }}</h3>
                    <span class="text-xs text-gray-400">Urutan: {{ $item->urutan }}</span>
                </div>
                <span class="inline-block px-2 py-1 bg-blue-100 text-blue-700 rounded text-xs font-medium mb-2">{{ $item->tingkat }}</span>
                @if($item->deskripsi)
                <p class="text-sm text-gray-500 mb-3 line-clamp-2">{{ $item->deskripsi }}</p>
                @endif
                <div class="flex gap-2 mt-3">
                    <a href="{{ route('admin.prestasi.edit', $item) }}" class="flex-1 text-center px-3 py-2 bg-primary/10 text-primary rounded-lg text-sm font-medium hover:bg-primary/20 transition">
                        Edit
                    </a>
                    <form action="{{ route('admin.prestasi.destroy', $item) }}" method="POST" class="flex-1" onsubmit="return confirm('Hapus prestasi ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full px-3 py-2 bg-red-50 text-red-600 rounded-lg text-sm font-medium hover:bg-red-100 transition">
                            Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-full py-12 text-center text-gray-500">
            <svg class="w-12 h-12 mx-auto mb-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path></svg>
            <p>Belum ada data prestasi</p>
        </div>
        @endforelse
    </div>
</div>
@endsection
