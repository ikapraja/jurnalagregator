<?php

require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

// Delete all Unknown records from DownloadLog to clean up the dashboard stats
\App\Models\DownloadLog::where('repository_name', 'Unknown')->delete();

echo "Cleaned up invalid download logs.\n";
