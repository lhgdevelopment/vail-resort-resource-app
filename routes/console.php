<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

// Schedule cleanup of unverified users (runs daily at 2 AM)
Schedule::command('users:cleanup-unverified --days=7')
    ->dailyAt('02:00')
    ->withoutOverlapping();
