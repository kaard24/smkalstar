<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel - SMK Al-Hidayah Lestari')</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#16a34a', // green-600
                        secondary: '#15803d', // green-700
                        accent: '#facc15', // yellow-400
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-gray-50 font-sans min-h-screen flex flex-col">
    <!-- Navbar -->
    <header class="bg-white shadow-sm sticky top-0 z-50">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo (Clickable to Dashboard) -->
                <a href="{{ route('admin.dashboard') }}" class="flex-shrink-0 flex items-center gap-2 hover:opacity-80 transition">
                    <img class="h-10 w-auto" src="{{ asset('images/logo.jpg') }}" alt="Logo">
                    <span class="font-bold text-xl text-primary tracking-tight">Admin Panel</span>
                </a>

                <!-- Desktop Menu -->
                <nav class="hidden md:flex space-x-1 items-center">
                    <!-- Data Pendaftar -->
                    <a href="{{ route('admin.pendaftar.index') }}" class="px-3 py-2 text-gray-700 hover:text-primary font-medium transition rounded-md hover:bg-gray-50 {{ request()->is('admin/pendaftar*') ? 'text-primary bg-primary/5' : '' }}">Data Pendaftar</a>

                    <!-- Profil Sekolah Dropdown -->
                    <div class="relative" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                        <button class="flex items-center gap-1 px-3 py-2 text-gray-700 hover:text-primary font-medium transition rounded-md hover:bg-gray-50 focus:outline-none {{ request()->is('admin/profil-sekolah*') ? 'text-primary bg-primary/5' : '' }}">
                            <span>Profil Sekolah</span>
                            <svg :class="{'rotate-180': open}" class="w-4 h-4 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        <div x-show="open" x-cloak
                             x-transition:enter="transition ease-out duration-100"
                             x-transition:enter-start="transform opacity-0 scale-95"
                             x-transition:enter-end="transform opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-75"
                             x-transition:leave-start="transform opacity-100 scale-100"
                             x-transition:leave-end="transform opacity-0 scale-95"
                             class="absolute left-0 mt-0 w-48 bg-white rounded-xl shadow-lg border border-gray-100 py-2 z-50">
                            <a href="{{ route('admin.profil-sekolah.sejarah') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-primary">Sejarah</a>
                            <a href="{{ route('admin.profil-sekolah.visi-misi') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-primary">Visi & Misi</a>
                            <a href="{{ route('admin.profil-sekolah.struktur') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-primary">Struktur Organisasi</a>
                            <a href="{{ route('admin.fasilitas.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-primary">Fasilitas</a>
                        </div>
                    </div>

                    <div class="relative" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                        <button class="flex items-center gap-1 px-3 py-2 text-gray-700 hover:text-primary font-medium transition rounded-md hover:bg-gray-50 focus:outline-none {{ request()->is('admin/jurusan*') || request()->is('admin/galeri*') ? 'text-primary bg-primary/5' : '' }}">
                            <span>Akademik</span>
                            <svg :class="{'rotate-180': open}" class="w-4 h-4 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        <div x-show="open" x-cloak
                             x-transition:enter="transition ease-out duration-100"
                             x-transition:enter-start="transform opacity-0 scale-95"
                             x-transition:enter-end="transform opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-75"
                             x-transition:leave-start="transform opacity-100 scale-100"
                             x-transition:leave-end="transform opacity-0 scale-95"
                             class="absolute left-0 mt-0 w-56 bg-white rounded-xl shadow-lg border border-gray-100 py-2 z-50">
                            <a href="{{ route('admin.jurusan.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-primary">Jurusan</a>
                            <a href="{{ route('admin.galeri.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-primary">Galeri</a>
                        </div>
                    </div>

                    <!-- Kesiswaan Dropdown -->
                    <div class="relative" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                        <button class="flex items-center gap-1 px-3 py-2 text-gray-700 hover:text-primary font-medium transition rounded-md hover:bg-gray-50 focus:outline-none {{ request()->is('admin/ekstrakurikuler*') || request()->is('admin/prestasi*') ? 'text-primary bg-primary/5' : '' }}">
                            <span>Kesiswaan</span>
                            <svg :class="{'rotate-180': open}" class="w-4 h-4 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        <div x-show="open" x-cloak
                             x-transition:enter="transition ease-out duration-100"
                             x-transition:enter-start="transform opacity-0 scale-95"
                             x-transition:enter-end="transform opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-75"
                             x-transition:leave-start="transform opacity-100 scale-100"
                             x-transition:leave-end="transform opacity-0 scale-95"
                             class="absolute left-0 mt-0 w-48 bg-white rounded-xl shadow-lg border border-gray-100 py-2 z-50">
                            <a href="{{ route('admin.ekstrakurikuler.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-primary">Ekstrakurikuler</a>
                            <a href="{{ route('admin.prestasi.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-primary">Prestasi</a>
                        </div>
                    </div>
                    
                    <!-- Berita -->
                    <a href="{{ route('admin.berita.index') }}" class="px-3 py-2 text-gray-700 hover:text-primary font-medium transition rounded-md hover:bg-gray-50 {{ request()->is('admin/berita*') ? 'text-primary bg-primary/5' : '' }}">Berita</a>
                </nav>

                <!-- User Profile / Logout -->
                <div class="hidden md:flex items-center space-x-4">
                    <div class="relative" x-data="{ open: false }" @click.away="open = false">
                        <button @click="open = !open" class="flex items-center gap-2 text-gray-700 hover:text-primary transition focus:outline-none">
                            <div class="w-9 h-9 bg-primary/10 rounded-full flex items-center justify-center border border-primary/20">
                                <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            </div>
                            <span class="font-medium text-sm">Administrator</span>
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
                             class="absolute right-0 mt-3 w-48 bg-white rounded-xl shadow-lg border border-gray-100 py-2 z-50">
                            <a href="{{ url('/') }}" target="_blank" class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-primary">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                                Lihat Website
                            </a>
                            <div class="border-t border-gray-100 my-1"></div>
                            <form action="{{ route('admin.logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="flex items-center gap-2 w-full px-4 py-2 text-sm text-red-600 hover:bg-red-50">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Mobile menu button -->
                <div class="md:hidden flex items-center">
                    <button type="button" class="text-gray-500 hover:text-gray-700 focus:outline-none" onclick="document.getElementById('admin-mobile-menu').classList.toggle('hidden')">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div class="hidden md:hidden bg-white border-t border-gray-100 overflow-y-auto max-h-[80vh]" id="admin-mobile-menu">
            <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
                <a href="{{ route('admin.pendaftar.index') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-primary hover:bg-gray-50">Data Pendaftar</a>
                
                <!-- Mobile Profil Sekolah -->
                <div x-data="{ open: false }">
                    <button @click="open = !open" class="flex w-full items-center justify-between px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-primary hover:bg-gray-50">
                        <span>Profil Sekolah</span>
                        <svg :class="{'rotate-180': open}" class="w-4 h-4 transition-transform text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    <div x-show="open" class="pl-4 space-y-1">
                        <a href="{{ route('admin.profil-sekolah.sejarah') }}" class="block px-3 py-2 rounded-md text-sm text-gray-600 hover:text-primary hover:bg-gray-50">Sejarah</a>
                        <a href="{{ route('admin.profil-sekolah.visi-misi') }}" class="block px-3 py-2 rounded-md text-sm text-gray-600 hover:text-primary hover:bg-gray-50">Visi & Misi</a>
                        <a href="{{ route('admin.profil-sekolah.struktur') }}" class="block px-3 py-2 rounded-md text-sm text-gray-600 hover:text-primary hover:bg-gray-50">Struktur Organisasi</a>
                        <a href="{{ route('admin.fasilitas.index') }}" class="block px-3 py-2 rounded-md text-sm text-gray-600 hover:text-primary hover:bg-gray-50">Fasilitas</a>
                    </div>
                </div>

                <!-- Mobile Akademik -->
                <div x-data="{ open: false }">
                    <button @click="open = !open" class="flex w-full items-center justify-between px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-primary hover:bg-gray-50">
                        <span>Akademik</span>
                        <svg :class="{'rotate-180': open}" class="w-4 h-4 transition-transform text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    <div x-show="open" class="pl-4 space-y-1">
                        <a href="{{ route('admin.jurusan.index') }}" class="block px-3 py-2 rounded-md text-sm text-gray-600 hover:text-primary hover:bg-gray-50">Jurusan</a>
                        <a href="{{ route('admin.galeri.index') }}" class="block px-3 py-2 rounded-md text-sm text-gray-600 hover:text-primary hover:bg-gray-50">Galeri</a>
                    </div>
                </div>

                <!-- Mobile Kesiswaan -->
                <div x-data="{ open: false }">
                    <button @click="open = !open" class="flex w-full items-center justify-between px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-primary hover:bg-gray-50">
                        <span>Kesiswaan</span>
                        <svg :class="{'rotate-180': open}" class="w-4 h-4 transition-transform text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    <div x-show="open" class="pl-4 space-y-1">
                        <a href="{{ route('admin.ekstrakurikuler.index') }}" class="block px-3 py-2 rounded-md text-sm text-gray-600 hover:text-primary hover:bg-gray-50">Ekstrakurikuler</a>
                        <a href="{{ route('admin.prestasi.index') }}" class="block px-3 py-2 rounded-md text-sm text-gray-600 hover:text-primary hover:bg-gray-50">Prestasi</a>
                    </div>
                </div>

                <a href="{{ route('admin.berita.index') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-primary hover:bg-gray-50">Berita</a>

                <div class="border-t border-gray-200 pt-3 mt-3">
                    <a href="{{ url('/') }}" target="_blank" class="block px-3 py-2 rounded-md text-base font-medium text-gray-600 hover:text-primary hover:bg-gray-50">Lihat Website</a>
                    <form action="{{ route('admin.logout') }}" method="POST" class="mt-2">
                        @csrf
                        <button type="submit" class="block w-full text-left px-3 py-2 rounded-md text-base font-medium text-red-600 hover:bg-red-50">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow container mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @yield('content')
    </main>

</body>
</html>

