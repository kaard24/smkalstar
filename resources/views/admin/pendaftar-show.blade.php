@extends('layouts.admin')

@section('title', 'Detail Calon Siswa - Admin Panel')

@section('content')
    <div class="mb-6">
        <a href="{{ route('admin.pendaftar.index') }}" class="inline-flex items-center text-slate-500 hover:text-[#4276A3]">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali ke Daftar
        </a>
    </div>

    <div class="mb-6 flex justify-between items-start">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">Detail Calon Siswa</h1>
            <p class="text-slate-600">{{ $siswa->nama }} - {{ $siswa->nisn }}</p>
        </div>
        <div class="flex gap-2">
            <a href="{{ route('admin.pendaftar.edit', $siswa->id) }}" class="btn btn-warning">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                </svg>
                Edit Data
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        {{-- Data Siswa --}}
        <div class="bg-white rounded-xl shadow-sm border border-slate-100 p-6">
            <h3 class="font-bold text-slate-800 mb-4 border-b pb-2">Data Siswa</h3>
            <div class="space-y-3 text-sm">
                <div>
                    <span class="block text-slate-500">NISN</span>
                    <span class="font-medium text-slate-800 font-mono">{{ $siswa->nisn }}</span>
                </div>
                <div>
                    <span class="block text-slate-500">Nama Lengkap</span>
                    <span class="font-medium text-slate-800">{{ $siswa->nama }}</span>
                </div>
                <div>
                    <span class="block text-slate-500">Jenis Kelamin</span>
                    <span class="font-medium text-slate-800">{{ $siswa->jk == 'L' ? 'Laki-laki' : ($siswa->jk == 'P' ? 'Perempuan' : '-') }}</span>
                </div>
                <div>
                    <span class="block text-slate-500">Tanggal Lahir</span>
                    <span class="font-medium text-slate-800">{{ $siswa->tgl_lahir?->format('d M Y') ?? '-' }}</span>
                </div>
                <div>
                    <span class="block text-slate-500">No. WhatsApp</span>
                    <span class="font-medium text-slate-800">{{ $siswa->no_wa ?? '-' }}</span>
                </div>
                <div>
                    <span class="block text-slate-500">Asal Sekolah</span>
                    <span class="font-medium text-slate-800">{{ $siswa->asal_sekolah ?? '-' }}</span>
                </div>
                <div>
                    <span class="block text-slate-500">Alamat</span>
                    <span class="font-medium text-slate-800">{{ $siswa->alamat ?? '-' }}</span>
                </div>
            </div>
        </div>

        {{-- Data Pendaftaran & Orang Tua --}}
        <div class="space-y-6">
            <div class="bg-white rounded-xl shadow-sm border border-slate-100 p-6">
                <h3 class="font-bold text-slate-800 mb-4 border-b pb-2">Data Pendaftaran</h3>
                <div class="space-y-3 text-sm">
                    @if($siswa->pendaftaran)
                    <div>
                        <span class="block text-slate-500">Jurusan Pilihan</span>
                        <span class="font-bold text-[#4276A3]">{{ $siswa->pendaftaran->jurusan->nama ?? '-' }}</span>
                    </div>
                    <div>
                        <span class="block text-slate-500">Gelombang</span>
                        <span class="font-medium text-slate-800">{{ $siswa->pendaftaran->gelombang ?? '-' }}</span>
                    </div>
                    <div>
                        <span class="block text-slate-500">Tanggal Daftar</span>
                        <span class="font-medium text-slate-800">{{ $siswa->pendaftaran->created_at->format('d M Y H:i') }}</span>
                    </div>
                    <div>
                        <span class="block text-slate-500">Status</span>
                        <span class="inline-flex px-2 py-1 bg-[#4276A3]/10 text-[#4276A3] rounded text-xs font-bold">{{ $siswa->pendaftaran->status_pendaftaran }}</span>
                    </div>
                    @else
                    <p class="text-slate-500 italic">Belum melengkapi data pendaftaran.</p>
                    @endif
                </div>
            </div>

            @if($siswa->orangTua)
            <div class="bg-white rounded-xl shadow-sm border border-slate-100 p-6">
                <h3 class="font-bold text-slate-800 mb-4 border-b pb-2">Data Orang Tua</h3>
                <div class="space-y-3 text-sm">
                    <div>
                        <span class="block text-slate-500">Nama Ayah</span>
                        <span class="font-medium text-slate-800">{{ $siswa->orangTua->nama_ayah ?? '-' }}</span>
                    </div>
                    <div>
                        <span class="block text-slate-500">Nama Ibu</span>
                        <span class="font-medium text-slate-800">{{ $siswa->orangTua->nama_ibu ?? '-' }}</span>
                    </div>
                    <div>
                        <span class="block text-slate-500">Pekerjaan</span>
                        <span class="font-medium text-slate-800">{{ $siswa->orangTua->pekerjaan ?? '-' }}</span>
                    </div>
                    <div>
                        <span class="block text-slate-500">No. WA Orang Tua</span>
                        <span class="font-medium text-slate-800">{{ $siswa->orangTua->no_wa_ortu ?? '-' }}</span>
                    </div>
                </div>
            </div>
            @endif
        </div>

        {{-- Berkas Upload dengan Progress --}}
        <div class="bg-white rounded-xl shadow-sm border border-slate-100 p-6">
            @php
                $berkasProgress = \App\Models\BerkasPendaftaran::getUploadProgress($siswa->id);
            @endphp
            
            <div class="flex items-center justify-between mb-4 border-b pb-2">
                <h3 class="font-bold text-slate-800">Progress Upload Berkas</h3>
                <span class="text-sm font-bold {{ $berkasProgress['is_complete'] ? 'text-[#4276A3]' : 'text-[#B45309]' }}">
                    {{ $berkasProgress['uploaded'] }}/{{ $berkasProgress['total'] }}
                </span>
            </div>
            
            {{-- Progress Bar --}}
            <div class="mb-6">
                <div class="w-full bg-slate-200 rounded-full h-3">
                    <div class="bg-[#4276A3] h-3 rounded-full transition-all duration-500" style="width: {{ $berkasProgress['percentage'] }}%"></div>
                </div>
                <p class="text-xs text-slate-500 mt-2">
                    @if($berkasProgress['is_complete'])
                        <span class="flex items-center gap-1"><svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> Semua berkas telah diupload</span>
                    @else
                        {{ $berkasProgress['total'] - $berkasProgress['uploaded'] }} berkas belum diupload
                    @endif
                </p>
            </div>
            
            {{-- Detail Berkas --}}
            <h4 class="font-semibold text-sm text-slate-700 mb-3">Detail Berkas</h4>
            <div class="space-y-2">
                @foreach($berkasProgress['detail'] as $key => $item)
                <div class="flex items-start justify-between p-3 rounded-lg {{ $item['uploaded'] ? 'bg-blue-50 border border-blue-100' : 'bg-slate-50 border border-slate-100' }}">
                    <div class="flex items-start gap-3">
                        <div class="w-6 h-6 rounded-full {{ $item['uploaded'] ? 'bg-[#4276A3]' : 'bg-gray-300' }} flex items-center justify-center flex-shrink-0 mt-0.5">
                            @if($item['uploaded'])
                            <svg class="w-3.5 h-3.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                            </svg>
                            @else
                            <span class="text-xs text-white font-bold">{{ $loop->iteration }}</span>
                            @endif
                        </div>
                        <div>
                            <span class="text-sm {{ $item['uploaded'] ? 'text-[#4276A3] font-medium' : 'text-slate-600' }}">{{ $item['label'] }}</span>
                            @if(isset($item['keterangan']) && $item['keterangan'])
                            <p class="text-xs text-slate-500 mt-0.5">{{ $item['keterangan'] }}</p>
                            @endif
                        </div>
                    </div>
                    @if($item['uploaded'])
                        @php
                            $berkasFile = $siswa->berkasPendaftaran->where('jenis_berkas', $key)->first();
                        @endphp
                        @if($berkasFile)
                        <a href="{{ route('admin.berkas.download', $berkasFile->id) }}" target="_blank" class="btn btn-sm btn-info">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                            </svg>
                            Unduh
                        </a>
                        @endif
                    @else
                        <span class="text-xs text-slate-400">Belum</span>
                    @endif
                </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
