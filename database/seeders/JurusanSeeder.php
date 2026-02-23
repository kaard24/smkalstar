<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Jurusan;

class JurusanSeeder extends Seeder
{
    public function run(): void
    {
        $jurusanData = [
            [
                'kode' => 'TKJ',
                'nama' => 'Teknik Komputer dan Jaringan',
                'kategori' => 'Teknologi Informasi',
                'deskripsi' => 'Jurusan yang mempelajari tentang teknologi komputer, jaringan, dan sistem informasi. Lulusan memiliki kompetensi di bidang networking, hardware, dan troubleshooting.',
                'gambar' => 'images/tkj.png',
                'logo' => 'images/logo/tkj.jpeg',
                'peluang_karir' => ['Network Engineer', 'System Administrator', 'IT Support', 'Technical Support', 'Network Technician'],
                'urutan' => 1,
                'aktif' => true,
            ],
            [
                'kode' => 'MPLB',
                'nama' => 'Manajemen Perkantoran dan Layanan Bisnis',
                'kategori' => 'Bisnis dan Manajemen',
                'deskripsi' => 'Jurusan yang mempelajari tentang administrasi perkantoran, korespondensi, dan layanan bisnis. Lulusan memiliki kompetensi di bidang administrasi dan manajemen kantor.',
                'gambar' => 'images/mplb.png',
                'logo' => 'images/logo/mplb1.jpeg',
                'peluang_karir' => ['Administrasi Perkantoran', 'Customer Service', 'Receptionist', 'Office Manager', 'Executive Assistant'],
                'urutan' => 2,
                'aktif' => true,
            ],
            [
                'kode' => 'AKL',
                'nama' => 'Akuntansi Keuangan dan Lembaga',
                'kategori' => 'Akuntansi dan Keuangan',
                'deskripsi' => 'Jurusan yang mempelajari tentang akuntansi, perpajakan, dan keuangan. Lulusan memiliki kompetensi di bidang pembukuan, laporan keuangan, dan perpajakan.',
                'gambar' => 'images/akl.png',
                'logo' => 'images/logo/akl.jpeg',
                'peluang_karir' => ['Accounting Staff', 'Tax Staff', 'Finance Staff', 'Auditor', 'Banking Officer'],
                'urutan' => 3,
                'aktif' => true,
            ],
            [
                'kode' => 'BR',
                'nama' => 'Bisnis Ritel',
                'kategori' => 'Bisnis dan Manajemen',
                'deskripsi' => 'Jurusan yang mempelajari tentang manajemen retail, merchandising, dan layanan pelanggan. Lulusan memiliki kompetensi di bidang operasional toko dan manajemen retail.',
                'gambar' => 'images/br.png',
                'logo' => 'images/logo/br.jpeg',
                'peluang_karir' => ['Store Manager', 'Merchandiser', 'Sales Supervisor', 'Retail Operations', 'Customer Service Manager'],
                'urutan' => 4,
                'aktif' => true,
            ],
        ];

        foreach ($jurusanData as $data) {
            Jurusan::updateOrCreate(
                ['kode' => $data['kode']],
                $data
            );
        }

        $this->command->info('Jurusan berhasil diupdate/dibuat!');
    }
}
