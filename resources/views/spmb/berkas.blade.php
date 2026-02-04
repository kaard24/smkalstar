@extends('layouts.app')

@section('title', 'Upload Berkas - SPMB SMK Al-Hidayah Lestari')

@section('content')
<div class="min-h-screen bg-slate-50">
    
  

    @php
        use Illuminate\Support\Str;
        $progress = \App\Models\BerkasPendaftaran::getUploadProgress(auth()->guard('spmb')->user()->id);
    @endphp

    <!-- Main Content -->
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-6 max-w-4xl">
        
        <!-- Progress Card -->
        <div class="bg-white rounded-xl border border-slate-200 p-6 mb-6">
            <div class="flex flex-col sm:flex-row sm:items-center gap-4">
                <div class="flex items-center gap-4">
                    <div class="w-16 h-16 relative">
                        <svg class="w-full h-full transform -rotate-90" viewBox="0 0 36 36">
                            <path class="text-slate-100" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" fill="none" stroke="currentColor" stroke-width="3"/>
                            <path class="{{ $progress['is_complete'] ? 'text-emerald-500' : 'text-blue-500' }}" stroke-dasharray="{{ $progress['percentage'] }}, 100" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round"/>
                        </svg>
                        <div class="absolute inset-0 flex items-center justify-center">
                            <span class="text-lg font-bold {{ $progress['is_complete'] ? 'text-emerald-600' : 'text-blue-600' }}">{{ $progress['percentage'] }}%</span>
                        </div>
                    </div>
                    <div>
                        <h2 class="text-lg font-semibold text-slate-800">Progress Upload</h2>
                        <p class="text-sm text-slate-500">{{ $progress['uploaded'] }} dari {{ $progress['total'] }} berkas</p>
                    </div>
                </div>
                <div class="flex-1 sm:text-right">
                    @if($progress['is_complete'])
                        <span class="inline-flex items-center gap-1.5 text-sm font-medium text-emerald-600 bg-emerald-50 px-3 py-1.5 rounded-lg">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            Semua berkas lengkap
                        </span>
                    @else
                        <span class="text-sm text-amber-600 bg-amber-50 px-3 py-1.5 rounded-lg">
                            {{ $progress['total'] - $progress['uploaded'] }} berkas belum diupload
                        </span>
                    @endif
                </div>
            </div>
            
            <div class="mt-4">
                <div class="h-2 bg-slate-100 rounded-full overflow-hidden">
                    <div class="h-full {{ $progress['is_complete'] ? 'bg-emerald-500' : 'bg-blue-500' }} rounded-full transition-all" style="width: {{ $progress['percentage'] }}%"></div>
                </div>
            </div>
        </div>

        <!-- Panduan Format File -->
        <div class="bg-blue-50 border border-blue-200 rounded-xl p-5 mb-6">
            <div class="flex items-start gap-3 mb-4">
                <div class="w-10 h-10 bg-blue-500 rounded-lg flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="font-semibold text-slate-800">Panduan Upload Berkas</h3>
                    <p class="text-sm text-slate-600">Pastikan file Anda memenuhi ketentuan berikut</p>
                </div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <!-- Kartu Keluarga -->
                <div class="bg-white rounded-lg border border-slate-200 p-4">
                    <div class="flex items-center gap-2 mb-2">
                        <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                        </svg>
                        <h4 class="font-semibold text-slate-800 text-sm">Kartu Keluarga (KK)</h4>
                    </div>
                    <ul class="text-xs text-slate-600 space-y-1 ml-6">
                        <li><span class="text-slate-400">Format:</span> PDF, JPG, PNG</li>
                        <li><span class="text-slate-400">Maksimal:</span> 2 MB</li>
                        <li><span class="text-slate-400">Contoh:</span> <span class="font-mono text-blue-600">kk_andi.pdf</span></li>
                    </ul>
                </div>

                <!-- Akta Kelahiran -->
                <div class="bg-white rounded-lg border border-slate-200 p-4">
                    <div class="flex items-center gap-2 mb-2">
                        <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        <h4 class="font-semibold text-slate-800 text-sm">Akta Kelahiran</h4>
                    </div>
                    <ul class="text-xs text-slate-600 space-y-1 ml-6">
                        <li><span class="text-slate-400">Format:</span> PDF, JPG, PNG</li>
                        <li><span class="text-slate-400">Maksimal:</span> 2 MB</li>
                        <li><span class="text-slate-400">Contoh:</span> <span class="font-mono text-blue-600">akta_andi.pdf</span></li>
                    </ul>
                </div>

                <!-- SKL atau Ijazah -->
                <div class="bg-white rounded-lg border border-slate-200 p-4">
                    <div class="flex items-center gap-2 mb-2">
                        <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                        <h4 class="font-semibold text-slate-800 text-sm">SKL atau Ijazah</h4>
                    </div>
                    <ul class="text-xs text-slate-600 space-y-1 ml-6">
                        <li><span class="text-slate-400">Format:</span> PDF, JPG, PNG</li>
                        <li><span class="text-slate-400">Maksimal:</span> 2 MB</li>
                    </ul>
                    <div class="mt-2 ml-6 px-2 py-1.5 bg-amber-50 border border-amber-200 rounded">
                        <p class="text-xs text-amber-700">
                            <span class="font-semibold">Catatan:</span> Upload SKL jika belum lulus, atau Ijazah jika sudah
                        </p>
                    </div>
                </div>


            </div>
        </div>

        <!-- Preview Grid - Drag & Drop Zone -->
        <div class="bg-white rounded-xl border-2 border-dashed border-slate-300 p-6 mb-6 hover:border-blue-400 transition-colors"
             x-data="{ isDragging: false }"
             x-on:dragover.prevent="isDragging = true"
             x-on:dragleave.prevent="isDragging = false"
             x-on:drop.prevent="isDragging = false"
             :class="{ 'border-blue-500 bg-blue-50': isDragging }"
             id="mainDropZone">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                @foreach($jenisBerkas as $kode => $nama)
                @php
                    $berkasItem = $berkas[$kode] ?? null;
                    $isUploaded = $berkasItem !== null;
                    $fileSize = $isUploaded ? $berkasItem->getFileSize() : null;
                @endphp
                
                <div class="relative group {{ $isUploaded ? 'bg-emerald-50 border-emerald-200' : 'bg-slate-50 border-slate-200' }} border-2 border-dashed rounded-xl p-4 transition-all hover:shadow-md"
                     onclick="openUploadModal('{{ $kode }}', '{{ $nama }}')"
                     style="cursor: pointer;">
                    
                    @if($isUploaded)
                    <!-- Uploaded State -->
                    @php
                        $isImage = !Str::endsWith(strtolower($berkasItem->nama_file), '.pdf');
                        $fileUrl = asset('storage/' . $berkasItem->path_file);
                    @endphp
                    <div class="text-center">
                        @if($isImage)
                        <!-- Image Thumbnail Preview -->
                        <div class="w-20 h-20 mx-auto rounded-xl overflow-hidden mb-3 shadow-md relative group-hover:shadow-lg transition-shadow cursor-pointer"
                             onclick="event.stopPropagation(); openPreviewModal('{{ $fileUrl }}', '{{ $nama }}', 'image')">
                            <img src="{{ $fileUrl }}" alt="{{ $nama }}" class="w-full h-full object-cover hover:scale-110 transition-transform duration-300">
                            <div class="absolute inset-0 bg-black/0 hover:bg-black/10 transition-colors flex items-center justify-center">
                                <svg class="w-6 h-6 text-white opacity-0 hover:opacity-100 transition-opacity drop-shadow-lg" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                            </div>
                        </div>
                        @else
                        <!-- PDF Icon Preview -->
                        <div class="w-14 h-14 mx-auto bg-emerald-500 rounded-xl flex items-center justify-center mb-3 cursor-pointer hover:bg-emerald-600 transition-colors"
                             onclick="event.stopPropagation(); openPreviewModal('{{ $fileUrl }}', '{{ $nama }}', 'pdf')">
                            <svg class="w-7 h-7 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M7 3C5.895 3 5 3.895 5 5v14c0 1.105.895 2 2 2h10c1.105 0 2-.895 2-2V9l-6-6H7zm6 1.5L17.5 9H13V4.5z"/>
                            </svg>
                        </div>
                        @endif
                        <h4 class="font-semibold text-slate-800 text-sm mb-1">{{ $nama }}</h4>
                        <p class="text-xs text-emerald-600 font-medium">{{ $fileSize ?? 'Tersimpan' }}</p>
                        
                        <!-- Hover Actions -->
                        <div class="absolute top-2 right-2 flex gap-1 opacity-0 group-hover:opacity-100 transition-opacity">
                            <button type="button"
                               onclick="event.stopPropagation(); openPreviewModal('{{ $fileUrl }}', '{{ $nama }}', '{{ $isImage ? 'image' : 'pdf' }}')"
                               class="w-7 h-7 bg-white rounded-lg shadow flex items-center justify-center text-slate-600 hover:text-blue-600">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                            </button>
                            <form action="{{ route('spmb.berkas.destroy', $berkasItem) }}" method="POST" 
                                  onclick="event.stopPropagation();"
                                  onsubmit="return confirm('Yakin ingin menghapus berkas ini?')" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-7 h-7 bg-white rounded-lg shadow flex items-center justify-center text-slate-600 hover:text-red-600">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                    @else
                    <!-- Empty State -->
                    <div class="text-center py-4">
                        <div class="w-14 h-14 mx-auto bg-slate-200 rounded-xl flex items-center justify-center mb-3 group-hover:bg-blue-100 group-hover:text-blue-500 transition-colors">
                            <svg class="w-7 h-7 text-slate-400 group-hover:text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                        </div>
                        <h4 class="font-semibold text-slate-700 text-sm mb-1">{{ $nama }}</h4>
                        <p class="text-xs text-slate-400">Klik untuk upload</p>
                    </div>
                    @endif
                </div>
                @endforeach
            </div>
            
            <div class="mt-4 text-center">
                <p class="text-xs text-slate-500 flex items-center justify-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                    </svg>
                    Format: PDF, JPG, PNG (Max 2MB)
                </p>
            </div>
        </div>

        <!-- Alert Messages -->
        @if(session('error'))
        <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg flex items-start gap-3">
            <svg class="w-5 h-5 text-red-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <p class="text-sm text-red-700">{{ session('error') }}</p>
        </div>
        @endif

        @if(session('success'))
        <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 rounded-lg flex items-start gap-3">
            <svg class="w-5 h-5 text-emerald-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <p class="text-sm text-emerald-700">{{ session('success') }}</p>
        </div>
        @endif

        <!-- Files List -->
        <div class="space-y-3">
            @foreach($jenisBerkas as $kode => $nama)
            @php
                $berkasItem = $berkas[$kode] ?? null;
                $isUploaded = $berkasItem !== null;
                $keterangan = \App\Models\BerkasPendaftaran::getKeteranganJenis($kode);
            @endphp
            
            <div class="bg-white rounded-xl border {{ $isUploaded ? 'border-emerald-200' : 'border-slate-200' }} p-4 sm:p-5">
                <div class="flex flex-col sm:flex-row sm:items-center gap-4">
                    <!-- Icon & Info -->
                    <div class="flex items-start gap-4 flex-1">
                        <div class="w-12 h-12 rounded-xl flex items-center justify-center flex-shrink-0 {{ $isUploaded ? 'bg-emerald-500' : 'bg-slate-200' }}">
                            @if($isUploaded)
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4"/>
                                </svg>
                            @else
                                <svg class="w-6 h-6 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                            @endif
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center gap-2 mb-1">
                                <h3 class="font-semibold text-slate-800">{{ $nama }}</h3>
                                <span class="text-xs px-2 py-0.5 rounded {{ $isUploaded ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-100 text-slate-600' }}">
                                    {{ $isUploaded ? 'Tersimpan' : 'Wajib' }}
                                </span>
                            </div>
                            @if($keterangan)
                                <p class="text-xs text-slate-500">{{ $keterangan }}</p>
                            @endif
                            @if($berkasItem)
                                <div class="mt-2 flex items-center gap-2 text-sm text-slate-600">
                                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"/>
                                    </svg>
                                    <span class="truncate max-w-[200px] sm:max-w-xs">{{ $berkasItem->nama_file }}</span>
                                    <span class="text-xs text-emerald-600 font-medium">{{ $berkasItem->getFileSize() }}</span>
                                    <span class="text-xs text-slate-400 whitespace-nowrap">{{ $berkasItem->created_at->diffForHumans() }}</span>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="flex items-center gap-2 sm:flex-shrink-0">
                        @if($berkasItem)
                            <a href="{{ route('spmb.berkas.download', $berkasItem) }}" 
                               class="flex items-center gap-2 px-3 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-lg text-sm font-medium transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                                <span class="hidden sm:inline">Lihat</span>
                            </a>
                            
                            <form action="{{ route('spmb.berkas.destroy', $berkasItem) }}" method="POST" 
                                  onsubmit="return confirm('Yakin ingin menghapus berkas ini?')" class="flex-shrink-0">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="flex items-center gap-2 px-3 py-2 bg-red-50 hover:bg-red-100 text-red-600 rounded-lg text-sm font-medium transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                    <span class="hidden sm:inline">Hapus</span>
                                </button>
                            </form>
                        @endif

                        <button type="button" 
                                onclick="openUploadModal('{{ $kode }}', '{{ $nama }}')"
                                class="flex items-center gap-2 px-4 py-2 {{ $berkasItem ? 'bg-amber-500 hover:bg-amber-600' : 'bg-blue-500 hover:bg-blue-600' }} text-white rounded-lg text-sm font-medium transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                            </svg>
                            <span>{{ $berkasItem ? 'Ganti' : 'Upload' }}</span>
                        </button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Next Step -->
        @if($progress['is_complete'])
            <div class="mt-6 bg-emerald-50 border border-emerald-200 rounded-xl p-5">
                <div class="flex flex-col sm:flex-row sm:items-center gap-4">
                    <div class="w-12 h-12 bg-emerald-500 rounded-lg flex items-center justify-center flex-shrink-0">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h3 class="font-semibold text-slate-800">Semua Berkas Lengkap!</h3>
                        <p class="text-sm text-slate-600">Anda telah berhasil mengupload semua dokumen yang diperlukan.</p>
                    </div>
                    <a href="{{ route('spmb.status') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-white text-emerald-600 rounded-lg font-medium hover:bg-emerald-100 transition-colors">
                        Lihat Status
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                        </svg>
                    </a>
                </div>
            </div>
        @else
            <div class="mt-6 bg-amber-50 border border-amber-200 rounded-xl p-5">
                <div class="flex items-start gap-3">
                    <svg class="w-5 h-5 text-amber-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <div>
                        <h3 class="font-semibold text-amber-900">Lengkapi Semua Berkas</h3>
                        <p class="text-sm text-amber-700">Upload semua dokumen yang diperlukan untuk melanjutkan ke tahap selanjutnya.</p>
                    </div>
                </div>
            </div>
        @endif

    </div>
</div>

{{-- Preview Modal untuk File yang Sudah Diupload --}}
<div id="previewModal" class="fixed inset-0 z-[60] hidden">
    <div class="absolute inset-0 bg-black/80" onclick="closePreviewModal()"></div>
    <div class="absolute inset-0 flex items-center justify-center p-4">
        <div class="bg-white rounded-xl shadow-2xl max-w-4xl w-full max-h-[90vh] flex flex-col relative">
            <!-- Header -->
            <div class="flex items-center justify-between px-6 py-4 border-b border-slate-200">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 id="previewTitle" class="font-semibold text-slate-800">Preview Berkas</h3>
                        <p id="previewSubtitle" class="text-sm text-slate-500">Nama Berkas</p>
                    </div>
                </div>
                <div class="flex items-center gap-2">
                    <a id="previewDownloadBtn" href="#" target="_blank" class="flex items-center gap-2 px-4 py-2 bg-blue-500 text-white rounded-lg text-sm font-medium hover:bg-blue-600 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                        </svg>
                        Download
                    </a>
                    <button type="button" onclick="closePreviewModal()" class="w-10 h-10 bg-slate-100 hover:bg-slate-200 rounded-lg flex items-center justify-center text-slate-500 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>
            
            <!-- Preview Content -->
            <div class="flex-1 overflow-auto p-6 bg-slate-50">
                <div id="previewImageContainer" class="hidden">
                    <img id="previewImage" src="" alt="Preview" class="max-w-full mx-auto rounded-lg shadow-lg">
                </div>
                <div id="previewPdfContainer" class="hidden">
                    <div class="bg-white rounded-lg shadow-lg p-8 text-center">
                        <div class="w-24 h-24 mx-auto bg-red-100 rounded-2xl flex items-center justify-center mb-4">
                            <svg class="w-12 h-12 text-red-500" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M7 3C5.895 3 5 3.895 5 5v14c0 1.105.895 2 2 2h10c1.105 0 2-.895 2-2V9l-6-6H7zm6 1.5L17.5 9H13V4.5z"/>
                            </svg>
                        </div>
                        <h4 class="text-lg font-semibold text-slate-800 mb-2">File PDF</h4>
                        <p class="text-sm text-slate-500 mb-6">File ini adalah dokumen PDF. Klik tombol download untuk melihat detailnya.</p>
                        <a id="previewPdfDownload" href="#" target="_blank" class="inline-flex items-center gap-2 px-6 py-3 bg-red-500 text-white rounded-xl font-medium hover:bg-red-600 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                            </svg>
                            Download PDF
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Upload Modal --}}
<div id="uploadModal" class="fixed inset-0 z-50 hidden">
    <div class="absolute inset-0 bg-black/50" onclick="closeUploadModal()"></div>
    <div class="absolute inset-0 flex items-center justify-center p-4">
        <div class="bg-white rounded-xl shadow-xl max-w-md w-full relative">
            <button type="button" onclick="closeUploadModal()" class="absolute top-4 right-4 w-8 h-8 bg-slate-100 hover:bg-slate-200 rounded-lg flex items-center justify-center text-slate-500 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>

            <div class="p-6">
                <div class="w-12 h-12 bg-blue-500 rounded-xl flex items-center justify-center mb-4">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-slate-800 mb-1">Upload Berkas</h3>
                <p id="modalBerkasNama" class="text-sm text-slate-500 mb-4"></p>

                <form action="{{ route('spmb.berkas.upload') }}" method="POST" enctype="multipart/form-data" id="uploadForm">
                    @csrf
                    <input type="hidden" name="jenis_berkas" id="modalJenisBerkas">

                    <div id="dropZone" class="border-2 border-dashed border-slate-300 rounded-xl p-8 text-center cursor-pointer hover:border-blue-400 hover:bg-blue-50 transition-all"
                         ondragover="this.classList.add('border-blue-500', 'bg-blue-50');"
                         ondragleave="this.classList.remove('border-blue-500', 'bg-blue-50');"
                         ondrop="this.classList.remove('border-blue-500', 'bg-blue-50');">
                        
                        <div id="uploadState">
                            <div class="w-16 h-16 mx-auto bg-slate-100 rounded-2xl flex items-center justify-center mb-4">
                                <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                                </svg>
                            </div>
                            <p class="text-base text-slate-700 font-medium mb-2">Drag & Drop file di sini</p>
                            <p class="text-sm text-slate-500 mb-4">atau</p>
                            <span class="inline-flex items-center gap-2 px-5 py-2.5 bg-blue-500 text-white rounded-lg text-sm font-medium hover:bg-blue-600 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"/>
                                </svg>
                                Pilih File
                            </span>
                            <p class="text-xs text-slate-400 mt-4">PDF, JPG, PNG (Max 2MB)</p>
                        </div>

                        <div id="fileSelectedState" class="hidden">
                            <div id="filePreviewIcon" class="w-20 h-20 mx-auto rounded-2xl flex items-center justify-center mb-4 shadow-lg"></div>
                            <p id="selectedFileName" class="text-base font-medium text-slate-800 mb-1 truncate px-4"></p>
                            <p id="selectedFileSize" class="text-sm text-slate-500 mb-4"></p>
                            <div class="flex items-center justify-center gap-3">
                                <button type="button" onclick="resetFileInput()" class="flex items-center gap-2 px-4 py-2 text-red-500 hover:bg-red-50 rounded-lg text-sm font-medium transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                    Hapus
                                </button>
                            </div>
                        </div>

                        <div id="loadingState" class="hidden">
                            <div class="w-16 h-16 mx-auto bg-blue-100 rounded-2xl flex items-center justify-center mb-4">
                                <svg class="w-8 h-8 text-blue-500 animate-spin" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                            </div>
                            <p class="text-base text-slate-700 font-medium mb-1">Mengupload...</p>
                            <p class="text-sm text-slate-500">Mohon tunggu sebentar</p>
                        </div>

                        <input type="file" name="file" id="fileInput" accept=".pdf,.jpg,.jpeg,.png" class="hidden" required>
                    </div>

                    @error('file')
                    <p class="mt-3 text-sm text-red-500 text-center">{{ $message }}</p>
                    @enderror
                    
                    @error('jenis_berkas')
                    <p class="mt-3 text-sm text-red-500 text-center">{{ $message }}</p>
                    @enderror

                    <div class="flex gap-3 mt-5">
                        <button type="button" onclick="closeUploadModal()" class="flex-1 px-4 py-2.5 border border-slate-300 text-slate-700 rounded-lg hover:bg-slate-50 transition-colors text-sm font-medium">
                            Batal
                        </button>
                        <button type="submit" id="submitBtn" disabled class="flex-1 px-4 py-2.5 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors text-sm font-medium disabled:opacity-50 disabled:cursor-not-allowed">
                            Upload
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
const dropZone = document.getElementById('dropZone');
const fileInput = document.getElementById('fileInput');
const uploadState = document.getElementById('uploadState');
const fileSelectedState = document.getElementById('fileSelectedState');
const loadingState = document.getElementById('loadingState');
const selectedFileName = document.getElementById('selectedFileName');
const selectedFileSize = document.getElementById('selectedFileSize');
const filePreviewIcon = document.getElementById('filePreviewIcon');
const submitBtn = document.getElementById('submitBtn');
const uploadForm = document.getElementById('uploadForm');

['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
    dropZone.addEventListener(eventName, preventDefaults, false);
    document.body.addEventListener(eventName, preventDefaults, false);
});

['dragenter', 'dragover'].forEach(eventName => {
    dropZone.addEventListener(eventName, () => dropZone.classList.add('border-blue-400', 'bg-blue-50'), false);
});

['dragleave', 'drop'].forEach(eventName => {
    dropZone.addEventListener(eventName, () => dropZone.classList.remove('border-blue-400', 'bg-blue-50'), false);
});

dropZone.addEventListener('drop', handleDrop, false);
dropZone.addEventListener('click', handleClick, false);
fileInput.addEventListener('change', handleFiles, false);
uploadForm.addEventListener('submit', handleSubmit, false);

function handleClick(e) {
    // Jangan trigger klik jika yang diklik adalah tombol Hapus & Pilih Ulang
    if (e.target.closest('button')) {
        return;
    }
    fileInput.click();
}

function preventDefaults(e) {
    e.preventDefault();
    e.stopPropagation();
}

function handleDrop(e) {
    const dt = e.dataTransfer;
    const files = dt.files;
    if (files.length > 0) {
        fileInput.files = files;
        handleFiles();
    }
}

function handleFiles() {
    const file = fileInput.files[0];
    if (file) {
        if (file.size > 2 * 1024 * 1024) {
            alert('Ukuran file terlalu besar. Maksimal 2MB.');
            resetFileInput();
            return;
        }
        const allowedTypes = ['application/pdf', 'image/jpeg', 'image/jpg', 'image/png'];
        if (!allowedTypes.includes(file.type)) {
            alert('Format file tidak didukung. Harap upload PDF, JPG, atau PNG.');
            resetFileInput();
            return;
        }
        showFileSelected(file);
    }
}

function showFileSelected(file) {
    uploadState.classList.add('hidden');
    fileSelectedState.classList.remove('hidden');
    loadingState.classList.add('hidden');
    selectedFileName.textContent = file.name;
    selectedFileSize.textContent = formatFileSize(file.size);
    
    if (file.type === 'application/pdf') {
        filePreviewIcon.innerHTML = `
            <div class="flex flex-col items-center">
                <svg class="w-10 h-10 text-red-500 mb-1" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M7 3C5.895 3 5 3.895 5 5v14c0 1.105.895 2 2 2h10c1.105 0 2-.895 2-2V9l-6-6H7zm6 1.5L17.5 9H13V4.5z"/>
                </svg>
                <span class="text-xs text-red-600 font-medium">PDF</span>
            </div>`;
        filePreviewIcon.className = 'w-20 h-20 mx-auto rounded-2xl flex items-center justify-center mb-4 shadow-lg bg-gradient-to-br from-red-50 to-red-100';
    } else if (file.type.startsWith('image/')) {
        // Create image preview
        const reader = new FileReader();
        reader.onload = function(e) {
            filePreviewIcon.innerHTML = `
                <img src="${e.target.result}" alt="Preview" class="w-full h-full object-cover rounded-2xl">
                <div class="absolute -bottom-2 -right-2 w-8 h-8 bg-emerald-500 rounded-full flex items-center justify-center shadow-md">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                </div>`;
        };
        reader.readAsDataURL(file);
        filePreviewIcon.className = 'w-20 h-20 mx-auto rounded-2xl flex items-center justify-center mb-4 shadow-lg relative overflow-hidden bg-slate-100';
    } else {
        filePreviewIcon.innerHTML = `
            <div class="flex flex-col items-center">
                <svg class="w-10 h-10 text-blue-500 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                <span class="text-xs text-blue-600 font-medium">IMAGE</span>
            </div>`;
        filePreviewIcon.className = 'w-20 h-20 mx-auto rounded-2xl flex items-center justify-center mb-4 shadow-lg bg-gradient-to-br from-blue-50 to-blue-100';
    }
    submitBtn.disabled = false;
}

function resetFileInput() {
    fileInput.value = '';
    uploadState.classList.remove('hidden');
    fileSelectedState.classList.add('hidden');
    loadingState.classList.add('hidden');
    submitBtn.disabled = true;
}

function handleSubmit(e) {
    if (!fileInput.files[0]) {
        e.preventDefault();
        alert('Silakan pilih file terlebih dahulu.');
        return;
    }
    uploadState.classList.add('hidden');
    fileSelectedState.classList.add('hidden');
    loadingState.classList.remove('hidden');
    submitBtn.disabled = true;
}

function formatFileSize(bytes) {
    if (bytes === 0) return '0 Bytes';
    const k = 1024;
    const sizes = ['Bytes', 'KB', 'MB'];
    const i = Math.floor(Math.log(bytes) / Math.log(k));
    return Math.round(bytes / Math.pow(k, i) * 100) / 100 + ' ' + sizes[i];
}

function openPreviewModal(fileUrl, nama, type) {
    document.getElementById('previewTitle').textContent = 'Preview: ' + nama;
    document.getElementById('previewSubtitle').textContent = nama;
    document.getElementById('previewDownloadBtn').href = fileUrl;
    
    const imageContainer = document.getElementById('previewImageContainer');
    const pdfContainer = document.getElementById('previewPdfContainer');
    
    if (type === 'image') {
        imageContainer.classList.remove('hidden');
        pdfContainer.classList.add('hidden');
        document.getElementById('previewImage').src = fileUrl;
    } else {
        imageContainer.classList.add('hidden');
        pdfContainer.classList.remove('hidden');
        document.getElementById('previewPdfDownload').href = fileUrl;
    }
    
    document.getElementById('previewModal').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closePreviewModal() {
    document.getElementById('previewModal').classList.add('hidden');
    document.body.style.overflow = '';
    document.getElementById('previewImage').src = '';
}

function openUploadModal(jenis, nama) {
    document.getElementById('modalJenisBerkas').value = jenis;
    document.getElementById('modalBerkasNama').textContent = nama;
    document.getElementById('uploadModal').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
    resetFileInput();
}

function closeUploadModal() {
    document.getElementById('uploadModal').classList.add('hidden');
    document.body.style.overflow = '';
    resetFileInput();
}

document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        if (!document.getElementById('previewModal').classList.contains('hidden')) {
            closePreviewModal();
        } else if (!document.getElementById('uploadModal').classList.contains('hidden')) {
            closeUploadModal();
        }
    }
});

// Auto-open modal if there are validation errors
@if($errors->has('file') || $errors->has('jenis_berkas'))
    @php
        $oldJenis = old('jenis_berkas');
        $jenisNama = $oldJenis ? (\App\Models\BerkasPendaftaran::getJenisBerkas()[$oldJenis] ?? $oldJenis) : '';
    @endphp
    @if($oldJenis)
        document.addEventListener('DOMContentLoaded', function() {
            openUploadModal('{{ $oldJenis }}', '{{ $jenisNama }}');
        });
    @endif
@endif
</script>
@endsection
