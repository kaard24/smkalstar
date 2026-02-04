<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CacheHeaders
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);
        
        // Skip jika request adalah untuk admin atau memiliki session
        if ($request->is('admin/*') || $request->is('spmb/dashboard') || $request->is('spmb/status') || $request->is('spmb/profil')) {
            return $response;
        }
        
        // Public pages - Cache for 1 hour
        if ($request->is('/') || $request->is('profil') || $request->is('jurusan') || $request->is('fasilitas') || 
            $request->is('ekstrakurikuler') || $request->is('prestasi') || $request->is('galeri') || $request->is('berita')) {
            
            $response->headers->set('Cache-Control', 'public, max-age=3600, s-maxage=7200');
            $response->headers->set('Expires', gmdate('D, d M Y H:i:s', time() + 3600) . ' GMT');
            $response->headers->set('Vary', 'Accept-Encoding');
            
            // Security headers
            $response->headers->set('X-Content-Type-Options', 'nosniff');
            $response->headers->set('X-Frame-Options', 'SAMEORIGIN');
            $response->headers->set('X-XSS-Protection', '1; mode=block');
            $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');
            
            return $response;
        }
        
        // Static assets - Cache for 1 year
        if ($request->is('build/*') || $request->is('images/*') || $request->is('js/*') || $request->is('css/*')) {
            $response->headers->set('Cache-Control', 'public, max-age=31536000, immutable');
            $response->headers->set('Expires', gmdate('D, d M Y H:i:s', time() + 31536000) . ' GMT');
            return $response;
        }
        
        // Default security headers untuk semua request
        $response->headers->set('X-Content-Type-Options', 'nosniff');
        $response->headers->set('X-Frame-Options', 'SAMEORIGIN');
        
        return $response;
    }
}
