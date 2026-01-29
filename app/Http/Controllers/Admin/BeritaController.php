<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\KomentarBerita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BeritaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $berita = Berita::terbaru()->withCount('komentar')->get();
        return view('admin.berita.index', compact('berita'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.berita.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'gambar.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'published_at' => 'nullable|date',
        ]);

        $gambarPaths = [];
        if ($request->hasFile('gambar')) {
            foreach ($request->file('gambar') as $file) {
                $gambarPaths[] = $file->store('berita', 'public');
            }
        }

        Berita::create([
            'judul' => $request->judul,
            'slug' => Str::slug($request->judul),
            'isi' => $request->isi,
            'gambar' => $gambarPaths,
            'is_active' => true,
            'published_at' => $request->published_at ?? now(),
        ]);

        return redirect()->route('admin.berita.index')
            ->with('success', 'Berita berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $berita = Berita::findOrFail($id);
        return view('admin.berita.edit', compact('berita'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'gambar.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'published_at' => 'nullable|date',
        ]);

        $berita = Berita::findOrFail($id);

        $gambarPaths = $berita->gambar ?? [];
        
        // Handle removed images
        if ($request->has('hapus_gambar')) {
            foreach ($request->hapus_gambar as $index) {
                if (isset($gambarPaths[$index])) {
                    if (!str_starts_with($gambarPaths[$index], 'http')) {
                        Storage::disk('public')->delete($gambarPaths[$index]);
                    }
                    unset($gambarPaths[$index]);
                }
            }
            $gambarPaths = array_values($gambarPaths); // Reindex
        }

        // Handle new images
        if ($request->hasFile('gambar')) {
            foreach ($request->file('gambar') as $file) {
                $gambarPaths[] = $file->store('berita', 'public');
            }
        }

        $berita->update([
            'judul' => $request->judul,
            'isi' => $request->isi,
            'gambar' => $gambarPaths,
            'published_at' => $request->published_at ?? $berita->published_at,
        ]);

        return redirect()->route('admin.berita.index')
            ->with('success', 'Berita berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $berita = Berita::findOrFail($id);

        // Delete all images
        if (!empty($berita->gambar)) {
            foreach ($berita->gambar as $img) {
                if (!str_starts_with($img, 'http')) {
                    Storage::disk('public')->delete($img);
                }
            }
        }

        $berita->delete();

        return redirect()->route('admin.berita.index')
            ->with('success', 'Berita berhasil dihapus.');
    }

    /**
     * Show comments for a berita
     */
    public function komentar($id)
    {
        $berita = Berita::with('komentar')->findOrFail($id);
        return view('admin.berita.komentar', compact('berita'));
    }

    /**
     * Delete a comment
     */
    public function destroyKomentar($id)
    {
        $komentar = KomentarBerita::findOrFail($id);
        $beritaId = $komentar->berita_id;
        $komentar->delete();

        return redirect()->route('admin.berita.komentar', $beritaId)
            ->with('success', 'Komentar berhasil dihapus.');
    }
}
