<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Seragam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;

class SeragamController extends Controller
{
    protected $hariList = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
    protected $warnaList = [
        'blue' => 'Biru',
        'gray' => 'Abu-abu',
        'green' => 'Hijau',
        'red' => 'Merah',
        'purple' => 'Ungu',
        'orange' => 'Oranye',
        'brown' => 'Coklat',
    ];

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $seragam = Seragam::ordered()->get();
        return view('admin.seragam.index', compact('seragam'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $hariList = $this->hariList;
        $warnaList = $this->warnaList;
        $existingHari = Seragam::pluck('hari')->toArray();
        
        return view('admin.seragam.create', compact('hariList', 'warnaList', 'existingHari'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'hari' => 'required|string|in:' . implode(',', $this->hariList) . '|unique:seragam,hari',
            'foto_laki' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'foto_perempuan' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'keterangan' => 'nullable|string|max:500',
            'warna_tema' => 'required|string|in:' . implode(',', array_keys($this->warnaList)),
            'urutan' => 'nullable|integer|min:0',
            'aktif' => 'boolean',
        ], [
            'hari.unique' => 'Seragam untuk hari ini sudah ada.',
            'foto_laki.required' => 'Foto seragam laki-laki wajib diupload.',
            'foto_perempuan.required' => 'Foto seragam perempuan wajib diupload.',
            'foto_laki.image' => 'File harus berupa gambar.',
            'foto_perempuan.image' => 'File harus berupa gambar.',
            'foto_laki.max' => 'Ukuran foto maksimal 2MB.',
            'foto_perempuan.max' => 'Ukuran foto maksimal 2MB.',
        ]);

        // Upload foto laki-laki
        if ($request->hasFile('foto_laki')) {
            $validated['foto_laki'] = $request->file('foto_laki')->store('seragam', 'public');
        }

        // Upload foto perempuan
        if ($request->hasFile('foto_perempuan')) {
            $validated['foto_perempuan'] = $request->file('foto_perempuan')->store('seragam', 'public');
        }

        $validated['aktif'] = $request->has('aktif');
        $validated['urutan'] = $validated['urutan'] ?? 0;

        Seragam::create($validated);

        // Clear cache
        Cache::forget('seragam_aktif');

        return redirect()->route('admin.seragam.index')
            ->with('success', 'Seragam berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Seragam $seragam)
    {
        $hariList = $this->hariList;
        $warnaList = $this->warnaList;
        
        return view('admin.seragam.edit', compact('seragam', 'hariList', 'warnaList'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Seragam $seragam)
    {
        $validated = $request->validate([
            'hari' => 'required|string|in:' . implode(',', $this->hariList) . '|unique:seragam,hari,' . $seragam->id,
            'foto_laki' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'foto_perempuan' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'keterangan' => 'nullable|string|max:500',
            'warna_tema' => 'required|string|in:' . implode(',', array_keys($this->warnaList)),
            'urutan' => 'nullable|integer|min:0',
            'aktif' => 'boolean',
        ], [
            'hari.unique' => 'Seragam untuk hari ini sudah ada.',
            'foto_laki.image' => 'File harus berupa gambar.',
            'foto_perempuan.image' => 'File harus berupa gambar.',
            'foto_laki.max' => 'Ukuran foto maksimal 2MB.',
            'foto_perempuan.max' => 'Ukuran foto maksimal 2MB.',
        ]);

        // Upload foto laki-laki baru jika ada
        if ($request->hasFile('foto_laki')) {
            // Hapus foto lama
            if ($seragam->foto_laki) {
                Storage::disk('public')->delete($seragam->foto_laki);
            }
            $validated['foto_laki'] = $request->file('foto_laki')->store('seragam', 'public');
        } else {
            unset($validated['foto_laki']);
        }

        // Upload foto perempuan baru jika ada
        if ($request->hasFile('foto_perempuan')) {
            // Hapus foto lama
            if ($seragam->foto_perempuan) {
                Storage::disk('public')->delete($seragam->foto_perempuan);
            }
            $validated['foto_perempuan'] = $request->file('foto_perempuan')->store('seragam', 'public');
        } else {
            unset($validated['foto_perempuan']);
        }

        $validated['aktif'] = $request->has('aktif');
        $validated['urutan'] = $validated['urutan'] ?? 0;

        $seragam->update($validated);

        // Clear cache
        Cache::forget('seragam_aktif');

        return redirect()->route('admin.seragam.index')
            ->with('success', 'Seragam berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Seragam $seragam)
    {
        // Hapus foto laki-laki
        if ($seragam->foto_laki) {
            Storage::disk('public')->delete($seragam->foto_laki);
        }

        // Hapus foto perempuan
        if ($seragam->foto_perempuan) {
            Storage::disk('public')->delete($seragam->foto_perempuan);
        }

        $seragam->delete();

        // Clear cache
        Cache::forget('seragam_aktif');

        return redirect()->route('admin.seragam.index')
            ->with('success', 'Seragam berhasil dihapus.');
    }
}
