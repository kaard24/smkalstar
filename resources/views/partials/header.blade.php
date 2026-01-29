<header class="bg-white/90 backdrop-blur-md shadow-sm sticky top-0 z-50 border-b border-gray-100/50">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Logo -->
            <div class="flex-shrink-0 flex items-center gap-2">
                <img class="h-12 w-auto" src="{{ asset('images/logo.jpg') }}" alt="Logo SMK Al-Hidayah Lestari">
                <a href="{{ url('/') }}" class="font-bold text-xl text-primary tracking-tight">SMK Al-Hidayah Lestari</a>
            </div>

            <!-- Desktop Menu -->
            <nav class="hidden md:flex space-x-1 items-center">
                <!-- Beranda -->
                <a href="{{ url('/') }}" class="px-3 py-2 text-gray-700 hover:text-primary font-medium transition rounded-md hover:bg-gray-50">Beranda</a>

                <!-- Profil Sekolah Dropdown -->
                <div class="relative" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                    <button class="flex items-center gap-1 px-3 py-2 text-gray-700 hover:text-primary font-medium transition rounded-md hover:bg-gray-50 focus:outline-none">
                        <span>Profil Sekolah</span>
                        <svg :class="{'rotate-180': open}" class="w-4 h-4 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    <div x-show="open" 
                         x-transition:enter="transition ease-out duration-100"
                         x-transition:enter-start="transform opacity-0 scale-95"
                         x-transition:enter-end="transform opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-75"
                         x-transition:leave-start="transform opacity-100 scale-100"
                         x-transition:leave-end="transform opacity-0 scale-95"
                         class="absolute left-0 mt-0 w-48 bg-white rounded-xl shadow-lg border border-gray-100 py-2 z-50">
                        <a href="{{ url('/profil') }}#sejarah" class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-primary">Sejarah</a>
                        <a href="{{ url('/profil') }}#visi-misi" class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-primary">Visi & Misi</a>
                        <a href="{{ url('/profil') }}#struktur-organisasi" class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-primary">Struktur Organisasi</a>
                        <a href="{{ url('/fasilitas') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-primary">Fasilitas</a>
                    </div>
                </div>

                <!-- Akademik Dropdown -->
                <div class="relative" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                    <button class="flex items-center gap-1 px-3 py-2 text-gray-700 hover:text-primary font-medium transition rounded-md hover:bg-gray-50 focus:outline-none">
                        <span>Akademik</span>
                        <svg :class="{'rotate-180': open}" class="w-4 h-4 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    <div x-show="open" 
                         x-transition:enter="transition ease-out duration-100"
                         x-transition:enter-start="transform opacity-0 scale-95"
                         x-transition:enter-end="transform opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-75"
                         x-transition:leave-start="transform opacity-100 scale-100"
                         x-transition:leave-end="transform opacity-0 scale-95"
                         class="absolute left-0 mt-0 w-56 bg-white rounded-xl shadow-lg border border-gray-100 py-2 z-50">
                        <a href="{{ url('/jurusan') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-primary">Jurusan</a>
                        <a href="{{ url('/galeri') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-primary">Galeri</a>
                    </div>
                </div>

                <!-- Kesiswaan Dropdown -->
                <div class="relative" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                    <button class="flex items-center gap-1 px-3 py-2 text-gray-700 hover:text-primary font-medium transition rounded-md hover:bg-gray-50 focus:outline-none">
                        <span>Kesiswaan</span>
                        <svg :class="{'rotate-180': open}" class="w-4 h-4 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    <div x-show="open" 
                         x-transition:enter="transition ease-out duration-100"
                         x-transition:enter-start="transform opacity-0 scale-95"
                         x-transition:enter-end="transform opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-75"
                         x-transition:leave-start="transform opacity-100 scale-100"
                         x-transition:leave-end="transform opacity-0 scale-95"
                         class="absolute left-0 mt-0 w-48 bg-white rounded-xl shadow-lg border border-gray-100 py-2 z-50">
                        <a href="{{ url('/ekstrakurikuler') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-primary">Ekstrakurikuler</a>
                        <a href="{{ url('/prestasi') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-primary">Prestasi</a>
                    </div>
                </div>

                <!-- Berita -->
                <a href="{{ url('/berita') }}" class="px-3 py-2 text-gray-700 hover:text-primary font-medium transition rounded-md hover:bg-gray-50">Berita</a>
                
                <div class="pl-2 border-l border-gray-200 flex items-center ml-2">
                    <a href="{{ url('/ppdb/info') }}" class="px-3 py-2 text-primary font-semibold hover:text-secondary transition rounded-md hover:bg-green-50">SPMB</a>
                </div>
            </nav>

            <!-- CTA Buttons / User Profile -->
            <div class="hidden md:flex items-center space-x-3">
                @auth('ppdb')
                    <!-- User sudah login -->
                    <div class="relative" x-data="{ open: false }" @click.away="open = false">
                        <button @click="open = !open" class="flex items-center gap-2 text-gray-700 hover:text-primary transition focus:outline-none">
                            <div class="w-9 h-9 bg-primary/10 rounded-full flex items-center justify-center border border-primary/20">
                                <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            </div>
                            <span class="font-medium text-sm hidden lg:block">{{ auth('ppdb')->user()->nama ?: 'Siswa' }}</span>
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        <!-- Dropdown Menu -->
                        <div x-show="open" 
                             x-transition:enter="transition ease-out duration-100"
                             x-transition:enter-start="transform opacity-0 scale-95"
                             x-transition:enter-end="transform opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-75"
                             x-transition:leave-start="transform opacity-100 scale-100"
                             x-transition:leave-end="transform opacity-0 scale-95"
                             class="absolute right-0 mt-3 w-56 bg-white rounded-xl shadow-lg border border-gray-100 py-2 z-50">
                            <div class="px-4 py-2 border-b border-gray-50 lg:hidden">
                                <p class="text-sm font-medium text-gray-900">{{ auth('ppdb')->user()->nama ?: 'Siswa' }}</p>
                                <p class="text-xs text-gray-500 truncate">{{ auth('ppdb')->user()->nisn }}</p>
                            </div>
                            <a href="{{ route('ppdb.dashboard') }}" class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-primary">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                                Dashboard
                            </a>
                            <a href="{{ route('ppdb.profil') }}" class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-primary">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                Profil Saya
                            </a>
                            <a href="{{ route('ppdb.berkas') }}" class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-primary">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                Upload Berkas
                            </a>
                            <div class="border-t border-gray-100 my-2"></div>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="flex items-center gap-2 w-full px-4 py-2 text-sm text-red-600 hover:bg-red-50">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <!-- User belum login -->
                    <a href="{{ url('/login') }}" class="text-sm font-medium text-gray-600 hover:text-primary transition">Login</a>
                    <a href="{{ url('/ppdb/register') }}" class="bg-primary hover:bg-secondary text-white px-5 py-2 rounded-full font-medium transition shadow-sm hover:shadow-md transfrom hover:-translate-y-0.5 text-sm">
                        Daftar Sekarang
                    </a>
                @endauth
            </div>

            <!-- Mobile menu button -->
            <div class="md:hidden flex items-center">
                <button type="button" class="text-gray-500 hover:text-gray-700 focus:outline-none" onclick="document.getElementById('mobile-menu').classList.toggle('hidden')">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div class="hidden md:hidden bg-white border-t border-gray-100 overflow-y-auto max-h-[80vh]" id="mobile-menu">
        <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
            <a href="{{ url('/') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-primary hover:bg-gray-50">Beranda</a>
            
            <!-- Mobile Profil Sekolah -->
            <div x-data="{ open: false }">
                <button @click="open = !open" class="flex w-full items-center justify-between px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-primary hover:bg-gray-50">
                    <span>Profil Sekolah</span>
                    <svg :class="{'rotate-180': open}" class="w-4 h-4 transition-transform text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </button>
                <div x-show="open" class="pl-4 space-y-1">
                    <a href="{{ url('/profil') }}#sejarah" class="block px-3 py-2 rounded-md text-sm text-gray-600 hover:text-primary hover:bg-gray-50">Sejarah</a>
                    <a href="{{ url('/profil') }}#visi-misi" class="block px-3 py-2 rounded-md text-sm text-gray-600 hover:text-primary hover:bg-gray-50">Visi & Misi</a>
                    <a href="{{ url('/profil') }}#struktur-organisasi" class="block px-3 py-2 rounded-md text-sm text-gray-600 hover:text-primary hover:bg-gray-50">Struktur Organisasi</a>
                    <a href="{{ url('/fasilitas') }}" class="block px-3 py-2 rounded-md text-sm text-gray-600 hover:text-primary hover:bg-gray-50">Fasilitas</a>
                </div>
            </div>

            <!-- Mobile Akademik -->
            <div x-data="{ open: false }">
                <button @click="open = !open" class="flex w-full items-center justify-between px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-primary hover:bg-gray-50">
                    <span>Akademik</span>
                    <svg :class="{'rotate-180': open}" class="w-4 h-4 transition-transform text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </button>
                <div x-show="open" class="pl-4 space-y-1">
                    <a href="{{ url('/jurusan') }}" class="block px-3 py-2 rounded-md text-sm text-gray-600 hover:text-primary hover:bg-gray-50">Jurusan</a>
                    <a href="{{ url('/galeri') }}" class="block px-3 py-2 rounded-md text-sm text-gray-600 hover:text-primary hover:bg-gray-50">Galeri</a>
                </div>
            </div>

            <!-- Mobile Kesiswaan -->
            <div x-data="{ open: false }">
                <button @click="open = !open" class="flex w-full items-center justify-between px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-primary hover:bg-gray-50">
                    <span>Kesiswaan</span>
                    <svg :class="{'rotate-180': open}" class="w-4 h-4 transition-transform text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </button>
                <div x-show="open" class="pl-4 space-y-1">
                    <a href="{{ url('/ekstrakurikuler') }}" class="block px-3 py-2 rounded-md text-sm text-gray-600 hover:text-primary hover:bg-gray-50">Ekstrakurikuler</a>
                    <a href="{{ url('/prestasi') }}" class="block px-3 py-2 rounded-md text-sm text-gray-600 hover:text-primary hover:bg-gray-50">Prestasi</a>
                </div>
            </div>

            <a href="{{ url('/ppdb/info') }}" class="block px-3 py-2 rounded-md text-base font-bold text-primary hover:bg-gray-50">SPMB</a>
            
            @auth('ppdb')
                <!-- User sudah login (mobile) -->
                <div class="border-t border-gray-200 pt-3 mt-3">
                    <div class="px-3 py-2 text-sm text-gray-500">
                        Login sebagai: <span class="font-semibold text-gray-700">{{ auth('ppdb')->user()->nama ?: 'Siswa' }}</span>
                    </div>
                    <a href="{{ route('ppdb.dashboard') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-primary hover:bg-gray-50">Dashboard</a>
                    <a href="{{ route('ppdb.profil') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-primary hover:bg-gray-50">Profil Saya</a>
                    <a href="{{ route('ppdb.berkas') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-primary hover:bg-gray-50">Upload Berkas</a>
                    <form action="{{ route('logout') }}" method="POST" class="mt-2">
                        @csrf
                        <button type="submit" class="block w-full text-left px-3 py-2 rounded-md text-base font-medium text-red-600 hover:bg-red-50">
                            Logout
                        </button>
                    </form>
                </div>
            @else
                <!-- User belum login (mobile) -->
                <div class="border-t border-gray-200 pt-3 mt-3 px-3">
                    <a href="{{ url('/login') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-600 hover:text-primary hover:bg-gray-50">Login</a>
                    <a href="{{ url('/ppdb/register') }}" class="block w-full text-center mt-3 px-5 py-3 rounded-md font-bold text-white bg-primary hover:bg-secondary">
                        Daftar Sekarang
                    </a>
                </div>
            @endauth
        </div>
    </div>
</header>

