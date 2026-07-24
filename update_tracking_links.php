<?php

$searchPath = 'c:/xampp/htdocs/jurnalagregator/resources/views/search.blade.php';
$searchContent = file_get_contents($searchPath);

// Replace Source URL in search.blade.php
$searchContent = str_replace(
    '<a href="{{ $article->source_url }}" target="_blank" class="block mb-2 group">',
    '<a href="{{ route(\'track.redirect\', [\'url\' => $article->source_url, \'repo\' => $repoName, \'type\' => \'click_source\', \'title\' => $article->title]) }}" target="_blank" class="block mb-2 group">',
    $searchContent
);
$searchContent = str_replace(
    '<a href="{{ $article->source_url }}" target="_blank" rel="noreferrer noopener" class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-white border border-slate-200 hover:border-slate-300 hover:bg-slate-50 text-slate-700 text-xs font-bold rounded-lg transition">',
    '<a href="{{ route(\'track.redirect\', [\'url\' => $article->source_url, \'repo\' => $repoName, \'type\' => \'click_source\', \'title\' => $article->title]) }}" target="_blank" rel="noreferrer noopener" class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-white border border-slate-200 hover:border-slate-300 hover:bg-slate-50 text-slate-700 text-xs font-bold rounded-lg transition">',
    $searchContent
);

// Replace DOI in search.blade.php
$searchContent = str_replace(
    '<a href="{{ $doiUrl }}" target="_blank" rel="noreferrer noopener" class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-white border border-slate-200 hover:border-slate-300 hover:bg-slate-50 text-slate-700 text-xs font-bold rounded-lg transition">',
    '<a href="{{ route(\'track.redirect\', [\'url\' => $doiUrl, \'repo\' => $repoName, \'type\' => \'click_doi\', \'title\' => $article->title]) }}" target="_blank" rel="noreferrer noopener" class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-white border border-slate-200 hover:border-slate-300 hover:bg-slate-50 text-slate-700 text-xs font-bold rounded-lg transition">',
    $searchContent
);
file_put_contents($searchPath, $searchContent);


$detailPath = 'c:/xampp/htdocs/jurnalagregator/resources/views/detail.blade.php';
$detailContent = file_get_contents($detailPath);

// Replace Source URL in detail.blade.php
$detailContent = str_replace(
    '<a href="{{ $article->source_url }}" target="_blank" rel="noreferrer noopener" class="inline-flex items-center gap-1.5 px-4 py-2 bg-[#1E3A8A] hover:bg-blue-900 text-white text-xs font-bold rounded-lg shadow-sm transition">',
    '<a href="{{ route(\'track.redirect\', [\'url\' => $article->source_url, \'repo\' => $article->repository->name ?? \'Lokal\', \'type\' => \'click_source\', \'title\' => $article->title]) }}" target="_blank" rel="noreferrer noopener" class="inline-flex items-center gap-1.5 px-4 py-2 bg-[#1E3A8A] hover:bg-blue-900 text-white text-xs font-bold rounded-lg shadow-sm transition">',
    $detailContent
);
$detailContent = str_replace(
    '<a href="{{ $article->source_url }}" target="_blank" rel="noreferrer noopener" class="w-full bg-[#1E3A8A] hover:bg-blue-900 text-white font-bold py-3 px-4 rounded-xl flex items-center justify-center gap-2 shadow-sm transition text-sm">',
    '<a href="{{ route(\'track.redirect\', [\'url\' => $article->source_url, \'repo\' => $article->repository->name ?? \'Lokal\', \'type\' => \'click_source\', \'title\' => $article->title]) }}" target="_blank" rel="noreferrer noopener" class="w-full bg-[#1E3A8A] hover:bg-blue-900 text-white font-bold py-3 px-4 rounded-xl flex items-center justify-center gap-2 shadow-sm transition text-sm">',
    $detailContent
);

// DOI in detail.blade.php
$detailContent = str_replace(
    '<a href="{{ $doiUrl }}" target="_blank" rel="noreferrer noopener" class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-white border border-slate-200 hover:border-slate-300 hover:bg-slate-50 text-slate-700 text-xs font-bold rounded-lg transition">',
    '<a href="{{ route(\'track.redirect\', [\'url\' => $doiUrl, \'repo\' => $article->repository->name ?? \'Lokal\', \'type\' => \'click_doi\', \'title\' => $article->title]) }}" target="_blank" rel="noreferrer noopener" class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-white border border-slate-200 hover:border-slate-300 hover:bg-slate-50 text-slate-700 text-xs font-bold rounded-lg transition">',
    $detailContent
);

file_put_contents($detailPath, $detailContent);

echo "Tracking links updated.\n";
