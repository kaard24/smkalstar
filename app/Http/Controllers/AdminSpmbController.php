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
use Illuminate\Support\Facades\Hash;
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

        // Search functionality (nama, nisn, no_wa, asal_sekolah)
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('no_wa', 'like', "%{$search}%")
                  ->orWhere('nisn', 'like', "%{$search}%")
                  ->orWhere('asal_sekolah', 'like', "%{$search}%")
                  ->orWhereYear('tgl_lahir', $search);
            });
        }

        // Filter by jurusan
        if ($request->filled('jurusan')) {
            $query->whereHas('pendaftaran', function ($q) use ($request) {
                $q->where('jurusan_id', $request->jurusan);
            });
        }

        // Filter by gender/jk
        if ($request->filled('gender') && in_array($request->gender, ['L', 'P'])) {
            $query->where('jk', $request->gender);
        }

        // Filter by asal sekolah (specific)
        if ($request->filled('asal_sekolah')) {
            $query->where('asal_sekolah', 'like', "%{$request->asal_sekolah}%");
        }

        // Filter by tanggal daftar range
        if ($request->filled('tgl_dari')) {
            $query->whereDate('created_at', '>=', $request->tgl_dari);
        }
        if ($request->filled('tgl_sampai')) {
            $query->whereDate('created_at', '<=', $request->tgl_sampai);
        }

        // Filter by status pendaftaran
        if ($request->filled('status')) {
            $status = $request->status;
            if ($status === 'baru') {
                // Siswa yang belum punya pendaftaran
                $query->whereDoesntHave('pendaftaran');
            } elseif ($status === 'proses_data') {
                // Siswa yang sudah punya pendaftaran tapi data belum lengkap
                $query->whereHas('pendaftaran')->where(function ($q) {
                    $q->whereNull('jk')
                      ->orWhereNull('tgl_lahir')
                      ->orWhereNull('alamat')
                      ->orWhereNull('asal_sekolah')
                      ->orWhereNull('nik')
                      ->orWhereNull('no_kk')
                      ->orWhereNull('tempat_lahir');
                });
            } elseif ($status === 'proses_berkas') {
                // Data lengkap tapi berkas belum lengkap (< 3 berkas)
                $query->whereHas('pendaftaran')
                      ->whereNotNull('jk')
                      ->whereNotNull('tgl_lahir')
                      ->whereNotNull('alamat')
                      ->whereNotNull('asal_sekolah')
                      ->whereNotNull('nik')
                      ->whereNotNull('no_kk')
                      ->whereNotNull('tempat_lahir')
                      ->where(function ($q) {
                          $q->whereDoesntHave('berkasPendaftaran')
                            ->orWhereHas('berkasPendaftaran', function ($sub) {
                                $sub->whereNotNull('path_file');
                            }, '<', 3);
                      });
            } elseif ($status === 'menunggu_pembayaran') {
                // Berkas lengkap tapi belum bayar
                $query->whereHas('pendaftaran', function ($q) {
                    $q->where('status_pendaftaran', 'Menunggu Pembayaran');
                })->whereHas('berkasPendaftaran', function ($q) {
                    $q->whereNotNull('path_file');
                }, '>=', 3)
                  ->whereDoesntHave('pembayaran');
            } elseif ($status === 'menunggu_verifikasi_pembayaran') {
                // Sudah bayar, menunggu verifikasi
                $query->whereHas('pembayaran', function ($q) {
                    $q->where('status', 'pending');
                });
            } elseif ($status === 'pembayaran_diverifikasi') {
                // Pembayaran sudah diverifikasi
                $query->whereHas('pembayaran', function ($q) {
                    $q->where('status', 'verified');
                });
            } elseif ($status === 'lengkap') {
                // Data lengkap dan berkas lengkap (3 berkas) tapi belum lulus
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
                      }, '>=', 3)
                      ->where(function ($q) {
                          $q->whereDoesntHave('pendaftaran.tes')
                            ->orWhereHas('pendaftaran.tes', function ($sub) {
                                $sub->where('status_kelulusan', '!=', 'Lulus');
                            });
                      });
            } elseif ($status === 'lulus') {
                // Siswa yang sudah lulus
                $query->whereHas('pendaftaran.tes', function ($q) {
                    $q->where('status_kelulusan', 'Lulus');
                });
            }
        }

        // Filter by upload berkas (total 3 jenis: KK, AKTA, SKL_IJAZAH)
        if ($request->filled('berkas')) {
            $berkas = $request->berkas;
            if ($berkas === 'belum') {
                // Belum upload sama sekali
                $query->whereDoesntHave('berkasPendaftaran');
            } elseif ($berkas === 'sebagian') {
                // Sudah upload sebagian (1-2 file)
                $query->whereHas('berkasPendaftaran', function ($q) {
                    $q->whereNotNull('path_file');
                }, '>=', 1)
                ->whereHas('berkasPendaftaran', function ($q) {
                    $q->whereNotNull('path_file');
                }, '<=', 2);
            } elseif ($berkas === 'lengkap') {
                // Sudah upload lengkap (3 file: KK, AKTA, SKL_IJAZAH)
                $query->whereHas('berkasPendaftaran', function ($q) {
                    $q->whereNotNull('path_file');
                }, '>=', 3);
            }
        }

        // Filter by kelulusan
        if ($request->filled('kelulusan')) {
            $kelulusan = $request->kelulusan;
            if ($kelulusan === 'pending') {
                // Belum ada keputusan (belum ada tes atau status Pending)
                $query->where(function ($q) {
                    $q->whereDoesntHave('pendaftaran.tes')
                      ->orWhereHas('pendaftaran.tes', function ($sub) {
                          $sub->where('status_kelulusan', 'Pending')
                              ->orWhereNull('status_kelulusan');
                      });
                });
            } elseif ($kelulusan === 'lulus') {
                // Sudah lulus
                $query->whereHas('pendaftaran.tes', function ($q) {
                    $q->where('status_kelulusan', 'Lulus');
                });
            } elseif ($kelulusan === 'tidak_lulus') {
                // Tidak lulus
                $query->whereHas('pendaftaran.tes', function ($q) {
                    $q->where('status_kelulusan', 'Tidak Lulus');
                });
            }
        }

        // Filter by status wawancara
        if ($request->filled('wawancara')) {
            $wawancara = $request->wawancara;
            if ($wawancara === 'belum') {
                $query->whereHas('pendaftaran')
                      ->where(function ($q) {
                          $q->whereDoesntHave('pendaftaran.tes')
                            ->orWhereHas('pendaftaran.tes', function ($q2) {
                                $q2->where('status_wawancara', 'belum');
                            });
                      });
            } elseif ($wawancara === 'sudah') {
                $query->whereHas('pendaftaran.tes', function ($q) {
                    $q->where('status_wawancara', 'sudah');
                });
            }
        }

        $pendaftar = $query->orderBy('created_at', 'desc')->paginate(15);
        $pendaftar->appends($request->query());

        $jurusanList = Jurusan::all();
        
        // Get unique asal sekolah for autocomplete
        $asalSekolahList = CalonSiswa::whereNotNull('asal_sekolah')
            ->distinct()
            ->pluck('asal_sekolah')
            ->filter()
            ->take(50);
            
        return view('admin.pendaftar', compact('pendaftar', 'jurusanList', 'asalSekolahList'));
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
            'password' => 'nullable|string|min:8',
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
                    'password' => $request->password ? Hash::make($request->password) : $siswa->password,
                    'password_plain' => $request->password ?? $siswa->password_plain,
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

                    // Update or Create Tes (Status Wawancara)
                    if ($request->has('status_wawancara')) {
                        $statusKelulusan = $request->status_wawancara === 'sudah' ? 'Lulus' : 'Pending';
                        
                        Tes::updateOrCreate(
                            ['pendaftaran_id' => $pendaftaran->id],
                            [
                                'status_wawancara' => $request->status_wawancara,
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
                  ->orWhere('asal_sekolah', 'like', "%{$search}%")
                  ->orWhereYear('tgl_lahir', $search);
            });
        }

        // Filter by jurusan
        if ($request->filled('jurusan')) {
            $query->whereHas('pendaftaran', function ($q) use ($request) {
                $q->where('jurusan_id', $request->jurusan);
            });
        }

        // Filter by gender
        if ($request->filled('gender') && in_array($request->gender, ['L', 'P'])) {
            $query->where('jk', $request->gender);
        }

        // Filter by asal sekolah
        if ($request->filled('asal_sekolah')) {
            $query->where('asal_sekolah', 'like', "%{$request->asal_sekolah}%");
        }

        // Filter by tanggal range
        if ($request->filled('tgl_dari')) {
            $query->whereDate('created_at', '>=', $request->tgl_dari);
        }
        if ($request->filled('tgl_sampai')) {
            $query->whereDate('created_at', '<=', $request->tgl_sampai);
        }

        // Filter by status pendaftaran
        if ($request->filled('status')) {
            $status = $request->status;
            if ($status === 'baru') {
                $query->whereDoesntHave('pendaftaran');
            } elseif ($status === 'proses_data') {
                $query->whereHas('pendaftaran')->where(function ($q) {
                    $q->whereNull('jk')->orWhereNull('tgl_lahir')->orWhereNull('alamat')
                      ->orWhereNull('asal_sekolah')->orWhereNull('nik')->orWhereNull('no_kk')->orWhereNull('tempat_lahir');
                });
            } elseif ($status === 'proses_berkas') {
                $query->whereHas('pendaftaran')->whereNotNull('jk')->whereNotNull('tgl_lahir')
                      ->whereNotNull('alamat')->whereNotNull('asal_sekolah')->whereNotNull('nik')
                      ->whereNotNull('no_kk')->whereNotNull('tempat_lahir')
                      ->where(function ($q) {
                          $q->whereDoesntHave('berkasPendaftaran')
                            ->orWhereHas('berkasPendaftaran', function ($sub) { $sub->whereNotNull('path_file'); }, '<', 3);
                      });
            } elseif ($status === 'lengkap') {
                $query->whereHas('pendaftaran')->whereNotNull('jk')->whereNotNull('tgl_lahir')
                      ->whereNotNull('alamat')->whereNotNull('asal_sekolah')->whereNotNull('nik')
                      ->whereNotNull('no_kk')->whereNotNull('tempat_lahir')
                      ->whereHas('berkasPendaftaran', function ($q) { $q->whereNotNull('path_file'); }, '>=', 3)
                      ->where(function ($q) {
                          $q->whereDoesntHave('pendaftaran.tes')
                            ->orWhereHas('pendaftaran.tes', function ($sub) { $sub->where('status_kelulusan', '!=', 'Lulus'); });
                      });
            } elseif ($status === 'lulus') {
                $query->whereHas('pendaftaran.tes', function ($q) { $q->where('status_kelulusan', 'Lulus'); });
            }
        }

        // Filter by upload berkas (total 3 jenis)
        if ($request->filled('berkas')) {
            $berkas = $request->berkas;
            if ($berkas === 'belum') {
                $query->whereDoesntHave('berkasPendaftaran');
            } elseif ($berkas === 'sebagian') {
                $query->whereHas('berkasPendaftaran', function ($q) { $q->whereNotNull('path_file'); }, '>=', 1)
                      ->whereHas('berkasPendaftaran', function ($q) { $q->whereNotNull('path_file'); }, '<=', 2);
            } elseif ($berkas === 'lengkap') {
                $query->whereHas('berkasPendaftaran', function ($q) { $q->whereNotNull('path_file'); }, '>=', 3);
            }
        }

        // Filter by kelulusan
        if ($request->filled('kelulusan')) {
            $kelulusan = $request->kelulusan;
            if ($kelulusan === 'pending') {
                $query->where(function ($q) {
                    $q->whereDoesntHave('pendaftaran.tes')
                      ->orWhereHas('pendaftaran.tes', function ($sub) { $sub->where('status_kelulusan', 'Pending')->orWhereNull('status_kelulusan'); });
                });
            } elseif ($kelulusan === 'lulus') {
                $query->whereHas('pendaftaran.tes', function ($q) { $q->where('status_kelulusan', 'Lulus'); });
            } elseif ($kelulusan === 'tidak_lulus') {
                $query->whereHas('pendaftaran.tes', function ($q) { $q->where('status_kelulusan', 'Tidak Lulus'); });
            }
        }

        // Filter by wawancara
        if ($request->filled('wawancara')) {
            $wawancara = $request->wawancara;
            if ($wawancara === 'belum') {
                $query->whereHas('pendaftaran')->where(function ($q) {
                    $q->whereDoesntHave('pendaftaran.tes')->orWhereHas('pendaftaran.tes', function ($q2) { $q2->where('status_wawancara', 'belum'); });
                });
            } elseif ($wawancara === 'sudah') {
                $query->whereHas('pendaftaran.tes', function ($q) { $q->where('status_wawancara', 'sudah'); });
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
                'Nilai Minat Bakat',
                'Status Wawancara',
                'Status Kelulusan',
                'Tanggal Daftar'
            ]);

            // Data rows
            foreach ($pendaftar as $index => $siswa) {
                // Safely access nested relationships
                $pendaftaran = $siswa->pendaftaran;
                $jurusan = $pendaftaran?->jurusan;
                $tes = $pendaftaran?->tes;
                $orangTua = $siswa->orangTua;
                
                fputcsv($file, [
                    $index + 1,
                    "'" . $siswa->nisn,
                    $siswa->nama,
                    $siswa->jk == 'L' ? 'Laki-laki' : ($siswa->jk == 'P' ? 'Perempuan' : '-'),
                    $siswa->tgl_lahir ? $siswa->tgl_lahir->format('d/m/Y') : '-',
                    $siswa->asal_sekolah ?? '-',
                    $siswa->alamat ?? '-',
                    $siswa->no_wa ? "'" . $siswa->no_wa : '-',
                    $orangTua?->nama_ayah ?? '-',
                    $orangTua?->nama_ibu ?? '-',
                    $orangTua?->no_wa_ortu ? "'" . $orangTua->no_wa_ortu : '-',
                    $jurusan?->nama ?? 'Belum Memilih',
                    $pendaftaran?->gelombang ?? '-',
                    $pendaftaran?->status_pendaftaran ?? 'Belum Lengkap',
                    $tes?->nilai_minat_bakat ?? '-',
                    $tes?->status_wawancara ?? 'belum',
                    $tes?->status_kelulusan ?? 'Pending',
                    $siswa->created_at?->format('d/m/Y H:i') ?? '-'
                ]);
            }

            fclose($file);
        };

        return new StreamedResponse($callback, 200, $headers);
    }

    /**
     * Bulk delete pendaftar
     */
    public function bulkDelete(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'required|integer|exists:calon_siswa,id',
        ]);

        $ids = $request->ids;
        $count = count($ids);

        try {
            DB::transaction(function () use ($ids) {
                $siswaList = CalonSiswa::whereIn('id', $ids)->get();
                
                foreach ($siswaList as $siswa) {
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
                }
            });

            return redirect()->route('admin.pendaftar.index')
                ->with('success', "{$count} data calon siswa berhasil dihapus.");

        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Bulk export pendaftar terpilih
     */
    public function bulkExport(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'required|integer|exists:calon_siswa,id',
        ]);

        $ids = $request->ids;
        
        $pendaftar = CalonSiswa::with(['pendaftaran.jurusan', 'pendaftaran.tes', 'orangTua'])
            ->whereIn('id', $ids)
            ->orderBy('created_at', 'desc')
            ->get();

        $filename = 'data_pendaftar_terpilih_' . date('Y-m-d_His') . '.csv';
        
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
                'Nilai Minat Bakat',
                'Status Wawancara',
                'Status Kelulusan',
                'Tanggal Daftar'
            ]);

            // Data rows
            foreach ($pendaftar as $index => $siswa) {
                // Safely access nested relationships
                $pendaftaran = $siswa->pendaftaran;
                $jurusan = $pendaftaran?->jurusan;
                $tes = $pendaftaran?->tes;
                $orangTua = $siswa->orangTua;
                
                fputcsv($file, [
                    $index + 1,
                    "'" . $siswa->nisn,
                    $siswa->nama,
                    $siswa->jk == 'L' ? 'Laki-laki' : ($siswa->jk == 'P' ? 'Perempuan' : '-'),
                    $siswa->tgl_lahir ? $siswa->tgl_lahir->format('d/m/Y') : '-',
                    $siswa->asal_sekolah ?? '-',
                    $siswa->alamat ?? '-',
                    $siswa->no_wa ? "'" . $siswa->no_wa : '-',
                    $orangTua?->nama_ayah ?? '-',
                    $orangTua?->nama_ibu ?? '-',
                    $orangTua?->no_wa_ortu ? "'" . $orangTua->no_wa_ortu : '-',
                    $jurusan?->nama ?? 'Belum Memilih',
                    $pendaftaran?->gelombang ?? '-',
                    $pendaftaran?->status_pendaftaran ?? 'Belum Lengkap',
                    $tes?->nilai_minat_bakat ?? '-',
                    $tes?->status_wawancara ?? 'belum',
                    $tes?->status_kelulusan ?? 'Pending',
                    $siswa->created_at?->format('d/m/Y H:i') ?? '-'
                ]);
            }

            fclose($file);
        };

        return new StreamedResponse($callback, 200, $headers);
    }

    /**
     * Bulk update status pendaftar
     */
    public function bulkUpdateStatus(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'required|integer|exists:calon_siswa,id',
            'status' => 'required|in:baru,proses_data,proses_berkas,lengkap,lulus',
        ]);

        $ids = $request->ids;
        $status = $request->status;
        $count = 0;

        try {
            DB::transaction(function () use ($ids, $status, &$count) {
                $siswaList = CalonSiswa::with('pendaftaran')->whereIn('id', $ids)->get();
                
                foreach ($siswaList as $siswa) {
                    // Pastikan siswa memiliki pendaftaran
                    if (!$siswa->pendaftaran) {
                        continue;
                    }
                    
                    $pendaftaran = $siswa->pendaftaran;
                    
                    switch ($status) {
                        case 'lulus':
                            // Update atau buat record tes dengan status lulus
                            Tes::updateOrCreate(
                                ['pendaftaran_id' => $pendaftaran->id],
                                [
                                    'status_wawancara' => 'sudah',
                                    'status_kelulusan' => 'Lulus',
                                ]
                            );
                            
                            // Update status pendaftaran
                            $pendaftaran->update(['status_pendaftaran' => 'Selesai Tes']);
                            
                            // Buat pengumuman
                            Pengumuman::updateOrCreate(
                                ['pendaftaran_id' => $pendaftaran->id],
                                [
                                    'keterangan' => 'Selamat! Anda dinyatakan LULUS seleksi SPMB SMK Al-Hidayah Lestari.',
                                    'tgl_pengumuman' => Carbon::now(),
                                ]
                            );
                            $count++;
                            break;
                            
                        case 'lengkap':
                            // Update status pendaftaran
                            $pendaftaran->update(['status_pendaftaran' => 'Diverifikasi']);
                            $count++;
                            break;
                            
                        case 'proses_berkas':
                            $pendaftaran->update(['status_pendaftaran' => 'Menunggu Verifikasi']);
                            $count++;
                            break;
                            
                        case 'proses_data':
                            $pendaftaran->update(['status_pendaftaran' => 'Terdaftar']);
                            $count++;
                            break;
                            
                        case 'baru':
                            $pendaftaran->update(['status_pendaftaran' => 'Terdaftar']);
                            $count++;
                            break;
                    }
                }
            });

            $statusLabel = [
                'baru' => 'Baru Daftar',
                'proses_data' => 'Proses Data',
                'proses_berkas' => 'Proses Berkas',
                'lengkap' => 'Data Lengkap',
                'lulus' => 'Sudah Lulus',
            ][$status];

            return redirect()->route('admin.pendaftar.index')
                ->with('success', "{$count} data berhasil diupdate status menjadi '{$statusLabel}'.");

        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Bulk send WhatsApp notification
     */
    public function bulkSendWA(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'required|integer|exists:calon_siswa,id',
            'pesan' => 'required|string|max:1000',
        ]);

        $ids = $request->ids;
        $pesan = $request->pesan;
        $successCount = 0;
        $failedCount = 0;

        try {
            $siswaList = CalonSiswa::with('pendaftaran.jurusan')->whereIn('id', $ids)->get();
            
            foreach ($siswaList as $siswa) {
                if (!$siswa->no_wa) {
                    $failedCount++;
                    continue;
                }
                
                try {
                    // Kirim notifikasi WA
                    $this->whatsappService->sendNotification(
                        $siswa->no_wa,
                        $this->formatPesanWA($pesan, $siswa)
                    );
                    $successCount++;
                } catch (\Exception $e) {
                    \Log::error("WA Notification failed for {$siswa->no_wa}: " . $e->getMessage());
                    $failedCount++;
                }
            }

            $message = "Notifikasi WA terkirim: {$successCount} sukses";
            if ($failedCount > 0) {
                $message .= ", {$failedCount} gagal";
            }

            return redirect()->route('admin.pendaftar.index')
                ->with('success', $message);

        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Format pesan WA dengan variabel
     */
    private function formatPesanWA($pesan, $siswa)
    {
        $replacements = [
            '{nama}' => $siswa->nama,
            '{nisn}' => $siswa->nisn,
            '{jurusan}' => $siswa->pendaftaran->jurusan->nama ?? '-',
            '{status}' => $siswa->pendaftaran->status_pendaftaran ?? '-',
        ];
        
        return str_replace(array_keys($replacements), array_values($replacements), $pesan);
    }
}
