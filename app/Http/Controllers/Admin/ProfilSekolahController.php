<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProfilSekolah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfilSekolahController extends Controller
{
    /**
     * Show the form for editing the school profile (legacy - redirects to sejarah)
     */
    public function edit()
    {
        return redirect()->route('admin.profil-sekolah.sejarah');
    }

    /**
     * Show Sejarah edit page
     */
    public function editSejarah()
    {
        $profil = ProfilSekolah::getInstance();
        return view('admin.profil-sejarah', compact('profil'));
    }

    /**
     * Update Sejarah
     */
    public function updateSejarah(Request $request)
    {
        $request->validate([
            'sejarah_judul' => 'required|string|max:255',
            'sejarah_konten' => 'required|string',
            'sejarah_gambar' => 'nullable|array',
            'sejarah_gambar.*' => 'image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $profil = ProfilSekolah::getInstance();

        $data = [
            'sejarah_judul' => $request->sejarah_judul,
            'sejarah_konten' => $request->sejarah_konten,
        ];

        if ($request->hasFile('sejarah_gambar')) {
            $currentImages = $profil->sejarah_gambar ?? [];
            if (!is_array($currentImages)) $currentImages = []; // handling legacy string data if any remains
            
            foreach ($request->file('sejarah_gambar') as $file) {
                 $path = $file->store('profil', 'public');
                 $currentImages[] = $path;
            }
            $data['sejarah_gambar'] = $currentImages;
        }

        // Handle image deletion if checkboxes are checked
        if ($request->has('hapus_gambar')) {
             $currentImages = $profil->sejarah_gambar ?? [];
             $indexesToDelete = $request->hapus_gambar;
             $newImages = [];
             
             foreach ($currentImages as $index => $path) {
                 // Fix: bandingkan sebagai string untuk menghindari mismatch tipe data
                 if (in_array((string)$index, $indexesToDelete) || in_array($index, $indexesToDelete)) {
                     if (!str_starts_with($path, 'http')) {
                         Storage::disk('public')->delete($path);
                     }
                 } else {
                     $newImages[] = $path;
                 }
             }
             $data['sejarah_gambar'] = array_values($newImages);
        }

        $profil->update($data);

        return redirect()->route('admin.profil-sekolah.sejarah')->with('success', 'Sejarah sekolah berhasil diperbarui.');
    }

    /**
     * Show Visi & Misi edit page
     */
    public function editVisiMisi()
    {
        $profil = ProfilSekolah::getInstance();
        return view('admin.profil-visi-misi', compact('profil'));
    }

    /**
     * Update Visi & Misi
     */
    public function updateVisiMisi(Request $request)
    {
        $request->validate([
            'visi' => 'required|string',
            'misi' => 'required|array|min:1',
            'misi.*' => 'required|string',
        ]);

        $profil = ProfilSekolah::getInstance();

        $profil->update([
            'visi' => $request->visi,
            'misi' => array_values(array_filter($request->misi)),
        ]);

        return redirect()->route('admin.profil-sekolah.visi-misi')->with('success', 'Visi & Misi berhasil diperbarui.');
    }

    /**
     * Show Struktur Organisasi edit page
     */
    public function editStruktur()
    {
        $profil = ProfilSekolah::getInstance();
        return view('admin.profil-struktur', compact('profil'));
    }

    /**
     * Update Struktur Organisasi
     */
    public function updateStruktur(Request $request)
    {
        $request->validate([
            'struktur_organisasi_gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $profil = ProfilSekolah::getInstance();

        if ($request->hasFile('struktur_organisasi_gambar')) {
            if ($profil->struktur_organisasi_gambar && !str_starts_with($profil->struktur_organisasi_gambar, 'http')) {
                Storage::disk('public')->delete($profil->struktur_organisasi_gambar);
            }
            $profil->update([
                'struktur_organisasi_gambar' => $request->file('struktur_organisasi_gambar')->store('profil', 'public')
            ]);
        }

        return redirect()->route('admin.profil-sekolah.struktur')->with('success', 'Struktur organisasi berhasil diperbarui.');
    }

    /**
     * Legacy update method (keeps old route working)
     */
    public function update(Request $request)
    {
        $request->validate([
            'sejarah_judul' => 'required|string|max:255',
            'sejarah_konten' => 'required|string',
            'sejarah_gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'visi' => 'required|string',
            'misi' => 'required|array|min:1',
            'misi.*' => 'required|string',
            'struktur_organisasi_gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $profil = ProfilSekolah::getInstance();

        $data = [
            'sejarah_judul' => $request->sejarah_judul,
            'sejarah_konten' => $request->sejarah_konten,
            'visi' => $request->visi,
            'misi' => array_values(array_filter($request->misi)),
        ];

        if ($request->hasFile('sejarah_gambar')) {
            if ($profil->sejarah_gambar && !str_starts_with($profil->sejarah_gambar, 'http')) {
                Storage::disk('public')->delete($profil->sejarah_gambar);
            }
            $data['sejarah_gambar'] = $request->file('sejarah_gambar')->store('profil', 'public');
        }

        if ($request->hasFile('struktur_organisasi_gambar')) {
            if ($profil->struktur_organisasi_gambar && !str_starts_with($profil->struktur_organisasi_gambar, 'http')) {
                Storage::disk('public')->delete($profil->struktur_organisasi_gambar);
            }
            $data['struktur_organisasi_gambar'] = $request->file('struktur_organisasi_gambar')->store('profil', 'public');
        }

        $profil->update($data);

        return redirect()->route('admin.profil-sekolah.sejarah')->with('success', 'Profil sekolah berhasil diperbarui.');
    }

    /**
     * Delete the struktur organisasi image
     */
    public function deleteStruktur()
    {
        $profil = ProfilSekolah::getInstance();

        if ($profil->struktur_organisasi_gambar && !str_starts_with($profil->struktur_organisasi_gambar, 'http')) {
            Storage::disk('public')->delete($profil->struktur_organisasi_gambar);
        }

        $profil->update(['struktur_organisasi_gambar' => null]);

        return redirect()->route('admin.profil-sekolah.struktur')->with('success', 'Gambar struktur organisasi berhasil dihapus.');
    }
}

