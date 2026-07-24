<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visitor;
use App\Models\DownloadLog;
use App\Models\SearchQuery;
use App\Models\SearchLog;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    public function login()
    {
        if (Session::has('admin_logged_in')) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.login');
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if ($request->username === 'admin' && $request->password === 'Salamliterasi@2026') {
            Session::put('admin_logged_in', true);
            return redirect()->route('admin.dashboard');
        }

        return back()->with('error', 'Username atau Password salah!');
    }

    public function logout()
    {
        Session::forget('admin_logged_in');
        return redirect()->route('admin.login');
    }

    public function dashboard(Request $request)
    {
        if (!Session::has('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        $today = Carbon::today()->toDateString();
        $yesterday = Carbon::yesterday()->toDateString();
        $thisMonth = Carbon::now()->format('Y-m');

                // Filter Database Khusus Grafik Unduhan
        $dbFilter = $request->input('db', 'all');
        // Daftar 8 Database Global
        $databases = ['Crossref', 'DOAJ', 'Semantic Scholar', 'OpenAlex', 'IEEE Xplore', 'CORE', 'Europe PMC', 'arXiv'];

        // ==========================
        // FITUR FILTER GRAFIK
        // ==========================
        $range = $request->query('range', '7_days');
        $startDateStr = $request->query('start_date');
        $endDateStr = $request->query('end_date');
        
        $startDate = null;
        $endDate = Carbon::today();
        $currentYear = Carbon::now()->year;

        if (!empty($startDateStr) && !empty($endDateStr)) {
            $startDate = Carbon::parse($startDateStr);
            $endDate = Carbon::parse($endDateStr);
            $range = 'custom';
        } else {
            switch ($range) {
                case '1_month':
                    $startDate = Carbon::today()->subMonth();
                    break;
                case '6_months':
                    $startDate = Carbon::today()->subMonths(6);
                    break;
                case '1_year':
                    $startDate = Carbon::today()->subYear();
                    break;
                case 'all_time':
                    $firstVisit = Visitor::orderBy('visited_date')->first();
                    $startDate = $firstVisit ? Carbon::parse($firstVisit->visited_date) : Carbon::today()->subMonth();
                    break;
                case 'year_'.$currentYear:
                    $startDate = Carbon::create($currentYear, 1, 1);
                    $endDate = Carbon::create($currentYear, 12, 31);
                    if ($endDate->isFuture()) { $endDate = Carbon::today(); }
                    break;
                case 'year_'.($currentYear - 1):
                    $startDate = Carbon::create($currentYear - 1, 1, 1);
                    $endDate = Carbon::create($currentYear - 1, 12, 31);
                    break;
                case 'year_'.($currentYear - 2):
                    $startDate = Carbon::create($currentYear - 2, 1, 1);
                    $endDate = Carbon::create($currentYear - 2, 12, 31);
                    break;
                case 'year_'.($currentYear - 3):
                    $startDate = Carbon::create($currentYear - 3, 1, 1);
                    $endDate = Carbon::create($currentYear - 3, 12, 31);
                    break;
                case '7_days':
                default:
                    $startDate = Carbon::today()->subDays(6);
                    $range = '7_days';
                    break;
            }
        }

        // Statistik Pengunjung (Berdasarkan Hits / Page Views)
        $visitors = [
            'today' => Visitor::where('visited_date', $today)->sum('hits'),
            'yesterday' => Visitor::where('visited_date', $yesterday)->sum('hits'),
            'month' => Visitor::where('visited_date', 'like', $thisMonth.'%')->sum('hits'),
            'all_time' => Visitor::sum('hits')
        ];

        // Statistik Unduhan Keseluruhan
        $downloads = [
            'today' => DownloadLog::whereDate('created_at', $today)->count(),
            'yesterday' => DownloadLog::whereDate('created_at', $yesterday)->count(),
            'month' => DownloadLog::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->count(),
            'all_time' => DownloadLog::count()
        ];

        // Statistik Pencarian Keseluruhan
        $searchesStats = [
            'today' => SearchLog::whereDate('created_at', $today)->count(),
            'yesterday' => SearchLog::whereDate('created_at', $yesterday)->count(),
            'month' => SearchLog::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->count(),
            'all_time' => SearchLog::count()
        ];

        // Statistik Unduhan per Database (Sesuai Rentang Waktu) - Tampilkan Semua 8 Database
        $dbCountsQuery = DownloadLog::selectRaw('repository_name, count(*) as total')
            ->whereNotNull('repository_name');
            
        if ($range !== 'all_time') {
            // Gunakan startOfDay() dan endOfDay() agar presisi
            $dbCountsQuery->whereBetween('created_at', [$startDate->copy()->startOfDay(), $endDate->copy()->endOfDay()]);
        }
            
        $dbCounts = $dbCountsQuery->groupBy('repository_name')
            ->pluck('total', 'repository_name')
            ->toArray();

        $downloadsPerDatabase = [];
        foreach ($databases as $dbName) {
            $total = 0;
            foreach ($dbCounts as $key => $val) {
                if (strtolower($key) === strtolower($dbName)) {
                    $total = $val;
                    break;
                }
            }
            $downloadsPerDatabase[] = (object) [
                'repository_name' => $dbName,
                'total' => $total
            ];
        }

        usort($downloadsPerDatabase, function($a, $b) {
            return $b->total <=> $a->total;
        });
            
        // Statistik Pencarian Populer (Berdasarkan Rentang Waktu)
        $searchesQuery = SearchLog::selectRaw('keyword, count(*) as count');
        if ($range !== 'all_time') {
            $searchesQuery->whereBetween('created_at', [$startDate->copy()->startOfDay(), $endDate->copy()->endOfDay()]);
        }
        $popularSearches = $searchesQuery->groupBy('keyword')->orderByDesc('count')->take(20)->get();


        
        // Data Grafik
        $chartDates = [];
        $chartVisits = [];
        $chartSearches = []; // Data untuk grafik pencarian
        $chartDownloads = []; // Datar, khusus visitChart
        $chartDownloadsSeries = []; // Baru, khusus multi-line
        
        $activeDbs = ($dbFilter === 'all') ? $databases : [$dbFilter];
        
        // Eager load data untuk mapping di memori O(N) agar sangat cepat
        $allLogs = DownloadLog::whereBetween('created_at', [$startDate->copy()->startOfDay(), $endDate->copy()->endOfDay()])->get();
        $dailyCounts = [];
        $monthlyCounts = [];
        foreach ($allLogs as $log) {
            if (!$log->repository_name) continue;
            $db = strtolower($log->repository_name);
            $day = $log->created_at->toDateString();
            $month = $log->created_at->format('Y-m');
            
            if (!isset($dailyCounts[$db][$day])) $dailyCounts[$db][$day] = 0;
            $dailyCounts[$db][$day]++;
            
            if (!isset($monthlyCounts[$db][$month])) $monthlyCounts[$db][$month] = 0;
            $monthlyCounts[$db][$month]++;
        }
        
        $diffInDays = $startDate->diffInDays($endDate);
        
        // Jika rentang waktu kurang dari atau sama dengan 60 hari, tampilkan per Hari
        if ($diffInDays <= 60 && $range !== 'all_time') {
            for ($date = $startDate->copy(); $date->lte($endDate); $date->addDay()) {
                $dateString = $date->toDateString();
                $chartDates[] = $date->format('d M');
                $chartVisits[] = (int) Visitor::where('visited_date', $dateString)->sum('hits');
                $chartSearches[] = SearchLog::whereDate('created_at', $dateString)->count();
                
                $totalDl = 0;
                foreach ($activeDbs as $dbName) {
                    $db = strtolower($dbName);
                    $count = $dailyCounts[$db][$dateString] ?? 0;
                    $chartDownloadsSeries[$dbName][] = $count;
                    $totalDl += $count;
                }
                $chartDownloads[] = $totalDl;
            }
        } 
        // Jika lebih dari 60 hari, kelompokkan per Bulan untuk menghindari grafik yang terlalu padat
        else {
            $startMonth = $startDate->copy()->startOfMonth();
            $endMonth = $endDate->copy()->startOfMonth();
            
            for ($date = $startMonth->copy(); $date->lte($endMonth); $date->addMonth()) {
                $monthString = $date->format('Y-m');
                $chartDates[] = $date->format('M Y');
                $chartVisits[] = (int) Visitor::where('visited_date', 'like', $monthString.'%')->sum('hits');
                $chartSearches[] = SearchLog::whereYear('created_at', $date->year)->whereMonth('created_at', $date->month)->count();
                
                $totalDl = 0;
                foreach ($activeDbs as $dbName) {
                    $db = strtolower($dbName);
                    $count = $monthlyCounts[$db][$monthString] ?? 0;
                    $chartDownloadsSeries[$dbName][] = $count;
                    $totalDl += $count;
                }
                $chartDownloads[] = $totalDl;
            }
        }
        
        // Format chartDownloadsSeries menjadi array of objects untuk ApexCharts
        $formattedSeries = [];
        foreach ($chartDownloadsSeries as $dbName => $dataArray) {
            $formattedSeries[] = [
                'name' => $dbName,
                'data' => $dataArray
            ];
        }

        // Variabel untuk UI
        $currentFilter = $range;
        $customStart = $startDateStr;
        $customEnd = $endDateStr;
        $years = [$currentYear, $currentYear - 1, $currentYear - 2, $currentYear - 3];

        // Jika ini adalah request AJAX dari JavaScript, kembalikan response JSON
        if ($request->ajax()) {
            return response()->json([
                'visitors' => $visitors,
                'downloads' => $downloads,
                'searchesStats' => $searchesStats,
                'downloadsPerDatabase' => $downloadsPerDatabase,
                'popularSearches' => $popularSearches,
                'chartDates' => $chartDates,
                'chartVisits' => $chartVisits,
                'chartDownloads' => $chartDownloads,
                'chartSearches' => $chartSearches,
                'chartDownloadsSeries' => $formattedSeries,
                'customStart' => $customStart,
                'customEnd' => $customEnd,
                'currentFilter' => $currentFilter,
                'dbFilter' => $dbFilter
            ]);
        }

        return view('admin.dashboard', compact('visitors', 'downloads', 'searchesStats', 'downloadsPerDatabase', 'popularSearches', 'chartDates', 'chartVisits', 'chartSearches', 'chartDownloads', 'formattedSeries', 'currentFilter', 'customStart', 'customEnd', 'years', 'databases', 'dbFilter'));
    }
}
