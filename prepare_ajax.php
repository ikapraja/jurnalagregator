<?php

// 1. Update AdminController
$controllerPath = 'c:/xampp/htdocs/jurnalagregator/app/Http/Controllers/AdminController.php';
$controllerContent = file_get_contents($controllerPath);

$oldReturn = <<<PHP
        // Variabel untuk UI
        \$currentFilter = \$range;
        \$customStart = \$startDateStr;
        \$customEnd = \$endDateStr;
        \$years = [\$currentYear, \$currentYear - 1, \$currentYear - 2, \$currentYear - 3];

        return view('admin.dashboard', compact('visitors', 'downloads', 'downloadsPerDatabase', 'popularSearches', 'chartDates', 'chartVisits', 'chartDownloads', 'currentFilter', 'customStart', 'customEnd', 'years'));
PHP;

$newReturn = <<<PHP
        // Variabel untuk UI
        \$currentFilter = \$range;
        \$customStart = \$startDateStr;
        \$customEnd = \$endDateStr;
        \$years = [\$currentYear, \$currentYear - 1, \$currentYear - 2, \$currentYear - 3];

        // Jika ini adalah request AJAX dari JavaScript, kembalikan response JSON
        if (\$request->ajax()) {
            return response()->json([
                'visitors' => \$visitors,
                'downloads' => \$downloads,
                'downloadsPerDatabase' => \$downloadsPerDatabase,
                'popularSearches' => \$popularSearches,
                'chartDates' => \$chartDates,
                'chartVisits' => \$chartVisits,
                'chartDownloads' => \$chartDownloads
            ]);
        }

        return view('admin.dashboard', compact('visitors', 'downloads', 'downloadsPerDatabase', 'popularSearches', 'chartDates', 'chartVisits', 'chartDownloads', 'currentFilter', 'customStart', 'customEnd', 'years'));
PHP;

if (strpos($controllerContent, 'if ($request->ajax())') === false) {
    $controllerContent = str_replace($oldReturn, $newReturn, $controllerContent);
    file_put_contents($controllerPath, $controllerContent);
    echo "AdminController updated.\n";
}

// 2. Update Dashboard Blade
$bladePath = 'c:/xampp/htdocs/jurnalagregator/resources/views/admin/dashboard.blade.php';
$bladeContent = file_get_contents($bladePath);

// Kita butuh fungsi replace yang canggih karena banyak perubahan struktur HTML.
// Lebih baik saya overwrite keseluruhan Blade file menggunakan preg_replace atau nulis ulang sepenuhnya bagian utama.
// Tapi karena file dashboard.blade.php cukup panjang, saya akan tulis file update_dashboard_ajax.php yang menggunakan regex.
