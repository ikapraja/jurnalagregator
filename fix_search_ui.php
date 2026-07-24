<?php

function fixUI() {
    $path = 'c:/xampp/htdocs/jurnalagregator/resources/views/search.blade.php';
    $content = file_get_contents($path);
    
    // 1. Make grid responsive: 3 columns on medium screens, 6 on large screens
    $content = str_replace('md:grid-cols-6', 'lg:grid-cols-6 md:grid-cols-3', $content);
    
    // 2. Shorten placeholders
    $content = str_replace('placeholder="Contoh: {{ date(\'Y\') - 5 }}"', 'placeholder="{{ date(\'Y\') - 5 }}"', $content);
    $content = str_replace('placeholder="Contoh: {{ date(\'Y\') }}"', 'placeholder="{{ date(\'Y\') }}"', $content);
    
    // 3. Shorten "Semua Database" to "Semua" to save space
    $content = str_replace('>Semua Database</option>', '>Semua</option>', $content);
    
    // 4. Add arXiv if not present
    if (strpos($content, '<option value="arxiv"') === false) {
        $europePmc = '<option value="europepmc" {{ request(\'source\') == \'europepmc\' ? \'selected\' : \'\' }}>Europe PMC</option>';
        $europePmcWithArxiv = $europePmc . "\n                                    " . '<option value="arxiv" {{ request(\'source\') == \'arxiv\' ? \'selected\' : \'\' }}>arXiv</option>';
        $content = str_replace($europePmc, $europePmcWithArxiv, $content);
    }
    
    // 5. Slightly reduce padding on inputs to ensure everything fits perfectly
    $content = str_replace('py-3 px-3 rounded-xl', 'py-3 px-2.5 rounded-xl', $content);
    
    file_put_contents($path, $content);
}

fixUI();
echo "UI fixed successfully.\n";
