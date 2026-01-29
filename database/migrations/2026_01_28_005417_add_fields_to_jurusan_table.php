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
        Schema::table('jurusan', function (Blueprint $table) {
            $table->string('kategori')->nullable()->after('nama'); // Teknologi, Manajemen, dll
            $table->text('deskripsi')->nullable()->after('kategori');
            $table->string('gambar')->nullable()->after('deskripsi');
            $table->json('peluang_karir')->nullable()->after('gambar');
            $table->integer('urutan')->default(0)->after('peluang_karir');
            $table->boolean('aktif')->default(true)->after('urutan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('jurusan', function (Blueprint $table) {
            $table->dropColumn(['kategori', 'deskripsi', 'gambar', 'peluang_karir', 'urutan', 'aktif']);
        });
    }
};
