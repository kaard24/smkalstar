@extends('layouts.admin')

@section('title', 'Status Kelulusan - Admin Panel')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-slate-800">Finalisasi Kelulusan Siswa</h1>
    </div>

    @if(session('success'))
    <div class="mb-6 p-4 bg-[#047857]/10 border border-[#047857]/20 text-[#047857] rounded-lg flex items-center">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
        {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="mb-6 p-4 bg-[#991B1B]/10 border border-[#991B1B]/20 text-[#991B1B] rounded-lg flex items-center">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        {{ session('error') }}
    </div>
    @endif

    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
        <table class="min-w-full divide-y divide-slate-200">
            <thead class="bg-slate-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Siswa</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Nilai BTQ</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nilai M&B</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nilai Kejuruan</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status Akhir</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($pendaftar as $item)
                <tr class="hover:bg-slate-50 transition">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div>
                                <div class="text-sm font-medium text-slate-800">{{ $item->calonSiswa->nama }}</div>
                                <div class="text-sm text-gray-500">{{ $item->jurusan->kode }} - {{ $item->calonSiswa->nisn }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="text-sm font-bold text-slate-800 bg-slate-100 px-2 py-1 rounded">{{ $item->tes->nilai_btq ?? '-' }}</span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="text-sm font-bold text-slate-800 bg-slate-100 px-2 py-1 rounded">{{ $item->tes->nilai_minat_bakat ?? '-' }}</span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="text-sm font-bold text-gray-900 bg-gray-100 px-2 py-1 rounded">{{ $item->tes->nilai_kejuruan ?? '-' }}</span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($item->tes && $item->tes->status_kelulusan == 'Lulus')
                            <span class="px-3 py-1 bg-[#4276A3]/10 text-[#4276A3] rounded-full text-xs font-bold">LULUS</span>
                        @elseif($item->tes && $item->tes->status_kelulusan == 'Tidak Lulus')
                            <span class="px-3 py-1 bg-[#991B1B]/10 text-[#991B1B] rounded-full text-xs font-bold">TIDAK LULUS</span>
                        @else
                            <span class="px-3 py-1 bg-[#B45309]/10 text-[#B45309] rounded-full text-xs font-bold">PENDING</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                        <div class="flex justify-center gap-2">
                            <a href="{{ route('admin.input_nilai', $item->id) }}" class="btn-icon btn-icon-edit btn-icon-sm" title="Edit Nilai">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                            </a>
                            <form action="{{ route('admin.kelulusan.notify', $item->id) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-success">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-3.138-5.437-2.1-11.966 3.038-16.148 5.462-4.446 13.532-4.088 18.575 1.14 5.043 5.228 5.61 13.332 1.348 19.32H.057z"/></svg>
                                    Kirim WA
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                        Belum ada data siswa yang selesai tes.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
        
        <div class="px-6 py-4 border-t border-slate-200">
            {{ $pendaftar->links() }}
        </div>
    </div>
@endsection
