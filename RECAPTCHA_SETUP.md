# Panduan Setup Google reCAPTCHA

Aplikasi SMK Alstar telah dilengkapi dengan Google reCAPTCHA v3 pada halaman registrasi untuk mencegah serangan bot dan spam registrasi.

## Langkah Setup

### 1. Daftar di Google reCAPTCHA

1. Kunjungi [Google reCAPTCHA Admin Console](https://www.google.com/recaptcha/admin)
2. Login dengan akun Google Anda
3. Klik "Create" atau "Buat"

### 2. Isi Form Pendaftaran

| Field | Nilai |
|-------|-------|
| Label | SPMB SMK Alstar |
| reCAPTCHA Type | reCAPTCHA v3 |
| Domains | `localhost`, `127.0.0.1`, `domain-anda.com` |
| Owners | Email admin |

### 3. Dapatkan API Keys

Setelah membuat, Anda akan mendapatkan:
- **Site Key** (untuk frontend)
- **Secret Key** (untuk backend)

### 4. Konfigurasi di Aplikasi

Tambahkan ke file `.env`:

```env
RECAPTCHA_SITE_KEY=your_site_key_here
RECAPTCHA_SECRET_KEY=your_secret_key_here
RECAPTCHA_ENABLED=true
```

### 5. Testing

Untuk development tanpa reCAPTCHA:
```env
RECAPTCHA_ENABLED=false
```

Atau gunakan test keys dari Google:
```env
# Test Keys (selalu lolos verifikasi)
RECAPTCHA_SITE_KEY=6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI
RECAPTCHA_SECRET_KEY=6LeIxAcTAAAAAGG-vFI1TnRWxMZNFuojJ4WifJWe
```

## Fitur Keamanan Tambahan

- ✅ Rate limiting: Maksimal 3 percobaan registrasi per IP
- ✅ Session encryption support
- ✅ Validasi server-side reCAPTCHA
- ✅ Logging untuk percobaan gagal

## Troubleshooting

### Error "Verifikasi keamanan gagal"
- Pastikan Site Key dan Secret Key benar
- Periksa domain yang didaftarkan
- Cek koneksi internet (reCAPTCHA membutuhkan akses ke Google)

### reCAPTCHA tidak muncul
- reCAPTCHA v3 bekerja invisible (tidak ada checkbox)
- Cek console browser untuk error JavaScript
- Pastikan `RECAPTCHA_SITE_KEY` sudah di-set di `.env`

### Development lokal
Untuk testing lokal, tambahkan `localhost` dan `127.0.0.1` di daftar domain reCAPTCHA.
