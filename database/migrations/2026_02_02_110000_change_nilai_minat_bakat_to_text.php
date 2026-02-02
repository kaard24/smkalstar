<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tes', function (Blueprint $table) {
            $table->text('nilai_minat_bakat')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('tes', function (Blueprint $table) {
            $table->integer('nilai_minat_bakat')->nullable()->change();
        });
    }
};
