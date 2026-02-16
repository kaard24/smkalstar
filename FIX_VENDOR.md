# Cara Memperbaiki Vendor Directory yang Corrupt

## Masalah
Vendor directory corrupt karena proses composer install sebelumnya terinterupsi.

## Solusi Cepat

### Opsi 1: Install Zip Extension PHP (Rekomendasi)

1. Buka file `C:\xampp\php\php.ini`
2. Cari baris `;extension=zip`
3. Hilangkan titik koma di depannya: `extension=zip`
4. Restart XAMPP
5. Jalankan:
```bash
composer install --no-interaction
```

### Opsi 2: Hapus Cache dan Reinstall

```bash
composer clear-cache
rmdir /s /q vendor
composer install --no-interaction --prefer-dist
```

### Opsi 3: Restore dari Git (jika ada)

```bash
git checkout vendor
```

## Catatan Penting

Kode CAPTCHA yang sudah ditambahkan tidak memerlukan package composer tambahan. reCAPTCHA diimplementasikan menggunakan HTTP Client bawaan Laravel (`Illuminate\Support\Facades\Http`).

Jika mendapat error `composer.lock is not up to date`, jalankan:
```bash
composer update --lock
```

## Status Perubahan Kode

File yang sudah dimodifikasi untuk CAPTCHA:
- ✅ `app/Http/Controllers/AuthController.php` - Validasi reCAPTCHA
- ✅ `resources/views/auth/register.blade.php` - Widget reCAPTCHA
- ✅ `resources/views/auth/login.blade.php` - Hapus session password
- ✅ `.env` - Konfigurasi reCAPTCHA
- ✅ `.env.example` - Template konfigurasi
- ✅ `RECAPTCHA_SETUP.md` - Dokumentasi

Setelah vendor diperbaiki, aplikasi akan berjalan normal dengan proteksi CAPTCHA.
