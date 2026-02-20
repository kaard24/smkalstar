<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('spmb_persyaratan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('gelombang_id')->nullable()->constrained('spmb_gelombang')->onDelete('cascade');
            $table->string('nama');
            $table->text('keterangan')->nullable();
            $table->boolean('wajib')->default(true);
            $table->integer('urutan')->default(0);
            $table->boolean('aktif')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('spmb_persyaratan');
    }
};
