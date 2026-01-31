<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - SMK Al-Hidayah Lestari</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#15803d',
                        secondary: '#166534',
                    }
                }
            }
        }
    </script>
    <style>
        * { font-family: 'Segoe UI', system-ui, sans-serif; }
    </style>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center p-4">

    <div class="w-full max-w-md">
        {{-- Card Login --}}
        <div class="bg-white rounded-lg shadow-md border border-gray-200 overflow-hidden">
            {{-- Header dengan Logo --}}
            <div class="bg-primary px-6 py-6 text-center">
                <img src="{{ asset('images/logo.jpg') }}" alt="Logo Sekolah" class="w-16 h-16 mx-auto rounded-full border-2 border-white/30 object-cover mb-3">
                <h1 class="text-xl font-bold text-white">Admin Panel</h1>
                <p class="text-green-100 text-sm mt-0.5">SMK Al-Hidayah Lestari</p>
            </div>

            {{-- Form --}}
            <div class="p-6">
                @if(session('error'))
                <div class="mb-4 p-3 bg-red-50 border border-red-200 text-red-700 rounded-md text-sm">
                    {{ session('error') }}
                </div>
                @endif

                @if(session('success'))
                <div class="mb-4 p-3 bg-green-50 border border-green-200 text-green-700 rounded-md text-sm">
                    {{ session('success') }}
                </div>
                @endif

                <h2 class="text-base font-semibold text-gray-800 mb-4 text-center">Masuk ke Akun Admin</h2>

                <form action="{{ route('admin.login.submit') }}" method="POST" class="space-y-4">
                    @csrf
                    
                    {{-- Username --}}
                    <div>
                        <label for="username" class="block text-sm font-medium text-gray-700 mb-1">
                            Username
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                                class="w-full pl-9 pr-3 py-2 text-sm border border-gray-300 rounded-md focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary @error('username') border-red-500 @enderror"
                            >
                        </div>
                        @error('username')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Password --}}
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">
                            Password
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                </svg>
                            </div>
                            <input 
                                type="password" 
                                id="password" 
                                name="password" 
                                placeholder="Masukkan password"
                                required
                                class="w-full pl-9 pr-3 py-2 text-sm border border-gray-300 rounded-md focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary @error('password') border-red-500 @enderror"
                            >
                        </div>
                        @error('password')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Submit Button --}}
                    <button 
                        type="submit" 
                        class="w-full py-2.5 bg-primary text-white text-sm font-medium rounded-md hover:bg-green-800 transition focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary"
                    >
                        Masuk
                    </button>
                </form>

            </div>
        </div>
    </div>

</body>
</html>
