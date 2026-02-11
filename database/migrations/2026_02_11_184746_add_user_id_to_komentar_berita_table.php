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
        Schema::table('komentar_berita', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable()->after('berita_id');
            $table->index(['berita_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('komentar_berita', function (Blueprint $table) {
            $table->dropIndex(['berita_id', 'user_id']);
            $table->dropColumn('user_id');
        });
    }
};
