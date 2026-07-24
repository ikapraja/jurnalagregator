<?php

$controllerPath = 'c:/xampp/htdocs/jurnalagregator/app/Http/Controllers/AdminController.php';
$controllerContent = file_get_contents($controllerPath);

// Define replacement for the chart data generation in AdminController
$oldLogic = <<<PHP
        // Data Grafik Kunjungan 7 Hari Terakhir
        \$chartDates = [];
        \$chartVisits = [];
        \$chartDownloads = [];
        
        for (\$i = 6; \$i >= 0; \$i--) {
            \$date = Carbon::today()->subDays(\$i);
            \$dateString = \$date->toDateString();
            \$chartDates[] = \$date->format('d M');
            \$chartVisits[] = Visitor::where('visited_date', \$dateString)->count();
            \$chartDownloads[] = DownloadLog::whereDate('created_at', \$dateString)->count();
        }

        return view('admin.dashboard', compact('visitors', 'downloads', 'downloadsPerDatabase', 'popularSearches', 'chartDates', 'chartVisits', 'chartDownloads'));
PHP;

$newLogic = <<<PHP
        // ==========================
        // FITUR FILTER GRAFIK
        // ==========================
        \$range = \$request->query('range', '7_days');
        \$startDateStr = \$request->query('start_date');
        \$endDateStr = \$request->query('end_date');
        
        \$startDate = null;
        \$endDate = Carbon::today();
        \$currentYear = Carbon::now()->year;

        if (!empty(\$startDateStr) && !empty(\$endDateStr)) {
            \$startDate = Carbon::parse(\$startDateStr);
            \$endDate = Carbon::parse(\$endDateStr);
            \$range = 'custom';
        } else {
            switch (\$range) {
                case '1_month':
                    \$startDate = Carbon::today()->subMonth();
                    break;
                case '6_months':
                    \$startDate = Carbon::today()->subMonths(6);
                    break;
                case '1_year':
                    \$startDate = Carbon::today()->subYear();
                    break;
                case 'all_time':
                    \$firstVisit = Visitor::orderBy('visited_date')->first();
                    \$startDate = \$firstVisit ? Carbon::parse(\$firstVisit->visited_date) : Carbon::today()->subMonth();
                    break;
                case 'year_'.\$currentYear:
                    \$startDate = Carbon::create(\$currentYear, 1, 1);
                    \$endDate = Carbon::create(\$currentYear, 12, 31);
                    if (\$endDate->isFuture()) { \$endDate = Carbon::today(); }
                    break;
                case 'year_'.(\$currentYear - 1):
                    \$startDate = Carbon::create(\$currentYear - 1, 1, 1);
                    \$endDate = Carbon::create(\$currentYear - 1, 12, 31);
                    break;
                case 'year_'.(\$currentYear - 2):
                    \$startDate = Carbon::create(\$currentYear - 2, 1, 1);
                    \$endDate = Carbon::create(\$currentYear - 2, 12, 31);
                    break;
                case 'year_'.(\$currentYear - 3):
                    \$startDate = Carbon::create(\$currentYear - 3, 1, 1);
                    \$endDate = Carbon::create(\$currentYear - 3, 12, 31);
                    break;
                case '7_days':
                default:
                    \$startDate = Carbon::today()->subDays(6);
                    \$range = '7_days';
                    break;
            }
        }
        
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
                \$chartVisits[] = Visitor::where('visited_date', \$dateString)->count();
                \$chartDownloads[] = DownloadLog::whereDate('created_at', \$dateString)->count();
            }
        } 
        // Jika lebih dari 60 hari, kelompokkan per Bulan untuk menghindari grafik yang terlalu padat
        else {
            \$startMonth = \$startDate->copy()->startOfMonth();
            \$endMonth = \$endDate->copy()->startOfMonth();
            
            for (\$date = \$startMonth->copy(); \$date->lte(\$endMonth); \$date->addMonth()) {
                \$monthString = \$date->format('Y-m');
                \$chartDates[] = \$date->format('M Y');
                \$chartVisits[] = Visitor::where('visited_date', 'like', \$monthString.'%')->count();
                \$chartDownloads[] = DownloadLog::whereYear('created_at', \$date->year)->whereMonth('created_at', \$date->month)->count();
            }
        }

        // Variabel untuk UI
        \$currentFilter = \$range;
        \$customStart = \$startDateStr;
        \$customEnd = \$endDateStr;
        \$years = [\$currentYear, \$currentYear - 1, \$currentYear - 2, \$currentYear - 3];

        return view('admin.dashboard', compact('visitors', 'downloads', 'downloadsPerDatabase', 'popularSearches', 'chartDates', 'chartVisits', 'chartDownloads', 'currentFilter', 'customStart', 'customEnd', 'years'));
PHP;

$controllerContent = str_replace($oldLogic, $newLogic, $controllerContent);
file_put_contents($controllerPath, $controllerContent);
echo "AdminController updated.\n";


// ===============================================
// DASHBOARD BLADE UPDATE
// ===============================================
$bladePath = 'c:/xampp/htdocs/jurnalagregator/resources/views/admin/dashboard.blade.php';
$bladeContent = file_get_contents($bladePath);

$oldChartHeader = <<<HTML
                    <!-- CHART -->
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-100">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-bold text-slate-800">Grafik Kunjungan (7 Hari Terakhir)</h3>
                        </div>
                        <div id="visitChart" class="w-full h-80"></div>
                    </div>
HTML;

$newChartHeader = <<<HTML
                    <!-- CHART -->
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-100">
                        <div class="flex flex-col xl:flex-row justify-between items-start xl:items-center mb-6 gap-4">
                            <h3 class="text-lg font-bold text-slate-800 shrink-0">Grafik Kunjungan & Unduhan</h3>
                            
                            <div class="flex flex-col md:flex-row items-start md:items-center gap-3 w-full xl:w-auto">
                                <!-- Rentang Manual -->
                                <form action="{{ route('admin.dashboard') }}" method="GET" class="flex items-center gap-2 bg-slate-50 p-1.5 rounded-lg border border-slate-200">
                                    <span class="text-xs font-semibold text-slate-500 pl-2">Rentang Manual:</span>
                                    <input type="date" name="start_date" value="{{ \$customStart }}" class="text-xs px-2 py-1.5 rounded border border-slate-300 outline-none focus:border-blue-500" required>
                                    <span class="text-slate-400">-</span>
                                    <input type="date" name="end_date" value="{{ \$customEnd }}" class="text-xs px-2 py-1.5 rounded border border-slate-300 outline-none focus:border-blue-500" required>
                                    <button type="submit" class="bg-[#1e293b] hover:bg-slate-800 text-white text-xs font-bold px-3 py-1.5 rounded transition">Tampilkan</button>
                                </form>
                                
                                <span class="text-xs font-bold text-slate-400 uppercase tracking-widest hidden md:block">ATAU</span>
                                
                                <!-- Pilih Rentang Dropdown -->
                                <div class="flex items-center gap-2 bg-slate-50 p-1.5 rounded-lg border border-slate-200">
                                    <span class="text-xs font-semibold text-slate-500 pl-2">Pilih Rentang:</span>
                                    <select onchange="window.location.href='?range='+this.value" class="text-xs px-2 py-1.5 rounded border border-slate-300 outline-none focus:border-blue-500 bg-white">
                                        <option value="7_days" {{ \$currentFilter === '7_days' ? 'selected' : '' }}>7 Hari Terakhir</option>
                                        <option value="1_month" {{ \$currentFilter === '1_month' ? 'selected' : '' }}>1 Bulan Terakhir</option>
                                        <option value="6_months" {{ \$currentFilter === '6_months' ? 'selected' : '' }}>6 Bulan Terakhir</option>
                                        <option value="1_year" {{ \$currentFilter === '1_year' ? 'selected' : '' }}>1 Tahun Terakhir</option>
                                        <option value="all_time" {{ \$currentFilter === 'all_time' ? 'selected' : '' }}>Sepanjang Waktu</option>
                                        <optgroup label="Tahun Kalender">
                                            @foreach(\$years as \$year)
                                                <option value="year_{{ \$year }}" {{ \$currentFilter === 'year_'.\$year ? 'selected' : '' }}>Tahun {{ \$year }}</option>
                                            @endforeach
                                        </optgroup>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div id="visitChart" class="w-full h-96"></div>
                    </div>
HTML;

$bladeContent = str_replace($oldChartHeader, $newChartHeader, $bladeContent);

file_put_contents($bladePath, $bladeContent);
echo "Dashboard Blade updated.\n";
