<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use App\Models\Tes;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Count Statistics from Database
        $totalPendaftar = Pendaftaran::count();
        $menungguVerifikasi = Pendaftaran::where('status_pendaftaran', 'Terdaftar')->count();
        $lulusSeleksi = Tes::where('status_kelulusan', 'Lulus')->count();
        
        // Sisa Kuota (total 480 - lulus)  
        $sisaKuota = 480 - $lulusSeleksi;

        // Statistik per Jurusan
        $statsJurusan = Pendaftaran::select('jurusan_id', DB::raw('count(*) as total'))
            ->with('jurusan')
            ->groupBy('jurusan_id')
            ->get();
            
        return view('admin.dashboard', compact(
            'totalPendaftar', 
            'menungguVerifikasi', 
            'lulusSeleksi', 
            'sisaKuota',
            'statsJurusan'
        ));
    }
}
