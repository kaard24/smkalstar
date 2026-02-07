<?php $__env->startSection('title', 'Kalender Akademik SPMB - SMK Al-Hidayah Lestari'); ?>

<?php $__env->startSection('content'); ?>
    <!-- Header Page -->
    <div class="relative bg-gradient-to-br from-blue-50 via-sky-50 to-cyan-50 py-16 md:py-24 border-b border-blue-100 overflow-hidden">
        <div class="absolute inset-0">
            <div class="absolute top-0 right-1/4 w-96 h-96 bg-blue-300/20 rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 left-1/4 w-72 h-72 bg-sky-300/20 rounded-full blur-3xl"></div>
        </div>
        
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
            <div class="inline-flex items-center gap-2 bg-gradient-to-r from-blue-500 to-cyan-500 text-white px-5 py-2 rounded-full text-sm font-bold mb-6 shadow-lg shadow-blue-200">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                Tahun Ajaran 2026/2027
            </div>
            <h1 class="text-3xl md:text-4xl lg:text-5xl xl:text-6xl font-bold text-gray-900 mb-4 font-heading">
                Kalender Akademik <br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-500 via-sky-500 to-cyan-500">SPMB 2026/2027</span>
            </h1>
            <p class="text-gray-600 text-lg md:text-xl max-w-3xl mx-auto leading-relaxed">Jadwal lengkap pendaftaran, tes masuk, dan pengumuman hasil seleksi</p>
        </div>
    </div>

    <!-- Global Countdown Section -->
    <?php
        $now = now();
        $activeGelombang = null;
        $nextEvent = null;
        
        foreach ($jadwal as $g) {
            $pendaftaranStart = \Carbon\Carbon::parse($g['pendaftaran_start']);
            $pendaftaranEnd = \Carbon\Carbon::parse($g['pendaftaran_end']);
            $tesStart = \Carbon\Carbon::parse($g['tes_mulai']);
            $tesEnd = \Carbon\Carbon::parse($g['tes_selesai']);
            $pengumuman = \Carbon\Carbon::parse($g['pengumuman']);
            
            // Cek pendaftaran berlangsung
            if ($now->between($pendaftaranStart, $pendaftaranEnd)) {
                $activeGelombang = $g;
                $nextEvent = ['type' => 'pendaftaran', 'date' => $pendaftaranEnd, 'label' => 'Pendaftaran ditutup'];
                break;
            }
            // Cek tes berlangsung
            elseif ($now->between($tesStart, $tesEnd)) {
                $activeGelombang = $g;
                $nextEvent = ['type' => 'tes', 'date' => $tesEnd, 'label' => 'Tes selesai'];
                break;
            }
            // Cek sebelum pendaftaran
            elseif ($now->lt($pendaftaranStart)) {
                if (!$nextEvent || $pendaftaranStart->lt($nextEvent['date'])) {
                    $nextEvent = ['type' => 'buka', 'date' => $pendaftaranStart, 'label' => 'Pendaftaran dibuka'];
                }
            }
            // Cek sebelum tes
            elseif ($now->lt($tesStart)) {
                if (!$nextEvent || $tesStart->lt($nextEvent['date'])) {
                    $nextEvent = ['type' => 'tes', 'date' => $tesStart, 'label' => 'Tes masuk dimulai'];
                }
            }
            // Cek sebelum pengumuman
            elseif ($now->lt($pengumuman)) {
                if (!$nextEvent || $pengumuman->lt($nextEvent['date'])) {
                    $nextEvent = ['type' => 'pengumuman', 'date' => $pengumuman, 'label' => 'Pengumuman hasil'];
                }
            }
        }
    ?>

    <?php if($nextEvent): ?>
    <section class="py-12 bg-gradient-to-r from-blue-600 to-cyan-600 relative overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <svg class="w-full h-full" viewBox="0 0 100 100" preserveAspectRatio="none">
                <pattern id="grid" width="10" height="10" patternUnits="userSpaceOnUse">
                    <circle cx="5" cy="5" r="1" fill="white"/>
                </pattern>
                <rect width="100" height="100" fill="url(#grid)"/>
            </svg>
        </div>
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center mb-8">
                <p class="text-blue-100 text-lg mb-2"><?php echo e($nextEvent['label']); ?></p>
                <h2 class="text-3xl md:text-4xl font-bold text-white font-heading" id="global-countdown">
                    Memuat...
                </h2>
            </div>
            <div class="flex flex-wrap justify-center gap-4 md:gap-6" id="countdown-units">
                <div class="bg-white/10 backdrop-blur-sm rounded-2xl px-6 py-4 text-center min-w-[80px]">
                    <div class="text-3xl md:text-4xl font-bold text-white" id="cd-days">00</div>
                    <div class="text-blue-100 text-sm">Hari</div>
                </div>
                <div class="bg-white/10 backdrop-blur-sm rounded-2xl px-6 py-4 text-center min-w-[80px]">
                    <div class="text-3xl md:text-4xl font-bold text-white" id="cd-hours">00</div>
                    <div class="text-blue-100 text-sm">Jam</div>
                </div>
                <div class="bg-white/10 backdrop-blur-sm rounded-2xl px-6 py-4 text-center min-w-[80px]">
                    <div class="text-3xl md:text-4xl font-bold text-white" id="cd-minutes">00</div>
                    <div class="text-blue-100 text-sm">Menit</div>
                </div>
                <div class="bg-white/10 backdrop-blur-sm rounded-2xl px-6 py-4 text-center min-w-[80px]">
                    <div class="text-3xl md:text-4xl font-bold text-white" id="cd-seconds">00</div>
                    <div class="text-blue-100 text-sm">Detik</div>
                </div>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- Timeline Section -->
    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 font-heading mb-4">Timeline SPMB 2026</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Ikuti setiap tahapan dengan cermat. Status akan diperbarui secara otomatis berdasarkan jadwal.</p>
            </div>

            <!-- Timeline Cards -->
            <div class="space-y-8">
                <?php $__currentLoopData = $jadwal; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $g): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $pendaftaranStart = \Carbon\Carbon::parse($g['pendaftaran_start']);
                        $pendaftaranEnd = \Carbon\Carbon::parse($g['pendaftaran_end']);
                        $tesStart = \Carbon\Carbon::parse($g['tes_mulai']);
                        $tesEnd = \Carbon\Carbon::parse($g['tes_selesai']);
                        $pengumuman = \Carbon\Carbon::parse($g['pengumuman']);
                        
                        // Tentukan status setiap tahap
                        $statusPendaftaran = $now->lt($pendaftaranStart) ? 'MENDATANG' : 
                            ($now->between($pendaftaranStart, $pendaftaranEnd) ? 'BERLANGSUNG' : 
                            ($now->gt($pendaftaranEnd) ? 'SELESAI' : 'BUKA'));
                        
                        $statusTes = $now->lt($tesStart) ? 'MENDATANG' : 
                            ($now->between($tesStart, $tesEnd) ? 'BERLANGSUNG' : 
                            ($now->gt($tesEnd) ? 'SELESAI' : 'BUKA'));
                        
                        $statusPengumuman = $now->lt($pengumuman) ? 'MENDATANG' : 'SELESAI';
                        
                        $statusColors = [
                            'SELESAI' => ['bg' => 'bg-green-100', 'text' => 'text-green-700', 'border' => 'border-green-200', 'icon' => 'text-green-500'],
                            'BERLANGSUNG' => ['bg' => 'bg-blue-100', 'text' => 'text-blue-700', 'border' => 'border-blue-200', 'icon' => 'text-blue-500'],
                            'MENDATANG' => ['bg' => 'bg-gray-100', 'text' => 'text-gray-600', 'border' => 'border-gray-200', 'icon' => 'text-gray-400'],
                            'BUKA' => ['bg' => 'bg-emerald-100', 'text' => 'text-emerald-700', 'border' => 'border-emerald-200', 'icon' => 'text-emerald-500']
                        ];
                        
                        $gelombangAktif = $now->between($pendaftaranStart, $pengumuman);
                    ?>

                    <div class="bg-white rounded-3xl shadow-lg border <?php echo e($gelombangAktif ? 'border-blue-200 ring-2 ring-blue-100' : 'border-gray-100'); ?> overflow-hidden hover:shadow-xl transition duration-300" id="gelombang-<?php echo e($g['gelombang']); ?>">
                        <!-- Header Gelombang -->
                        <div class="p-6 md:p-8 border-b <?php echo e($gelombangAktif ? 'bg-gradient-to-r from-blue-50 to-cyan-50 border-blue-100' : 'border-gray-100'); ?>">
                            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                                <div class="flex items-center gap-4">
                                    <div class="w-16 h-16 rounded-2xl <?php echo e($gelombangAktif ? 'bg-gradient-to-br from-blue-500 to-cyan-500 text-white' : 'bg-gray-100 text-gray-500'); ?> flex items-center justify-center text-2xl font-bold font-heading">
                                        <?php echo e($g['gelombang']); ?>

                                    </div>
                                    <div>
                                        <h3 class="text-2xl font-bold text-gray-900 font-heading"><?php echo e($g['nama']); ?></h3>
                                        <p class="text-gray-500 text-sm mt-1">Tahun Ajaran 2026/2027</p>
                                    </div>
                                </div>
                                <?php if($gelombangAktif): ?>
                                    <span class="inline-flex items-center gap-2 bg-gradient-to-r from-blue-500 to-cyan-500 text-white px-4 py-2 rounded-xl text-sm font-bold shadow-lg">
                                        <span class="w-2 h-2 bg-white rounded-full animate-pulse"></span>
                                        SEDANG BERLANGSUNG
                                    </span>
                                <?php elseif($now->gt($pengumuman)): ?>
                                    <span class="inline-flex items-center gap-2 bg-gray-100 text-gray-500 px-4 py-2 rounded-xl text-sm font-bold border border-gray-200">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        SELESAI
                                    </span>
                                <?php else: ?>
                                    <span class="inline-flex items-center gap-2 bg-gray-100 text-gray-500 px-4 py-2 rounded-xl text-sm font-bold border border-gray-200">
                                        <?php echo e($now->lt($pendaftaranStart) ? 'MENDATANG' : 'AKAN DATANG'); ?>

                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- Timeline Steps -->
                        <div class="p-6 md:p-8">
                            <div class="grid md:grid-cols-3 gap-6">
                                <!-- Pendaftaran -->
                                <div class="relative <?php echo e($statusColors[$statusPendaftaran]['bg']); ?> rounded-2xl p-6 border <?php echo e($statusColors[$statusPendaftaran]['border']); ?> <?php echo e($statusPendaftaran == 'BERLANGSUNG' ? 'ring-2 ring-blue-200' : ''); ?>">
                                    <?php if($statusPendaftaran == 'BERLANGSUNG'): ?>
                                        <div class="absolute -top-3 -right-3 w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center animate-pulse">
                                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                            </svg>
                                        </div>
                                    <?php endif; ?>
                                    <div class="flex items-center gap-3 mb-4">
                                        <div class="w-12 h-12 rounded-xl bg-white <?php echo e($statusColors[$statusPendaftaran]['icon']); ?> flex items-center justify-center">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <h4 class="font-bold text-gray-900">Pendaftaran</h4>
                                            <span class="inline-block mt-1 px-2 py-0.5 rounded text-xs font-bold <?php echo e($statusColors[$statusPendaftaran]['bg']); ?> <?php echo e($statusColors[$statusPendaftaran]['text']); ?>">
                                                <?php echo e($statusPendaftaran); ?>

                                            </span>
                                        </div>
                                    </div>
                                    <p class="text-sm text-gray-600 mb-2">
                                        <span class="font-medium"><?php echo e($pendaftaranStart->translatedFormat('d M Y')); ?></span> - 
                                        <span class="font-medium"><?php echo e($pendaftaranEnd->translatedFormat('d M Y')); ?></span>
                                    </p>
                                    <?php if($statusPendaftaran == 'BERLANGSUNG'): ?>
                                        <?php
                                            $sisaHari = $now->diffInDays($pendaftaranEnd, false);
                                        ?>
                                        <div class="mt-3 pt-3 border-t <?php echo e($statusColors[$statusPendaftaran]['border']); ?>">
                                            <p class="text-sm <?php echo e($statusColors[$statusPendaftaran]['text']); ?> font-medium">
                                                Sisa waktu: <?php echo e(ceil($sisaHari)); ?> hari
                                            </p>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <!-- Tes Masuk -->
                                <div class="relative <?php echo e($statusColors[$statusTes]['bg']); ?> rounded-2xl p-6 border <?php echo e($statusColors[$statusTes]['border']); ?> <?php echo e($statusTes == 'BERLANGSUNG' ? 'ring-2 ring-blue-200' : ''); ?>">
                                    <?php if($statusTes == 'BERLANGSUNG'): ?>
                                        <div class="absolute -top-3 -right-3 w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center animate-pulse">
                                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                            </svg>
                                        </div>
                                    <?php endif; ?>
                                    <div class="flex items-center gap-3 mb-4">
                                        <div class="w-12 h-12 rounded-xl bg-white <?php echo e($statusColors[$statusTes]['icon']); ?> flex items-center justify-center">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <h4 class="font-bold text-gray-900">Tes Masuk</h4>
                                            <span class="inline-block mt-1 px-2 py-0.5 rounded text-xs font-bold <?php echo e($statusColors[$statusTes]['bg']); ?> <?php echo e($statusColors[$statusTes]['text']); ?>">
                                                <?php echo e($statusTes); ?>

                                            </span>
                                        </div>
                                    </div>
                                    <p class="text-sm text-gray-600 mb-2">
                                        <span class="font-medium"><?php echo e($tesStart->translatedFormat('d M Y')); ?></span> - 
                                        <span class="font-medium"><?php echo e($tesEnd->translatedFormat('d M Y')); ?></span>
                                    </p>
                                    <?php if($statusTes == 'BERLANGSUNG'): ?>
                                        <?php
                                            $sisaHariTes = $now->diffInDays($tesEnd, false);
                                        ?>
                                        <div class="mt-3 pt-3 border-t <?php echo e($statusColors[$statusTes]['border']); ?>">
                                            <p class="text-sm <?php echo e($statusColors[$statusTes]['text']); ?> font-medium">
                                                Berlangsung: <?php echo e(ceil($sisaHariTes)); ?> hari lagi
                                            </p>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <!-- Pengumuman -->
                                <div class="relative <?php echo e($statusColors[$statusPengumuman]['bg']); ?> rounded-2xl p-6 border <?php echo e($statusColors[$statusPengumuman]['border']); ?>">
                                    <div class="flex items-center gap-3 mb-4">
                                        <div class="w-12 h-12 rounded-xl bg-white <?php echo e($statusColors[$statusPengumuman]['icon']); ?> flex items-center justify-center">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <h4 class="font-bold text-gray-900">Pengumuman</h4>
                                            <span class="inline-block mt-1 px-2 py-0.5 rounded text-xs font-bold <?php echo e($statusColors[$statusPengumuman]['bg']); ?> <?php echo e($statusColors[$statusPengumuman]['text']); ?>">
                                                <?php echo e($statusPengumuman); ?>

                                            </span>
                                        </div>
                                    </div>
                                    <p class="text-sm text-gray-600 mb-2">
                                        <span class="font-medium"><?php echo e($pengumuman->translatedFormat('d M Y')); ?></span>
                                    </p>
                                    <?php if($statusPengumuman == 'MENDATANG' && $now->diffInDays($pengumuman, false) <= 7 && $now->diffInDays($pengumuman, false) > 0): ?>
                                        <?php
                                            $sisaHariPengumuman = $now->diffInDays($pengumuman, false);
                                        ?>
                                        <div class="mt-3 pt-3 border-t <?php echo e($statusColors[$statusPengumuman]['border']); ?>">
                                            <p class="text-sm <?php echo e($statusColors[$statusPengumuman]['text']); ?> font-medium">
                                                <?php echo e(ceil($sisaHariPengumuman)); ?> hari lagi
                                            </p>
                                        </div>
                                    <?php endif; ?>
                                    <?php if($statusPengumuman == 'SELESAI'): ?>
                                        <div class="mt-3 pt-3 border-t <?php echo e($statusColors[$statusPengumuman]['border']); ?>">
                                            <a href="<?php echo e(route('spmb.pengumuman')); ?>" class="inline-flex items-center gap-1 text-sm <?php echo e($statusColors[$statusPengumuman]['text']); ?> font-medium hover:underline">
                                                Cek hasil
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                                </svg>
                                            </a>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <!-- Legend -->
            <div class="mt-12 bg-white rounded-2xl p-6 border border-gray-100">
                <h3 class="font-bold text-gray-900 mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Keterangan Status
                </h3>
                <div class="flex flex-wrap gap-4">
                    <div class="flex items-center gap-2">
                        <span class="w-3 h-3 rounded-full bg-green-500"></span>
                        <span class="text-sm text-gray-600"><strong>SELESAI</strong> - Tahapan telah selesai</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="w-3 h-3 rounded-full bg-blue-500 animate-pulse"></span>
                        <span class="text-sm text-gray-600"><strong>BERLANGSUNG</strong> - Sedang berlangsung</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="w-3 h-3 rounded-full bg-gray-400"></span>
                        <span class="text-sm text-gray-600"><strong>MENDATANG</strong> - Belum dimulai</span>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="mt-12 grid md:grid-cols-2 gap-6">
                <a href="<?php echo e(route('spmb.info')); ?>" class="group flex items-center gap-4 bg-white p-6 rounded-2xl border border-gray-100 shadow-sm hover:shadow-lg hover:border-blue-200 transition duration-300">
                    <div class="w-14 h-14 rounded-xl bg-blue-50 text-blue-500 flex items-center justify-center group-hover:bg-blue-500 group-hover:text-white transition">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <h4 class="font-bold text-gray-900 group-hover:text-blue-600 transition">Informasi Lengkap</h4>
                        <p class="text-sm text-gray-500">Lihat syarat dan alur pendaftaran</p>
                    </div>
                    <svg class="w-5 h-5 text-gray-400 ml-auto group-hover:text-blue-500 group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
                
                <a href="<?php echo e(route('spmb.pengumuman')); ?>" class="group flex items-center gap-4 bg-white p-6 rounded-2xl border border-gray-100 shadow-sm hover:shadow-lg hover:border-blue-200 transition duration-300">
                    <div class="w-14 h-14 rounded-xl bg-orange-50 text-orange-500 flex items-center justify-center group-hover:bg-orange-500 group-hover:text-white transition">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <div>
                        <h4 class="font-bold text-gray-900 group-hover:text-orange-600 transition">Cek Pengumuman</h4>
                        <p class="text-sm text-gray-500">Lihat hasil seleksi masuk</p>
                    </div>
                    <svg class="w-5 h-5 text-gray-400 ml-auto group-hover:text-orange-500 group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
        </div>
    </section>

    <?php $__env->startPush('scripts'); ?>
    <script>
        <?php if($nextEvent): ?>
        // Countdown Timer
        const targetDate = new Date('<?php echo e($nextEvent['date']->format('Y-m-d H:i:s')); ?>').getTime();
        
        function updateCountdown() {
            const now = new Date().getTime();
            const distance = targetDate - now;
            
            if (distance < 0) {
                document.getElementById('global-countdown').innerHTML = 'Waktu habis!';
                document.getElementById('cd-days').innerHTML = '00';
                document.getElementById('cd-hours').innerHTML = '00';
                document.getElementById('cd-minutes').innerHTML = '00';
                document.getElementById('cd-seconds').innerHTML = '00';
                return;
            }
            
            const days = Math.floor(distance / (1000 * 60 * 60 * 24));
            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);
            
            document.getElementById('cd-days').innerHTML = String(days).padStart(2, '0');
            document.getElementById('cd-hours').innerHTML = String(hours).padStart(2, '0');
            document.getElementById('cd-minutes').innerHTML = String(minutes).padStart(2, '0');
            document.getElementById('cd-seconds').innerHTML = String(seconds).padStart(2, '0');
            
            document.getElementById('global-countdown').innerHTML = days + ' hari lagi';
        }
        
        updateCountdown();
        setInterval(updateCountdown, 1000);
        <?php endif; ?>
    </script>
    <?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\user\.gemini\antigravity\scratch\smkalstar\smkalstar\resources\views/spmb/kalender.blade.php ENDPATH**/ ?>