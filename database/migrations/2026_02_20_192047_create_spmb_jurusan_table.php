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
        Schema::create('spmb_jurusan', function (Blueprint $table) {
            $table->id();
            $table->string('kode')->unique(); // TKJ, MPLB, AKL, BR
            $table->string('nama'); // Nama lengkap jurusan
            $table->string('logo')->nullable(); // Path logo
            $table->string('gambar')->nullable(); // Path gambar
            $table->string('warna_border')->default('border-gray-200'); // Class border warna
            $table->string('warna_bg')->default('bg-gray-50'); // Class background warna
            $table->string('warna_text')->default('text-gray-600'); // Class text warna
            $table->string('warna_hover')->default('group-hover:bg-gray-600'); // Class hover
            $table->integer('urutan')->default(0);
            $table->boolean('aktif')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spmb_jurusan');
    }
};
