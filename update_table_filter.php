<?php

$controllerPath = 'c:/xampp/htdocs/jurnalagregator/app/Http/Controllers/AdminController.php';
$controllerContent = file_get_contents($controllerPath);

// 1. Pindahkan logika filter tanggal ke atas (sebelum perhitungan tabel database)
// Potong blok filter dari bawah
$filterBlock = <<<PHP
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
PHP;

// Hapus blok tersebut dari posisi aslinya
$controllerContent = str_replace($filterBlock, '', $controllerContent);

// Sisipkan blok filter ke atas, tepat setelah deklarasi $databases
$targetInsert = <<<PHP
        \$databases = ['Crossref', 'DOAJ', 'Semantic Scholar', 'OpenAlex', 'IEEE Xplore', 'CORE', 'Europe PMC', 'arXiv'];
PHP;
$controllerContent = str_replace($targetInsert, $targetInsert . "\n\n" . $filterBlock, $controllerContent);

// 2. Modifikasi query tabel Peringkat Unduhan agar menggunakan filter tanggal tersebut
$oldDbCounts = <<<PHP
        // Statistik Unduhan per Database (All Time) - Tampilkan Semua 8 Database
        \$dbCounts = DownloadLog::selectRaw('repository_name, count(*) as total')
            ->whereNotNull('repository_name')
            ->groupBy('repository_name')
            ->pluck('total', 'repository_name')
            ->toArray();
PHP;

$newDbCounts = <<<PHP
        // Statistik Unduhan per Database (Sesuai Rentang Waktu) - Tampilkan Semua 8 Database
        \$dbCountsQuery = DownloadLog::selectRaw('repository_name, count(*) as total')
            ->whereNotNull('repository_name');
            
        if (\$range !== 'all_time') {
            // Gunakan startOfDay() dan endOfDay() agar presisi
            \$dbCountsQuery->whereBetween('created_at', [\$startDate->copy()->startOfDay(), \$endDate->copy()->endOfDay()]);
        }
            
        \$dbCounts = \$dbCountsQuery->groupBy('repository_name')
            ->pluck('total', 'repository_name')
            ->toArray();
PHP;

$controllerContent = str_replace($oldDbCounts, $newDbCounts, $controllerContent);

file_put_contents($controllerPath, $controllerContent);

// 3. Update dashboard.blade.php untuk menghapus tulisan "(All Time)"
$bladePath = 'c:/xampp/htdocs/jurnalagregator/resources/views/admin/dashboard.blade.php';
$bladeContent = file_get_contents($bladePath);
$bladeContent = str_replace('Peringkat Unduhan per Database (All Time)', 'Peringkat Unduhan per Database (Berdasarkan Rentang Waktu)', $bladeContent);
file_put_contents($bladePath, $bladeContent);

echo "Berhasil update tabel peringkat unduhan agar menyesuaikan dengan rentang waktu.\n";
