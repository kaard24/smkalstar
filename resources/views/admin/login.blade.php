<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - SMK Al-Hidayah Lestari</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#15803d',      // green-700
                        secondary: '#166534',    // green-800
                    },
                    fontFamily: {
                        sans: ['Segoe UI', 'Tahoma', 'Geneva', 'Verdana', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style>
        body { 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: 18px;
        }
        .input-large {
            padding: 16px 20px;
            font-size: 18px;
            min-height: 56px;
        }
        .btn-large {
            padding: 16px 28px;
            font-size: 18px;
            font-weight: 700;
            min-height: 56px;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-green-900 to-green-700 min-h-screen flex items-center justify-center py-12 px-4">

    <div class="max-w-lg w-full">
        {{-- Logo & Title --}}
        <div class="text-center mb-8">
            <div class="flex justify-center mb-6">
                <div class="w-28 h-28 bg-white rounded-full flex items-center justify-center shadow-xl">
                    <svg class="w-16 h-16 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                </div>
            </div>
            <h1 class="text-4xl font-bold text-white mb-2">Admin Panel</h1>
            <p class="text-green-100 text-xl">SMK Al-Hidayah Lestari</p>
        </div>

        {{-- Login Card --}}
        <div class="bg-white rounded-2xl shadow-2xl p-8 border-4 border-green-600">
            @if(session('error'))
            <div class="mb-6 p-5 bg-red-50 border-2 border-red-300 text-red-800 rounded-xl text-lg">
                {{ session('error') }}
            </div>
            @endif

            @if(session('success'))
            <div class="mb-6 p-5 bg-green-50 border-2 border-green-300 text-green-800 rounded-xl text-lg">
                {{ session('success') }}
            </div>
            @endif

            <div class="text-center mb-8">
                <h2 class="text-2xl font-bold text-gray-900">Masuk sebagai Admin</h2>
                <p class="text-gray-600 text-lg mt-2">Silakan masukkan username dan password</p>
            </div>

            <form action="{{ route('admin.login.submit') }}" method="POST" class="space-y-6">
                @csrf
                
                {{-- Username --}}
                <div>
                    <label for="username" class="block text-lg font-bold text-gray-800 mb-3">
                        Username / Nama Pengguna <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="h-6 w-6 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                        <input 
                            type="text" 
                            id="username" 
                            name="username" 
                            value="{{ old('username') }}"
                            placeholder="Masukkan username Anda"
                            required
                            autofocus
                            class="w-full pl-12 pr-4 input-large border-2 border-gray-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition @error('username') border-red-500 @enderror"
                        >
                    </div>
                    @error('username')
                    <p class="mt-2 text-base text-red-600 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Password --}}
                <div>
                    <label for="password" class="block text-lg font-bold text-gray-800 mb-3">
                        Password / Kata Sandi <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="h-6 w-6 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                        </div>
                        <input 
                            type="password" 
                            id="password" 
                            name="password" 
                            placeholder="Masukkan password Anda"
                            required
                            class="w-full pl-12 pr-4 input-large border-2 border-gray-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition @error('password') border-red-500 @enderror"
                        >
                    </div>
                    @error('password')
                    <p class="mt-2 text-base text-red-600 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Remember Me --}}
                <div class="flex items-center">
                    <label class="flex items-center cursor-pointer">
                        <input type="checkbox" name="remember" class="w-5 h-5 rounded border-2 border-gray-300 text-primary focus:ring-primary">
                        <span class="ml-3 text-base font-medium text-gray-700">Ingat saya di perangkat ini</span>
                    </label>
                </div>

                {{-- Submit Button --}}
                <button 
                    type="submit" 
                    class="w-full btn-large bg-primary text-white rounded-xl font-bold hover:bg-green-800 transition shadow-lg flex items-center justify-center gap-3"
                >
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                    </svg>
                    Masuk ke Panel Admin
                </button>
            </form>

            {{-- Help Text --}}
            <div class="mt-6 p-4 bg-yellow-50 border-2 border-yellow-200 rounded-xl">
                <p class="text-base text-yellow-800 flex items-start gap-2">
                    <svg class="w-5 h-5 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                    </svg>
                    <span>Jika lupa password, silakan hubungi pihak IT sekolah.</span>
                </p>
            </div>
        </div>

        {{-- Back Link --}}
        <div class="text-center mt-8">
            <a href="{{ url('/') }}" class="text-green-100 hover:text-white transition text-lg font-medium flex items-center justify-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali ke Halaman Utama Website
            </a>
        </div>
    </div>

</body>
</html>
