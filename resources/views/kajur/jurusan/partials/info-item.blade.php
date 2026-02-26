<div class="info-program-item flex gap-3">
    <div class="flex-1">
        <input type="text" name="info_label[]" value="{{ $label }}" 
            class="w-full rounded-lg border-slate-300 focus:border-orange-500 focus:ring-orange-500 text-sm"
            placeholder="Label (contoh: Durasi)">
    </div>
    <div class="flex-1">
        <input type="text" name="info_value[]" value="{{ $value }}" 
            class="w-full rounded-lg border-slate-300 focus:border-orange-500 focus:ring-orange-500 text-sm"
            placeholder="Value (contoh: 3 Tahun)">
    </div>
    <button type="button" onclick="removeInfoProgram(this)" 
        class="w-10 h-10 flex items-center justify-center text-slate-400 hover:text-red-500 hover:bg-red-50 rounded-lg transition">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
    </button>
</div>
