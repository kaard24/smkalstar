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
        Schema::table('seragam', function (Blueprint $table) {
            $table->json('keterangan_foto_laki')->nullable()->after('foto_laki');
            $table->json('keterangan_foto_perempuan')->nullable()->after('foto_perempuan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('seragam', function (Blueprint $table) {
            $table->dropColumn(['keterangan_foto_laki', 'keterangan_foto_perempuan']);
        });
    }
};
