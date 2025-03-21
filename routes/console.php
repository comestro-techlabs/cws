<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;


Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Schedule::command('exam:reminder')->dailyAt('07:00'); // Runs every day at 7 AM

Schedule::command('assignment:reminder')->dailyAt('05:00');