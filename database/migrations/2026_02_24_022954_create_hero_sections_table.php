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
        Schema::create('hero_sections', function (Blueprint $table) {
            $table->id();
            $table->string('badge_text')->default('Pendaftaran 2026/2027 Dibuka');
            $table->string('title_line1')->default('SPMB 2026/2027');
            $table->string('title_highlight')->default('Telah');
            $table->string('title_line2')->default('Dibuka!');
            $table->text('description')->default('Daftarkan diri Anda sekarang dan jadilah bagian dari generasi unggul dan berakhlak di SMK Al-Hidayah Lestari.');
            $table->string('button_primary_text')->default('Daftar Sekarang');
            $table->string('button_primary_url')->default('/spmb/register');
            $table->string('button_secondary_text')->default('Info Lebih Lanjut');
            $table->string('button_secondary_url')->default('/spmb/info');
            $table->string('hero_image')->default('images/b1.webp');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hero_sections');
    }
};
