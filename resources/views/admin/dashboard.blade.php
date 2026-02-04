@extends('layouts.admin')

@section('title', 'Dashboard - Admin Panel')

@section('content')
    {{-- Welcome Banner --}}
    <div class="welcome-banner rounded-xl shadow-sm p-6 mb-6 text-white relative">
        <div class="flex flex-col md:flex-row items-center gap-4 text-center md:text-left relative z-10">
            <div class="w-14 h-14 bg-[#4276A3]/20 rounded-xl flex items-center justify-center flex-shrink-0 border border-[#4276A3]/30">
                <svg class="w-7 h-7 text-[#9CBCDA]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                </svg>
            </div>
            <div class="flex-1">
                <h1 class="text-xl font-semibold">Dashboard Statistik SPMB</h1>
                <p class="text-sm text-slate-300 mt-1">Pantau progress pendaftaran dan analisis data secara real-time</p>
            </div>
            <div class="text-right">
                <p class="text-xs text-slate-400">Tahun Ajaran</p>
                <p class="text-lg font-bold">2026/2027</p>
            </div>
        </div>
    </div>

    {{-- Main Statistics Cards with Growth --}}
    <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        {{-- Total Pendaftar --}}
        <div class="stat-card card p-5 border-l-4 border-[#4276A3]">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-xs text-slate-500 font-medium uppercase tracking-wider">Total Pendaftar</p>
                    <p class="text-2xl font-bold text-slate-800 mt-1">{{ number_format($totalPendaftar ?? 0) }}</p>
                    <div class="flex items-center gap-1 mt-2">
                        @if(($totalPendaftarGrowth ?? 0) >= 0)
                            <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                            </svg>
                            <span class="text-xs text-green-600 font-medium">+{{ $totalPendaftarGrowth ?? 0 }}%</span>
                        @else
                            <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6"/>
                            </svg>
                            <span class="text-xs text-red-600 font-medium">{{ $totalPendaftarGrowth ?? 0 }}%</span>
                        @endif
                        <span class="text-xs text-slate-400">vs bulan lalu</span>
                    </div>
                </div>
                <div class="w-10 h-10 bg-[#4276A3]/10 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-[#4276A3]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                </div>
            </div>
        </div>

        {{-- Data Lengkap --}}
        <div class="stat-card card p-5 border-l-4 border-[#047857]">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-xs text-slate-500 font-medium uppercase tracking-wider">Data Lengkap</p>
                    <p class="text-2xl font-bold text-slate-800 mt-1">{{ number_format($dataLengkap ?? 0) }}</p>
                    <div class="flex items-center gap-1 mt-2">
                        @if(($dataLengkapGrowth ?? 0) >= 0)
                            <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                            </svg>
                            <span class="text-xs text-green-600 font-medium">+{{ $dataLengkapGrowth ?? 0 }}%</span>
                        @else
                            <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6"/>
                            </svg>
                            <span class="text-xs text-red-600 font-medium">{{ $dataLengkapGrowth ?? 0 }}%</span>
                        @endif
                        <span class="text-xs text-slate-400">vs bulan lalu</span>
                    </div>
                </div>
                <div class="w-10 h-10 bg-[#047857]/10 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-[#047857]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
            </div>
        </div>

        {{-- Berkas Lengkap --}}
        <div class="stat-card card p-5 border-l-4 border-[#B45309]">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-xs text-slate-500 font-medium uppercase tracking-wider">Berkas Lengkap</p>
                    <p class="text-2xl font-bold text-slate-800 mt-1">{{ number_format($berkasLengkap ?? 0) }}</p>
                    <div class="flex items-center gap-2 mt-2">
                        <div class="w-16 bg-slate-200 rounded-full h-1.5">
                            <div class="bg-[#B45309] h-1.5 rounded-full" style="width: {{ $berkasConversionRate ?? 0 }}%"></div>
                        </div>
                        <span class="text-xs text-slate-500">{{ $berkasConversionRate ?? 0 }}%</span>
                    </div>
                </div>
                <div class="w-10 h-10 bg-[#B45309]/10 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-[#B45309]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
            </div>
        </div>

        {{-- Sudah Lulus --}}
        <div class="stat-card card p-5 border-l-4 border-green-500">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-xs text-slate-500 font-medium uppercase tracking-wider">Sudah Lulus</p>
                    <p class="text-2xl font-bold text-slate-800 mt-1">{{ number_format($sudahLulus ?? 0) }}</p>
                    <div class="flex items-center gap-1 mt-2">
                        @if(($sudahLulusGrowth ?? 0) >= 0)
                            <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                            </svg>
                            <span class="text-xs text-green-600 font-medium">+{{ $sudahLulusGrowth ?? 0 }}%</span>
                        @else
                            <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6"/>
                            </svg>
                            <span class="text-xs text-red-600 font-medium">{{ $sudahLulusGrowth ?? 0 }}%</span>
                        @endif
                        <span class="text-xs text-slate-400">vs bulan lalu</span>
                    </div>
                </div>
                <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    {{-- Charts Row --}}
    <div class="grid lg:grid-cols-2 gap-6 mb-6">
        {{-- Weekly Registration Chart --}}
        <div class="card p-5">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-sm font-semibold text-slate-800 flex items-center gap-2">
                    <svg class="w-4 h-4 text-[#4276A3]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z"/>
                    </svg>
                    Grafik Pendaftar per Minggu
                </h3>
            </div>
            <div class="h-64">
                <canvas id="weeklyChart"></canvas>
            </div>
        </div>

        {{-- Jurusan Distribution --}}
        <div class="card p-5">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-sm font-semibold text-slate-800 flex items-center gap-2">
                    <svg class="w-4 h-4 text-[#4276A3]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"/>
                    </svg>
                    Distribusi per Jurusan
                </h3>
            </div>
            <div class="h-64">
                <canvas id="jurusanChart"></canvas>
            </div>
        </div>
    </div>

    {{-- Analytics & Lists Row --}}
    <div class="grid lg:grid-cols-3 gap-6 mb-6">
        {{-- Conversion Funnel --}}
        <div class="card p-5">
            <h3 class="text-sm font-semibold text-slate-800 mb-4 flex items-center gap-2">
                <svg class="w-4 h-4 text-[#4276A3]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                </svg>
                Conversion Rate
            </h3>
            <div class="space-y-3">
                {{-- Pendaftar -> Data Lengkap --}}
                <div>
                    <div class="flex justify-between text-xs mb-1">
                        <span class="text-slate-600">Pendaftar → Data Lengkap</span>
                        <span class="font-medium text-[#4276A3]">{{ $conversionRate ?? 0 }}%</span>
                    </div>
                    <div class="w-full bg-slate-100 rounded-full h-2">
                        <div class="bg-[#4276A3] h-2 rounded-full transition-all" style="width: {{ $conversionRate ?? 0 }}%"></div>
                    </div>
                </div>

                {{-- Data Lengkap -> Berkas Lengkap --}}
                <div>
                    <div class="flex justify-between text-xs mb-1">
                        <span class="text-slate-600">Data → Berkas Lengkap</span>
                        <span class="font-medium text-[#B45309]">{{ $berkasConversionRate ?? 0 }}%</span>
                    </div>
                    <div class="w-full bg-slate-100 rounded-full h-2">
                        <div class="bg-[#B45309] h-2 rounded-full transition-all" style="width: {{ $berkasConversionRate ?? 0 }}%"></div>
                    </div>
                </div>

                {{-- Berkas -> Lulus --}}
                <div>
                    <div class="flex justify-between text-xs mb-1">
                        <span class="text-slate-600">Berkas → Lulus</span>
                        <span class="font-medium text-green-600">{{ $lulusConversionRate ?? 0 }}%</span>
                    </div>
                    <div class="w-full bg-slate-100 rounded-full h-2">
                        <div class="bg-green-500 h-2 rounded-full transition-all" style="width: {{ $lulusConversionRate ?? 0 }}%"></div>
                    </div>
                </div>
            </div>

            {{-- Drop-off Info --}}
            <div class="mt-4 pt-4 border-t border-slate-200">
                <h4 class="text-xs font-medium text-slate-500 mb-2">Drop-off Rate</h4>
                <div class="space-y-2">
                    @if(isset($dropOffData['pendaftaran_ke_data']))
                    <div class="flex items-center justify-between text-xs">
                        <span class="text-slate-600">Belum lengkap data</span>
                        <span class="text-red-500 font-medium">{{ $dropOffData['pendaftaran_ke_data']['count'] }} ({{ $dropOffData['pendaftaran_ke_data']['rate'] }}%)</span>
                    </div>
                    @endif
                    @if(isset($dropOffData['data_ke_berkas']))
                    <div class="flex items-center justify-between text-xs">
                        <span class="text-slate-600">Belum upload berkas</span>
                        <span class="text-orange-500 font-medium">{{ $dropOffData['data_ke_berkas']['count'] }} ({{ $dropOffData['data_ke_berkas']['rate'] }}%)</span>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- Top 10 Asal Sekolah --}}
        <div class="card p-5">
            <h3 class="text-sm font-semibold text-slate-800 mb-4 flex items-center gap-2">
                <svg class="w-4 h-4 text-[#4276A3]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                </svg>
                Top 10 Asal Sekolah
            </h3>
            <div class="space-y-2 max-h-64 overflow-y-auto">
                @forelse($topSekolah ?? [] as $index => $sekolah)
                <div class="flex items-center gap-3 p-2 rounded-lg {{ $index < 3 ? 'bg-slate-50' : '' }}">
                    <div class="w-6 h-6 rounded-full flex items-center justify-center text-xs font-bold {{ $index < 3 ? 'bg-[#4276A3] text-white' : 'bg-slate-200 text-slate-600' }}">
                        {{ $index + 1 }}
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-xs font-medium text-slate-700 truncate">{{ $sekolah->asal_sekolah ?? 'Tidak Diketahui' }}</p>
                    </div>
                    <span class="text-xs font-semibold text-[#4276A3]">{{ $sekolah->total }}</span>
                </div>
                @empty
                <p class="text-xs text-slate-500 text-center py-4">Belum ada data</p>
                @endforelse
            </div>
        </div>

        {{-- Additional Metrics --}}
        <div class="card p-5">
            <h3 class="text-sm font-semibold text-slate-800 mb-4 flex items-center gap-2">
                <svg class="w-4 h-4 text-[#4276A3]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                </svg>
                Metrik Tambahan
            </h3>
            
            {{-- Average Completion Time --}}
            <div class="mb-4 p-3 bg-slate-50 rounded-lg">
                <p class="text-xs text-slate-500 mb-1">Rata-rata Waktu Penyelesaian</p>
                <p class="text-lg font-bold text-slate-800">
                    @if($avgCompletionTime)
                        {{ $avgCompletionTime }} <span class="text-sm font-normal text-slate-500">hari</span>
                    @else
                        <span class="text-sm font-normal text-slate-400">Belum ada data</span>
                    @endif
                </p>
                <p class="text-xs text-slate-400 mt-1">Dari daftar sampai berkas lengkap</p>
            </div>

            {{-- Siap Tes Count --}}
            <div class="mb-4 p-3 bg-slate-50 rounded-lg">
                <p class="text-xs text-slate-500 mb-1">Siap Tes</p>
                <p class="text-lg font-bold text-slate-800">{{ $siapTes ?? 0 }}</p>
                <p class="text-xs text-slate-400 mt-1">Data & berkas lengkap</p>
            </div>

            {{-- Total Stats Summary --}}
            <div class="grid grid-cols-2 gap-2">
                <div class="text-center p-2 bg-blue-50 rounded-lg">
                    <p class="text-xs text-blue-600 mb-1">Conversion</p>
                    <p class="text-lg font-bold text-blue-800">{{ $conversionRate ?? 0 }}%</p>
                </div>
                <div class="text-center p-2 bg-green-50 rounded-lg">
                    <p class="text-xs text-green-600 mb-1">Kelulusan</p>
                    <p class="text-lg font-bold text-green-800">{{ $lulusConversionRate ?? 0 }}%</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Peak Hours Chart --}}
    <div class="card p-5 mb-6">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-sm font-semibold text-slate-800 flex items-center gap-2">
                <svg class="w-4 h-4 text-[#4276A3]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                Peak Hours (Jam Paling Ramai)
            </h3>
        </div>
        <div class="h-48">
            <canvas id="peakHoursChart"></canvas>
        </div>
    </div>

    {{-- Menu Cepat --}}
    <div class="card p-6 mb-6">
        <h2 class="text-lg font-semibold text-slate-800 mb-5 flex items-center gap-2">
            <span class="w-8 h-8 bg-[#4276A3]/10 rounded-lg flex items-center justify-center">
                <svg class="w-4 h-4 text-[#4276A3]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
                </svg>
            </span>
            Menu Cepat
        </h2>
        
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <a href="{{ route('admin.pendaftar.index') }}" class="group flex flex-col items-center gap-3 p-5 bg-slate-50 border border-slate-200 rounded-xl hover:border-[#4276A3] hover:shadow-sm transition text-center">
                <div class="w-12 h-12 bg-[#4276A3]/10 rounded-xl flex items-center justify-center group-hover:bg-[#4276A3]/20 transition">
                    <svg class="w-6 h-6 text-[#4276A3]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </div>
                <span class="text-sm font-medium text-slate-700 group-hover:text-[#4276A3] transition">Data Pendaftar</span>
            </a>

            <a href="{{ route('admin.fasilitas.index') }}" class="group flex flex-col items-center gap-3 p-5 bg-slate-50 border border-slate-200 rounded-xl hover:border-slate-400 hover:shadow-sm transition text-center">
                <div class="w-12 h-12 bg-slate-200 rounded-xl flex items-center justify-center group-hover:bg-slate-300 transition">
                    <svg class="w-6 h-6 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                </div>
                <span class="text-sm font-medium text-slate-700 group-hover:text-slate-600 transition">Fasilitas</span>
            </a>

            <a href="{{ route('admin.berita.index') }}" class="group flex flex-col items-center gap-3 p-5 bg-slate-50 border border-slate-200 rounded-xl hover:border-slate-400 hover:shadow-sm transition text-center">
                <div class="w-12 h-12 bg-slate-200 rounded-xl flex items-center justify-center group-hover:bg-slate-300 transition">
                    <svg class="w-6 h-6 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                    </svg>
                </div>
                <span class="text-sm font-medium text-slate-700 group-hover:text-slate-600 transition">Berita</span>
            </a>

            <a href="{{ route('admin.profil-sekolah.sejarah') }}" class="group flex flex-col items-center gap-3 p-5 bg-slate-50 border border-slate-200 rounded-xl hover:border-[#4276A3] hover:shadow-sm transition text-center">
                <div class="w-12 h-12 bg-[#4276A3]/10 rounded-xl flex items-center justify-center group-hover:bg-[#4276A3]/20 transition">
                    <svg class="w-6 h-6 text-[#4276A3]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                </div>
                <span class="text-sm font-medium text-slate-700 group-hover:text-[#4276A3] transition">Profil Sekolah</span>
            </a>
        </div>
    </div>

    {{-- Info Cards --}}
    <div class="grid md:grid-cols-2 gap-6">
        <div class="bg-[#4276A3] rounded-xl p-6 text-white shadow-sm relative overflow-hidden">
            <div class="absolute top-0 right-0 w-32 h-32 bg-white/5 rounded-full -mr-10 -mt-10"></div>
            <h3 class="text-lg font-semibold mb-3 flex items-center gap-2 relative z-10">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                Alur SPMB
            </h3>
            <ol class="space-y-2 text-sm text-blue-100 list-decimal list-inside relative z-10">
                <li>Siswa mendaftar dan melengkapi data (biodata, orang tua, jurusan)</li>
                <li>Siswa upload dokumen (KK, Akta, SKL, Ijazah)</li>
                <li>Setelah berkas lengkap, siswa menunggu jadwal tes via WhatsApp</li>
                <li>Tes dan wawancara dilakukan offline di sekolah</li>
            </ol>
        </div>
        
        <div class="bg-[#334155] rounded-xl p-6 text-white shadow-sm relative overflow-hidden">
            <div class="absolute top-0 right-0 w-32 h-32 bg-white/5 rounded-full -mr-10 -mt-10"></div>
            <h3 class="text-lg font-semibold mb-3 flex items-center gap-2 relative z-10">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                Catatan Penting
            </h3>
            <ul class="space-y-2 text-sm text-slate-300 list-disc list-inside relative z-10">
                <li>Admin dapat melihat progress upload berkas siswa</li>
                <li>Tidak ada nilai tes yang ditampilkan di website</li>
                <li>Jadwal tes diumumkan via WhatsApp</li>
                <li>Semua siswa otomatis lulus</li>
            </ul>
        </div>
    </div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Weekly Registration Chart
    const weeklyCtx = document.getElementById('weeklyChart').getContext('2d');
    new Chart(weeklyCtx, {
        type: 'line',
        data: {
            labels: {!! json_encode($weeklyData['weeks'] ?? []) !!},
            datasets: [{
                label: 'Pendaftar',
                data: {!! json_encode($weeklyData['counts'] ?? []) !!},
                borderColor: '#4276A3',
                backgroundColor: 'rgba(66, 118, 163, 0.1)',
                borderWidth: 2,
                fill: true,
                tension: 0.4,
                pointRadius: 4,
                pointBackgroundColor: '#4276A3',
                pointBorderColor: '#fff',
                pointBorderWidth: 2,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    callbacks: {
                        title: function(context) {
                            const labels = {!! json_encode($weeklyData['labels'] ?? []) !!};
                            return 'Minggu: ' + labels[context[0].dataIndex];
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { stepSize: 1, font: { size: 11 } },
                    grid: { color: 'rgba(0,0,0,0.05)' }
                },
                x: {
                    ticks: { font: { size: 11 } },
                    grid: { display: false }
                }
            }
        }
    });

    // Jurusan Distribution Chart
    const jurusanCtx = document.getElementById('jurusanChart').getContext('2d');
    new Chart(jurusanCtx, {
        type: 'doughnut',
        data: {
            labels: {!! json_encode($statsJurusan->pluck('nama') ?? []) !!},
            datasets: [{
                data: {!! json_encode($statsJurusan->pluck('pendaftaran_count') ?? []) !!},
                backgroundColor: [
                    '#4276A3',
                    '#047857',
                    '#B45309',
                    '#7C3AED',
                    '#DC2626',
                    '#0891B2',
                    '#059669',
                ],
                borderWidth: 0,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'right',
                    labels: {
                        boxWidth: 12,
                        padding: 10,
                        font: { size: 11 }
                    }
                }
            },
            cutout: '60%'
        }
    });

    // Peak Hours Chart
    const peakCtx = document.getElementById('peakHoursChart').getContext('2d');
    new Chart(peakCtx, {
        type: 'bar',
        data: {
            labels: {!! json_encode(($peakHours ?? collect())->pluck('hour')) !!},
            datasets: [{
                label: 'Pendaftar',
                data: {!! json_encode(($peakHours ?? collect())->pluck('total')) !!},
                backgroundColor: '#4276A3',
                borderRadius: 4,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { stepSize: 1, font: { size: 11 } },
                    grid: { color: 'rgba(0,0,0,0.05)' }
                },
                x: {
                    ticks: { font: { size: 10 }, maxRotation: 45 },
                    grid: { display: false }
                }
            }
        }
    });
</script>
@endpush
