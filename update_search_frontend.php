<?php

$bladePath = 'c:/xampp/htdocs/jurnalagregator/resources/views/admin/dashboard.blade.php';
$content = file_get_contents($bladePath);

// 1. Inject Summary Cards and Chart Container into Pencarian Tab
$findPencarianTab = <<<HTML
                <!-- TAB: PENCARIAN POPULER -->
                <div x-show="tab === 'pencarian'" style="display: none;" x-transition.opacity>
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-100">
HTML;

$insertPencarianUI = <<<HTML
                <!-- TAB: PENCARIAN POPULER -->
                <div x-show="tab === 'pencarian'" style="display: none;" x-transition.opacity>
                    
                    <!-- KARTU PENCARIAN -->
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                        <!-- Card 1 -->
                        <div class="bg-white rounded-xl p-5 shadow-sm border border-slate-100 border-b-4 border-b-blue-500">
                            <p class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-1">Hari Ini</p>
                            <div class="flex items-end justify-between">
                                <h3 id="val-search-today" class="text-3xl font-black text-slate-800">{{ number_format(\$searchesStats['today']) }}</h3>
                                <div class="w-10 h-10 bg-blue-50 text-blue-500 rounded-full flex items-center justify-center">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                                </div>
                            </div>
                        </div>
                        <!-- Card 2 -->
                        <div class="bg-white rounded-xl p-5 shadow-sm border border-slate-100 border-b-4 border-b-amber-500">
                            <p class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-1">Kemarin</p>
                            <div class="flex items-end justify-between">
                                <h3 id="val-search-yesterday" class="text-3xl font-black text-slate-800">{{ number_format(\$searchesStats['yesterday']) }}</h3>
                                <div class="w-10 h-10 bg-amber-50 text-amber-500 rounded-full flex items-center justify-center">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                </div>
                            </div>
                        </div>
                        <!-- Card 3 -->
                        <div class="bg-white rounded-xl p-5 shadow-sm border border-slate-100 border-b-4 border-b-emerald-500">
                            <p class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-1">Bulan Ini</p>
                            <div class="flex items-end justify-between">
                                <h3 id="val-search-month" class="text-3xl font-black text-slate-800">{{ number_format(\$searchesStats['month']) }}</h3>
                                <div class="w-10 h-10 bg-emerald-50 text-emerald-500 rounded-full flex items-center justify-center">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                                </div>
                            </div>
                        </div>
                        <!-- Card 4 -->
                        <div class="bg-white rounded-xl p-5 shadow-sm border border-slate-100 border-b-4 border-b-purple-500">
                            <p class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-1">Sepanjang Waktu</p>
                            <div class="flex items-end justify-between">
                                <h3 id="val-search-all" class="text-3xl font-black text-slate-800">{{ number_format(\$searchesStats['all_time']) }}</h3>
                                <div class="w-10 h-10 bg-purple-50 text-purple-500 rounded-full flex items-center justify-center">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- CHART PENCARIAN -->
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-100 mb-6">
                        <div class="flex flex-col xl:flex-row justify-between items-start xl:items-center mb-6 gap-4">
                            <h3 class="text-lg font-bold text-slate-800 shrink-0">Grafik Volume Pencarian</h3>
                            
                            <div class="flex flex-col md:flex-row items-start md:items-center gap-3 w-full xl:w-auto">
                                
                                <!-- Rentang Manual -->
                                <form onsubmit="event.preventDefault(); fetchData(this);" class="flex items-center gap-2 bg-slate-50 p-1.5 rounded-lg border border-slate-200">
                                    <span class="text-xs font-semibold text-slate-500 pl-2">Rentang Manual:</span>
                                    <input type="date" name="start_date" value="{{ \$customStart }}" class="dl-start-input text-xs px-2 py-1.5 rounded border border-slate-300 outline-none focus:border-blue-500" required>
                                    <span class="text-slate-400">-</span>
                                    <input type="date" name="end_date" value="{{ \$customEnd }}" class="dl-end-input text-xs px-2 py-1.5 rounded border border-slate-300 outline-none focus:border-blue-500" required>
                                    <button type="submit" class="bg-[#1e293b] hover:bg-slate-800 text-white text-xs font-bold px-3 py-1.5 rounded transition">Tampilkan</button>
                                </form>
                                
                                <span class="text-xs font-bold text-slate-400 uppercase tracking-widest hidden md:block">ATAU</span>
                                
                                <!-- Pilih Rentang Dropdown -->
                                <div class="flex items-center gap-2 bg-slate-50 p-1.5 rounded-lg border border-slate-200">
                                    <span class="text-xs font-semibold text-slate-500 pl-2">Pilih Rentang:</span>
                                    <select onchange="fetchData('?range='+this.value)" class="dl-range-select text-xs px-2 py-1.5 rounded border border-slate-300 outline-none focus:border-blue-500 bg-white">
                                        <option value="7_days" {{ \$currentFilter === '7_days' ? 'selected' : '' }}>7 Hari Terakhir</option>
                                        <option value="1_month" {{ \$currentFilter === '1_month' ? 'selected' : '' }}>1 Bulan Terakhir</option>
                                        <option value="6_months" {{ \$currentFilter === '6_months' ? 'selected' : '' }}>6 Bulan Terakhir</option>
                                        <option value="1_year" {{ \$currentFilter === '1_year' ? 'selected' : '' }}>1 Tahun Terakhir</option>
                                        <option value="all_time" {{ \$currentFilter === 'all_time' ? 'selected' : '' }}>Sepanjang Waktu</option>
                                        @foreach(\$years as \$year)
                                            <option value="year_{{ \$year }}" {{ \$currentFilter === 'year_'.\$year ? 'selected' : '' }}>Tahun {{ \$year }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div id="searchChart" class="w-full h-96"></div>
                    </div>

                    <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-100">
HTML;
$content = str_replace($findPencarianTab, $insertPencarianUI, $content);

// 2. Initialize searchChart in JS
$findVisitChartRender = <<<JS
        var visitChart = new ApexCharts(document.querySelector("#visitChart"), chartOptions);
        visitChart.render();
JS;

$insertSearchChartRender = <<<JS
        var visitChart = new ApexCharts(document.querySelector("#visitChart"), chartOptions);
        visitChart.render();

        // Init ApexCharts Search
        var searchChartOptions = {
            series: [{
                name: 'Pencarian',
                data: @json(\$chartSearches)
            }],
            chart: {
                height: 380,
                type: 'area',
                toolbar: { show: false },
                fontFamily: 'Inter, sans-serif'
            },
            colors: ['#a855f7'],
            dataLabels: { enabled: false },
            stroke: { curve: 'smooth', width: 3 },
            fill: {
                type: 'gradient',
                gradient: { shadeIntensity: 1, opacityFrom: 0.4, opacityTo: 0.05, stops: [0, 90, 100] }
            },
            xaxis: {
                categories: @json(\$chartDates),
                axisBorder: { show: false },
                axisTicks: { show: false }
            },
            yaxis: { min: 0, forceNiceScale: true },
            grid: { borderColor: '#f1f5f9', strokeDashArray: 4 }
        };
        var searchChart = new ApexCharts(document.querySelector("#searchChart"), searchChartOptions);
        searchChart.render();
JS;
if (strpos($content, 'var searchChartOptions = {') === false) {
    $content = str_replace($findVisitChartRender, $insertSearchChartRender, $content);
}

// 3. Update fetchData AJAX success block
$findUpdateDownloads = <<<JS
                document.getElementById('val-dl-month').innerText = formatter.format(data.downloads.month);
                document.getElementById('val-dl-all').innerText = formatter.format(data.downloads.all_time);
JS;

$insertUpdateSearchesStats = <<<JS
                document.getElementById('val-dl-month').innerText = formatter.format(data.downloads.month);
                document.getElementById('val-dl-all').innerText = formatter.format(data.downloads.all_time);
                
                // Update Searches Stats
                if (data.searchesStats) {
                    document.getElementById('val-search-today').innerText = formatter.format(data.searchesStats.today);
                    document.getElementById('val-search-yesterday').innerText = formatter.format(data.searchesStats.yesterday);
                    document.getElementById('val-search-month').innerText = formatter.format(data.searchesStats.month);
                    document.getElementById('val-search-all').innerText = formatter.format(data.searchesStats.all_time);
                }
JS;
if (strpos($content, 'val-search-today') === false) {
    $content = str_replace($findUpdateDownloads, $insertUpdateSearchesStats, $content);
}

// 4. Update searchChart inside fetchData
$findDownloadChartUpdate = <<<JS
                downloadChart.updateOptions({
                    xaxis: { categories: data.chartDates }
                });
JS;

$insertSearchChartUpdate = <<<JS
                downloadChart.updateOptions({
                    xaxis: { categories: data.chartDates }
                });
                
                if (data.chartSearches) {
                    searchChart.updateSeries([
                        { name: 'Pencarian', data: data.chartSearches }
                    ]);
                    searchChart.updateOptions({
                        xaxis: { categories: data.chartDates }
                    });
                }
JS;
if (strpos($content, 'searchChart.updateSeries') === false) {
    $content = str_replace($findDownloadChartUpdate, $insertSearchChartUpdate, $content);
}

file_put_contents($bladePath, $content);
echo "Frontend updated.\n";

