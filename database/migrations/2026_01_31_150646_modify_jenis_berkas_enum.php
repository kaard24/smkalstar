<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Ubah enum jenis_berkas untuk menggabungkan SKL dan IJAZAH menjadi SKL_IJAZAH
        DB::statement("ALTER TABLE berkas_pendaftaran MODIFY COLUMN jenis_berkas ENUM('KK','AKTA','SKL','IJAZAH','SKL_IJAZAH') NOT NULL");
        
        // Update data lama: SKL dan IJAZAH menjadi SKL_IJAZAH
        // Ambil semua berkas SKL dan IJAZAH
        $sklBerkas = DB::table('berkas_pendaftaran')
            ->where('jenis_berkas', 'SKL')
            ->get();
        
        $ijazahBerkas = DB::table('berkas_pendaftaran')
            ->where('jenis_berkas', 'IJAZAH')
            ->get();

        // Kelompokkan berdasarkan calon_siswa_id
        $sklBySiswa = $sklBerkas->keyBy('calon_siswa_id');
        $ijazahBySiswa = $ijazahBerkas->keyBy('calon_siswa_id');

        // Gabungkan semua siswa yang punya SKL atau IJAZAH
        $allSiswaIds = $sklBySiswa->keys()->merge($ijazahBySiswa->keys())->unique();

        foreach ($allSiswaIds as $siswaId) {
            $hasSkl = isset($sklBySiswa[$siswaId]);
            $hasIjazah = isset($ijazahBySiswa[$siswaId]);

            // Jika sudah ada SKL_IJAZAH, skip
            $existing = DB::table('berkas_pendaftaran')
                ->where('calon_siswa_id', $siswaId)
                ->where('jenis_berkas', 'SKL_IJAZAH')
                ->first();

            if ($existing) {
                // Hapus SKL dan IJAZAH lama jika ada
                DB::table('berkas_pendaftaran')
                    ->where('calon_siswa_id', $siswaId)
                    ->whereIn('jenis_berkas', ['SKL', 'IJAZAH'])
                    ->delete();
                continue;
            }

            // Pilih salah satu untuk dijadikan SKL_IJAZAH (prioritas: IJAZAH > SKL)
            $sourceBerkas = $hasIjazah ? $ijazahBySiswa[$siswaId] : $sklBySiswa[$siswaId];

            // Update jenis berkas menjadi SKL_IJAZAH
            DB::table('berkas_pendaftaran')
                ->where('id', $sourceBerkas->id)
                ->update([
                    'jenis_berkas' => 'SKL_IJAZAH',
                    'updated_at' => now(),
                ]);

            // Hapus berkas lainnya (jika ada IJAZAH dan SKL, yang tidak dipakai dihapus)
            DB::table('berkas_pendaftaran')
                ->where('calon_siswa_id', $siswaId)
                ->whereIn('jenis_berkas', ['SKL', 'IJAZAH'])
                ->where('id', '!=', $sourceBerkas->id)
                ->delete();
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Kembalikan ke enum semula (tidak bisa mengembalikan data yang sudah terhapus)
        DB::statement("ALTER TABLE berkas_pendaftaran MODIFY COLUMN jenis_berkas ENUM('KK','AKTA','SKL','IJAZAH') NOT NULL");
    }
};
