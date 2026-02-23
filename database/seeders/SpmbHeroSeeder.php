<?php

namespace Database\Seeders;

use App\Models\SpmbHero;
use Illuminate\Database\Seeder;

class SpmbHeroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Hanya buat jika belum ada hero
        if (SpmbHero::count() === 0) {
            SpmbHero::create([
                'badge_text' => 'Pendaftaran Dibuka!',
                'badge_warna' => 'blue',
                'judul_baris1' => 'Sistem Penerimaan',
                'judul_baris2' => 'Murid Baru 2026/2027',
                'deskripsi' => 'Informasi lengkap mengenai pendaftaran, jadwal, persyaratan, dan biaya pendidikan di SMK Al-Hidayah Lestari',
                'tahun_ajaran' => '2026/2027',
                'tampilkan_gelombang' => true,
                'jumlah_gelombang_tampil' => 2,
                'aktif' => true,
                'urutan' => 1,
            ]);

            $this->command->info('Hero SPMB default berhasil dibuat!');
        } else {
            $this->command->info('Hero SPMB sudah ada, skipping...');
        }
    }
}
