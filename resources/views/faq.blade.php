<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="referrer" content="no-referrer">
    <title>FAQ - Agregator Jurnal Perpustakaan PKTJ</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #F8FAFC; }
        [x-cloak] { display: none !important; }
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
                <a href="{{ route('faq') }}" class="px-4 py-2 text-sm font-bold text-[#1E3A8A] bg-white rounded-lg shadow-sm border border-slate-200/60 transition">FAQ</a>
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
            <a href="{{ route('how-to-use') }}" class="px-4 py-3 text-sm font-semibold text-slate-600 rounded-lg hover:bg-slate-50 hover:text-[#1E3A8A] transition">Cara Menggunakan</a>
            <a href="{{ route('faq') }}" class="px-4 py-3 text-sm font-bold text-[#1E3A8A] bg-blue-50 rounded-lg transition">FAQ</a>
            <a href="{{ route('about') }}" class="px-4 py-3 text-sm font-semibold text-slate-600 rounded-lg hover:bg-slate-50 hover:text-[#1E3A8A] transition">Tentang</a>
        </div>
    </header>

    <!-- Main Content Wrapped in Alpine FAQ State -->
    <main class="flex-grow w-full" x-data="{ searchQuery: '', activeFaq: null }">
        
        <!-- Hero Section -->
        <div class="relative bg-[#1E3A8A] overflow-hidden text-white pb-24">
            <div class="absolute inset-0 bg-[radial-gradient(#ffffff_1px,transparent_1px)] [background-size:24px_24px] opacity-10"></div>
            
            <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 pt-16 pb-8 text-center relative z-10">
                <h1 class="text-3xl md:text-5xl font-extrabold mb-4 tracking-tight">Pertanyaan yang Sering Diajukan</h1>
                <p class="text-lg text-blue-200 font-light">
                    Temukan jawaban mengenai penggunaan Agregator Jurnal Perpustakaan PKTJ.
                </p>
            </div>
        </div>

        <!-- Search Bar -->
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 -mt-10 relative z-20">
            <div class="relative bg-white rounded-2xl shadow-xl shadow-slate-200/50 border border-slate-200 overflow-hidden flex items-center p-2 focus-within:ring-2 focus-within:ring-blue-500 focus-within:border-blue-500 transition-all duration-300">
                <svg class="w-6 h-6 text-slate-400 ml-3 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                <input type="text" x-model="searchQuery" class="w-full px-4 py-3 text-slate-700 bg-transparent border-none focus:outline-none focus:ring-0 md:text-lg placeholder-slate-400 font-medium" placeholder="Cari pertanyaan...">
                <button x-show="searchQuery !== ''" @click="searchQuery = ''" style="display: none;" class="p-2 mr-2 bg-slate-100 rounded-full text-slate-500 hover:text-slate-700 hover:bg-slate-200 transition shrink-0">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
        </div>

        <!-- Popular Questions Chips -->
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 mt-6 mb-2 text-center" x-show="searchQuery === ''" x-transition>
            <span class="text-[11px] font-extrabold text-slate-400 uppercase tracking-widest block mb-4">Pertanyaan Populer</span>
            <div class="flex flex-wrap justify-center gap-3">
                <button @click="searchQuery = 'Apakah semua artikel gratis'; activeFaq = 'q1'" class="bg-white border border-slate-200 hover:border-blue-300 hover:text-[#1E3A8A] hover:bg-blue-50 hover:shadow-sm text-slate-600 text-sm font-semibold px-5 py-2.5 rounded-full transition-all duration-200">Apakah semua artikel gratis?</button>
                <button @click="searchQuery = 'Mengapa PDF tidak tersedia'; activeFaq = 'q6'" class="bg-white border border-slate-200 hover:border-blue-300 hover:text-[#1E3A8A] hover:bg-blue-50 hover:shadow-sm text-slate-600 text-sm font-semibold px-5 py-2.5 rounded-full transition-all duration-200">Mengapa PDF tidak tersedia?</button>
                <button @click="searchQuery = 'Bagaimana cara mengutip'; activeFaq = 'q5'" class="bg-white border border-slate-200 hover:border-blue-300 hover:text-[#1E3A8A] hover:bg-blue-50 hover:shadow-sm text-slate-600 text-sm font-semibold px-5 py-2.5 rounded-full transition-all duration-200">Bagaimana cara mengutip artikel?</button>
                <button @click="searchQuery = 'Dari mana sumber data'; activeFaq = 'q2'" class="bg-white border border-slate-200 hover:border-blue-300 hover:text-[#1E3A8A] hover:bg-blue-50 hover:shadow-sm text-slate-600 text-sm font-semibold px-5 py-2.5 rounded-full transition-all duration-200">Dari mana sumber data berasal?</button>
            </div>
        </div>

        <!-- FAQ Categories & Accordions -->
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 pb-12 pt-6 space-y-8">
            
            <!-- Category: Umum -->
            <div x-show="searchQuery === '' || 'Dari mana sumber data berasal? Apakah saya harus membuat akun?'.toLowerCase().includes(searchQuery.toLowerCase())" x-transition>
                <h3 class="flex items-center gap-3 text-lg font-bold text-slate-900 mb-5 border-b border-slate-200 pb-3">
                    <div class="w-8 h-8 rounded-full bg-blue-50 text-blue-500 flex items-center justify-center shadow-sm border border-blue-100">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path></svg>
                    </div>
                </h3>

                <!-- Q2 -->
                <div class="group bg-white border border-slate-200 rounded-xl mb-3 overflow-hidden shadow-sm hover:shadow-md hover:border-slate-300 transition-all duration-200" 
                     data-question="Dari mana sumber data berasal?" 
                     x-show="searchQuery === '' || $el.dataset.question.toLowerCase().includes(searchQuery.toLowerCase())"
                     :class="{ 'ring-2 ring-blue-500/20 bg-blue-50/30 border-blue-300': activeFaq === 'q2' }">
                    <button @click="activeFaq = activeFaq === 'q2' ? null : 'q2'" class="w-full text-left px-6 py-5 flex items-center justify-between focus:outline-none">
                        <span class="font-semibold text-slate-800 text-[15px] pr-4" :class="{ 'text-[#1E3A8A]': activeFaq === 'q2' }">Dari mana sumber data berasal?</span>
                        <div class="flex-shrink-0 w-7 h-7 rounded-full bg-slate-100 flex items-center justify-center transition-transform duration-300 border border-slate-200/60" :class="{ 'rotate-180 bg-blue-100 text-blue-600 border-blue-200': activeFaq === 'q2', 'text-slate-500 group-hover:bg-slate-200': activeFaq !== 'q2' }">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path></svg>
                        </div>
                    </button>
                    <div x-show="activeFaq === 'q2'" x-collapse>
                        <div class="px-6 pb-6 pt-1 text-slate-600 text-[15px] leading-relaxed text-justify">
                            Saat ini terintegrasi dengan 8 pangkalan data global:
                            <ul class="mt-3 space-y-2">
                                <li class="flex items-center gap-2"><svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Crossref</li>
                                <li class="flex items-center gap-2"><svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> DOAJ (Directory of Open Access Journals)</li>
                                <li class="flex items-center gap-2"><svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Semantic Scholar</li>
                                <li class="flex items-center gap-2"><svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> OpenAlex</li>
                                <li class="flex items-center gap-2"><svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> IEEE Xplore</li>
                                <li class="flex items-center gap-2"><svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> CORE</li>
                                <li class="flex items-center gap-2"><svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Europe PMC</li>
                                <li class="flex items-center gap-2"><svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> arXiv</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Q7 -->
                <div class="group bg-white border border-slate-200 rounded-xl mb-3 overflow-hidden shadow-sm hover:shadow-md hover:border-slate-300 transition-all duration-200" 
                     data-question="Apakah saya harus membuat akun?" 
                     x-show="searchQuery === '' || $el.dataset.question.toLowerCase().includes(searchQuery.toLowerCase())"
                     :class="{ 'ring-2 ring-blue-500/20 bg-blue-50/30 border-blue-300': activeFaq === 'q7' }">
                    <button @click="activeFaq = activeFaq === 'q7' ? null : 'q7'" class="w-full text-left px-6 py-5 flex items-center justify-between focus:outline-none">
                        <span class="font-semibold text-slate-800 text-[15px] pr-4" :class="{ 'text-[#1E3A8A]': activeFaq === 'q7' }">Apakah saya harus membuat akun?</span>
                        <div class="flex-shrink-0 w-7 h-7 rounded-full bg-slate-100 flex items-center justify-center transition-transform duration-300 border border-slate-200/60" :class="{ 'rotate-180 bg-blue-100 text-blue-600 border-blue-200': activeFaq === 'q7', 'text-slate-500 group-hover:bg-slate-200': activeFaq !== 'q7' }">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path></svg>
                        </div>
                    </button>
                    <div x-show="activeFaq === 'q7'" x-collapse>
                        <div class="px-6 pb-6 pt-1 text-slate-600 text-[15px] leading-relaxed text-justify">
                            <strong>Tidak perlu.</strong> Agregator Jurnal Perpustakaan PKTJ dirancang sebagai fasilitas publik yang bisa diakses secara instan tanpa perlu mendaftar atau melakukan <i>login</i>.
                        </div>
                    </div>
                </div>
            </div>

            <!-- Category: Pencarian -->
            <div x-show="searchQuery === '' || 'Mengapa kadang pencarian memakan waktu 5-10 detik? Bagaimana cara mempersempit hasil pencarian?'.toLowerCase().includes(searchQuery.toLowerCase())" x-transition>
                <h3 class="flex items-center gap-3 text-lg font-bold text-slate-900 mb-5 border-b border-slate-200 pb-3">
                    <div class="w-8 h-8 rounded-full bg-indigo-50 text-indigo-500 flex items-center justify-center shadow-sm border border-indigo-100">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                </h3>

                <!-- Q3 -->
                <div class="group bg-white border border-slate-200 rounded-xl mb-3 overflow-hidden shadow-sm hover:shadow-md hover:border-slate-300 transition-all duration-200" 
                     data-question="Mengapa kadang pencarian memakan waktu 5-10 detik?" 
                     x-show="searchQuery === '' || $el.dataset.question.toLowerCase().includes(searchQuery.toLowerCase())"
                     :class="{ 'ring-2 ring-blue-500/20 bg-blue-50/30 border-blue-300': activeFaq === 'q3' }">
                    <button @click="activeFaq = activeFaq === 'q3' ? null : 'q3'" class="w-full text-left px-6 py-5 flex items-center justify-between focus:outline-none">
                        <span class="font-semibold text-slate-800 text-[15px] pr-4" :class="{ 'text-[#1E3A8A]': activeFaq === 'q3' }">Mengapa kadang pencarian memakan waktu 5-10 detik?</span>
                        <div class="flex-shrink-0 w-7 h-7 rounded-full bg-slate-100 flex items-center justify-center transition-transform duration-300 border border-slate-200/60" :class="{ 'rotate-180 bg-blue-100 text-blue-600 border-blue-200': activeFaq === 'q3', 'text-slate-500 group-hover:bg-slate-200': activeFaq !== 'q3' }">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path></svg>
                        </div>
                    </button>
                    <div x-show="activeFaq === 'q3'" x-collapse>
                        <div class="px-6 pb-6 pt-1 text-slate-600 text-[15px] leading-relaxed text-justify">
                            Kami tidak mencari data di dalam server lokal, melainkan melakukan kueri secara paralel ke 8 pangkalan data di seluruh dunia.<br><br>Namun, setelah pencarian pertama Anda selesai, data akan disimpan sementara (<i>cache</i>) sehingga ketika Anda pindah ke halaman selanjutnya (Pagination), prosesnya akan terasa sangat instan.
                        </div>
                    </div>
                </div>

                <!-- Q4 -->
                <div class="group bg-white border border-slate-200 rounded-xl mb-3 overflow-hidden shadow-sm hover:shadow-md hover:border-slate-300 transition-all duration-200" 
                     data-question="Bagaimana cara mempersempit hasil pencarian?" 
                     x-show="searchQuery === '' || $el.dataset.question.toLowerCase().includes(searchQuery.toLowerCase())"
                     :class="{ 'ring-2 ring-blue-500/20 bg-blue-50/30 border-blue-300': activeFaq === 'q4' }">
                    <button @click="activeFaq = activeFaq === 'q4' ? null : 'q4'" class="w-full text-left px-6 py-5 flex items-center justify-between focus:outline-none">
                        <span class="font-semibold text-slate-800 text-[15px] pr-4" :class="{ 'text-[#1E3A8A]': activeFaq === 'q4' }">Bagaimana cara mempersempit hasil pencarian?</span>
                        <div class="flex-shrink-0 w-7 h-7 rounded-full bg-slate-100 flex items-center justify-center transition-transform duration-300 border border-slate-200/60" :class="{ 'rotate-180 bg-blue-100 text-blue-600 border-blue-200': activeFaq === 'q4', 'text-slate-500 group-hover:bg-slate-200': activeFaq !== 'q4' }">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path></svg>
                        </div>
                    </button>
                    <div x-show="activeFaq === 'q4'" x-collapse>
                        <div class="px-6 pb-6 pt-1 text-slate-600 text-[15px] leading-relaxed text-justify">
                            Gunakan panel <strong>Filter</strong> yang berada di sebelah kiri hasil pencarian. Anda bisa memfilter hasil berdasarkan:
                            <ul class="list-disc pl-5 mt-2 space-y-1">
                                <li><strong>Tahun Terbit:</strong> Sangat berguna jika dosen Anda meminta referensi maksimal 5 tahun terakhir.</li>
                                <li><strong>Bahasa:</strong> Memudahkan pencarian jurnal berbahasa Indonesia atau Inggris saja.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Category: Artikel & Open Access -->
            <div x-show="searchQuery === '' || 'Apakah semua artikel gratis? Mengapa PDF tidak tersedia?'.toLowerCase().includes(searchQuery.toLowerCase())" x-transition>
                <h3 class="flex items-center gap-3 text-lg font-bold text-slate-900 mb-5 border-b border-slate-200 pb-3">
                    <div class="w-8 h-8 rounded-full bg-emerald-50 text-emerald-500 flex items-center justify-center shadow-sm border border-emerald-100">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    </div>
                </h3>

                <!-- Q1 -->
                <div class="group bg-white border border-slate-200 rounded-xl mb-3 overflow-hidden shadow-sm hover:shadow-md hover:border-slate-300 transition-all duration-200" 
                     data-question="Apakah semua artikel gratis?" 
                     x-show="searchQuery === '' || $el.dataset.question.toLowerCase().includes(searchQuery.toLowerCase())"
                     :class="{ 'ring-2 ring-blue-500/20 bg-blue-50/30 border-blue-300': activeFaq === 'q1' }">
                    <button @click="activeFaq = activeFaq === 'q1' ? null : 'q1'" class="w-full text-left px-6 py-5 flex items-center justify-between focus:outline-none">
                        <span class="font-semibold text-slate-800 text-[15px] pr-4" :class="{ 'text-[#1E3A8A]': activeFaq === 'q1' }">Apakah semua artikel gratis?</span>
                        <div class="flex-shrink-0 w-7 h-7 rounded-full bg-slate-100 flex items-center justify-center transition-transform duration-300 border border-slate-200/60" :class="{ 'rotate-180 bg-blue-100 text-blue-600 border-blue-200': activeFaq === 'q1', 'text-slate-500 group-hover:bg-slate-200': activeFaq !== 'q1' }">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path></svg>
                        </div>
                    </button>
                    <div x-show="activeFaq === 'q1'" x-collapse>
                        <div class="px-6 pb-6 pt-1 text-slate-600 text-[15px] leading-relaxed text-justify">
                            <strong>Ya.</strong> Sistem kami secara khusus memprioritaskan jurnal yang memiliki lisensi <strong>Open Access</strong> (Akses Terbuka). Ini berarti sebagian besar PDF artikel yang muncul dapat Anda baca dan unduh secara legal tanpa perlu berlangganan.
                        </div>
                    </div>
                </div>

                <!-- Q6 -->
                <div class="group bg-white border border-slate-200 rounded-xl mb-3 overflow-hidden shadow-sm hover:shadow-md hover:border-slate-300 transition-all duration-200" 
                     data-question="Mengapa PDF tidak tersedia?" 
                     x-show="searchQuery === '' || $el.dataset.question.toLowerCase().includes(searchQuery.toLowerCase())"
                     :class="{ 'ring-2 ring-blue-500/20 bg-blue-50/30 border-blue-300': activeFaq === 'q6' }">
                    <button @click="activeFaq = activeFaq === 'q6' ? null : 'q6'" class="w-full text-left px-6 py-5 flex items-center justify-between focus:outline-none">
                        <span class="font-semibold text-slate-800 text-[15px] pr-4" :class="{ 'text-[#1E3A8A]': activeFaq === 'q6' }">Mengapa PDF tidak tersedia?</span>
                        <div class="flex-shrink-0 w-7 h-7 rounded-full bg-slate-100 flex items-center justify-center transition-transform duration-300 border border-slate-200/60" :class="{ 'rotate-180 bg-blue-100 text-blue-600 border-blue-200': activeFaq === 'q6', 'text-slate-500 group-hover:bg-slate-200': activeFaq !== 'q6' }">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path></svg>
                        </div>
                    </button>
                    <div x-show="activeFaq === 'q6'" x-collapse>
                        <div class="px-6 pb-6 pt-1 text-slate-600 text-[15px] leading-relaxed text-justify">
                            Beberapa penerbit institusi mencegah pengunduhan langsung (Direct Download) melalui layanan pihak ketiga. Jika tombol "Download PDF" tidak ada, klik tombol biru <strong>"Kunjungi Sumber"</strong>. Anda akan diarahkan ke situs resmi penerbit untuk mengunduh PDF secara gratis di sana.
                        </div>
                    </div>
                </div>
            </div>

            <!-- Category: Sitasi -->
            <div x-show="searchQuery === '' || 'Bagaimana cara mengutip artikel?'.toLowerCase().includes(searchQuery.toLowerCase())" x-transition>
                <h3 class="flex items-center gap-3 text-lg font-bold text-slate-900 mb-5 border-b border-slate-200 pb-3">
                    <div class="w-8 h-8 rounded-full bg-amber-50 text-amber-500 flex items-center justify-center shadow-sm border border-amber-100">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                    </div>
                </h3>

                <!-- Q5 -->
                <div class="group bg-white border border-slate-200 rounded-xl mb-3 overflow-hidden shadow-sm hover:shadow-md hover:border-slate-300 transition-all duration-200" 
                     data-question="Bagaimana cara mengutip artikel?" 
                     x-show="searchQuery === '' || $el.dataset.question.toLowerCase().includes(searchQuery.toLowerCase())"
                     :class="{ 'ring-2 ring-blue-500/20 bg-blue-50/30 border-blue-300': activeFaq === 'q5' }">
                    <button @click="activeFaq = activeFaq === 'q5' ? null : 'q5'" class="w-full text-left px-6 py-5 flex items-center justify-between focus:outline-none">
                        <span class="font-semibold text-slate-800 text-[15px] pr-4" :class="{ 'text-[#1E3A8A]': activeFaq === 'q5' }">Bagaimana cara mengutip artikel?</span>
                        <div class="flex-shrink-0 w-7 h-7 rounded-full bg-slate-100 flex items-center justify-center transition-transform duration-300 border border-slate-200/60" :class="{ 'rotate-180 bg-blue-100 text-blue-600 border-blue-200': activeFaq === 'q5', 'text-slate-500 group-hover:bg-slate-200': activeFaq !== 'q5' }">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path></svg>
                        </div>
                    </button>
                    <div x-show="activeFaq === 'q5'" x-collapse>
                        <div class="px-6 pb-6 pt-1 text-slate-600 text-[15px] leading-relaxed text-justify">
                            Sistem kami menyusun format daftar pustaka untuk Anda secara otomatis. Caranya:
                            <ol class="list-decimal pl-5 mt-3 space-y-2">
                                <li>Klik tombol <strong>Detail</strong> pada jurnal yang diinginkan.</li>
                                <li>Gulir ke bawah pada bagian <strong>Format Sitasi</strong>.</li>
                                <li>Klik ikon <strong>Salin</strong> di sebelah format APA, MLA, atau koding BibTeX.</li>
                                <li>Tempelkan ke dalam Laporan Anda.</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Empty State -->
            <div x-show="searchQuery !== '' && !('Dari mana sumber data berasal? Apakah saya harus membuat akun? Mengapa kadang pencarian memakan waktu 5-10 detik? Bagaimana cara mempersempit hasil pencarian? Apakah semua artikel gratis? Mengapa PDF tidak tersedia? Bagaimana cara mengutip artikel?'.toLowerCase().includes(searchQuery.toLowerCase()))" x-transition style="display: none;" class="text-center py-12">
                <div class="w-16 h-16 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <h3 class="text-lg font-bold text-slate-900 mb-2">Jawaban tidak ditemukan</h3>
                <p class="text-slate-500">Coba gunakan kata kunci lain yang lebih sederhana.</p>
            </div>

        </div>

        <!-- Support Section -->
        <div class="bg-slate-50 border-t border-slate-200 mt-auto py-12 text-center">
            <div class="max-w-2xl mx-auto px-4">
                <div class="w-14 h-14 bg-white rounded-2xl shadow-sm border border-slate-200 flex items-center justify-center mx-auto mb-5">
                    <svg class="w-7 h-7 text-[#1E3A8A]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                </div>
                <h2 class="text-2xl font-extrabold text-slate-900 mb-3 tracking-tight">Masih belum menemukan jawaban?</h2>
                <p class="text-slate-600 mb-8 text-[15px]">
                    Hubungi Perpustakaan PKTJ apabila Anda memiliki pertanyaan atau mengalami kendala saat menggunakan Agregator Jurnal.
                </p>
                <a href="mailto:library@pktj.ac.id" class="inline-flex items-center justify-center gap-2 bg-[#1E3A8A] hover:bg-blue-800 text-white font-bold py-3 px-8 rounded-xl shadow-md shadow-blue-900/20 transition-all hover:-translate-y-0.5">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    Hubungi Kami
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
