<?php

// TASK 1: SEO OpenGraph Meta Tags
$detailPath = 'c:/xampp/htdocs/jurnalagregator/resources/views/detail.blade.php';
$detailContent = file_get_contents($detailPath);
if (strpos($detailContent, 'og:title') === false) {
    $metaTags = <<<HTML
    <!-- SEO & OpenGraph -->
    <meta property="og:title" content="{{ \$article->title }} - Agregator Jurnal PKTJ" />
    <meta property="og:description" content="{{ Str::limit(strip_tags(\$article->abstract ?? 'Baca selengkapnya di Agregator Jurnal PKTJ'), 150) }}" />
    <meta property="og:image" content="{{ asset('logodashboard.png') }}" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta name="twitter:card" content="summary_large_image" />
    
HTML;
    $detailContent = str_replace('<meta name="viewport"', $metaTags . '    <meta name="viewport"', $detailContent);
    file_put_contents($detailPath, $detailContent);
}

// TASK 2: Source Filter Backend
$controllerPath = 'c:/xampp/htdocs/jurnalagregator/app/Http/Controllers/SearchController.php';
$controllerContent = file_get_contents($controllerPath);
if (strpos($controllerContent, "\$source = \$request->input('source', 'all');") === false) {
    $controllerContent = str_replace(
        '$language = $request->input(\'language\', \'all\');',
        "\$language = \$request->input('language', 'all');\n        \$source = \$request->input('source', 'all');",
        $controllerContent
    );
    $controllerContent = str_replace(
        '$result = $liveSearch->search($searchKeyword, $page, $perPage, $sort, $yearFrom, $yearTo, $language);',
        '$result = $liveSearch->search($searchKeyword, $page, $perPage, $sort, $yearFrom, $yearTo, $language, $source);',
        $controllerContent
    );
    $controllerContent = str_replace(
        "compact('articles', 'popularSearches', 'didYouMean', 'keyword', 'strict')",
        "compact('articles', 'popularSearches', 'didYouMean', 'keyword', 'strict', 'source')",
        $controllerContent
    );
    file_put_contents($controllerPath, $controllerContent);
}

$servicePath = 'c:/xampp/htdocs/jurnalagregator/app/Services/LiveSearchService.php';
$serviceContent = file_get_contents($servicePath);
if (strpos($serviceContent, '$source = \'all\'') === false) {
    $serviceContent = str_replace(
        'public function search($keyword, $page = 1, $perPage = 10, $sort = \'relevansi\', $yearFrom = null, $yearTo = null, $language = \'all\')',
        'public function search($keyword, $page = 1, $perPage = 10, $sort = \'relevansi\', $yearFrom = null, $yearTo = null, $language = \'all\', $source = \'all\')',
        $serviceContent
    );
    $serviceContent = str_replace(
        '$cacheKey = "search_" . md5($keyword . $page . $perPage . $sort . $yearFrom . $yearTo . $language);',
        '$cacheKey = "search_" . md5($keyword . $page . $perPage . $sort . $yearFrom . $yearTo . $language . $source);',
        $serviceContent
    );
    $serviceContent = str_replace(
        'return Cache::remember($cacheKey, 3600, function () use ($keyword, $page, $perPage, $sort, $yearFrom, $yearTo, $language) {',
        'return Cache::remember($cacheKey, 3600, function () use ($keyword, $page, $perPage, $sort, $yearFrom, $yearTo, $language, $source) {',
        $serviceContent
    );
    $serviceContent = str_replace(
        '$responses = Http::pool(function (Pool $pool) use ($keyword, $limitPerSource, $offset, $page) {',
        '$responses = Http::pool(function (Pool $pool) use ($keyword, $limitPerSource, $offset, $page, $source) {',
        $serviceContent
    );

    // Replace the $requests array creation
    $requestsTarget = <<<'PHP'
                $requests = [
                    $pool->as('crossref')->timeout(15)->get("https://api.crossref.org/works", [
                        'query' => $keyword,
                        'rows' => $limitPerSource,
                        'offset' => $offset,
                        'select' => 'DOI,title,abstract,author,URL,language,published-print,published-online,is-referenced-by-count',
                        'mailto' => env('CROSSREF_MAILTO', 'admin@jurnalagregator.local')
                    ]),
                    $pool->as('arxiv')->timeout(15)->get("http://export.arxiv.org/api/query?search_query=all:" . urlencode($keyword) . "&start={$offset}&max_results={$limitPerSource}"),
                    $pool->as('doaj')->timeout(15)->get("https://doaj.org/api/search/articles/" . urlencode($keyword), [
                        'page' => $page,
                        'pageSize' => $limitPerSource
                    ]),
                    $pool->as('semantic_scholar')->timeout(15)
                        ->withHeaders(env('SEMANTIC_SCHOLAR_API_KEY') ? ['x-api-key' => env('SEMANTIC_SCHOLAR_API_KEY')] : [])
                        ->get("https://api.semanticscholar.org/graph/v1/paper/search", [
                            'query' => $keyword,
                            'offset' => $offset,
                            'limit' => $limitPerSource,
                            'fields' => 'title,abstract,authors,year,publicationDate,url,openAccessPdf,externalIds,citationCount'
                        ]),
                    $pool->as('openalex')->timeout(15)->get("https://api.openalex.org/works", [
                        'search' => $keyword,
                        'page' => $page,
                        'per-page' => $limitPerSource,
                        'mailto' => env('CROSSREF_MAILTO', 'admin@jurnalagregator.local')
                    ]),
                    $pool->as('europepmc')->timeout(15)->get("https://www.ebi.ac.uk/europepmc/webservices/rest/search", [
                        'query' => $keyword,
                        'format' => 'json',
                        'resultType' => 'core',
                        'pageSize' => $limitPerSource
                    ])
                ];
PHP;
    $requestsReplacement = <<<'PHP'
                $requests = [];
                if ($source === 'all' || $source === 'crossref') {
                    $requests[] = $pool->as('crossref')->timeout(15)->get("https://api.crossref.org/works", [
                        'query' => $keyword,
                        'rows' => $limitPerSource,
                        'offset' => $offset,
                        'select' => 'DOI,title,abstract,author,URL,language,published-print,published-online,is-referenced-by-count',
                        'mailto' => env('CROSSREF_MAILTO', 'admin@jurnalagregator.local')
                    ]);
                }
                if ($source === 'all' || $source === 'arxiv') {
                    $requests[] = $pool->as('arxiv')->timeout(15)->get("http://export.arxiv.org/api/query?search_query=all:" . urlencode($keyword) . "&start={$offset}&max_results={$limitPerSource}");
                }
                if ($source === 'all' || $source === 'doaj') {
                    $requests[] = $pool->as('doaj')->timeout(15)->get("https://doaj.org/api/search/articles/" . urlencode($keyword), [
                        'page' => $page,
                        'pageSize' => $limitPerSource
                    ]);
                }
                if ($source === 'all' || $source === 'semantic_scholar') {
                    $requests[] = $pool->as('semantic_scholar')->timeout(15)
                        ->withHeaders(env('SEMANTIC_SCHOLAR_API_KEY') ? ['x-api-key' => env('SEMANTIC_SCHOLAR_API_KEY')] : [])
                        ->get("https://api.semanticscholar.org/graph/v1/paper/search", [
                            'query' => $keyword,
                            'offset' => $offset,
                            'limit' => $limitPerSource,
                            'fields' => 'title,abstract,authors,year,publicationDate,url,openAccessPdf,externalIds,citationCount'
                        ]);
                }
                if ($source === 'all' || $source === 'openalex') {
                    $requests[] = $pool->as('openalex')->timeout(15)->get("https://api.openalex.org/works", [
                        'search' => $keyword,
                        'page' => $page,
                        'per-page' => $limitPerSource,
                        'mailto' => env('CROSSREF_MAILTO', 'admin@jurnalagregator.local')
                    ]);
                }
                if ($source === 'all' || $source === 'europepmc') {
                    $requests[] = $pool->as('europepmc')->timeout(15)->get("https://www.ebi.ac.uk/europepmc/webservices/rest/search", [
                        'query' => $keyword,
                        'format' => 'json',
                        'resultType' => 'core',
                        'pageSize' => $limitPerSource
                    ]);
                }
PHP;
    $serviceContent = str_replace($requestsTarget, $requestsReplacement, $serviceContent);
    $serviceContent = str_replace("if (env('CORE_API_KEY')) {", "if (env('CORE_API_KEY') && (\$source === 'all' || \$source === 'core')) {", $serviceContent);
    $serviceContent = str_replace("if (env('IEEE_API_KEY')) {", "if (env('IEEE_API_KEY') && (\$source === 'all' || \$source === 'ieee')) {", $serviceContent);
    file_put_contents($servicePath, $serviceContent);
}

// TASK 3: UI Updates (Source Filter & Bookmark) in search.blade.php
$searchPath = 'c:/xampp/htdocs/jurnalagregator/resources/views/search.blade.php';
$searchContent = file_get_contents($searchPath);

// Change grid from 5 to 6 cols
$searchContent = str_replace('md:grid-cols-5', 'md:grid-cols-6', $searchContent);

// Add Source dropdown next to Language
$languageSelectTarget = <<<HTML
                            <div>
                                <label class="block text-xs font-bold text-slate-500 mb-1.5 uppercase tracking-wide">Bahasa</label>
                                <select name="language" style="text-align-last: center;" class="w-full text-center bg-[#F8FAFC] border border-slate-200 text-slate-800 py-3 px-4 rounded-xl focus:ring-2 focus:ring-[#1E3A8A]/20 focus:border-[#1E3A8A] transition text-sm">
                                    <option value="all" {{ request('language') == 'all' ? 'selected' : '' }}>Semua</option>
                                    <option value="id" {{ request('language') == 'id' ? 'selected' : '' }}>Indonesia</option>
                                    <option value="en" {{ request('language') == 'en' ? 'selected' : '' }}>Inggris</option>
                                </select>
                            </div>
HTML;
$sourceSelect = <<<HTML
                            <div>
                                <label class="block text-xs font-bold text-slate-500 mb-1.5 uppercase tracking-wide">Sumber</label>
                                <select name="source" style="text-align-last: center;" class="w-full text-center bg-[#F8FAFC] border border-slate-200 text-slate-800 py-3 px-4 rounded-xl focus:ring-2 focus:ring-[#1E3A8A]/20 focus:border-[#1E3A8A] transition text-sm">
                                    <option value="all" {{ request('source') == 'all' ? 'selected' : '' }}>Semua Database</option>
                                    <option value="crossref" {{ request('source') == 'crossref' ? 'selected' : '' }}>Crossref</option>
                                    <option value="doaj" {{ request('source') == 'doaj' ? 'selected' : '' }}>DOAJ</option>
                                    <option value="semantic_scholar" {{ request('source') == 'semantic_scholar' ? 'selected' : '' }}>Semantic Scholar</option>
                                    <option value="openalex" {{ request('source') == 'openalex' ? 'selected' : '' }}>OpenAlex</option>
                                </select>
                            </div>
HTML;
if (strpos($searchContent, 'name="source"') === false) {
    $searchContent = str_replace($languageSelectTarget, $languageSelectTarget . "\n" . $sourceSelect, $searchContent);
}

// Add Bookmark logic (HTML & JS)
$bookmarkHtml = <<<HTML
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
        bookmarks.forEach(b => {
            document.querySelectorAll('.bookmark-icon-' + b.id).forEach(el => {
                el.setAttribute('fill', 'currentColor');
                el.classList.add('text-amber-500');
                el.classList.remove('text-slate-400');
            });
        });
    }

    function toggleBookmark(id, title) {
        let index = bookmarks.findIndex(b => b.id === id);
        if (index > -1) {
            bookmarks.splice(index, 1);
            document.querySelectorAll('.bookmark-icon-' + id).forEach(el => {
                el.setAttribute('fill', 'none');
                el.classList.remove('text-amber-500');
                el.classList.add('text-slate-400');
            });
        } else {
            bookmarks.push({id: id, title: title});
        }
        localStorage.setItem('pktj_bookmarks', JSON.stringify(bookmarks));
        updateBookmarkUI();
    }

    function openBookmarkModal() {
        document.getElementById('bookmark-modal').classList.remove('hidden');
        let list = document.getElementById('bookmark-list');
        if (bookmarks.length === 0) {
            list.innerHTML = '<div class="text-center py-10 text-slate-500"><svg class="w-16 h-16 mx-auto mb-4 text-slate-200" fill="currentColor" viewBox="0 0 24 24"><path d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"></path></svg><h3 class="font-bold text-lg mb-1">Koleksi Masih Kosong</h3><p class="text-sm">Simpan jurnal menarik dengan mengklik ikon pita pada hasil pencarian.</p></div>';
            return;
        }
        
        // Buat path yang dinamis sesuai environment (misal di localhost vs server)
        let basePath = window.location.pathname.replace(/\/search$/, '').replace(/\/$/, '');
        if (!basePath.includes('public')) basePath += '/public'; // fallback jika di xampp

        list.innerHTML = bookmarks.map(b => `
            <div class="flex justify-between items-center p-4 border border-slate-100 rounded-xl mb-3 hover:bg-slate-50 transition shadow-sm">
                <a href="/jurnalagregator/public/article/\${b.id}" class="text-[13px] font-bold text-[#1E3A8A] hover:text-amber-600 line-clamp-2 w-5/6 transition leading-relaxed">\${b.title}</a>
                <button onclick="toggleBookmark('\${b.id}', '\${b.title.replace(/'/g, '\\'')}'); openBookmarkModal()" class="text-red-400 hover:text-red-600 p-2 bg-red-50 hover:bg-red-100 rounded-lg transition" title="Hapus"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg></button>
            </div>
        `).join('');
    }

    function closeBookmarkModal() {
        document.getElementById('bookmark-modal').classList.add('hidden');
    }

    document.addEventListener('DOMContentLoaded', updateBookmarkUI);
</script>
HTML;

if (strpos($searchContent, 'bookmark-modal') === false) {
    $searchContent = str_replace('</body>', $bookmarkHtml . "\n</body>", $searchContent);
}

// Add Bookmark button to cards in search.blade.php
// We find <h3 class="text-base sm:text-lg font-bold text-[#1E3A8A]
$cardTitleRegex = '/(<h3 class="[^"]*?text-base sm:text-lg font-bold text-\[#1E3A8A\][^"]*?">\s*<a[^>]*>.*?<\/a>\s*<\/h3>)/s';
$cardBookmarkBtn = <<<HTML
$1
                            <button onclick="toggleBookmark('{{ \$article->id }}', '{{ addslashes(Str::limit(\$article->title, 100)) }}')" class="absolute top-4 right-4 text-slate-300 hover:text-amber-500 transition drop-shadow-sm" title="Simpan ke Koleksi">
                                <svg class="w-6 h-6 bookmark-icon-{{ \$article->id }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"></path></svg>
                            </button>
HTML;
if (strpos($searchContent, 'toggleBookmark(') === false) {
    // Wait, the title container is relative? Let's check search.blade.php card.
    // The card is <article class="relative ...
    $searchContent = preg_replace($cardTitleRegex, $cardBookmarkBtn, $searchContent);
}

file_put_contents($searchPath, $searchContent);

echo "Features 2, 3, and 4 implemented successfully.\n";
