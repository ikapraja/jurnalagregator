<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
        <!-- SEO & OpenGraph -->
    <meta property="og:title" content="{{ $article->title }} - Agregator Jurnal PKTJ" />
    <meta property="og:description" content="{{ Str::limit(strip_tags($article->abstract ?? 'Baca selengkapnya di Agregator Jurnal PKTJ'), 150) }}" />
    <meta property="og:image" content="{{ asset('logodashboard.png') }}" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta name="twitter:card" content="summary_large_image" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="referrer" content="no-referrer">
    <title>{{ $article->title }} - Agregator Jurnal PKTJ</title>
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

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('logodashboard.png') }}">
</head>
<body class="bg-[#F8FAFC] text-slate-800 min-h-screen flex flex-col">

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

    <!-- Navbar -->
    <header class="bg-white/80 backdrop-blur-md border-b border-slate-200 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex items-center justify-between">
            <a href="{{ route('search.index') }}" class="flex items-center gap-3">
                <img src="{{ asset('logo.png') }}" alt="Logo PKTJ" class="h-10 w-auto object-contain" onerror="this.outerHTML='<div class=\'w-10 h-10 bg-[#1E3A8A] rounded-xl flex items-center justify-center text-white font-bold text-xl shadow-sm\'>P</div>'">
                <div class="flex flex-col">
                    <h1 class="text-lg font-extrabold text-[#1E3A8A] tracking-tight leading-tight">AGREGATOR JURNAL</h1>
                    <span class="text-[0.65rem] text-slate-500 font-bold tracking-wider uppercase">PERPUSTAKAAN POLITEKNIK KESELAMATAN TRANSPORTASI JALAN</span>
                </div>
            </a>
            <nav class="hidden md:flex gap-8 text-sm font-semibold text-slate-600">
                <a href="{{ route('search.index') }}" class="text-[#1E3A8A] hover:text-[#1E3A8A] transition">Beranda</a>
                <a href="{{ route('how-to-use') }}" class="hover:text-[#1E3A8A] transition">Cara Menggunakan</a>
                <a href="{{ route('faq') }}" class="hover:text-[#1E3A8A] transition">FAQ</a>
                <a href="{{ route('about') }}" class="hover:text-[#1E3A8A] transition">Tentang</a>
            </nav>
            <button class="md:hidden text-slate-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
            </button>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow w-full pb-16">
        
        <!-- Hero Title Section -->
        <div class="relative bg-[#1E3A8A] overflow-hidden text-white border-b border-blue-900 py-6 shadow-sm z-10">
            <div class="absolute inset-0 bg-[radial-gradient(#ffffff_1px,transparent_1px)] [background-size:24px_24px] opacity-10"></div>
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <!-- Breadcrumb -->
                <div class="flex items-center gap-2 text-xs font-semibold mb-6 text-blue-200">
                    <a href="{{ route('search.index') }}" class="hover:text-white flex items-center gap-1 transition">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                        Beranda
                    </a>
                    <span class="opacity-50">/</span>
                    @php
                        $searchUrl = session('last_search_url', route('search.index'));
                    @endphp
                    <a href="{{ $searchUrl }}" class="hover:text-white transition">Pencarian</a>
                    <span class="opacity-50">/</span>
                    <span class="text-white truncate max-w-[200px]">{{ Str::limit($article->title, 30) }}</span>
                </div>
                
                <!-- Badges -->
                <div class="flex flex-wrap gap-2 mb-5">
                    <span class="bg-white/10 text-white px-3 py-1.5 rounded-lg text-xs font-bold border border-white/20 flex items-center gap-1.5 backdrop-blur-sm">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                        {{ is_object($article->repository ?? null) ? ($article->repository->name ?? 'Repositori Internal') : ($article->repository ?? 'Repositori Internal') }}
                    </span>
                    <span class="bg-amber-400/20 text-amber-300 px-3 py-1.5 rounded-lg text-xs font-bold border border-amber-400/30 flex items-center gap-1.5 backdrop-blur-sm">
                        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path></svg>
                        Open Access
                    </span>
                    <span class="bg-white/10 text-white px-3 py-1.5 rounded-lg text-xs font-bold border border-white/20 backdrop-blur-sm">
                        {{ $article->publication_year ?? 'Tahun T/A' }}
                    </span>
                    <span class="bg-white/10 text-white px-3 py-1.5 rounded-lg text-xs font-bold border border-white/20 flex items-center gap-1.5 backdrop-blur-sm">
                        <svg class="w-3.5 h-3.5 text-amber-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        {{ $article->citation_count ?? 0 }} sitasi
                    </span>
                </div>

                <h1 class="text-3xl md:text-4xl lg:text-5xl font-extrabold leading-[1.2] tracking-tight mb-6 text-white">
                    {{ $article->title }}
                </h1>

                <!-- Authors in Header -->
                <div class="flex flex-wrap items-center gap-4 text-sm font-semibold text-blue-100">
                    @forelse($article->authors ?? [] as $author)
                        @php
                            $parts = explode(' ', $author->name);
                            $last = array_pop($parts);
                            $initials = '';
                            foreach($parts as $part) {
                                if(strlen($part) > 0) $initials .= strtoupper($part[0]) . '. ';
                            }
                            $formattedName = $initials . $last;
                        @endphp
                        <span class="flex items-center gap-1.5">
                            <svg class="w-4 h-4 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            {{ $formattedName }}
                        </span>
                    @empty
                        <span class="italic text-blue-300/70">Penulis tidak diketahui</span>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Toolbar Bar (Floating Below Header) -->
        <div class="bg-white/80 backdrop-blur-md border-b border-slate-200 shadow-sm sticky top-[73px] sm:top-[73px] z-40" x-data="{ 
        copiedLink: false, 
        copyLink() { 
            fetch('{{ url("/api/track") }}', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
                body: JSON.stringify({
                    type: 'share_link',
                    repo: '{{ isset($article->repository) && is_object($article->repository) ? $article->repository->name : 'Agregator' }}',
                    title: '{{ addslashes(Str::limit($article->title, 100)) }}'
                })
            }).catch(e => console.log(e));

            if (navigator.share) {
                navigator.share({
                    title: '{{ addslashes(Str::limit($article->title, 100)) }}',
                    text: 'Baca jurnal menarik ini di Agregator Jurnal PKTJ:',
                    url: window.location.href
                }).catch(console.error);
            } else {
                navigator.clipboard.writeText(window.location.href); 
                this.copiedLink = true; 
                setTimeout(() => this.copiedLink = false, 2000); 
            }
        } 
    }">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3 flex flex-wrap items-center justify-between gap-3">
                <div class="flex items-center gap-2">
                    @if($article->source_url)
                    <a href="{{ route('track.redirect', ['url' => $article->source_url, 'repo' => $article->repository->name ?? 'Lokal', 'type' => 'click_source', 'title' => $article->title]) }}" target="_blank" rel="noreferrer noopener" class="inline-flex items-center gap-1.5 px-4 py-2 bg-[#1E3A8A] hover:bg-blue-900 text-white text-xs font-bold rounded-lg shadow-sm transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                        Kunjungi Sumber
                    </a>
                    @endif
                    @if($article->pdf_url)
                    <a href="{{ $article->pdf_url }}" target="_blank" rel="noreferrer noopener" class="inline-flex items-center gap-1.5 px-4 py-2 bg-emerald-50 text-emerald-700 border border-emerald-200 hover:bg-emerald-100 text-xs font-bold rounded-lg shadow-sm transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                        PDF
                    </a>
                    @endif
                    @if($article->doi)
                    @php $doiUrl = str_starts_with($article->doi, 'http') ? $article->doi : 'https://doi.org/' . $article->doi; @endphp
                    <a href="{{ $doiUrl }}" target="_blank" rel="noreferrer noopener" class="inline-flex items-center gap-1.5 px-4 py-2 bg-white border border-slate-200 hover:bg-slate-50 text-slate-700 text-xs font-bold rounded-lg shadow-sm transition">
                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path></svg>
                        DOI
                    </a>
                    @endif
                </div>
                <div class="flex items-center gap-2">
                    <button onclick="toggleBookmark('{{ $article->id }}', '{{ addslashes(Str::limit($article->title, 100)) }}', '{{ isset($article->repository) && is_object($article->repository) ? $article->repository->name : 'Unknown' }}')" class="bookmark-btn-{{ $article->id }} inline-flex items-center gap-1.5 px-4 py-2 bg-white border border-slate-200 hover:bg-slate-50 text-slate-700 text-xs font-bold rounded-lg transition shadow-sm" title="Simpan ke Koleksi">
                        <svg class="w-4 h-4 bookmark-icon-{{ $article->id }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"></path></svg>
                        <span class="bookmark-text-{{ $article->id }}">Simpan</span>
                    </button>
                    <button @click="copyLink()" class="inline-flex items-center gap-1.5 px-4 py-2 bg-white border border-slate-200 hover:bg-slate-50 text-slate-700 text-xs font-bold rounded-lg transition shadow-sm">
                        <svg x-show="!copiedLink" class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"></path></svg>
                        <svg x-show="copiedLink" style="display: none;" class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        <span x-text="copiedLink ? 'Tersalin!' : 'Bagikan'"></span>
                    </button>
                </div>
            </div>
        </div>

        <!-- Content Grid (2 Columns Layout) -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6 grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- LEFT COLUMN (Main Content) -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Abstract Card -->
                <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 sm:p-8" x-data="{ expanded: false }">
                    <div class="flex items-center gap-2 mb-4 border-b border-slate-100 pb-4">
                        <div class="w-8 h-8 bg-blue-50 rounded-lg flex items-center justify-center text-[#1E3A8A]">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        </div>
                        <h2 class="text-lg font-bold text-slate-900">Abstrak</h2>
                    </div>
                    <div class="text-[15px] text-slate-600 leading-relaxed font-medium relative text-justify">
                        <div :class="expanded ? '' : 'line-clamp-6'">
                            {!! nl2br(e($article->abstract ?? 'Abstrak tidak tersedia untuk artikel ini.')) !!}
                        </div>
                        @if($article->abstract && strlen($article->abstract) > 500)
                            <button @click="expanded = !expanded" class="text-[#1E3A8A] font-bold mt-3 flex items-center gap-1 hover:underline">
                                <span x-text="expanded ? 'Tampilkan Lebih Sedikit' : 'Baca Selengkapnya'"></span>
                                <svg class="w-4 h-4 transition-transform" :class="expanded ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </button>
                        @endif
                    </div>
                </div>

                <!-- Cluster/Topics Card -->
                @if($article->cluster)
                <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 sm:p-8">
                    <div class="flex items-center gap-2 mb-4 border-b border-slate-100 pb-4">
                        <div class="w-8 h-8 bg-purple-50 rounded-lg flex items-center justify-center text-purple-600">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11V7a5 5 0 0110 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                        </div>
                        <h2 class="text-lg font-bold text-slate-900">Topik & Kata Kunci</h2>
                    </div>
                    <div class="flex flex-wrap gap-2">
                        <span class="px-4 py-2 bg-slate-50 border border-slate-200 text-slate-700 text-sm font-semibold rounded-xl hover:border-[#1E3A8A] hover:text-[#1E3A8A] transition cursor-pointer">
                            {{ $article->cluster }}
                        </span>
                    </div>
                </div>
                @endif

                <!-- Authors Card -->
                <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 sm:p-8">
                    <div class="flex items-center gap-2 mb-6 border-b border-slate-100 pb-4">
                        <div class="w-8 h-8 bg-emerald-50 rounded-lg flex items-center justify-center text-emerald-600">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        </div>
                        <h2 class="text-lg font-bold text-slate-900">Penulis ({{ count($article->authors ?? []) }})</h2>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                        @forelse($article->authors ?? [] as $author)
                            @php
                                $parts = explode(' ', $author->name);
                                $last = array_pop($parts);
                                $initials = '';
                                foreach($parts as $part) {
                                    if(strlen($part) > 0) $initials .= strtoupper($part[0]) . '. ';
                                }
                                $formattedName = $initials . $last;
                                $firstInit = strtoupper(substr($author->name, 0, 1));
                                $colors = ['bg-slate-100 text-slate-700', 'bg-blue-50 text-[#1E3A8A]', 'bg-emerald-50 text-emerald-700', 'bg-amber-50 text-amber-700', 'bg-rose-50 text-rose-700', 'bg-purple-50 text-purple-700'];
                                $color = $colors[crc32($author->name) % count($colors)];
                            @endphp
                            <div class="flex items-center gap-3 p-3 rounded-xl border border-slate-100 hover:border-slate-300 transition bg-slate-50/50">
                                <div class="w-10 h-10 rounded-full flex items-center justify-center font-bold text-sm shrink-0 {{ $color }}">
                                    {{ $firstInit }}
                                </div>
                                <span class="font-bold text-slate-800 text-sm truncate" title="{{ $author->name }}">{{ $formattedName }}</span>
                            </div>
                        @empty
                            <span class="text-slate-500 italic text-sm font-medium">Penulis tidak diketahui</span>
                        @endforelse
                    </div>
                </div>

                <!-- Citation Card -->
                <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 sm:p-8" x-data="{ tab: 'apa', copied: false, copyToClipboard(text) { navigator.clipboard.writeText(text); this.copied = true; setTimeout(() => this.copied = false, 2000); } }">
                    <div class="flex items-center gap-2 mb-6 border-b border-slate-100 pb-4">
                        <div class="w-8 h-8 bg-amber-50 rounded-lg flex items-center justify-center text-amber-600">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path></svg>
                        </div>
                        <h2 class="text-lg font-bold text-slate-900">Format Sitasi</h2>
                    </div>

                    <!-- Tabs -->
                    <div class="flex border-b border-slate-200 mb-5">
                        <button @click="tab = 'apa'" :class="tab === 'apa' ? 'border-[#1E3A8A] text-[#1E3A8A] font-bold' : 'border-transparent text-slate-500 hover:text-slate-700 font-semibold'" class="px-6 py-3 border-b-2 text-sm transition">APA</button>
                        <button @click="tab = 'mla'" :class="tab === 'mla' ? 'border-[#1E3A8A] text-[#1E3A8A] font-bold' : 'border-transparent text-slate-500 hover:text-slate-700 font-semibold'" class="px-6 py-3 border-b-2 text-sm transition">MLA</button>
                        <button @click="tab = 'bibtex'" :class="tab === 'bibtex' ? 'border-[#1E3A8A] text-[#1E3A8A] font-bold' : 'border-transparent text-slate-500 hover:text-slate-700 font-semibold'" class="px-6 py-3 border-b-2 text-sm transition">BibTeX</button>
                    </div>

                    @php
                        $authorsApa = '';
                        $authorsMla = '';
                        $authorsList = collect($article->authors ?? [])->pluck('name')->toArray();
                        
                        if(count($authorsList) > 0) {
                            $authorsApa = implode(', ', $authorsList);
                            $authorsMla = $authorsList[0] . (count($authorsList) > 1 ? ', et al.' : '.');
                        } else {
                            $authorsApa = 'Anonim';
                            $authorsMla = 'Anonim.';
                        }
                        $year = $article->publication_year ?? 'n.d.';
                        $title = $article->title;
                        $url = $article->doi ?? $article->source_url; 

                        $apaText = "$authorsApa. ($year). $title. $url";
                        $mlaText = "$authorsMla \"$title.\" ($year). $url.";
                        $bibtexText = "@article{,\n    title={ $title },\n    author={ " . implode(' and ', $authorsList) . " },\n    year={ $year },\n    url={ $url }\n}";
                    @endphp

                    <!-- Citation Contents -->
                    <div class="relative group mt-2">
                        <!-- Copy Button -->
                        <button 
                            @click="tab === 'apa' ? copyToClipboard(`{{ addslashes($apaText) }}`) : (tab === 'mla' ? copyToClipboard(`{{ addslashes($mlaText) }}`) : copyToClipboard(`{{ str_replace(["\r", "\n"], ["\\r", "\\n"], addslashes($bibtexText)) }}`))"
                            class="absolute top-3 right-3 p-2 bg-white border border-slate-200 rounded-lg shadow-sm hover:border-[#1E3A8A] hover:text-[#1E3A8A] text-slate-500 transition z-10"
                            title="Salin ke Clipboard">
                            <svg x-show="!copied" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3"></path></svg>
                            <svg x-show="copied" style="display: none;" class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        </button>

                        <div x-show="tab === 'apa'" class="bg-slate-50 p-6 rounded-xl font-mono text-sm text-slate-700 border border-slate-200 pr-16 leading-relaxed">
                            {{ $apaText }}
                        </div>
                        <div x-show="tab === 'mla'" class="bg-slate-50 p-6 rounded-xl font-mono text-sm text-slate-700 border border-slate-200 pr-16 leading-relaxed" style="display: none;">
                            {{ $mlaText }}
                        </div>
                        <div x-show="tab === 'bibtex'" class="bg-slate-50 p-6 rounded-xl font-mono text-sm text-slate-700 border border-slate-200 pr-16 whitespace-pre overflow-x-auto leading-relaxed" style="display: none;">{{ $bibtexText }}</div>
                    </div>
                </div>
            </div>

            <!-- RIGHT COLUMN (Sidebar Akses Cepat) -->
            <div class="lg:col-span-1 space-y-6">
                <!-- Sidebar Tools Card -->
                <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 sm:p-8 sticky top-40" x-data="{ copiedSidebarLink: false, copySidebarLink() { navigator.clipboard.writeText(window.location.href); this.copiedSidebarLink = true; setTimeout(() => this.copiedSidebarLink = false, 2000); } }">
                    <div class="flex items-center gap-2 mb-6 border-b border-slate-100 pb-4 text-[#1E3A8A] font-bold">
                        <svg class="w-5 h-5 text-[#FBBF24]" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.381z" clip-rule="evenodd"></path></svg>
                        <h3 class="text-lg">Akses Cepat</h3>
                    </div>

                    <div class="space-y-3 mb-8">
                        @if($article->source_url)
                        <a href="{{ route('track.redirect', ['url' => $article->source_url, 'repo' => $article->repository->name ?? 'Lokal', 'type' => 'click_source', 'title' => $article->title]) }}" target="_blank" rel="noreferrer noopener" class="w-full bg-[#1E3A8A] hover:bg-blue-900 text-white font-bold py-3 px-4 rounded-xl flex items-center justify-center gap-2 shadow-sm transition text-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                            Kunjungi Sumber
                        </a>
                        @endif
                        
                        @if($article->pdf_url)
                        <a href="{{ $article->pdf_url }}" target="_blank" rel="noreferrer noopener" class="w-full bg-emerald-50 hover:bg-emerald-100 border border-emerald-200 text-emerald-700 font-bold py-3 px-4 rounded-xl flex items-center justify-center gap-2 shadow-sm transition text-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                            Download PDF
                        </a>
                        @endif
                        
                        @if($article->doi)
                        @php $doiUrl = str_starts_with($article->doi, 'http') ? $article->doi : 'https://doi.org/' . $article->doi; @endphp
                        <a href="{{ $doiUrl }}" target="_blank" rel="noreferrer noopener" class="w-full bg-white hover:bg-slate-50 border border-slate-200 text-slate-700 font-bold py-3 px-4 rounded-xl flex items-center justify-center gap-2 transition text-sm">
                            <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path></svg>
                            Buka DOI
                        </a>
                        @endif
                    </div>

                    <!-- Informasi Jurnal list -->
                    <div class="border-t border-slate-100 pt-6 relative">
                        <span class="absolute -top-3 left-1/2 -translate-x-1/2 bg-white px-3 text-[11px] uppercase font-bold tracking-wider text-slate-400">Informasi Metadata</span>
                        <ul class="space-y-5 text-sm">
                            <li class="flex flex-col gap-1.5">
                                <span class="flex items-center gap-2 text-slate-500 font-bold"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg> Tahun Terbit</span>
                                <span class="font-extrabold text-slate-900 ml-6">{{ $article->publication_year ?? 'Tahun T/A' }}</span>
                            </li>
                            <li class="flex flex-col gap-1.5">
                                <span class="flex items-center gap-2 text-slate-500 font-bold"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129"></path></svg> Bahasa</span>
                                <span class="font-extrabold text-slate-900 ml-6">{{ strtoupper($article->language ?? 'ID') }}</span>
                            </li>
                            <li class="flex flex-col gap-1.5">
                                <span class="flex items-center gap-2 text-slate-500 font-bold"><svg class="w-4 h-4 text-amber-500" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg> Total Sitasi</span>
                                <span class="font-extrabold text-slate-900 ml-6">
                                    @if(isset($article->citation_count) && $article->citation_count > 0)
                                        {{ $article->citation_count }}x
                                    @else
                                        -
                                    @endif
                                </span>
                            </li>
                            <li class="flex flex-col gap-1.5">
                                <span class="flex items-center gap-2 text-slate-500 font-bold"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg> Sumber Jurnal</span>
                                <span class="font-extrabold text-slate-900 ml-6">{{ $article->journal_name ?? 'Tidak tersedia' }}</span>
                            </li>
                            <li class="flex flex-col gap-1.5">
                                <span class="flex items-center gap-2 text-slate-500 font-bold"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg> Sumber Database</span>
                                <span class="font-extrabold text-slate-900 ml-6">{{ is_object($article->repository ?? null) ? ($article->repository->name ?? 'Repositori Internal') : ($article->repository ?? 'Repositori Internal') }}</span>
                            </li>
                            @if($article->doi)
                            <li class="flex flex-col gap-1.5" x-data="{ copiedDoi: false, copyDoi() { navigator.clipboard.writeText('{{ $article->doi }}'); this.copiedDoi = true; setTimeout(() => this.copiedDoi = false, 2000); } }">
                                <span class="flex items-center gap-2 text-slate-500 font-bold"><svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path></svg> Nomor DOI</span>
                                <div class="flex items-center justify-between ml-6">
                                    <span class="font-extrabold text-slate-900 break-all mr-2">{{ $article->doi }}</span>
                                    <button @click="copyDoi()" class="p-1 text-slate-400 hover:text-[#1E3A8A] transition shrink-0 bg-slate-50 hover:bg-slate-100 rounded border border-slate-200" title="Salin DOI">
                                        <svg x-show="!copiedDoi" class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3"></path></svg>
                                        <svg x-show="copiedDoi" style="display: none;" class="w-3.5 h-3.5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                    </button>
                                </div>
                            </li>
                            @endif
                            <li class="flex flex-col gap-1.5">
                                <span class="flex items-center gap-2 text-slate-500 font-bold"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg> Akses</span>
                                <span class="font-extrabold text-[#1E3A8A] ml-6 flex items-center gap-1.5">Open Access <svg class="w-4 h-4 text-[#1E3A8A]" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg></span>
                            </li>
                        </ul>
                    </div>
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
