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
        Schema::create('footer_settings', function (Blueprint $table) {
            $table->id();
            $table->string('logo')->nullable();
            $table->string('nama_sekolah')->default('SMK Al-Hidayah Lestari');
            $table->text('tagline')->default('Mewujudkan generasi unggul, berakhlak mulia, dan siap kerja dengan kompetensi masa depan.');
            $table->string('alamat')->default('JL. KANA LESTARI BLOK K/I, Lb. Bulus, Jakarta Selatan 12440');
            $table->string('telepon')->default('(021) 7661343');
            $table->string('whatsapp')->default('Chat Pak Kaffa');
            $table->string('whatsapp_link')->default('#');
            $table->string('spmb_title')->default('Info SPMB');
            $table->text('spmb_description')->default('Sistem Penerimaan Murid Baru tahun ajaran 2026/2027 telah dibuka.');
            $table->string('spmb_button_text')->default('Daftar Sekarang');
            $table->string('spmb_button_link')->default('/spmb');
            $table->boolean('show_spmb')->default(true);
            $table->timestamps();
        });

        // Insert default data
        DB::table('footer_settings')->insert([
            'nama_sekolah' => 'SMK Al-Hidayah Lestari',
            'tagline' => 'Mewujudkan generasi unggul, berakhlak mulia, dan siap kerja dengan kompetensi masa depan.',
            'alamat' => 'JL. KANA LESTARI BLOK K/I, Lb. Bulus, Jakarta Selatan 12440',
            'telepon' => '(021) 7661343',
            'whatsapp' => 'Chat Pak Kaffa',
            'whatsapp_link' => '#',
            'spmb_title' => 'Info SPMB',
            'spmb_description' => 'Sistem Penerimaan Murid Baru tahun ajaran 2026/2027 telah dibuka.',
            'spmb_button_text' => 'Daftar Sekarang',
            'spmb_button_link' => '/spmb',
            'show_spmb' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('footer_settings');
    }
};
