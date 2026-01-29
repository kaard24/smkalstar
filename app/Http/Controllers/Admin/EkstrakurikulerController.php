<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ekstrakurikuler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EkstrakurikulerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ekstrakurikuler = Ekstrakurikuler::urut()->get();
        return view('admin.ekstrakurikuler.index', compact('ekstrakurikuler'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.ekstrakurikuler.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|array',
            'gambar.*' => 'image|mimes:jpg,jpeg,png,webp|max:2048',
            'urutan' => 'nullable|integer',
            'aktif' => 'boolean',
        ]);

        $data = [
            'nama' => $validated['nama'],
            'deskripsi' => $validated['deskripsi'] ?? null,
            'urutan' => $validated['urutan'] ?? 0,
            'aktif' => $request->has('aktif'),
        ];

        if ($request->hasFile('gambar')) {
             $images = [];
             foreach ($request->file('gambar') as $file) {
                 $images[] = $file->store('ekstrakurikuler', 'public');
             }
             $data['gambar'] = $images;
        }

        Ekstrakurikuler::create($data);

        return redirect()->route('admin.ekstrakurikuler.index')->with('success', 'Ekstrakurikuler berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ekstrakurikuler $ekstrakurikuler)
    {
        return view('admin.ekstrakurikuler.form', ['ekstrakurikuler' => $ekstrakurikuler]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ekstrakurikuler $ekstrakurikuler)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|array',
            'gambar.*' => 'image|mimes:jpg,jpeg,png,webp|max:2048',
            'urutan' => 'nullable|integer',
            'aktif' => 'boolean',
        ]);

        $data = [
            'nama' => $validated['nama'],
            'deskripsi' => $validated['deskripsi'] ?? null,
            'urutan' => $validated['urutan'] ?? 0,
            'aktif' => $request->has('aktif'),
        ];

        // Handle new images
        $currentImages = $ekstrakurikuler->gambar ?? [];
        if (!is_array($currentImages)) $currentImages = [];

        if ($request->hasFile('gambar')) {
             foreach ($request->file('gambar') as $file) {
                 $currentImages[] = $file->store('ekstrakurikuler', 'public');
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

        $ekstrakurikuler->update($data);

        return redirect()->route('admin.ekstrakurikuler.index')->with('success', 'Ekstrakurikuler berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ekstrakurikuler $ekstrakurikuler)
    {
        if ($ekstrakurikuler->gambar && !str_starts_with($ekstrakurikuler->gambar, 'http')) {
            Storage::disk('public')->delete($ekstrakurikuler->gambar);
        }

        $ekstrakurikuler->delete();

        return redirect()->route('admin.ekstrakurikuler.index')->with('success', 'Ekstrakurikuler berhasil dihapus.');
    }
}
