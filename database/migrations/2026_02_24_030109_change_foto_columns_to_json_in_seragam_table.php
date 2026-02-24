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
        // Untuk SQLite, kita perlu approach berbeda karena tidak support modify column
        // Rename kolom lama
        Schema::table('seragam', function (Blueprint $table) {
            $table->renameColumn('foto_laki', 'foto_laki_old');
            $table->renameColumn('foto_perempuan', 'foto_perempuan_old');
        });

        // Tambah kolom baru dengan tipe json
        Schema::table('seragam', function (Blueprint $table) {
            $table->json('foto_laki')->nullable();
            $table->json('foto_perempuan')->nullable();
        });

        // Migrasi data lama ke format baru (single image menjadi array)
        $seragams = DB::table('seragam')->get();
        foreach ($seragams as $seragam) {
            $fotoLaki = $seragam->foto_laki_old ? [$seragam->foto_laki_old] : [];
            $fotoPerempuan = $seragam->foto_perempuan_old ? [$seragam->foto_perempuan_old] : [];
            
            DB::table('seragam')
                ->where('id', $seragam->id)
                ->update([
                    'foto_laki' => json_encode($fotoLaki),
                    'foto_perempuan' => json_encode($fotoPerempuan),
                ]);
        }

        // Hapus kolom lama
        Schema::table('seragam', function (Blueprint $table) {
            $table->dropColumn(['foto_laki_old', 'foto_perempuan_old']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Rename kolom json
        Schema::table('seragam', function (Blueprint $table) {
            $table->renameColumn('foto_laki', 'foto_laki_json');
            $table->renameColumn('foto_perempuan', 'foto_perempuan_json');
        });

        // Tambah kolom lama dengan tipe string
        Schema::table('seragam', function (Blueprint $table) {
            $table->string('foto_laki')->nullable();
            $table->string('foto_perempuan')->nullable();
        });

        // Migrasi data kembali (ambil gambar pertama dari array)
        $seragams = DB::table('seragam')->get();
        foreach ($seragams as $seragam) {
            $fotoLaki = json_decode($seragam->foto_laki_json);
            $fotoPerempuan = json_decode($seragam->foto_perempuan_json);
            
            DB::table('seragam')
                ->where('id', $seragam->id)
                ->update([
                    'foto_laki' => $fotoLaki[0] ?? null,
                    'foto_perempuan' => $fotoPerempuan[0] ?? null,
                ]);
        }

        // Hapus kolom json
        Schema::table('seragam', function (Blueprint $table) {
            $table->dropColumn(['foto_laki_json', 'foto_perempuan_json']);
        });
    }
};
