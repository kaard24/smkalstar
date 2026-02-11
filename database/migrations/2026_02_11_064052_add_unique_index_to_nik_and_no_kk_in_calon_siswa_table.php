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
        Schema::table('calon_siswa', function (Blueprint $table) {
            // Hapus data duplikat sebelum menambahkan unique index
            // Ini akan menyimpan data dengan ID terkecil dan menghapus yang lainnya
            \DB::statement('
                DELETE cs1 FROM calon_siswa cs1
                INNER JOIN calon_siswa cs2
                WHERE cs1.id > cs2.id AND cs1.nik IS NOT NULL AND cs1.nik = cs2.nik
            ');
            
            \DB::statement('
                DELETE cs1 FROM calon_siswa cs1
                INNER JOIN calon_siswa cs2
                WHERE cs1.id > cs2.id AND cs1.no_kk IS NOT NULL AND cs1.no_kk = cs2.no_kk
            ');

            // Tambahkan unique index
            $table->unique('nik', 'calon_siswa_nik_unique');
            $table->unique('no_kk', 'calon_siswa_no_kk_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('calon_siswa', function (Blueprint $table) {
            $table->dropUnique('calon_siswa_nik_unique');
            $table->dropUnique('calon_siswa_no_kk_unique');
        });
    }
};
