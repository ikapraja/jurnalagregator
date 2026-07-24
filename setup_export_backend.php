<?php
$controllerPath = 'c:/xampp/htdocs/jurnalagregator/app/Http/Controllers/SearchController.php';
$content = file_get_contents($controllerPath);

$exportMethod = <<<'EOD'
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
        $format = $request->input('format', 'csv');

        $liveSearch = new \App\Services\LiveSearchService();
        $result = $liveSearch->search($keyword, 1, 100, $sort, $yearFrom, $yearTo, $language);
        $items = $result['items'] ?? [];

        if (empty($items)) {
            return redirect()->route('search.index')->with('error', 'Tidak ada data untuk diekspor.');
        }

        $filename = 'Export_Jurnal_' . \Illuminate\Support\Str::slug($keyword) . '_' . date('Ymd_His');

        if ($format === 'json') {
            return response()->json([
                'query' => $keyword,
                'total_exported' => count($items),
                'results' => $items
            ], 200, [
                'Content-Disposition' => 'attachment; filename="' . $filename . '.json"'
            ]);
        } elseif ($format === 'bibtex') {
            $bibtex = "";
            foreach ($items as $index => $item) {
                $type = 'article';
                $key = 'ref' . ($index + 1) . '_' . date('Y');
                $title = str_replace(['{', '}'], '', $item->title ?? '');
                $authors = implode(' and ', $item->authors ?? ['Unknown']);
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
                'Content-Disposition' => 'attachment; filename="' . $filename . '.bib"'
            ]);
        } else {
            // CSV
            $headers = [
                "Content-type"        => "text/csv; charset=UTF-8",
                "Content-Disposition" => "attachment; filename=\"{$filename}.csv\"",
                "Pragma"              => "no-cache",
                "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
                "Expires"             => "0"
            ];
            
            $callback = function() use($items) {
                $file = fopen('php://output', 'w');
                // BOM for Excel UTF-8
                fputs($file, $bom =(chr(0xEF) . chr(0xBB) . chr(0xBF)));
                fputcsv($file, ['No', 'Judul', 'Penulis', 'Tahun', 'Jurnal', 'Database', 'Sitasi', 'Open Access', 'DOI', 'URL', 'Abstrak']);
                
                $no = 1;
                foreach ($items as $item) {
                    $repoName = isset($item->repository) && is_object($item->repository) ? $item->repository->name : 'Lokal';
                    fputcsv($file, [
                        $no++,
                        $item->title,
                        is_array($item->authors) ? implode(', ', $item->authors) : '',
                        $item->publication_year,
                        $item->journal_name,
                        $repoName,
                        $item->citation_count,
                        $item->pdf_url ? 'Ya' : 'Tidak',
                        $item->doi,
                        $item->source_url,
                        $item->abstract
                    ]);
                }
                fclose($file);
            };

            return response()->stream($callback, 200, $headers);
        }
    }
}
EOD;

$content = preg_replace('/\}\s*$/', "\n$exportMethod", $content);
file_put_contents($controllerPath, $content);
echo "SearchController updated.\n";

$routesPath = 'c:/xampp/htdocs/jurnalagregator/routes/web.php';
$routesContent = file_get_contents($routesPath);
if (strpos($routesContent, "Route::get('/export'") === false) {
    $routesContent = str_replace(
        "Route::get('/', [SearchController::class, 'index'])->name('search.index');", 
        "Route::get('/', [SearchController::class, 'index'])->name('search.index');\nRoute::get('/export', [SearchController::class, 'export'])->name('search.export');", 
        $routesContent
    );
    file_put_contents($routesPath, $routesContent);
    echo "routes/web.php updated.\n";
}

$servicePath = 'c:/xampp/htdocs/jurnalagregator/app/Services/LiveSearchService.php';
$serviceContent = file_get_contents($servicePath);
$serviceContent = str_replace(
    '$limitPerSource = 15;', 
    '$limitPerSource = $perPage > 20 ? 25 : 15;', 
    $serviceContent
);
file_put_contents($servicePath, $serviceContent);
echo "LiveSearchService updated.\n";
