<?php

function trackBookmark() {
    $files = [
        'c:/xampp/htdocs/jurnalagregator/resources/views/search.blade.php',
        'c:/xampp/htdocs/jurnalagregator/resources/views/detail.blade.php'
    ];
    
    foreach ($files as $path) {
        $content = file_get_contents($path);
        
        $oldPush = 'bookmarks.push({id: id, title: title});';
        
        // Add fetch logic to track bookmark
        $newPush = <<<JS
            bookmarks.push({id: id, title: title});
            // Track bookmark as engagement/download
            fetch('/jurnalagregator/public/api/track', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
                body: JSON.stringify({
                    type: 'bookmark_add',
                    repo: 'Agregator Bookmark',
                    title: title
                })
            }).catch(e => console.log(e));
JS;
        
        // Only replace if not already tracked
        if (strpos($content, "type: 'bookmark_add'") === false) {
            $content = str_replace($oldPush, $newPush, $content);
            file_put_contents($path, $content);
        }
    }
}

trackBookmark();
echo "Bookmark tracking added.\n";
