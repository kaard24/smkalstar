<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Seed admin user untuk login ke halaman admin
     */
    public function run(): void
    {
        // Cek apakah admin sudah ada
        if (Admin::where('username', 'admin')->exists()) {
            $this->command->info('Admin user already exists, skipping...');
            return;
        }

        Admin::create([
            'username' => 'admin',
            'name' => 'Administrator',
            'password' => Hash::make('admin123'),
        ]);

        $this->command->info('Admin user created successfully!');
        $this->command->info('Username: admin');
        $this->command->info('Password: admin123');
    }
}
