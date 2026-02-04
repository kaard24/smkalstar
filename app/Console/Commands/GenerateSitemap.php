<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Berita;
use Carbon\Carbon;

class GenerateSitemap extends Command
{
    protected $signature = 'sitemap:generate';
    protected $description = 'Generate dynamic sitemap.xml';

    public function handle()
    {
        $baseUrl = config('app.url');
        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL;
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . PHP_EOL;
        
        // Static pages
        $staticPages = [
            ['url' => '/', 'priority' => '1.0', 'freq' => 'weekly'],
            ['url' => '/profil', 'priority' => '0.9', 'freq' => 'monthly'],
            ['url' => '/jurusan', 'priority' => '0.9', 'freq' => 'monthly'],
            ['url' => '/spmb/info', 'priority' => '1.0', 'freq' => 'weekly'],
            ['url' => '/fasilitas', 'priority' => '0.8', 'freq' => 'monthly'],
            ['url' => '/ekstrakurikuler', 'priority' => '0.7', 'freq' => 'monthly'],
            ['url' => '/prestasi', 'priority' => '0.8', 'freq' => 'weekly'],
            ['url' => '/berita', 'priority' => '0.9', 'freq' => 'daily'],
            ['url' => '/galeri', 'priority' => '0.7', 'freq' => 'weekly'],
            ['url' => '/privacy-policy', 'priority' => '0.3', 'freq' => 'yearly'],
            ['url' => '/terms', 'priority' => '0.3', 'freq' => 'yearly'],
        ];
        
        foreach ($staticPages as $page) {
            $xml .= $this->createUrlEntry($baseUrl . $page['url'], now()->toDateString(), $page['freq'], $page['priority']);
        }
        
        // Dynamic pages - Berita
        $beritaList = Berita::where('is_published', true)
            ->where('published_at', '<=', now())
            ->get();
        
        foreach ($beritaList as $berita) {
            $xml .= $this->createUrlEntry(
                $baseUrl . '/berita/' . $berita->slug,
                $berita->updated_at->toDateString(),
                'monthly',
                '0.6'
            );
        }
        
        $xml .= '</urlset>';
        
        // Save to public directory
        file_put_contents(public_path('sitemap.xml'), $xml);
        
        $this->info('Sitemap generated successfully!');
        $this->info('Total URLs: ' . (count($staticPages) + count($beritaList)));
        
        return 0;
    }
    
    private function createUrlEntry($loc, $lastmod, $changefreq, $priority)
    {
        return sprintf(
            "    <url>\n        <loc>%s</loc>\n        <lastmod>%s</lastmod>\n        <changefreq>%s</changefreq>\n        <priority>%s</priority>\n    </url>\n",
            htmlspecialchars($loc),
            $lastmod,
            $changefreq,
            $priority
        );
    }
}
