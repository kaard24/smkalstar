<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SpmbJurusan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;

class SpmbJurusanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jurusan = SpmbJurusan::ordered()->get();
        return view('admin.spmb.jurusan.index', compact('jurusan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.spmb.jurusan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode' => 'required|string|max:10|unique:spmb_jurusan',
            'nama' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'warna_border' => 'nullable|string|max:50',
            'warna_bg' => 'nullable|string|max:50',
            'warna_text' => 'nullable|string|max:50',
            'warna_hover' => 'nullable|string|max:50',
            'urutan' => 'required|integer|min:0',
            'aktif' => 'boolean',
        ]);

        // Handle logo upload
        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $logoName = 'spmb/jurusan/logo_' . time() . '_' . uniqid() . '.' . $logo->getClientOriginalExtension();
            $logo->storeAs('public', $logoName);
            $validated['logo'] = $logoName;
        }

        // Handle gambar upload
        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $gambarName = 'spmb/jurusan/gambar_' . time() . '_' . uniqid() . '.' . $gambar->getClientOriginalExtension();
            $gambar->storeAs('public', $gambarName);
            $validated['gambar'] = $gambarName;
        }

        $validated['aktif'] = $request->boolean('aktif', true);

        SpmbJurusan::create($validated);

        // Clear cache
        Cache::forget('spmb_data');

        return redirect()->route('admin.spmb.jurusan.index')
            ->with('success', 'Program keahlian berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SpmbJurusan $jurusan)
    {
        return view('admin.spmb.jurusan.edit', compact('jurusan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SpmbJurusan $jurusan)
    {
        $validated = $request->validate([
            'kode' => 'required|string|max:10|unique:spmb_jurusan,kode,' . $jurusan->id,
            'nama' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'warna_border' => 'nullable|string|max:50',
            'warna_bg' => 'nullable|string|max:50',
            'warna_text' => 'nullable|string|max:50',
            'warna_hover' => 'nullable|string|max:50',
            'urutan' => 'required|integer|min:0',
            'aktif' => 'boolean',
        ]);

        // Handle logo upload
        if ($request->hasFile('logo')) {
            // Hapus logo lama
            if ($jurusan->logo && Storage::disk('public')->exists($jurusan->logo)) {
                Storage::disk('public')->delete($jurusan->logo);
            }
            $logo = $request->file('logo');
            $logoName = 'spmb/jurusan/logo_' . time() . '_' . uniqid() . '.' . $logo->getClientOriginalExtension();
            $logo->storeAs('public', $logoName);
            $validated['logo'] = $logoName;
        }

        // Handle gambar upload
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama
            if ($jurusan->gambar && Storage::disk('public')->exists($jurusan->gambar)) {
                Storage::disk('public')->delete($jurusan->gambar);
            }
            $gambar = $request->file('gambar');
            $gambarName = 'spmb/jurusan/gambar_' . time() . '_' . uniqid() . '.' . $gambar->getClientOriginalExtension();
            $gambar->storeAs('public', $gambarName);
            $validated['gambar'] = $gambarName;
        }

        $validated['aktif'] = $request->boolean('aktif', true);

        $jurusan->update($validated);

        // Clear cache
        Cache::forget('spmb_data');

        return redirect()->route('admin.spmb.jurusan.index')
            ->with('success', 'Program keahlian berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SpmbJurusan $jurusan)
    {
        // Hapus file
        if ($jurusan->logo && Storage::disk('public')->exists($jurusan->logo)) {
            Storage::disk('public')->delete($jurusan->logo);
        }
        if ($jurusan->gambar && Storage::disk('public')->exists($jurusan->gambar)) {
            Storage::disk('public')->delete($jurusan->gambar);
        }

        $jurusan->delete();

        // Clear cache
        Cache::forget('spmb_data');

        return redirect()->route('admin.spmb.jurusan.index')
            ->with('success', 'Program keahlian berhasil dihapus.');
    }

    /**
     * Toggle active status
     */
    public function toggleActive(SpmbJurusan $jurusan)
    {
        $jurusan->update(['aktif' => !$jurusan->aktif]);
        
        // Clear cache
        Cache::forget('spmb_data');
        
        $status = $jurusan->aktif ? 'diaktifkan' : 'dinonaktifkan';
        
        return redirect()->back()
            ->with('success', "Program keahlian berhasil {$status}.");
    }
}
