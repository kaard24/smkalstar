@extends('layouts.admin')

@section('title', 'Dashboard - Admin Panel')

@section('content')
<div class="max-w-6xl mx-auto">
    <!-- Welcome Banner -->
    <div class="bg-primary rounded-2xl shadow-lg p-8 mb-8 text-white border-4 border-green-800">
        <div class="flex flex-col md:flex-row items-center gap-6 text-center md:text-left">
            <div class="w-20 h-20 bg-white rounded-full flex items-center justify-center flex-shrink-0">
                <svg class="w-10 h-10 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <div>
                <h1 class="text-3xl font-bold mb-2">Selamat Datang di Panel Admin</h1>
                <p class="text-xl text-white/90">Kelola data sekolah dengan mudah dan cepat</p>
            </div>
        </div>
    </div>

    <!-- Statistik Utama - Cards Besar -->
    <div class="grid md:grid-cols-3 gap-6 mb-8">
        <!-- Total Pendaftar -->
        <div class="bg-white rounded-2xl card-solid p-6 hover-clear transition cursor-pointer" onclick="window.location='{{ route('admin.pendaftar.index') }}'">
            <div class="flex items-center gap-5">
                <div class="w-16 h-16 bg-blue-100 rounded-xl flex items-center justify-center flex-shrink-0">
                    <svg class="w-8 h-8 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-gray-600 font-semibold text-lg">Total Pendaftar</p>
                    <p class="text-4xl font-bold text-gray-900">{{ \App\Models\CalonSiswa::count() }}</p>
                    <p class="text-sm text-gray-500 mt-1">orang telah mendaftar</p>
                </div>
            </div>
        </div>

        <!-- Jumlah Jurusan -->
        <div class="bg-white rounded-2xl card-solid p-6 hover-clear transition cursor-pointer" onclick="window.location='{{ route('admin.jurusan.index') }}'">
            <div class="flex items-center gap-5">
                <div class="w-16 h-16 bg-green-100 rounded-xl flex items-center justify-center flex-shrink-0">
                    <svg class="w-8 h-8 text-green-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-gray-600 font-semibold text-lg">Jumlah Jurusan</p>
                    <p class="text-4xl font-bold text-gray-900">{{ \App\Models\Jurusan::count() }}</p>
                    <p class="text-sm text-gray-500 mt-1">program keahlian</p>
                </div>
            </div>
        </div>

        <!-- Total Berita -->
        <div class="bg-white rounded-2xl card-solid p-6 hover-clear transition cursor-pointer" onclick="window.location='{{ route('admin.berita.index') }}'">
            <div class="flex items-center gap-5">
                <div class="w-16 h-16 bg-yellow-100 rounded-xl flex items-center justify-center flex-shrink-0">
                    <svg class="w-8 h-8 text-yellow-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-gray-600 font-semibold text-lg">Jumlah Berita</p>
                    <p class="text-4xl font-bold text-gray-900">{{ \App\Models\Berita::count() }}</p>
                    <p class="text-sm text-gray-500 mt-1">artikel dipublikasikan</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Menu Navigasi Cepat - Grid Besar -->
    <div class="bg-white rounded-2xl card-solid p-8">
        <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center gap-3">
            <svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
            </svg>
            Menu Cepat
        </h2>
        
        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-4">
            <!-- Data Pendaftar -->
            <a href="{{ route('admin.pendaftar.index') }}" 
               class="flex flex-col items-center gap-4 p-6 border-2 border-gray-200 rounded-xl hover:border-primary hover:bg-green-50 transition text-center group">
                <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center group-hover:bg-blue-200 transition">
                    <svg class="w-8 h-8 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </div>
                <div>
                    <p class="font-bold text-lg text-gray-900">Data Pendaftar</p>
                    <p class="text-sm text-gray-500 mt-1">Lihat & kelola data siswa</p>
                </div>
            </a>

            <!-- Jurusan -->
            <a href="{{ route('admin.jurusan.index') }}" 
               class="flex flex-col items-center gap-4 p-6 border-2 border-gray-200 rounded-xl hover:border-primary hover:bg-green-50 transition text-center group">
                <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center group-hover:bg-green-200 transition">
                    <svg class="w-8 h-8 text-green-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>
                    </svg>
                </div>
                <div>
                    <p class="font-bold text-lg text-gray-900">Jurusan</p>
                    <p class="text-sm text-gray-500 mt-1">Kelola program studi</p>
                </div>
            </a>

            <!-- Fasilitas -->
            <a href="{{ route('admin.fasilitas.index') }}" 
               class="flex flex-col items-center gap-4 p-6 border-2 border-gray-200 rounded-xl hover:border-primary hover:bg-green-50 transition text-center group">
                <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center group-hover:bg-purple-200 transition">
                    <svg class="w-8 h-8 text-purple-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                </div>
                <div>
                    <p class="font-bold text-lg text-gray-900">Fasilitas</p>
                    <p class="text-sm text-gray-500 mt-1">Sarana & prasarana</p>
                </div>
            </a>

            <!-- Berita -->
            <a href="{{ route('admin.berita.index') }}" 
               class="flex flex-col items-center gap-4 p-6 border-2 border-gray-200 rounded-xl hover:border-primary hover:bg-green-50 transition text-center group">
                <div class="w-16 h-16 bg-yellow-100 rounded-full flex items-center justify-center group-hover:bg-yellow-200 transition">
                    <svg class="w-8 h-8 text-yellow-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                    </svg>
                </div>
                <div>
                    <p class="font-bold text-lg text-gray-900">Berita</p>
                    <p class="text-sm text-gray-500 mt-1">Kelola artikel sekolah</p>
                </div>
            </a>

            <!-- Ekstrakurikuler -->
            <a href="{{ route('admin.ekstrakurikuler.index') }}" 
               class="flex flex-col items-center gap-4 p-6 border-2 border-gray-200 rounded-xl hover:border-primary hover:bg-green-50 transition text-center group">
                <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center group-hover:bg-red-200 transition">
                    <svg class="w-8 h-8 text-red-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div>
                    <p class="font-bold text-lg text-gray-900">Ekstrakurikuler</p>
                    <p class="text-sm text-gray-500 mt-1">Kegiatan siswa</p>
                </div>
            </a>

            <!-- Prestasi -->
            <a href="{{ route('admin.prestasi.index') }}" 
               class="flex flex-col items-center gap-4 p-6 border-2 border-gray-200 rounded-xl hover:border-primary hover:bg-green-50 transition text-center group">
                <div class="w-16 h-16 bg-orange-100 rounded-full flex items-center justify-center group-hover:bg-orange-200 transition">
                    <svg class="w-8 h-8 text-orange-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
                    </svg>
                </div>
                <div>
                    <p class="font-bold text-lg text-gray-900">Prestasi</p>
                    <p class="text-sm text-gray-500 mt-1">Prestasi sekolah</p>
                </div>
            </a>

            <!-- Galeri -->
            <a href="{{ route('admin.galeri.index') }}" 
               class="flex flex-col items-center gap-4 p-6 border-2 border-gray-200 rounded-xl hover:border-primary hover:bg-green-50 transition text-center group">
                <div class="w-16 h-16 bg-pink-100 rounded-full flex items-center justify-center group-hover:bg-pink-200 transition">
                    <svg class="w-8 h-8 text-pink-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
                <div>
                    <p class="font-bold text-lg text-gray-900">Galeri</p>
                    <p class="text-sm text-gray-500 mt-1">Foto kegiatan</p>
                </div>
            </a>

            <!-- Profil Sekolah -->
            <a href="{{ route('admin.profil-sekolah.sejarah') }}" 
               class="flex flex-col items-center gap-4 p-6 border-2 border-gray-200 rounded-xl hover:border-primary hover:bg-green-50 transition text-center group">
                <div class="w-16 h-16 bg-teal-100 rounded-full flex items-center justify-center group-hover:bg-teal-200 transition">
                    <svg class="w-8 h-8 text-teal-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                </div>
                <div>
                    <p class="font-bold text-lg text-gray-900">Profil Sekolah</p>
                    <p class="text-sm text-gray-500 mt-1">Sejarah & visi misi</p>
                </div>
            </a>
        </div>
    </div>

    <!-- Panduan Singkat -->
    <div class="mt-8 bg-blue-50 border-2 border-blue-200 rounded-2xl p-6">
        <h3 class="text-xl font-bold text-blue-900 mb-3 flex items-center gap-2">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            Petunjuk Penggunaan
        </h3>
        <ul class="space-y-2 text-blue-800 text-lg">
            <li class="flex items-start gap-2">
                <span class="font-bold">1.</span>
                <span>Klik menu <strong>Data Pendaftar</strong> untuk melihat dan mengelola data calon siswa</span>
            </li>
            <li class="flex items-start gap-2">
                <span class="font-bold">2.</span>
                <span>Klik menu <strong>Berita</strong> untuk menambah atau mengubah artikel di website</span>
            </li>
            <li class="flex items-start gap-2">
                <span class="font-bold">3.</span>
                <span>Klik tombol <strong>Lihat Web</strong> di atas untuk melihat tampilan website publik</span>
            </li>
        </ul>
    </div>
</div>
@endsection
