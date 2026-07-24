<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Jadwal Harvester telah DIMATIKAN untuk menghemat resource server dan menjaga keamanan API Limit
// Schedule::command('api:harvest')->dailyAt('02:00');
