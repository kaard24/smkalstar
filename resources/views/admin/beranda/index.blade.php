@extends('layouts.admin')

@section('title', 'Kelola Beranda - Admin Panel')

@section('content')
    {{-- Header --}}
    <div class="mb-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-lg font-semibold text-slate-800">Kelola Beranda</h1>
                <p class="text-sm text-slate-600 mt-1">Atur section dan konten halaman utama</p>
            </div>
            <a href="{{ route('admin.beranda.create') }}" class="btn btn-primary">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Tambah Section
            </a>
        </div>
    </div>

    {{-- Alerts --}}
    @if(session('success'))
    <div class="mb-4 p-3 bg-[#4276A3]/10 border border-[#4276A3]/20 text-[#4276A3] rounded-lg text-sm">
        {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="mb-4 p-3 bg-[#991B1B]/10 border border-[#991B1B]/20 text-[#991B1B] rounded-lg text-sm">
        {{ session('error') }}
    </div>
    @endif

    {{-- Sections by Type --}}
    @php
        $tipeLabels = \App\Models\BerandaSection::getTipeList();
        $tipeIcons = [
            'hero' => 'M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z',
            'about' => 'M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z',
            'feature' => 'M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z',
            'statistic' => 'M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z',
            'cta' => 'M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z',
        ];
    @endphp

    @forelse($tipeLabels as $tipe => $label)
        @php
            $tipeSections = $sections->get($tipe, collect());
        @endphp
        <div class="mb-6">
            <div class="flex items-center gap-2 mb-3">
                <svg class="w-5 h-5 text-[#4276A3]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $tipeIcons[$tipe] ?? 'M4 6h16M4 12h16M4 18h16' }}"/>
                </svg>
                <h2 class="text-sm font-semibold text-slate-700">{{ $label }}</h2>
                <span class="px-2 py-0.5 bg-slate-100 text-slate-600 rounded text-xs">{{ $tipeSections->count() }}</span>
            </div>

            @if($tipeSections->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach($tipeSections as $section)
                    <div class="card p-4 {{ $section->is_active ? 'border-l-4 border-green-500' : 'opacity-60' }}">
                        <div class="flex items-start justify-between mb-3">
                            <span class="px-2 py-0.5 rounded text-xs font-medium {{ $section->warna_badge }}">
                                {{ $section->tipe_label }}
                            </span>
                            <div class="flex items-center gap-1">
                                <form action="{{ route('admin.beranda.toggle-active', $section) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="p-1 rounded hover:bg-slate-100 {{ $section->is_active ? 'text-green-600' : 'text-slate-400' }}" title="{{ $section->is_active ? 'Nonaktifkan' : 'Aktifkan' }}">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                    </button>
                                </form>
                                <a href="{{ route('admin.beranda.edit', $section) }}" class="p-1 rounded hover:bg-slate-100 text-[#4276A3]" title="Edit">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                </a>
                                <form action="{{ route('admin.beranda.destroy', $section) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus section ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-1 rounded hover:bg-slate-100 text-[#991B1B]" title="Hapus">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>

                        @if($section->gambar)
                        <div class="mb-3 aspect-video rounded-lg overflow-hidden bg-slate-100">
                            <img src="{{ $section->gambar_url }}" alt="{{ $section->judul }}" class="w-full h-full object-cover">
                        </div>
                        @endif

                        <h3 class="font-medium text-slate-800 mb-1">{{ $section->judul }}</h3>
                        @if($section->subjudul)
                        <p class="text-xs text-slate-500 mb-2">{{ $section->subjudul }}</p>
                        @endif
                        
                        <div class="flex items-center justify-between mt-3 pt-3 border-t border-slate-100">
                            <span class="text-xs text-slate-400">Urutan: {{ $section->urutan }}</span>
                            @if($section->tombol_teks)
                            <span class="text-xs px-2 py-0.5 bg-blue-50 text-blue-600 rounded">{{ $section->tombol_teks }}</span>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <div class="card p-6 text-center text-slate-500">
                    <svg class="w-10 h-10 mx-auto mb-2 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    <p class="text-sm">Belum ada section {{ $label }}</p>
                    <a href="{{ route('admin.beranda.create') }}?tipe={{ $tipe }}" class="text-[#4276A3] hover:underline text-xs mt-1 inline-block">Tambah section</a>
                </div>
            @endif
        </div>
    @empty
        <div class="card p-8 text-center">
            <svg class="w-12 h-12 mx-auto mb-3 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
            </svg>
            <p class="text-slate-500">Belum ada section beranda</p>
            <a href="{{ route('admin.beranda.create') }}" class="btn btn-primary mt-3">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Tambah Section
            </a>
        </div>
    @endforelse
@endsection
