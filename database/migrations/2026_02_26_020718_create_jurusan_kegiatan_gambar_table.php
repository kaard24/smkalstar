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
        Schema::create('jurusan_kegiatan_gambar', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kegiatan_id')->constrained('jurusan_kegiatan')->onDelete('cascade');
            $table->string('gambar');
            $table->integer('urutan')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jurusan_kegiatan_gambar');
    }
};
