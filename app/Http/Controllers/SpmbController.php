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
            'nik' => [
                'required',
                'string',
                'size:16',
                'regex:/^[0-9]{16}$/',
                // NIK tidak boleh sama dengan murid lain (unique, kecuali milik sendiri)
                'unique:calon_siswa,nik,' . $siswa->id,
            ],
            'no_kk' => [
                'required',
                'string',
                'size:16',
                'regex:/^[0-9]{16}$/',
                // No KK tidak boleh sama dengan murid lain
                'unique:calon_siswa,no_kk,' . $siswa->id,
            ],
            'alamat' => [
                'required',
                'string',
                'min:10',
                'max:255',
                'regex:/^[a-zA-Z0-9\s.,\/\-()]+$/',
            ],
            'alamat_sekolah' => [
                'required',
                'string',
                'min:10',
                'max:255',
                'regex:/^[a-zA-Z0-9\s.,\/\-()]+$/',
            ],
            'npsn' => [
                'required',
                'string',
                'size:8',
                'regex:/^[0-9]{8}$/',
            ],
            'agama' => 'required|in:Islam,Kristen,Katolik,Hindu,Buddha,Konghucu',
            'golongan_darah' => 'nullable|in:A,B,AB,O,Tidak Tahu',
            'anak_ke' => 'required|integer|between:1,10',
            'jumlah_saudara' => 'required|integer|between:0,10',
            'tinggi_badan' => 'required|integer|between:100,200',
            'berat_badan' => 'required|integer|between:20,200',
            'riwayat_penyakit' => [
                'nullable',
                'string',
                'max:500',
                // Validasi untuk mencegah SQL injection dan karakter berbahaya
                'regex:/^[a-zA-Z0-9\s,\.\-\(\)\/]*$/',
            ],
            'minat_bakat' => [
                'nullable',
                'string',
                'max:1000',
                'regex:/^[a-zA-Z\s,\.\-\(\)\/\;\:\"\'\?\!]*$/',
            ],
            'jenis' => 'required|in:orang_tua,wali',
        ];

        $messages = [
            'nik.required' => 'NIK wajib diisi.',
            'nik.size' => 'NIK harus 16 digit.',
            'nik.regex' => 'NIK hanya boleh berisi angka 16 digit.',
            'nik.unique' => 'NIK ini sudah terdaftar oleh siswa lain.',
            'no_kk.required' => 'Nomor KK wajib diisi.',
            'no_kk.size' => 'Nomor KK harus 16 digit.',
            'no_kk.regex' => 'Nomor KK hanya boleh berisi angka 16 digit.',
            'no_kk.unique' => 'Nomor KK ini sudah terdaftar oleh siswa lain.',
            'alamat.required' => 'Alamat wajib diisi.',
            'alamat.min' => 'Alamat terlalu pendek, minimal 10 karakter.',
            'alamat.max' => 'Alamat terlalu panjang, maksimal 255 karakter.',
            'alamat.regex' => 'Alamat hanya boleh mengandung huruf, angka, spasi, dan karakter . , - / ( )',
            'alamat_sekolah.required' => 'Alamat sekolah wajib diisi.',
            'alamat_sekolah.min' => 'Alamat sekolah terlalu pendek, minimal 10 karakter.',
            'alamat_sekolah.max' => 'Alamat sekolah terlalu panjang, maksimal 255 karakter.',
            'alamat_sekolah.regex' => 'Alamat sekolah hanya boleh mengandung huruf, angka, spasi, dan karakter . , - / ( )',
            'npsn.required' => 'NPSN sekolah wajib diisi.',
            'npsn.size' => 'NPSN harus 8 digit.',
            'npsn.regex' => 'NPSN hanya boleh berisi angka 8 digit.',
            'agama.required' => 'Agama wajib dipilih.',
            'anak_ke.required' => 'Anak ke wajib diisi.',
            'anak_ke.between' => 'Anak ke hanya boleh diisi angka 1-10.',
            'jumlah_saudara.required' => 'Jumlah saudara wajib diisi.',
            'jumlah_saudara.between' => 'Jumlah saudara hanya boleh diisi angka 0-10.',
            'tinggi_badan.required' => 'Tinggi badan wajib diisi.',
            'tinggi_badan.between' => 'Tinggi badan harus antara 100-200 cm.',
            'berat_badan.required' => 'Berat badan wajib diisi.',
            'berat_badan.between' => 'Berat badan harus antara 20-200 kg.',
            'riwayat_penyakit.max' => 'Riwayat penyakit maksimal 500 karakter.',
            'riwayat_penyakit.regex' => 'Riwayat penyakit hanya boleh mengandung huruf, angka, spasi, dan karakter , . - / ( )',
            'minat_bakat.max' => 'Minat dan bakat maksimal 1000 karakter.',
            'minat_bakat.regex' => 'Minat dan bakat hanya boleh mengandung huruf, spasi, dan tanda baca umum (tanpa angka).',
            'jenis.required' => 'Jenis orang tua/wali wajib dipilih.',
        ];

        // Validasi khusus berdasarkan jenis
        if ($request->jenis === 'orang_tua') {
            $rules['nama_ayah'] = 'required|string|max:100|regex:/^[a-zA-Z\s\.\']+$/';
            $rules['nik_ayah'] = [
                'required',
                'string',
                'size:16',
                'regex:/^[0-9]{16}$/',
                // NIK ayah tidak boleh sama dengan NIK anak
                'different:nik',
            ];
            $rules['status_ayah'] = 'required|in:hidup,meninggal';
            $rules['nama_ibu'] = 'required|string|max:100|regex:/^[a-zA-Z\s\.\']+$/';
            $rules['nik_ibu'] = [
                'required',
                'string',
                'size:16',
                'regex:/^[0-9]{16}$/',
                // NIK ibu tidak boleh sama dengan NIK anak
                'different:nik',
                // NIK ibu tidak boleh sama dengan NIK ayah
                'different:nik_ayah',
            ];
            $rules['status_ibu'] = 'required|in:hidup,meninggal';
            $rules['no_wa_ortu'] = 'required|string|regex:/^[0-9]{10,15}$/';
            $rules['pekerjaan_ayah'] = 'required|string|max:100|regex:/^[a-zA-Z0-9\s,\.\-\/\&]+$/';
            $rules['pekerjaan_ibu'] = 'required|string|max:100|regex:/^[a-zA-Z0-9\s,\.\-\/\&]+$/';
            $rules['pendidikan_ayah'] = 'required|in:Tidak Sekolah,SD,SMP,SMA,D1,D2,D3,S1,S2,S3';
            $rules['pendidikan_ibu'] = 'required|in:Tidak Sekolah,SD,SMP,SMA,D1,D2,D3,S1,S2,S3';
            $rules['penghasilan_ayah'] = 'required|in:<1jt,1jt-3jt,3jt-5jt,5jt-10jt,>10jt';
            $rules['penghasilan_ibu'] = 'required|in:<1jt,1jt-3jt,3jt-5jt,5jt-10jt,>10jt';

            $messages['nama_ayah.required'] = 'Nama ayah wajib diisi.';
            $messages['nama_ayah.regex'] = 'Nama ayah hanya boleh mengandung huruf, spasi, titik, dan apostrof.';
            $messages['nik_ayah.required'] = 'NIK ayah wajib diisi.';
            $messages['nik_ayah.size'] = 'NIK ayah harus 16 digit.';
            $messages['nik_ayah.regex'] = 'NIK ayah hanya boleh berisi angka 16 digit.';
            $messages['nik_ayah.different'] = 'NIK ayah tidak boleh sama dengan NIK anak.';
            $messages['status_ayah.required'] = 'Status ayah wajib dipilih.';
            $messages['nama_ibu.required'] = 'Nama ibu wajib diisi.';
            $messages['nama_ibu.regex'] = 'Nama ibu hanya boleh mengandung huruf, spasi, titik, dan apostrof.';
            $messages['nik_ibu.required'] = 'NIK ibu wajib diisi.';
            $messages['nik_ibu.size'] = 'NIK ibu harus 16 digit.';
            $messages['nik_ibu.regex'] = 'NIK ibu hanya boleh berisi angka 16 digit.';
            $messages['nik_ibu.different'] = 'NIK ibu tidak boleh sama dengan NIK anak atau NIK ayah.';
            $messages['status_ibu.required'] = 'Status ibu wajib dipilih.';
            $messages['no_wa_ortu.required'] = 'Nomor WhatsApp orang tua wajib diisi.';
            $messages['no_wa_ortu.regex'] = 'Nomor WhatsApp hanya boleh berisi angka 10-15 digit.';
            $messages['pekerjaan_ayah.required'] = 'Pekerjaan ayah wajib diisi.';
            $messages['pekerjaan_ayah.regex'] = 'Pekerjaan ayah hanya boleh mengandung huruf, angka, spasi, dan tanda baca umum.';
            $messages['pekerjaan_ibu.required'] = 'Pekerjaan ibu wajib diisi.';
            $messages['pekerjaan_ibu.regex'] = 'Pekerjaan ibu hanya boleh mengandung huruf, angka, spasi, dan tanda baca umum.';
            $messages['pendidikan_ayah.required'] = 'Pendidikan ayah wajib dipilih.';
            $messages['pendidikan_ibu.required'] = 'Pendidikan ibu wajib dipilih.';
            $messages['penghasilan_ayah.required'] = 'Penghasilan ayah wajib dipilih.';
            $messages['penghasilan_ibu.required'] = 'Penghasilan ibu wajib dipilih.';
        } else {
            $rules['nama_wali'] = 'required|string|max:100|regex:/^[a-zA-Z\s\.\']+$/';
            $rules['pekerjaan_wali'] = 'required|string|max:100|regex:/^[a-zA-Z0-9\s,\.\-\/\&]+$/';
            $rules['no_hp_wali'] = 'required|string|regex:/^[0-9]{10,15}$/';
            $rules['hubungan_wali'] = 'required|string|max:50';

            $messages['nama_wali.required'] = 'Nama wali wajib diisi.';
            $messages['nama_wali.regex'] = 'Nama wali hanya boleh mengandung huruf, spasi, titik, dan apostrof.';
            $messages['pekerjaan_wali.required'] = 'Pekerjaan wali wajib diisi.';
            $messages['pekerjaan_wali.regex'] = 'Pekerjaan wali hanya boleh mengandung huruf, angka, spasi, dan tanda baca umum.';
            $messages['no_hp_wali.required'] = 'Nomor HP wali wajib diisi.';
            $messages['no_hp_wali.regex'] = 'Nomor HP hanya boleh berisi angka 10-15 digit.';
            $messages['hubungan_wali.required'] = 'Hubungan wali wajib diisi.';
        }

        $validated = $request->validate($rules, $messages);

        // Validasi tambahan: Cek NIK ayah dan ibu tidak sama dengan NIK siswa lain di database
        if ($request->jenis === 'orang_tua') {
            // Cek NIK ayah tidak sama dengan NIK siswa lain
            $nikAyahExists = CalonSiswa::where('nik', $request->nik_ayah)
                ->where('id', '!=', $siswa->id)
                ->exists();
            
            if ($nikAyahExists) {
                return back()
                    ->withErrors(['nik_ayah' => 'NIK ayah sudah terdaftar sebagai NIK siswa lain.'])
                    ->withInput();
            }

            // Cek NIK ibu tidak sama dengan NIK siswa lain
            $nikIbuExists = CalonSiswa::where('nik', $request->nik_ibu)
                ->where('id', '!=', $siswa->id)
                ->exists();
            
            if ($nikIbuExists) {
                return back()
                    ->withErrors(['nik_ibu' => 'NIK ibu sudah terdaftar sebagai NIK siswa lain.'])
                    ->withInput();
            }

            // Cek NIK ayah dan ibu tidak sama (redundant tapi untuk keamanan)
            if ($request->nik_ayah === $request->nik_ibu) {
                return back()
                    ->withErrors(['nik_ibu' => 'NIK ibu tidak boleh sama dengan NIK ayah.'])
                    ->withInput();
            }
        }

        // Validasi khusus untuk wali
        if ($request->jenis === 'wali') {
            // Cek no_hp_wali tidak sama dengan no_wa siswa sendiri
            if ($request->no_hp_wali === $siswa->no_wa) {
                return back()
                    ->withErrors(['no_hp_wali' => 'Nomor HP wali tidak boleh sama dengan nomor WA Anda sendiri.'])
                    ->withInput();
            }

            // Cek no_hp_wali tidak sama dengan no_wa_ortu/no_hp_wali siswa lain
            $noHpWaliExists = OrangTua::where(function ($query) use ($request) {
                $query->where('no_wa_ortu', $request->no_hp_wali)
                      ->orWhere('no_hp_wali', $request->no_hp_wali);
            })
            ->where('calon_siswa_id', '!=', $siswa->id)
            ->exists();

            if ($noHpWaliExists) {
                return back()
                    ->withErrors(['no_hp_wali' => 'Nomor HP ini sudah terdaftar sebagai nomor orang tua/wali siswa lain.'])
                    ->withInput();
            }
        }

        try {
            DB::transaction(function () use ($request, $siswa) {
                // Update Calon Siswa data
                $siswa->update([
                    'nik' => $request->nik,
                    'no_kk' => $request->no_kk,
                    'alamat' => $request->alamat,
                    'alamat_sekolah' => $request->alamat_sekolah,
                    'npsn_sekolah' => $request->npsn,
                    'agama' => $request->agama,
                    'golongan_darah' => $request->golongan_darah,
                    'anak_ke' => (int) $request->anak_ke,
                    'jumlah_saudara' => (int) $request->jumlah_saudara,
                    'tinggi_badan' => (int) $request->tinggi_badan,
                    'berat_badan' => (int) $request->berat_badan,
                    'riwayat_penyakit' => $request->riwayat_penyakit,
                    'minat_bakat' => $request->minat_bakat,
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
                    $orangTuaData['pendidikan_ayah'] = $request->pendidikan_ayah;
                    $orangTuaData['pendidikan_ibu'] = $request->pendidikan_ibu;
                    $orangTuaData['penghasilan_ayah'] = $request->penghasilan_ayah;
                    $orangTuaData['penghasilan_ibu'] = $request->penghasilan_ibu;
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
