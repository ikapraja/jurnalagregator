<?php
$detailPath = 'c:/xampp/htdocs/jurnalagregator/resources/views/detail.blade.php';
$detailContent = file_get_contents($detailPath);

// 1. Add 'Simpan' button next to 'Bagikan'
$bagikanTarget = <<<HTML
                <div class="flex items-center gap-2">
                    <button @click="copyLink()" class="inline-flex items-center gap-1.5 px-4 py-2 bg-white border border-slate-200 hover:bg-slate-50 text-slate-700 text-xs font-bold rounded-lg transition shadow-sm">
HTML;
$bagikanReplacement = <<<HTML
                <div class="flex items-center gap-2">
                    <button onclick="toggleBookmark('{{ \$article->id }}', '{{ addslashes(Str::limit(\$article->title, 100)) }}')" class="inline-flex items-center gap-1.5 px-4 py-2 bg-amber-50 border border-amber-200 hover:bg-amber-100 text-amber-700 text-xs font-bold rounded-lg transition shadow-sm" title="Simpan ke Koleksi">
                        <svg class="w-4 h-4 bookmark-icon-{{ \$article->id }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"></path></svg>
                        <span class="bookmark-text-{{ \$article->id }}">Simpan</span>
                    </button>
                    <button @click="copyLink()" class="inline-flex items-center gap-1.5 px-4 py-2 bg-white border border-slate-200 hover:bg-slate-50 text-slate-700 text-xs font-bold rounded-lg transition shadow-sm">
HTML;
if (strpos($detailContent, 'bookmark-icon-') === false) {
    $detailContent = str_replace($bagikanTarget, $bagikanReplacement, $detailContent);
}

// 2. Add Floating Modal & Script (extract from search.blade.php)
$searchPath = 'c:/xampp/htdocs/jurnalagregator/resources/views/search.blade.php';
$searchContent = file_get_contents($searchPath);

// Extract the bookmark HTML/JS from search.blade.php
// It starts with <!-- Floating Bookmark Button --> and ends before </body>
$startToken = '<!-- Floating Bookmark Button -->';
$startPos = strpos($searchContent, $startToken);
$endPos = strrpos($searchContent, '</body>');

if ($startPos !== false && $endPos !== false) {
    $bookmarkHtmlJs = substr($searchContent, $startPos, $endPos - $startPos);
    
    // Make a small tweak for the detail page: we want the button text to change to 'Tersimpan'
    $bookmarkHtmlJs = str_replace(
        "el.classList.add('text-slate-400');",
        "el.classList.add('text-slate-400'); document.querySelectorAll('.bookmark-text-' + id).forEach(t => t.innerText = 'Simpan');",
        $bookmarkHtmlJs
    );
    $bookmarkHtmlJs = str_replace(
        "el.classList.remove('text-slate-400');",
        "el.classList.remove('text-slate-400'); document.querySelectorAll('.bookmark-text-' + b.id).forEach(t => t.innerText = 'Tersimpan');",
        $bookmarkHtmlJs
    );

    if (strpos($detailContent, $startToken) === false) {
        $detailContent = str_replace('</body>', $bookmarkHtmlJs . "\n</body>", $detailContent);
    }
    
    file_put_contents($detailPath, $detailContent);
    echo "Bookmark UI injected into detail.blade.php\n";
} else {
    echo "Could not find bookmark snippet in search.blade.php\n";
}
