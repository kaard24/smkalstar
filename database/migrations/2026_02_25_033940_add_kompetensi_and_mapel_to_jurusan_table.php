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
            $table->text('deskripsi_lengkap')->nullable()->after('deskripsi');
            $table->json('kompetensi')->nullable()->after('peluang_karir');
            $table->json('mata_pelajaran')->nullable()->after('kompetensi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('jurusan', function (Blueprint $table) {
            $table->dropColumn(['deskripsi_lengkap', 'kompetensi', 'mata_pelajaran']);
        });
    }
};
