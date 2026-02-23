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
            // Ubah enum penghasilan_ayah ke varchar agar fleksibel
            $table->string('penghasilan_ayah', 50)->nullable()->change();
            $table->string('penghasilan_ibu', 50)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orang_tua', function (Blueprint $table) {
            // Kembalikan ke enum dengan nilai lama
            $table->enum('penghasilan_ayah', ['< 1jt', '1jt - 2jt', '2jt - 3jt', '3jt - 5jt', '> 5jt'])->nullable()->change();
            $table->enum('penghasilan_ibu', ['< 1jt', '1jt - 2jt', '2jt - 3jt', '3jt - 5jt', '> 5jt'])->nullable()->change();
        });
    }
};
