<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SpmbGelombang;
use App\Models\SpmbAlur;
use App\Models\SpmbPersyaratan;
use App\Models\SpmbBiaya;
use App\Models\SpmbKontak;
use App\Models\SpmbHero;
use App\Models\SpmbJurusan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class SpmbController extends Controller
{
    // ==================== DASHBOARD ====================
    public function index()
    {
        $gelombang = SpmbGelombang::ordered()->get();
        $totalGelombang = $gelombang->count();
        $gelombangAktif = $gelombang->where('is_aktif', true)->count();
        
        $hero = SpmbHero::ordered()->get();
        $totalHero = $hero->count();
        $heroAktif = $hero->where('aktif', true)->count();
        
        $jurusan = SpmbJurusan::ordered()->get();
        $totalJurusan = $jurusan->count();
        $jurusanAktif = $jurusan->where('aktif', true)->count();
        
        return view('admin.spmb.index', compact(
            'gelombang', 'totalGelombang', 'gelombangAktif',
            'hero', 'totalHero', 'heroAktif',
            'jurusan', 'totalJurusan', 'jurusanAktif'
        ));
    }

    // ==================== GELOMBANG ====================
    public function gelombangIndex()
    {
        $gelombang = SpmbGelombang::ordered()->get();
        return view('admin.spmb.gelombang.index', compact('gelombang'));
    }

    public function gelombangCreate()
    {
        return view('admin.spmb.gelombang.create');
    }

    public function gelombangStore(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nomor' => 'required|integer|min:1|unique:spmb_gelombang,nomor',
            'tahun_ajaran' => 'required|string|max:20',
            'pendaftaran_start' => 'required|date',
            'pendaftaran_end' => 'required|date|after_or_equal:pendaftaran_start',
            'tes_mulai' => 'required|date|after_or_equal:pendaftaran_end',
            'tes_selesai' => 'required|date|after_or_equal:tes_mulai',
            'pengumuman' => 'required|date|after_or_equal:tes_selesai',
            'status' => 'required|in:draft,aktif,selesai',
            'urutan' => 'nullable|integer|min:0',
        ]);

        $validated['aktif'] = $request->has('aktif');
        $validated['urutan'] = $validated['urutan'] ?? $validated['nomor'];

        SpmbGelombang::create($validated);
        Cache::forget('spmb_data');

        return redirect()->route('admin.spmb.gelombang.index')
            ->with('success', 'Gelombang berhasil ditambahkan.');
    }

    public function gelombangEdit(SpmbGelombang $gelombang)
    {
        return view('admin.spmb.gelombang.edit', compact('gelombang'));
    }

    public function gelombangUpdate(Request $request, SpmbGelombang $gelombang)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nomor' => 'required|integer|min:1|unique:spmb_gelombang,nomor,' . $gelombang->id,
            'tahun_ajaran' => 'required|string|max:20',
            'pendaftaran_start' => 'required|date',
            'pendaftaran_end' => 'required|date|after_or_equal:pendaftaran_start',
            'tes_mulai' => 'required|date|after_or_equal:pendaftaran_end',
            'tes_selesai' => 'required|date|after_or_equal:tes_mulai',
            'pengumuman' => 'required|date|after_or_equal:tes_selesai',
            'status' => 'required|in:draft,aktif,selesai',
            'urutan' => 'nullable|integer|min:0',
        ]);

        $validated['aktif'] = $request->has('aktif');
        $validated['urutan'] = $validated['urutan'] ?? $validated['nomor'];

        $gelombang->update($validated);
        Cache::forget('spmb_data');

        return redirect()->route('admin.spmb.gelombang.index')
            ->with('success', 'Gelombang berhasil diperbarui.');
    }

    public function gelombangDestroy(SpmbGelombang $gelombang)
    {
        $gelombang->delete();
        Cache::forget('spmb_data');

        return redirect()->route('admin.spmb.gelombang.index')
            ->with('success', 'Gelombang berhasil dihapus.');
    }

    // ==================== ALUR ====================
    public function alurIndex()
    {
        $alur = SpmbAlur::with('gelombang')->ordered()->get();
        $gelombang = SpmbGelombang::active()->get();
        return view('admin.spmb.alur.index', compact('alur', 'gelombang'));
    }

    public function alurStore(Request $request)
    {
        $validated = $request->validate([
            'gelombang_id' => 'nullable|exists:spmb_gelombang,id',
            'nomor' => 'required|integer|min:1',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'urutan' => 'nullable|integer|min:0',
        ]);

        $validated['aktif'] = $request->has('aktif');
        $validated['urutan'] = $validated['urutan'] ?? $validated['nomor'];

        SpmbAlur::create($validated);
        Cache::forget('spmb_data');

        return redirect()->route('admin.spmb.alur.index')
            ->with('success', 'Alur berhasil ditambahkan.');
    }

    public function alurUpdate(Request $request, SpmbAlur $alur)
    {
        $validated = $request->validate([
            'gelombang_id' => 'nullable|exists:spmb_gelombang,id',
            'nomor' => 'required|integer|min:1',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'urutan' => 'nullable|integer|min:0',
        ]);

        $validated['aktif'] = $request->has('aktif');
        $validated['urutan'] = $validated['urutan'] ?? $validated['nomor'];

        $alur->update($validated);
        Cache::forget('spmb_data');

        return redirect()->route('admin.spmb.alur.index')
            ->with('success', 'Alur berhasil diperbarui.');
    }

    public function alurDestroy(SpmbAlur $alur)
    {
        $alur->delete();
        Cache::forget('spmb_data');

        return redirect()->route('admin.spmb.alur.index')
            ->with('success', 'Alur berhasil dihapus.');
    }

    // ==================== PERSYARATAN ====================
    public function persyaratanIndex()
    {
        $persyaratan = SpmbPersyaratan::with('gelombang')->ordered()->get();
        $gelombang = SpmbGelombang::active()->get();
        return view('admin.spmb.persyaratan.index', compact('persyaratan', 'gelombang'));
    }

    public function persyaratanStore(Request $request)
    {
        $validated = $request->validate([
            'gelombang_id' => 'nullable|exists:spmb_gelombang,id',
            'nama' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
            'wajib' => 'boolean',
            'urutan' => 'nullable|integer|min:0',
        ]);

        $validated['aktif'] = $request->has('aktif');
        $validated['wajib'] = $request->has('wajib');
        $validated['urutan'] = $validated['urutan'] ?? 0;

        SpmbPersyaratan::create($validated);
        Cache::forget('spmb_data');

        return redirect()->route('admin.spmb.persyaratan.index')
            ->with('success', 'Persyaratan berhasil ditambahkan.');
    }

    public function persyaratanUpdate(Request $request, SpmbPersyaratan $persyaratan)
    {
        $validated = $request->validate([
            'gelombang_id' => 'nullable|exists:spmb_gelombang,id',
            'nama' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
            'wajib' => 'boolean',
            'urutan' => 'nullable|integer|min:0',
        ]);

        $validated['aktif'] = $request->has('aktif');
        $validated['wajib'] = $request->has('wajib');
        $validated['urutan'] = $validated['urutan'] ?? 0;

        $persyaratan->update($validated);
        Cache::forget('spmb_data');

        return redirect()->route('admin.spmb.persyaratan.index')
            ->with('success', 'Persyaratan berhasil diperbarui.');
    }

    public function persyaratanDestroy(SpmbPersyaratan $persyaratan)
    {
        $persyaratan->delete();
        Cache::forget('spmb_data');

        return redirect()->route('admin.spmb.persyaratan.index')
            ->with('success', 'Persyaratan berhasil dihapus.');
    }

    // ==================== BIAYA ====================
    public function biayaIndex()
    {
        $biaya = SpmbBiaya::with('gelombang')->ordered()->get();
        $gelombang = SpmbGelombang::active()->get();
        return view('admin.spmb.biaya.index', compact('biaya', 'gelombang'));
    }

    public function biayaStore(Request $request)
    {
        $validated = $request->validate([
            'gelombang_id' => 'nullable|exists:spmb_gelombang,id',
            'nama' => 'required|string|max:255',
            'nominal' => 'required|integer|min:0',
            'keterangan' => 'nullable|string',
            'urutan' => 'nullable|integer|min:0',
        ]);

        $validated['aktif'] = $request->has('aktif');
        $validated['urutan'] = $validated['urutan'] ?? 0;

        SpmbBiaya::create($validated);
        Cache::forget('spmb_data');

        return redirect()->route('admin.spmb.biaya.index')
            ->with('success', 'Biaya berhasil ditambahkan.');
    }

    public function biayaUpdate(Request $request, SpmbBiaya $biaya)
    {
        $validated = $request->validate([
            'gelombang_id' => 'nullable|exists:spmb_gelombang,id',
            'nama' => 'required|string|max:255',
            'nominal' => 'required|integer|min:0',
            'keterangan' => 'nullable|string',
            'urutan' => 'nullable|integer|min:0',
        ]);

        $validated['aktif'] = $request->has('aktif');
        $validated['urutan'] = $validated['urutan'] ?? 0;

        $biaya->update($validated);
        Cache::forget('spmb_data');

        return redirect()->route('admin.spmb.biaya.index')
            ->with('success', 'Biaya berhasil diperbarui.');
    }

    public function biayaDestroy(SpmbBiaya $biaya)
    {
        $biaya->delete();
        Cache::forget('spmb_data');

        return redirect()->route('admin.spmb.biaya.index')
            ->with('success', 'Biaya berhasil dihapus.');
    }

    // ==================== KONTAK ====================
    public function kontakIndex()
    {
        $kontak = SpmbKontak::ordered()->get();
        return view('admin.spmb.kontak.index', compact('kontak'));
    }

    public function kontakStore(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'nullable|string|max:255',
            'telepon' => 'nullable|string|max:20',
            'whatsapp' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'urutan' => 'nullable|integer|min:0',
        ]);

        $validated['aktif'] = $request->has('aktif');
        $validated['urutan'] = $validated['urutan'] ?? 0;

        SpmbKontak::create($validated);
        Cache::forget('spmb_data');

        return redirect()->route('admin.spmb.kontak.index')
            ->with('success', 'Kontak berhasil ditambahkan.');
    }

    public function kontakUpdate(Request $request, SpmbKontak $kontak)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'nullable|string|max:255',
            'telepon' => 'nullable|string|max:20',
            'whatsapp' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'urutan' => 'nullable|integer|min:0',
        ]);

        $validated['aktif'] = $request->has('aktif');
        $validated['urutan'] = $validated['urutan'] ?? 0;

        $kontak->update($validated);
        Cache::forget('spmb_data');

        return redirect()->route('admin.spmb.kontak.index')
            ->with('success', 'Kontak berhasil diperbarui.');
    }

    public function kontakDestroy(SpmbKontak $kontak)
    {
        $kontak->delete();
        Cache::forget('spmb_data');

        return redirect()->route('admin.spmb.kontak.index')
            ->with('success', 'Kontak berhasil dihapus.');
    }

    // ==================== HERO / BANNER ====================
    public function heroIndex()
    {
        $heroes = SpmbHero::ordered()->get();
        return view('admin.spmb.hero.index', compact('heroes'));
    }

    public function heroCreate()
    {
        return view('admin.spmb.hero.create');
    }

    public function heroStore(Request $request)
    {
        $validated = $request->validate([
            'badge_text' => 'required|string|max:255',
            'badge_warna' => 'required|in:blue,green,orange,purple,red,indigo',
            'judul_baris1' => 'required|string|max:255',
            'judul_baris2' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tahun_ajaran' => 'required|string|max:20',
            'jumlah_gelombang_tampil' => 'required|integer|min:1|max:5',
            'urutan' => 'nullable|integer|min:0',
            'bg_type' => 'required|in:default,color,image',
            'bg_value' => 'nullable|string|max:255',
            'bg_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $validated['aktif'] = $request->has('aktif');
        $validated['tampilkan_gelombang'] = $request->has('tampilkan_gelombang');
        $validated['urutan'] = $validated['urutan'] ?? (SpmbHero::max('urutan') + 1);

        // Handle background
        if ($validated['bg_type'] === 'image' && $request->hasFile('bg_image')) {
            $file = $request->file('bg_image');
            $filename = 'spmb_bg_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/spmb'), $filename);
            $validated['bg_value'] = 'images/spmb/' . $filename;
        }

        // Jika default, kosongkan bg_value
        if ($validated['bg_type'] === 'default') {
            $validated['bg_value'] = null;
        }

        SpmbHero::create($validated);
        Cache::forget('spmb_data');

        return redirect()->route('admin.spmb.hero.index')
            ->with('success', 'Hero/Banner berhasil ditambahkan.');
    }

    public function heroEdit(SpmbHero $hero)
    {
        return view('admin.spmb.hero.edit', compact('hero'));
    }

    public function heroUpdate(Request $request, SpmbHero $hero)
    {
        $validated = $request->validate([
            'badge_text' => 'required|string|max:255',
            'badge_warna' => 'required|in:blue,green,orange,purple,red,indigo',
            'judul_baris1' => 'required|string|max:255',
            'judul_baris2' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tahun_ajaran' => 'required|string|max:20',
            'jumlah_gelombang_tampil' => 'required|integer|min:1|max:5',
            'urutan' => 'nullable|integer|min:0',
            'bg_type' => 'required|in:default,color,image',
            'bg_value' => 'nullable|string|max:255',
            'bg_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $validated['aktif'] = $request->has('aktif');
        $validated['tampilkan_gelombang'] = $request->has('tampilkan_gelombang');
        $validated['urutan'] = $validated['urutan'] ?? $hero->urutan;

        // Handle background
        if ($validated['bg_type'] === 'image' && $request->hasFile('bg_image')) {
            // Hapus gambar lama jika ada
            if ($hero->bg_value && file_exists(public_path($hero->bg_value))) {
                unlink(public_path($hero->bg_value));
            }
            
            $file = $request->file('bg_image');
            $filename = 'spmb_bg_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/spmb'), $filename);
            $validated['bg_value'] = 'images/spmb/' . $filename;
        } elseif ($validated['bg_type'] !== 'image') {
            // Jika bukan image, hapus gambar lama
            if ($hero->bg_value && str_starts_with($hero->bg_value, 'images/') && file_exists(public_path($hero->bg_value))) {
                unlink(public_path($hero->bg_value));
            }
            
            // Jika default, kosongkan bg_value
            if ($validated['bg_type'] === 'default') {
                $validated['bg_value'] = null;
            }
        }

        $hero->update($validated);
        Cache::forget('spmb_data');

        return redirect()->route('admin.spmb.hero.index')
            ->with('success', 'Hero/Banner berhasil diperbarui.');
    }

    public function heroDestroy(SpmbHero $hero)
    {
        $hero->delete();
        Cache::forget('spmb_data');

        return redirect()->route('admin.spmb.hero.index')
            ->with('success', 'Hero/Banner berhasil dihapus.');
    }
}
