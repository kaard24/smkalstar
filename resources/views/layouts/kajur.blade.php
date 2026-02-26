<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Panel Kepala Jurusan - SMK Al-Hidayah')</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <!-- Alpine.js Collapse -->
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script>
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.plugin(collapse);
        });
    </script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#4276A3',
                    }
                }
            }
        }
    </script>
    
    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-slate-50 min-h-screen" x-data="{ mobileMenuOpen: false }">
    <!-- Header -->
    <header class="bg-[#1E293B] text-white sticky top-0 z-50">
        <div class="container mx-auto px-4">
            <div class="flex items-center justify-between h-16">
                {{-- Logo --}}
                <a href="{{ route('kajur.dashboard') }}" class="flex items-center gap-3 flex-shrink-0">
                    <div class="w-10 h-10 bg-[#4276A3] rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                    </div>
                    <div class="hidden sm:block">
                        <h1 class="font-bold text-base leading-tight">Kepala Jurusan</h1>
                        <p class="text-xs text-slate-400">Panel Pengelolaan</p>
                    </div>
                </a>

                {{-- Desktop Navigation --}}
                <nav class="hidden md:flex items-center gap-1">
                    <a href="{{ route('kajur.dashboard') }}" 
                       class="flex items-center gap-2 px-4 py-2 rounded-lg text-sm font-medium transition {{ request()->is('kajur/dashboard') ? 'bg-[#4276A3]/20 text-white border-l-2 border-[#4276A3]' : 'text-slate-300 hover:bg-white/5 hover:text-white' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                        Dashboard
                    </a>
                    <a href="{{ route('kajur.jurusan.edit') }}" 
                       class="flex items-center gap-2 px-4 py-2 rounded-lg text-sm font-medium transition {{ request()->is('kajur/jurusan*') ? 'bg-[#4276A3]/20 text-white border-l-2 border-[#4276A3]' : 'text-slate-300 hover:bg-white/5 hover:text-white' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                        Edit Jurusan
                    </a>
                </nav>

                {{-- User Menu & Mobile Toggle --}}
                <div class="flex items-center gap-3">
                    @php
                        $kajur = Auth::guard('kajur')->user();
                    @endphp
                    
                    {{-- User Info (Desktop) --}}
                    <div class="hidden lg:block text-right">
                        <p class="text-sm font-medium text-white truncate max-w-[150px]">{{ $kajur->nama }}</p>
                        <p class="text-xs text-slate-400 truncate max-w-[150px]">{{ $kajur->jurusan->nama ?? 'Tidak ada jurusan' }}</p>
                    </div>

                    {{-- Logout Button --}}
                    <form action="{{ route('kajur.logout') }}" method="POST" class="hidden sm:block">
                        @csrf
                        <button type="submit" class="flex items-center gap-2 px-3 py-2 bg-red-500/20 hover:bg-red-500/30 text-red-400 text-sm font-medium rounded-lg transition border border-red-500/30">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                            </svg>
                            <span>Keluar</span>
                        </button>
                    </form>

                    {{-- Mobile Menu Toggle --}}
                    <button @click="mobileMenuOpen = !mobileMenuOpen" 
                            class="md:hidden p-2 rounded-lg text-slate-300 hover:bg-white/10 hover:text-white transition">
                        <svg x-show="!mobileMenuOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                        <svg x-show="mobileMenuOpen" x-cloak class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        {{-- Mobile Navigation Dropdown --}}
        <div x-show="mobileMenuOpen" 
             x-cloak
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 -translate-y-2"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-2"
             class="md:hidden bg-[#1E293B] border-t border-[#334155]">
            <div class="container mx-auto px-4 py-3 space-y-1">
                {{-- User Info (Mobile) --}}
                <div class="sm:hidden px-4 py-3 border-b border-[#334155] mb-2">
                    <p class="text-sm font-medium text-white">{{ $kajur->nama }}</p>
                    <p class="text-xs text-slate-400">{{ $kajur->jurusan->nama ?? 'Tidak ada jurusan' }}</p>
                </div>

                <a href="{{ route('kajur.dashboard') }}" 
                   @click="mobileMenuOpen = false"
                   class="flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-medium {{ request()->is('kajur/dashboard') ? 'bg-[#4276A3]/20 text-white' : 'text-slate-300 hover:bg-white/5 hover:text-white' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    Dashboard
                </a>
                <a href="{{ route('kajur.jurusan.edit') }}" 
                   @click="mobileMenuOpen = false"
                   class="flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-medium {{ request()->is('kajur/jurusan*') ? 'bg-[#4276A3]/20 text-white' : 'text-slate-300 hover:bg-white/5 hover:text-white' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                    Edit Jurusan
                </a>

                {{-- Logout (Mobile) --}}
                <div class="sm:hidden border-t border-[#334155] pt-2 mt-2">
                    <form action="{{ route('kajur.logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-medium text-red-400 hover:bg-red-500/10 transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                            </svg>
                            Keluar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-6">
        @if(session('success'))
        <div class="mb-6 bg-green-100 border border-green-200 text-green-800 px-4 py-3 rounded-xl flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
            </svg>
            {{ session('success') }}
        </div>
        @endif

        @if(session('error'))
        <div class="mb-6 bg-red-100 border border-red-200 text-red-800 px-4 py-3 rounded-xl flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            {{ session('error') }}
        </div>
        @endif

        @yield('content')
    </main>

    @stack('scripts')
</body>
</html>
