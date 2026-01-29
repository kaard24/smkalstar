<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfilSekolah extends Model
{
    use HasFactory;

    protected $table = 'profil_sekolah';

    protected $fillable = [
        'sejarah_judul',
        'sejarah_konten',
        'sejarah_gambar',
        'visi',
        'misi',
        'struktur_organisasi_gambar',
    ];

    protected $casts = [
        'misi' => 'array',
        'sejarah_gambar' => 'array',
    ];

    public function getSejarahGambarUrlsAttribute()
    {
        if (empty($this->sejarah_gambar) || !is_array($this->sejarah_gambar)) {
            return [];
        }

        return array_map(function ($gambar) {
            if (str_starts_with($gambar, 'http')) {
                return $gambar;
            }
            return asset('storage/' . $gambar);
        }, $this->sejarah_gambar);
    }

    /**
     * Get the singleton instance of school profile
     * Creates default data if not exists
     */
    public static function getInstance(): self
    {
        $profil = self::first();

        if (!$profil) {
            $profil = self::create([
                'sejarah_judul' => 'Berdiri Sejak 2005 untuk Mencerdaskan Bangsa',
                'sejarah_konten' => "SMK Al-Hidayah Lestari didirikan pada tahun 2005 di bawah naungan Yayasan Al-Hidayah. Berawal dari keinginan kuat para pendiri untuk menyediakan pendidikan kejuruan yang berkualitas namun terjangkau bagi masyarakat sekitar.\n\nDengan semangat \"Ilmu Amaliah, Amal Ilmiah\", sekolah ini terus berkembang dari awalnya hanya memiliki satu jurusan hingga kini memiliki 4 Kompetensi Keahlian unggulan. Kami berkomitmen untuk terus berinovasi dalam melahirkan lulusan yang siap kerja, santun, dan mandiri.\n\nKini, SMK Al-Hidayah Lestari telah meluluskan ribuan alumni yang tersebar di berbagai sektor industri maupun yang melanjutkan ke jenjang perguruan tinggi negeri dan swasta.",
                'sejarah_gambar' => 'https://images.unsplash.com/photo-1544531586-fde5298cdd40?ixlib=rb-1.2.1&auto=format&fit=crop&w=1000&q=80',
                'visi' => 'Menjadi Sekolah Menengah Kejuruan yang Unggul dalam IMTAQ dan IPTEK serta Berwawasan Lingkungan pada Tahun 2030.',
                'misi' => [
                    'Menanamkan nilai-nilai keimanan dan ketakwaan kepada Tuhan YME.',
                    'Melaksanakan pembelajaran berbasis kompetensi dan teknologi informasi.',
                    'Membangun kemitraan yang sinergis dengan Dunia Usaha dan Dunia Industri.',
                    'Menciptakan lingkungan sekolah yang bersih, hijau, dan kondusif.',
                ],
                'struktur_organisasi_gambar' => null,
            ]);
        }

        return $profil;
    }
}
