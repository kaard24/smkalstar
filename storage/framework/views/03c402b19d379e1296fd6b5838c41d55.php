

<?php $__env->startSection('title', 'Beranda - SMK Al-Hidayah Lestari'); ?>

<?php $__env->startSection('content'); ?>
    <!-- Hero Section - Premium Redesign -->
    <section class="relative bg-white overflow-hidden min-h-[80vh] md:min-h-screen flex items-center">
        <!-- Animated Background Elements -->
        <div class="absolute inset-0 z-0">
            <div class="absolute inset-0 bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 z-10"></div>
            <!-- Animated Blobs -->
            <div class="absolute top-20 left-10 w-72 h-72 bg-primary/30 rounded-full blur-3xl animate-pulse"></div>
            <div class="absolute bottom-20 right-10 w-96 h-96 bg-cyan-500/20 rounded-full blur-3xl animate-pulse" style="animation-delay: 1s;"></div>
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[800px] h-[800px] bg-gradient-radial from-primary/10 to-transparent rounded-full"></div>
            <!-- Pattern Overlay -->
            <div class="absolute inset-0 opacity-20" style="background-image: url('data:image/svg+xml,%3Csvg width=&quot;60&quot; height=&quot;60&quot; viewBox=&quot;0 0 60 60&quot; xmlns=&quot;http://www.w3.org/2000/svg&quot;%3E%3Cg fill=&quot;none&quot; fill-rule=&quot;evenodd&quot;%3E%3Cg fill=&quot;%23ffffff&quot; fill-opacity=&quot;0.05&quot;%3E%3Cpath d=&quot;M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z&quot;/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
            <img src="<?php echo e(asset('images/b1.webp')); ?>" 
                     alt="Gedung SMK Al-Hidayah Lestari" 
                     class="w-full h-full object-cover opacity-40 mix-blend-overlay" 
                     fetchpriority="high" 
                     decoding="async"
                     width="1920"
                     height="1080">
        </div>
        
        <div class="container relative z-20 mx-auto px-4 sm:px-6 lg:px-8 py-12 md:py-20">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="max-w-3xl text-white">
                    <div class="inline-flex items-center gap-2 bg-gradient-to-r from-primary/20 to-cyan-500/20 backdrop-blur-md border border-primary/30 px-4 py-2 rounded-full text-sm font-medium text-cyan-300 mb-6 animate-fade-in-up">
                        <span class="w-2 h-2 rounded-full bg-cyan-400 animate-pulse"></span>
                        SPMB 2026/2027 Telah Dibuka
                    </div>
                    <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl xl:text-7xl font-bold leading-tight mb-6 font-heading animate-fade-in-up" style="animation-delay: 0.1s;">
                        Mewujudkan Generasi <br>
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 via-primary to-cyan-300">Unggul & Berakhlak</span>
                    </h1>
                    <p class="text-base md:text-lg text-gray-300 mb-8 leading-relaxed max-w-xl font-light animate-fade-in-up" style="animation-delay: 0.2s;">
                        SMK Al-Hidayah Lestari berkomitmen mencetak lulusan yang kompeten, berkarakter Islami, dan siap bersaing di era digital.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 animate-fade-in-up" style="animation-delay: 0.3s;">
                        <a href="<?php echo e(url('/ppdb/register')); ?>" class="group relative bg-gradient-to-r from-primary to-cyan-500 text-white font-bold px-8 py-4 rounded-2xl shadow-2xl shadow-primary/30 transition-all transform hover:-translate-y-1 hover:shadow-cyan-500/40 text-center flex items-center justify-center gap-3 text-base md:text-lg overflow-hidden">
                            <span class="absolute inset-0 bg-gradient-to-r from-cyan-400 to-primary opacity-0 group-hover:opacity-100 transition-opacity"></span>
                            <span class="relative">Daftar Sekarang</span>
                            <svg class="w-5 h-5 relative group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                        </a>
                        <a href="#jurusan" class="group relative bg-white/5 hover:bg-white/10 text-white font-semibold px-8 py-4 rounded-2xl backdrop-blur-md border border-white/20 hover:border-cyan-400/50 transition-all text-center flex items-center justify-center gap-2 text-base">
                            <span>Lihat Jurusan</span>
                            <svg class="w-5 h-5 group-hover:translate-y-0.5 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </a>
                    </div>
                    
                    <!-- Trust Indicators -->
                    <div class="mt-10 flex items-center gap-6 text-sm text-gray-400 animate-fade-in-up" style="animation-delay: 0.4s;">
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            <span>Akreditasi A</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            <span>Free Registration</span>
                        </div>
                    </div>
                </div>
                
                <!-- Hero Visual/Illustration -->
                <div class="hidden lg:block relative animate-fade-in-up" style="animation-delay: 0.5s;">
                    <div class="relative">
                        <!-- Floating Cards -->
                        <div class="absolute -top-10 -left-10 bg-white rounded-2xl p-4 shadow-2xl animate-float" style="animation-delay: 0s;">
                            <div class="flex items-center gap-3">
                                <div class="w-12 h-12 bg-gradient-to-br from-primary to-cyan-400 rounded-xl flex items-center justify-center text-white">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500">Program</p>
                                    <p class="font-bold text-gray-900">4 Jurusan</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="absolute top-20 -right-5 bg-white rounded-2xl p-4 shadow-2xl animate-float" style="animation-delay: 0.5s;">
                            <div class="flex items-center gap-3">
                                <div class="w-12 h-12 bg-gradient-to-br from-orange-400 to-red-500 rounded-xl flex items-center justify-center text-white">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500">Rating</p>
                                    <p class="font-bold text-gray-900">4.9/5.0</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="absolute -bottom-5 left-10 bg-white rounded-2xl p-4 shadow-2xl animate-float" style="animation-delay: 1s;">
                            <div class="flex items-center gap-3">
                                <div class="w-12 h-12 bg-gradient-to-br from-green-400 to-emerald-500 rounded-xl flex items-center justify-center text-white">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500">Siswa</p>
                                    <p class="font-bold text-gray-900">1500+</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Main Image/Graphic Container -->
                        <div class="bg-gradient-to-br from-white/10 to-white/5 backdrop-blur-sm border border-white/20 rounded-3xl p-6 mx-8">
                            <img src="<?php echo e(asset('images/b1.webp')); ?>" alt="SMK Al-Hidayah" class="rounded-2xl shadow-2xl w-full object-cover aspect-[4/3]">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats / Quick Info -->
    <div class="bg-primary relative z-30 -mt-4 md:-mt-8 mx-2 md:mx-4 lg:mx-auto max-w-6xl rounded-xl md:rounded-2xl shadow-xl grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-8 p-4 md:p-8 text-white text-center">
        <div>
            <div class="text-xl md:text-3xl font-bold font-heading mb-0.5 md:mb-1">1500+</div>
            <div class="text-xs md:text-sm text-cyan-100">Siswa Aktif</div>
        </div>
        <div>
            <div class="text-xl md:text-3xl font-bold font-heading mb-0.5 md:mb-1">50+</div>
            <div class="text-xs md:text-sm text-cyan-100">Guru Berkompeten</div>
        </div>
        <div>
            <div class="text-xl md:text-3xl font-bold font-heading mb-0.5 md:mb-1">4</div>
            <div class="text-xs md:text-sm text-cyan-100">Kompetensi Keahlian</div>
        </div>
        <div>
            <div class="text-xl md:text-3xl font-bold font-heading mb-0.5 md:mb-1">A</div>
            <div class="text-xs md:text-sm text-cyan-100">Akreditasi Sekolah</div>
        </div>
    </div>

    <!-- Vision Summary -->
    <section class="py-12 md:py-20 lg:py-32 bg-gray-50">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-12 md:mb-16">
                <span class="text-primary font-bold tracking-wider uppercase text-xs md:text-sm mb-2 md:mb-3 block">Kenapa Memilih Kami?</span>
                <h2 class="text-xl sm:text-2xl md:text-4xl font-bold text-gray-900 mb-4 md:mb-6 font-heading">Pendidikan Berkualitas untuk Masa Depan</h2>
                <p class="text-gray-600 text-sm md:text-lg leading-relaxed">
                    Kami menggabungkan kurikulum nasional dengan nilai-nilai keislaman untuk membentuk karakter siswa yang kuat dan skill yang relevan dengan industri global.
                </p>
            </div>
            
            <div class="grid md:grid-cols-3 gap-4 md:gap-8">
                <!-- Feature 1 -->
                <div class="bg-white p-6 md:p-10 rounded-2xl md:rounded-3xl shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 group">
                    <div class="w-12 h-12 md:w-16 md:h-16 bg-[#F0F9FF] rounded-xl md:rounded-2xl flex items-center justify-center text-primary mb-4 md:mb-6 group-hover:scale-105 transition duration-300">
                        <svg class="w-6 h-6 md:w-8 md:h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                    </div>
                    <h4 class="text-base md:text-xl font-bold text-gray-900 mb-2 md:mb-4 font-heading">Kurikulum Terintegrasi</h4>
                    <p class="text-gray-600 text-sm md:text-base leading-relaxed">Paduan kurikulum merdeka dan pendidikan karakter berbasis pesantren untuk mencetak lulusan yang seimbang dunia akhirat.</p>
                </div>

                <!-- Feature 2 -->
                <div class="bg-white p-6 md:p-10 rounded-2xl md:rounded-3xl shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 group">
                    <div class="w-12 h-12 md:w-16 md:h-16 bg-[#F0F9FF] rounded-xl md:rounded-2xl flex items-center justify-center text-primary mb-4 md:mb-6 group-hover:scale-105 transition duration-300">
                        <svg class="w-6 h-6 md:w-8 md:h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    </div>
                    <h4 class="text-base md:text-xl font-bold text-gray-900 mb-2 md:mb-4 font-heading">Siap Kerja & Kuliah</h4>
                    <p class="text-gray-600 text-sm md:text-base leading-relaxed">Kerjasama luas dengan Dunia Usaha & Industri serta pembekalan intensif untuk yang ingin melanjutkan studi.</p>
                </div>

                <!-- Feature 3 -->
                <div class="bg-white p-6 md:p-10 rounded-2xl md:rounded-3xl shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 group">
                    <div class="w-12 h-12 md:w-16 md:h-16 bg-[#F0F9FF] rounded-xl md:rounded-2xl flex items-center justify-center text-primary mb-4 md:mb-6 group-hover:scale-105 transition duration-300">
                        <svg class="w-6 h-6 md:w-8 md:h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/></svg>
                    </div>
                    <h4 class="text-base md:text-xl font-bold text-gray-900 mb-2 md:mb-4 font-heading">Fasilitas Modern</h4>
                    <p class="text-gray-600 text-sm md:text-base leading-relaxed">Laboratorium standar industri, smart classroom, dan lingkungan belajar yang asri dan nyaman.</p>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Majors Section -->
    <section id="jurusan" class="py-12 md:py-20 lg:py-32 bg-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-8 md:mb-12 gap-4">
                <div>
                    <span class="text-primary font-bold tracking-wider uppercase text-xs md:text-sm mb-2 block">Program Keahlian</span>
                    <h2 class="text-xl sm:text-2xl md:text-4xl font-bold text-gray-900 font-heading">Pilihan Masa Depanmu</h2>
                </div>
                <a href="<?php echo e(url('/jurusan')); ?>" class="group inline-flex items-center text-primary font-semibold hover:text-secondary transition text-sm md:text-base">
                    Lihat Semua Jurusan 
                    <svg class="w-4 h-4 md:w-5 md:h-5 ml-1 transform group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-8">
                <?php
                    $jurusan = [
                        [
                            'code' => 'TKJ',
                            'name' => 'Teknik Komputer & Jaringan',
                            'bg' => 'bg-blue-500'
                        ],
                        [
                            'code' => 'MPLB',
                            'name' => 'Manajemen Perkantoran',
                            'bg' => 'bg-purple-500'
                        ],
                        [
                            'code' => 'AKL',
                            'name' => 'Akuntansi & Keuangan',
                            'bg' => 'bg-[#F97316]'
                        ],
                        [
                            'code' => 'BDP',
                            'name' => 'Bisnis Daring & Pemasaran',
                            'bg' => 'bg-gradient-to-br from-[#0EA5E9] to-[#1E3A5F]'
                        ]
                    ];
                ?>

                <?php $__currentLoopData = $jurusan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $j): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="group relative bg-white rounded-xl md:rounded-2xl shadow-sm hover:shadow-2xl transition-all duration-500 overflow-hidden border border-gray-100 flex flex-col h-full">
                    <div class="h-40 md:h-56 <?php echo e($j['bg']); ?> relative overflow-hidden flex items-center justify-center">
                        <span class="text-6xl md:text-8xl font-bold text-white/30 font-heading"><?php echo e($j['code']); ?></span>
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
                        <h4 class="absolute bottom-3 left-4 md:bottom-4 md:left-6 text-white text-xl md:text-2xl font-bold font-heading"><?php echo e($j['code']); ?></h4>
                    </div>
                    <div class="p-4 md:p-6 flex-grow flex flex-col justify-between">
                        <p class="text-gray-600 font-medium mb-3 text-sm md:text-base"><?php echo e($j['name']); ?></p>
                        <a href="<?php echo e(url('/jurusan')); ?>" class="inline-flex items-center text-primary font-semibold hover:text-secondary group-hover:translate-x-1 transition text-xs md:text-sm">
                            Pelajari Lebih Lanjut
                            <svg class="w-3 h-3 md:w-4 md:h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </a>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </section>

    <!-- Call to Action SPMB -->
    <section class="py-12 md:py-20 lg:py-32 bg-gray-900 relative overflow-hidden">
        <div class="absolute inset-0 z-0 opacity-20">
            <img src="<?php echo e(asset('images/b1.webp')); ?>" alt="" class="w-full h-full object-cover grayscale" loading="lazy" decoding="async" role="presentation">
            <div class="absolute inset-0 bg-gray-900/50"></div>
        </div>
        
        <div class="container relative z-10 mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-xl sm:text-2xl md:text-4xl lg:text-5xl font-bold mb-4 md:mb-6 text-white font-heading">Siap Menggapai Masa Depan?</h2>
            <p class="text-sm md:text-lg lg:text-xl text-gray-300 mb-6 md:mb-10 max-w-2xl mx-auto font-light">
                Jangan lewatkan kesempatan untuk bergabung dengan SMK terbaik. Kuota terbatas!
            </p>
            <div class="flex flex-col sm:flex-row gap-3 md:gap-5 justify-center">
                <a href="<?php echo e(url('/ppdb/register')); ?>" class="bg-primary hover:bg-primary-dark text-white font-bold px-8 py-3 md:px-10 md:py-5 rounded-xl shadow-lg shadow-cyan-900/20 transition transform hover:-translate-y-1 text-sm md:text-base">
                    Daftar Sekarang
                </a>
                <a href="<?php echo e(url('/ppdb/info')); ?>" class="bg-transparent border border-gray-600 hover:border-gray-400 text-white font-semibold px-8 py-3 md:px-10 md:py-5 rounded-xl transition hover:bg-white/5 text-sm md:text-base">
                    Informasi & Jadwal
                </a>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\eka\.gemini\antigravity\scratch\smk-alstar\resources\views/home.blade.php ENDPATH**/ ?>