<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FooterSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class FooterController extends Controller
{
    /**
     * Show the form for editing footer
     */
    public function edit()
    {
        $footer = FooterSetting::getSettings();
        return view('admin.footer.edit', compact('footer'));
    }

    /**
     * Update footer settings
     */
    public function update(Request $request)
    {
        $footer = FooterSetting::getSettings();

        $validated = $request->validate([
            'nama_sekolah' => 'required|string|max:255',
            'tagline' => 'required|string|max:500',
            'alamat' => 'required|string|max:500',
            'telepon' => 'required|string|max:50',
            'whatsapp' => 'required|string|max:100',
            'whatsapp_link' => 'required|string|max:500',
            'spmb_title' => 'required|string|max:100',
            'spmb_description' => 'required|string|max:500',
            'spmb_button_text' => 'required|string|max:50',
            'spmb_button_link' => 'required|string|max:500',
            'show_spmb' => 'boolean',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $validated['show_spmb'] = $request->has('show_spmb');

        // Handle logo upload
        if ($request->hasFile('logo')) {
            // Delete old logo if exists
            if ($footer->logo && Storage::disk('public')->exists($footer->logo)) {
                Storage::disk('public')->delete($footer->logo);
            }
            $logoPath = $request->file('logo')->store('footer', 'public');
            $validated['logo'] = $logoPath;
        }

        $footer->update($validated);

        // Clear cache
        Cache::forget('footer_settings');

        return redirect()->route('admin.footer.edit')
            ->with('success', 'Pengaturan footer berhasil diperbarui.');
    }
}
