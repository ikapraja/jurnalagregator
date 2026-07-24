<?php

$controllerPath = 'c:/xampp/htdocs/jurnalagregator/app/Http/Controllers/SearchController.php';
$controllerContent = file_get_contents($controllerPath);

$newMethod = <<<PHP
    private function getDidYouMean(\$keyword)
    {
        if (empty(trim(\$keyword))) return null;
        
        // Kamus kata statis (domain spesifik)
        \$dictionary = [
            'keselamatan', 'transportasi', 'jalan', 'jurnal', 'penelitian', 'pengembangan',
            'kendaraan', 'lalu', 'lintas', 'kecelakaan', 'manajemen', 'rekayasa', 'logistik',
            'otomotif', 'mesin', 'analisis', 'evaluasi', 'pengaruh', 'sistem', 'kinerja',
            'karakteristik', 'perencanaan', 'pelayanan', 'angkutan', 'umum', 'barang'
        ];
        
        // Ambil dari database pencarian populer (top 50)
        \$popular = \App\Models\SearchQuery::orderByDesc('count')->limit(50)->pluck('keyword')->toArray();
        \$dictionary = array_unique(array_merge(\$dictionary, \$popular));
        
        \$words = explode(' ', strtolower(trim(\$keyword)));
        \$correctedWords = [];
        \$hasCorrection = false;
        
        foreach (\$words as \$word) {
            // Abaikan kata terlalu pendek atau angka
            if (strlen(\$word) < 4 || is_numeric(\$word)) {
                \$correctedWords[] = \$word;
                continue;
            }
            
            // Jika kata sudah ada di kamus, berarti benar
            if (in_array(\$word, \$dictionary)) {
                \$correctedWords[] = \$word;
                continue;
            }
            
            \$closest = \$word;
            \$shortestDistance = -1;
            
            foreach (\$dictionary as \$dictWord) {
                // Hanya periksa jika panjang kata mirip (beda maksimal 2 karakter)
                if (abs(strlen(\$word) - strlen(\$dictWord)) > 2) continue;
                
                \$lev = levenshtein(\$word, \$dictWord);
                
                // Jika jarak <= 2 (typo ringan), anggap ini kandidat perbaikan
                if (\$lev <= 2) {
                    if (\$lev == 0) {
                        \$closest = \$dictWord;
                        \$shortestDistance = 0;
                        break;
                    }
                    
                    if (\$lev < \$shortestDistance || \$shortestDistance < 0) {
                        \$closest = \$dictWord;
                        \$shortestDistance = \$lev;
                    }
                }
            }
            
            if (\$closest !== \$word) {
                \$hasCorrection = true;
            }
            
            \$correctedWords[] = \$closest;
        }
        
        if (\$hasCorrection) {
            return implode(' ', \$correctedWords);
        }
        
        return null;
    }
PHP;

// Sisipkan method baru sebelum tanda } terakhir di controller
$controllerContent = preg_replace('/}(?!.*})/', $newMethod . "\n}", $controllerContent);

// Cari bagian return view dan tambahkan $didYouMean
$searchBlock = <<<PHP
        // Buat custom paginator dari hasil memori
        \$articles = new LengthAwarePaginator(
            \$items,
            \$total,
            \$perPage,
            \$page,
            ['path' => \$request->url(), 'query' => \$request->query()]
        );
        
        \$didYouMean = \$this->getDidYouMean(\$keyword);

        return view('search', compact('articles', 'popularSearches', 'didYouMean', 'keyword'));
PHP;

// Ganti blok lama
$oldSearchBlock = <<<PHP
        // Buat custom paginator dari hasil memori
        \$articles = new LengthAwarePaginator(
            \$items,
            \$total,
            \$perPage,
            \$page,
            ['path' => \$request->url(), 'query' => \$request->query()]
        );

        return view('search', compact('articles', 'popularSearches'));
PHP;

$controllerContent = str_replace($oldSearchBlock, $searchBlock, $controllerContent);

// Coba juga jika view return-nya agak beda
if (strpos($controllerContent, compact('articles', 'popularSearches', 'didYouMean', 'keyword')) === false) {
     $controllerContent = str_replace(
         "return view('search', compact('articles', 'popularSearches'));",
         "\$didYouMean = \$this->getDidYouMean(\$keyword);\n        return view('search', compact('articles', 'popularSearches', 'didYouMean', 'keyword'));",
         $controllerContent
     );
}

file_put_contents($controllerPath, $controllerContent);


// SEKARANG UPDATE VIEW (Blade)
$bladePath = 'c:/xampp/htdocs/jurnalagregator/resources/views/search.blade.php';
$bladeContent = file_get_contents($bladePath);

$targetHtml = <<<HTML
                    <span class="text-sm text-slate-500 font-medium">Menampilkan {{ \$articles->firstItem() ?? 0 }} hingga {{ \$articles->lastItem() ?? 0 }} dari {{ number_format(\$articles->total(), 0, ',', '.') }} hasil</span>
                </div>
HTML;

$typoHtml = <<<HTML
                    <span class="text-sm text-slate-500 font-medium">Menampilkan {{ \$articles->firstItem() ?? 0 }} hingga {{ \$articles->lastItem() ?? 0 }} dari {{ number_format(\$articles->total(), 0, ',', '.') }} hasil</span>
                </div>
                
                @if(isset(\$didYouMean) && strtolower(trim(\$didYouMean)) !== strtolower(trim(\$keyword)))
                <div class="mb-6 bg-amber-50 border border-amber-200 text-amber-800 px-4 py-3 rounded-xl flex items-start gap-3 shadow-sm">
                    <svg class="w-5 h-5 mt-0.5 text-amber-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <div>
                        <p class="text-sm font-medium">Mungkin maksud Anda: <a href="{{ route('search.index', array_merge(request()->query(), ['q' => \$didYouMean])) }}" class="font-black underline hover:text-amber-900 transition">{{ \$didYouMean }}</a>?</p>
                        <p class="text-xs text-amber-700 mt-1 opacity-80">Menampilkan hasil untuk <strong>{{ \$keyword }}</strong>. Klik kata di atas untuk beralih.</p>
                    </div>
                </div>
                @endif
HTML;

$bladeContent = str_replace($targetHtml, $typoHtml, $bladeContent);
file_put_contents($bladePath, $bladeContent);

echo "Typo correction feature implemented.\n";
