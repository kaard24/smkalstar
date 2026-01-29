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
        Schema::table('profil_sekolah', function (Blueprint $table) {
            // First drop the existing column then recreate it as JSON
            // Using a raw statement might be safer for type change, but drop/add is standard for simple changes without data preservation or if data preservation logic is complex.
            // However, we want to try to preserve data if possible, or just overwrite.
            // Since this is a dev env, we can just drop and add. 
            // BUT, to be safer and standard:
            $table->dropColumn('sejarah_gambar');
        });

        Schema::table('profil_sekolah', function (Blueprint $table) {
            $table->json('sejarah_gambar')->nullable()->after('sejarah_konten');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('profil_sekolah', function (Blueprint $table) {
            $table->dropColumn('sejarah_gambar');
        });

        Schema::table('profil_sekolah', function (Blueprint $table) {
            $table->string('sejarah_gambar')->nullable()->after('sejarah_konten');
        });
    }
};
