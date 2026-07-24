<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$articles = \App\Models\Article::all();
foreach($articles as $a) {
    $text = strtolower($a->title . ' ' . $a->abstract);
    $cluster = 'Belum Terklasifikasi';
    
    $clusters = [
        'Keselamatan Transportasi' => ['keselamatan transportasi', 'road safety', 'traffic safety', 'accident', 'kecelakaan', 'helm', 'seatbelt', 'crash', 'pedestrian'],
        'Otomotif & Energi Terbarukan' => ['kendaraan listrik', 'mobil listrik', 'electric vehicle', ' ev ', 'battery', 'baterai', 'lithium'],
        'Sistem Cerdas & Big Data' => ['sistem cerdas', 'big data', 'machine learning', 'artificial intelligence', ' ai ', 'deep learning', 'neural network', 'iot', 'data mining'],
        'Transportasi & Multimoda' => ['transportasi', 'multimoda', 'rel', 'railway', 'kereta', 'bus', 'angkutan', 'public transport', 'transit', 'jalan tol', 'highway']
    ];

    foreach ($clusters as $c => $keywords) {
        foreach ($keywords as $k) {
            if (strpos($text, $k) !== false) {
                $cluster = $c;
                break 2;
            }
        }
    }
    
    if ($a->cluster !== $cluster) {
        $a->cluster = $cluster;
        $a->save();
        echo "Updated: {$a->id} -> $cluster\n";
    }
}
echo "Done\n";
