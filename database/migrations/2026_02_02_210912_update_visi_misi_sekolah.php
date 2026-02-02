<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\ProfilSekolah;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Update visi dan misi di database jika data sudah ada
        $profil = ProfilSekolah::first();
        
        if ($profil) {
            $profil->update([
                'visi' => 'TERBENTUKNYA INSAN YANG BERKARAKTER, BERPRESTASI, PEDULI LINGKUNGAN DAN KOMPETEN DALAM KONSENTRASI KEAHLIAN MANAJEMEN PERKANTORAN, BISNIS RITEL, AKUNTANSI DAN TEKHNIK KOMPUTER JARINGAN',
                'misi' => [
                    'Membekali dan mengembangkan pengetahuan yang didasari oleh keimanan dan ketakwaan kepada Tuhan yang Maha Esa sebagai landasan dalam bertindak.',
                    'Menyelenggarakan Pendidikan Kejuruan yang sesuai dengan 8 standar Nasional Pendidikan +I, Berkarakter Kebangsaan, Kewirausahaan dan berbudaya lingkungan yang relevan dengan kebutuhan Dunia Usaha Dunia Industri dan Masyarakat.',
                    'Membina Kerjasama dengan potensi pengembangan SDM, Inovasi tepat guna dan kemajuan dunia usaha dan dunia industri.',
                    'Meningkatkan kompetensi guru sesuai dengan bidang tugasnya.',
                    'Mewujutkan kondisi tempat belajar yang kondusif dan representatif',
                ],
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Optional: Kembalikan ke visi misi sebelumnya jika perlu
        $profil = ProfilSekolah::first();
        
        if ($profil) {
            $profil->update([
                'visi' => 'Menjadi Sekolah Menengah Kejuruan yang Unggul dalam IMTAQ dan IPTEK serta Berwawasan Lingkungan pada Tahun 2030.',
                'misi' => [
                    'Menanamkan nilai-nilai keimanan dan ketakwaan kepada Tuhan YME.',
                    'Melaksanakan pembelajaran berbasis kompetensi dan teknologi informasi.',
                    'Membangun kemitraan yang sinergis dengan Dunia Usaha dan Dunia Industri.',
                    'Menciptakan lingkungan sekolah yang bersih, hijau, dan kondusif.',
                ],
            ]);
        }
    }
};
