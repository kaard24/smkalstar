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
        // Tambah field ke tabel calon_siswa
        Schema::table('calon_siswa', function (Blueprint $table) {
            $table->enum('agama', ['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu', 'Lainnya'])->nullable()->after('jk');
            $table->tinyInteger('anak_ke')->nullable()->after('agama');
            $table->tinyInteger('jumlah_saudara')->nullable()->after('anak_ke');
            $table->enum('golongan_darah', ['A', 'B', 'AB', 'O', '-'])->nullable()->after('jumlah_saudara');
            $table->text('riwayat_penyakit')->nullable()->after('golongan_darah');
            $table->smallInteger('tinggi_badan')->nullable()->after('riwayat_penyakit')->comment('dalam cm');
            $table->smallInteger('berat_badan')->nullable()->after('tinggi_badan')->comment('dalam kg');
            $table->string('npsn_sekolah', 8)->nullable()->after('asal_sekolah');
        });

        // Tambah field ke tabel orang_tua
        Schema::table('orang_tua', function (Blueprint $table) {
            $table->enum('pendidikan_ayah', ['Tidak Sekolah', 'SD', 'SMP', 'SMA', 'D1', 'D2', 'D3', 'S1', 'S2', 'S3'])->nullable()->after('pekerjaan_ayah');
            $table->enum('pendidikan_ibu', ['Tidak Sekolah', 'SD', 'SMP', 'SMA', 'D1', 'D2', 'D3', 'S1', 'S2', 'S3'])->nullable()->after('pekerjaan_ibu');
            $table->enum('penghasilan_ortu', ['< 1jt', '1jt - 2jt', '2jt - 3jt', '3jt - 5jt', '> 5jt'])->nullable()->after('no_wa_ortu');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('calon_siswa', function (Blueprint $table) {
            $table->dropColumn(['agama', 'anak_ke', 'jumlah_saudara', 'golongan_darah', 'riwayat_penyakit', 'tinggi_badan', 'berat_badan', 'npsn_sekolah']);
        });

        Schema::table('orang_tua', function (Blueprint $table) {
            $table->dropColumn(['pendidikan_ayah', 'pendidikan_ibu', 'penghasilan_ortu']);
        });
    }
};
