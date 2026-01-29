<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use App\Models\OrangTua;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        return view('ppdb.edit-profil', compact('calonSiswa', 'jurusan'));
    }

    public function update(Request $request)
    {
        $calonSiswa = Auth::guard('ppdb')->user();

        $request->validate([
            'nama' => 'required|string|max:100',
            'alamat' => 'required|string',
            'no_wa' => 'required|string|max:15',
            'asal_sekolah' => 'required|string|max:100',
            'nama_ayah' => 'required|string|max:100',
            'nama_ibu' => 'required|string|max:100',
            'no_wa_ortu' => 'required|string|max:15',
            'pekerjaan' => 'required|string|max:100',
        ]);

        // Update CalonSiswa
        $calonSiswa->update([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'no_wa' => $request->no_wa,
            'asal_sekolah' => $request->asal_sekolah,
        ]);

        // Update OrangTua
        if ($calonSiswa->orangTua) {
            $calonSiswa->orangTua->update([
                'nama_ayah' => $request->nama_ayah,
                'nama_ibu' => $request->nama_ibu,
                'no_wa_ortu' => $request->no_wa_ortu,
                'pekerjaan' => $request->pekerjaan,
            ]);
        } else {
            OrangTua::create([
                'calon_siswa_id' => $calonSiswa->id,
                'nama_ayah' => $request->nama_ayah,
                'nama_ibu' => $request->nama_ibu,
                'no_wa_ortu' => $request->no_wa_ortu,
                'pekerjaan' => $request->pekerjaan,
            ]);
        }

        return redirect()->route('ppdb.dashboard')->with('success', 'Biodata berhasil diperbarui.');
    }
}
