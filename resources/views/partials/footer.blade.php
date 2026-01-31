<footer class="bg-gray-900 text-gray-300 pt-12 pb-24 md:pb-12 border-t border-gray-800">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
            <!-- Brand & Desc -->
            <div>
                <div class="flex items-center gap-2 mb-4">
                    <img class="h-10 w-auto rounded-full" src="{{ asset('images/logo.jpg') }}" alt="Logo SMK Al-Hidayah Lestari">
                    <span class="font-bold text-lg tracking-tight text-white">SMK Al-Hidayah Lestari</span>
                </div>
                <p class="text-gray-400 text-sm leading-relaxed mb-4">
                    Mewujudkan generasi unggul, berakhlak mulia, dan siap kerja dengan kompetensi masa depan.
                </p>
                <div class="flex space-x-4">
                    <a href="https://www.instagram.com/smkalstar/?hl=af" target="_blank" class="text-gray-400 hover:text-pink-500 transition">
                        <span class="sr-only">Instagram</span>
                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                    </a>
                    <a href="https://www.tiktok.com/@smkalstar" target="_blank" class="text-gray-400 hover:text-white transition">
                        <span class="sr-only">TikTok</span>
                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93v6.16c0 3.13-1.12 6.19-3.32 8.44-1.48 1.46-3.49 2.27-5.59 2.27-2.79.03-5.57-1.07-7.55-3.04-1.99-1.92-3.13-4.66-3.14-7.44-.02-2.75 1.12-5.46 3.07-7.42 1.94-1.98 4.67-3.11 7.42-3.13v4.51c-1.12.04-2.21.48-3 1.25-.8.74-1.27 1.76-1.29 2.84-.01 2.25 1.83 4.09 4.08 4.1 2.26 0 4.1-1.83 4.1-4.1V.02z"/></svg>
                    </a>
                    <a href="https://youtube.com/@smkal-hidayahlestari5604" target="_blank" class="text-gray-400 hover:text-red-600 transition">
                        <span class="sr-only">YouTube</span>
                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                    </a>
                </div>
            </div>

            <!-- Quick Links -->
            <div>
                <h3 class="text-base font-semibold mb-4 text-white">Tautan Cepat</h3>
                <ul class="space-y-2 text-sm text-gray-400">
                    <li><a href="{{ url('/profil') }}" class="hover:text-primary transition">Profil Sekolah</a></li>
                    <li><a href="{{ url('/jurusan') }}" class="hover:text-primary transition">Kompetensi Keahlian</a></li>
                    <li><a href="{{ url('/ppdb/info') }}" class="hover:text-primary transition">Info SPMB</a></li>
                    <li><a href="{{ url('/ekstrakurikuler') }}" class="hover:text-primary transition">Ekstrakurikuler</a></li>
                    <li><a href="{{ url('/berita') }}" class="hover:text-primary transition">Berita</a></li>
                </ul>
            </div>

            <!-- Contact -->
            <div>
                <h3 class="text-base font-semibold mb-4 text-white">Hubungi Kami</h3>
                <ul class="space-y-3 text-sm text-gray-400">
                    <li class="flex items-start">
                        <svg class="h-5 w-5 text-primary mr-2 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <a href="https://maps.app.goo.gl/AWMEJJrR6kJmquZD7" target="_blank" class="hover:text-primary transition">
                            JL. KANA LESTARI BLOK K/I, Lb. Bulus, Kec. Cilandak, Jakarta Selatan 12440
                        </a>
                    </li>
                    <li class="flex items-center">
                        <svg class="h-5 w-5 text-primary mr-2 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                        <span>(021) 7661343</span>
                    </li>
                    <li class="flex items-center">
                        <svg class="h-5 w-5 text-green-500 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M.057 24l1.687-6.163c-3.138-5.437-2.1-11.966 3.038-16.148 5.462-4.446 13.532-4.088 18.575 1.14 5.043 5.228 5.61 13.332 1.348 19.32H.057zM23.633 4.97c-5.184-5.366-14.156-5.405-19.349.333C-1.127 9.876-1.077 17.585 4.3 22.03L2.24 29.537l7.536-2.015c1.82 1.05 3.916 1.625 6.13 1.625 6.89 0 12.5-5.61 12.5-12.5 0-3.342-1.303-6.483-3.67-8.67z"/>
                        </svg>
                        <a href="https://wa.me/62812345678" target="_blank" class="hover:text-green-400 transition">Chat WhatsApp</a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="border-t border-gray-800 pt-6 flex flex-col md:flex-row justify-between items-center gap-4">
            <p class="text-gray-500 text-xs text-center md:text-left">
                &copy; {{ date('Y') }} SMK Al-Hidayah Lestari. All rights reserved.
            </p>
            <div class="flex space-x-4 text-xs text-gray-500">
                <a href="#" class="hover:text-white transition">Privacy Policy</a>
                <a href="#" class="hover:text-white transition">Terms</a>
            </div>
        </div>
    </div>
</footer>
