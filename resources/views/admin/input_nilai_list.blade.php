@extends('layouts.admin')

@section('title', 'Input Nilai Tes - PPDB Admin')

@section('content')
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-slate-800">Input Nilai Tes Seleksi</h1>
        <p class="text-slate-600">Pilih siswa yang sudah terverifikasi untuk input nilai tes.</p>
    </div>

    @if(session('success'))
    <div class="mb-6 p-4 bg-[#047857]/10 border border-[#047857]/20 text-[#047857] rounded-lg flex items-center">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
        {{ session('success') }}
    </div>
    @endif

    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
        <table class="min-w-full divide-y divide-slate-200">
            <thead class="bg-slate-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Nama Siswa</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">NISN</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jurusan</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status Pendaftaran</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nilai</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($pendaftar as $item)
                <tr class="hover:bg-slate-50 transition">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="w-10 h-10 rounded-full bg-[#4276A3]/10 text-[#4276A3] flex items-center justify-center font-bold mr-3">
                                {{ substr($item->calonSiswa->nama, 0, 1) }}
                            </div>
                            <div>
                                <div class="text-sm font-medium text-slate-800">{{ $item->calonSiswa->nama }}</div>
                                <div class="text-sm text-gray-500">{{ $item->calonSiswa->asal_sekolah }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 font-mono">{{ $item->calonSiswa->nisn }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 py-1 bg-[#4276A3]/10 text-[#4276A3] rounded text-xs font-bold">{{ $item->jurusan->kode }}</span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($item->status_pendaftaran == 'Selesai Tes')
                            <span class="px-2 py-1 bg-blue-100 text-blue-700 rounded-full text-xs font-bold">Selesai Tes</span>
                        @elseif($item->status_pendaftaran == 'Diverifikasi')
                            <span class="px-2 py-1 bg-[#B45309]/10 text-[#B45309] rounded-full text-xs font-bold">Diverifikasi</span>
                        @else
                            <span class="px-2 py-1 bg-slate-100 text-slate-700 rounded-full text-xs font-bold">{{ $item->status_pendaftaran }}</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                        @if($item->tes)
                            <div class="space-y-1">
                                <span class="block text-gray-600">BTQ: <strong>{{ $item->tes->nilai_btq ?? '-' }}</strong></span>
                                <span class="block text-gray-600">M&B: <strong>{{ $item->tes->nilai_minat_bakat ?? '-' }}</strong></span>
                                <span class="block text-gray-600">Kejuruan: <strong>{{ $item->tes->nilai_kejuruan ?? '-' }}</strong></span>
                            </div>
                        @else
                            <span class="text-slate-400">Belum diisi</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-center">
                        <a href="{{ route('admin.input_nilai', $item->id) }}" class="btn btn-primary">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                            Input Nilai
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                        <div class="flex flex-col items-center">
                            <svg class="w-12 h-12 text-slate-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                            <p>Belum ada siswa yang siap untuk input nilai.</p>
                            <p class="text-sm text-gray-400 mt-1">Pastikan siswa sudah diverifikasi berkas terlebih dahulu.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
        
        @if($pendaftar->hasPages())
        <div class="px-6 py-4 border-t border-slate-200">
            {{ $pendaftar->links() }}
        </div>
        @endif
    </div>
@endsection
