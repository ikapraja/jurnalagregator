<?php

function fixFetchUrl() {
    $files = [
        'c:/xampp/htdocs/jurnalagregator/resources/views/search.blade.php',
        'c:/xampp/htdocs/jurnalagregator/resources/views/detail.blade.php'
    ];
    
    foreach ($files as $path) {
        $content = file_get_contents($path);
        
        // Replace hardcoded url with Laravel url helper
        $content = str_replace(
            "fetch('/jurnalagregator/public/api/track', {",
            "fetch('{{ url(\"/api/track\") }}', {",
            $content
        );
        
        file_put_contents($path, $content);
    }
}

fixFetchUrl();
echo "Fetch URL fixed.\n";
