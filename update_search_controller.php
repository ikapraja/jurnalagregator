<?php

$path = 'c:/xampp/htdocs/jurnalagregator/app/Http/Controllers/SearchController.php';
$content = file_get_contents($path);

// Insert DownloadLog import at the top
if (strpos($content, 'use App\Models\DownloadLog;') === false) {
    $content = str_replace(
        'use App\Models\Article;',
        "use App\Models\Article;\nuse App\Models\DownloadLog;",
        $content
    );
}

// Find the export method start
$searchStr = '$filename = \'Export_Jurnal_\' . date(\'Ymd_His\');';
$logCode = <<<PHP
\$filename = 'Export_Jurnal_' . date('Ymd_His');

        // Track the export for each database
        try {
            \$logs = [];
            foreach (\$items as \$item) {
                \$repoName = isset(\$item->repository) && is_object(\$item->repository) ? \$item->repository->name : 'Lokal';
                \$logs[] = [
                    'repository_name' => \$repoName,
                    'download_type' => 'export_' . \$format,
                    'article_title' => \$item->title,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
            if (count(\$logs) > 0) {
                DownloadLog::insert(\$logs);
            }
        } catch (\Exception \$e) {
            // Abaikan jika gagal
        }
PHP;

if (strpos($content, '// Track the export for each database') === false) {
    $content = str_replace($searchStr, $logCode, $content);
    file_put_contents($path, $content);
    echo "SearchController updated for tracking exports.\n";
} else {
    echo "Tracking already exists.\n";
}
