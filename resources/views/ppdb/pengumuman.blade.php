@extends('layouts.app')

@section('title', 'Cek Pengumuman - SPMB SMK Al-Hidayah Lestari')

@section('content')
    <div class="relative bg-gray-900 min-h-screen py-24 overflow-hidden">
        <!-- Background Elements -->
        <div class="absolute inset-0 opacity-20">
            <img src="{{ asset('images/b1.jpg') }}" class="w-full h-full object-cover">
        </div>
        <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-gray-900/90 to-transparent"></div>
        
        <div class="container relative z-10 mx-auto px-4 sm:px-6 lg:px-8 max-w-3xl">
             <!-- Header -->
             <div class="text-center mb-16">
                <span class="inline-block py-1 px-3 rounded-full bg-yellow-500/20 text-yellow-500 text-sm font-bold mb-4 border border-yellow-500/20">Hasil Seleksi</span>
                <h1 class="text-3xl md:text-5xl font-bold text-white font-heading mb-4">Pengumuman Kelulusan</h1>
                <p class="text-gray-400 text-lg max-w-xl mx-auto">Silakan masukkan NISN untuk melihat hasil seleksi Penerimaan Peserta Didik Baru.</p>
            </div>

             <!-- Search Card -->
            <div class="bg-white rounded-3xl shadow-2xl overflow-hidden mb-12 border border-gray-800/50">
                <div class="p-8 md:p-12">
                     <form action="{{ route('ppdb.pengumuman.cek') }}" method="GET" class="space-y-8">
                        <div>
                            <label for="nisn" class="block text-center text-sm font-bold text-gray-500 uppercase tracking-wider mb-4">Nomor Induk Siswa Nasional (NISN)</label>
                            <div class="relative max-w-lg mx-auto">
                                <input type="text" name="nisn" id="nisn" class="block w-full text-center text-3xl font-bold tracking-widest px-4 py-4 rounded-2xl border-2 border-gray-200 focus:border-primary focus:ring-4 focus:ring-primary/10 transition placeholder-gray-300" placeholder="00xxxxxxxx" required>
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="inline-flex items-center justify-center px-10 py-4 bg-primary text-white text-lg font-bold rounded-2xl hover:bg-green-600 transition shadow-lg hover:shadow-green-500/30 transform hover:-translate-y-1">
                                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                                Cek Hasil Seleksi
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            
            <!-- Result Area (Example logic) -->
            @if(session('hasil'))
                @php $hasil = session('hasil'); @endphp
                <div class="bg-white rounded-3xl shadow-2xl overflow-hidden animate-fade-in-up">
                    <div class="p-10 text-center">
                        @if($hasil->status_kelulusan == 'Lulus')
                            <div class="w-24 h-24 bg-green-100 text-green-600 rounded-full flex items-center justify-center mx-auto mb-6 shadow-inner animate-bounce">
                                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                            </div>
                            <h2 class="text-3xl md:text-4xl font-bold text-green-600 mb-2 font-heading">SELAMAT!</h2>
                            <p class="text-xl text-gray-900 font-bold mb-2">{{ $hasil->nama }}</p>
                            <p class="text-gray-600 mb-8 max-w-md mx-auto">
                                Anda dinyatakan <strong class="text-green-600 bg-green-50 px-2 py-1 rounded">LULUS</strong> seleksi masuk SMK Al-Hidayah Lestari pada kompetensi keahlian:
                            </p>
                            
                            <div class="bg-gray-50 rounded-2xl p-6 mb-8 border border-gray-100 inline-block w-full max-w-sm">
                                <p class="text-sm text-gray-400 font-bold uppercase tracking-wider mb-1">Jurusan</p>
                                <p class="text-2xl font-bold text-primary">{{ $hasil->jurusan }}</p>
                            </div>
                            
                            <div>
                                <a href="#" class="inline-flex items-center px-8 py-3 bg-gray-900 text-white rounded-xl font-bold hover:bg-gray-800 transition">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                                    Cetak Bukti Lulus
                                </a>
                            </div>

                        @elseif($hasil->status_kelulusan == 'Tidak Lulus')
                            <div class="w-24 h-24 bg-red-100 text-red-600 rounded-full flex items-center justify-center mx-auto mb-6 shadow-inner">
                                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12"></path></svg>
                            </div>
                            <h2 class="text-3xl md:text-4xl font-bold text-red-600 mb-2 font-heading">MOHON MAAF</h2>
                            <p class="text-xl text-gray-900 font-bold mb-2">{{ $hasil->nama }}</p>
                            <p class="text-gray-600 max-w-md mx-auto">
                                Anda dinyatakan <strong class="text-red-600 bg-red-50 px-2 py-1 rounded">TIDAK LULUS</strong> seleksi tahun ini. Tetap semangat dan jangan menyerah!
                            </p>
                        @else
                            <div class="w-24 h-24 bg-yellow-100 text-yellow-600 rounded-full flex items-center justify-center mx-auto mb-6 shadow-inner animate-pulse">
                                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <h2 class="text-3xl md:text-4xl font-bold text-yellow-600 mb-2 font-heading">DALAM PROSES</h2>
                            <p class="text-xl text-gray-900 font-bold mb-2">{{ $hasil->nama }}</p>
                            <p class="text-gray-600 max-w-md mx-auto">
                                Data Anda sedang dalam proses verifikasi dan seleksi oleh panitia. Silakan cek kembali secara berkala.
                            </p>
                        @endif
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
