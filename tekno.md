# Teknologi & Struktur Project

> Dokumentasi teknologi dan struktur file untuk project **SMK Al-Hidayah Lestari - Sistem Penerimaan Siswa Baru (SPMB)**

---

## 📋 Informasi Project

| Item | Detail |
|------|--------|
| **Nama Project** | SMK Al-Hidayah Lestari - SPMB |
| **Tipe** | Web Application - Pendaftaran Siswa Baru |
| **Versi Laravel** | 12.x |
| **Versi PHP** | ^8.2 |
| **Database** | MySQL |
| **Text Editor** | Anti Gravity |

---

## 🚀 Teknologi Utama

### Backend
| Teknologi | Versi | Keterangan |
|-----------|-------|------------|
| [PHP](https://www.php.net/) | ^8.2 | Bahasa pemrograman server-side |
| [Laravel](https://laravel.com/) | ^12.0 | Framework PHP modern |
| [Laravel Tinker](https://github.com/laravel/tinker) | ^2.10 | REPL untuk Laravel |
| [Composer](https://getcomposer.org/) | - | Dependency Manager PHP |

### Frontend
| Teknologi | Versi | Keterangan |
|-----------|-------|------------|
| [Tailwind CSS](https://tailwindcss.com/) | ^4.0.0 | Utility-first CSS framework |
| [Vite](https://vitejs.dev/) | ^7.0.7 | Build tool & dev server |
| [Alpine.js](https://alpinejs.dev/) | (via CDN) | JavaScript framework ringan |
| [Axios](https://axios-http.com/) | ^1.11.0 | HTTP client |

### Database & Storage
| Teknologi | Keterangan |
|-----------|------------|
| **MySQL** | Database utama |
| Redis | Support untuk cache & queue |
| Laravel Storage | File storage untuk upload berkas |

### Authentication & Security
| Fitur | Implementasi |
|-------|--------------|
| Auth Guard | Custom `spmb` guard untuk calon siswa |
| Admin Auth | Separate authentication untuk admin |
| Rate Limiting | Rate limiter untuk login & registrasi |
| Password Hashing | Bcrypt (default Laravel) |

### Development Tools
| Tool | Keterangan |
|------|------------|
| **Anti Gravity** | Text Editor utama |
| Laravel Pint | Code style fixer |
| Laravel Sail | Docker development environment |
| PHPUnit | Unit testing |
| Faker | Data seeding |
| Mockery | Testing mock objects |

---

## 🌟 Fitur-Fitur Website

### A. Website Publik (Frontend)
| Fitur | Deskripsi |
|-------|-----------|
| **Homepage** | Landing page dengan informasi sekolah, jurusan, dan CTA pendaftaran |
| **Profil Sekolah** | Visi-misi, sejarah singkat, dan struktur organisasi sekolah |
| **Jurusan** | Detail 4 jurusan (RPL, TKJ, DKV, BR) dengan prospek karir |
| **Fasilitas** | Galeri fasilitas sekolah (laboratorium, perpustakaan, dll) |
| **Ekstrakurikuler** | Daftar dan deskripsi kegiatan ekstrakurikuler |
| **Prestasi** | Showcase prestasi siswa dan sekolah |
| **Galeri** | Koleksi foto kegiatan sekolah |
| **Berita** | Artikel berita sekolah dengan sistem komentar |
| **Info Seragam** | Informasi ketentuan seragam sekolah |
| **Pendaftaran Online** | Formulir pendaftaran calon siswa baru |

### B. Sistem SPMB (Siswa)
| Fitur | Deskripsi |
|-------|-----------|
| **Registrasi Akun** | Pendaftaran akun dengan NISN, nama, dan password |
| **Login Siswa** | Autentikasi khusus untuk calon siswa |
| **Dashboard Siswa** | Overview status pendaftaran dan progress |
| **Lengkapi Data** | Pengisian data lengkap calon siswa dan orang tua |
| **Upload Berkas** | Upload dokumen (KK, Akta, Ijazah, Pas Foto, dll) |
| **Pembayaran** | Upload bukti pembayaran formulir pendaftaran |
| **Cek Status** | Monitoring status verifikasi berkas dan pembayaran |
| **Pengumuman Kelulusan** | Cek hasil kelulusan seleksi |
| **Edit Profil** | Update data pribadi dan foto profil |
| **Kalender Akademik** | Informasi jadwal penting pendaftaran |

### C. Panel Admin (Backend)
| Fitur | Deskripsi |
|-------|-----------|
| **Dashboard Admin** | Statistik pendaftar, chart, dan ringkasan data |
| **Manajemen Pendaftar** | CRUD data calon siswa, verifikasi akun |
| **Verifikasi Berkas** | Review dan approve/reject dokumen siswa |
| **Input Nilai Tes** | Entry nilai wawancara dan minat bakat |
| **Manajemen Kelulusan** | Tentukan status kelulusan siswa |
| **Manajemen Pembayaran** | Verifikasi bukti pembayaran siswa |
| **Manajemen Jurusan** | Kelola data jurusan (RPL, TKJ, DKV, BR) |
| **CMS Berita** | Buat, edit, hapus artikel berita |
| **CMS Galeri** | Upload dan kelola foto galeri |
| **CMS Fasilitas** | Kelola informasi fasilitas sekolah |
| **CMS Ekstrakurikuler** | Kelola data ekstrakurikuler |
| **CMS Prestasi** | Input dan edit prestasi sekolah/siswa |
| **Profil Sekolah** | Edit visi-misi, sejarah, struktur organisasi |
| **Cache Management** | Clear cache frontend/backend |
| **Export Data** | Export data pendaftar ke Excel/PDF |

---

## 📝 Alur SPMB - Langkah-langkah Pendaftaran Siswa

```
┌─────────────────────────────────────────────────────────────────────────────┐
│                         ALUR PENDAFTARAN SISWA BARU                         │
└─────────────────────────────────────────────────────────────────────────────┘

STEP 1: REGISTRASI AKUN
├── Buka halaman /register
├── Isi data: NISN (10 digit), Nama Lengkap, Jenis Kelamin
├── Pilih Jurusan 1 dan Jurusan 2 (alternatif)
├── Isi Tempat Lahir, Tanggal Lahir, Asal Sekolah
├── Isi Nomor WhatsApp (format: 62xxxxxxxxxx)
├── Buat Password (min 8 karakter, huruf besar/kecil, angka, simbol)
├── Konfirmasi password
└── Klik "Daftar Sekarang"
    └── ✓ Akun berhasil dibuat, redirect ke login

STEP 2: LOGIN
├── Buka halaman /login
├── Masukkan NISN dan Password
└── Klik "Masuk"
    └── ✓ Berhasil login, masuk ke Dashboard SPMB

STEP 3: LENGKAPI DATA PRIBADI
├── Klik menu "Lengkapi Data"
├── Upload Foto Profil (opsional)
├── Isi Data Lengkap Calon Siswa:
│   ├── NIK (16 digit)
│   ├── Nomor KK
│   ├── Alamat Lengkap
│   ├── Agama
│   ├── Anak ke- / Jumlah Saudara
│   ├── Minat & Bakat
│   └── Prestasi (jika ada)
├── Isi Data Orang Tua:
│   ├── Data Ayah (NIK, Nama, Pekerjaan, Penghasilan, No. HP)
│   ├── Data Ibu (NIK, Nama, Pekerjaan, Penghasilan, No. HP)
│   └── Data Wali (jika ada)
└── Simpan Data
    └── ✓ Status: Data Lengkap

STEP 4: UPLOAD BERKAS
├── Klik menu "Upload Berkas"
├── Upload dokumen yang diperlukan:
│   ├── 📄 Kartu Keluarga (KK)
│   ├── 📄 Akta Kelahiran
│   ├── 📄 Ijazah SMP/Surat Keterangan Lulus
│   ├── 📄 KTP Orang Tua
│   ├── 📄 Pas Foto 3x4 (background merah/biru)
│   └── 📄 Raport (opsional)
├── Pastikan file: JPG/PNG/PDF, max 2MB
└── Submit Berkas
    └── ⏳ Menunggu Verifikasi Admin

STEP 5: PEMBAYARAN
├── Klik menu "Pembayaran"
├── Lihat informasi biaya pendaftaran
├── Transfer ke rekening sekolah
├── Upload bukti transfer
├── Tunggu verifikasi pembayaran
└── ✓ Status: Pembayaran Terverifikasi

STEP 6: TES/WAWANCARA (Jadwal ditentukan Admin)
├── Ikuti jadwal tes yang diumumkan
├── Tes Wawancara
├── Tes Minat & Bakat
└── ⏳ Menunggu Input Nilai dari Admin

STEP 7: PENGAUMUMAN KELULUSAN
├── Klik menu "Pengumuman"
├── Cek status kelulusan:
│   ├── 🎉 LULUS - Jurusan: [Nama Jurusan]
│   └── ❌ TIDAK LULUS
├── Jika lulus:
│   ├── Download Surat Kelulusan
│   ├── Download Kartu Ujian
│   └── Ikuti instruksi daftar ulang
└── ✓ Pendaftaran Selesai
```

---

## 👨‍💼 Hak Akses Admin - Apa Saja yang Bisa Dilakukan

### 1. Dashboard Admin
- Melihat statistik total pendaftar
- Melihat pendaftar per jurusan
- Melihat status pembayaran (pending/verified)
- Melihat status verifikasi berkas
- Chart/graph perkembangan pendaftaran
- Notifikasi pendaftar baru

### 2. Manajemen Pendaftar (Menu: Data Pendaftar)
- **Lihat Semua Pendaftar**: Tabel dengan filter & search
- **Detail Pendaftar**: Lihat profil lengkap siswa
- **Tambah Pendaftar**: Input manual pendaftar baru
- **Edit Data**: Update data siswa jika ada kesalahan
- **Hapus Pendaftar**: Hapus data yang tidak valid
- **Reset Password**: Reset password siswa
- **Export Data**: Export ke Excel/CSV/PDF
- **Filter**: Berdasarkan jurusan, status, gelombang

### 3. Verifikasi Berkas (Menu: Verifikasi Berkas)
- **Daftar Berkas Menunggu**: Tabel berkas pending
- **Review Berkas**: Preview dokumen yang diupload
- **Approve Berkas**: Setujui berkas yang valid
- **Reject Berkas**: Tolak dengan alasan/keterangan
- **Request Ulang**: Minta siswa upload ulang jika tidak jelas
- **Status Berkas**: Tracking status tiap dokumen

### 4. Input Nilai Tes (Menu: Input Nilai)
- **Daftar Peserta Tes**: List siswa yang akan diuji
- **Input Nilai Wawancara**: Entry nilai 0-100
- **Input Nilai Minat Bakat**: Entry penilaian tulis
- **Catatan Tes**: Tambah komentar/keterangan
- **Update Nilai**: Edit nilai jika ada kesalahan

### 5. Manajemen Kelulusan (Menu: Kelulusan)
- **Setting Kriteria**: Tentukan passing grade
- **Proses Seleksi**: Sistem otomatis seleksi berdasarkan nilai
- **Status Kelulusan**:
  - Tentukan siswa LULUS / TIDAK LULUS
  - Penentuan jurusan untuk yang lulus
  - Generate nomor pendaftaran
- **Pengumuman**: Publish/unpublish hasil
- **Surat Kelulusan**: Generate PDF surat kelulusan
- **Kartu Ujian**: Generate kartu ujian

### 6. Manajemen Pembayaran (Menu: Pembayaran)
- **Daftar Pembayaran**: Semua transaksi pembayaran
- **Verifikasi Transfer**: Cek & approve bukti transfer
- **Tolak Pembayaran**: Reject jika bukti tidak valid
- **Riwayat Pembayaran**: Track semua transaksi
- **Laporan Keuangan**: Ringkasan pemasukan pendaftaran
- **Setting Biaya**: Atur nominal biaya pendaftaran

### 7. Manajemen Jurusan (Menu: Jurusan)
- **Lihat Jurusan**: List 4 jurusan (RPL, TKJ, DKV, BR)
- **Edit Jurusan**: Update deskripsi, kuota, prospek
- **Setting Kuota**: Atur jumlah penerimaan per jurusan
- **Status Jurusan**: Aktif/non-aktifkan pendaftaran jurusan

### 8. CMS Website

#### 8.1 Berita (Menu: Berita)
- Buat artikel baru dengan editor
- Upload gambar thumbnail
- Set kategori berita
- Publish/draft artikel
- Edit & hapus berita
- **Moderasi Komentar**: Approve/hapus komentar pengunjung

#### 8.2 Galeri (Menu: Galeri)
- Upload foto kegiatan
- Buat album/kategori
- Tambah keterangan foto
- Hapus foto

#### 8.3 Fasilitas (Menu: Fasilitas)
- Tambah fasilitas baru
- Upload gambar fasilitas
- Edit deskripsi
- Urutkan tampilan

#### 8.4 Ekstrakurikuler (Menu: Ekstrakurikuler)
- Input data ekskul baru
- Upload logo/foto ekskul
- Edit jadwal kegiatan
- Deskripsi kegiatan

#### 8.5 Prestasi (Menu: Prestasi)
- Tambah prestasi siswa/sekolah
- Upload foto/sertifikat
- Kategori prestasi (akademik/non-akademik)
- Tingkat prestasi (lokal/nasional/internasional)

### 9. Profil Sekolah (Menu: Profil)
- **Visi & Misi**: Edit teks visi-misi sekolah
- **Sejarah**: Update sejarah singkat sekolah
- **Struktur Organisasi**:
  - Kelola bagan struktur
  - Tambah/edit jabatan
  - Upload foto pejabat

### 10. Tools Admin
- **Clear Cache**: Hapus cache frontend
- **Generate Sitemap**: Buat sitemap.xml
- **Mode Maintenance**: Aktifkan/nonaktifkan maintenance mode

---

## 📁 Struktur File Project

```
smk-alstar/
├── 📂 app/                          # Core Application
│   ├── 📂 Console/
│   │   └── 📂 Commands/             # Artisan Commands
│   │       ├── ClearFrontendCache.php
│   │       └── GenerateSitemap.php
│   ├── 📂 Http/
│   │   ├── 📂 Controllers/          # Controllers
│   │   │   ├── 📂 Admin/            # Admin Controllers
│   │   │   │   ├── BeritaController.php
│   │   │   │   ├── EkstrakurikulerController.php
│   │   │   │   ├── FasilitasController.php
│   │   │   │   ├── GaleriController.php
│   │   │   │   ├── PrestasiController.php
│   │   │   │   ├── ProfilSekolahController.php
│   │   │   │   └── StrukturOrganisasiController.php
│   │   │   ├── AdminAuthController.php
│   │   │   ├── AdminCacheController.php
│   │   │   ├── AdminDashboardController.php
│   │   │   ├── AdminKelulusanController.php
│   │   │   ├── AdminPembayaranController.php
│   │   │   ├── AdminSpmbController.php
│   │   │   ├── AdminVerifikasiController.php
│   │   │   ├── AuthController.php       # Auth Calon Siswa
│   │   │   ├── BeritaController.php
│   │   │   ├── BerkasController.php
│   │   │   ├── ProfilSiswaController.php
│   │   │   ├── PublicPageController.php
│   │   │   ├── SpmbController.php
│   │   │   ├── SpmbDashboardController.php
│   │   │   └── SpmbPembayaranController.php
│   │   └── 📂 Middleware/           # Custom Middleware
│   │       └── CacheHeaders.php
│   ├── 📂 Models/                   # Eloquent Models
│   │   ├── Admin.php
│   │   ├── Berita.php
│   │   ├── BerkasPendaftaran.php
│   │   ├── CalonSiswa.php
│   │   ├── Ekstrakurikuler.php
│   │   ├── Fasilitas.php
│   │   ├── Galeri.php
│   │   ├── Jurusan.php
│   │   ├── KomentarBerita.php
│   │   ├── LogWhatsapp.php
│   │   ├── OrangTua.php
│   │   ├── Pembayaran.php
│   │   ├── Pendaftaran.php
│   │   ├── Pengumuman.php
│   │   ├── Prestasi.php
│   │   ├── ProfilSekolah.php
│   │   ├── StrukturOrganisasiMember.php
│   │   ├── StrukturOrganisasiSection.php
│   │   └── Tes.php
│   ├── 📂 Providers/
│   │   └── AppServiceProvider.php
│   ├── 📂 Services/
│   │   └── WhatsAppService.php      # WhatsApp integration
│   └── 📂 Traits/
│       └── ClearsCache.php          # Cache management trait
│
├── 📂 bootstrap/                    # Bootstrap files
│   └── 📂 cache/
│
├── 📂 config/                       # Configuration files
│   ├── app.php
│   ├── auth.php
│   ├── cache.php
│   ├── database.php
│   ├── filesystems.php
│   ├── logging.php
│   ├── mail.php
│   ├── queue.php
│   ├── services.php
│   └── session.php
│
├── 📂 database/
│   ├── 📂 factories/                # Model factories
│   ├── 📂 migrations/               # Database migrations (50+ files)
│   │   ├── 0001_01_01_000000_create_users_table.php
│   │   ├── 2026_01_27_031411_create_jurusan_table.php
│   │   ├── 2026_01_27_031412_create_calon_siswa_table.php
│   │   ├── 2026_01_27_031413_create_orang_tua_table.php
│   │   ├── 2026_01_27_031414_create_pendaftaran_table.php
│   │   ├── 2026_01_27_031415_create_tes_table.php
│   │   ├── 2026_01_27_031416_create_log_whatsapp_table.php
│   │   ├── 2026_01_28_004605_create_fasilitas_table.php
│   │   ├── 2026_01_28_000001_create_ekstrakurikuler_table.php
│   │   ├── 2026_01_28_000002_create_prestasi_table.php
│   │   ├── 2026_01_28_004605_create_profil_sekolah_table.php
│   │   ├── 2026_01_29_092800_create_struktur_organisasi_tables.php
│   │   ├── 2026_01_29_095700_create_berita_tables.php
│   │   ├── 2026_01_29_094500_create_galeri_table.php
│   │   ├── 2026_02_08_010611_create_pembayaran_table.php
│   │   └── ... (50+ migration files)
│   └── 📂 seeders/                  # Database seeders
│
├── 📂 public/                       # Public assets
│   ├── 📂 build/                    # Vite build output
│   ├── 📂 images/                   # Uploaded images
│   ├── index.php
│   └── .htaccess
│
├── 📂 resources/                    # Resources
│   ├── 📂 css/
│   │   └── app.css                  # Main CSS entry
│   ├── 📂 js/
│   │   └── app.js                   # Main JS entry
│   └── 📂 views/                    # Blade templates
│       ├── 📂 admin/                # Admin panel views
│       │   ├── 📂 berita/
│       │   ├── 📂 ekstrakurikuler/
│       │   ├── 📂 fasilitas/
│       │   ├── 📂 galeri/
│       │   ├── 📂 pembayaran/
│       │   ├── 📂 prestasi/
│       │   ├── berkas-verifikasi.blade.php
│       │   ├── dashboard.blade.php
│       │   ├── input_nilai.blade.php
│       │   ├── kelulusan.blade.php
│       │   ├── login.blade.php
│       │   ├── pendaftar.blade.php
│       │   ├── profil-sejarah.blade.php
│       │   ├── profil-struktur.blade.php
│       │   └── profil-visi-misi.blade.php
│       ├── 📂 auth/                 # Authentication views
│       │   ├── login.blade.php
│       │   └── register.blade.php
│       ├── 📂 berita/               # Public berita views
│       ├── 📂 errors/               # Error pages
│       ├── 📂 jurusan/              # Jurusan detail views
│       ├── 📂 layouts/              # Layout templates
│       │   ├── admin.blade.php      # Admin layout
│       │   └── app.blade.php        # Public layout
│       ├── 📂 legal/                # Legal pages (privacy, terms)
│       ├── 📂 partials/             # Partial templates
│       │   ├── bottom-nav.blade.php
│       │   ├── footer.blade.php
│       │   └── header.blade.php
│       ├── 📂 spmb/                 # SPMB panel views
│       │   ├── berkas.blade.php
│       │   ├── dashboard.blade.php
│       │   ├── edit-profil.blade.php
│       │   ├── info.blade.php
│       │   ├── kalender.blade.php
│       │   ├── lengkapi-data.blade.php
│       │   ├── pembayaran.blade.php
│       │   ├── pengumuman.blade.php
│       │   ├── profil.blade.php
│       │   ├── register.blade.php
│       │   └── status.blade.php
│       ├── berita.blade.php
│       ├── ekstrakurikuler.blade.php
│       ├── fasilitas.blade.php
│       ├── galeri.blade.php
│       ├── home.blade.php           # Homepage
│       ├── prestasi.blade.php
│       ├── profil.blade.php
│       └── seragam.blade.php
│
├── 📂 routes/                       # Route definitions
│   ├── console.php
│   └── web.php                      # Web routes
│
├── 📂 storage/                      # Storage
│   ├── 📂 app/
│   │   └── 📂 public/
│   │       └── 📂 uploads/          # File uploads
│   ├── 📂 framework/
│   │   ├── 📂 cache/
│   │   ├── 📂 sessions/
│   │   └── 📂 views/
│   └── 📂 logs/
│
├── 📂 tests/                        # Testing
│   ├── 📂 Feature/
│   └── 📂 Unit/
│
├── 📂 vendor/                       # Composer dependencies
│
├── 📄 .env                          # Environment variables
├── 📄 .env.example                  # Environment template
├── 📄 artisan                       # Artisan CLI
├── 📄 composer.json                 # PHP dependencies
├── 📄 composer.lock                 # Locked PHP dependencies
├── 📄 package.json                  # Node.js dependencies
├── 📄 package-lock.json             # Locked Node dependencies
├── 📄 tailwind.config.js            # Tailwind CSS config
├── 📄 vite.config.js                # Vite config
├── 📄 phpunit.xml                   # PHPUnit config
├── 📄 postcss.config.js             # PostCSS config
├── 📄 README.md                     # Project readme
└── 📄 tekno.md                      # This file
```

---

## 🔧 Konfigurasi Utama

### Environment Variables (.env)

```env
# Application
APP_NAME="SMK Al-Hidayah"
APP_ENV=local
APP_KEY=base64:...
APP_DEBUG=true
APP_URL=http://localhost

# Database (MySQL)
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=smk_alhidayah
DB_USERNAME=root
DB_PASSWORD=

# Session & Cache
SESSION_DRIVER=database
CACHE_STORE=database
QUEUE_CONNECTION=database
```

### Tailwind CSS Config

```javascript
// Custom colors
primary: {
    DEFAULT: '#0EA5E9',    // Sky blue
    50: '#F0F9FF',
    500: '#0EA5E9',
    900: '#0C4A6E',
},
secondary: '#F97316',      // Orange
navy: '#1E3A5F',           // Navy blue
accent: '#F97316',
ice: '#F0F9FF',
```

---

## 📝 Command Penting

```bash
# Setup project
composer run setup

# Development server
composer run dev

# Testing
composer run test

# Code style
./vendor/bin/pint

# Artisan commands
php artisan migrate
php artisan db:seed
php artisan cache:clear
php artisan config:clear
php artisan view:clear

# Generate sitemap
php artisan sitemap:generate

# Clear frontend cache
php artisan cache:frontend:clear
```

---

## 📊 Database Schema (Ringkasan)

### Tabel Utama
| Tabel | Fungsi |
|-------|--------|
| `calon_siswa` | Data calon siswa (auth) |
| `orang_tua` | Data orang tua/wali |
| `pendaftaran` | Data pendaftaran & jurusan pilihan |
| `tes` | Nilai tes & status kelulusan |
| `pembayaran` | Riwayat pembayaran |
| `berkas_pendaftaran` | File upload berkas |
| `jurusan` | Data jurusan sekolah |
| `admin` | Data admin panel |
| `berita` | CMS berita |
| `galeri` | CMS galeri |
| `fasilitas` | CMS fasilitas |
| `ekstrakurikuler` | CMS ekstrakurikuler |
| `prestasi` | CMS prestasi |
| `profil_sekolah` | Data profil sekolah |
| `struktur_organisasi_sections` | Bagan struktur organisasi |
| `struktur_organisasi_members` | Anggota struktur organisasi |

---

## 🔐 Security Features

- **Rate Limiting**: Login & registrasi dilimit
- **Password Requirements**: Min 8 karakter, huruf besar/kecil, angka, simbol
- **CSRF Protection**: Laravel CSRF token
- **XSS Protection**: Blade `{{ }}` auto-escape
- **SQL Injection**: Eloquent ORM parameter binding
- **File Upload**: Validasi tipe & ukuran file

---

## 📦 Dependencies Utama

### PHP (composer.json)
```json
{
    "php": "^8.2",
    "laravel/framework": "^12.0",
    "laravel/tinker": "^2.10.1"
}
```

### Node.js (package.json)
```json
{
    "@tailwindcss/vite": "^4.0.0",
    "axios": "^1.11.0",
    "concurrently": "^9.0.1",
    "laravel-vite-plugin": "^2.0.0",
    "tailwindcss": "^4.0.0",
    "vite": "^7.0.7"
}
```

---

## 📚 Referensi

- [Laravel Documentation](https://laravel.com/docs/12.x)
- [Tailwind CSS Documentation](https://tailwindcss.com/docs)
- [Vite Documentation](https://vitejs.dev/guide/)
- [Alpine.js Documentation](https://alpinejs.dev/)

---

*Dibuat dengan ❤️ menggunakan Anti Gravity*  
*Terakhir update: Februari 2026*
