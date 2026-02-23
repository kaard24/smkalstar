@extends('layouts.admin')

@section('title', 'SPMB - Admin Panel')

@section('content')
<div class="max-w-6xl mx-auto">
    {{-- Header --}}
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-slate-800">Kelola SPMB</h1>
        <p class="text-slate-600">Kelola informasi penerimaan murid baru.</p>
    </div>

    {{-- Stats Cards --}}
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
        {{-- Hero --}}
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-4">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-pink-100 text-pink-600 flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-xs text-slate-500">Hero/Banner</p>
                    <p class="text-xl font-bold text-slate-800">{{ $heroAktif }}/{{ $totalHero }}</p>
                </div>
            </div>
        </div>

        {{-- Jurusan --}}
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-4">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-cyan-100 text-cyan-600 flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                </div>
                <div>
                    <p class="text-xs text-slate-500">Jurusan</p>
                    <p class="text-xl font-bold text-slate-800">{{ $jurusanAktif }}/{{ $totalJurusan }}</p>
                </div>
            </div>
        </div>

        {{-- Gelombang --}}
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-4">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-blue-100 text-blue-600 flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-xs text-slate-500">Gelombang</p>
                    <p class="text-xl font-bold text-slate-800">{{ $gelombangAktif }}/{{ $totalGelombang }}</p>
                </div>
            </div>
        </div>

        {{-- Tahun Ajaran --}}
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-4">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-purple-100 text-purple-600 flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-xs text-slate-500">Tahun Ajaran</p>
                    <p class="text-lg font-bold text-slate-800">{{ $gelombang->first()?->tahun_ajaran ?? '-' }}</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Menu Grid --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        {{-- Hero / Banner --}}
        <a href="{{ route('admin.spmb.hero.index') }}" class="group bg-white rounded-xl shadow-sm border border-slate-200 p-6 hover:shadow-md transition-all hover:-translate-y-1">
            <div class="flex items-start justify-between mb-4">
                <div class="w-14 h-14 rounded-xl bg-pink-100 text-pink-600 flex items-center justify-center group-hover:bg-pink-600 group-hover:text-white transition">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
                <svg class="w-5 h-5 text-slate-400 group-hover:text-pink-600 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </div>
            <h3 class="text-lg font-bold text-slate-800 mb-1">Hero / Banner</h3>
            <p class="text-sm text-slate-500">Kelola banner hero halaman SPMB</p>
        </a>

        {{-- Program Keahlian --}}
        <a href="{{ route('admin.spmb.jurusan.index') }}" class="group bg-white rounded-xl shadow-sm border border-slate-200 p-6 hover:shadow-md transition-all hover:-translate-y-1">
            <div class="flex items-start justify-between mb-4">
                <div class="w-14 h-14 rounded-xl bg-cyan-100 text-cyan-600 flex items-center justify-center group-hover:bg-cyan-600 group-hover:text-white transition">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                </div>
                <svg class="w-5 h-5 text-slate-400 group-hover:text-cyan-600 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </div>
            <h3 class="text-lg font-bold text-slate-800 mb-1">Program Keahlian</h3>
            <p class="text-sm text-slate-500">Kelola jurusan yang tampil di SPMB</p>
        </a>

        {{-- Gelombang --}}
        <a href="{{ route('admin.spmb.gelombang.index') }}" class="group bg-white rounded-xl shadow-sm border border-slate-200 p-6 hover:shadow-md transition-all hover:-translate-y-1">
            <div class="flex items-start justify-between mb-4">
                <div class="w-14 h-14 rounded-xl bg-blue-100 text-blue-600 flex items-center justify-center group-hover:bg-blue-600 group-hover:text-white transition">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
                <svg class="w-5 h-5 text-slate-400 group-hover:text-blue-600 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </div>
            <h3 class="text-lg font-bold text-slate-800 mb-1">Gelombang</h3>
            <p class="text-sm text-slate-500">Kelola jadwal dan gelombang pendaftaran</p>
        </a>

        {{-- Alur --}}
        <a href="{{ route('admin.spmb.alur.index') }}" class="group bg-white rounded-xl shadow-sm border border-slate-200 p-6 hover:shadow-md transition-all hover:-translate-y-1">
            <div class="flex items-start justify-between mb-4">
                <div class="w-14 h-14 rounded-xl bg-indigo-100 text-indigo-600 flex items-center justify-center group-hover:bg-indigo-600 group-hover:text-white transition">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                    </svg>
                </div>
                <svg class="w-5 h-5 text-slate-400 group-hover:text-indigo-600 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </div>
            <h3 class="text-lg font-bold text-slate-800 mb-1">Alur Pendaftaran</h3>
            <p class="text-sm text-slate-500">Kelola tahapan alur pendaftaran</p>
        </a>

        {{-- Persyaratan --}}
        <a href="{{ route('admin.spmb.persyaratan.index') }}" class="group bg-white rounded-xl shadow-sm border border-slate-200 p-6 hover:shadow-md transition-all hover:-translate-y-1">
            <div class="flex items-start justify-between mb-4">
                <div class="w-14 h-14 rounded-xl bg-emerald-100 text-emerald-600 flex items-center justify-center group-hover:bg-emerald-600 group-hover:text-white transition">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <svg class="w-5 h-5 text-slate-400 group-hover:text-emerald-600 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </div>
            <h3 class="text-lg font-bold text-slate-800 mb-1">Persyaratan</h3>
            <p class="text-sm text-slate-500">Kelola persyaratan berkas pendaftaran</p>
        </a>

        {{-- Biaya --}}
        <a href="{{ route('admin.spmb.biaya.index') }}" class="group bg-white rounded-xl shadow-sm border border-slate-200 p-6 hover:shadow-md transition-all hover:-translate-y-1">
            <div class="flex items-start justify-between mb-4">
                <div class="w-14 h-14 rounded-xl bg-amber-100 text-amber-600 flex items-center justify-center group-hover:bg-amber-600 group-hover:text-white transition">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <svg class="w-5 h-5 text-slate-400 group-hover:text-amber-600 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </div>
            <h3 class="text-lg font-bold text-slate-800 mb-1">Biaya</h3>
            <p class="text-sm text-slate-500">Kelola rincian biaya pendaftaran</p>
        </a>

        {{-- Kontak --}}
        <a href="{{ route('admin.spmb.kontak.index') }}" class="group bg-white rounded-xl shadow-sm border border-slate-200 p-6 hover:shadow-md transition-all hover:-translate-y-1">
            <div class="flex items-start justify-between mb-4">
                <div class="w-14 h-14 rounded-xl bg-rose-100 text-rose-600 flex items-center justify-center group-hover:bg-rose-600 group-hover:text-white transition">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                    </svg>
                </div>
                <svg class="w-5 h-5 text-slate-400 group-hover:text-rose-600 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </div>
            <h3 class="text-lg font-bold text-slate-800 mb-1">Kontak</h3>
            <p class="text-sm text-slate-500">Kelola kontak person panitia</p>
        </a>
    </div>

    {{-- Quick Preview Grid --}}
    <div class="grid lg:grid-cols-2 gap-8">
        {{-- Program Keahlian Preview --}}
        @if($jurusan->isNotEmpty())
        <div>
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-bold text-slate-800">Program Keahlian</h2>
                <a href="{{ route('admin.spmb.jurusan.index') }}" class="text-sm text-blue-600 hover:text-blue-700">Lihat Semua</a>
            </div>
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
                <div class="grid grid-cols-2 gap-4 p-4">
                    @foreach($jurusan->where('aktif', true)->take(4) as $j)
                    <div class="flex items-center gap-3 p-3 rounded-lg border {{ $j->warna_border }} bg-gray-50">
                        <div class="w-10 h-10 rounded-lg {{ $j->warna_bg }} flex items-center justify-center flex-shrink-0">
                            <img src="{{ $j->logo_url }}" alt="{{ $j->nama }}" class="w-6 h-6 object-contain">
                        </div>
                        <div class="min-w-0">
                            <p class="text-xs font-bold text-slate-500">{{ $j->kode }}</p>
                            <p class="text-sm font-medium text-slate-800 truncate">{{ $j->nama }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endif

        {{-- Gelombang Aktif Preview --}}
        @if($gelombang->isNotEmpty())
        <div>
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-bold text-slate-800">Gelombang Aktif</h2>
                <a href="{{ route('admin.spmb.gelombang.index') }}" class="text-sm text-blue-600 hover:text-blue-700">Lihat Semua</a>
            </div>
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
                <div class="divide-y divide-slate-100">
                    @foreach($gelombang->take(3) as $g)
                    <div class="p-4 flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl {{ $g->is_aktif ? 'bg-blue-100 text-blue-600' : 'bg-slate-100 text-slate-500' }} flex items-center justify-center font-bold text-sm">
                                {{ $g->nomor }}
                            </div>
                            <div>
                                <p class="font-medium text-slate-800">{{ $g->nama }}</p>
                                <p class="text-xs text-slate-500">{{ $g->tahun_ajaran }}</p>
                            </div>
                        </div>
                        @php
                            $colors = $g->status_color;
                        @endphp
                        <span class="badge {{ $colors['bg'] }} {{ $colors['text'] }} text-xs">
                            {{ $g->status_pendaftaran }}
                        </span>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
