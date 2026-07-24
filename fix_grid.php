<?php

function fixGrid() {
    $path = 'c:/xampp/htdocs/jurnalagregator/resources/views/search.blade.php';
    $content = file_get_contents($path);
    
    // Change lg:grid-cols-6 to custom fractions to make the 'Sumber' column wider
    $content = str_replace(
        'lg:grid-cols-6 md:grid-cols-3', 
        'lg:grid-cols-[1fr_1fr_1fr_1.5fr_1fr_1fr] md:grid-cols-3', 
        $content
    );
    
    // Restore nice padding so it doesn't look squeezed
    $content = str_replace('py-3 px-2.5', 'py-3 px-4', $content);
    
    file_put_contents($path, $content);
}

fixGrid();
echo "Grid fixed.\n";
