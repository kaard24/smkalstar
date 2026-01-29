<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration untuk membersihkan tabel legacy dan menyesuaikan struktur
 * 
 * - Drop tabel users (tidak dipakai, auth menggunakan calon_siswa)
 * - Drop tabel otp_logins (OTP sudah dihapus)
 * - Tambah kolom username ke tabel admin
 * - TIDAK menghapus sessions karena masih digunakan Laravel
 */
return new class extends Migration
{
    public function up(): void
    {
        // Hapus tabel password_reset_tokens jika ada
        Schema::dropIfExists('password_reset_tokens');
        
        // Hapus tabel users (tidak dipakai)
        Schema::dropIfExists('users');
        
        // Hapus tabel otp_logins
        Schema::dropIfExists('otp_logins');

        // Buat tabel sessions jika belum ada (untuk SESSION_DRIVER=database)
        if (!Schema::hasTable('sessions')) {
            Schema::create('sessions', function (Blueprint $table) {
                $table->string('id')->primary();
                $table->foreignId('user_id')->nullable()->index();
                $table->string('ip_address', 45)->nullable();
                $table->text('user_agent')->nullable();
                $table->longText('payload');
                $table->integer('last_activity')->index();
            });
        }

        // Tambah kolom username ke tabel admin jika belum ada
        if (!Schema::hasColumn('admin', 'username')) {
            Schema::table('admin', function (Blueprint $table) {
                $table->string('username')->unique()->after('id');
            });
        }
    }

    public function down(): void
    {
        // Recreate users table
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        // Recreate otp_logins table
        Schema::create('otp_logins', function (Blueprint $table) {
            $table->id();
            $table->foreignId('calon_siswa_id')->nullable()->constrained('calon_siswa')->onDelete('cascade');
            $table->string('nisn', 10);
            $table->string('no_wa');
            $table->string('otp_code', 6);
            $table->timestamp('expired_at');
            $table->timestamp('verified_at')->nullable();
            $table->integer('attempts')->default(0);
            $table->timestamps();
        });

        // Hapus kolom username dari admin
        if (Schema::hasColumn('admin', 'username')) {
            Schema::table('admin', function (Blueprint $table) {
                $table->dropColumn('username');
            });
        }
    }
};

