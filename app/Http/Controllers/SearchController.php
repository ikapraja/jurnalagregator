<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\LiveSearchService;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\SearchQuery;
use App\Models\SearchLog;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->input('q');
        
        $popularSearches = SearchQuery::orderByDesc('count')->limit(5)->pluck('keyword');
        
        if (empty(trim($keyword))) {
            // Jika kosong, kembalikan paginator kosong
            $articles = new LengthAwarePaginator([], 0, 20, 1, [
                'path' => $request->url(),
                'query' => $request->query()
            ]);
            return view('search', compact('articles', 'popularSearches'));
        }

        // Batasi panjang keyword agar tidak meledakkan database (Max 255 chars)
        $keyword = \Illuminate\Support\Str::limit($keyword, 250, '');
        $normalizedKeyword = strtolower(trim($keyword));
        $searchQueryRecord = SearchQuery::firstOrCreate(
            ['keyword' => $normalizedKeyword],
            ['count' => 0]
        );
        $searchQueryRecord->increment('count');

        // Log untuk time-series
        SearchLog::create(['keyword' => $normalizedKeyword]);

        $page = (int) $request->input('page', 1);
        $perPage = 20;
        $sort = $request->input('sort', 'relevansi');
        
        // Amankan tipe data tahun agar tidak memicu TypeError jika diisi huruf
        $yearFrom = $request->input('year_from') ? (int) $request->input('year_from') : null;
        $yearTo = $request->input('year_to') ? (int) $request->input('year_to') : null;
        
        $language = $request->input('language', 'all');
        $source = $request->input('source', 'all');
        $strict = $request->input('strict', 0);

        $didYouMean = $this->getDidYouMean($keyword);
        $searchKeyword = $keyword;

        // Auto-correct like Google if not in strict mode
        if (!$strict && $didYouMean && strtolower(trim($didYouMean)) !== strtolower(trim($keyword))) {
            $searchKeyword = $didYouMean;
        }

        $liveSearch = new LiveSearchService();
        
        try {
            // Panggil API secara live tanpa menyentuh DB
            $result = $liveSearch->search($searchKeyword, $page, $perPage, $sort, $yearFrom, $yearTo, $language, $source);
            $items = $result['items'];
            $total = $result['total'];
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('LiveSearchService failed: ' . $e->getMessage());
            $items = [];
            $total = 0;
        }

        if ($request->has('prefetch')) {
            // Jika request ini hanya untuk prefetch (background loading), hentikan eksekusi di sini.
            // Data sudah berhasil di-cache oleh LiveSearchService di atas, sehingga halaman selanjutnya akan instan!
            return response()->json(['status' => 'prefetched']);
        }

        // Buat custom paginator dari hasil memori
        $articles = new LengthAwarePaginator(
            $items, 
            $total, 
            $perPage, 
            $page, 
            [
                'path' => $request->url(), 
                'query' => $request->query()
            ]
        );
        
        // Cek jika user mencoba akses halaman di luar batas
        if ($articles->total() > 0 && $page > $articles->lastPage()) {
            return redirect($request->fullUrlWithQuery(['page' => $articles->lastPage()]));
        }
        
        // Simpan URL pencarian ini ke session (tanpa prefetch) agar breadcrumb selalu akurat
        if (!$request->has('prefetch')) {
            session(['last_search_url' => $request->fullUrl()]);
        }

        
        return view('search', compact('articles', 'popularSearches', 'didYouMean', 'keyword', 'strict', 'source'));
    }

    private function getDidYouMean($keyword)
    {
        if (empty(trim($keyword))) return null;
        
        $dictionary = [
            'keselamatan', 'transportasi', 'jalan', 'jurnal', 'penelitian', 'pengembangan',
            'kendaraan', 'lalu', 'lintas', 'kecelakaan', 'manajemen', 'rekayasa', 'logistik',
            'otomotif', 'mesin', 'analisis', 'evaluasi', 'pengaruh', 'sistem', 'kinerja',
            'karakteristik', 'perencanaan', 'pelayanan', 'angkutan', 'umum', 'barang',
            'sepeda', 'motor', 'mobil', 'pejalan', 'kaki', 'rambu', 'marka', 'dampak'
        ];
        
        $popular = \App\Models\SearchQuery::where('count', '>=', 5)->orderByDesc('count')->limit(50)->pluck('keyword')->toArray();
        $dictionary = array_unique(array_merge($dictionary, $popular));
        
        $words = explode(' ', strtolower(trim($keyword)));
        $correctedWords = [];
        $hasCorrection = false;
        
        foreach ($words as $word) {
            if (strlen($word) < 4 || is_numeric($word)) {
                $correctedWords[] = $word;
                continue;
            }
            if (in_array($word, $dictionary)) {
                $correctedWords[] = $word;
                continue;
            }
            
            $closest = $word;
            $shortestDistance = -1;
            foreach ($dictionary as $dictWord) {
                if (abs(strlen($word) - strlen($dictWord)) > 2) continue;
                $lev = levenshtein($word, $dictWord);
                if ($lev <= 2) {
                    if ($lev == 0) { $closest = $dictWord; $shortestDistance = 0; break; }
                    if ($lev < $shortestDistance || $shortestDistance < 0) {
                        $closest = $dictWord;
                        $shortestDistance = $lev;
                    }
                }
            }
            if ($closest !== $word) $hasCorrection = true;
            $correctedWords[] = $closest;
        }
        
        return $hasCorrection ? implode(' ', $correctedWords) : null;
    }

    public function export(Request $request)
    {
        $keyword = $request->input('q');
        if (empty(trim($keyword))) {
            return redirect()->route('search.index')->with('error', 'Kata kunci pencarian kosong.');
        }

        $sort = $request->input('sort', 'relevansi');
        $yearFrom = $request->input('year_from');
        $yearTo = $request->input('year_to');
        $language = $request->input('language', 'all');
        $source = $request->input('source', 'all');
        $format = $request->input('format', 'csv');

        $liveSearch = new \App\Services\LiveSearchService();
        $result = $liveSearch->search($keyword, 1, 100, $sort, $yearFrom, $yearTo, $language);
        $items = $result['items'] ?? [];

        if (empty($items)) {
            return redirect()->route('search.index')->with('error', 'Tidak ada data untuk diekspor.');
        }

                $filename = 'Export_Jurnal_' . \Illuminate\Support\Str::slug($keyword) . '_' . date('Ymd_His');
        
        try {
            $now = now();
            $logs = [];
            foreach ($items as $item) {
                // Safely handle both array and object
                $repo = is_array($item) ? ($item['source'] ?? 'Unknown') : ($item->source ?? (isset($item->repository) && is_object($item->repository) ? $item->repository->name : 'Unknown'));
                $title = is_array($item) ? ($item['title'] ?? 'Exported Article') : ($item->title ?? 'Exported Article');
                
                $logs[] = [
                    'repository_name' => $repo,
                    'download_type'   => 'export_' . $format,
                    'article_title'   => \Illuminate\Support\Str::limit($title, 250),
                    'created_at'      => $now,
                    'updated_at'      => $now
                ];
            }
            
            if (!empty($logs)) {
                \App\Models\DownloadLog::insert($logs);
            }
        } catch (\Throwable $e) {
            // Catch BOTH Exception and Error to prevent crashing the export
        }

        if ($format === 'json') {
            return response()->json([
                'query' => $keyword,
                'total_exported' => count($items),
                'results' => $items
            ], 200, [
                'Content-Disposition' => 'attachment; filename="' . $filename . '.json"',
                'Access-Control-Expose-Headers' => 'Content-Disposition'
            ]);
        } elseif ($format === 'bibtex') {
            $bibtex = "";
            foreach ($items as $index => $item) {
                $type = 'article';
                $key = 'ref' . ($index + 1) . '_' . date('Y');
                $title = str_replace(['{', '}'], '', $item->title ?? '');
                
                $authorsList = [];
                if (is_array($item->authors)) {
                    foreach ($item->authors as $author) {
                        $authorsList[] = is_string($author) ? $author : (is_object($author) ? ($author->name ?? '') : (is_array($author) ? ($author['name'] ?? '') : ''));
                    }
                }
                $authorsList = array_filter($authorsList);
                $authors = implode(' and ', $authorsList ?: ['Unknown']);

                $year = $item->publication_year ?? date('Y');
                $repoName = isset($item->repository) && is_object($item->repository) ? $item->repository->name : 'Unknown';
                $journal = $item->journal_name ?? $repoName;
                $url = $item->source_url ?? '';
                $doi = $item->doi ?? '';
                $abstract = str_replace(['{', '}'], '', $item->abstract ?? '');

                $bibtex .= "@{$type}{{ {$key},\n";
                $bibtex .= "  title={{$title}},\n";
                $bibtex .= "  author={{$authors}},\n";
                $bibtex .= "  journal={{$journal}},\n";
                $bibtex .= "  year={{$year}},\n";
                if ($doi) $bibtex .= "  doi={{$doi}},\n";
                if ($url) $bibtex .= "  url={{$url}},\n";
                if ($abstract) $bibtex .= "  abstract={{$abstract}}\n";
                $bibtex .= "}\n\n";
            }
            return response($bibtex, 200, [
                'Content-Type' => 'application/x-bibtex',
                'Content-Disposition' => 'attachment; filename="' . $filename . '.bib"',
                'Access-Control-Expose-Headers' => 'Content-Disposition'
            ]);
        } else {
            // CSV
            $headers = [
                "Content-type"        => "text/csv; charset=UTF-8",
                "Content-Disposition" => "attachment; filename=\"{$filename}.csv\"",
                "Access-Control-Expose-Headers" => "Content-Disposition",
                "Pragma"              => "no-cache",
                "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
                "Expires"             => "0"
            ];
            
            $callback = function() use($items) {
                $file = fopen('php://output', 'w');
                // BOM for Excel UTF-8
                fputs($file, $bom =(chr(0xEF) . chr(0xBB) . chr(0xBF)));
                fputcsv($file, ['No', 'Judul', 'Penulis', 'Tahun', 'Jurnal', 'Database', 'Sitasi', 'Open Access', 'DOI', 'URL', 'Abstrak'], ';');
                
                $no = 1;
                foreach ($items as $item) {
                    $repoName = isset($item->repository) && is_object($item->repository) ? $item->repository->name : 'Lokal';
                    
                    $authorsList = [];
                    if (is_array($item->authors)) {
                        foreach ($item->authors as $author) {
                            $authorsList[] = is_string($author) ? $author : (is_object($author) ? ($author->name ?? '') : (is_array($author) ? ($author['name'] ?? '') : ''));
                        }
                    }
                    $authorsStr = implode(', ', array_filter($authorsList));

                    fputcsv($file, [
                        $no++,
                        $item->title,
                        $authorsStr,
                        $item->publication_year,
                        $item->journal_name,
                        $repoName,
                        $item->citation_count,
                        $item->pdf_url ? 'Ya' : 'Tidak',
                        $item->doi,
                        $item->source_url,
                        $item->abstract
                    ], ';');
                }
                fclose($file);
            };

            return response()->stream($callback, 200, $headers);
        }
    }
}