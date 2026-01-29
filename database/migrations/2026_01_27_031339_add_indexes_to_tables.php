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
        Schema::table('calon_siswa', function (Blueprint $table) {
            $table->index('no_wa');
            $table->index('nama'); // Often searched by name too
        });

        Schema::table('pendaftaran', function (Blueprint $table) {
            $table->index('status_pendaftaran');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('calon_siswa', function (Blueprint $table) {
            $table->dropIndex(['no_wa']);
            $table->dropIndex(['nama']);
        });

        Schema::table('pendaftaran', function (Blueprint $table) {
            $table->dropIndex(['status_pendaftaran']);
        });
    }
};
