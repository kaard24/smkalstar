@extends('layouts.admin')

@section('title', 'Tambah Kepala Jurusan - Admin Panel')

@section('content')
<div class="max-w-2xl mx-auto">
    {{-- Header --}}
    <div class="mb-8">
        <a href="{{ route('admin.kajur.index') }}" class="text-slate-500 hover:text-slate-700 flex items-center gap-1 mb-4">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Kembali
        </a>
        <h1 class="text-2xl font-bold text-slate-800">Tambah Kepala Jurusan</h1>
        <p class="text-slate-600">Buat akun baru untuk kepala jurusan.</p>
    </div>

    {{-- Form --}}
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
        <form action="{{ route('admin.kajur.store') }}" method="POST" class="space-y-6">
            @csrf

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-2">Nama Lengkap</label>
                <input type="text" name="nama" value="{{ old('nama') }}" 
                    class="w-full rounded-lg border-slate-300 focus:border-[#4276A3] focus:ring-[#4276A3]"
                    placeholder="Contoh: Budi Santoso" required>
                @error('nama')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-2">Username</label>
                <input type="text" name="username" value="{{ old('username') }}" 
                    class="w-full rounded-lg border-slate-300 focus:border-[#4276A3] focus:ring-[#4276A3]"
                    placeholder="Contoh: kajur.tkj" required>
                @error('username')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-2">Password</label>
                <input type="password" name="password" 
                    class="w-full rounded-lg border-slate-300 focus:border-[#4276A3] focus:ring-[#4276A3]"
                    placeholder="Minimal 6 karakter" required>
                @error('password')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-2">Jurusan yang Diampu</label>
                <select name="jurusan_id" class="w-full rounded-lg border-slate-300 focus:border-[#4276A3] focus:ring-[#4276A3]" required>
                    <option value="">Pilih Jurusan</option>
                    @foreach($jurusan as $j)
                    <option value="{{ $j->id }}" {{ old('jurusan_id') == $j->id ? 'selected' : '' }}>{{ $j->nama }}</option>
                    @endforeach
                </select>
                @error('jurusan_id')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="flex items-center gap-3 cursor-pointer">
                    <input type="checkbox" name="aktif" value="1" checked
                        class="rounded border-slate-300 text-[#4276A3] focus:ring-[#4276A3] w-5 h-5">
                    <span class="text-slate-700">Aktifkan akun ini</span>
                </label>
            </div>

            <div class="flex gap-4 pt-4">
                <button type="submit" class="inline-flex items-center gap-2 px-6 py-3 bg-[#4276A3] hover:bg-[#365f85] text-white font-semibold rounded-xl transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Simpan
                </button>
                <a href="{{ route('admin.kajur.index') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-slate-200 hover:bg-slate-300 text-slate-700 font-semibold rounded-xl transition">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
