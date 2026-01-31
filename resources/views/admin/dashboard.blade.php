@extends('layouts.admin')

@section('title', 'Dashboard - Admin Panel')

@section('content')
    {{-- Welcome Banner --}}
    <div class="bg-primary rounded-lg shadow-sm p-6 mb-6 text-white">
        <div class="flex flex-col md:flex-row items-center gap-4 text-center md:text-left">
            <div class="w-14 h-14 bg-white/20 rounded-full flex items-center justify-center flex-shrink-0">
                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <div>
                <h1 class="text-xl font-bold">Selamat Datang di Panel Admin</h1>
                <p class="text-sm text-green-100 mt-0.5">Kelola data sekolah dengan mudah dan cepat</p>
            </div>
        </div>
    </div>

    {{-- Statistik --}}
    <div class="grid md:grid-cols-4 gap-4 mb-6">
        {{-- Total Pendaftar --}}
        <a href="{{ route('admin.pendaftar.index') }}" class="card p-4 hover:border-primary transition">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-blue-50 rounded-lg flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-xs text-gray-500 font-medium">Total Pendaftar</p>
                    <p class="text-xl font-bold text-gray-900">{{ $totalPendaftar }}</p>
                </div>
            </div>
        </a>

        {{-- Data Lengkap --}}
        <a href="{{ route('admin.pendaftar.index') }}?status=lengkap" class="card p-4 hover:border-primary transition">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-green-50 rounded-lg flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-xs text-gray-500 font-medium">Data Lengkap</p>
                    <p class="text-xl font-bold text-gray-900">{{ $dataLengkap }}</p>
                </div>
            </div>
        </a>

        {{-- Berkas Lengkap --}}
        <a href="{{ route('admin.pendaftar.index') }}" class="card p-4 hover:border-primary transition">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-yellow-50 rounded-lg flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-xs text-gray-500 font-medium">Berkas Lengkap</p>
                    <p class="text-xl font-bold text-gray-900">{{ $berkasLengkap }}</p>
                </div>
            </div>
        </a>

        {{-- Siap Tes --}}
        <a href="{{ route('admin.pendaftar.index') }}" class="card p-4 hover:border-primary transition border-green-200">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 text-green-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-xs text-gray-500 font-medium">Siap Tes</p>
                    <p class="text-xl font-bold text-green-700">{{ $siapTes }}</p>
                </div>
            </div>
        </a>
    </div>

    {{-- Menu Navigasi Cepat --}}
    <div class="card p-5 mb-6">
        <h2 class="text-base font-semibold text-gray-800 mb-4 flex items-center gap-2">
            <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
            </svg>
            Menu Cepat
        </h2>
        
        <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
            <a href="{{ route('admin.pendaftar.index') }}" class="flex flex-col items-center gap-2 p-4 border border-gray-200 rounded-lg hover:border-primary hover:bg-gray-50 transition text-center">
                <div class="w-10 h-10 bg-blue-50 rounded-full flex items-center justify-center">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </div>
                <span class="text-xs font-medium text-gray-700">Data Pendaftar</span>
            </a>

            <a href="{{ route('admin.jurusan.index') }}" class="flex flex-col items-center gap-2 p-4 border border-gray-200 rounded-lg hover:border-primary hover:bg-gray-50 transition text-center">
                <div class="w-10 h-10 bg-green-50 rounded-full flex items-center justify-center">
                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>
                    </svg>
                </div>
                <span class="text-xs font-medium text-gray-700">Jurusan</span>
            </a>

            <a href="{{ route('admin.fasilitas.index') }}" class="flex flex-col items-center gap-2 p-4 border border-gray-200 rounded-lg hover:border-primary hover:bg-gray-50 transition text-center">
                <div class="w-10 h-10 bg-purple-50 rounded-full flex items-center justify-center">
                    <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                </div>
                <span class="text-xs font-medium text-gray-700">Fasilitas</span>
            </a>

            <a href="{{ route('admin.berita.index') }}" class="flex flex-col items-center gap-2 p-4 border border-gray-200 rounded-lg hover:border-primary hover:bg-gray-50 transition text-center">
                <div class="w-10 h-10 bg-yellow-50 rounded-full flex items-center justify-center">
                    <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                    </svg>
                </div>
                <span class="text-xs font-medium text-gray-700">Berita</span>
            </a>

            <a href="{{ route('admin.ekstrakurikuler.index') }}" class="flex flex-col items-center gap-2 p-4 border border-gray-200 rounded-lg hover:border-primary hover:bg-gray-50 transition text-center">
                <div class="w-10 h-10 bg-red-50 rounded-full flex items-center justify-center">
                    <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <span class="text-xs font-medium text-gray-700">Ekstrakurikuler</span>
            </a>

            <a href="{{ route('admin.prestasi.index') }}" class="flex flex-col items-center gap-2 p-4 border border-gray-200 rounded-lg hover:border-primary hover:bg-gray-50 transition text-center">
                <div class="w-10 h-10 bg-orange-50 rounded-full flex items-center justify-center">
                    <svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
                    </svg>
                </div>
                <span class="text-xs font-medium text-gray-700">Prestasi</span>
            </a>

            <a href="{{ route('admin.galeri.index') }}" class="flex flex-col items-center gap-2 p-4 border border-gray-200 rounded-lg hover:border-primary hover:bg-gray-50 transition text-center">
                <div class="w-10 h-10 bg-pink-50 rounded-full flex items-center justify-center">
                    <svg class="w-5 h-5 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
                <span class="text-xs font-medium text-gray-700">Galeri</span>
            </a>

            <a href="{{ route('admin.profil-sekolah.sejarah') }}" class="flex flex-col items-center gap-2 p-4 border border-gray-200 rounded-lg hover:border-primary hover:bg-gray-50 transition text-center">
                <div class="w-10 h-10 bg-teal-50 rounded-full flex items-center justify-center">
                    <svg class="w-5 h-5 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                </div>
                <span class="text-xs font-medium text-gray-700">Profil Sekolah</span>
            </a>
        </div>
    </div>

    {{-- Info Alur PPDB --}}
    <div class="grid md:grid-cols-2 gap-4">
        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
            <h3 class="text-sm font-semibold text-blue-900 mb-3 flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                Alur PPDB Sederhana
            </h3>
            <ol class="space-y-1.5 text-xs text-blue-800 list-decimal list-inside">
                <li>Siswa mendaftar dan melengkapi data (biodata, orang tua, jurusan)</li>
                <li>Siswa upload dokumen (KK, Akta, SKL, Ijazah)</li>
                <li>Setelah berkas lengkap, siswa menunggu jadwal tes via WhatsApp</li>
                <li>Tes dan wawancara dilakukan offline di sekolah</li>
                <li>Semua siswa yang mendaftar dinyatakan LULUS</li>
            </ol>
        </div>
        
        <div class="bg-green-50 border border-green-200 rounded-lg p-4">
            <h3 class="text-sm font-semibold text-green-900 mb-3 flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                Catatan Penting
            </h3>
            <ul class="space-y-1.5 text-xs text-green-800 list-disc list-inside">
                <li>Admin dapat melihat progress upload berkas siswa di menu Data Pendaftar</li>
                <li>Tidak ada nilai tes yang ditampilkan di website (wawancara offline)</li>
                <li>Jadwal tes diumumkan via WhatsApp, bukan melalui dashboard</li>
                <li>Semua siswa otomatis lulus, tidak ada seleksi ketat</li>
            </ul>
        </div>
    </div>
@endsection
