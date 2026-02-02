@extends('layouts.app')

@section('title', 'Status Pendaftaran - SMK Al-Hidayah Lestari')

@section('content')
    <div class="relative bg-gray-900 min-h-screen py-12 md:py-24 overflow-hidden">
        <!-- Background - Hidden on mobile for performance -->
        <div class="absolute inset-0 opacity-10 md:opacity-20 hidden md:block">
            <img src="{{ asset('images/b2.jpg') }}" class="w-full h-full object-cover" loading="lazy" decoding="async" alt="">
        </div>
        <div class="absolute inset-0 bg-gradient-to-b from-gray-900 via-gray-900/95 to-gray-800"></div>
        
        <div class="container relative z-10 mx-auto px-4 sm:px-6 lg:px-8 max-w-3xl">
            <!-- Header -->
            <div class="text-center mb-8 md:mb-12">
                <span class="inline-block py-1 px-3 rounded-full bg-primary/20 text-primary text-xs md:text-sm font-bold mb-3 border border-primary/20">Portal SPMB Online</span>
                <h1 class="text-2xl md:text-4xl font-bold text-white font-heading mb-2">Status Pendaftaran</h1>
                <p class="text-gray-400 text-sm md:text-base max-w-xl mx-auto">Pantau progres pendaftaran Anda secara real-time.</p>
            </div>

            <!-- Student Info Card -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden mb-6 md:mb-8">
                <div class="p-6 md:p-8">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-16 h-16 bg-primary/10 rounded-full flex items-center justify-center">
                            <svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-lg md:text-xl font-bold text-gray-900">{{ $siswa->nama ?? 'Calon Siswa' }}</h2>
                            <p class="text-gray-500 text-sm">NISN: {{ $siswa->nisn }}</p>
                        </div>
                    </div>
                    
                    @if($siswa->pendaftaran && $siswa->pendaftaran->jurusan)
                    <div class="flex items-center gap-2 mt-4 p-3 bg-primary/5 rounded-lg border border-primary/10">
                        <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                        </svg>
                        <span class="text-sm text-gray-700">Jurusan: <strong class="text-primary">{{ $siswa->pendaftaran->jurusan->nama }}</strong></span>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Progress Overview -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden mb-6 md:mb-8">
                <div class="p-6 md:p-8">
                    <h3 class="font-bold text-gray-900 text-lg mb-4">Progress Pendaftaran</h3>
                    
                    <div class="w-full bg-gray-200 rounded-full h-3 mb-4">
                        @php
                            $totalSteps = 4;
                            $completedSteps = 0;
                            if($biodataComplete) $completedSteps++;
                            if($orangTuaComplete) $completedSteps++;
                            if($jurusanComplete) $completedSteps++;
                            if($progress['is_complete']) $completedSteps++;
                            $overallProgress = ($completedSteps / $totalSteps) * 100;
                        @endphp
                        <div class="bg-primary h-3 rounded-full transition-all duration-500" style="width: {{ $overallProgress }}%"></div>
                    </div>
                    
                    <p class="text-sm text-gray-600 text-center">{{ $completedSteps }} dari {{ $totalSteps }} langkah selesai ({{ round($overallProgress) }}%)</p>
                </div>
            </div>

            <!-- Steps Status -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-800/10">
                <div class="p-6 md:p-8">
                    <h3 class="font-bold text-gray-900 text-lg mb-6 flex items-center gap-2">
                        <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                        Detail Progres
                    </h3>
                    
                    <div class="space-y-4">
                        <!-- Step 1: Biodata -->
                        <div class="flex items-center gap-4 p-4 rounded-xl {{ $biodataComplete ? 'bg-green-50 border border-green-100' : 'bg-gray-50 border border-gray-100' }}">
                            <div class="w-10 h-10 rounded-full flex items-center justify-center flex-shrink-0 {{ $biodataComplete ? 'bg-green-500 text-white' : 'bg-gray-200 text-gray-800' }}">
                                @if($biodataComplete)
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                @else
                                    <span class="text-sm font-bold">1</span>
                                @endif
                            </div>
                            <div class="flex-1">
                                <h4 class="font-semibold text-gray-900">Data Diri</h4>
                                <p class="text-sm text-gray-600">{{ $biodataComplete ? 'Lengkap' : 'Belum lengkap' }}</p>
                            </div>
                            @if(!$biodataComplete)
                                <a href="{{ route('ppdb.lengkapi-data') }}" class="text-primary text-sm font-medium hover:underline">Lengkapi</a>
                            @endif
                        </div>
                        
                        <!-- Step 2: Orang Tua -->
                        <div class="flex items-center gap-4 p-4 rounded-xl {{ $orangTuaComplete ? 'bg-green-50 border border-green-100' : 'bg-gray-50 border border-gray-100' }}">
                            <div class="w-10 h-10 rounded-full flex items-center justify-center flex-shrink-0 {{ $orangTuaComplete ? 'bg-green-500 text-white' : 'bg-gray-200 text-gray-800' }}">
                                @if($orangTuaComplete)
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                @else
                                    <span class="text-sm font-bold">2</span>
                                @endif
                            </div>
                            <div class="flex-1">
                                <h4 class="font-semibold text-gray-900">Data Orang Tua</h4>
                                <p class="text-sm text-gray-600">{{ $orangTuaComplete ? 'Lengkap' : 'Belum lengkap' }}</p>
                            </div>
                            @if(!$orangTuaComplete)
                                <a href="{{ route('ppdb.lengkapi-data') }}" class="text-primary text-sm font-medium hover:underline">Lengkapi</a>
                            @endif
                        </div>
                        
                        <!-- Step 3: Jurusan -->
                        <div class="flex items-center gap-4 p-4 rounded-xl {{ $jurusanComplete ? 'bg-green-50 border border-green-100' : 'bg-gray-50 border border-gray-100' }}">
                            <div class="w-10 h-10 rounded-full flex items-center justify-center flex-shrink-0 {{ $jurusanComplete ? 'bg-green-500 text-white' : 'bg-gray-200 text-gray-800' }}">
                                @if($jurusanComplete)
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                @else
                                    <span class="text-sm font-bold">3</span>
                                @endif
                            </div>
                            <div class="flex-1">
                                <h4 class="font-semibold text-gray-900">Pilihan Jurusan</h4>
                                <p class="text-sm text-gray-600">{{ $jurusanComplete ? ($siswa->pendaftaran->jurusan->nama ?? 'Terpilih') : 'Belum memilih' }}</p>
                            </div>
                            @if(!$jurusanComplete)
                                <a href="{{ route('ppdb.lengkapi-data') }}" class="text-primary text-sm font-medium hover:underline">Pilih</a>
                            @endif
                        </div>
                        
                        <!-- Step 4: Berkas -->
                        <div class="flex items-center gap-4 p-4 rounded-xl {{ $progress['is_complete'] ? 'bg-green-50 border border-green-100' : ($progress['uploaded'] > 0 ? 'bg-yellow-50 border border-yellow-100' : 'bg-gray-50 border border-gray-100') }}">
                            <div class="w-10 h-10 rounded-full flex items-center justify-center flex-shrink-0 {{ $progress['is_complete'] ? 'bg-green-500 text-white' : ($progress['uploaded'] > 0 ? 'bg-yellow-400 text-gray-800' : 'bg-gray-200 text-gray-800') }}">
                                @if($progress['is_complete'])
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                @else
                                    <span class="text-sm font-bold">{{ $progress['uploaded'] }}</span>
                                @endif
                            </div>
                            <div class="flex-1">
                                <h4 class="font-semibold text-gray-900">Upload Berkas</h4>
                                <p class="text-sm text-gray-600">{{ $progress['uploaded'] }}/{{ $progress['total'] }} dokumen</p>
                            </div>
                            <a href="{{ route('ppdb.berkas') }}" class="text-primary text-sm font-medium hover:underline">
                                {{ $progress['is_complete'] ? 'Kelola' : 'Upload' }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Next Steps Info -->
            @if($progress['is_complete'] && $biodataComplete && $orangTuaComplete && $jurusanComplete)
                <div class="mt-6 bg-blue-50 border border-blue-200 rounded-xl p-6">
                    <div class="flex items-start gap-3">
                        <svg class="w-6 h-6 text-blue-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <div>
                            <h4 class="font-semibold text-blue-900">Selamat! Semua data lengkap</h4>
                            <p class="text-sm text-blue-700 mt-1">
                                Anda telah menyelesaikan semua langkah pendaftaran. Jadwal tes dan wawancara akan diinformasikan melalui WhatsApp Anda.
                            </p>
                        </div>
                    </div>
                </div>
            @else
                <div class="mt-6 bg-yellow-50 border border-yellow-200 rounded-xl p-6">
                    <div class="flex items-start gap-3">
                        <svg class="w-6 h-6 text-yellow-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                        </svg>
                        <div>
                            <h4 class="font-semibold text-yellow-900">Lengkapi Data Anda</h4>
                            <p class="text-sm text-yellow-700 mt-1">
                                Silakan lengkapi semua data dan upload dokumen yang diperlukan untuk melanjutkan proses pendaftaran.
                            </p>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
