<?php

$baseDir = 'c:/xampp/htdocs/jurnalagregator';

// 1. Update Migration
$migrationFile = glob($baseDir . '/database/migrations/*_create_search_logs_table.php')[0];
$migrationContent = file_get_contents($migrationFile);
$migrationContent = str_replace(
    "\$table->id();",
    "\$table->id();\n            \$table->string('keyword')->index();",
    $migrationContent
);
file_put_contents($migrationFile, $migrationContent);

// 2. Update Model
$modelFile = $baseDir . '/app/Models/SearchLog.php';
$modelContent = file_get_contents($modelFile);
$modelContent = str_replace(
    "use HasFactory;",
    "use HasFactory;\n\n    protected \$fillable = ['keyword'];",
    $modelContent
);
file_put_contents($modelFile, $modelContent);

// 3. Migrate
echo shell_exec("cd $baseDir && c:\\xampp\\php\\php.exe artisan migrate");

// 4. Update SearchController
$searchCtrlFile = $baseDir . '/app/Http/Controllers/SearchController.php';
$searchCtrlContent = file_get_contents($searchCtrlFile);
if (strpos($searchCtrlContent, 'use App\Models\SearchLog;') === false) {
    $searchCtrlContent = str_replace("use App\Models\SearchQuery;", "use App\Models\SearchQuery;\nuse App\Models\SearchLog;", $searchCtrlContent);
}
if (strpos($searchCtrlContent, 'SearchLog::create') === false) {
    $searchCtrlContent = str_replace(
        "\$searchQueryRecord->increment('count');",
        "\$searchQueryRecord->increment('count');\n\n        // Log untuk time-series\n        SearchLog::create(['keyword' => \$normalizedKeyword]);",
        $searchCtrlContent
    );
}
file_put_contents($searchCtrlFile, $searchCtrlContent);

// 5. Update AdminController
$adminCtrlFile = $baseDir . '/app/Http/Controllers/AdminController.php';
$adminCtrlContent = file_get_contents($adminCtrlFile);

// Import SearchLog
if (strpos($adminCtrlContent, 'use App\Models\SearchLog;') === false) {
    $adminCtrlContent = str_replace("use App\Models\SearchQuery;", "use App\Models\SearchQuery;\nuse App\Models\SearchLog;", $adminCtrlContent);
}

// Tambahkan hitungan untuk kartu pencarian di dekat $downloads
$findDownloads = <<<PHP
        // Statistik Unduhan Keseluruhan
        \$downloads = [
            'today' => DownloadLog::whereDate('created_at', \$today)->count(),
            'yesterday' => DownloadLog::whereDate('created_at', \$yesterday)->count(),
            'month' => DownloadLog::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->count(),
            'all_time' => DownloadLog::count()
        ];
PHP;

$insertSearches = <<<PHP
        // Statistik Pencarian Keseluruhan
        \$searchesStats = [
            'today' => SearchLog::whereDate('created_at', \$today)->count(),
            'yesterday' => SearchLog::whereDate('created_at', \$yesterday)->count(),
            'month' => SearchLog::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->count(),
            'all_time' => SearchLog::count()
        ];
PHP;
if (strpos($adminCtrlContent, '$searchesStats = [') === false) {
    $adminCtrlContent = str_replace($findDownloads, $findDownloads . "\n\n" . $insertSearches, $adminCtrlContent);
}

// Ganti query $popularSearches agar menggunakan SearchLog dan filter tanggal
$oldPopularSearches = <<<PHP
        // Statistik Pencarian Populer (All Time)
        \$popularSearches = SearchQuery::orderByDesc('count')->take(20)->get();
PHP;

$newPopularSearches = <<<PHP
        // Statistik Pencarian Populer (Berdasarkan Rentang Waktu)
        \$searchesQuery = SearchLog::selectRaw('keyword, count(*) as count');
        if (\$range !== 'all_time') {
            \$searchesQuery->whereBetween('created_at', [\$startDate->copy()->startOfDay(), \$endDate->copy()->endOfDay()]);
        }
        \$popularSearches = \$searchesQuery->groupBy('keyword')->orderByDesc('count')->take(20)->get();
PHP;
$adminCtrlContent = str_replace($oldPopularSearches, $newPopularSearches, $adminCtrlContent);


// Modifikasi loop grafik untuk menyertakan $chartSearches
$oldLoopsBlock = <<<PHP
        // Data Grafik
        \$chartDates = [];
        \$chartVisits = [];
        \$chartDownloads = []; // Datar, khusus visitChart
        \$chartDownloadsSeries = []; // Baru, khusus multi-line
PHP;

$newLoopsBlock = <<<PHP
        // Data Grafik
        \$chartDates = [];
        \$chartVisits = [];
        \$chartSearches = []; // Data untuk grafik pencarian
        \$chartDownloads = []; // Datar, khusus visitChart
        \$chartDownloadsSeries = []; // Baru, khusus multi-line
PHP;
$adminCtrlContent = str_replace($oldLoopsBlock, $newLoopsBlock, $adminCtrlContent);

// Loop harian chartSearches
$oldDailyLoop = <<<PHP
                \$chartVisits[] = (int) Visitor::where('visited_date', \$dateString)->sum('hits');
                
                \$totalDl = 0;
PHP;
$newDailyLoop = <<<PHP
                \$chartVisits[] = (int) Visitor::where('visited_date', \$dateString)->sum('hits');
                \$chartSearches[] = SearchLog::whereDate('created_at', \$dateString)->count();
                
                \$totalDl = 0;
PHP;
$adminCtrlContent = str_replace($oldDailyLoop, $newDailyLoop, $adminCtrlContent);

// Loop bulanan chartSearches
$oldMonthlyLoop = <<<PHP
                \$chartVisits[] = (int) Visitor::where('visited_date', 'like', \$monthString.'%')->sum('hits');
                
                \$totalDl = 0;
PHP;
$newMonthlyLoop = <<<PHP
                \$chartVisits[] = (int) Visitor::where('visited_date', 'like', \$monthString.'%')->sum('hits');
                \$chartSearches[] = SearchLog::whereYear('created_at', \$date->year)->whereMonth('created_at', \$date->month)->count();
                
                \$totalDl = 0;
PHP;
$adminCtrlContent = str_replace($oldMonthlyLoop, $newMonthlyLoop, $adminCtrlContent);


// Tambahkan responses di return
$adminCtrlContent = str_replace(
    "'downloads' => \$downloads,", 
    "'downloads' => \$downloads,\n                'searchesStats' => \$searchesStats,", 
    $adminCtrlContent
);
$adminCtrlContent = str_replace(
    "'chartDownloads' => \$chartDownloads,", 
    "'chartDownloads' => \$chartDownloads,\n                'chartSearches' => \$chartSearches,", 
    $adminCtrlContent
);
$adminCtrlContent = str_replace(
    "compact('visitors', 'downloads', 'downloadsPerDatabase', 'popularSearches', 'chartDates', 'chartVisits', 'chartDownloads', 'formattedSeries', 'currentFilter', 'customStart', 'customEnd', 'years', 'databases', 'dbFilter')",
    "compact('visitors', 'downloads', 'searchesStats', 'downloadsPerDatabase', 'popularSearches', 'chartDates', 'chartVisits', 'chartSearches', 'chartDownloads', 'formattedSeries', 'currentFilter', 'customStart', 'customEnd', 'years', 'databases', 'dbFilter')",
    $adminCtrlContent
);

file_put_contents($adminCtrlFile, $adminCtrlContent);

echo "Backend updated.\n";
