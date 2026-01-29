@extends('layouts.app')

@section('title', 'Dashboard SPMB - SMK Al-Hidayah Lestari')

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Header -->
    <div class="bg-gradient-to-r from-primary to-green-600 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                <div>
                    <h1 class="text-2xl md:text-3xl font-bold">Dashboard SPMB</h1>
                    <p class="mt-1 text-green-100">Selamat datang, {{ $siswa->nama ?: 'Calon Siswa' }}!</p>
                </div>
                <div class="mt-4 md:mt-0 flex items-center gap-4">
                    <span class="bg-white/20 px-4 py-2 rounded-lg text-sm">
                        NISN: {{ $siswa->nisn }}
                    </span>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-white/20 hover:bg-white/30 px-4 py-2 rounded-lg text-sm transition">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8" x-data="{ showLoginPopup: {{ session('success') && str_contains(session('success'), 'Selamat datang') ? 'true' : 'false' }} }">
        
        <!-- Login Success Popup -->
        <div x-show="showLoginPopup" x-cloak
             class="fixed inset-0 z-50 flex items-center justify-center p-4"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0">
            <div class="absolute inset-0 bg-black/50" @click="showLoginPopup = false"></div>
            <div class="relative bg-white rounded-3xl shadow-2xl p-8 max-w-sm w-full text-center transform"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 scale-90"
                 x-transition:enter-end="opacity-100 scale-100">
                <!-- Success Icon -->
                <div class="w-20 h-20 mx-auto mb-6 bg-green-100 rounded-full flex items-center justify-center">
                    <svg class="w-10 h-10 text-green-600 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-800 mb-2">Login Berhasil!</h3>
                <p class="text-gray-600 mb-6">{{ session('success') }}</p>
                <button @click="showLoginPopup = false" 
                        class="w-full bg-primary text-white px-6 py-3 rounded-xl font-semibold hover:bg-primary/90 transition shadow-lg">
                    Lanjutkan
                </button>
            </div>
        </div>

        @if(session('error'))
        <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-700 rounded-xl">
            {{ session('error') }}
        </div>
        @endif

        <!-- Completion Alert -->
        @if($completeness['percentage'] < 100)
        <div class="mb-6 p-4 bg-yellow-50 border border-yellow-200 rounded-xl flex items-start gap-3">
            <svg class="w-6 h-6 text-yellow-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
            </svg>
            <div class="flex-1">
                <p class="font-semibold text-yellow-800">Data Belum Lengkap ({{ $completeness['percentage'] }}%)</p>
                <p class="text-sm text-yellow-700 mt-1">Silakan lengkapi data untuk melanjutkan proses pendaftaran.</p>
                <a href="{{ route('ppdb.lengkapi-data') }}" class="inline-flex items-center gap-1 mt-2 text-sm font-semibold text-yellow-800 hover:text-yellow-900">
                    Lengkapi Data Sekarang
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
        </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Status Cards -->
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <!-- Status Pendaftaran -->
                    <div class="bg-white rounded-xl p-4 shadow-sm border border-gray-100">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-lg bg-blue-100 flex items-center justify-center">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500">Pendaftaran</p>
                                <p class="font-semibold text-sm {{ $pendaftaran?->status_pendaftaran === 'Terdaftar' ? 'text-green-600' : 'text-gray-900' }}">
                                    {{ $pendaftaran?->status_pendaftaran ?? 'Belum' }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Status Berkas -->
                    <div class="bg-white rounded-xl p-4 shadow-sm border border-gray-100">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-lg bg-purple-100 flex items-center justify-center">
                                <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500">Berkas</p>
                                @php
                                    $berkasCount = $siswa->berkasPendaftaran->count();
                                @endphp
                                <p class="font-semibold text-sm {{ $berkasCount > 0 ? 'text-green-600' : 'text-gray-600' }}">
                                    {{ $berkasCount > 0 ? 'Berhasil' : 'Belum Upload' }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Status Tes -->
                    <div class="bg-white rounded-xl p-4 shadow-sm border border-gray-100">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-lg bg-orange-100 flex items-center justify-center">
                                <svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500">Tes BTQ</p>
                                <p class="font-semibold text-sm text-gray-900">
                                    {{ $tes?->nilai_btq ? 'Selesai' : 'Pending' }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Status Kelulusan -->
                    <div class="bg-white rounded-xl p-4 shadow-sm border border-gray-100">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-lg {{ $tes?->status_kelulusan === 'Lulus' ? 'bg-green-100' : ($tes?->status_kelulusan === 'Tidak Lulus' ? 'bg-red-100' : 'bg-gray-100') }} flex items-center justify-center">
                                <svg class="w-5 h-5 {{ $tes?->status_kelulusan === 'Lulus' ? 'text-green-600' : ($tes?->status_kelulusan === 'Tidak Lulus' ? 'text-red-600' : 'text-gray-600') }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500">Kelulusan</p>
                                <p class="font-semibold text-sm {{ $tes?->status_kelulusan === 'Lulus' ? 'text-green-600' : ($tes?->status_kelulusan === 'Tidak Lulus' ? 'text-red-600' : 'text-gray-900') }}">
                                    {{ $tes?->status_kelulusan ?? 'Pending' }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Biodata Card -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                        <h2 class="font-semibold text-gray-900">Biodata Siswa</h2>
                        <a href="{{ route('ppdb.profil.edit') }}" class="text-sm text-primary hover:underline">Edit</a>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <p class="text-xs text-gray-500">Nama Lengkap</p>
                                <p class="font-medium text-gray-900">{{ $siswa->nama ?: '-' }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500">NISN</p>
                                <p class="font-medium text-gray-900">{{ $siswa->nisn }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500">Jenis Kelamin</p>
                                <p class="font-medium text-gray-900">{{ $siswa->jk === 'L' ? 'Laki-laki' : 'Perempuan' }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500">Tanggal Lahir</p>
                                <p class="font-medium text-gray-900">{{ $siswa->tgl_lahir ? $siswa->tgl_lahir->format('d F Y') : '-' }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500">No. WhatsApp</p>
                                <p class="font-medium text-gray-900">{{ $siswa->no_wa ?: '-' }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500">Asal Sekolah</p>
                                <p class="font-medium text-gray-900">{{ $siswa->asal_sekolah ?: '-' }}</p>
                            </div>
                            <div class="md:col-span-2">
                                <p class="text-xs text-gray-500">Alamat</p>
                                <p class="font-medium text-gray-900">{{ $siswa->alamat ?: '-' }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Nilai Card -->
                @if($tes)
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-100">
                        <h2 class="font-semibold text-gray-900">Nilai Tes</h2>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                            <div class="text-center p-4 bg-gray-50 rounded-xl">
                                <p class="text-xs text-gray-500 mb-1">BTQ</p>
                                <p class="text-2xl font-bold text-primary">{{ $tes->nilai_btq ?? '-' }}</p>
                            </div>
                            <div class="text-center p-4 bg-gray-50 rounded-xl">
                                <p class="text-xs text-gray-500 mb-1">Wawancara</p>
                                <p class="text-2xl font-bold text-primary">{{ $tes->nilai_wawancara ?? '-' }}</p>
                            </div>
                            <div class="text-center p-4 bg-gray-50 rounded-xl">
                                <p class="text-xs text-gray-500 mb-1">Akademik</p>
                                <p class="text-2xl font-bold text-primary">{{ $tes->nilai_akademik ?? '-' }}</p>
                            </div>
                            <div class="text-center p-4 bg-gray-50 rounded-xl">
                                <p class="text-xs text-gray-500 mb-1">Total</p>
                                <p class="text-2xl font-bold text-primary">{{ $tes->nilai_total ?? '-' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Pengumuman -->
                @if($pengumuman)
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-100">
                        <h2 class="font-semibold text-gray-900">Pengumuman Terbaru</h2>
                    </div>
                    <div class="p-6">
                        <h3 class="font-semibold text-gray-900">{{ $pengumuman->judul }}</h3>
                        <p class="text-sm text-gray-500 mt-1">{{ $pengumuman->created_at->format('d M Y') }}</p>
                        <div class="mt-3 text-gray-700 prose prose-sm max-w-none">
                            {!! nl2br(e($pengumuman->isi)) !!}
                        </div>
                    </div>
                </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Progress Timeline -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-100">
                        <h2 class="font-semibold text-gray-900">Timeline Pendaftaran</h2>
                    </div>
                    <div class="p-6">
                        <div class="space-y-4">
                            @foreach($timeline as $index => $item)
                            <div class="flex gap-3">
                                <div class="flex flex-col items-center">
                                    <div class="w-8 h-8 rounded-full flex items-center justify-center
                                        @if($item['status'] === 'completed') bg-green-100 text-green-600
                                        @elseif($item['status'] === 'current') bg-primary text-white
                                        @elseif($item['status'] === 'rejected') bg-red-100 text-red-600
                                        @else bg-gray-100 text-gray-400
                                        @endif">
                                        @if($item['status'] === 'completed')
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        @elseif($item['status'] === 'rejected')
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                        @else
                                        <span class="text-xs font-bold">{{ $index + 1 }}</span>
                                        @endif
                                    </div>
                                    @if($index < count($timeline) - 1)
                                    <div class="w-0.5 h-full bg-gray-200 my-1"></div>
                                    @endif
                                </div>
                                <div class="pb-4">
                                    <p class="font-medium text-sm text-gray-900">{{ $item['title'] }}</p>
                                    <p class="text-xs text-gray-500">{{ $item['description'] }}</p>
                                    @if($item['date'])
                                    <p class="text-xs text-gray-400 mt-1">{{ $item['date'] }}</p>
                                    @endif
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-100">
                        <h2 class="font-semibold text-gray-900">Menu Cepat</h2>
                    </div>
                    <div class="p-4 space-y-2">
                        <a href="{{ route('ppdb.lengkapi-data') }}" class="flex items-center gap-3 p-3 rounded-lg hover:bg-gray-50 transition">
                            <div class="w-10 h-10 rounded-lg bg-blue-100 flex items-center justify-center">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="font-medium text-sm text-gray-900">Lengkapi Data</p>
                                <p class="text-xs text-gray-500">Isi biodata lengkap</p>
                            </div>
                        </a>
                        <a href="{{ route('ppdb.berkas') }}" class="flex items-center gap-3 p-3 rounded-lg hover:bg-gray-50 transition">
                            <div class="w-10 h-10 rounded-lg bg-purple-100 flex items-center justify-center">
                                <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="font-medium text-sm text-gray-900">Upload Berkas</p>
                                <p class="text-xs text-gray-500">KK, Akta, Ijazah</p>
                            </div>
                        </a>
                        <a href="{{ route('ppdb.status') }}" class="flex items-center gap-3 p-3 rounded-lg hover:bg-gray-50 transition">
                            <div class="w-10 h-10 rounded-lg bg-green-100 flex items-center justify-center">
                                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="font-medium text-sm text-gray-900">Cek Status</p>
                                <p class="text-xs text-gray-500">Lihat progress</p>
                            </div>
                        </a>
                    </div>
                </div>

                <!-- Contact Support -->
                <div class="bg-gradient-to-br from-primary to-green-600 rounded-xl p-6 text-white">
                    <h3 class="font-semibold mb-2">Butuh Bantuan?</h3>
                    <p class="text-sm text-green-100 mb-4">Hubungi panitia SPMB jika ada kendala.</p>
                    <a href="https://wa.me/6281234567890" target="_blank" class="inline-flex items-center gap-2 bg-white text-primary px-4 py-2 rounded-lg text-sm font-semibold hover:bg-green-50 transition">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                        </svg>
                        Hubungi via WhatsApp
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
