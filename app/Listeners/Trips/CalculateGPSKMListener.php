<?php

namespace App\Listeners\Trips;

use App\Jobs\CalculateGPSKm;
use Illuminate\Contracts\Queue\ShouldQueue;

class CalculateGPSKMListener implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        dispatch(new CalculateGPSKm($event->trip));
    }
}
