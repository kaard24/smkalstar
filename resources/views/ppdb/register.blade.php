@extends('layouts.app')

@section('title', 'Formulir Pendaftaran - SMK Al-Hidayah Lestari')

@section('content')
    <div class="relative bg-gray-50 min-h-screen py-20 overflow-hidden">
        <div class="absolute inset-0 z-0 opacity-5 pointer-events-none">
            <svg class="absolute top-0 left-0 w-full h-full text-primary" fill="currentColor" viewBox="0 0 100 100" preserveAspectRatio="none">
                <path d="M0 0 L50 100 L100 0 Z" opacity="0.1" />
            </svg>
        </div>

        <div class="container relative z-10 mx-auto px-4 sm:px-6 lg:px-8 max-w-4xl">
            <!-- Header -->
            <div class="text-center mb-12">
                <h1 class="text-3xl md:text-5xl font-bold text-gray-900 font-heading mb-4">Formulir Pendaftaran</h1>
                <p class="text-gray-600 text-lg">Lengkapi data diri Anda untuk bergabung bersama kami</p>
                @auth
                <div class="mt-4 inline-flex items-center gap-2 bg-white px-4 py-2 rounded-full shadow-sm border border-gray-100 text-sm text-gray-600">
                    <span>Login sebagai:</span>
                    <span class="font-bold text-primary">{{ Auth::user()->email }}</span>
                </div>
                @endauth
            </div>

            @if(session('error'))
            <div class="mb-8 p-6 bg-red-50 border border-red-100 text-red-700 rounded-2xl flex items-center gap-4">
                <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                <span>{{ session('error') }}</span>
            </div>
            @endif

            @if($errors->any())
            <div class="mb-8 p-6 bg-red-50 border border-red-100 text-red-700 rounded-2xl">
                <div class="flex items-center gap-4 mb-2">
                    <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                    <span class="font-bold">Mohon periksa kesalahan berikut:</span>
                </div>
                <ul class="list-disc list-inside text-sm space-y-1 ml-10">
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <div class="bg-white rounded-[2rem] shadow-xl border border-gray-100 overflow-hidden" x-data="{ step: 1, formData: {} }">
                <!-- Step Indicator -->
                <div class="bg-gray-50/50 p-8 border-b border-gray-100">
                    <div class="flex items-center justify-between relative px-4">
                         <!-- Line -->
                        <div class="absolute left-0 top-1/2 transform -translate-y-1/2 w-full h-1.5 bg-gray-200 rounded-full z-0"></div>
                        <div class="absolute left-0 top-1/2 transform -translate-y-1/2 h-1.5 bg-gradient-to-r from-green-400 to-green-600 rounded-full z-0 transition-all duration-500 will-change-width" :style="'width: ' + ((step - 1) * 25) + '%'"></div>

                        <!-- Steps -->
                        <template x-for="i in 5">
                            <div class="relative z-10 flex flex-col items-center cursor-pointer group" @click="step = i">
                                <div class="w-10 h-10 md:w-12 md:h-12 rounded-full flex items-center justify-center font-bold text-sm md:text-base transition-all duration-300 border-4"
                                    :class="step >= i ? 'bg-primary border-primary text-white shadow-lg scale-110' : 'bg-white border-gray-200 text-gray-400 group-hover:border-primary/30'">
                                    <span x-text="i"></span>
                                </div>
                                <span class="hidden md:block text-xs font-bold mt-3 text-gray-500 uppercase tracking-wider transition duration-300"
                                      :class="step >= i ? 'text-primary' : ''"
                                      x-text="['Data Siswa', 'Data Ortu', 'Jurusan', 'Dokumen', 'Review'][i-1]"></span>
                            </div>
                        </template>
                    </div>
                </div>

                <!-- Form Content -->
                <form action="{{ route('ppdb.store') }}" method="POST" class="p-8 md:p-12" id="registerForm">
                    @csrf
                    
                    <!-- Step 1: Data Siswa -->
                    <div x-show="step === 1" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform translate-x-4" x-transition:enter-end="opacity-100 transform translate-x-0">
                        <div class="flex items-center gap-3 mb-8">
                            <span class="w-8 h-8 rounded-lg bg-primary/10 text-primary flex items-center justify-center font-bold">1</span>
                            <h2 class="text-2xl font-bold text-gray-900 font-heading">Data Pribadi Siswa</h2>
                        </div>
                        
                        <div class="grid md:grid-cols-2 gap-8">
                            <div class="space-y-2">
                                <label class="block text-sm font-bold text-gray-700">NISN <span class="text-red-500">*</span></label>
                                <input type="text" name="nisn" value="{{ old('nisn') }}" class="w-full px-4 py-3 rounded-xl border-gray-200 focus:border-primary focus:ring focus:ring-primary/20 transition shadow-sm placeholder-gray-400 bg-gray-50 focus:bg-white" placeholder="00xxxxxx" required>
                            </div>
                            <div class="space-y-2">
                                <label class="block text-sm font-bold text-gray-700">Nama Lengkap <span class="text-red-500">*</span></label>
                                <input type="text" name="nama" value="{{ old('nama') }}" class="w-full px-4 py-3 rounded-xl border-gray-200 focus:border-primary focus:ring focus:ring-primary/20 transition shadow-sm placeholder-gray-400 bg-gray-50 focus:bg-white" placeholder="Sesuai Ijazah" required>
                            </div>
                             <div class="space-y-2">
                                <label class="block text-sm font-bold text-gray-700">Tanggal Lahir <span class="text-red-500">*</span></label>
                                <input type="date" name="tgl_lahir" value="{{ old('tgl_lahir') }}" class="w-full px-4 py-3 rounded-xl border-gray-200 focus:border-primary focus:ring focus:ring-primary/20 transition shadow-sm bg-gray-50 focus:bg-white cursor-pointer" required>
                            </div>
                            <div class="space-y-2">
                                <label class="block text-sm font-bold text-gray-700">Jenis Kelamin <span class="text-red-500">*</span></label>
                                <div class="relative">
                                    <select name="jk" class="w-full px-4 py-3 rounded-xl border-gray-200 focus:border-primary focus:ring focus:ring-primary/20 transition shadow-sm bg-gray-50 focus:bg-white appearance-none" required>
                                        <option value="">Pilih Jenis Kelamin</option>
                                        <option value="L" {{ old('jk') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                        <option value="P" {{ old('jk') == 'P' ? 'selected' : '' }}>Perempuan</option>
                                    </select>
                                    <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none text-gray-500">
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                    </div>
                                </div>
                            </div>
                            <div class="space-y-2">
                                <label class="block text-sm font-bold text-gray-700">No. WhatsApp <span class="text-red-500">*</span></label>
                                <input type="text" name="no_wa" value="{{ old('no_wa') }}" class="w-full px-4 py-3 rounded-xl border-gray-200 focus:border-primary focus:ring focus:ring-primary/20 transition shadow-sm placeholder-gray-400 bg-gray-50 focus:bg-white" placeholder="0812xxxxxxxx" required>
                            </div>
                            <div class="space-y-2">
                                <label class="block text-sm font-bold text-gray-700">Asal Sekolah <span class="text-red-500">*</span></label>
                                <input type="text" name="asal_sekolah" value="{{ old('asal_sekolah') }}" class="w-full px-4 py-3 rounded-xl border-gray-200 focus:border-primary focus:ring focus:ring-primary/20 transition shadow-sm placeholder-gray-400 bg-gray-50 focus:bg-white" placeholder="SMP/MTs..." required>
                            </div>
                             <div class="md:col-span-2 space-y-2">
                                <label class="block text-sm font-bold text-gray-700">Alamat Lengkap <span class="text-red-500">*</span></label>
                                <textarea name="alamat" rows="3" class="w-full px-4 py-3 rounded-xl border-gray-200 focus:border-primary focus:ring focus:ring-primary/20 transition shadow-sm placeholder-gray-400 bg-gray-50 focus:bg-white resize-none" required>{{ old('alamat') }}</textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Step 2: Data Ortu -->
                    <div x-show="step === 2" x-cloak x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform translate-x-4" x-transition:enter-end="opacity-100 transform translate-x-0">
                          <div class="flex items-center gap-3 mb-8">
                            <span class="w-8 h-8 rounded-lg bg-primary/10 text-primary flex items-center justify-center font-bold">2</span>
                            <h2 class="text-2xl font-bold text-gray-900 font-heading">Data Orang Tua / Wali</h2>
                        </div>

                          <div class="grid md:grid-cols-2 gap-8">
                            <div class="space-y-2">
                                <label class="block text-sm font-bold text-gray-700">Nama Ayah <span class="text-red-500">*</span></label>
                                <input type="text" name="nama_ayah" value="{{ old('nama_ayah') }}" class="w-full px-4 py-3 rounded-xl border-gray-200 focus:border-primary focus:ring focus:ring-primary/20 transition shadow-sm placeholder-gray-400 bg-gray-50 focus:bg-white" required>
                            </div>
                             <div class="space-y-2">
                                <label class="block text-sm font-bold text-gray-700">Nama Ibu <span class="text-red-500">*</span></label>
                                <input type="text" name="nama_ibu" value="{{ old('nama_ibu') }}" class="w-full px-4 py-3 rounded-xl border-gray-200 focus:border-primary focus:ring focus:ring-primary/20 transition shadow-sm placeholder-gray-400 bg-gray-50 focus:bg-white" required>
                            </div>
                            <div class="space-y-2">
                                <label class="block text-sm font-bold text-gray-700">Pekerjaan Orang Tua <span class="text-red-500">*</span></label>
                                <input type="text" name="pekerjaan" value="{{ old('pekerjaan') }}" class="w-full px-4 py-3 rounded-xl border-gray-200 focus:border-primary focus:ring focus:ring-primary/20 transition shadow-sm placeholder-gray-400 bg-gray-50 focus:bg-white" required>
                            </div>
                            <div class="space-y-2">
                                <label class="block text-sm font-bold text-gray-700">No. WhatsApp Orang Tua <span class="text-red-500">*</span></label>
                                <input type="text" name="no_wa_ortu" value="{{ old('no_wa_ortu') }}" class="w-full px-4 py-3 rounded-xl border-gray-200 focus:border-primary focus:ring focus:ring-primary/20 transition shadow-sm placeholder-gray-400 bg-gray-50 focus:bg-white" placeholder="0812xxxxxxxx" required>
                                <p class="text-xs text-gray-500 mt-1">*Informasi kelulusan & wawancara akan dikirim ke nomor ini.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Step 3: Jurusan -->
                    <div x-show="step === 3" x-cloak x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform translate-x-4" x-transition:enter-end="opacity-100 transform translate-x-0">
                         <div class="flex items-center gap-3 mb-8">
                            <span class="w-8 h-8 rounded-lg bg-primary/10 text-primary flex items-center justify-center font-bold">3</span>
                            <h2 class="text-2xl font-bold text-gray-900 font-heading">Pilih Jurusan</h2>
                        </div>

                         <div class="space-y-6">
                            <label class="block text-sm font-bold text-gray-700">Pilihan Jurusan Utama <span class="text-red-500">*</span></label>
                            <div class="grid md:grid-cols-2 gap-4">
                                @foreach($jurusan as $j)
                                @php
                                    $colors = ['TKJ' => 'green', 'MPLB' => 'blue', 'AKL' => 'orange', 'BDP' => 'purple'];
                                    $color = $colors[$j->kode] ?? 'gray';
                                @endphp
                                <label class="cursor-pointer border-2 border-transparent p-4 rounded-2xl bg-gray-50 hover:bg-white hover:border-{{ $color }}-200 hover:shadow-lg transition-all duration-300 relative group has-[:checked]:border-{{ $color }}-500 has-[:checked]:bg-{{ $color }}-50 has-[:checked]:shadow-md">
                                    <input type="radio" name="jurusan_id" value="{{ $j->id }}" class="peer sr-only" {{ old('jurusan_id') == $j->id ? 'checked' : '' }} required>
                                    <div class="flex items-center">
                                        <div class="w-12 h-12 bg-white rounded-xl flex items-center justify-center text-{{ $color }}-600 mr-4 shadow-sm border border-gray-100 peer-checked:bg-{{ $color }}-500 peer-checked:text-white transition group-hover:scale-110">
                                            <span class="font-bold text-sm">{{ $j->kode }}</span>
                                        </div>
                                        <div>
                                            <p class="font-bold text-gray-900 text-lg">{{ $j->nama }}</p>
                                            <p class="text-xs text-gray-500 font-medium bg-white px-2 py-0.5 rounded-full inline-block shadow-sm mt-1 border border-gray-100">Kode: {{ $j->kode }}</p>
                                        </div>
                                    </div>
                                    <div class="absolute top-4 right-4 text-{{ $color }}-500 opacity-0 peer-checked:opacity-100 transition-opacity transform scale-0 peer-checked:scale-100">
                                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                                    </div>
                                </label>
                                @endforeach
                            </div>
                         </div>
                         <div class="mt-8 space-y-2">
                            <label class="block text-sm font-bold text-gray-700">Gelombang Pendaftaran <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <select name="gelombang" class="w-full px-4 py-3 rounded-xl border-gray-200 focus:border-primary focus:ring focus:ring-primary/20 transition shadow-sm bg-gray-50 focus:bg-white appearance-none" required>
                                    <option value="Gelombang 1" {{ old('gelombang') == 'Gelombang 1' ? 'selected' : '' }}>Gelombang 1 (Januari - Maret)</option>
                                    <option value="Gelombang 2" {{ old('gelombang') == 'Gelombang 2' ? 'selected' : '' }}>Gelombang 2 (April - Juni)</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none text-gray-500">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Step 4: Dokumen -->
                    <div x-show="step === 4" x-cloak x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform translate-x-4" x-transition:enter-end="opacity-100 transform translate-x-0">
                         <div class="flex items-center gap-3 mb-8">
                            <span class="w-8 h-8 rounded-lg bg-primary/10 text-primary flex items-center justify-center font-bold">4</span>
                            <h2 class="text-2xl font-bold text-gray-900 font-heading">Upload Dokumen</h2>
                        </div>

                         <div class="bg-yellow-50 border border-yellow-100 rounded-2xl p-6 mb-8 flex gap-4">
                            <svg class="w-6 h-6 text-yellow-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <p class="text-yellow-800 text-sm leading-relaxed">
                                <strong>Info Penting:</strong> <br>
                                Dokumen persyaratan dapat diunggah setelah Anda menyelesaikan proses pendaftaran ini. Anda akan diarahkan ke halaman profil siswa untuk melengkapi berkas.
                            </p>
                         </div>

                         <div class="space-y-6">
                            <div class="border-3 border-dashed border-gray-200 rounded-3xl p-12 text-center bg-gray-50 hover:bg-gray-100 transition duration-300 group cursor-not-allowed">
                                <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center mx-auto mb-4 shadow-sm group-hover:scale-110 transition">
                                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                                </div>
                                <h4 class="font-bold text-gray-900 mb-1">Area Upload Dokumen</h4>
                                <p class="text-sm font-medium text-gray-500">Akan aktif setelah pendaftaran berhasil</p>
                            </div>
                         </div>
                    </div>

                    <!-- Step 5: Review -->
                    <div x-show="step === 5" x-cloak x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform translate-x-4" x-transition:enter-end="opacity-100 transform translate-x-0">
                         <div class="flex items-center gap-3 mb-8">
                            <span class="w-8 h-8 rounded-lg bg-primary/10 text-primary flex items-center justify-center font-bold">5</span>
                            <h2 class="text-2xl font-bold text-gray-900 font-heading">Konfirmasi Akhir</h2>
                        </div>

                         <div class="bg-primary/5 border border-primary/10 rounded-2xl p-6 mb-8">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-6 w-6 text-primary" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                                </div>
                                <div class="ml-4">
                                    <h3 class="font-bold text-primary text-lg mb-1">Hampir Selesai!</h3>
                                    <p class="text-sm text-gray-600 leading-relaxed">
                                        Silakan periksa kembali seluruh data yang telah Anda isi. Pastikan nomor WhatsApp aktif untuk menerima informasi selanjutnya. Data dapat diperbarui melalui halaman profil siswa nantinya.
                                    </p>
                                </div>
                            </div>
                        </div>

                          <div class="mt-8">
                            <label class="flex items-start gap-3 p-4 border border-gray-200 rounded-xl hover:bg-gray-50 cursor-pointer transition">
                                <input type="checkbox" class="mt-1 w-5 h-5 rounded border-gray-300 text-primary focus:ring-primary transition" required>
                                <span class="text-sm text-gray-600 leading-relaxed font-medium">Saya menyatakan dengan sadar bahwa seluruh data yang saya isikan adalah benar, akurat, dan dapat dipertanggungjawabkan keasliannya.</span>
                            </label>
                        </div>
                    </div>

                    <!-- Navigation Buttons -->
                    <div class="flex justify-between mt-12 pt-8 border-t border-gray-100">
                        <button type="button" x-show="step > 1" @click="step--" class="px-8 py-3 bg-white border border-gray-200 rounded-xl text-gray-700 font-bold hover:bg-gray-50 hover:border-gray-300 transition flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                            Kembali
                        </button>
                        <div class="flex-1"></div> <!-- Spacer -->
                        <button type="button" x-show="step < 5" @click="step++" class="px-8 py-3 bg-primary text-white rounded-xl font-bold hover:bg-green-700 transition shadow-lg hover:shadow-xl flex items-center gap-2">
                            Selanjutnya
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        </button>
                         <button type="submit" x-show="step === 5" class="px-10 py-3 bg-accent text-gray-900 rounded-xl font-bold hover:bg-yellow-300 transition shadow-lg transform hover:-translate-y-1 hover:shadow-xl flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            Kirim Pendaftaran
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
