<?php

namespace App\Models\Trips;

use App\Models\Trip;
use App\Models\Trips\Account;

class FinanceSummary
{
    public function __construct(Trip $trip)
    {
        foreach (Account::all() as $account) {
            $this->{$account} = 0;
        }
        $this->hire = $trip->orders()->sum('hire');
        $this->trip = $trip;
        $this->expense = 0;
        $this->income = 0;
        $this->costPerKm = "Not Updated";
        $this->costPerDay = "Not Updated";
    }

    public function handle()
    {
        foreach ($this->trip->ledgers as $ledger) {
            $this->{$ledger->toable} += abs($ledger->amount);
            if ($ledger->amount < 0) {
                $this->expense += abs($ledger->amount);
            } else {
                $this->income += abs($ledger->amount);
            }
        }
        //balance
        $this->balance = $this->hire - $this->income;
        if ($this->trip->gps_km) {
            $this->costPerKm = round($this->expense / $this->trip->gps_km, 2);
        }
        $this->costPerDay = round(($this->income / ($this->trip->trip_days != 0 ?: 1)), 2);
        return $this;
    }
}
