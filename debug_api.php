<?php
$content = file_get_contents('c:/xampp/htdocs/jurnalagregator/routes/api.php');
$content = str_replace(
    "} catch (\Exception \$e) {",
    "} catch (\Throwable \$e) {\n        \Illuminate\Support\Facades\Log::error('API Track Error: ' . \$e->getMessage());",
    $content
);
file_put_contents('c:/xampp/htdocs/jurnalagregator/routes/api.php', $content);
