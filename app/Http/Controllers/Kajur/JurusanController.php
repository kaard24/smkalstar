<?php

namespace App\Http\Controllers\Kajur;

use App\Http\Controllers\Controller;
use App\Models\Jurusan;
use App\Models\JurusanInfo;
use App\Models\JurusanDetailItem;
use App\Models\JurusanKegiatan;
use App\Models\JurusanKegiatanGambar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class JurusanController extends Controller
{
    /**
     * Show the form for editing the jurusan
     */
    public function edit()
    {
        $kajur = Auth::guard('kajur')->user();
        $jurusan = $kajur->jurusan()->with(['infoProgram', 'kompetensiItems', 'mapelItems', 'karirItems', 'kegiatan.gambar'])->first();
        
        return view('kajur.jurusan.edit', compact('jurusan'));
    }

    /**
     * Update the jurusan
     */
    public function update(Request $request)
    {
        $kajur = Auth::guard('kajur')->user();
        $jurusan = $kajur->jurusan;

        $validated = $request->validate([
            'kode' => 'required|string|max:10|unique:jurusan,kode,' . $jurusan->id,
            'nama' => 'required|string|max:255',
            'kategori' => 'nullable|string|max:255',
            'deskripsi' => 'nullable|string',
            'deskripsi_lengkap' => 'nullable|string',
            'peluang_karir' => 'nullable|string',
            'deskripsi_peluang_karir' => 'nullable|string',
            'kompetensi' => 'nullable|string',
            'deskripsi_kompetensi' => 'nullable|string',
            'mata_pelajaran' => 'nullable|string',
            'deskripsi_mata_pelajaran' => 'nullable|string',
            'urutan' => 'nullable|integer|min:0',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

        // Handle logo upload
        if ($request->hasFile('logo')) {
            if ($jurusan->logo && Storage::disk('public')->exists($jurusan->logo)) {
                Storage::disk('public')->delete($jurusan->logo);
            }
            $logoPath = $request->file('logo')->store('jurusan/logo', 'public');
            $validated['logo'] = $logoPath;
        }

        // Handle gambar upload
        if ($request->hasFile('gambar')) {
            if ($jurusan->gambar && Storage::disk('public')->exists($jurusan->gambar)) {
                Storage::disk('public')->delete($jurusan->gambar);
            }
            $gambarPath = $request->file('gambar')->store('jurusan/gambar', 'public');
            $validated['gambar'] = $gambarPath;
        }

        // Process array fields
        if (!empty($validated['peluang_karir'])) {
            $validated['peluang_karir'] = array_map('trim', explode("\n", $validated['peluang_karir']));
        } else {
            $validated['peluang_karir'] = null;
        }
        if (!empty($validated['kompetensi'])) {
            $validated['kompetensi'] = array_map('trim', explode("\n", $validated['kompetensi']));
        } else {
            $validated['kompetensi'] = null;
        }
        if (!empty($validated['mata_pelajaran'])) {
            $validated['mata_pelajaran'] = array_map('trim', explode("\n", $validated['mata_pelajaran']));
        } else {
            $validated['mata_pelajaran'] = null;
        }

        $validated['aktif'] = true;
        $validated['urutan'] = $validated['urutan'] ?? $jurusan->urutan;

        $jurusan->update($validated);

        // Handle info program dinamis
        $this->syncInfoProgram($jurusan, $request);

        // Handle detail items (kompetensi, mapel, karir)
        $this->syncDetailItems($jurusan, $request);

        // Handle kegiatan
        $this->syncKegiatan($jurusan, $request);

        Cache::forget('jurusan_aktif');

        return redirect()->route('kajur.dashboard')
            ->with('success', 'Program keahlian berhasil diperbarui.');
    }

    /**
     * Sync info program dinamis
     */
    private function syncInfoProgram(Jurusan $jurusan, Request $request)
    {
        $jurusan->infoProgram()->delete();

        if ($request->has('info_label') && $request->has('info_value')) {
            $labels = $request->input('info_label', []);
            $values = $request->input('info_value', []);

            foreach ($labels as $index => $label) {
                if (!empty($label) && !empty($values[$index])) {
                    JurusanInfo::create([
                        'jurusan_id' => $jurusan->id,
                        'label' => $label,
                        'value' => $values[$index],
                        'urutan' => $index,
                    ]);
                }
            }
        }
    }

    /**
     * Sync detail items (kompetensi, mapel, karir)
     */
    private function syncDetailItems(Jurusan $jurusan, Request $request)
    {
        $jurusan->detailItems()->delete();

        // Simpan kompetensi items
        if ($request->has('kompetensi_judul')) {
            $juduls = $request->input('kompetensi_judul', []);
            $deskripsis = $request->input('kompetensi_deskripsi', []);
            
            foreach ($juduls as $index => $judul) {
                if (!empty($judul)) {
                    JurusanDetailItem::create([
                        'jurusan_id' => $jurusan->id,
                        'tipe' => 'kompetensi',
                        'judul' => $judul,
                        'deskripsi' => $deskripsis[$index] ?? null,
                        'urutan' => $index,
                    ]);
                }
            }
        }

        // Simpan mapel items
        if ($request->has('mapel_judul')) {
            $juduls = $request->input('mapel_judul', []);
            $deskripsis = $request->input('mapel_deskripsi', []);
            
            foreach ($juduls as $index => $judul) {
                if (!empty($judul)) {
                    JurusanDetailItem::create([
                        'jurusan_id' => $jurusan->id,
                        'tipe' => 'mapel',
                        'judul' => $judul,
                        'deskripsi' => $deskripsis[$index] ?? null,
                        'urutan' => $index,
                    ]);
                }
            }
        }

        // Simpan karir items
        if ($request->has('karir_judul')) {
            $juduls = $request->input('karir_judul', []);
            $deskripsis = $request->input('karir_deskripsi', []);
            
            foreach ($juduls as $index => $judul) {
                if (!empty($judul)) {
                    JurusanDetailItem::create([
                        'jurusan_id' => $jurusan->id,
                        'tipe' => 'karir',
                        'judul' => $judul,
                        'deskripsi' => $deskripsis[$index] ?? null,
                        'urutan' => $index,
                    ]);
                }
            }
        }
    }

    /**
     * Sync kegiatan jurusan
     */
    private function syncKegiatan(Jurusan $jurusan, Request $request)
    {
        $existingIds = $request->input('kegiatan_id', []);
        $juduls = $request->input('kegiatan_judul', []);
        $deskripsis = $request->input('kegiatan_deskripsi', []);
        
        // Delete kegiatan yang tidak ada di form
        $jurusan->kegiatan()->whereNotIn('id', $existingIds)->each(function ($kegiatan) {
            foreach ($kegiatan->gambar as $gambar) {
                if (Storage::disk('public')->exists($gambar->gambar)) {
                    Storage::disk('public')->delete($gambar->gambar);
                }
            }
            $kegiatan->delete();
        });

        // Process each kegiatan
        foreach ($juduls as $index => $judul) {
            if (empty($judul)) continue;

            $kegiatanId = $existingIds[$index] ?? null;
            $deskripsi = $deskripsis[$index] ?? null;

            if ($kegiatanId && $kegiatanId !== 'new') {
                $kegiatan = JurusanKegiatan::find($kegiatanId);
                if ($kegiatan) {
                    $kegiatan->update([
                        'judul' => $judul,
                        'deskripsi' => $deskripsi,
                        'urutan' => $index,
                    ]);
                }
            } else {
                $kegiatan = JurusanKegiatan::create([
                    'jurusan_id' => $jurusan->id,
                    'judul' => $judul,
                    'deskripsi' => $deskripsi,
                    'urutan' => $index,
                ]);
            }

            // Handle gambar upload
            if ($request->hasFile("kegiatan_gambar_{$index}")) {
                foreach ($request->file("kegiatan_gambar_{$index}") as $fileIndex => $file) {
                    $gambarPath = $file->store('jurusan/kegiatan', 'public');
                    JurusanKegiatanGambar::create([
                        'kegiatan_id' => $kegiatan->id,
                        'gambar' => $gambarPath,
                        'urutan' => $fileIndex,
                    ]);
                }
            }
        }
    }

    /**
     * Delete a kegiatan gambar
     */
    public function deleteKegiatanGambar(JurusanKegiatanGambar $gambar)
    {
        if (Storage::disk('public')->exists($gambar->gambar)) {
            Storage::disk('public')->delete($gambar->gambar);
        }
        $gambar->delete();
        
        return response()->json(['success' => true]);
    }
}
