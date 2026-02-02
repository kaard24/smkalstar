<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Artisan;

class AdminCacheController extends Controller
{
    /**
     * Clear all frontend caches
     */
    public function clearFrontend(Request $request)
    {
        $cacheKeys = [
            'profil_sekolah',
            'jurusan_aktif',
            'fasilitas_aktif',
            'ekstrakurikuler_aktif',
            'prestasi_aktif',
            'galeri_aktif',
        ];

        $cleared = [];
        foreach ($cacheKeys as $key) {
            if (Cache::has($key)) {
                Cache::forget($key);
                $cleared[] = $key;
            }
        }

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Cache berhasil dihapus',
                'cleared' => $cleared
            ]);
        }

        return redirect()->back()->with('success', 'Cache frontend berhasil dihapus. Data akan di-cache ulang saat ada request berikutnya.');
    }

    /**
     * Clear all application caches
     */
    public function clearAll(Request $request)
    {
        Artisan::call('cache:clear');

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Semua cache berhasil dihapus'
            ]);
        }

        return redirect()->back()->with('success', 'Semua cache berhasil dihapus.');
    }
}
