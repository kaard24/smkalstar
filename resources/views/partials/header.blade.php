<header class="bg-white/95 backdrop-blur-md shadow-sm sticky top-0 z-50 border-b border-gray-100">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-14 md:h-16">
            <!-- Logo -->
            <a href="{{ url('/') }}" class="flex-shrink-0 flex items-center gap-2">
                <img class="h-8 w-8 md:h-9 md:w-9 rounded-full object-cover" src="{{ asset('images/logo.jpg') }}" alt="Logo SMK Al-Hidayah Lestari">
                <span class="font-bold text-sm md:text-lg text-primary tracking-tight truncate max-w-[140px] md:max-w-none leading-none">
                    SMK Al-Hidayah
                </span>
            </a>

            <!-- Desktop Menu -->
            <nav class="hidden md:flex space-x-1 items-center">
                <a href="{{ url('/') }}" class="px-3 py-2 text-gray-700 hover:text-primary font-medium transition rounded-md hover:bg-gray-50 text-sm">Beranda</a>

                <!-- Profil Sekolah Dropdown -->
                <div class="relative" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                    <button class="flex items-center gap-1 px-3 py-2 text-gray-700 hover:text-primary font-medium transition rounded-md hover:bg-gray-50 focus:outline-none text-sm">
                        <span>Profil</span>
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
                         class="absolute left-0 mt-0 w-48 bg-white rounded-xl shadow-lg border border-gray-100 py-2 z-50">
                        <a href="{{ url('/profil') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-primary">Profil Sekolah</a>
                        <a href="{{ url('/fasilitas') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-primary">Fasilitas</a>
                        <a href="{{ url('/ekstrakurikuler') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-primary">Ekstrakurikuler</a>
                        <a href="{{ url('/prestasi') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-primary">Prestasi</a>
                        <a href="{{ url('/galeri') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-primary">Galeri</a>
                    </div>
                </div>

                <a href="{{ url('/jurusan') }}" class="px-3 py-2 text-gray-700 hover:text-primary font-medium transition rounded-md hover:bg-gray-50 text-sm">Jurusan</a>
                <a href="{{ url('/berita') }}" class="px-3 py-2 text-gray-700 hover:text-primary font-medium transition rounded-md hover:bg-gray-50 text-sm">Berita</a>
                
                <div class="pl-2 border-l border-gray-200 flex items-center ml-2">
                    <a href="{{ url('/ppdb/info') }}" class="px-3 py-2 text-primary font-semibold hover:text-secondary transition rounded-md hover:bg-green-50 text-sm">SPMB</a>
                </div>
            </nav>

            <!-- CTA Buttons / User Profile -->
            <div class="hidden md:flex items-center space-x-2">
                @auth('ppdb')
                    <div class="relative" x-data="{ open: false }" @click.away="open = false">
                        <button @click="open = !open" class="flex items-center gap-2 text-gray-700 hover:text-primary transition focus:outline-none px-2 py-1 rounded-lg hover:bg-gray-50">
                            <div class="w-8 h-8 bg-primary/10 rounded-full flex items-center justify-center border border-primary/20">
                                <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            </div>
                            <span class="font-medium text-sm hidden lg:block truncate max-w-[100px]">{{ auth('ppdb')->user()->nama ?: 'Siswa' }}</span>
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                            <a href="{{ route('ppdb.dashboard') }}" class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-primary">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                                </svg>
                                Dashboard
                            </a>
                            <a href="{{ route('ppdb.profil') }}" class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-primary">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                                Profil
                            </a>
                            <div class="border-t border-gray-100 my-1"></div>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="flex items-center gap-2 w-full px-4 py-2 text-sm text-red-600 hover:bg-red-50">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                    </svg>
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ url('/login') }}" class="text-sm font-medium text-gray-600 hover:text-primary transition px-3 py-2">Login</a>
                    <a href="{{ url('/ppdb/register') }}" class="bg-primary hover:bg-secondary text-white px-4 py-2 rounded-lg font-medium transition shadow-sm text-sm">
                        Daftar
                    </a>
                @endauth
            </div>

            <!-- Mobile menu button -->
            <div class="md:hidden flex items-center">
                <button type="button" class="p-2 rounded-lg text-gray-500 hover:text-gray-700 hover:bg-gray-100 transition" onclick="document.getElementById('mobile-menu').classList.toggle('hidden')">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div class="hidden md:hidden bg-white border-t border-gray-100 overflow-y-auto max-h-[80vh]" id="mobile-menu">
        <div class="px-4 py-3 space-y-1">
            <a href="{{ url('/') }}" class="block px-4 py-3 rounded-lg text-sm font-medium {{ request()->is('/') ? 'bg-primary text-white' : 'text-gray-700 hover:bg-gray-50' }}">
                <span class="flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                    Beranda
                </span>
            </a>
            <a href="{{ url('/profil') }}" class="block px-4 py-3 rounded-lg text-sm font-medium {{ request()->is('profil') ? 'bg-primary text-white' : 'text-gray-700 hover:bg-gray-50' }}">
                <span class="flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                    Profil Sekolah
                </span>
            </a>
            <a href="{{ url('/jurusan') }}" class="block px-4 py-3 rounded-lg text-sm font-medium {{ request()->is('jurusan') ? 'bg-primary text-white' : 'text-gray-700 hover:bg-gray-50' }}">
                <span class="flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/></svg>
                    Jurusan
                </span>
            </a>
            <a href="{{ url('/fasilitas') }}" class="block px-4 py-3 rounded-lg text-sm font-medium {{ request()->is('fasilitas') ? 'bg-primary text-white' : 'text-gray-700 hover:bg-gray-50' }}">
                <span class="flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                    Fasilitas
                </span>
            </a>
            <a href="{{ url('/ekstrakurikuler') }}" class="block px-4 py-3 rounded-lg text-sm font-medium {{ request()->is('ekstrakurikuler') ? 'bg-primary text-white' : 'text-gray-700 hover:bg-gray-50' }}">
                <span class="flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    Ekstrakurikuler
                </span>
            </a>
            <a href="{{ url('/prestasi') }}" class="block px-4 py-3 rounded-lg text-sm font-medium {{ request()->is('prestasi') ? 'bg-primary text-white' : 'text-gray-700 hover:bg-gray-50' }}">
                <span class="flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/></svg>
                    Prestasi
                </span>
            </a>
            <a href="{{ url('/berita') }}" class="block px-4 py-3 rounded-lg text-sm font-medium {{ request()->is('berita') ? 'bg-primary text-white' : 'text-gray-700 hover:bg-gray-50' }}">
                <span class="flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                    Berita
                </span>
            </a>
            <a href="{{ url('/galeri') }}" class="block px-4 py-3 rounded-lg text-sm font-medium {{ request()->is('galeri') ? 'bg-primary text-white' : 'text-gray-700 hover:bg-gray-50' }}">
                <span class="flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    Galeri
                </span>
            </a>
            <a href="{{ url('/ppdb/info') }}" class="block px-4 py-3 rounded-lg text-sm font-bold {{ request()->is('ppdb*') ? 'bg-primary text-white' : 'text-primary bg-green-50' }}">
                <span class="flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    Info SPMB
                </span>
            </a>
            
            @auth('ppdb')
                <div class="border-t border-gray-200 pt-3 mt-3">
                    <div class="px-4 py-2 text-xs text-gray-500">
                        Login sebagai: <span class="font-semibold text-gray-700">{{ auth('ppdb')->user()->nama ?: 'Siswa' }}</span>
                    </div>
                    <a href="{{ route('ppdb.dashboard') }}" class="block px-4 py-3 rounded-lg text-sm font-medium {{ request()->routeIs('ppdb.dashboard') ? 'bg-primary text-white' : 'text-gray-700 hover:bg-gray-50' }}">
                        <span class="flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                            Dashboard
                        </span>
                    </a>
                    <a href="{{ route('ppdb.profil') }}" class="block px-4 py-3 rounded-lg text-sm font-medium {{ request()->routeIs('ppdb.profil') ? 'bg-primary text-white' : 'text-gray-700 hover:bg-gray-50' }}">
                        <span class="flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                            Profil Saya
                        </span>
                    </a>
                    <form action="{{ route('logout') }}" method="POST" class="mt-2">
                        @csrf
                        <button type="submit" class="block w-full text-left px-4 py-3 rounded-lg text-sm font-medium text-red-600 hover:bg-red-50">
                            <span class="flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                                Logout
                            </span>
                        </button>
                    </form>
                </div>
            @else
                <div class="border-t border-gray-200 pt-3 mt-3 space-y-2">
                    <a href="{{ url('/login') }}" class="block px-4 py-3 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 text-center border border-gray-200">
                        Login
                    </a>
                    <a href="{{ url('/ppdb/register') }}" class="block w-full text-center px-4 py-3 rounded-lg font-bold text-white bg-primary hover:bg-secondary">
                        Daftar Sekarang
                    </a>
                </div>
            @endauth
        </div>
    </div>
</header>
