@extends('layouts.app')

@section('title', 'Jadwal Seragam - SMK Al-Hidayah Lestari')

@push('styles')
<style>
/* Day Tabs */
.day-tabs {
    display: flex;
    justify-content: center;
    gap: 8px;
    flex-wrap: wrap;
}

.day-tab {
    padding: 10px 20px;
    border-radius: 9999px;
    font-size: 14px;
    font-weight: 500;
    color: #64748b;
    background: white;
    border: 1px solid #e2e8f0;
    cursor: pointer;
    transition: all 0.2s;
    white-space: nowrap;
}

.day-tab:hover {
    border-color: #4276A3;
    color: #4276A3;
}

.day-tab.active {
    background: #4276A3;
    color: white;
    border-color: #4276A3;
    box-shadow: 0 4px 14px rgba(66, 118, 163, 0.3);
}

/* Photo Card */
.photo-card {
    background: white;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1), 0 2px 4px -2px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
}

.photo-card:hover {
    box-shadow: 0 20px 25px -5px rgba(0,0,0,0.1), 0 8px 10px -6px rgba(0,0,0,0.1);
}

.photo-wrapper {
    position: relative;
    aspect-ratio: 3/4;
    overflow: hidden;
    background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
    cursor: pointer;
}

.photo-wrapper img {
    width: 100%;
    height: 100%;
    object-fit: contain;
    transition: transform 0.5s ease;
}

.photo-card:hover .photo-wrapper img {
    transform: scale(1.05);
}

/* Hover Overlay */
.photo-overlay {
    position: absolute;
    inset: 0;
    background: rgba(0,0,0,0);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: all 0.3s ease;
}

.photo-wrapper:hover .photo-overlay {
    background: rgba(0,0,0,0.2);
    opacity: 1;
}

.zoom-icon {
    width: 56px;
    height: 56px;
    background: rgba(255,255,255,0.95);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    transform: scale(0);
    transition: transform 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
    box-shadow: 0 10px 30px rgba(0,0,0,0.3);
}

.photo-wrapper:hover .zoom-icon {
    transform: scale(1);
}

/* Photo Nav Dots */
.photo-nav-dots {
    position: absolute;
    bottom: 12px;
    left: 50%;
    transform: translateX(-50%);
    display: flex;
    gap: 6px;
    padding: 6px 12px;
    background: rgba(0,0,0,0.5);
    border-radius: 20px;
    backdrop-filter: blur(4px);
}

.photo-dot {
    width: 6px;
    height: 6px;
    border-radius: 50%;
    background: rgba(255,255,255,0.4);
    transition: all 0.3s;
}

.photo-dot.active {
    background: white;
    width: 18px;
    border-radius: 3px;
}

/* Caption */
.photo-caption {
    padding: 12px 16px;
    background: #f8fafc;
    border-top: 1px solid #e2e8f0;
    text-align: center;
    font-size: 14px;
    color: #475569;
    font-weight: 500;
}

/* Nav Bar */
.photo-nav-bar {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 12px 16px;
    background: white;
    border-top: 1px solid #e2e8f0;
}

.photo-nav-btn {
    width: 36px;
    height: 36px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #f1f5f9;
    color: #64748b;
    border: none;
    cursor: pointer;
    transition: all 0.2s;
}

.photo-nav-btn:hover {
    background: #e2e8f0;
    color: #475569;
}

/* Empty State */
.empty-photo {
    aspect-ratio: 3/4;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
    color: #94a3b8;
    gap: 12px;
}

/* ===== LIGHTBOX BACKDROP ===== */
.lightbox-backdrop {
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,0.8);
    z-index: 999;
    opacity: 0;
    visibility: hidden;
    transition: all 0.3s ease;
}

.lightbox-backdrop.active {
    opacity: 1;
    visibility: visible;
}

/* ===== LIGHTBOX ===== */
.lightbox {
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%) scale(0.95);
    width: 90vw;
    height: 80vh;
    max-width: 1200px;
    z-index: 1000;
    background: rgba(0,0,0,0.95);
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    visibility: hidden;
    transition: all 0.3s ease;
    overflow: hidden;
}

.lightbox.active {
    opacity: 1;
    visibility: visible;
    transform: translate(-50%, -50%) scale(1);
}

.lightbox-close {
    position: absolute;
    top: 16px;
    right: 16px;
    z-index: 1002;
    width: 48px;
    height: 48px;
    border-radius: 50%;
    background: rgba(255,255,255,0.9);
    border: 2px solid rgba(255,255,255,0.5);
    color: #1f2937;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.2s;
    z-index: 1002;
    box-shadow: 0 4px 20px rgba(0,0,0,0.3);
}

.lightbox-close:hover {
    background: white;
    transform: scale(1.1);
}

.lightbox-content {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    width: 100%;
    height: 100%;
    padding: 60px 60px 80px;
    position: relative;
}

.lightbox-img-wrapper {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 100%;
    height: 100%;
}

.lightbox img {
    max-width: 85%;
    max-height: 65vh;
    width: auto;
    height: auto;
    object-fit: contain;
    cursor: zoom-in;
    transition: transform 0.3s ease;
}

.lightbox img.zoomed {
    cursor: zoom-out;
    transform: scale(1.5);
}

.lightbox img.zoomed {
    cursor: zoom-out;
    transform: scale(1.5);
}

.lightbox-caption {
    position: absolute;
    bottom: 50px;
    left: 60px;
    right: 60px;
    color: white;
    text-align: center;
    padding: 12px 20px;
    font-size: 16px;
    font-weight: 500;
    background: rgba(0,0,0,0.7);
    border-radius: 8px;
    line-height: 1.5;
    z-index: 1001;
}

.lightbox-counter {
    position: absolute;
    bottom: 16px;
    left: 50%;
    transform: translateX(-50%);
    color: rgba(255,255,255,0.7);
    font-size: 13px;
    background: rgba(0,0,0,0.5);
    padding: 4px 14px;
    border-radius: 20px;
    z-index: 1001;
}

/* Lightbox Navigation Arrows */
.lightbox-nav {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background: rgba(255,255,255,0.1);
    backdrop-filter: blur(8px);
    border: 1px solid rgba(255,255,255,0.2);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.2s;
    z-index: 1001;
}

.lightbox-nav:hover {
    background: rgba(255,255,255,0.25);
}

.lightbox-nav.prev { left: 16px; }
.lightbox-nav.next { right: 16px; }

@media (max-width: 768px) {
    .lightbox-inner {
        width: 95vw;
        height: 70vh;
    }
    .lightbox-nav.prev { left: 8px; }
    .lightbox-nav.next { right: 8px; }
    .lightbox-nav {
        width: 40px;
        height: 40px;
    }
    .lightbox-content {
        padding: 50px 40px 70px;
    }
}

/* Loading */
.lightbox-loading {
    position: absolute;
    width: 40px;
    height: 40px;
    border: 3px solid rgba(255,255,255,0.1);
    border-top-color: white;
    border-radius: 50%;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    to { transform: rotate(360deg); }
}

[x-cloak] { display: none !important; }
</style>
@endpush

@section('content')
<!-- Header -->
<div class="relative bg-gradient-to-br from-blue-50 via-sky-50 to-cyan-50 py-16 md:py-24 border-b border-blue-100 overflow-hidden">
    <div class="absolute inset-0">
        <div class="absolute top-1/2 left-0 w-96 h-96 bg-blue-300/20 rounded-full blur-3xl -translate-y-1/2"></div>
        <div class="absolute top-0 right-1/4 w-72 h-72 bg-sky-300/20 rounded-full blur-3xl"></div>
        <div class="absolute inset-0 opacity-10" style="background-image: url('data:image/svg+xml,%3Csvg width=&quot;32&quot; height=&quot;32&quot; viewBox=&quot;0 0 32 32&quot; xmlns=&quot;http://www.w3.org/2000/svg&quot;%3E%3Ccircle cx=&quot;16&quot; cy=&quot;16&quot; r=&quot;2&quot; fill=&quot;%233b82f6&quot; fill-opacity=&quot;0.4&quot;/%3E%3C/svg%3E');"></div>
    </div>
    
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
        <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-gray-900 mb-4">
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-500 via-sky-500 to-cyan-500">Jadwal</span> Seragam
        </h1>
        <p class="text-gray-600 text-lg md:text-xl max-w-3xl mx-auto leading-relaxed">
            Informasi lengkap penggunaan seragam harian untuk siswa laki-laki dan perempuan
        </p>
    </div>
</div>

<!-- Main Content -->
<section class="py-12 md:py-16 bg-white"
         x-data="seragamSwipe({{ $seragam->count() }})"
         x-init="init()">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        
        @if($seragam->count() > 0)
            <!-- Day Tabs -->
            <div class="flex justify-center mb-10">
                <div class="day-tabs">
                    @foreach($seragam as $index => $item)
                    <button @click="goToSlide({{ $index }})" 
                            :class="{ 'active': currentSlide === {{ $index }} }"
                            class="day-tab">
                        {{ $item->hari }}
                    </button>
                    @endforeach
                </div>
            </div>

            <!-- Slides -->
            <div class="overflow-hidden">
                <div class="flex transition-transform duration-300 ease-out"
                     :style="`transform: translateX(-${currentSlide * 100}%)`">
                    
                    @foreach($seragam as $item)
                    @php
                        $fotoLaki = $item->foto_laki_data ?? [];
                        $fotoPerempuan = $item->foto_perempuan_data ?? [];
                    @endphp
                    <div class="w-full flex-shrink-0 px-0 md:px-4">
                        <!-- Day Title -->
                        <div class="text-center mb-8">
                            <h2 class="text-2xl font-bold text-gray-900">{{ $item->hari }}</h2>
                            @if($item->keterangan)
                                <p class="text-gray-500 mt-1">{{ $item->keterangan }}</p>
                            @endif
                        </div>

                        <!-- Photos Grid -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 max-w-4xl mx-auto">
                            <!-- Laki-laki -->
                            <div x-data="photoGallery({{ json_encode($fotoLaki) }}, 'Laki-laki')">
                                <div class="photo-card">
                                    <div class="p-4 bg-gradient-to-r from-blue-50 to-blue-100 border-b border-blue-100 flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-full bg-blue-500 flex items-center justify-center text-white">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                            </svg>
                                        </div>
                                        <span class="font-semibold text-blue-900">Laki-laki</span>
                                        @if(count($fotoLaki) > 1)
                                            <span class="ml-auto text-xs bg-blue-200 text-blue-700 px-3 py-1 rounded-full">
                                                {{ count($fotoLaki) }} foto
                                            </span>
                                        @endif
                                    </div>
                                    
                                    @if(count($fotoLaki) > 0)
                                        <div class="photo-wrapper" @click="openLightbox(currentIndex)">
                                            <img :src="`/storage/${photos[currentIndex].foto}`" 
                                                 :alt="`Seragam {{ $item->hari }} Laki-laki`"
                                                 loading="lazy">
                                            
                                            <!-- Hover Overlay -->
                                            <div class="photo-overlay">
                                                <div class="zoom-icon">
                                                    <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"/>
                                                    </svg>
                                                </div>
                                            </div>
                                            
                                            @if(count($fotoLaki) > 1)
                                            <div class="photo-nav-dots">
                                                <template x-for="(photo, idx) in photos" :key="idx">
                                                    <div class="photo-dot" :class="{ 'active': currentIndex === idx }"></div>
                                                </template>
                                            </div>
                                            @endif
                                        </div>
                                        
                                        <!-- Caption -->
                                        <div class="photo-caption" x-show="photos[currentIndex]?.keterangan" x-text="photos[currentIndex]?.keterangan" x-cloak></div>
                                        
                                        <!-- Navigation -->
                                        @if(count($fotoLaki) > 1)
                                        <div class="photo-nav-bar">
                                            <button @click="prevPhoto()" class="photo-nav-btn">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                                                </svg>
                                            </button>
                                            <span class="text-sm text-gray-500 font-medium">
                                                <span x-text="currentIndex + 1"></span> / {{ count($fotoLaki) }}
                                            </span>
                                            <button @click="nextPhoto()" class="photo-nav-btn">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                                </svg>
                                            </button>
                                        </div>
                                        @endif
                                    @else
                                        <div class="empty-photo">
                                            <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                            <span class="text-sm">Belum ada foto</span>
                                        </div>
                                    @endif
                                </div>

                                <!-- Lightbox Backdrop -->
                                <div class="lightbox-backdrop" 
                                     :class="{ 'active': lightboxOpen }" 
                                     x-cloak 
                                     @click="closeLightbox()"></div>
                                
                                <!-- Lightbox -->
                                <div class="lightbox" 
                                     :class="{ 'active': lightboxOpen }" 
                                     x-cloak
                                     @touchstart="touchStart($event)"
                                     @touchend="touchEnd($event)">
                                    <div class="lightbox-inner">
                                        <button class="lightbox-close" @click="closeLightbox()">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                            </svg>
                                        </button>
                                        
                                        <button class="lightbox-nav prev" @click.stop="prevPhoto()" x-show="photos.length > 1">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                                            </svg>
                                        </button>
                                        
                                        <div class="lightbox-content">
                                            <div class="lightbox-img-wrapper">
                                                <div x-show="lightboxOpen && !imageLoaded" class="lightbox-loading"></div>
                                                <img :src="lightboxOpen ? `/storage/${photos[currentIndex].foto}` : ''" 
                                                     :alt="'Foto seragam'"
                                                     @load="imageLoaded = true"
                                                     @click.stop="toggleZoom()"
                                                     :class="{ 'zoomed': isZoomed }"
                                                     loading="lazy">
                                            </div>
                                            <p class="lightbox-caption" x-text="photos[currentIndex]?.keterangan || ''" x-show="photos[currentIndex]?.keterangan"></p>
                                            <p class="lightbox-counter" x-show="photos.length > 1">
                                                <span x-text="currentIndex + 1"></span> / <span x-text="photos.length"></span>
                                            </p>
                                        </div>
                                        
                                        <button class="lightbox-nav next" @click.stop="nextPhoto()" x-show="photos.length > 1">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Perempuan -->
                            <div x-data="photoGallery({{ json_encode($fotoPerempuan) }}, 'Perempuan')">
                                <div class="photo-card">
                                    <div class="p-4 bg-gradient-to-r from-pink-50 to-pink-100 border-b border-pink-100 flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-full bg-pink-500 flex items-center justify-center text-white">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                            </svg>
                                        </div>
                                        <span class="font-semibold text-pink-900">Perempuan</span>
                                        @if(count($fotoPerempuan) > 1)
                                            <span class="ml-auto text-xs bg-pink-200 text-pink-700 px-3 py-1 rounded-full">
                                                {{ count($fotoPerempuan) }} foto
                                            </span>
                                        @endif
                                    </div>
                                    
                                    @if(count($fotoPerempuan) > 0)
                                        <div class="photo-wrapper" @click="openLightbox(currentIndex)">
                                            <img :src="`/storage/${photos[currentIndex].foto}`" 
                                                 :alt="`Seragam {{ $item->hari }} Perempuan`"
                                                 loading="lazy">
                                            
                                            <!-- Hover Overlay -->
                                            <div class="photo-overlay">
                                                <div class="zoom-icon">
                                                    <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"/>
                                                    </svg>
                                                </div>
                                            </div>
                                            
                                            @if(count($fotoPerempuan) > 1)
                                            <div class="photo-nav-dots">
                                                <template x-for="(photo, idx) in photos" :key="idx">
                                                    <div class="photo-dot" :class="{ 'active': currentIndex === idx }"></div>
                                                </template>
                                            </div>
                                            @endif
                                        </div>
                                        
                                        <!-- Caption -->
                                        <div class="photo-caption" x-show="photos[currentIndex]?.keterangan" x-text="photos[currentIndex]?.keterangan" x-cloak></div>
                                        
                                        <!-- Navigation -->
                                        @if(count($fotoPerempuan) > 1)
                                        <div class="photo-nav-bar">
                                            <button @click="prevPhoto()" class="photo-nav-btn">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                                                </svg>
                                            </button>
                                            <span class="text-sm text-gray-500 font-medium">
                                                <span x-text="currentIndex + 1"></span> / {{ count($fotoPerempuan) }}
                                            </span>
                                            <button @click="nextPhoto()" class="photo-nav-btn">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                                </svg>
                                            </button>
                                        </div>
                                        @endif
                                    @else
                                        <div class="empty-photo">
                                            <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                            <span class="text-sm">Belum ada foto</span>
                                        </div>
                                    @endif
                                </div>

                                <!-- Lightbox Backdrop -->
                                <div class="lightbox-backdrop" 
                                     :class="{ 'active': lightboxOpen }" 
                                     x-cloak 
                                     @click="closeLightbox()"></div>
                                
                                <!-- Lightbox -->
                                <div class="lightbox" 
                                     :class="{ 'active': lightboxOpen }" 
                                     x-cloak
                                     @touchstart="touchStart($event)"
                                     @touchend="touchEnd($event)">
                                    <div class="lightbox-inner">
                                        <button class="lightbox-close" @click="closeLightbox()">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                            </svg>
                                        </button>
                                        
                                        <button class="lightbox-nav prev" @click.stop="prevPhoto()" x-show="photos.length > 1">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                                            </svg>
                                        </button>
                                        
                                        <div class="lightbox-content">
                                            <div class="lightbox-img-wrapper">
                                                <div x-show="lightboxOpen && !imageLoaded" class="lightbox-loading"></div>
                                                <img :src="lightboxOpen ? `/storage/${photos[currentIndex].foto}` : ''" 
                                                     :alt="'Foto seragam'"
                                                     @load="imageLoaded = true"
                                                     @click.stop="toggleZoom()"
                                                     :class="{ 'zoomed': isZoomed }"
                                                     loading="lazy">
                                            </div>
                                            <p class="lightbox-caption" x-text="photos[currentIndex]?.keterangan || ''" x-show="photos[currentIndex]?.keterangan"></p>
                                            <p class="lightbox-counter" x-show="photos.length > 1">
                                                <span x-text="currentIndex + 1"></span> / <span x-text="photos.length"></span>
                                            </p>
                                        </div>
                                        
                                        <button class="lightbox-nav next" @click.stop="nextPhoto()" x-show="photos.length > 1">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

        @else
            <!-- Empty State -->
            <div class="max-w-2xl mx-auto">
                <div class="relative bg-gradient-to-br from-fuchsia-50 via-purple-50 to-pink-50 border border-fuchsia-100 rounded-3xl p-12 md:p-16 text-center overflow-hidden">
                    <div class="absolute inset-0">
                        <div class="absolute top-10 right-10 w-32 h-32 bg-fuchsia-300/20 rounded-full blur-2xl animate-pulse"></div>
                        <div class="absolute bottom-10 left-10 w-24 h-24 bg-purple-300/20 rounded-full blur-2xl animate-pulse" style="animation-delay: 0.5s;"></div>
                    </div>
                    
                    <div class="relative z-10">
                        <div class="w-28 h-28 mx-auto mb-6 bg-gradient-to-br from-fuchsia-100 to-purple-100 rounded-3xl flex items-center justify-center shadow-xl rotate-3 hover:rotate-0 transition-transform duration-500">
                            <svg class="w-14 h-14 text-fuchsia-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-3">Belum ada data seragam</h3>
                        <p class="text-gray-500 mb-2 max-w-md mx-auto">Data jadwal seragam akan segera ditampilkan di sini.</p>
                        <p class="text-fuchsia-500 text-sm font-medium">✨ Stay tuned!</p>
                    </div>
                </div>
            </div>
        @endif
    </div>
</section>
@endsection

@push('scripts')
<script>
// Main Swipe Controller
function seragamSwipe(totalSlides) {
    return {
        currentSlide: 0,
        totalSlides: totalSlides,
        
        next() {
            if (this.currentSlide < this.totalSlides - 1) {
                this.currentSlide++;
            }
        },
        
        prev() {
            if (this.currentSlide > 0) {
                this.currentSlide--;
            }
        },
        
        goToSlide(index) {
            this.currentSlide = index;
        }
    }
}

// Photo Gallery Controller
function photoGallery(photos, type) {
    return {
        photos: photos,
        type: type,
        currentIndex: 0,
        lightboxOpen: false,
        imageLoaded: false,
        isZoomed: false,
        scrollY: 0,
        touchStartX: 0,
        
        init() {
            this.keyHandler = (e) => this.handleKeydown(e);
            document.addEventListener('keydown', this.keyHandler);
        },
        
        nextPhoto() {
            if (this.photos.length > 1) {
                this.currentIndex = (this.currentIndex + 1) % this.photos.length;
                this.imageLoaded = false;
                this.isZoomed = false;
            }
        },
        
        prevPhoto() {
            if (this.photos.length > 1) {
                this.currentIndex = (this.currentIndex - 1 + this.photos.length) % this.photos.length;
                this.imageLoaded = false;
                this.isZoomed = false;
            }
        },
        
        openLightbox(index) {
            this.currentIndex = index;
            this.lightboxOpen = true;
            this.imageLoaded = false;
            this.isZoomed = false;
            this.scrollY = window.scrollY;
            document.body.style.overflow = 'hidden';
            document.body.style.position = 'fixed';
            document.body.style.top = `-${this.scrollY}px`;
            document.body.style.width = '100%';
        },
        
        closeLightbox() {
            this.lightboxOpen = false;
            this.imageLoaded = false;
            this.isZoomed = false;
            document.body.style.overflow = '';
            document.body.style.position = '';
            document.body.style.top = '';
            document.body.style.width = '';
            window.scrollTo(0, this.scrollY);
        },
        
        toggleZoom() {
            if (this.photos.length <= 1) return;
            this.isZoomed = !this.isZoomed;
        },
        
        // Touch swipe for lightbox
        touchStart(e) {
            this.touchStartX = e.touches[0].clientX;
        },
        
        touchEnd(e) {
            if (this.photos.length <= 1) return;
            
            const touchEndX = e.changedTouches[0].clientX;
            const diff = this.touchStartX - touchEndX;
            
            if (Math.abs(diff) > 50) {
                if (diff > 0) {
                    this.nextPhoto();
                } else {
                    this.prevPhoto();
                }
            }
        },
        
        // Keyboard handler
        handleKeydown(e) {
            if (!this.lightboxOpen) return;
            
            if (e.key === 'Escape') this.closeLightbox();
            if (e.key === 'ArrowLeft' && this.photos.length > 1) this.prevPhoto();
            if (e.key === 'ArrowRight' && this.photos.length > 1) this.nextPhoto();
        }
    }
}
</script>
@endpush
