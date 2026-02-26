@extends('layouts.admin')

@section('title', 'Edit Profil - Admin Panel')

@section('content')
<div class="max-w-2xl mx-auto">
    {{-- Header --}}
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-slate-800">Edit Profil</h1>
        <p class="text-slate-600">Perbarui informasi akun admin Anda.</p>
    </div>

    {{-- Form --}}
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
        <form action="{{ route('admin.profil.update') }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            {{-- Informasi Admin --}}
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Nama Lengkap</label>
                    <input type="text" name="name" value="{{ old('name', $admin->name) }}" 
                        class="w-full rounded-lg border-slate-300 focus:border-[#4276A3] focus:ring-[#4276A3]"
                        placeholder="Masukkan nama lengkap" required>
                    @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Username</label>
                    <input type="text" name="username" value="{{ old('username', $admin->username) }}" 
                        class="w-full rounded-lg border-slate-300 focus:border-[#4276A3] focus:ring-[#4276A3]"
                        placeholder="Masukkan username" required>
                    @error('username')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="border-t border-slate-200 pt-6">
                <h3 class="text-lg font-semibold text-slate-800 mb-4">Ubah Password</h3>
                <p class="text-sm text-slate-500 mb-4">Kosongkan jika tidak ingin mengubah password.</p>

                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Password Saat Ini</label>
                        <input type="password" name="current_password" 
                            class="w-full rounded-lg border-slate-300 focus:border-[#4276A3] focus:ring-[#4276A3]"
                            placeholder="Masukkan password saat ini">
                        @error('current_password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Password Baru</label>
                        <input type="password" name="password" 
                            class="w-full rounded-lg border-slate-300 focus:border-[#4276A3] focus:ring-[#4276A3]"
                            placeholder="Minimal 6 karakter">
                        @error('password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Konfirmasi Password Baru</label>
                        <input type="password" name="password_confirmation" 
                            class="w-full rounded-lg border-slate-300 focus:border-[#4276A3] focus:ring-[#4276A3]"
                            placeholder="Ulangi password baru">
                    </div>
                </div>
            </div>

            <div class="flex gap-4 pt-4">
                <button type="submit" class="inline-flex items-center gap-2 px-6 py-3 bg-[#4276A3] hover:bg-[#365f85] text-white font-semibold rounded-xl transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Simpan Perubahan
                </button>
                <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-slate-200 hover:bg-slate-300 text-slate-700 font-semibold rounded-xl transition">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
