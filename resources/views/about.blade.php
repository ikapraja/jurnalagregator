<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="referrer" content="no-referrer">
    <title>Tentang - Agregator Perpustakaan PKTJ</title>
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
                <a href="{{ route('how-to-use') }}" class="px-4 py-2 text-sm font-semibold text-slate-600 rounded-lg hover:text-[#1E3A8A] hover:bg-white hover:shadow-sm transition">Cara Menggunakan</a>
                <a href="{{ route('faq') }}" class="px-4 py-2 text-sm font-semibold text-slate-600 rounded-lg hover:text-[#1E3A8A] hover:bg-white hover:shadow-sm transition">FAQ</a>
                <a href="{{ route('about') }}" class="px-4 py-2 text-sm font-bold text-[#1E3A8A] bg-white rounded-lg shadow-sm border border-slate-200/60 transition">Tentang</a>
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
            <a href="{{ route('how-to-use') }}" class="px-4 py-3 text-sm font-semibold text-slate-600 rounded-lg hover:bg-slate-50 hover:text-[#1E3A8A] transition">Cara Menggunakan</a>
            <a href="{{ route('faq') }}" class="px-4 py-3 text-sm font-semibold text-slate-600 rounded-lg hover:bg-slate-50 hover:text-[#1E3A8A] transition">FAQ</a>
            <a href="{{ route('about') }}" class="px-4 py-3 text-sm font-bold text-[#1E3A8A] bg-blue-50 rounded-lg transition">Tentang</a>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow w-full">
        
        <!-- Hero Section -->
        <div class="relative bg-[#1E3A8A] overflow-hidden text-white">
            <div class="absolute inset-0 bg-[radial-gradient(#ffffff_1px,transparent_1px)] [background-size:24px_24px] opacity-10"></div>
            
            <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-16 text-center relative z-10">
                <h1 class="text-3xl md:text-5xl font-extrabold mb-6 tracking-tight leading-tight">Apa itu Agregator Jurnal<br class="hidden md:block"> Perpustakaan PKTJ?</h1>
                <p class="text-lg md:text-xl text-blue-100 leading-relaxed font-light max-w-4xl mx-auto text-justify">
                    Agregator Jurnal Perpustakaan PKTJ merupakan layanan pencarian referensi ilmiah yang dikembangkan oleh Perpustakaan Politeknik Keselamatan Transportasi Jalan (PKTJ). Platform ini membantu mahasiswa, dosen, peneliti, dan masyarakat menemukan artikel ilmiah dari berbagai database akademik melalui satu kali pencarian.
                </p>
            </div>
        </div>

        <!-- SECTION 1: Mengapa Dibuat -->
        <div class="py-16 bg-white border-b border-slate-200">
            <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-3xl md:text-4xl font-extrabold text-slate-900 mb-6 tracking-tight">Mengapa Agregator Jurnal Perpustakaan PKTJ Dibuat?</h2>
                    <p class="text-slate-600 max-w-3xl mx-auto text-lg leading-relaxed text-justify">
                        Sebelum adanya Agregator Jurnal Perpustakaan PKTJ, pengguna harus membuka berbagai database akademik secara terpisah untuk menemukan referensi ilmiah.<br><br>
                        Agregator Jurnal Perpustakaan PKTJ menyederhanakan proses tersebut dengan menghubungkan berbagai sumber informasi ilmiah ke dalam satu platform pencarian yang terpusat.
                    </p>
                </div>
                
                <!-- Comparison Diagram -->
                <div class="flex flex-col md:flex-row items-center justify-center gap-6 md:gap-10 mt-8">
                    
                    <!-- Sebelum -->
                    <div class="bg-slate-50 border border-slate-200 rounded-3xl p-8 w-full md:w-80 text-center shadow-sm relative overflow-hidden group hover:border-slate-300 transition-all">
                        <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center mx-auto mb-5 shadow-sm text-slate-400 border border-slate-200">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <h3 class="font-extrabold text-slate-400 mb-3 uppercase tracking-widest text-xs">Sebelum</h3>
                        <p class="font-semibold text-slate-700 text-lg">Banyak website<br>Banyak pencarian</p>
                    </div>
                    
                    <!-- Arrow -->
                    <div class="text-slate-300 transform md:-rotate-90">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path></svg>
                    </div>

                    <!-- Sesudah -->
                    <div class="bg-gradient-to-b from-blue-50 to-white border border-blue-200 rounded-3xl p-8 w-full md:w-80 text-center shadow-md shadow-blue-900/5 ring-1 ring-blue-500/10 relative overflow-hidden group hover:shadow-lg hover:shadow-blue-900/10 transition-all">
                        <div class="absolute inset-0 bg-blue-500 opacity-0 group-hover:opacity-5 transition-opacity"></div>
                        <div class="w-16 h-16 bg-blue-600 rounded-full flex items-center justify-center mx-auto mb-5 shadow-md shadow-blue-600/30 text-white relative z-10">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                        <h3 class="font-extrabold text-blue-600 mb-3 uppercase tracking-widest text-xs relative z-10">Sesudah</h3>
                        <p class="font-bold text-slate-900 text-lg relative z-10">Satu platform<br>Satu pencarian<br>Hasil lebih cepat</p>
                    </div>

                </div>
            </div>
        </div>

        <!-- SECTION 2: Bagaimana Cara Kerjanya? -->
        <div class="py-16 bg-[#F8FAFC] border-b border-slate-200 overflow-x-hidden">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-3xl md:text-4xl font-extrabold text-slate-900 mb-4 tracking-tight">Bagaimana Cara Kerjanya?</h2>
                    <p class="text-slate-600 max-w-2xl mx-auto text-lg">Alur kerja sistem Agregator Jurnal Perpustakaan PKTJ di belakang layar.</p>
                </div>
                
                <div class="bg-white rounded-2xl shadow-md border border-slate-200 p-6 flex flex-col md:flex-row items-center justify-between gap-4 overflow-x-auto max-w-5xl mx-auto">
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
        </div>

        <!-- SECTION 3: Mengapa Menggunakan -->
        <div class="py-16 bg-white border-b border-slate-200">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-3xl md:text-4xl font-extrabold text-slate-900 mb-4 tracking-tight">Mengapa Menggunakan Agregator Jurnal Perpustakaan PKTJ?</h2>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    
                    <!-- Card 1 -->
                    <div class="group bg-white border border-slate-200 rounded-2xl p-8 hover:shadow-xl hover:shadow-blue-900/5 hover:-translate-y-1 transition-all duration-300">
                        <div class="w-14 h-14 rounded-2xl bg-blue-50 flex items-center justify-center mb-6 text-blue-600 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </div>
                        <h3 class="text-lg font-bold text-slate-900 mb-3">Satu Kali Pencarian</h3>
                        <p class="text-slate-600 text-sm leading-relaxed">
                            Cari referensi ilmiah dari berbagai sumber melalui satu platform terpusat tanpa perlu berpindah-pindah.
                        </p>
                    </div>

                    <!-- Card 2 -->
                    <div class="group bg-white border border-slate-200 rounded-2xl p-8 hover:shadow-xl hover:shadow-blue-900/5 hover:-translate-y-1 transition-all duration-300">
                        <div class="w-14 h-14 rounded-2xl bg-emerald-50 flex items-center justify-center mb-6 text-emerald-600 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                        </div>
                        <h3 class="text-lg font-bold text-slate-900 mb-3">Pencarian Cepat</h3>
                        <p class="text-slate-600 text-sm leading-relaxed">
                            Hasil ditampilkan secara efisien dari berbagai database akademik global yang terhubung.
                        </p>
                    </div>

                    <!-- Card 3 -->
                    <div class="group bg-white border border-slate-200 rounded-2xl p-8 hover:shadow-xl hover:shadow-blue-900/5 hover:-translate-y-1 transition-all duration-300">
                        <div class="w-14 h-14 rounded-2xl bg-purple-50 flex items-center justify-center mb-6 text-purple-600 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                        </div>
                        <h3 class="text-lg font-bold text-slate-900 mb-3">Sumber Tepercaya</h3>
                        <p class="text-slate-600 text-sm leading-relaxed">
                            Hasil berasal dari database akademik terkemuka dan penerbit ilmiah global yang bereputasi tinggi.
                        </p>
                    </div>

                    <!-- Card 4 -->
                    <div class="group bg-white border border-slate-200 rounded-2xl p-8 hover:shadow-xl hover:shadow-blue-900/5 hover:-translate-y-1 transition-all duration-300">
                        <div class="w-14 h-14 rounded-2xl bg-amber-50 flex items-center justify-center mb-6 text-amber-600 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <h3 class="text-lg font-bold text-slate-900 mb-3">Gratis Digunakan</h3>
                        <p class="text-slate-600 text-sm leading-relaxed">
                            Platform dapat digunakan kapan saja tanpa dipungut biaya untuk melakukan pencarian referensi.
                        </p>
                    </div>

                </div>
            </div>
        </div>

        <!-- SECTION 4: Untuk Siapa -->
        <div class="py-16 bg-[#F8FAFC] border-b border-slate-200">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight">Untuk Siapa Platform Ini?</h2>
                </div>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div class="bg-white rounded-2xl border border-slate-200 p-6 flex flex-col items-center text-center shadow-sm">
                        <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mb-4 text-blue-700">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 14l9-5-9-5-9 5 9 5z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"></path></svg>
                        </div>
                        <h3 class="text-lg font-bold text-slate-900 mb-2">Mahasiswa</h3>
                        <p class="text-slate-500 text-sm">Mencari referensi untuk menunjang tugas akhir dan penelitian.</p>
                    </div>

                    <div class="bg-white rounded-2xl border border-slate-200 p-6 flex flex-col items-center text-center shadow-sm">
                        <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mb-4 text-blue-700">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                        </div>
                        <h3 class="text-lg font-bold text-slate-900 mb-2">Dosen</h3>
                        <p class="text-slate-500 text-sm">Mendukung kegiatan pembelajaran dan penyusunan publikasi.</p>
                    </div>

                    <div class="bg-white rounded-2xl border border-slate-200 p-6 flex flex-col items-center text-center shadow-sm">
                        <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mb-4 text-blue-700">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                        </div>
                        <h3 class="text-lg font-bold text-slate-900 mb-2">Peneliti</h3>
                        <p class="text-slate-500 text-sm">Menelusuri dan memantau artikel ilmiah terbaru dengan mudah.</p>
                    </div>

                    <div class="bg-white rounded-2xl border border-slate-200 p-6 flex flex-col items-center text-center shadow-sm">
                        <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mb-4 text-blue-700">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        </div>
                        <h3 class="text-lg font-bold text-slate-900 mb-2">Masyarakat Umum</h3>
                        <p class="text-slate-500 text-sm">Mengakses pengetahuan dan referensi ilmiah secara publik dan mudah.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- SECTION 5: Tentang Perpustakaan PKTJ -->
        <div class="py-16 bg-white">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <div class="flex items-center justify-center mx-auto mb-6">
                    <img src="{{ asset('logo.png') }}" alt="Logo PKTJ" class="h-16 md:h-20 w-auto object-contain" onerror="this.outerHTML='<div class=\'w-16 h-16 bg-[#1E3A8A] rounded-xl flex items-center justify-center text-white font-bold text-2xl shadow-inner\'>P</div>'">
                </div>
                <h2 class="text-3xl font-extrabold text-slate-900 mb-6 tracking-tight">Dikembangkan oleh Perpustakaan PKTJ</h2>
                <p class="text-slate-600 text-lg leading-relaxed mb-10 max-w-3xl mx-auto text-justify">
                    Agregator Jurnal Perpustakaan PKTJ dikembangkan sebagai bagian dari komitmen Perpustakaan Politeknik Keselamatan Transportasi Jalan dalam meningkatkan akses terhadap literatur ilmiah, mendukung kegiatan pendidikan, penelitian, dan pengabdian kepada masyarakat.
                </p>
                <a href="https://library.pktj.ac.id/" target="_blank" class="inline-flex items-center justify-center gap-2 bg-[#1E3A8A] hover:bg-blue-800 text-white font-bold py-3 px-8 rounded-xl shadow-md shadow-blue-900/20 transition-all hover:-translate-y-0.5">
                    Kunjungi Website Perpustakaan
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                </a>
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
