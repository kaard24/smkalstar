# REKOMENDASI UNTUK BAGIAN USER
## SMK Alstar - Sistem Penerimaan Murid Baru (SPMB)

**Berdasarkan Hasil Black Box Testing**  
**Tanggal:** 4 Februari 2026

---

## 1. OVERVIEW USER EXPERIENCE

Berdasarkan hasil testing, bagian user secara fungsional **sudah baik**, namun terdapat beberapa area yang bisa ditingkatkan untuk memberikan pengalaman yang lebih baik bagi calon siswa dan pengunjung website.

### Skor UX Saat Ini: ⭐⭐⭐⭐ (4/5)

---

## 2. REKOMENDASI PRIORITAS TINGGI

### 2.1 PROGRESS INDICATOR YANG LEBIH JELAS

**Masalah Saat Ini:**
- Progress bar sudah ada tapi bisa lebih informatif
- Siswa sulit memahami apa saja yang masih kurang

**Rekomendasi:**
Tambahkan checklist visual yang jelas:
```
☑️ Akun Terdaftar
☑️ Data Diri Lengkap  
☑️ Data Orang Tua/Wali
☑️ Jurusan Dipilih
☐ Upload Berkas (2/3 selesai)
   ├── ☑️ Kartu Keluarga
   ├── ☑️ Akta Kelahiran
   └── ☐ SKL/Ijazah (kurang)
☐ Tes & Wawancara
☐ Kelulusan
```

**Implementasi:** Modifikasi `resources/views/spmb/status.blade.php`

---

### 2.2 WHATSAPP VALIDATION REAL-TIME

**Masalah Saat Ini:**
- Validasi nomor WhatsApp hanya saat submit
- Format tidak otomatis dikonversi

**Rekomendasi:**
```
Input: 08123456789
Auto-format: 628123456789

Validasi real-time dengan warna:
🟢 Hijau: Format benar (62xxxxxxxxxx)
🔴 Merah: Format salah
```

**File yang perlu diubah:**
- `resources/views/auth/register.blade.php`
- `resources/views/spmb/lengkapi-data.blade.php`

---

### 2.3 UPLOAD BERKAS - DRAG & DROP + PREVIEW

**Masalah Saat Ini:**
- Upload hanya dengan button click
- Tidak ada preview sebelum upload
- User tidak tahu file sudah benar atau belum

**Rekomendasi Implementasi:**
```
Drag & Drop Berkas di sini
atau klik browse

Preview:
📄 KK        📄 Akta      ⬜ SKL
✓ 500KB     ✓ 400KB     Belum
[Hapus]     [Hapus]     upload
```

**Benefit:**
- Mencegah kesalahan upload file yang salah
- UX lebih modern dan intuitif

---

### 2.4 NOTIFIKASI WHATSAPP OTOMATIS

**Masalah Saat Ini:**
- Notifikasi WA hanya untuk kelulusan
- Tidak ada reminder untuk melengkapi data

**Rekomendasi Alur Notifikasi:**
```
1. Setelah Register → "Selamat! Akun Anda terdaftar."
2. Data Belum Lengkap (H+3) → "Jangan lupa lengkapi data..."
3. Berkas Kurang (H+7) → "Upload berkas segera..."
4. Jadwal Tes → "Jadwal tes: [Tanggal]"
5. Hasil Kelulusan → "Selamat! Anda dinyatakan LULUS"
```

**File yang perlu diubah:**
- `app/Http/Controllers/AuthController.php`
- `app/Http/Controllers/SpmbController.php`
- `app/Http/Controllers/BerkasController.php`

---

### 2.5 PANDUAN FORMAT FILE YANG JELAS

**Masalah Saat Ini:**
- User sering salah upload (file terlalu besar, format salah)
- Error message muncul setelah upload

**Rekomendasi Tampilan:**
```
Panduan Upload Berkas:

Kartu Keluarga (KK)
   Format: PDF, JPG, PNG
   Maksimal: 2 MB
   Contoh: kk_andi.pdf

Akta Kelahiran
   Format: PDF, JPG, PNG
   Maksimal: 2 MB

SKL atau Ijazah
   Format: PDF, JPG, PNG
   Maksimal: 2 MB
   Catatan: Upload SKL jika belum lulus, atau Ijazah jika sudah
```

---

## 3. REKOMENDASI PRIORITAS MEDIUM

### 3.1 SEARCH JURUSAN DENGAN FILTER

**Masalah Saat Ini:**
- Halaman jurusan hanya menampilkan list biasa
- Tidak ada informasi kuota/jumlah pendaftar

**Rekomendasi Fitur:**
```
Cari Jurusan...

Filter: [Semua] [Teknologi] [Bisnis] [Kesehatan]
Sort: [Nama] [Popularitas] [Kuota]

Rekayasa Perangkat Lunak (RPL)
   Kuota: 120 | Terisi: 85
   Rating: 4.5/5 (32 reviews)
   [Lihat Detail]
```

---

### 3.2 KALENDER AKADEMIK INTERAKTIF ✅ IMPLEMENTED

**Status:** ✅ **SUDAH DIIMPLEMENTASIKAN**  
**URL:** `/spmb/kalender`  
**File:** `resources/views/spmb/kalender.blade.php`

**Fitur yang Diimplementasikan:**
- ✅ Timeline 2 gelombang pendaftaran (Gelombang 1, 2)
- ✅ Jadwal tes masuk per gelombang
- ✅ Jadwal pengumuman hasil seleksi
- ✅ Countdown timer global (otomatis menghitung mundur ke event berikutnya)
- ✅ Status dinamis per tahapan: `SELESAI`, `BERLANGSUNG`, `MENDATANG`
- ✅ Highlight gelombang yang sedang aktif
- ✅ Sisa waktu pendaftaran/tes yang sedang berlangsung
- ✅ Link cepat ke halaman pengumuman
- ✅ Desain responsif dengan gradient modern

```
Timeline SPMB 2026/2027

Gelombang 1 [SEDANG DIBUKA]
├── Pendaftaran: 1 Januari - 23 Mei 2026
├── Tes Masuk: 26-28 Mei 2026
└── Pengumuman: 1 Juni 2026

Gelombang 2 [AKAN DATANG]
├── Pendaftaran: 24 Mei - 4 Juli 2026
├── Tes Masuk: 7-9 Juli 2026
└── Pengumuman: 12 Juli 2026
```

**Menu Navigasi:**
- Desktop: Dropdown menu "SPMB" di header
- Mobile: Dropdown menu "SPMB" di grid menu dan bottom navigation

---

### 3.3 FAQ INTERAKTIF

**Masalah Saat Ini:**
- Banyak siswa bertanya hal yang sama
- Tidak ada self-service untuk info umum

**Rekomendasi:**
```
FAQ - Pertanyaan Umum

Q: Bagaimana cara mendaftar?
A: Klik tombol daftar, isi NISN dan data diri...

Q: Berkas apa saja yang diperlukan?
A: 1. KK, 2. Akta, 3. SKL/Ijazah...

Q: Apakah bisa daftar tanpa NISN?
A: Tidak, NISN wajib...

Butuh bantuan? Hubungi kami:
WhatsApp: 0812-XXXX-XXXX
Email: info@smkalstar.sch.id
```

---

### 3.4 LEADERBOARD / STATISTIK PUBLIK ✅ IMPLEMENTED

**Status:** ✅ **SUDAH DIIMPLEMENTASIKAN**  
**URL:** `/spmb/pengumuman`  
**File:** `resources/views/spmb/pengumuman.blade.php`

**Fitur yang Diimplementasikan:**
- ✅ **Total Pendaftar Real-time** - Counter otomatis dari database
- ✅ **Jurusan Favorit** - Ranking jurusan dengan progress bar visual
- ✅ **Statistik per Gelombang** - Distribusi pendaftar per gelombang
- ✅ **Pendaftar Terbaru** - 5 pendaftar terakhir dengan inisial (privasi terjaga)
- ✅ **API Endpoint** - `/spmb/api/statistik` untuk data JSON real-time
- ✅ **Visualisasi Progress Bar** - Persentase pendaftar per jurusan
- ✅ **Responsive Design** - Tampilan optimal di desktop & mobile

```
Statistik SPMB 2026/2027 (Real-time)

📊 Total Pendaftar: 1,234 siswa

🏆 Jurusan Favorit:
🥇 TKJ - 456 pendaftar (37%)
🥈 MPLB - 389 pendaftar (31%)
🥉 AKL - 245 pendaftar (20%)
    BR - 144 pendaftar (12%)

📈 Per Gelombang:
    Gel. 1: 523 | Gel. 2: 456 | Gel. 3: 255

⏱️ Pendaftar Terbaru:
    AB - Daftar TKJ (5 menit lalu)
    CD - Daftar MPLB (12 menit lalu)
    ...
```

**Technical Details:**
- Data diambil langsung dari tabel `pendaftaran` dan `jurusan`
- Cache-friendly: data diquery real-time tanpa cache untuk akurasi
- Privacy protection: nama lengkap disembunyikan, hanya tampil inisial
- API tersedia untuk integrasi dengan komponen frontend lainnya

**Benefit:**
- ✅ Membangun trust calon siswa dengan transparansi data
- ✅ Mendorong persaingan sehat antar jurusan
- ✅ Memberikan gambaran popularitas jurusan
- ✅ Motivasi bagi calon siswa untuk segera mendaftar

---

### 3.5 SIMULASI TES ONLINE

**Rekomendasi Fitur Baru:**
```
Simulasi Tes Masuk

Latihan soal-soal yang sering muncul:
☐ Tes Logika (10 soal)
☐ Tes Minat Bakat (15 soal)  
☐ Tes BTQ (5 soal)

[Mulai Simulasi] [Lihat Hasil Tes Saya]
```

**Manfaat:**
- Siswa lebih siap menghadapi tes
- Mengurangi anxiety calon siswa

---

## 4. REKOMENDASI UI/UX IMPROVEMENTS

### 4.1 DARK MODE SUPPORT

**Implementasi:**
- Tambahkan toggle dark mode
- Komponen yang perlu dark mode:
  - Form input
  - Dashboard
  - Status page
  - Profile page

---

### 4.2 KEYBOARD NAVIGATION

**Masalah Saat Ini:**
- Beberapa form tidak support tab navigation
- Tidak ada shortcut keyboard

**Rekomendasi:**
- Pastikan semua form bisa diakses dengan Tab
- Tambahkan shortcut:
  - Ctrl + S = Simpan form
  - Ctrl + / = Buka bantuan
  - Esc = Tutup modal

---

### 4.3 AUTO-SAVE FORM ✅ IMPLEMENTED

**Status:** ✅ **SUDAH DIIMPLEMENTASIKAN**  
**URL:** `/spmb/lengkapi-data`  
**File:** `resources/views/spmb/lengkapi-data.blade.php`

**Fitur yang Diimplementasikan:**
- ✅ **Auto-save otomatis** - Data disimpan ke localStorage setiap 5 detik
- ✅ **Auto-save saat input** - Debounced save saat user mengetik (1 detik setelah berhenti)
- ✅ **Restore data** - Modal konfirmasi saat halaman dibuka kembali jika ada data tersimpan
- ✅ **Toast notification** - Notifikasi saat data berhasil disimpan
- ✅ **Timestamp** - Menampilkan waktu terakhir disimpan
- ✅ **Data expiry** - Data lebih dari 24 jam akan dihapus otomatis
- ✅ **Clear on submit** - Data localStorage dihapus saat form berhasil disubmit

**Cara Kerja:**
```
1. User mengisi form → Auto-save setiap 5 detik
2. Browser tertutup/refresh → Data tersimpan di localStorage
3. User buka halaman lagi → Muncul modal "Pulihkan Data?"
4. Pilih "Pulihkan" → Form terisi dengan data sebelumnya
5. Pilih "Hapus Data" → Data dihapus, form kosong
6. Submit form berhasil → localStorage dibersihkan
```

**Data yang Disimpan:**
- Semua input text, email, tel, textarea
- Radio buttons
- Checkboxes
- Step aktif (step 1 atau 2)

**File yang diubah:**
- ✅ `resources/views/spmb/lengkapi-data.blade.php`

---

### 4.4 GRAFIK PROGRESS YANG LEBIH MENARIK

**Rekomendasi:**
```
Kelengkapan Pendaftaran: 75%
████████████████████░░░░

Ringkasan:
☑️ Data Diri        (Selesai)
☑️ Data Orang Tua   (Selesai)
☑️ Pilih Jurusan    (Selesai)
⏳ Upload Berkas    (2 dari 3)
⏳ Tes & Wawancara  (Menunggu)
```

---

## 5. REKOMENDASI RESPONSIVE & MOBILE

### 5.1 OPTIMASI MOBILE SPESIFIK

**Masalah yang Terdeteksi:**
- Bottom navigation sudah bagus tapi bisa ditingkatkan
- Beberapa form terlalu panjang di mobile

**Rekomendasi:**
```
Mobile Bottom Nav:
┌─────┬─────┬─────┬─────┬─────┐
│ 🏠  │ 📋  │ 📊  │ 📁  │ 👤  │
│Home │Info │Status│File │Profil│
└─────┴─────┴─────┴─────┴─────┘

Form Stepper untuk Mobile:
Step 1/4: Data Diri →
[Compact view, satu section per step]
```

---

### 5.2 OPTIMASI GAMBAR

**Rekomendasi:**
- Konversi otomatis ke WebP untuk performa lebih baik
- Lazy loading untuk gambar
- Thumbnail preview untuk upload foto

---

## 6. REKOMENDASI AKSESIBILITAS (A11Y)

### 6.1 ARIA LABELS & SCREEN READER

**Perbaikan yang Diperlukan:**
```html
Sebelum:
<input type="file" name="berkas">

Sesudah:
<input 
    type="file" 
    name="berkas" 
    aria-label="Upload berkas KK"
    aria-describedby="kk-help"
    accept=".pdf,.jpg,.png">
<div id="kk-help">
    Upload scan Kartu Keluarga dalam format PDF, JPG, atau PNG
</div>
```

### 6.2 FOCUS INDICATORS

```css
Tambahkan style untuk focus:
*:focus-visible {
    outline: 3px solid #3b82f6;
    outline-offset: 2px;
}
```

### 6.3 FONT SIZE & CONTRAST

**Cek & Perbaiki:**
- Minimum font size: 16px untuk input (mencegah zoom di iOS)
- Contrast ratio minimum: 4.5:1 untuk teks normal
- Support text resizing hingga 200%

---

## 7. REKOMENDASI PERFORMANCE

### 7.1 LAZY LOADING

**Implementasi:**
- Gambar: `<img loading="lazy" src="..." alt="...">`
- Dynamic import untuk component berat

### 7.2 CODE SPLITTING

**Rekomendasi:**
- Pisahkan bundle JS untuk halaman user dan admin
- Preload critical resources
- Defer non-critical scripts

---

## 8. REKOMENDASI KONTEN

### 8.1 GAMBAR DEFAULT

**Siapkan gambar default untuk:**
- Profil siswa tanpa foto
- Berita tanpa gambar
- Jurusan tanpa ilustrasi
- Galeri kosong

```
public/images/defaults/
├── avatar-male.svg
├── avatar-female.svg
├── news-placeholder.jpg
├── jurusan-placeholder.jpg
└── empty-gallery.svg
```

### 8.2 VIDEO PROFIL SEKOLAH

**Rekomendasi:**
- Tambahkan section video profil di home
- Video tour fasilitas
- Testimonial alumni (jika ada)

### 8.3 NEWSLETTER

**Fitur:**
- Subscribe berita terbaru via email
- Notifikasi jadwal penting
- Pengingat deadline pendaftaran

---

## 9. CHECKLIST IMPLEMENTASI

### Minggu 1 - Quick Wins
- [ ] Auto-format nomor WhatsApp
- [ ] Panduan upload yang lebih jelas
- [ ] Progress indicator improvement
- [ ] Keyboard navigation fixes

### Minggu 2 - Feature Additions  
- [ ] Drag & drop upload
- [ ] FAQ interaktif
- [ ] Auto-save form
- [ ] Dark mode support

### Minggu 3 - Optimizations
- [ ] Image optimization (WebP)
- [ ] Lazy loading implementation
- [ ] Mobile-specific improvements
- [ ] Accessibility audit & fixes

### Minggu 4 - Content & Polish
- [ ] Default images setup
- [ ] Video content integration
- [ ] Newsletter feature
- [ ] Final testing

---

## 10. RINGKASAN PRIORITAS

| Prioritas | Rekomendasi | Impact | Effort |
|-----------|-------------|--------|--------|
| P1 | Progress indicator jelas | Tinggi | Rendah |
| P1 | WhatsApp validation real-time | Tinggi | Rendah |
| P1 | Auto-save form | Tinggi | Rendah |
| P2 | Drag & drop upload | Tinggi | Sedang |
| P2 | Notifikasi WA otomatis | Tinggi | Sedang |
| P2 | Panduan file yang jelas | Tinggi | Rendah |
| P3 | Search jurusan filter | Sedang | Sedang |
| P3 | Kalender akademik | Sedang | Rendah |
| P3 | FAQ interaktif | Sedang | Rendah |
| P4 | Simulasi tes online | Tinggi | Tinggi |
| P4 | Dark mode | Rendah | Sedang |
| P4 | Chatbot | Sedang | Tinggi |

---

## KESIMPULAN

Implementasi rekomendasi di atas akan meningkatkan:

1. **User Satisfaction** - Lebih mudah digunakan
2. **Conversion Rate** - Lebih banyak siswa menyelesaikan pendaftaran
3. **Support Tickets** - Berkurangnya pertanyaan berulang
4. **Accessibility** - Bisa diakses lebih banyak orang
5. **Performance** - Lebih cepat dan responsif

**Estimasi Total Waktu:** 2-4 minggu untuk semua prioritas tinggi dan medium.

---

*Dokumen ini dibuat berdasarkan hasil testing komprehensif terhadap seluruh fitur user.*
