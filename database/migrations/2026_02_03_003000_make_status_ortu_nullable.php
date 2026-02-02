<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orang_tua', function (Blueprint $table) {
            $table->enum('status_ayah', ['hidup', 'meninggal'])->nullable()->default('hidup')->change();
            $table->enum('status_ibu', ['hidup', 'meninggal'])->nullable()->default('hidup')->change();
        });
    }

    public function down(): void
    {
        Schema::table('orang_tua', function (Blueprint $table) {
            $table->enum('status_ayah', ['hidup', 'meninggal'])->default('hidup')->change();
            $table->enum('status_ibu', ['hidup', 'meninggal'])->default('hidup')->change();
        });
    }
};
