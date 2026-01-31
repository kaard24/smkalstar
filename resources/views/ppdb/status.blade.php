@extends('layouts.app')

@section('title', 'Cek Status Pendaftaran - SMK Al-Hidayah Lestari')

@section('content')
    <div class="relative bg-gray-900 min-h-screen py-12 md:py-24 overflow-hidden">
        <!-- Background - Hidden on mobile for performance -->
        <div class="absolute inset-0 opacity-10 md:opacity-20 hidden md:block">
            <img src="{{ asset('images/b2.jpg') }}" class="w-full h-full object-cover" loading="lazy" alt="">
        </div>
        <div class="absolute inset-0 bg-gradient-to-b from-gray-900 via-gray-900/95 to-gray-800"></div>
        
        <div class="container relative z-10 mx-auto px-4 sm:px-6 lg:px-8 max-w-3xl">
            <!-- Header -->
            <div class="text-center mb-8 md:mb-12">
                <span class="inline-block py-1 px-3 rounded-full bg-primary/20 text-primary text-xs md:text-sm font-bold mb-3 border border-primary/20">Portal SPMB Online</span>
                <h1 class="text-2xl md:text-4xl font-bold text-white font-heading mb-2">Cek Status Pendaftaran</h1>
                <p class="text-gray-400 text-sm md:text-base max-w-xl mx-auto">Pantau progres pendaftaran Anda secara real-time.</p>
            </div>

            <!-- Info Card -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden mb-6 md:mb-8">
                <div class="p-6 md:p-8 text-center">
                    <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h2 class="text-xl font-bold text-gray-900 mb-2">Sistem Pendaftaran Sederhana</h2>
                    <p class="text-gray-600 text-sm md:text-base">
                        Setelah melengkapi data dan upload dokumen, Anda akan menunggu jadwal tes yang akan diumumkan melalui WhatsApp.
                    </p>
                </div>
            </div>

            <!-- Steps Info -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-800/10">
                <div class="p-6 md:p-8">
                    <h3 class="font-bold text-gray-900 text-lg mb-6 flex items-center gap-2">
                        <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                        Alur Pendaftaran
                    </h3>
                    
                    <div class="relative pl-6 md:pl-8 space-y-8 before:absolute before:left-2.5 md:before:left-3 before:top-2 before:bottom-2 before:w-0.5 before:bg-gray-200">
                        <!-- Step 1 -->
                        <div class="relative">
                            <div class="absolute -left-[29px] md:-left-[33px] bg-green-500 w-5 h-5 md:w-6 md:h-6 rounded-full border-2 md:border-4 border-white shadow flex items-center justify-center text-white">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-900 text-sm md:text-base">1. Pendaftaran Akun</h4>
                                <p class="text-xs md:text-sm text-gray-600 mt-1">Buat akun dengan NISN dan password</p>
                            </div>
                        </div>
                        
                        <!-- Step 2 -->
                        <div class="relative">
                            <div class="absolute -left-[29px] md:-left-[33px] bg-green-500 w-5 h-5 md:w-6 md:h-6 rounded-full border-2 md:border-4 border-white shadow flex items-center justify-center text-white">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-900 text-sm md:text-base">2. Lengkapi Data</h4>
                                <p class="text-xs md:text-sm text-gray-600 mt-1">Isi biodata, data orang tua, dan pilih jurusan</p>
                            </div>
                        </div>
                        
                        <!-- Step 3 -->
                        <div class="relative">
                            <div class="absolute -left-[29px] md:-left-[33px] bg-green-500 w-5 h-5 md:w-6 md:h-6 rounded-full border-2 md:border-4 border-white shadow flex items-center justify-center text-white">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-900 text-sm md:text-base">3. Upload Dokumen</h4>
                                <p class="text-xs md:text-sm text-gray-600 mt-1">Upload KK, Akta, SKL, dan Ijazah</p>
                            </div>
                        </div>
                        
                        <!-- Step 4 -->
                        <div class="relative">
                            <div class="absolute -left-[29px] md:-left-[33px] bg-yellow-400 w-5 h-5 md:w-6 md:h-6 rounded-full border-2 md:border-4 border-white shadow flex items-center justify-center">
                                <span class="text-xs font-bold text-white">4</span>
                            </div>
                            <div class="bg-yellow-50 rounded-xl p-4 border border-yellow-100">
                                <h4 class="font-bold text-gray-900 text-sm md:text-base">4. Menunggu Jadwal Tes</h4>
                                <p class="text-xs md:text-sm text-gray-600 mt-1">Jadwal tes akan diinformasikan melalui WhatsApp</p>
                            </div>
                        </div>
                        
                        <!-- Step 5 -->
                        <div class="relative opacity-60">
                            <div class="absolute -left-[29px] md:-left-[33px] bg-gray-300 w-5 h-5 md:w-6 md:h-6 rounded-full border-2 md:border-4 border-white shadow flex items-center justify-center text-white text-xs font-bold">
                                5
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-900 text-sm md:text-base">5. Tes & Wawancara</h4>
                                <p class="text-xs md:text-sm text-gray-600 mt-1">Dilaksanakan offline di sekolah</p>
                            </div>
                        </div>
                        
                        <!-- Step 6 -->
                        <div class="relative opacity-60">
                            <div class="absolute -left-[29px] md:-left-[33px] bg-gray-300 w-5 h-5 md:w-6 md:h-6 rounded-full border-2 md:border-4 border-white shadow flex items-center justify-center text-white text-xs font-bold">
                                6
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-900 text-sm md:text-base">6. Kelulusan</h4>
                                <p class="text-xs md:text-sm text-gray-600 mt-1">Selamat! Semua siswa diterima</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Info Box -->
                <div class="bg-blue-50 p-6 border-t border-blue-100">
                    <div class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-blue-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <div>
                            <h4 class="font-semibold text-blue-900 text-sm">Informasi Penting</h4>
                            <ul class="text-xs md:text-sm text-blue-700 mt-2 space-y-1">
                                <li>• Tidak ada nilai tes yang ditampilkan di website</li>
                                <li>• Wawancara dilakukan secara offline di sekolah</li>
                                <li>• Nilai dicatat secara manual oleh panitia</li>
                                <li>• Semua siswa yang mendaftar dipastikan lulus</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Login CTA -->
            <div class="mt-6 md:mt-8 text-center">
                <p class="text-gray-400 text-sm mb-3">Sudah memiliki akun?</p>
                <a href="{{ route('login') }}" class="inline-flex items-center gap-2 bg-primary text-white px-6 py-3 rounded-xl font-semibold hover:bg-green-700 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                    </svg>
                    Login ke Dashboard
                </a>
            </div>
        </div>
    </div>
@endsection
