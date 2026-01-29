@extends('layouts.app')

@section('title', 'Informasi SPMB - SMK Al-Hidayah Lestari')

@section('content')
    <!-- Header Page -->
    <div class="relative bg-gray-900 py-24 overflow-hidden">
        <div class="absolute inset-0 opacity-20">
            <img src="{{ asset('images/b1.jpg') }}" class="w-full h-full object-cover">
        </div>
        <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-gray-900/50 to-transparent"></div>
        <div class="container relative z-10 mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-3xl md:text-5xl font-bold text-white mb-4 font-heading">Sistem Penerimaan Murid Baru</h1>
            <p class="text-gray-300 text-lg max-w-2xl mx-auto font-light">Informasi Lengkap Pendaftaran Tahun Pelajaran 2026/2027</p>
        </div>
    </div>

    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-3 gap-12">
                <!-- Main Content -->
                <div class="lg:col-span-2 space-y-16">
                    
                    <!-- Program Keahlian -->
                    <div>
                        <div class="flex items-center gap-4 mb-8">
                            <span class="w-12 h-12 rounded-2xl bg-primary/10 text-primary flex items-center justify-center text-xl font-bold">1</span>
                            <h2 class="text-3xl font-bold text-gray-900 font-heading">Program Keahlian</h2>
                        </div>
                        <div class="grid sm:grid-cols-2 gap-6">
                            <div class="p-6 border border-green-100 rounded-3xl bg-white hover:shadow-lg transition duration-300 group">
                                <div class="w-10 h-10 rounded-full bg-green-50 mb-4 flex items-center justify-center text-green-600 group-hover:bg-green-600 group-hover:text-white transition">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                </div>
                                <h3 class="font-bold text-gray-900 text-lg group-hover:text-primary transition">Teknik Komputer & Jaringan (TKJ)</h3>
                            </div>
                            <div class="p-6 border border-blue-100 rounded-3xl bg-white hover:shadow-lg transition duration-300 group">
                                <div class="w-10 h-10 rounded-full bg-blue-50 mb-4 flex items-center justify-center text-blue-600 group-hover:bg-blue-600 group-hover:text-white transition">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                                </div>
                                <h3 class="font-bold text-gray-900 text-lg group-hover:text-blue-600 transition">Manajemen Perkantoran (MPLB)</h3>
                            </div>
                            <div class="p-6 border border-orange-100 rounded-3xl bg-white hover:shadow-lg transition duration-300 group">
                                <div class="w-10 h-10 rounded-full bg-orange-50 mb-4 flex items-center justify-center text-orange-600 group-hover:bg-orange-600 group-hover:text-white transition">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </div>
                                <h3 class="font-bold text-gray-900 text-lg group-hover:text-orange-600 transition">Akuntansi Keuangan (AKL)</h3>
                            </div>
                            <div class="p-6 border border-purple-100 rounded-3xl bg-white hover:shadow-lg transition duration-300 group">
                                <div class="w-10 h-10 rounded-full bg-purple-50 mb-4 flex items-center justify-center text-purple-600 group-hover:bg-purple-600 group-hover:text-white transition">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                                </div>
                                <h3 class="font-bold text-gray-900 text-lg group-hover:text-purple-600 transition">Bisnis Daring & Pemasaran (BDP)</h3>
                            </div>
                        </div>
                    </div>

                    <!-- Gelombang Pendaftaran -->
                    <div>
                        <div class="flex items-center gap-4 mb-8">
                            <span class="w-12 h-12 rounded-2xl bg-primary/10 text-primary flex items-center justify-center text-xl font-bold">2</span>
                            <h2 class="text-3xl font-bold text-gray-900 font-heading">Jadwal Pendaftaran</h2>
                        </div>
                        
                        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
                            <div class="p-6 md:p-8 space-y-6">
                                <!-- Gelombang 1 -->
                                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 p-4 rounded-2xl bg-green-50/50 border border-green-100">
                                    <div class="flex items-center gap-4">
                                        <div class="w-12 h-12 rounded-full bg-green-100 flex items-center justify-center text-green-600">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        </div>
                                        <div>
                                            <h4 class="font-bold text-gray-900 text-lg">Gelombang 1</h4>
                                            <p class="text-sm text-gray-600 font-medium">Januari – 23 Mei 2026</p>
                                        </div>
                                    </div>
                                    <span class="px-4 py-2 bg-green-500 text-white rounded-xl text-xs font-bold shadow-sm md:self-center self-start">SEDANG DIBUKA</span>
                                </div>

                                <!-- Gelombang 2 -->
                                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 p-4 rounded-2xl border border-gray-100 hover:bg-gray-50 transition">
                                    <div class="flex items-center gap-4">
                                        <div class="w-12 h-12 rounded-full bg-gray-100 flex items-center justify-center text-gray-400">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        </div>
                                        <div>
                                            <h4 class="font-bold text-gray-900 text-lg">Gelombang 2</h4>
                                            <p class="text-sm text-gray-600 font-medium">24 Mei – 4 Juli 2026</p>
                                        </div>
                                    </div>
                                    <span class="px-4 py-2 bg-gray-100 text-gray-500 rounded-xl text-xs font-bold border border-gray-200 md:self-center self-start">AKAN DATANG</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Alur PPDB -->
                    <div>
                        <div class="flex items-center gap-4 mb-8">
                            <span class="w-12 h-12 rounded-2xl bg-primary/10 text-primary flex items-center justify-center text-xl font-bold">3</span>
                            <h2 class="text-3xl font-bold text-gray-900 font-heading">Alur Pendaftaran</h2>
                        </div>
                        <div class="relative pl-6 sm:pl-10 space-y-10 before:absolute before:left-2 sm:before:left-4 before:top-2 before:bottom-2 before:w-0.5 before:bg-gradient-to-b before:from-primary before:to-gray-200">
                            <div class="relative group">
                                <span class="absolute -left-[33px] sm:-left-[41px] top-0 w-8 h-8 sm:w-10 sm:h-10 rounded-full bg-primary border-4 border-white shadow-md flex items-center justify-center text-white text-xs sm:text-sm font-bold z-10">1</span>
                                <h3 class="font-bold text-gray-900 text-lg mb-1 group-hover:text-primary transition">Pendaftaran Online</h3>
                                <p class="text-gray-600 leading-relaxed">Calon siswa membuat akun & mengisi formulir pendaftaran awal melalui website.</p>
                            </div>
                            <div class="relative group">
                                <span class="absolute -left-[33px] sm:-left-[41px] top-0 w-8 h-8 sm:w-10 sm:h-10 rounded-full bg-white border-4 border-gray-200 shadow-sm flex items-center justify-center text-gray-500 text-xs sm:text-sm font-bold z-10 group-hover:border-primary group-hover:text-primary transition">2</span>
                                <h3 class="font-bold text-gray-900 text-lg mb-1 group-hover:text-primary transition">Lengkapi Biodata</h3>
                                <p class="text-gray-600 leading-relaxed">Melengkapi data diri secara detail dan mengunggah dokumen persyaratan.</p>
                            </div>
                            <div class="relative group">
                                <span class="absolute -left-[33px] sm:-left-[41px] top-0 w-8 h-8 sm:w-10 sm:h-10 rounded-full bg-white border-4 border-gray-200 shadow-sm flex items-center justify-center text-gray-500 text-xs sm:text-sm font-bold z-10 group-hover:border-primary group-hover:text-primary transition">3</span>
                                <h3 class="font-bold text-gray-900 text-lg mb-1 group-hover:text-primary transition">Tes Seleksi</h3>
                                <p class="text-gray-600 leading-relaxed">Mengikuti tes akademik, minat bakat, dan wawancara di sekolah.</p>
                            </div>
                            <div class="relative group">
                                <span class="absolute -left-[33px] sm:-left-[41px] top-0 w-8 h-8 sm:w-10 sm:h-10 rounded-full bg-white border-4 border-gray-200 shadow-sm flex items-center justify-center text-gray-500 text-xs sm:text-sm font-bold z-10 group-hover:border-primary group-hover:text-primary transition">4</span>
                                <h3 class="font-bold text-gray-900 text-lg mb-1 group-hover:text-primary transition">Pengumuman & Daftar Ulang</h3>
                                <p class="text-gray-600 leading-relaxed">Melihat hasil seleksi dan melakukan daftar ulang bagi yang dinyatakan lulus.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Syarat Pendaftaran -->
                    <div>
                         <div class="flex items-center gap-4 mb-8">
                            <span class="w-12 h-12 rounded-2xl bg-primary/10 text-primary flex items-center justify-center text-xl font-bold">4</span>
                            <h2 class="text-3xl font-bold text-gray-900 font-heading">Persyaratan Berkas</h2>
                        </div>
                        <div class="bg-white rounded-3xl border border-gray-100 p-8 shadow-sm">
                            <ul class="space-y-4">
                                <li class="flex items-start gap-3">
                                    <svg class="w-6 h-6 text-green-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                    <span class="text-gray-700 font-medium">Fotokopi Ijazah SMP/MTs (Legalisir)</span>
                                </li>
                                <li class="flex items-start gap-3">
                                    <svg class="w-6 h-6 text-green-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                    <span class="text-gray-700 font-medium">Fotokopi Akta Kelahiran</span>
                                </li>
                                <li class="flex items-start gap-3">
                                    <svg class="w-6 h-6 text-green-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                    <span class="text-gray-700 font-medium">Fotokopi Kartu Keluarga (KK)</span>
                                </li>
                                <li class="flex items-start gap-3">
                                    <svg class="w-6 h-6 text-green-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                    <span class="text-gray-700 font-medium">Pas Foto 3x4 (4 lembar)</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Sidebar Fees & Contact -->
                <div class="lg:col-span-1 space-y-8">
                    <!-- Biaya -->
                    <div class="bg-gradient-to-br from-primary to-green-800 text-white rounded-3xl p-8 shadow-xl relative overflow-hidden group">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full blur-3xl transform translate-x-10 -translate-y-10"></div>
                        
                        <h3 class="text-2xl font-bold mb-6 font-heading relative z-10">Rincian Biaya</h3>
                        <div class="space-y-4 mb-8 relative z-10">
                            <div class="flex justify-between items-center py-2 border-b border-white/20">
                                <span class="text-blue-50">Uang Gedung</span>
                                <span class="font-bold">Rp 1.500.000</span>
                            </div>
                            <div class="flex justify-between items-center py-2 border-b border-white/20">
                                <span class="text-blue-50">SPP Juli</span>
                                <span class="font-bold">Rp 400.000</span>
                            </div>
                            <div class="flex justify-between items-center py-2 border-b border-white/20">
                                <span class="text-blue-50">Seragam (5 Set)</span>
                                <span class="font-bold">Rp 1.150.000</span>
                            </div>
                            <div class="flex justify-between items-center py-2 border-b border-white/20">
                                <span class="text-blue-50">Kegiatan Awal</span>
                                <span class="font-bold">Rp 550.000</span>
                            </div>
                            <div class="flex justify-between items-center pt-4">
                                <span class="font-bold text-lg">TOTAL</span>
                                <span class="font-bold text-2xl">Rp 3.600.000</span>
                            </div>
                        </div>
                        
                         <a href="{{ url('/ppdb/register') }}" class="block w-full text-center bg-white text-primary font-bold py-4 rounded-xl hover:bg-green-50 transition shadow-lg relative z-10 hover:shadow-xl transform group-hover:-translate-y-1 duration-300">
                            Daftar Sekarang
                        </a>
                    </div>
                    
                    <!-- Contact Person -->
                    <div class="bg-white p-8 rounded-3xl border border-gray-100 shadow-sm">
                        <h3 class="text-xl font-bold text-gray-900 mb-6 font-heading">Butuh Bantuan?</h3>
                        <p class="text-gray-600 mb-6 leading-relaxed">Jika ada kendala saat mendaftar, hubungi panitia kami:</p>
                        <div class="space-y-4">
                            <a href="#" class="flex items-center p-4 bg-gray-50 rounded-2xl hover:bg-green-50 group transition duration-300">
                                <div class="w-10 h-10 rounded-full bg-green-100 text-green-600 flex items-center justify-center mr-4 group-hover:bg-green-500 group-hover:text-white transition">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-3.138-5.437-2.1-11.966 3.038-16.148 5.462-4.446 13.532-4.088 18.575 1.14 5.043 5.228 5.61 13.332 1.348 19.32H.057zM23.633 4.97c-5.184-5.366-14.156-5.405-19.349.333C-1.127 9.876-1.077 17.585 4.3 22.03L2.24 29.537l7.536-2.015c1.82 1.05 3.916 1.625 6.13 1.625 6.89 0 12.5-5.61 12.5-12.5 0-3.342-1.303-6.483-3.67-8.67z"/></svg>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500 font-medium">Panitia 1</p>
                                    <p class="font-bold text-gray-900">0812-3456-7890</p>
                                </div>
                            </a>
                            <a href="#" class="flex items-center p-4 bg-gray-50 rounded-2xl hover:bg-green-50 group transition duration-300">
                                <div class="w-10 h-10 rounded-full bg-green-100 text-green-600 flex items-center justify-center mr-4 group-hover:bg-green-500 group-hover:text-white transition">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-3.138-5.437-2.1-11.966 3.038-16.148 5.462-4.446 13.532-4.088 18.575 1.14 5.043 5.228 5.61 13.332 1.348 19.32H.057zM23.633 4.97c-5.184-5.366-14.156-5.405-19.349.333C-1.127 9.876-1.077 17.585 4.3 22.03L2.24 29.537l7.536-2.015c1.82 1.05 3.916 1.625 6.13 1.625 6.89 0 12.5-5.61 12.5-12.5 0-3.342-1.303-6.483-3.67-8.67z"/></svg>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500 font-medium">Panitia 2</p>
                                    <p class="font-bold text-gray-900">0898-7654-3210</p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
