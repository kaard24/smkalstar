<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('spmb_gelombang', function (Blueprint $table) {
            $table->id();
            $table->string('nama'); // Gelombang 1, Gelombang 2
            $table->integer('nomor'); // 1, 2, 3
            $table->string('tahun_ajaran'); // 2026/2027
            
            // Jadwal Pendaftaran
            $table->date('pendaftaran_start');
            $table->date('pendaftaran_end');
            
            // Jadwal Tes
            $table->date('tes_mulai');
            $table->date('tes_selesai');
            
            // Jadwal Pengumuman
            $table->date('pengumuman');
            
            $table->enum('status', ['draft', 'aktif', 'selesai'])->default('draft');
            $table->boolean('aktif')->default(true);
            $table->integer('urutan')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('spmb_gelombang');
    }
};
