<?php

function fixBookmarkTrackingPerDb() {
    $files = [
        'c:/xampp/htdocs/jurnalagregator/resources/views/search.blade.php',
        'c:/xampp/htdocs/jurnalagregator/resources/views/detail.blade.php'
    ];
    
    foreach ($files as $path) {
        $content = file_get_contents($path);
        
        // 1. Update toggleBookmark signature
        $content = str_replace('function toggleBookmark(id, title) {', 'function toggleBookmark(id, title, source = "Unknown") {', $content);
        
        // 2. Update push to localStorage
        $content = str_replace('bookmarks.push({id: id, title: title});', 'bookmarks.push({id: id, title: title, source: source});', $content);
        
        // 3. Update the track fetch request to use the real source instead of hardcoded 'Agregator Bookmark'
        $content = str_replace("repo: 'Agregator Bookmark',", "repo: source,", $content);
        
        // 4. Update the detail page button to pass source
        // In detail.blade.php: onclick="toggleBookmark('{{ $article->id }}', '{{ addslashes(Str::limit($article->title, 100)) }}')"
        $content = preg_replace(
            "/onclick=\"toggleBookmark\('\{\{ \\\$article->id \}\}', '\{\{ addslashes\(Str::limit\(\\\$article->title, 100\)\) \}\}'\)\"/",
            "onclick=\"toggleBookmark('{{ \$article->id }}', '{{ addslashes(Str::limit(\$article->title, 100)) }}', '{{ \$article->source ?? 'Unknown' }}')\"",
            $content
        );
        
        // 5. Update the search page result button to pass source
        // In search.blade.php: onclick="toggleBookmark('${escapeHTML(item.id)}', '${escapeHTML(item.title).replace(/'/g, '\\\\\'')}')"
        $content = str_replace(
            "onclick=\"toggleBookmark('\${escapeHTML(item.id)}', '\${escapeHTML(item.title).replace(/'/g, '\\\\\\'')}')\"",
            "onclick=\"toggleBookmark('\${escapeHTML(item.id)}', '\${escapeHTML(item.title).replace(/'/g, '\\\\\\'')}', '\${escapeHTML(item.source || \'Unknown\')}')\"",
            $content
        );

        file_put_contents($path, $content);
    }
}

fixBookmarkTrackingPerDb();
echo "Bookmark tracking updated to per-database.\n";
