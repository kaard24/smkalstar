<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CalonSiswa;
use App\Models\OrangTua;
use App\Models\Pendaftaran;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class SpmbController extends Controller
{

    /**
     * Show the complete registration form
     */
    public function create()
    {
        $siswa = Auth::guard('spmb')->user();
        
        // If already fully registered, redirect to dashboard
        if ($siswa->isRegistrationComplete() && $siswa->pendaftaran?->jurusan_id) {
            return redirect()->route('spmb.dashboard')->with('info', 'Data Anda sudah lengkap.');
        }

        $siswa->load(['orangTua', 'pendaftaran']);
        
        return view('spmb.lengkapi-data', compact('siswa'));
    }

    /**
     * Store the complete registration data
     */
    public function store(Request $request)
    {
        $siswa = Auth::guard('spmb')->user();

        $rules = [
            'nik' => 'required|string|size:16',
            'no_kk' => 'required|string|size:16',
            'jk' => 'required|in:L,P',
            'alamat' => 'required|string',
            'alamat_sekolah' => 'required|string',
            'jenis' => 'required|in:orang_tua,wali',
        ];

        $messages = [
            'nik.required' => 'NIK wajib diisi.',
            'nik.size' => 'NIK harus 16 digit.',
            'no_kk.required' => 'Nomor KK wajib diisi.',
            'no_kk.size' => 'Nomor KK harus 16 digit.',
            'jk.required' => 'Jenis kelamin wajib dipilih.',
            'alamat.required' => 'Alamat wajib diisi.',
            'alamat_sekolah.required' => 'Alamat sekolah wajib diisi.',
            'jenis.required' => 'Jenis orang tua/wali wajib dipilih.',
        ];

        // Validasi khusus berdasarkan jenis
        if ($request->jenis === 'orang_tua') {
            $rules['nama_ayah'] = 'required|string|max:100';
            $rules['nik_ayah'] = 'required|string|size:16';
            $rules['status_ayah'] = 'required|in:hidup,meninggal';
            $rules['nama_ibu'] = 'required|string|max:100';
            $rules['nik_ibu'] = 'required|string|size:16';
            $rules['status_ibu'] = 'required|in:hidup,meninggal';
            $rules['no_wa_ortu'] = 'required|string';
            $rules['pekerjaan_ayah'] = 'required|string|max:100';
            $rules['pekerjaan_ibu'] = 'required|string|max:100';

            $messages['nama_ayah.required'] = 'Nama ayah wajib diisi.';
            $messages['nik_ayah.required'] = 'NIK ayah wajib diisi.';
            $messages['nik_ayah.size'] = 'NIK ayah harus 16 digit.';
            $messages['status_ayah.required'] = 'Status ayah wajib dipilih.';
            $messages['nama_ibu.required'] = 'Nama ibu wajib diisi.';
            $messages['nik_ibu.required'] = 'NIK ibu wajib diisi.';
            $messages['nik_ibu.size'] = 'NIK ibu harus 16 digit.';
            $messages['status_ibu.required'] = 'Status ibu wajib dipilih.';
            $messages['no_wa_ortu.required'] = 'Nomor WhatsApp orang tua wajib diisi.';
            $messages['pekerjaan_ayah.required'] = 'Pekerjaan ayah wajib diisi.';
            $messages['pekerjaan_ibu.required'] = 'Pekerjaan ibu wajib diisi.';
        } else {
            $rules['nama_wali'] = 'required|string|max:100';
            $rules['pekerjaan_wali'] = 'required|string|max:100';
            $rules['no_hp_wali'] = 'required|string';
            $rules['hubungan_wali'] = 'required|string|max:50';

            $messages['nama_wali.required'] = 'Nama wali wajib diisi.';
            $messages['pekerjaan_wali.required'] = 'Pekerjaan wali wajib diisi.';
            $messages['no_hp_wali.required'] = 'Nomor HP wali wajib diisi.';
            $messages['hubungan_wali.required'] = 'Hubungan wali wajib diisi.';
        }

        $request->validate($rules, $messages);

        try {
            DB::transaction(function () use ($request, $siswa) {
                // Update Calon Siswa data
                $siswa->update([
                    'nik' => $request->nik,
                    'no_kk' => $request->no_kk,
                    'jk' => $request->jk,
                    'alamat' => $request->alamat,
                    'alamat_sekolah' => $request->alamat_sekolah,
                ]);

                // Data orang tua/wali
                $orangTuaData = [
                    'jenis' => $request->jenis,
                ];

                if ($request->jenis === 'orang_tua') {
                    $orangTuaData['nama_ayah'] = $request->nama_ayah;
                    $orangTuaData['nik_ayah'] = $request->nik_ayah;
                    $orangTuaData['status_ayah'] = $request->status_ayah;
                    $orangTuaData['nama_ibu'] = $request->nama_ibu;
                    $orangTuaData['nik_ibu'] = $request->nik_ibu;
                    $orangTuaData['status_ibu'] = $request->status_ibu;
                    $orangTuaData['no_wa_ortu'] = $request->no_wa_ortu;
                    $orangTuaData['pekerjaan_ayah'] = $request->pekerjaan_ayah;
                    $orangTuaData['pekerjaan_ibu'] = $request->pekerjaan_ibu;
                    // Kosongkan field wali
                    $orangTuaData['nama_wali'] = null;
                    $orangTuaData['pekerjaan_wali'] = null;
                    $orangTuaData['no_hp_wali'] = null;
                    $orangTuaData['hubungan_wali'] = null;
                } else {
                    $orangTuaData['nama_wali'] = $request->nama_wali;
                    $orangTuaData['pekerjaan_wali'] = $request->pekerjaan_wali;
                    $orangTuaData['no_hp_wali'] = $request->no_hp_wali;
                    $orangTuaData['hubungan_wali'] = $request->hubungan_wali;
                    // Kosongkan field orang tua
                    $orangTuaData['nama_ayah'] = null;
                    $orangTuaData['nik_ayah'] = null;
                    $orangTuaData['status_ayah'] = null;
                    $orangTuaData['nama_ibu'] = null;
                    $orangTuaData['nik_ibu'] = null;
                    $orangTuaData['status_ibu'] = null;
                    $orangTuaData['no_wa_ortu'] = null;
                    $orangTuaData['pekerjaan_ayah'] = null;
                    $orangTuaData['pekerjaan_ibu'] = null;
                    $orangTuaData['pekerjaan'] = null;
                }

                // Create or update Orang Tua
                OrangTua::updateOrCreate(
                    ['calon_siswa_id' => $siswa->id],
                    $orangTuaData
                );

                // Update status pendaftaran menjadi lengkap
                if ($siswa->pendaftaran) {
                    $siswa->pendaftaran->update([
                        'status_pendaftaran' => 'Terdaftar',
                    ]);
                }
            });

            return redirect()->route('spmb.dashboard')->with('success', 'Data berhasil disimpan! Pendaftaran Anda sudah lengkap.');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage())->withInput();
        }
    }
}
