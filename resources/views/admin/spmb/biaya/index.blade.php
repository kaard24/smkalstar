@extends('layouts.admin')

@section('title', 'Biaya SPMB - Admin Panel')

@section('content')
<div class="max-w-4xl mx-auto">
    {{-- Header --}}
    <div class="mb-8 flex flex-wrap items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">Rincian Biaya</h1>
            <p class="text-slate-600">Kelola rincian biaya pendaftaran SPMB.</p>
        </div>
        <button onclick="document.getElementById('modal-tambah').classList.remove('hidden')" class="btn btn-primary shadow-md hover:shadow-lg">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
            </svg>
            Tambah Biaya
        </button>
    </div>

    {{-- Alert --}}
    @if(session('success'))
    <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-xl flex items-center gap-2">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
        </svg>
        {{ session('success') }}
    </div>
    @endif

    @php
        $totalBiaya = $biaya->where('aktif', true)->sum('nominal');
    @endphp

    {{-- Preview Card --}}
    <div class="bg-gradient-to-br from-[#0EA5E9] to-[#1E3A5F] text-white rounded-3xl p-8 shadow-xl relative overflow-hidden mb-8">
        <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full blur-3xl transform translate-x-10 -translate-y-10"></div>
        
        <h2 class="text-xl font-bold mb-6 font-heading relative z-10">Preview Rincian Biaya</h2>
        <div class="space-y-4 mb-6 relative z-10">
            @forelse($biaya->where('aktif', true) as $item)
            <div class="flex justify-between items-center py-2 border-b border-white/20">
                <span class="text-sky-100">{{ $item->nama }}</span>
                <span class="font-bold">{{ $item->nominal_formatted }}</span>
            </div>
            @empty
            <div class="text-center py-4 text-sky-100">Belum ada data biaya</div>
            @endforelse
        </div>
        <div class="flex justify-between items-center pt-4 relative z-10">
            <span class="font-bold text-lg">TOTAL</span>
            <span class="font-bold text-2xl">Rp {{ number_format($totalBiaya, 0, ',', '.') }}</span>
        </div>
    </div>

    {{-- Table List --}}
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="px-6 py-4 border-b border-slate-200 bg-slate-50">
            <h2 class="font-semibold text-slate-800">Daftar Biaya</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Nama Biaya</th>
                        <th>Nominal</th>
                        <th>Keterangan</th>
                        <th>Status</th>
                        <th class="w-24">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($biaya as $item)
                    <tr>
                        <td class="font-medium">{{ $item->nama }}</td>
                        <td class="font-mono font-medium">{{ $item->nominal_formatted }}</td>
                        <td class="text-sm text-slate-600 max-w-xs truncate">{{ $item->keterangan ?? '-' }}</td>
                        <td>
                            <span class="badge {{ $item->aktif ? 'badge-success' : 'badge-secondary' }}">
                                {{ $item->aktif ? 'Aktif' : 'Nonaktif' }}
                            </span>
                        </td>
                        <td>
                            <div class="flex gap-1">
                                <button onclick="editBiaya({{ $item->id }}, '{{ addslashes($item->nama) }}', {{ $item->nominal }}, '{{ addslashes($item->keterangan ?? '') }}', {{ $item->aktif ? 1 : 0 }})" class="btn-icon btn-icon-sm btn-icon-edit">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                </button>
                                <form action="{{ route('admin.spmb.biaya.destroy', $item) }}" method="POST" class="inline" onsubmit="return confirm('Hapus biaya ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-icon btn-icon-sm btn-icon-delete">
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
                        <td colspan="5" class="text-center py-8 text-slate-500">
                            Belum ada data. Klik "Tambah Biaya" untuk menambahkan.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- Modal Tambah --}}
<div id="modal-tambah" class="hidden fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-xl shadow-xl max-w-lg w-full">
        <div class="px-6 py-4 border-b border-slate-200 flex items-center justify-between">
            <h3 class="text-lg font-bold text-slate-800">Tambah Biaya</h3>
            <button onclick="document.getElementById('modal-tambah').classList.add('hidden')" class="text-slate-400 hover:text-slate-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
        <form action="{{ route('admin.spmb.biaya.store') }}" method="POST" class="p-6 space-y-4">
            @csrf
            <div>
                <label class="form-label">Nama Biaya <span class="text-rose-600">*</span></label>
                <input type="text" name="nama" required class="form-input" placeholder="Uang Gedung">
            </div>
            <div>
                <label class="form-label">Nominal (Rp) <span class="text-rose-600">*</span></label>
                <input type="number" name="nominal" required min="0" class="form-input" placeholder="1500000">
            </div>
            <div>
                <label class="form-label">Keterangan</label>
                <textarea name="keterangan" rows="2" class="form-input" placeholder="Keterangan tambahan..."></textarea>
            </div>
            <div>
                <label class="flex items-center cursor-pointer">
                    <input type="checkbox" name="aktif" value="1" checked class="w-5 h-5 text-[#4276A3] border-slate-300 rounded focus:ring-[#4276A3]">
                    <span class="ml-3 text-sm font-medium text-slate-700">Aktif</span>
                </label>
            </div>
            <div class="flex justify-end gap-3 pt-4">
                <button type="button" onclick="document.getElementById('modal-tambah').classList.add('hidden')" class="btn btn-secondary">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>

{{-- Modal Edit --}}
<div id="modal-edit" class="hidden fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-xl shadow-xl max-w-lg w-full">
        <div class="px-6 py-4 border-b border-slate-200 flex items-center justify-between">
            <h3 class="text-lg font-bold text-slate-800">Edit Biaya</h3>
            <button onclick="document.getElementById('modal-edit').classList.add('hidden')" class="text-slate-400 hover:text-slate-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
        <form id="form-edit" method="POST" class="p-6 space-y-4">
            @csrf
            @method('PUT')
            <div>
                <label class="form-label">Nama Biaya <span class="text-rose-600">*</span></label>
                <input type="text" id="edit-nama" name="nama" required class="form-input">
            </div>
            <div>
                <label class="form-label">Nominal (Rp) <span class="text-rose-600">*</span></label>
                <input type="number" id="edit-nominal" name="nominal" required min="0" class="form-input">
            </div>
            <div>
                <label class="form-label">Keterangan</label>
                <textarea id="edit-keterangan" name="keterangan" rows="2" class="form-input"></textarea>
            </div>
            <div>
                <label class="flex items-center cursor-pointer">
                    <input type="checkbox" id="edit-aktif" name="aktif" value="1" class="w-5 h-5 text-[#4276A3] border-slate-300 rounded focus:ring-[#4276A3]">
                    <span class="ml-3 text-sm font-medium text-slate-700">Aktif</span>
                </label>
            </div>
            <div class="flex justify-end gap-3 pt-4">
                <button type="button" onclick="document.getElementById('modal-edit').classList.add('hidden')" class="btn btn-secondary">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

<script>
function editBiaya(id, nama, nominal, keterangan, aktif) {
    document.getElementById('form-edit').action = `/admin/spmb/biaya/${id}`;
    document.getElementById('edit-nama').value = nama;
    document.getElementById('edit-nominal').value = nominal;
    document.getElementById('edit-keterangan').value = keterangan;
    document.getElementById('edit-aktif').checked = aktif === 1;
    document.getElementById('modal-edit').classList.remove('hidden');
}
</script>
@endsection
