<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Jurusan;

class JurusanSeeder extends Seeder
{
    public function run(): void
    {
        Jurusan::create([
            'kode' => 'TKJ',
            'nama' => 'Teknik Komputer dan Jaringan'
        ]);

        Jurusan::create([
            'kode' => 'MPLB',
            'nama' => 'Manajemen Perkantoran dan Layanan Bisnis'
        ]);

        Jurusan::create([
            'kode' => 'AKL',
            'nama' => 'Akuntansi Keuangan dan Lembaga'
        ]);

        Jurusan::create([
            'kode' => 'BR',
            'nama' => 'Bisnis Ritel'
        ]);
    }
}
