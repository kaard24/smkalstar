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
        Schema::create('profil_sekolah', function (Blueprint $table) {
            $table->id();
            
            // Sejarah Section
            $table->string('sejarah_judul')->default('Berdiri Sejak 2005 untuk Mencerdaskan Bangsa');
            $table->text('sejarah_konten')->nullable();
            $table->string('sejarah_gambar')->nullable();
            
            // Visi
            $table->text('visi')->nullable();
            
            // Misi (stored as JSON array)
            $table->json('misi')->nullable();
            
            // Struktur Organisasi
            $table->string('struktur_organisasi_gambar')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profil_sekolah');
    }
};
