<nav class="fixed bottom-0 left-0 z-50 w-full bg-white/95 backdrop-blur-lg border-t border-gray-200/80 shadow-[0_-8px_30px_-6px_rgba(0,0,0,0.1)] md:hidden" aria-label="Navigasi mobile" style="padding-bottom: max(env(safe-area-inset-bottom), 0px);">
    <?php if(auth()->guard('spmb')->check()): ?>
    
    <div class="grid h-16 grid-cols-4 mx-auto font-medium">
        
        <a href="<?php echo e(route('spmb.dashboard')); ?>" data-instant class="inline-flex flex-col items-center justify-center px-2 hover:bg-gray-50 group <?php echo e(request()->routeIs('spmb.dashboard') ? 'text-primary' : 'text-gray-500'); ?>">
            <svg class="w-6 h-6 mb-0.5 group-hover:text-primary <?php echo e(request()->routeIs('spmb.dashboard') ? 'text-primary' : 'text-gray-500'); ?>" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
            </svg>
            <span class="text-[10px] group-hover:text-primary <?php echo e(request()->routeIs('spmb.dashboard') ? 'text-primary' : 'text-gray-500'); ?>">Dashboard</span>
        </a>

        
        <a href="<?php echo e(route('spmb.status')); ?>" data-instant class="inline-flex flex-col items-center justify-center px-2 hover:bg-gray-50 group <?php echo e(request()->routeIs('spmb.status') ? 'text-primary' : 'text-gray-500'); ?>">
            <svg class="w-6 h-6 mb-0.5 group-hover:text-primary <?php echo e(request()->routeIs('spmb.status') ? 'text-primary' : 'text-gray-500'); ?>" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
            </svg>
            <span class="text-[10px] group-hover:text-primary <?php echo e(request()->routeIs('spmb.status') ? 'text-primary' : 'text-gray-500'); ?>">Status</span>
        </a>

        
        <a href="<?php echo e(route('spmb.berkas')); ?>" data-instant class="inline-flex flex-col items-center justify-center px-2 hover:bg-gray-50 group <?php echo e(request()->routeIs('spmb.berkas') ? 'text-primary' : 'text-gray-500'); ?>">
            <svg class="w-6 h-6 mb-0.5 group-hover:text-primary <?php echo e(request()->routeIs('spmb.berkas') ? 'text-primary' : 'text-gray-500'); ?>" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>
            <span class="text-[10px] group-hover:text-primary <?php echo e(request()->routeIs('spmb.berkas') ? 'text-primary' : 'text-gray-500'); ?>">Berkas</span>
        </a>

        
        <?php
            $navUser = auth('spmb')->user();
            $navFotoUrl = $navUser->foto && file_exists(public_path('storage/foto/' . $navUser->foto)) 
                ? asset('storage/foto/' . $navUser->foto) 
                : ($navUser->jk === 'P' ? asset('images/avatar-female.svg') : asset('images/avatar-male.svg'));
        ?>
        <a href="<?php echo e(route('spmb.profil')); ?>" data-instant class="inline-flex flex-col items-center justify-center px-2 hover:bg-gray-50 group <?php echo e(request()->routeIs('spmb.profil') ? 'text-primary' : 'text-gray-500'); ?>" aria-current="<?php echo e(request()->routeIs('spmb.profil') ? 'page' : 'false'); ?>">
            <div class="w-6 h-6 mb-0.5 rounded-full overflow-hidden border-2 <?php echo e(request()->routeIs('spmb.profil') ? 'border-primary' : 'border-gray-300'); ?>">
                <img src="<?php echo e($navFotoUrl); ?>" alt="Profil" class="w-full h-full object-cover">
            </div>
            <span class="text-[10px] group-hover:text-primary <?php echo e(request()->routeIs('spmb.profil') ? 'text-primary' : 'text-gray-500'); ?>">Profil</span>
        </a>
    </div>
    <?php else: ?>
    
    <div class="flex h-16 items-center justify-center font-medium">
        <div class="flex w-full max-w-sm items-center justify-around">
            
            <a href="<?php echo e(url('/')); ?>" data-instant class="inline-flex flex-col items-center justify-center w-20 py-2 hover:bg-gray-50 rounded-xl group <?php echo e(request()->is('/') ? 'text-primary' : 'text-gray-500'); ?>">
                <svg class="w-6 h-6 mb-0.5 group-hover:text-primary <?php echo e(request()->is('/') ? 'text-primary' : 'text-gray-500'); ?>" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                <span class="text-[10px] group-hover:text-primary <?php echo e(request()->is('/') ? 'text-primary' : 'text-gray-500'); ?>">Beranda</span>
            </a>

            
            <div class="relative" x-data="{ open: false }" @click.away="open = false">
                <button @click="open = !open" class="inline-flex flex-col items-center justify-center w-20 py-2 hover:bg-gray-50 rounded-xl <?php echo e(request()->is('spmb*') ? 'text-primary' : 'text-gray-500'); ?>">
                    <svg class="w-6 h-6 mb-0.5 <?php echo e(request()->is('spmb*') ? 'text-primary' : 'text-gray-500'); ?>" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span class="text-[10px] <?php echo e(request()->is('spmb*') ? 'text-primary' : 'text-gray-500'); ?>">SPMB</span>
                </button>
                
                <div x-show="open" x-cloak 
                     x-transition:enter="transition ease-out duration-100"
                     x-transition:enter-start="transform opacity-0 scale-95 translate-y-2"
                     x-transition:enter-end="transform opacity-100 scale-100 translate-y-0"
                     x-transition:leave="transition ease-in duration-75"
                     x-transition:leave-start="transform opacity-100 scale-100 translate-y-0"
                     x-transition:leave-end="transform opacity-0 scale-95 translate-y-2"
                     class="absolute bottom-full left-1/2 transform -translate-x-1/2 mb-2 w-48 bg-white rounded-xl shadow-lg border border-gray-200 py-2 z-50">
                    <a href="<?php echo e(url('/spmb/info')); ?>" class="flex items-center gap-3 px-4 py-3 text-sm text-gray-700 hover:bg-sky-50 hover:text-primary <?php echo e(request()->is('spmb/info') ? 'bg-sky-50 text-primary' : ''); ?>" @click="open = false">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Info SPMB
                    </a>
                    <a href="<?php echo e(route('spmb.kalender')); ?>" class="flex items-center gap-3 px-4 py-3 text-sm text-gray-700 hover:bg-sky-50 hover:text-primary <?php echo e(request()->is('spmb/kalender') ? 'bg-sky-50 text-primary' : ''); ?>" @click="open = false">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        Kalender Akademik
                    </a>
                    <a href="<?php echo e(route('spmb.pengumuman')); ?>" class="flex items-center gap-3 px-4 py-3 text-sm text-gray-700 hover:bg-sky-50 hover:text-primary <?php echo e(request()->is('spmb/pengumuman') ? 'bg-sky-50 text-primary' : ''); ?>" @click="open = false">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/>
                        </svg>
                        Cek Pengumuman
                    </a>
                </div>
            </div>

            
            <a href="<?php echo e(url('/login')); ?>" data-instant class="inline-flex flex-col items-center justify-center w-20 py-2 hover:bg-gray-50 rounded-xl group <?php echo e(request()->is('login') ? 'text-primary' : 'text-gray-500'); ?>" aria-current="<?php echo e(request()->is('login') ? 'page' : 'false'); ?>">
                <svg class="w-6 h-6 mb-0.5 group-hover:text-primary <?php echo e(request()->is('login') ? 'text-primary' : 'text-gray-500'); ?>" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                </svg>
                <span class="text-[10px] group-hover:text-primary <?php echo e(request()->is('login') ? 'text-primary' : 'text-gray-500'); ?>">Masuk</span>
            </a>
        </div>
    </div>
    <?php endif; ?>
</nav>

<style>
    /* Safe area padding for iPhone X and newer */
    @supports (padding-bottom: env(safe-area-inset-bottom)) {
        .safe-area-pb {
            padding-bottom: max(env(safe-area-inset-bottom), 8px);
        }
    }
    
    /* Ensure touch targets are at least 44px on mobile */
    @media (max-width: 768px) {
        nav a, nav button {
            min-height: 44px;
        }
    }
</style><?php /**PATH C:\Users\eka\.gemini\antigravity\scratch\smk-alstar\resources\views/partials/bottom-nav.blade.php ENDPATH**/ ?>