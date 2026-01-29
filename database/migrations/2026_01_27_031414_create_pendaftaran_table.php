<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('pendaftaran', function (Blueprint $table) {
            $table->id();
            $table->foreignId('calon_siswa_id')->constrained('calon_siswa')->cascadeOnDelete();
            $table->foreignId('jurusan_id')->constrained('jurusan')->cascadeOnDelete();
            $table->enum('gelombang', ['Gelombang 1','Gelombang 2']);
            $table->enum('status_pendaftaran', ['Terdaftar','Diverifikasi','Menunggu Tes','Selesai Tes'])
                  ->default('Terdaftar');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('pendaftaran');
    }
};
