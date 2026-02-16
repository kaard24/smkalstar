<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use App\Models\BerkasPendaftaran;
use App\Models\Pembayaran;
use App\Models\Pengumuman;
use Illuminate\Support\Facades\Auth;

class SpmbDashboardController extends Controller
{

    /**
     * Show SPMB Dashboard
     */
    public function index()
    {
        $siswa = Auth::guard('spmb')->user();
        $siswa->load(['orangTua', 'pendaftaran.jurusan', 'pendaftaran.tes', 'berkasPendaftaran', 'pembayaran']);

        $pendaftaran = $siswa->pendaftaran;
        
        // Get berkas progress
        $berkasProgress = BerkasPendaftaran::getUploadProgress($siswa->id);

        // Get latest pengumuman
        $pengumuman = Pengumuman::latest()->first();

        // Get pembayaran from loaded relation
        $pembayaran = $siswa->pembayaran;
        $pembayaranComplete = $pembayaran && $pembayaran->isVerified();

        // Calculate registration completeness (now includes berkas and pembayaran)
        $biodataComplete = $siswa->isRegistrationComplete();
        $orangTuaComplete = $siswa->orangTua !== null;
        $jurusanSelected = $pendaftaran?->jurusan_id !== null;
        $berkasComplete = $berkasProgress['is_complete'];

        $completeness = [
            'biodata' => $biodataComplete,
            'orang_tua' => $orangTuaComplete,
            'jurusan' => $jurusanSelected,
            'berkas' => $berkasComplete,
            'pembayaran' => $pembayaranComplete,
            'percentage' => $this->calculateCompleteness($biodataComplete, $orangTuaComplete, $jurusanSelected, $berkasComplete, $pembayaranComplete),
            'berkas_progress' => $berkasProgress,
            'pembayaran_status' => $pembayaran?->status ?? null,
        ];

        // Status timeline
        $timeline = $this->buildTimeline($siswa, $pendaftaran, $berkasProgress, $pembayaran);

        return view('spmb.dashboard', compact(
            'siswa',
            'pendaftaran',
            'pengumuman',
            'completeness',
            'timeline',
            'berkasProgress'
        ));
    }

    /**
     * Calculate registration completeness percentage
     */
    protected function calculateCompleteness(bool $biodata, bool $orangTua, bool $jurusan, bool $berkas, bool $pembayaran = false): int
    {
        $total = 5;
        $completed = ($biodata ? 1 : 0) + ($orangTua ? 1 : 0) + ($jurusan ? 1 : 0) + ($berkas ? 1 : 0) + ($pembayaran ? 1 : 0);
        return (int) round(($completed / $total) * 100);
    }

    /**
     * Build registration timeline - Simplified version
     */
    protected function buildTimeline($siswa, $pendaftaran, array $berkasProgress, ?Pembayaran $pembayaran): array
    {
        $timeline = [];
        $tes = $pendaftaran?->tes;

        // 1. Registration
        $timeline[] = [
            'title' => 'Pendaftaran Akun',
            'status' => 'completed',
            'date' => $siswa->created_at->format('d M Y'),
            'description' => 'Akun berhasil dibuat',
        ];

        // 2. Biodata
        if ($siswa->isRegistrationComplete()) {
            $timeline[] = [
                'title' => 'Biodata Lengkap',
                'status' => 'completed',
                'date' => $siswa->updated_at->format('d M Y'),
                'description' => 'Data diri telah dilengkapi',
            ];
        } else {
            $timeline[] = [
                'title' => 'Lengkapi Biodata',
                'status' => 'current',
                'date' => null,
                'description' => 'Silakan lengkapi data diri Anda',
            ];
        }

        // 3. Upload Berkas
        if ($berkasProgress['is_complete']) {
            $timeline[] = [
                'title' => 'Upload Berkas',
                'status' => 'completed',
                'date' => $siswa->berkasPendaftaran()->latest()->first()?->created_at->format('d M Y'),
                'description' => 'Semua berkas telah diupload (' . $berkasProgress['uploaded'] . '/' . $berkasProgress['total'] . ')',
            ];
        } else {
            $currentStep = $siswa->isRegistrationComplete() ? 'current' : 'upcoming';
            $timeline[] = [
                'title' => 'Upload Berkas',
                'status' => $currentStep,
                'date' => null,
                'description' => 'Progress: ' . $berkasProgress['uploaded'] . ' dari ' . $berkasProgress['total'] . ' berkas',
            ];
        }

        // 4. Pembayaran
        if ($berkasProgress['is_complete']) {
            if ($pembayaran && $pembayaran->isVerified()) {
                $timeline[] = [
                    'title' => 'Pembayaran',
                    'status' => 'completed',
                    'date' => $pembayaran->verified_at?->format('d M Y') ?? $pembayaran->updated_at->format('d M Y'),
                    'description' => 'Pembayaran telah diverifikasi',
                ];
            } elseif ($pembayaran && $pembayaran->isPending()) {
                $timeline[] = [
                    'title' => 'Pembayaran',
                    'status' => 'current',
                    'date' => null,
                    'description' => 'Menunggu verifikasi pembayaran',
                ];
            } elseif ($pembayaran && $pembayaran->isRejected()) {
                $timeline[] = [
                    'title' => 'Pembayaran',
                    'status' => 'current',
                    'date' => null,
                    'description' => 'Pembayaran ditolak, silakan upload ulang',
                ];
            } else {
                $timeline[] = [
                    'title' => 'Pembayaran',
                    'status' => 'current',
                    'date' => null,
                    'description' => 'Silakan lakukan pembayaran',
                ];
            }
        } else {
            $timeline[] = [
                'title' => 'Pembayaran',
                'status' => 'upcoming',
                'date' => null,
                'description' => 'Lengkapi upload berkas terlebih dahulu',
            ];
        }

        // 5. Tes & Wawancara
        if ($pembayaran && $pembayaran->isVerified()) {
            $tesStatus = $tes?->status_wawancara ?? 'belum';
            if ($tesStatus === 'sudah') {
                $timeline[] = [
                    'title' => 'Tes & Wawancara',
                    'status' => 'completed',
                    'date' => $tes?->updated_at?->format('d M Y') ?? '-',
                    'description' => 'Tes dan wawancara telah selesai dilaksanakan',
                ];
            } else {
                $timeline[] = [
                    'title' => 'Tes & Wawancara',
                    'status' => 'current',
                    'date' => null,
                    'description' => 'Menunggu pelaksanaan tes dan wawancara',
                ];
            }
        } else {
            $timeline[] = [
                'title' => 'Tes & Wawancara',
                'status' => 'upcoming',
                'date' => null,
                'description' => 'Selesaikan pembayaran terlebih dahulu',
            ];
        }

        // 6. Kelulusan - Berdasarkan status wawancara
        if ($tes?->status_wawancara === 'sudah') {
            $statusKelulusan = $tes?->status_kelulusan ?? 'Lulus';
            $timeline[] = [
                'title' => 'Kelulusan',
                'status' => 'completed',
                'date' => $tes?->updated_at?->format('d M Y') ?? '-',
                'description' => $statusKelulusan === 'Lulus' 
                    ? 'Selamat! Anda dinyatakan LULUS' 
                    : 'Anda dinyatakan TIDAK LULUS',
            ];
        } else {
            $timeline[] = [
                'title' => 'Kelulusan',
                'status' => 'upcoming',
                'date' => null,
                'description' => 'Menunggu selesainya tes dan wawancara',
            ];
        }

        return $timeline;
    }
}
