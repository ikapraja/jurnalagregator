<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;

DB::statement("ALTER TABLE articles MODIFY COLUMN cluster ENUM('Transportasi & Multimoda', 'Otomotif & Energi Terbarukan', 'Sistem Cerdas & Big Data', 'Keselamatan Transportasi', 'Belum Terklasifikasi') DEFAULT 'Belum Terklasifikasi'");
echo "DB updated\n";
