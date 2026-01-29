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
        // Create sections table (for subtitles like "Tenaga Pendidik", etc.)
        Schema::create('struktur_organisasi_sections', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->integer('urutan')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Create members table (for individual members with photo, name, description)
        Schema::create('struktur_organisasi_members', function (Blueprint $table) {
            $table->id();
            $table->foreignId('section_id')->constrained('struktur_organisasi_sections')->onDelete('cascade');
            $table->string('foto')->nullable();
            $table->string('nama');
            $table->string('keterangan')->nullable();
            $table->integer('urutan')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('struktur_organisasi_members');
        Schema::dropIfExists('struktur_organisasi_sections');
    }
};
