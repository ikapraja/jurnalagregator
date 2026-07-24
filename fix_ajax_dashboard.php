<?php

// 1. Fix AdminController
$controllerPath = 'c:/xampp/htdocs/jurnalagregator/app/Http/Controllers/AdminController.php';
$controllerContent = file_get_contents($controllerPath);

$oldJson = <<<PHP
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
PHP;

$newJson = <<<PHP
        if (\$request->ajax()) {
            return response()->json([
                'visitors' => \$visitors,
                'downloads' => \$downloads,
                'downloadsPerDatabase' => \$downloadsPerDatabase,
                'popularSearches' => \$popularSearches,
                'chartDates' => \$chartDates,
                'chartVisits' => \$chartVisits,
                'chartDownloads' => \$chartDownloads,
                'customStart' => \$customStart,
                'customEnd' => \$customEnd,
                'currentFilter' => \$currentFilter
            ]);
        }
PHP;

$controllerContent = str_replace($oldJson, $newJson, $controllerContent);
file_put_contents($controllerPath, $controllerContent);


// 2. Fix Dashboard Blade
$bladePath = 'c:/xampp/htdocs/jurnalagregator/resources/views/admin/dashboard.blade.php';
$bladeContent = file_get_contents($bladePath);

// Fix duplicate tbody id
$oldHtml = <<<HTML
                                </thead>
                                <tbody id="tbody-db-ranking">
                                    @forelse(\$popularSearches as \$index => \$search)
HTML;

$newHtml = <<<HTML
                                </thead>
                                <tbody id="tbody-popular-searches">
                                    @forelse(\$popularSearches as \$index => \$search)
HTML;
$bladeContent = str_replace($oldHtml, $newHtml, $bladeContent);

// Add input updating to JS
$oldJs = <<<JS
                document.getElementById('tbody-popular-searches').innerHTML = searchHtml;

                // Update Chart
JS;

$newJs = <<<JS
                document.getElementById('tbody-popular-searches').innerHTML = searchHtml;

                // Update Inputs & Select
                const startInput = document.querySelector('input[name="start_date"]');
                const endInput = document.querySelector('input[name="end_date"]');
                const rangeSelect = document.querySelector('select');
                if (startInput) startInput.value = data.customStart || '';
                if (endInput) endInput.value = data.customEnd || '';
                if (rangeSelect) rangeSelect.value = data.currentFilter || '7_days';

                // Update Chart
JS;

$bladeContent = str_replace($oldJs, $newJs, $bladeContent);
file_put_contents($bladePath, $bladeContent);

echo "Fix applied successfully.\n";
