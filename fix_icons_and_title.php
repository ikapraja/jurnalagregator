<?php

$bladePath = 'c:/xampp/htdocs/jurnalagregator/resources/views/admin/dashboard.blade.php';
$content = file_get_contents($bladePath);

// 1. Ganti Judul
$content = str_replace(
    '<h1 class="text-2xl font-bold text-slate-800">Statistik Keseluruhan</h1>',
    '<h1 class="text-2xl font-bold text-slate-800" x-text="tab === \'pengunjung\' ? \'Statistik Pengunjung Keseluruhan\' : (tab === \'unduhan\' ? \'Statistik Unduhan Keseluruhan\' : \'Statistik Pencarian Keseluruhan\')">Statistik Keseluruhan</h1>',
    $content
);

// Icon Definitions
$iconToday = '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>'; // Clock
$iconYesterday = '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>'; // Calendar
$iconMonth = '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>'; // Chart
$iconAllTime = '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>'; // Globe

// Function to generate the cards HTML for a specific section
function getCardsHtml($prefix, $arrayName) {
    global $iconToday, $iconYesterday, $iconMonth, $iconAllTime;
    
    // Some titles have specific words
    $titleToday = $prefix === 'dl' ? 'Unduhan Hari Ini' : 'Hari Ini';
    
    return <<<HTML
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                        <!-- Card 1 -->
                        <div class="bg-white rounded-xl p-5 shadow-sm border border-slate-100 border-b-4 border-b-blue-500">
                            <p class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-1">Hari Ini</p>
                            <div class="flex items-end justify-between">
                                <h3 id="val-{$prefix}-today" class="text-3xl font-black text-slate-800">{{ number_format(\${$arrayName}['today']) }}</h3>
                                <div class="w-10 h-10 bg-blue-50 text-blue-500 rounded-full flex items-center justify-center">
                                    {$iconToday}
                                </div>
                            </div>
                        </div>
                        <!-- Card 2 -->
                        <div class="bg-white rounded-xl p-5 shadow-sm border border-slate-100 border-b-4 border-b-amber-500">
                            <p class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-1">Kemarin</p>
                            <div class="flex items-end justify-between">
                                <h3 id="val-{$prefix}-yesterday" class="text-3xl font-black text-slate-800">{{ number_format(\${$arrayName}['yesterday']) }}</h3>
                                <div class="w-10 h-10 bg-amber-50 text-amber-500 rounded-full flex items-center justify-center">
                                    {$iconYesterday}
                                </div>
                            </div>
                        </div>
                        <!-- Card 3 -->
                        <div class="bg-white rounded-xl p-5 shadow-sm border border-slate-100 border-b-4 border-b-emerald-500">
                            <p class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-1">Bulan Ini</p>
                            <div class="flex items-end justify-between">
                                <h3 id="val-{$prefix}-month" class="text-3xl font-black text-slate-800">{{ number_format(\${$arrayName}['month']) }}</h3>
                                <div class="w-10 h-10 bg-emerald-50 text-emerald-500 rounded-full flex items-center justify-center">
                                    {$iconMonth}
                                </div>
                            </div>
                        </div>
                        <!-- Card 4 -->
                        <div class="bg-white rounded-xl p-5 shadow-sm border border-slate-100 border-b-4 border-b-purple-500">
                            <p class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-1">Sepanjang Waktu</p>
                            <div class="flex items-end justify-between">
                                <h3 id="val-{$prefix}-all" class="text-3xl font-black text-slate-800">{{ number_format(\${$arrayName}['all_time']) }}</h3>
                                <div class="w-10 h-10 bg-purple-50 text-purple-500 rounded-full flex items-center justify-center">
                                    {$iconAllTime}
                                </div>
                            </div>
                        </div>
                    </div>
HTML;
}

$pengunjungCardsNew = getCardsHtml('vis', 'visitors');
$unduhanCardsNew = getCardsHtml('dl', 'downloads');
$pencarianCardsNew = getCardsHtml('search', 'searchesStats');


// Kita akan menggunakan regex / string split untuk mengganti block kartu lamanya
function replaceCardsBlock($content, $startComment, $endComment, $newHtml) {
    $startPos = strpos($content, $startComment);
    if ($startPos === false) return $content;
    
    // Find where the cards grid starts
    $gridStartPos = strpos($content, '<div class="grid', $startPos);
    
    // Find where the grid ends (by finding the next major section comment)
    $gridEndPos = strpos($content, '<!-- CHART', $gridStartPos);
    if ($gridEndPos === false) {
        $gridEndPos = strpos($content, '<!-- TABEL', $gridStartPos);
    }
    
    if ($gridStartPos !== false && $gridEndPos !== false) {
        // Extract before and after
        $before = substr($content, 0, $gridStartPos);
        $after = substr($content, $gridEndPos);
        return $before . $newHtml . "\n                    " . $after;
    }
    return $content;
}

$content = replaceCardsBlock($content, '<!-- KARTU PENGUNJUNG -->', '<!-- CHART -->', $pengunjungCardsNew);
$content = replaceCardsBlock($content, '<!-- KARTU UNDUHAN -->', '<!-- CHART UNDUHAN -->', $unduhanCardsNew);
$content = replaceCardsBlock($content, '<!-- KARTU PENCARIAN -->', '<!-- CHART PENCARIAN -->', $pencarianCardsNew);


file_put_contents($bladePath, $content);
echo "Cards and titles successfully updated.\n";
