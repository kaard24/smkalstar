<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FooterSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FooterSettingController extends Controller
{
    public function edit()
    {
        $footer = FooterSetting::getSettings();
        return view('admin.footer.edit', compact('footer'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'nama_sekolah' => 'required|string|max:255',
            'tagline' => 'required|string',
            'alamat' => 'required|string',
            'telepon' => 'required|string|max:50',
            'whatsapp' => 'nullable|string|max:100',
            'whatsapp_link' => 'nullable|string|max:255',
            'spmb_title' => 'required|string|max:255',
            'spmb_description' => 'required|string',
            'spmb_button_text' => 'required|string|max:100',
            'spmb_button_link' => 'required|string|max:255',
            'show_spmb' => 'boolean',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $validated['show_spmb'] = $request->boolean('show_spmb', false);

        $footer = FooterSetting::getSettings();
        
        if ($request->hasFile('logo')) {
            if ($footer->logo && Storage::disk('public')->exists($footer->logo)) {
                Storage::disk('public')->delete($footer->logo);
            }
            $validated['logo'] = $request->file('logo')->store('footer', 'public');
        }

        $footer->update($validated);
        return redirect()->route('admin.footer.edit')->with('success', 'Pengaturan footer berhasil diperbarui.');
    }
}
