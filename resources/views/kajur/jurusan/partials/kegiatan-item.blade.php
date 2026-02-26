<div class="kegiatan-item bg-slate-50 rounded-xl p-5 border border-slate-200" data-index="{{ $index }}">
    <input type="hidden" name="kegiatan_id[]" value="{{ $kegiatan ? $kegiatan->id : 'new' }}">
    <div class="flex gap-3 mb-4">
        <div class="flex-1">
            <label class="block text-xs font-medium text-slate-600 mb-1">Judul Kegiatan</label>
            <input type="text" name="kegiatan_judul[]" value="{{ $judul }}"
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
            placeholder="Deskripsi kegiatan (opsional)...">{{ $deskripsi }}</textarea>
    </div>
    <div>
        <label class="block text-xs font-medium text-slate-600 mb-2">Gambar Kegiatan</label>
        <div class="flex flex-wrap gap-2 mb-2">
            @foreach($gambar as $g)
            <div class="relative group" id="kegiatan-gambar-{{ $g->id }}">
                <img src="{{ $g->gambar_url }}" class="w-20 h-20 object-cover rounded-lg border border-slate-200">
                <button type="button" onclick="deleteKegiatanGambar({{ $g->id }})" 
                    class="absolute -top-1.5 -right-1.5 w-5 h-5 bg-red-500 text-white rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition shadow-sm">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
            @endforeach
        </div>
        <label class="inline-flex items-center gap-2 px-4 py-2 bg-white border border-slate-300 hover:border-pink-400 text-slate-700 text-sm font-medium rounded-lg cursor-pointer transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
            Tambah Gambar
            <input type="file" name="kegiatan_gambar_{{ $index }}[]" multiple accept="image/*" class="hidden" onchange="previewKegiatanGambar(this, {{ $index }})">
        </label>
        <div id="preview-kegiatan-{{ $index }}" class="flex flex-wrap gap-2 mt-2"></div>
    </div>
</div>
