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
        // Migration ini ditinggalkan karena kolom username sudah dibuat
        // di migration create_admin_table yang lebih baru.
        // Jika tabel admin sudah ada dengan struktur lama, tambahkan kolom yang kurang.
        
        if (Schema::hasTable('admin')) {
            Schema::table('admin', function (Blueprint $table) {
                // Cek apakah kolom username belum ada
                if (!Schema::hasColumn('admin', 'username')) {
                    $table->string('username')->unique()->after('id');
                }
                // Cek apakah kolom remember_token belum ada
                if (!Schema::hasColumn('admin', 'remember_token')) {
                    $table->rememberToken()->after('password');
                }
                // Cek apakah kolom avatar belum ada
                if (!Schema::hasColumn('admin', 'avatar')) {
                    $table->string('avatar')->nullable()->after('name');
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('admin')) {
            Schema::table('admin', function (Blueprint $table) {
                if (Schema::hasColumn('admin', 'username')) {
                    $table->dropColumn('username');
                }
                if (Schema::hasColumn('admin', 'remember_token')) {
                    $table->dropColumn('remember_token');
                }
                if (Schema::hasColumn('admin', 'avatar')) {
                    $table->dropColumn('avatar');
                }
            });
        }
    }
};
