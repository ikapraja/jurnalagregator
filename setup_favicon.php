<?php

$directory = new RecursiveDirectoryIterator('c:/xampp/htdocs/jurnalagregator/resources/views');
$iterator = new RecursiveIteratorIterator($directory);
$regex = new RegexIterator($iterator, '/^.+\.blade\.php$/i', RecursiveRegexIterator::GET_MATCH);

$faviconHtml = "\n    <!-- Favicon -->\n    <link rel=\"icon\" type=\"image/png\" href=\"{{ asset('logodashboard.png') }}\">";
$updatedFiles = 0;

foreach ($regex as $file) {
    $path = $file[0];
    $content = file_get_contents($path);

    // Cek apakah file memiliki tag <head>
    if (strpos($content, '</head>') !== false) {
        // Cek apakah sudah ada favicon logodashboard.png
        if (strpos($content, "href=\"{{ asset('logodashboard.png') }}\"") === false && strpos($content, "href='{{ asset('logodashboard.png') }}'") === false) {
            
            // Hapus favicon lama jika ada (opsional, tapi disarankan)
            $content = preg_replace('/<link[^>]*rel=["\'](?:shortcut )?icon["\'][^>]*>/i', '', $content);
            
            // Sisipkan favicon sebelum penutup head
            $content = str_replace('</head>', $faviconHtml . "\n</head>", $content);
            file_put_contents($path, $content);
            $updatedFiles++;
        }
    }
}

echo "Berhasil memperbarui favicon di $updatedFiles file blade.\n";
