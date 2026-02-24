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
        Schema::table('spmb_hero', function (Blueprint $table) {
            $table->enum('bg_type', ['default', 'color', 'image'])->default('default')->after('urutan');
            $table->string('bg_value', 255)->nullable()->after('bg_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('spmb_hero', function (Blueprint $table) {
            $table->dropColumn(['bg_type', 'bg_value']);
        });
    }
};
