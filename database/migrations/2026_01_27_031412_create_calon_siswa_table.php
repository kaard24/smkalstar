<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('calon_siswa', function (Blueprint $table) {
            $table->id();
            $table->string('nisn')->unique();
            $table->string('nama');
            $table->enum('jk', ['L','P']);
            $table->date('tgl_lahir');
            $table->text('alamat');
            $table->string('no_wa');
            $table->string('asal_sekolah');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('calon_siswa');
    }
};
