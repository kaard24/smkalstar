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
            // Tambah kolom penghasilan ayah dan ibu terpisah
            $table->enum('penghasilan_ayah', ['< 1jt', '1jt - 2jt', '2jt - 3jt', '3jt - 5jt', '> 5jt'])->nullable()->after('pendidikan_ayah');
            $table->enum('penghasilan_ibu', ['< 1jt', '1jt - 2jt', '2jt - 3jt', '3jt - 5jt', '> 5jt'])->nullable()->after('pendidikan_ibu');
        });

        // Migrasi data lama dari penghasilan_ortu ke penghasilan_ayah (default)
        DB::table('orang_tua')->whereNotNull('penghasilan_ortu')->update([
            'penghasilan_ayah' => DB::raw('penghasilan_ortu')
        ]);

        Schema::table('orang_tua', function (Blueprint $table) {
            // Hapus kolom penghasilan_ortu lama
            $table->dropColumn('penghasilan_ortu');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orang_tua', function (Blueprint $table) {
            // Tambah kembali kolom lama
            $table->enum('penghasilan_ortu', ['< 1jt', '1jt - 2jt', '2jt - 3jt', '3jt - 5jt', '> 5jt'])->nullable()->after('no_wa_ortu');
        });

        // Migrasi data kembali ke kolom lama (gunakan data ayah sebagai default)
        DB::table('orang_tua')->whereNotNull('penghasilan_ayah')->update([
            'penghasilan_ortu' => DB::raw('penghasilan_ayah')
        ]);

        Schema::table('orang_tua', function (Blueprint $table) {
            // Hapus kolom baru
            $table->dropColumn(['penghasilan_ayah', 'penghasilan_ibu']);
        });
    }
};
