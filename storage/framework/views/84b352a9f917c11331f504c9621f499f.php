<?php
    // Definisikan warna tema berdasarkan kode jurusan
    $themes = [
        'TKJ' => [
            'primary' => 'blue-900',
            'primary_light' => 'blue-800',
            'bg' => 'bg-blue-900',
            'bg_light' => 'bg-blue-50',
            'text' => 'text-blue-900',
            'text_light' => 'text-blue-600',
            'border' => 'border-blue-200',
            'gradient' => 'from-blue-900 via-blue-800 to-blue-700',
            'accent' => 'blue-500',
        ],
        'MPLB' => [
            'primary' => 'green-600',
            'primary_light' => 'green-500',
            'bg' => 'bg-green-600',
            'bg_light' => 'bg-green-50',
            'text' => 'text-green-700',
            'text_light' => 'text-green-600',
            'border' => 'border-green-200',
            'gradient' => 'from-green-600 via-green-500 to-emerald-500',
            'accent' => 'green-400',
        ],
        'AKL' => [
            'primary' => 'purple-600',
            'primary_light' => 'purple-500',
            'bg' => 'bg-purple-600',
            'bg_light' => 'bg-purple-50',
            'text' => 'text-purple-700',
            'text_light' => 'text-purple-600',
            'border' => 'border-purple-200',
            'gradient' => 'from-purple-600 via-purple-500 to-pink-500',
            'accent' => 'purple-400',
        ],
        'BR' => [
            'primary' => 'cyan-600',
            'primary_light' => 'cyan-500',
            'bg' => 'bg-cyan-600',
            'bg_light' => 'bg-cyan-50',
            'text' => 'text-cyan-700',
            'text_light' => 'text-cyan-600',
            'border' => 'border-cyan-200',
            'gradient' => 'from-cyan-600 via-cyan-500 to-teal-500',
            'accent' => 'teal-400',
        ],
    ];
    
    $theme = $themes[$jurusanDetail->kode] ?? $themes['TKJ'];
    $logoFile = $jurusanDetail->kode === 'MPLB' ? 'mplb1.jpeg' : strtolower($jurusanDetail->kode) . '.jpeg';
    $logoPath = 'images/logo/' . $logoFile;
?>



<?php $__env->startSection('title', $jurusanDetail->nama . ' - SMK Al-Hidayah Lestari'); ?>

<?php $__env->startSection('content'); ?>
    <!-- Hero Section -->
    <div class="relative <?php echo e($theme['bg']); ?> py-10 sm:py-16 md:py-24 overflow-hidden">
        <!-- Decorative Elements -->
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute top-0 right-0 w-64 h-64 sm:w-96 sm:h-96 bg-white/10 rounded-full blur-3xl transform translate-x-1/3 -translate-y-1/3"></div>
            <div class="absolute bottom-0 left-0 w-48 h-48 sm:w-72 sm:h-72 bg-white/5 rounded-full blur-3xl transform -translate-x-1/3 translate-y-1/3"></div>
            
            <!-- Pattern Berdasarkan Jurusan -->
            <?php if($jurusanDetail->kode === 'TKJ'): ?>
            <!-- Circuit/Network Pattern untuk TKJ -->
            <div class="absolute inset-0 opacity-10">
                <svg class="w-full h-full" xmlns="http://www.w3.org/2000/svg">
                    <defs>
                        <pattern id="circuit" x="0" y="0" width="60" height="60" patternUnits="userSpaceOnUse">
                            <circle cx="10" cy="10" r="2" fill="white"/>
                            <circle cx="30" cy="30" r="2" fill="white"/>
                            <circle cx="50" cy="10" r="2" fill="white"/>
                            <circle cx="50" cy="50" r="2" fill="white"/>
                            <circle cx="10" cy="50" r="2" fill="white"/>
                            <path d="M10 10 L30 30 L50 10" stroke="white" stroke-width="0.5" fill="none"/>
                            <path d="M30 30 L50 50" stroke="white" stroke-width="0.5" fill="none"/>
                            <path d="M10 50 L30 30" stroke="white" stroke-width="0.5" fill="none"/>
                            <path d="M50 50 L30 50" stroke="white" stroke-width="0.5" fill="none"/>
                        </pattern>
                    </defs>
                    <rect width="100%" height="100%" fill="url(#circuit)"/>
                </svg>
            </div>
            <?php elseif($jurusanDetail->kode === 'MPLB'): ?>
            <!-- Geometric/Office Pattern untuk MPLB -->
            <div class="absolute inset-0 opacity-10">
                <svg class="w-full h-full" xmlns="http://www.w3.org/2000/svg">
                    <defs>
                        <pattern id="office" x="0" y="0" width="40" height="40" patternUnits="userSpaceOnUse">
                            <rect x="5" y="5" width="12" height="12" stroke="white" stroke-width="0.5" fill="none" rx="1"/>
                            <rect x="23" y="5" width="12" height="12" stroke="white" stroke-width="0.5" fill="none" rx="1"/>
                            <rect x="5" y="23" width="12" height="12" stroke="white" stroke-width="0.5" fill="none" rx="1"/>
                            <rect x="23" y="23" width="12" height="12" stroke="white" stroke-width="0.5" fill="none" rx="1"/>
                        </pattern>
                    </defs>
                    <rect width="100%" height="100%" fill="url(#office)"/>
                </svg>
            </div>
            <?php elseif($jurusanDetail->kode === 'AKL'): ?>
            <!-- Grid/Accounting Pattern untuk AKL -->
            <div class="absolute inset-0 opacity-10">
                <svg class="w-full h-full" xmlns="http://www.w3.org/2000/svg">
                    <defs>
                        <pattern id="accounting" x="0" y="0" width="50" height="30" patternUnits="userSpaceOnUse">
                            <line x1="0" y1="0" x2="50" y2="0" stroke="white" stroke-width="0.5"/>
                            <line x1="0" y1="10" x2="50" y2="10" stroke="white" stroke-width="0.5"/>
                            <line x1="0" y1="20" x2="50" y2="20" stroke="white" stroke-width="0.5"/>
                            <line x1="0" y1="30" x2="50" y2="30" stroke="white" stroke-width="0.5"/>
                            <line x1="10" y1="0" x2="10" y2="30" stroke="white" stroke-width="0.5"/>
                            <line x1="25" y1="0" x2="25" y2="30" stroke="white" stroke-width="0.5"/>
                            <line x1="40" y1="0" x2="40" y2="30" stroke="white" stroke-width="0.5"/>
                            <text x="15" y="8" fill="white" font-size="4" font-family="monospace">+</text>
                            <text x="30" y="18" fill="white" font-size="4" font-family="monospace">-</text>
                            <text x="15" y="28" fill="white" font-size="4" font-family="monospace">=</text>
                        </pattern>
                    </defs>
                    <rect width="100%" height="100%" fill="url(#accounting)"/>
                </svg>
            </div>
            <?php elseif($jurusanDetail->kode === 'BR'): ?>
            <!-- Dynamic/Retail Pattern untuk Bisnis Ritel -->
            <div class="absolute inset-0 opacity-10">
                <svg class="w-full h-full" xmlns="http://www.w3.org/2000/svg">
                    <defs>
                        <pattern id="retail" x="0" y="0" width="40" height="40" patternUnits="userSpaceOnUse">
                            <polygon points="20,5 35,20 20,35 5,20" stroke="white" stroke-width="0.5" fill="none"/>
                            <circle cx="20" cy="20" r="3" fill="white"/>
                            <path d="M5 5 L15 15 M35 5 L25 15 M5 35 L15 25 M35 35 L25 25" stroke="white" stroke-width="0.5"/>
                        </pattern>
                    </defs>
                    <rect width="100%" height="100%" fill="url(#retail)"/>
                </svg>
            </div>
            <?php endif; ?>
        </div>
        
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="flex flex-col lg:flex-row items-center gap-5 sm:gap-8 lg:gap-12">
                <!-- Logo Jurusan -->
                <div class="w-24 h-24 sm:w-32 sm:h-32 md:w-40 md:h-40 rounded-2xl sm:rounded-3xl bg-white shadow-2xl overflow-hidden flex-shrink-0 ring-4 ring-white/20">
                    <img src="<?php echo e(asset($logoPath)); ?>" alt="Logo <?php echo e($jurusanDetail->nama); ?>" class="w-full h-full object-cover">
                </div>
                
                <!-- Content -->
                <div class="text-center lg:text-left flex-1">
                    <div class="inline-flex items-center gap-2 bg-white/10 backdrop-blur-sm text-white px-3 sm:px-4 py-1 sm:py-1.5 rounded-full text-xs sm:text-sm font-medium mb-3 sm:mb-4">
                        <svg class="w-3 h-3 sm:w-4 sm:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>
                        </svg>
                        <span class="whitespace-nowrap">Program Keahlian</span>
                    </div>
                    <h1 class="text-xl sm:text-2xl md:text-4xl lg:text-5xl font-bold text-white mb-2 sm:mb-4 font-heading">
                        <?php echo e($jurusanDetail->nama); ?>

                    </h1>
                    <p class="text-white/80 text-sm sm:text-base md:text-lg max-w-2xl leading-relaxed">
                        <?php echo e($jurusanDetail->deskripsi ?? 'Pelajari selengkapnya tentang program keahlian ' . $jurusanDetail->nama . ' dan persiapkan masa depan gemilang bersama SMK Al-Hidayah Lestari.'); ?>

                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Navigation Jurusan -->
    <div class="bg-white border-b border-gray-200 sticky top-14 md:top-16 z-40">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center gap-2 overflow-x-auto py-2 sm:py-3 no-scrollbar scroll-smooth">
                <span class="text-gray-500 text-xs sm:text-sm font-medium whitespace-nowrap mr-1 sm:mr-2 flex-shrink-0">Jurusan:</span>
                <?php $__currentLoopData = $jurusanList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $j): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $jLogoFile = $j->kode === 'MPLB' ? 'mplb1.jpeg' : strtolower($j->kode) . '.jpeg';
                        $jLogoPath = 'images/logo/' . $jLogoFile;
                        $isActive = $j->id === $jurusanDetail->id;
                    ?>
                    <a href="<?php echo e(url('/jurusan/' . strtolower($j->kode))); ?>" 
                       class="flex items-center gap-1.5 sm:gap-2 px-2.5 sm:px-3 py-1.5 sm:py-2 rounded-lg sm:rounded-xl text-xs sm:text-sm font-medium whitespace-nowrap transition flex-shrink-0 <?php echo e($isActive ? $theme['bg'] . ' text-white' : 'text-gray-600 hover:bg-gray-100'); ?>">
                        <img src="<?php echo e(asset($jLogoPath)); ?>" alt="<?php echo e($j->nama); ?>" class="w-4 h-4 sm:w-5 sm:h-5 rounded-full object-cover flex-shrink-0">
                        <span><?php echo e($j->kode); ?></span>
                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <section class="py-8 sm:py-12 md:py-16 bg-gray-50">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-3 gap-4 sm:gap-6 lg:gap-8">
                <!-- Main Content -->
                <div class="lg:col-span-2 space-y-4 sm:space-y-6 lg:space-y-8">
                    <!-- Gambar Jurusan -->
                    <?php if($jurusanDetail->gambar_url): ?>
                    <div class="bg-white rounded-2xl sm:rounded-3xl overflow-hidden shadow-sm">
                        <div class="h-48 sm:h-56 md:h-64 lg:h-80 relative">
                            <img src="<?php echo e($jurusanDetail->gambar_url); ?>" alt="<?php echo e($jurusanDetail->nama); ?>" class="absolute inset-0 w-full h-full object-cover">
                        </div>
                    </div>
                    <?php endif; ?>

                    <!-- Tentang Jurusan -->
                    <div class="bg-white rounded-2xl sm:rounded-3xl p-5 sm:p-6 md:p-8 shadow-sm">
                        <h2 class="text-lg sm:text-xl md:text-2xl font-bold text-gray-900 mb-4 sm:mb-6 flex items-center gap-2 sm:gap-3">
                            <span class="w-8 h-8 sm:w-10 sm:h-10 rounded-lg sm:rounded-xl <?php echo e($theme['bg_light']); ?> <?php echo e($theme['text']); ?> flex items-center justify-center flex-shrink-0">
                                <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </span>
                            <span>Tentang Jurusan</span>
                        </h2>
                        <div class="prose prose-gray max-w-none">
                            <p class="text-gray-600 leading-relaxed text-sm sm:text-base md:text-lg">
                                <?php echo e($jurusanDetail->deskripsi_lengkap ?? $jurusanDetail->deskripsi ?? 'Deskripsi lengkap tentang jurusan ' . $jurusanDetail->nama . ' akan segera ditambahkan.'); ?>

                            </p>
                        </div>
                    </div>

                    <!-- Kompetensi -->
                    <div class="bg-white rounded-2xl sm:rounded-3xl p-5 sm:p-6 md:p-8 shadow-sm">
                        <h2 class="text-lg sm:text-xl md:text-2xl font-bold text-gray-900 mb-4 sm:mb-6 flex items-center gap-2 sm:gap-3">
                            <span class="w-8 h-8 sm:w-10 sm:h-10 rounded-lg sm:rounded-xl <?php echo e($theme['bg_light']); ?> <?php echo e($theme['text']); ?> flex items-center justify-center flex-shrink-0">
                                <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                                </svg>
                            </span>
                            <span>Kompetensi Utama</span>
                        </h2>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-4">
                            <?php
                                $kompetensi = $jurusanDetail->kompetensi ?? [
                                    'Menguasai teori dan praktik sesuai bidang keahlian',
                                    'Mampu mengoperasikan peralatan dan software terkini',
                                    'Mempunyai sertifikasi kompetensi yang diakui',
                                    'Siap bersaing di dunia kerja dan wirausaha',
                                ];
                            ?>
                            <?php $__currentLoopData = $kompetensi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="flex items-start gap-2 sm:gap-3 p-3 sm:p-4 <?php echo e($theme['bg_light']); ?> rounded-xl sm:rounded-2xl">
                                <svg class="w-4 h-4 sm:w-5 sm:h-5 <?php echo e($theme['text']); ?> flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                <span class="text-gray-700 text-sm sm:text-base"><?php echo e($item); ?></span>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>

                    <!-- Peluang Karir -->
                    <?php if($jurusanDetail->peluang_karir && count($jurusanDetail->peluang_karir) > 0): ?>
                    <div class="bg-white rounded-2xl sm:rounded-3xl p-5 sm:p-6 md:p-8 shadow-sm">
                        <h2 class="text-lg sm:text-xl md:text-2xl font-bold text-gray-900 mb-4 sm:mb-6 flex items-center gap-2 sm:gap-3">
                            <span class="w-8 h-8 sm:w-10 sm:h-10 rounded-lg sm:rounded-xl <?php echo e($theme['bg_light']); ?> <?php echo e($theme['text']); ?> flex items-center justify-center flex-shrink-0">
                                <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </span>
                            <span>Peluang Karir</span>
                        </h2>
                        <div class="flex flex-wrap gap-2 sm:gap-3">
                            <?php $__currentLoopData = $jurusanDetail->peluang_karir; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $karir): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <span class="px-3 sm:px-4 py-1.5 sm:py-2 <?php echo e($theme['bg_light']); ?> <?php echo e($theme['text']); ?> rounded-lg sm:rounded-xl font-medium text-xs sm:text-sm border <?php echo e($theme['border']); ?>">
                                <?php echo e($karir); ?>

                            </span>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                    <?php endif; ?>

                    <!-- Mata Pelajaran -->
                    <div class="bg-white rounded-2xl sm:rounded-3xl p-5 sm:p-6 md:p-8 shadow-sm">
                        <h2 class="text-lg sm:text-xl md:text-2xl font-bold text-gray-900 mb-4 sm:mb-6 flex items-center gap-2 sm:gap-3">
                            <span class="w-8 h-8 sm:w-10 sm:h-10 rounded-lg sm:rounded-xl <?php echo e($theme['bg_light']); ?> <?php echo e($theme['text']); ?> flex items-center justify-center flex-shrink-0">
                                <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                </svg>
                            </span>
                            <span>Mata Pelajaran Produk</span>
                        </h2>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 sm:gap-3">
                            <?php
                                $mapel = $jurusanDetail->mata_pelajaran ?? [
                                    'Dasar-dasar Kejuruan',
                                    'Kompetensi Keahlian',
                                    'Produk Kreatif dan Kewirausahaan',
                                    'Praktik Kerja Lapangan',
                                ];
                            ?>
                            <?php $__currentLoopData = $mapel; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="flex items-center gap-2 sm:gap-3 p-2.5 sm:p-3 border border-gray-100 rounded-lg sm:rounded-xl hover:bg-gray-50 transition">
                                <span class="w-7 h-7 sm:w-8 sm:h-8 rounded-md sm:rounded-lg <?php echo e($theme['bg']); ?> text-white flex items-center justify-center text-xs sm:text-sm font-bold flex-shrink-0">
                                    <?php echo e(substr($loop->iteration, 0, 1)); ?>

                                </span>
                                <span class="text-gray-700 font-medium text-xs sm:text-sm truncate"><?php echo e($item); ?></span>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="lg:col-span-1 space-y-4 sm:space-y-6">
                    <!-- Info Cepat -->
                    <div class="bg-gradient-to-br <?php echo e($theme['gradient']); ?> rounded-2xl sm:rounded-3xl p-5 sm:p-6 text-white shadow-xl">
                        <h3 class="text-lg sm:text-xl font-bold mb-4 sm:mb-6">Info Program</h3>
                        <div class="space-y-3 sm:space-y-4">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 sm:w-10 sm:h-10 rounded-lg sm:rounded-xl bg-white/20 flex items-center justify-center flex-shrink-0">
                                    <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <div class="min-w-0">
                                    <p class="text-white/70 text-xs sm:text-sm">Durasi</p>
                                    <p class="font-semibold text-sm sm:text-base">3 Tahun</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 sm:w-10 sm:h-10 rounded-lg sm:rounded-xl bg-white/20 flex items-center justify-center flex-shrink-0">
                                    <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <div class="min-w-0">
                                    <p class="text-white/70 text-xs sm:text-sm">Sertifikasi</p>
                                    <p class="font-semibold text-sm sm:text-base">BNSP / LSP</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 sm:w-10 sm:h-10 rounded-lg sm:rounded-xl bg-white/20 flex items-center justify-center flex-shrink-0">
                                    <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                <div class="min-w-0">
                                    <p class="text-white/70 text-xs sm:text-sm">Prakerin</p>
                                    <p class="font-semibold text-sm sm:text-base">Di Industri</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- CTA Daftar -->
                    <div class="bg-white rounded-2xl sm:rounded-3xl p-5 sm:p-6 shadow-sm border border-gray-100">
                        <h3 class="text-base sm:text-lg font-bold text-gray-900 mb-2 sm:mb-3">Tertarik?</h3>
                        <p class="text-gray-600 text-xs sm:text-sm mb-3 sm:mb-4">Daftar sekarang dan jadilah bagian dari <?php echo e($jurusanDetail->nama); ?>.</p>
                        <a href="<?php echo e(url('/spmb/register')); ?>" class="block w-full <?php echo e($theme['bg']); ?> hover:<?php echo e($theme['primary_light']); ?> text-white text-center font-bold py-2.5 sm:py-3 rounded-lg sm:rounded-xl transition text-sm sm:text-base">
                            Daftar Sekarang
                        </a>
                    </div>

                    <!-- Jurusan Lainnya -->
                    <div class="bg-white rounded-2xl sm:rounded-3xl p-5 sm:p-6 shadow-sm border border-gray-100">
                        <h3 class="text-base sm:text-lg font-bold text-gray-900 mb-3 sm:mb-4">Jurusan Lainnya</h3>
                        <div class="space-y-2 sm:space-y-3">
                            <?php $__currentLoopData = $jurusanList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $j): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($j->id !== $jurusanDetail->id): ?>
                                <?php
                                    $otherLogoFile = $j->kode === 'MPLB' ? 'mplb1.jpeg' : strtolower($j->kode) . '.jpeg';
                                    $otherLogoPath = 'images/logo/' . $otherLogoFile;
                                ?>
                                <a href="<?php echo e(url('/jurusan/' . strtolower($j->kode))); ?>" class="flex items-center gap-2 sm:gap-3 p-2.5 sm:p-3 rounded-lg sm:rounded-xl hover:bg-gray-50 transition group">
                                    <img src="<?php echo e(asset($otherLogoPath)); ?>" alt="<?php echo e($j->nama); ?>" class="w-8 h-8 sm:w-10 sm:h-10 rounded-lg object-cover flex-shrink-0">
                                    <div class="flex-1 min-w-0">
                                        <p class="font-semibold text-gray-900 text-xs sm:text-sm group-hover:<?php echo e($theme['text']); ?> transition truncate"><?php echo e($j->nama); ?></p>
                                        <p class="text-gray-500 text-[10px] sm:text-xs"><?php echo e($j->kode); ?></p>
                                    </div>
                                    <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 text-gray-400 group-hover:<?php echo e($theme['text']); ?> transition flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                    </svg>
                                </a>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\eka\.gemini\antigravity\scratch\smk-alstar\resources\views/jurusan/detail.blade.php ENDPATH**/ ?>