@extends('layouts.admin')

@section('title', 'Program Keahlian - Admin Panel')

@section('content')
<div class="max-w-7xl mx-auto">
    {{-- Header --}}
    <div class="mb-8 flex flex-wrap items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">Program Keahlian</h1>
            <p class="text-slate-600">Kelola data jurusan untuk halaman profil sekolah.</p>
        </div>
        <a href="{{ route('admin.jurusan.create') }}" class="btn btn-primary shadow-md hover:shadow-lg">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
            </svg>
            Tambah Jurusan
        </a>
    </div>

    {{-- Alert --}}
    @if(session('success'))
    <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-xl flex items-center gap-2">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
        </svg>
        {{ session('success') }}
    </div>
    @endif

    {{-- Empty State --}}
    @if($jurusan->isEmpty())
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-12 text-center">
        <div class="w-20 h-20 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-4">
            <svg class="w-10 h-10 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
            </svg>
        </div>
        <h3 class="text-lg font-semibold text-slate-700 mb-2">Belum Ada Jurusan</h3>
        <p class="text-slate-500 mb-4">Mulai dengan menambahkan jurusan pertama.</p>
        <a href="{{ route('admin.jurusan.create') }}" class="btn btn-primary shadow-md hover:shadow-lg">
            Tambah Jurusan Pertama
        </a>
    </div>
    @else
    
    {{-- Grid Cards --}}
    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($jurusan as $j)
        <div class="bg-white rounded-xl shadow-sm border {{ $j->aktif ? 'border-blue-200 ring-2 ring-blue-100' : 'border-slate-200' }} overflow-hidden group">
            {{-- Gambar Header --}}
            <div class="relative h-48 bg-gradient-to-br from-slate-100 to-slate-200 overflow-hidden">
                @if($j->gambar_url)
                <img src="{{ $j->gambar_url }}" alt="{{ $j->nama }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                @else
                <div class="w-full h-full flex items-center justify-center">
                    <svg class="w-16 h-16 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
                @endif
                
                {{-- Status Badge --}}
                @if($j->aktif)
                <span class="absolute top-3 right-3 px-2 py-1 bg-emerald-500 text-white text-xs font-bold rounded-lg shadow">
                    AKTIF
                </span>
                @else
                <span class="absolute top-3 right-3 px-2 py-1 bg-slate-400 text-white text-xs font-bold rounded-lg shadow">
                    NONAKTIF
                </span>
                @endif

                {{-- Logo Badge --}}
                @if($j->logo_url)
                <div class="absolute bottom-3 left-3 w-14 h-14 bg-white rounded-xl shadow-md p-1">
                    <img src="{{ $j->logo_url }}" alt="Logo {{ $j->nama }}" class="w-full h-full object-contain rounded-lg">
                </div>
                @endif
            </div>

            {{-- Content --}}
            <div class="p-5">
                <div class="flex items-start justify-between gap-3 mb-3">
                    <div>
                        <span class="text-xs font-bold text-blue-600 bg-blue-50 px-2 py-1 rounded mb-2 inline-block">{{ $j->kode }}</span>
                        <h3 class="text-lg font-bold text-slate-800">{{ $j->nama }}</h3>
                    </div>
                </div>

                {{-- Info Program --}}
                <div class="flex flex-wrap gap-2 mb-3">
                    @if($j->infoProgram->count() > 0)
                        @foreach($j->infoProgram->take(3) as $info)
                        <span class="text-xs px-2 py-1 bg-blue-50 text-blue-700 rounded">
                            {{ $info->label }}: {{ $info->value }}
                        </span>
                        @endforeach
                    @else
                        <span class="text-xs px-2 py-1 bg-blue-50 text-blue-700 rounded">Durasi: 3 Tahun</span>
                        <span class="text-xs px-2 py-1 bg-emerald-50 text-emerald-700 rounded">Sertifikasi: BNSP</span>
                    @endif
                </div>

                {{-- Deskripsi --}}
                <p class="text-sm text-slate-600 line-clamp-2 mb-4">
                    {{ $j->deskripsi ?? 'Belum ada deskripsi' }}
                </p>

                {{-- Link Halaman Publik --}}
                <div class="mb-4">
                    <a href="{{ url('/jurusan/' . strtolower($j->kode)) }}" target="_blank" class="inline-flex items-center gap-1 text-xs text-blue-600 hover:text-blue-800">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                        </svg>
                        Lihat Halaman Publik
                    </a>
                </div>

                {{-- Actions --}}
                <div class="flex gap-2 pt-3 border-t border-slate-100">
                    <a href="{{ route('admin.jurusan.edit', $j) }}" class="btn-icon btn-icon-edit flex-1 justify-center" title="Edit">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                        Edit
                    </a>
                    <form action="{{ route('admin.jurusan.destroy', $j) }}" method="POST" class="inline" onsubmit="return confirm('Hapus jurusan ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-icon btn-icon-delete" title="Hapus">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif
</div>
@endsection
