<?php

$path = 'c:/xampp/htdocs/jurnalagregator/routes/web.php';
$content = file_get_contents($path);

// Cek apakah route meetyourmaker sudah ada
if (strpos($content, '/meetyourmaker') === false) {
    $easterEggRoute = "\n// Easter Egg Route\nRoute::get('/meetyourmaker', function () {\n    return redirect('https://www.linkedin.com/in/bagusikapraja/');\n});\n";
    $content .= $easterEggRoute;
    file_put_contents($path, $content);
    echo "Easter egg route added successfully.\n";
} else {
    echo "Easter egg route already exists.\n";
}
