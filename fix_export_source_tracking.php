<?php

function fixExportSourceTracking() {
    $path = 'c:/xampp/htdocs/jurnalagregator/app/Http/Controllers/SearchController.php';
    $content = file_get_contents($path);
    
    // Fix repo extraction logic
    $oldLine = "\$repo = is_array(\$item) ? (\$item['source'] ?? 'Unknown') : (\$item->source ?? 'Unknown');";
    $newLine = "\$repo = is_array(\$item) ? (\$item['source'] ?? 'Unknown') : (\$item->source ?? (isset(\$item->repository) && is_object(\$item->repository) ? \$item->repository->name : 'Unknown'));";
    
    if (strpos($content, $oldLine) !== false) {
        $content = str_replace($oldLine, $newLine, $content);
        file_put_contents($path, $content);
        echo "SearchController updated successfully.\n";
    } else {
        echo "Line not found in SearchController.\n";
    }
}

fixExportSourceTracking();

