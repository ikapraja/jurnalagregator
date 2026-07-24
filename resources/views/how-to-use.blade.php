<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="referrer" content="no-referrer">
    <title>Cara Menggunakan - Agregator Jurnal Perpustakaan PKTJ</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #F8FAFC; }
    </style>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('logodashboard.png') }}">
</head>
<body class="text-slate-800 min-h-screen flex flex-col antialiased">

    <!-- Top Bar Kuning -->
    <div class="bg-[#FBBF24] text-[#1E3A8A] py-2 px-4 sm:px-6 lg:px-8 text-xs font-bold flex justify-center sm:justify-start items-center shadow-sm relative z-50">
        <div class="max-w-7xl mx-auto w-full flex flex-col sm:flex-row gap-2 sm:gap-6 items-center">
            <span class="flex items-center gap-1.5">
                <svg class="w-4 h-4 text-[#1E3A8A]" fill="currentColor" viewBox="0 0 24 24"><path d="M20 4H4c-1.103 0-2 .897-2 2v12c0 1.103.897 2 2 2h16c1.103 0 2-.897 2-2V6c0-1.103-.897-2-2-2zm0 2v2H4V6h16zM9.5 10a2.5 2.5 0 1 1 0 5 2.5 2.5 0 0 1 0-5zM5 18c0-1.332 2.658-2 4.5-2s4.5.668 4.5 2H5zm9-1h5v-1h-5v1zm0-3h5v-1h-5v1zm0-3h5v-1h-5v1z"></path></svg>
                NPP 3376022C0000001
            </span>
            <span class="flex items-center gap-1.5">
                <svg class="w-4 h-4 text-[#1E3A8A]" fill="currentColor" viewBox="0 0 24 24"><path d="M6 14.5l-1.5 8 3.5-2 3-2.5-1-6.5z"/><path d="M18 14.5l1.5 8-3.5-2-3-2.5 1-6.5z"/><path fill-rule="evenodd" clip-rule="evenodd" d="M12 2a7.5 7.5 0 100 15 7.5 7.5 0 000-15zm0 10.5a3 3 0 110-6 3 3 0 010 6z"/></svg>
                Akreditasi A
            </span>
        </div>
    </div>

    <!-- Header / Navbar -->
    <header class="bg-white/80 backdrop-blur-md border-b border-slate-200 sticky top-0 z-40 shadow-sm" x-data="{ mobileMenuOpen: false }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3 flex items-center justify-between">
            <a href="{{ route('search.index') }}" class="flex items-center gap-3 group">
                <img src="{{ asset('logo.png') }}" alt="Logo PKTJ" class="h-10 sm:h-12 w-auto object-contain transition-transform group-hover:scale-105" onerror="this.outerHTML='<div class=\'w-10 h-10 bg-[#1E3A8A] rounded-xl flex items-center justify-center text-white font-bold text-xl shadow-inner\'>P</div>'">
                <div class="flex flex-col ml-1">
                    <h1 class="text-lg sm:text-xl font-extrabold text-[#1E3A8A] tracking-tight leading-tight uppercase">AGREGATOR JURNAL</h1>
                    <span class="text-[0.6rem] sm:text-[0.65rem] text-slate-500 font-bold tracking-wider uppercase mt-0.5">Perpustakaan Politeknik Keselamatan Transportasi Jalan</span>
                </div>
            </a>
            
            <!-- Desktop Nav -->
            <nav class="hidden md:flex items-center gap-1 bg-slate-100/50 p-1 rounded-xl border border-slate-200/50">
                <a href="{{ route('search.index') }}" class="px-4 py-2 text-sm font-semibold text-slate-600 rounded-lg hover:text-[#1E3A8A] hover:bg-white hover:shadow-sm transition">Beranda</a>
                <a href="{{ route('how-to-use') }}" class="px-4 py-2 text-sm font-bold text-[#1E3A8A] bg-white rounded-lg shadow-sm border border-slate-200/60 transition">Cara Menggunakan</a>
                <a href="{{ route('faq') }}" class="px-4 py-2 text-sm font-semibold text-slate-600 rounded-lg hover:text-[#1E3A8A] hover:bg-white hover:shadow-sm transition">FAQ</a>
                <a href="{{ route('about') }}" class="px-4 py-2 text-sm font-semibold text-slate-600 rounded-lg hover:text-[#1E3A8A] hover:bg-white hover:shadow-sm transition">Tentang</a>
            </nav>

            <!-- Mobile Menu Button -->
            <button @click="mobileMenuOpen = !mobileMenuOpen" class="md:hidden p-2 rounded-lg bg-slate-100 text-slate-600 hover:bg-slate-200 transition">
                <svg x-show="!mobileMenuOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                <svg x-show="mobileMenuOpen" style="display: none;" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>

        <!-- Mobile Nav -->
        <div x-show="mobileMenuOpen" style="display: none;" x-transition class="md:hidden absolute top-full left-0 w-full bg-white border-b border-slate-200 shadow-lg py-4 px-4 flex flex-col gap-2 z-50">
            <a href="{{ route('search.index') }}" class="px-4 py-3 text-sm font-semibold text-slate-600 rounded-lg hover:bg-slate-50 hover:text-[#1E3A8A] transition">Beranda</a>
            <a href="{{ route('how-to-use') }}" class="px-4 py-3 text-sm font-bold text-[#1E3A8A] bg-blue-50 rounded-lg transition">Cara Menggunakan</a>
            <a href="{{ route('faq') }}" class="px-4 py-3 text-sm font-semibold text-slate-600 rounded-lg hover:bg-slate-50 hover:text-[#1E3A8A] transition">FAQ</a>
            <a href="{{ route('about') }}" class="px-4 py-3 text-sm font-semibold text-slate-600 rounded-lg hover:bg-slate-50 hover:text-[#1E3A8A] transition">Tentang</a>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow w-full">
        <!-- Hero Section -->
        <div class="relative bg-[#1E3A8A] overflow-hidden text-white">
            <div class="absolute inset-0 bg-[radial-gradient(#ffffff_1px,transparent_1px)] [background-size:24px_24px] opacity-10"></div>
            
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 pt-16 pb-24 text-center relative z-10">
                <h1 class="text-3xl md:text-5xl font-extrabold mb-4 tracking-tight">Cara Menggunakan Agregator Jurnal</h1>
                <p class="text-lg text-blue-200 font-light max-w-2xl mx-auto">
                    Panduan praktis langkah demi langkah untuk menemukan referensi ilmiah yang Anda butuhkan dengan cepat dan mudah.
                </p>
            </div>
        </div>

        <!-- Alur Singkat (Process Flow) -->
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 -mt-12 relative z-20">
            <div class="bg-white rounded-2xl shadow-md border border-slate-200 p-6 flex flex-col md:flex-row items-center justify-between gap-4 overflow-x-auto">
                
                <div class="flex flex-col items-center gap-2 min-w-[120px]">
                    <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-full flex items-center justify-center border-2 border-blue-100 shadow-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                    <span class="text-xs font-bold text-slate-700 text-center">Cari Kata Kunci</span>
                </div>
                
                <div class="text-slate-300 hidden md:block"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg></div>
                <div class="text-slate-300 md:hidden"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path></svg></div>

                <div class="flex flex-col items-center gap-2 min-w-[120px]">
                    <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-full flex items-center justify-center border-2 border-blue-100 shadow-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5M7.188 2.239l.777 2.897M5.136 7.965l-2.898-.777M13.95 4.05l-2.122 2.122m-5.657 5.656l-2.12 2.122"></path></svg>
                    </div>
                    <span class="text-xs font-bold text-slate-700 text-center">Klik Cari</span>
                </div>
                
                <div class="text-slate-300 hidden md:block"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg></div>
                <div class="text-slate-300 md:hidden"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path></svg></div>

                <div class="flex flex-col items-center gap-2 min-w-[120px]">
                    <div class="w-12 h-12 bg-emerald-50 text-emerald-600 rounded-full flex items-center justify-center border-2 border-emerald-100 shadow-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path></svg>
                    </div>
                    <span class="text-xs font-bold text-slate-700 text-center">Gunakan Filter<br><span class="font-normal text-slate-500">(Opsional)</span></span>
                </div>
                
                <div class="text-slate-300 hidden md:block"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg></div>
                <div class="text-slate-300 md:hidden"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path></svg></div>

                <div class="flex flex-col items-center gap-2 min-w-[120px]">
                    <div class="w-12 h-12 bg-purple-50 text-purple-600 rounded-full flex items-center justify-center border-2 border-purple-100 shadow-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    </div>
                    <span class="text-xs font-bold text-slate-700 text-center">Pilih Artikel</span>
                </div>
                
                <div class="text-slate-300 hidden md:block"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg></div>
                <div class="text-slate-300 md:hidden"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path></svg></div>

                <div class="flex flex-col items-center gap-2 min-w-[120px]">
                    <div class="w-12 h-12 bg-amber-50 text-amber-600 rounded-full flex items-center justify-center border-2 border-amber-100 shadow-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                    </div>
                    <span class="text-xs font-bold text-slate-700 text-center">Buka Sumber Asli</span>
                </div>
            </div>
        </div>

        <!-- Guide Steps -->
        <div class="py-12">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-16">
                
                <!-- Step 1 -->
                <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8 flex flex-col md:flex-row gap-8 items-start relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-48 h-48 bg-blue-50 rounded-bl-full -z-0 opacity-50"></div>
                    <div class="flex-shrink-0 w-16 h-16 bg-[#1E3A8A] text-white rounded-2xl flex items-center justify-center text-3xl font-extrabold shadow-lg z-10">
                        1
                    </div>
                    <div class="z-10 flex-1">
                        <h3 class="text-2xl font-bold text-slate-900 mb-3">Cari Jurnal</h3>
                        <p class="text-slate-600 leading-relaxed mb-6 text-justify">
                            Masukkan kata kunci, topik, judul, atau nama penulis yang Anda butuhkan pada kolom pencarian di halaman utama, lalu tekan Enter atau klik tombol Cari. Sistem akan langsung mencari ke berbagai sumber pangkalan data di seluruh dunia.
                        </p>
                        
                        <!-- UI Mockup -->
                        <div class="bg-slate-50 border border-slate-200 rounded-xl p-4 shadow-sm w-full md:w-5/6 mx-auto md:mx-0">
                            <div class="bg-white p-2 rounded-2xl shadow-sm border border-slate-100 flex flex-col md:flex-row items-center gap-2 relative z-10">
                                <div class="flex-1 w-full flex items-center relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                        </svg>
                                    </div>
                                    <div class="w-full pl-10 pr-3 py-3 bg-transparent text-slate-400 font-medium text-sm">Cari topik, judul, penulis, atau DOI...</div>
                                </div>
                                <div class="flex gap-2 w-full md:w-auto">
                                    <div class="px-4 py-3 rounded-xl bg-slate-50 border border-slate-200 text-slate-600 flex items-center justify-center flex-1 md:flex-none">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path></svg>
                                    </div>
                                    <div class="px-6 py-3 rounded-xl bg-[#FBBF24] text-[#1E3A8A] font-extrabold shadow-sm flex items-center justify-center gap-2 whitespace-nowrap flex-1 md:flex-none text-sm">
                                        Cari Jurnal
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Step 2 -->
                <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8 flex flex-col md:flex-row gap-8 items-start relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-48 h-48 bg-emerald-50 rounded-bl-full -z-0 opacity-50"></div>
                    <div class="flex-shrink-0 w-16 h-16 bg-emerald-600 text-white rounded-2xl flex items-center justify-center text-3xl font-extrabold shadow-lg z-10">
                        2
                    </div>
                    <div class="z-10 flex-1">
                        <h3 class="text-2xl font-bold text-slate-900 mb-3">Saring Hasil Pencarian</h3>
                        <p class="text-slate-600 leading-relaxed mb-6 text-justify">
                            Jika hasil yang muncul terlalu banyak, Anda bisa menggunakan menu Filter lanjutan dengan mengklik ikon filter di sebelah tombol cari. Anda bisa membatasi rentang <strong>Tahun Terbit</strong> untuk mencari jurnal terbaru, atau memilih <strong>Bahasa</strong> tertentu.
                        </p>
                        
                        <!-- UI Mockup -->
                        <div class="bg-white border border-slate-200 rounded-2xl p-4 shadow-sm text-center mx-auto md:mx-0 w-full relative z-10">
                            <div class="grid grid-cols-1 md:grid-cols-5 gap-3 items-end">
                                <div>
                                    <label class="block text-[10px] font-bold text-slate-500 mb-1.5 uppercase tracking-wide">Tahun Dari</label>
                                    <div class="w-full text-center bg-[#F8FAFC] border border-slate-200 text-slate-400 py-2 px-2 rounded-lg text-xs">Contoh: {{ date('Y') - 5 }}</div>
                                </div>
                                <div>
                                    <label class="block text-[10px] font-bold text-slate-500 mb-1.5 uppercase tracking-wide">Tahun Sampai</label>
                                    <div class="w-full text-center bg-[#F8FAFC] border border-slate-200 text-slate-400 py-2 px-2 rounded-lg text-xs">Contoh: {{ date('Y') }}</div>
                                </div>
                                <div>
                                    <label class="block text-[10px] font-bold text-slate-500 mb-1.5 uppercase tracking-wide">Bahasa</label>
                                    <div class="w-full text-center bg-[#F8FAFC] border border-slate-200 text-slate-800 py-2 px-2 rounded-lg text-xs flex justify-between items-center">
                                        <span>Semua</span>
                                        <svg class="w-3 h-3 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-[10px] font-bold text-slate-500 mb-1.5 uppercase tracking-wide">Urutkan</label>
                                    <div class="w-full text-center bg-[#F8FAFC] border border-slate-200 text-slate-800 py-2 px-2 rounded-lg text-xs flex justify-between items-center">
                                        <span>Relevansi</span>
                                        <svg class="w-3 h-3 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                    </div>
                                </div>
                                <div>
                                    <div class="w-full bg-[#1E3A8A] text-white font-bold py-2 px-2 rounded-lg shadow-sm text-xs cursor-pointer">Terapkan</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Step 3 -->
                <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8 flex flex-col md:flex-row gap-8 items-start relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-48 h-48 bg-purple-50 rounded-bl-full -z-0 opacity-50"></div>
                    <div class="flex-shrink-0 w-16 h-16 bg-purple-600 text-white rounded-2xl flex items-center justify-center text-3xl font-extrabold shadow-lg z-10">
                        3
                    </div>
                    <div class="z-10 flex-1">
                        <h3 class="text-2xl font-bold text-slate-900 mb-3">Buka Detail Artikel</h3>
                        <p class="text-slate-600 leading-relaxed mb-6 text-justify">
                            Klik tombol "Detail" pada jurnal yang menarik perhatian Anda. Anda akan dibawa ke halaman yang berisi informasi lengkap mengenai abstrak, nama penulis, dan yang paling penting: <strong>Daftar Pustaka Otomatis</strong> yang bisa langsung Anda salin (copy) ke laporan Anda.
                        </p>
                        
                        <!-- UI Mockup -->
                        <div class="bg-slate-50 border border-slate-200 rounded-xl p-4 shadow-sm w-full mx-auto md:mx-0">
                            <div class="bg-white rounded-lg border border-slate-200 p-4">
                                <div class="h-4 bg-slate-200 rounded w-3/4 mb-2"></div>
                                <div class="h-3 bg-slate-100 rounded w-1/4 mb-6"></div>
                                
                                <div class="flex justify-between items-center border-t border-slate-100 pt-4">
                                    <div class="text-xs font-bold text-slate-700">Format Sitasi (APA)</div>
                                    <div class="flex items-center gap-1.5 bg-slate-100 text-slate-600 px-3 py-1.5 rounded-lg text-xs font-semibold">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3"></path></svg>
                                        Salin
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- Tips & Notes Section -->
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 pb-16 space-y-8">
            
            <!-- Tips -->
            <div class="bg-amber-50 rounded-2xl border border-amber-200 p-6 sm:p-8">
                <h3 class="text-lg font-bold text-amber-900 mb-4 flex items-center gap-2">
                    <svg class="w-6 h-6 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path></svg>
                    Tips Pencarian
                </h3>
                <ul class="space-y-3">
                    <li class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-amber-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        <span class="text-amber-900 text-sm md:text-base text-justify block">Gunakan <strong>kata kunci yang spesifik</strong> (contoh: "keselamatan transportasi jalan" daripada hanya "transportasi").</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-amber-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        <span class="text-amber-900 text-sm md:text-base text-justify block"><strong>Gunakan Bahasa Inggris</strong> untuk mendapatkan hasil jurnal berskala internasional yang jauh lebih banyak dan akurat.</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-amber-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        <span class="text-amber-900 text-sm md:text-base text-justify block">Jika Anda mencari dokumen tertentu, <strong>gunakan kode DOI</strong> (jika tersedia) langsung di kotak pencarian.</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-amber-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        <span class="text-amber-900 text-sm md:text-base text-justify block">Jika hasil kurang memuaskan, <strong>coba beberapa variasi kata kunci</strong> atau sinonim dari topik yang Anda cari.</span>
                    </li>
                </ul>
            </div>

            <!-- Notes -->
            <div class="bg-slate-100 rounded-2xl border border-slate-200 p-6 sm:p-8 flex items-start gap-4">
                <div class="w-10 h-10 rounded-full bg-slate-200 flex-shrink-0 flex items-center justify-center text-slate-500">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <div>
                    <h4 class="text-sm font-bold text-slate-900 uppercase tracking-wider mb-2">Catatan Penting</h4>
                    <p class="text-sm text-slate-600 leading-relaxed text-justify">
                        Sistem Agregator Jurnal Perpustakaan PKTJ ini tidak menyimpan <i>file</i> dokumen artikel (seperti PDF) di dalam <i>server</i> kami sendiri. Saat Anda mengklik "Kunjungi Sumber" atau "Buka DOI", Anda akan secara otomatis diarahkan (<i>redirect</i>) ke situs penerbit aslinya untuk mengunduh dokumen secara langsung dari sumber yang sah.
                    </p>
                </div>
            </div>

        </div>
    </main>

                            <!-- Footer -->
    <footer class="relative bg-[#1E3A8A] pt-16 mt-auto text-white overflow-hidden font-sans border-t border-blue-900">
        <!-- Radial Dot Background -->
        <div class="absolute inset-0 bg-[radial-gradient(#ffffff_1px,transparent_1px)] [background-size:24px_24px] opacity-10"></div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <!-- Grid 12 Kolom -->
            <div class="grid grid-cols-1 md:grid-cols-12 gap-10 lg:gap-8 mb-4">
                
                <!-- Column 1: Brand & Desc -->
                <div class="flex flex-col gap-5 md:col-span-12 lg:col-span-4 lg:pr-6">
                    <div class="flex items-center gap-3">
                        <img src="{{ asset('logo.png') }}" alt="Logo PKTJ" class="h-12 w-auto object-contain" onerror="this.outerHTML='<div class=\'w-10 h-10 bg-transparent border border-white/30 rounded-full flex items-center justify-center text-white font-bold text-xl\'>P</div>'">
                        <div class="flex flex-col">
                            <h2 class="text-lg font-extrabold text-white tracking-tight leading-tight">PERPUSTAKAAN PKTJ</h2>
                        </div>
                    </div>
                    <p class="text-[14px] font-medium text-blue-100/80 leading-relaxed text-justify mt-2">
                        Agregator Jurnal Perpustakaan PKTJ membantu mahasiswa, dosen, peneliti, dan masyarakat menemukan referensi ilmiah dari berbagai database akademik terpercaya melalui satu pencarian.
                    </p>
                </div>

                <!-- Column 2: Navigasi -->
                <div class="flex flex-col gap-6 md:col-span-4 lg:col-span-2 lg:justify-self-center">
                    <div class="flex flex-col gap-2">
                        <h3 class="text-base font-bold text-white tracking-wide uppercase">Navigasi</h3>
                        <div class="w-8 h-0.5 bg-[#FBBF24]"></div>
                    </div>
                    <ul class="flex flex-col gap-4">
                        <li>
                            <a href="{{ route('search.index') }}" class="flex items-center gap-2 text-[14px] text-blue-100/80 hover:text-[#FBBF24] transition-colors group font-medium">
                                <svg class="w-3.5 h-3.5 text-[#FBBF24] group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"></path></svg>
                                Beranda
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('how-to-use') }}" class="flex items-center gap-2 text-[14px] text-blue-100/80 hover:text-[#FBBF24] transition-colors group font-medium">
                                <svg class="w-3.5 h-3.5 text-[#FBBF24] group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"></path></svg>
                                Cara Menggunakan
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('faq') }}" class="flex items-center gap-2 text-[14px] text-blue-100/80 hover:text-[#FBBF24] transition-colors group font-medium">
                                <svg class="w-3.5 h-3.5 text-[#FBBF24] group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"></path></svg>
                                FAQ
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('about') }}" class="flex items-center gap-2 text-[14px] text-blue-100/80 hover:text-[#FBBF24] transition-colors group font-medium">
                                <svg class="w-3.5 h-3.5 text-[#FBBF24] group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"></path></svg>
                                Tentang
                            </a>
                        </li>
                    </ul>
                </div>
                
                <!-- Column 3: Pusat Informasi -->
                <div class="flex flex-col gap-6 md:col-span-4 lg:col-span-3 lg:pl-6">
                    <div class="flex flex-col gap-2">
                        <h3 class="text-base font-bold text-white tracking-wide uppercase">Pusat Informasi</h3>
                        <div class="w-8 h-0.5 bg-[#FBBF24]"></div>
                    </div>
                    <ul class="flex flex-col gap-4">
                        <li>
                            <a href="https://library.pktj.ac.id/" target="_blank" rel="noopener noreferrer" class="flex items-center gap-2 text-[14px] text-blue-100/80 hover:text-[#FBBF24] transition-colors group font-medium">
                                <svg class="w-3.5 h-3.5 text-[#FBBF24] group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"></path></svg>
                                Website Utama
                            </a>
                        </li>
                        <li>
                            <a href="http://eprints.pktj.ac.id/" target="_blank" rel="noopener noreferrer" class="flex items-center gap-2 text-[14px] text-blue-100/80 hover:text-[#FBBF24] transition-colors group font-medium">
                                <svg class="w-3.5 h-3.5 text-[#FBBF24] group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"></path></svg>
                                Repositori Institusi
                            </a>
                        </li>
                        <li>
                            <a href="https://opac.pktj.ac.id/" target="_blank" rel="noopener noreferrer" class="flex items-center gap-2 text-[14px] text-blue-100/80 hover:text-[#FBBF24] transition-colors group font-medium">
                                <svg class="w-3.5 h-3.5 text-[#FBBF24] group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"></path></svg>
                                Katalog Buku (OPAC)
                            </a>
                        </li>
                    </ul>
                </div>
                
                <!-- Column 4: Hubungi Kami -->
                <div class="flex flex-col gap-6 md:col-span-4 lg:col-span-3">
                    <div class="flex flex-col gap-2">
                        <h3 class="text-base font-bold text-white tracking-wide uppercase">Hubungi Kami</h3>
                        <div class="w-8 h-0.5 bg-[#FBBF24]"></div>
                    </div>
                    <ul class="flex flex-col gap-4">
                        <li class="flex items-start gap-3 text-[14px] text-blue-100/80 font-medium">
                            <svg class="w-5 h-5 text-[#FBBF24] shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.243-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            <div class="flex flex-col pb-3 border-b border-dotted border-blue-400/30 w-full">
                                <span class="font-bold text-white">Perpustakaan Margadana:</span>
                                <span>Jl. Abdul Syukur No. 17, Kota Tegal</span>
                            </div>
                        </li>
                        <li class="flex items-start gap-3 text-[14px] text-blue-100/80 font-medium">
                            <svg class="w-5 h-5 text-[#FBBF24] shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.243-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            <div class="flex flex-col pb-3 border-b border-dotted border-blue-400/30 w-full">
                                <span class="font-bold text-white">Perpustakaan Perintis:</span>
                                <span>Jl. Perintis Kemerdekaan No. 17, Kota Tegal</span>
                            </div>
                        </li>
                        <li class="flex items-center gap-3 text-[14px] text-blue-100/80 font-medium">
                            <svg class="w-5 h-5 text-[#FBBF24] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            library@pktj.ac.id
                        </li>
                        <li class="flex items-center gap-3 text-[14px] text-blue-100/80 font-medium">
                            <svg class="w-5 h-5 text-[#FBBF24] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                            (0283) 351061
                        </li>
                    </ul>
                </div>
                
            </div>
        </div>
        
        <!-- Bottom Bar Full Width Darker Blue -->
        <div class="bg-[#172554] py-5 mt-8 relative z-10 border-t border-blue-900/50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row items-center justify-between gap-4">
                <p class="text-[13px] font-medium text-blue-200/60 text-center md:text-left">
                    &copy; {{ date('Y') }} Perpustakaan Politeknik Keselamatan Transportasi Jalan.<br class="block md:hidden"> Seluruh Hak Cipta Dilindungi.
                </p>
                <div class="flex gap-6 text-[13px] font-medium text-blue-200/60">
                    <a href="#" class="hover:text-[#FBBF24] transition-colors">Privacy Policy</a>
                    <a href="#" class="hover:text-[#FBBF24] transition-colors">Terms of Service</a>
                </div>
            </div>
        </div>
    </footer>

</body>
</html>
