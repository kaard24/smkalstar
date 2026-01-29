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
        Schema::table('admin', function (Blueprint $table) {
            // Cek apakah kolom username belum ada
            if (!Schema::hasColumn('admin', 'username')) {
                $table->string('username')->unique()->after('id');
            }
            // Cek apakah kolom remember_token belum ada
            if (!Schema::hasColumn('admin', 'remember_token')) {
                $table->rememberToken()->after('password');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('admin', function (Blueprint $table) {
            if (Schema::hasColumn('admin', 'username')) {
                $table->dropColumn('username');
            }
            if (Schema::hasColumn('admin', 'remember_token')) {
                $table->dropColumn('remember_token');
            }
        });
    }
};
