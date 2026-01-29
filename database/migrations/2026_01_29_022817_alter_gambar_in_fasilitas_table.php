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
        Schema::table('fasilitas', function (Blueprint $table) {
            // Drop column to recreate as JSON, handling potential string data loss is acceptable in dev
            $table->dropColumn('gambar');
        });

        Schema::table('fasilitas', function (Blueprint $table) {
            $table->json('gambar')->nullable()->after('nama');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('fasilitas', function (Blueprint $table) {
            $table->dropColumn('gambar');
        });

        Schema::table('fasilitas', function (Blueprint $table) {
            $table->string('gambar')->nullable()->after('nama');
        });
    }
};
