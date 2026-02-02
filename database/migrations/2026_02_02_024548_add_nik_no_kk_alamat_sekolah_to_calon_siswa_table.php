<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('calon_siswa', function (Blueprint $table) {
            $table->string('nik', 16)->nullable()->after('nisn');
            $table->string('no_kk', 16)->nullable()->after('nik');
            $table->text('alamat_sekolah')->nullable()->after('asal_sekolah');
        });
    }

    public function down(): void
    {
        Schema::table('calon_siswa', function (Blueprint $table) {
            $table->dropColumn(['nik', 'no_kk', 'alamat_sekolah']);
        });
    }
};
