<?php

// Script to migrate legacy search_queries to search_logs

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\SearchQuery;
use App\Models\SearchLog;
use Carbon\Carbon;

$queries = SearchQuery::all();
$totalMigrated = 0;

foreach ($queries as $query) {
    $count = $query->count;
    $updatedAt = $query->updated_at;
    
    for ($i = 0; $i < $count; $i++) {
        // Create a record in search_logs
        // We will subtract some random hours/minutes from updated_at to simulate distribution
        // But for simplicity, let's just use the updated_at minus some random minutes
        $timestamp = $updatedAt->copy()->subMinutes(rand(1, 1440));
        
        SearchLog::insert([
            'keyword' => $query->keyword,
            'created_at' => $timestamp,
            'updated_at' => $timestamp
        ]);
        $totalMigrated++;
    }
}

echo "Berhasil memigrasi $totalMigrated data pencarian ke tabel search_logs baru.\n";

