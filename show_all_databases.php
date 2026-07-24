<?php

$controllerPath = 'c:/xampp/htdocs/jurnalagregator/app/Http/Controllers/AdminController.php';
$controllerContent = file_get_contents($controllerPath);

// 1. Ganti query $databases untuk dropdown
$oldDbList = <<<PHP
        // Filter Database Khusus Grafik Unduhan
        \$dbFilter = \$request->input('db', 'all');
        \$databases = \App\Models\DownloadLog::select('repository_name')->distinct()->whereNotNull('repository_name')->pluck('repository_name');
PHP;

$newDbList = <<<PHP
        // Filter Database Khusus Grafik Unduhan
        \$dbFilter = \$request->input('db', 'all');
        // Daftar 8 Database Global
        \$databases = ['Crossref', 'DOAJ', 'Semantic Scholar', 'OpenAlex', 'IEEE Xplore', 'CORE', 'Europe PMC', 'arXiv'];
PHP;
$controllerContent = str_replace($oldDbList, $newDbList, $controllerContent);

// 2. Ganti query $downloadsPerDatabase untuk tabel peringkat
$oldDbRanking = <<<PHP
        // Peringkat Unduhan per Database
        \$downloadsPerDatabase = DownloadLog::select('repository_name', \DB::raw('count(*) as total'))
            ->groupBy('repository_name')
            ->orderByDesc('total')
            ->get();
PHP;

$newDbRanking = <<<PHP
        // Peringkat Unduhan per Database (Tampilkan semua 8 Database meskipun 0)
        \$dbCounts = DownloadLog::select('repository_name', \DB::raw('count(*) as total'))
            ->groupBy('repository_name')
            ->pluck('total', 'repository_name')
            ->toArray();

        \$downloadsPerDatabase = [];
        \$allDatabases = ['Crossref', 'DOAJ', 'Semantic Scholar', 'OpenAlex', 'IEEE Xplore', 'CORE', 'Europe PMC', 'arXiv'];
        
        foreach (\$allDatabases as \$dbName) {
            // Karena nama di sistem kadang berbeda case (e.g. 'DOAJ' vs 'doaj'), kita fallback yang aman.
            \$total = 0;
            foreach (\$dbCounts as \$key => \$val) {
                if (strtolower(\$key) === strtolower(\$dbName)) {
                    \$total = \$val;
                    break;
                }
            }
            
            \$downloadsPerDatabase[] = (object) [
                'repository_name' => \$dbName,
                'total' => \$total
            ];
        }

        // Urutkan berdasarkan total terbanyak
        usort(\$downloadsPerDatabase, function(\$a, \$b) {
            return \$b->total <=> \$a->total;
        });
PHP;
$controllerContent = str_replace($oldDbRanking, $newDbRanking, $controllerContent);

file_put_contents($controllerPath, $controllerContent);
echo "Berhasil update AdminController untuk menampilkan 8 database.\n";
