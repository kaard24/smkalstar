<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use App\Models\Tes;
use App\Models\Pengumuman;
use Illuminate\Http\Request;
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
        $tes = $pendaftaran?->tes;

        // Get latest pengumuman
        $pengumuman = Pengumuman::latest()->first();

        // Calculate registration completeness
        $biodataComplete = $siswa->isRegistrationComplete();
        $orangTuaComplete = $siswa->orangTua !== null;
        $jurusanSelected = $pendaftaran?->jurusan_id !== null;

        $completeness = [
            'biodata' => $biodataComplete,
            'orang_tua' => $orangTuaComplete,
            'jurusan' => $jurusanSelected,
            'percentage' => $this->calculateCompleteness($biodataComplete, $orangTuaComplete, $jurusanSelected),
        ];

        // Status timeline
        $timeline = $this->buildTimeline($siswa, $pendaftaran, $tes);

        return view('ppdb.dashboard', compact(
            'siswa',
            'pendaftaran',
            'tes',
            'pengumuman',
            'completeness',
            'timeline'
        ));
    }

    /**
     * Calculate registration completeness percentage
     */
    protected function calculateCompleteness(bool $biodata, bool $orangTua, bool $jurusan): int
    {
        $total = 3;
        $completed = ($biodata ? 1 : 0) + ($orangTua ? 1 : 0) + ($jurusan ? 1 : 0);
        return (int) round(($completed / $total) * 100);
    }

    /**
     * Build registration timeline
     */
    protected function buildTimeline($siswa, $pendaftaran, $tes): array
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
        if ($pendaftaran) {
            // Check if user has uploaded any berkas
            $hasBerkas = $siswa->berkasPendaftaran()->count() > 0;
            
            if ($hasBerkas) {
                $timeline[] = [
                    'title' => 'Upload Berkas',
                    'status' => 'completed',
                    'date' => $siswa->berkasPendaftaran()->latest()->first()->created_at->format('d M Y'),
                    'description' => 'Berkas berhasil diupload',
                ];
            } else {
                $timeline[] = [
                    'title' => 'Upload Berkas',
                    'status' => 'current',
                    'date' => null,
                    'description' => 'Silakan upload berkas pendaftaran',
                ];
            }
        }

        // 4. Test BTQ
        if ($tes) {
            if ($tes->nilai_btq !== null) {
                $timeline[] = [
                    'title' => 'Tes BTQ',
                    'status' => 'completed',
                    'date' => $tes->updated_at->format('d M Y'),
                    'description' => 'Nilai: ' . $tes->nilai_btq,
                ];
            } else {
                $timeline[] = [
                    'title' => 'Tes BTQ',
                    'status' => 'pending',
                    'date' => null,
                    'description' => 'Menunggu jadwal tes',
                ];
            }
        }

        // 5. Announcement
        if ($tes && $tes->status_kelulusan !== 'Pending') {
            $timeline[] = [
                'title' => 'Pengumuman',
                'status' => $tes->status_kelulusan === 'Lulus' ? 'completed' : 'rejected',
                'date' => $tes->updated_at->format('d M Y'),
                'description' => 'Status: ' . $tes->status_kelulusan,
            ];
        } else {
            $timeline[] = [
                'title' => 'Pengumuman',
                'status' => 'upcoming',
                'date' => null,
                'description' => 'Menunggu hasil seleksi',
            ];
        }

        return $timeline;
    }
}
