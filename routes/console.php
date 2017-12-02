<?php

use Illuminate\Foundation\Inspiring;

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
    $this->comment(Inspiring::quote());
})->describe('Display an inspiring quote');

Artisan::command('truck:status:email', function () {
    Mail::to([
        'itsme@theyounus.com', 'jmh@jaysm.com',
    ])->send(new App\Mail\TrucksStatus());
});

Artisan::command("trip:calculate:km {trip_id}", function () {
    $trip = App\Models\Trip::findOrFail($this->argument('trip_id'));
    dispatch(new App\Jobs\CalculateGPSKm($trip));
});
