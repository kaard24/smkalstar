<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Seragam;

class SeragamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'hari' => 'Senin',
                'foto_laki' => null,
                'foto_perempuan' => null,
                'keterangan' => 'Seragam putih abu-abu. Kemeja putih dengan celana/rok abu-abu. Dikenakan setiap hari Senin.',
                'warna_tema' => 'gray',
                'urutan' => 1,
                'aktif' => true,
            ],
            [
                'hari' => 'Selasa',
                'foto_laki' => null,
                'foto_perempuan' => null,
                'keterangan' => 'Seragam batik sekolah. Kemeja batik khas sekolah dengan celana/rok hitam. Memperkenalkan budaya Indonesia.',
                'warna_tema' => 'brown',
                'urutan' => 2,
                'aktif' => true,
            ],
            [
                'hari' => 'Rabu',
                'foto_laki' => null,
                'foto_perempuan' => null,
                'keterangan' => 'Seragam olahraga. Kaos olahraga biru dengan celana/rok putih. Untuk aktivitas fisik dan olahraga.',
                'warna_tema' => 'blue',
                'urutan' => 3,
                'aktif' => true,
            ],
            [
                'hari' => 'Kamis',
                'foto_laki' => null,
                'foto_perempuan' => null,
                'keterangan' => 'Seragam Muslim. Baju koko putih dengan celana/rok biru. Mengenakan peci atau kerudung sesuai agama.',
                'warna_tema' => 'blue',
                'urutan' => 4,
                'aktif' => true,
            ],
            [
                'hari' => 'Jumat',
                'foto_laki' => null,
                'foto_perempuan' => null,
                'keterangan' => 'Seragam Pramuka. Seragam pramuka lengkap dengan atributnya. Membangun karakter disiplin dan mandiri.',
                'warna_tema' => 'brown',
                'urutan' => 5,
                'aktif' => true,
            ],
            [
                'hari' => 'Sabtu',
                'foto_laki' => null,
                'foto_perempuan' => null,
                'keterangan' => 'Seragam bebas sopan. Mengenakan pakaian bebas yang sopan dan rapi.',
                'warna_tema' => 'purple',
                'urutan' => 6,
                'aktif' => true,
            ],
        ];

        foreach ($data as $item) {
            Seragam::create($item);
        }
    }
}
