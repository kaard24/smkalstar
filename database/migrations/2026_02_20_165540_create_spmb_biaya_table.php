<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('spmb_biaya', function (Blueprint $table) {
            $table->id();
            $table->foreignId('gelombang_id')->nullable()->constrained('spmb_gelombang')->onDelete('cascade');
            $table->string('nama'); // Uang Gedung, SPP, dll
            $table->integer('nominal');
            $table->text('keterangan')->nullable();
            $table->integer('urutan')->default(0);
            $table->boolean('aktif')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('spmb_biaya');
    }
};
