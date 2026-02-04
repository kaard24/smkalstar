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
        Schema::table('tes', function (Blueprint $table) {
            $table->dropColumn([
                'nilai_btq',
                'nilai_kejuruan',
                'status_btq'
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tes', function (Blueprint $table) {
            $table->integer('nilai_btq')->nullable()->after('pendaftaran_id');
            $table->integer('nilai_kejuruan')->nullable()->after('nilai_minat_bakat');
            $table->string('status_btq')->nullable()->after('nilai_kejuruan');
        });
    }
};
