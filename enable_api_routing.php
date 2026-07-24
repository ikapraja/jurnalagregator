<?php

function fixLaravel11ApiRouting() {
    $path = 'c:/xampp/htdocs/jurnalagregator/bootstrap/app.php';
    $content = file_get_contents($path);
    
    // Add API routes mapping to bootstrap/app.php
    $oldLine = "web: __DIR__.'/../routes/web.php',";
    $newLine = "web: __DIR__.'/../routes/web.php',\n        api: __DIR__.'/../routes/api.php',";
    
    if (strpos($content, "api: __DIR__") === false) {
        $content = str_replace($oldLine, $newLine, $content);
        file_put_contents($path, $content);
        echo "API routing enabled in bootstrap/app.php\n";
    } else {
        echo "API routing already enabled.\n";
    }
}

fixLaravel11ApiRouting();
