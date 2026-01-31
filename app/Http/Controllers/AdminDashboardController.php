<?php

namespace App\Http\Controllers;

use App\Models\CalonSiswa;
use App\Models\BerkasPendaftaran;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Count Statistics
        $totalPendaftar = CalonSiswa::count();
        
        // Count siswa with complete data (biodata + orang tua + jurusan)
        $dataLengkap = CalonSiswa::whereHas('pendaftaran')
            ->whereNotNull('jk')
            ->whereNotNull('tgl_lahir')
            ->whereNotNull('alamat')
            ->whereNotNull('asal_sekolah')
            ->count();
        
        // Count siswa with complete berkas upload
        $berkasLengkap = 0;
        $totalBerkasRequired = count(BerkasPendaftaran::getJenisBerkas());
        
        $calonSiswaIds = CalonSiswa::pluck('id');
        foreach ($calonSiswaIds as $id) {
            if (BerkasPendaftaran::isAllUploaded($id)) {
                $berkasLengkap++;
            }
        }
        
        // Siap tes = data lengkap + berkas lengkap
        $siapTes = CalonSiswa::whereHas('pendaftaran')
            ->whereNotNull('jk')
            ->whereNotNull('tgl_lahir')
            ->whereNotNull('alamat')
            ->whereNotNull('asal_sekolah')
            ->whereHas('berkasPendaftaran', function ($q) use ($totalBerkasRequired) {
                $q->select('calon_siswa_id')
                  ->groupBy('calon_siswa_id')
                  ->havingRaw('COUNT(*) = ?', [$totalBerkasRequired]);
            })
            ->count();

        // Statistik per Jurusan
        $statsJurusan = DB::table('pendaftaran')
            ->select('jurusan_id', DB::raw('count(*) as total'))
            ->groupBy('jurusan_id')
            ->get();
            
        return view('admin.dashboard', compact(
            'totalPendaftar', 
            'dataLengkap', 
            'berkasLengkap', 
            'siapTes',
            'statsJurusan'
        ));
    }
}
