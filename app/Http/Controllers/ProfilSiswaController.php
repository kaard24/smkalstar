<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use App\Models\OrangTua;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class ProfilSiswaController extends Controller
{

    public function index()
    {
        $calonSiswa = Auth::guard('ppdb')->user();
        
        if (!$calonSiswa->isRegistrationComplete()) {
            return redirect()->route('ppdb.lengkapi-data')->with('info', 'Silakan lengkapi data pendaftaran Anda.');
        }

        // Load relationships
        $calonSiswa->load(['orangTua', 'pendaftaran.jurusan', 'pendaftaran.tes']);

        return view('ppdb.profil', compact('calonSiswa'));
    }

    public function edit()
    {
        $calonSiswa = Auth::guard('ppdb')->user();
        $calonSiswa->load(['orangTua', 'pendaftaran.jurusan']);
        $jurusan = Jurusan::all();
        
        // Tentukan jenis data (orang_tua atau wali) berdasarkan data yang sudah ada
        $jenis = $calonSiswa->orangTua?->jenis ?? 'orang_tua';

        return view('ppdb.edit-profil', compact('calonSiswa', 'jurusan', 'jenis'));
    }

    public function update(Request $request)
    {
        $calonSiswa = Auth::guard('ppdb')->user();
        
        // Load orangTua relationship
        $calonSiswa->load('orangTua');
        
        // Get jenis from existing data or request
        $jenis = $calonSiswa->orangTua?->jenis ?? $request->jenis ?? 'orang_tua';

        // Cek apakah user ingin menambahkan data orang tua (opsional)
        // Hanya switch ke orang_tua jika user benar-benar mengisi data orang tua
        $switchToOrtu = $request->has('switch_to_ortu') && $request->switch_to_ortu == '1';
        $isDataOrtuFilled = !empty($request->nama_ayah) || !empty($request->nama_ibu);
        
        // Jika switch_to_ortu aktif dan data ortu diisi, baru ubah jenis ke orang_tua
        if ($switchToOrtu && $isDataOrtuFilled) {
            $jenis = 'orang_tua';
        }

        // Base validation rules
        $rules = [
            'nama' => 'required|string|max:100',
            'nik' => 'required|string|size:16',
            'no_kk' => 'required|string|size:16',
            'jk' => 'required|in:L,P',
            'tgl_lahir' => 'required|date',
            'tempat_lahir' => 'required|string|max:100',
            'alamat' => 'required|string',
            'alamat_sekolah' => 'required|string',
            'no_wa' => 'required|string|max:15',
            'asal_sekolah' => 'required|string|max:100',
        ];

        // Validation rules based on jenis
        if ($jenis === 'orang_tua') {
            $rules['nama_ayah'] = 'required|string|max:100';
            $rules['nama_ibu'] = 'required|string|max:100';
            $rules['no_wa_ortu'] = 'required|string|max:15';
            $rules['pekerjaan_ayah'] = 'required|string|max:100';
            $rules['pekerjaan_ibu'] = 'required|string|max:100';
        } else {
            // Wali
            $rules['nama_wali'] = 'required|string|max:100';
            $rules['pekerjaan_wali'] = 'required|string|max:100';
            $rules['no_hp_wali'] = 'required|string|max:15';
            $rules['hubungan_wali'] = 'required|string|max:50';
        }

        $validated = $request->validate($rules);

        try {
            DB::transaction(function () use ($request, $calonSiswa, $jenis, $switchToOrtu, $isDataOrtuFilled) {
                // Update CalonSiswa
                $calonSiswa->update([
                    'nama' => $request->nama,
                    'nik' => $request->nik,
                    'no_kk' => $request->no_kk,
                    'jk' => $request->jk,
                    'tgl_lahir' => $request->tgl_lahir,
                    'tempat_lahir' => $request->tempat_lahir,
                    'alamat' => $request->alamat,
                    'alamat_sekolah' => $request->alamat_sekolah,
                    'no_wa' => $request->no_wa,
                    'asal_sekolah' => $request->asal_sekolah,
                ]);

                // Update OrangTua/Wali
                if ($jenis === 'orang_tua') {
                    $orangTuaData = [
                        'jenis' => 'orang_tua',
                        'nama_ayah' => $request->nama_ayah,
                        'nama_ibu' => $request->nama_ibu,
                        'no_wa_ortu' => $request->no_wa_ortu,
                        'pekerjaan_ayah' => $request->pekerjaan_ayah,
                        'pekerjaan_ibu' => $request->pekerjaan_ibu,
                        // Kosongkan field wali
                        'nama_wali' => null,
                        'pekerjaan_wali' => null,
                        'no_hp_wali' => null,
                        'hubungan_wali' => null,
                    ];
                } else {
                    // Wali
                    $orangTuaData = [
                        'jenis' => 'wali',
                        'nama_wali' => $request->nama_wali,
                        'pekerjaan_wali' => $request->pekerjaan_wali,
                        'no_hp_wali' => $request->no_hp_wali,
                        'hubungan_wali' => $request->hubungan_wali,
                        // Kosongkan field orang tua
                        'nama_ayah' => null,
                        'nik_ayah' => null,
                        'status_ayah' => null,
                        'pekerjaan_ayah' => null,
                        'nama_ibu' => null,
                        'nik_ibu' => null,
                        'status_ibu' => null,
                        'pekerjaan_ibu' => null,
                        'no_wa_ortu' => null,
                        'pekerjaan' => null,
                    ];
                }

                if ($calonSiswa->orangTua) {
                    $calonSiswa->orangTua->update($orangTuaData);
                } else {
                    $orangTuaData['calon_siswa_id'] = $calonSiswa->id;
                    OrangTua::create($orangTuaData);
                }
            });

            // Refresh data dari database
            $calonSiswa->refresh();

            // Pesan sukses berbeda jika switch dari wali ke orang tua
            // Hanya tampilkan pesan switch jika benar-benar switch dan data diisi
            $actuallySwitched = ($switchToOrtu && $isDataOrtuFilled && $calonSiswa->orangTua?->jenis === 'orang_tua');
            $successMessage = $actuallySwitched 
                ? 'Data berhasil diperbarui! Data orang tua telah ditambahkan.' 
                : 'Biodata berhasil diperbarui.';

            return redirect()->route('ppdb.profil')->with('success', $successMessage);

        } catch (\Exception $e) {
            Log::error('Error update profil: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Upload foto profil
     */
    public function uploadFoto(Request $request)
    {
        $request->validate([
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ], [
            'foto.required' => 'Pilih foto terlebih dahulu',
            'foto.image' => 'File harus berupa gambar',
            'foto.mimes' => 'Format foto harus jpeg, png, atau jpg',
            'foto.max' => 'Ukuran foto maksimal 2MB',
        ]);

        $calonSiswa = Auth::guard('ppdb')->user();

        // Hapus foto lama jika ada
        if ($calonSiswa->foto) {
            Storage::disk('public')->delete('foto/' . $calonSiswa->foto);
        }

        // Upload foto baru
        $file = $request->file('foto');
        $filename = 'siswa_' . $calonSiswa->id . '_' . time() . '.' . $file->getClientOriginalExtension();
        $file->storeAs('foto', $filename, 'public');

        // Update database
        $calonSiswa->update(['foto' => $filename]);

        return back()->with('success', 'Foto profil berhasil diperbarui');
    }

    /**
     * Hapus foto profil
     */
    public function hapusFoto()
    {
        $calonSiswa = Auth::guard('ppdb')->user();

        if ($calonSiswa->foto) {
            Storage::disk('public')->delete('foto/' . $calonSiswa->foto);
            $calonSiswa->update(['foto' => null]);
        }

        return back()->with('success', 'Foto profil berhasil dihapus');
    }
}
