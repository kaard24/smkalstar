@extends('layouts.app')

@section('title', 'Beranda - SMK Al-Hidayah Lestari')

@section('content')
    <!-- Hero Section -->
    <section class="relative bg-white overflow-hidden min-h-[90vh] flex items-center">
        <div class="absolute inset-0 z-0">
            <div class="absolute inset-0 bg-gradient-to-r from-gray-900/90 via-gray-900/70 to-transparent z-10"></div>
            <img src="{{ asset('images/b1.jpg') }}" alt="School Building" class="w-full h-full object-cover">
        </div>
        
        <div class="container relative z-20 mx-auto px-4 sm:px-6 lg:px-8 py-20">
            <div class="max-w-3xl text-white">
                <div class="inline-flex items-center gap-2 bg-white/10 backdrop-blur-md border border-white/20 px-4 py-2 rounded-full text-sm font-medium text-accent mb-8">
                    <span class="w-2 h-2 rounded-full bg-accent animate-pulse"></span>
                    Penerimaan Siswa Baru 2026/2027 Telah Dibuka
                </div>
                <h1 class="text-4xl md:text-6xl lg:text-7xl font-bold leading-tight mb-6 font-heading">
                    Mewujudkan Generasi <br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-green-400 to-green-200">Unggul & Berakhlak</span>
                </h1>
                <p class="text-lg md:text-xl text-gray-200 mb-10 leading-relaxed max-w-2xl font-light">
                    SMK Al-Hidayah Lestari berkomitmen mencetak lulusan yang kompeten, berkarakter Islami, dan siap bersaing di era digital.
                </p>
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="{{ url('/ppdb/register') }}" class="bg-primary hover:bg-primary-dark text-white font-semibold px-8 py-4 rounded-xl shadow-lg hover:shadow-green-500/30 transition-all transform hover:-translate-y-1 text-center flex items-center justify-center gap-2 group">
                        Daftar Sekarang
                        <svg class="w-5 h-5 group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
                    </a>
                    <a href="#jurusan" class="bg-white/10 hover:bg-white/20 text-white font-medium px-8 py-4 rounded-xl backdrop-blur-md border border-white/20 transition text-center hover:border-white/40">
                        Jelajahi Kompetensi
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats / Quick Info -->
    <div class="bg-primary relative z-30 -mt-8 mx-4 md:mx-auto max-w-6xl rounded-2xl shadow-xl grid grid-cols-2 md:grid-cols-4 gap-8 p-8 text-white text-center">
        <div>
            <div class="text-3xl font-bold font-heading mb-1">1500+</div>
            <div class="text-sm text-green-100">Siswa Aktif</div>
        </div>
        <div>
            <div class="text-3xl font-bold font-heading mb-1">50+</div>
            <div class="text-sm text-green-100">Guru Berkompeten</div>
        </div>
        <div>
            <div class="text-3xl font-bold font-heading mb-1">4</div>
            <div class="text-sm text-green-100">Kompetensi Keahlian</div>
        </div>
        <div>
            <div class="text-3xl font-bold font-heading mb-1">A</div>
            <div class="text-sm text-green-100">Akreditasi Sekolah</div>
        </div>
    </div>

    <!-- Vision Summary -->
    <section class="py-20 md:py-32 bg-gray-50">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-20">
                <span class="text-primary font-bold tracking-wider uppercase text-sm mb-3 block">Kenapa Memilih Kami?</span>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6 font-heading">Pendidikan Berkualitas untuk Masa Depan</h2>
                <p class="text-gray-600 text-lg leading-relaxed">
                    Kami menggabungkan kurikulum nasional dengan nilai-nilai keislaman untuk membentuk karakter siswa yang kuat dan skill yang relevan dengan industri global.
                </p>
            </div>
            
            <div class="grid md:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="bg-white p-10 rounded-3xl shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 group">
                    <div class="w-16 h-16 bg-green-50 rounded-2xl flex items-center justify-center text-primary mb-8 group-hover:scale-110 transition duration-300">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                    </div>
                    <h4 class="text-xl font-bold text-gray-900 mb-4 font-heading">Kurikulum Terintegrasi</h4>
                    <p class="text-gray-600 leading-relaxed">Paduan kurikulum merdeka dan pendidikan karakter berbasis pesantren untuk mencetak lulusan yang seimbang dunia akhirat.</p>
                </div>

                <!-- Feature 2 -->
                <div class="bg-white p-10 rounded-3xl shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 group">
                    <div class="w-16 h-16 bg-green-50 rounded-2xl flex items-center justify-center text-primary mb-8 group-hover:scale-110 transition duration-300">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    </div>
                    <h4 class="text-xl font-bold text-gray-900 mb-4 font-heading">Siap Kerja & Kuliah</h4>
                    <p class="text-gray-600 leading-relaxed">Kerjasama luas dengan Dunia Usaha & Industri serta pembekalan intensif untuk yang ingin melanjutkan studi.</p>
                </div>

                <!-- Feature 3 -->
                <div class="bg-white p-10 rounded-3xl shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 group">
                    <div class="w-16 h-16 bg-green-50 rounded-2xl flex items-center justify-center text-primary mb-8 group-hover:scale-110 transition duration-300">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                    </div>
                    <h4 class="text-xl font-bold text-gray-900 mb-4 font-heading">Fasilitas Modern</h4>
                    <p class="text-gray-600 leading-relaxed">Laboratorium standar industri, smart classroom, dan lingkungan belajar yang asri dan nyaman.</p>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Majors Section -->
    <section id="jurusan" class="py-20 md:py-32 bg-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-end mb-16 gap-6">
                <div>
                     <span class="text-primary font-bold tracking-wider uppercase text-sm mb-3 block">Program Keahlian</span>
                     <h2 class="text-3xl md:text-4xl font-bold text-gray-900 font-heading">Pilihan Masa Depanmu</h2>
                </div>
                <a href="{{ url('/jurusan') }}" class="group inline-flex items-center text-primary font-semibold hover:text-secondary transition">
                    Lihat Semua Jurusan 
                    <svg class="w-5 h-5 ml-2 transform group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                </a>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Helper for cards -->
                @php
                    $jurusan = [
                        [
                            'code' => 'TKJ',
                            'name' => 'Teknik Komputer & Jaringan',
                            'img' => 'https://images.unsplash.com/photo-1550751827-4bd374c3f58b?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60'
                        ],
                        [
                            'code' => 'MPLB',
                            'name' => 'Manajemen Perkantoran',
                            'img' => 'https://images.unsplash.com/photo-1450101499163-c8848c66ca85?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60'
                        ],
                        [
                            'code' => 'AKL',
                            'name' => 'Akuntansi & Keuangan',
                            'img' => 'https://images.unsplash.com/photo-1554224155-6726b3ff858f?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60'
                        ],
                        [
                            'code' => 'BDP',
                            'name' => 'Bisnis Daring & Pemasaran',
                            'img' => 'https://images.unsplash.com/photo-1472851294608-062f824d29cc?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60'
                        ]
                    ];
                @endphp

                @foreach($jurusan as $j)
                <div class="group relative bg-white rounded-2xl shadow-sm hover:shadow-2xl transition-all duration-500 overflow-hidden border border-gray-100 flex flex-col h-full">
                    <div class="h-56 bg-gray-200 relative overflow-hidden">
                        <img src="{{ $j['img'] }}" alt="{{ $j['code'] }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
                         <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-80 group-hover:opacity-60 transition duration-500"></div>
                         <h4 class="absolute bottom-4 left-6 text-white text-2xl font-bold font-heading">{{ $j['code'] }}</h4>
                    </div>
                    <div class="p-6 flex-grow flex flex-col justify-between">
                        <p class="text-gray-600 font-medium mb-4">{{ $j['name'] }}</p>
                        <a href="{{ url('/jurusan') }}" class="inline-flex items-center text-primary font-semibold hover:text-secondary group-hover:translate-x-1 transition text-sm">
                            Pelajari Lebih Lanjut
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Call to Action PPDB -->
    <section class="py-20 md:py-32 bg-gray-900 relative overflow-hidden">
        <div class="absolute inset-0 z-0 opacity-20">
             <img src="{{ asset('images/b1.jpg') }}" alt="Background" class="w-full h-full object-cover grayscale">
             <div class="absolute inset-0 bg-gray-900/50"></div>
        </div>
        
        <div class="container relative z-10 mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl md:text-5xl font-bold mb-6 text-white font-heading">Siap Menggapai Masa Depan?</h2>
            <p class="text-lg md:text-xl text-gray-300 mb-10 max-w-2xl mx-auto font-light">
                Jangan lewatkan kesempatan untuk bergabung dengan SMK terbaik. Kuota terbatas!
            </p>
            <div class="flex flex-col sm:flex-row gap-5 justify-center">
                <a href="{{ url('/ppdb/register') }}" class="bg-primary hover:bg-primary-dark text-white font-bold px-10 py-5 rounded-xl shadow-lg shadow-green-900/20 transition transform hover:-translate-y-1">
                    Daftar Sekarang
                </a>
                <a href="{{ url('/ppdb/info') }}" class="bg-transparent border border-gray-600 hover:border-gray-400 text-white font-semibold px-10 py-5 rounded-xl transition hover:bg-white/5">
                    Informasi & Jadwal
                </a>
            </div>
        </div>
    </section>
@endsection
