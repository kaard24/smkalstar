<?php

namespace App\Http\Controllers;

use App\Models\ProfilSekolah;
use App\Models\Jurusan;
use App\Models\Fasilitas;
use App\Models\Ekstrakurikuler;
use App\Models\Prestasi;
use App\Models\Galeri;
use Illuminate\Support\Facades\Cache;

class PublicPageController extends Controller
{
    /**
     * Cache duration in seconds (1 hour)
     */
    protected const CACHE_DURATION = 3600;

    /**
     * Home page
     */
    public function home()
    {
        return view('home');
    }

    /**
     * Profil sekolah page (cached)
     */
    public function profil()
    {
        $profil = Cache::remember('profil_sekolah', self::CACHE_DURATION, function () {
            return ProfilSekolah::getInstance();
        });

        return view('profil', compact('profil'));
    }

    /**
     * Detail jurusan page
     */
    public function jurusanDetail($slug)
    {
        $jurusanList = Cache::remember('jurusan_aktif', self::CACHE_DURATION, function () {
            return Jurusan::aktif()->urut()->get();
        });

        $searchSlug = strtolower($slug);
        
        $jurusanDetail = $jurusanList->first(function ($item) use ($searchSlug) {
            return strtolower($item->kode) === $searchSlug || 
                   str_replace(' ', '-', strtolower($item->nama)) === $searchSlug;
        });

        if (!$jurusanDetail) {
            abort(404);
        }

        return view('jurusan.detail', compact('jurusanDetail', 'jurusanList'));
    }

    /**
     * Fasilitas page (cached)
     */
    public function fasilitas()
    {
        $fasilitas = Cache::remember('fasilitas_aktif', self::CACHE_DURATION, function () {
            return Fasilitas::aktif()->urut()->get();
        });

        return view('fasilitas', compact('fasilitas'));
    }

    /**
     * Ekstrakurikuler page (cached)
     */
    public function ekstrakurikuler()
    {
        $ekstrakurikuler = Cache::remember('ekstrakurikuler_aktif', self::CACHE_DURATION, function () {
            return Ekstrakurikuler::aktif()->urut()->get();
        });

        return view('ekstrakurikuler', compact('ekstrakurikuler'));
    }

    /**
     * Prestasi page (cached)
     */
    public function prestasi()
    {
        $prestasi = Cache::remember('prestasi_aktif', self::CACHE_DURATION, function () {
            return Prestasi::aktif()->urut()->get();
        });

        return view('prestasi', compact('prestasi'));
    }

    /**
     * Galeri page (cached)
     */
    public function galeri()
    {
        $galeri = Cache::remember('galeri_aktif', self::CACHE_DURATION, function () {
            return Galeri::aktif()->urut()->get();
        });

        return view('galeri', compact('galeri'));
    }
}
