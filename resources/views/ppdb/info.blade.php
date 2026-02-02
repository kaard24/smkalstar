@extends('layouts.app')

@section('title', 'Informasi SPMB - SMK Al-Hidayah Lestari')

@section('content')
    <!-- Header Page - Unique PPDB Design -->
    <div class="relative bg-gradient-to-br from-orange-50 via-amber-50 to-yellow-50 py-16 md:py-24 border-b border-orange-100 overflow-hidden">
        <!-- Decorative Elements -->
        <div class="absolute inset-0">
            <div class="absolute top-0 right-1/4 w-96 h-96 bg-orange-300/20 rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 left-1/4 w-72 h-72 bg-amber-300/20 rounded-full blur-3xl"></div>
            <!-- Diagonal Lines Pattern -->
            <svg class="absolute inset-0 w-full h-full opacity-10" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <pattern id="diagonal-lines" patternUnits="userSpaceOnUse" width="40" height="40" patternTransform="rotate(45)">
                        <line x1="0" y1="0" x2="0" y2="40" stroke="#f97316" stroke-width="2" />
                    </pattern>
                </defs>
                <rect width="100%" height="100%" fill="url(#diagonal-lines)" />
            </svg>
        </div>
        
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
            <div class="inline-flex items-center gap-2 bg-gradient-to-r from-orange-500 to-amber-500 text-white px-5 py-2 rounded-full text-sm font-bold mb-6 shadow-lg shadow-orange-200">
                <span class="w-2 h-2 bg-white rounded-full animate-pulse"></span>
                Pendaftaran Dibuka!
            </div>
            <h1 class="text-3xl md:text-4xl lg:text-5xl xl:text-6xl font-bold text-gray-900 mb-4 font-heading">
                Sistem Penerimaan <br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-500 via-amber-500 to-yellow-500">Murid Baru 2026/2027</span>
            </h1>
            <p class="text-gray-600 text-lg md:text-xl max-w-3xl mx-auto leading-relaxed mb-8">Informasi lengkap mengenai pendaftaran, jadwal, persyaratan, dan biaya pendidikan di SMK Al-Hidayah Lestari</p>
            
            <!-- Countdown/Quick Info -->
            <div class="flex flex-wrap justify-center gap-4 md:gap-6">
                <div class="bg-white/80 backdrop-blur-sm rounded-2xl px-6 py-4 shadow-lg border border-orange-100">
                    <div class="text-2xl font-bold text-orange-600">Gelombang 1</div>
                    <div class="text-sm text-gray-600">Jan - Mei 2026</div>
                </div>
                <div class="bg-white/80 backdrop-blur-sm rounded-2xl px-6 py-4 shadow-lg border border-amber-100">
                    <div class="text-2xl font-bold text-amber-600">Gelombang 2</div>
                    <div class="text-sm text-gray-600">Mei - Juli 2026</div>
                </div>
                <div class="bg-gradient-to-r from-orange-500 to-amber-500 rounded-2xl px-6 py-4 shadow-lg text-white">
                    <div class="text-2xl font-bold">100%</div>
                    <div class="text-sm opacity-90">Gratis Pendaftaran</div>
                </div>
            </div>
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
                            <div class="p-6 border border-sky-100 rounded-3xl bg-white hover:shadow-lg transition duration-300 group">
                                <div class="w-10 h-10 rounded-full bg-sky-50 mb-4 flex items-center justify-center text-sky-600 group-hover:bg-sky-600 group-hover:text-white transition">
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
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08.402-2.599 1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </div>
                                <h3 class="font-bold text-gray-900 text-lg group-hover:text-orange-600 transition">Akuntansi Keuangan (AKL)</h3>
                            </div>
                            <div class="p-6 border border-cyan-100 rounded-3xl bg-white hover:shadow-lg transition duration-300 group">
                                <div class="w-10 h-10 rounded-full bg-cyan-50 mb-4 flex items-center justify-center text-cyan-600 group-hover:bg-cyan-600 group-hover:text-white transition">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                                </div>
                                <h3 class="font-bold text-gray-900 text-lg group-hover:text-cyan-600 transition">Bisnis Daring & Pemasaran (BDP)</h3>
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
                                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 p-4 rounded-2xl bg-sky-50/50 border border-sky-100">
                                    <div class="flex items-center gap-4">
                                        <div class="w-12 h-12 rounded-full bg-sky-100 flex items-center justify-center text-sky-600">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        </div>
                                        <div>
                                            <h4 class="font-bold text-gray-900 text-lg">Gelombang 1</h4>
                                            <p class="text-sm text-gray-600 font-medium">Januari – 23 Mei 2026</p>
                                        </div>
                                    </div>
                                    <span class="px-4 py-2 bg-[#0EA5E9] text-white rounded-xl text-xs font-bold shadow-sm md:self-center self-start">SEDANG DIBUKA</span>
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

                    <!-- Alur SPMB -->
                    <div>
                        <div class="flex items-center gap-4 mb-8">
                            <span class="w-12 h-12 rounded-2xl bg-primary/10 text-primary flex items-center justify-center text-xl font-bold">3</span>
                            <h2 class="text-3xl font-bold text-gray-900 font-heading">Alur Pendaftaran</h2>
                        </div>
                        <div class="relative pl-6 sm:pl-10 space-y-10 before:absolute before:left-2 sm:before:left-4 before:top-2 before:bottom-2 before:w-0.5 before:bg-gradient-to-b before:from-primary before:to-slate-200">
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
                                    <svg class="w-6 h-6 text-[#0EA5E9] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                    <span class="text-gray-700 font-medium">Fotokopi Ijazah SMP/MTs (Legalisir)</span>
                                </li>
                                <li class="flex items-start gap-3">
                                    <svg class="w-6 h-6 text-[#0EA5E9] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                    <span class="text-gray-700 font-medium">Fotokopi Akta Kelahiran</span>
                                </li>
                                <li class="flex items-start gap-3">
                                    <svg class="w-6 h-6 text-[#0EA5E9] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                    <span class="text-gray-700 font-medium">Fotokopi Kartu Keluarga (KK)</span>
                                </li>
                                <li class="flex items-start gap-3">
                                    <svg class="w-6 h-6 text-[#0EA5E9] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                    <span class="text-gray-700 font-medium">Pas Foto 3x4 (4 lembar)</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Sidebar Fees & Contact -->
                <div class="lg:col-span-1 space-y-8">
                    <!-- Biaya -->
                    <div class="bg-gradient-to-br from-[#0EA5E9] to-[#1E3A5F] text-white rounded-3xl p-8 shadow-xl relative overflow-hidden group">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full blur-3xl transform translate-x-10 -translate-y-10"></div>
                        
                        <h3 class="text-2xl font-bold mb-6 font-heading relative z-10">Rincian Biaya</h3>
                        <div class="space-y-4 mb-8 relative z-10">
                            <div class="flex justify-between items-center py-2 border-b border-white/20">
                                <span class="text-cyan-50">Uang Gedung</span>
                                <span class="font-bold">Rp 1.500.000</span>
                            </div>
                            <div class="flex justify-between items-center py-2 border-b border-white/20">
                                <span class="text-cyan-50">SPP Juli</span>
                                <span class="font-bold">Rp 400.000</span>
                            </div>
                            <div class="flex justify-between items-center py-2 border-b border-white/20">
                                <span class="text-cyan-50">Seragam (5 Set)</span>
                                <span class="font-bold">Rp 1.150.000</span>
                            </div>
                            <div class="flex justify-between items-center py-2 border-b border-white/20">
                                <span class="text-cyan-50">Kegiatan Awal</span>
                                <span class="font-bold">Rp 550.000</span>
                            </div>
                            <div class="flex justify-between items-center pt-4">
                                <span class="font-bold text-lg">TOTAL</span>
                                <span class="font-bold text-2xl">Rp 3.600.000</span>
                            </div>
                        </div>
                        
                         <a href="{{ url('/ppdb/register') }}" class="block w-full text-center bg-[#F97316] text-white font-bold py-4 rounded-xl hover:bg-orange-600 transition shadow-lg relative z-10 hover:shadow-xl transform group-hover:-translate-y-1 duration-300">
                            Daftar Sekarang
                        </a>
                    </div>
                    
                    <!-- Contact Person -->
                    <div class="bg-white p-8 rounded-3xl border border-gray-100 shadow-sm">
                        <h3 class="text-xl font-bold text-gray-900 mb-6 font-heading">Butuh Bantuan?</h3>
                        <p class="text-gray-600 mb-6 leading-relaxed">Jika ada kendala saat mendaftar, hubungi panitia kami:</p>
                        <div class="space-y-4">
                            <a href="https://wa.me/628812489572" target="_blank" class="flex items-center p-4 bg-gray-50 rounded-2xl hover:bg-green-50 group transition duration-300">
                                <div class="w-10 h-10 rounded-full bg-green-100 text-green-600 flex items-center justify-center mr-4 group-hover:bg-green-500 group-hover:text-white transition flex-shrink-0">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                                </div>
                                <div class="min-w-0">
                                    <p class="text-sm text-gray-500 font-medium">Pak Kaffa</p>
                                    <p class="font-bold text-gray-900">0881-2489-572</p>
                                </div>
                            </a>
                            <a href="https://wa.me/6289651626030" target="_blank" class="flex items-center p-4 bg-gray-50 rounded-2xl hover:bg-green-50 group transition duration-300">
                                <div class="w-10 h-10 rounded-full bg-green-100 text-green-600 flex items-center justify-center mr-4 group-hover:bg-green-500 group-hover:text-white transition flex-shrink-0">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                                </div>
                                <div class="min-w-0">
                                    <p class="text-sm text-gray-500 font-medium">Pak Akbar</p>
                                    <p class="font-bold text-gray-900">0896-5162-6030</p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
