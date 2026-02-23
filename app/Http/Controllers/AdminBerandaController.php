<?php

namespace App\Http\Controllers;

use App\Models\BerandaSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminBerandaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sections = BerandaSection::orderBy('urutan', 'asc')
            ->orderBy('created_at', 'desc')
            ->get()
            ->groupBy('tipe');
        
        return view('admin.beranda.index', compact('sections'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tipeList = BerandaSection::getTipeList();
        return view('admin.beranda.create', compact('tipeList'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'subjudul' => 'nullable|string|max:255',
            'konten' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'tipe' => 'required|in:hero,about,feature,statistic,cta',
            'urutan' => 'required|integer|min:0',
            'is_active' => 'boolean',
            'tombol_teks' => 'nullable|string|max:100',
            'tombol_link' => 'nullable|string|max:255',
            'warna_latar' => 'nullable|string|max:50',
        ]);

        // Handle gambar upload
        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $namaFile = 'beranda/' . time() . '_' . uniqid() . '.' . $gambar->getClientOriginalExtension();
            $gambar->storeAs('public', $namaFile);
            $validated['gambar'] = $namaFile;
        }

        $validated['is_active'] = $request->boolean('is_active', true);

        BerandaSection::create($validated);

        return redirect()->route('admin.beranda.index')
            ->with('success', 'Section beranda berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BerandaSection $beranda)
    {
        $tipeList = BerandaSection::getTipeList();
        return view('admin.beranda.edit', compact('beranda', 'tipeList'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BerandaSection $beranda)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'subjudul' => 'nullable|string|max:255',
            'konten' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'tipe' => 'required|in:hero,about,feature,statistic,cta',
            'urutan' => 'required|integer|min:0',
            'is_active' => 'boolean',
            'tombol_teks' => 'nullable|string|max:100',
            'tombol_link' => 'nullable|string|max:255',
            'warna_latar' => 'nullable|string|max:50',
        ]);

        // Handle hapus gambar
        if ($request->boolean('hapus_gambar')) {
            if ($beranda->gambar && Storage::disk('public')->exists($beranda->gambar)) {
                Storage::disk('public')->delete($beranda->gambar);
            }
            $validated['gambar'] = null;
        }

        // Handle gambar upload
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($beranda->gambar && Storage::disk('public')->exists($beranda->gambar)) {
                Storage::disk('public')->delete($beranda->gambar);
            }
            
            $gambar = $request->file('gambar');
            $namaFile = 'beranda/' . time() . '_' . uniqid() . '.' . $gambar->getClientOriginalExtension();
            $gambar->storeAs('public', $namaFile);
            $validated['gambar'] = $namaFile;
        }

        $validated['is_active'] = $request->boolean('is_active', true);
        
        // Remove hapus_gambar from validated data
        unset($validated['hapus_gambar']);

        $beranda->update($validated);

        return redirect()->route('admin.beranda.index')
            ->with('success', 'Section beranda berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BerandaSection $beranda)
    {
        // Hapus gambar jika ada
        if ($beranda->gambar && Storage::disk('public')->exists($beranda->gambar)) {
            Storage::disk('public')->delete($beranda->gambar);
        }

        $beranda->delete();

        return redirect()->route('admin.beranda.index')
            ->with('success', 'Section beranda berhasil dihapus.');
    }

    /**
     * Toggle active status
     */
    public function toggleActive(BerandaSection $beranda)
    {
        $beranda->update(['is_active' => !$beranda->is_active]);
        
        $status = $beranda->is_active ? 'diaktifkan' : 'dinonaktifkan';
        
        return redirect()->back()
            ->with('success', "Section berhasil {$status}.");
    }
}
