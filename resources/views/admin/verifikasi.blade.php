@extends('layouts.admin')

@section('title', 'Verifikasi Berkas - Admin Panel')

@section('content')
    @if(isset($pendaftaran))
        <!-- Detail View -->
        <div class="flex items-center mb-6">
            <a href="{{ route('admin.verifikasi.index') }}" class="mr-4 text-slate-500 hover:text-slate-700">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </a>
            <h1 class="text-2xl font-bold text-slate-800">Verifikasi Dokumen: {{ $pendaftaran->calonSiswa->nama }}</h1>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Student Info -->
            <div class="lg:col-span-1 space-y-6">
                <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200">
                    <h3 class="font-bold text-slate-800 mb-4 border-b border-slate-200 pb-2">Informasi Siswa</h3>
                    <div class="space-y-3 text-sm">
                        <div>
                            <span class="block text-slate-500">NISN</span>
                            <span class="font-medium text-slate-800">{{ $pendaftaran->calonSiswa->nisn }}</span>
                        </div>
                        <div>
                            <span class="block text-gray-500">Nama Lengkap</span>
                            <span class="font-medium text-gray-900">{{ $pendaftaran->calonSiswa->nama }}</span>
                        </div>
                        <div>
                            <span class="block text-gray-500">Jurusan Pilihan</span>
                            <span class="font-medium text-[#4276A3]">{{ $pendaftaran->jurusan->nama }}</span>
                        </div>
                        <div>
                            <span class="block text-gray-500">Tanggal Daftar</span>
                            <span class="font-medium text-gray-900">{{ $pendaftaran->created_at->format('d M Y') }}</span>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                    <h3 class="font-bold text-gray-900 mb-4 border-b pb-2">Aksi Validasi</h3>
                    <form action="{{ route('admin.verifikasi.verify', $pendaftaran->id) }}" method="POST" class="space-y-3">
                        @csrf
                        <button type="submit" class="btn btn-primary w-full">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Setujui & Verifikasi
                        </button>
                    </form>
                </div>
            </div>

            <!-- Documents Preview -->
            <div class="lg:col-span-2 space-y-8">
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                    <h3 class="font-bold text-gray-900 mb-4">Data Siswa</h3>
                    <div class="grid grid-cols-2 gap-4 text-sm">
                        <div><span class="text-gray-500">Alamat:</span> <span class="font-medium">{{ $pendaftaran->calonSiswa->alamat }}</span></div>
                        <div><span class="text-gray-500">No. WA:</span> <span class="font-medium">{{ $pendaftaran->calonSiswa->no_wa }}</span></div>
                        <div><span class="text-gray-500">Asal Sekolah:</span> <span class="font-medium">{{ $pendaftaran->calonSiswa->asal_sekolah }}</span></div>
                        <div><span class="text-gray-500">Jenis Kelamin:</span> <span class="font-medium">{{ $pendaftaran->calonSiswa->jk == 'L' ? 'Laki-laki' : 'Perempuan' }}</span></div>
                    </div>
                </div>
                
                @if($pendaftaran->calonSiswa->orangTua)
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                    <h3 class="font-bold text-gray-900 mb-4">Data Orang Tua</h3>
                    <div class="grid grid-cols-2 gap-4 text-sm">
                        <div><span class="text-gray-500">Nama Ayah:</span> <span class="font-medium">{{ $pendaftaran->calonSiswa->orangTua->nama_ayah }}</span></div>
                        <div><span class="text-gray-500">Nama Ibu:</span> <span class="font-medium">{{ $pendaftaran->calonSiswa->orangTua->nama_ibu }}</span></div>
                        <div><span class="text-gray-500">No. WA Ortu:</span> <span class="font-medium">{{ $pendaftaran->calonSiswa->orangTua->no_wa_ortu }}</span></div>
                        <div><span class="text-gray-500">Pekerjaan:</span> <span class="font-medium">{{ $pendaftaran->calonSiswa->orangTua->pekerjaan }}</span></div>
                    </div>
                </div>
                @endif

                @if($pendaftaran->calonSiswa->berkasPendaftaran->count() > 0)
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                    <h3 class="font-bold text-gray-900 mb-4">Berkas Dokumen</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach($pendaftaran->calonSiswa->berkasPendaftaran as $berkas)
                        <div class="p-4 rounded-lg border {{ $berkas->status_verifikasi == 'Valid' ? 'bg-[#4276A3]/10 border-[#4276A3]/20' : ($berkas->status_verifikasi == 'Tidak Valid' ? 'bg-[#991B1B]/10 border-[#991B1B]/20' : 'bg-slate-50 border-slate-200') }}">
                            <div class="flex items-start justify-between">
                                <div>
                                    <h4 class="font-bold text-sm text-slate-800">{{ $berkas->nama_jenis }}</h4>
                                    <p class="text-xs text-gray-500 mt-1">{{ $berkas->created_at->format('d M Y H:i') }}</p>
                                    <div class="mt-2">
                                         <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium {{ $berkas->status_verifikasi == 'Valid' ? 'bg-[#4276A3]/10 text-[#4276A3]' : ($berkas->status_verifikasi == 'Tidak Valid' ? 'bg-[#991B1B]/10 text-[#991B1B]' : 'bg-[#B45309]/10 text-[#B45309]') }}">
                                            {{ $berkas->status_verifikasi }}
                                        </span>
                                    </div>
                                </div>
                                <a href="{{ route('admin.berkas.download', $berkas->id) }}" target="_blank" class="btn btn-sm btn-info">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                                    </svg>
                                    Lihat
                                </a>
                            </div>
                            @if($berkas->catatan)
                            <div class="mt-2 text-xs text-[#991B1B] bg-white p-2 rounded border border-[#991B1B]/20">
                                Catatan: {{ $berkas->catatan }}
                            </div>
                            @endif
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
        </div>
    @else
        <!-- List View -->
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Verifikasi Berkas Pendaftar</h1>

        @if(session('success'))
        <div class="mb-6 p-4 bg-[#047857]/10 border border-[#047857]/20 text-[#047857] rounded-lg">{{ session('success') }}</div>
        @endif

        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
            <table class="min-w-full divide-y divide-slate-200">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase">Nama</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">NISN</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Jurusan</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal Daftar</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($pendaftar ?? [] as $item)
                    <tr class="hover:bg-slate-50 transition">
                        <td class="px-6 py-4 font-medium text-gray-900">{{ $item->calonSiswa->nama }}</td>
                        <td class="px-6 py-4 text-slate-600 font-mono text-sm">{{ $item->calonSiswa->nisn }}</td>
                        <td class="px-6 py-4"><span class="px-2 py-1 bg-[#4276A3]/10 text-[#4276A3] rounded text-xs font-bold">{{ $item->jurusan->kode }}</span></td>
                        <td class="px-6 py-4 text-gray-600">{{ $item->created_at->format('d M Y') }}</td>
                        <td class="px-6 py-4 text-center">
                            <a href="{{ route('admin.verifikasi.show', $item->id) }}" class="btn btn-sm btn-primary">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Verifikasi
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center text-gray-500">Tidak ada pendaftar yang perlu diverifikasi.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            @if(isset($pendaftar) && $pendaftar->hasPages())
            <div class="px-6 py-4 border-t border-slate-200">{{ $pendaftar->links() }}</div>
            @endif
        </div>
    @endif
@endsection
