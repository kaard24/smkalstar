@extends('layouts.app')

@section('title', 'Login - SMK Al-Hidayah Lestari')

@section('content')
<div class="min-h-screen bg-gray-50 flex items-center justify-center py-12 px-4" x-data="{ 
    showRegPopup: {{ session('registration_success') ? 'true' : 'false' }},
    showPassword: false,
    isLoading: false
}">
    <div class="w-full max-w-md">
        <!-- Logo & Title -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-white rounded-2xl shadow-md mb-4">
                <img src="{{ asset('images/logo.webp') }}" alt="Logo" class="w-12 h-12 object-contain rounded-lg" loading="lazy" decoding="async">
            </div>
            <h1 class="text-2xl font-bold text-gray-900">Masuk ke Akun</h1>
            <p class="text-gray-500 mt-1 text-sm">SPMB SMK Al-Hidayah Lestari</p>
        </div>

        <!-- Login Card -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8">
            @if(session('error'))
            <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl flex items-start gap-3">
                <svg class="w-5 h-5 text-red-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <p class="text-red-700 text-sm">{{ session('error') }}</p>
            </div>
            @endif

            <form action="{{ route('login.submit') }}" method="POST" @submit="isLoading = true">
                @csrf
                
                <!-- NISN -->
                <div class="mb-5">
                    <label for="nisn" class="block text-sm font-medium text-gray-700 mb-2">
                        NISN <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="text" 
                        id="nisn" 
                        name="nisn" 
                        value="{{ session('registered_nisn', old('nisn')) }}"
                        placeholder="Masukkan 10 digit NISN"
                        maxlength="10"
                        required
                        class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all"
                    >
                    @error('nisn')
                    <p class="mt-1.5 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mb-5">
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                        Password <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input 
                            :type="showPassword ? 'text' : 'password'" 
                            id="password" 
                            name="password" 
                            value="{{ session('registered_password') }}"
                            placeholder="Masukkan password"
                            required
                            class="w-full px-4 py-3 pr-12 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all"
                        >
                        <button 
                            type="button" 
                            @click="showPassword = !showPassword" 
                            class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 transition"
                        >
                            <svg x-show="!showPassword" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                            <svg x-show="showPassword" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display: none;">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                            </svg>
                        </button>
                    </div>
                    @error('password')
                    <p class="mt-1.5 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Remember Me -->
                <div class="flex items-center mb-6">
                    <input type="checkbox" name="remember" id="remember" class="w-4 h-4 rounded border-gray-300 text-primary focus:ring-primary">
                    <label for="remember" class="ml-2 text-sm text-gray-600">Ingat saya</label>
                </div>

                <!-- Submit Button -->
                <button 
                    type="submit" 
                    class="w-full flex items-center justify-center gap-2 bg-primary text-white px-6 py-3.5 rounded-xl font-semibold hover:bg-primary-dark transition shadow-lg shadow-primary/20 disabled:opacity-70"
                    :disabled="isLoading"
                >
                    <svg x-show="isLoading" class="w-5 h-5 animate-spin" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <span x-text="isLoading ? 'Memuat...' : 'Masuk'"></span>
                </button>
            </form>

            <!-- Divider -->
            <div class="relative my-6">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-gray-200"></div>
                </div>
                <div class="relative flex justify-center">
                    <span class="px-4 bg-white text-sm text-gray-400">atau</span>
                </div>
            </div>

            <!-- Register Link -->
            <p class="text-center text-gray-600 text-sm">
                Belum punya akun?
                <a href="{{ route('register') }}" class="text-primary font-semibold hover:underline ml-1">Daftar Sekarang</a>
            </p>
        </div>
    </div>

    <!-- Success Modal -->
    <div x-show="showRegPopup" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4">
        <div class="absolute inset-0 bg-black/50" @click="showRegPopup = false"></div>
        <div class="relative bg-white rounded-2xl shadow-2xl p-8 max-w-sm w-full text-center">
            <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                </svg>
            </div>
            <h3 class="text-xl font-bold text-gray-900 mb-2">Pendaftaran Berhasil!</h3>
            <p class="text-gray-600 text-sm mb-6">Akun Anda telah dibuat. Data login sudah terisi otomatis.</p>
            <button @click="showRegPopup = false" class="w-full bg-primary text-white px-6 py-3 rounded-xl font-semibold hover:bg-primary-dark transition">
                Mengerti
            </button>
        </div>
    </div>
</div>
@endsection
