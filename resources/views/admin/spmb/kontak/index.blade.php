@extends('layouts.admin')

@section('title', 'Kontak SPMB - Admin Panel')

@section('content')
<div class="max-w-4xl mx-auto">
    {{-- Header --}}
    <div class="mb-8 flex flex-wrap items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">Kontak Person</h1>
            <p class="text-slate-600">Kelola kontak person panitia SPMB.</p>
        </div>
        <button onclick="document.getElementById('modal-tambah').classList.remove('hidden')" class="btn btn-primary shadow-md hover:shadow-lg">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
            </svg>
            Tambah Kontak
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

    {{-- Preview Card --}}
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-8 mb-8">
        <h2 class="text-lg font-bold text-slate-800 mb-6">Preview Kontak</h2>
        <div class="space-y-4">
            @forelse($kontak->where('aktif', true) as $item)
            <a href="{{ $item->whatsapp_link }}" target="_blank" class="flex items-center p-4 bg-slate-50 rounded-2xl hover:bg-green-50 group transition duration-300">
                <div class="w-12 h-12 rounded-full bg-green-100 text-green-600 flex items-center justify-center mr-4 group-hover:bg-green-500 group-hover:text-white transition flex-shrink-0">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                    </svg>
                </div>
                <div class="min-w-0 flex-1">
                    <p class="text-sm text-slate-500 font-medium">{{ $item->jabatan ?? 'Panitia' }}</p>
                    <p class="font-bold text-slate-800 text-lg">{{ $item->nama }}</p>
                    <p class="text-slate-600">{{ $item->whatsapp }}</p>
                </div>
                <svg class="w-5 h-5 text-slate-400 group-hover:text-green-600 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                </svg>
            </a>
            @empty
            <div class="text-center py-4 text-slate-500">Belum ada kontak</div>
            @endforelse
        </div>
    </div>

    {{-- Table List --}}
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="px-6 py-4 border-b border-slate-200 bg-slate-50">
            <h2 class="font-semibold text-slate-800">Daftar Kontak</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Jabatan</th>
                        <th>WhatsApp</th>
                        <th>Status</th>
                        <th class="w-24">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($kontak as $item)
                    <tr>
                        <td class="font-medium">{{ $item->nama }}</td>
                        <td class="text-slate-600">{{ $item->jabatan ?? '-' }}</td>
                        <td class="font-mono text-sm">{{ $item->whatsapp }}</td>
                        <td>
                            <span class="badge {{ $item->aktif ? 'badge-success' : 'badge-secondary' }}">
                                {{ $item->aktif ? 'Aktif' : 'Nonaktif' }}
                            </span>
                        </td>
                        <td>
                            <div class="flex gap-1">
                                <button onclick="editKontak({{ $item->id }}, '{{ addslashes($item->nama) }}', '{{ addslashes($item->jabatan ?? '') }}', '{{ $item->telepon ?? '' }}', '{{ $item->whatsapp }}', '{{ $item->email ?? '' }}', {{ $item->aktif ? 1 : 0 }})" class="btn-icon btn-icon-sm btn-icon-edit">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                </button>
                                <form action="{{ route('admin.spmb.kontak.destroy', $item) }}" method="POST" class="inline" onsubmit="return confirm('Hapus kontak ini?')">
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
                            Belum ada data. Klik "Tambah Kontak" untuk menambahkan.
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
            <h3 class="text-lg font-bold text-slate-800">Tambah Kontak</h3>
            <button onclick="document.getElementById('modal-tambah').classList.add('hidden')" class="text-slate-400 hover:text-slate-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
        <form action="{{ route('admin.spmb.kontak.store') }}" method="POST" class="p-6 space-y-4">
            @csrf
            <div>
                <label class="form-label">Nama <span class="text-rose-600">*</span></label>
                <input type="text" name="nama" required class="form-input" placeholder="Nama lengkap">
            </div>
            <div>
                <label class="form-label">Jabatan</label>
                <input type="text" name="jabatan" class="form-input" placeholder="Koordinator SPMB">
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="form-label">Telepon</label>
                    <input type="text" name="telepon" class="form-input" placeholder="08123456789">
                </div>
                <div>
                    <label class="form-label">WhatsApp <span class="text-rose-600">*</span></label>
                    <input type="text" name="whatsapp" required class="form-input" placeholder="08123456789">
                </div>
            </div>
            <div>
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-input" placeholder="email@example.com">
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
            <h3 class="text-lg font-bold text-slate-800">Edit Kontak</h3>
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
                <label class="form-label">Nama <span class="text-rose-600">*</span></label>
                <input type="text" id="edit-nama" name="nama" required class="form-input">
            </div>
            <div>
                <label class="form-label">Jabatan</label>
                <input type="text" id="edit-jabatan" name="jabatan" class="form-input">
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="form-label">Telepon</label>
                    <input type="text" id="edit-telepon" name="telepon" class="form-input">
                </div>
                <div>
                    <label class="form-label">WhatsApp <span class="text-rose-600">*</span></label>
                    <input type="text" id="edit-whatsapp" name="whatsapp" required class="form-input">
                </div>
            </div>
            <div>
                <label class="form-label">Email</label>
                <input type="email" id="edit-email" name="email" class="form-input">
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
function editKontak(id, nama, jabatan, telepon, whatsapp, email, aktif) {
    document.getElementById('form-edit').action = `/admin/spmb/kontak/${id}`;
    document.getElementById('edit-nama').value = nama;
    document.getElementById('edit-jabatan').value = jabatan;
    document.getElementById('edit-telepon').value = telepon;
    document.getElementById('edit-whatsapp').value = whatsapp;
    document.getElementById('edit-email').value = email;
    document.getElementById('edit-aktif').checked = aktif === 1;
    document.getElementById('modal-edit').classList.remove('hidden');
}
</script>
@endsection
