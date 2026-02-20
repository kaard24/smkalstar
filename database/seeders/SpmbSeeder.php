<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SpmbGelombang;
use App\Models\SpmbAlur;
use App\Models\SpmbPersyaratan;
use App\Models\SpmbBiaya;
use App\Models\SpmbKontak;
use Carbon\Carbon;

class SpmbSeeder extends Seeder
{
    public function run(): void
    {
        // Create Gelombang
        $gelombang1 = SpmbGelombang::create([
            'nama' => 'Gelombang 1',
            'nomor' => 1,
            'tahun_ajaran' => '2026/2027',
            'pendaftaran_start' => '2026-01-01',
            'pendaftaran_end' => '2026-05-23',
            'tes_mulai' => '2026-05-26',
            'tes_selesai' => '2026-05-28',
            'pengumuman' => '2026-06-01',
            'status' => 'aktif',
            'aktif' => true,
            'urutan' => 1,
        ]);

        $gelombang2 = SpmbGelombang::create([
            'nama' => 'Gelombang 2',
            'nomor' => 2,
            'tahun_ajaran' => '2026/2027',
            'pendaftaran_start' => '2026-05-24',
            'pendaftaran_end' => '2026-07-04',
            'tes_mulai' => '2026-07-07',
            'tes_selesai' => '2026-07-09',
            'pengumuman' => '2026-07-12',
            'status' => 'draft',
            'aktif' => true,
            'urutan' => 2,
        ]);

        // Create Alur Pendaftaran (Global - tidak terikat gelombang)
        $alurData = [
            ['nomor' => 1, 'judul' => 'Pendaftaran Akun', 'deskripsi' => 'Calon siswa membuat akun dengan NISN dan mengisi formulir pendaftaran awal.'],
            ['nomor' => 2, 'judul' => 'Data Diri Lengkap', 'deskripsi' => 'Melengkapi NIK, alamat, data sekolah asal, dan informasi pribadi lainnya.'],
            ['nomor' => 3, 'judul' => 'Data Orang Tua/Wali', 'deskripsi' => 'Mengisi data lengkap orang tua atau wali beserta informasi kontak.'],
            ['nomor' => 4, 'judul' => 'Upload Berkas', 'deskripsi' => 'Mengunggah dokumen persyaratan seperti ijazah, KK, dan akta kelahiran.'],
            ['nomor' => 5, 'judul' => 'Pembayaran', 'deskripsi' => 'Melakukan pembayaran biaya pendaftaran dan mengunggah bukti transfer.'],
            ['nomor' => 6, 'judul' => 'Tes & Wawancara', 'deskripsi' => 'Mengikuti tes akademik, minat bakat, dan wawancara di sekolah.'],
            ['nomor' => 7, 'judul' => 'Pengumuman Kelulusan', 'deskripsi' => 'Melihat hasil seleksi dan melakukan daftar ulang bagi yang dinyatakan lulus.'],
        ];

        foreach ($alurData as $alur) {
            SpmbAlur::create([
                'gelombang_id' => null, // Global
                'nomor' => $alur['nomor'],
                'judul' => $alur['judul'],
                'deskripsi' => $alur['deskripsi'],
                'urutan' => $alur['nomor'],
                'aktif' => true,
            ]);
        }

        // Create Persyaratan (Global)
        $persyaratanData = [
            ['nama' => 'Fotokopi SKL/Ijazah SMP/MTs', 'wajib' => true],
            ['nama' => 'Fotokopi Akta Kelahiran', 'wajib' => true],
            ['nama' => 'Fotokopi Kartu Keluarga (KK)', 'wajib' => true],
            ['nama' => 'Pas foto 3x4 (3 lembar)', 'wajib' => true],
            ['nama' => 'Surat keterangan sehat', 'wajib' => false],
        ];

        foreach ($persyaratanData as $syarat) {
            SpmbPersyaratan::create([
                'gelombang_id' => null, // Global
                'nama' => $syarat['nama'],
                'keterangan' => null,
                'wajib' => $syarat['wajib'],
                'urutan' => 0,
                'aktif' => true,
            ]);
        }

        // Create Biaya (Global)
        $biayaData = [
            ['nama' => 'Uang Gedung', 'nominal' => 1500000],
            ['nama' => 'SPP Juli', 'nominal' => 400000],
            ['nama' => 'Seragam (5 Set)', 'nominal' => 1150000],
            ['nama' => 'Kegiatan Awal', 'nominal' => 550000],
        ];

        foreach ($biayaData as $b) {
            SpmbBiaya::create([
                'gelombang_id' => null, // Global
                'nama' => $b['nama'],
                'nominal' => $b['nominal'],
                'keterangan' => null,
                'urutan' => 0,
                'aktif' => true,
            ]);
        }

        // Create Kontak
        $kontakData = [
            [
                'nama' => 'Pak Kaffa',
                'jabatan' => 'Koordinator SPMB',
                'telepon' => '08812489572',
                'whatsapp' => '08812489572',
                'email' => null,
            ],
            [
                'nama' => 'Pak Akbar',
                'jabatan' => 'Panitia SPMB',
                'telepon' => '089651626030',
                'whatsapp' => '089651626030',
                'email' => null,
            ],
        ];

        foreach ($kontakData as $kontak) {
            SpmbKontak::create([
                'nama' => $kontak['nama'],
                'jabatan' => $kontak['jabatan'],
                'telepon' => $kontak['telepon'],
                'whatsapp' => $kontak['whatsapp'],
                'email' => $kontak['email'],
                'urutan' => 0,
                'aktif' => true,
            ]);
        }
    }
}
