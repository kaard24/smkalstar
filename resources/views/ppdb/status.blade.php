@extends('layouts.app')

@section('title', 'Status Pendaftaran - PPDB SMK Al-Hidayah Lestari')

@section('content')
<div class="min-h-screen bg-slate-50">
    


    @php
        $totalSteps = 7;
        $completedSteps = 1;
        if($biodataComplete) $completedSteps++;
        if($orangTuaComplete) $completedSteps++;
        if($jurusanComplete) $completedSteps++;
        if($progress['is_complete']) $completedSteps++;
        if($wawancaraComplete) $completedSteps++;
        if($kelulusanStatus === 'Lulus') $completedSteps++;
        $overallProgress = ($completedSteps / $totalSteps) * 100;
        
        $jenisOrtu = $siswa->orangTua?->jenis ?? null;
        $labelOrtu = ($jenisOrtu === 'wali') ? 'Data Wali' : 'Data Orang Tua';
    @endphp

    <!-- Main Content -->
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-6 max-w-4xl">
        
        <!-- Progress Overview -->
        <div class="bg-white rounded-xl border border-slate-200 p-6 mb-6">
            <div class="flex flex-col sm:flex-row sm:items-center gap-6">
                <div class="flex items-center gap-4">
                    <div class="w-20 h-20 relative">
                        <svg class="w-full h-full transform -rotate-90" viewBox="0 0 36 36">
                            <path class="text-slate-100" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" fill="none" stroke="currentColor" stroke-width="3"/>
                            <path class="{{ $overallProgress >= 100 ? 'text-emerald-500' : ($overallProgress >= 70 ? 'text-blue-500' : ($overallProgress >= 40 ? 'text-amber-500' : 'text-slate-400')) }}" 
                                  stroke-dasharray="{{ $overallProgress }}, 100" 
                                  d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" 
                                  fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round"/>
                        </svg>
                        <div class="absolute inset-0 flex items-center justify-center">
                            <span class="text-xl font-bold {{ $overallProgress >= 100 ? 'text-emerald-600' : ($overallProgress >= 70 ? 'text-blue-600' : ($overallProgress >= 40 ? 'text-amber-600' : 'text-slate-600')) }}">{{ round($overallProgress) }}%</span>
                        </div>
                    </div>
                    <div>
                        <h2 class="text-lg font-semibold text-slate-800">Progres Pendaftaran</h2>
                        <p class="text-sm text-slate-500">{{ $completedSteps }} dari {{ $totalSteps }} langkah</p>
                    </div>
                </div>
                <div class="flex-1 sm:text-right">
                    @if($kelulusanStatus === 'Lulus')
                        <span class="inline-flex items-center gap-1.5 text-sm font-bold text-emerald-600 bg-emerald-50 px-4 py-2 rounded-lg">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            LULUS
                        </span>
                    @elseif($overallProgress >= 85)
                        <span class="inline-flex items-center gap-1.5 text-sm font-medium text-blue-600 bg-blue-50 px-3 py-1.5 rounded-lg">Hampir Selesai</span>
                    @elseif($overallProgress >= 50)
                        <span class="inline-flex items-center gap-1.5 text-sm font-medium text-amber-600 bg-amber-50 px-3 py-1.5 rounded-lg">Dalam Proses</span>
                    @else
                        <span class="inline-flex items-center gap-1.5 text-sm font-medium text-slate-600 bg-slate-100 px-3 py-1.5 rounded-lg">Memulai</span>
                    @endif
                </div>
            </div>
        </div>

        <!-- Student Profile -->
        <div class="bg-white rounded-xl border border-slate-200 p-5 mb-6">
            <div class="flex flex-col sm:flex-row sm:items-center gap-4">
                <div class="w-16 h-16 rounded-xl overflow-hidden {{ $siswa->foto ? '' : 'bg-blue-500' }}">
                    @if($siswa->foto)
                        <img src="{{ asset('storage/foto/' . $siswa->foto) }}" alt="Foto" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full flex items-center justify-center">
                            <span class="text-xl font-bold text-white">{{ substr($siswa->nama, 0, 1) }}</span>
                        </div>
                    @endif
                </div>
                <div class="flex-1 min-w-0">
                    <h3 class="text-lg font-semibold text-slate-800 truncate">{{ $siswa->nama }}</h3>
                    <p class="text-sm text-slate-500">NISN: {{ $siswa->nisn }}</p>
                    @if($siswa->pendaftaran?->jurusan)
                        <div class="mt-2 inline-flex items-center gap-2 text-sm">
                            <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"/>
                            </svg>
                            <span class="text-blue-600 font-medium">{{ $siswa->pendaftaran->jurusan->nama }}</span>
                        </div>
                    @endif
                </div>
                <div class="flex gap-4 text-center">
                    <div>
                        <p class="text-xl font-bold text-slate-800">{{ $totalSteps - $completedSteps }}</p>
                        <p class="text-xs text-slate-500">Tersisa</p>
                    </div>
                    <div class="w-px bg-slate-200"></div>
                    <div>
                        <p class="text-xl font-bold {{ $progress['is_complete'] ? 'text-emerald-600' : 'text-amber-600' }}">{{ $progress['uploaded'] }}/{{ $progress['total'] }}</p>
                        <p class="text-xs text-slate-500">Berkas</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Steps Timeline -->
        <div class="bg-white rounded-xl border border-slate-200 p-5">
            <h3 class="font-semibold text-slate-800 mb-5">Detail Langkah</h3>
            
            <div class="relative">
                <div class="absolute left-5 top-3 bottom-3 w-0.5 bg-slate-200"></div>
                
                <div class="space-y-4">
                    
                    <!-- Step 1: Pendaftaran -->
                    <div class="relative flex gap-4">
                        <div class="w-10 h-10 rounded-full bg-blue-500 flex items-center justify-center flex-shrink-0 z-10">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                        <div class="flex-1 pt-1">
                            <div class="flex items-center justify-between mb-1">
                                <h4 class="font-medium text-slate-800">Pendaftaran Akun</h4>
                                <span class="text-xs text-blue-600 bg-blue-50 px-2 py-0.5 rounded">Selesai</span>
                            </div>
                            <p class="text-sm text-slate-500">Akun berhasil dibuat pada {{ $siswa->created_at->format('d M Y') }}</p>
                        </div>
                    </div>

                    <!-- Step 2: Biodata -->
                    <div class="relative flex gap-4">
                        <div class="w-10 h-10 rounded-full flex items-center justify-center flex-shrink-0 z-10 {{ $biodataComplete ? 'bg-blue-500' : 'bg-slate-200' }}">
                            @if($biodataComplete)
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                                </svg>
                            @else
                                <span class="text-sm font-bold text-slate-600">2</span>
                            @endif
                        </div>
                        <div class="flex-1 pt-1">
                            <div class="flex items-center justify-between mb-1">
                                <h4 class="font-medium {{ $biodataComplete ? 'text-slate-800' : 'text-slate-600' }}">Data Diri</h4>
                                @if($biodataComplete)
                                    <span class="text-xs text-blue-600 bg-blue-50 px-2 py-0.5 rounded">Lengkap</span>
                                @else
                                    <a href="{{ route('ppdb.lengkapi-data') }}" class="text-xs text-white bg-blue-500 hover:bg-blue-600 px-3 py-1 rounded transition-colors">Lengkapi</a>
                                @endif
                            </div>
                            <p class="text-sm text-slate-500">{{ $biodataComplete ? 'Data diri sudah lengkap' : 'Silakan lengkapi data diri' }}</p>
                        </div>
                    </div>

                    <!-- Step 3: Orang Tua -->
                    <div class="relative flex gap-4">
                        <div class="w-10 h-10 rounded-full flex items-center justify-center flex-shrink-0 z-10 {{ $orangTuaComplete ? 'bg-blue-500' : 'bg-slate-200' }}">
                            @if($orangTuaComplete)
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                                </svg>
                            @else
                                <span class="text-sm font-bold text-slate-600">3</span>
                            @endif
                        </div>
                        <div class="flex-1 pt-1">
                            <div class="flex items-center justify-between mb-1">
                                <h4 class="font-medium {{ $orangTuaComplete ? 'text-slate-800' : 'text-slate-600' }}">{{ $labelOrtu }}</h4>
                                @if($orangTuaComplete)
                                    <span class="text-xs text-blue-600 bg-blue-50 px-2 py-0.5 rounded">Lengkap</span>
                                @else
                                    <a href="{{ route('ppdb.lengkapi-data') }}" class="text-xs text-white bg-blue-500 hover:bg-blue-600 px-3 py-1 rounded transition-colors">Lengkapi</a>
                                @endif
                            </div>
                            <p class="text-sm text-slate-500">{{ $orangTuaComplete ? 'Data sudah lengkap' : 'Silakan lengkapi data' }}</p>
                        </div>
                    </div>

                    <!-- Step 4: Jurusan -->
                    <div class="relative flex gap-4">
                        <div class="w-10 h-10 rounded-full flex items-center justify-center flex-shrink-0 z-10 {{ $jurusanComplete ? 'bg-blue-500' : 'bg-slate-200' }}">
                            @if($jurusanComplete)
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                                </svg>
                            @else
                                <span class="text-sm font-bold text-slate-600">4</span>
                            @endif
                        </div>
                        <div class="flex-1 pt-1">
                            <div class="flex items-center justify-between mb-1">
                                <h4 class="font-medium {{ $jurusanComplete ? 'text-slate-800' : 'text-slate-600' }}">Pilihan Jurusan</h4>
                                @if($jurusanComplete)
                                    <span class="text-xs text-blue-600 bg-blue-50 px-2 py-0.5 rounded">Terpilih</span>
                                @else
                                    <a href="{{ route('ppdb.lengkapi-data') }}" class="text-xs text-white bg-blue-500 hover:bg-blue-600 px-3 py-1 rounded transition-colors">Pilih</a>
                                @endif
                            </div>
                            <p class="text-sm text-slate-500">
                                @if($jurusanComplete)
                                    <span class="text-blue-600 font-medium">{{ $siswa->pendaftaran->jurusan->nama ?? '' }}</span>
                                @else
                                    Silakan pilih jurusan
                                @endif
                            </p>
                        </div>
                    </div>

                    <!-- Step 5: Upload Berkas -->
                    <div class="relative flex gap-4">
                        <div class="w-10 h-10 rounded-full flex items-center justify-center flex-shrink-0 z-10 {{ $progress['is_complete'] ? 'bg-blue-500' : ($progress['uploaded'] > 0 ? 'bg-amber-400' : 'bg-slate-200') }}">
                            @if($progress['is_complete'])
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                                </svg>
                            @else
                                <span class="text-sm font-bold {{ $progress['uploaded'] > 0 ? 'text-white' : 'text-slate-600' }}">{{ $progress['uploaded'] }}</span>
                            @endif
                        </div>
                        <div class="flex-1 pt-1">
                            <div class="flex items-center justify-between mb-1">
                                <h4 class="font-medium {{ $progress['is_complete'] ? 'text-slate-800' : 'text-slate-600' }}">Upload Berkas</h4>
                                <a href="{{ route('ppdb.berkas') }}" class="text-xs {{ $progress['is_complete'] ? 'text-blue-600 bg-blue-50' : 'text-white bg-blue-500 hover:bg-blue-600' }} px-3 py-1 rounded transition-colors">
                                    {{ $progress['is_complete'] ? 'Kelola' : ($progress['uploaded'] > 0 ? 'Lanjut' : 'Upload') }}
                                </a>
                            </div>
                            <p class="text-sm text-slate-500 mb-2">{{ $progress['is_complete'] ? 'Semua berkas lengkap' : 'Upload dokumen yang diperlukan' }}</p>
                            <div class="w-full bg-slate-100 rounded-full h-1.5">
                                <div class="bg-blue-500 h-1.5 rounded-full transition-all" style="width: {{ ($progress['uploaded'] / $progress['total']) * 100 }}%"></div>
                            </div>
                            <p class="text-xs text-slate-400 mt-1">{{ $progress['uploaded'] }} dari {{ $progress['total'] }} dokumen</p>
                        </div>
                    </div>

                    <!-- Step 6: Tes & Wawancara -->
                    <div class="relative flex gap-4">
                        <div class="w-10 h-10 rounded-full flex items-center justify-center flex-shrink-0 z-10 {{ $wawancaraComplete ? 'bg-blue-500' : ($progress['is_complete'] ? 'bg-blue-100 border-2 border-blue-500' : 'bg-slate-200') }}">
                            @if($wawancaraComplete)
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                                </svg>
                            @elseif($progress['is_complete'])
                                <span class="w-2 h-2 bg-blue-500 rounded-full"></span>
                            @else
                                <span class="text-sm font-bold text-slate-600">6</span>
                            @endif
                        </div>
                        <div class="flex-1 pt-1">
                            <div class="flex items-center justify-between mb-1">
                                <h4 class="font-medium {{ $wawancaraComplete ? 'text-slate-800' : ($progress['is_complete'] ? 'text-blue-600' : 'text-slate-600') }}">Tes & Wawancara</h4>
                                @if($wawancaraComplete)
                                    <span class="text-xs text-blue-600 bg-blue-50 px-2 py-0.5 rounded">Selesai</span>
                                @elseif($progress['is_complete'])
                                    <span class="text-xs text-blue-600 bg-blue-50 px-2 py-0.5 rounded">Menunggu</span>
                                @endif
                            </div>
                            <p class="text-sm text-slate-500">
                                @if($wawancaraComplete)
                                    Tes dan wawancara telah selesai
                                @elseif($progress['is_complete'])
                                    Menunggu jadwal via WhatsApp
                                @else
                                    Lengkapi upload berkas terlebih dahulu
                                @endif
                            </p>
                        </div>
                    </div>

                    <!-- Step 7: Kelulusan -->
                    <div class="relative flex gap-4">
                        <div class="w-10 h-10 rounded-full flex items-center justify-center flex-shrink-0 z-10 {{ $kelulusanStatus === 'Lulus' ? 'bg-emerald-500' : ($kelulusanStatus === 'Tidak Lulus' ? 'bg-red-500' : ($wawancaraComplete ? 'bg-blue-100 border-2 border-blue-500' : 'bg-slate-200')) }}">
                            @if($kelulusanStatus === 'Lulus')
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                                </svg>
                            @elseif($kelulusanStatus === 'Tidak Lulus')
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            @elseif($wawancaraComplete)
                                <span class="w-2 h-2 bg-blue-500 rounded-full"></span>
                            @else
                                <span class="text-sm font-bold text-slate-600">7</span>
                            @endif
                        </div>
                        <div class="flex-1 pt-1">
                            <div class="flex items-center justify-between mb-1">
                                <h4 class="font-medium {{ $kelulusanStatus === 'Lulus' ? 'text-emerald-700' : ($kelulusanStatus === 'Tidak Lulus' ? 'text-red-700' : ($wawancaraComplete ? 'text-blue-600' : 'text-slate-600')) }}">Kelulusan</h4>
                                @if($kelulusanStatus === 'Lulus')
                                    <span class="text-xs text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded font-bold">LULUS</span>
                                @elseif($kelulusanStatus === 'Tidak Lulus')
                                    <span class="text-xs text-red-600 bg-red-50 px-2 py-0.5 rounded font-bold">Tidak Lulus</span>
                                @elseif($wawancaraComplete)
                                    <span class="text-xs text-blue-600 bg-blue-50 px-2 py-0.5 rounded">Diproses</span>
                                @endif
                            </div>
                            <p class="text-sm {{ $kelulusanStatus === 'Lulus' ? 'text-emerald-600' : ($kelulusanStatus === 'Tidak Lulus' ? 'text-red-600' : 'text-slate-500') }}">
                                @if($kelulusanStatus === 'Lulus')
                                    Selamat! Anda dinyatakan LULUS.
                                @elseif($kelulusanStatus === 'Tidak Lulus')
                                    Anda dinyatakan tidak lulus. Tetap semangat!
                                @elseif($wawancaraComplete)
                                    Status kelulusan sedang diproses.
                                @else
                                    Menunggu selesainya tes dan wawancara
                                @endif
                            </p>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- Info Card -->
        @if($kelulusanStatus === 'Lulus' && $progress['is_complete'])
            {{-- Sudah lulus dan berkas lengkap --}}
            <div class="mt-6 bg-emerald-50 border border-emerald-200 rounded-xl p-5">
                <div class="flex flex-col sm:flex-row sm:items-center gap-4">
                    <div class="w-12 h-12 bg-emerald-500 rounded-lg flex items-center justify-center flex-shrink-0">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h3 class="font-semibold text-emerald-900">Selamat! Anda Lulus!</h3>
                        <p class="text-sm text-emerald-700">Anda telah berhasil menyelesaikan semua tahapan dan dinyatakan LULUS.</p>
                    </div>
                    <a href="{{ route('ppdb.pengumuman') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-emerald-500 text-white rounded-lg font-medium hover:bg-emerald-600 transition-colors">
                        Lihat Pengumuman
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                        </svg>
                    </a>
                </div>
            </div>
        @elseif($kelulusanStatus === 'Lulus' && !$progress['is_complete'])
            {{-- Sudah lulus tapi berkas belum lengkap --}}
            <div class="mt-6 bg-emerald-50 border border-emerald-200 rounded-xl p-5">
                <div class="flex flex-col sm:flex-row sm:items-center gap-4">
                    <div class="w-12 h-12 bg-emerald-500 rounded-lg flex items-center justify-center flex-shrink-0">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h3 class="font-semibold text-emerald-900">Selamat atas kelulusan anda!</h3>
                        <p class="text-sm text-emerald-700">Mohon untuk lengkapi berkas Anda. Silakan upload berkas yang masih kurang.</p>
                    </div>
                    <a href="{{ route('ppdb.berkas') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-emerald-500 text-white rounded-lg font-medium hover:bg-emerald-600 transition-colors">
                        Lengkapi Berkas
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                        </svg>
                    </a>
                </div>
            </div>
        @elseif(!$progress['is_complete'])
            {{-- Belum lulus dan berkas belum lengkap --}}
            <div class="mt-6 bg-amber-50 border border-amber-200 rounded-xl p-5">
                <div class="flex flex-col sm:flex-row sm:items-center gap-4">
                    <div class="w-12 h-12 bg-amber-500 rounded-lg flex items-center justify-center flex-shrink-0">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h3 class="font-semibold text-amber-900">Hampir Selesai!</h3>
                        <p class="text-sm text-amber-700">Upload semua berkas. Tes dan wawancara akan diinformasikan via WhatsApp.</p>
                    </div>
                    <a href="{{ route('ppdb.berkas') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-amber-500 text-white rounded-lg font-medium hover:bg-amber-600 transition-colors">
                        Upload Berkas
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                        </svg>
                    </a>
                </div>
            </div>
        @elseif($overallProgress >= 85)
            {{-- Berkas lengkap tapi belum lulus, menunggu tes/wawancara --}}
            <div class="mt-6 bg-blue-50 border border-blue-200 rounded-xl p-5">
                <div class="flex flex-col sm:flex-row sm:items-center gap-4">
                    <div class="w-12 h-12 bg-blue-500 rounded-lg flex items-center justify-center flex-shrink-0">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h3 class="font-semibold text-blue-900">Hampir Selesai!</h3>
                        <p class="text-sm text-blue-700">Semua data Anda sudah lengkap. Tes dan wawancara akan diinformasikan via WhatsApp.</p>
                    </div>
                </div>
            </div>
        @elseif($overallProgress < 50)
            <div class="mt-6 bg-slate-50 border border-slate-200 rounded-xl p-5">
                <div class="flex flex-col sm:flex-row sm:items-center gap-4">
                    <div class="w-12 h-12 bg-slate-200 rounded-lg flex items-center justify-center flex-shrink-0">
                        <svg class="w-6 h-6 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h3 class="font-semibold text-slate-800">Mulai Perjalanan Anda</h3>
                        <p class="text-sm text-slate-600">Silakan lengkapi semua data dan upload dokumen yang diperlukan.</p>
                    </div>
                    <a href="{{ route('ppdb.lengkapi-data') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-blue-500 text-white rounded-lg font-medium hover:bg-blue-600 transition-colors">
                        Mulai
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </a>
                </div>
            </div>
        @endif

    </div>
</div>
@endsection
