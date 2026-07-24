<?php

function fixColorsAndJS() {
    $detailPath = 'c:/xampp/htdocs/jurnalagregator/resources/views/detail.blade.php';
    $searchPath = 'c:/xampp/htdocs/jurnalagregator/resources/views/search.blade.php';
    
    // 1. Update Button in detail.blade.php to be white by default and add bookmark-btn-ID
    $detailContent = file_get_contents($detailPath);
    
    $oldButton = '<button onclick="window.toggleBookmark(\'{{ $article->id }}\', \'{{ addslashes(Str::limit($article->title, 100)) }}\')" class="inline-flex items-center gap-1.5 px-4 py-2 bg-amber-50 border border-amber-200 hover:bg-amber-100 text-amber-700 text-xs font-bold rounded-lg transition shadow-sm" title="Simpan ke Koleksi">';
    $newButton = '<button onclick="toggleBookmark(\'{{ $article->id }}\', \'{{ addslashes(Str::limit($article->title, 100)) }}\')" class="bookmark-btn-{{ $article->id }} inline-flex items-center gap-1.5 px-4 py-2 bg-white border border-slate-200 hover:bg-slate-50 text-slate-700 text-xs font-bold rounded-lg transition shadow-sm" title="Simpan ke Koleksi">';
    
    $detailContent = str_replace($oldButton, $newButton, $detailContent);
    // Also handle if they are already white or have @click
    $detailContent = preg_replace(
        '/<button [^>]*toggleBookmark[^>]*class="[^"]*bookmark-btn-{{ \$article->id }}[^"]*"[^>]*>/', 
        $newButton, 
        $detailContent
    );
    file_put_contents($detailPath, $detailContent);
    
    // 2. Rewrite JS block for both to include background color toggling
    $jsTemplate = <<<'HTML'
<script>
    let bookmarks = JSON.parse(localStorage.getItem('pktj_bookmarks') || '[]');

    function updateBookmarkUI() {
        let countEl = document.getElementById('bookmark-count');
        if(countEl) countEl.innerText = bookmarks.length;
        
        document.querySelectorAll('[class*="bookmark-icon-"]').forEach(el => el.setAttribute('fill', 'none'));
        
        // Reset all detail buttons to white
        document.querySelectorAll('[class*="bookmark-btn-"]').forEach(el => {
            el.classList.add('bg-white', 'border-slate-200', 'text-slate-700', 'hover:bg-slate-50');
            el.classList.remove('bg-amber-50', 'border-amber-200', 'text-amber-700', 'hover:bg-amber-100');
        });

        bookmarks.forEach(b => {
            document.querySelectorAll('[class*="bookmark-icon-' + b.id + '"]').forEach(el => {
                el.setAttribute('fill', 'currentColor');
                el.classList.add('text-amber-500');
                el.classList.remove('text-slate-400');
            });
            document.querySelectorAll('[class*="bookmark-text-' + b.id + '"]').forEach(t => t.innerText = 'Tersimpan');
            
            // Set detail button to yellow
            document.querySelectorAll('[class*="bookmark-btn-' + b.id + '"]').forEach(el => {
                el.classList.remove('bg-white', 'border-slate-200', 'text-slate-700', 'hover:bg-slate-50');
                el.classList.add('bg-amber-50', 'border-amber-200', 'text-amber-700', 'hover:bg-amber-100');
            });
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
            document.querySelectorAll('[class*="bookmark-btn-' + id + '"]').forEach(el => {
                el.classList.add('bg-white', 'border-slate-200', 'text-slate-700', 'hover:bg-slate-50');
                el.classList.remove('bg-amber-50', 'border-amber-200', 'text-amber-700', 'hover:bg-amber-100');
            });
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
        
        let baseUrl = '{{ url('/') }}';

        list.innerHTML = bookmarks.map(b => `
            <div class="flex justify-between items-center p-4 border border-slate-100 rounded-xl mb-3 hover:bg-slate-50 transition shadow-sm">
                <a href="${baseUrl}/article/${b.id}" class="text-[13px] font-bold text-[#1E3A8A] hover:text-amber-600 line-clamp-2 w-5/6 transition leading-relaxed">${escapeHTML(b.title)}</a>
                <button onclick="toggleBookmark('${escapeHTML(b.id)}', '${escapeHTML(b.title).replace(/'/g, '\\'')}'); openBookmarkModal()" class="text-red-400 hover:text-red-600 p-2 bg-red-50 hover:bg-red-100 rounded-lg transition" title="Hapus"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg></button>
            </div>
        `).join('');
    }

    function closeBookmarkModal() {
        document.getElementById('bookmark-modal').classList.add('hidden');
    }

    document.addEventListener('DOMContentLoaded', updateBookmarkUI);
</script>
HTML;

    // Apply JS replacement
    foreach([$detailPath, $searchPath] as $path) {
        $content = file_get_contents($path);
        $content = preg_replace('/<script>\s*let bookmarks = JSON\.parse.*?<\/script>/s', $jsTemplate, $content);
        file_put_contents($path, $content);
    }
}

fixColorsAndJS();
echo "Colors and JS updated successfully.\n";
