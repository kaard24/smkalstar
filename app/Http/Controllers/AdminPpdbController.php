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

class AdminPpdbController extends Controller
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

        // Filter by status
        if ($request->filled('status')) {
            $status = $request->status;
            if ($status === 'baru') {
                // Siswa yang belum punya pendaftaran
                $query->whereDoesntHave('pendaftaran');
            } elseif ($status === 'proses_data') {
                // Siswa yang sudah punya pendaftaran tapi data belum lengkap
                $query->whereHas('pendaftaran')
                      ->where(function ($q) {
                          $q->whereNull('jk')
                            ->orWhereNull('tgl_lahir')
                            ->orWhereNull('alamat')
                            ->orWhereNull('asal_sekolah');
                      });
            } elseif ($status === 'proses_berkas') {
                // Siswa yang data sudah lengkap tapi berkas belum lengkap
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
                            ->havingRaw('COUNT(CASE WHEN file_path IS NOT NULL THEN 1 END) < 4');
                      });
            } elseif ($status === 'lengkap') {
                // Siswa yang data lengkap dan berkas lengkap
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
                            ->havingRaw('COUNT(CASE WHEN file_path IS NOT NULL THEN 1 END) = 4');
                      });
            }
        }

        $pendaftar = $query->orderBy('created_at', 'desc')->paginate(15);
        $pendaftar->appends($request->query()); // Preserve query params in pagination

        $jurusanList = Jurusan::all();
            
        return view('admin.pendaftar', compact('pendaftar', 'jurusanList'));
    }

    public function show($id)
    {
        $siswa = CalonSiswa::with(['orangTua', 'berkasPendaftaran', 'pendaftaran.jurusan'])->findOrFail($id);
        
        return view('admin.pendaftar-show', compact('siswa'));
    }

    public function edit($id)
    {
        $siswa = CalonSiswa::with(['orangTua', 'pendaftaran.jurusan'])->findOrFail($id);
        $jurusan = Jurusan::all();
        
        return view('admin.pendaftar-edit', compact('siswa', 'jurusan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jk' => 'nullable|in:L,P',
            'jurusan_id' => 'nullable|exists:jurusan,id',
        ]);

        $siswa = CalonSiswa::with('pendaftaran')->findOrFail($id);

        try {
            DB::transaction(function () use ($request, $siswa) {
                // Update CalonSiswa
                $siswa->update([
                    'nama' => $request->nama,
                    'jk' => $request->jk,
                    'tgl_lahir' => $request->tgl_lahir,
                    'asal_sekolah' => $request->asal_sekolah,
                    'alamat' => $request->alamat,
                    'no_wa' => $request->no_wa,
                ]);

                // Update or Create OrangTua
                if ($request->nama_ayah || $request->nama_ibu) {
                    OrangTua::updateOrCreate(
                        ['calon_siswa_id' => $siswa->id],
                        [
                            'nama_ayah' => $request->nama_ayah,
                            'nama_ibu' => $request->nama_ibu,
                            'pekerjaan' => $request->pekerjaan,
                            'no_wa_ortu' => $request->no_wa_ortu,
                        ]
                    );
                }

                // Update or Create Pendaftaran if jurusan selected
                if ($request->jurusan_id) {
                    Pendaftaran::updateOrCreate(
                        ['calon_siswa_id' => $siswa->id],
                        [
                            'jurusan_id' => $request->jurusan_id,
                            'gelombang' => $request->gelombang,
                            'status_pendaftaran' => 'Terdaftar',
                        ]
                    );
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
                    ? 'Selamat! Anda dinyatakan LULUS seleksi PPDB SMK Al-Hidayah Lestari.' 
                    : 'Mohon maaf, Anda dinyatakan TIDAK LULUS seleksi PPDB tahun ini.';

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
                            ->havingRaw('COUNT(CASE WHEN file_path IS NOT NULL THEN 1 END) < 4');
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
                            ->havingRaw('COUNT(CASE WHEN file_path IS NOT NULL THEN 1 END) = 4');
                      });
            }
        }

        $pendaftar = $query->orderBy('created_at', 'desc')->get();

        $filename = 'data_pendaftar_ppdb_' . date('Y-m-d_His') . '.csv';
        
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
                    $siswa->pendaftaran->tes->status_kelulusan ?? 'Pending',
                    $siswa->created_at->format('d/m/Y H:i')
                ]);
            }

            fclose($file);
        };

        return new StreamedResponse($callback, 200, $headers);
    }
}
