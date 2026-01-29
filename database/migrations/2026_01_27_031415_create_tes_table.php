<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('tes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pendaftaran_id')->constrained('pendaftaran')->cascadeOnDelete();
            $table->integer('nilai_btq')->nullable();
            $table->integer('nilai_minat_bakat')->nullable();
            $table->integer('nilai_kejuruan')->nullable();
            $table->enum('status_btq', ['Lulus','Tidak Lulus'])->nullable();
            $table->enum('status_kelulusan', ['Pending','Lulus','Tidak Lulus'])->default('Pending');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('tes');
    }
};
