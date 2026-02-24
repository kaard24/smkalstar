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
            'foto_laki' => 'nullable|array',
            'foto_laki.*' => 'image|mimes:jpg,jpeg,png,webp|max:2048',
            'foto_perempuan' => 'nullable|array',
            'foto_perempuan.*' => 'image|mimes:jpg,jpeg,png,webp|max:2048',
            'keterangan_foto_laki' => 'nullable|array',
            'keterangan_foto_laki.*' => 'nullable|string|max:255',
            'keterangan_foto_perempuan' => 'nullable|array',
            'keterangan_foto_perempuan.*' => 'nullable|string|max:255',
            'keterangan' => 'nullable|string|max:500',
            'warna_tema' => 'required|string|in:' . implode(',', array_keys($this->warnaList)),
            'urutan' => 'nullable|integer|min:0',
            'aktif' => 'boolean',
        ], [
            'hari.unique' => 'Seragam untuk hari ini sudah ada.',
            'foto_laki.*.image' => 'File harus berupa gambar.',
            'foto_perempuan.*.image' => 'File harus berupa gambar.',
            'foto_laki.*.max' => 'Ukuran foto maksimal 2MB.',
            'foto_perempuan.*.max' => 'Ukuran foto maksimal 2MB.',
        ]);

        // Upload multiple foto laki-laki
        $fotoLaki = [];
        $keteranganLaki = [];
        if ($request->hasFile('foto_laki')) {
            foreach ($request->file('foto_laki') as $index => $file) {
                $fotoLaki[] = $file->store('seragam', 'public');
                $keteranganLaki[] = $request->input("keterangan_foto_laki.$index") ?? '';
            }
        }
        $validated['foto_laki'] = $fotoLaki;
        $validated['keterangan_foto_laki'] = $keteranganLaki;

        // Upload multiple foto perempuan
        $fotoPerempuan = [];
        $keteranganPerempuan = [];
        if ($request->hasFile('foto_perempuan')) {
            foreach ($request->file('foto_perempuan') as $index => $file) {
                $fotoPerempuan[] = $file->store('seragam', 'public');
                $keteranganPerempuan[] = $request->input("keterangan_foto_perempuan.$index") ?? '';
            }
        }
        $validated['foto_perempuan'] = $fotoPerempuan;
        $validated['keterangan_foto_perempuan'] = $keteranganPerempuan;

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
            'foto_laki' => 'nullable|array',
            'foto_laki.*' => 'image|mimes:jpg,jpeg,png,webp|max:2048',
            'foto_perempuan' => 'nullable|array',
            'foto_perempuan.*' => 'image|mimes:jpg,jpeg,png,webp|max:2048',
            'keterangan_foto_laki' => 'nullable|array',
            'keterangan_foto_laki.*' => 'nullable|string|max:255',
            'keterangan_foto_perempuan' => 'nullable|array',
            'keterangan_foto_perempuan.*' => 'nullable|string|max:255',
            'keterangan' => 'nullable|string|max:500',
            'warna_tema' => 'required|string|in:' . implode(',', array_keys($this->warnaList)),
            'urutan' => 'nullable|integer|min:0',
            'aktif' => 'boolean',
        ], [
            'hari.unique' => 'Seragam untuk hari ini sudah ada.',
            'foto_laki.*.image' => 'File harus berupa gambar.',
            'foto_perempuan.*.image' => 'File harus berupa gambar.',
            'foto_laki.*.max' => 'Ukuran foto maksimal 2MB.',
            'foto_perempuan.*.max' => 'Ukuran foto maksimal 2MB.',
        ]);

        // Get existing photos and captions
        $fotoLaki = $seragam->foto_laki ?? [];
        $fotoPerempuan = $seragam->foto_perempuan ?? [];
        $keteranganLaki = $request->input('keterangan_foto_laki', $seragam->keterangan_foto_laki ?? []);
        $keteranganPerempuan = $request->input('keterangan_foto_perempuan', $seragam->keterangan_foto_perempuan ?? []);

        // Handle deleted photos laki-laki
        if ($request->has('hapus_foto_laki')) {
            foreach ($request->hapus_foto_laki as $index => $foto) {
                if (in_array($foto, $fotoLaki)) {
                    Storage::disk('public')->delete($foto);
                    $fotoIndex = array_search($foto, $fotoLaki);
                    unset($fotoLaki[$fotoIndex]);
                    unset($keteranganLaki[$fotoIndex]);
                }
            }
            $fotoLaki = array_values($fotoLaki);
            $keteranganLaki = array_values($keteranganLaki);
        }

        // Handle deleted photos perempuan
        if ($request->has('hapus_foto_perempuan')) {
            foreach ($request->hapus_foto_perempuan as $index => $foto) {
                if (in_array($foto, $fotoPerempuan)) {
                    Storage::disk('public')->delete($foto);
                    $fotoIndex = array_search($foto, $fotoPerempuan);
                    unset($fotoPerempuan[$fotoIndex]);
                    unset($keteranganPerempuan[$fotoIndex]);
                }
            }
            $fotoPerempuan = array_values($fotoPerempuan);
            $keteranganPerempuan = array_values($keteranganPerempuan);
        }

        // Upload foto laki-laki baru jika ada
        if ($request->hasFile('foto_laki')) {
            foreach ($request->file('foto_laki') as $index => $file) {
                $fotoLaki[] = $file->store('seragam', 'public');
                $keteranganLaki[] = $request->input("keterangan_foto_laki_baru.$index") ?? '';
            }
        }

        // Upload foto perempuan baru jika ada
        if ($request->hasFile('foto_perempuan')) {
            foreach ($request->file('foto_perempuan') as $index => $file) {
                $fotoPerempuan[] = $file->store('seragam', 'public');
                $keteranganPerempuan[] = $request->input("keterangan_foto_perempuan_baru.$index") ?? '';
            }
        }

        // Update captions for existing photos
        if ($request->has('keterangan_foto_laki')) {
            foreach ($request->keterangan_foto_laki as $index => $caption) {
                if (isset($keteranganLaki[$index])) {
                    $keteranganLaki[$index] = $caption;
                }
            }
        }

        if ($request->has('keterangan_foto_perempuan')) {
            foreach ($request->keterangan_foto_perempuan as $index => $caption) {
                if (isset($keteranganPerempuan[$index])) {
                    $keteranganPerempuan[$index] = $caption;
                }
            }
        }

        $validated['foto_laki'] = array_values($fotoLaki);
        $validated['foto_perempuan'] = array_values($fotoPerempuan);
        $validated['keterangan_foto_laki'] = array_values($keteranganLaki);
        $validated['keterangan_foto_perempuan'] = array_values($keteranganPerempuan);
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
        // Hapus semua foto laki-laki
        if ($seragam->foto_laki) {
            foreach ($seragam->foto_laki as $foto) {
                Storage::disk('public')->delete($foto);
            }
        }

        // Hapus semua foto perempuan
        if ($seragam->foto_perempuan) {
            foreach ($seragam->foto_perempuan as $foto) {
                Storage::disk('public')->delete($foto);
            }
        }

        $seragam->delete();

        // Clear cache
        Cache::forget('seragam_aktif');

        return redirect()->route('admin.seragam.index')
            ->with('success', 'Seragam berhasil dihapus.');
    }
}
