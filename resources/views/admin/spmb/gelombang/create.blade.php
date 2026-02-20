@extends('layouts.admin')

@section('title', 'Tambah Gelombang - Admin Panel')

@section('content')
<div class="max-w-3xl mx-auto">
    {{-- Header --}}
    <div class="mb-8">
        <a href="{{ route('admin.spmb.gelombang.index') }}" class="inline-flex items-center text-sm text-slate-500 hover:text-[#4276A3] mb-4 transition-colors">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Kembali ke Daftar Gelombang
        </a>
        <h1 class="text-2xl font-bold text-slate-800">Tambah Gelombang Baru</h1>
        <p class="text-slate-600">Tambahkan jadwal gelombang pendaftaran.</p>
    </div>

    {{-- Error Alert --}}
    @if($errors->any())
    <div class="mb-6 p-4 bg-rose-50 border border-rose-200 text-rose-700 rounded-xl">
        <div class="flex items-center gap-2 mb-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <span class="font-medium">Terjadi kesalahan:</span>
        </div>
        <ul class="list-disc pl-5 space-y-1 text-sm">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('admin.spmb.gelombang.store') }}" method="POST" class="space-y-6">
        @csrf

        {{-- Info Dasar --}}
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-200 bg-slate-50">
                <h2 class="font-semibold text-slate-800">Informasi Dasar</h2>
            </div>
            <div class="p-6 space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="nama" class="form-label">Nama Gelombang <span class="text-rose-600">*</span></label>
                        <input type="text" id="nama" name="nama" value="{{ old('nama') }}" required
                               class="form-input @error('nama') border-rose-500 @enderror"
                               placeholder="Gelombang 1">
                    </div>
                    <div>
                        <label for="nomor" class="form-label">Nomor <span class="text-rose-600">*</span></label>
                        <input type="number" id="nomor" name="nomor" value="{{ old('nomor') }}" required min="1"
                               class="form-input @error('nomor') border-rose-500 @enderror"
                               placeholder="1">
                    </div>
                </div>
                <div>
                    <label for="tahun_ajaran" class="form-label">Tahun Ajaran <span class="text-rose-600">*</span></label>
                    <input type="text" id="tahun_ajaran" name="tahun_ajaran" value="{{ old('tahun_ajaran', date('Y') . '/' . (date('Y') + 1)) }}" required
                           class="form-input @error('tahun_ajaran') border-rose-500 @enderror"
                           placeholder="2026/2027">
                </div>
                <div>
                    <label class="flex items-center cursor-pointer">
                        <input type="checkbox" name="aktif" value="1" checked
                               class="w-5 h-5 text-[#4276A3] border-slate-300 rounded focus:ring-[#4276A3]">
                        <span class="ml-3 text-sm font-medium text-slate-700">Aktif</span>
                    </label>
                </div>
            </div>
        </div>

        {{-- Jadwal Pendaftaran --}}
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-200 bg-slate-50">
                <h2 class="font-semibold text-slate-800">Jadwal Pendaftaran</h2>
            </div>
            <div class="p-6 space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="pendaftaran_start" class="form-label">Tanggal Mulai <span class="text-rose-600">*</span></label>
                        <input type="date" id="pendaftaran_start" name="pendaftaran_start" value="{{ old('pendaftaran_start') }}" required
                               class="form-input @error('pendaftaran_start') border-rose-500 @enderror">
                    </div>
                    <div>
                        <label for="pendaftaran_end" class="form-label">Tanggal Selesai <span class="text-rose-600">*</span></label>
                        <input type="date" id="pendaftaran_end" name="pendaftaran_end" value="{{ old('pendaftaran_end') }}" required
                               class="form-input @error('pendaftaran_end') border-rose-500 @enderror">
                    </div>
                </div>
            </div>
        </div>

        {{-- Jadwal Tes --}}
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-200 bg-slate-50">
                <h2 class="font-semibold text-slate-800">Jadwal Tes</h2>
            </div>
            <div class="p-6 space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="tes_mulai" class="form-label">Tanggal Mulai <span class="text-rose-600">*</span></label>
                        <input type="date" id="tes_mulai" name="tes_mulai" value="{{ old('tes_mulai') }}" required
                               class="form-input @error('tes_mulai') border-rose-500 @enderror">
                    </div>
                    <div>
                        <label for="tes_selesai" class="form-label">Tanggal Selesai <span class="text-rose-600">*</span></label>
                        <input type="date" id="tes_selesai" name="tes_selesai" value="{{ old('tes_selesai') }}" required
                               class="form-input @error('tes_selesai') border-rose-500 @enderror">
                    </div>
                </div>
            </div>
        </div>

        {{-- Jadwal Pengumuman --}}
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-200 bg-slate-50">
                <h2 class="font-semibold text-slate-800">Jadwal Pengumuman</h2>
            </div>
            <div class="p-6">
                <div>
                    <label for="pengumuman" class="form-label">Tanggal Pengumuman <span class="text-rose-600">*</span></label>
                    <input type="date" id="pengumuman" name="pengumuman" value="{{ old('pengumuman') }}" required
                           class="form-input @error('pengumuman') border-rose-500 @enderror">
                </div>
            </div>
        </div>

        {{-- Status & Urutan --}}
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-200 bg-slate-50">
                <h2 class="font-semibold text-slate-800">Pengaturan Lainnya</h2>
            </div>
            <div class="p-6 space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="status" class="form-label">Status <span class="text-rose-600">*</span></label>
                        <select id="status" name="status" required class="form-input @error('status') border-rose-500 @enderror">
                            <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                            <option value="aktif" {{ old('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="selesai" {{ old('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                        </select>
                    </div>
                    <div>
                        <label for="urutan" class="form-label">Urutan Tampil</label>
                        <input type="number" id="urutan" name="urutan" value="{{ old('urutan') }}" min="0"
                               class="form-input @error('urutan') border-rose-500 @enderror"
                               placeholder="Otomatis jika kosong">
                    </div>
                </div>
            </div>
        </div>

        {{-- Actions --}}
        <div class="flex justify-end gap-4">
            <a href="{{ route('admin.spmb.gelombang.index') }}" class="btn btn-secondary btn-lg">
                Batal
            </a>
            <button type="submit" class="btn btn-primary btn-lg shadow-sm hover:shadow-md">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                Simpan Gelombang
            </button>
        </div>
    </form>
</div>
@endsection
