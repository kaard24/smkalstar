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
                        primary: '#15803d',      // green-700 - lebih gelap untuk kontras
                        secondary: '#166534',    // green-800
                        accent: '#ca8a04',       // yellow-600 - lebih terlihat
                    },
                    fontFamily: {
                        sans: ['Segoe UI', 'Tahoma', 'Geneva', 'Verdana', 'sans-serif'],
                    },
                    fontSize: {
                        'xxl': '1.5rem',
                        '3xl': '2rem',
                    }
                }
            }
        }
    </script>
    <style>
        body { 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: 17px;
            line-height: 1.6;
        }
        [x-cloak] { display: none !important; }
        
        /* Custom scrollbar yang lebih besar */
        ::-webkit-scrollbar {
            width: 12px;
            height: 12px;
        }
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }
        ::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 6px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #555;
        }

        /* Tombol lebih besar */
        .btn-large {
            padding: 14px 28px;
            font-size: 16px;
            font-weight: 600;
            border-radius: 8px;
            min-height: 48px;
        }

        /* Input lebih besar */
        .input-large {
            padding: 14px 18px;
            font-size: 17px;
            min-height: 52px;
        }

        /* Nav item lebih besar */
        .nav-item {
            padding: 16px 20px;
            font-size: 17px;
            font-weight: 600;
        }

        /* Card dengan shadow lebih jelas */
        .card-solid {
            border: 2px solid #e5e7eb;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }

        /* Hover state yang jelas */
        .hover-clear:hover {
            background-color: #dcfce7;
            border-color: #15803d;
        }

        /* Status badge yang lebih besar */
        .badge-large {
            padding: 8px 16px;
            font-size: 15px;
            font-weight: 700;
            border-radius: 9999px;
        }
    </style>
</head>
<body class="bg-gray-100 font-sans min-h-screen flex flex-col">
    <!-- Top Navbar - Simplified -->
    <header class="bg-white border-b-4 border-primary sticky top-0 z-50">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <!-- Logo -->
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 hover:opacity-80 transition">
                    <div class="w-12 h-12 bg-primary rounded-lg flex items-center justify-center">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                    </div>
                    <div>
                        <span class="font-bold text-2xl text-primary block leading-tight">Admin Panel</span>
                        <span class="text-sm text-gray-500">SMK Al-Hidayah Lestari</span>
                    </div>
                </a>

                <!-- Desktop Navigation - Simple Horizontal -->
                <nav class="hidden lg:flex items-center gap-2">
                    <a href="{{ route('admin.pendaftar.index') }}" 
                       class="nav-item rounded-lg transition flex items-center gap-2
                       {{ request()->is('admin/pendaftar*') ? 'bg-primary text-white' : 'text-gray-700 hover:bg-green-100' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                        Data Pendaftar
                    </a>

                    <a href="{{ route('admin.jurusan.index') }}" 
                       class="nav-item rounded-lg transition flex items-center gap-2
                       {{ request()->is('admin/jurusan*') ? 'bg-primary text-white' : 'text-gray-700 hover:bg-green-100' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>
                        </svg>
                        Jurusan
                    </a>

                    <a href="{{ route('admin.fasilitas.index') }}" 
                       class="nav-item rounded-lg transition flex items-center gap-2
                       {{ request()->is('admin/fasilitas*') ? 'bg-primary text-white' : 'text-gray-700 hover:bg-green-100' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                        Fasilitas
                    </a>

                    <a href="{{ route('admin.berita.index') }}" 
                       class="nav-item rounded-lg transition flex items-center gap-2
                       {{ request()->is('admin/berita*') ? 'bg-primary text-white' : 'text-gray-700 hover:bg-green-100' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                        </svg>
                        Berita
                    </a>

                    <!-- More Menu Dropdown -->
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" 
                                class="nav-item rounded-lg transition flex items-center gap-2 text-gray-700 hover:bg-green-100">
                            <span>Lainnya</span>
                            <svg :class="{'rotate-180': open}" class="w-5 h-5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        <div x-show="open" @click.away="open = false" x-cloak
                             class="absolute right-0 mt-2 w-64 bg-white rounded-xl shadow-xl border-2 border-gray-200 py-2 z-50">
                            <a href="{{ route('admin.ekstrakurikuler.index') }}" class="block px-5 py-3 text-gray-700 hover:bg-green-50 hover:text-primary text-base font-medium border-b border-gray-100">
                                Ekstrakurikuler
                            </a>
                            <a href="{{ route('admin.prestasi.index') }}" class="block px-5 py-3 text-gray-700 hover:bg-green-50 hover:text-primary text-base font-medium border-b border-gray-100">
                                Prestasi
                            </a>
                            <a href="{{ route('admin.galeri.index') }}" class="block px-5 py-3 text-gray-700 hover:bg-green-50 hover:text-primary text-base font-medium border-b border-gray-100">
                                Galeri
                            </a>
                            <a href="{{ route('admin.profil-sekolah.sejarah') }}" class="block px-5 py-3 text-gray-700 hover:bg-green-50 hover:text-primary text-base font-medium">
                                Profil Sekolah
                            </a>
                        </div>
                    </div>
                </nav>

                <!-- User Actions -->
                <div class="flex items-center gap-4">
                    <a href="{{ url('/') }}" target="_blank" 
                       class="hidden md:flex items-center gap-2 px-4 py-2 text-primary font-semibold hover:bg-green-50 rounded-lg transition border-2 border-primary">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                        <span>Lihat Web</span>
                    </a>
                    
                    <form action="{{ route('admin.logout') }}" method="POST" class="hidden md:block">
                        @csrf
                        <button type="submit" 
                                class="flex items-center gap-2 px-5 py-3 bg-red-600 text-white font-bold rounded-lg hover:bg-red-700 transition btn-large">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                            </svg>
                            Keluar
                        </button>
                    </form>

                    <!-- Mobile menu button -->
                    <button type="button" 
                            class="lg:hidden p-3 rounded-lg border-2 border-gray-300 hover:border-primary hover:bg-green-50 transition"
                            onclick="document.getElementById('admin-mobile-menu').classList.toggle('hidden')">
                        <svg class="h-7 w-7 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu - Large & Clear -->
        <div class="hidden lg:hidden bg-white border-t-2 border-gray-200" id="admin-mobile-menu">
            <div class="px-4 py-4 space-y-2">
                <a href="{{ route('admin.pendaftar.index') }}" 
                   class="block px-5 py-4 rounded-xl text-lg font-bold {{ request()->is('admin/pendaftar*') ? 'bg-primary text-white' : 'text-gray-700 bg-gray-50' }}">
                    📋 Data Pendaftar
                </a>
                <a href="{{ route('admin.jurusan.index') }}" 
                   class="block px-5 py-4 rounded-xl text-lg font-bold {{ request()->is('admin/jurusan*') ? 'bg-primary text-white' : 'text-gray-700 bg-gray-50' }}">
                    🎓 Jurusan
                </a>
                <a href="{{ route('admin.fasilitas.index') }}" 
                   class="block px-5 py-4 rounded-xl text-lg font-bold {{ request()->is('admin/fasilitas*') ? 'bg-primary text-white' : 'text-gray-700 bg-gray-50' }}">
                    🏢 Fasilitas
                </a>
                <a href="{{ route('admin.berita.index') }}" 
                   class="block px-5 py-4 rounded-xl text-lg font-bold {{ request()->is('admin/berita*') ? 'bg-primary text-white' : 'text-gray-700 bg-gray-50' }}">
                    📰 Berita
                </a>
                <a href="{{ route('admin.ekstrakurikuler.index') }}" 
                   class="block px-5 py-4 rounded-xl text-lg font-bold {{ request()->is('admin/ekstrakurikuler*') ? 'bg-primary text-white' : 'text-gray-700 bg-gray-50' }}">
                    ⚽ Ekstrakurikuler
                </a>
                <a href="{{ route('admin.prestasi.index') }}" 
                   class="block px-5 py-4 rounded-xl text-lg font-bold {{ request()->is('admin/prestasi*') ? 'bg-primary text-white' : 'text-gray-700 bg-gray-50' }}">
                    🏆 Prestasi
                </a>
                <a href="{{ route('admin.galeri.index') }}" 
                   class="block px-5 py-4 rounded-xl text-lg font-bold {{ request()->is('admin/galeri*') ? 'bg-primary text-white' : 'text-gray-700 bg-gray-50' }}">
                    🖼️ Galeri
                </a>
                <a href="{{ route('admin.profil-sekolah.sejarah') }}" 
                   class="block px-5 py-4 rounded-xl text-lg font-bold {{ request()->is('admin/profil-sekolah*') ? 'bg-primary text-white' : 'text-gray-700 bg-gray-50' }}">
                    🏫 Profil Sekolah
                </a>

                <div class="border-t-2 border-gray-200 pt-4 mt-4">
                    <a href="{{ url('/') }}" target="_blank" 
                       class="block px-5 py-4 rounded-xl text-lg font-bold text-primary bg-green-50 mb-2">
                        👁️ Lihat Website
                    </a>
                    <form action="{{ route('admin.logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="block w-full px-5 py-4 rounded-xl text-lg font-bold text-white bg-red-600 text-left">
                            🚪 Keluar / Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content Area -->
    <main class="flex-grow container mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @yield('content')
    </main>

    <!-- Simple Footer -->
    <footer class="bg-white border-t-2 border-gray-200 py-6 mt-auto">
        <div class="container mx-auto px-4 text-center">
            <p class="text-gray-600 font-medium text-lg">
                © {{ date('Y') }} SMK Al-Hidayah Lestari - Panel Administrasi
            </p>
            <p class="text-gray-500 mt-1">
                Butuh bantuan? Hubungi tim IT sekolah
            </p>
        </div>
    </footer>
</body>
</html>
