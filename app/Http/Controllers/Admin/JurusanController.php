<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Jurusan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class JurusanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jurusan = Jurusan::orderBy('urutan')->get();
        return view('admin.jurusan.index', compact('jurusan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.jurusan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode' => 'required|string|max:10|unique:jurusan,kode',
            'nama' => 'required|string|max:255',
            'kategori' => 'nullable|string|max:255',
            'deskripsi' => 'nullable|string',
            'peluang_karir' => 'nullable|string',
            'urutan' => 'nullable|integer|min:0',
            'aktif' => 'boolean',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

        // Handle logo upload
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('jurusan/logo', 'public');
            $validated['logo'] = $logoPath;
        }

        // Handle gambar upload
        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('jurusan/gambar', 'public');
            $validated['gambar'] = $gambarPath;
        }

        // Process peluang karir
        if (!empty($validated['peluang_karir'])) {
            $validated['peluang_karir'] = array_map('trim', explode("\n", $validated['peluang_karir']));
        }

        $validated['aktif'] = $request->has('aktif');
        $validated['urutan'] = $validated['urutan'] ?? (Jurusan::max('urutan') + 1);

        Jurusan::create($validated);
        Cache::forget('jurusan_aktif');

        return redirect()->route('admin.jurusan.index')
            ->with('success', 'Program keahlian berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Jurusan $jurusan)
    {
        return view('admin.jurusan.show', compact('jurusan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Jurusan $jurusan)
    {
        return view('admin.jurusan.edit', compact('jurusan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Jurusan $jurusan)
    {
        $validated = $request->validate([
            'kode' => 'required|string|max:10|unique:jurusan,kode,' . $jurusan->id,
            'nama' => 'required|string|max:255',
            'kategori' => 'nullable|string|max:255',
            'deskripsi' => 'nullable|string',
            'peluang_karir' => 'nullable|string',
            'urutan' => 'nullable|integer|min:0',
            'aktif' => 'boolean',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

        // Handle logo upload
        if ($request->hasFile('logo')) {
            // Delete old logo if exists
            if ($jurusan->logo && Storage::disk('public')->exists($jurusan->logo)) {
                Storage::disk('public')->delete($jurusan->logo);
            }
            $logoPath = $request->file('logo')->store('jurusan/logo', 'public');
            $validated['logo'] = $logoPath;
        }

        // Handle gambar upload
        if ($request->hasFile('gambar')) {
            // Delete old gambar if exists
            if ($jurusan->gambar && Storage::disk('public')->exists($jurusan->gambar)) {
                Storage::disk('public')->delete($jurusan->gambar);
            }
            $gambarPath = $request->file('gambar')->store('jurusan/gambar', 'public');
            $validated['gambar'] = $gambarPath;
        }

        // Process peluang karir
        if (!empty($validated['peluang_karir'])) {
            $validated['peluang_karir'] = array_map('trim', explode("\n", $validated['peluang_karir']));
        } else {
            $validated['peluang_karir'] = null;
        }

        $validated['aktif'] = $request->has('aktif');
        $validated['urutan'] = $validated['urutan'] ?? $jurusan->urutan;

        $jurusan->update($validated);
        Cache::forget('jurusan_aktif');

        return redirect()->route('admin.jurusan.index')
            ->with('success', 'Program keahlian berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jurusan $jurusan)
    {
        // Delete files if exists
        if ($jurusan->logo && Storage::disk('public')->exists($jurusan->logo)) {
            Storage::disk('public')->delete($jurusan->logo);
        }
        if ($jurusan->gambar && Storage::disk('public')->exists($jurusan->gambar)) {
            Storage::disk('public')->delete($jurusan->gambar);
        }

        $jurusan->delete();
        Cache::forget('jurusan_aktif');

        return redirect()->route('admin.jurusan.index')
            ->with('success', 'Program keahlian berhasil dihapus.');
    }
}
