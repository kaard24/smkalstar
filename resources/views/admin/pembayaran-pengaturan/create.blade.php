@extends('layouts.admin')

@section('title', 'Tambah Pengaturan Pembayaran - Admin Panel')

@section('content')
    {{-- Header --}}
    <div class="mb-6">
        <div class="flex items-center gap-2 text-sm text-slate-500 mb-2">
            <a href="{{ route('admin.pembayaran-pengaturan.index') }}" class="hover:text-[#4276A3]">Pengaturan Pembayaran</a>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
            <span>Tambah Baru</span>
        </div>
        <h1 class="text-lg font-semibold text-slate-800">Tambah Pengaturan Pembayaran</h1>
    </div>

    {{-- Alerts --}}
    @if($errors->any())
    <div class="mb-4 p-3 bg-[#991B1B]/10 border border-[#991B1B]/20 text-[#991B1B] rounded-lg text-sm">
        <p class="font-medium mb-1">Terdapat kesalahan:</p>
        <ul class="list-disc list-inside text-xs">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    {{-- Form --}}
    <div class="card p-6 max-w-2xl">
        <form action="{{ route('admin.pembayaran-pengaturan.store') }}" method="POST">
            @csrf

            <div class="space-y-4">
                {{-- Nama Penerima --}}
                <div>
                    <label for="nama_penerima" class="block text-sm font-medium text-slate-700 mb-1">
                        Nama Penerima <span class="text-[#991B1B]">*</span>
                    </label>
                    <input type="text" id="nama_penerima" name="nama_penerima" 
                           value="{{ old('nama_penerima') }}" required
                           placeholder="Contoh: SMK Al-Hidayah Lestari"
                           class="w-full px-3 py-2 text-sm border border-slate-300 rounded-md focus:outline-none focus:border-[#4276A3] focus:ring-1 focus:ring-[#4276A3]">
                    <p class="text-xs text-slate-500 mt-1">Nama rekening penerima transfer</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    {{-- Nomor Rekening --}}
                    <div>
                        <label for="nomor_rekening" class="block text-sm font-medium text-slate-700 mb-1">
                            Nomor Rekening
                        </label>
                        <input type="text" id="nomor_rekening" name="nomor_rekening" 
                               value="{{ old('nomor_rekening') }}"
                               placeholder="Contoh: 1234-5678-9012"
                               class="w-full px-3 py-2 text-sm border border-slate-300 rounded-md focus:outline-none focus:border-[#4276A3] focus:ring-1 focus:ring-[#4276A3]">
                    </div>

                    {{-- Bank --}}
                    <div>
                        <label for="bank" class="block text-sm font-medium text-slate-700 mb-1">
                            Bank
                        </label>
                        <input type="text" id="bank" name="bank" 
                               value="{{ old('bank') }}"
                               placeholder="Contoh: BRI, BCA, Mandiri"
                               class="w-full px-3 py-2 text-sm border border-slate-300 rounded-md focus:outline-none focus:border-[#4276A3] focus:ring-1 focus:ring-[#4276A3]">
                    </div>
                </div>

                {{-- Biaya --}}
                <div>
                    <label for="biaya" class="block text-sm font-medium text-slate-700 mb-1">
                        Biaya Pendaftaran <span class="text-[#991B1B]">*</span>
                    </label>
                    <div class="relative">
                        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-slate-500 text-sm">Rp</span>
                        <input type="number" id="biaya" name="biaya" 
                               value="{{ old('biaya') }}" required min="0"
                               placeholder="250000"
                               class="w-full pl-10 pr-3 py-2 text-sm border border-slate-300 rounded-md focus:outline-none focus:border-[#4276A3] focus:ring-1 focus:ring-[#4276A3]">
                    </div>
                    <p class="text-xs text-slate-500 mt-1">Jumlah biaya pendaftaran dalam Rupiah</p>
                </div>

                {{-- Keterangan --}}
                <div>
                    <label for="keterangan" class="block text-sm font-medium text-slate-700 mb-1">
                        Keterangan
                    </label>
                    <textarea id="keterangan" name="keterangan" rows="3"
                              placeholder="Contoh: Transfer ke rekening BRI 1234-5678-90 a.n. SMK Al-Hidayah Lestari"
                              class="w-full px-3 py-2 text-sm border border-slate-300 rounded-md focus:outline-none focus:border-[#4276A3] focus:ring-1 focus:ring-[#4276A3]">{{ old('keterangan') }}</textarea>
                    <p class="text-xs text-slate-500 mt-1">Informasi tambahan seperti nomor rekening, bank, dll.</p>
                </div>

                {{-- Is Active --}}
                <div class="p-3 bg-slate-50 rounded-lg border border-slate-200">
                    <label class="flex items-start gap-3 cursor-pointer">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active') ? 'checked' : '' }}
                               class="mt-0.5 w-4 h-4 text-[#4276A3] border-slate-300 rounded focus:ring-[#4276A3]">
                        <div>
                            <span class="text-sm font-medium text-slate-700">Aktifkan pengaturan ini</span>
                            <p class="text-xs text-slate-500 mt-0.5">Jika diaktifkan, pengaturan lain akan otomatis dinonaktifkan.</p>
                        </div>
                    </label>
                </div>
            </div>

            {{-- Buttons --}}
            <div class="mt-6 flex justify-end gap-2 pt-4 border-t border-slate-200">
                <a href="{{ route('admin.pembayaran-pengaturan.index') }}" class="btn btn-secondary">
                    Batal
                </a>
                <button type="submit" class="btn btn-primary">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Simpan
                </button>
            </div>
        </form>
    </div>
@endsection
