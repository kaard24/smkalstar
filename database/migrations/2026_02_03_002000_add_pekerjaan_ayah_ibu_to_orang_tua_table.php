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
            // Tambahkan kolom pekerjaan terpisah untuk ayah dan ibu
            $table->string('pekerjaan_ayah', 100)->nullable()->after('status_ayah');
            $table->string('pekerjaan_ibu', 100)->nullable()->after('status_ibu');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orang_tua', function (Blueprint $table) {
            $table->dropColumn(['pekerjaan_ayah', 'pekerjaan_ibu']);
        });
    }
};
