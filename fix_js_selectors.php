<?php

function fixBookmarkJs($path) {
    $content = file_get_contents($path);
    
    // Replace the updateBookmarkUI function
    $targetUpdate = '/function updateBookmarkUI\(\) \{.*?\}/s';
    $newUpdate = <<<JS
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
            document.querySelectorAll('.bookmark-text-' + b.id).forEach(t => t.innerText = 'Tersimpan');
        });
    }
JS;
    $content = preg_replace($targetUpdate, $newUpdate, $content);

    // Replace the toggleBookmark function
    $targetToggle = '/function toggleBookmark\(id, title\) \{.*?\}/s';
    $newToggle = <<<JS
function toggleBookmark(id, title) {
        let index = bookmarks.findIndex(b => b.id === id);
        if (index > -1) {
            bookmarks.splice(index, 1);
            document.querySelectorAll('[class*="bookmark-icon-' + id + '"]').forEach(el => {
                el.setAttribute('fill', 'none');
                el.classList.remove('text-amber-500');
                el.classList.add('text-slate-400');
            });
            document.querySelectorAll('.bookmark-text-' + id).forEach(t => t.innerText = 'Simpan');
        } else {
            bookmarks.push({id: id, title: title});
        }
        localStorage.setItem('pktj_bookmarks', JSON.stringify(bookmarks));
        updateBookmarkUI();
    }
JS;
    $content = preg_replace($targetToggle, $newToggle, $content);

    // Also change onclick in Alpine to @click just in case Alpine is swallowing native clicks
    // In detail.blade.php it's inside the toolbar Alpine scope
    $content = str_replace(
        'onclick="toggleBookmark(',
        '@click="window.toggleBookmark(',
        $content
    );

    file_put_contents($path, $content);
}

fixBookmarkJs('c:/xampp/htdocs/jurnalagregator/resources/views/search.blade.php');
fixBookmarkJs('c:/xampp/htdocs/jurnalagregator/resources/views/detail.blade.php');

echo "JavaScript fixed successfully.\n";
