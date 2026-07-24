<?php
$path = 'c:/xampp/htdocs/jurnalagregator/resources/views/search.blade.php';
$content = file_get_contents($path);

// Ekstrak bagian marquee lama
preg_match('/<div class="relative flex overflow-x-hidden group">(.*?)<\/div>\s*<\/div>\s*<style>/s', $content, $matches);

if (isset($matches[1])) {
    $oldMarquee = $matches[1];
    
    // Siapkan set HTML baru (2 set untuk infinite loop)
    $links = [
        ['name' => 'Crossref', 'url' => 'https://www.crossref.org/', 'color' => 'hover:text-blue-500 hover:drop-shadow-[0_0_12px_rgba(59,130,246,0.8)]'],
        ['name' => 'DOAJ', 'url' => 'https://doaj.org/', 'color' => 'hover:text-emerald-500 hover:drop-shadow-[0_0_12px_rgba(16,185,129,0.8)]'],
        ['name' => 'Semantic Scholar', 'url' => 'https://www.semanticscholar.org/', 'color' => 'hover:text-purple-500 hover:drop-shadow-[0_0_12px_rgba(168,85,247,0.8)]'],
        ['name' => 'OpenAlex', 'url' => 'https://openalex.org/', 'color' => 'hover:text-orange-500 hover:drop-shadow-[0_0_12px_rgba(249,115,22,0.8)]'],
        ['name' => 'CORE', 'url' => 'https://core.ac.uk/', 'color' => 'hover:text-slate-800 hover:drop-shadow-[0_0_12px_rgba(30,41,59,0.5)]'],
        ['name' => 'IEEE Xplore', 'url' => 'https://ieeexplore.ieee.org/', 'color' => 'hover:text-cyan-600 hover:drop-shadow-[0_0_12px_rgba(8,145,178,0.8)]'],
        ['name' => 'Europe PMC', 'url' => 'https://europepmc.org/', 'color' => 'hover:text-teal-500 hover:drop-shadow-[0_0_12px_rgba(20,184,166,0.8)]'],
        ['name' => 'arXiv', 'url' => 'https://arxiv.org/', 'color' => 'hover:text-red-600 hover:drop-shadow-[0_0_12px_rgba(220,38,38,0.8)]']
    ];
    
    $setHtml = "";
    foreach ($links as $link) {
        $setHtml .= "\n                    <a href=\"{$link['url']}\" target=\"_blank\" class=\"mx-8 font-extrabold text-2xl tracking-tight text-slate-400 transition-all duration-300 {$link['color']}\">{$link['name']}</a>";
    }
    
    $newMarquee = <<<HTML

                <div class="flex animate-marquee whitespace-nowrap items-center group-hover:pause-animation">
                    <!-- Set 1 -->$setHtml
                    <!-- Set 2 -->$setHtml
                </div>
                <!-- Absolute Clone -->
                <div class="absolute top-0 flex animate-marquee2 whitespace-nowrap items-center group-hover:pause-animation">
                    <!-- Set 1 -->$setHtml
                    <!-- Set 2 -->$setHtml
                </div>
            
HTML;

    $content = str_replace($oldMarquee, $newMarquee, $content);
    file_put_contents($path, $content);
    echo "Marquee updated to uniform links with glow effect.\n";
} else {
    echo "Failed to find marquee block.\n";
}
?>
