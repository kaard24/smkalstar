@extends('layouts.app')

@section('title', 'Kalender Akademik SPMB - SMK Al-Hidayah Lestari')

@section('content')
    <!-- Header Page -->
    <div class="relative bg-gradient-to-br from-blue-50 via-sky-50 to-cyan-50 py-16 md:py-24 border-b border-blue-100 overflow-hidden">
        <div class="absolute inset-0">
            <div class="absolute top-0 right-1/4 w-96 h-96 bg-blue-300/20 rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 left-1/4 w-72 h-72 bg-sky-300/20 rounded-full blur-3xl"></div>
        </div>
        
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
            <div class="inline-flex items-center gap-2 bg-gradient-to-r from-blue-500 to-cyan-500 text-white px-5 py-2 rounded-full text-sm font-bold mb-6 shadow-lg shadow-blue-200">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                Tahun Ajaran 2026/2027
            </div>
            <h1 class="text-3xl md:text-4xl lg:text-5xl xl:text-6xl font-bold text-gray-900 mb-4 font-heading">
                Kalender Akademik <br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-500 via-sky-500 to-cyan-500">SPMB 2026/2027</span>
            </h1>
            <p class="text-gray-600 text-lg md:text-xl max-w-3xl mx-auto leading-relaxed">Jadwal lengkap pendaftaran, tes masuk, dan pengumuman hasil seleksi</p>
        </div>
    </div>

    <!-- Global Countdown Section -->
    @php
        $now = now();
        $activeGelombang = null;
        $nextEvent = null;
        
        foreach ($gelombang as $g) {
            $pendaftaranStart = $g->pendaftaran_start;
            $pendaftaranEnd = $g->pendaftaran_end;
            $tesStart = $g->tes_mulai;
            $tesEnd = $g->tes_selesai;
            $pengumuman = $g->pengumuman;
            
            // Cek pendaftaran berlangsung
            if ($now->between($pendaftaranStart, $pendaftaranEnd)) {
                $activeGelombang = $g;
                $nextEvent = ['type' => 'pendaftaran', 'date' => $pendaftaranEnd, 'label' => 'Pendaftaran ditutup'];
                break;
            }
            // Cek tes berlangsung
            elseif ($now->between($tesStart, $tesEnd)) {
                $activeGelombang = $g;
                $nextEvent = ['type' => 'tes', 'date' => $tesEnd, 'label' => 'Tes selesai'];
                break;
            }
            // Cek sebelum pendaftaran
            elseif ($now->lt($pendaftaranStart)) {
                if (!$nextEvent || $pendaftaranStart->lt($nextEvent['date'])) {
                    $nextEvent = ['type' => 'buka', 'date' => $pendaftaranStart, 'label' => 'Pendaftaran dibuka'];
                }
            }
            // Cek sebelum tes
            elseif ($now->lt($tesStart)) {
                if (!$nextEvent || $tesStart->lt($nextEvent['date'])) {
                    $nextEvent = ['type' => 'tes', 'date' => $tesStart, 'label' => 'Tes masuk dimulai'];
                }
            }
            // Cek sebelum pengumuman
            elseif ($now->lt($pengumuman)) {
                if (!$nextEvent || $pengumuman->lt($nextEvent['date'])) {
                    $nextEvent = ['type' => 'pengumuman', 'date' => $pengumuman, 'label' => 'Pengumuman hasil'];
                }
            }
        }
    @endphp

    @if($nextEvent)
    <section class="py-12 bg-gradient-to-r from-blue-600 to-cyan-600 relative overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <svg class="w-full h-full" viewBox="0 0 100 100" preserveAspectRatio="none">
                <pattern id="grid" width="10" height="10" patternUnits="userSpaceOnUse">
                    <circle cx="5" cy="5" r="1" fill="white"/>
                </pattern>
                <rect width="100" height="100" fill="url(#grid)"/>
            </svg>
        </div>
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center mb-8">
                <p class="text-blue-100 text-lg mb-2">{{ $nextEvent['label'] }}</p>
                <h2 class="text-3xl md:text-4xl font-bold text-white font-heading" id="global-countdown">
                    Memuat...
                </h2>
            </div>
            <div class="flex flex-wrap justify-center gap-4 md:gap-6" id="countdown-units">
                <div class="bg-white/10 backdrop-blur-sm rounded-2xl px-6 py-4 text-center min-w-[80px]">
                    <div class="text-3xl md:text-4xl font-bold text-white" id="cd-days">00</div>
                    <div class="text-blue-100 text-sm">Hari</div>
                </div>
                <div class="bg-white/10 backdrop-blur-sm rounded-2xl px-6 py-4 text-center min-w-[80px]">
                    <div class="text-3xl md:text-4xl font-bold text-white" id="cd-hours">00</div>
                    <div class="text-blue-100 text-sm">Jam</div>
                </div>
                <div class="bg-white/10 backdrop-blur-sm rounded-2xl px-6 py-4 text-center min-w-[80px]">
                    <div class="text-3xl md:text-4xl font-bold text-white" id="cd-minutes">00</div>
                    <div class="text-blue-100 text-sm">Menit</div>
                </div>
                <div class="bg-white/10 backdrop-blur-sm rounded-2xl px-6 py-4 text-center min-w-[80px]">
                    <div class="text-3xl md:text-4xl font-bold text-white" id="cd-seconds">00</div>
                    <div class="text-blue-100 text-sm">Detik</div>
                </div>
            </div>
        </div>
    </section>
    @endif

    <!-- Timeline Section -->
    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 font-heading mb-4">Timeline SPMB 2026</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Ikuti setiap tahapan dengan cermat. Status akan diperbarui secara otomatis berdasarkan jadwal.</p>
            </div>

            <!-- Timeline Cards -->
            <div class="space-y-8">
                @foreach($gelombang as $index => $g)
                    @php
                        $pendaftaranStart = $g->pendaftaran_start;
                        $pendaftaranEnd = $g->pendaftaran_end;
                        $tesStart = $g->tes_mulai;
                        $tesEnd = $g->tes_selesai;
                        $pengumuman = $g->pengumuman;
                        
                        // Gunakan accessor dari model
                        $statusPendaftaran = $g->status_pendaftaran;
                        $statusTes = $g->status_tes;
                        $statusPengumuman = $g->status_pengumuman;
                        
                        $statusColors = [
                            'SELESAI' => ['bg' => 'bg-green-100', 'text' => 'text-green-700', 'border' => 'border-green-200', 'icon' => 'text-green-500'],
                            'BERLANGSUNG' => ['bg' => 'bg-blue-100', 'text' => 'text-blue-700', 'border' => 'border-blue-200', 'icon' => 'text-blue-500'],
                            'MENDATANG' => ['bg' => 'bg-gray-100', 'text' => 'text-gray-600', 'border' => 'border-gray-200', 'icon' => 'text-gray-400'],
                            'BUKA' => ['bg' => 'bg-emerald-100', 'text' => 'text-emerald-700', 'border' => 'border-emerald-200', 'icon' => 'text-emerald-500']
                        ];
                        
                        $gelombangAktif = $g->is_aktif;
                    @endphp

                    <div class="bg-white rounded-3xl shadow-lg border {{ $gelombangAktif ? 'border-blue-200 ring-2 ring-blue-100' : 'border-gray-100' }} overflow-hidden hover:shadow-xl transition duration-300" id="gelombang-{{ $g->nomor }}">
                        <!-- Header Gelombang -->
                        <div class="p-6 md:p-8 border-b {{ $gelombangAktif ? 'bg-gradient-to-r from-blue-50 to-cyan-50 border-blue-100' : 'border-gray-100' }}">
                            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                                <div class="flex items-center gap-4">
                                    <div class="w-16 h-16 rounded-2xl {{ $gelombangAktif ? 'bg-gradient-to-br from-blue-500 to-cyan-500 text-white' : 'bg-gray-100 text-gray-500' }} flex items-center justify-center text-2xl font-bold font-heading">
                                        {{ $g->nomor }}
                                    </div>
                                    <div>
                                        <h3 class="text-2xl font-bold text-gray-900 font-heading">{{ $g->nama }}</h3>
                                        <p class="text-gray-500 text-sm mt-1">Tahun Ajaran {{ $g->tahun_ajaran }}</p>
                                    </div>
                                </div>
                                @if($gelombangAktif)
                                    <span class="inline-flex items-center gap-2 bg-gradient-to-r from-blue-500 to-cyan-500 text-white px-4 py-2 rounded-xl text-sm font-bold shadow-lg">
                                        <span class="w-2 h-2 bg-white rounded-full animate-pulse"></span>
                                        SEDANG BERLANGSUNG
                                    </span>
                                @elseif($now->gt($pengumuman))
                                    <span class="inline-flex items-center gap-2 bg-gray-100 text-gray-500 px-4 py-2 rounded-xl text-sm font-bold border border-gray-200">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        SELESAI
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-2 bg-gray-100 text-gray-500 px-4 py-2 rounded-xl text-sm font-bold border border-gray-200">
                                        {{ $now->lt($pendaftaranStart) ? 'MENDATANG' : 'AKAN DATANG' }}
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- Timeline Steps -->
                        <div class="p-6 md:p-8">
                            <div class="grid md:grid-cols-3 gap-6">
                                <!-- Pendaftaran -->
                                <div class="relative {{ $statusColors[$statusPendaftaran]['bg'] }} rounded-2xl p-6 border {{ $statusColors[$statusPendaftaran]['border'] }} {{ $statusPendaftaran == 'BERLANGSUNG' ? 'ring-2 ring-blue-200' : '' }}">
                                    @if($statusPendaftaran == 'BERLANGSUNG')
                                        <div class="absolute -top-3 -right-3 w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center animate-pulse">
                                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                            </svg>
                                        </div>
                                    @endif
                                    <div class="flex items-center gap-3 mb-4">
                                        <div class="w-12 h-12 rounded-xl bg-white {{ $statusColors[$statusPendaftaran]['icon'] }} flex items-center justify-center">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <h4 class="font-bold text-gray-900">Pendaftaran</h4>
                                            <span class="inline-block mt-1 px-2 py-0.5 rounded text-xs font-bold {{ $statusColors[$statusPendaftaran]['bg'] }} {{ $statusColors[$statusPendaftaran]['text'] }}">
                                                {{ $statusPendaftaran }}
                                            </span>
                                        </div>
                                    </div>
                                    <p class="text-sm text-gray-600 mb-2">
                                        <span class="font-medium">{{ $pendaftaranStart->translatedFormat('d M Y') }}</span> - 
                                        <span class="font-medium">{{ $pendaftaranEnd->translatedFormat('d M Y') }}</span>
                                    </p>
                                    @if($statusPendaftaran == 'BERLANGSUNG')
                                        @php
                                            $sisaHari = $now->diffInDays($pendaftaranEnd, false);
                                        @endphp
                                        <div class="mt-3 pt-3 border-t {{ $statusColors[$statusPendaftaran]['border'] }}">
                                            <p class="text-sm {{ $statusColors[$statusPendaftaran]['text'] }} font-medium">
                                                Sisa waktu: {{ ceil($sisaHari) }} hari
                                            </p>
                                        </div>
                                    @endif
                                </div>

                                <!-- Tes Masuk -->
                                <div class="relative {{ $statusColors[$statusTes]['bg'] }} rounded-2xl p-6 border {{ $statusColors[$statusTes]['border'] }} {{ $statusTes == 'BERLANGSUNG' ? 'ring-2 ring-blue-200' : '' }}">
                                    @if($statusTes == 'BERLANGSUNG')
                                        <div class="absolute -top-3 -right-3 w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center animate-pulse">
                                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                            </svg>
                                        </div>
                                    @endif
                                    <div class="flex items-center gap-3 mb-4">
                                        <div class="w-12 h-12 rounded-xl bg-white {{ $statusColors[$statusTes]['icon'] }} flex items-center justify-center">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <h4 class="font-bold text-gray-900">Tes Masuk</h4>
                                            <span class="inline-block mt-1 px-2 py-0.5 rounded text-xs font-bold {{ $statusColors[$statusTes]['bg'] }} {{ $statusColors[$statusTes]['text'] }}">
                                                {{ $statusTes }}
                                            </span>
                                        </div>
                                    </div>
                                    <p class="text-sm text-gray-600 mb-2">
                                        <span class="font-medium">{{ $tesStart->translatedFormat('d M Y') }}</span> - 
                                        <span class="font-medium">{{ $tesEnd->translatedFormat('d M Y') }}</span>
                                    </p>
                                    @if($statusTes == 'BERLANGSUNG')
                                        @php
                                            $sisaHariTes = $now->diffInDays($tesEnd, false);
                                        @endphp
                                        <div class="mt-3 pt-3 border-t {{ $statusColors[$statusTes]['border'] }}">
                                            <p class="text-sm {{ $statusColors[$statusTes]['text'] }} font-medium">
                                                Berlangsung: {{ ceil($sisaHariTes) }} hari lagi
                                            </p>
                                        </div>
                                    @endif
                                </div>

                                <!-- Pengumuman -->
                                <div class="relative {{ $statusColors[$statusPengumuman]['bg'] }} rounded-2xl p-6 border {{ $statusColors[$statusPengumuman]['border'] }}">
                                    <div class="flex items-center gap-3 mb-4">
                                        <div class="w-12 h-12 rounded-xl bg-white {{ $statusColors[$statusPengumuman]['icon'] }} flex items-center justify-center">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <h4 class="font-bold text-gray-900">Pengumuman</h4>
                                            <span class="inline-block mt-1 px-2 py-0.5 rounded text-xs font-bold {{ $statusColors[$statusPengumuman]['bg'] }} {{ $statusColors[$statusPengumuman]['text'] }}">
                                                {{ $statusPengumuman }}
                                            </span>
                                        </div>
                                    </div>
                                    <p class="text-sm text-gray-600 mb-2">
                                        <span class="font-medium">{{ $pengumuman->translatedFormat('d M Y') }}</span>
                                    </p>
                                    @if($statusPengumuman == 'MENDATANG' && $now->diffInDays($pengumuman, false) <= 7 && $now->diffInDays($pengumuman, false) > 0)
                                        @php
                                            $sisaHariPengumuman = $now->diffInDays($pengumuman, false);
                                        @endphp
                                        <div class="mt-3 pt-3 border-t {{ $statusColors[$statusPengumuman]['border'] }}">
                                            <p class="text-sm {{ $statusColors[$statusPengumuman]['text'] }} font-medium">
                                                {{ ceil($sisaHariPengumuman) }} hari lagi
                                            </p>
                                        </div>
                                    @endif
                                    @if($statusPengumuman == 'SELESAI')
                                        <div class="mt-3 pt-3 border-t {{ $statusColors[$statusPengumuman]['border'] }}">
                                            <a href="{{ route('spmb.pengumuman') }}" class="inline-flex items-center gap-1 text-sm {{ $statusColors[$statusPengumuman]['text'] }} font-medium hover:underline">
                                                Cek hasil
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                                </svg>
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>


        </div>
    </section>

    @push('scripts')
    <script>
        @if($nextEvent)
        // Countdown Timer
        const targetDate = new Date('{{ $nextEvent['date']->format('Y-m-d H:i:s') }}').getTime();
        
        function updateCountdown() {
            const now = new Date().getTime();
            const distance = targetDate - now;
            
            if (distance < 0) {
                document.getElementById('global-countdown').innerHTML = 'Waktu habis!';
                document.getElementById('cd-days').innerHTML = '00';
                document.getElementById('cd-hours').innerHTML = '00';
                document.getElementById('cd-minutes').innerHTML = '00';
                document.getElementById('cd-seconds').innerHTML = '00';
                return;
            }
            
            const days = Math.floor(distance / (1000 * 60 * 60 * 24));
            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);
            
            document.getElementById('cd-days').innerHTML = String(days).padStart(2, '0');
            document.getElementById('cd-hours').innerHTML = String(hours).padStart(2, '0');
            document.getElementById('cd-minutes').innerHTML = String(minutes).padStart(2, '0');
            document.getElementById('cd-seconds').innerHTML = String(seconds).padStart(2, '0');
            
            document.getElementById('global-countdown').innerHTML = days + ' hari lagi';
        }
        
        updateCountdown();
        setInterval(updateCountdown, 1000);
        @endif
    </script>
    @endpush
@endsection
