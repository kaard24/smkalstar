<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use App\Models\BerkasPendaftaran;
use App\Models\Pengumuman;
use Illuminate\Support\Facades\Auth;

class PpdbDashboardController extends Controller
{

    /**
     * Show PPDB Dashboard
     */
    public function index()
    {
        $siswa = Auth::guard('ppdb')->user();
        $siswa->load(['orangTua', 'pendaftaran.jurusan', 'pendaftaran.tes', 'berkasPendaftaran']);

        $pendaftaran = $siswa->pendaftaran;
        
        // Get berkas progress
        $berkasProgress = BerkasPendaftaran::getUploadProgress($siswa->id);

        // Get latest pengumuman
        $pengumuman = Pengumuman::latest()->first();

        // Calculate registration completeness (now includes berkas)
        $biodataComplete = $siswa->isRegistrationComplete();
        $orangTuaComplete = $siswa->orangTua !== null;
        $jurusanSelected = $pendaftaran?->jurusan_id !== null;
        $berkasComplete = $berkasProgress['is_complete'];

        $completeness = [
            'biodata' => $biodataComplete,
            'orang_tua' => $orangTuaComplete,
            'jurusan' => $jurusanSelected,
            'berkas' => $berkasComplete,
            'percentage' => $this->calculateCompleteness($biodataComplete, $orangTuaComplete, $jurusanSelected, $berkasComplete),
            'berkas_progress' => $berkasProgress,
        ];

        // Status timeline
        $timeline = $this->buildTimeline($siswa, $pendaftaran, $berkasProgress);

        return view('ppdb.dashboard', compact(
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
    protected function calculateCompleteness(bool $biodata, bool $orangTua, bool $jurusan, bool $berkas): int
    {
        $total = 4;
        $completed = ($biodata ? 1 : 0) + ($orangTua ? 1 : 0) + ($jurusan ? 1 : 0) + ($berkas ? 1 : 0);
        return (int) round(($completed / $total) * 100);
    }

    /**
     * Build registration timeline - Simplified version
     */
    protected function buildTimeline($siswa, $pendaftaran, array $berkasProgress): array
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

        // 4. Tes & Wawancara (gabungan, tanpa menunggu jadwal)
        if ($berkasProgress['is_complete']) {
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
                'description' => 'Lengkapi upload berkas terlebih dahulu',
            ];
        }

        // 5. Kelulusan - Berdasarkan status wawancara
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
