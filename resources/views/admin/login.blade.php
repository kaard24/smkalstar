<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin & Kajur - SMK Al-Hidayah Lestari</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        /* Set B: Modern Enterprise Palette */
                        primary: '#4276A3',       // Steel Blue - satu accent
                        'primary-dark': '#365f85',
                        slate: {
                            50: '#F8FAFC',
                            100: '#F1F5F9',
                            200: '#E2E8F0',
                            300: '#CBD5E1',
                            400: '#94A3B8',
                            500: '#64748B',
                            600: '#475569',
                            700: '#334155',
                            800: '#1E293B',
                            900: '#0F172A',
                        }
                    }
                }
            }
        }
    </script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        * { font-family: 'Inter', system-ui, sans-serif; }
        
        body {
            background: #F8FAFC;  /* Slate-50 */
        }
        
        .form-input:focus {
            border-color: #4276A3;
            box-shadow: 0 0 0 3px rgba(66, 118, 163, 0.1);
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4">

    <div class="w-full max-w-md">
        {{-- Card Login --}}
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
            {{-- Header dengan Logo - Slate-700 (Set B) --}}
            <div class="bg-[#334155] px-6 py-6 text-center">
                <div class="w-16 h-16 mx-auto rounded-full border-2 border-white/20 bg-white p-1 mb-3">
                    <img src="{{ asset('images/logo.webp') }}" alt="Logo Sekolah" class="w-full h-full rounded-full object-cover" loading="lazy" decoding="async">
                </div>
                <h1 class="text-xl font-semibold text-white">Admin & Kajur Panel</h1>
                <p class="text-slate-400 text-sm mt-0.5">SMK Al-Hidayah Lestari</p>
            </div>

            {{-- Form --}}
            <div class="p-6">
                @if(session('error'))
                <div class="mb-4 p-3 bg-[#991B1B]/10 border border-[#991B1B]/20 text-[#991B1B] rounded-lg text-sm">
                    {{ session('error') }}
                </div>
                @endif

                @if(session('success'))
                <div class="mb-4 p-3 bg-[#047857]/10 border border-[#047857]/20 text-[#047857] rounded-lg text-sm">
                    {{ session('success') }}
                </div>
                @endif

                <h2 class="text-base font-medium text-slate-800 mb-4 text-center">Masuk ke Akun Admin atau Kajur</h2>
                
                <div class="flex gap-2 mb-4">
                    <div class="flex-1 p-3 bg-blue-50 rounded-lg text-center border border-blue-100">
                        <svg class="w-6 h-6 mx-auto text-[#4276A3] mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        <p class="text-xs font-medium text-slate-600">Admin</p>
                    </div>
                    <div class="flex-1 p-3 bg-green-50 rounded-lg text-center border border-green-100">
                        <svg class="w-6 h-6 mx-auto text-green-600 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                        <p class="text-xs font-medium text-slate-600">Kajur</p>
                    </div>
                </div>

                <form action="{{ route('admin.login.submit') }}" method="POST" class="space-y-4">
                    @csrf
                    
                    {{-- Username --}}
                    <div>
                        <label for="username" class="block text-sm font-medium text-slate-700 mb-1">
                            Username
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-4 w-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            </div>
                            <input 
                                type="text" 
                                id="username" 
                                name="username" 
                                value="{{ old('username') }}"
                                placeholder="Masukkan username"
                                required
                                autofocus
                                class="form-input w-full pl-9 pr-3 py-2.5 text-sm border border-slate-200 rounded-lg focus:outline-none @error('username') border-red-500 @enderror"
                            >
                        </div>
                        @error('username')
                        <p class="mt-1 text-xs text-[#991B1B]">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Password --}}
                    <div>
                        <label for="password" class="block text-sm font-medium text-slate-700 mb-1">
                            Password
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-4 w-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                </svg>
                            </div>
                            <input 
                                type="password" 
                                id="password" 
                                name="password" 
                                placeholder="Masukkan password"
                                required
                                class="form-input w-full pl-9 pr-3 py-2.5 text-sm border border-slate-200 rounded-lg focus:outline-none @error('password') border-red-500 @enderror"
                            >
                        </div>
                        @error('password')
                        <p class="mt-1 text-xs text-[#991B1B]">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Submit Button --}}
                    <button 
                        type="submit" 
                        class="w-full py-2.5 bg-[#4276A3] text-white text-sm font-medium rounded-lg hover:bg-[#365f85] transition focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#4276A3]"
                    >
                        Masuk
                    </button>
                </form>

            </div>
        </div>
        
        {{-- Footer --}}
        <p class="text-center text-xs text-slate-400 mt-6">
            © {{ date('Y') }} SMK Al-Hidayah Lestari
        </p>
    </div>

</body>
</html>
