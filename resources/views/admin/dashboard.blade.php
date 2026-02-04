@extends('layouts.admin')

@section('title', 'Dashboard - Admin Panel')

@section('content')
    {{-- Welcome Banner - Flat Slate-700 dengan brand accent subtle --}}
    <div class="welcome-banner rounded-xl shadow-sm p-6 mb-8 text-white relative">
        <div class="flex flex-col md:flex-row items-center gap-4 text-center md:text-left relative z-10">
            <div class="w-14 h-14 bg-[#4276A3]/20 rounded-xl flex items-center justify-center flex-shrink-0 border border-[#4276A3]/30">
                <svg class="w-7 h-7 text-[#9CBCDA]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <div>
                <h1 class="text-xl font-semibold">Selamat Datang di Panel Admin</h1>
                <p class="text-sm text-slate-300 mt-1">Kelola data sekolah dengan mudah dan cepat</p>
            </div>
        </div>
    </div>

    {{-- Statistik - Menggunakan Set B palette --}}
    <div class="grid md:grid-cols-4 gap-5 mb-8">
        {{-- Total Pendaftar --}}
        <a href="{{ route('admin.pendaftar.index') }}" class="stat-card card p-5 hover:border-[#4276A3] transition group">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-[#4276A3]/10 rounded-xl flex items-center justify-center flex-shrink-0 group-hover:bg-[#4276A3]/20 transition">
                    <svg class="w-6 h-6 text-[#4276A3]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-xs text-slate-500 font-medium uppercase tracking-wider">Total Pendaftar</p>
                    <p class="text-2xl font-bold text-slate-800">{{ $totalPendaftar ?? 0 }}</p>
                </div>
            </div>
        </a>

        {{-- Data Lengkap --}}
        <a href="{{ route('admin.pendaftar.index') }}?status=lengkap" class="stat-card card p-5 hover:border-[#047857] transition group" style="border-left-color: #047857;">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-[#047857]/10 rounded-xl flex items-center justify-center flex-shrink-0 group-hover:bg-[#047857]/20 transition">
                    <svg class="w-6 h-6 text-[#047857]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-xs text-slate-500 font-medium uppercase tracking-wider">Data Lengkap</p>
                    <p class="text-2xl font-bold text-slate-800">{{ $dataLengkap ?? 0 }}</p>
                </div>
            </div>
        </a>

        {{-- Berkas Lengkap --}}
        <a href="{{ route('admin.pendaftar.index') }}" class="stat-card card p-5 hover:border-[#B45309] transition group" style="border-left-color: #B45309;">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-[#B45309]/10 rounded-xl flex items-center justify-center flex-shrink-0 group-hover:bg-[#B45309]/20 transition">
                    <svg class="w-6 h-6 text-[#B45309]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-xs text-slate-500 font-medium uppercase tracking-wider">Berkas Lengkap</p>
                    <p class="text-2xl font-bold text-slate-800">{{ $berkasLengkap ?? 0 }}</p>
                </div>
            </div>
        </a>

        {{-- Siap Tes --}}
        <a href="{{ route('admin.pendaftar.index') }}" class="stat-card card p-5 hover:border-[#4276A3] transition group">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-[#4276A3]/10 rounded-xl flex items-center justify-center flex-shrink-0 group-hover:bg-[#4276A3]/20 transition">
                    <svg class="w-6 h-6 text-[#4276A3]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-xs text-slate-500 font-medium uppercase tracking-wider">Siap Tes</p>
                    <p class="text-2xl font-bold text-slate-800">{{ $siapTes ?? 0 }}</p>
                </div>
            </div>
        </a>
    </div>

    {{-- Menu Navigasi Cepat - Menggunakan Set B (Satu accent: #4276A3) --}}
    <div class="card p-6 mb-8">
        <h2 class="text-lg font-semibold text-slate-800 mb-5 flex items-center gap-2">
            <span class="w-8 h-8 bg-[#4276A3]/10 rounded-lg flex items-center justify-center">
                <svg class="w-4 h-4 text-[#4276A3]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
                </svg>
            </span>
            Menu Cepat
        </h2>
        
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            {{-- Data Pendaftar - Brand Accent --}}
            <a href="{{ route('admin.pendaftar.index') }}" class="group flex flex-col items-center gap-3 p-5 bg-slate-50 border border-slate-200 rounded-xl hover:border-[#4276A3] hover:shadow-sm transition text-center">
                <div class="w-12 h-12 bg-[#4276A3]/10 rounded-xl flex items-center justify-center group-hover:bg-[#4276A3]/20 transition">
                    <svg class="w-6 h-6 text-[#4276A3]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </div>
                <span class="text-sm font-medium text-slate-700 group-hover:text-[#4276A3] transition">Data Pendaftar</span>
            </a>

            {{-- Fasilitas - Slate-600 --}}
            <a href="{{ route('admin.fasilitas.index') }}" class="group flex flex-col items-center gap-3 p-5 bg-slate-50 border border-slate-200 rounded-xl hover:border-slate-400 hover:shadow-sm transition text-center">
                <div class="w-12 h-12 bg-slate-200 rounded-xl flex items-center justify-center group-hover:bg-slate-300 transition">
                    <svg class="w-6 h-6 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                </div>
                <span class="text-sm font-medium text-slate-700 group-hover:text-slate-600 transition">Fasilitas</span>
            </a>

            {{-- Berita - Slate-600 --}}
            <a href="{{ route('admin.berita.index') }}" class="group flex flex-col items-center gap-3 p-5 bg-slate-50 border border-slate-200 rounded-xl hover:border-slate-400 hover:shadow-sm transition text-center">
                <div class="w-12 h-12 bg-slate-200 rounded-xl flex items-center justify-center group-hover:bg-slate-300 transition">
                    <svg class="w-6 h-6 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                    </svg>
                </div>
                <span class="text-sm font-medium text-slate-700 group-hover:text-slate-600 transition">Berita</span>
            </a>

            {{-- Ekstrakurikuler - Slate-600 --}}
            <a href="{{ route('admin.ekstrakurikuler.index') }}" class="group flex flex-col items-center gap-3 p-5 bg-slate-50 border border-slate-200 rounded-xl hover:border-slate-400 hover:shadow-sm transition text-center">
                <div class="w-12 h-12 bg-slate-200 rounded-xl flex items-center justify-center group-hover:bg-slate-300 transition">
                    <svg class="w-6 h-6 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <span class="text-sm font-medium text-slate-700 group-hover:text-slate-600 transition">Ekstrakurikuler</span>
            </a>

            {{-- Prestasi - Slate-600 --}}
            <a href="{{ route('admin.prestasi.index') }}" class="group flex flex-col items-center gap-3 p-5 bg-slate-50 border border-slate-200 rounded-xl hover:border-slate-400 hover:shadow-sm transition text-center">
                <div class="w-12 h-12 bg-slate-200 rounded-xl flex items-center justify-center group-hover:bg-slate-300 transition">
                    <svg class="w-6 h-6 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
                    </svg>
                </div>
                <span class="text-sm font-medium text-slate-700 group-hover:text-slate-600 transition">Prestasi</span>
            </a>

            {{-- Galeri - Slate-600 --}}
            <a href="{{ route('admin.galeri.index') }}" class="group flex flex-col items-center gap-3 p-5 bg-slate-50 border border-slate-200 rounded-xl hover:border-slate-400 hover:shadow-sm transition text-center">
                <div class="w-12 h-12 bg-slate-200 rounded-xl flex items-center justify-center group-hover:bg-slate-300 transition">
                    <svg class="w-6 h-6 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
                <span class="text-sm font-medium text-slate-700 group-hover:text-slate-600 transition">Galeri</span>
            </a>

            {{-- Profil Sekolah - Brand Accent (karena penting) --}}
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

    {{-- Info Cards - Flat design dengan Set B colors --}}
    <div class="grid md:grid-cols-2 gap-6">
        {{-- Alur SPMB - Brand Steel --}}
        <div class="bg-[#4276A3] rounded-xl p-6 text-white shadow-sm relative overflow-hidden">
            <div class="absolute top-0 right-0 w-32 h-32 bg-white/5 rounded-full -mr-10 -mt-10"></div>
            <div class="absolute bottom-0 left-0 w-24 h-24 bg-white/5 rounded-full -ml-10 -mb-10"></div>
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
        
        {{-- Catatan Penting - Slate-700 --}}
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
