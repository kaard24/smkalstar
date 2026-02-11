<header class="bg-white/95 shadow-sm sticky top-0 z-50 border-b border-gray-100 md:backdrop-blur-md safe-area-inset-top">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-14 md:h-16">
            <!-- Logo -->
            <a href="<?php echo e(url('/')); ?>" class="flex-shrink-0 flex items-center gap-2">
                <img class="h-8 w-8 md:h-9 md:w-9 rounded-full object-cover" src="<?php echo e(asset('images/logo.webp')); ?>" alt="Logo SMK Al-Hidayah Lestari" loading="lazy" decoding="async">
                <span class="font-bold text-sm md:text-lg text-primary tracking-tight truncate max-w-[140px] md:max-w-none leading-none">
                    SMK Al-Hidayah Lestari
                </span>
            </a>

            <!-- Desktop Menu -->
            <nav class="hidden md:flex space-x-1 items-center">
                <a href="<?php echo e(url('/')); ?>" class="px-3 py-2 text-gray-700 hover:text-primary font-medium transition rounded-md hover:bg-gray-50 text-sm">Beranda</a>

                <!-- Profil Sekolah Dropdown -->
                <div class="relative" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                    <button class="flex items-center gap-1 px-3 py-2 text-gray-700 hover:text-primary font-medium transition rounded-md hover:bg-gray-50 focus:outline-none text-sm" aria-haspopup="true" :aria-expanded="open.toString()" aria-label="Menu Profil Sekolah">
                        <span>Profil</span>
                        <svg :class="{'rotate-180': open}" class="w-4 h-4 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div x-show="open" x-cloak
                         x-transition:enter="transition ease-out duration-100"
                         x-transition:enter-start="transform opacity-0 scale-95"
                         x-transition:enter-end="transform opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-75"
                         x-transition:leave-start="transform opacity-100 scale-100"
                         x-transition:leave-end="transform opacity-0 scale-95"
                         class="absolute left-0 mt-0 w-48 bg-white rounded-xl shadow-lg border border-gray-100 py-2 z-50">
                        <a href="<?php echo e(url('/profil')); ?>" class="block px-4 py-2 text-sm text-gray-700 hover:bg-sky-50 hover:text-primary">Profil Sekolah</a>
                        <a href="<?php echo e(url('/fasilitas')); ?>" class="block px-4 py-2 text-sm text-gray-700 hover:bg-sky-50 hover:text-primary">Fasilitas</a>
                        <a href="<?php echo e(url('/ekstrakurikuler')); ?>" class="block px-4 py-2 text-sm text-gray-700 hover:bg-sky-50 hover:text-primary">Ekstrakurikuler</a>
                        <a href="<?php echo e(url('/prestasi')); ?>" class="block px-4 py-2 text-sm text-gray-700 hover:bg-sky-50 hover:text-primary">Prestasi</a>
                        <a href="<?php echo e(url('/galeri')); ?>" class="block px-4 py-2 text-sm text-gray-700 hover:bg-sky-50 hover:text-primary">Galeri</a>
                        <a href="<?php echo e(url('/seragam')); ?>" class="block px-4 py-2 text-sm text-gray-700 hover:bg-sky-50 hover:text-primary <?php echo e(request()->is('seragam') ? 'bg-sky-50 text-primary' : ''); ?>">👔 Seragam</a>
                    </div>
                </div>

                <!-- Jurusan Dropdown -->
                <div class="relative" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                    <button class="flex items-center gap-1 px-3 py-2 text-gray-700 hover:text-primary font-medium transition rounded-md hover:bg-gray-50 focus:outline-none text-sm <?php echo e(request()->is('jurusan*') ? 'text-primary bg-sky-50' : ''); ?>" aria-haspopup="true" :aria-expanded="open.toString()">
                        <span>Jurusan</span>
                        <svg :class="{'rotate-180': open}" class="w-4 h-4 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div x-show="open" x-cloak
                         x-transition:enter="transition ease-out duration-100"
                         x-transition:enter-start="transform opacity-0 scale-95"
                         x-transition:enter-end="transform opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-75"
                         x-transition:leave-start="transform opacity-100 scale-100"
                         x-transition:leave-end="transform opacity-0 scale-95"
                         class="absolute left-0 mt-0 w-64 bg-white rounded-xl shadow-lg border border-gray-100 py-2 z-50">
                        <a href="<?php echo e(url('/jurusan/tkj')); ?>" class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-sky-50 hover:text-primary <?php echo e(request()->is('jurusan/tkj') ? 'bg-sky-50 text-primary' : ''); ?>">
                            <img src="<?php echo e(asset('images/logo/tkj.jpeg')); ?>" alt="TKJ" class="w-6 h-6 rounded-md object-cover">
                            <span>Teknik Komputer Jaringan</span>
                        </a>
                        <a href="<?php echo e(url('/jurusan/mplb')); ?>" class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-sky-50 hover:text-primary <?php echo e(request()->is('jurusan/mplb') ? 'bg-sky-50 text-primary' : ''); ?>">
                            <img src="<?php echo e(asset('images/logo/mplb.jpeg')); ?>" alt="MPLB" class="w-6 h-6 rounded-md object-cover">
                            <span>Manajemen Perkantoran</span>
                        </a>
                        <a href="<?php echo e(url('/jurusan/akl')); ?>" class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-sky-50 hover:text-primary <?php echo e(request()->is('jurusan/akl') ? 'bg-sky-50 text-primary' : ''); ?>">
                            <img src="<?php echo e(asset('images/logo/akl.jpeg')); ?>" alt="AKL" class="w-6 h-6 rounded-md object-cover">
                            <span>Akuntansi Keuangan</span>
                        </a>
                        <a href="<?php echo e(url('/jurusan/br')); ?>" class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-sky-50 hover:text-primary <?php echo e(request()->is('jurusan/br') ? 'bg-sky-50 text-primary' : ''); ?>">
                            <img src="<?php echo e(asset('images/logo/br.jpeg')); ?>" alt="BR" class="w-6 h-6 rounded-md object-cover">
                            <span>Bisnis Ritel</span>
                        </a>
                    </div>
                </div>

                <a href="<?php echo e(url('/berita')); ?>" class="px-3 py-2 text-gray-700 hover:text-primary font-medium transition rounded-md hover:bg-gray-50 text-sm">Berita</a>
                
                <!-- SPMB Dropdown -->
                <div class="relative" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                    <button class="flex items-center gap-1 px-3 py-2 text-primary font-semibold hover:text-secondary transition rounded-md hover:bg-sky-50 focus:outline-none text-sm" aria-haspopup="true" :aria-expanded="open.toString()">
                        <span>SPMB</span>
                        <svg :class="{'rotate-180': open}" class="w-4 h-4 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div x-show="open" x-cloak
                         x-transition:enter="transition ease-out duration-100"
                         x-transition:enter-start="transform opacity-0 scale-95"
                         x-transition:enter-end="transform opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-75"
                         x-transition:leave-start="transform opacity-100 scale-100"
                         x-transition:leave-end="transform opacity-0 scale-95"
                         class="absolute left-0 mt-0 w-56 bg-white rounded-xl shadow-lg border border-gray-100 py-2 z-50">
                        <a href="<?php echo e(url('/spmb/info')); ?>" class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-sky-50 hover:text-primary <?php echo e(request()->is('spmb/info') ? 'bg-sky-50 text-primary' : ''); ?>">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Informasi SPMB
                        </a>
                        <a href="<?php echo e(route('spmb.kalender')); ?>" class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-sky-50 hover:text-primary <?php echo e(request()->is('spmb/kalender') ? 'bg-sky-50 text-primary' : ''); ?>">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            Kalender Akademik
                        </a>
                        <a href="<?php echo e(route('spmb.pengumuman')); ?>" class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-sky-50 hover:text-primary <?php echo e(request()->is('spmb/pengumuman') ? 'bg-sky-50 text-primary' : ''); ?>">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/>
                            </svg>
                            Cek Pengumuman
                        </a>
                    </div>
                </div>
            </nav>

            <!-- CTA Buttons / User Profile -->
            <div class="hidden md:flex items-center space-x-2">
                <?php if(auth()->guard('spmb')->check()): ?>
                    <?php
                        $user = auth('spmb')->user();
                        $fotoUrl = $user->foto && file_exists(public_path('storage/foto/' . $user->foto)) 
                            ? asset('storage/foto/' . $user->foto) 
                            : ($user->jk === 'P' ? asset('images/avatar-female.svg') : asset('images/avatar-male.svg'));
                    ?>
                    <div class="relative" x-data="{ open: false }" @click.away="open = false">
                        <button @click="open = !open" class="flex items-center gap-2 text-gray-700 hover:text-primary transition focus:outline-none px-2 py-1 rounded-lg hover:bg-gray-50" aria-haspopup="true" :aria-expanded="open.toString()" aria-label="Menu pengguna <?php echo e($user->nama ?: 'Siswa'); ?>">
                            <div class="w-8 h-8 rounded-full overflow-hidden border-2 border-primary/20 bg-gray-100">
                                <img src="<?php echo e($fotoUrl); ?>" alt="Foto <?php echo e($user->nama); ?>" class="w-full h-full object-cover">
                            </div>
                            <span class="font-medium text-sm hidden lg:block truncate max-w-[100px]"><?php echo e($user->nama ?: 'Siswa'); ?></span>
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        <div x-show="open" x-cloak
                             x-transition:enter="transition ease-out duration-100"
                             x-transition:enter-start="transform opacity-0 scale-95"
                             x-transition:enter-end="transform opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-75"
                             x-transition:leave-start="transform opacity-100 scale-100"
                             x-transition:leave-end="transform opacity-0 scale-95"
                             class="absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-lg border border-gray-100 py-2 z-50">
                            <a href="<?php echo e(route('spmb.dashboard')); ?>" class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-primary">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                                </svg>
                                Dashboard
                            </a>
                            <a href="<?php echo e(route('spmb.profil')); ?>" class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-primary">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                                Profil
                            </a>
                            <div class="border-t border-gray-100 my-1"></div>
                            <form action="<?php echo e(route('logout')); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <button type="submit" class="flex items-center gap-2 w-full px-4 py-2 text-sm text-red-600 hover:bg-red-50">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                    </svg>
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                <?php else: ?>
                    <a href="<?php echo e(url('/login')); ?>" class="text-sm font-medium text-gray-600 hover:text-primary transition px-3 py-2">Login</a>
                    <a href="<?php echo e(url('/spmb/register')); ?>" class="bg-primary hover:bg-secondary text-white px-4 py-2 rounded-lg font-medium transition shadow-sm text-sm">
                        Daftar
                    </a>
                <?php endif; ?>
            </div>

            <!-- Mobile menu button -->
            <div class="md:hidden flex items-center">
                <button type="button" 
                    class="p-2.5 rounded-xl text-gray-500 hover:text-gray-700 hover:bg-gray-100 transition active:scale-95" 
                    onclick="document.getElementById('mobile-menu').classList.toggle('hidden')" 
                    aria-label="Toggle menu navigasi" 
                    aria-expanded="false" 
                    aria-controls="mobile-menu"
                    style="min-height: 44px; min-width: 44px;">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu - Compact Grid Layout -->
    <div class="hidden md:hidden bg-white border-t border-gray-100 max-h-[80vh] overflow-y-auto" id="mobile-menu" style="padding-bottom: env(safe-area-inset-bottom);">
        <div class="px-4 py-3 pb-safe">
            <!-- Grid Menu -->
            <div class="grid grid-cols-3 gap-2">
                <a href="<?php echo e(url('/')); ?>" class="flex flex-col items-center justify-center p-3 rounded-lg text-xs font-medium <?php echo e(request()->is('/') ? 'bg-primary text-white' : 'text-gray-700 hover:bg-gray-50'); ?>">
                    <svg class="w-5 h-5 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                    Beranda
                </a>
                <a href="<?php echo e(url('/profil')); ?>" class="flex flex-col items-center justify-center p-3 rounded-lg text-xs font-medium <?php echo e(request()->is('profil') ? 'bg-primary text-white' : 'text-gray-700 hover:bg-gray-50'); ?>">
                    <svg class="w-5 h-5 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                    Profil
                </a>
                
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" class="w-full flex flex-col items-center justify-center p-3 rounded-lg text-xs font-medium <?php echo e(request()->is('jurusan*') ? 'bg-primary text-white' : 'text-gray-700 hover:bg-gray-50'); ?>">
                        <svg class="w-5 h-5 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/></svg>
                        Jurusan
                    </button>
                    
                    <div x-show="open" x-cloak class="absolute top-full left-1/2 transform -translate-x-1/2 mt-1 w-48 bg-white rounded-xl shadow-lg border border-gray-100 py-2 z-50">
                        <a href="<?php echo e(url('/jurusan/tkj')); ?>" class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-sky-50 hover:text-primary <?php echo e(request()->is('jurusan/tkj') ? 'bg-sky-50 text-primary' : ''); ?>">
                            <img src="<?php echo e(asset('images/logo/tkj.jpeg')); ?>" alt="TKJ" class="w-5 h-5 rounded">
                            TKJ
                        </a>
                        <a href="<?php echo e(url('/jurusan/mplb')); ?>" class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-sky-50 hover:text-primary <?php echo e(request()->is('jurusan/mplb') ? 'bg-sky-50 text-primary' : ''); ?>">
                            <img src="<?php echo e(asset('images/logo/mplb.jpeg')); ?>" alt="MPLB" class="w-5 h-5 rounded">
                            MPLB
                        </a>
                        <a href="<?php echo e(url('/jurusan/akl')); ?>" class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-sky-50 hover:text-primary <?php echo e(request()->is('jurusan/akl') ? 'bg-sky-50 text-primary' : ''); ?>">
                            <img src="<?php echo e(asset('images/logo/akl.jpeg')); ?>" alt="AKL" class="w-5 h-5 rounded">
                            AKL
                        </a>
                        <a href="<?php echo e(url('/jurusan/br')); ?>" class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-sky-50 hover:text-primary <?php echo e(request()->is('jurusan/br') ? 'bg-sky-50 text-primary' : ''); ?>">
                            <img src="<?php echo e(asset('images/logo/br.jpeg')); ?>" alt="BR" class="w-5 h-5 rounded">
                            BR
                        </a>
                    </div>
                </div>
                <a href="<?php echo e(url('/fasilitas')); ?>" class="flex flex-col items-center justify-center p-3 rounded-lg text-xs font-medium <?php echo e(request()->is('fasilitas') ? 'bg-primary text-white' : 'text-gray-700 hover:bg-gray-50'); ?>">
                    <svg class="w-5 h-5 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                    Fasilitas
                </a>
                <a href="<?php echo e(url('/ekstrakurikuler')); ?>" class="flex flex-col items-center justify-center p-3 rounded-lg text-xs font-medium <?php echo e(request()->is('ekstrakurikuler') ? 'bg-primary text-white' : 'text-gray-700 hover:bg-gray-50'); ?>">
                    <svg class="w-5 h-5 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    Eskul
                </a>
                <a href="<?php echo e(url('/prestasi')); ?>" class="flex flex-col items-center justify-center p-3 rounded-lg text-xs font-medium <?php echo e(request()->is('prestasi') ? 'bg-primary text-white' : 'text-gray-700 hover:bg-gray-50'); ?>">
                    <svg class="w-5 h-5 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/></svg>
                    Prestasi
                </a>
                <a href="<?php echo e(url('/berita')); ?>" class="flex flex-col items-center justify-center p-3 rounded-lg text-xs font-medium <?php echo e(request()->is('berita') ? 'bg-primary text-white' : 'text-gray-700 hover:bg-gray-50'); ?>">
                    <svg class="w-5 h-5 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                    Berita
                </a>
                <a href="<?php echo e(url('/galeri')); ?>" class="flex flex-col items-center justify-center p-3 rounded-lg text-xs font-medium <?php echo e(request()->is('galeri') ? 'bg-primary text-white' : 'text-gray-700 hover:bg-gray-50'); ?>">
                    <svg class="w-5 h-5 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    Galeri
                </a>
                <a href="<?php echo e(url('/seragam')); ?>" class="flex flex-col items-center justify-center p-3 rounded-lg text-xs font-medium <?php echo e(request()->is('seragam') ? 'bg-primary text-white' : 'text-gray-700 hover:bg-gray-50'); ?>">
                    <span class="text-lg mb-0.5">👔</span>
                    Seragam
                </a>
                
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" class="w-full flex flex-col items-center justify-center p-3 rounded-lg text-xs font-bold <?php echo e(request()->is('spmb*') ? 'bg-primary text-white' : 'text-primary bg-sky-50'); ?>">
                        <svg class="w-5 h-5 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        SPMB
                    </button>
                    <div x-show="open" x-cloak class="absolute bottom-full left-1/2 transform -translate-x-1/2 mb-2 w-48 bg-white rounded-xl shadow-lg border border-gray-100 py-2 z-50">
                        <a href="<?php echo e(url('/spmb/info')); ?>" class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-sky-50 hover:text-primary <?php echo e(request()->is('spmb/info') ? 'bg-sky-50 text-primary' : ''); ?>">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            Info SPMB
                        </a>
                        <a href="<?php echo e(route('spmb.kalender')); ?>" class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-sky-50 hover:text-primary <?php echo e(request()->is('spmb/kalender') ? 'bg-sky-50 text-primary' : ''); ?>">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            Kalender
                        </a>
                        <a href="<?php echo e(route('spmb.pengumuman')); ?>" class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-sky-50 hover:text-primary <?php echo e(request()->is('spmb/pengumuman') ? 'bg-sky-50 text-primary' : ''); ?>">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/></svg>
                            Pengumuman
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- User Section -->
            <?php if(auth()->guard('spmb')->check()): ?>
                <?php
                    $mobileUser = auth('spmb')->user();
                    $mobileFotoUrl = $mobileUser->foto && file_exists(public_path('storage/foto/' . $mobileUser->foto)) 
                        ? asset('storage/foto/' . $mobileUser->foto) 
                        : ($mobileUser->jk === 'P' ? asset('images/avatar-female.svg') : asset('images/avatar-male.svg'));
                ?>
                <div class="border-t border-gray-200 pt-3 mt-3">
                    <div class="flex items-center gap-3 mb-2">
                        <div class="w-10 h-10 rounded-full overflow-hidden border-2 border-primary/20 bg-gray-100">
                            <img src="<?php echo e($mobileFotoUrl); ?>" alt="Foto <?php echo e($mobileUser->nama); ?>" class="w-full h-full object-cover">
                        </div>
                        <div class="flex-1 min-w-0">
                            <span class="text-sm font-medium text-gray-900 block truncate"><?php echo e($mobileUser->nama ?: 'Siswa'); ?></span>
                            <span class="text-xs text-gray-500"><?php echo e($mobileUser->nisn); ?></span>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-2">
                        <a href="<?php echo e(route('spmb.dashboard')); ?>" class="flex items-center justify-center gap-2 px-3 py-2 rounded-lg text-xs font-medium <?php echo e(request()->routeIs('spmb.dashboard') ? 'bg-primary text-white' : 'text-gray-700 hover:bg-gray-50 border border-gray-200'); ?>">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                            Dashboard
                        </a>
                        <form action="<?php echo e(route('logout')); ?>" method="POST" class="flex-1">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="w-full flex items-center justify-center gap-2 px-3 py-2 rounded-lg text-xs font-medium text-red-600 border border-red-200 hover:bg-red-50">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            <?php else: ?>
                <div class="border-t border-gray-200 pt-3 mt-3 grid grid-cols-2 gap-2">
                    <a href="<?php echo e(url('/login')); ?>" class="flex items-center justify-center px-3 py-2 rounded-lg text-xs font-medium text-gray-700 hover:bg-gray-50 border border-gray-200">
                        Login
                    </a>
                    <a href="<?php echo e(url('/spmb/register')); ?>" class="flex items-center justify-center px-3 py-2 rounded-lg text-xs font-bold text-white bg-primary hover:bg-secondary">
                        Daftar
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</header>
<?php /**PATH C:\Users\eka\.gemini\antigravity\scratch\smk-alstar\resources\views/partials/header.blade.php ENDPATH**/ ?>