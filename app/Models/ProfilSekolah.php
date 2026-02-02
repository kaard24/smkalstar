<?php

namespace App\Models;

use App\Traits\ClearsCache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfilSekolah extends Model
{
    use HasFactory, ClearsCache;

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
                'visi' => 'TERBENTUKNYA INSAN YANG BERKARAKTER, BERPRESTASI, PEDULI LINGKUNGAN DAN KOMPETEN DALAM KONSENTRASI KEAHLIAN MANAJEMEN PERKANTORAN, BISNIS RITEL, AKUNTANSI DAN TEKHNIK KOMPUTER JARINGAN',
                'misi' => [
                    'Membekali dan mengembangkan pengetahuan yang didasari oleh keimanan dan ketakwaan kepada Tuhan yang Maha Esa sebagai landasan dalam bertindak.',
                    'Menyelenggarakan Pendidikan Kejuruan yang sesuai dengan 8 standar Nasional Pendidikan +I, Berkarakter Kebangsaan, Kewirausahaan dan berbudaya lingkungan yang relevan dengan kebutuhan Dunia Usaha Dunia Industri dan Masyarakat.',
                    'Membina Kerjasama dengan potensi pengembangan SDM, Inovasi tepat guna dan kemajuan dunia usaha dan dunia industri.',
                    'Meningkatkan kompetensi guru sesuai dengan bidang tugasnya.',
                    'Mewujutkan kondisi tempat belajar yang kondusif dan representatif',
                ],
                'struktur_organisasi_gambar' => null,
            ]);
        }

        return $profil;
    }

    /**
     * Get cache key to clear
     */
    public function getCacheKey()
    {
        return 'profil_sekolah';
    }
}
