@extends('layouts.admin')

@section('title', 'Pengaturan Pembayaran - Admin Panel')

@section('content')
    {{-- Header --}}
    <div class="mb-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-lg font-semibold text-slate-800">Pengaturan Pembayaran</h1>
                <p class="text-sm text-slate-600 mt-1">Kelola nama penerima dan biaya pendaftaran</p>
            </div>
            <a href="{{ route('admin.pembayaran-pengaturan.create') }}" class="btn btn-primary">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Tambah Pengaturan
            </a>
        </div>
    </div>

    {{-- Alerts --}}
    @if(session('success'))
    <div class="mb-4 p-3 bg-[#4276A3]/10 border border-[#4276A3]/20 text-[#4276A3] rounded-lg text-sm">
        {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="mb-4 p-3 bg-[#991B1B]/10 border border-[#991B1B]/20 text-[#991B1B] rounded-lg text-sm">
        {{ session('error') }}
    </div>
    @endif

    {{-- Active Setting Card --}}
    @php
        $activeSetting = \App\Models\PengaturanPembayaran::getActive();
    @endphp
    @if($activeSetting)
    <div class="mb-6 card p-4 border-l-4 border-green-500 bg-green-50/50">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="text-sm font-semibold text-slate-800 flex items-center gap-2">
                    <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Pengaturan Aktif Saat Ini
                </h3>
                <div class="mt-2 text-sm text-slate-600">
                    <p><span class="font-medium">Penerima:</span> {{ $activeSetting->nama_penerima }}</p>
                    @if($activeSetting->bank || $activeSetting->nomor_rekening)
                    <p><span class="font-medium">Rekening:</span> {{ $activeSetting->bank }} {{ $activeSetting->nomor_rekening ? '- ' . $activeSetting->nomor_rekening : '' }}</p>
                    @endif
                    <p><span class="font-medium">Biaya:</span> {{ $activeSetting->biaya_formatted }}</p>
                </div>
            </div>
            <a href="{{ route('admin.pembayaran-pengaturan.edit', $activeSetting) }}" class="btn btn-sm btn-secondary">
                Edit
            </a>
        </div>
    </div>
    @endif

    {{-- Table --}}
    <div class="card overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200">
                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-600">Status</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-600">Nama Penerima</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-600">Biaya</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-600">Keterangan</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-600">Dibuat Oleh</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-600">Terakhir Update</th>
                        <th class="px-4 py-3 text-center text-xs font-semibold text-slate-600">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($pengaturan as $item)
                    <tr class="hover:bg-slate-50/50">
                        <td class="px-4 py-3">
                            @if($item->is_active)
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-green-100 text-green-700">
                                    Aktif
                                </span>
                            @else
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-slate-100 text-slate-600">
                                    Nonaktif
                                </span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-sm text-slate-800 font-medium">
                            {{ $item->nama_penerima }}
                            @if($item->bank || $item->nomor_rekening)
                            <p class="text-xs text-slate-500 mt-0.5">{{ $item->bank }} {{ $item->nomor_rekening ? '- ' . $item->nomor_rekening : '' }}</p>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-sm text-slate-600">{{ $item->biaya_formatted }}</td>
                        <td class="px-4 py-3 text-sm text-slate-500 max-w-xs truncate" title="{{ $item->keterangan }}">
                            {{ $item->keterangan ?? '-' }}
                        </td>
                        <td class="px-4 py-3 text-sm text-slate-600">{{ $item->createdBy?->nama ?? '-' }}</td>
                        <td class="px-4 py-3 text-sm text-slate-500">
                            {{ $item->updated_at->format('d/m/Y H:i') }}
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex items-center justify-center gap-1">
                                <form action="{{ route('admin.pembayaran-pengaturan.toggle-active', $item) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="p-1.5 rounded hover:bg-slate-100 {{ $item->is_active ? 'text-green-600' : 'text-slate-400' }}" title="{{ $item->is_active ? 'Nonaktifkan' : 'Aktifkan' }}">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                    </button>
                                </form>
                                <a href="{{ route('admin.pembayaran-pengaturan.edit', $item) }}" class="p-1.5 rounded hover:bg-slate-100 text-[#4276A3]" title="Edit">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                </a>
                                <form action="{{ route('admin.pembayaran-pengaturan.destroy', $item) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus pengaturan ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-1.5 rounded hover:bg-slate-100 text-[#991B1B]" title="Hapus">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-4 py-8 text-center text-slate-500">
                            <svg class="w-12 h-12 mx-auto mb-3 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            <p>Belum ada pengaturan pembayaran</p>
                            <a href="{{ route('admin.pembayaran-pengaturan.create') }}" class="text-[#4276A3] hover:underline mt-1 inline-block">Tambah pengaturan baru</a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($pengaturan->hasPages())
        <div class="px-4 py-3 border-t border-slate-200">
            {{ $pengaturan->links() }}
        </div>
        @endif
    </div>
@endsection
