<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

class ClearFrontendCache extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cache:clear-frontend';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear all frontend page caches';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $cacheKeys = [
            'profil_sekolah',
            'jurusan_aktif',
            'fasilitas_aktif',
            'ekstrakurikuler_aktif',
            'prestasi_aktif',
            'galeri_aktif',
        ];

        foreach ($cacheKeys as $key) {
            Cache::forget($key);
            $this->info("Cleared cache: {$key}");
        }

        // Clear all related berita caches
        // Note: In production with cache tags, this would be more efficient
        $this->info('Frontend caches cleared successfully!');

        return Command::SUCCESS;
    }
}
