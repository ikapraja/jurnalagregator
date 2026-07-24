<?php

function setupComprehensiveTracking() {
    // 1. Add API Route for silent tracking
    $apiPath = 'c:/xampp/htdocs/jurnalagregator/routes/api.php';
    $apiContent = file_get_contents($apiPath);
    if (strpos($apiContent, "Route::post('/track'") === false) {
        $trackingRoute = <<<PHP
Route::post('/track', function(\Illuminate\Http\Request \$request) {
    try {
        \App\Models\DownloadLog::create([
            'repository_name' => \$request->input('repo', 'Agregator'),
            'download_type' => \$request->input('type', 'action'),
            'article_title' => \$request->input('title', 'Unknown')
        ]);
        return response()->json(['success' => true]);
    } catch (\Exception \$e) {
        return response()->json(['success' => false], 500);
    }
});
PHP;
        $apiContent .= "\n" . $trackingRoute . "\n";
        file_put_contents($apiPath, $apiContent);
    }

    // 2. Track Exports in SearchController
    $searchControllerPath = 'c:/xampp/htdocs/jurnalagregator/app/Http/Controllers/SearchController.php';
    $scContent = file_get_contents($searchControllerPath);
    
    if (strpos($scContent, "DownloadLog::create") === false && strpos($scContent, "function export") !== false) {
        // Find the line: $filename = 'Export_Jurnal_' . \Illuminate\Support\Str::slug($keyword) . '_' . date('Ymd_His');
        $exportLogCode = <<<PHP
        $filename = 'Export_Jurnal_' . \Illuminate\Support\Str::slug(\$keyword) . '_' . date('Ymd_His');
        
        try {
            \App\Models\DownloadLog::create([
                'repository_name' => 'Agregator Export',
                'download_type' => 'export_' . \$format,
                'article_title' => 'Keyword: ' . \$keyword
            ]);
        } catch (\Exception \$e) {}
PHP;
        $scContent = str_replace(
            "\$filename = 'Export_Jurnal_' . \Illuminate\Support\Str::slug(\$keyword) . '_' . date('Ymd_His');",
            $exportLogCode,
            $scContent
        );
        file_put_contents($searchControllerPath, $scContent);
    }

    // 3. Track Share in detail.blade.php
    $detailPath = 'c:/xampp/htdocs/jurnalagregator/resources/views/detail.blade.php';
    $detailContent = file_get_contents($detailPath);
    
    // Replace the copyLink() JS block with one that includes a fetch to the API
    $oldXData = "x-data=\"{ 
        copiedLink: false, 
        copyLink() { 
            if (navigator.share) {
                navigator.share({
                    title: '{{ addslashes(Str::limit(\$article->title, 100)) }}',
                    text: 'Baca jurnal menarik ini di Agregator Jurnal PKTJ:',
                    url: window.location.href
                }).catch(console.error);
            } else {
                navigator.clipboard.writeText(window.location.href); 
                this.copiedLink = true; 
                setTimeout(() => this.copiedLink = false, 2000); 
            }
        } 
    }\"";

    $newXData = "x-data=\"{ 
        copiedLink: false, 
        copyLink() { 
            fetch('/jurnalagregator/public/api/track', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
                body: JSON.stringify({
                    type: 'share_link',
                    repo: '{{ \$article->source ?? 'Agregator' }}',
                    title: '{{ addslashes(Str::limit(\$article->title, 100)) }}'
                })
            }).catch(e => console.log(e));

            if (navigator.share) {
                navigator.share({
                    title: '{{ addslashes(Str::limit(\$article->title, 100)) }}',
                    text: 'Baca jurnal menarik ini di Agregator Jurnal PKTJ:',
                    url: window.location.href
                }).catch(console.error);
            } else {
                navigator.clipboard.writeText(window.location.href); 
                this.copiedLink = true; 
                setTimeout(() => this.copiedLink = false, 2000); 
            }
        } 
    }\"";

    // Use plain str_replace for safety
    if (strpos($detailContent, "fetch('/jurnalagregator/public/api/track'") === false) {
        $detailContent = str_replace($oldXData, $newXData, $detailContent);
        file_put_contents($detailPath, $detailContent);
    }
}

setupComprehensiveTracking();
echo "Tracking updated successfully.\n";
