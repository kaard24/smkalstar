@extends('layouts.admin')

@section('title', 'Verifikasi Berkas - Admin Panel')

@section('content')
    @if(isset($pendaftaran))
        <!-- Detail View -->
        <div class="flex items-center mb-6">
            <a href="{{ route('admin.verifikasi.index') }}" class="mr-4 text-gray-500 hover:text-gray-700">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </a>
            <h1 class="text-2xl font-bold text-gray-800">Verifikasi Dokumen: {{ $pendaftaran->calonSiswa->nama }}</h1>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Student Info -->
            <div class="lg:col-span-1 space-y-6">
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                    <h3 class="font-bold text-gray-900 mb-4 border-b pb-2">Informasi Siswa</h3>
                    <div class="space-y-3 text-sm">
                        <div>
                            <span class="block text-gray-500">NISN</span>
                            <span class="font-medium text-gray-900">{{ $pendaftaran->calonSiswa->nisn }}</span>
                        </div>
                        <div>
                            <span class="block text-gray-500">Nama Lengkap</span>
                            <span class="font-medium text-gray-900">{{ $pendaftaran->calonSiswa->nama }}</span>
                        </div>
                        <div>
                            <span class="block text-gray-500">Jurusan Pilihan</span>
                            <span class="font-medium text-primary">{{ $pendaftaran->jurusan->nama }}</span>
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
                        <button type="submit" class="w-full bg-blue-600 text-white font-bold py-2 rounded-lg hover:bg-blue-700 transition">
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
                        <div class="p-4 rounded-lg border {{ $berkas->status_verifikasi == 'Valid' ? 'bg-blue-50 border-blue-200' : ($berkas->status_verifikasi == 'Tidak Valid' ? 'bg-red-50 border-red-200' : 'bg-gray-50 border-gray-200') }}">
                            <div class="flex items-start justify-between">
                                <div>
                                    <h4 class="font-bold text-sm text-gray-800">{{ $berkas->nama_jenis }}</h4>
                                    <p class="text-xs text-gray-500 mt-1">{{ $berkas->created_at->format('d M Y H:i') }}</p>
                                    <div class="mt-2">
                                         <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium {{ $berkas->status_verifikasi == 'Valid' ? 'bg-blue-100 text-blue-800' : ($berkas->status_verifikasi == 'Tidak Valid' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                                            {{ $berkas->status_verifikasi }}
                                        </span>
                                    </div>
                                </div>
                                <a href="{{ route('admin.berkas.download', $berkas->id) }}" target="_blank" class="flex items-center text-blue-600 hover:text-blue-800 text-sm font-medium">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                                    Lihat
                                </a>
                            </div>
                            @if($berkas->catatan)
                            <div class="mt-2 text-xs text-red-600 bg-white p-2 rounded border border-red-100">
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
        <div class="mb-6 p-4 bg-blue-50 border border-blue-200 text-blue-700 rounded-lg">{{ session('success') }}</div>
        @endif

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">NISN</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Jurusan</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal Daftar</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($pendaftar ?? [] as $item)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 font-medium text-gray-900">{{ $item->calonSiswa->nama }}</td>
                        <td class="px-6 py-4 text-gray-600 font-mono text-sm">{{ $item->calonSiswa->nisn }}</td>
                        <td class="px-6 py-4"><span class="px-2 py-1 bg-blue-100 text-blue-700 rounded text-xs font-bold">{{ $item->jurusan->kode }}</span></td>
                        <td class="px-6 py-4 text-gray-600">{{ $item->created_at->format('d M Y') }}</td>
                        <td class="px-6 py-4 text-center">
                            <a href="{{ route('admin.verifikasi.show', $item->id) }}" class="text-primary hover:text-blue-600 font-medium text-sm">Verifikasi</a>
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
            <div class="px-6 py-4 border-t">{{ $pendaftar->links() }}</div>
            @endif
        </div>
    @endif
@endsection
