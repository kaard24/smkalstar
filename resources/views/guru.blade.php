@extends('layouts.app')

@section('title', 'Guru & Tenaga Pendidik - SMK Al-Hidayah Lestari')

@section('content')
    <!-- Header Page -->
    <div class="bg-sky-50 py-12 border-b border-sky-100">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-2">Guru & Tenaga Pendidik</h1>
            <p class="text-gray-600">Pengajar dan staf profesional SMK Al-Hidayah Lestari</p>
        </div>
    </div>

    <section class="py-12 md:py-16 bg-white min-h-[400px]">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="max-w-xl mx-auto">
                <svg class="w-20 h-20 text-gray-300 mx-auto mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                </svg>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Halaman Sedang Disiapkan</h3>
                <p class="text-gray-500">Data guru dan tenaga pendidik akan segera ditampilkan di halaman ini.</p>
                <a href="{{ url('/') }}" class="inline-block mt-6 px-6 py-2 bg-primary text-white rounded-lg hover:bg-secondary transition-colors">
                    Kembali ke Beranda
                </a>
            </div>
        </div>
    </section>
@endsection
