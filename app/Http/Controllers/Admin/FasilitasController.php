<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Fasilitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FasilitasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fasilitas = Fasilitas::urut()->get();
        return view('admin.fasilitas.index', compact('fasilitas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.fasilitas.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'gambar' => 'nullable|array',
            'gambar.*' => 'image|mimes:jpg,jpeg,png,webp|max:2048',
            'urutan' => 'nullable|integer',
            'aktif' => 'boolean',
        ]);

        $data = [
            'nama' => $validated['nama'],
            'urutan' => $validated['urutan'] ?? 0,
            'aktif' => $request->has('aktif'),
        ];

        if ($request->hasFile('gambar')) {
             $images = [];
             foreach ($request->file('gambar') as $file) {
                 $images[] = $file->store('fasilitas', 'public');
             }
             $data['gambar'] = $images;
        }

        Fasilitas::create($data);

        return redirect()->route('admin.fasilitas.index')->with('success', 'Fasilitas berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Fasilitas $fasilita)
    {
        return view('admin.fasilitas.form', ['fasilitas' => $fasilita]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Fasilitas $fasilita)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'gambar' => 'nullable|array',
            'gambar.*' => 'image|mimes:jpg,jpeg,png,webp|max:2048',
            'urutan' => 'nullable|integer',
            'aktif' => 'boolean',
        ]);

        $data = [
            'nama' => $validated['nama'],
            'urutan' => $validated['urutan'] ?? 0,
            'aktif' => $request->has('aktif'),
        ];

        // Handle new images
        $currentImages = $fasilita->gambar ?? [];
        if (!is_array($currentImages)) $currentImages = [];

        if ($request->hasFile('gambar')) {
             foreach ($request->file('gambar') as $file) {
                 $currentImages[] = $file->store('fasilitas', 'public');
             }
        }
        
        // Handle image deletion
        if ($request->has('hapus_gambar')) {
             $indexesToDelete = $request->hapus_gambar;
             $newImages = [];
             
             foreach ($currentImages as $index => $path) {
                 if (in_array($index, $indexesToDelete)) {
                     if (!str_starts_with($path, 'http')) {
                         Storage::disk('public')->delete($path);
                     }
                 } else {
                     $newImages[] = $path;
                 }
             }
             $currentImages = array_values($newImages);
        }

        $data['gambar'] = $currentImages;

        $fasilita->update($data);

        return redirect()->route('admin.fasilitas.index')->with('success', 'Fasilitas berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Fasilitas $fasilita)
    {
        if ($fasilita->gambar && !str_starts_with($fasilita->gambar, 'http')) {
            Storage::disk('public')->delete($fasilita->gambar);
        }

        $fasilita->delete();

        return redirect()->route('admin.fasilitas.index')->with('success', 'Fasilitas berhasil dihapus.');
    }
}
