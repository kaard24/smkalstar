@extends('layouts.app')

@section('title', 'Login SPMB - SMK Al-Hidayah Lestari')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-primary/10 to-green-50 flex items-center justify-center py-12 px-4" x-data="{ 
    showRegPopup: {{ session('registration_success') ? 'true' : 'false' }},
    showLoginPopup: false
}">
    <div class="max-w-md w-full">
        <!-- Logo & Title -->
        <div class="text-center mb-8">
            <div class="flex justify-center mb-4">
                <img src="{{ asset('images/logo.jpg') }}" alt="Logo SMK Al-Hidayah Lestari" class="w-24 h-24 object-contain">
            </div>
            <h1 class="text-3xl font-bold text-gray-900">SPMB Online</h1>
            <p class="text-gray-600 mt-2">SMK Al-Hidayah Lestari</p>
        </div>

        <!-- Login Card -->
        <div class="bg-white rounded-2xl shadow-xl p-8 border border-gray-100">
            @if(session('error'))
            <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-700 rounded-lg text-sm">
                {{ session('error') }}
            </div>
            @endif

            <div class="text-center mb-6">
                <h2 class="text-xl font-bold text-gray-800">Masuk ke Akun Anda</h2>
                <p class="text-gray-500 text-sm mt-1">Gunakan NISN dan Password</p>
            </div>

            <!-- Login Form -->
            <form action="{{ route('login.submit') }}" method="POST" class="space-y-5" id="loginForm">
                @csrf
                
                <!-- NISN Input -->
                <div>
                    <label for="nisn" class="block text-sm font-medium text-gray-700 mb-2">
                        NISN <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"></path>
                            </svg>
                        </div>
                        <input 
                            type="text" 
                            id="nisn" 
                            name="nisn" 
                            value="{{ session('registered_nisn', old('nisn')) }}"
                            placeholder="Masukkan 10 digit NISN"
                            maxlength="10"
                            required
                            class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition @error('nisn') border-red-500 @enderror"
                        >
                    </div>
                    @error('nisn')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password Input -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                        Password <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                        </div>
                        <input 
                            type="password" 
                            id="password" 
                            name="password" 
                            value="{{ session('registered_password') }}"
                            placeholder="Masukkan password"
                            required
                            class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition @error('password') border-red-500 @enderror"
                        >
                    </div>
                    @error('password')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Remember Me -->
                <div class="flex items-center justify-between">
                    <label class="flex items-center">
                        <input type="checkbox" name="remember" class="rounded border-gray-300 text-primary focus:ring-primary">
                        <span class="ml-2 text-sm text-gray-600">Ingat saya</span>
                    </label>
                </div>

                <!-- Submit Button -->
                <button 
                    type="submit" 
                    class="w-full flex items-center justify-center gap-2 bg-primary text-white px-6 py-3 rounded-xl font-semibold hover:bg-primary/90 transition shadow-lg shadow-primary/25"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                    </svg>
                    Masuk
                </button>
            </form>

            <div class="relative my-6">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-gray-200"></div>
                </div>
                <div class="relative flex justify-center text-sm">
                    <span class="px-4 bg-white text-gray-500">atau</span>
                </div>
            </div>

            <div class="text-center">
                <p class="text-gray-600 text-sm">
                    Belum punya akun?
                    <a href="{{ route('register') }}" class="text-primary font-semibold hover:underline">Daftar Sekarang</a>
                </p>
            </div>
        </div>

        <!-- Info Box -->
        <div class="mt-6 bg-blue-50 border border-blue-200 rounded-xl p-4 text-center">
            <p class="text-blue-700 text-sm">
                <strong>Langkah Pendaftaran:</strong><br>
                1. Daftar Akun → 2. Lengkapi Data → 3. Upload Berkas
            </p>
        </div>

        <!-- Back Link -->
        <div class="text-center mt-6">
            <a href="{{ url('/') }}" class="text-gray-500 hover:text-primary transition text-sm">
                ← Kembali ke Halaman Utama
            </a>
        </div>
    </div>

    <!-- Registration Success Popup -->
    <div x-show="showRegPopup" x-cloak
         class="fixed inset-0 z-50 flex items-center justify-center p-4"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0">
        <div class="absolute inset-0 bg-black/50" @click="showRegPopup = false"></div>
        <div class="relative bg-white rounded-3xl shadow-2xl p-8 max-w-sm w-full text-center transform"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 scale-90"
             x-transition:enter-end="opacity-100 scale-100">
            <!-- Success Icon -->
            <div class="w-20 h-20 mx-auto mb-6 bg-green-100 rounded-full flex items-center justify-center animate-bounce">
                <svg class="w-10 h-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>
            <h3 class="text-2xl font-bold text-gray-800 mb-2">Pendaftaran Berhasil!</h3>
            <p class="text-gray-600 mb-6">Akun Anda telah dibuat. Data login sudah terisi otomatis, silakan klik tombol <strong>Masuk</strong> untuk melanjutkan.</p>
            <button @click="showRegPopup = false" 
                    class="w-full bg-primary text-white px-6 py-3 rounded-xl font-semibold hover:bg-primary/90 transition shadow-lg">
                Mengerti
            </button>
        </div>
    </div>
</div>
@endsection
