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
        Schema::create('beranda_sections', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('subjudul')->nullable();
            $table->text('konten')->nullable();
            $table->string('gambar')->nullable();
            $table->enum('tipe', ['hero', 'about', 'feature', 'statistic', 'cta'])->default('hero');
            $table->integer('urutan')->default(0);
            $table->boolean('is_active')->default(true);
            $table->string('tombol_teks')->nullable();
            $table->string('tombol_link')->nullable();
            $table->string('warna_latar')->nullable(); // tailwind class
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('beranda_sections');
    }
};
