# REKOMENDASI UNTUK BAGIAN ADMIN
## SMK Alstar - Sistem Penerimaan Murid Baru (SPMB)

**Berdasarkan Hasil Black Box Testing**  
**Tanggal:** 4 Februari 2026

---

## 1. OVERVIEW ADMIN EXPERIENCE

Berdasarkan hasil testing, bagian admin secara fungsional **sudah sangat baik** dengan fitur CRUD yang lengkap. Namun, terdapat beberapa area yang bisa ditingkatkan untuk efisiensi operasional dan manajemen data yang lebih baik.

### Skor Admin UX Saat Ini: ⭐⭐⭐⭐ (4/5)

---

## 2. REKOMENDASI PRIORITAS TINGGI

### 2.1 BULK OPERATIONS (Operasi Massal)

**Masalah Saat Ini:**
- Tidak ada fitur seleksi multiple untuk operasi massal
- Admin harus menghapus/edit data satu per satu
- Tidak ada export selektif

**Rekomendasi Fitur:**
```
┌─────────────────────────────────────────────────────────┐
│ ☑️  Pilih Semua   [Export Pilihan] [Hapus Pilihan]      │
├─────────────────────────────────────────────────────────┤
│ ☑️ │ NISN      │ Nama              │ Jurusan  │ Aksi   │
├────┼───────────┼───────────────────┼──────────┼────────┤
│ ☐  │ 1234567890│ Andi Wijaya       │ RPL      │ [Edit] │
│ ☐  │ 1234567891│ Budi Santoso      │ TKJ      │ [Edit] │
│ ☑️  │ 1234567892│ Citra Dewi        │ RPL      │ [Edit] │
│ ☑️  │ 1234567893│ Dedi Pratama      │ Akuntansi│ [Edit] │
│ ☐  │ 1234567894│ Eka Putri         │ RPL      │ [Edit] │
└────┴───────────┴───────────────────┴──────────┴────────┘
      2 item dipilih
```

**Operasi Massal yang Diperlukan:**
- Export Excel untuk data terpilih
- Hapus multiple data sekaligus
- Update status massal (contoh: ubah status jadi "Lulus")
- Kirim notifikasi WA massal
- Cetak kartu peserta massal

**File yang perlu dimodifikasi:**
- `resources/views/admin/pendaftar.blade.php`
- `app/Http/Controllers/AdminSpmbController.php`

---

### 2.2 ADVANCED FILTERING & SEARCH

**Masalah Saat Ini:**
- Filter terbatas (jurusan, status)
- Tidak ada filter rentang tanggal
- Tidak ada filter kombinasi

**Rekomendasi Filter Lanjutan:**
```
Filter Data Pendaftar:
┌────────────────────────────────────────────────────────┐
│ Cari: [____________________] [🔍]                     │
├────────────────────────────────────────────────────────┤
│ Jurusan: [Semua Jurusan ▼]                           │
│ Status:  [Semua Status ▼]                            │
│ Gender:  [L/P/Semua ▼]                               │
│ Asal Sekolah: [________________]                     │
├────────────────────────────────────────────────────────┤
│ Tanggal Daftar:                                       │
│ Dari: [__/__/____] Sampai: [__/__/____]             │
├────────────────────────────────────────────────────────┤
│ Upload Berkas:                                        │
│ ○ Semua  ○ Belum Upload  ○ Sebagian  ○ Lengkap      │
├────────────────────────────────────────────────────────┤
│ Kelulusan:                                            │
│ ○ Semua  ○ Pending  ○ Lulus  ○ Tidak Lulus          │
├────────────────────────────────────────────────────────┤
│ [Terapkan Filter] [Reset Filter]                      │
└────────────────────────────────────────────────────────┘
```

**Benefit:**
- Admin bisa menemukan data spesifik lebih cepat
- Laporan yang lebih tersegmentasi
- Analisis data yang lebih mendalam

---

### 2.3 AUDIT LOG (Pencatatan Aktivitas)

**Masalah Saat Ini:**
- Tidak ada pencatatan siapa yang mengubah data
- Sulit melacak perubahan jika terjadi kesalahan input
- Tidak ada accountability

**Rekomendasi Implementasi:**
```
📋 Audit Log - Riwayat Perubahan Data

┌─────────────────────────────────────────────────────────┐
│ Filter: [Hari Ini] [7 Hari] [30 Hari] [Custom]          │
├─────────────────────────────────────────────────────────┤
│ Waktu           │ Admin       │ Aksi        │ Detail    │
├─────────────────┼─────────────┼─────────────┼───────────┤
│ 04/02 14:30:22 │ admin1      │ UPDATE      │ Siswa ID: │
│                 │             │             │ 123 -     │
│                 │             │             │ Status:   │
│                 │             │             │ Pending→  │
│                 │             │             │ Lulus     │
├─────────────────┼─────────────┼─────────────┼───────────┤
│ 04/02 14:25:10 │ admin2      │ DELETE      │ Siswa ID: │
│                 │             │             │ 456 -     │
│                 │             │             │ Andi W    │
├─────────────────┼─────────────┼─────────────┼───────────┤
│ 04/02 14:20:05 │ admin1      │ CREATE      │ Siswa ID: │
│                 │             │             │ 789 -     │
│                 │             │             │ Budi S    │
└─────────────────┴─────────────┴─────────────┴───────────┘
```

**Data yang Perlu Dicatat:**
- Siapa admin yang melakukan perubahan
- Timestamp perubahan
- Data sebelum dan sesudah (delta)
- IP address admin
- Tipe aksi (CREATE, UPDATE, DELETE, EXPORT)

**Implementasi:**
- Buat tabel `audit_logs`
- Gunakan Laravel Observer atau Event
- Retention policy: 1 tahun

---

### 2.4 STATISTIK & ANALYTICS DASHBOARD

**Masalah Saat Ini:**
- Dashboard hanya menampilkan angka dasar
- Tidak ada visualisasi grafik
- Tidak ada perbandingan periode

**Rekomendasi Dashboard Lengkap:**
```
┌─────────────────────────────────────────────────────────┐
│ 📊 DASHBOARD STATISTIK SPMB 2026                        │
├─────────────────────────────────────────────────────────┤
│                                                         │
│  Total Pendaftar: 1,234    ↑ 15% vs bulan lalu         │
│  Data Lengkap:    856      ↑ 8%  vs bulan lalu         │
│  Berkas Lengkap:  723      ↑ 12% vs bulan lalu         │
│  Sudah Lulus:     512      ↑ 5%  vs bulan lalu         │
│                                                         │
├─────────────────────────────────────────────────────────┤
│ 📈 Grafik Pendaftar per Minggu                          │
│                                                         │
│  300 ┤                          ╭────                  │
│  250 ┤              ╭──────────╯                       │
│  200 ┤    ╭────────╯                                   │
│  150 ┤───╯                                             │
│  100 ┤                                                 │
│   50 ┤                                                 │
│    0 ┴────┬────┬────┬────┬────┬────┬────              │
│          W1   W2   W3   W4   W5   W6                  │
│                                                         │
├─────────────────────────────────────────────────────────┤
│ 📊 Distribusi per Jurusan                               │
│                                                         │
│  RPL        ████████████████████████████████ 456 (37%) │
│  TKJ        ████████████████████████         389 (32%) │
│  Akuntansi  ██████████████████               245 (20%) │
│  Lainnya    ██████████                       144 (11%) │
│                                                         │
├─────────────────────────────────────────────────────────┤
│ 📍 Top 10 Asal Sekolah                                  │
│  1. SMPN 1 Kota Bekasi          - 123 pendaftar        │
│  2. SMPN 2 Kota Bekasi          -  98 pendaftar        │
│  3. SMPN 3 Kota Bekasi          -  87 pendaftar        │
│  ...                                                   │
└─────────────────────────────────────────────────────────┘
```

**Metrik Tambahan:**
- Conversion rate (pendaftar → data lengkap → berkas lengkap → lulus)
- Drop-off rate per step
- Rata-rata waktu penyelesaian pendaftaran
- Peak hours (jam paling ramai)
- Geographic distribution (per kecamatan/kota)

---

### 2.5 IMPORT DATA EXCEL

**Masalah Saat Ini:**
- Hanya ada export, tidak ada import
- Input data manual satu per satu memakan waktu
- Tidak ada migrasi data dari sistem lama

**Rekomendasi Fitur Import:**
```
📥 Import Data Pendaftar

Format file: Excel (.xlsx, .xls) atau CSV
Template: [Download Template Excel]

Kolom yang diperlukan:
- NISN (wajib, unik)
- Nama Lengkap (wajib)
- Jenis Kelamin (L/P)
- Tempat Lahir
- Tanggal Lahir (DD/MM/YYYY)
- Asal Sekolah
- Jurusan Pilihan (kode jurusan)
- No. WhatsApp

[Upload File] [Preview] [Import]

⚠️ Data yang sudah ada (berdasarkan NISN) akan di-skip
```

**Validasi Import:**
- Cek duplikat NISN
- Validasi format tanggal
- Validasi jurusan exists
- Preview sebelum import final
- Report hasil import (sukses, gagal, skip)

---

## 3. REKOMENDASI PRIORITAS MEDIUM

### 3.1 CETAK KARTU PESERTA

**Fitur:**
- Generate kartu peserta tes otomatis
- Format PDF siap cetak
- QR Code untuk verifikasi
- Bulk print untuk banyak siswa

```
┌──────────────────────────────────────────┐
│        KARTU PESERTA TES SPMB           │
│            SMK ALSTAR 2026              │
│                                          │
│  [FOTO]     No. Peserta: SPMB-001234    │
│                                          │
│  Nama: Andi Wijaya                       │
│  NISN: 1234567890                        │
│  Jurusan: Rekayasa Perangkat Lunak      │
│                                          │
│  ┌─────────────┐                         │
│  │ ▄▄▄▄▄▄▄▄▄▄ │  Scan untuk verifikasi  │
│  │ ▄▄▄▄▄▄▄▄▄▄ │                         │
│  │ ▄▄▄▄▄▄▄▄▄▄ │                         │
│  └─────────────┘                         │
│                                          │
│  TTD Panitia       TTD Kepala Sekolah   │
│  ___________       ___________          │
│                                          │
│  *) Kartu ini wajib dibawa saat tes     │
└──────────────────────────────────────────┘
```

---

### 3.2 MANAJEMEN JADWAL TES

**Fitur:**
- Buat jadwal tes (tanggal, waktu, ruang)
- Alokasi siswa ke jadwal
- Cek konflik jadwal
- Reminder otomatis via WA

```
📅 Jadwal Tes Masuk

Gelombang 1:
┌─────────────┬──────────┬──────────┬──────────┐
│ Tanggal     │ Sesi 1   │ Sesi 2   │ Sesi 3   │
├─────────────┼──────────┼──────────┼──────────┤
│ 10 Mar 2026 │ 30 siswa │ 30 siswa │ 30 siswa │
│ 11 Mar 2026 │ 25 siswa │ 30 siswa │ 28 siswa │
│ 12 Mar 2026 │ -        │ -        │ -        │
└─────────────┴──────────┴──────────┴──────────┘

Alokasi Otomatis:
[Alokasi semua siswa yang berkas lengkap ke jadwal]
```

---

### 3.3 VERIFIKASI BERKAS DIGITAL

**Masalah Saat Ini:**
- Admin hanya bisa lihat/download berkas
- Tidak ada status verifikasi
- Tidak ada catatan penolakan

**Rekomendasi:**
```
Verifikasi Berkas - Andi Wijaya (NISN: 1234567890)

Kartu Keluarga:
[📄 Preview KK.pdf]
Status: [✓ Valid  ☐ Tidak Valid]
Catatan: ___________________________
        ___________________________

Akta Kelahiran:
[📄 Preview AKTA.pdf]
Status: [✓ Valid  ☐ Tidak Valid]
Catatan: ___________________________

SKL/Ijazah:
[📄 Preview SKL.pdf]
Status: [✓ Valid  ☐ Tidak Valid]
Catatan: ___________________________

[Simpan Verifikasi] [Kirim Notifikasi ke Siswa]
```

---

### 3.4 KONFIGURASI GELombang PENDAFTARAN

**Fitur:**
- Atur periode pendaftaran gelombang 1, 2, 3
- Kuota per jurusan per gelombang
- Otomatis tutup pendaftaran jika kuota penuh
- Pengumuman otomatis per gelombang

```
Konfigurasi Gelombang Pendaftaran

Gelombang 1:
- Periode: 01/01/2026 - 28/02/2026
- Status: [Aktif ☐ / Nonaktif ☑️]
- Kuota per Jurusan:
  * RPL: 120 (terisi: 85)
  * TKJ: 120 (terisi: 92)
  * Akuntansi: 60 (terisi: 45)

[Update Kuota] [Tutup Pendaftaran]
```

---

### 3.5 TEMPLATE NOTIFIKASI WHATSAPP

**Fitur:**
- Kelola template pesan WA
- Variabel dinamis ({{nama}}, {{nisn}}, {{jadwal}})
- Preview pesan sebelum kirim
- Riwayat pengiriman

```
Template Pesan WhatsApp

Nama Template: Notifikasi Jadwal Tes
Subject: Jadwal Tes SPMB Anda

Isi Pesan:
Halo {{nama}},

Jadwal tes SPMB Anda:
📅 Tanggal: {{tanggal_tes}}
🕐 Waktu: {{waktu_tes}}
📍 Lokasi: {{lokasi_tes}}

Mohon hadir 30 menit lebih awal.
Bawa kartu peserta dan perlengkapan.

Terima kasih.
SMK Alstar

[Kirim Test] [Simpan Template]
```

---

## 4. REKOMENDASI REPORTING & EKSPOR

### 4.1 LAPORAN HARIAN/MINGGUAN OTOMATIS

**Fitur:**
- Generate laporan otomatis (PDF/Excel)
- Kirim ke email admin/pimpinan
- Jadwal laporan harian/mingguan/bulanan

```
Jenis Laporan:
☑ Laporan Harian Pendaftar
☑ Laporan Mingguan Progress
☐ Laporan Bulanan Statistik
☐ Laporan Akhir Seleksi

Penerima Email:
- kepsek@smkalstar.sch.id
- wakasek@smkalstar.sch.id

Jadwal Kirim:
[Setiap hari jam 18:00]
[Setiap Senin jam 08:00]
```

### 4.2 EXPORT FORMAT LAIN

**Format Export Tambahan:**
- **PDF** - Untuk laporan formal
- **CSV** - Untuk import ke sistem lain
- **Word** - Untuk surat edaran
- **JSON/XML** - Untuk integrasi API

---

## 5. REKOMENDASI KEAMANAN & MANAJEMEN AKSES

### 5.1 ROLE-BASED ACCESS CONTROL (RBAC)

**Masalah Saat Ini:**
- Semua admin memiliki akses penuh
- Tidak ada pemisahan hak akses
- Risk jika ada admin tidak bertanggung jawab

**Rekomendasi Role:**
```
Role Admin:

1. SUPER ADMIN (Kepala Sekolah)
   ✓ Semua akses termasuk konfigurasi sistem
   ✓ Manajemen user admin
   ✓ Lihat audit log
   ✓ Backup/restore database

2. ADMIN PENDAFTARAN (Petugas PPDB)
   ✓ CRUD data pendaftar
   ✓ Verifikasi berkas
   ✓ Input nilai tes
   ✓ Pengumuman kelulusan
   ✗ Hapus data permanen
   ✗ Konfigurasi sistem

3. ADMIN KONTEN (Operator Sekolah)
   ✓ Manajemen berita
   ✓ Manajemen galeri
   ✓ Update profil sekolah
   ✓ Manajemen fasilitas
   ✗ Akses data pendaftar
   ✗ Input nilai

4. VERIFIKATOR (Guru/Panitia)
   ✓ Lihat data pendaftar (readonly)
   ✓ Verifikasi berkas
   ✓ Input nilai tes
   ✗ Edit data pendaftar
   ✗ Hapus data
```

**Implementasi:**
- Tabel `roles` dan `permissions`
- Middleware untuk cek permission
- Gate/Policy Laravel

---

### 5.2 SESSION MANAGEMENT

**Fitur:**
- Lihat admin yang sedang online
- Force logout admin jika diperlukan
- Notifikasi login dari device baru
- Auto logout setelah idle 30 menit

```
Admin yang Online:
┌─────────────────┬─────────────┬──────────────────────┐
│ Admin           │ IP Address  │ Login Sejak          │
├─────────────────┼─────────────┼──────────────────────┤
│ admin1 (Anda)   │ 192.168.1.1 │ 04/02/2026 08:30:22  │
│ operator1       │ 192.168.1.5 │ 04/02/2026 09:15:00  │
│ verifikator2    │ 192.168.1.8 │ 04/02/2026 10:00:45  │
└─────────────────┴─────────────┴──────────────────────┘

[Force Logout] pada operator1?
```

---

## 6. REKOMENDASI UX/UI IMPROVEMENTS

### 6.1 SHORTCUT KEYBOARD

**Shortcut untuk Efisiensi:**
```
Ctrl + N : Tambah data baru
Ctrl + S : Simpan form
Ctrl + F : Fokus ke search
Ctrl + E : Export data
Ctrl + P : Print
Esc      : Tutup modal/cancel
?        : Tampilkan help shortcut
```

### 6.2 QUICK ACTIONS

**Tombol Aksi Cepat:**
```
Floating Action Button (FAB):

[+] (hover)
├── Tambah Pendaftar
├── Import Excel
├── Export Data
└── Cetak Laporan
```

### 6.3 DARK MODE

**Implementasi:**
- Toggle dark mode di navbar
- Simpan preference di localStorage
- Support system preference (media query)

### 6.4 RESPONSIVE TABLE

**Masalah Saat Ini:**
- Tabel data pendaftar tidak optimal di mobile

**Solusi:**
- Horizontal scroll dengan sticky column
- Card view untuk mobile
- Collapsible rows

---

## 7. REKOMENDASI BACKUP & DATA MANAGEMENT

### 7.1 BACKUP OTOMATIS

**Konfigurasi:**
- Backup database harian (scheduled)
- Backup file berkas mingguan
- Retention: 30 hari
- Cloud storage (Google Drive/S3)

```
Backup Management:

Terakhir Backup: 04/02/2026 02:00:00
Status: ✓ Sukses
Ukuran: 156 MB

[Backup Sekarang] [Restore] [Download]

Riwayat Backup:
│ 04/02 │ 03/02 │ 02/02 │ 01/02 │ ... │
│  ✓    │  ✓    │  ✓    │  ✓    │     │
```

### 7.2 ARCHIVE DATA

**Fitur:**
- Archive data tahun lalu
- Pisahkan database aktif vs arsip
- Restore jika diperlukan

---

## 8. CHECKLIST IMPLEMENTASI

### Fase 1 - Foundation (Minggu 1-2)
- [ ] Bulk operations (select all, export selected)
- [ ] Advanced filtering
- [ ] Audit log system
- [ ] Role-based access control

### Fase 2 - Feature (Minggu 3-4)
- [ ] Import Excel
- [ ] Cetak kartu peserta
- [ ] Manajemen jadwal tes
- [ ] Template notifikasi WA

### Fase 3 - Analytics (Minggu 5-6)
- [ ] Dashboard statistik lengkap
- [ ] Grafik & visualisasi
- [ ] Laporan otomatis
- [ ] Export format PDF

### Fase 4 - Polish (Minggu 7-8)
- [ ] Dark mode
- [ ] Keyboard shortcuts
- [ ] UX improvements
- [ ] Backup otomatis

---

## 9. PRIORITAS IMPLEMENTASI

| Prioritas | Fitur | Impact | Effort | Alasan |
|-----------|-------|--------|--------|--------|
| 🔴 P1 | Bulk Operations | Tinggi | Sedang | Efisiensi kerja admin |
| 🔴 P1 | Audit Log | Tinggi | Sedang | Security & accountability |
| 🔴 P1 | RBAC | Tinggi | Sedang | Keamanan data |
| 🟡 P2 | Import Excel | Tinggi | Rendah | Migrasi & efisiensi input |
| 🟡 P2 | Analytics Dashboard | Tinggi | Sedang | Decision making |
| 🟡 P2 | Advanced Filter | Medium | Rendah | User experience |
| 🟢 P3 | Cetak Kartu | Medium | Rendah | Keperluan operasional |
| 🟢 P3 | Manajemen Jadwal | Medium | Sedang | Organisasi tes |
| 🔵 P4 | Dark Mode | Low | Rendah | UX enhancement |
| 🔵 P4 | Backup Otomatis | Medium | Sedang | Data protection |

---

## 10. KESIMPULAN

Implementasi rekomendasi admin di atas akan meningkatkan:

1. **Efisiensi Operasional**
   - Bulk operations mengurangi waktu repetitive task
   - Import Excel mempercepat input data massal
   - Advanced filter memudahkan pencarian data

2. **Security & Accountability**
   - Audit log mencegah dan mendeteksi penyalahgunaan
   - RBAC membatasi akses sesuai tanggung jawab
   - Session management meningkatkan kontrol

3. **Decision Making**
   - Analytics dashboard memberikan insight
   - Statistik real-time untuk monitoring
   - Laporan otomatis untuk pimpinan

4. **User Experience**
   - Dark mode untuk kenyamanan
   - Shortcuts untuk efisiensi
   - Responsive design untuk fleksibilitas

**Estimasi Waktu Implementasi Total: 6-8 minggu**

---

*Dokumen ini dibuat berdasarkan analisis fitur admin yang ada dan best practices sistem PPDB.*
