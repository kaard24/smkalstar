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
        Schema::table('orang_tua', function (Blueprint $table) {
            // Ubah kolom orang tua menjadi nullable untuk kasus wali
            $table->string('nama_ayah')->nullable()->change();
            $table->string('nama_ibu')->nullable()->change();
            $table->string('no_wa_ortu')->nullable()->change();
            $table->string('pekerjaan')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orang_tua', function (Blueprint $table) {
            // Kembalikan ke required (non-nullable)
            $table->string('nama_ayah')->nullable(false)->change();
            $table->string('nama_ibu')->nullable(false)->change();
            $table->string('no_wa_ortu')->nullable(false)->change();
            $table->string('pekerjaan')->nullable(false)->change();
        });
    }
};
