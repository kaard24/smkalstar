<div class="detail-item-{{ $tipe }} bg-slate-50 rounded-xl p-4 border border-slate-200">
    <div class="flex gap-3">
        <div class="flex-1 space-y-3">
            <input type="text" name="{{ $tipe }}_judul[]" value="{{ $judul }}"
                class="w-full rounded-lg border-slate-300 focus:border-blue-500 focus:ring-blue-500 text-sm font-medium bg-white"
                placeholder="{{ $placeholder }}">
            <textarea name="{{ $tipe }}_deskripsi[]" rows="2" 
                class="w-full rounded-lg border-slate-300 focus:border-blue-500 focus:ring-blue-500 text-sm bg-white"
                placeholder="Deskripsi {{ $tipe }} (opsional)...">{{ $deskripsi }}</textarea>
        </div>
        <button type="button" onclick="removeDetailItem(this, '{{ $tipe }}')" 
            class="w-10 h-10 flex items-center justify-center text-slate-400 hover:text-red-500 hover:bg-red-50 rounded-lg transition self-start">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
        </button>
    </div>
</div>
