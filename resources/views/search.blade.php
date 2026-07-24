<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="referrer" content="no-referrer">
    <title>Temukan Referensi Ilmiah dengan Mudah - Perpustakaan PKTJ</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com">
        
            });
        }
    </script>
    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js">
        
            });
        }
    </script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11">
        
            });
        }
    </script>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
            @keyframes slide-up {
            0% { opacity: 0; transform: translateY(20px); }
            100% { opacity: 1; transform: translateY(0); }
        }
        .animate-slide-up {
            animation: slide-up 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }
    </style>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('logodashboard.png') }}">
</head>
<body class="bg-[#F8FAFC] text-slate-800 min-h-screen flex flex-col" x-data="searchOverlay()">

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
                <a href="{{ route('search.index') }}" class="px-4 py-2 text-sm font-bold text-[#1E3A8A] bg-white rounded-lg shadow-sm border border-slate-200/60 transition">Beranda</a>
                <a href="{{ route('how-to-use') }}" class="px-4 py-2 text-sm font-semibold text-slate-600 rounded-lg hover:text-[#1E3A8A] hover:bg-white hover:shadow-sm transition">Cara Menggunakan</a>
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
            <a href="{{ route('search.index') }}" class="px-4 py-3 text-sm font-bold text-[#1E3A8A] bg-blue-50 rounded-lg transition">Beranda</a>
            <a href="{{ route('how-to-use') }}" class="px-4 py-3 text-sm font-semibold text-slate-600 rounded-lg hover:bg-slate-50 hover:text-[#1E3A8A] transition">Cara Menggunakan</a>
            <a href="{{ route('faq') }}" class="px-4 py-3 text-sm font-semibold text-slate-600 rounded-lg hover:bg-slate-50 hover:text-[#1E3A8A] transition">FAQ</a>
            <a href="{{ route('about') }}" class="px-4 py-3 text-sm font-semibold text-slate-600 rounded-lg hover:bg-slate-50 hover:text-[#1E3A8A] transition">Tentang</a>
        </div>
    </header>

    <main class="flex-grow w-full">
        @if(request()->anyFilled(['q', 'cluster', 'year_from', 'year_to', 'language']))
        <!-- ============================================== -->
        <!-- HASIL PENCARIAN VIEW                           -->
        <!-- ============================================== -->
        <div class="relative bg-[#1E3A8A] overflow-hidden border-b border-blue-900 py-6">
            <div class="absolute inset-0 bg-[radial-gradient(#ffffff_1px,transparent_1px)] [background-size:24px_24px] opacity-10"></div>
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <form action="{{ route('search.index') }}" method="GET" @submit="startSearch()" x-data="{ showFilters: {{ request()->hasAny(['year_from', 'year_to', 'language']) && (request('year_from') || request('year_to') || (request('language') && request('language') !== 'all')) ? 'true' : 'false' }} }" class="w-full max-w-4xl relative">
                    <div class="flex flex-col md:flex-row gap-3 bg-white p-2 rounded-2xl shadow-sm border border-slate-200 items-center">
                        <div class="relative flex-1 w-full">
                            <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none">
                                <svg class="h-6 w-6 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>
                            <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari topik, judul, penulis, atau DOI..." 
                                   class="w-full pl-14 pr-4 py-3 bg-transparent focus:outline-none text-slate-800 placeholder-slate-400 font-medium text-base">
                        </div>
                        <div class="flex gap-2 w-full md:w-auto">
                            <button type="button" @click="showFilters = !showFilters" class="px-5 py-3 rounded-xl bg-slate-50 border border-slate-200 text-slate-600 hover:bg-slate-100 hover:text-[#1E3A8A] transition flex items-center justify-center flex-1 md:flex-none" title="Filter Lanjutan">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path></svg>
                            </button>
                            <button type="submit" class="px-6 py-3 rounded-xl bg-[#FBBF24] hover:bg-amber-500 text-[#1E3A8A] font-extrabold transition shadow-sm flex items-center justify-center gap-2 whitespace-nowrap flex-1 md:flex-none">
                                Cari Jurnal
                            </button>
                        </div>
                    </div>

                    <!-- Advanced Filters Dropdown -->
                    <div x-show="showFilters" x-transition class="mt-3 bg-white border border-slate-200 rounded-2xl p-6 shadow-lg w-full text-center" style="display: none;">
                        <div class="grid grid-cols-1 lg:grid-cols-[1fr_1fr_1fr_1.5fr_1fr_1fr] md:grid-cols-3 gap-5 items-end">
                            <div>
                                <label class="block text-xs font-bold text-slate-500 mb-1.5 uppercase tracking-wide">Tahun Dari</label>
                                <input type="number" name="year_from" value="{{ request('year_from') }}" placeholder="{{ date('Y') - 5 }}" class="w-full text-left bg-[#F8FAFC] border border-slate-200 text-slate-800 py-3 px-4 rounded-xl focus:ring-2 focus:ring-[#1E3A8A]/20 focus:border-[#1E3A8A] transition text-sm">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-slate-500 mb-1.5 uppercase tracking-wide">Tahun Sampai</label>
                                <input type="number" name="year_to" value="{{ request('year_to') }}" placeholder="{{ date('Y') }}" class="w-full text-left bg-[#F8FAFC] border border-slate-200 text-slate-800 py-3 px-4 rounded-xl focus:ring-2 focus:ring-[#1E3A8A]/20 focus:border-[#1E3A8A] transition text-sm">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-slate-500 mb-1.5 uppercase tracking-wide">Bahasa</label>
                                <select name="language"  class="w-full text-left bg-[#F8FAFC] border border-slate-200 text-slate-800 py-3 px-4 rounded-xl focus:ring-2 focus:ring-[#1E3A8A]/20 focus:border-[#1E3A8A] transition text-sm">
                                    <option value="all" {{ request('language') == 'all' ? 'selected' : '' }}>Semua</option>
                                    <option value="id" {{ request('language') == 'id' ? 'selected' : '' }}>Indonesia</option>
                                    <option value="en" {{ request('language') == 'en' ? 'selected' : '' }}>Inggris</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-slate-500 mb-1.5 uppercase tracking-wide">Sumber</label>
                                <select name="source"  class="w-full text-left bg-[#F8FAFC] border border-slate-200 text-slate-800 py-3 px-4 rounded-xl focus:ring-2 focus:ring-[#1E3A8A]/20 focus:border-[#1E3A8A] transition text-sm">
                                    <option value="all" {{ request('source') == 'all' ? 'selected' : '' }}>Semua</option>
                                    <option value="crossref" {{ request('source') == 'crossref' ? 'selected' : '' }}>Crossref</option>
                                    <option value="doaj" {{ request('source') == 'doaj' ? 'selected' : '' }}>DOAJ</option>
                                    <option value="semantic_scholar" {{ request('source') == 'semantic_scholar' ? 'selected' : '' }}>Semantic Scholar</option>
                                    <option value="openalex" {{ request('source') == 'openalex' ? 'selected' : '' }}>OpenAlex</option>
                                    <option value="ieee" {{ request('source') == 'ieee' ? 'selected' : '' }}>IEEE Xplore</option>
                                    <option value="core" {{ request('source') == 'core' ? 'selected' : '' }}>CORE</option>
                                    <option value="europepmc" {{ request('source') == 'europepmc' ? 'selected' : '' }}>Europe PMC</option>
                                    <option value="arxiv" {{ request('source') == 'arxiv' ? 'selected' : '' }}>arXiv</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-slate-500 mb-1.5 uppercase tracking-wide">Urutkan</label>
                                <select name="sort"  class="w-full text-left bg-[#F8FAFC] border border-slate-200 text-slate-800 py-3 px-4 rounded-xl focus:ring-2 focus:ring-[#1E3A8A]/20 focus:border-[#1E3A8A] transition text-sm">
                                    <option value="relevansi" {{ request('sort') == 'relevansi' ? 'selected' : '' }}>Relevansi</option>
                                    <option value="terbaru" {{ request('sort') == 'terbaru' ? 'selected' : '' }}>Terbaru</option>
                                    <option value="terlama" {{ request('sort') == 'terlama' ? 'selected' : '' }}>Terlama</option>
                                    <option value="sitasi" {{ request('sort') == 'sitasi' ? 'selected' : '' }}>Sitasi</option>
                                </select>
                            </div>
                            <div>
                                <button type="submit" class="w-full bg-[#1E3A8A] hover:bg-blue-800 text-white font-bold py-3 px-4 rounded-xl shadow-sm transition text-sm">Terapkan</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 w-full">
            <section>
                <div class="mb-6 flex flex-col sm:flex-row sm:justify-between sm:items-end border-b border-slate-200 pb-4 sm:pb-2 gap-4">
                    <div class="flex items-center gap-3">
                        <h2 class="text-xl font-extrabold text-slate-800">
                            Hasil Pencarian
                        </h2>
                        @if(isset($articles) && $articles->total() > 0)
                        <div class="relative inline-block text-left" x-data="{ openDownload: false }">
                            <div>
                                <button @click="openDownload = !openDownload" @click.away="openDownload = false" type="button" class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-bold text-blue-700 bg-blue-50 border border-blue-200 rounded-lg hover:bg-blue-100 hover:text-[#1E3A8A] transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500/30 shadow-sm" id="menu-button" aria-expanded="true" aria-haspopup="true">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                                    Download Top 100
                                    <svg class="w-3.5 h-3.5 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                </button>
                            </div>
                            <div x-show="openDownload" style="display: none;" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="absolute left-0 z-50 mt-2 w-56 origin-top-left sm:origin-bottom-left rounded-xl bg-white shadow-xl border border-slate-200 focus:outline-none overflow-hidden" role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
                                <div class="p-1" role="none">
                                    <div class="px-3 py-2 border-b border-slate-100 mb-1">
                                        <p class="text-[10px] font-bold text-slate-500 uppercase tracking-wider">Pilih Format Unduhan</p>
                                    </div>
                                    <a href="#" @click.prevent="startDownload('CSV', '{{ route('search.export', array_merge(request()->query(), ['format' => 'csv'])) }}'); openDownload = false" class="text-slate-700 hover:bg-blue-50 hover:text-[#1E3A8A] group flex items-center gap-2 rounded-lg px-3 py-2 text-sm font-semibold transition-colors" role="menuitem" tabindex="-1">
                                        <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                        CSV (Excel)
                                    </a>
                                    <a href="#" @click.prevent="startDownload('BibTeX', '{{ route('search.export', array_merge(request()->query(), ['format' => 'bibtex'])) }}'); openDownload = false" class="text-slate-700 hover:bg-blue-50 hover:text-[#1E3A8A] group flex items-center gap-2 rounded-lg px-3 py-2 text-sm font-semibold transition-colors" role="menuitem" tabindex="-1">
                                        <svg class="w-4 h-4 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                                        BibTeX (Mendeley/Zotero)
                                    </a>
                                    <a href="#" @click.prevent="startDownload('JSON', '{{ route('search.export', array_merge(request()->query(), ['format' => 'json'])) }}'); openDownload = false" class="text-slate-700 hover:bg-blue-50 hover:text-[#1E3A8A] group flex items-center gap-2 rounded-lg px-3 py-2 text-sm font-semibold transition-colors" role="menuitem" tabindex="-1">
                                        <svg class="w-4 h-4 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path></svg>
                                        JSON (Developer)
                                    </a>
                                </div>
                                <div class="px-3 py-2.5 bg-slate-50 border-t border-slate-100 flex gap-2 items-start">
                                    <svg class="w-4 h-4 text-slate-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    <p class="text-[10px] text-slate-500 leading-tight">Mengekspor 100 hasil teratas untuk menjaga performa sistem.</p>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                    <span class="text-sm text-slate-500 font-medium">Menampilkan {{ $articles->firstItem() ?? 0 }} hingga {{ $articles->lastItem() ?? 0 }} dari {{ number_format($articles->total(), 0, ',', '.') }} hasil</span>
                </div>
                
                @if(isset($didYouMean) && strtolower(trim($didYouMean)) !== strtolower(trim($keyword)) && !$strict)
                <div class="mb-6 bg-blue-50 border border-blue-200 text-blue-800 px-5 py-4 rounded-xl flex items-start gap-4 shadow-sm animate-slide-up">
                    <svg class="w-6 h-6 mt-0.5 text-blue-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <div class="flex flex-col gap-1">
                        <p class="text-sm font-medium">Menampilkan hasil untuk <a href="{{ route('search.index', array_merge(request()->query(), ['q' => $didYouMean, 'strict' => 1])) }}" class="font-black italic text-[#1E3A8A] hover:underline transition">{{ $didYouMean }}</a></p>
                        <p class="text-[13px] text-blue-700 opacity-90">Atau telusuri hasil untuk <a href="{{ route('search.index', array_merge(request()->query(), ['q' => $keyword, 'strict' => 1])) }}" class="font-bold underline hover:text-[#1E3A8A] transition">{{ $keyword }}</a></p>
                    </div>
                </div>
                @endif

                <div class="space-y-6">
                    @forelse($articles as $article)
                        <article class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200 hover:shadow-md transition duration-200 animate-slide-up" style="animation-fill-mode: both; animation-delay: {{ $loop->index * 60 }}ms;">
                            <!-- Top Row: Badges -->
                            <div class="flex items-center justify-between mb-3">
                                <div class="flex flex-wrap items-center gap-2">
                                    @php
                                        $repoName = $article->repository ? $article->repository->name : 'Database Lokal';
                                        $sourceColor = 'bg-slate-100 text-slate-700 border-slate-200';
                                        
                                        if (stripos($repoName, 'Crossref') !== false) $sourceColor = 'bg-blue-50 text-blue-700 border-blue-200';
                                        elseif (stripos($repoName, 'DOAJ') !== false) $sourceColor = 'bg-emerald-50 text-emerald-700 border-emerald-200';
                                        elseif (stripos($repoName, 'arXiv') !== false) $sourceColor = 'bg-rose-50 text-rose-700 border-rose-200';
                                        elseif (stripos($repoName, 'Semantic') !== false) $sourceColor = 'bg-purple-50 text-purple-700 border-purple-200';
                                        elseif (stripos($repoName, 'OpenAlex') !== false) $sourceColor = 'bg-orange-50 text-orange-700 border-orange-200';
                                        elseif (stripos($repoName, 'Europe PMC') !== false) $sourceColor = 'bg-teal-50 text-teal-700 border-teal-200';
                                        elseif (stripos($repoName, 'CORE') !== false) $sourceColor = 'bg-slate-100 text-slate-800 border-slate-300';
                                        elseif (stripos($repoName, 'IEEE') !== false) $sourceColor = 'bg-sky-50 text-sky-700 border-sky-200';
                                    @endphp
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-bold border {{ $sourceColor }}">
                                        {{ strtoupper($repoName) }}
                                    </span>
                                    
                                    @if($article->pdf_url || stripos($repoName, 'DOAJ') !== false)
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-md text-xs font-bold bg-[#FBBF24]/20 text-amber-800 border border-amber-200">
                                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path d="M10 2a5 5 0 00-5 5v2a2 2 0 00-2 2v5a2 2 0 002 2h10a2 2 0 002-2v-5a2 2 0 00-2-2H7V7a3 3 0 015.905-.75 1 1 0 001.937-.5A5.002 5.002 0 0010 2z"></path></svg>
                                        Open Access
                                    </span>
                                    @endif
                                    
                                    <span class="text-sm font-semibold text-slate-500">{{ $article->publication_year ?? '' }}</span>
                                </div>
                                
                                <div class="hidden sm:block">
                                    @if($article->cluster)
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold border bg-slate-50 text-slate-600 border-slate-200">
                                        {{ $article->cluster }}
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <a href="{{ route('track.redirect', ['url' => $article->source_url, 'repo' => $repoName, 'type' => 'click_source', 'title' => $article->title]) }}" target="_blank" class="block mb-2 group">
                                <h3 class="text-lg md:text-xl font-bold text-slate-900 group-hover:text-[#1E3A8A] transition leading-snug">
                                    {{ $article->title }}
                                </h3>
                            </a>

                            <div class="flex items-center gap-2 mb-4 text-sm text-slate-500 font-medium">
                                @if(count($article->authors) > 1)
                                    <svg class="w-4 h-4 text-blue-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                @else
                                    <svg class="w-4 h-4 text-blue-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                @endif
                                <span class="truncate">
                                    @if(count($article->authors) > 0)
                                        {{ collect($article->authors)->pluck('name')->implode(', ') }}
                                    @else
                                        <i class="text-slate-400">Penulis tidak diketahui</i>
                                    @endif
                                </span>
                            </div>

                            <div class="mb-5 text-slate-600 text-sm leading-relaxed font-medium text-justify relative" x-data="{ expanded: false }">
                                <div :class="expanded ? '' : 'line-clamp-2 md:line-clamp-3'">
                                    {{ $article->abstract ?? 'Abstrak tidak tersedia untuk artikel ini.' }}
                                </div>
                                @if($article->abstract && strlen($article->abstract) > 250)
                                    <button @click="expanded = !expanded" class="text-[#1E3A8A] text-xs font-bold mt-2 flex items-center gap-1 hover:underline">
                                        <span x-text="expanded ? 'Tampilkan Lebih Sedikit' : 'Baca Selengkapnya'"></span>
                                        <svg class="w-3.5 h-3.5 transition-transform" :class="expanded ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                    </button>
                                @endif
                            </div>

                            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pt-4 border-t border-slate-100">
                                <div class="flex items-center gap-3 text-xs font-bold text-slate-500">
                                    <span class="text-[#FBBF24] flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                        @if(isset($article->citation_count) && $article->citation_count > 0)
                                            {{ $article->citation_count }} sitasi
                                        @else
                                            Sitasi: -
                                        @endif
                                    </span>
                                    <span class="text-slate-300">•</span>
                                    <span class="uppercase flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129"></path></svg>
                                        {{ strtoupper($article->language ?? 'ID') }}
                                    </span>
                                </div>

                                <div class="flex flex-wrap items-center gap-2">
                                    <a href="{{ route('article.show', $article->id) }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-[#1E3A8A] hover:bg-blue-900 text-white text-xs font-bold rounded-lg transition shadow-sm">
                                        Detail
                                    </a>
                                    @if($article->source_url)
                                    <a href="{{ route('track.redirect', ['url' => $article->source_url, 'repo' => $repoName, 'type' => 'click_source', 'title' => $article->title]) }}" target="_blank" rel="noreferrer noopener" class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-white border border-slate-200 hover:border-slate-300 hover:bg-slate-50 text-slate-700 text-xs font-bold rounded-lg transition">
                                        Sumber
                                    </a>
                                    @endif
                                    @if($article->pdf_url)
                                    <a href="{{ route('track.redirect', ['url' => $article->pdf_url, 'repo' => $repoName, 'type' => 'click_pdf', 'title' => $article->title]) }}" target="_blank" rel="noreferrer noopener" class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-emerald-50 text-emerald-700 hover:bg-emerald-100 border border-emerald-200 text-xs font-bold rounded-lg transition">
                                        PDF
                                    </a>
                                    @endif
                                    @if($article->doi)
                                    @php $doiUrl = str_starts_with($article->doi, 'http') ? $article->doi : 'https://doi.org/' . $article->doi; @endphp
                                    <a href="{{ route('track.redirect', ['url' => $doiUrl, 'repo' => $repoName, 'type' => 'click_doi', 'title' => $article->title]) }}" target="_blank" rel="noreferrer noopener" class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-white border border-slate-200 hover:border-slate-300 hover:bg-slate-50 text-slate-700 text-xs font-bold rounded-lg transition">
                                        DOI
                                    </a>
                                    @endif
                                </div>
                            </div>
                        </article>
                    @empty
                        <div class="text-center py-20 bg-slate-50 rounded-3xl border-2 border-dashed border-slate-200 flex flex-col items-center justify-center animate-slide-up">
                            <div class="w-24 h-24 mb-6 bg-white rounded-full flex items-center justify-center shadow-sm">
                                <svg class="w-12 h-12 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"></path>
                                </svg>
                            </div>
                            <h3 class="text-2xl font-black text-slate-800 mb-2">Jurnal Tidak Ditemukan</h3>
                            <p class="text-slate-500 font-medium max-w-md mx-auto mb-6">Kami tidak dapat menemukan literatur yang cocok dengan kata kunci atau filter Anda. Coba gunakan istilah yang lebih umum.</p>
                            <button @click="window.scrollTo({top: 0, behavior: 'smooth'}); document.querySelector('input[name=q]').focus();" class="px-6 py-2.5 bg-[#1E3A8A] text-white font-bold rounded-xl hover:bg-blue-800 transition shadow-sm">
                                Coba Kata Kunci Lain
                            </button>
                        </div>
                    @endforelse
                </div>

                <div class="mt-8">
                    {{ $articles->links() }}
                </div>
            </section>
        </div>

        @else
        <!-- ============================================== -->
        <!-- LANDING PAGE VIEW                              -->
        <!-- ============================================== -->
        
        <!-- Hero Section -->
        <section class="bg-[#1E3A8A] relative overflow-hidden text-white w-full">
            <div class="absolute inset-0 bg-[radial-gradient(#ffffff_1px,transparent_1px)] [background-size:24px_24px] opacity-10"></div>
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 lg:py-28 relative z-10 flex flex-col items-center text-center">
                
                <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-blue-900/50 border border-blue-400/30 text-blue-200 text-xs font-bold mb-8">
                    <span class="w-2 h-2 rounded-full bg-blue-400 animate-pulse"></span>
                    Sistem Pencarian Terpadu
                </div>
                
                <h1 class="text-4xl md:text-5xl lg:text-[4rem] font-extrabold tracking-tight leading-tight mb-6">
                    Temukan Referensi Ilmiah dengan Mudah
                </h1>
                
                <p class="text-lg md:text-xl text-blue-100 mb-10 leading-relaxed font-light max-w-3xl mx-auto">
                    Cari jutaan referensi ilmiah dari berbagai database akademik terpercaya melalui satu pencarian sederhana.
                </p>

                <!-- Form Pencarian -->
                <form action="{{ route('search.index') }}" method="GET" @submit="startSearch()" x-data="{ showFilters: false }" class="relative z-20 w-full max-w-4xl mx-auto">
                    <div class="flex flex-col md:flex-row gap-3 bg-white p-2 rounded-2xl shadow-2xl items-center">
                        <div class="relative flex-1 w-full">
                            <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none">
                                <svg class="h-6 w-6 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>
                            <input type="text" name="q" placeholder="Cari topik, judul, penulis, atau DOI..." 
                                   class="w-full pl-14 pr-4 py-4 bg-transparent focus:outline-none text-slate-800 placeholder-slate-400 font-medium text-lg">
                        </div>
                        <div class="flex gap-2 w-full md:w-auto">
                            <button type="button" @click="showFilters = !showFilters" class="px-5 py-4 rounded-xl bg-slate-50 border border-slate-200 text-slate-600 hover:bg-slate-100 hover:text-[#1E3A8A] transition flex items-center justify-center flex-1 md:flex-none" title="Filter Lanjutan">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path></svg>
                            </button>
                            <button type="submit" class="px-8 py-4 rounded-xl bg-[#FBBF24] hover:bg-amber-500 text-[#1E3A8A] font-extrabold transition shadow-md flex items-center justify-center gap-2 whitespace-nowrap flex-1 md:flex-none">
                                Cari Jurnal
                            </button>
                        </div>
                    </div>

                    <!-- Advanced Filters Dropdown -->
                    <div x-show="showFilters" x-transition class="mt-2 bg-white border border-slate-200 rounded-2xl p-6 shadow-xl absolute w-full z-20 text-center" style="display: none;">
                        <div class="grid grid-cols-1 lg:grid-cols-[1fr_1fr_1fr_1.5fr_1fr_1fr] md:grid-cols-3 gap-5 items-end">
                            <div>
                                <label class="block text-xs font-bold text-slate-500 mb-1.5 uppercase tracking-wide">Tahun Dari</label>
                                <input type="number" name="year_from" value="{{ request('year_from') }}" placeholder="{{ date('Y') - 5 }}" class="w-full text-left bg-[#F8FAFC] border border-slate-200 text-slate-800 py-3 px-4 rounded-xl focus:ring-2 focus:ring-[#1E3A8A]/20 focus:border-[#1E3A8A] transition text-sm">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-slate-500 mb-1.5 uppercase tracking-wide">Tahun Sampai</label>
                                <input type="number" name="year_to" value="{{ request('year_to') }}" placeholder="{{ date('Y') }}" class="w-full text-left bg-[#F8FAFC] border border-slate-200 text-slate-800 py-3 px-4 rounded-xl focus:ring-2 focus:ring-[#1E3A8A]/20 focus:border-[#1E3A8A] transition text-sm">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-slate-500 mb-1.5 uppercase tracking-wide">Bahasa</label>
                                <select name="language"  class="w-full text-left bg-[#F8FAFC] border border-slate-200 text-slate-800 py-3 px-4 rounded-xl focus:ring-2 focus:ring-[#1E3A8A]/20 focus:border-[#1E3A8A] transition text-sm">
                                    <option value="all" {{ request('language') == 'all' ? 'selected' : '' }}>Semua</option>
                                    <option value="id" {{ request('language') == 'id' ? 'selected' : '' }}>Indonesia</option>
                                    <option value="en" {{ request('language') == 'en' ? 'selected' : '' }}>Inggris</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-slate-500 mb-1.5 uppercase tracking-wide">Sumber</label>
                                <select name="source"  class="w-full text-left bg-[#F8FAFC] border border-slate-200 text-slate-800 py-3 px-4 rounded-xl focus:ring-2 focus:ring-[#1E3A8A]/20 focus:border-[#1E3A8A] transition text-sm">
                                    <option value="all" {{ request('source') == 'all' ? 'selected' : '' }}>Semua</option>
                                    <option value="crossref" {{ request('source') == 'crossref' ? 'selected' : '' }}>Crossref</option>
                                    <option value="doaj" {{ request('source') == 'doaj' ? 'selected' : '' }}>DOAJ</option>
                                    <option value="semantic_scholar" {{ request('source') == 'semantic_scholar' ? 'selected' : '' }}>Semantic Scholar</option>
                                    <option value="openalex" {{ request('source') == 'openalex' ? 'selected' : '' }}>OpenAlex</option>
                                    <option value="ieee" {{ request('source') == 'ieee' ? 'selected' : '' }}>IEEE Xplore</option>
                                    <option value="core" {{ request('source') == 'core' ? 'selected' : '' }}>CORE</option>
                                    <option value="europepmc" {{ request('source') == 'europepmc' ? 'selected' : '' }}>Europe PMC</option>
                                    <option value="arxiv" {{ request('source') == 'arxiv' ? 'selected' : '' }}>arXiv</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-slate-500 mb-1.5 uppercase tracking-wide">Urutkan</label>
                                <select name="sort"  class="w-full text-left bg-[#F8FAFC] border border-slate-200 text-slate-800 py-3 px-4 rounded-xl focus:ring-2 focus:ring-[#1E3A8A]/20 focus:border-[#1E3A8A] transition text-sm">
                                    <option value="relevansi" {{ request('sort') == 'relevansi' ? 'selected' : '' }}>Relevansi</option>
                                    <option value="terbaru" {{ request('sort') == 'terbaru' ? 'selected' : '' }}>Terbaru</option>
                                    <option value="terlama" {{ request('sort') == 'terlama' ? 'selected' : '' }}>Terlama</option>
                                    <option value="sitasi" {{ request('sort') == 'sitasi' ? 'selected' : '' }}>Sitasi</option>
                                </select>
                            </div>
                            <div>
                                <button type="submit" class="w-full bg-[#1E3A8A] hover:bg-blue-800 text-white font-bold py-3 px-4 rounded-xl shadow-sm transition text-sm">Terapkan</button>
                            </div>
                        </div>
                    </div>
                </form>

                <div class="mt-8 flex flex-wrap items-center justify-center gap-3">
                    <span class="text-xs font-semibold text-blue-300/80 mr-1">Pencarian Populer:</span>
                    @if(isset($popularSearches) && count($popularSearches) > 0)
                        @foreach($popularSearches as $term)
                            <a href="?q={{ urlencode($term) }}" @click="startSearch()" class="block px-4 py-2 rounded-full bg-blue-800/50 border border-blue-400/30 text-xs font-semibold text-blue-100 hover:bg-white hover:text-[#1E3A8A] transition truncate max-w-[150px] sm:max-w-[200px]" title="{{ ucwords($term) }}">{{ ucwords($term) }}</a>
                        @endforeach
                    @else
                        <span class="text-xs font-medium text-blue-400/60 italic">Belum ada data pencarian.</span>
                    @endif
                </div>
            </div>
        </section>

        <!-- Statistic Cards -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 relative z-20">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 sm:gap-6">
                <!-- Card 1 -->
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200 hover:shadow-md transition group">
                    <div class="w-10 h-10 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center mb-4 group-hover:bg-[#1E3A8A] group-hover:text-white transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                    </div>
                    <h3 class="text-3xl font-black text-slate-900 mb-1">8+</h3>
                    <p class="text-sm font-semibold text-slate-500">Database Terhubung</p>
                </div>
                <!-- Card 2 -->
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200 hover:shadow-md transition group">
                    <div class="w-10 h-10 bg-emerald-50 text-emerald-600 rounded-xl flex items-center justify-center mb-4 group-hover:bg-emerald-500 group-hover:text-white transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    </div>
                    <h3 class="text-3xl font-black text-slate-900 mb-1">Jutaan+</h3>
                    <p class="text-sm font-semibold text-slate-500">Artikel Ilmiah</p>
                </div>
                <!-- Card 3 -->
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200 hover:shadow-md transition group">
                    <div class="w-10 h-10 bg-amber-50 text-amber-600 rounded-xl flex items-center justify-center mb-4 group-hover:bg-amber-500 group-hover:text-white transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"></path></svg>
                    </div>
                    <h3 class="text-3xl font-black text-slate-900 mb-1">Gratis</h3>
                    <p class="text-sm font-semibold text-slate-500">Tanpa Registrasi</p>
                </div>
                <!-- Card 4 -->
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200 hover:shadow-md transition group">
                    <div class="w-10 h-10 bg-purple-50 text-purple-600 rounded-xl flex items-center justify-center mb-4 group-hover:bg-purple-500 group-hover:text-white transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </div>
                    <h3 class="text-3xl font-black text-slate-900 mb-1">Realtime</h3>
                    <p class="text-sm font-semibold text-slate-500">Pencarian Cepat</p>
                </div>
            </div>
        </section>

        <!-- Database Logos (Infinite Marquee) -->
        <section class="py-12 border-b border-slate-200 bg-white overflow-hidden relative">
            <div class="max-w-7xl mx-auto px-4 text-center mb-6">
                <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Terhubung secara real-time dengan basis data global</p>
            </div>
            
            <!-- Gradient Masks for smooth fading edges -->
            <div class="absolute left-0 top-0 bottom-0 w-32 bg-gradient-to-r from-white to-transparent z-10"></div>
            <div class="absolute right-0 top-0 bottom-0 w-32 bg-gradient-to-l from-white to-transparent z-10"></div>

            <div class="relative flex overflow-x-hidden group">
                <div class="flex animate-marquee whitespace-nowrap items-center group-hover:pause-animation">
                    <!-- Set 1 -->
                    <a href="https://www.crossref.org/" target="_blank" class="mx-8 font-extrabold text-2xl tracking-tight text-slate-400 transition-all duration-300 hover:text-blue-500 hover:drop-shadow-[0_0_12px_rgba(59,130,246,0.8)]">Crossref</a>
                    <a href="https://doaj.org/" target="_blank" class="mx-8 font-extrabold text-2xl tracking-tight text-slate-400 transition-all duration-300 hover:text-emerald-500 hover:drop-shadow-[0_0_12px_rgba(16,185,129,0.8)]">DOAJ</a>
                    <a href="https://www.semanticscholar.org/" target="_blank" class="mx-8 font-extrabold text-2xl tracking-tight text-slate-400 transition-all duration-300 hover:text-purple-500 hover:drop-shadow-[0_0_12px_rgba(168,85,247,0.8)]">Semantic Scholar</a>
                    <a href="https://openalex.org/" target="_blank" class="mx-8 font-extrabold text-2xl tracking-tight text-slate-400 transition-all duration-300 hover:text-orange-500 hover:drop-shadow-[0_0_12px_rgba(249,115,22,0.8)]">OpenAlex</a>
                    <a href="https://core.ac.uk/" target="_blank" class="mx-8 font-extrabold text-2xl tracking-tight text-slate-400 transition-all duration-300 hover:text-slate-800 hover:drop-shadow-[0_0_12px_rgba(30,41,59,0.5)]">CORE</a>
                    <a href="https://ieeexplore.ieee.org/" target="_blank" class="mx-8 font-extrabold text-2xl tracking-tight text-slate-400 transition-all duration-300 hover:text-cyan-600 hover:drop-shadow-[0_0_12px_rgba(8,145,178,0.8)]">IEEE Xplore</a>
                    <a href="https://europepmc.org/" target="_blank" class="mx-8 font-extrabold text-2xl tracking-tight text-slate-400 transition-all duration-300 hover:text-teal-500 hover:drop-shadow-[0_0_12px_rgba(20,184,166,0.8)]">Europe PMC</a>
                    <a href="https://arxiv.org/" target="_blank" class="mx-8 font-extrabold text-2xl tracking-tight text-slate-400 transition-all duration-300 hover:text-red-600 hover:drop-shadow-[0_0_12px_rgba(220,38,38,0.8)]">arXiv</a>
                    <!-- Set 2 -->
                    <a href="https://www.crossref.org/" target="_blank" class="mx-8 font-extrabold text-2xl tracking-tight text-slate-400 transition-all duration-300 hover:text-blue-500 hover:drop-shadow-[0_0_12px_rgba(59,130,246,0.8)]">Crossref</a>
                    <a href="https://doaj.org/" target="_blank" class="mx-8 font-extrabold text-2xl tracking-tight text-slate-400 transition-all duration-300 hover:text-emerald-500 hover:drop-shadow-[0_0_12px_rgba(16,185,129,0.8)]">DOAJ</a>
                    <a href="https://www.semanticscholar.org/" target="_blank" class="mx-8 font-extrabold text-2xl tracking-tight text-slate-400 transition-all duration-300 hover:text-purple-500 hover:drop-shadow-[0_0_12px_rgba(168,85,247,0.8)]">Semantic Scholar</a>
                    <a href="https://openalex.org/" target="_blank" class="mx-8 font-extrabold text-2xl tracking-tight text-slate-400 transition-all duration-300 hover:text-orange-500 hover:drop-shadow-[0_0_12px_rgba(249,115,22,0.8)]">OpenAlex</a>
                    <a href="https://core.ac.uk/" target="_blank" class="mx-8 font-extrabold text-2xl tracking-tight text-slate-400 transition-all duration-300 hover:text-slate-800 hover:drop-shadow-[0_0_12px_rgba(30,41,59,0.5)]">CORE</a>
                    <a href="https://ieeexplore.ieee.org/" target="_blank" class="mx-8 font-extrabold text-2xl tracking-tight text-slate-400 transition-all duration-300 hover:text-cyan-600 hover:drop-shadow-[0_0_12px_rgba(8,145,178,0.8)]">IEEE Xplore</a>
                    <a href="https://europepmc.org/" target="_blank" class="mx-8 font-extrabold text-2xl tracking-tight text-slate-400 transition-all duration-300 hover:text-teal-500 hover:drop-shadow-[0_0_12px_rgba(20,184,166,0.8)]">Europe PMC</a>
                    <a href="https://arxiv.org/" target="_blank" class="mx-8 font-extrabold text-2xl tracking-tight text-slate-400 transition-all duration-300 hover:text-red-600 hover:drop-shadow-[0_0_12px_rgba(220,38,38,0.8)]">arXiv</a>
                </div>
                <!-- Absolute Clone -->
                <div class="absolute top-0 flex animate-marquee2 whitespace-nowrap items-center group-hover:pause-animation">
                    <!-- Set 1 -->
                    <a href="https://www.crossref.org/" target="_blank" class="mx-8 font-extrabold text-2xl tracking-tight text-slate-400 transition-all duration-300 hover:text-blue-500 hover:drop-shadow-[0_0_12px_rgba(59,130,246,0.8)]">Crossref</a>
                    <a href="https://doaj.org/" target="_blank" class="mx-8 font-extrabold text-2xl tracking-tight text-slate-400 transition-all duration-300 hover:text-emerald-500 hover:drop-shadow-[0_0_12px_rgba(16,185,129,0.8)]">DOAJ</a>
                    <a href="https://www.semanticscholar.org/" target="_blank" class="mx-8 font-extrabold text-2xl tracking-tight text-slate-400 transition-all duration-300 hover:text-purple-500 hover:drop-shadow-[0_0_12px_rgba(168,85,247,0.8)]">Semantic Scholar</a>
                    <a href="https://openalex.org/" target="_blank" class="mx-8 font-extrabold text-2xl tracking-tight text-slate-400 transition-all duration-300 hover:text-orange-500 hover:drop-shadow-[0_0_12px_rgba(249,115,22,0.8)]">OpenAlex</a>
                    <a href="https://core.ac.uk/" target="_blank" class="mx-8 font-extrabold text-2xl tracking-tight text-slate-400 transition-all duration-300 hover:text-slate-800 hover:drop-shadow-[0_0_12px_rgba(30,41,59,0.5)]">CORE</a>
                    <a href="https://ieeexplore.ieee.org/" target="_blank" class="mx-8 font-extrabold text-2xl tracking-tight text-slate-400 transition-all duration-300 hover:text-cyan-600 hover:drop-shadow-[0_0_12px_rgba(8,145,178,0.8)]">IEEE Xplore</a>
                    <a href="https://europepmc.org/" target="_blank" class="mx-8 font-extrabold text-2xl tracking-tight text-slate-400 transition-all duration-300 hover:text-teal-500 hover:drop-shadow-[0_0_12px_rgba(20,184,166,0.8)]">Europe PMC</a>
                    <a href="https://arxiv.org/" target="_blank" class="mx-8 font-extrabold text-2xl tracking-tight text-slate-400 transition-all duration-300 hover:text-red-600 hover:drop-shadow-[0_0_12px_rgba(220,38,38,0.8)]">arXiv</a>
                    <!-- Set 2 -->
                    <a href="https://www.crossref.org/" target="_blank" class="mx-8 font-extrabold text-2xl tracking-tight text-slate-400 transition-all duration-300 hover:text-blue-500 hover:drop-shadow-[0_0_12px_rgba(59,130,246,0.8)]">Crossref</a>
                    <a href="https://doaj.org/" target="_blank" class="mx-8 font-extrabold text-2xl tracking-tight text-slate-400 transition-all duration-300 hover:text-emerald-500 hover:drop-shadow-[0_0_12px_rgba(16,185,129,0.8)]">DOAJ</a>
                    <a href="https://www.semanticscholar.org/" target="_blank" class="mx-8 font-extrabold text-2xl tracking-tight text-slate-400 transition-all duration-300 hover:text-purple-500 hover:drop-shadow-[0_0_12px_rgba(168,85,247,0.8)]">Semantic Scholar</a>
                    <a href="https://openalex.org/" target="_blank" class="mx-8 font-extrabold text-2xl tracking-tight text-slate-400 transition-all duration-300 hover:text-orange-500 hover:drop-shadow-[0_0_12px_rgba(249,115,22,0.8)]">OpenAlex</a>
                    <a href="https://core.ac.uk/" target="_blank" class="mx-8 font-extrabold text-2xl tracking-tight text-slate-400 transition-all duration-300 hover:text-slate-800 hover:drop-shadow-[0_0_12px_rgba(30,41,59,0.5)]">CORE</a>
                    <a href="https://ieeexplore.ieee.org/" target="_blank" class="mx-8 font-extrabold text-2xl tracking-tight text-slate-400 transition-all duration-300 hover:text-cyan-600 hover:drop-shadow-[0_0_12px_rgba(8,145,178,0.8)]">IEEE Xplore</a>
                    <a href="https://europepmc.org/" target="_blank" class="mx-8 font-extrabold text-2xl tracking-tight text-slate-400 transition-all duration-300 hover:text-teal-500 hover:drop-shadow-[0_0_12px_rgba(20,184,166,0.8)]">Europe PMC</a>
                    <a href="https://arxiv.org/" target="_blank" class="mx-8 font-extrabold text-2xl tracking-tight text-slate-400 transition-all duration-300 hover:text-red-600 hover:drop-shadow-[0_0_12px_rgba(220,38,38,0.8)]">arXiv</a>
                </div>
            </div>
            </div>
            
            <style>
                .animate-marquee {
                    animation: marquee 35s linear infinite;
                }
                .animate-marquee2 {
                    animation: marquee2 35s linear infinite;
                }
                .pause-animation {
                    animation-play-state: paused;
                }
                @keyframes marquee {
                    0% { transform: translateX(0%); }
                    100% { transform: translateX(-100%); }
                }
                @keyframes marquee2 {
                    0% { transform: translateX(100%); }
                    100% { transform: translateX(0%); }
                }
                    @keyframes slide-up {
            0% { opacity: 0; transform: translateY(20px); }
            100% { opacity: 1; transform: translateY(0); }
        }
        .animate-slide-up {
            animation: slide-up 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }
    </style>
        </section>

        <!-- Popular Topics -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-extrabold text-slate-900 mb-4">Topik Populer</h2>
                <p class="text-slate-500 font-medium max-w-2xl mx-auto">Mulai eksplorasi Anda dari kategori riset paling dicari di ekosistem akademik kami.</p>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
                <a href="?q=Transportasi+%26+Multimoda" @click="startSearch()" class="bg-white rounded-2xl p-5 border border-slate-200 hover:border-[#1E3A8A] hover:shadow-md transition text-center group flex flex-col items-center">
                    <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center mb-3 group-hover:bg-[#1E3A8A] group-hover:text-white transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path></svg>
                    </div>
                    <h3 class="font-bold text-slate-800 text-sm">Transportasi & Multimoda</h3>
                </a>
                <a href="?q=Infrastruktur+Jalan" @click="startSearch()" class="bg-white rounded-2xl p-5 border border-slate-200 hover:border-[#1E3A8A] hover:shadow-md transition text-center group flex flex-col items-center">
                    <div class="w-12 h-12 bg-slate-50 text-slate-600 rounded-xl flex items-center justify-center mb-3 group-hover:bg-[#1E3A8A] group-hover:text-white transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path></svg>
                    </div>
                    <h3 class="font-bold text-slate-800 text-sm">Infrastruktur Jalan</h3>
                </a>
                <a href="?q=Otomotif+%26+Kendaraan+Listrik" @click="startSearch()" class="bg-white rounded-2xl p-5 border border-slate-200 hover:border-[#1E3A8A] hover:shadow-md transition text-center group flex flex-col items-center">
                    <div class="w-12 h-12 bg-amber-50 text-amber-600 rounded-xl flex items-center justify-center mb-3 group-hover:bg-[#1E3A8A] group-hover:text-white transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </div>
                    <h3 class="font-bold text-slate-800 text-sm">Otomotif & Kendaraan Listrik</h3>
                </a>
                <a href="?q=Energi+%26+Keberlanjutan" @click="startSearch()" class="bg-white rounded-2xl p-5 border border-slate-200 hover:border-[#1E3A8A] hover:shadow-md transition text-center group flex flex-col items-center">
                    <div class="w-12 h-12 bg-emerald-50 text-emerald-600 rounded-xl flex items-center justify-center mb-3 group-hover:bg-[#1E3A8A] group-hover:text-white transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path></svg>
                    </div>
                    <h3 class="font-bold text-slate-800 text-sm">Energi & Keberlanjutan</h3>
                </a>
                <a href="?q=AI,+IoT+%26+Big+Data" @click="startSearch()" class="bg-white rounded-2xl p-5 border border-slate-200 hover:border-[#1E3A8A] hover:shadow-md transition text-center group flex flex-col items-center">
                    <div class="w-12 h-12 bg-purple-50 text-purple-600 rounded-xl flex items-center justify-center mb-3 group-hover:bg-[#1E3A8A] group-hover:text-white transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"></path></svg>
                    </div>
                    <h3 class="font-bold text-slate-800 text-sm">AI, IoT & Big Data</h3>
                </a>
                <a href="?q=Keselamatan+Transportasi" @click="startSearch()" class="bg-white rounded-2xl p-5 border border-slate-200 hover:border-[#1E3A8A] hover:shadow-md transition text-center group flex flex-col items-center">
                    <div class="w-12 h-12 bg-rose-50 text-rose-600 rounded-xl flex items-center justify-center mb-3 group-hover:bg-[#1E3A8A] group-hover:text-white transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                    </div>
                    <h3 class="font-bold text-slate-800 text-sm">Keselamatan Transportasi</h3>
                </a>
            </div>
        </section>

        <!-- How It Works (Horizontal Timeline) -->
        <section class="bg-white py-16 border-y border-slate-200">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-3xl font-extrabold text-slate-900 mb-4">Cara Kerja</h2>
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
        </section>

        <!-- Why Use This Website -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-extrabold text-slate-900 mb-4">Mengapa Menggunakan Website Ini?</h2>
            </div>
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Card 1 -->
                <div class="bg-white p-8 rounded-2xl border border-slate-200 shadow-sm hover:shadow-lg transition-all duration-300 hover:-translate-y-1 h-full flex flex-col items-start text-left">
                    <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center mb-6">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 mb-3">One Search</h3>
                    <p class="text-slate-500 text-sm font-medium leading-relaxed">Cari di berbagai database sekaligus.</p>
                </div>
                <!-- Card 2 -->
                <div class="bg-white p-8 rounded-2xl border border-slate-200 shadow-sm hover:shadow-lg transition-all duration-300 hover:-translate-y-1 h-full flex flex-col items-start text-left">
                    <div class="w-12 h-12 bg-emerald-50 text-emerald-600 rounded-xl flex items-center justify-center mb-6">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M8 11V7a4 4 0 118 0m-4 8v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2z"></path></svg>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 mb-3">Open Access</h3>
                    <p class="text-slate-500 text-sm font-medium leading-relaxed">Prioritas hasil dari jurnal akses terbuka.</p>
                </div>
                <!-- Card 3 -->
                <div class="bg-white p-8 rounded-2xl border border-slate-200 shadow-sm hover:shadow-lg transition-all duration-300 hover:-translate-y-1 h-full flex flex-col items-start text-left">
                    <div class="w-12 h-12 bg-amber-50 text-amber-600 rounded-xl flex items-center justify-center mb-6">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 mb-3">Fast</h3>
                    <p class="text-slate-500 text-sm font-medium leading-relaxed">Pencarian real-time dari berbagai sumber.</p>
                </div>
                <!-- Card 4 -->
                <div class="bg-white p-8 rounded-2xl border border-slate-200 shadow-sm hover:shadow-lg transition-all duration-300 hover:-translate-y-1 h-full flex flex-col items-start text-left">
                    <div class="w-12 h-12 bg-purple-50 text-purple-600 rounded-xl flex items-center justify-center mb-6">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 mb-3">Reliable</h3>
                    <p class="text-slate-500 text-sm font-medium leading-relaxed">Data berasal dari database akademik terpercaya.</p>
                </div>
            </div>
        </section>
        
        @endif
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

    <!-- Scroll to Top Button -->
    <div x-data="{ showScroll: false }" @scroll.window="showScroll = (window.pageYOffset > 400)">
        <button x-show="showScroll" 
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-8"
                x-transition:enter-end="opacity-100 translate-y-0"
                x-transition:leave="transition ease-in duration-300"
                x-transition:leave-start="opacity-100 translate-y-0"
                x-transition:leave-end="opacity-0 translate-y-8"
                @click="window.scrollTo({top: 0, behavior: 'smooth'})" 
                class="fixed bottom-8 right-8 z-50 bg-[#FBBF24] text-[#1E3A8A] p-3.5 rounded-full shadow-xl hover:bg-amber-400 hover:scale-110 hover:shadow-amber-500/20 transition-all focus:outline-none"
                style="display: none;" title="Kembali ke Atas">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 10l7-7m0 0l7 7m-7-7v18"></path></svg>
        </button>
    </div>

    <!-- Loading Overlay -->
    <div x-show="isSearching" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 backdrop-blur-none"
         x-transition:enter-end="opacity-100 backdrop-blur-md"
         class="fixed inset-0 z-[100] flex items-center justify-center bg-white/60 backdrop-blur-md"
         style="display: none;">
        <div class="bg-white p-8 rounded-3xl shadow-2xl flex flex-col items-center max-w-sm w-full mx-4 border border-slate-100 relative overflow-hidden">
            <!-- Decorative background elements -->
            <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-[#1E3A8A] via-blue-400 to-[#1E3A8A] animate-pulse"></div>
            
            <div class="relative w-20 h-20 mb-6 flex items-center justify-center">
                <!-- Outer spinning ring -->
                <div class="absolute inset-0 border-4 border-slate-100 rounded-full"></div>
                <div class="absolute inset-0 border-4 border-[#1E3A8A] border-t-transparent rounded-full animate-spin"></div>
                <!-- Inner pulse -->
                <div class="absolute inset-0 flex items-center justify-center">
                    <span class="text-[#1E3A8A] font-extrabold text-sm" x-text="progress + '%'">0%</span>
                </div>
            </div>
            
            <h3 class="text-xl font-extrabold text-slate-800 mb-2 text-center" x-text="loadingTitle">Menyisir Database...</h3>
            <p class="text-sm text-slate-500 text-center font-medium leading-relaxed" x-text="loadingText">
                Menarik jutaan data jurnal secara real-time dari seluruh dunia. Mohon tunggu sebentar.
            </p>
        </div>
    </div>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('searchOverlay', () => ({
                isSearching: false,
                progress: 0,
                loadingTitle: 'Menyisir Database...',
                loadingText: 'Menarik jutaan data jurnal secara real-time dari seluruh dunia. Mohon tunggu sebentar.',
                init() {
                    window.addEventListener('pageshow', (event) => {
                        if (event.persisted) {
                            this.isSearching = false;
                        }
                    });
                },
                startSearch() {
                    this.loadingTitle = 'Menyisir Database...';
                    this.loadingText = 'Menarik jutaan data jurnal secara real-time dari seluruh dunia. Mohon tunggu sebentar.';
                    this.isSearching = true;
                    this.progress = 0;
                    
                    let interval = setInterval(() => {
                        if (this.progress < 85) {
                            this.progress += Math.floor(Math.random() * 15) + 5;
                            if (this.progress > 85) this.progress = 85;
                        } else if (this.progress < 98) {
                            this.progress += 1;
                        }
                    }, 400);
                },
                startDownload(format, url) {
                    this.loadingTitle = 'Menyiapkan File ' + format + '...';
                    this.loadingText = 'Sistem sedang merangkum dan mengekstrak puluhan jurnal terbaik untuk Anda. Mohon tunggu...';
                    this.isSearching = true;
                    this.progress = 0;
                    
                    let interval = setInterval(() => {
                        if (this.progress < 85) {
                            this.progress += Math.floor(Math.random() * 15) + 5;
                            if (this.progress > 85) this.progress = 85;
                        } else if (this.progress < 98) {
                            this.progress += 1;
                        }
                    }, 400);

                    fetch(url)
                        .then(response => {
                                                        let ext = '.txt';
                            if (format.toLowerCase() === 'csv') ext = '.csv';
                            if (format.toLowerCase() === 'json') ext = '.json';
                            if (format.toLowerCase() === 'bibtex') ext = '.bib';
                            
                            // Ambil query dari URL jika ada
                            let urlObj = new URL(url, window.location.origin);
                            let q = urlObj.searchParams.get('q') || 'Data';
                            q = q.replace(/[^a-z0-9]/gi, '_').toLowerCase();
                            
                            let dateStr = new Date().toISOString().replace(/T/, '_').replace(/\..+/, '').replace(/-/g, '').replace(/:/g, '');
                            let filename = 'Export_Jurnal_' + q + '_' + dateStr + ext;
                            let disposition = response.headers.get('content-disposition');
                            if (disposition && disposition.indexOf('attachment') !== -1) {
                                let filenameRegex = /filename[^;=\n]*=((['"]).*?\2|[^;\n]*)/;
                                let matches = filenameRegex.exec(disposition);
                                if (matches != null && matches[1]) { 
                                    filename = matches[1].replace(/['"]/g, '');
                                }
                            }
                            return response.blob().then(blob => ({ blob, filename }));
                        })
                        .then(({ blob, filename }) => {
                            this.progress = 100;
                            setTimeout(() => {
                                clearInterval(interval);
                                this.isSearching = false;
                                
                                const objectUrl = window.URL.createObjectURL(blob);
                                const a = document.createElement('a');
                                a.style.display = 'none';
                                a.href = objectUrl;
                                a.download = filename;
                                document.body.appendChild(a);
                                a.click();
                                window.URL.revokeObjectURL(objectUrl);
                            }, 500);
                        })
                        .catch(() => {
                            clearInterval(interval);
                            this.isSearching = false;
                            Swal.fire({icon:'error', title:'Oops...', text:'Gagal mengunduh file!'});
                        });
                }
            }))
        })
    </script>
<!-- Smart Background Prefetching -->
    @if(isset($articles) && $articles->total() > 0 && !request()->has('prefetch'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Tunggu 3 detik setelah halaman selesai dimuat agar tidak mengganggu kecepatan awal
            setTimeout(() => {
                let currentPage = {{ request('page', 1) }};
                let totalPages = {{ $articles->lastPage() ?? 1 }};
                
                // Siapkan 4 halaman ke depan dan 2 halaman ke belakang secara diam-diam
                let pagesToFetch = [];
                for(let i = 1; i <= 2; i++) { if(currentPage - i >= 1) pagesToFetch.push(currentPage - i); }
                for(let i = 1; i <= 4; i++) { if(currentPage + i <= totalPages) pagesToFetch.push(currentPage + i); }
                
                pagesToFetch.forEach(p => {
                    let url = new URL(window.location.href);
                    url.searchParams.set('page', p);
                    url.searchParams.set('prefetch', '1');
                    
                    fetch(url.toString(), {
                        priority: 'low'
                    }).catch(e => {}); // Abaikan error jika gagal prefetch
                });
            }, 3000);
        });
    </script>
    @endif
<!-- Floating Bookmark Button -->
<div class="fixed bottom-6 right-6 z-[60]">
    <button onclick="openBookmarkModal()" class="bg-[#1E3A8A] text-white p-4 rounded-full shadow-2xl hover:bg-blue-900 transition flex items-center gap-2 border-2 border-white/20">
        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"></path></svg>
        <span id="bookmark-count" class="font-bold bg-amber-400 text-[#1E3A8A] text-[13px] px-2.5 py-0.5 rounded-full shadow-inner">0</span>
    </button>
</div>

<!-- Bookmark Modal -->
<div id="bookmark-modal" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-[100] hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-3xl w-full max-w-2xl max-h-[80vh] flex flex-col shadow-2xl border border-slate-200">
        <div class="p-5 border-b flex justify-between items-center bg-[#F8FAFC] rounded-t-3xl">
            <h2 class="text-lg font-black text-[#1E3A8A] flex items-center gap-2"><svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"></path></svg> Koleksi Membaca Anda</h2>
            <button onclick="closeBookmarkModal()" class="text-slate-500 hover:text-red-500 bg-white p-1 rounded-full shadow-sm"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg></button>
        </div>
        <div class="p-6 overflow-y-auto flex-grow bg-white" id="bookmark-list">
        </div>
    </div>
</div>

<script>
    let bookmarks = JSON.parse(localStorage.getItem('pktj_bookmarks') || '[]');

    function updateBookmarkUI() {
        let countEl = document.getElementById('bookmark-count');
        if(countEl) countEl.innerText = bookmarks.length;
        
        document.querySelectorAll('[class*="bookmark-icon-"]').forEach(el => el.setAttribute('fill', 'none'));
        
        // Reset all detail buttons to white
        document.querySelectorAll('[class*="bookmark-btn-"]').forEach(el => {
            el.classList.add('bg-white', 'border-slate-200', 'text-slate-700', 'hover:bg-slate-50');
            el.classList.remove('bg-amber-50', 'border-amber-200', 'text-amber-700', 'hover:bg-amber-100');
        });

        bookmarks.forEach(b => {
            document.querySelectorAll('[class*="bookmark-icon-' + b.id + '"]').forEach(el => {
                el.setAttribute('fill', 'currentColor');
                el.classList.add('text-amber-500');
                el.classList.remove('text-slate-400');
            });
            document.querySelectorAll('[class*="bookmark-text-' + b.id + '"]').forEach(t => t.innerText = 'Tersimpan');
            
            // Set detail button to yellow
            document.querySelectorAll('[class*="bookmark-btn-' + b.id + '"]').forEach(el => {
                el.classList.remove('bg-white', 'border-slate-200', 'text-slate-700', 'hover:bg-slate-50');
                el.classList.add('bg-amber-50', 'border-amber-200', 'text-amber-700', 'hover:bg-amber-100');
            });
        });
    }

    function toggleBookmark(id, title, source = "Unknown") {
        let index = bookmarks.findIndex(b => b.id === id);
        if (index > -1) {
            bookmarks.splice(index, 1);
            document.querySelectorAll('[class*="bookmark-icon-' + id + '"]').forEach(el => {
                el.setAttribute('fill', 'none');
                el.classList.remove('text-amber-500');
                el.classList.add('text-slate-400');
            });
            document.querySelectorAll('[class*="bookmark-text-' + id + '"]').forEach(t => t.innerText = 'Simpan');
            document.querySelectorAll('[class*="bookmark-btn-' + id + '"]').forEach(el => {
                el.classList.add('bg-white', 'border-slate-200', 'text-slate-700', 'hover:bg-slate-50');
                el.classList.remove('bg-amber-50', 'border-amber-200', 'text-amber-700', 'hover:bg-amber-100');
            });
        } else {
                        bookmarks.push({id: id, title: title, source: source});
            // Track bookmark as engagement/download
            fetch('{{ url("/api/track") }}', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
                body: JSON.stringify({
                    type: 'bookmark_add',
                    repo: source,
                    title: title
                })
            }).catch(e => console.log(e));
        }
        localStorage.setItem('pktj_bookmarks', JSON.stringify(bookmarks));
        updateBookmarkUI();
    }

    function escapeHTML(str) {
        return (str || '').toString().replace(/[&<>'"]/g, 
            tag => ({
                '&': '&amp;',
                '<': '&lt;',
                '>': '&gt;',
                "'": '&#39;',
                '"': '&quot;'
            }[tag] || tag)
        );
    }

    function openBookmarkModal() {
        document.getElementById('bookmark-modal').classList.remove('hidden');
        let list = document.getElementById('bookmark-list');
        if (bookmarks.length === 0) {
            list.innerHTML = '<div class="text-center py-10 text-slate-500"><svg class="w-16 h-16 mx-auto mb-4 text-slate-200" fill="currentColor" viewBox="0 0 24 24"><path d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"></path></svg><h3 class="font-bold text-lg mb-1">Koleksi Masih Kosong</h3><p class="text-sm">Simpan jurnal menarik dengan mengklik ikon pita pada hasil pencarian.</p></div>';
            return;
        }
        
        let baseUrl = '{{ url('/') }}';

        list.innerHTML = bookmarks.map(b => `
            <div class="flex justify-between items-center p-4 border border-slate-100 rounded-xl mb-3 hover:bg-slate-50 transition shadow-sm">
                <a href="${baseUrl}/article/${b.id}" class="text-[13px] font-bold text-[#1E3A8A] hover:text-amber-600 line-clamp-2 w-5/6 transition leading-relaxed">${escapeHTML(b.title)}</a>
                <button onclick="toggleBookmark('${escapeHTML(b.id)}', '${escapeHTML(b.title).replace(/'/g, '\'')}'); openBookmarkModal()" class="text-red-400 hover:text-red-600 p-2 bg-red-50 hover:bg-red-100 rounded-lg transition" title="Hapus"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg></button>
            </div>
        `).join('');
    }

    function closeBookmarkModal() {
        document.getElementById('bookmark-modal').classList.add('hidden');
    }

    document.addEventListener('DOMContentLoaded', updateBookmarkUI);
</script>
</body>
</html>