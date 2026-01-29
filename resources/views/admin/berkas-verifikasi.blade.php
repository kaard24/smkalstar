@extends('layouts.admin')

@section('title', 'Verifikasi Berkas - Admin PPDB')

@section('content')
        {{-- Header --}}
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Verifikasi Berkas Pendaftaran</h1>
            <p class="text-gray-600 mt-2">Kelola dan verifikasi berkas yang diupload oleh calon siswa</p>
        </div>

        {{-- Filters --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4 mb-6">
            <form action="{{ route('admin.berkas.index') }}" method="GET" class="flex flex-wrap gap-4 items-end">
                <div class="flex-1 min-w-[200px]">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Cari NISN</label>
                    <input type="text" name="nisn" value="{{ request('nisn') }}" 
                           placeholder="Masukkan NISN"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary">
                </div>
                <div class="min-w-[150px]">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                    <select name="status" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary">
                        <option value="all" {{ request('status') === 'all' ? 'selected' : '' }}>Semua</option>
                        <option value="Pending" {{ request('status') === 'Pending' ? 'selected' : '' }}>Pending</option>
                        <option value="Valid" {{ request('status') === 'Valid' ? 'selected' : '' }}>Valid</option>
                        <option value="Tidak Valid" {{ request('status') === 'Tidak Valid' ? 'selected' : '' }}>Tidak Valid</option>
                    </select>
                </div>
                <button type="submit" class="px-6 py-2 bg-primary text-white rounded-lg hover:bg-primary/90 transition font-medium">
                    Filter
                </button>
                <a href="{{ route('admin.berkas.index') }}" class="px-4 py-2 text-gray-600 hover:text-gray-800 transition">
                    Reset
                </a>
            </form>
        </div>

        {{-- Alert Messages --}}
        @if(session('success'))
        <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-700 rounded-xl text-sm">
            {{ session('success') }}
        </div>
        @endif

        @if(session('error'))
        <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-700 rounded-xl text-sm">
            {{ session('error') }}
        </div>
        @endif

        {{-- Table --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 border-b border-gray-100">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">NISN / Nama</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Jenis Berkas</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">File</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Tanggal Upload</th>
                            <th class="px-6 py-4 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($berkasList as $berkas)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4">
                                <div class="font-medium text-gray-900">{{ $berkas->calonSiswa->nisn }}</div>
                                <div class="text-sm text-gray-500">{{ $berkas->calonSiswa->nama }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    {{ $berkas->nama_jenis }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <a href="{{ route('admin.berkas.download', $berkas) }}" 
                                   class="text-primary hover:underline text-sm flex items-center gap-1"
                                   target="_blank">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                                    </svg>
                                    {{ Str::limit($berkas->nama_file, 25) }}
                                </a>
                            </td>
                            <td class="px-6 py-4">
                                @if($berkas->isValid())
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    Valid
                                </span>
                                @elseif($berkas->isTidakValid())
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                    Tidak Valid
                                </span>
                                @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                    Pending
                                </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-600">
                                {{ $berkas->created_at->format('d/m/Y H:i') }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-center gap-2">
                                    <button type="button" 
                                            onclick="openVerifyModal({{ $berkas->id }}, '{{ $berkas->calonSiswa->nama }}', '{{ $berkas->nama_jenis }}')"
                                            class="px-3 py-1.5 bg-primary text-white text-xs rounded-lg hover:bg-primary/90 transition">
                                        Verifikasi
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                                <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                <p class="text-lg font-medium">Tidak ada berkas</p>
                                <p class="text-sm">Belum ada berkas yang diupload oleh calon siswa</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            @if($berkasList->hasPages())
            <div class="px-6 py-4 border-t border-gray-100">
                {{ $berkasList->withQueryString()->links() }}
            </div>
            @endif
        </div>


{{-- Verify Modal --}}
<div id="verifyModal" class="fixed inset-0 z-50 hidden">
    <div class="absolute inset-0 bg-black/50" onclick="closeVerifyModal()"></div>
    <div class="absolute inset-0 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-xl max-w-md w-full p-6 relative">
            <button type="button" onclick="closeVerifyModal()" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>

            <h3 class="text-lg font-semibold text-gray-900 mb-1">Verifikasi Berkas</h3>
            <p id="modalInfo" class="text-sm text-gray-500 mb-6"></p>

            <form id="verifyForm" method="POST">
                @csrf
                
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Status Verifikasi</label>
                    <div class="grid grid-cols-2 gap-3">
                        <label class="relative cursor-pointer">
                            <input type="radio" name="status" value="Valid" class="peer sr-only" required>
                            <div class="px-4 py-3 border-2 rounded-xl text-center transition peer-checked:border-green-500 peer-checked:bg-green-50">
                                <span class="text-sm font-medium text-gray-700 peer-checked:text-green-700">✓ Valid</span>
                            </div>
                        </label>
                        <label class="relative cursor-pointer">
                            <input type="radio" name="status" value="Tidak Valid" class="peer sr-only">
                            <div class="px-4 py-3 border-2 rounded-xl text-center transition peer-checked:border-red-500 peer-checked:bg-red-50">
                                <span class="text-sm font-medium text-gray-700 peer-checked:text-red-700">✗ Tidak Valid</span>
                            </div>
                        </label>
                    </div>
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Catatan (Opsional)</label>
                    <textarea name="catatan" rows="3" 
                              placeholder="Tuliskan catatan jika berkas tidak valid..."
                              class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary"></textarea>
                </div>

                <div class="flex gap-3">
                    <button type="button" onclick="closeVerifyModal()" 
                            class="flex-1 px-4 py-3 border border-gray-300 text-gray-700 rounded-xl hover:bg-gray-50 transition font-medium">
                        Batal
                    </button>
                    <button type="submit" 
                            class="flex-1 px-4 py-3 bg-primary text-white rounded-xl hover:bg-primary/90 transition font-medium shadow-sm">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function openVerifyModal(id, nama, jenis) {
    document.getElementById('verifyForm').action = `/admin/berkas/${id}/verify`;
    document.getElementById('modalInfo').textContent = `${nama} - ${jenis}`;
    document.getElementById('verifyModal').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closeVerifyModal() {
    document.getElementById('verifyModal').classList.add('hidden');
    document.body.style.overflow = '';
}
</script>
@endsection
