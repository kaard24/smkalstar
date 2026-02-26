@extends('layouts.kajur')

@section('title', 'Edit Program Keahlian - Panel Kepala Jurusan')

@section('content')
<div class="max-w-5xl mx-auto px-4 py-8">
    {{-- Header --}}
    <div class="mb-6">        
        <div class="flex items-start gap-4">
            @if($jurusan->logo_url)
            <img src="{{ $jurusan->logo_url }}" alt="{{ $jurusan->nama }}" class="w-16 h-16 object-contain bg-white rounded-xl shadow-sm border border-slate-200 p-2">
            @else
            <div class="w-16 h-16 bg-slate-100 rounded-xl flex items-center justify-center">
                <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                </svg>
            </div>
            @endif
            <div>
                <h1 class="text-2xl font-bold text-slate-800">{{ $jurusan->nama }}</h1>
                <p class="text-slate-500">Kode: {{ $jurusan->kode }} • {{ $jurusan->kegiatan->count() }} Kegiatan</p>
            </div>
        </div>
    </div>

    {{-- Form --}}
    <form id="jurusanForm" action="{{ route('kajur.jurusan.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        {{-- Section: Informasi Dasar --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden" x-data="{ open: true }">
            <button type="button" @click="open = !open" class="w-full px-6 py-4 flex items-center justify-between bg-gradient-to-r from-blue-50 to-white hover:from-blue-100 transition">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div class="text-left">
                        <h2 class="font-semibold text-slate-800">Informasi Dasar</h2>
                        <p class="text-sm text-slate-500">Kode, nama, dan urutan jurusan</p>
                    </div>
                </div>
                <svg :class="{ 'rotate-180': open }" class="w-5 h-5 text-slate-400 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
            </button>
            <div x-show="open" x-collapse class="p-6 border-t border-slate-100">
                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Kode Jurusan <span class="text-red-500">*</span></label>
                        <input type="text" name="kode" value="{{ old('kode', $jurusan->kode) }}" 
                            class="w-full rounded-xl border-slate-300 focus:border-blue-500 focus:ring-blue-500 uppercase text-sm py-2.5"
                            placeholder="Contoh: TKJ" required>
                        @error('kode')
                        <p class="text-red-500 text-sm mt-1 flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            {{ $message }}
                        </p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Nama Jurusan <span class="text-red-500">*</span></label>
                        <input type="text" name="nama" value="{{ old('nama', $jurusan->nama) }}" 
                            class="w-full rounded-xl border-slate-300 focus:border-blue-500 focus:ring-blue-500 text-sm py-2.5"
                            placeholder="Contoh: Teknik Komputer dan Jaringan" required>
                        @error('nama')
                        <p class="text-red-500 text-sm mt-1 flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            {{ $message }}
                        </p>
                        @enderror
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-slate-700 mb-2">Urutan Tampil</label>
                        <div class="flex items-center gap-3">
                            <input type="number" name="urutan" value="{{ old('urutan', $jurusan->urutan) }}" min="0"
                                class="w-32 rounded-xl border-slate-300 focus:border-blue-500 focus:ring-blue-500 text-sm py-2.5">
                            <span class="text-sm text-slate-500">Urutan untuk penampilan di website (0 = pertama)</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Section: Deskripsi --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden" x-data="{ open: true }">
            <button type="button" @click="open = !open" class="w-full px-6 py-4 flex items-center justify-between bg-gradient-to-r from-green-50 to-white hover:from-green-100 transition">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-green-100 rounded-xl flex items-center justify-center">
                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"/>
                        </svg>
                    </div>
                    <div class="text-left">
                        <h2 class="font-semibold text-slate-800">Deskripsi</h2>
                        <p class="text-sm text-slate-500">Deskripsi singkat dan lengkap jurusan</p>
                    </div>
                </div>
                <svg :class="{ 'rotate-180': open }" class="w-5 h-5 text-slate-400 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
            </button>
            <div x-show="open" x-collapse class="p-6 border-t border-slate-100">
                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Deskripsi Singkat</label>
                        <textarea name="deskripsi" rows="3" 
                            class="w-full rounded-xl border-slate-300 focus:border-blue-500 focus:ring-blue-500 text-sm"
                            placeholder="Deskripsi singkat tentang jurusan (tampil di hero & list)...">{{ old('deskripsi', $jurusan->deskripsi) }}</textarea>
                        <p class="text-xs text-slate-500 mt-1">Tampil di halaman list jurusan dan hero section</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Deskripsi Lengkap</label>
                        <textarea name="deskripsi_lengkap" rows="6" 
                            class="w-full rounded-xl border-slate-300 focus:border-blue-500 focus:ring-blue-500 text-sm"
                            placeholder="Deskripsi lengkap tentang jurusan (tampil di halaman detail)...">{{ old('deskripsi_lengkap', $jurusan->deskripsi_lengkap) }}</textarea>
                        <p class="text-xs text-slate-500 mt-1">Tampil di halaman detail jurusan</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Section: Media --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden" x-data="{ open: true }">
            <button type="button" @click="open = !open" class="w-full px-6 py-4 flex items-center justify-between bg-gradient-to-r from-purple-50 to-white hover:from-purple-100 transition">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-purple-100 rounded-xl flex items-center justify-center">
                        <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <div class="text-left">
                        <h2 class="font-semibold text-slate-800">Media (Logo & Gambar)</h2>
                        <p class="text-sm text-slate-500">Upload logo dan gambar jurusan</p>
                    </div>
                </div>
                <svg :class="{ 'rotate-180': open }" class="w-5 h-5 text-slate-400 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
            </button>
            <div x-show="open" x-collapse class="p-6 border-t border-slate-100">
                <div class="grid md:grid-cols-2 gap-6">
                    {{-- Logo --}}
                    <div x-data="{ preview: '{{ $jurusan->logo_url }}', hover: false }">
                        <label class="block text-sm font-medium text-slate-700 mb-3">Logo Jurusan</label>
                        <div class="relative group">
                            <div @dragover.prevent="hover = true" @dragleave.prevent="hover = false" @drop.prevent="handleDrop($event, 'logo')"
                                 :class="{ 'border-blue-400 bg-blue-50': hover }"
                                 class="aspect-video rounded-xl border-2 border-dashed border-slate-300 flex flex-col items-center justify-center cursor-pointer transition overflow-hidden bg-slate-50"
                                 onclick="document.getElementById('logo').click()">
                                
                                <template x-if="preview">
                                    <img :src="preview" class="w-full h-full object-contain p-4">
                                </template>
                                <template x-if="!preview">
                                    <div class="text-center p-6">
                                        <svg class="mx-auto h-12 w-12 text-slate-400 mb-3" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                        <p class="text-sm text-slate-600 font-medium">Klik atau drop logo di sini</p>
                                        <p class="text-xs text-slate-500 mt-1">PNG, JPG, WEBP max 2MB</p>
                                    </div>
                                </template>
                            </div>
                            <input id="logo" name="logo" type="file" accept="image/*" class="hidden" 
                                   @change="preview = URL.createObjectURL($event.target.files[0])">
                            
                            {{-- Remove button --}}
                            <button type="button" x-show="preview" x-cloak @click.stop="preview = null; document.getElementById('logo').value = ''"
                                    class="absolute top-2 right-2 w-8 h-8 bg-red-500 hover:bg-red-600 text-white rounded-lg flex items-center justify-center shadow-lg transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                            </button>
                        </div>
                        @error('logo')
                        <p class="text-red-500 text-sm mt-2 flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            {{ $message }}
                        </p>
                        @enderror
                    </div>

                    {{-- Gambar --}}
                    <div x-data="{ preview: '{{ $jurusan->gambar_url }}', hover: false }">
                        <label class="block text-sm font-medium text-slate-700 mb-3">Gambar Jurusan</label>
                        <div class="relative group">
                            <div @dragover.prevent="hover = true" @dragleave.prevent="hover = false" @drop.prevent="handleDrop($event, 'gambar')"
                                 :class="{ 'border-blue-400 bg-blue-50': hover }"
                                 class="aspect-video rounded-xl border-2 border-dashed border-slate-300 flex flex-col items-center justify-center cursor-pointer transition overflow-hidden bg-slate-50"
                                 onclick="document.getElementById('gambar').click()">
                                
                                <template x-if="preview">
                                    <img :src="preview" class="w-full h-full object-cover">
                                </template>
                                <template x-if="!preview">
                                    <div class="text-center p-6">
                                        <svg class="mx-auto h-12 w-12 text-slate-400 mb-3" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                        <p class="text-sm text-slate-600 font-medium">Klik atau drop gambar di sini</p>
                                        <p class="text-xs text-slate-500 mt-1">PNG, JPG, WEBP max 5MB</p>
                                    </div>
                                </template>
                            </div>
                            <input id="gambar" name="gambar" type="file" accept="image/*" class="hidden" 
                                   @change="preview = URL.createObjectURL($event.target.files[0])">
                            
                            {{-- Remove button --}}
                            <button type="button" x-show="preview" x-cloak @click.stop="preview = null; document.getElementById('gambar').value = ''"
                                    class="absolute top-2 right-2 w-8 h-8 bg-red-500 hover:bg-red-600 text-white rounded-lg flex items-center justify-center shadow-lg transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                            </button>
                        </div>
                        @error('gambar')
                        <p class="text-red-500 text-sm mt-2 flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            {{ $message }}
                        </p>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        {{-- Section: Kompetensi, Mapel, Karir (Tabs) --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden" x-data="{ 
            activeTab: 'kompetensi',
            kompetensiCount: {{ $jurusan->kompetensiItems->count() > 0 ? $jurusan->kompetensiItems->count() : 1 }},
            mapelCount: {{ $jurusan->mapelItems->count() > 0 ? $jurusan->mapelItems->count() : 1 }},
            karirCount: {{ $jurusan->karirItems->count() > 0 ? $jurusan->karirItems->count() : 1 }}
        }">
            <div class="flex items-center border-b border-slate-200">
                <button type="button" @click="activeTab = 'kompetensi'" 
                        :class="{ 'border-b-2 border-[#4276A3] text-[#4276A3] bg-blue-50/50': activeTab === 'kompetensi' }"
                        class="flex-1 px-6 py-4 text-sm font-medium text-slate-600 hover:text-slate-800 transition flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                    </svg>
                    Kompetensi
                    <span x-text="kompetensiCount" class="px-2 py-0.5 bg-slate-200 text-slate-600 rounded-full text-xs"></span>
                </button>
                <button type="button" @click="activeTab = 'mapel'" 
                        :class="{ 'border-b-2 border-[#4276A3] text-[#4276A3] bg-blue-50/50': activeTab === 'mapel' }"
                        class="flex-1 px-6 py-4 text-sm font-medium text-slate-600 hover:text-slate-800 transition flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                    Mata Pelajaran
                    <span x-text="mapelCount" class="px-2 py-0.5 bg-slate-200 text-slate-600 rounded-full text-xs"></span>
                </button>
                <button type="button" @click="activeTab = 'karir'" 
                        :class="{ 'border-b-2 border-[#4276A3] text-[#4276A3] bg-blue-50/50': activeTab === 'karir' }"
                        class="flex-1 px-6 py-4 text-sm font-medium text-slate-600 hover:text-slate-800 transition flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                    Peluang Karir
                    <span x-text="karirCount" class="px-2 py-0.5 bg-slate-200 text-slate-600 rounded-full text-xs"></span>
                </button>
            </div>
            
            <div class="p-6">
                {{-- Tab Content: Kompetensi --}}
                <div x-show="activeTab === 'kompetensi'" class="space-y-4">
                    <div class="flex items-center justify-between">
                        <p class="text-sm text-slate-600">Daftar kompetensi yang dimiliki jurusan ini</p>
                        <button type="button" onclick="addDetailItem('kompetensi')" class="flex items-center gap-2 px-4 py-2 bg-blue-50 hover:bg-blue-100 text-blue-600 text-sm font-medium rounded-lg transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                            Tambah Kompetensi
                        </button>
                    </div>
                    <div id="kompetensi-container" class="space-y-3">
                        @if($jurusan->kompetensiItems->count() > 0)
                            @foreach($jurusan->kompetensiItems as $item)
                            @include('kajur.jurusan.partials.detail-item', ['tipe' => 'kompetensi', 'judul' => $item->judul, 'deskripsi' => $item->deskripsi, 'placeholder' => 'Judul kompetensi'])
                            @endforeach
                        @else
                            @include('kajur.jurusan.partials.detail-item', ['tipe' => 'kompetensi', 'judul' => '', 'deskripsi' => '', 'placeholder' => 'Judul kompetensi'])
                        @endif
                    </div>
                </div>

                {{-- Tab Content: Mapel --}}
                <div x-show="activeTab === 'mapel'" class="space-y-4" style="display: none;">
                    <div class="flex items-center justify-between">
                        <p class="text-sm text-slate-600">Daftar mata pelajaran produktif jurusan ini</p>
                        <button type="button" onclick="addDetailItem('mapel')" class="flex items-center gap-2 px-4 py-2 bg-green-50 hover:bg-green-100 text-green-600 text-sm font-medium rounded-lg transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                            Tambah Mapel
                        </button>
                    </div>
                    <div id="mapel-container" class="space-y-3">
                        @if($jurusan->mapelItems->count() > 0)
                            @foreach($jurusan->mapelItems as $item)
                            @include('kajur.jurusan.partials.detail-item', ['tipe' => 'mapel', 'judul' => $item->judul, 'deskripsi' => $item->deskripsi, 'placeholder' => 'Judul mata pelajaran'])
                            @endforeach
                        @else
                            @include('kajur.jurusan.partials.detail-item', ['tipe' => 'mapel', 'judul' => '', 'deskripsi' => '', 'placeholder' => 'Judul mata pelajaran'])
                        @endif
                    </div>
                </div>

                {{-- Tab Content: Karir --}}
                <div x-show="activeTab === 'karir'" class="space-y-4" style="display: none;">
                    <div class="flex items-center justify-between">
                        <p class="text-sm text-slate-600">Daftar peluang karir setelah lulus</p>
                        <button type="button" onclick="addDetailItem('karir')" class="flex items-center gap-2 px-4 py-2 bg-purple-50 hover:bg-purple-100 text-purple-600 text-sm font-medium rounded-lg transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                            Tambah Karir
                        </button>
                    </div>
                    <div id="karir-container" class="space-y-3">
                        @if($jurusan->karirItems->count() > 0)
                            @foreach($jurusan->karirItems as $item)
                            @include('kajur.jurusan.partials.detail-item', ['tipe' => 'karir', 'judul' => $item->judul, 'deskripsi' => $item->deskripsi, 'placeholder' => 'Judul karir'])
                            @endforeach
                        @else
                            @include('kajur.jurusan.partials.detail-item', ['tipe' => 'karir', 'judul' => '', 'deskripsi' => '', 'placeholder' => 'Judul karir'])
                        @endif
                    </div>
                </div>
            </div>
        </div>

        {{-- Section: Info Program --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden" x-data="{ open: false }">
            <button type="button" @click="open = !open" class="w-full px-6 py-4 flex items-center justify-between bg-gradient-to-r from-orange-50 to-white hover:from-orange-100 transition">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-orange-100 rounded-xl flex items-center justify-center">
                        <svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div class="text-left">
                        <h2 class="font-semibold text-slate-800">Info Program</h2>
                        <p class="text-sm text-slate-500">Informasi tambahan tentang program (durasi, sertifikasi, dll)</p>
                    </div>
                </div>
                <svg :class="{ 'rotate-180': open }" class="w-5 h-5 text-slate-400 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
            </button>
            <div x-show="open" x-collapse class="p-6 border-t border-slate-100">
                <div id="info-program-container" class="space-y-3">
                    @if($jurusan->infoProgram->count() > 0)
                        @foreach($jurusan->infoProgram as $info)
                        @include('kajur.jurusan.partials.info-item', ['label' => $info->label, 'value' => $info->value])
                        @endforeach
                    @else
                        @include('kajur.jurusan.partials.info-item', ['label' => 'Durasi', 'value' => '3 Tahun'])
                        @include('kajur.jurusan.partials.info-item', ['label' => 'Sertifikasi', 'value' => 'BNSP / LSP'])
                        @include('kajur.jurusan.partials.info-item', ['label' => 'Prakerin', 'value' => 'Di Industri'])
                    @endif
                </div>
                <button type="button" onclick="addInfoProgram()" class="mt-4 flex items-center gap-2 px-4 py-2 bg-orange-50 hover:bg-orange-100 text-orange-600 text-sm font-medium rounded-lg transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                    Tambah Info
                </button>
            </div>
        </div>

        {{-- Section: Kegiatan --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden" x-data="{ open: false }">
            <button type="button" @click="open = !open" class="w-full px-6 py-4 flex items-center justify-between bg-gradient-to-r from-pink-50 to-white hover:from-pink-100 transition">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-pink-100 rounded-xl flex items-center justify-center">
                        <svg class="w-5 h-5 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div class="text-left">
                        <h2 class="font-semibold text-slate-800">Kegiatan Jurusan</h2>
                        <p class="text-sm text-slate-500">Foto dan deskripsi kegiatan ({{ $jurusan->kegiatan->count() }} kegiatan)</p>
                    </div>
                </div>
                <svg :class="{ 'rotate-180': open }" class="w-5 h-5 text-slate-400 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
            </button>
            <div x-show="open" x-collapse class="p-6 border-t border-slate-100">
                <div id="kegiatan-container" class="space-y-4">
                    @if($jurusan->kegiatan->count() > 0)
                        @foreach($jurusan->kegiatan as $index => $kegiatan)
                        @include('kajur.jurusan.partials.kegiatan-item', [
                            'index' => $index,
                            'kegiatan' => $kegiatan,
                            'judul' => $kegiatan->judul,
                            'deskripsi' => $kegiatan->deskripsi,
                            'gambar' => $kegiatan->gambar
                        ])
                        @endforeach
                    @else
                        @include('kajur.jurusan.partials.kegiatan-item', [
                            'index' => 0,
                            'kegiatan' => null,
                            'judul' => '',
                            'deskripsi' => '',
                            'gambar' => collect()
                        ])
                    @endif
                </div>
                <button type="button" onclick="addKegiatan()" class="mt-4 w-full flex items-center justify-center gap-2 px-4 py-3 border-2 border-dashed border-pink-200 hover:border-pink-400 text-pink-600 font-medium rounded-xl transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                    Tambah Kegiatan Baru
                </button>
            </div>
        </div>

        {{-- Bottom Actions --}}
        <div class="sticky bottom-0 bg-slate-50 border-t border-slate-200 p-4 -mx-4 sm:mx-0 sm:rounded-2xl sm:border">
            <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                <a href="{{ route('kajur.dashboard') }}" class="w-full sm:w-auto flex items-center justify-center gap-2 px-6 py-3 bg-white border border-slate-300 text-slate-700 font-medium rounded-xl hover:bg-slate-50 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    Batal
                </a>
                <button type="submit" class="w-full sm:w-auto flex items-center justify-center gap-2 px-8 py-3 bg-[#4276A3] hover:bg-[#365f85] text-white font-semibold rounded-xl transition shadow-lg">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    Simpan Semua Perubahan
                </button>
            </div>
        </div>
    </form>
</div>

@push('scripts')
<script>
function addDetailItem(tipe) {
    const container = document.getElementById(tipe + '-container');
    const item = document.createElement('div');
    item.className = `detail-item-${tipe} bg-slate-50 rounded-xl p-4 border border-slate-200`;
    
    let placeholder = '';
    let colorClass = '';
    if (tipe === 'kompetensi') { placeholder = 'Judul kompetensi (contoh: Teknik Jaringan)'; colorClass = 'blue'; }
    else if (tipe === 'mapel') { placeholder = 'Judul mata pelajaran (contoh: Matematika)'; colorClass = 'green'; }
    else if (tipe === 'karir') { placeholder = 'Judul karir (contoh: Network Engineer)'; colorClass = 'purple'; }
    
    item.innerHTML = `
        <div class="flex gap-3">
            <div class="flex-1 space-y-3">
                <input type="text" name="${tipe}_judul[]" 
                    class="w-full rounded-lg border-slate-300 focus:border-${colorClass}-500 focus:ring-${colorClass}-500 text-sm font-medium bg-white"
                    placeholder="${placeholder}">
                <textarea name="${tipe}_deskripsi[]" rows="2" 
                    class="w-full rounded-lg border-slate-300 focus:border-${colorClass}-500 focus:ring-${colorClass}-500 text-sm bg-white"
                    placeholder="Deskripsi ${tipe} (opsional)..."></textarea>
            </div>
            <button type="button" onclick="removeDetailItem(this, '${tipe}')" 
                class="w-10 h-10 flex items-center justify-center text-slate-400 hover:text-red-500 hover:bg-red-50 rounded-lg transition self-start">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
            </button>
        </div>
    `;
    container.appendChild(item);
    
    // Update counter
    const countEl = document.querySelector(`[x-data] span[x-text="${tipe}Count"]`);
    if (countEl) {
        const currentCount = parseInt(countEl.textContent) || 0;
        countEl.textContent = currentCount + 1;
    }
}

function removeDetailItem(button, tipe) {
    const items = document.querySelectorAll('.detail-item-' + tipe);
    if (items.length > 1) {
        button.closest('.detail-item-' + tipe).remove();
        // Update counter
        const countEl = document.querySelector(`[x-data] span[x-text="${tipe}Count"]`);
        if (countEl) {
            const currentCount = parseInt(countEl.textContent) || 1;
            countEl.textContent = Math.max(1, currentCount - 1);
        }
    } else {
        alert('Minimal harus ada 1 item ' + tipe);
    }
}

function addInfoProgram() {
    const container = document.getElementById('info-program-container');
    const item = document.createElement('div');
    item.className = 'info-program-item flex gap-3';
    item.innerHTML = `
        <div class="flex-1">
            <input type="text" name="info_label[]" 
                class="w-full rounded-lg border-slate-300 focus:border-orange-500 focus:ring-orange-500 text-sm"
                placeholder="Label (contoh: Biaya)">
        </div>
        <div class="flex-1">
            <input type="text" name="info_value[]" 
                class="w-full rounded-lg border-slate-300 focus:border-orange-500 focus:ring-orange-500 text-sm"
                placeholder="Value (contoh: Rp 500.000)">
        </div>
        <button type="button" onclick="removeInfoProgram(this)" 
            class="w-10 h-10 flex items-center justify-center text-slate-400 hover:text-red-500 hover:bg-red-50 rounded-lg transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
        </button>
    `;
    container.appendChild(item);
}

function removeInfoProgram(button) {
    const items = document.querySelectorAll('.info-program-item');
    if (items.length > 1) {
        button.closest('.info-program-item').remove();
    } else {
        alert('Minimal harus ada 1 info program');
    }
}

// Kegiatan Functions
let kegiatanIndex = {{ $jurusan->kegiatan->count() > 0 ? $jurusan->kegiatan->count() : 1 }};

function addKegiatan() {
    const container = document.getElementById('kegiatan-container');
    const item = document.createElement('div');
    item.className = 'kegiatan-item bg-slate-50 rounded-xl p-5 border border-slate-200';
    item.setAttribute('data-index', kegiatanIndex);
    item.innerHTML = `
        <input type="hidden" name="kegiatan_id[]" value="new">
        <div class="flex gap-3 mb-4">
            <div class="flex-1">
                <label class="block text-xs font-medium text-slate-600 mb-1">Judul Kegiatan</label>
                <input type="text" name="kegiatan_judul[]" 
                    class="w-full rounded-lg border-slate-300 focus:border-pink-500 focus:ring-pink-500 text-sm font-medium bg-white"
                    placeholder="Contoh: Praktek di Lab">
            </div>
            <button type="button" onclick="removeKegiatan(this)" 
                class="w-10 h-10 flex items-center justify-center text-slate-400 hover:text-red-500 hover:bg-red-50 rounded-lg transition self-end">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
            </button>
        </div>
        <div class="mb-4">
            <label class="block text-xs font-medium text-slate-600 mb-1">Deskripsi</label>
            <textarea name="kegiatan_deskripsi[]" rows="2" 
                class="w-full rounded-lg border-slate-300 focus:border-pink-500 focus:ring-pink-500 text-sm bg-white"
                placeholder="Deskripsi kegiatan (opsional)..."></textarea>
        </div>
        <div>
            <label class="block text-xs font-medium text-slate-600 mb-2">Gambar Kegiatan</label>
            <div class="flex flex-wrap gap-2 mb-2" id="existing-kegiatan-${kegiatanIndex}"></div>
            <label class="inline-flex items-center gap-2 px-4 py-2 bg-white border border-slate-300 hover:border-pink-400 text-slate-700 text-sm font-medium rounded-lg cursor-pointer transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                Tambah Gambar
                <input type="file" name="kegiatan_gambar_${kegiatanIndex}[]" multiple accept="image/*" class="hidden" onchange="previewKegiatanGambar(this, ${kegiatanIndex})">
            </label>
            <div id="preview-kegiatan-${kegiatanIndex}" class="flex flex-wrap gap-2 mt-2"></div>
        </div>
    `;
    container.appendChild(item);
    item.scrollIntoView({ behavior: 'smooth', block: 'center' });
    kegiatanIndex++;
}

function removeKegiatan(button) {
    const items = document.querySelectorAll('.kegiatan-item');
    if (items.length > 1) {
        button.closest('.kegiatan-item').remove();
    } else {
        alert('Minimal harus ada 1 kegiatan');
    }
}

function previewKegiatanGambar(input, index) {
    const previewContainer = document.getElementById('preview-kegiatan-' + index);
    if (!previewContainer) return;
    
    Array.from(input.files).forEach(file => {
        const reader = new FileReader();
        reader.onload = function(e) {
            const div = document.createElement('div');
            div.className = 'relative';
            div.innerHTML = `
                <img src="${e.target.result}" class="w-20 h-20 object-cover rounded-lg border border-slate-200">
                <button type="button" onclick="this.parentElement.remove()" 
                    class="absolute -top-1 -right-1 w-5 h-5 bg-red-500 text-white rounded-full flex items-center justify-center">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            `;
            previewContainer.appendChild(div);
        }
        reader.readAsDataURL(file);
    });
}

function deleteKegiatanGambar(gambarId) {
    if (!confirm('Yakin ingin menghapus gambar ini?')) return;
    
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    
    fetch(`{{ url('kajur/jurusan/kegiatan-gambar') }}/${gambarId}`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': csrfToken,
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            document.getElementById('kegiatan-gambar-' + gambarId)?.remove();
        } else {
            alert('Gagal menghapus gambar');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Terjadi kesalahan');
    });
}

function handleDrop(e, type) {
    e.preventDefault();
    const input = document.getElementById(type);
    const dt = e.dataTransfer;
    const files = dt.files;
    
    if (files.length > 0) {
        input.files = files;
        const event = new Event('change');
        input.dispatchEvent(event);
    }
}
</script>
@endpush
@endsection
