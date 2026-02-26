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
            $table->string('durasi', 50)->nullable()->after('mata_pelajaran');
            $table->string('sertifikasi', 100)->nullable()->after('durasi');
            $table->string('prakerin', 100)->nullable()->after('sertifikasi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('jurusan', function (Blueprint $table) {
            $table->dropColumn(['durasi', 'sertifikasi', 'prakerin']);
        });
    }
};
