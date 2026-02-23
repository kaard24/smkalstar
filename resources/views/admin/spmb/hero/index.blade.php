@extends('layouts.admin')

@section('title', 'Hero/Banner SPMB - Admin Panel')

@section('content')
<div class="max-w-6xl mx-auto">
    {{-- Header --}}
    <div class="mb-8 flex flex-wrap items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">Hero / Banner SPMB</h1>
            <p class="text-slate-600">Kelola konten banner hero di halaman informasi SPMB.</p>
        </div>
        <a href="{{ route('admin.spmb.hero.create') }}" class="btn btn-primary shadow-md hover:shadow-lg">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
            </svg>
            Tambah Hero
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
    @if($heroes->isEmpty())
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-12 text-center">
        <div class="w-20 h-20 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-4">
            <svg class="w-10 h-10 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
        </div>
        <h3 class="text-lg font-semibold text-slate-700 mb-2">Belum Ada Hero</h3>
        <p class="text-slate-500 mb-4">Mulai dengan menambahkan hero/banner pertama.</p>
        <a href="{{ route('admin.spmb.hero.create') }}" class="btn btn-primary shadow-md hover:shadow-lg">
            Tambah Hero Pertama
        </a>
    </div>
    @else
    {{-- Hero Cards --}}
    <div class="space-y-6">
        @foreach($heroes as $hero)
        @php
            $isAktif = $hero->aktif;
            $warnaClasses = [
                'blue' => 'from-blue-500 to-cyan-500',
                'green' => 'from-emerald-500 to-green-500',
                'orange' => 'from-orange-500 to-amber-500',
                'purple' => 'from-purple-500 to-violet-500',
                'red' => 'from-red-500 to-rose-500',
                'indigo' => 'from-indigo-500 to-blue-500',
            ];
            $badgeClass = $warnaClasses[$hero->badge_warna] ?? $warnaClasses['blue'];
        @endphp
        <div class="bg-white rounded-xl shadow-sm border {{ $isAktif ? 'border-blue-200 ring-2 ring-blue-100' : 'border-slate-200' }} overflow-hidden">
            {{-- Preview Header --}}
            <div class="p-6 border-b {{ $isAktif ? 'bg-gradient-to-r from-blue-50 to-cyan-50 border-blue-100' : 'bg-slate-50 border-slate-100' }}">
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                    <div class="flex items-center gap-4">
                        <div class="w-14 h-14 rounded-2xl {{ $isAktif ? 'bg-gradient-to-br ' . $badgeClass . ' text-white' : 'bg-slate-200 text-slate-500' }} flex items-center justify-center text-xl font-bold">
                            {{ $hero->urutan }}
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-slate-800">{{ $hero->judul_baris1 }}</h3>
                            <p class="text-sm text-slate-500">{{ $hero->tahun_ajaran }}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        @if($isAktif)
                        <span class="inline-flex items-center gap-2 bg-gradient-to-r from-emerald-500 to-green-500 text-white px-4 py-2 rounded-xl text-sm font-bold shadow-lg">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            AKTIF
                        </span>
                        @else
                        <span class="inline-flex items-center gap-2 bg-slate-200 text-slate-600 px-4 py-2 rounded-xl text-sm font-bold">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                            NONAKTIF
                        </span>
                        @endif
                        <div class="flex gap-2">
                            <a href="{{ route('admin.spmb.hero.edit', $hero) }}" class="btn-icon btn-icon-edit" title="Edit">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                            </a>
                            <form action="{{ route('admin.spmb.hero.destroy', $hero) }}" method="POST" class="inline" onsubmit="return confirm('Hapus hero ini?')">
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
            </div>

            {{-- Hero Preview --}}
            <div class="p-6">
                {{-- Preview Banner --}}
                <div class="relative bg-gradient-to-br from-blue-50 via-sky-50 to-cyan-50 py-8 px-6 rounded-xl border border-blue-100 overflow-hidden">
                    <div class="text-center relative z-10">
                        {{-- Badge --}}
                        <div class="inline-flex items-center gap-2 bg-gradient-to-r {{ $badgeClass }} text-white px-4 py-2 rounded-full text-sm font-bold mb-4 shadow-lg">
                            <span class="w-2 h-2 bg-white rounded-full animate-pulse"></span>
                            {{ $hero->badge_text }}
                        </div>
                        
                        {{-- Judul --}}
                        <h2 class="text-2xl md:text-3xl font-bold text-slate-800 mb-2">
                            {{ $hero->judul_baris1 }} <br>
                            <span class="text-transparent bg-clip-text bg-gradient-to-r {{ $badgeClass }}">{{ $hero->judul_baris2 }}</span>
                        </h2>
                        
                        {{-- Deskripsi --}}
                        <p class="text-slate-600 max-w-2xl mx-auto">{{ $hero->deskripsi }}</p>
                        
                        {{-- Info Tambahan --}}
                        @if($hero->tampilkan_gelombang)
                        <div class="mt-4 inline-flex items-center gap-2 px-4 py-2 bg-white/80 rounded-xl text-sm">
                            <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            Menampilkan {{ $hero->jumlah_gelombang_tampil }} gelombang
                        </div>
                        @endif
                    </div>
                </div>

                {{-- Details Grid --}}
                <div class="grid md:grid-cols-4 gap-4 mt-4">
                    <div class="bg-slate-50 rounded-xl p-4 border border-slate-100">
                        <div class="text-xs text-slate-500 uppercase font-semibold mb-1">Badge</div>
                        <div class="font-medium text-slate-800">{{ $hero->badge_text }}</div>
                    </div>
                    <div class="bg-slate-50 rounded-xl p-4 border border-slate-100">
                        <div class="text-xs text-slate-500 uppercase font-semibold mb-1">Warna Badge</div>
                        <div class="flex items-center gap-2">
                            <span class="w-4 h-4 rounded-full bg-gradient-to-r {{ $badgeClass }}"></span>
                            <span class="font-medium text-slate-800 capitalize">{{ $hero->badge_warna }}</span>
                        </div>
                    </div>
                    <div class="bg-slate-50 rounded-xl p-4 border border-slate-100">
                        <div class="text-xs text-slate-500 uppercase font-semibold mb-1">Tahun Ajaran</div>
                        <div class="font-medium text-slate-800">{{ $hero->tahun_ajaran }}</div>
                    </div>
                    <div class="bg-slate-50 rounded-xl p-4 border border-slate-100">
                        <div class="text-xs text-slate-500 uppercase font-semibold mb-1">Urutan</div>
                        <div class="font-medium text-slate-800">{{ $hero->urutan }}</div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif
</div>
@endsection
