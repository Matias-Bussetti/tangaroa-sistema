<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    Log::channel('pack')->info(Inspiring::quote());
    $this->comment(Inspiring::quote());
})->describe('Display an inspiring quote');

Artisan::command('hi', function () {
    $this->comment("hola");
})->describe('Display custom msg');
