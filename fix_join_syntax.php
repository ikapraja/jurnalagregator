<?php
$file = 'c:/xampp/htdocs/jurnalagregator/resources/views/search.blade.php';
$content = file_get_contents($file);
$content = str_replace("`).join(''););", "`).join('');", $content);
file_put_contents($file, $content);
echo "Syntax error fixed.\n";
