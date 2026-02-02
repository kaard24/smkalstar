@extends('layouts.app')

@section('title', 'Kebijakan Privasi - SMK Al-Hidayah Lestari')

@section('content')
    <!-- Header Page -->
    <div class="bg-sky-50 py-12 border-b border-sky-100">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-2xl md:text-3xl lg:text-4xl font-bold text-gray-900 mb-2">Kebijakan Privasi</h1>
            <p class="text-gray-600">Perlindungan data pribadi Anda adalah prioritas kami</p>
        </div>
    </div>

    <section class="py-12 md:py-16 bg-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-4xl">
            <div class="prose prose-gray max-w-none">
                <p class="text-gray-600 mb-6">Terakhir diperbarui: {{ date('d F Y') }}</p>

                <h2 class="text-xl font-bold text-gray-900 mt-8 mb-4">1. Pendahuluan</h2>
                <p class="text-gray-600 mb-4">
                    SMK Al-Hidayah Lestari berkomitmen untuk melindungi privasi Anda. Kebijakan Privasi ini menjelaskan bagaimana kami mengumpulkan, menggunakan, menyimpan, dan melindungi informasi pribadi Anda saat menggunakan website dan layanan kami, termasuk sistem PPDB (Penerimaan Peserta Didik Baru).
                </p>

                <h2 class="text-xl font-bold text-gray-900 mt-8 mb-4">2. Informasi yang Kami Kumpulkan</h2>
                <p class="text-gray-600 mb-4">
                    Kami mengumpulkan informasi berikut ketika Anda menggunakan layanan kami:
                </p>
                <ul class="list-disc list-inside text-gray-600 mb-4 space-y-2">
                    <li><strong>Data Pribadi:</strong> Nama lengkap, NISN, tempat dan tanggal lahir, jenis kelamin, alamat, nomor telepon/WhatsApp, dan alamat email.</li>
                    <li><strong>Data Orang Tua/Wali:</strong> Nama, pekerjaan, dan kontak orang tua/wali.</li>
                    <li><strong>Dokumen:</strong> Fotokopi ijazah, akta kelahiran, kartu keluarga, dan dokumen pendukung lainnya.</li>
                    <li><strong>Data Teknis:</strong> Alamat IP, jenis browser, dan perangkat yang digunakan untuk mengakses website.</li>
                </ul>

                <h2 class="text-xl font-bold text-gray-900 mt-8 mb-4">3. Penggunaan Informasi</h2>
                <p class="text-gray-600 mb-4">
                    Informasi yang kami kumpulkan digunakan untuk:
                </p>
                <ul class="list-disc list-inside text-gray-600 mb-4 space-y-2">
                    <li>Proses pendaftaran dan seleksi PPDB</li>
                    <li>Komunikasi terkait status pendaftaran</li>
                    <li>Administrasi akademik setelah diterima</li>
                    <li>Peningkatan kualitas layanan pendidikan</li>
                    <li>Keperluan dokumentasi dan pelaporan ke instansi terkait</li>
                </ul>

                <h2 class="text-xl font-bold text-gray-900 mt-8 mb-4">4. Perlindungan Data</h2>
                <p class="text-gray-600 mb-4">
                    Kami mengimplementasikan berbagai langkah keamanan untuk melindungi data pribadi Anda:
                </p>
                <ul class="list-disc list-inside text-gray-600 mb-4 space-y-2">
                    <li>Enkripsi data sensitif saat transmisi dan penyimpanan</li>
                    <li>Akses terbatas hanya untuk staf yang berwenang</li>
                    <li>Backup data berkala</li>
                    <li>Kebijakan password yang kuat</li>
                    <li>Audit keamanan secara berkala</li>
                </ul>

                <h2 class="text-xl font-bold text-gray-900 mt-8 mb-4">5. Penyimpanan Data</h2>
                <p class="text-gray-600 mb-4">
                    Data pribadi akan disimpan selama diperlukan untuk tujuan yang dijelaskan dalam kebijakan ini, atau sesuai dengan ketentuan peraturan perundang-undangan yang berlaku. Setelah periode tersebut, data akan dihapus atau dianonimkan.
                </p>

                <h2 class="text-xl font-bold text-gray-900 mt-8 mb-4">6. Hak Anda</h2>
                <p class="text-gray-600 mb-4">
                    Anda memiliki hak untuk:
                </p>
                <ul class="list-disc list-inside text-gray-600 mb-4 space-y-2">
                    <li>Mengakses data pribadi Anda</li>
                    <li>Meminta koreksi data yang tidak akurat</li>
                    <li>Meminta penghapusan data (dengan ketentuan tertentu)</li>
                    <li>Menolak penggunaan data untuk tujuan tertentu</li>
                </ul>

                <h2 class="text-xl font-bold text-gray-900 mt-8 mb-4">7. Cookies</h2>
                <p class="text-gray-600 mb-4">
                    Website kami menggunakan cookies untuk meningkatkan pengalaman pengguna, termasuk:
                </p>
                <ul class="list-disc list-inside text-gray-600 mb-4 space-y-2">
                    <li>Cookies sesi untuk login (dihapus saat logout)</li>
                    <li>Cookies preferensi untuk pengaturan tampilan</li>
                    <li>Cookies analitik untuk memahami penggunaan website</li>
                </ul>

                <h2 class="text-xl font-bold text-gray-900 mt-8 mb-4">8. Perubahan Kebijakan</h2>
                <p class="text-gray-600 mb-4">
                    Kami dapat memperbarui kebijakan privasi ini dari waktu ke waktu. Perubahan akan diumumkan melalui website kami dan berlaku efektif segera setelah diposting.
                </p>

                <h2 class="text-xl font-bold text-gray-900 mt-8 mb-4">9. Kontak</h2>
                <p class="text-gray-600 mb-4">
                    Jika Anda memiliki pertanyaan tentang kebijakan privasi ini atau ingin menggunakan hak Anda terkait data pribadi, silakan hubungi kami:
                </p>
                <div class="bg-gray-50 p-4 rounded-lg mb-4">
                    <p class="text-gray-600">
                        <strong>SMK Al-Hidayah Lestari</strong><br>
                        JL. KANA LESTARI BLOK K/I, Lb. Bulus, Kec. Cilandak<br>
                        Jakarta Selatan 12440<br>
                        Telepon: (021) 7661343<br>
                        WhatsApp: 0881-2489-572
                    </p>
                </div>
            </div>
        </div>
    </section>
@endsection
