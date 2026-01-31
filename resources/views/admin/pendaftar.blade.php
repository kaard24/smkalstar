@extends('layouts.admin')

@section('title', 'Daftar Pendaftar - Admin Panel')

@section('content')
    {{-- Header Section --}}
    <div class="mb-8">
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Data Calon Siswa</h1>
                <p class="text-lg text-gray-600">Kelola data pendaftar PPDB SMK Al-Hidayah Lestari</p>
            </div>
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('admin.pendaftar.export', request()->query()) }}" 
                   class="btn-large bg-green-600 text-white hover:bg-green-700 flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    Export Excel
                </a>
                <div class="px-6 py-3 bg-blue-100 text-blue-800 rounded-lg font-bold text-lg border-2 border-blue-300">
                    Total: {{ $pendaftar->total() }} siswa
                </div>
            </div>
        </div>
    </div>

    {{-- Alert Messages --}}
    @if(session('success'))
    <div class="mb-6 p-5 bg-green-50 border-2 border-green-300 text-green-800 rounded-xl flex items-center text-lg">
        <svg class="w-7 h-7 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
        </svg>
        {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="mb-6 p-5 bg-red-50 border-2 border-red-300 text-red-800 rounded-xl flex items-center text-lg">
        <svg class="w-7 h-7 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
        </svg>
        {{ session('error') }}
    </div>
    @endif

    {{-- Search and Filter Section --}}
    <div class="mb-6 bg-white rounded-xl border-2 border-gray-200 p-6 card-solid">
        <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">
            <svg class="w-6 h-6 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
            Cari Data
        </h3>
        <form action="{{ route('admin.pendaftar.index') }}" method="GET" class="flex flex-wrap gap-4 items-end">
            {{-- Search Input --}}
            <div class="flex-1 min-w-[300px]">
                <label for="search" class="block text-base font-bold text-gray-700 mb-2">Kata Kunci</label>
                <div class="relative">
                    <input type="text" name="search" id="search" value="{{ request('search') }}" 
                           placeholder="Masukkan nama, NISN, atau asal sekolah..." 
                           class="w-full pl-12 pr-4 input-large border-2 border-gray-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition">
                    <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
            </div>

            {{-- Jurusan Filter --}}
            <div class="w-64">
                <label for="jurusan" class="block text-base font-bold text-gray-700 mb-2">Filter Jurusan</label>
                <select name="jurusan" id="jurusan" class="w-full px-4 input-large border-2 border-gray-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition bg-white">
                    <option value="">-- Semua Jurusan --</option>
                    @foreach($jurusanList as $jurusan)
                        <option value="{{ $jurusan->id }}" {{ request('jurusan') == $jurusan->id ? 'selected' : '' }}>
                            {{ $jurusan->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Status Filter --}}
            <div class="w-56">
                <label for="status" class="block text-base font-bold text-gray-700 mb-2">Status Pendaftaran</label>
                <select name="status" id="status" class="w-full px-4 input-large border-2 border-gray-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition bg-white">
                    <option value="">-- Semua Status --</option>
                    <option value="baru" {{ request('status') == 'baru' ? 'selected' : '' }}>🆕 Baru Daftar</option>
                    <option value="proses" {{ request('status') == 'proses' ? 'selected' : '' }}>⏳ Dalam Proses</option>
                    <option value="lengkap" {{ request('status') == 'lengkap' ? 'selected' : '' }}>✅ Data Lengkap</option>
                </select>
            </div>

            {{-- Action Buttons --}}
            <div class="flex gap-3">
                <button type="submit" class="btn-large bg-primary text-white hover:bg-green-800 flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    Cari
                </button>
                @if(request('search') || request('jurusan') || request('status'))
                <a href="{{ route('admin.pendaftar.index') }}" class="btn-large bg-gray-200 text-gray-700 hover:bg-gray-300 flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                    Reset
                </a>
                @endif
            </div>
        </form>
    </div>

    {{-- Data Table --}}
    <div class="bg-white rounded-xl border-2 border-gray-200 overflow-hidden card-solid">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-gray-100 border-b-2 border-gray-300">
                    <tr>
                        <th class="px-6 py-5 font-bold text-gray-800 text-lg">Nama Lengkap</th>
                        <th class="px-6 py-5 font-bold text-gray-800 text-lg">NISN</th>
                        <th class="px-6 py-5 font-bold text-gray-800 text-lg">Jurusan</th>
                        <th class="px-6 py-5 font-bold text-gray-800 text-lg">Status</th>
                        <th class="px-6 py-5 font-bold text-gray-800 text-lg text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($pendaftar as $siswa)
                    <tr class="hover:bg-green-50 transition">
                        <td class="px-6 py-5">
                            <div class="font-bold text-gray-900 text-lg">{{ $siswa->nama }}</div>
                            <div class="text-base text-gray-600 mt-1">{{ $siswa->asal_sekolah ?? '-' }}</div>
                        </td>
                        <td class="px-6 py-5 text-gray-700 font-mono text-lg">{{ $siswa->nisn }}</td>
                        <td class="px-6 py-5">
                            @if($siswa->pendaftaran && $siswa->pendaftaran->jurusan)
                                <span class="badge-large bg-green-100 text-green-800 border border-green-300">
                                    {{ $siswa->pendaftaran->jurusan->kode }}
                                </span>
                            @else
                                <span class="badge-large bg-gray-100 text-gray-600 border border-gray-300">
                                    Belum Pilih
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-5">
                            @php
                                $isComplete = $siswa->isRegistrationComplete();
                                $hasPendaftaran = $siswa->pendaftaran !== null;
                            @endphp
                            @if($hasPendaftaran && $isComplete)
                                <span class="badge-large bg-green-100 text-green-800 border border-green-300">
                                    ✅ Lengkap
                                </span>
                            @elseif($hasPendaftaran)
                                <span class="badge-large bg-yellow-100 text-yellow-800 border border-yellow-300">
                                    ⏳ Proses
                                </span>
                            @else
                                <span class="badge-large bg-gray-100 text-gray-600 border border-gray-300">
                                    🆕 Baru
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-5">
                            <div class="flex gap-2 justify-center">
                                <a href="{{ route('admin.pendaftar.show', $siswa->id) }}" 
                                   class="px-4 py-2 bg-blue-100 text-blue-800 rounded-lg hover:bg-blue-200 text-base font-bold transition border-2 border-blue-300 flex items-center gap-1">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                    Lihat
                                </a>
                                <a href="{{ route('admin.pendaftar.edit', $siswa->id) }}" 
                                   class="px-4 py-2 bg-yellow-100 text-yellow-800 rounded-lg hover:bg-yellow-200 text-base font-bold transition border-2 border-yellow-300 flex items-center gap-1">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                    Edit
                                </a>
                                <form action="{{ route('admin.pendaftar.destroy', $siswa->id) }}" method="POST" 
                                      onsubmit="return confirm('Yakin ingin menghapus data calon siswa ini?')" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="px-4 py-2 bg-red-100 text-red-800 rounded-lg hover:bg-red-200 text-base font-bold transition border-2 border-red-300 flex items-center gap-1">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                            <div class="flex flex-col items-center">
                                <svg class="w-16 h-16 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <p class="text-xl font-medium">Tidak ada data ditemukan</p>
                                <p class="text-base mt-1">Coba ubah kata kunci pencarian</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        {{-- Pagination --}}
        <div class="px-6 py-5 border-t-2 border-gray-200 bg-gray-50">
            {{ $pendaftar->links() }}
        </div>
    </div>

    {{-- Info Cards --}}
    <div class="mt-8 grid md:grid-cols-3 gap-6">
        <div class="bg-green-50 border-2 border-green-200 rounded-xl p-5">
            <h4 class="font-bold text-green-900 mb-2 flex items-center gap-2">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                Status Lengkap
            </h4>
            <p class="text-green-800 text-base">Data siswa sudah lengkap dan siap diverifikasi</p>
        </div>
        <div class="bg-yellow-50 border-2 border-yellow-200 rounded-xl p-5">
            <h4 class="font-bold text-yellow-900 mb-2 flex items-center gap-2">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                </svg>
                Status Proses
            </h4>
            <p class="text-yellow-800 text-base">Data siswa belum lengkap, perlu dilengkapi</p>
        </div>
        <div class="bg-gray-50 border-2 border-gray-200 rounded-xl p-5">
            <h4 class="font-bold text-gray-900 mb-2 flex items-center gap-2">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                </svg>
                Status Baru
            </h4>
            <p class="text-gray-700 text-base">Siswa baru mendaftar, belum mengisi data</p>
        </div>
    </div>
@endsection
