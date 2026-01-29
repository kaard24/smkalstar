<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('calon_siswa', function (Blueprint $table) {
            $table->string('password')->nullable()->after('no_wa');
            $table->string('remember_token', 100)->nullable()->after('password');
            
            // Make some fields nullable for registration flow
            // (they will be filled in during the full registration form)
        });

        // Update existing records with a temporary password if needed
        // In production, you might want to force password reset
    }

    public function down(): void
    {
        Schema::table('calon_siswa', function (Blueprint $table) {
            $table->dropColumn(['password', 'remember_token']);
        });
    }
};
