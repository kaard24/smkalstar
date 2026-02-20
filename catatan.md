# 📝 Catatan Penting Sebelum Deploy

> ⚠️ **PERINGATAN KEAMANAN**  
> Baca file ini dengan saksama sebelum mengupload website ke server internet!

---

## 🚨 Prioritas 1: Session Cookie (WAJIB!)

### Sebelum Deploy ke Server Production:

**Ubah di file `.env`:**

```bash
# ❌ SAAT INI (Development/Localhost)
SESSION_SAME_SITE=null

# ✅ WAJIB DIUBAH SAAT DEPLOY (Production)
SESSION_SAME_SITE=lax
```

### Kenapa Penting?

| Environment | Setting | Alasan |
|-------------|---------|--------|
| **Localhost** (`127.0.0.1`) | `null` | Browser memblokir cookie di localhost kalau pakai `lax` |
| **Production** (Server Internet) | `lax` | Melindungi dari serangan CSRF (Cross-Site Request Forgery) |

### Risiko Kalau Lupa:
- 🔓 Website rentan diserang CSRF
- 🔓 Hacker bisa eksekusi aksi tanpa izin user
- 🔓 Data user berpotensi dicuri/dimanipulasi

---

## ✅ Checklist Pre-Deploy

- [ ] `SESSION_SAME_SITE=null` → `SESSION_SAME_SITE=lax`
- [ ] `APP_ENV=local` → `APP_ENV=production`
- [ ] `APP_DEBUG=true` → `APP_DEBUG=false`
- [ ] `APP_URL=http://127.0.0.1:8000` → `APP_URL=https://domain-anda.com`
- [ ] Generate app key baru: `php artisan key:generate`
- [ ] Clear cache: `php artisan config:cache`

---

## 🔒 Rekomendasi Security Lain

### 1. HTTPS (Wajib)
```env
SESSION_SECURE_COOKIE=true  # Hanya kirim cookie via HTTPS
```

### 2. Session Lifetime
```env
SESSION_LIFETIME=120  # 120 menit = 2 jam (default OK)
```

### 3. Database
```env
# Gunakan kredensial database production
DB_DATABASE=nama_database_production
DB_USERNAME=username_production
DB_PASSWORD=password_kuat_yang_berbeda_dari_local
```

---

## 🛠️ Command Setelah Deploy

```bash
# 1. Install dependencies production
composer install --optimize-autoloader --no-dev

# 2. Generate key
php artisan key:generate

# 3. Cache config (biar cepat)
php artisan config:cache
php artisan route:cache
php artisan view:cache

# 4. Migrate database
php artisan migrate --force

# 5. Set permission folder
chmod -R 775 storage bootstrap/cache
```

---

## 📞 Ingat!

> **"Sebelum website di-upload ke server internet, pastikan ubah ke `lax`!"**

---

*Dibuat: 20 Februari 2026*  
*Project: SMK Al-Hidayah Lestari - Sistem Penerimaan Murid Baru*
