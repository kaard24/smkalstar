@extends('layouts.app')

@section('title', 'Cek Status Pendaftaran - SMK Al-Hidayah Lestari')

@section('content')
    <div class="relative bg-gray-900 min-h-screen py-24 overflow-hidden">
        <!-- Background Elements -->
        <div class="absolute inset-0 opacity-20">
            <img src="{{ asset('images/b2.jpg') }}" class="w-full h-full object-cover">
        </div>
        <div class="absolute inset-0 bg-gradient-to-b from-gray-900 via-gray-900/90 to-gray-800"></div>
        
        <div class="container relative z-10 mx-auto px-4 sm:px-6 lg:px-8 max-w-3xl">
            <!-- Header -->
            <div class="text-center mb-16">
                <span class="inline-block py-1 px-3 rounded-full bg-primary/20 text-primary text-sm font-bold mb-4 border border-primary/20">Portal SPMB Online</span>
                <h1 class="text-3xl md:text-5xl font-bold text-white font-heading mb-4">Cek Status Pendaftaran</h1>
                <p class="text-gray-400 text-lg max-w-xl mx-auto">Pantau progres seleksi Anda secara real-time dengan memasukkan nomor pendaftaran atau NISN.</p>
            </div>

            <!-- Search Card -->
            <div class="bg-white rounded-3xl shadow-xl overflow-hidden mb-12 transform transition-all hover:shadow-2xl">
                <div class="p-8 md:p-10">
                    <form class="flex flex-col md:flex-row gap-4 relative">
                        <div class="relative flex-1 group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="h-6 w-6 text-gray-400 group-focus-within:text-primary transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            </div>
                            <input type="text" placeholder="Masukkan Nomor Pendaftaran / NISN" class="w-full pl-12 pr-4 py-4 rounded-2xl border-2 border-gray-100 focus:border-primary focus:ring focus:ring-primary/20 transition shadow-sm placeholder-gray-400 font-medium text-lg">
                        </div>
                        <button type="submit" class="bg-primary hover:bg-green-600 text-white font-bold py-4 px-8 rounded-2xl transition shadow-lg transform active:scale-95 flex items-center justify-center gap-2">
                             <span>Cek Sekarang</span>
                             <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </button>
                    </form>
                </div>
            </div>

            <!-- Result Card (Dummy Data - Hidden by default, show if search result exists) -->
            <!-- For preview purposes, we show it -->
            <div class="bg-white rounded-3xl shadow-2xl overflow-hidden border border-gray-800/10">
                <div class="bg-gradient-to-r from-gray-50 to-white p-8 border-b border-gray-100 flex flex-col md:flex-row justify-between items-center gap-4">
                    <div class="flex items-center gap-4">
                        <div class="w-16 h-16 rounded-2xl bg-primary text-white flex items-center justify-center shadow-lg transform rotate-3">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        </div>
                        <div>
                            <p class="text-sm font-bold text-gray-400 uppercase tracking-wider">Nomor Pendaftaran</p>
                            <p class="font-mono font-bold text-2xl text-gray-900 tracking-tight">SPMB-2026-00123</p>
                        </div>
                    </div>
                    <span class="bg-yellow-100 text-yellow-700 px-6 py-2 rounded-xl text-sm font-bold border border-yellow-200 shadow-sm flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-yellow-500 animate-pulse"></span>
                        Menunggu Tes
                    </span>
                </div>
                
                <div class="p-8 md:p-10">
                    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-10 pb-8 border-b border-gray-100">
                        <div>
                            <h3 class="text-2xl font-bold text-gray-900 mb-2">Ahmad Fulan</h3>
                             <div class="flex items-center text-gray-600 gap-2">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                                <span class="font-medium">Teknik Komputer & Jaringan (TKJ)</span>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-xs text-gray-400 font-bold uppercase mb-1">Gelombang</p>
                            <p class="text-lg font-bold text-gray-900">Gelombang 1</p>
                        </div>
                    </div>

                    <div>
                        <h4 class="font-bold text-gray-900 text-lg mb-8 flex items-center gap-2">
                             <span class="w-8 h-8 rounded-lg bg-gray-100 flex items-center justify-center text-gray-600">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                             </span>
                            Timeline Seleksi
                        </h4>
                        
                         <div class="relative pl-8 md:pl-10 space-y-12 before:absolute before:left-3 before:top-2 before:bottom-2 before:w-0.5 before:bg-gray-100">
                            <!-- Step 1 Compelted -->
                            <div class="relative group">
                                <div class="absolute -left-[39px] bg-green-500 w-8 h-8 rounded-full border-4 border-white shadow-md flex items-center justify-center text-white">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                </div>
                                <div>
                                    <h5 class="font-bold text-gray-900 text-lg mb-1 group-hover:text-primary transition">Pendaftaran Online</h5>
                                    <div class="flex flex-col sm:flex-row sm:items-center gap-1 sm:gap-4 mb-2">
                                        <span class="text-sm text-gray-500 font-medium">27 Jan 2026</span>
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-md text-xs font-medium bg-green-100 text-green-800">
                                            Berkas Terverifikasi
                                        </span>
                                    </div>
                                    <p class="text-gray-600">Data diri dan berkas awal telah berhasil diverifikasi oleh admin.</p>
                                </div>
                            </div>
                            
                            <!-- Step 2 Active -->
                             <div class="relative group">
                                <div class="absolute -left-[39px] bg-white w-8 h-8 rounded-full border-4 border-yellow-400 shadow-md animate-pulse"></div>
                                <div class="bg-yellow-50 rounded-2xl p-5 border border-yellow-100 -mt-4">
                                    <h5 class="font-bold text-gray-900 text-lg mb-1 group-hover:text-yellow-600 transition">Tes Akademik & Wawancara</h5>
                                    <p class="text-sm text-gray-500 font-bold mb-3 flex items-center gap-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        10 Feb 2026, 08:00 WIB
                                    </p>
                                    <div class="flex items-start gap-3 bg-white/50 p-3 rounded-xl mb-4">
                                        <svg class="w-5 h-5 text-yellow-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                        <p class="text-sm text-gray-700"><strong>Lokasi:</strong> Aula Lt. 2 SMK Al-Hidayah Lestari<br><span class="text-gray-500 text-xs">Jln. Raya Puncak Km. 5 No. 123</span></p>
                                    </div>
                                    <a href="#" class="inline-flex items-center gap-2 bg-primary text-white text-sm font-bold px-4 py-2 rounded-lg hover:bg-green-700 transition shadow-sm">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                                        Cetak Kartu Tes
                                    </a>
                                </div>
                            </div>

                             <!-- Step 3 Pending -->
                             <div class="relative opacity-50 group">
                                <div class="absolute -left-[39px] bg-gray-200 w-8 h-8 rounded-full border-4 border-white shadow-sm flex items-center justify-center text-gray-400">
                                    <span class="text-xs font-bold">3</span>
                                </div>
                                <div>
                                    <h5 class="font-bold text-gray-900 text-lg mb-1">Pengumuman Kelulusan</h5>
                                    <p class="text-sm text-gray-500">Estimasi: 15 Feb 2026</p>
                                </div>
                            </div>

                             <!-- Step 4 Pending -->
                             <div class="relative opacity-50 group">
                                <div class="absolute -left-[39px] bg-gray-200 w-8 h-8 rounded-full border-4 border-white shadow-sm flex items-center justify-center text-gray-400">
                                    <span class="text-xs font-bold">4</span>
                                </div>
                                <div>
                                    <h5 class="font-bold text-gray-900 text-lg mb-1">Daftar Ulang</h5>
                                    <p class="text-sm text-gray-500">Menunggu hasil seleksi</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
