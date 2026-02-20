@extends('layouts.admin')

@section('title', 'Alur Pendaftaran - Admin Panel')

@section('content')
<div class="max-w-4xl mx-auto">
    {{-- Header --}}
    <div class="mb-8 flex flex-wrap items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">Alur Pendaftaran</h1>
            <p class="text-slate-600">Kelola 7 tahapan alur pendaftaran SPMB.</p>
        </div>
        <button onclick="document.getElementById('modal-tambah').classList.remove('hidden')" class="btn btn-primary shadow-md hover:shadow-lg">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
            </svg>
            Tambah Tahapan
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

    {{-- Timeline Preview --}}
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-8 mb-8">
        <h2 class="text-lg font-bold text-slate-800 mb-6">Preview Timeline</h2>
        <div class="relative pl-8 space-y-8 before:absolute before:left-3 before:top-2 before:bottom-2 before:w-0.5 before:bg-gradient-to-b before:from-primary before:to-slate-200">
            @forelse($alur as $item)
            <div class="relative group">
                <span class="absolute -left-[29px] top-0 w-6 h-6 rounded-full {{ $item->aktif ? 'bg-primary' : 'bg-slate-300' }} border-4 border-white shadow flex items-center justify-center text-white text-xs font-bold z-10">
                    {{ $item->nomor }}
                </span>
                <div class="flex items-start justify-between">
                    <div>
                        <h3 class="font-bold text-slate-800 {{ $item->aktif ? '' : 'line-through text-slate-400' }}">{{ $item->judul }}</h3>
                        <p class="text-slate-600 text-sm mt-1 {{ $item->aktif ? '' : 'text-slate-400' }}">{{ $item->deskripsi }}</p>
                    </div>
                    <div class="flex gap-2">
                        <button onclick="editAlur({{ $item->id }}, '{{ $item->nomor }}', '{{ addslashes($item->judul) }}', '{{ addslashes($item->deskripsi) }}', {{ $item->aktif ? 1 : 0 }})" class="btn-icon btn-icon-edit" title="Edit">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                        </button>
                        <form action="{{ route('admin.spmb.alur.destroy', $item) }}" method="POST" class="inline" onsubmit="return confirm('Hapus tahapan ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-icon btn-icon-delete" title="Hapus">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @empty
            <div class="text-center py-8 text-slate-500">
                Belum ada data alur pendaftaran.
            </div>
            @endforelse
        </div>
    </div>

    {{-- Table List --}}
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="px-6 py-4 border-b border-slate-200 bg-slate-50">
            <h2 class="font-semibold text-slate-800">Daftar Tahapan</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="data-table">
                <thead>
                    <tr>
                        <th class="w-16">No</th>
                        <th>Judul</th>
                        <th>Deskripsi</th>
                        <th>Status</th>
                        <th class="w-24">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($alur as $item)
                    <tr>
                        <td class="text-center font-bold">{{ $item->nomor }}</td>
                        <td class="font-medium">{{ $item->judul }}</td>
                        <td class="text-sm text-slate-600 max-w-xs truncate">{{ $item->deskripsi }}</td>
                        <td>
                            <span class="badge {{ $item->aktif ? 'badge-success' : 'badge-secondary' }}">
                                {{ $item->aktif ? 'Aktif' : 'Nonaktif' }}
                            </span>
                        </td>
                        <td>
                            <div class="flex gap-1">
                                <button onclick="editAlur({{ $item->id }}, '{{ $item->nomor }}', '{{ addslashes($item->judul) }}', '{{ addslashes($item->deskripsi) }}', {{ $item->aktif ? 1 : 0 }})" class="btn-icon btn-icon-sm btn-icon-edit">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                </button>
                                <form action="{{ route('admin.spmb.alur.destroy', $item) }}" method="POST" class="inline" onsubmit="return confirm('Hapus tahapan ini?')">
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
                            Belum ada data. Klik "Tambah Tahapan" untuk menambahkan.
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
    <div class="bg-white rounded-xl shadow-xl max-w-lg w-full max-h-[90vh] overflow-y-auto">
        <div class="px-6 py-4 border-b border-slate-200 flex items-center justify-between">
            <h3 class="text-lg font-bold text-slate-800">Tambah Tahapan</h3>
            <button onclick="document.getElementById('modal-tambah').classList.add('hidden')" class="text-slate-400 hover:text-slate-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
        <form action="{{ route('admin.spmb.alur.store') }}" method="POST" class="p-6 space-y-4">
            @csrf
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="form-label">Nomor <span class="text-rose-600">*</span></label>
                    <input type="number" name="nomor" required min="1" class="form-input" placeholder="1">
                </div>
                <div>
                    <label class="form-label">Urutan</label>
                    <input type="number" name="urutan" min="0" class="form-input" placeholder="Otomatis">
                </div>
            </div>
            <div>
                <label class="form-label">Judul <span class="text-rose-600">*</span></label>
                <input type="text" name="judul" required class="form-input" placeholder="Pendaftaran Akun">
            </div>
            <div>
                <label class="form-label">Deskripsi <span class="text-rose-600">*</span></label>
                <textarea name="deskripsi" required rows="3" class="form-input" placeholder="Penjelasan tahapan..."></textarea>
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
    <div class="bg-white rounded-xl shadow-xl max-w-lg w-full max-h-[90vh] overflow-y-auto">
        <div class="px-6 py-4 border-b border-slate-200 flex items-center justify-between">
            <h3 class="text-lg font-bold text-slate-800">Edit Tahapan</h3>
            <button onclick="document.getElementById('modal-edit').classList.add('hidden')" class="text-slate-400 hover:text-slate-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
        <form id="form-edit" method="POST" class="p-6 space-y-4">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="form-label">Nomor <span class="text-rose-600">*</span></label>
                    <input type="number" id="edit-nomor" name="nomor" required min="1" class="form-input">
                </div>
                <div>
                    <label class="form-label">Urutan</label>
                    <input type="number" id="edit-urutan" name="urutan" min="0" class="form-input">
                </div>
            </div>
            <div>
                <label class="form-label">Judul <span class="text-rose-600">*</span></label>
                <input type="text" id="edit-judul" name="judul" required class="form-input">
            </div>
            <div>
                <label class="form-label">Deskripsi <span class="text-rose-600">*</span></label>
                <textarea id="edit-deskripsi" name="deskripsi" required rows="3" class="form-input"></textarea>
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
function editAlur(id, nomor, judul, deskripsi, aktif) {
    document.getElementById('form-edit').action = `/admin/spmb/alur/${id}`;
    document.getElementById('edit-nomor').value = nomor;
    document.getElementById('edit-judul').value = judul;
    document.getElementById('edit-deskripsi').value = deskripsi;
    document.getElementById('edit-aktif').checked = aktif === 1;
    document.getElementById('modal-edit').classList.remove('hidden');
}
</script>
@endsection
