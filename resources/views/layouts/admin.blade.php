<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel - SMK Al-Hidayah Lestari')</title>
    
    <!-- Vite Assets - Tailwind CSS & JS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <style>
        body { 
            font-family: 'Inter', sans-serif;
            font-size: 14px;
            line-height: 1.5;
        }
        [x-cloak] { display: none !important; }
        
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }
        ::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #555;
        }

        .btn {
            padding: 8px 16px;
            font-size: 14px;
            font-weight: 500;
            border-radius: 6px;
            transition: all 0.2s;
        }

        .input {
            padding: 10px 14px;
            font-size: 14px;
            border-radius: 6px;
            border: 1px solid #d1d5db;
        }
        .input:focus {
            outline: none;
            border-color: var(--color-primary);
            box-shadow: 0 0 0 3px rgba(22, 163, 74, 0.1);
        }

        .nav-item {
            padding: 10px 16px;
            font-size: 14px;
            font-weight: 500;
            border-radius: 6px;
            transition: all 0.2s;
        }

        .card {
            background: white;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            border: 1px solid #e5e7eb;
        }
        
        /* Admin specific color overrides */
        .text-primary { color: var(--color-primary); }
        .bg-primary { background-color: var(--color-primary); }
        .hover\:bg-primary:hover { background-color: var(--color-primary); }
        .border-primary { border-color: var(--color-primary); }
    </style>
</head>
<body class="bg-gray-50 font-sans min-h-screen">
    <!-- Header -->
    <header class="bg-white border-b border-gray-200 sticky top-0 z-50">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center h-16">
                <!-- Logo Sekolah -->
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 hover:opacity-80 transition">
                    <img src="{{ asset('images/logo.webp') }}" alt="Logo Sekolah" class="w-10 h-10 object-contain rounded" loading="lazy" decoding="async">
                    <div>
                        <span class="font-bold text-lg block leading-tight" style="color: var(--color-primary)">Admin Panel</span>
                        <span class="text-xs text-gray-500">SMK Al-Hidayah Lestari</span>
                    </div>
                </a>

                <!-- Desktop Navigation -->
                <nav class="hidden lg:flex items-center gap-1">
                    <a href="{{ route('admin.pendaftar.index') }}" 
                       class="nav-item flex items-center gap-2 {{ request()->is('admin/pendaftar*') ? 'bg-primary text-white' : 'text-gray-700 hover:bg-gray-100' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        Data Pendaftar
                    </a>

                    <a href="{{ route('admin.struktur-organisasi.index') }}" 
                       class="nav-item flex items-center gap-2 {{ request()->is('admin/struktur-organisasi*') ? 'bg-primary text-white' : 'text-gray-700 hover:bg-gray-100' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                        Struktur Organisasi
                    </a>

                    <a href="{{ route('admin.fasilitas.index') }}" 
                       class="nav-item flex items-center gap-2 {{ request()->is('admin/fasilitas*') ? 'bg-primary text-white' : 'text-gray-700 hover:bg-gray-100' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                        Fasilitas
                    </a>

                    <a href="{{ route('admin.berita.index') }}" 
                       class="nav-item flex items-center gap-2 {{ request()->is('admin/berita*') ? 'bg-primary text-white' : 'text-gray-700 hover:bg-gray-100' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                        </svg>
                        Berita
                    </a>

                    <!-- More Menu Dropdown -->
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" 
                                class="nav-item flex items-center gap-1 text-gray-700 hover:bg-gray-100">
                            <span>Lainnya</span>
                            <svg :class="{'rotate-180': open}" class="w-4 h-4 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        <div x-show="open" @click.away="open = false" x-cloak
                             class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-200 py-1 z-50">
                            <a href="{{ route('admin.ekstrakurikuler.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">
                                Ekstrakurikuler
                            </a>
                            <a href="{{ route('admin.prestasi.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">
                                Prestasi
                            </a>
                            <a href="{{ route('admin.galeri.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">
                                Galeri
                            </a>
                            <a href="{{ route('admin.jurusan.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">
                                Jurusan
                            </a>
                            <a href="{{ route('admin.profil-sekolah.sejarah') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">
                                Sejarah
                            </a>
                            <a href="{{ route('admin.profil-sekolah.visi-misi') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">
                                Visi Misi
                            </a>
                        </div>
                    </div>
                </nav>

                <!-- User Actions -->
                <div class="flex items-center gap-3">
                    <a href="{{ url('/') }}" target="_blank" 
                       class="hidden md:flex items-center gap-2 px-3 py-2 text-sm font-medium hover:bg-green-50 rounded-lg transition border"
                       style="color: var(--color-primary); border-color: var(--color-primary)">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                        Lihat Web
                    </a>
                    
                    <form action="{{ route('admin.logout') }}" method="POST" class="hidden md:block">
                        @csrf
                        <button type="submit" 
                                class="flex items-center gap-2 px-4 py-2 bg-red-600 text-white text-sm font-medium rounded-lg hover:bg-red-700 transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                            </svg>
                            Keluar
                        </button>
                    </form>

                    <!-- Mobile menu button -->
                    <button type="button" 
                            class="lg:hidden p-2 rounded-lg border border-gray-300 hover:border-primary hover:bg-green-50 transition"
                            onclick="document.getElementById('admin-mobile-menu').classList.toggle('hidden')">
                        <svg class="h-5 w-5 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div class="hidden lg:hidden bg-white border-t border-gray-200" id="admin-mobile-menu">
            <div class="px-4 py-3 space-y-1">
                <a href="{{ route('admin.pendaftar.index') }}" 
                   class="block px-4 py-2 rounded-lg text-sm font-medium {{ request()->is('admin/pendaftar*') ? 'text-white' : 'text-gray-700 hover:bg-gray-50' }}"
                   style="{{ request()->is('admin/pendaftar*') ? 'background-color: var(--color-primary)' : '' }}">
                    Data Pendaftar
                </a>
                <a href="{{ route('admin.struktur-organisasi.index') }}" 
                   class="block px-4 py-2 rounded-lg text-sm font-medium {{ request()->is('admin/struktur-organisasi*') ? 'text-white' : 'text-gray-700 hover:bg-gray-50' }}"
                   style="{{ request()->is('admin/struktur-organisasi*') ? 'background-color: var(--color-primary)' : '' }}">
                    Struktur Organisasi
                </a>
                <a href="{{ route('admin.fasilitas.index') }}" 
                   class="block px-4 py-2 rounded-lg text-sm font-medium {{ request()->is('admin/fasilitas*') ? 'text-white' : 'text-gray-700 hover:bg-gray-50' }}"
                   style="{{ request()->is('admin/fasilitas*') ? 'background-color: var(--color-primary)' : '' }}">
                    Fasilitas
                </a>
                <a href="{{ route('admin.berita.index') }}" 
                   class="block px-4 py-2 rounded-lg text-sm font-medium {{ request()->is('admin/berita*') ? 'text-white' : 'text-gray-700 hover:bg-gray-50' }}"
                   style="{{ request()->is('admin/berita*') ? 'background-color: var(--color-primary)' : '' }}">
                    Berita
                </a>
                <a href="{{ route('admin.ekstrakurikuler.index') }}" 
                   class="block px-4 py-2 rounded-lg text-sm font-medium {{ request()->is('admin/ekstrakurikuler*') ? 'text-white' : 'text-gray-700 hover:bg-gray-50' }}"
                   style="{{ request()->is('admin/ekstrakurikuler*') ? 'background-color: var(--color-primary)' : '' }}">
                    Ekstrakurikuler
                </a>
                <a href="{{ route('admin.prestasi.index') }}" 
                   class="block px-4 py-2 rounded-lg text-sm font-medium {{ request()->is('admin/prestasi*') ? 'text-white' : 'text-gray-700 hover:bg-gray-50' }}"
                   style="{{ request()->is('admin/prestasi*') ? 'background-color: var(--color-primary)' : '' }}">
                    Prestasi
                </a>
                <a href="{{ route('admin.galeri.index') }}" 
                   class="block px-4 py-2 rounded-lg text-sm font-medium {{ request()->is('admin/galeri*') ? 'text-white' : 'text-gray-700 hover:bg-gray-50' }}"
                   style="{{ request()->is('admin/galeri*') ? 'background-color: var(--color-primary)' : '' }}">
                    Galeri
                </a>
                <a href="{{ route('admin.jurusan.index') }}" 
                   class="block px-4 py-2 rounded-lg text-sm font-medium {{ request()->is('admin/jurusan*') ? 'text-white' : 'text-gray-700 hover:bg-gray-50' }}"
                   style="{{ request()->is('admin/jurusan*') ? 'background-color: var(--color-primary)' : '' }}">
                    Jurusan
                </a>
                <a href="{{ route('admin.profil-sekolah.sejarah') }}" 
                   class="block px-4 py-2 rounded-lg text-sm font-medium {{ request()->is('admin/profil-sekolah/sejarah*') ? 'text-white' : 'text-gray-700 hover:bg-gray-50' }}"
                   style="{{ request()->is('admin/profil-sekolah/sejarah*') ? 'background-color: var(--color-primary)' : '' }}">
                    Sejarah
                </a>
                <a href="{{ route('admin.profil-sekolah.visi-misi') }}" 
                   class="block px-4 py-2 rounded-lg text-sm font-medium {{ request()->is('admin/profil-sekolah/visi-misi*') ? 'text-white' : 'text-gray-700 hover:bg-gray-50' }}"
                   style="{{ request()->is('admin/profil-sekolah/visi-misi*') ? 'background-color: var(--color-primary)' : '' }}">
                    Visi Misi
                </a>

                <div class="border-t border-gray-200 pt-3 mt-3">
                    <a href="{{ url('/') }}" target="_blank" 
                       class="block px-4 py-2 rounded-lg text-sm font-medium hover:bg-green-50 mb-1"
                       style="color: var(--color-primary)">
                        Lihat Website
                    </a>
                    <form action="{{ route('admin.logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="block w-full px-4 py-2 rounded-lg text-sm font-medium text-white bg-red-600 text-left hover:bg-red-700">
                            Keluar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content Area -->
    <main class="container mx-auto px-4 py-6">
        @yield('content')
    </main>
</body>
</html>
