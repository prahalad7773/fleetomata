<?php

namespace App\Mail;

use App\Models\Truck;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TrucksStatus extends Mailable
{
    private $trucks;
    private $emptyTrucks;
    private $transitTrucks;

    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
        $this->trucks = Truck::all();
        $this->emptyTrucks = collect();
        $this->transitTrucks = collect();
        $this->trucks->each(function ($truck) {
            $truck->activeTrip ? $this->transitTrucks->push($truck) : $this->emptyTrucks->push($truck);
        });
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails/trucks/status')->with([
            'emptyTrucks' => $this->emptyTrucks,
            'transitTrucks' => $this->transitTrucks,
        ])->subject('Truck Status - ' . Carbon::now()->toFormattedDateString());
    }
}
