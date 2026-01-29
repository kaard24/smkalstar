<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminPpdbController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminVerifikasiController;
use App\Http\Controllers\AdminKelulusanController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\PpdbController;
use App\Http\Controllers\PpdbDashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfilSiswaController;
use App\Http\Controllers\BerkasController;
use Illuminate\Http\Request;
use App\Models\CalonSiswa;
use App\Models\Pendaftaran;
use App\Models\Tes;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Public Pages
Route::get('/', function () { return view('home'); });
Route::get('/profil', function () { 
    $profil = \App\Models\ProfilSekolah::getInstance();
    return view('profil', compact('profil')); 
});
Route::get('/jurusan', function () { 
    $jurusan = \App\Models\Jurusan::aktif()->urut()->get();
    return view('jurusan', compact('jurusan')); 
});
Route::get('/fasilitas', function () { 
    $fasilitas = \App\Models\Fasilitas::aktif()->urut()->get();
    return view('fasilitas', compact('fasilitas')); 
});
Route::get('/ekstrakurikuler', function () { 
    $ekstrakurikuler = \App\Models\Ekstrakurikuler::aktif()->urut()->get();
    return view('ekstrakurikuler', compact('ekstrakurikuler')); 
});
Route::get('/prestasi', function () { 
    $prestasi = \App\Models\Prestasi::aktif()->urut()->get();
    return view('prestasi', compact('prestasi')); 
});
Route::get('/galeri', function () { 
    $galeri = \App\Models\Galeri::aktif()->urut()->get();
    return view('galeri', compact('galeri')); 
});

// Berita Routes
Route::get('/berita', [\App\Http\Controllers\BeritaController::class, 'index'])->name('berita.index');
Route::get('/berita/{slug}', [\App\Http\Controllers\BeritaController::class, 'show'])->name('berita.show');
Route::post('/berita/{slug}/komentar', [\App\Http\Controllers\BeritaController::class, 'storeKomentar'])->name('berita.komentar');

// ============================================
// Auth Routes - Siswa (NISN + Password)
// ============================================
Route::middleware('guest:ppdb')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
    
    // Alias routes untuk /ppdb prefix
    Route::get('/ppdb/login', fn() => redirect()->route('login'));
    Route::get('/ppdb/register', fn() => redirect()->route('register'));
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ============================================
// PPDB Public Pages (tanpa auth)
// ============================================
Route::prefix('ppdb')->name('ppdb.')->group(function () {
    Route::get('/', function () { return view('ppdb.info'); })->name('index');
    Route::get('/info', function () { return view('ppdb.info'); })->name('info');

    // Pengumuman (public check)
    Route::get('/pengumuman', function () { 
        return view('ppdb.pengumuman'); 
    })->name('pengumuman');

    Route::get('/pengumuman/cek', function (Request $request) {
        $request->validate(['nisn' => 'required']);
        
        $calonSiswa = CalonSiswa::where('nisn', $request->nisn)->first();
        
        if (!$calonSiswa) {
            return redirect()->route('ppdb.pengumuman')->with('error', 'NISN tidak ditemukan.');
        }
        
        $pendaftaran = Pendaftaran::with('jurusan')->where('calon_siswa_id', $calonSiswa->id)->first();
        
        if (!$pendaftaran) {
             return redirect()->route('ppdb.pengumuman')->with('error', 'Data pendaftaran tidak ditemukan.');
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
        
        return redirect()->route('ppdb.pengumuman')->with('hasil', $hasil);
    })->name('pengumuman.cek');
});

// ============================================
// Protected PPDB Routes (memerlukan login dengan guard ppdb)
// ============================================
Route::middleware('auth:ppdb')->prefix('ppdb')->name('ppdb.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [PpdbDashboardController::class, 'index'])->name('dashboard');
    
    // Lengkapi Data Pendaftaran
    Route::get('/lengkapi-data', [PpdbController::class, 'create'])->name('lengkapi-data');
    Route::post('/lengkapi-data', [PpdbController::class, 'store'])->name('lengkapi-data.store');
    
    // Status
    Route::get('/status', function () { 
        $siswa = auth('ppdb')->user();
        $siswa->load(['pendaftaran.jurusan', 'pendaftaran.tes']);
        return view('ppdb.status', compact('siswa')); 
    })->name('status');
    
    // Upload Berkas
    Route::get('/berkas', [BerkasController::class, 'index'])->name('berkas');
    Route::post('/berkas/upload', [BerkasController::class, 'upload'])->name('berkas.upload');
    Route::get('/berkas/{berkas}/download', [BerkasController::class, 'download'])->name('berkas.download');
    Route::delete('/berkas/{berkas}', [BerkasController::class, 'destroy'])->name('berkas.destroy');
    
    // Nilai
    Route::get('/nilai', function () {
        $siswa = auth('ppdb')->user();
        $pendaftaran = Pendaftaran::where('calon_siswa_id', $siswa->id)->first();
        $tes = $pendaftaran ? Tes::where('pendaftaran_id', $pendaftaran->id)->first() : null;
        return view('ppdb.nilai', compact('tes'));
    })->name('nilai');
    
    // Student Profile
    Route::get('/profil', [ProfilSiswaController::class, 'index'])->name('profil');
    Route::get('/profil/edit', [ProfilSiswaController::class, 'edit'])->name('profil.edit');
    Route::put('/profil', [ProfilSiswaController::class, 'update'])->name('profil.update');
});

// Legacy route redirects
Route::get('/siswa/profil', function () {
    return redirect()->route('ppdb.profil');
});

// Redirect dari route lama
Route::get('/ppdb/upload-berkas', function () {
    return redirect()->route('ppdb.berkas');
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
    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('dashboard');
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    });

    // Pendaftar Module (CRUD)
    Route::get('/pendaftar', [AdminPpdbController::class, 'index'])->name('pendaftar.index');
    Route::get('/pendaftar/{id}', [AdminPpdbController::class, 'show'])->name('pendaftar.show');
    Route::get('/pendaftar/{id}/edit', [AdminPpdbController::class, 'edit'])->name('pendaftar.edit');
    Route::put('/pendaftar/{id}', [AdminPpdbController::class, 'update'])->name('pendaftar.update');
    Route::delete('/pendaftar/{id}', [AdminPpdbController::class, 'destroy'])->name('pendaftar.destroy');
    
    // Input Nilai (kept for optional use)
    Route::get('/input-nilai', [AdminPpdbController::class, 'inputNilaiList'])->name('input_nilai.index');
    Route::get('/input-nilai/{id}', [AdminPpdbController::class, 'formNilai'])->name('input_nilai');
    Route::post('/simpan-nilai/{id}', [AdminPpdbController::class, 'simpanNilai'])->name('simpan_nilai');

    // Verifikasi Pendaftaran Module
    Route::get('/verifikasi', [AdminVerifikasiController::class, 'index'])->name('verifikasi.index');
    Route::get('/verifikasi/{id}', [AdminVerifikasiController::class, 'show'])->name('verifikasi.show');
    Route::post('/verifikasi/{id}', [AdminVerifikasiController::class, 'verify'])->name('verifikasi.verify');

    // Verifikasi Berkas Module
    Route::get('/berkas', [BerkasController::class, 'adminIndex'])->name('berkas.index');
    Route::get('/berkas/{berkas}/download', [BerkasController::class, 'adminDownload'])->name('berkas.download');
    Route::post('/berkas/{berkas}/verify', [BerkasController::class, 'adminVerify'])->name('berkas.verify');

    // Kelulusan Module
    Route::get('/kelulusan', [AdminKelulusanController::class, 'index'])->name('kelulusan');
    Route::post('/kelulusan/{id}/notify', [AdminKelulusanController::class, 'sendNotification'])->name('kelulusan.notify');

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

    // Jurusan Module
    Route::resource('jurusan', \App\Http\Controllers\Admin\JurusanController::class)->except(['show']);

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
});

