@extends('layouts.admin')

@section('title', 'Detail Pembayaran - Admin')

@section('content')
<div class="p-6">
    <!-- Header -->
    <div class="flex items-center justify-between mb-6">
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.pembayaran.index') }}" class="p-2 hover:bg-slate-100 rounded-lg transition-colors">
                <svg class="w-5 h-5 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
            </a>
            <div>
                <h1 class="text-2xl font-bold text-slate-800">Detail Pembayaran</h1>
                <p class="text-slate-600">Informasi detail pembayaran siswa</p>
            </div>
        </div>
        
        <div class="flex items-center gap-2">
            @php
                $statusColors = [
                    'pending' => 'bg-amber-100 text-amber-700 border-amber-200',
                    'verified' => 'bg-emerald-100 text-emerald-700 border-emerald-200',
                    'rejected' => 'bg-red-100 text-red-700 border-red-200',
                ];
            @endphp
            <span class="px-4 py-2 text-sm font-semibold rounded-lg border {{ $statusColors[$pembayaran->status] }}">
                {{ $pembayaran->status_label }}
            </span>
        </div>
    </div>

    <!-- Alert Messages -->
    @if(session('success'))
    <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 rounded-lg flex items-start gap-3">
        <svg class="w-5 h-5 text-emerald-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
        <p class="text-sm text-emerald-700">{{ session('success') }}</p>
    </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Data Siswa -->
        <div class="bg-white rounded-xl border border-slate-200 overflow-hidden">
            <div class="p-4 border-b border-slate-100 bg-slate-50">
                <h2 class="font-semibold text-slate-800 flex items-center gap-2">
                    <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    Data Siswa
                </h2>
            </div>
            <div class="p-4 space-y-4">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm text-slate-500">NISN</p>
                        <p class="font-medium text-slate-800">{{ $pembayaran->calonSiswa->nisn }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-slate-500">Nama Lengkap</p>
                        <p class="font-medium text-slate-800">{{ $pembayaran->calonSiswa->nama }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-slate-500">Jurusan Pilihan</p>
                        <p class="font-medium text-slate-800">{{ $pembayaran->calonSiswa->pendaftaran?->jurusan?->nama ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-slate-500">No. WhatsApp</p>
                        <p class="font-medium text-slate-800">{{ $pembayaran->calonSiswa->no_wa ?? '-' }}</p>
                    </div>
                    <div class="col-span-2">
                        <p class="text-sm text-slate-500">Asal Sekolah</p>
                        <p class="font-medium text-slate-800">{{ $pembayaran->calonSiswa->asal_sekolah ?? '-' }}</p>
                    </div>
                </div>
                
                <div class="pt-4 border-t border-slate-100">
                    <a href="{{ route('admin.pendaftar.show', $pembayaran->calonSiswa->id) }}" 
                        class="inline-flex items-center gap-2 text-blue-600 hover:text-blue-700 font-medium">
                        Lihat Detail Pendaftaran
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>

        <!-- Data Pembayaran -->
        <div class="bg-white rounded-xl border border-slate-200 overflow-hidden">
            <div class="p-4 border-b border-slate-100 bg-slate-50">
                <h2 class="font-semibold text-slate-800 flex items-center gap-2">
                    <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                    Data Pembayaran
                </h2>
            </div>
            <div class="p-4 space-y-4">
                <div class="bg-emerald-50 border border-emerald-200 rounded-lg p-4">
                    <p class="text-sm text-emerald-700 mb-1">Jumlah Pembayaran</p>
                    <p class="text-2xl font-bold text-emerald-800">{{ $pembayaran->jumlah_formatted }}</p>
                </div>
                
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm text-slate-500">Tanggal Upload</p>
                        <p class="font-medium text-slate-800">{{ $pembayaran->created_at->format('d M Y H:i') }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-slate-500">Status</p>
                        <p class="font-medium text-slate-800">{{ $pembayaran->status_label }}</p>
                    </div>
                    @if($pembayaran->verified_at)
                    <div>
                        <p class="text-sm text-slate-500">Tanggal Verifikasi</p>
                        <p class="font-medium text-slate-800">{{ $pembayaran->verified_at->format('d M Y H:i') }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-slate-500">Diverifikasi Oleh</p>
                        <p class="font-medium text-slate-800">{{ $pembayaran->verifiedBy?->nama ?? '-' }}</p>
                    </div>
                    @endif
                </div>
                
                @if($pembayaran->catatan_admin)
                <div class="bg-slate-50 rounded-lg p-3">
                    <p class="text-sm text-slate-500 mb-1">Catatan Admin</p>
                    <p class="text-sm text-slate-800">{{ $pembayaran->catatan_admin }}</p>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Bukti Pembayaran -->
    <div class="mt-6 bg-white rounded-xl border border-slate-200 overflow-hidden">
        <div class="p-4 border-b border-slate-100 bg-slate-50 flex items-center justify-between">
            <h2 class="font-semibold text-slate-800 flex items-center gap-2">
                <svg class="w-5 h-5 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                Bukti Pembayaran
            </h2>
            <div class="flex items-center gap-2">
                <a href="{{ route('admin.pembayaran.preview', $pembayaran) }}" target="_blank"
                    class="inline-flex items-center gap-2 px-3 py-1.5 bg-blue-100 hover:bg-blue-200 text-blue-700 rounded-lg text-sm font-medium transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                    Preview
                </a>
                <a href="{{ route('admin.pembayaran.download', $pembayaran) }}"
                    class="inline-flex items-center gap-2 px-3 py-1.5 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-lg text-sm font-medium transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                    </svg>
                    Download
                </a>
            </div>
        </div>
        <div class="p-4">
            @php
                $isImage = !str_ends_with(strtolower($pembayaran->bukti_pembayaran), '.pdf');
            @endphp
            
            @if($isImage)
            <div class="max-w-md mx-auto">
                <img src="{{ $pembayaran->bukti_url }}" alt="Bukti Pembayaran" 
                    class="w-full rounded-lg border border-slate-200 cursor-pointer hover:shadow-lg transition-shadow"
                    onclick="window.open('{{ $pembayaran->bukti_url }}', '_blank')">
            </div>
            @else
            <div class="max-w-md mx-auto bg-red-50 border border-red-200 rounded-lg p-8 text-center">
                <div class="w-20 h-20 mx-auto bg-red-100 rounded-2xl flex items-center justify-center mb-4">
                    <svg class="w-10 h-10 text-red-500" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M7 3C5.895 3 5 3.895 5 5v14c0 1.105.895 2 2 2h10c1.105 0 2-.895 2-2V9l-6-6H7zm6 1.5L17.5 9H13V4.5z"/>
                    </svg>
                </div>
                <h4 class="text-lg font-semibold text-slate-800 mb-2">File PDF</h4>
                <p class="text-sm text-slate-500 mb-4">Bukti pembayaran dalam format PDF</p>
                <a href="{{ $pembayaran->bukti_url }}" target="_blank"
                    class="inline-flex items-center gap-2 px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded-lg font-medium transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                    Lihat PDF
                </a>
            </div>
            @endif
        </div>
    </div>

    <!-- Action Buttons -->
    @if($pembayaran->isPending())
    <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-4">
        <!-- Verifikasi Form -->
        <div class="bg-white rounded-xl border border-slate-200 p-6">
            <h3 class="font-semibold text-emerald-700 mb-4 flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                Verifikasi Pembayaran
            </h3>
            <form action="{{ route('admin.pembayaran.verify', $pembayaran) }}" method="POST">
                @csrf
                @method('PATCH')
                <input type="hidden" name="status" value="verified">
                <div class="mb-4">
                    <label class="block text-sm font-medium text-slate-700 mb-1">Catatan (opsional)</label>
                    <textarea name="catatan" rows="3" 
                        class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500"
                        placeholder="Tambahkan catatan jika diperlukan"></textarea>
                </div>
                <button type="submit" 
                    onclick="return confirm('Apakah Anda yakin ingin memverifikasi pembayaran ini?')"
                    class="w-full py-2.5 bg-emerald-500 hover:bg-emerald-600 text-white rounded-lg font-medium transition-colors">
                    Verifikasi Pembayaran
                </button>
            </form>
        </div>

        <!-- Tolak Form -->
        <div class="bg-white rounded-xl border border-slate-200 p-6">
            <h3 class="font-semibold text-red-700 mb-4 flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
                Tolak Pembayaran
            </h3>
            <form action="{{ route('admin.pembayaran.verify', $pembayaran) }}" method="POST">
                @csrf
                @method('PATCH')
                <input type="hidden" name="status" value="rejected">
                <div class="mb-4">
                    <label class="block text-sm font-medium text-slate-700 mb-1">Alasan Penolakan <span class="text-red-500">*</span></label>
                    <textarea name="catatan" rows="3" required
                        class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500"
                        placeholder="Jelaskan alasan penolakan"></textarea>
                </div>
                <button type="submit" 
                    onclick="return confirm('Apakah Anda yakin ingin menolak pembayaran ini?')"
                    class="w-full py-2.5 bg-red-500 hover:bg-red-600 text-white rounded-lg font-medium transition-colors">
                    Tolak Pembayaran
                </button>
            </form>
        </div>
    </div>
    @endif
</div>
@endsection
