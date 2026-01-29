<div class="fixed bottom-0 left-0 z-50 w-full h-16 bg-white border-t border-gray-200 shadow-[0_-4px_6px_-1px_rgba(0,0,0,0.1)] md:hidden">
    <div class="grid h-full max-w-lg grid-cols-4 mx-auto font-medium">
        @auth('ppdb')
            {{-- Dashboard --}}
            <a href="{{ route('ppdb.dashboard') }}" class="inline-flex flex-col items-center justify-center px-5 hover:bg-gray-50 group {{ request()->routeIs('ppdb.dashboard') ? 'text-primary' : 'text-gray-500' }}">
                <svg class="w-6 h-6 mb-1 group-hover:text-primary {{ request()->routeIs('ppdb.dashboard') ? 'text-primary' : 'text-gray-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                </svg>
                <span class="text-[10px] group-hover:text-primary {{ request()->routeIs('ppdb.dashboard') ? 'text-primary' : 'text-gray-500' }}">Dashboard</span>
            </a>

            {{-- Status --}}
            <a href="{{ route('ppdb.status') }}" class="inline-flex flex-col items-center justify-center px-5 hover:bg-gray-50 group {{ request()->routeIs('ppdb.status') ? 'text-primary' : 'text-gray-500' }}">
                <svg class="w-6 h-6 mb-1 group-hover:text-primary {{ request()->routeIs('ppdb.status') ? 'text-primary' : 'text-gray-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                </svg>
                <span class="text-[10px] group-hover:text-primary {{ request()->routeIs('ppdb.status') ? 'text-primary' : 'text-gray-500' }}">Status</span>
            </a>

            {{-- Berkas --}}
            <a href="{{ route('ppdb.berkas') }}" class="inline-flex flex-col items-center justify-center px-5 hover:bg-gray-50 group {{ request()->routeIs('ppdb.berkas') ? 'text-primary' : 'text-gray-500' }}">
                 <svg class="w-6 h-6 mb-1 group-hover:text-primary {{ request()->routeIs('ppdb.berkas') ? 'text-primary' : 'text-gray-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                <span class="text-[10px] group-hover:text-primary {{ request()->routeIs('ppdb.berkas') ? 'text-primary' : 'text-gray-500' }}">Berkas</span>
            </a>

            {{-- Profil --}}
            <a href="{{ route('ppdb.profil') }}" class="inline-flex flex-col items-center justify-center px-5 hover:bg-gray-50 group {{ request()->routeIs('ppdb.profil') ? 'text-primary' : 'text-gray-500' }}">
                <svg class="w-6 h-6 mb-1 group-hover:text-primary {{ request()->routeIs('ppdb.profil') ? 'text-primary' : 'text-gray-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
                <span class="text-[10px] group-hover:text-primary {{ request()->routeIs('ppdb.profil') ? 'text-primary' : 'text-gray-500' }}">Profil</span>
            </a>
        @else
             {{-- Home --}}
             <a href="{{ url('/') }}" class="inline-flex flex-col items-center justify-center px-5 hover:bg-gray-50 group {{ request()->is('/') ? 'text-primary' : 'text-gray-500' }}">
                <svg class="w-6 h-6 mb-1 group-hover:text-primary {{ request()->is('/') ? 'text-primary' : 'text-gray-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                </svg>
                <span class="text-[10px] group-hover:text-primary {{ request()->is('/') ? 'text-primary' : 'text-gray-500' }}">Beranda</span>
            </a>

            {{-- Jurusan --}}
            <a href="{{ url('/jurusan') }}" class="inline-flex flex-col items-center justify-center px-5 hover:bg-gray-50 group {{ request()->is('jurusan') ? 'text-primary' : 'text-gray-500' }}">
                <svg class="w-6 h-6 mb-1 group-hover:text-primary {{ request()->is('jurusan') ? 'text-primary' : 'text-gray-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                </svg>
                <span class="text-[10px] group-hover:text-primary {{ request()->is('jurusan') ? 'text-primary' : 'text-gray-500' }}">Jurusan</span>
            </a>
            
            {{-- Info PPDB --}}
            <a href="{{ url('/ppdb/info') }}" class="inline-flex flex-col items-center justify-center px-5 hover:bg-gray-50 group {{ request()->is('ppdb/info') ? 'text-primary' : 'text-gray-500' }}">
                <svg class="w-6 h-6 mb-1 group-hover:text-primary {{ request()->is('ppdb/info') ? 'text-primary' : 'text-gray-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span class="text-[10px] group-hover:text-primary {{ request()->is('ppdb/info') ? 'text-primary' : 'text-gray-500' }}">Info SPMB</span>
            </a>

            {{-- Login/Daftar --}}
            <a href="{{ url('/login') }}" class="inline-flex flex-col items-center justify-center px-5 hover:bg-gray-50 group {{ request()->is('login') ? 'text-primary' : 'text-gray-500' }}">
                <svg class="w-6 h-6 mb-1 group-hover:text-primary {{ request()->is('login') ? 'text-primary' : 'text-gray-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                </svg>
                <span class="text-[10px] group-hover:text-primary {{ request()->is('login') ? 'text-primary' : 'text-gray-500' }}">Masuk</span>
            </a>
        @endauth
    </div>
</div>
