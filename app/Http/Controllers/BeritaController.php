<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\KomentarBerita;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
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
        
        // Get related berita
        $related = Berita::aktif()
            ->published()
            ->where('id', '!=', $berita->id)
            ->terbaru()
            ->limit(3)
            ->get();
            
        return view('berita.show', compact('berita', 'related'));
    }

    /**
     * Store a new comment
     */
    public function storeKomentar(Request $request, $slug)
    {
        $request->validate([
            'username' => auth('ppdb')->check() ? 'nullable|string|max:100' : 'required|string|max:100',
            'komentar' => 'required|string|max:1000',
            'show_username' => 'nullable|boolean',
        ]);

        $berita = Berita::aktif()->where('slug', $slug)->firstOrFail();

        KomentarBerita::create([
            'berita_id' => $berita->id,
            'username' => auth('ppdb')->check() ? auth('ppdb')->user()->nama : $request->username,
            'komentar' => $request->komentar,
            'show_username' => $request->has('show_username'),
            'is_approved' => true,
        ]);

        return redirect()->route('berita.show', $slug)
            ->with('success', 'Komentar berhasil ditambahkan.');
    }
}
