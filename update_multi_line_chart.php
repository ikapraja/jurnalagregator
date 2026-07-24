<?php

// 1. Update AdminController.php
$controllerPath = 'c:/xampp/htdocs/jurnalagregator/app/Http/Controllers/AdminController.php';
$controllerContent = file_get_contents($controllerPath);

$oldLoopsBlock = <<<PHP
        // Data Grafik
        \$chartDates = [];
        \$chartVisits = [];
        \$chartDownloads = [];
        
        \$diffInDays = \$startDate->diffInDays(\$endDate);
        
        // Jika rentang waktu kurang dari atau sama dengan 60 hari, tampilkan per Hari
        if (\$diffInDays <= 60 && \$range !== 'all_time') {
            for (\$date = \$startDate->copy(); \$date->lte(\$endDate); \$date->addDay()) {
                \$dateString = \$date->toDateString();
                \$chartDates[] = \$date->format('d M');
                \$chartVisits[] = (int) Visitor::where('visited_date', \$dateString)->sum('hits');
                if (\$dbFilter !== 'all') {
                    \$chartDownloads[] = DownloadLog::where('repository_name', \$dbFilter)->whereDate('created_at', \$dateString)->count();
                } else {
                    \$chartDownloads[] = DownloadLog::whereDate('created_at', \$dateString)->count();
                }
            }
        } 
        // Jika lebih dari 60 hari, kelompokkan per Bulan untuk menghindari grafik yang terlalu padat
        else {
            \$startMonth = \$startDate->copy()->startOfMonth();
            \$endMonth = \$endDate->copy()->startOfMonth();
            
            for (\$date = \$startMonth->copy(); \$date->lte(\$endMonth); \$date->addMonth()) {
                \$monthString = \$date->format('Y-m');
                \$chartDates[] = \$date->format('M Y');
                \$chartVisits[] = (int) Visitor::where('visited_date', 'like', \$monthString.'%')->sum('hits');
                if (\$dbFilter !== 'all') {
                    \$chartDownloads[] = DownloadLog::where('repository_name', \$dbFilter)->whereYear('created_at', \$date->year)->whereMonth('created_at', \$date->month)->count();
                } else {
                    \$chartDownloads[] = DownloadLog::whereYear('created_at', \$date->year)->whereMonth('created_at', \$date->month)->count();
                }
            }
        }

        // Variabel untuk UI
        \$currentFilter = \$range;
        \$customStart = \$startDateStr;
        \$customEnd = \$endDateStr;
        \$years = [\$currentYear, \$currentYear - 1, \$currentYear - 2, \$currentYear - 3];

        // Jika ini adalah request AJAX dari JavaScript, kembalikan response JSON
        if (\$request->ajax()) {
            return response()->json([
                'visitors' => \$visitors,
                'downloads' => \$downloads,
                'downloadsPerDatabase' => \$downloadsPerDatabase,
                'popularSearches' => \$popularSearches,
                'chartDates' => \$chartDates,
                'chartVisits' => \$chartVisits,
                'chartDownloads' => \$chartDownloads,
                'customStart' => \$customStart,
                'customEnd' => \$customEnd,
                'currentFilter' => \$currentFilter,
                'dbFilter' => \$dbFilter
            ]);
        }

        return view('admin.dashboard', compact('visitors', 'downloads', 'downloadsPerDatabase', 'popularSearches', 'chartDates', 'chartVisits', 'chartDownloads', 'currentFilter', 'customStart', 'customEnd', 'years', 'databases', 'dbFilter'));
PHP;

$newLoopsBlock = <<<PHP
        // Data Grafik
        \$chartDates = [];
        \$chartVisits = [];
        \$chartDownloads = []; // Datar, khusus visitChart
        \$chartDownloadsSeries = []; // Baru, khusus multi-line
        
        \$activeDbs = (\$dbFilter === 'all') ? \$databases : [\$dbFilter];
        
        // Eager load data untuk mapping di memori O(N) agar sangat cepat
        \$allLogs = DownloadLog::whereBetween('created_at', [\$startDate->copy()->startOfDay(), \$endDate->copy()->endOfDay()])->get();
        \$dailyCounts = [];
        \$monthlyCounts = [];
        foreach (\$allLogs as \$log) {
            if (!\$log->repository_name) continue;
            \$db = strtolower(\$log->repository_name);
            \$day = \$log->created_at->toDateString();
            \$month = \$log->created_at->format('Y-m');
            
            if (!isset(\$dailyCounts[\$db][\$day])) \$dailyCounts[\$db][\$day] = 0;
            \$dailyCounts[\$db][\$day]++;
            
            if (!isset(\$monthlyCounts[\$db][\$month])) \$monthlyCounts[\$db][\$month] = 0;
            \$monthlyCounts[\$db][\$month]++;
        }
        
        \$diffInDays = \$startDate->diffInDays(\$endDate);
        
        // Jika rentang waktu kurang dari atau sama dengan 60 hari, tampilkan per Hari
        if (\$diffInDays <= 60 && \$range !== 'all_time') {
            for (\$date = \$startDate->copy(); \$date->lte(\$endDate); \$date->addDay()) {
                \$dateString = \$date->toDateString();
                \$chartDates[] = \$date->format('d M');
                \$chartVisits[] = (int) Visitor::where('visited_date', \$dateString)->sum('hits');
                
                \$totalDl = 0;
                foreach (\$activeDbs as \$dbName) {
                    \$db = strtolower(\$dbName);
                    \$count = \$dailyCounts[\$db][\$dateString] ?? 0;
                    \$chartDownloadsSeries[\$dbName][] = \$count;
                    \$totalDl += \$count;
                }
                \$chartDownloads[] = \$totalDl;
            }
        } 
        // Jika lebih dari 60 hari, kelompokkan per Bulan untuk menghindari grafik yang terlalu padat
        else {
            \$startMonth = \$startDate->copy()->startOfMonth();
            \$endMonth = \$endDate->copy()->startOfMonth();
            
            for (\$date = \$startMonth->copy(); \$date->lte(\$endMonth); \$date->addMonth()) {
                \$monthString = \$date->format('Y-m');
                \$chartDates[] = \$date->format('M Y');
                \$chartVisits[] = (int) Visitor::where('visited_date', 'like', \$monthString.'%')->sum('hits');
                
                \$totalDl = 0;
                foreach (\$activeDbs as \$dbName) {
                    \$db = strtolower(\$dbName);
                    \$count = \$monthlyCounts[\$db][\$monthString] ?? 0;
                    \$chartDownloadsSeries[\$dbName][] = \$count;
                    \$totalDl += \$count;
                }
                \$chartDownloads[] = \$totalDl;
            }
        }
        
        // Format chartDownloadsSeries menjadi array of objects untuk ApexCharts
        \$formattedSeries = [];
        foreach (\$chartDownloadsSeries as \$dbName => \$dataArray) {
            \$formattedSeries[] = [
                'name' => \$dbName,
                'data' => \$dataArray
            ];
        }

        // Variabel untuk UI
        \$currentFilter = \$range;
        \$customStart = \$startDateStr;
        \$customEnd = \$endDateStr;
        \$years = [\$currentYear, \$currentYear - 1, \$currentYear - 2, \$currentYear - 3];

        // Jika ini adalah request AJAX dari JavaScript, kembalikan response JSON
        if (\$request->ajax()) {
            return response()->json([
                'visitors' => \$visitors,
                'downloads' => \$downloads,
                'downloadsPerDatabase' => \$downloadsPerDatabase,
                'popularSearches' => \$popularSearches,
                'chartDates' => \$chartDates,
                'chartVisits' => \$chartVisits,
                'chartDownloads' => \$chartDownloads,
                'chartDownloadsSeries' => \$formattedSeries,
                'customStart' => \$customStart,
                'customEnd' => \$customEnd,
                'currentFilter' => \$currentFilter,
                'dbFilter' => \$dbFilter
            ]);
        }

        return view('admin.dashboard', compact('visitors', 'downloads', 'downloadsPerDatabase', 'popularSearches', 'chartDates', 'chartVisits', 'chartDownloads', 'formattedSeries', 'currentFilter', 'customStart', 'customEnd', 'years', 'databases', 'dbFilter'));
PHP;

$controllerContent = str_replace($oldLoopsBlock, $newLoopsBlock, $controllerContent);
file_put_contents($controllerPath, $controllerContent);

// 2. Update dashboard.blade.php
$bladePath = 'c:/xampp/htdocs/jurnalagregator/resources/views/admin/dashboard.blade.php';
$bladeContent = file_get_contents($bladePath);

$oldDlChartOptions = <<<JS
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
JS;

$newDlChartOptions = <<<JS
        // Init ApexCharts Download (Multi-Line)
        var dlChartOptions = {
            series: @json(\$formattedSeries),
            chart: {
                height: 380,
                type: 'line',
                toolbar: { show: false },
                fontFamily: 'Inter, sans-serif'
            },
            colors: ['#10b981', '#3b82f6', '#f59e0b', '#ef4444', '#8b5cf6', '#ec4899', '#06b6d4', '#14b8a6'],
            dataLabels: { enabled: false },
            stroke: { curve: 'smooth', width: 3 },
            xaxis: {
                categories: @json(\$chartDates),
                axisBorder: { show: false },
                axisTicks: { show: false }
            },
            yaxis: { min: 0, forceNiceScale: true },
            grid: { borderColor: '#f1f5f9', strokeDashArray: 4 },
            tooltip: {
                shared: true,
                intersect: false,
            },
            legend: {
                position: 'top',
                horizontalAlign: 'right'
            }
        };
JS;
$bladeContent = str_replace($oldDlChartOptions, $newDlChartOptions, $bladeContent);

$oldDownloadChartUpdate = <<<JS
                downloadChart.updateSeries([
                    { name: 'Unduhan', data: data.chartDownloads }
                ]);
JS;

$newDownloadChartUpdate = <<<JS
                downloadChart.updateSeries(data.chartDownloadsSeries);
JS;
$bladeContent = str_replace($oldDownloadChartUpdate, $newDownloadChartUpdate, $bladeContent);

file_put_contents($bladePath, $bladeContent);

echo "Berhasil update multi-line chart.\n";
