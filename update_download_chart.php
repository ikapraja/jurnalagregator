<?php

// 1. Update AdminController
$controllerPath = 'c:/xampp/htdocs/jurnalagregator/app/Http/Controllers/AdminController.php';
$controllerContent = file_get_contents($controllerPath);

$insertDbLogics = <<<PHP
        // Filter Database Khusus Grafik Unduhan
        \$dbFilter = \$request->input('db', 'all');
        \$databases = \App\Models\DownloadLog::select('repository_name')->distinct()->whereNotNull('repository_name')->pluck('repository_name');

        // Statistik Pengunjung (Berdasarkan Hits / Page Views)
PHP;
$controllerContent = str_replace('// Statistik Pengunjung (Berdasarkan Hits / Page Views)', $insertDbLogics, $controllerContent);

$oldLoop1 = <<<PHP
                \$chartVisits[] = (int) Visitor::where('visited_date', \$dateString)->sum('hits');
                \$chartDownloads[] = DownloadLog::whereDate('created_at', \$dateString)->count();
PHP;
$newLoop1 = <<<PHP
                \$chartVisits[] = (int) Visitor::where('visited_date', \$dateString)->sum('hits');
                if (\$dbFilter !== 'all') {
                    \$chartDownloads[] = DownloadLog::where('repository_name', \$dbFilter)->whereDate('created_at', \$dateString)->count();
                } else {
                    \$chartDownloads[] = DownloadLog::whereDate('created_at', \$dateString)->count();
                }
PHP;
$controllerContent = str_replace($oldLoop1, $newLoop1, $controllerContent);

$oldLoop2 = <<<PHP
                \$chartVisits[] = (int) Visitor::where('visited_date', 'like', \$monthString.'%')->sum('hits');
                \$chartDownloads[] = DownloadLog::whereYear('created_at', \$date->year)->whereMonth('created_at', \$date->month)->count();
PHP;
$newLoop2 = <<<PHP
                \$chartVisits[] = (int) Visitor::where('visited_date', 'like', \$monthString.'%')->sum('hits');
                if (\$dbFilter !== 'all') {
                    \$chartDownloads[] = DownloadLog::where('repository_name', \$dbFilter)->whereYear('created_at', \$date->year)->whereMonth('created_at', \$date->month)->count();
                } else {
                    \$chartDownloads[] = DownloadLog::whereYear('created_at', \$date->year)->whereMonth('created_at', \$date->month)->count();
                }
PHP;
$controllerContent = str_replace($oldLoop2, $newLoop2, $controllerContent);

$oldCompact = "compact('visitors', 'downloads', 'downloadsPerDatabase', 'popularSearches', 'chartDates', 'chartVisits', 'chartDownloads', 'currentFilter', 'customStart', 'customEnd', 'years')";
$newCompact = "compact('visitors', 'downloads', 'downloadsPerDatabase', 'popularSearches', 'chartDates', 'chartVisits', 'chartDownloads', 'currentFilter', 'customStart', 'customEnd', 'years', 'databases', 'dbFilter')";
$controllerContent = str_replace($oldCompact, $newCompact, $controllerContent);

$oldJson = <<<PHP
                'chartVisits' => \$chartVisits,
                'chartDownloads' => \$chartDownloads,
                'customStart' => \$customStart,
                'customEnd' => \$customEnd,
                'currentFilter' => \$currentFilter
            ]);
PHP;
$newJson = <<<PHP
                'chartVisits' => \$chartVisits,
                'chartDownloads' => \$chartDownloads,
                'customStart' => \$customStart,
                'customEnd' => \$customEnd,
                'currentFilter' => \$currentFilter,
                'dbFilter' => \$dbFilter
            ]);
PHP;
$controllerContent = str_replace($oldJson, $newJson, $controllerContent);

file_put_contents($controllerPath, $controllerContent);

// 2. Update Blade View
$bladePath = 'c:/xampp/htdocs/jurnalagregator/resources/views/admin/dashboard.blade.php';
$bladeContent = file_get_contents($bladePath);

$chartHtml = <<<HTML
                    <!-- CHART UNDUHAN -->
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-100 mb-6">
                        <div class="flex flex-col xl:flex-row justify-between items-start xl:items-center mb-6 gap-4">
                            <h3 class="text-lg font-bold text-slate-800 shrink-0">Grafik Unduhan</h3>
                            
                            <div class="flex flex-col md:flex-row items-start md:items-center gap-3 w-full xl:w-auto">
                                <!-- Filter Database -->
                                <div class="flex items-center gap-2 bg-slate-50 p-1.5 rounded-lg border border-slate-200">
                                    <span class="text-xs font-semibold text-slate-500 pl-2">Pilih Database:</span>
                                    <select id="dbFilter" onchange="fetchData('?db='+this.value)" class="text-xs px-2 py-1.5 rounded border border-slate-300 outline-none focus:border-blue-500 bg-white">
                                        <option value="all" {{ \$dbFilter === 'all' ? 'selected' : '' }}>Semua Database</option>
                                        @foreach(\$databases as \$dbName)
                                            <option value="{{ \$dbName }}" {{ \$dbFilter === \$dbName ? 'selected' : '' }}>{{ \$dbName }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div id="downloadChart" class="w-full h-96"></div>
                    </div>

                    <!-- TABEL UNDUHAN PER DATABASE -->
HTML;
$bladeContent = str_replace('<!-- TABEL UNDUHAN PER DATABASE -->', $chartHtml, $bladeContent);

$oldFetchData = <<<JS
        // AJAX Fetching Data
        function fetchData(urlOrForm) {
            let url = '';
            if (typeof urlOrForm === 'string') {
                url = urlOrForm;
            } else {
                const formData = new FormData(urlOrForm);
                const params = new URLSearchParams(formData);
                url = '?' + params.toString();
            }
JS;

$newFetchData = <<<JS
        // Init ApexCharts Download
        var dlChartOptions = {
            series: [{
                name: 'Unduhan',
                data: @json(\$chartDownloads)
            }],
            chart: {
                height: 380,
                type: 'area',
                toolbar: { show: false },
                fontFamily: 'Inter, sans-serif'
            },
            colors: ['#10b981'],
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
        var downloadChart = new ApexCharts(document.querySelector("#downloadChart"), dlChartOptions);
        downloadChart.render();

        // AJAX Fetching Data
        function fetchData(urlOrForm) {
            let urlObj = new URL(window.location.origin + window.location.pathname);
            const dbFilter = document.getElementById('dbFilter');
            const currentUrlParams = new URLSearchParams(window.location.search);
            
            if (typeof urlOrForm === 'string') {
                const incomingParams = new URLSearchParams(urlOrForm.replace('?', ''));
                
                // Merge parameters: if incoming has range, clear start/end date.
                if (incomingParams.has('range')) {
                    urlObj.searchParams.set('range', incomingParams.get('range'));
                } else if (currentUrlParams.has('range')) {
                    urlObj.searchParams.set('range', currentUrlParams.get('range'));
                } else if (currentUrlParams.has('start_date')) {
                    urlObj.searchParams.set('start_date', currentUrlParams.get('start_date'));
                    urlObj.searchParams.set('end_date', currentUrlParams.get('end_date'));
                }
                
                // Set DB filter
                if (incomingParams.has('db')) {
                    urlObj.searchParams.set('db', incomingParams.get('db'));
                } else if (dbFilter) {
                    urlObj.searchParams.set('db', dbFilter.value);
                }
            } else {
                const formData = new FormData(document.getElementById('filterForm'));
                for(let [key, value] of formData.entries()) {
                    urlObj.searchParams.set(key, value);
                }
                if (dbFilter) urlObj.searchParams.set('db', dbFilter.value);
            }
            
            let url = urlObj.toString();
JS;
$bladeContent = str_replace($oldFetchData, $newFetchData, $bladeContent);

$oldChartUpdate = <<<JS
                // Update Chart
                visitChart.updateSeries([
                    { name: 'Pengunjung', data: data.chartVisits },
                    { name: 'Unduhan/Klik', data: data.chartDownloads }
                ]);
                visitChart.updateOptions({
                    xaxis: { categories: data.chartDates }
                });
JS;

$newChartUpdate = <<<JS
                // Update Chart
                visitChart.updateSeries([
                    { name: 'Pengunjung', data: data.chartVisits },
                    { name: 'Unduhan/Klik', data: data.chartDownloads }
                ]);
                visitChart.updateOptions({
                    xaxis: { categories: data.chartDates }
                });
                
                downloadChart.updateSeries([
                    { name: 'Unduhan', data: data.chartDownloads }
                ]);
                downloadChart.updateOptions({
                    xaxis: { categories: data.chartDates }
                });
                
                if (document.getElementById('dbFilter') && data.dbFilter) {
                    document.getElementById('dbFilter').value = data.dbFilter;
                }
JS;
$bladeContent = str_replace($oldChartUpdate, $newChartUpdate, $bladeContent);

file_put_contents($bladePath, $bladeContent);
echo "Chart Update completed.\n";
