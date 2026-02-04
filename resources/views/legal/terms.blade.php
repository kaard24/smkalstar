@extends('layouts.app')

@section('title', 'Syarat dan Ketentuan - SMK Al-Hidayah Lestari')

@section('content')
    <!-- Header Page -->
    <div class="bg-sky-50 py-12 border-b border-sky-100">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-2xl md:text-3xl lg:text-4xl font-bold text-gray-900 mb-2">Syarat dan Ketentuan</h1>
            <p class="text-gray-600">Ketentuan penggunaan layanan SMK Al-Hidayah Lestari</p>
        </div>
    </div>

    <section class="py-12 md:py-16 bg-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-4xl">
            <div class="prose prose-gray max-w-none">
                <p class="text-gray-600 mb-6">Terakhir diperbarui: {{ date('d F Y') }}</p>

                <h2 class="text-xl font-bold text-gray-900 mt-8 mb-4">1. Penerimaan Syarat</h2>
                <p class="text-gray-600 mb-4">
                    Dengan mengakses dan menggunakan website SMK Al-Hidayah Lestari, Anda menyetujui untuk terikat oleh syarat dan ketentuan ini. Jika Anda tidak menyetujui bagian mana pun dari ketentuan ini, Anda tidak diperkenankan menggunakan layanan kami.
                </p>

                <h2 class="text-xl font-bold text-gray-900 mt-8 mb-4">2. Penggunaan Layanan</h2>
                <h3 class="text-lg font-semibold text-gray-800 mt-6 mb-3">2.1. Sistem SPMB</h3>
                <p class="text-gray-600 mb-4">
                    Sistem Penerimaan Peserta Didik Baru (SPMB) online tersedia untuk calon siswa yang memenuhi persyaratan administrasi. Pengguna bertanggung jawab untuk:
                </p>
                <ul class="list-disc list-inside text-gray-600 mb-4 space-y-2">
                    <li>Memberikan informasi yang akurat dan lengkap</li>
                    <li>Menjaga kerahasiaan akun dan password</li>
                    <li>Mematuhi jadwal dan prosedur yang telah ditentukan</li>
                    <li>Memberikan dokumen yang asli dan valid</li>
                </ul>

                <h3 class="text-lg font-semibold text-gray-800 mt-6 mb-3">2.2. Larangan</h3>
                <p class="text-gray-600 mb-4">
                    Pengguna dilarang melakukan:
                </p>
                <ul class="list-disc list-inside text-gray-600 mb-4 space-y-2">
                    <li>Membuat akun dengan data palsu atau menipu</li>
                    <li>Mengakses akun pengguna lain tanpa izin</li>
                    <li>Menggunakan sistem untuk tujuan yang melanggar hukum</li>
                    <li>Mengunggah konten yang mengandung malware atau virus</li>
                    <li>Mengganggu atau merusak sistem kami</li>
                </ul>

                <h2 class="text-xl font-bold text-gray-900 mt-8 mb-4">3. Akurasi Data</h2>
                <p class="text-gray-600 mb-4">
                    Anda bertanggung jawab penuh atas keakuratan data yang Anda masukkan. SMK Al-Hidayah Lestari tidak bertanggung jawab atas kesalahan pendaftaran yang disebabkan oleh informasi yang tidak akurat atau tidak lengkap dari pengguna.
                </p>

                <h2 class="text-xl font-bold text-gray-900 mt-8 mb-4">4. Kepemilikan Konten</h2>
                <p class="text-gray-600 mb-4">
                    Semua konten yang ditampilkan di website ini, termasuk teks, gambar, logo, dan desain, adalah milik SMK Al-Hidayah Lestari dan dilindungi oleh undang-undang hak cipta. Anda tidak diperkenankan:
                </p>
                <ul class="list-disc list-inside text-gray-600 mb-4 space-y-2">
                    <li>Menggandakan, mendistribusikan, atau memodifikasi konten tanpa izin tertulis</li>
                    <li>Menggunakan logo atau merek dagang kami tanpa izin</li>
                    <li>Mengambil data dari website dengan metode scraping atau serupa</li>
                </ul>

                <h2 class="text-xl font-bold text-gray-900 mt-8 mb-4">5. Komentar dan Interaksi</h2>
                <p class="text-gray-600 mb-4">
                    Pengguna yang berkomentar di website wajib:
                </p>
                <ul class="list-disc list-inside text-gray-600 mb-4 space-y-2">
                    <li>Berkomentar dengan sopan dan menghargai</li>
                    <li>Tidak menggunakan kata-kata kasar, menghina, atau diskriminatif</li>
                    <li>Tidak menyebarkan informasi palsu (hoaks)</li>
                    <li>Tidak melakukan spam atau promosi yang tidak relevan</li>
                </ul>
                <p class="text-gray-600 mb-4">
                    SMK Al-Hidayah Lestari berhak menghapus komentar yang melanggar ketentuan ini dan/atau memblokir pengguna yang melakukan pelanggaran berulang.
                </p>

                <h2 class="text-xl font-bold text-gray-900 mt-8 mb-4">6. Batasan Tanggung Jawab</h2>
                <p class="text-gray-600 mb-4">
                    SMK Al-Hidayah Lestari tidak bertanggung jawab atas:
                </p>
                <ul class="list-disc list-inside text-gray-600 mb-4 space-y-2">
                    <li>Gangguan layanan akibat force majeure atau masalah teknis di luar kendali kami</li>
                    <li>Kerugian yang timbul dari penggunaan informasi di website ini</li>
                    <li>Konten atau aktivitas dari website pihak ketiga yang terhubung dari website kami</li>
                </ul>

                <h2 class="text-xl font-bold text-gray-900 mt-8 mb-4">7. Perubahan Layanan</h2>
                <p class="text-gray-600 mb-4">
                    Kami berhak untuk:
                </p>
                <ul class="list-disc list-inside text-gray-600 mb-4 space-y-2">
                    <li>Mengubah, menangguhkan, atau menghentikan bagian mana pun dari layanan kapan saja</li>
                    <li>Memperbarui syarat dan ketentuan ini sewaktu-waktu</li>
                    <li>Mengubah kebijakan SPMB sesuai dengan kebijakan pemerintah dan yayasan</li>
                </ul>
                <p class="text-gray-600 mb-4">
                    Perubahan akan diumumkan melalui website dan/atau media komunikasi resmi kami.
                </p>

                <h2 class="text-xl font-bold text-gray-900 mt-8 mb-4">8. Hukum yang Berlaku</h2>
                <p class="text-gray-600 mb-4">
                    Syarat dan ketentuan ini diatur oleh hukum Republik Indonesia. Setiap perselisihan yang timbul akan diselesaikan secara musyawarah atau melalui lembaga hukum yang berwenang di wilayah hukum Indonesia.
                </p>

                <h2 class="text-xl font-bold text-gray-900 mt-8 mb-4">9. Kontak</h2>
                <p class="text-gray-600 mb-4">
                    Untuk pertanyaan tentang syarat dan ketentuan ini, silakan hubungi:
                </p>
                <div class="bg-gray-50 p-4 rounded-lg mb-4">
                    <p class="text-gray-600">
                        <strong>SMK Al-Hidayah Lestari</strong><br>
                        JL. KANA LESTARI BLOK K/I, Lb. Bulus, Kec. Cilandak<br>
                        Jakarta Selatan 12440<br>
                        Telepon: (021) 7661343<br>
                        Email: info@smkalhidayah.sch.id
                    </p>
                </div>

                <div class="border-t border-gray-200 pt-6 mt-8">
                    <p class="text-gray-500 text-sm">
                        Dengan menggunakan layanan kami, Anda menyatakan telah membaca, memahami, dan menyetujui syarat dan ketentuan ini.
                    </p>
                </div>
            </div>
        </div>
    </section>
@endsection
