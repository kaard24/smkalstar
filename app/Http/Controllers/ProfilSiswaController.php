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
        $calonSiswa = Auth::guard('spmb')->user();

        // Load relationships
        $calonSiswa->load(['orangTua', 'pendaftaran.jurusan', 'pendaftaran.tes']);

        return view('spmb.profil', compact('calonSiswa'));
    }

    public function edit()
    {
        $calonSiswa = Auth::guard('spmb')->user();
        $calonSiswa->load(['orangTua', 'pendaftaran.jurusan', 'pendaftaran.jurusan2']);
        $jurusan = Jurusan::all();
        
        // Tentukan jenis data (orang_tua atau wali) berdasarkan data yang sudah ada
        $jenis = $calonSiswa->orangTua?->jenis ?? 'orang_tua';

        return view('spmb.edit-profil', compact('calonSiswa', 'jurusan', 'jenis'));
    }

    public function update(Request $request)
    {
        $calonSiswa = Auth::guard('spmb')->user();
        
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

        // Cek apakah user ingin switch ke wali
        $switchToWali = $request->has('switch_to_wali') && $request->switch_to_wali == '1';
        $isDataWaliFilled = !empty($request->nama_wali);
        
        // Jika switch_to_wali aktif dan data wali diisi, ubah jenis ke wali
        if ($switchToWali && $isDataWaliFilled) {
            $jenis = 'wali';
        }

        // Base validation rules - sama ketat dengan lengkapi-data
        $rules = [
            'nama' => 'required|string|min:3|max:50|regex:/^[a-zA-Z\s\'\-]+$/u',
            'nik' => 'required|string|size:16|regex:/^[0-9]{16}$/',
            'no_kk' => 'required|string|size:16|regex:/^[0-9]{16}$/',
            'jk' => 'required|in:L,P',
            'tgl_lahir' => 'required|date|before_or_equal:' . now()->subYears(15)->format('Y-m-d') . '|after_or_equal:' . now()->subYears(20)->format('Y-m-d'),
            'tempat_lahir' => 'required|string|min:3|max:50|regex:/^[a-zA-Z\s\-]+$/u',
            'alamat' => 'required|string|min:10|max:255|regex:/^[a-zA-Z0-9\s.,\-\/\(\)]+$/u',
            'alamat_sekolah' => 'required|string|min:10|max:255|regex:/^[a-zA-Z0-9\s.,\-\/\(\)]+$/u',
            'no_wa' => 'required|string|regex:/^62[0-9]{9,12}$/',
            'asal_sekolah' => 'required|string|min:5|max:100|regex:/^[a-zA-Z0-9\s\-\.]+$/u',
            'npsn' => 'required|string|size:8|regex:/^[0-9]{8}$/',
            'agama' => 'required|in:Islam,Kristen,Katolik,Hindu,Buddha,Konghucu',
            'golongan_darah' => 'nullable|in:A,B,AB,O,Tidak Tahu',
            'anak_ke' => 'required|integer|between:1,10',
            'jumlah_saudara' => 'required|integer|between:0,10',
            'tinggi_badan' => 'required|integer|between:100,200',
            'berat_badan' => 'required|integer|between:20,200',
            'riwayat_penyakit' => 'nullable|string|max:500|regex:/^[a-zA-Z0-9\s,\.\-\(\)\/]*$/u',
        ];

        // Validation rules based on jenis - sama ketat dengan lengkapi-data
        if ($jenis === 'orang_tua') {
            $rules['nama_ayah'] = 'required|string|max:100|regex:/^[a-zA-Z\s\.\']+$/';
            $rules['nik_ayah'] = 'required|string|size:16|regex:/^[0-9]{16}$/';
            $rules['status_ayah'] = 'required|in:hidup,meninggal';
            $rules['nama_ibu'] = 'required|string|max:100|regex:/^[a-zA-Z\s\.\']+$/';
            $rules['nik_ibu'] = 'required|string|size:16|regex:/^[0-9]{16}$/';
            $rules['status_ibu'] = 'required|in:hidup,meninggal';
            $rules['no_wa_ortu'] = 'required|string|regex:/^[0-9]{10,15}$/';
            $rules['pekerjaan_ayah'] = 'required|string|max:100|regex:/^[a-zA-Z0-9\s,\.\-\/\&]+$/';
            $rules['pekerjaan_ibu'] = 'required|string|max:100|regex:/^[a-zA-Z0-9\s,\.\-\/\&]+$/';
            $rules['pendidikan_ayah'] = 'required|in:Tidak Sekolah,SD,SMP,SMA,D1,D2,D3,S1,S2,S3';
            $rules['pendidikan_ibu'] = 'required|in:Tidak Sekolah,SD,SMP,SMA,D1,D2,D3,S1,S2,S3';
            $rules['penghasilan_ayah'] = 'required|in:<1jt,1jt-3jt,3jt-5jt,5jt-10jt,>10jt';
            $rules['penghasilan_ibu'] = 'required|in:<1jt,1jt-3jt,3jt-5jt,5jt-10jt,>10jt';
        } else {
            // Wali
            $rules['nama_wali'] = 'required|string|max:100|regex:/^[a-zA-Z\s\.\']+$/';
            $rules['pekerjaan_wali'] = 'required|string|max:100|regex:/^[a-zA-Z0-9\s,\.\-\/\&]+$/';
            $rules['no_hp_wali'] = 'required|string|regex:/^[0-9]{10,15}$/';
            $rules['hubungan_wali'] = 'required|string|max:50';
        }

        // Custom error messages dalam bahasa Indonesia
        $messages = [
            'nama.required' => 'Nama lengkap wajib diisi.',
            'nama.min' => 'Nama lengkap minimal 3 karakter.',
            'nama.max' => 'Nama lengkap maksimal 50 karakter.',
            'nama.regex' => 'Nama lengkap hanya boleh berisi huruf, spasi, tanda petik, dan tanda hubung.',
            
            'nik.required' => 'NIK wajib diisi.',
            'nik.size' => 'NIK harus 16 digit.',
            'nik.regex' => 'NIK hanya boleh berisi angka 16 digit.',
            
            'no_kk.required' => 'Nomor KK wajib diisi.',
            'no_kk.size' => 'Nomor KK harus 16 digit.',
            'no_kk.regex' => 'Nomor KK hanya boleh berisi angka 16 digit.',
            
            'tempat_lahir.required' => 'Tempat lahir wajib diisi.',
            'tempat_lahir.min' => 'Tempat lahir minimal 3 karakter.',
            'tempat_lahir.max' => 'Tempat lahir maksimal 50 karakter.',
            'tempat_lahir.regex' => 'Tempat lahir hanya boleh berisi huruf, spasi, dan tanda hubung.',
            
            'tgl_lahir.required' => 'Tanggal lahir wajib diisi.',
            'tgl_lahir.before_or_equal' => 'Umur minimal harus 15 tahun.',
            'tgl_lahir.after_or_equal' => 'Umur maksimal adalah 20 tahun.',
            
            'alamat.required' => 'Alamat wajib diisi.',
            'alamat.min' => 'Alamat terlalu pendek, minimal 10 karakter.',
            'alamat.max' => 'Alamat terlalu panjang, maksimal 255 karakter.',
            'alamat.regex' => 'Alamat hanya boleh mengandung huruf, angka, spasi, dan karakter . , - / ( )',
            
            'alamat_sekolah.required' => 'Alamat sekolah wajib diisi.',
            'alamat_sekolah.min' => 'Alamat sekolah terlalu pendek, minimal 10 karakter.',
            'alamat_sekolah.max' => 'Alamat sekolah terlalu panjang, maksimal 255 karakter.',
            'alamat_sekolah.regex' => 'Alamat sekolah hanya boleh mengandung huruf, angka, spasi, dan karakter . , - / ( )',
            
            'no_wa.required' => 'Nomor WhatsApp wajib diisi.',
            'no_wa.regex' => 'Nomor WhatsApp harus diawali dengan 62 dan terdiri dari 11-14 digit (contoh: 6281234567890).',
            
            'asal_sekolah.required' => 'Asal sekolah wajib diisi.',
            'asal_sekolah.min' => 'Asal sekolah minimal 5 karakter.',
            'asal_sekolah.max' => 'Asal sekolah maksimal 100 karakter.',
            'asal_sekolah.regex' => 'Asal sekolah hanya boleh berisi huruf, angka, spasi, titik, dan tanda hubung.',
            
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
            
            // Orang Tua
            'nama_ayah.required' => 'Nama ayah wajib diisi.',
            'nama_ayah.regex' => 'Nama ayah hanya boleh mengandung huruf, spasi, titik, dan apostrof.',
            'nik_ayah.required' => 'NIK ayah wajib diisi.',
            'nik_ayah.size' => 'NIK ayah harus 16 digit.',
            'nik_ayah.regex' => 'NIK ayah hanya boleh berisi angka 16 digit.',
            'status_ayah.required' => 'Status ayah wajib dipilih.',
            
            'nama_ibu.required' => 'Nama ibu wajib diisi.',
            'nama_ibu.regex' => 'Nama ibu hanya boleh mengandung huruf, spasi, titik, dan apostrof.',
            'nik_ibu.required' => 'NIK ibu wajib diisi.',
            'nik_ibu.size' => 'NIK ibu harus 16 digit.',
            'nik_ibu.regex' => 'NIK ibu hanya boleh berisi angka 16 digit.',
            'status_ibu.required' => 'Status ibu wajib dipilih.',
            
            'no_wa_ortu.required' => 'Nomor WhatsApp orang tua wajib diisi.',
            'no_wa_ortu.regex' => 'Nomor WhatsApp hanya boleh berisi angka 10-15 digit.',
            
            'pekerjaan_ayah.required' => 'Pekerjaan ayah wajib diisi.',
            'pekerjaan_ayah.regex' => 'Pekerjaan ayah hanya boleh mengandung huruf, angka, spasi, dan tanda baca umum.',
            'pekerjaan_ibu.required' => 'Pekerjaan ibu wajib diisi.',
            'pekerjaan_ibu.regex' => 'Pekerjaan ibu hanya boleh mengandung huruf, angka, spasi, dan tanda baca umum.',
            
            'pendidikan_ayah.required' => 'Pendidikan ayah wajib dipilih.',
            'pendidikan_ibu.required' => 'Pendidikan ibu wajib dipilih.',
            'penghasilan_ayah.required' => 'Penghasilan ayah wajib dipilih.',
            'penghasilan_ibu.required' => 'Penghasilan ibu wajib dipilih.',
            
            // Wali
            'nama_wali.required' => 'Nama wali wajib diisi.',
            'nama_wali.regex' => 'Nama wali hanya boleh mengandung huruf, spasi, titik, dan apostrof.',
            'pekerjaan_wali.required' => 'Pekerjaan wali wajib diisi.',
            'pekerjaan_wali.regex' => 'Pekerjaan wali hanya boleh mengandung huruf, angka, spasi, dan tanda baca umum.',
            'no_hp_wali.required' => 'Nomor HP wali wajib diisi.',
            'no_hp_wali.regex' => 'Nomor HP hanya boleh berisi angka 10-15 digit.',
            'hubungan_wali.required' => 'Hubungan wali wajib diisi.',
        ];

        $validated = $request->validate($rules, $messages);

        try {
            DB::transaction(function () use ($request, $calonSiswa, $jenis, $switchToOrtu, $isDataOrtuFilled, $switchToWali, $isDataWaliFilled) {
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
                    'npsn_sekolah' => $request->npsn,
                    'agama' => $request->agama,
                    'golongan_darah' => $request->golongan_darah,
                    'anak_ke' => (int) $request->anak_ke,
                    'jumlah_saudara' => (int) $request->jumlah_saudara,
                    'tinggi_badan' => (int) $request->tinggi_badan,
                    'berat_badan' => (int) $request->berat_badan,
                    'riwayat_penyakit' => $request->riwayat_penyakit,
                ]);

                // Update OrangTua/Wali
                if ($jenis === 'orang_tua') {
                    $orangTuaData = [
                        'jenis' => 'orang_tua',
                        'nama_ayah' => $request->nama_ayah,
                        'nik_ayah' => $request->nik_ayah,
                        'status_ayah' => $request->status_ayah,
                        'nama_ibu' => $request->nama_ibu,
                        'nik_ibu' => $request->nik_ibu,
                        'status_ibu' => $request->status_ibu,
                        'no_wa_ortu' => $request->no_wa_ortu,
                        'pekerjaan_ayah' => $request->pekerjaan_ayah,
                        'pekerjaan_ibu' => $request->pekerjaan_ibu,
                        'pendidikan_ayah' => $request->pendidikan_ayah,
                        'pendidikan_ibu' => $request->pendidikan_ibu,
                        'penghasilan_ayah' => $request->penghasilan_ayah,
                        'penghasilan_ibu' => $request->penghasilan_ibu,
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

            // Pesan sukses berbeda jika switch dari wali ke orang tua atau sebaliknya
            // Hanya tampilkan pesan switch jika benar-benar switch dan data diisi
            $actuallySwitchedOrtu = ($switchToOrtu && $isDataOrtuFilled && $calonSiswa->orangTua?->jenis === 'orang_tua');
            $actuallySwitchedWali = ($switchToWali && $isDataWaliFilled && $calonSiswa->orangTua?->jenis === 'wali');
            
            if ($actuallySwitchedOrtu) {
                $successMessage = 'Data berhasil diperbarui! Data orang tua telah ditambahkan.';
            } elseif ($actuallySwitchedWali) {
                $successMessage = 'Data berhasil diperbarui! Data wali telah ditambahkan.';
            } else {
                $successMessage = 'Biodata berhasil diperbarui.';
            }

            return redirect()->route('spmb.profil')->with('success', $successMessage);

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

        $calonSiswa = Auth::guard('spmb')->user();

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
        $calonSiswa = Auth::guard('spmb')->user();

        if ($calonSiswa->foto) {
            Storage::disk('public')->delete('foto/' . $calonSiswa->foto);
            $calonSiswa->update(['foto' => null]);
        }

        return back()->with('success', 'Foto profil berhasil dihapus');
    }
}
