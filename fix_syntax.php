<?php
$path = 'c:/xampp/htdocs/jurnalagregator/app/Http/Controllers/SearchController.php';
$content = file_get_contents($path);
$content = str_replace(
    "         = 'Export_Jurnal_'",
    "        \$filename = 'Export_Jurnal_'",
    $content
);
file_put_contents($path, $content);
echo "Syntax error fixed.\n";
