<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Ubah kolom jk, tgl_lahir, alamat, asal_sekolah menjadi nullable
 * karena data ini diisi di form "Lengkapi Data", bukan saat registrasi
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('calon_siswa', function (Blueprint $table) {
            $table->enum('jk', ['L', 'P'])->nullable()->change();
            $table->date('tgl_lahir')->nullable()->change();
            $table->text('alamat')->nullable()->change();
            $table->string('asal_sekolah', 255)->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('calon_siswa', function (Blueprint $table) {
            $table->enum('jk', ['L', 'P'])->nullable(false)->change();
            $table->date('tgl_lahir')->nullable(false)->change();
            $table->text('alamat')->nullable(false)->change();
            $table->string('asal_sekolah', 255)->nullable(false)->change();
        });
    }
};
