<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminSpmbController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminVerifikasiController;
use App\Http\Controllers\AdminKelulusanController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminCacheController;
use App\Http\Controllers\SpmbController;
use App\Http\Controllers\SpmbDashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfilSiswaController;
use App\Http\Controllers\BerkasController;
use App\Http\Controllers\SpmbPembayaranController;
use App\Http\Controllers\AdminPembayaranController;
use App\Http\Controllers\PublicPageController;
use Illuminate\Http\Request;
use App\Models\CalonSiswa;
use App\Models\Pendaftaran;
use App\Models\Tes;
use App\Models\Jurusan;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Public Pages (with caching)
Route::get('/', [PublicPageController::class, 'home']);
Route::get('/profil', [PublicPageController::class, 'profil'])->name('profil');

Route::get('/jurusan/{slug}', [PublicPageController::class, 'jurusanDetail'])->name('jurusan.detail');
Route::get('/fasilitas', [PublicPageController::class, 'fasilitas'])->name('fasilitas');
Route::get('/ekstrakurikuler', [PublicPageController::class, 'ekstrakurikuler'])->name('ekstrakurikuler');
Route::get('/prestasi', [PublicPageController::class, 'prestasi'])->name('prestasi');
Route::get('/galeri', [PublicPageController::class, 'galeri'])->name('galeri');

// Seragam - Info Seragam Sekolah (Public)
Route::get('/seragam', function() {
    $seragam = [
        [
            'hari' => 'Senin',
            'nama' => 'Seragam Putih Abu-abu',
            'warna' => 'Putih - Abu-abu',
            'icon' => '👔',
            'deskripsi' => 'Kemeja putih dengan celana/rok abu-abu. Dikenakan setiap hari Senin.',
            'warna_bg' => 'from-gray-100 to-gray-300',
            'warna_text' => 'text-gray-800'
        ],
        [
            'hari' => 'Selasa',
            'nama' => 'Seragam Batik',
            'warna' => 'Batik Sekolah',
            'icon' => '🌺',
            'deskripsi' => 'Kemeja batik khas sekolah dengan celana/rok hitam. Memperkenalkan budaya Indonesia.',
            'warna_bg' => 'from-amber-100 to-orange-200',
            'warna_text' => 'text-amber-900'
        ],
        [
            'hari' => 'Rabu',
            'nama' => 'Seragam Olahraga',
            'warna' => 'Biru - Putih',
            'icon' => '🏃',
            'deskripsi' => 'Kaos olahraga biru dengan celana/rok putih. Untuk aktivitas fisik dan olahraga.',
            'warna_bg' => 'from-blue-100 to-cyan-200',
            'warna_text' => 'text-blue-900'
        ],
        [
            'hari' => 'Kamis',
            'nama' => 'Seragam Muslim',
            'warna' => 'Putih - Biru',
            'icon' => '🧕',
            'deskripsi' => 'Baju koko putih dengan celana/rok biru. Mengenakan peci atau kerudung sesuai agama.',
            'warna_bg' => 'from-sky-100 to-blue-200',
            'warna_text' => 'text-sky-900'
        ],
        [
            'hari' => 'Jumat',
            'nama' => 'Seragam Pramuka',
            'warna' => 'Coklat - Krem',
            'icon' => '🧭',
            'deskripsi' => 'Seragam pramuka lengkap dengan atributnya. Membangung karakter disiplin dan mandiri.',
            'warna_bg' => 'from-amber-200 to-yellow-300',
            'warna_text' => 'text-amber-900'
        ],
    ];
    return view('seragam', compact('seragam'));
})->name('seragam');

// Legal Pages
Route::get('/privacy-policy', function () {
    return view('legal.privacy');
})->name('privacy');
Route::get('/terms', function () {
    return view('legal.terms');
})->name('terms');

// Offline page for PWA
Route::get('/offline.html', function () {
    return view('errors.offline');
});

// Berita Routes
Route::get('/berita', [\App\Http\Controllers\BeritaController::class, 'index'])->name('berita.index');
Route::get('/berita/{slug}', [\App\Http\Controllers\BeritaController::class, 'show'])->name('berita.show');
Route::post('/berita/{slug}/komentar', [\App\Http\Controllers\BeritaController::class, 'storeKomentar'])->name('berita.komentar');

// ============================================
// Auth Routes - Siswa (NISN + Password)
// ============================================
Route::middleware('guest:spmb')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
    
    // Alias routes untuk /spmb prefix
    Route::get('/spmb/login', fn() => redirect()->route('login'));
    Route::get('/spmb/register', fn() => redirect()->route('register'));
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ============================================
// SPMB Public Pages (tanpa auth)
// ============================================
Route::prefix('spmb')->name('spmb.')->group(function () {
    Route::get('/', function () { 
        $jurusan = Jurusan::aktif()->urut()->get();
        return view('spmb.info', compact('jurusan')); 
    })->name('index');
    Route::get('/info', function () { 
        $jurusan = Jurusan::aktif()->urut()->get();
        return view('spmb.info', compact('jurusan')); 
    })->name('info');

    // Kalender Akademik
    Route::get('/kalender', function () {
        // Data jadwal SPMB 2026/2027 - 2 Gelombang
        $jadwal = [
            [
                'gelombang' => 1,
                'nama' => 'Gelombang 1',
                'pendaftaran_start' => '2026-01-01',
                'pendaftaran_end' => '2026-05-23',
                'tes_mulai' => '2026-05-26',
                'tes_selesai' => '2026-05-28',
                'pengumuman' => '2026-06-01',
            ],
            [
                'gelombang' => 2,
                'nama' => 'Gelombang 2',
                'pendaftaran_start' => '2026-05-24',
                'pendaftaran_end' => '2026-07-04',
                'tes_mulai' => '2026-07-07',
                'tes_selesai' => '2026-07-09',
                'pengumuman' => '2026-07-12',
            ],
        ];
        
        return view('spmb.kalender', compact('jadwal'));
    })->name('kalender');

    // Pengumuman (public check)
    Route::get('/pengumuman', function () {
        // Statistik Pendaftaran
        $totalPendaftar = Pendaftaran::count();
        
        // Statistik per Jurusan
        $statistikJurusan = Pendaftaran::selectRaw('jurusan_id, COUNT(*) as total')
            ->with('jurusan:id,nama,kode')
            ->groupBy('jurusan_id')
            ->orderByDesc('total')
            ->get()
            ->map(function($item) use ($totalPendaftar) {
                return [
                    'nama' => $item->jurusan->nama ?? 'Unknown',
                    'kode' => $item->jurusan->kode ?? '-',
                    'total' => $item->total,
                    'persentase' => $totalPendaftar > 0 ? round(($item->total / $totalPendaftar) * 100, 1) : 0,
                ];
            });
        
        // Statistik per Gelombang
        $statistikGelombang = Pendaftaran::selectRaw('gelombang, COUNT(*) as total')
            ->groupBy('gelombang')
            ->orderBy('gelombang')
            ->get();
        
        // Pendaftar terbaru (5 terakhir, dengan inisial untuk privasi)
        $pendaftarTerbaru = Pendaftaran::with(['calonSiswa:id,nama,asal_sekolah', 'jurusan:id,nama'])
            ->latest()
            ->take(5)
            ->get()
            ->map(function($item) {
                $nama = $item->calonSiswa->nama ?? 'Anonim';
                $inisial = implode('', array_map(function($word) {
                    return strtoupper(substr($word, 0, 1));
                }, array_slice(explode(' ', $nama), 0, 2))); // Max 2 huruf inisial
                
                return [
                    'inisial' => $inisial,
                    'asal_sekolah' => $item->calonSiswa->asal_sekolah ?? '-',
                    'jurusan' => $item->jurusan->nama ?? '-',
                    'waktu' => $item->created_at->diffForHumans(),
                ];
            });
        
        return view('spmb.pengumuman', compact('totalPendaftar', 'statistikJurusan', 'statistikGelombang', 'pendaftarTerbaru'));
    })->name('pengumuman');

    Route::get('/pengumuman/cek', function (Request $request) {
        $request->validate(['nisn' => 'required']);
        
        $calonSiswa = CalonSiswa::where('nisn', $request->nisn)->first();
        
        if (!$calonSiswa) {
            return redirect()->route('spmb.pengumuman')->with('error', 'NISN tidak ditemukan.');
        }
        
        $pendaftaran = Pendaftaran::with('jurusan')->where('calon_siswa_id', $calonSiswa->id)->first();
        
        if (!$pendaftaran) {
             return redirect()->route('spmb.pengumuman')->with('error', 'Data pendaftaran tidak ditemukan.');
        }
        
        $tes = Tes::where('pendaftaran_id', $pendaftaran->id)->first();
        
        $status = 'Pending';
        if ($tes && $tes->status_kelulusan) {
            $status = $tes->status_kelulusan;
        }
        
        $hasil = (object) [
            'nama' => $calonSiswa->nama,
            'jurusan' => $pendaftaran->jurusan->nama ?? '-',
            'status_kelulusan' => $status
        ];
        
        return redirect()->route('spmb.pengumuman')->with('hasil', $hasil);
    })->name('pengumuman.cek');
    
    // API Statistik Real-time
    Route::get('/api/statistik', function () {
        $totalPendaftar = Pendaftaran::count();
        
        $statistikJurusan = Pendaftaran::selectRaw('jurusan_id, COUNT(*) as total')
            ->with('jurusan:id,nama,kode')
            ->groupBy('jurusan_id')
            ->orderByDesc('total')
            ->get()
            ->map(function($item) use ($totalPendaftar) {
                return [
                    'nama' => $item->jurusan->nama ?? 'Unknown',
                    'kode' => $item->jurusan->kode ?? '-',
                    'total' => $item->total,
                    'persentase' => $totalPendaftar > 0 ? round(($item->total / $totalPendaftar) * 100, 1) : 0,
                ];
            });
        
        return response()->json([
            'total_pendaftar' => $totalPendaftar,
            'jurusan_favorit' => $statistikJurusan,
            'updated_at' => now()->toISOString(),
        ]);
    })->name('api.statistik');
});

// ============================================
// Protected SPMB Routes (memerlukan login dengan guard spmb)
// ============================================
Route::middleware('auth:spmb')->prefix('spmb')->name('spmb.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [SpmbDashboardController::class, 'index'])->name('dashboard');
    
    // Lengkapi Data Pendaftaran
    Route::get('/lengkapi-data', [SpmbController::class, 'create'])->name('lengkapi-data');
    Route::post('/lengkapi-data', [SpmbController::class, 'store'])->name('lengkapi-data.store');
    
    // Status
    Route::get('/status', function () { 
        $siswa = auth('spmb')->user();
        $siswa->load(['pendaftaran.jurusan', 'pendaftaran.tes', 'orangTua', 'pembayaran']);
        
        // Calculate progress
        $progress = \App\Models\BerkasPendaftaran::getUploadProgress($siswa->id);
        
        // Check data completeness
        $biodataComplete = !empty($siswa->nama) && !empty($siswa->tgl_lahir) && !empty($siswa->jk) && !empty($siswa->alamat);
        
        // Check data orang tua/wali - handle both cases
        $orangTuaComplete = false;
        $jenisOrtu = $siswa->orangTua?->jenis ?? null;
        if ($jenisOrtu === 'orang_tua') {
            $orangTuaComplete = !empty($siswa->orangTua->nama_ayah) && !empty($siswa->orangTua->nama_ibu);
        } elseif ($jenisOrtu === 'wali') {
            $orangTuaComplete = !empty($siswa->orangTua->nama_wali);
        }
        $jurusanComplete = $siswa->pendaftaran && $siswa->pendaftaran->jurusan_id;
        
        // Check pembayaran status
        $pembayaran = $siswa->pembayaran;
        $pembayaranComplete = $pembayaran && $pembayaran->isVerified();
        
        // Check tes & wawancara status
        $tes = $siswa->pendaftaran?->tes;
        $wawancaraComplete = $tes?->status_wawancara === 'sudah';
        $kelulusanStatus = $tes?->status_kelulusan ?? 'Pending';
        
        return view('spmb.status', compact('siswa', 'progress', 'biodataComplete', 'orangTuaComplete', 'jurusanComplete', 'wawancaraComplete', 'kelulusanStatus', 'tes', 'jenisOrtu', 'pembayaran', 'pembayaranComplete')); 
    })->name('status');
    
    // Upload Berkas
    Route::get('/berkas', [BerkasController::class, 'index'])->name('berkas');
    Route::post('/berkas/upload', [BerkasController::class, 'upload'])->name('berkas.upload');
    Route::get('/berkas/{berkas}/download', [BerkasController::class, 'download'])->name('berkas.download');
    Route::delete('/berkas/{berkas}', [BerkasController::class, 'destroy'])->name('berkas.destroy');
    
    // Pembayaran
    Route::get('/pembayaran', [SpmbPembayaranController::class, 'index'])->name('pembayaran');
    Route::post('/pembayaran', [SpmbPembayaranController::class, 'store'])->name('pembayaran.store');
    Route::get('/pembayaran/{pembayaran}/download', [SpmbPembayaranController::class, 'download'])->name('pembayaran.download');
    Route::get('/pembayaran/{pembayaran}/preview', [SpmbPembayaranController::class, 'preview'])->name('pembayaran.preview');
    
    // Student Profile
    Route::get('/profil', [ProfilSiswaController::class, 'index'])->name('profil');
    Route::get('/profil/edit', [ProfilSiswaController::class, 'edit'])->name('profil.edit');
    Route::put('/profil', [ProfilSiswaController::class, 'update'])->name('profil.update');
    Route::post('/profil/foto', [ProfilSiswaController::class, 'uploadFoto'])->name('profil.foto');
    Route::delete('/profil/foto', [ProfilSiswaController::class, 'hapusFoto'])->name('profil.foto.hapus');
});

// Legacy route redirects
Route::get('/siswa/profil', function () {
    return redirect()->route('spmb.profil');
});

// Redirect dari route lama
Route::get('/spmb/upload-berkas', function () {
    return redirect()->route('spmb.berkas');
});

// ============================================
// Admin Auth Routes
// ============================================
Route::prefix('admin')->name('admin.')->group(function () {
    // Login (guest only)
    Route::middleware('guest:admin')->group(function () {
        Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [AdminAuthController::class, 'login'])->name('login.submit');
    });
    
    // Logout
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');
});

// ============================================
// Protected Admin Routes (memerlukan login dengan guard admin)
// ============================================
Route::middleware('auth:admin')->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard', [AdminDashboardController::class, 'index']);

    // Pendaftar Module (CRUD)
    Route::get('/pendaftar', [AdminSpmbController::class, 'index'])->name('pendaftar.index');
    Route::get('/pendaftar/create', [AdminSpmbController::class, 'create'])->name('pendaftar.create');
    Route::post('/pendaftar', [AdminSpmbController::class, 'store'])->name('pendaftar.store');
    Route::get('/pendaftar/export', [AdminSpmbController::class, 'exportExcel'])->name('pendaftar.export');
    Route::post('/pendaftar/bulk-delete', [AdminSpmbController::class, 'bulkDelete'])->name('pendaftar.bulk-delete');
    Route::post('/pendaftar/bulk-export', [AdminSpmbController::class, 'bulkExport'])->name('pendaftar.bulk-export');
    Route::post('/pendaftar/bulk-update-status', [AdminSpmbController::class, 'bulkUpdateStatus'])->name('pendaftar.bulk-update-status');
    Route::post('/pendaftar/bulk-send-wa', [AdminSpmbController::class, 'bulkSendWA'])->name('pendaftar.bulk-send-wa');
    Route::get('/pendaftar/{id}', [AdminSpmbController::class, 'show'])->name('pendaftar.show');
    Route::get('/pendaftar/{id}/edit', [AdminSpmbController::class, 'edit'])->name('pendaftar.edit');
    Route::put('/pendaftar/{id}', [AdminSpmbController::class, 'update'])->name('pendaftar.update');
    Route::delete('/pendaftar/{id}', [AdminSpmbController::class, 'destroy'])->name('pendaftar.destroy');
    
    // Input Nilai (kept for optional use)
    Route::get('/input-nilai', [AdminSpmbController::class, 'inputNilaiList'])->name('input_nilai.index');
    Route::get('/input-nilai/{id}', [AdminSpmbController::class, 'formNilai'])->name('input_nilai');
    Route::post('/simpan-nilai/{id}', [AdminSpmbController::class, 'simpanNilai'])->name('simpan_nilai');

    // Verifikasi Pendaftaran Module (deprecated - but keep routes for backward compatibility)
    Route::get('/verifikasi', function() {
        return redirect()->route('admin.pendaftar.index')->with('info', 'Fitur verifikasi tidak lagi digunakan. Silakan lihat progress upload di Data Pendaftar.');
    })->name('verifikasi.index');

    // Berkas Module - Admin can view/download only, no verification
    Route::get('/berkas', [BerkasController::class, 'adminIndex'])->name('berkas.index');
    Route::get('/berkas/{berkas}/download', [BerkasController::class, 'adminDownload'])->name('berkas.download');
    Route::post('/berkas/upload', [BerkasController::class, 'adminUpload'])->name('berkas.upload');
    Route::delete('/berkas/{berkas}', [BerkasController::class, 'adminDestroy'])->name('berkas.destroy');

    // Pembayaran Module
    Route::get('/pembayaran', [AdminPembayaranController::class, 'index'])->name('pembayaran.index');
    Route::get('/pembayaran/{pembayaran}', [AdminPembayaranController::class, 'show'])->name('pembayaran.show');
    Route::patch('/pembayaran/{pembayaran}/verify', [AdminPembayaranController::class, 'verify'])->name('pembayaran.verify');
    Route::post('/pembayaran/bulk-verify', [AdminPembayaranController::class, 'bulkVerify'])->name('pembayaran.bulk-verify');
    Route::get('/pembayaran/{pembayaran}/download', [AdminPembayaranController::class, 'download'])->name('pembayaran.download');
    Route::get('/pembayaran/{pembayaran}/preview', [AdminPembayaranController::class, 'preview'])->name('pembayaran.preview');

    // Kelulusan Module (deprecated - all students automatically pass)
    Route::get('/kelulusan', function() {
        return redirect()->route('admin.pendaftar.index')->with('info', 'Semua siswa otomatis lulus. Tidak perlu pengumuman kelulusan.');
    })->name('kelulusan');

    // Profil Sekolah Module (Split into 3 pages)
    Route::get('/profil-sekolah', [\App\Http\Controllers\Admin\ProfilSekolahController::class, 'edit'])->name('profil-sekolah.edit');
    Route::put('/profil-sekolah', [\App\Http\Controllers\Admin\ProfilSekolahController::class, 'update'])->name('profil-sekolah.update');
    Route::delete('/profil-sekolah/struktur', [\App\Http\Controllers\Admin\ProfilSekolahController::class, 'deleteStruktur'])->name('profil-sekolah.delete-struktur');
    
    // Sejarah
    Route::get('/profil-sekolah/sejarah', [\App\Http\Controllers\Admin\ProfilSekolahController::class, 'editSejarah'])->name('profil-sekolah.sejarah');
    Route::put('/profil-sekolah/sejarah', [\App\Http\Controllers\Admin\ProfilSekolahController::class, 'updateSejarah'])->name('profil-sekolah.update-sejarah');
    
    // Visi & Misi
    Route::get('/profil-sekolah/visi-misi', [\App\Http\Controllers\Admin\ProfilSekolahController::class, 'editVisiMisi'])->name('profil-sekolah.visi-misi');
    Route::put('/profil-sekolah/visi-misi', [\App\Http\Controllers\Admin\ProfilSekolahController::class, 'updateVisiMisi'])->name('profil-sekolah.update-visi-misi');
    
    // Struktur Organisasi Module
    Route::prefix('struktur-organisasi')->name('struktur-organisasi.')->group(function () {
        Route::get('/', [\App\Http\Controllers\Admin\StrukturOrganisasiController::class, 'index'])->name('index');
        Route::post('/section', [\App\Http\Controllers\Admin\StrukturOrganisasiController::class, 'storeSection'])->name('section.store');
        Route::put('/section/{id}', [\App\Http\Controllers\Admin\StrukturOrganisasiController::class, 'updateSection'])->name('section.update');
        Route::delete('/section/{id}', [\App\Http\Controllers\Admin\StrukturOrganisasiController::class, 'destroySection'])->name('section.destroy');
        Route::post('/member', [\App\Http\Controllers\Admin\StrukturOrganisasiController::class, 'storeMember'])->name('member.store');
        Route::put('/member/{id}', [\App\Http\Controllers\Admin\StrukturOrganisasiController::class, 'updateMember'])->name('member.update');
        Route::delete('/member/{id}', [\App\Http\Controllers\Admin\StrukturOrganisasiController::class, 'destroyMember'])->name('member.destroy');
    });
    // Legacy struktur routes (redirect to new route)
    Route::get('/profil-sekolah/struktur', fn() => redirect()->route('admin.struktur-organisasi.index'))->name('profil-sekolah.struktur');



    // Fasilitas Module
    Route::resource('fasilitas', \App\Http\Controllers\Admin\FasilitasController::class)->except(['show']);

    // Ekstrakurikuler Module
    Route::resource('ekstrakurikuler', \App\Http\Controllers\Admin\EkstrakurikulerController::class)->except(['show']);

    // Prestasi Module
    Route::resource('prestasi', \App\Http\Controllers\Admin\PrestasiController::class)->except(['show']);

    // Galeri Module
    Route::resource('galeri', \App\Http\Controllers\Admin\GaleriController::class)->except(['show']);

    // Berita Module
    Route::resource('berita', \App\Http\Controllers\Admin\BeritaController::class)->except(['show']);
    Route::get('berita/{id}/komentar', [\App\Http\Controllers\Admin\BeritaController::class, 'komentar'])->name('berita.komentar');
    Route::delete('berita/komentar/{id}', [\App\Http\Controllers\Admin\BeritaController::class, 'destroyKomentar'])->name('berita.komentar.destroy');

    // Cache Management
    Route::post('/cache/clear-frontend', [AdminCacheController::class, 'clearFrontend'])->name('cache.clear-frontend');
    Route::post('/cache/clear-all', [AdminCacheController::class, 'clearAll'])->name('cache.clear-all');
});

