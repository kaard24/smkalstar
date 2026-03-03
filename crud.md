# Analisis CRUD Admin vs Halaman User (Setelah Perbaikan)

Tanggal analisis: 2026-03-03  
Project: smk-alstar (Laravel)

## Ringkasan hasil
- CRUD admin yang dicek: **18 modul**.
- Modul yang terkoneksi ke halaman user: **17**.
- Modul admin-only (memang bukan halaman user publik): **1** (`admin/kajur`).
- Status `PARTIAL` dan `NO` pada analisis sebelumnya sudah ditangani di kode.

Status legend:
- `OK` = CRUD jalan dan tampil/terpakai di user page.
- `ADMIN-ONLY` = khusus panel internal.

## Matriks per modul

| Modul Admin | Status | Catatan koneksi |
|---|---|---|
| Pendaftar (`admin/pendaftar`) | OK | Sinkron ke status/dashboard/pengumuman siswa. |
| Pembayaran (`admin/pembayaran`) | OK | Verifikasi admin tampil di halaman pembayaran siswa. |
| Pengaturan Pembayaran (`admin/pembayaran-pengaturan`) | OK | Dipakai langsung di `/spmb/pembayaran`. |
| Hero Beranda (`admin/hero`) | OK | Dipakai di beranda `/`. |
| Beranda Section (`admin/beranda`) | OK | Sudah dirender di beranda user sebagai section dinamis. |
| Profil Sekolah (`admin/profil-sekolah/*`) | OK | Tampil di `/profil` dan bagian sejarah beranda. |
| Struktur Organisasi (`admin/struktur-organisasi/*`) | OK | Tampil di `/profil`. |
| Fasilitas (`admin/fasilitas`) | OK | Koneksi ke `/fasilitas` + home, cache invalidation sudah diperluas. |
| Ekstrakurikuler (`admin/ekstrakurikuler`) | OK | Tampil di `/ekstrakurikuler`. |
| Prestasi (`admin/prestasi`) | OK | Tampil di `/prestasi`. |
| Galeri (`admin/galeri`) | OK | Tampil di `/galeri` + home, cache invalidation sudah diperluas. |
| Berita (`admin/berita`) | OK | Tampil di `/berita` + home, cache invalidation `berita_home` sudah ditambah. |
| Jurusan (`admin/jurusan`) | OK | Tampil di `/jurusan/{slug}` dan kartu home sudah dinamis dari DB. |
| Kajur Account (`admin/kajur`) | ADMIN-ONLY | Khusus panel kajur. |
| Footer (`admin/footer`) | OK | Link info SPMB sudah benar ke `/spmb/info`. |
| Seragam (`admin/seragam`) | OK | Tampil di `/seragam`. |
| SPMB Konten (`admin/spmb/*`) | OK | `/spmb` dan `/spmb/info` kini pakai sumber data controller yang sama. |
| Berkas Admin (`admin/berkas`) | OK | Sinkron ke modul berkas siswa. |

## Perubahan kode yang dilakukan
1. Sinkronisasi source SPMB:
- `routes/web.php`: route `GET /spmb` diubah ke `PublicPageController@spmbInfo` (sama dengan `/spmb/info`).

2. Perbaikan link footer:
- `resources/views/partials/footer.blade.php`: `'/ppdb/info'` -> `'/spmb/info'`.

3. Perbaikan invalidasi cache home:
- `app/Models/Fasilitas.php`: cache key menjadi `['fasilitas_aktif', 'fasilitas_home']`.
- `app/Models/Galeri.php`: cache key menjadi `['galeri_aktif', 'galeri_home']`.
- `app/Models/Berita.php`: tambah clear `berita_home`.
- `app/Models/Jurusan.php`: tambah clear `jurusan_home`.

4. Koneksi `admin/beranda` ke user:
- `app/Http/Controllers/PublicPageController.php`: load `BerandaSection::active()->ordered()->get()->groupBy('tipe')` untuk home.
- `resources/views/home.blade.php`: render section dinamis dari `admin/beranda`.

5. Jurusan home jadi dinamis:
- `app/Http/Controllers/PublicPageController.php`: tambah `jurusanHome` dari DB.
- `resources/views/home.blade.php`: kartu jurusan sekarang pakai data `Jurusan` (bukan array hardcoded).

## Checklist uji cepat
1. Update data di `admin/spmb/*`, cek `/spmb` dan `/spmb/info` hasilnya sama.
2. Update fasilitas/galeri/berita, cek perubahan langsung muncul di home.
3. Update jurusan (nama/logo), cek kartu jurusan home ikut berubah.
4. Klik link "Info SPMB" di footer, pastikan menuju `/spmb/info`.
5. Update section di `admin/beranda`, pastikan section tampil di beranda user.
