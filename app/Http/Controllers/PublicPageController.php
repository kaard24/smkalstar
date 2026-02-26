<?php

namespace App\Http\Controllers;

use App\Models\ProfilSekolah;
use App\Models\Jurusan;
use App\Models\Fasilitas;
use App\Models\Ekstrakurikuler;
use App\Models\Prestasi;
use App\Models\Galeri;
use App\Models\Berita;
use App\Models\Seragam;
use App\Models\SpmbGelombang;
use App\Models\SpmbAlur;
use App\Models\SpmbPersyaratan;
use App\Models\SpmbBiaya;
use App\Models\SpmbKontak;
use App\Models\SpmbHero;
use App\Models\SpmbJurusan;
use App\Models\HeroSection;
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
        // Get profil sekolah for sejarah section
        $profil = Cache::remember('profil_sekolah', self::CACHE_DURATION, function () {
            return ProfilSekolah::getInstance();
        });

        // Get fasilitas (limited to 6)
        $fasilitas = Cache::remember('fasilitas_home', self::CACHE_DURATION, function () {
            return Fasilitas::aktif()->urut()->limit(6)->get();
        });

        // Get galeri (limited to 8)
        $galeri = Cache::remember('galeri_home', self::CACHE_DURATION, function () {
            return Galeri::aktif()->urut()->limit(8)->get();
        });

        // Get berita (limited to 3 latest)
        $berita = Cache::remember('berita_home', self::CACHE_DURATION, function () {
            return Berita::aktif()->published()->terbaru()->limit(3)->get();
        });

        // Get hero section (active)
        $hero = Cache::remember('hero_section', self::CACHE_DURATION, function () {
            return HeroSection::getActive() ?? $this->getDefaultHero();
        });

        return view('home', compact('profil', 'fasilitas', 'galeri', 'berita', 'hero'));
    }

    /**
     * Get default hero section when no active hero in database
     */
    private function getDefaultHero(): HeroSection
    {
        return new HeroSection([
            'badge_text' => 'Pendaftaran 2026/2027 Dibuka',
            'title_line1' => 'SPMB 2026/2027',
            'title_highlight' => 'Telah',
            'title_line2' => 'Dibuka!',
            'description' => 'Daftarkan diri Anda sekarang dan jadilah bagian dari generasi unggul dan berakhlak di SMK Al-Hidayah Lestari.',
            'button_primary_text' => 'Daftar Sekarang',
            'button_primary_url' => '/spmb/register',
            'button_secondary_text' => 'Info Lebih Lanjut',
            'button_secondary_url' => '/spmb/info',
            'hero_image' => 'images/b1.webp',
            'is_active' => true,
        ]);
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

        // Load info program and detail items
        $jurusanDetail->load(['infoProgram', 'kompetensiItems', 'mapelItems', 'karirItems']);

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

    /**
     * Seragam page (cached)
     */
    public function seragam()
    {
        $seragam = Cache::remember('seragam_aktif', self::CACHE_DURATION, function () {
            return Seragam::active()->ordered()->get();
        });

        return view('seragam', compact('seragam'));
    }

    /**
     * SPMB Info page (cached)
     */
    public function spmbInfo()
    {
        $spmbData = Cache::remember('spmb_data', self::CACHE_DURATION, function () {
            return [
                'hero' => SpmbHero::getHeroUtama(),
                'jurusan' => SpmbJurusan::active()->ordered()->get(),
                'gelombang' => SpmbGelombang::active()->ordered()->get(),
                'alur' => SpmbAlur::active()->ordered()->get(),
                'persyaratan' => SpmbPersyaratan::active()->ordered()->get(),
                'biaya' => SpmbBiaya::active()->ordered()->get(),
                'kontak' => SpmbKontak::active()->ordered()->get(),
            ];
        });

        return view('spmb.info', $spmbData);
    }
}
