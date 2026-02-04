<?php

namespace App\Http\Controllers;

use App\Models\CalonSiswa;
use App\Models\Pendaftaran;
use App\Models\Tes;
use App\Models\Pengumuman;
use App\Models\Jurusan;
use App\Models\OrangTua;
use App\Models\BerkasPendaftaran;
use App\Services\WhatsAppService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Symfony\Component\HttpFoundation\StreamedResponse;

class AdminSpmbController extends Controller
{
    protected $whatsappService;

    public function __construct(WhatsAppService $whatsappService)
    {
        $this->whatsappService = $whatsappService;
    }

    public function index(Request $request)
    {
        $query = CalonSiswa::with(['pendaftaran.jurusan', 'pendaftaran.tes']);

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('no_wa', 'like', "%{$search}%")
                  ->orWhere('nisn', 'like', "%{$search}%")
                  ->orWhereYear('tgl_lahir', $search);
            });
        }

        // Filter by jurusan
        if ($request->filled('jurusan')) {
            $query->whereHas('pendaftaran', function ($q) use ($request) {
                $q->where('jurusan_id', $request->jurusan);
            });
        }

        // Filter by status pendaftaran
        if ($request->filled('status')) {
            $status = $request->status;
            if ($status === 'baru') {
                // Siswa yang belum punya pendaftaran
                $query->whereDoesntHave('pendaftaran');
            } elseif ($status === 'proses_data') {
                // Siswa yang sudah punya pendaftaran tapi data belum lengkap (NIK, No KK, dll)
                $query->whereHas('pendaftaran')
                      ->where(function ($q) {
                          $q->whereNull('jk')
                            ->orWhereNull('tgl_lahir')
                            ->orWhereNull('alamat')
                            ->orWhereNull('asal_sekolah')
                            ->orWhereNull('nik')
                            ->orWhereNull('no_kk')
                            ->orWhereNull('tempat_lahir');
                      });
            } elseif ($status === 'proses_berkas') {
                // Siswa yang data sudah lengkap tapi berkas belum lengkap
                $query->whereHas('pendaftaran')
                      ->whereNotNull('jk')
                      ->whereNotNull('tgl_lahir')
                      ->whereNotNull('alamat')
                      ->whereNotNull('asal_sekolah')
                      ->whereNotNull('nik')
                      ->whereNotNull('no_kk')
                      ->whereNotNull('tempat_lahir')
                      ->where(function ($q) {
                          $q->whereNotExists(function ($sub) {
                              $sub->select(DB::raw(1))
                                  ->from('berkas_pendaftaran')
                                  ->whereColumn('berkas_pendaftaran.calon_siswa_id', 'calon_siswa.id')
                                  ->groupBy('calon_siswa_id')
                                  ->havingRaw('COUNT(CASE WHEN path_file IS NOT NULL THEN 1 END) = 4');
                          })
                          ->orWhereExists(function ($sub) {
                              $sub->select(DB::raw(1))
                                  ->from('berkas_pendaftaran')
                                  ->whereColumn('berkas_pendaftaran.calon_siswa_id', 'calon_siswa.id')
                                  ->groupBy('calon_siswa_id')
                                  ->havingRaw('COUNT(CASE WHEN path_file IS NOT NULL THEN 1 END) < 4');
                          })
                          ->orWhereDoesntHave('berkasPendaftaran');
                      });
            } elseif ($status === 'lengkap') {
                // Siswa yang data lengkap dan berkas lengkap tapi belum wawancara/lulus
                $query->whereHas('pendaftaran')
                      ->whereNotNull('jk')
                      ->whereNotNull('tgl_lahir')
                      ->whereNotNull('alamat')
                      ->whereNotNull('asal_sekolah')
                      ->whereNotNull('nik')
                      ->whereNotNull('no_kk')
                      ->whereNotNull('tempat_lahir')
                      ->whereHas('berkasPendaftaran', function ($q) {
                          $q->whereNotNull('path_file');
                      }, '=', 4)
                      ->whereDoesntHave('pendaftaran.tes', function ($q) {
                          $q->where('status_wawancara', 'sudah');
                      });
            } elseif ($status === 'lulus') {
                // Siswa yang sudah lulus wawancara
                $query->whereHas('pendaftaran.tes', function ($q) {
                    $q->where('status_wawancara', 'sudah')
                      ->where('status_kelulusan', 'Lulus');
                });
            }
        }

        // Filter by status wawancara (terpisah dari status pendaftaran)
        if ($request->filled('wawancara')) {
            $wawancara = $request->wawancara;
            if ($wawancara === 'belum') {
                // Siswa yang belum wawancara (belum ada record tes atau status_wawancara = 'belum')
                $query->whereHas('pendaftaran')
                      ->where(function ($q) {
                          $q->whereDoesntHave('pendaftaran.tes')
                            ->orWhereHas('pendaftaran.tes', function ($q2) {
                                $q2->where('status_wawancara', 'belum');
                            });
                      });
            } elseif ($wawancara === 'sudah') {
                // Siswa yang sudah wawancara
                $query->whereHas('pendaftaran.tes', function ($q) {
                    $q->where('status_wawancara', 'sudah');
                });
            }
        }

        $pendaftar = $query->orderBy('created_at', 'desc')->paginate(15);
        $pendaftar->appends($request->query()); // Preserve query params in pagination

        $jurusanList = Jurusan::all();
            
        return view('admin.pendaftar', compact('pendaftar', 'jurusanList'));
    }

    public function create()
    {
        $jurusan = Jurusan::all();
        $berkasList = BerkasPendaftaran::getJenisBerkas();
        
        return view('admin.pendaftar-create', compact('jurusan', 'berkasList'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nisn' => 'required|string|max:10|unique:calon_siswa,nisn',
            'nik' => 'nullable|string|size:16',
            'no_kk' => 'nullable|string|size:16',
            'nama' => 'required|string|max:255',
            'jk' => 'nullable|in:L,P',
            'tempat_lahir' => 'nullable|string|max:100',
            'tgl_lahir' => 'nullable|date',
            'alamat' => 'nullable|string',
            'no_wa' => 'nullable|string|max:15',
            'asal_sekolah' => 'nullable|string|max:100',
            'alamat_sekolah' => 'nullable|string',
            'password' => 'required|string|min:6',
            'jurusan_id' => 'nullable|exists:jurusan,id',
            'gelombang' => 'nullable|string|max:20',
            // Orang Tua
            'jenis' => 'nullable|in:orang_tua,wali',
            'nama_ayah' => 'nullable|string|max:100',
            'nik_ayah' => 'nullable|string|size:16',
            'status_ayah' => 'nullable|in:hidup,meninggal',
            'nama_ibu' => 'nullable|string|max:100',
            'nik_ibu' => 'nullable|string|size:16',
            'status_ibu' => 'nullable|in:hidup,meninggal',
            'pekerjaan' => 'nullable|string|max:100',
            'pekerjaan_ayah' => 'nullable|string|max:100',
            'pekerjaan_ibu' => 'nullable|string|max:100',
            'no_wa_ortu' => 'nullable|string|max:15',
            'nama_wali' => 'nullable|string|max:100',
            'pekerjaan_wali' => 'nullable|string|max:100',
            'no_hp_wali' => 'nullable|string|max:15',
            'hubungan_wali' => 'nullable|string|max:50',
            // Tes
            'status_wawancara' => 'nullable|in:belum,sudah',
            'nilai_minat_bakat' => 'nullable|string',
            'berkas' => 'nullable|array',
            'berkas.*' => 'nullable|file|max:5120|mimes:pdf,jpg,jpeg,png',
        ]);

        try {
            DB::transaction(function () use ($request) {
                // Create Calon Siswa
                $siswa = CalonSiswa::create([
                    'nisn' => $request->nisn,
                    'nik' => $request->nik,
                    'no_kk' => $request->no_kk,
                    'nama' => $request->nama,
                    'jk' => $request->jk,
                    'tempat_lahir' => $request->tempat_lahir,
                    'tgl_lahir' => $request->tgl_lahir,
                    'alamat' => $request->alamat,
                    'no_wa' => $request->no_wa,
                    'asal_sekolah' => $request->asal_sekolah,
                    'alamat_sekolah' => $request->alamat_sekolah,
                    'password' => bcrypt($request->password),
                ]);

                // Create Orang Tua if data provided
                if ($request->nama_ayah || $request->nama_ibu || $request->nama_wali) {
                    OrangTua::create([
                        'calon_siswa_id' => $siswa->id,
                        'jenis' => $request->jenis ?? 'orang_tua',
                        'nama_ayah' => $request->nama_ayah,
                        'nik_ayah' => $request->nik_ayah,
                        'status_ayah' => $request->status_ayah ?? 'hidup',
                        'nama_ibu' => $request->nama_ibu,
                        'nik_ibu' => $request->nik_ibu,
                        'status_ibu' => $request->status_ibu ?? 'hidup',
                        'pekerjaan' => $request->pekerjaan,
                        'pekerjaan_ayah' => $request->pekerjaan_ayah,
                        'pekerjaan_ibu' => $request->pekerjaan_ibu,
                        'no_wa_ortu' => $request->no_wa_ortu,
                        'nama_wali' => $request->nama_wali,
                        'pekerjaan_wali' => $request->pekerjaan_wali,
                        'no_hp_wali' => $request->no_hp_wali,
                        'hubungan_wali' => $request->hubungan_wali,
                    ]);
                }

                // Create Pendaftaran if jurusan selected
                $pendaftaran = null;
                if ($request->jurusan_id) {
                    $pendaftaran = Pendaftaran::create([
                        'calon_siswa_id' => $siswa->id,
                        'jurusan_id' => $request->jurusan_id,
                        'gelombang' => $request->gelombang ?? 'Gelombang 1',
                        'status_pendaftaran' => 'Terdaftar',
                    ]);

                    // Create Tes record if status wawancara provided
                    if ($request->status_wawancara) {
                        $statusKelulusan = $request->status_wawancara === 'sudah' ? 'Lulus' : 'Pending';
                        
                        Tes::create([
                            'pendaftaran_id' => $pendaftaran->id,
                            'status_wawancara' => $request->status_wawancara,
                            'nilai_minat_bakat' => $request->nilai_minat_bakat,
                            'status_kelulusan' => $statusKelulusan,
                        ]);

                        // Create pengumuman if lulus
                        if ($request->status_wawancara === 'sudah') {
                            Pengumuman::create([
                                'pendaftaran_id' => $pendaftaran->id,
                                'keterangan' => 'Selamat! Anda dinyatakan LULUS seleksi SPMB SMK Al-Hidayah Lestari.',
                                'tgl_pengumuman' => Carbon::now(),
                            ]);

                            $pendaftaran->update(['status_pendaftaran' => 'Selesai Tes']);
                        }
                    }
                }

                // Handle file uploads
                if ($request->hasFile('berkas')) {
                    foreach ($request->file('berkas') as $jenis => $file) {
                        $path = $file->store('berkas/' . $siswa->id, 'public');
                        
                        BerkasPendaftaran::create([
                            'calon_siswa_id' => $siswa->id,
                            'jenis_berkas' => $jenis,
                            'nama_file' => $file->getClientOriginalName(),
                            'path_file' => $path,
                            'status_verifikasi' => BerkasPendaftaran::STATUS_VALID,
                        ]);
                    }
                }
            });

            return redirect()->route('admin.pendaftar.index')
                ->with('success', 'Data calon siswa berhasil ditambahkan.');

        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }

    public function show($id)
    {
        $siswa = CalonSiswa::with(['orangTua', 'berkasPendaftaran', 'pendaftaran.jurusan'])->findOrFail($id);
        
        return view('admin.pendaftar-show', compact('siswa'));
    }

    public function edit($id)
    {
        $siswa = CalonSiswa::with(['orangTua', 'pendaftaran.jurusan', 'pendaftaran.tes'])->findOrFail($id);
        $jurusan = Jurusan::all();
        
        return view('admin.pendaftar-edit', compact('siswa', 'jurusan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nik' => 'nullable|string|size:16',
            'no_kk' => 'nullable|string|size:16',
            'jk' => 'nullable|in:L,P',
            'tempat_lahir' => 'nullable|string|max:100',
            'tgl_lahir' => 'nullable|date',
            'alamat' => 'nullable|string',
            'alamat_sekolah' => 'nullable|string',
            'no_wa' => 'nullable|string|max:15',
            'asal_sekolah' => 'nullable|string|max:100',
            'jurusan_id' => 'nullable|exists:jurusan,id',
            // Orang Tua / Wali
            'jenis' => 'nullable|in:orang_tua,wali',
            'nama_ayah' => 'nullable|string|max:100',
            'nik_ayah' => 'nullable|string|size:16',
            'status_ayah' => 'nullable|in:hidup,meninggal',
            'nama_ibu' => 'nullable|string|max:100',
            'nik_ibu' => 'nullable|string|size:16',
            'status_ibu' => 'nullable|in:hidup,meninggal',
            'pekerjaan' => 'nullable|string|max:100',
            'pekerjaan_ayah' => 'nullable|string|max:100',
            'pekerjaan_ibu' => 'nullable|string|max:100',
            'no_wa_ortu' => 'nullable|string|max:15',
            'nama_wali' => 'nullable|string|max:100',
            'pekerjaan_wali' => 'nullable|string|max:100',
            'no_hp_wali' => 'nullable|string|max:15',
            'hubungan_wali' => 'nullable|string|max:50',
        ]);

        $siswa = CalonSiswa::with('pendaftaran')->findOrFail($id);

        try {
            DB::transaction(function () use ($request, $siswa) {
                // Update CalonSiswa
                $siswa->update([
                    'nama' => $request->nama,
                    'nik' => $request->nik,
                    'no_kk' => $request->no_kk,
                    'jk' => $request->jk,
                    'tempat_lahir' => $request->tempat_lahir,
                    'tgl_lahir' => $request->tgl_lahir,
                    'asal_sekolah' => $request->asal_sekolah,
                    'alamat_sekolah' => $request->alamat_sekolah,
                    'alamat' => $request->alamat,
                    'no_wa' => $request->no_wa,
                ]);

                // Update or Create OrangTua
                $jenis = $request->jenis ?? 'orang_tua';
                if ($jenis === 'orang_tua' && ($request->nama_ayah || $request->nama_ibu)) {
                    OrangTua::updateOrCreate(
                        ['calon_siswa_id' => $siswa->id],
                        [
                            'jenis' => 'orang_tua',
                            'nama_ayah' => $request->nama_ayah,
                            'nik_ayah' => $request->nik_ayah,
                            'status_ayah' => $request->status_ayah ?? 'hidup',
                            'nama_ibu' => $request->nama_ibu,
                            'nik_ibu' => $request->nik_ibu,
                            'status_ibu' => $request->status_ibu ?? 'hidup',
                            'pekerjaan' => $request->pekerjaan,
                            'pekerjaan_ayah' => $request->pekerjaan_ayah,
                            'pekerjaan_ibu' => $request->pekerjaan_ibu,
                            'no_wa_ortu' => $request->no_wa_ortu,
                            'nama_wali' => null,
                            'pekerjaan_wali' => null,
                            'no_hp_wali' => null,
                            'hubungan_wali' => null,
                        ]
                    );
                } elseif ($jenis === 'wali' && $request->nama_wali) {
                    OrangTua::updateOrCreate(
                        ['calon_siswa_id' => $siswa->id],
                        [
                            'jenis' => 'wali',
                            'nama_ayah' => null,
                            'nik_ayah' => null,
                            'status_ayah' => null,
                            'nama_ibu' => null,
                            'nik_ibu' => null,
                            'status_ibu' => null,
                            'pekerjaan' => null,
                            'pekerjaan_ayah' => null,
                            'pekerjaan_ibu' => null,
                            'no_wa_ortu' => null,
                            'nama_wali' => $request->nama_wali,
                            'pekerjaan_wali' => $request->pekerjaan_wali,
                            'no_hp_wali' => $request->no_hp_wali,
                            'hubungan_wali' => $request->hubungan_wali,
                        ]
                    );
                }

                // Update or Create Pendaftaran if jurusan selected
                if ($request->jurusan_id) {
                    $pendaftaran = Pendaftaran::updateOrCreate(
                        ['calon_siswa_id' => $siswa->id],
                        [
                            'jurusan_id' => $request->jurusan_id,
                            'gelombang' => $request->gelombang,
                            'status_pendaftaran' => 'Terdaftar',
                        ]
                    );

                    // Update or Create Tes (Status Wawancara & Nilai Minat Bakat)
                    if ($request->has('status_wawancara')) {
                        $statusKelulusan = $request->status_wawancara === 'sudah' ? 'Lulus' : 'Pending';
                        
                        Tes::updateOrCreate(
                            ['pendaftaran_id' => $pendaftaran->id],
                            [
                                'status_wawancara' => $request->status_wawancara,
                                'nilai_minat_bakat' => $request->nilai_minat_bakat,
                                'status_kelulusan' => $statusKelulusan,
                            ]
                        );

                        // Jika wawancara sudah, buat/update pengumuman
                        if ($request->status_wawancara === 'sudah') {
                            Pengumuman::updateOrCreate(
                                ['pendaftaran_id' => $pendaftaran->id],
                                [
                                    'keterangan' => 'Selamat! Anda dinyatakan LULUS seleksi SPMB SMK Al-Hidayah Lestari.',
                                    'tgl_pengumuman' => Carbon::now(),
                                ]
                            );

                            // Update status pendaftaran
                            $pendaftaran->update(['status_pendaftaran' => 'Selesai Tes']);
                        }
                    }
                }
            });

            return redirect()->route('admin.pendaftar.index')
                ->with('success', 'Data calon siswa berhasil diperbarui.');

        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy($id)
    {
        $siswa = CalonSiswa::findOrFail($id);

        try {
            DB::transaction(function () use ($siswa) {
                // Delete related records
                if ($siswa->pendaftaran) {
                    if ($siswa->pendaftaran->tes) {
                        $siswa->pendaftaran->tes->delete();
                    }
                    $siswa->pendaftaran->delete();
                }
                
                // Delete berkas
                $siswa->berkasPendaftaran()->delete();
                
                // Delete orang tua
                if ($siswa->orangTua) {
                    $siswa->orangTua->delete();
                }
                
                // Delete calon siswa
                $siswa->delete();
            });

            return redirect()->route('admin.pendaftar.index')
                ->with('success', 'Data calon siswa berhasil dihapus.');

        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function inputNilaiList()
    {
        // Show verified students who need score input
        $pendaftar = Pendaftaran::with(['calonSiswa', 'jurusan', 'tes'])
            ->whereIn('status_pendaftaran', ['Diverifikasi', 'Menunggu Tes', 'Selesai Tes'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);
            
        return view('admin.input_nilai_list', compact('pendaftar'));
    }

    public function formNilai($id)
    {
        $pendaftaran = Pendaftaran::with(['calonSiswa', 'jurusan', 'tes'])->findOrFail($id);
        return view('admin.input_nilai', compact('pendaftaran'));
    }

    public function simpanNilai(Request $request, $id)
    {
        $request->validate([
            'nilai_btq' => 'required|integer|min:0|max:100',
            'nilai_minat_bakat' => 'required|integer|min:0|max:100',
            'nilai_kejuruan' => 'required|integer|min:0|max:100',
            'status_btq' => 'required|in:Lulus,Tidak Lulus',
            'status_kelulusan' => 'required|in:Pending,Lulus,Tidak Lulus',
        ]);

        $pendaftaran = Pendaftaran::findOrFail($id);

        try {
            DB::transaction(function () use ($request, $pendaftaran) {
                // Update or Create Tes Record
                $tes = Tes::updateOrCreate(
                    ['pendaftaran_id' => $pendaftaran->id],
                    [
                        'nilai_btq' => $request->nilai_btq,
                        'nilai_minat_bakat' => $request->nilai_minat_bakat,
                        'nilai_kejuruan' => $request->nilai_kejuruan,
                        'status_btq' => $request->status_btq,
                        'status_kelulusan' => $request->status_kelulusan,
                    ]
                );

                // Update Pendaftaran Status
                $pendaftaran->update([
                    'status_pendaftaran' => 'Selesai Tes'
                ]);

                // Generate Pengumuman
                $keterangan = $request->status_kelulusan == 'Lulus' 
                    ? 'Selamat! Anda dinyatakan LULUS seleksi SPMB SMK Al-Hidayah Lestari.' 
                    : 'Mohon maaf, Anda dinyatakan TIDAK LULUS seleksi SPMB tahun ini.';

                Pengumuman::updateOrCreate(
                    ['pendaftaran_id' => $pendaftaran->id],
                    [
                        'keterangan' => $keterangan,
                        'tgl_pengumuman' => Carbon::now(),
                    ]
                );
            });
            
            // Send WA Notification (Outside transaction to prevent rollback of data if API fails, 
            // though here we are just logging, so it could be inside. Kept outside for best practice if using real API)
            if ($request->status_kelulusan != 'Pending') {
                try {
                    $this->whatsappService->sendKelulusanNotification(
                        $pendaftaran->calonSiswa->no_wa,
                        $pendaftaran->calonSiswa->nama,
                        strtoupper($request->status_kelulusan),
                        [
                            'btq' => $request->nilai_btq,
                            'minat' => $request->nilai_minat_bakat,
                            'kejuruan' => $request->nilai_kejuruan
                        ]
                    );
                } catch (\Exception $e) {
                    // Log error but don't fail the request
                    \Log::error('WA Notification failed: ' . $e->getMessage());
                }
            }

            return redirect()->route('admin.pendaftar.index')
                ->with('success', 'Nilai berhasil disimpan dan pengumuman telah dibuat.');

        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Export data pendaftar ke Excel (CSV format)
     */
    public function exportExcel(Request $request)
    {
        $query = CalonSiswa::with(['pendaftaran.jurusan', 'pendaftaran.tes', 'orangTua']);

        // Apply same filters as index
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('no_wa', 'like', "%{$search}%")
                  ->orWhere('nisn', 'like', "%{$search}%")
                  ->orWhereYear('tgl_lahir', $search);
            });
        }

        if ($request->filled('jurusan')) {
            $query->whereHas('pendaftaran', function ($q) use ($request) {
                $q->where('jurusan_id', $request->jurusan);
            });
        }

        if ($request->filled('status')) {
            $status = $request->status;
            if ($status === 'baru') {
                $query->whereDoesntHave('pendaftaran');
            } elseif ($status === 'proses_data') {
                $query->whereHas('pendaftaran')
                      ->where(function ($q) {
                          $q->whereNull('jk')
                            ->orWhereNull('tgl_lahir')
                            ->orWhereNull('alamat')
                            ->orWhereNull('asal_sekolah');
                      });
            } elseif ($status === 'proses_berkas') {
                $query->whereHas('pendaftaran')
                      ->whereNotNull('jk')
                      ->whereNotNull('tgl_lahir')
                      ->whereNotNull('alamat')
                      ->whereNotNull('asal_sekolah')
                      ->whereExists(function ($q) {
                          $q->select(DB::raw(1))
                            ->from('berkas_pendaftaran')
                            ->whereColumn('berkas_pendaftaran.calon_siswa_id', 'calon_siswa.id')
                            ->groupBy('calon_siswa_id')
                            ->havingRaw('COUNT(CASE WHEN path_file IS NOT NULL THEN 1 END) < 4');
                      });
            } elseif ($status === 'lengkap') {
                $query->whereHas('pendaftaran')
                      ->whereNotNull('jk')
                      ->whereNotNull('tgl_lahir')
                      ->whereNotNull('alamat')
                      ->whereNotNull('asal_sekolah')
                      ->whereExists(function ($q) {
                          $q->select(DB::raw(1))
                            ->from('berkas_pendaftaran')
                            ->whereColumn('berkas_pendaftaran.calon_siswa_id', 'calon_siswa.id')
                            ->groupBy('calon_siswa_id')
                            ->havingRaw('COUNT(CASE WHEN path_file IS NOT NULL THEN 1 END) = 4');
                      });
            }
        }

        $pendaftar = $query->orderBy('created_at', 'desc')->get();

        $filename = 'data_pendaftar_spmb_' . date('Y-m-d_His') . '.csv';
        
        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
        ];

        $callback = function () use ($pendaftar) {
            $file = fopen('php://output', 'w');
            
            // Add BOM for UTF-8
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));

            // Header row
            fputcsv($file, [
                'No',
                'NISN',
                'Nama Lengkap',
                'Jenis Kelamin',
                'Tanggal Lahir',
                'Asal Sekolah',
                'Alamat',
                'No. WhatsApp',
                'Nama Ayah',
                'Nama Ibu',
                'No. WA Ortu',
                'Jurusan Pilihan',
                'Gelombang',
                'Status Pendaftaran',
                'Nilai BTQ',
                'Nilai Minat Bakat',
                'Nilai Kejuruan',
                'Status BTQ',
                'Status Wawancara',
                'Status Kelulusan',
                'Tanggal Daftar'
            ]);

            // Data rows
            foreach ($pendaftar as $index => $siswa) {
                fputcsv($file, [
                    $index + 1,
                    $siswa->nisn,
                    $siswa->nama,
                    $siswa->jk == 'L' ? 'Laki-laki' : ($siswa->jk == 'P' ? 'Perempuan' : '-'),
                    $siswa->tgl_lahir ? $siswa->tgl_lahir->format('d/m/Y') : '-',
                    $siswa->asal_sekolah ?? '-',
                    $siswa->alamat ?? '-',
                    $siswa->no_wa ?? '-',
                    $siswa->orangTua->nama_ayah ?? '-',
                    $siswa->orangTua->nama_ibu ?? '-',
                    $siswa->orangTua->no_wa_ortu ?? '-',
                    $siswa->pendaftaran->jurusan->nama ?? 'Belum Memilih',
                    $siswa->pendaftaran->gelombang ?? '-',
                    $siswa->pendaftaran->status_pendaftaran ?? 'Belum Lengkap',
                    $siswa->pendaftaran->tes->nilai_btq ?? '-',
                    $siswa->pendaftaran->tes->nilai_minat_bakat ?? '-',
                    $siswa->pendaftaran->tes->nilai_kejuruan ?? '-',
                    $siswa->pendaftaran->tes->status_btq ?? '-',
                    $siswa->pendaftaran->tes->status_wawancara ?? 'belum',
                    $siswa->pendaftaran->tes->status_kelulusan ?? 'Pending',
                    $siswa->created_at->format('d/m/Y H:i')
                ]);
            }

            fclose($file);
        };

        return new StreamedResponse($callback, 200, $headers);
    }
}
