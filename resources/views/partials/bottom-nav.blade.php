<nav class="fixed bottom-0 left-0 z-50 w-full bg-white/95 backdrop-blur-lg border-t border-gray-200/80 shadow-[0_-8px_30px_-6px_rgba(0,0,0,0.1)] md:hidden safe-area-pb" aria-label="Navigasi mobile">
    <div class="grid h-16 grid-cols-4 mx-auto font-medium">
        @auth('ppdb')
            {{-- Dashboard --}}
            <a href="{{ route('ppdb.dashboard') }}" data-instant class="inline-flex flex-col items-center justify-center px-2 hover:bg-gray-50 group {{ request()->routeIs('ppdb.dashboard') ? 'text-primary' : 'text-gray-500' }}">
                <svg class="w-6 h-6 mb-0.5 group-hover:text-primary {{ request()->routeIs('ppdb.dashboard') ? 'text-primary' : 'text-gray-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                <span class="text-[10px] group-hover:text-primary {{ request()->routeIs('ppdb.dashboard') ? 'text-primary' : 'text-gray-500' }}">Dashboard</span>
            </a>

            {{-- Status --}}
            <a href="{{ route('ppdb.status') }}" data-instant class="inline-flex flex-col items-center justify-center px-2 hover:bg-gray-50 group {{ request()->routeIs('ppdb.status') ? 'text-primary' : 'text-gray-500' }}">
                <svg class="w-6 h-6 mb-0.5 group-hover:text-primary {{ request()->routeIs('ppdb.status') ? 'text-primary' : 'text-gray-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                </svg>
                <span class="text-[10px] group-hover:text-primary {{ request()->routeIs('ppdb.status') ? 'text-primary' : 'text-gray-500' }}">Status</span>
            </a>

            {{-- Berkas --}}
            <a href="{{ route('ppdb.berkas') }}" data-instant class="inline-flex flex-col items-center justify-center px-2 hover:bg-gray-50 group {{ request()->routeIs('ppdb.berkas') ? 'text-primary' : 'text-gray-500' }}">
                <svg class="w-6 h-6 mb-0.5 group-hover:text-primary {{ request()->routeIs('ppdb.berkas') ? 'text-primary' : 'text-gray-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                <span class="text-[10px] group-hover:text-primary {{ request()->routeIs('ppdb.berkas') ? 'text-primary' : 'text-gray-500' }}">Berkas</span>
            </a>

            {{-- Profil --}}
            @php
                $navUser = auth('ppdb')->user();
                $navFotoUrl = $navUser->foto && file_exists(public_path('storage/foto/' . $navUser->foto)) 
                    ? asset('storage/foto/' . $navUser->foto) 
                    : ($navUser->jk === 'P' ? asset('images/avatar-female.svg') : asset('images/avatar-male.svg'));
            @endphp
            <a href="{{ route('ppdb.profil') }}" data-instant class="inline-flex flex-col items-center justify-center px-2 hover:bg-gray-50 group {{ request()->routeIs('ppdb.profil') ? 'text-primary' : 'text-gray-500' }}" aria-current="{{ request()->routeIs('ppdb.profil') ? 'page' : 'false' }}">
                <div class="w-6 h-6 mb-0.5 rounded-full overflow-hidden border-2 {{ request()->routeIs('ppdb.profil') ? 'border-primary' : 'border-gray-300' }}">
                    <img src="{{ $navFotoUrl }}" alt="Profil" class="w-full h-full object-cover">
                </div>
                <span class="text-[10px] group-hover:text-primary {{ request()->routeIs('ppdb.profil') ? 'text-primary' : 'text-gray-500' }}">Profil</span>
            </a>
        @else
            {{-- Home --}}
            <a href="{{ url('/') }}" data-instant class="inline-flex flex-col items-center justify-center px-2 hover:bg-gray-50 group {{ request()->is('/') ? 'text-primary' : 'text-gray-500' }}">
                <svg class="w-6 h-6 mb-0.5 group-hover:text-primary {{ request()->is('/') ? 'text-primary' : 'text-gray-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                <span class="text-[10px] group-hover:text-primary {{ request()->is('/') ? 'text-primary' : 'text-gray-500' }}">Beranda</span>
            </a>

            {{-- Jurusan --}}
            <a href="{{ url('/jurusan') }}" data-instant class="inline-flex flex-col items-center justify-center px-2 hover:bg-gray-50 group {{ request()->is('jurusan') ? 'text-primary' : 'text-gray-500' }}">
                <svg class="w-6 h-6 mb-0.5 group-hover:text-primary {{ request()->is('jurusan') ? 'text-primary' : 'text-gray-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                </svg>
                <span class="text-[10px] group-hover:text-primary {{ request()->is('jurusan') ? 'text-primary' : 'text-gray-500' }}">Jurusan</span>
            </a>
            
            {{-- Info SPMB --}}
            <a href="{{ url('/ppdb/info') }}" data-instant class="inline-flex flex-col items-center justify-center px-2 hover:bg-gray-50 group {{ request()->is('ppdb/info') ? 'text-primary' : 'text-gray-500' }}">
                <svg class="w-6 h-6 mb-0.5 group-hover:text-primary {{ request()->is('ppdb/info') ? 'text-primary' : 'text-gray-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <span class="text-[10px] group-hover:text-primary {{ request()->is('ppdb/info') ? 'text-primary' : 'text-gray-500' }}">Info SPMB</span>
            </a>

            {{-- Login/Daftar --}}
            <a href="{{ url('/login') }}" data-instant class="inline-flex flex-col items-center justify-center px-2 hover:bg-gray-50 group {{ request()->is('login') ? 'text-primary' : 'text-gray-500' }}" aria-current="{{ request()->is('login') ? 'page' : 'false' }}">
                <svg class="w-6 h-6 mb-0.5 group-hover:text-primary {{ request()->is('login') ? 'text-primary' : 'text-gray-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                </svg>
                <span class="text-[10px] group-hover:text-primary {{ request()->is('login') ? 'text-primary' : 'text-gray-500' }}">Masuk</span>
            </a>
        @endauth
    </div>
</nav>

<style>
    /* Safe area padding for iPhone X and newer */
    @supports (padding-bottom: env(safe-area-inset-bottom)) {
        .safe-area-pb {
            padding-bottom: env(safe-area-inset-bottom);
        }
    }
</style>
