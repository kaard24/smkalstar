<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orang_tua', function (Blueprint $table) {
            $table->enum('jenis', ['orang_tua', 'wali'])->default('orang_tua')->after('calon_siswa_id');
            $table->string('nik_ayah', 16)->nullable()->after('nama_ayah');
            $table->string('nik_ibu', 16)->nullable()->after('nama_ibu');
            $table->enum('status_ayah', ['hidup', 'meninggal'])->default('hidup')->after('nik_ayah');
            $table->enum('status_ibu', ['hidup', 'meninggal'])->default('hidup')->after('nik_ibu');
            // Untuk wali
            $table->string('nama_wali', 100)->nullable()->after('status_ibu');
            $table->string('pekerjaan_wali', 100)->nullable()->after('nama_wali');
            $table->string('no_hp_wali', 15)->nullable()->after('pekerjaan_wali');
            $table->string('hubungan_wali', 50)->nullable()->after('no_hp_wali');
        });
    }

    public function down(): void
    {
        Schema::table('orang_tua', function (Blueprint $table) {
            $table->dropColumn(['jenis', 'nik_ayah', 'nik_ibu', 'status_ayah', 'status_ibu', 'nama_wali', 'pekerjaan_wali', 'no_hp_wali', 'hubungan_wali']);
        });
    }
};
