<?php
$file = 'c:\\xampp\\htdocs\\jurnalagregator\\resources\\views\\search.blade.php';

$content = <<<'EOD'
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="referrer" content="no-referrer">
    <title>Temukan Referensi Ilmiah dengan Mudah - Perpustakaan PKTJ</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-[#F8FAFC] text-slate-800 min-h-screen flex flex-col">

    <!-- Navbar -->
    <header class="bg-white/80 backdrop-blur-md border-b border-slate-200 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <img src="{{ asset('logo.png') }}" alt="Logo PKTJ" class="h-10 w-auto object-contain" onerror="this.outerHTML='<div class=\'w-10 h-10 bg-[#1E3A8A] rounded-xl flex items-center justify-center text-white font-bold text-xl shadow-sm\'>P</div>'">
                <div class="flex flex-col">
                    <h1 class="text-lg font-extrabold text-[#1E3A8A] tracking-tight leading-tight">AGREGATOR JURNAL</h1>
                    <span class="text-[0.65rem] text-slate-500 font-bold tracking-wider uppercase">PERPUSTAKAAN PKTJ</span>
                </div>
            </div>
            <nav class="hidden md:flex gap-8 text-sm font-semibold text-slate-600">
                <a href="{{ route('search.index') }}" class="text-[#1E3A8A] hover:text-[#1E3A8A] transition">Beranda</a>
                <a href="#" class="hover:text-[#1E3A8A] transition">Cara Menggunakan</a>
                <a href="#" class="hover:text-[#1E3A8A] transition">FAQ</a>
                <a href="{{ route('about') }}" class="hover:text-[#1E3A8A] transition">Tentang</a>
            </nav>
            <!-- Mobile Menu Button (Optional placeholder) -->
            <button class="md:hidden text-slate-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
            </button>
        </div>
    </header>

    <main class="flex-grow w-full">
        @if(request()->anyFilled(['q', 'cluster', 'year_from', 'year_to', 'language']))
        <!-- ============================================== -->
        <!-- HASIL PENCARIAN VIEW                           -->
        <!-- ============================================== -->
        <div class="bg-white border-b border-slate-200 py-6">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <form action="{{ route('search.index') }}" method="GET" x-data="{ showFilters: {{ request()->hasAny(['year_from', 'year_to', 'language']) && (request('year_from') || request('year_to') || (request('language') && request('language') !== 'all')) ? 'true' : 'false' }} }" class="w-full max-w-4xl relative">
                    <div class="flex flex-col md:flex-row gap-3 bg-[#F8FAFC] p-1.5 rounded-2xl border border-slate-200 shadow-sm items-center">
                        <div class="relative flex-1 w-full">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                            </div>
                            <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari topik, judul, penulis, atau DOI..." 
                                   class="w-full pl-11 pr-4 py-3 bg-transparent focus:outline-none text-slate-800 placeholder-slate-400 font-medium text-sm">
                        </div>
                        <div class="flex gap-2 w-full md:w-auto">
                            <button type="button" @click="showFilters = !showFilters" class="flex-1 md:flex-none text-sm font-semibold text-slate-600 bg-white border border-slate-200 hover:border-[#1E3A8A] hover:text-[#1E3A8A] transition px-4 py-3 rounded-xl shadow-sm flex items-center justify-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path></svg>
                            </button>
                            <button type="submit" class="flex-1 md:flex-none bg-[#1E3A8A] hover:bg-blue-900 text-white font-bold py-3 px-6 rounded-xl shadow-md transition-all flex items-center justify-center gap-2 text-sm">
                                Cari
                            </button>
                        </div>
                    </div>

                    <!-- Advanced Filters Dropdown -->
                    <div x-show="showFilters" x-transition class="mt-2 bg-white border border-slate-200 rounded-2xl p-5 shadow-lg absolute w-full z-20" style="display: none;">
                        <div class="grid grid-cols-1 md:grid-cols-5 gap-4 items-end">
                            <div>
                                <label class="block text-xs font-bold text-slate-500 mb-1.5">Tahun Dari</label>
                                <input type="number" name="year_from" value="{{ request('year_from') }}" placeholder="Contoh: 2015" class="w-full bg-[#F8FAFC] border border-slate-200 text-slate-800 py-2.5 px-3 rounded-lg focus:ring-2 focus:ring-[#1E3A8A]/20 focus:border-[#1E3A8A] transition text-sm">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-slate-500 mb-1.5">Tahun Sampai</label>
                                <input type="number" name="year_to" value="{{ request('year_to') }}" placeholder="Contoh: 2026" class="w-full bg-[#F8FAFC] border border-slate-200 text-slate-800 py-2.5 px-3 rounded-lg focus:ring-2 focus:ring-[#1E3A8A]/20 focus:border-[#1E3A8A] transition text-sm">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-slate-500 mb-1.5">Bahasa</label>
                                <select name="language" class="w-full bg-[#F8FAFC] border border-slate-200 text-slate-800 py-2.5 px-3 rounded-lg focus:ring-2 focus:ring-[#1E3A8A]/20 focus:border-[#1E3A8A] transition text-sm">
                                    <option value="all" {{ request('language') == 'all' ? 'selected' : '' }}>Semua</option>
                                    <option value="id" {{ request('language') == 'id' ? 'selected' : '' }}>Indonesia</option>
                                    <option value="en" {{ request('language') == 'en' ? 'selected' : '' }}>Inggris</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-slate-500 mb-1.5">Urutkan</label>
                                <select name="sort" class="w-full bg-[#F8FAFC] border border-slate-200 text-slate-800 py-2.5 px-3 rounded-lg focus:ring-2 focus:ring-[#1E3A8A]/20 focus:border-[#1E3A8A] transition text-sm">
                                    <option value="relevansi" {{ request('sort') == 'relevansi' ? 'selected' : '' }}>Relevansi</option>
                                    <option value="terbaru" {{ request('sort') == 'terbaru' ? 'selected' : '' }}>Terbaru</option>
                                    <option value="terlama" {{ request('sort') == 'terlama' ? 'selected' : '' }}>Terlama</option>
                                    <option value="sitasi" {{ request('sort') == 'sitasi' ? 'selected' : '' }}>Sitasi</option>
                                </select>
                            </div>
                            <div>
                                <button type="submit" class="w-full bg-[#FBBF24] hover:bg-amber-500 text-slate-900 font-bold py-2.5 px-4 rounded-lg shadow-sm transition text-sm">Terapkan</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 w-full">
            <section>
                <div class="mb-6 flex justify-between items-end border-b border-slate-200 pb-2">
                    <h2 class="text-xl font-extrabold text-slate-800">
                        Hasil Pencarian
                    </h2>
                    <span class="text-sm text-slate-500 font-medium">Menampilkan {{ $articles->firstItem() ?? 0 }}-{{ $articles->lastItem() ?? 0 }} dari {{ $articles->total() }}</span>
                </div>

                <div class="space-y-6">
                    @forelse($articles as $article)
                        <article class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200 hover:shadow-md transition duration-200">
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

                            <a href="{{ $article->source_url }}" target="_blank" class="block mb-2 group">
                                <h3 class="text-lg md:text-xl font-bold text-slate-900 group-hover:text-[#1E3A8A] transition leading-snug">
                                    {{ $article->title }}
                                </h3>
                            </a>

                            <div class="flex items-center gap-2 mb-4 text-sm text-slate-500 font-medium">
                                @if($article->authors->count() > 1)
                                    <svg class="w-4 h-4 text-blue-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                @else
                                    <svg class="w-4 h-4 text-blue-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                @endif
                                <span class="truncate">
                                    @if($article->authors->count() > 0)
                                        {{ $article->authors->pluck('name')->implode(', ') }}
                                    @else
                                        <i class="text-slate-400">Penulis tidak diketahui</i>
                                    @endif
                                </span>
                            </div>

                            <div class="mb-5" x-data="{ expanded: false }">
                                <p class="text-slate-600 text-sm leading-relaxed font-medium" :class="expanded ? '' : 'line-clamp-2 md:line-clamp-3'">
                                    {{ $article->abstract ?? 'Abstrak tidak tersedia untuk artikel ini.' }}
                                </p>
                                @if($article->abstract && strlen($article->abstract) > 250)
                                    <button @click="expanded = !expanded" class="text-[#1E3A8A] text-xs font-bold mt-1.5 hover:underline">
                                        <span x-text="expanded ? 'Tampilkan Lebih Sedikit' : 'Baca Selengkapnya'"></span>
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
                                    @if($article->pdf_url)
                                    <a href="{{ $article->pdf_url }}" target="_blank" rel="noreferrer noopener" class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-emerald-50 text-emerald-700 hover:bg-emerald-100 border border-emerald-200 text-xs font-bold rounded-lg transition">
                                        PDF
                                    </a>
                                    @endif
                                    @if($article->doi)
                                    @php $doiUrl = str_starts_with($article->doi, 'http') ? $article->doi : 'https://doi.org/' . $article->doi; @endphp
                                    <a href="{{ $doiUrl }}" target="_blank" rel="noreferrer noopener" class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-white border border-slate-200 hover:border-slate-300 hover:bg-slate-50 text-slate-700 text-xs font-bold rounded-lg transition">
                                        DOI
                                    </a>
                                    @endif
                                    @if($article->source_url)
                                    <a href="{{ $article->source_url }}" target="_blank" rel="noreferrer noopener" class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-white border border-slate-200 hover:border-slate-300 hover:bg-slate-50 text-slate-700 text-xs font-bold rounded-lg transition">
                                        Sumber
                                    </a>
                                    @endif
                                </div>
                            </div>
                        </article>
                    @empty
                        <div class="text-center py-16 bg-white rounded-2xl border border-dashed border-slate-300">
                            <h3 class="text-lg font-bold text-slate-900">Tidak ada artikel ditemukan</h3>
                            <p class="mt-1 text-sm text-slate-500 font-medium">Coba gunakan kata kunci lain atau longgarkan filter pencarian Anda.</p>
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
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-24 relative overflow-hidden">
            <div class="grid lg:grid-cols-2 gap-12 items-center relative z-10">
                <!-- Left: Text & Search -->
                <div class="max-w-2xl">
                    <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-white border border-slate-200 text-slate-600 shadow-sm text-xs font-bold mb-6">
                        <span class="w-2 h-2 rounded-full bg-[#1E3A8A] animate-pulse"></span>
                        Sistem Pencarian Terpusat
                    </div>
                    <h1 class="text-4xl md:text-5xl lg:text-[3.5rem] font-extrabold text-slate-900 tracking-tight leading-[1.1] mb-6">
                        Temukan <span class="text-[#1E3A8A]">Referensi Ilmiah</span> dengan Mudah
                    </h1>
                    <p class="text-lg text-slate-600 mb-10 leading-relaxed font-medium max-w-lg">
                        Cari jutaan artikel ilmiah dari berbagai database terpercaya hanya dengan satu kali pencarian.
                    </p>

                    <!-- Form Pencarian -->
                    <form action="{{ route('search.index') }}" method="GET" x-data="{ showFilters: false }" class="relative z-20">
                        <div class="flex flex-col sm:flex-row gap-2 bg-white p-2 rounded-2xl border border-slate-200 shadow-xl shadow-slate-200/50">
                            <div class="relative flex-1 w-full">
                                <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none">
                                    <svg class="h-6 w-6 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                </div>
                                <input type="text" name="q" placeholder="Cari topik, judul, penulis, atau DOI..." 
                                       class="w-full pl-14 pr-4 py-4 bg-transparent focus:outline-none text-slate-800 placeholder-slate-400 font-semibold text-base">
                            </div>
                            <div class="flex gap-2">
                                <button type="button" @click="showFilters = !showFilters" class="px-5 py-4 rounded-xl bg-slate-50 border border-slate-100 text-slate-500 hover:bg-slate-100 hover:text-[#1E3A8A] transition flex items-center justify-center" title="Filter Lanjutan">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path></svg>
                                </button>
                                <button type="submit" class="px-8 py-4 rounded-xl bg-[#1E3A8A] hover:bg-blue-900 text-white font-bold transition shadow-md flex items-center justify-center gap-2 whitespace-nowrap">
                                    Cari Jurnal
                                </button>
                            </div>
                        </div>
                    </form>

                    <div class="mt-8">
                        <span class="text-sm font-semibold text-slate-500 mr-2 block mb-3 sm:inline-block sm:mb-0">Contoh pencarian:</span>
                        <div class="inline-flex flex-wrap gap-2">
                            <a href="?q=Machine+Learning" class="px-3 py-1.5 rounded-lg bg-white border border-slate-200 text-xs font-semibold text-slate-600 hover:border-[#1E3A8A] hover:text-[#1E3A8A] shadow-sm transition">Machine Learning</a>
                            <a href="?q=Keselamatan+Transportasi" class="px-3 py-1.5 rounded-lg bg-white border border-slate-200 text-xs font-semibold text-slate-600 hover:border-[#1E3A8A] hover:text-[#1E3A8A] shadow-sm transition">Keselamatan Transportasi</a>
                            <a href="?q=Artificial+Intelligence" class="px-3 py-1.5 rounded-lg bg-white border border-slate-200 text-xs font-semibold text-slate-600 hover:border-[#1E3A8A] hover:text-[#1E3A8A] shadow-sm transition">Artificial Intelligence</a>
                            <a href="?q=Road+Safety" class="px-3 py-1.5 rounded-lg bg-white border border-slate-200 text-xs font-semibold text-slate-600 hover:border-[#1E3A8A] hover:text-[#1E3A8A] shadow-sm transition">Road Safety</a>
                            <a href="?q=Big+Data" class="px-3 py-1.5 rounded-lg bg-white border border-slate-200 text-xs font-semibold text-slate-600 hover:border-[#1E3A8A] hover:text-[#1E3A8A] shadow-sm transition">Big Data</a>
                            <a href="?q=Education" class="px-3 py-1.5 rounded-lg bg-white border border-slate-200 text-xs font-semibold text-slate-600 hover:border-[#1E3A8A] hover:text-[#1E3A8A] shadow-sm transition">Education</a>
                        </div>
                    </div>
                </div>
                
                <!-- Right: Illustration -->
                <div class="hidden lg:flex justify-end relative z-10">
                    <div class="absolute inset-0 bg-blue-100 rounded-full blur-3xl opacity-60 transform translate-x-10 translate-y-10"></div>
                    <div class="relative w-full max-w-sm aspect-square bg-white rounded-[2.5rem] shadow-2xl shadow-slate-200 border border-slate-100 p-8 flex flex-col justify-between overflow-hidden transform rotate-2 hover:rotate-0 transition duration-500">
                        <div class="flex justify-between items-start">
                            <div class="w-16 h-16 bg-[#1E3A8A] rounded-2xl flex items-center justify-center shadow-lg">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                            </div>
                            <div class="px-4 py-1.5 bg-amber-100 text-amber-700 rounded-full text-xs font-bold shadow-sm">AI Powered</div>
                        </div>
                        <div class="space-y-4 relative z-10 mt-6">
                            <div class="w-3/4 h-3 bg-slate-100 rounded-full"></div>
                            <div class="w-full h-3 bg-slate-100 rounded-full"></div>
                            <div class="w-5/6 h-3 bg-slate-100 rounded-full"></div>
                        </div>
                        <div class="flex gap-4 mt-8">
                            <div class="flex-1 bg-slate-50 rounded-xl border border-slate-100 p-4">
                                <div class="flex items-center gap-3 mb-2">
                                    <div class="w-6 h-6 rounded-full bg-blue-200"></div>
                                    <div class="w-1/2 h-2.5 bg-slate-200 rounded-full"></div>
                                </div>
                                <div class="w-full h-2 bg-slate-200 rounded-full mt-3"></div>
                                <div class="w-2/3 h-2 bg-slate-200 rounded-full mt-2"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Statistics Section -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 relative z-20">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 sm:gap-6">
                <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm hover:shadow-md transition group">
                    <div class="w-10 h-10 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center mb-4 group-hover:bg-[#1E3A8A] group-hover:text-white transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                    </div>
                    <h3 class="text-2xl font-black text-slate-900 mb-1">8+</h3>
                    <p class="text-sm font-semibold text-slate-500">Database Terhubung</p>
                </div>
                <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm hover:shadow-md transition group">
                    <div class="w-10 h-10 bg-emerald-50 text-emerald-600 rounded-xl flex items-center justify-center mb-4 group-hover:bg-emerald-500 group-hover:text-white transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    </div>
                    <h3 class="text-2xl font-black text-slate-900 mb-1">Jutaan+</h3>
                    <p class="text-sm font-semibold text-slate-500">Artikel Ilmiah</p>
                </div>
                <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm hover:shadow-md transition group">
                    <div class="w-10 h-10 bg-amber-50 text-amber-600 rounded-xl flex items-center justify-center mb-4 group-hover:bg-amber-500 group-hover:text-white transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"></path></svg>
                    </div>
                    <h3 class="text-2xl font-black text-slate-900 mb-1">Gratis</h3>
                    <p class="text-sm font-semibold text-slate-500">Tanpa Registrasi</p>
                </div>
                <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm hover:shadow-md transition group">
                    <div class="w-10 h-10 bg-purple-50 text-purple-600 rounded-xl flex items-center justify-center mb-4 group-hover:bg-purple-500 group-hover:text-white transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </div>
                    <h3 class="text-2xl font-black text-slate-900 mb-1">Realtime</h3>
                    <p class="text-sm font-semibold text-slate-500">Pencarian Cepat</p>
                </div>
            </div>
        </section>

        <!-- Trust Section -->
        <section class="border-y border-slate-200 bg-white py-12 mt-10">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h3 class="text-sm font-bold text-slate-400 uppercase tracking-widest mb-8">Didukung Database Ilmiah Terpercaya</h3>
                <div class="flex flex-wrap justify-center items-center gap-8 md:gap-12 opacity-60 grayscale hover:grayscale-0 transition duration-300">
                    <!-- Text representation for logos to keep it clean, as we don't have SVG images for all -->
                    <span class="font-extrabold text-xl text-slate-700">Crossref</span>
                    <span class="font-extrabold text-xl text-slate-700">DOAJ</span>
                    <span class="font-extrabold text-xl text-slate-700">OpenAlex</span>
                    <span class="font-extrabold text-xl text-slate-700">Semantic Scholar</span>
                    <span class="font-extrabold text-xl text-slate-700">CORE</span>
                    <span class="font-extrabold text-xl text-slate-700">IEEE Xplore</span>
                    <span class="font-extrabold text-xl text-slate-700">Europe PMC</span>
                    <span class="font-extrabold text-xl text-slate-700">arXiv</span>
                </div>
            </div>
        </section>

        <!-- Popular Topics -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-extrabold text-slate-900 mb-4">Topik Populer</h2>
                <p class="text-slate-500 font-medium max-w-2xl mx-auto">Mulai eksplorasi Anda dari kategori riset paling dicari di ekosistem akademik kami.</p>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
                <a href="?q=Keselamatan+Transportasi" class="bg-white rounded-2xl p-5 border border-slate-200 hover:border-[#1E3A8A] hover:shadow-md transition text-center group">
                    <div class="text-3xl mb-3 transform group-hover:scale-110 transition">🚗</div>
                    <h3 class="font-bold text-slate-800 text-sm">Keselamatan Transportasi</h3>
                </a>
                <a href="?q=Artificial+Intelligence" class="bg-white rounded-2xl p-5 border border-slate-200 hover:border-[#1E3A8A] hover:shadow-md transition text-center group">
                    <div class="text-3xl mb-3 transform group-hover:scale-110 transition">🤖</div>
                    <h3 class="font-bold text-slate-800 text-sm">Artificial Intelligence</h3>
                </a>
                <a href="?q=Teknik" class="bg-white rounded-2xl p-5 border border-slate-200 hover:border-[#1E3A8A] hover:shadow-md transition text-center group">
                    <div class="text-3xl mb-3 transform group-hover:scale-110 transition">⚙️</div>
                    <h3 class="font-bold text-slate-800 text-sm">Teknik</h3>
                </a>
                <a href="?q=Kesehatan" class="bg-white rounded-2xl p-5 border border-slate-200 hover:border-[#1E3A8A] hover:shadow-md transition text-center group">
                    <div class="text-3xl mb-3 transform group-hover:scale-110 transition">🏥</div>
                    <h3 class="font-bold text-slate-800 text-sm">Kesehatan</h3>
                </a>
                <a href="?q=Pendidikan" class="bg-white rounded-2xl p-5 border border-slate-200 hover:border-[#1E3A8A] hover:shadow-md transition text-center group">
                    <div class="text-3xl mb-3 transform group-hover:scale-110 transition">📚</div>
                    <h3 class="font-bold text-slate-800 text-sm">Pendidikan</h3>
                </a>
                <a href="?q=Manajemen" class="bg-white rounded-2xl p-5 border border-slate-200 hover:border-[#1E3A8A] hover:shadow-md transition text-center group">
                    <div class="text-3xl mb-3 transform group-hover:scale-110 transition">📈</div>
                    <h3 class="font-bold text-slate-800 text-sm">Manajemen</h3>
                </a>
            </div>
        </section>

        <!-- How It Works -->
        <section class="bg-white py-20 border-y border-slate-200">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h2 class="text-3xl font-extrabold text-slate-900 mb-16">Cara Kerja</h2>
                <div class="grid md:grid-cols-3 gap-8 relative">
                    <!-- Line connecting steps on desktop -->
                    <div class="hidden md:block absolute top-8 left-[15%] right-[15%] h-0.5 bg-slate-100 z-0"></div>
                    
                    <div class="relative z-10 flex flex-col items-center">
                        <div class="w-16 h-16 bg-[#F8FAFC] border-2 border-slate-200 rounded-2xl flex items-center justify-center text-xl font-black text-slate-700 mb-6 shadow-sm">1</div>
                        <h3 class="text-lg font-bold text-slate-900 mb-2">Masukkan Kata Kunci</h3>
                        <p class="text-slate-500 text-sm font-medium">Ketik topik atau judul di kolom pencarian.</p>
                    </div>
                    
                    <div class="relative z-10 flex flex-col items-center">
                        <div class="w-16 h-16 bg-blue-50 border-2 border-blue-200 rounded-2xl flex items-center justify-center text-xl font-black text-blue-700 mb-6 shadow-sm transform md:-translate-y-2">2</div>
                        <h3 class="text-lg font-bold text-slate-900 mb-2">Pilih Jurnal</h3>
                        <p class="text-slate-500 text-sm font-medium">Bandingkan hasil dari 8 database sekaligus.</p>
                    </div>
                    
                    <div class="relative z-10 flex flex-col items-center">
                        <div class="w-16 h-16 bg-emerald-50 border-2 border-emerald-200 rounded-2xl flex items-center justify-center text-xl font-black text-emerald-700 mb-6 shadow-sm">3</div>
                        <h3 class="text-lg font-bold text-slate-900 mb-2">Baca & Unduh</h3>
                        <p class="text-slate-500 text-sm font-medium">Akses sumber asli atau PDF secara langsung.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Why Use Us -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-extrabold text-slate-900 mb-4">Mengapa Menggunakan Website Ini?</h2>
            </div>
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="bg-white p-8 rounded-3xl border border-slate-200 shadow-sm hover:shadow-lg transition">
                    <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center mb-6">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 mb-3">One Search</h3>
                    <p class="text-slate-500 text-sm font-medium leading-relaxed">Cari di banyak database sekaligus, hemat waktu riset literatur Anda.</p>
                </div>
                <div class="bg-white p-8 rounded-3xl border border-slate-200 shadow-sm hover:shadow-lg transition">
                    <div class="w-12 h-12 bg-emerald-50 text-emerald-600 rounded-xl flex items-center justify-center mb-6">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 11V7a4 4 0 118 0m-4 8v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2z"></path></svg>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 mb-3">Open Access</h3>
                    <p class="text-slate-500 text-sm font-medium leading-relaxed">Fokus pada penemuan jurnal gratis yang bisa diunduh lebih cepat.</p>
                </div>
                <div class="bg-white p-8 rounded-3xl border border-slate-200 shadow-sm hover:shadow-lg transition">
                    <div class="w-12 h-12 bg-amber-50 text-amber-600 rounded-xl flex items-center justify-center mb-6">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 mb-3">Fast</h3>
                    <p class="text-slate-500 text-sm font-medium leading-relaxed">Hasil pencarian real-time langsung ditarik dari API global.</p>
                </div>
                <div class="bg-white p-8 rounded-3xl border border-slate-200 shadow-sm hover:shadow-lg transition">
                    <div class="w-12 h-12 bg-purple-50 text-purple-600 rounded-xl flex items-center justify-center mb-6">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 mb-3">Reliable</h3>
                    <p class="text-slate-500 text-sm font-medium leading-relaxed">Data berasal langsung dari database ilmiah terpercaya berskala dunia.</p>
                </div>
            </div>
        </section>
        
        @endif
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-slate-200 mt-auto">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8 mb-8">
                <div class="lg:col-span-2">
                    <div class="flex items-center gap-3 mb-4">
                        <img src="{{ asset('logo.png') }}" alt="Logo PKTJ" class="h-8 w-auto object-contain" onerror="this.outerHTML='<div class=\'w-8 h-8 bg-[#1E3A8A] rounded-lg flex items-center justify-center text-white font-bold text-sm shadow-sm\'>P</div>'">
                        <span class="font-extrabold text-slate-900">Perpustakaan PKTJ</span>
                    </div>
                    <p class="text-slate-500 text-sm font-medium leading-relaxed max-w-sm">
                        Politeknik Keselamatan Transportasi Jalan.<br>
                        Kementerian Perhubungan Republik Indonesia.
                    </p>
                </div>
                <div>
                    <h4 class="font-bold text-slate-900 mb-4">Quick Links</h4>
                    <ul class="space-y-2 text-sm font-medium text-slate-500">
                        <li><a href="#" class="hover:text-[#1E3A8A] transition">Beranda</a></li>
                        <li><a href="#" class="hover:text-[#1E3A8A] transition">Cara Menggunakan</a></li>
                        <li><a href="{{ route('about') }}" class="hover:text-[#1E3A8A] transition">Tentang Kami</a></li>
                        <li><a href="#" class="hover:text-[#1E3A8A] transition">FAQ</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold text-slate-900 mb-4">Contact</h4>
                    <ul class="space-y-2 text-sm font-medium text-slate-500">
                        <li>info@pktj.ac.id</li>
                        <li>(0283) 351061</li>
                        <li>Tegal, Jawa Tengah</li>
                    </ul>
                </div>
            </div>
            <div class="pt-8 border-t border-slate-100 flex flex-col md:flex-row items-center justify-between gap-4">
                <p class="text-xs font-semibold text-slate-400">
                    &copy; {{ date('Y') }} Perpustakaan PKTJ. All rights reserved.
                </p>
                <div class="flex gap-4 text-xs font-semibold text-slate-400">
                    <a href="#" class="hover:text-slate-600">Privacy Policy</a>
                    <a href="#" class="hover:text-slate-600">Terms of Service</a>
                </div>
            </div>
        </div>
    </footer>

</body>
</html>
EOD;

file_put_contents($file, $content);
echo "File created successfully.\n";
