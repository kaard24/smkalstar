

<?php $__env->startSection('title', 'Informasi SPMB - SMK Al-Hidayah Lestari'); ?>

<?php $__env->startSection('content'); ?>
    <!-- Header Page - SPMB Design -->
    <div class="relative bg-gradient-to-br from-blue-50 via-sky-50 to-cyan-50 py-16 md:py-24 border-b border-blue-100 overflow-hidden">
        <!-- Decorative Elements -->
        <div class="absolute inset-0">
            <div class="absolute top-0 right-1/4 w-96 h-96 bg-blue-300/20 rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 left-1/4 w-72 h-72 bg-sky-300/20 rounded-full blur-3xl"></div>
            <!-- Education Steps Pattern - Representasi tangga pendidikan/menuju cita-cita -->
            <svg class="absolute inset-0 w-full h-full opacity-10" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <pattern id="education-steps" patternUnits="userSpaceOnUse" width="60" height="60">
                        <!-- Steps/Graduation motif -->
                        <path d="M0 45 L15 45 L15 30 L30 30 L30 15 L45 15 L45 0 L60 0" stroke="#3b82f6" stroke-width="1.5" fill="none"/>
                        <circle cx="45" cy="45" r="3" fill="#3b82f6"/>
                        <circle cx="15" cy="15" r="2" fill="#3b82f6"/>
                        <path d="M5 55 L10 50 L15 55" stroke="#3b82f6" stroke-width="1" fill="none"/>
                    </pattern>
                </defs>
                <rect width="100%" height="100%" fill="url(#education-steps)" />
            </svg>
        </div>
        
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
            <div class="inline-flex items-center gap-2 bg-gradient-to-r from-blue-500 to-cyan-500 text-white px-5 py-2 rounded-full text-sm font-bold mb-6 shadow-lg shadow-blue-200">
                <span class="w-2 h-2 bg-white rounded-full animate-pulse"></span>
                Pendaftaran Dibuka!
            </div>
            <h1 class="text-3xl md:text-4xl lg:text-5xl xl:text-6xl font-bold text-gray-900 mb-4 font-heading">
                Sistem Penerimaan <br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-500 via-sky-500 to-cyan-500">Murid Baru 2026/2027</span>
            </h1>
            <p class="text-gray-600 text-lg md:text-xl max-w-3xl mx-auto leading-relaxed mb-8">Informasi lengkap mengenai pendaftaran, jadwal, persyaratan, dan biaya pendidikan di SMK Al-Hidayah Lestari</p>
            
            <!-- Countdown/Quick Info -->
            <div class="flex flex-wrap justify-center gap-4 md:gap-6">
                <?php $__currentLoopData = $gelombang->take(2); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $g): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    $isAktif = $g->is_aktif;
                    $statusColor = $isAktif ? 'blue' : 'slate';
                ?>
                <div class="bg-white/80 backdrop-blur-sm rounded-2xl px-6 py-4 shadow-lg border border-<?php echo e($isAktif ? 'blue' : 'slate'); ?>-100">
                    <div class="text-2xl font-bold text-<?php echo e($isAktif ? 'blue' : 'slate'); ?>-600"><?php echo e($g->nama); ?></div>
                    <div class="text-sm text-gray-600"><?php echo e($g->pendaftaran_start->format('M')); ?> - <?php echo e($g->pendaftaran_end->format('M Y')); ?></div>
                    <?php if($isAktif): ?>
                    <div class="mt-2 inline-flex items-center gap-1 text-xs font-bold text-blue-600">
                        <span class="w-1.5 h-1.5 bg-blue-500 rounded-full animate-pulse"></span>
                        BERLANGSUNG
                    </div>
                    <?php endif; ?>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>

    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-3 gap-12">
                <!-- Main Content -->
                <div class="lg:col-span-2 space-y-16">
                    
                    <!-- Program Keahlian -->
                    <?php
                        $jurusanImages = [
                            'TKJ' => ['img' => 'images/tkj.png', 'logo' => 'images/logo/tkj.jpeg', 'border' => 'border-blue-900', 'bg' => 'bg-blue-50', 'text' => 'text-blue-900', 'hover' => 'group-hover:bg-blue-900'],
                            'MPLB' => ['img' => 'images/mplb.png', 'logo' => 'images/logo/mplb.jpeg', 'border' => 'border-green-500', 'bg' => 'bg-green-50', 'text' => 'text-green-600', 'hover' => 'group-hover:bg-green-600'],
                            'AKL' => ['img' => 'images/akl.png', 'logo' => 'images/logo/akl.jpeg', 'border' => 'border-purple-500', 'bg' => 'bg-purple-50', 'text' => 'text-purple-600', 'hover' => 'group-hover:bg-purple-600'],
                            'BR' => ['img' => 'images/br.png', 'logo' => 'images/logo/br.jpeg', 'border' => 'border-cyan-500', 'bg' => 'bg-cyan-50', 'text' => 'text-cyan-600', 'hover' => 'group-hover:bg-cyan-600'],
                        ];
                    ?>
                    <div>
                        <div class="flex items-center gap-4 mb-8">
                            <span class="w-12 h-12 rounded-2xl bg-primary/10 text-primary flex items-center justify-center text-xl font-bold">1</span>
                            <h2 class="text-3xl font-bold text-gray-900 font-heading">Program Keahlian</h2>
                        </div>
                        <div class="grid sm:grid-cols-2 gap-6">
                            <?php $__empty_1 = true; $__currentLoopData = $jurusan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $j): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <?php
                                    $data = $jurusanImages[$j->kode] ?? [
                                        'img' => null,
                                        'logo' => 'images/logo/default.jpeg',
                                        'border' => 'border-gray-100', 
                                        'bg' => 'bg-gray-50', 
                                        'text' => 'text-gray-600',
                                        'hover' => 'group-hover:bg-gray-600',
                                    ];
                                ?>
                                
                                <a href="<?php echo e(url('/jurusan/' . strtolower($j->kode))); ?>" class="flex flex-col border <?php echo e($data['border']); ?> rounded-3xl bg-white hover:shadow-lg transition duration-300 group overflow-hidden cursor-pointer">
                                    
                                    <div class="relative h-48 bg-gray-50 overflow-hidden flex items-center justify-center p-2">
                                        <img src="<?php echo e(asset($data['img'])); ?>" alt="<?php echo e($j->nama); ?>" class="w-full h-full object-contain scale-125 group-hover:scale-[1.35] transition duration-300">
                                    </div>
                                    
                                    <div class="p-3 flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-full <?php echo e($data['bg']); ?> flex items-center justify-center overflow-hidden flex-shrink-0 ring-2 ring-white shadow-sm <?php echo e($data['hover']); ?> transition">
                                            <img src="<?php echo e(asset($data['logo'])); ?>" alt="Logo <?php echo e($j->nama); ?>" class="w-full h-full object-cover">
                                        </div>
                                        <h3 class="font-bold text-gray-900 text-sm group-hover:<?php echo e($data['text']); ?> transition leading-tight"><?php echo e($j->nama); ?></h3>
                                    </div>
                                </a>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <div class="col-span-2 p-6 border border-gray-100 rounded-3xl bg-gray-50 text-center text-gray-500">
                                    Belum ada data program keahlian.
                                </div>
                            <?php endif; ?>
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
                                <?php $__currentLoopData = $gelombang; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $g): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    $isBerlangsung = $g->status_pendaftaran === 'BERLANGSUNG';
                                    $isSelesai = $g->status_pendaftaran === 'SELESAI';
                                ?>
                                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 p-4 rounded-2xl <?php echo e($isBerlangsung ? 'bg-sky-50/50 border border-sky-100' : ($isSelesai ? 'bg-gray-50 border border-gray-100' : 'border border-gray-100 hover:bg-gray-50 transition')); ?>">
                                    <div class="flex items-center gap-4">
                                        <div class="w-12 h-12 rounded-full <?php echo e($isBerlangsung ? 'bg-sky-100 text-sky-600' : ($isSelesai ? 'bg-gray-200 text-gray-500' : 'bg-gray-100 text-gray-400')); ?> flex items-center justify-center">
                                            <span class="text-lg font-bold"><?php echo e($g->nomor); ?></span>
                                        </div>
                                        <div>
                                            <h4 class="font-bold text-gray-900 text-lg"><?php echo e($g->nama); ?></h4>
                                            <p class="text-sm text-gray-600 font-medium"><?php echo e($g->pendaftaran_start->translatedFormat('d M Y')); ?> - <?php echo e($g->pendaftaran_end->translatedFormat('d M Y')); ?></p>
                                        </div>
                                    </div>
                                    <?php if($isBerlangsung): ?>
                                    <span class="px-4 py-2 bg-[#0EA5E9] text-white rounded-xl text-xs font-bold shadow-sm md:self-center self-start">SEDANG DIBUKA</span>
                                    <?php elseif($isSelesai): ?>
                                    <span class="px-4 py-2 bg-gray-200 text-gray-600 rounded-xl text-xs font-bold md:self-center self-start">SELESAI</span>
                                    <?php else: ?>
                                    <span class="px-4 py-2 bg-gray-100 text-gray-500 rounded-xl text-xs font-bold border border-gray-200 md:self-center self-start">AKAN DATANG</span>
                                    <?php endif; ?>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                            <?php $__empty_1 = true; $__currentLoopData = $alur; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <?php
                                $isFirst = $index === 0;
                            ?>
                            <div class="relative group">
                                <span class="absolute -left-[33px] sm:-left-[41px] top-0 w-8 h-8 sm:w-10 sm:h-10 rounded-full <?php echo e($isFirst ? 'bg-primary border-4 border-white shadow-md text-white' : 'bg-white border-4 border-gray-200 shadow-sm text-gray-500 group-hover:border-primary group-hover:text-primary'); ?> flex items-center justify-center text-xs sm:text-sm font-bold z-10 transition"><?php echo e($item->nomor); ?></span>
                                <h3 class="font-bold text-gray-900 text-lg mb-1 group-hover:text-primary transition"><?php echo e($item->judul); ?></h3>
                                <p class="text-gray-600 leading-relaxed"><?php echo e($item->deskripsi); ?></p>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <div class="text-center text-gray-500 py-4">Belum ada data alur pendaftaran.</div>
                            <?php endif; ?>
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
                                <?php $__empty_1 = true; $__currentLoopData = $persyaratan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <li class="flex items-start gap-3">
                                    <svg class="w-6 h-6 text-[#0EA5E9] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    <div>
                                        <span class="text-gray-700 font-medium"><?php echo e($item->nama); ?></span>
                                        <?php if($item->keterangan): ?>
                                        <p class="text-sm text-gray-500 mt-1"><?php echo e($item->keterangan); ?></p>
                                        <?php endif; ?>
                                    </div>
                                    <?php if($item->wajib): ?>
                                    <span class="ml-auto px-2 py-0.5 bg-rose-100 text-rose-700 text-xs rounded-full font-medium">Wajib</span>
                                    <?php endif; ?>
                                </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <li class="text-center text-gray-500 py-4">Belum ada data persyaratan.</li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Sidebar Fees & Contact -->
                <div class="lg:col-span-1 space-y-8">
                    <!-- Kalender Akademik Card -->
                    <a href="<?php echo e(route('spmb.kalender')); ?>" class="block bg-gradient-to-br from-indigo-500 to-purple-600 text-white rounded-3xl p-6 shadow-xl relative overflow-hidden group hover:shadow-2xl transition duration-300">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full blur-3xl transform translate-x-10 -translate-y-10"></div>
                        <div class="absolute bottom-0 left-0 w-24 h-24 bg-white/10 rounded-full blur-2xl transform -translate-x-5 translate-y-5"></div>
                        
                        <div class="relative z-10">
                            <div class="flex items-center gap-3 mb-4">
                                <div class="w-12 h-12 rounded-xl bg-white/20 flex items-center justify-center">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                <h3 class="text-xl font-bold font-heading">Kalender Akademik</h3>
                            </div>
                            <p class="text-indigo-100 text-sm mb-4">Lihat jadwal lengkap pendaftaran, tes masuk, dan pengumuman untuk semua gelombang.</p>
                            <div class="flex items-center gap-2 text-sm font-semibold">
                                <span>Lihat Timeline</span>
                                <svg class="w-4 h-4 group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </div>
                        </div>
                    </a>
                    <?php
                        $totalBiaya = $biaya->sum('nominal');
                    ?>
                    <!-- Biaya -->
                    <div class="bg-gradient-to-br from-[#0EA5E9] to-[#1E3A5F] text-white rounded-3xl p-8 shadow-xl relative overflow-hidden group">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full blur-3xl transform translate-x-10 -translate-y-10"></div>
                        
                        <h3 class="text-2xl font-bold mb-6 font-heading relative z-10">Rincian Biaya</h3>
                        <div class="space-y-4 mb-8 relative z-10">
                            <?php $__empty_1 = true; $__currentLoopData = $biaya; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <div class="flex justify-between items-center py-2 border-b border-white/20">
                                <span class="text-cyan-50"><?php echo e($item->nama); ?></span>
                                <span class="font-bold"><?php echo e($item->nominal_formatted); ?></span>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <div class="text-center py-4 text-cyan-100">Belum ada data biaya.</div>
                            <?php endif; ?>
                            <?php if($biaya->isNotEmpty()): ?>
                            <div class="flex justify-between items-center pt-4">
                                <span class="font-bold text-lg">TOTAL</span>
                                <span class="font-bold text-2xl">Rp <?php echo e(number_format($totalBiaya, 0, ',', '.')); ?></span>
                            </div>
                            <?php endif; ?>
                        </div>
                        
                        <a href="<?php echo e(url('/spmb/register')); ?>" class="block w-full text-center bg-[#F97316] text-white font-bold py-4 rounded-xl hover:bg-orange-600 transition shadow-lg relative z-10 hover:shadow-xl transform group-hover:-translate-y-1 duration-300">
                            Daftar Sekarang
                        </a>
                    </div>
                    
                    <!-- Contact Person -->
                    <div class="bg-white p-8 rounded-3xl border border-gray-100 shadow-sm">
                        <h3 class="text-xl font-bold text-gray-900 mb-6 font-heading">Butuh Bantuan?</h3>
                        <p class="text-gray-600 mb-6 leading-relaxed">Jika ada kendala saat mendaftar, hubungi panitia kami:</p>
                        <div class="space-y-4">
                            <?php $__empty_1 = true; $__currentLoopData = $kontak; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <a href="<?php echo e($item->whatsapp_link); ?>" target="_blank" class="flex items-center p-4 bg-gray-50 rounded-2xl hover:bg-green-50 group transition duration-300">
                                <div class="w-10 h-10 rounded-full bg-green-100 text-green-600 flex items-center justify-center mr-4 group-hover:bg-green-500 group-hover:text-white transition flex-shrink-0">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                                    </svg>
                                </div>
                                <div class="min-w-0">
                                    <p class="text-sm text-gray-500 font-medium"><?php echo e($item->jabatan ?? 'Panitia'); ?></p>
                                    <p class="font-bold text-gray-900"><?php echo e($item->nama); ?></p>
                                    <p class="text-gray-600 text-sm"><?php echo e($item->telepon_formatted); ?></p>
                                </div>
                            </a>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <div class="text-center text-gray-500 py-4">Belum ada data kontak.</div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\eka\.gemini\antigravity\scratch\smk-alstar\resources\views/spmb/info.blade.php ENDPATH**/ ?>