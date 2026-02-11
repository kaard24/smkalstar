<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Update enum status_pendaftaran untuk menambahkan status pembayaran
        DB::statement("ALTER TABLE pendaftaran MODIFY COLUMN status_pendaftaran ENUM('Terdaftar','Diverifikasi','Menunggu Pembayaran','Pembayaran Diverifikasi','Menunggu Tes','Selesai Tes') DEFAULT 'Terdaftar'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Kembalikan ke enum semula
        DB::statement("ALTER TABLE pendaftaran MODIFY COLUMN status_pendaftaran ENUM('Terdaftar','Diverifikasi','Menunggu Tes','Selesai Tes') DEFAULT 'Terdaftar'");
    }
};
