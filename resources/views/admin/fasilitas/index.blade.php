@extends('layouts.admin')

@section('title', 'Kelola Fasilitas - Admin Panel')

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Kelola Fasilitas</h1>
            <p class="text-gray-600">Kelola data fasilitas sekolah</p>
        </div>
        <a href="{{ route('admin.fasilitas.create') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-primary text-white rounded-lg font-medium hover:bg-secondary transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
            Tambah Fasilitas
        </a>
    </div>

    @if(session('success'))
    <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-700 rounded-xl flex items-center gap-2">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
        {{ session('success') }}
    </div>
    @endif

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @forelse($fasilitas as $item)
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden group">
            <div class="relative h-48">
                @if($item->gambar_url)
                <img src="{{ $item->gambar_url }}" alt="{{ $item->nama }}" class="w-full h-full object-cover">
                @else
                <div class="w-full h-full bg-gray-100 flex items-center justify-center">
                    <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                </div>
                @endif
                <div class="absolute top-2 right-2">
                    @if($item->aktif)
                    <span class="px-2 py-1 bg-green-500 text-white rounded-full text-xs font-bold">Aktif</span>
                    @else
                    <span class="px-2 py-1 bg-gray-500 text-white rounded-full text-xs font-bold">Nonaktif</span>
                    @endif
                </div>
            </div>
            <div class="p-4">
                <div class="flex justify-between items-start mb-2">
                    <h3 class="font-bold text-gray-900">{{ $item->nama }}</h3>
                    <span class="text-xs text-gray-400">Urutan: {{ $item->urutan }}</span>
                </div>
                <div class="flex gap-2 mt-3">
                    <a href="{{ route('admin.fasilitas.edit', $item) }}" class="flex-1 text-center px-3 py-2 bg-primary/10 text-primary rounded-lg text-sm font-medium hover:bg-primary/20 transition">
                        Edit
                    </a>
                    <form action="{{ route('admin.fasilitas.destroy', $item) }}" method="POST" class="flex-1" onsubmit="return confirm('Hapus fasilitas ini?')">
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
            <svg class="w-12 h-12 mx-auto mb-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
            <p>Belum ada data fasilitas</p>
        </div>
        @endforelse
    </div>
</div>
@endsection
