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
        $siswa->load(['orangTua', 'pendaftaran.jurusan', 'berkasPendaftaran']);

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

        // 4. Menunggu Jadwal Tes (diganti dari Tes BTQ)
        if ($berkasProgress['is_complete']) {
            $timeline[] = [
                'title' => 'Menunggu Jadwal Tes',
                'status' => 'current',
                'date' => null,
                'description' => 'Jadwal tes akan diinformasikan melalui WhatsApp',
            ];
        } else {
            $timeline[] = [
                'title' => 'Menunggu Jadwal Tes',
                'status' => 'upcoming',
                'date' => null,
                'description' => 'Lengkapi upload berkas terlebih dahulu',
            ];
        }

        // 5. Tes & Wawancara (Offline)
        $timeline[] = [
            'title' => 'Tes & Wawancara',
            'status' => 'upcoming',
            'date' => null,
            'description' => 'Dilaksanakan offline di sekolah',
        ];

        // 6. Kelulusan - Semua siswa lulus
        $timeline[] = [
            'title' => 'Kelulusan',
            'status' => 'upcoming',
            'date' => null,
            'description' => 'Selamat! Semua siswa diterima',
        ];

        return $timeline;
    }
}
