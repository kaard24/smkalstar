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
        Schema::create('spmb_hero', function (Blueprint $table) {
            $table->id();
            $table->string('badge_text')->default('Pendaftaran Dibuka!');
            $table->string('badge_warna')->default('blue'); // blue, green, orange, purple, dll
            $table->string('judul_baris1')->default('Sistem Penerimaan');
            $table->string('judul_baris2')->default('Murid Baru 2026/2027');
            $table->text('deskripsi')->default('Informasi lengkap mengenai pendaftaran, jadwal, persyaratan, dan biaya pendidikan di SMK Al-Hidayah Lestari');
            $table->string('tahun_ajaran')->default('2026/2027');
            $table->boolean('tampilkan_gelombang')->default(true);
            $table->integer('jumlah_gelombang_tampil')->default(2);
            $table->boolean('aktif')->default(true);
            $table->integer('urutan')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spmb_hero');
    }
};
