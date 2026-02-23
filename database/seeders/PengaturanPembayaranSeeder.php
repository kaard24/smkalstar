<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PengaturanPembayaran;

class PengaturanPembayaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil data dari config
        $biaya = config('spmb.biaya_pendaftaran', 50000);
        $bank = config('spmb.rekening_bank', 'Bank DKI/Jakarta');
        $nomorRekening = config('spmb.rekening_nomor', '61112000900');
        $atasNama = config('spmb.rekening_atas_nama', 'SMK Al Hidayah Lestari');

        // Buat pengaturan dari config jika belum ada
        if (!PengaturanPembayaran::exists()) {
            PengaturanPembayaran::create([
                'nama_penerima' => $atasNama,
                'nomor_rekening' => $nomorRekening,
                'bank' => $bank,
                'biaya' => $biaya,
                'keterangan' => 'Silakan transfer sesuai nominal yang tertera.',
                'is_active' => true,
            ]);

            $this->command->info('Pengaturan pembayaran berhasil dibuat dari config!');
        } else {
            $this->command->info('Pengaturan pembayaran sudah ada, skip seeding.');
        }
    }
}
