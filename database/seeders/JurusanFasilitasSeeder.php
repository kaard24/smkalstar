<?php

namespace Database\Seeders;

use App\Models\Jurusan;
use App\Models\Fasilitas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JurusanFasilitasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Update existing jurusan with additional data
        $jurusanData = [
            'TKJ' => [
                'nama' => 'Teknik Komputer dan Jaringan (TKJ)',
                'kategori' => 'Teknologi',
                'deskripsi' => 'Mempelajari tentang perakitan komputer, instalasi jaringan (LAN, WAN), administrasi server, hingga keamanan jaringan. Siswa akan dibekali sertifikasi mikrotik dan cisco.',
                'gambar' => 'https://images.unsplash.com/photo-1550751827-4bd374c3f58b?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80',
                'peluang_karir' => ['Network Engineer', 'IT Support', 'System Admin'],
                'urutan' => 1,
                'aktif' => true,
            ],
            'MPLB' => [
                'nama' => 'Manajemen Perkantoran (MPLB)',
                'kategori' => 'Manajemen',
                'deskripsi' => 'Mempelajari pengelolaan administrasi kantor, surat menyurat, pengarsipan, hingga public speaking. Jurusan ini fokus pada mencetak tenaga administrasi yang profesional dan rapi.',
                'gambar' => 'https://images.unsplash.com/photo-1497215728101-856f4ea42174?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80',
                'peluang_karir' => ['Sekretaris', 'Staff Admin', 'Receptionist'],
                'urutan' => 2,
                'aktif' => true,
            ],
            'AKL' => [
                'nama' => 'Akuntansi & Keuangan (AKL)',
                'kategori' => 'Keuangan',
                'deskripsi' => 'Mendalami siklus akuntansi jasa, dagang, dan manufaktur, serta perpajakan dan penggunaan aplikasi komputer akuntansi (MYOB/Accurate).',
                'gambar' => 'https://images.unsplash.com/photo-1554224155-8d04cb21cd6c?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80',
                'peluang_karir' => ['Staff Akuntan', 'Konsultan Pajak', 'Teller Bank'],
                'urutan' => 3,
                'aktif' => true,
            ],
            'BR' => [
                'nama' => 'Bisnis Ritel',
                'kategori' => 'Bisnis',
                'deskripsi' => 'Fokus pada operasional bisnis ritel, manajemen toko, layanan pelanggan, dan supply chain. Siswa diajarkan cara mengelola bisnis penjualan eceran.',
                'gambar' => 'https://images.unsplash.com/photo-1556742049-0cfed4f7a07d?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80',
                'peluang_karir' => ['Store Manager', 'Visual Merchandiser', 'Retail Supervisor', 'Customer Service'],
                'urutan' => 4,
                'aktif' => true,
            ],
        ];

        foreach ($jurusanData as $kode => $data) {
            Jurusan::updateOrCreate(
                ['kode' => $kode],
                $data
            );
        }

        // Seed fasilitas
        $fasilitasData = [
            ['nama' => 'Lab Komputer TKJ', 'gambar' => 'https://images.unsplash.com/photo-1598427958043-34fd7795325b?ixlib=rb-1.2.1&auto=format&fit=crop&w=600&q=80', 'urutan' => 1, 'aktif' => true],
            ['nama' => 'Perpustakaan', 'gambar' => 'https://images.unsplash.com/photo-1541829070764-84a7d30dd3f3?ixlib=rb-1.2.1&auto=format&fit=crop&w=600&q=80', 'urutan' => 2, 'aktif' => true],
            ['nama' => 'Masjid Sekolah', 'gambar' => 'https://images.unsplash.com/photo-1461344577544-4e5dc9487184?ixlib=rb-1.2.1&auto=format&fit=crop&w=600&q=80', 'urutan' => 3, 'aktif' => true],
            ['nama' => 'Ruang Kelas Ber-AC', 'gambar' => 'https://images.unsplash.com/photo-1510531704581-5b2870972060?ixlib=rb-1.2.1&auto=format&fit=crop&w=600&q=80', 'urutan' => 4, 'aktif' => true],
            ['nama' => 'Lapangan Olahraga', 'gambar' => 'https://images.unsplash.com/photo-1576678927484-cc907957088c?ixlib=rb-1.2.1&auto=format&fit=crop&w=600&q=80', 'urutan' => 5, 'aktif' => true],
            ['nama' => 'Kantin Sehat', 'gambar' => 'https://images.unsplash.com/photo-1534093607318-f025419f664e?ixlib=rb-1.2.1&auto=format&fit=crop&w=600&q=80', 'urutan' => 6, 'aktif' => true],
        ];

        foreach ($fasilitasData as $data) {
            Fasilitas::updateOrCreate(
                ['nama' => $data['nama']],
                $data
            );
        }

        $this->command->info('Jurusan dan Fasilitas seeded successfully!');
    }
}
