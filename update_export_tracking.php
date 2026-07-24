<?php

function updateExportTracking() {
    $path = 'c:/xampp/htdocs/jurnalagregator/app/Http/Controllers/SearchController.php';
    $content = file_get_contents($path);
    
    $oldCode = <<<PHP
        try {
            \App\Models\DownloadLog::create([
                'repository_name' => 'Agregator Export',
                'download_type' => 'export_' . \$format,
                'article_title' => 'Keyword: ' . \$keyword
            ]);
        } catch (\Exception \$e) {}
PHP;

    $newCode = <<<PHP
        try {
            \$now = now();
            \$logs = [];
            foreach (\$items as \$item) {
                // Determine source, default to 'Unknown' if not set
                \$repo = \$item['source'] ?? 'Unknown';
                // Capitalize properly if needed, but existing sources like 'doaj', 'crossref' are usually handled by dashboard's ucwords
                
                \$logs[] = [
                    'repository_name' => \$repo,
                    'download_type'   => 'export_' . \$format,
                    'article_title'   => \Illuminate\Support\Str::limit(\$item['title'] ?? 'Exported Article', 250),
                    'created_at'      => \$now,
                    'updated_at'      => \$now
                ];
            }
            
            // Bulk insert for high performance (1 query for up to 100 items)
            if (!empty(\$logs)) {
                // Split into chunks if there are too many, but 100 is perfectly fine for a single insert
                \App\Models\DownloadLog::insert(\$logs);
            }
        } catch (\Exception \$e) {
            // Silently fail if tracking errors out
        }
PHP;

    $content = str_replace($oldCode, $newCode, $content);
    file_put_contents($path, $content);
}

updateExportTracking();
echo "Export tracking updated for per-database stats.\n";
