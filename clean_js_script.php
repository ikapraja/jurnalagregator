<?php

function completelyFixScriptBlock($path) {
    $content = file_get_contents($path);
    
    $cleanScript = <<<'HTML'
<script>
    let bookmarks = JSON.parse(localStorage.getItem('pktj_bookmarks') || '[]');

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

    function escapeHTML(str) {
        return (str || '').toString().replace(/[&<>'"]/g, 
            tag => ({
                '&': '&amp;',
                '<': '&lt;',
                '>': '&gt;',
                "'": '&#39;',
                '"': '&quot;'
            }[tag] || tag)
        );
    }

    function openBookmarkModal() {
        document.getElementById('bookmark-modal').classList.remove('hidden');
        let list = document.getElementById('bookmark-list');
        if (bookmarks.length === 0) {
            list.innerHTML = '<div class="text-center py-10 text-slate-500"><svg class="w-16 h-16 mx-auto mb-4 text-slate-200" fill="currentColor" viewBox="0 0 24 24"><path d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"></path></svg><h3 class="font-bold text-lg mb-1">Koleksi Masih Kosong</h3><p class="text-sm">Simpan jurnal menarik dengan mengklik ikon pita pada hasil pencarian.</p></div>';
            return;
        }
        
        let basePath = window.location.pathname.replace(/\/search$/, '').replace(/\/$/, '');
        if (!basePath.includes('public')) basePath += '/public'; 

        list.innerHTML = bookmarks.map(b => `
            <div class="flex justify-between items-center p-4 border border-slate-100 rounded-xl mb-3 hover:bg-slate-50 transition shadow-sm">
                <a href="${basePath}/article/${b.id}" class="text-[13px] font-bold text-[#1E3A8A] hover:text-amber-600 line-clamp-2 w-5/6 transition leading-relaxed">${escapeHTML(b.title)}</a>
                <button onclick="window.toggleBookmark('${escapeHTML(b.id)}', '${escapeHTML(b.title).replace(/'/g, '\\'')}'); window.openBookmarkModal()" class="text-red-400 hover:text-red-600 p-2 bg-red-50 hover:bg-red-100 rounded-lg transition" title="Hapus"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg></button>
            </div>
        `).join('');
    }

    function closeBookmarkModal() {
        document.getElementById('bookmark-modal').classList.add('hidden');
    }

    document.addEventListener('DOMContentLoaded', updateBookmarkUI);
</script>
HTML;

    // Use regex to replace the entire script block at the end of the file
    $content = preg_replace('/<script>\s*let bookmarks = JSON\.parse.*?<\/script>/s', $cleanScript, $content);
    
    // Also, ensure the bookmark button in detail.blade.php has onclick, not @click which can be intercepted by Alpine
    $content = str_replace(
        '@click="window.toggleBookmark(',
        'onclick="window.toggleBookmark(',
        $content
    );

    file_put_contents($path, $content);
}

completelyFixScriptBlock('c:/xampp/htdocs/jurnalagregator/resources/views/search.blade.php');
completelyFixScriptBlock('c:/xampp/htdocs/jurnalagregator/resources/views/detail.blade.php');

echo "Script block completely rewritten.\n";
