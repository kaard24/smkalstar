@extends('layouts.app')

@section('title', 'Login Kepala Jurusan - SMK Al-Hidayah')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-[#1E293B] to-[#0F172A] px-4">
    <div class="max-w-md w-full">
        {{-- Logo & Header --}}
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-[#4276A3] rounded-2xl mb-4">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
            </div>
            <h1 class="text-2xl font-bold text-white">Login Kepala Jurusan</h1>
            <p class="text-slate-400 mt-2">Masukkan username dan password Anda</p>
        </div>

        {{-- Login Form --}}
        <div class="bg-white rounded-2xl shadow-xl p-8">
            <form action="{{ route('kajur.login.submit') }}" method="POST" class="space-y-6">
                @csrf
                
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Username</label>
                    <input type="text" name="username" value="{{ old('username') }}" 
                        class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:border-[#4276A3] focus:ring-2 focus:ring-[#4276A3]/20 outline-none transition"
                        placeholder="Masukkan username" required>
                    @error('username')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Password</label>
                    <input type="password" name="password" 
                        class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:border-[#4276A3] focus:ring-2 focus:ring-[#4276A3]/20 outline-none transition"
                        placeholder="Masukkan password" required>
                </div>

                <button type="submit" 
                    class="w-full py-3 bg-[#4276A3] hover:bg-[#365f85] text-white font-semibold rounded-xl transition shadow-lg shadow-[#4276A3]/30">
                    Masuk
                </button>
            </form>

            <div class="mt-6 text-center">
                <a href="{{ url('/') }}" class="text-sm text-slate-500 hover:text-[#4276A3] transition">
                    ← Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
