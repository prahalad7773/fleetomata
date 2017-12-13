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

Artisan::command("delete:customer:ledgers", function () {
    App\Models\Trips\Ledger::where('fromable_type', 'App\Models\Trips\Customer')
        ->orWhere('toable_type', 'App\Models\Trips\Customer')
        ->delete();

    App\Models\Trips\Order::where('when', '<', Carbon\Carbon::today()->startOfMonth()->subDays(15))
        ->update([
            'pod_status' => 'Waived off by System',
            'pending_balance' => 0,
        ]);

    App\Models\Trips\Order::where('when', '>', Carbon\Carbon::today()->startOfMonth()->subDays(15))
        ->whereIn('type', [0, 1])->get()->each(function ($order) {
        $order->update([
            'pending_balance' => $order->hire,
        ]);
    });
});
