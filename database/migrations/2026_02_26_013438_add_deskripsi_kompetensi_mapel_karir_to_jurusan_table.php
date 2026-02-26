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
            $table->text('deskripsi_kompetensi')->nullable()->after('kompetensi');
            $table->text('deskripsi_mata_pelajaran')->nullable()->after('mata_pelajaran');
            $table->text('deskripsi_peluang_karir')->nullable()->after('peluang_karir');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('jurusan', function (Blueprint $table) {
            $table->dropColumn(['deskripsi_kompetensi', 'deskripsi_mata_pelajaran', 'deskripsi_peluang_karir']);
        });
    }
};
