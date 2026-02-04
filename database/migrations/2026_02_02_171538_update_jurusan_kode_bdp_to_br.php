<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Step 1: Add BR to enum (temporary include both BDP and BR)
        DB::statement("ALTER TABLE jurusan MODIFY kode ENUM('TKJ','MPLB','AKL','BDP','BR') NOT NULL");
        
        // Step 2: Update existing BDP (Bisnis Daring dan Pemasaran) records to BR (Bisnis Ritel)
        DB::table('jurusan')->where('kode', 'BDP')->update(['kode' => 'BR']);
        
        // Step 3: Final enum without BDP
        DB::statement("ALTER TABLE jurusan MODIFY kode ENUM('TKJ','MPLB','AKL','BR') NOT NULL");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert BR (Bisnis Ritel) back to BDP (Bisnis Daring dan Pemasaran)
        DB::table('jurusan')->where('kode', 'BR')->update(['kode' => 'BDP']);
        
        DB::statement("ALTER TABLE jurusan MODIFY kode ENUM('TKJ','MPLB','AKL','BDP') NOT NULL");
    }
};
