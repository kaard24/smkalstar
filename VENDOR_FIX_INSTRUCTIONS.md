# Cara Memperbaiki Vendor Directory

## Masalah
Vendor directory corrupt dan composer install timeout karena PHP tidak memiliki zip extension.

## Solusi Cepat - Aktifkan Zip Extension

### Step 1: Edit php.ini
1. Buka file `C:\xampp\php\php.ini`
2. Cari baris: `;extension=zip`
3. Ubah menjadi: `extension=zip`
4. Save file

### Step 2: Restart Apache
1. Buka XAMPP Control Panel
2. Klik Stop pada Apache
3. Klik Start pada Apache

### Step 3: Install Vendor
Buka CMD/PowerShell dan jalankan:
```bash
cd C:\Users\eka\.gemini\antigravity\scratch\smk-alstar
rmdir /s /q vendor
composer install --no-interaction
```

Ini akan memakan waktu sekitar 5-10 menit tapi akan berhasil.

---

## Alternatif: Download Vendor Zip

Jika zip extension tidak bisa diaktifkan, alternative adalah:

1. Download vendor.zip dari komputer lain yang sudah berhasil install
2. Extract ke folder project
3. Jalankan: `composer dump-autoload`

---

## Status Kode CAPTCHA

Kode CAPTCHA sudah selesai ditambahkan dan siap digunakan setelah vendor diperbaiki:

✅ `app/Http/Controllers/AuthController.php` - Verifikasi reCAPTCHA v3  
✅ `resources/views/auth/register.blade.php` - Widget invisible reCAPTCHA  
✅ `.env` - Konfigurasi reCAPTCHA  

---

## Testing Setelah Vendor Fixed

Setelah vendor berhasil diinstall:

1. Clear cache:
```bash
php artisan config:clear
php artisan cache:clear
php artisan view:clear
```

2. Test reCAPTCHA (tanpa API key):
   - Buka halaman register
   - reCAPTCHA akan bypass karena tidak ada API key
   
3. Setup reCAPTCHA dengan API key:
   - Daftar di https://www.google.com/recaptcha/admin
   - Pilih reCAPTCHA v3
   - Tambahkan domain Anda
   - Copy Site Key dan Secret Key ke `.env`
