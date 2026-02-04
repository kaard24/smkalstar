<?php

namespace App\Http\Controllers;

use App\Models\CalonSiswa;
use App\Models\BerkasPendaftaran;
use App\Models\Pendaftaran;
use App\Models\Jurusan;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Cache statistics for 5 minutes
        $stats = Cache::remember('admin_dashboard_stats', 300, function () {
            return $this->calculateStatistics();
        });

        // Statistik per Jurusan dengan nama jurusan
        $statsJurusan = Jurusan::withCount('pendaftaran')
            ->orderBy('pendaftaran_count', 'desc')
            ->get();

        // Top 10 Asal Sekolah
        $topSekolah = CalonSiswa::select('asal_sekolah', DB::raw('count(*) as total'))
            ->whereNotNull('asal_sekolah')
            ->groupBy('asal_sekolah')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->get();

        // Data untuk grafik pendaftar per minggu (6 minggu terakhir)
        $weeklyData = $this->getWeeklyRegistrationData();

        // Peak hours data
        $peakHours = $this->getPeakHoursData();

        // Geographic distribution
        $geoDistribution = $this->getGeographicDistribution();

        return view('admin.dashboard', array_merge($stats, [
            'statsJurusan' => $statsJurusan,
            'topSekolah' => $topSekolah,
            'weeklyData' => $weeklyData,
            'peakHours' => $peakHours,
            'geoDistribution' => $geoDistribution,
        ]));
    }

    private function calculateStatistics()
    {
        $now = Carbon::now();
        $lastMonth = Carbon::now()->subMonth();

        // Total Pendaftar
        $totalPendaftar = CalonSiswa::count();
        $totalPendaftarLastMonth = CalonSiswa::whereDate('created_at', '<=', $lastMonth)->count();
        $totalPendaftarGrowth = $this->calculateGrowth($totalPendaftar, $totalPendaftarLastMonth);

        // Data Lengkap (biodata lengkap)
        $dataLengkap = CalonSiswa::whereHas('pendaftaran')
            ->whereNotNull('jk')
            ->whereNotNull('tgl_lahir')
            ->whereNotNull('alamat')
            ->whereNotNull('asal_sekolah')
            ->whereNotNull('nik')
            ->whereNotNull('no_kk')
            ->whereNotNull('tempat_lahir')
            ->count();
        $dataLengkapLastMonth = CalonSiswa::whereHas('pendaftaran')
            ->whereNotNull('jk')
            ->whereNotNull('tgl_lahir')
            ->whereDate('created_at', '<=', $lastMonth)
            ->count();
        $dataLengkapGrowth = $this->calculateGrowth($dataLengkap, $dataLengkapLastMonth);

        // Berkas Lengkap
        $totalBerkasRequired = count(BerkasPendaftaran::getJenisBerkas());
        $berkasLengkap = CalonSiswa::whereHas('berkasPendaftaran', function ($q) use ($totalBerkasRequired) {
            $q->whereNotNull('path_file');
        }, '>=', $totalBerkasRequired)->count();
        
        // Sudah Lulus
        $sudahLulus = CalonSiswa::whereHas('pendaftaran.tes', function ($q) {
            $q->where('status_kelulusan', 'Lulus');
        })->count();
        $sudahLulusLastMonth = CalonSiswa::whereHas('pendaftaran.tes', function ($q) use ($lastMonth) {
            $q->where('status_kelulusan', 'Lulus')
              ->whereDate('updated_at', '<=', $lastMonth);
        })->count();
        $sudahLulusGrowth = $this->calculateGrowth($sudahLulus, $sudahLulusLastMonth);

        // Siap Tes (data lengkap + berkas lengkap)
        $siapTes = CalonSiswa::whereHas('pendaftaran')
            ->whereNotNull('jk')
            ->whereNotNull('tgl_lahir')
            ->whereNotNull('alamat')
            ->whereNotNull('asal_sekolah')
            ->whereHas('berkasPendaftaran', function ($q) {
                $q->whereNotNull('path_file');
            }, '>=', $totalBerkasRequired)
            ->count();

        // Conversion rates
        $conversionRate = $totalPendaftar > 0 ? round(($dataLengkap / $totalPendaftar) * 100, 1) : 0;
        $berkasConversionRate = $totalPendaftar > 0 ? round(($berkasLengkap / $totalPendaftar) * 100, 1) : 0;
        $lulusConversionRate = $totalPendaftar > 0 ? round(($sudahLulus / $totalPendaftar) * 100, 1) : 0;

        // Drop-off rates per step
        $dropOffData = $this->calculateDropOffRates($totalPendaftar, $dataLengkap, $berkasLengkap, $siapTes, $sudahLulus);

        // Average completion time
        $avgCompletionTime = $this->calculateAverageCompletionTime();

        return compact(
            'totalPendaftar',
            'totalPendaftarGrowth',
            'dataLengkap',
            'dataLengkapGrowth',
            'berkasLengkap',
            'sudahLulus',
            'sudahLulusGrowth',
            'siapTes',
            'conversionRate',
            'berkasConversionRate',
            'lulusConversionRate',
            'dropOffData',
            'avgCompletionTime'
        );
    }

    private function calculateGrowth($current, $previous)
    {
        if ($previous == 0) {
            return $current > 0 ? 100 : 0;
        }
        return round((($current - $previous) / $previous) * 100, 1);
    }

    private function calculateDropOffRates($total, $dataLengkap, $berkasLengkap, $siapTes, $lulus)
    {
        return [
            'pendaftaran_ke_data' => [
                'count' => $total - $dataLengkap,
                'rate' => $total > 0 ? round((($total - $dataLengkap) / $total) * 100, 1) : 0,
            ],
            'data_ke_berkas' => [
                'count' => $dataLengkap - $berkasLengkap,
                'rate' => $dataLengkap > 0 ? round((($dataLengkap - $berkasLengkap) / $dataLengkap) * 100, 1) : 0,
            ],
            'berkas_ke_lulus' => [
                'count' => $siapTes - $lulus,
                'rate' => $siapTes > 0 ? round((($siapTes - $lulus) / $siapTes) * 100, 1) : 0,
            ],
        ];
    }

    private function calculateAverageCompletionTime()
    {
        $completed = CalonSiswa::whereHas('pendaftaran')
            ->whereHas('berkasPendaftaran', function ($q) {
                $q->whereNotNull('path_file');
            }, '>=', 4)
            ->whereNotNull('created_at')
            ->get();

        if ($completed->isEmpty()) {
            return null;
        }

        $totalDays = 0;
        $count = 0;

        foreach ($completed as $siswa) {
            $latestBerkas = $siswa->berkasPendaftaran()
                ->whereNotNull('path_file')
                ->latest('updated_at')
                ->first();
            
            if ($latestBerkas && $latestBerkas->updated_at) {
                $days = $siswa->created_at->diffInDays($latestBerkas->updated_at);
                $totalDays += $days;
                $count++;
            }
        }

        return $count > 0 ? round($totalDays / $count, 1) : null;
    }

    private function getWeeklyRegistrationData()
    {
        $weeks = [];
        $counts = [];
        $labels = [];

        for ($i = 5; $i >= 0; $i--) {
            $startOfWeek = Carbon::now()->subWeeks($i)->startOfWeek();
            $endOfWeek = Carbon::now()->subWeeks($i)->endOfWeek();
            
            $count = CalonSiswa::whereBetween('created_at', [$startOfWeek, $endOfWeek])->count();
            
            $weeks[] = 'W' . (6 - $i);
            $counts[] = $count;
            $labels[] = $startOfWeek->format('d M');
        }

        return [
            'weeks' => $weeks,
            'counts' => $counts,
            'labels' => $labels,
        ];
    }

    private function getPeakHoursData()
    {
        return CalonSiswa::select(DB::raw('HOUR(created_at) as hour'), DB::raw('count(*) as total'))
            ->groupBy('hour')
            ->orderBy('hour')
            ->get()
            ->map(function ($item) {
                return [
                    'hour' => sprintf('%02d:00', $item->hour),
                    'total' => $item->total,
                ];
            });
    }

    private function getGeographicDistribution()
    {
        // Extract kecamatan/kota from alamat (simplified)
        return CalonSiswa::select('alamat', DB::raw('count(*) as total'))
            ->whereNotNull('alamat')
            ->groupBy('alamat')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->get()
            ->map(function ($item) {
                // Extract first part of address as area
                $parts = explode(',', $item->alamat);
                $area = trim($parts[0] ?? 'Tidak Diketahui');
                return [
                    'area' => $area,
                    'total' => $item->total,
                ];
            });
    }
}
