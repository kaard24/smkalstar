<header class="bg-white/95 backdrop-blur-md shadow-sm sticky top-0 z-50 border-b border-gray-100">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-14 md:h-16">
            <!-- Logo -->
            <div class="flex-shrink-0 flex items-center gap-2">
                <img class="h-10 w-auto rounded-full" src="{{ asset('images/logo.jpg') }}" alt="Logo SMK Al-Hidayah Lestari">
                <a href="{{ url('/') }}" class="font-bold text-base md:text-lg text-primary tracking-tight truncate max-w-[180px] md:max-w-none">
                    SMK Al-Hidayah
                </a>
            </div>

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
                🏠 Beranda
            </a>
            <a href="{{ url('/profil') }}" class="block px-4 py-3 rounded-lg text-sm font-medium {{ request()->is('profil') ? 'bg-primary text-white' : 'text-gray-700 hover:bg-gray-50' }}">
                🏫 Profil Sekolah
            </a>
            <a href="{{ url('/jurusan') }}" class="block px-4 py-3 rounded-lg text-sm font-medium {{ request()->is('jurusan') ? 'bg-primary text-white' : 'text-gray-700 hover:bg-gray-50' }}">
                🎓 Jurusan
            </a>
            <a href="{{ url('/fasilitas') }}" class="block px-4 py-3 rounded-lg text-sm font-medium {{ request()->is('fasilitas') ? 'bg-primary text-white' : 'text-gray-700 hover:bg-gray-50' }}">
                🏢 Fasilitas
            </a>
            <a href="{{ url('/ekstrakurikuler') }}" class="block px-4 py-3 rounded-lg text-sm font-medium {{ request()->is('ekstrakurikuler') ? 'bg-primary text-white' : 'text-gray-700 hover:bg-gray-50' }}">
                ⚽ Ekstrakurikuler
            </a>
            <a href="{{ url('/prestasi') }}" class="block px-4 py-3 rounded-lg text-sm font-medium {{ request()->is('prestasi') ? 'bg-primary text-white' : 'text-gray-700 hover:bg-gray-50' }}">
                🏆 Prestasi
            </a>
            <a href="{{ url('/berita') }}" class="block px-4 py-3 rounded-lg text-sm font-medium {{ request()->is('berita') ? 'bg-primary text-white' : 'text-gray-700 hover:bg-gray-50' }}">
                📰 Berita
            </a>
            <a href="{{ url('/ppdb/info') }}" class="block px-4 py-3 rounded-lg text-sm font-bold {{ request()->is('ppdb*') ? 'bg-primary text-white' : 'text-primary bg-green-50' }}">
                📝 Info SPMB
            </a>
            
            @auth('ppdb')
                <div class="border-t border-gray-200 pt-3 mt-3">
                    <div class="px-4 py-2 text-xs text-gray-500">
                        Login sebagai: <span class="font-semibold text-gray-700">{{ auth('ppdb')->user()->nama ?: 'Siswa' }}</span>
                    </div>
                    <a href="{{ route('ppdb.dashboard') }}" class="block px-4 py-3 rounded-lg text-sm font-medium {{ request()->routeIs('ppdb.dashboard') ? 'bg-primary text-white' : 'text-gray-700 hover:bg-gray-50' }}">
                        📊 Dashboard
                    </a>
                    <a href="{{ route('ppdb.profil') }}" class="block px-4 py-3 rounded-lg text-sm font-medium {{ request()->routeIs('ppdb.profil') ? 'bg-primary text-white' : 'text-gray-700 hover:bg-gray-50' }}">
                        👤 Profil Saya
                    </a>
                    <form action="{{ route('logout') }}" method="POST" class="mt-2">
                        @csrf
                        <button type="submit" class="block w-full text-left px-4 py-3 rounded-lg text-sm font-medium text-red-600 hover:bg-red-50">
                            🚪 Logout
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
