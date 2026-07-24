<?php
$files = [
    'resources/views/search.blade.php',
    'resources/views/how-to-use.blade.php',
    'resources/views/detail.blade.php',
    'resources/views/faq.blade.php',
    'resources/views/about.blade.php',
];

foreach ($files as $file) {
    $path = 'c:/xampp/htdocs/jurnalagregator/' . $file;
    if (file_exists($path)) {
        $content = file_get_contents($path);
        // Replace pb-12 in the footer tag
        $content = str_replace('<footer class="relative bg-[#1E3A8A] pt-16 pb-12 mt-auto', '<footer class="relative bg-[#1E3A8A] pt-16 mt-auto', $content);
        file_put_contents($path, $content);
        echo "Updated $file\n";
    }
}
?>
