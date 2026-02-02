<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title', 'Admin Panel - SMK Al-Hidayah Lestari'); ?></title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        /* ============================================
                           SET B: MODERN ENTERPRISE PALETTE
                           ============================================ */
                        // Base Scale (Grays) - Slate
                        'slate-50': '#F8FAFC',
                        'slate-100': '#F1F5F9',
                        'slate-200': '#E2E8F0',
                        'slate-300': '#CBD5E1',
                        'slate-400': '#94A3B8',
                        'slate-500': '#64748B',
                        'slate-600': '#475569',
                        'slate-700': '#334155',  // Primary
                        'slate-800': '#1E293B',  // Text utama
                        'slate-900': '#0F172A',  // Heading
                        
                        // The Only Pop Color - Steel Blue (Accent)
                        'brand-steel': '#4276A3',
                        'brand-steel-light': '#9CBCDA',
                        'brand-steel-dark': '#365f85',
                        
                        // Semantic Colors (Muted)
                        'success': '#047857',    // Emerald-700 darkened
                        'warning': '#B45309',    // Amber-700
                        'danger': '#991B1B',     // Red-800 darkened
                        
                        // Legacy aliases for compatibility
                        'primary': '#4276A3',
                        'primary-light': 'rgba(66, 118, 163, 0.1)',
                        'navy': '#334155',
                        'charcoal': '#1E293B',
                        'cool-gray': '#F8FAFC',
                        'border-gray': '#E2E8F0',
                        'text-secondary': '#64748B',
                    }
                }
            }
        }
    </script>
    
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        
        /* ============================================
           BASE STYLES - SET B: MODERN ENTERPRISE
           ============================================ */
        body { 
            font-family: 'Inter', system-ui, sans-serif;
            font-size: 14px;
            line-height: 1.5;
            background: #F8FAFC;  /* Slate-50 */
            min-height: 100vh;
            color: #1E293B;  /* Slate-800 - bukan hitam murni */
        }
        
        [x-cloak] { display: none !important; }
        
        /* ============================================
           SCROLLBAR - Subtle dengan brand color
           ============================================ */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #F8FAFC;
        }
        ::-webkit-scrollbar-thumb {
            background: #94A3B8;  /* Slate-400 */
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #64748B;  /* Slate-500 */
        }

        /* ============================================
           NAVIGATION ITEMS
           ============================================ */
        .nav-item {
            padding: 10px 16px;
            font-size: 14px;
            font-weight: 500;
            border-radius: 8px;
            transition: all 0.2s ease;
        }

        /* ============================================
           CARDS - Clean dengan shadow subtle
           ============================================ */
        .card {
            background: #FFFFFF;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(51, 65, 85, 0.08);  /* Slate-700 with low opacity */
            border: 1px solid #E2E8F0;  /* Slate-200 */
            transition: all 0.2s ease;
        }
        .card:hover {
            box-shadow: 0 4px 6px rgba(51, 65, 85, 0.05), 0 2px 4px rgba(51, 65, 85, 0.03);
            transform: translateY(-1px);
        }

        .stat-card {
            background: #FFFFFF;
            border-left: 4px solid #4276A3;  /* Brand accent */
            border: 1px solid #E2E8F0;
        }

        /* ============================================
           BUTTON STYLES - MUTED & PROFESSIONAL
           ============================================ */
        
        /* Base Button */
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            padding: 0.625rem 1.25rem;
            font-size: 0.875rem;
            font-weight: 500;
            border-radius: 0.5rem;
            transition: all 0.2s ease-in-out;
            border: none;
            cursor: pointer;
            white-space: nowrap;
            line-height: 1.25;
        }
        .btn:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }
        .btn:active {
            transform: translateY(1px);
        }
        
        /* Button Sizes */
        .btn-sm {
            padding: 0.375rem 0.75rem;
            font-size: 0.75rem;
            border-radius: 0.375rem;
            gap: 0.375rem;
        }
        .btn-lg {
            padding: 0.875rem 1.75rem;
            font-size: 1rem;
            border-radius: 0.625rem;
            gap: 0.625rem;
        }
        
        /* Primary Button - Brand Steel (Satu-satunya warna pop) */
        .btn-primary {
            background: #4276A3;
            color: white;
            box-shadow: 0 1px 2px rgba(51, 65, 85, 0.1);
        }
        .btn-primary:hover {
            background: #365f85;  /* brand-steel-dark */
            box-shadow: 0 2px 4px rgba(51, 65, 85, 0.15);
        }
        
        /* Secondary Button - Slate Gray */
        .btn-secondary {
            background: #F1F5F9;  /* Slate-100 */
            color: #475569;  /* Slate-600 */
            border: 1px solid #E2E8F0;  /* Slate-200 */
        }
        .btn-secondary:hover {
            background: #E2E8F0;  /* Slate-200 */
            color: #334155;  /* Slate-700 */
        }
        
        /* Success Button - Muted Emerald (hanya untuk success status) */
        .btn-success {
            background: #047857;  /* Emerald-700 */
            color: white;
            box-shadow: 0 1px 2px rgba(4, 120, 87, 0.2);
        }
        .btn-success:hover {
            background: #065f46;  /* Emerald-800 */
        }
        
        /* Danger Button - Soft Red (hanya untuk destructive actions) */
        .btn-danger {
            background: #991B1B;  /* Red-800 */
            color: white;
            box-shadow: 0 1px 2px rgba(153, 27, 27, 0.2);
        }
        .btn-danger:hover {
            background: #7f1d1d;  /* Red-900 */
        }
        
        /* Warning Button - Muted Amber */
        .btn-warning {
            background: #B45309;  /* Amber-700 */
            color: white;
            box-shadow: 0 1px 2px rgba(180, 83, 9, 0.2);
        }
        .btn-warning:hover {
            background: #92400e;  /* Amber-800 */
        }
        
        /* Info Button - Brand dengan opacity */
        .btn-info {
            background: rgba(66, 118, 163, 0.1);
            color: #4276A3;
            border: 1px solid rgba(66, 118, 163, 0.2);
        }
        .btn-info:hover {
            background: rgba(66, 118, 163, 0.15);
        }
        
        /* Outline Button Variants */
        .btn-outline-primary {
            background: transparent;
            color: #4276A3;
            border: 1.5px solid #4276A3;
        }
        .btn-outline-primary:hover {
            background: rgba(66, 118, 163, 0.08);
        }
        
        /* Ghost Button - Untuk actions sekunder */
        .btn-ghost {
            background: transparent;
            color: #64748B;  /* Slate-500 */
        }
        .btn-ghost:hover {
            background: #F1F5F9;  /* Slate-100 */
            color: #334155;  /* Slate-700 */
        }
        
        /* ============================================
           ACTION BUTTON ICONS - Table Actions
           ============================================ */
        .btn-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 2.25rem;
            height: 2.25rem;
            border-radius: 0.5rem;
            transition: all 0.2s ease-in-out;
            border: none;
            cursor: pointer;
        }
        .btn-icon-sm {
            width: 1.875rem;
            height: 1.875rem;
            border-radius: 0.375rem;
        }
        .btn-icon-lg {
            width: 2.75rem;
            height: 2.75rem;
            border-radius: 0.625rem;
        }
        
        /* View - Brand Steel */
        .btn-icon-view {
            background: rgba(66, 118, 163, 0.1);
            color: #4276A3;
        }
        .btn-icon-view:hover {
            background: #4276A3;
            color: white;
        }
        
        /* Edit - Slate (bukan orange/amber yang terlalu teriak) */
        .btn-icon-edit {
            background: rgba(100, 116, 139, 0.1);  /* Slate-500 */
            color: #64748B;
        }
        .btn-icon-edit:hover {
            background: #64748B;
            color: white;
        }
        
        /* Delete - Red muted */
        .btn-icon-delete {
            background: rgba(153, 27, 27, 0.08);
            color: #991B1B;
        }
        .btn-icon-delete:hover {
            background: #991B1B;
            color: white;
        }
        
        /* ============================================
           TEXT BUTTON
           ============================================ */
        .btn-text {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 0.75rem;
            font-size: 0.875rem;
            font-weight: 500;
            border-radius: 0.375rem;
            transition: all 0.2s ease-in-out;
            background: transparent;
            border: none;
            cursor: pointer;
        }
        .btn-text-primary {
            color: #4276A3;
        }
        .btn-text-primary:hover {
            background: rgba(66, 118, 163, 0.08);
        }
        
        /* ============================================
           BUTTON GROUP
           ============================================ */
        .btn-group {
            display: inline-flex;
            gap: 0.5rem;
            flex-wrap: wrap;
        }

        /* ============================================
           WELCOME BANNER - Flat design (no gradient)
           ============================================ */
        .welcome-banner {
            background: #334155;  /* Slate-700 */
            position: relative;
            overflow: hidden;
        }
        .welcome-banner::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -10%;
            width: 400px;
            height: 400px;
            background: rgba(66, 118, 163, 0.1);  /* Brand dengan opacity */
            border-radius: 50%;
        }
        .welcome-banner::after {
            content: '';
            position: absolute;
            bottom: -30%;
            left: -5%;
            width: 300px;
            height: 300px;
            background: rgba(255, 255, 255, 0.03);
            border-radius: 50%;
        }

        /* ============================================
           TABLE STYLES - Data display
           ============================================ */
        .data-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
        }
        .data-table th {
            background: #F8FAFC;  /* Slate-50 */
            color: #475569;  /* Slate-600 */
            font-weight: 600;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            padding: 0.75rem 1rem;
            border-bottom: 1px solid #E2E8F0;
            text-align: left;
        }
        .data-table td {
            padding: 1rem;
            border-bottom: 1px solid #E2E8F0;
            color: #334155;  /* Slate-700 */
            font-size: 0.875rem;
        }
        .data-table tr:hover td {
            background: rgba(66, 118, 163, 0.03);  /* Brand dengan opacity sangat rendah */
        }
        
        /* ============================================
           STATUS BADGES
           ============================================ */
        .badge {
            display: inline-flex;
            align-items: center;
            gap: 0.375rem;
            padding: 0.25rem 0.625rem;
            border-radius: 0.375rem;
            font-size: 0.75rem;
            font-weight: 600;
        }
        
        .badge-success {
            background: rgba(4, 120, 87, 0.1);  /* Success dengan 10% opacity */
            color: #047857;
            border: 1px solid rgba(4, 120, 87, 0.2);
        }
        
        .badge-warning {
            background: rgba(180, 83, 9, 0.1);
            color: #B45309;
            border: 1px solid rgba(180, 83, 9, 0.2);
        }
        
        .badge-danger {
            background: rgba(153, 27, 27, 0.1);
            color: #991B1B;
            border: 1px solid rgba(153, 27, 27, 0.2);
        }
        
        .badge-info {
            background: rgba(66, 118, 163, 0.1);
            color: #4276A3;
            border: 1px solid rgba(66, 118, 163, 0.2);
        }
        
        .badge-secondary {
            background: #F1F5F9;
            color: #64748B;
            border: 1px solid #E2E8F0;
        }

        /* ============================================
           FORM ELEMENTS
           ============================================ */
        .form-input {
            width: 100%;
            padding: 0.625rem 0.875rem;
            border: 1px solid #E2E8F0;
            border-radius: 0.5rem;
            font-size: 0.875rem;
            transition: all 0.2s ease;
            background: white;
            color: #334155;
        }
        .form-input:focus {
            border-color: #4276A3;
            box-shadow: 0 0 0 3px rgba(66, 118, 163, 0.1);
            outline: none;
        }
        .form-input::placeholder {
            color: #94A3B8;  /* Slate-400 */
        }
        
        .form-label {
            display: block;
            font-size: 0.875rem;
            font-weight: 500;
            color: #334155;  /* Slate-700 */
            margin-bottom: 0.375rem;
        }
        
        .form-error {
            font-size: 0.75rem;
            color: #991B1B;
            margin-top: 0.25rem;
        }

        /* ============================================
           SELECTION & FOCUS
           ============================================ */
        ::selection {
            background-color: rgba(66, 118, 163, 0.2);
            color: #1E293B;
        }
        
        *:focus-visible {
            outline: 2px solid #4276A3;
            outline-offset: 2px;
        }
    </style>
</head>
<body class="font-sans min-h-screen">
    <!-- Header -->
    <header class="bg-[#334155] border-b border-[#475569] sticky top-0 z-50">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center h-16">
                <!-- Logo Sekolah -->
                <a href="<?php echo e(route('admin.dashboard')); ?>" class="flex items-center gap-3 hover:opacity-80 transition">
                    <div class="w-10 h-10 bg-white/10 rounded-lg flex items-center justify-center">
                        <img src="<?php echo e(asset('images/logo.webp')); ?>" alt="Logo" class="w-8 h-8 object-contain rounded" loading="lazy">
                    </div>
                    <div>
                        <span class="font-bold text-lg block leading-tight text-white">Admin Panel</span>
                        <span class="text-xs text-slate-400">SMK Al-Hidayah Lestari</span>
                    </div>
                </a>

                <!-- Desktop Navigation -->
                <nav class="hidden lg:flex items-center gap-1">
                    <a href="<?php echo e(route('admin.pendaftar.index')); ?>" 
                       class="nav-item flex items-center gap-2 <?php echo e(request()->is('admin/pendaftar*') ? 'bg-[#4276A3]/20 text-white border-l-2 border-[#4276A3]' : 'text-slate-300 hover:bg-white/5 hover:text-white'); ?>">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        Data Pendaftar
                    </a>

                    <a href="<?php echo e(route('admin.struktur-organisasi.index')); ?>" 
                       class="nav-item flex items-center gap-2 <?php echo e(request()->is('admin/struktur-organisasi*') ? 'bg-[#4276A3]/20 text-white border-l-2 border-[#4276A3]' : 'text-slate-300 hover:bg-white/5 hover:text-white'); ?>">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                        Struktur
                    </a>

                    <a href="<?php echo e(route('admin.fasilitas.index')); ?>" 
                       class="nav-item flex items-center gap-2 <?php echo e(request()->is('admin/fasilitas*') ? 'bg-[#4276A3]/20 text-white border-l-2 border-[#4276A3]' : 'text-slate-300 hover:bg-white/5 hover:text-white'); ?>">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                        Fasilitas
                    </a>

                    <a href="<?php echo e(route('admin.berita.index')); ?>" 
                       class="nav-item flex items-center gap-2 <?php echo e(request()->is('admin/berita*') ? 'bg-[#4276A3]/20 text-white border-l-2 border-[#4276A3]' : 'text-slate-300 hover:bg-white/5 hover:text-white'); ?>">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                        </svg>
                        Berita
                    </a>

                    <!-- More Menu Dropdown -->
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" 
                                class="nav-item flex items-center gap-1 text-slate-300 hover:bg-white/5 hover:text-white">
                            <span>Lainnya</span>
                            <svg :class="{'rotate-180': open}" class="w-4 h-4 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        <div x-show="open" @click.away="open = false" x-cloak
                             class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-[#E2E8F0] py-2 z-50 overflow-hidden">
                            <a href="<?php echo e(route('admin.ekstrakurikuler.index')); ?>" class="block px-4 py-2 text-sm text-[#64748B] hover:bg-[#F8FAFC] hover:text-[#334155] transition">
                                Ekstrakurikuler
                            </a>
                            <a href="<?php echo e(route('admin.prestasi.index')); ?>" class="block px-4 py-2 text-sm text-[#64748B] hover:bg-[#F8FAFC] hover:text-[#334155] transition">
                                Prestasi
                            </a>
                            <a href="<?php echo e(route('admin.galeri.index')); ?>" class="block px-4 py-2 text-sm text-[#64748B] hover:bg-[#F8FAFC] hover:text-[#334155] transition">
                                Galeri
                            </a>
                            <a href="<?php echo e(route('admin.jurusan.index')); ?>" class="block px-4 py-2 text-sm text-[#64748B] hover:bg-[#F8FAFC] hover:text-[#334155] transition">
                                Jurusan
                            </a>
                            <div class="border-t border-[#E2E8F0] my-1"></div>
                            <a href="<?php echo e(route('admin.profil-sekolah.sejarah')); ?>" class="block px-4 py-2 text-sm text-[#64748B] hover:bg-[#F8FAFC] hover:text-[#334155] transition">
                                Sejarah
                            </a>
                            <a href="<?php echo e(route('admin.profil-sekolah.visi-misi')); ?>" class="block px-4 py-2 text-sm text-[#64748B] hover:bg-[#F8FAFC] hover:text-[#334155] transition">
                                Visi Misi
                            </a>
                        </div>
                    </div>
                </nav>

                <!-- User Actions -->
                <div class="flex items-center gap-3">
                    <a href="<?php echo e(url('/')); ?>" target="_blank" 
                       class="hidden md:flex items-center gap-2 px-4 py-2 text-sm font-medium text-white bg-[#4276A3] hover:bg-[#365f85] rounded-lg transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                        Lihat Web
                    </a>
                    
                    <form action="<?php echo e(route('admin.logout')); ?>" method="POST" class="hidden md:block">
                        <?php echo csrf_field(); ?>
                        <button type="submit" 
                                class="flex items-center gap-2 px-4 py-2 bg-white/10 text-white text-sm font-medium rounded-lg hover:bg-white/20 transition border border-white/10">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                            </svg>
                            Keluar
                        </button>
                    </form>

                    <!-- Mobile menu button -->
                    <button type="button" 
                            class="lg:hidden p-2 rounded-lg bg-white/10 text-white hover:bg-white/20 transition"
                            onclick="document.getElementById('admin-mobile-menu').classList.toggle('hidden')">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div class="hidden lg:hidden bg-[#1E293B] border-t border-[#334155]" id="admin-mobile-menu">
            <div class="px-4 py-3 space-y-1">
                <a href="<?php echo e(route('admin.pendaftar.index')); ?>" 
                   class="block px-4 py-2 rounded-lg text-sm font-medium <?php echo e(request()->is('admin/pendaftar*') ? 'text-white bg-[#4276A3]/20 border-l-2 border-[#4276A3]' : 'text-slate-400 hover:bg-white/5 hover:text-white'); ?>">
                    Data Pendaftar
                </a>
                <a href="<?php echo e(route('admin.struktur-organisasi.index')); ?>" 
                   class="block px-4 py-2 rounded-lg text-sm font-medium <?php echo e(request()->is('admin/struktur-organisasi*') ? 'text-white bg-[#4276A3]/20 border-l-2 border-[#4276A3]' : 'text-slate-400 hover:bg-white/5 hover:text-white'); ?>">
                    Struktur Organisasi
                </a>
                <a href="<?php echo e(route('admin.fasilitas.index')); ?>" 
                   class="block px-4 py-2 rounded-lg text-sm font-medium <?php echo e(request()->is('admin/fasilitas*') ? 'text-white bg-[#4276A3]/20 border-l-2 border-[#4276A3]' : 'text-slate-400 hover:bg-white/5 hover:text-white'); ?>">
                    Fasilitas
                </a>
                <a href="<?php echo e(route('admin.berita.index')); ?>" 
                   class="block px-4 py-2 rounded-lg text-sm font-medium <?php echo e(request()->is('admin/berita*') ? 'text-white bg-[#4276A3]/20 border-l-2 border-[#4276A3]' : 'text-slate-400 hover:bg-white/5 hover:text-white'); ?>">
                    Berita
                </a>
                <a href="<?php echo e(route('admin.ekstrakurikuler.index')); ?>" 
                   class="block px-4 py-2 rounded-lg text-sm font-medium <?php echo e(request()->is('admin/ekstrakurikuler*') ? 'text-white bg-[#4276A3]/20 border-l-2 border-[#4276A3]' : 'text-slate-400 hover:bg-white/5 hover:text-white'); ?>">
                    Ekstrakurikuler
                </a>
                <a href="<?php echo e(route('admin.prestasi.index')); ?>" 
                   class="block px-4 py-2 rounded-lg text-sm font-medium <?php echo e(request()->is('admin/prestasi*') ? 'text-white bg-[#4276A3]/20 border-l-2 border-[#4276A3]' : 'text-slate-400 hover:bg-white/5 hover:text-white'); ?>">
                    Prestasi
                </a>
                <a href="<?php echo e(route('admin.galeri.index')); ?>" 
                   class="block px-4 py-2 rounded-lg text-sm font-medium <?php echo e(request()->is('admin/galeri*') ? 'text-white bg-[#4276A3]/20 border-l-2 border-[#4276A3]' : 'text-slate-400 hover:bg-white/5 hover:text-white'); ?>">
                    Galeri
                </a>
                <a href="<?php echo e(route('admin.jurusan.index')); ?>" 
                   class="block px-4 py-2 rounded-lg text-sm font-medium <?php echo e(request()->is('admin/jurusan*') ? 'text-white bg-[#4276A3]/20 border-l-2 border-[#4276A3]' : 'text-slate-400 hover:bg-white/5 hover:text-white'); ?>">
                    Jurusan
                </a>

                <div class="border-t border-[#334155] pt-3 mt-3">
                    <a href="<?php echo e(url('/')); ?>" target="_blank" 
                       class="block px-4 py-2 rounded-lg text-sm font-medium text-white bg-[#4276A3] hover:bg-[#365f85] mb-1 text-center">
                        Lihat Website
                    </a>
                    <form action="<?php echo e(route('admin.logout')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="block w-full px-4 py-2 rounded-lg text-sm font-medium text-white bg-white/10 text-left hover:bg-white/20">
                            Keluar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content Area -->
    <main class="container mx-auto px-4 py-6">
        <?php echo $__env->yieldContent('content'); ?>
    </main>
</body>
</html>
<?php /**PATH C:\Users\eka\.gemini\antigravity\scratch\smk-alstar\resources\views/layouts/admin.blade.php ENDPATH**/ ?>