<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\KomentarBerita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

class BeritaController extends Controller
{
    /**
     * Cache duration in seconds (30 minutes for berita)
     */
    protected const CACHE_DURATION = 1800;

    /**
     * Display a listing of all berita
     */
    public function index(Request $request)
    {
        $query = Berita::aktif()->published()->terbaru();
        
        // Handle search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                  ->orWhere('isi', 'like', "%{$search}%");
            });
        }
        
        $berita = $query->paginate(12)->withQueryString();
        return view('berita.index', compact('berita'));
    }

    /**
     * Display the specified berita
     */
    public function show($slug)
    {
        $berita = Berita::aktif()->where('slug', $slug)->firstOrFail();
        $berita->load('approvedKomentar');
        
        // Check if user has already commented
        $hasCommented = $this->hasUserCommented($berita->id);
        
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
            
        return view('berita.show', compact('berita', 'related', 'hasCommented'));
    }

    /**
     * Check if current user/guest has already commented on this berita
     */
    private function hasUserCommented(int $beritaId): bool
    {
        if (auth('spmb')->check()) {
            // For logged in users, check by user ID
            $userId = auth('spmb')->user()->id;
            return KomentarBerita::where('berita_id', $beritaId)
                ->where('user_id', $userId)
                ->exists();
        } else {
            // For guests, check by session
            $commentedKey = 'commented_berita_' . $beritaId;
            return Session::has($commentedKey);
        }
    }

    /**
     * Store a new comment
     */
    public function storeKomentar(Request $request, $slug)
    {
        $berita = Berita::aktif()->where('slug', $slug)->firstOrFail();
        
        // Check if user has already commented
        if ($this->hasUserCommented($berita->id)) {
            return redirect()->route('berita.show', $slug)
                ->with('error', 'Anda sudah memberikan komentar pada berita ini. Hanya 1 komentar yang diperbolehkan per akun/pengguna.');
        }
        
        // Validation rules:
        // - Only letters and spaces allowed (no numbers, no special characters)
        // - No URLs/links allowed
        // - Max 100 characters for comment
        // - Max 50 characters for username
        
        $rules = [
            'komentar' => [
                'required',
                'string',
                'max:100',
                'regex:/^[a-zA-Z\s]+$/u', // Only letters and spaces
            ],
            'show_username' => 'nullable|boolean',
        ];
        
        // Username validation for guests
        if (!auth('spmb')->check()) {
            $rules['username'] = [
                'required',
                'string',
                'max:50',
                'regex:/^[a-zA-Z\s]+$/u', // Only letters and spaces
            ];
        }
        
        $messages = [
            'komentar.required' => 'Komentar wajib diisi.',
            'komentar.max' => 'Komentar maksimal 100 karakter.',
            'komentar.regex' => 'Komentar hanya boleh berisi huruf dan spasi (tidak boleh angka, simbol, atau link).',
            'username.required' => 'Nama wajib diisi.',
            'username.max' => 'Nama maksimal 50 karakter.',
            'username.regex' => 'Nama hanya boleh berisi huruf dan spasi (tidak boleh angka atau simbol).',
        ];
        
        $request->validate($rules, $messages);
        
        // Additional check for URLs/links in comment
        $komentar = $request->komentar;
        if ($this->containsUrl($komentar)) {
            return redirect()->route('berita.show', $slug)
                ->with('error', 'Komentar tidak boleh mengandung link atau URL.')
                ->withInput();
        }
        
        // Prepare data
        $data = [
            'berita_id' => $berita->id,
            'komentar' => $komentar,
            'show_username' => $request->has('show_username'),
            'is_approved' => true,
        ];
        
        if (auth('spmb')->check()) {
            $data['user_id'] = auth('spmb')->user()->id;
            $data['username'] = auth('spmb')->user()->nama;
        } else {
            $data['username'] = $request->username;
        }
        
        KomentarBerita::create($data);
        
        // Mark as commented for guests
        if (!auth('spmb')->check()) {
            Session::put('commented_berita_' . $berita->id, true);
        }

        return redirect()->route('berita.show', $slug)
            ->with('success', 'Komentar berhasil ditambahkan.');
    }
    
    /**
     * Check if text contains URL/link
     */
    private function containsUrl(string $text): bool
    {
        // Pattern to detect URLs
        $pattern = '/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,}(\/[\S]*)?/';
        if (preg_match($pattern, $text)) {
            return true;
        }
        
        // Pattern to detect www. domains
        $pattern = '/(www\.)[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,}(\/[\S]*)?/';
        if (preg_match($pattern, $text)) {
            return true;
        }
        
        // Pattern to detect common TLDs without protocol
        $pattern = '/[a-zA-Z0-9\-\.]+\.(com|net|org|id|co\.id|go\.id|ac\.id|my\.id|blogspot|wordpress|github|youtube|instagram|facebook|twitter|tiktok|wa\.me|whatsapp)(\/[\S]*)?/i';
        if (preg_match($pattern, $text)) {
            return true;
        }
        
        return false;
    }
}
