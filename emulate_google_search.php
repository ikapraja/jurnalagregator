<?php

$controllerPath = 'c:/xampp/htdocs/jurnalagregator/app/Http/Controllers/SearchController.php';
$controllerContent = file_get_contents($controllerPath);

// Update SearchController
// 1. Move getDidYouMean logic to the top, before calling the API.
// 2. Add strict param handling
$newBlock = <<<PHP
        \$page = (int) \$request->input('page', 1);
        \$perPage = 20;
        \$sort = \$request->input('sort', 'relevansi');
        \$yearFrom = \$request->input('year_from');
        \$yearTo = \$request->input('year_to');
        \$language = \$request->input('language', 'all');
        \$strict = \$request->input('strict', 0);

        \$didYouMean = \$this->getDidYouMean(\$keyword);
        \$searchKeyword = \$keyword;

        // Auto-correct like Google if not in strict mode
        if (!\$strict && \$didYouMean && strtolower(trim(\$didYouMean)) !== strtolower(trim(\$keyword))) {
            \$searchKeyword = \$didYouMean;
        }

        \$liveSearch = new LiveSearchService();
        
        try {
            // Panggil API secara live tanpa menyentuh DB
            \$result = \$liveSearch->search(\$searchKeyword, \$page, \$perPage, \$sort, \$yearFrom, \$yearTo, \$language);
            \$items = \$result['items'];
            \$total = \$result['total'];
        } catch (\Exception \$e) {
            \Illuminate\Support\Facades\Log::error('LiveSearchService failed: ' . \$e->getMessage());
            \$items = [];
            \$total = 0;
        }

        // Buat custom paginator dari hasil memori
        \$articles = new LengthAwarePaginator(
            \$items, 
            \$total, 
            \$perPage, 
            \$page, 
            [
                'path' => \$request->url(), 
                'query' => \$request->query()
            ]
        );
        
        return view('search', compact('articles', 'popularSearches', 'didYouMean', 'keyword', 'strict'));
PHP;

// Find the old block to replace
$oldBlockRegex = '/\$page = \(int\).*?return view\(\'search\', compact\(\'articles\', \'popularSearches\', \'didYouMean\', \'keyword\'\)\);/s';
$controllerContent = preg_replace($oldBlockRegex, $newBlock, $controllerContent);

// Remove the old $didYouMean call if it's still lingering
// (Handled by the regex above which replaces everything up to the return statement)

file_put_contents($controllerPath, $controllerContent);


// Update View
$bladePath = 'c:/xampp/htdocs/jurnalagregator/resources/views/search.blade.php';
$bladeContent = file_get_contents($bladePath);

$oldAlertRegex = '/@if\(isset\(\$didYouMean\).*?@endif/s';
$newAlert = <<<HTML
@if(isset(\$didYouMean) && strtolower(trim(\$didYouMean)) !== strtolower(trim(\$keyword)) && !\$strict)
                <div class="mb-6 bg-blue-50 border border-blue-200 text-blue-800 px-5 py-4 rounded-xl flex items-start gap-4 shadow-sm animate-slide-up">
                    <svg class="w-6 h-6 mt-0.5 text-blue-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <div class="flex flex-col gap-1">
                        <p class="text-sm font-medium">Menampilkan hasil untuk <a href="{{ route('search.index', array_merge(request()->query(), ['q' => \$didYouMean, 'strict' => 1])) }}" class="font-black italic text-[#1E3A8A] hover:underline transition">{{ \$didYouMean }}</a></p>
                        <p class="text-[13px] text-blue-700 opacity-90">Atau telusuri hasil untuk <a href="{{ route('search.index', array_merge(request()->query(), ['q' => \$keyword, 'strict' => 1])) }}" class="font-bold underline hover:text-[#1E3A8A] transition">{{ \$keyword }}</a></p>
                    </div>
                </div>
                @endif
HTML;

$bladeContent = preg_replace($oldAlertRegex, $newAlert, $bladeContent);

// Add the logic to update the search input box so it displays the corrected word?
// No, Google keeps the original typo in the search box, but the results are for the corrected one. Our input box uses `value="{{ request('q') }}"` which is the original keyword! So that's perfect.

file_put_contents($bladePath, $bladeContent);

echo "Google-like auto-correction feature implemented.\n";
