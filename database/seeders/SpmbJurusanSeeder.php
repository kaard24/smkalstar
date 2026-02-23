<?php

namespace Database\Seeders;

use App\Models\SpmbJurusan;
use Illuminate\Database\Seeder;

class SpmbJurusanSeeder extends Seeder
{
    public function run(): void
    {
        $jurusanData = [
            [
                'kode' => 'TKJ',
                'nama' => 'Teknik Komputer dan Jaringan',
                'logo' => 'images/logo/tkj.jpeg',
                'gambar' => 'images/tkj.png',
                'warna_border' => 'border-blue-900',
                'warna_bg' => 'bg-blue-50',
                'warna_text' => 'text-blue-900',
                'warna_hover' => 'group-hover:bg-blue-900',
                'urutan' => 1,
                'aktif' => true,
            ],
            [
                'kode' => 'MPLB',
                'nama' => 'Manajemen Perkantoran dan Layanan Bisnis',
                'logo' => 'images/logo/mplb1.jpeg',
                'gambar' => 'images/mplb.png',
                'warna_border' => 'border-green-500',
                'warna_bg' => 'bg-green-50',
                'warna_text' => 'text-green-600',
                'warna_hover' => 'group-hover:bg-green-600',
                'urutan' => 2,
                'aktif' => true,
            ],
            [
                'kode' => 'AKL',
                'nama' => 'Akuntansi Keuangan dan Lembaga',
                'logo' => 'images/logo/akl.jpeg',
                'gambar' => 'images/akl.png',
                'warna_border' => 'border-purple-500',
                'warna_bg' => 'bg-purple-50',
                'warna_text' => 'text-purple-600',
                'warna_hover' => 'group-hover:bg-purple-600',
                'urutan' => 3,
                'aktif' => true,
            ],
            [
                'kode' => 'BR',
                'nama' => 'Bisnis Ritel',
                'logo' => 'images/logo/br.jpeg',
                'gambar' => 'images/br.png',
                'warna_border' => 'border-cyan-500',
                'warna_bg' => 'bg-cyan-50',
                'warna_text' => 'text-cyan-600',
                'warna_hover' => 'group-hover:bg-cyan-600',
                'urutan' => 4,
                'aktif' => true,
            ],
        ];

        foreach ($jurusanData as $data) {
            SpmbJurusan::updateOrCreate(
                ['kode' => $data['kode']],
                $data
            );
        }

        $this->command->info('SPMB Jurusan berhasil diupdate/dibuat!');
    }
}
