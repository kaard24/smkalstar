# Audit Mobile UI - Halaman User

Tanggal audit: 3 Maret 2026  
Metode: review kode Blade/Tailwind (tanpa screenshot perangkat nyata), fokus tampilan mobile.

## Ringkasan

- Status umum: `PARTIAL`
- Mayoritas halaman sudah responsif dasar, tapi konsistensi skala teks, kepadatan grid, dan elemen `fixed` di mobile belum seragam.
- Tidak ditemukan error sintaks fatal di view user yang dicek, namun ada beberapa potensi bug UX di layar kecil.

## Temuan Utama (Prioritas Tinggi)

1. Konsistensi ukuran teks mobile belum seragam.
- Dampak: beberapa section terasa "kebesaran" dibanding halaman lain.
- Pola yang muncul: body/description langsung `text-base` atau lebih besar di mobile pada beberapa halaman.

2. Benturan elemen bawah layar (`fixed`) dengan bottom nav.
- Dampak: tombol/toast/CTA berisiko saling menimpa pada layar pendek.
- Lokasi rawan: halaman dengan komponen `fixed bottom-*` bersamaan dengan `partials/bottom-nav`.

3. Grid 2 kolom terlalu padat untuk kartu konten tertentu.
- Dampak: kartu jadi sempit, teks cepat terpotong, visual kurang rapi.
- Pola: `grid-cols-2` dipakai di mobile untuk kartu yang masih punya gambar + teks cukup banyak.

## Temuan Per Halaman

## 1) Layout Global

File:
- `resources/views/layouts/app.blade.php`
- `resources/views/partials/header.blade.php`
- `resources/views/partials/bottom-nav.blade.php`

Temuan:
- `main` sudah diberi `pb-20` untuk ruang bottom nav, ini bagus.
- Namun halaman yang menambah elemen `fixed bottom-*` sendiri tetap berpotensi overlap.
- Header sticky + bottom nav + CTA fixed (di halaman tertentu) membuat layar mobile terasa penuh.

Status: `PARTIAL`

## 2) Beranda

File:
- `resources/views/home.blade.php`

Temuan:
- Struktur sudah responsif, tapi kombinasi hero + elemen sticky/fixed dapat terasa padat di viewport pendek.
- Perlu cek ulang konsistensi ukuran deskripsi section agar tidak beda jauh dengan halaman user lain.

Status: `PARTIAL`

## 3) Profil Sekolah

File:
- `resources/views/profil.blade.php`

Temuan:
- Beberapa heading/description mobile cenderung besar, membuat ritme baca tidak seimbang.
- Spasi antar blok konten cukup besar di mobile pada beberapa section.

Status: `PARTIAL`

## 4) Jurusan Detail

File:
- `resources/views/jurusan/detail.blade.php`

Temuan:
- Secara struktur sudah baik, namun masih ada kombinasi teks dan card yang terlihat besar di beberapa blok mobile.
- Banyak komponen card beruntun; perlu penyetaraan ukuran teks kecil (`text-sm`) agar lebih ringkas.

Status: `PARTIAL`

## 5) Fasilitas / Ekstrakurikuler / Prestasi / Galeri / Seragam

File:
- `resources/views/fasilitas.blade.php`
- `resources/views/ekstrakurikuler.blade.php`
- `resources/views/prestasi.blade.php`
- `resources/views/galeri.blade.php`
- `resources/views/seragam.blade.php`

Temuan:
- Pada beberapa section, `grid-cols-2` di mobile membuat konten kartu terlalu rapat.
- Komponen lightbox/preview dengan kontrol besar dapat terlalu dominan di layar kecil.
- Beberapa caption/teks metadata masih relatif besar untuk kartu kecil.

Status: `PARTIAL`

## 6) Berita

File:
- `resources/views/berita/index.blade.php`
- `resources/views/berita/show.blade.php`

Temuan:
- Search bar di index memakai input + tombol absolut; di layar sempit ruang ketik terasa mepet.
- Halaman detail umumnya aman, tapi ukuran blok heading/subheading perlu diseragamkan dengan halaman user lain.

Status: `PARTIAL`

## 7) Auth User

File:
- `resources/views/auth/login.blade.php`
- `resources/views/auth/register.blade.php`

Temuan:
- Secara mobile sudah fungsional.
- Perlu cek konsistensi skala label/help text agar tidak lebih besar dari kebutuhan.

Status: `YES` (minor polishing)

## 8) SPMB - Info / Kalender / Pengumuman

File:
- `resources/views/spmb/info.blade.php`
- `resources/views/spmb/kalender.blade.php`
- `resources/views/spmb/pengumuman.blade.php`

Temuan:
- Bagian program/jadwal sudah diarahkan ke 2 kolom, namun beberapa kartu masih padat jika konten panjang.
- Terdapat section dengan teks dan spacing yang masih terasa besar di mobile.

Status: `PARTIAL`

## 9) SPMB - Dashboard / Status / Berkas / Pembayaran

File:
- `resources/views/spmb/dashboard.blade.php`
- `resources/views/spmb/status.blade.php`
- `resources/views/spmb/berkas.blade.php`
- `resources/views/spmb/pembayaran.blade.php`

Temuan:
- Layout umumnya responsif, tetapi kepadatan informasi cukup tinggi untuk layar kecil.
- Beberapa badge/tabel/list butuh kompresi tipografi agar tidak terlihat "berat".

Status: `PARTIAL`

## 10) SPMB - Lengkapi Data / Profil

File:
- `resources/views/spmb/lengkapi-data.blade.php`
- `resources/views/spmb/profil.blade.php`
- `resources/views/spmb/edit-profil.blade.php`
- `resources/views/spmb/register.blade.php`

Temuan:
- `lengkapi-data` paling rawan: form panjang, banyak grup, ada elemen fixed (toast/autosave) yang bisa bertabrakan dengan bottom nav.
- Beberapa komponen step/chip memiliki minimum width yang membuat wrapping kurang rapi di ponsel kecil.
- Register/profil relatif aman, masih perlu penyamaan skala teks kecil.

Status: `PARTIAL`

## Daftar Potensi Bug UX Mobile

1. Overlap elemen `fixed bottom-*` dengan bottom nav.
2. Kartu 2 kolom terlalu sempit pada konten gambar + teks.
3. Input pencarian dengan tombol absolut mengurangi area ketik di layar kecil.
4. Ukuran teks tidak konsisten antar halaman user.

## Rekomendasi Standar (Agar Konsisten)

1. Tetapkan skala tipografi mobile global:
- Body: `text-sm`/`text-[15px]`
- Deskripsi section: `text-sm sm:text-base`
- Judul section: `text-lg sm:text-xl`

2. Aturan grid mobile:
- Konten kartu berat: default `grid-cols-1`, naik ke `sm:grid-cols-2`.
- Hanya pakai `grid-cols-2` di mobile bila isi kartu sangat ringkas.

3. Aturan elemen fixed:
- Semua elemen fixed bawah layar wajib offset terhadap bottom nav (`bottom-20` atau lebih) saat mobile.

4. Aturan spacing:
- Gunakan skala mobile konsisten (`p-4`, `gap-3`, `space-y-4`) lalu naik di `sm/md`.

## Kesimpulan

Halaman user sudah berjalan dan responsif dasar, tetapi untuk kualitas mobile yang rapi dan konsisten masih perlu normalisasi pada tipografi, grid, dan elemen fixed. Prioritas pertama: `spmb/lengkapi-data`, halaman grid konten (fasilitas/galeri/sejenis), lalu penyamaan skala teks lintas halaman.
