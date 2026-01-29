<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CalonSiswa;
use App\Models\OrangTua;
use App\Models\Pendaftaran;
use App\Models\Tes;
use App\Models\Jurusan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PpdbController extends Controller
{

    /**
     * Show the complete registration form
     */
    public function create()
    {
        $siswa = Auth::guard('ppdb')->user();
        
        // If already fully registered, redirect to dashboard
        if ($siswa->isRegistrationComplete() && $siswa->pendaftaran?->jurusan_id) {
            return redirect()->route('ppdb.dashboard')->with('info', 'Data Anda sudah lengkap.');
        }

        $siswa->load(['orangTua', 'pendaftaran']);
        $jurusan = Jurusan::all();
        
        return view('ppdb.lengkapi-data', compact('jurusan', 'siswa'));
    }

    /**
     * Store the complete registration data
     */
    public function store(Request $request)
    {
        $siswa = Auth::guard('ppdb')->user();

        $request->validate([
            'nama' => 'required|string|max:100',
            'jk' => 'required|in:L,P',
            'tgl_lahir' => 'required|date',
            'alamat' => 'required|string',
            'asal_sekolah' => 'required|string|max:100',
            'nama_ayah' => 'required|string|max:100',
            'nama_ibu' => 'required|string|max:100',
            'no_wa_ortu' => 'required|string',
            'pekerjaan' => 'required|string|max:100',
            'jurusan_id' => 'required|exists:jurusan,id',
            'gelombang' => 'required|in:Gelombang 1,Gelombang 2',
        ], [
            'nama.required' => 'Nama lengkap wajib diisi.',
            'jk.required' => 'Jenis kelamin wajib dipilih.',
            'tgl_lahir.required' => 'Tanggal lahir wajib diisi.',
            'alamat.required' => 'Alamat wajib diisi.',
            'asal_sekolah.required' => 'Asal sekolah wajib diisi.',
            'nama_ayah.required' => 'Nama ayah wajib diisi.',
            'nama_ibu.required' => 'Nama ibu wajib diisi.',
            'no_wa_ortu.required' => 'Nomor WhatsApp orang tua wajib diisi.',
            'pekerjaan.required' => 'Pekerjaan orang tua wajib diisi.',
            'jurusan_id.required' => 'Jurusan wajib dipilih.',
            'gelombang.required' => 'Gelombang wajib dipilih.',
        ]);

        try {
            DB::transaction(function () use ($request, $siswa) {
                // Update Calon Siswa data
                $siswa->update([
                    'nama' => $request->nama,
                    'jk' => $request->jk,
                    'tgl_lahir' => $request->tgl_lahir,
                    'alamat' => $request->alamat,
                    'asal_sekolah' => $request->asal_sekolah,
                ]);

                // Create or update Orang Tua
                OrangTua::updateOrCreate(
                    ['calon_siswa_id' => $siswa->id],
                    [
                        'nama_ayah' => $request->nama_ayah,
                        'nama_ibu' => $request->nama_ibu,
                        'no_wa_ortu' => $request->no_wa_ortu,
                        'pekerjaan' => $request->pekerjaan,
                    ]
                );

                // Update or create Pendaftaran
                $pendaftaran = Pendaftaran::updateOrCreate(
                    ['calon_siswa_id' => $siswa->id],
                    [
                        'jurusan_id' => $request->jurusan_id,
                        'gelombang' => $request->gelombang,
                        'status_pendaftaran' => 'Terdaftar',
                    ]
                );

                // Create Tes record if not exists
                Tes::firstOrCreate(
                    ['pendaftaran_id' => $pendaftaran->id],
                    ['status_kelulusan' => 'Pending']
                );
            });

            return redirect()->route('ppdb.dashboard')->with('success', 'Data berhasil disimpan! Pendaftaran Anda sudah lengkap.');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage())->withInput();
        }
    }
}
