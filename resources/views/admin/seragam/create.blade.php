@extends('layouts.admin')

@section('title', 'Tambah Seragam - Admin Panel')

@section('content')
<div class="max-w-3xl mx-auto" x-data="seragamForm()">
    {{-- Header --}}
    <div class="mb-8">
        <a href="{{ route('admin.seragam.index') }}" class="inline-flex items-center text-sm text-slate-500 hover:text-[#4276A3] mb-4 transition-colors">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Kembali ke Daftar Seragam
        </a>
        <h1 class="text-2xl font-bold text-slate-800">Tambah Seragam Baru</h1>
        <p class="text-slate-600">Tambahkan jadwal seragam untuk hari tertentu.</p>
    </div>

    {{-- Error Alert --}}
    @if($errors->any())
    <div class="mb-6 p-4 bg-rose-50 border border-rose-200 text-rose-700 rounded-xl">
        <div class="flex items-center gap-2 mb-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <span class="font-medium">Terjadi kesalahan:</span>
        </div>
        <ul class="list-disc pl-5 space-y-1 text-sm">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('admin.seragam.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        {{-- Main Info Card --}}
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-200 bg-slate-50">
                <h2 class="font-semibold text-slate-800">Informasi Seragam</h2>
            </div>
            <div class="p-6 space-y-6">
                {{-- Hari --}}
                <div>
                    <label for="hari" class="form-label">Hari <span class="text-rose-600">*</span></label>
                    <select id="hari" name="hari" required
                            class="form-input @error('hari') border-rose-500 @enderror">
                        <option value="">Pilih Hari</option>
                        @foreach($hariList as $hari)
                            @if(!in_array($hari, $existingHari))
                                <option value="{{ $hari }}" {{ old('hari') == $hari ? 'selected' : '' }}>{{ $hari }}</option>
                            @endif
                        @endforeach
                    </select>
                    @if(count($existingHari) >= count($hariList))
                        <p class="mt-1 text-sm text-amber-600">Semua hari sudah memiliki data seragam.</p>
                    @endif
                </div>

                {{-- Warna Tema --}}
                <div>
                    <label class="form-label mb-3">Warna Tema <span class="text-rose-600">*</span></label>
                    <div class="grid grid-cols-4 sm:grid-cols-7 gap-3">
                        @foreach($warnaList as $key => $label)
                        <label class="cursor-pointer group">
                            <input type="radio" name="warna_tema" value="{{ $key }}" 
                                   class="sr-only peer" {{ old('warna_tema', 'blue') == $key ? 'checked' : '' }}>
                            <div class="flex flex-col items-center gap-2 p-3 rounded-lg border-2 border-slate-200 peer-checked:border-[#4276A3] peer-checked:bg-[#4276A3]/5 hover:border-slate-300 transition-all">
                                <div class="w-8 h-8 rounded-full bg-gradient-to-br
                                    @if($key == 'blue') from-blue-500 to-blue-600
                                    @elseif($key == 'gray') from-slate-500 to-slate-600
                                    @elseif($key == 'green') from-emerald-500 to-emerald-600
                                    @elseif($key == 'red') from-rose-500 to-rose-600
                                    @elseif($key == 'purple') from-violet-500 to-violet-600
                                    @elseif($key == 'orange') from-orange-500 to-orange-600
                                    @elseif($key == 'brown') from-amber-700 to-amber-800
                                    @endif
                                "></div>
                                <span class="text-xs text-slate-600 peer-checked:text-[#4276A3] peer-checked:font-medium">{{ $label }}</span>
                            </div>
                        </label>
                        @endforeach
                    </div>
                    @error('warna_tema')
                        <p class="mt-1 text-sm text-rose-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Keterangan --}}
                <div>
                    <label for="keterangan" class="form-label">Keterangan</label>
                    <textarea id="keterangan" name="keterangan" rows="3"
                              class="form-input @error('keterangan') border-rose-500 @enderror"
                              placeholder="Deskripsi seragam (opsional)">{{ old('keterangan') }}</textarea>
                    <p class="mt-1 text-xs text-slate-500">Maksimal 500 karakter.</p>
                </div>

                {{-- Urutan & Status --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="urutan" class="form-label">Urutan Tampil</label>
                        <input type="number" id="urutan" name="urutan" min="0" value="{{ old('urutan', 0) }}"
                               class="form-input @error('urutan') border-rose-500 @enderror">
                        <p class="mt-1 text-xs text-slate-500">Urutan menampilkan di halaman user.</p>
                    </div>
                    <div class="flex items-center pt-8">
                        <label class="flex items-center cursor-pointer">
                            <input type="checkbox" name="aktif" value="1" checked
                                   class="w-5 h-5 text-[#4276A3] border-slate-300 rounded focus:ring-[#4276A3]">
                            <span class="ml-3 text-sm font-medium text-slate-700">Tampilkan di Website</span>
                        </label>
                    </div>
                </div>
            </div>
        </div>

        {{-- Photos Card --}}
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-200 bg-slate-50">
                <h2 class="font-semibold text-slate-800">Foto Seragam</h2>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- Foto Laki-laki --}}
                    <div>
                        <label class="form-label">Foto Laki-laki <span class="text-rose-600">*</span></label>
                        <div class="relative">
                            <div class="border-2 border-dashed border-slate-300 rounded-xl p-6 text-center hover:bg-slate-50 transition cursor-pointer relative overflow-hidden"
                                 :class="{ 'border-[#4276A3] bg-[#4276A3]/5': lakiPreview }"
                                 @click="$refs.inputLaki.click()">
                                
                                {{-- Preview --}}
                                <template x-if="lakiPreview">
                                    <img :src="lakiPreview" class="w-full aspect-[3/4] object-cover rounded-lg">
                                </template>
                                
                                {{-- Placeholder --}}
                                <template x-if="!lakiPreview">
                                    <div>
                                        <svg class="w-12 h-12 text-slate-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        <p class="text-sm text-slate-600 font-medium">Klik untuk upload foto</p>
                                        <p class="text-xs text-slate-400 mt-1">JPG, PNG, WebP (Max 2MB)</p>
                                    </div>
                                </template>

                                {{-- Change overlay --}}
                                <div x-show="lakiPreview" class="absolute inset-0 bg-black/50 flex items-center justify-center opacity-0 hover:opacity-100 transition-opacity">
                                    <span class="text-white text-sm font-medium">Ganti Foto</span>
                                </div>
                            </div>
                            <input type="file" x-ref="inputLaki" name="foto_laki" accept="image/*" required class="hidden"
                                   @change="handleFileChange($event, 'laki')">
                        </div>
                        @error('foto_laki')
                            <p class="mt-1 text-sm text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Foto Perempuan --}}
                    <div>
                        <label class="form-label">Foto Perempuan <span class="text-rose-600">*</span></label>
                        <div class="relative">
                            <div class="border-2 border-dashed border-slate-300 rounded-xl p-6 text-center hover:bg-slate-50 transition cursor-pointer relative overflow-hidden"
                                 :class="{ 'border-[#4276A3] bg-[#4276A3]/5': perempuanPreview }"
                                 @click="$refs.inputPerempuan.click()">
                                
                                {{-- Preview --}}
                                <template x-if="perempuanPreview">
                                    <img :src="perempuanPreview" class="w-full aspect-[3/4] object-cover rounded-lg">
                                </template>
                                
                                {{-- Placeholder --}}
                                <template x-if="!perempuanPreview">
                                    <div>
                                        <svg class="w-12 h-12 text-slate-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        <p class="text-sm text-slate-600 font-medium">Klik untuk upload foto</p>
                                        <p class="text-xs text-slate-400 mt-1">JPG, PNG, WebP (Max 2MB)</p>
                                    </div>
                                </template>

                                {{-- Change overlay --}}
                                <div x-show="perempuanPreview" class="absolute inset-0 bg-black/50 flex items-center justify-center opacity-0 hover:opacity-100 transition-opacity">
                                    <span class="text-white text-sm font-medium">Ganti Foto</span>
                                </div>
                            </div>
                            <input type="file" x-ref="inputPerempuan" name="foto_perempuan" accept="image/*" required class="hidden"
                                   @change="handleFileChange($event, 'perempuan')">
                        </div>
                        @error('foto_perempuan')
                            <p class="mt-1 text-sm text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        {{-- Actions --}}
        <div class="flex justify-end gap-4">
            <a href="{{ route('admin.seragam.index') }}" class="btn btn-secondary btn-lg">
                Batal
            </a>
            <button type="submit" class="btn btn-primary btn-lg shadow-sm hover:shadow-md">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                Simpan Seragam
            </button>
        </div>
    </form>
</div>

<script>
function seragamForm() {
    return {
        lakiPreview: null,
        perempuanPreview: null,
        
        handleFileChange(event, type) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    if (type === 'laki') {
                        this.lakiPreview = e.target.result;
                    } else {
                        this.perempuanPreview = e.target.result;
                    }
                };
                reader.readAsDataURL(file);
            }
        }
    }
}
</script>
@endsection
