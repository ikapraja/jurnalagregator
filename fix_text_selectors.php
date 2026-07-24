<?php

function fixBookmarkTextJs($path) {
    $content = file_get_contents($path);
    
    // Completely rewrite the two functions to be perfect
    $target = '/function updateBookmarkUI\(\) \{.*?function toggleBookmark\(id, title\) \{.*?\}/s';
    
    // We only want to replace up to the end of toggleBookmark
    // So let's just use string replacement on the exact functions
    
    $newFunctions = <<<JS
function updateBookmarkUI() {
        let countEl = document.getElementById('bookmark-count');
        if(countEl) countEl.innerText = bookmarks.length;
        
        document.querySelectorAll('[class*="bookmark-icon-"]').forEach(el => el.setAttribute('fill', 'none'));
        bookmarks.forEach(b => {
            document.querySelectorAll('[class*="bookmark-icon-' + b.id + '"]').forEach(el => {
                el.setAttribute('fill', 'currentColor');
                el.classList.add('text-amber-500');
                el.classList.remove('text-slate-400');
            });
            document.querySelectorAll('[class*="bookmark-text-' + b.id + '"]').forEach(t => t.innerText = 'Tersimpan');
        });
    }

    function toggleBookmark(id, title) {
        let index = bookmarks.findIndex(b => b.id === id);
        if (index > -1) {
            bookmarks.splice(index, 1);
            document.querySelectorAll('[class*="bookmark-icon-' + id + '"]').forEach(el => {
                el.setAttribute('fill', 'none');
                el.classList.remove('text-amber-500');
                el.classList.add('text-slate-400');
            });
            document.querySelectorAll('[class*="bookmark-text-' + id + '"]').forEach(t => t.innerText = 'Simpan');
        } else {
            bookmarks.push({id: id, title: title});
        }
        localStorage.setItem('pktj_bookmarks', JSON.stringify(bookmarks));
        updateBookmarkUI();
    }
JS;

    // Use regex to replace both functions safely
    $content = preg_replace('/function updateBookmarkUI\(\) \{.*?updateBookmarkUI\(\);\n    \}/s', $newFunctions, $content);

    file_put_contents($path, $content);
}

fixBookmarkTextJs('c:/xampp/htdocs/jurnalagregator/resources/views/search.blade.php');
fixBookmarkTextJs('c:/xampp/htdocs/jurnalagregator/resources/views/detail.blade.php');

echo "Text selectors fixed successfully.\n";
