<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\KomentarBerita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class BeritaController extends Controller
{
    /**
     * Cache duration in seconds (30 minutes for berita)
     */
    protected const CACHE_DURATION = 1800;

    /**
     * Display a listing of all berita
     */
    public function index()
    {
        $berita = Berita::aktif()->published()->terbaru()->paginate(12);
        return view('berita.index', compact('berita'));
    }

    /**
     * Display the specified berita
     */
    public function show($slug)
    {
        $berita = Berita::aktif()->where('slug', $slug)->firstOrFail();
        $berita->load('approvedKomentar');
        
        // Get related berita (cached)
        $cacheKey = 'related_berita_' . $berita->id;
        $related = Cache::remember($cacheKey, self::CACHE_DURATION, function () use ($berita) {
            return Berita::aktif()
                ->published()
                ->where('id', '!=', $berita->id)
                ->terbaru()
                ->limit(3)
                ->get();
        });
            
        return view('berita.show', compact('berita', 'related'));
    }

    /**
     * Store a new comment
     */
    public function storeKomentar(Request $request, $slug)
    {
        $request->validate([
            'username' => auth('spmb')->check() ? 'nullable|string|max:100' : 'required|string|max:100',
            'komentar' => 'required|string|max:1000',
            'show_username' => 'nullable|boolean',
        ]);

        $berita = Berita::aktif()->where('slug', $slug)->firstOrFail();

        KomentarBerita::create([
            'berita_id' => $berita->id,
            'username' => auth('spmb')->check() ? auth('spmb')->user()->nama : $request->username,
            'komentar' => $request->komentar,
            'show_username' => $request->has('show_username'),
            'is_approved' => true,
        ]);

        return redirect()->route('berita.show', $slug)
            ->with('success', 'Komentar berhasil ditambahkan.');
    }
}
