<?php

function fixExportFilename() {
    $searchControllerPath = 'c:/xampp/htdocs/jurnalagregator/app/Http/Controllers/SearchController.php';
    $scContent = file_get_contents($searchControllerPath);
    
    // Add Access-Control-Expose-Headers to JSON
    $scContent = str_replace(
        "'Content-Disposition' => 'attachment; filename=\"' . \$filename . '.json\"'",
        "'Content-Disposition' => 'attachment; filename=\"' . \$filename . '.json\"',\n                'Access-Control-Expose-Headers' => 'Content-Disposition'",
        $scContent
    );
    
    // Add Access-Control-Expose-Headers to Bibtex
    $scContent = str_replace(
        "'Content-Disposition' => 'attachment; filename=\"' . \$filename . '.bib\"'",
        "'Content-Disposition' => 'attachment; filename=\"' . \$filename . '.bib\"',\n                'Access-Control-Expose-Headers' => 'Content-Disposition'",
        $scContent
    );
    
    // Add Access-Control-Expose-Headers to CSV
    $scContent = str_replace(
        "\"Content-Disposition\" => \"attachment; filename=\\\"{\$filename}.csv\\\"\",",
        "\"Content-Disposition\" => \"attachment; filename=\\\"{\$filename}.csv\\\"\",\n                \"Access-Control-Expose-Headers\" => \"Content-Disposition\",",
        $scContent
    );
    
    file_put_contents($searchControllerPath, $scContent);
    
    // Fix search.blade.php Javascript fallback
    $bladePath = 'c:/xampp/htdocs/jurnalagregator/resources/views/search.blade.php';
    $bladeContent = file_get_contents($bladePath);
    
    $oldFallback = "let filename = 'Export_Jurnal_' + format + '.txt';";
    $newFallback = <<<JS
                            let ext = '.txt';
                            if (format.toLowerCase() === 'csv') ext = '.csv';
                            if (format.toLowerCase() === 'json') ext = '.json';
                            if (format.toLowerCase() === 'bibtex') ext = '.bib';
                            
                            // Ambil query dari URL jika ada
                            let urlObj = new URL(url, window.location.origin);
                            let q = urlObj.searchParams.get('q') || 'Data';
                            q = q.replace(/[^a-z0-9]/gi, '_').toLowerCase();
                            
                            let dateStr = new Date().toISOString().replace(/T/, '_').replace(/\..+/, '').replace(/-/g, '').replace(/:/g, '');
                            let filename = 'Export_Jurnal_' + q + '_' + dateStr + ext;
JS;

    if (strpos($bladeContent, "let filename = 'Export_Jurnal_' + format + '.txt';") !== false) {
        $bladeContent = str_replace($oldFallback, $newFallback, $bladeContent);
        file_put_contents($bladePath, $bladeContent);
    }
}

fixExportFilename();
echo "Export filename logic fixed.\n";
