@extends('layouts.admin')

@section('title', 'Daftar Pendaftar - Admin Panel')

@section('content')
    {{-- Header Section --}}
    <div class="mb-6">
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-slate-800">Data Calon Siswa</h1>
                <p class="text-sm text-slate-500 mt-1">Kelola data pendaftar PPDB SMK Al-Hidayah Lestari</p>
            </div>
            <div class="flex flex-wrap gap-2 items-center">
                <a href="{{ route('admin.pendaftar.create') }}" 
                   class="btn btn-primary">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Tambah Siswa
                </a>
                <a href="{{ route('admin.pendaftar.export', request()->query()) }}" 
                   class="btn btn-success">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    Export Excel
                </a>
                <div class="px-4 py-2 bg-slate-100 text-slate-700 rounded-lg font-medium text-sm border border-slate-200">
                    Total: {{ $pendaftar->total() }} siswa
                </div>
            </div>
        </div>
    </div>

    {{-- Alert Messages --}}
    @if(session('success'))
    <div class="mb-4 p-4 bg-[#047857]/10 border border-[#047857]/20 text-[#047857] rounded-lg flex items-center text-sm">
        <svg class="w-5 h-5 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
        </svg>
        {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="mb-4 p-4 bg-[#991B1B]/10 border border-[#991B1B]/20 text-[#991B1B] rounded-lg flex items-center text-sm">
        <svg class="w-5 h-5 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
        </svg>
        {{ session('error') }}
    </div>
    @endif

    {{-- Search and Filter Section --}}
    <div class="mb-4 card p-4">
        <h3 class="text-sm font-semibold text-slate-800 mb-3 flex items-center gap-2">
            <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
            Filter Data
        </h3>
        <form action="{{ route('admin.pendaftar.index') }}" method="GET" class="flex flex-wrap gap-3 items-end">
            {{-- Search Input --}}
            <div class="flex-1 min-w-[250px]">
                <label for="search" class="block text-xs font-medium text-slate-600 mb-1">Kata Kunci</label>
                <div class="relative">
                    <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400 pointer-events-none z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    <input type="text" name="search" id="search" value="{{ request('search') }}" 
                           placeholder="Nama, NISN, atau No. WA..." 
                           style="padding-left: 2.5rem;"
                           class="form-input">
                </div>
            </div>

            {{-- Jurusan Filter --}}
            <div class="w-48">
                <label for="jurusan" class="block text-xs font-medium text-slate-600 mb-1">Jurusan</label>
                <select name="jurusan" id="jurusan" class="form-input">
                    <option value="">Semua Jurusan</option>
                    @foreach($jurusanList as $jurusan)
                        <option value="{{ $jurusan->id }}" {{ request('jurusan') == $jurusan->id ? 'selected' : '' }}>
                            {{ $jurusan->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Status Filter --}}
            <div class="w-48">
                <label for="status" class="block text-xs font-medium text-slate-600 mb-1">Status Pendaftaran</label>
                <select name="status" id="status" class="form-input">
                    <option value="">Semua Status</option>
                    <option value="baru" {{ request('status') == 'baru' ? 'selected' : '' }}>Baru Daftar</option>
                    <option value="proses_data" {{ request('status') == 'proses_data' ? 'selected' : '' }}>Proses Data</option>
                    <option value="proses_berkas" {{ request('status') == 'proses_berkas' ? 'selected' : '' }}>Proses Berkas</option>
                    <option value="lengkap" {{ request('status') == 'lengkap' ? 'selected' : '' }}>Data Lengkap</option>
                    <option value="lulus" {{ request('status') == 'lulus' ? 'selected' : '' }}>Sudah Lulus</option>
                </select>
            </div>

            {{-- Wawancara Filter --}}
            <div class="w-48">
                <label for="wawancara" class="block text-xs font-medium text-slate-600 mb-1">Status Wawancara</label>
                <select name="wawancara" id="wawancara" class="form-input">
                    <option value="">Semua</option>
                    <option value="belum" {{ request('wawancara') == 'belum' ? 'selected' : '' }}>Belum Wawancara</option>
                    <option value="sudah" {{ request('wawancara') == 'sudah' ? 'selected' : '' }}>Sudah Wawancara</option>
                </select>
            </div>

            {{-- Action Buttons --}}
            <div class="flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    Cari
                </button>
                @if(request('search') || request('jurusan') || request('status') || request('wawancara'))
                <a href="{{ route('admin.pendaftar.index') }}" class="btn btn-secondary">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                    Reset
                </a>
                @endif
            </div>
        </form>
    </div>

    {{-- Data Table --}}
    <div class="card overflow-hidden">
        <div class="overflow-x-auto">
            <table class="data-table">
                <thead>
                    <tr>
                        <th class="w-12 text-center">No</th>
                        <th>Nama</th>
                        <th>NISN</th>
                        <th>Jurusan</th>
                        <th>Berkas</th>
                        <th>Status</th>
                        <th class="text-center w-24">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pendaftar as $index => $siswa)
                    @php
                        $isComplete = $siswa->isRegistrationComplete();
                        $hasPendaftaran = $siswa->pendaftaran !== null;
                        $berkasProgress = \App\Models\BerkasPendaftaran::getUploadProgress($siswa->id);
                        $nomor = ($pendaftar->currentPage() - 1) * $pendaftar->perPage() + $index + 1;
                    @endphp
                    <tr class="cursor-pointer" onclick="window.location='{{ route('admin.pendaftar.show', $siswa->id) }}'">
                        <td class="text-center text-slate-500">{{ $nomor }}</td>
                        <td>
                            <div class="font-medium text-slate-800">{{ $siswa->nama }}</div>
                            <div class="text-xs text-slate-400 mt-0.5">{{ $siswa->no_wa ?? '-' }}</div>
                        </td>
                        <td>
                            <span class="font-mono text-slate-600 text-xs">{{ $siswa->nisn }}</span>
                        </td>
                        <td>
                            @if($siswa->pendaftaran && $siswa->pendaftaran->jurusan)
                                <span class="badge badge-info">
                                    {{ $siswa->pendaftaran->jurusan->kode }}
                                </span>
                            @else
                                <span class="badge badge-secondary">
                                    Belum Pilih
                                </span>
                            @endif
                        </td>
                        <td>
                            <div class="flex items-center gap-2">
                                <div class="flex-1 w-20 bg-slate-200 rounded-full h-1.5">
                                    <div class="bg-[#4276A3] h-1.5 rounded-full transition-all" style="width: {{ $berkasProgress['percentage'] }}%"></div>
                                </div>
                                <span class="text-xs font-medium text-slate-600 whitespace-nowrap">
                                    {{ $berkasProgress['uploaded'] }}/{{ $berkasProgress['total'] }}
                                </span>
                            </div>
                            @if($berkasProgress['is_complete'])
                                <span class="text-xs text-[#047857] font-medium">Lengkap</span>
                            @elseif($berkasProgress['uploaded'] > 0)
                                <span class="text-xs text-[#B45309]">Proses</span>
                            @else
                                <span class="text-xs text-slate-400">Belum Upload</span>
                            @endif
                        </td>
                        <td>
                            @if($hasPendaftaran && $isComplete && $berkasProgress['is_complete'])
                                <span class="badge badge-success">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    Siap Tes
                                </span>
                            @elseif($hasPendaftaran && $isComplete)
                                <span class="badge badge-info">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4"/>
                                    </svg>
                                    Data Lengkap
                                </span>
                            @elseif($hasPendaftaran)
                                <span class="badge badge-warning">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    Proses
                                </span>
                            @else
                                <span class="badge badge-secondary">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                    </svg>
                                    Baru
                                </span>
                            @endif
                        </td>
                        <td>
                            <div class="flex gap-2 justify-center" onclick="event.stopPropagation();">
                                <a href="{{ route('admin.pendaftar.edit', $siswa->id) }}" 
                                   class="btn btn-sm btn-secondary">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                    Edit
                                </a>
                                <form action="{{ route('admin.pendaftar.destroy', $siswa->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus data ini?');event.stopPropagation();">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                        <td colspan="7" class="px-6 py-8 text-center text-slate-500">
                            <div class="flex flex-col items-center">
                                <svg class="w-12 h-12 text-slate-300 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <p class="text-sm font-medium">Tidak ada data ditemukan</p>
                                <p class="text-xs mt-1 text-slate-400">Coba ubah kata kunci pencarian</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        {{-- Pagination --}}
        <div class="px-4 py-3 border-t border-slate-200 bg-slate-50">
            {{ $pendaftar->links() }}
        </div>
    </div>

    {{-- Info Cards --}}
    <div class="mt-4 grid md:grid-cols-4 gap-3">
        <div class="bg-[#047857]/10 border border-[#047857]/20 rounded-lg p-3">
            <h4 class="font-semibold text-[#047857] mb-1 flex items-center gap-2 text-xs">
                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                Siap Tes
            </h4>
            <p class="text-[#047857]/80 text-xs">Data & berkas lengkap</p>
        </div>
        <div class="bg-[#4276A3]/10 border border-[#4276A3]/20 rounded-lg p-3">
            <h4 class="font-semibold text-[#4276A3] mb-1 flex items-center gap-2 text-xs">
                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" clip-rule="evenodd"/>
                </svg>
                Data Lengkap
            </h4>
            <p class="text-[#4276A3]/80 text-xs">Biodata lengkap, berkas belum</p>
        </div>
        <div class="bg-[#B45309]/10 border border-[#B45309]/20 rounded-lg p-3">
            <h4 class="font-semibold text-[#B45309] mb-1 flex items-center gap-2 text-xs">
                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                </svg>
                Proses
            </h4>
            <p class="text-[#B45309]/80 text-xs">Data belum lengkap</p>
        </div>
        <div class="bg-slate-100 border border-slate-200 rounded-lg p-3">
            <h4 class="font-semibold text-slate-700 mb-1 flex items-center gap-2 text-xs">
                <svg class="w-3 h-3 text-slate-500" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                </svg>
                Baru
            </h4>
            <p class="text-slate-500 text-xs">Siswa baru mendaftar</p>
        </div>
    </div>
@endsection
