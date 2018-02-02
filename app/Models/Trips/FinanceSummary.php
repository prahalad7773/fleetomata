<?php

namespace App\Models\Trips;

use App\Models\Trip;
use App\Models\Trips\Account;
use App\Models\Trips\Order;

class FinanceSummary
{
    public function __construct(Trip $trip)
    {
        $accounts = Account::all();
        foreach ($accounts as $account) {
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
            if (!$ledger->toable instanceof Order) {
                $this->{$ledger->toable} += abs($ledger->amount);
            }
            if ($ledger->fromable instanceof Order) {
                $this->income += abs($ledger->amount);
            }
            if ($ledger->amount < 0) {
                $this->expense += abs($ledger->amount);
            }
        }
        //balance
        $this->balance = $this->hire - $this->income;
        if ($this->trip->gps_km) {
            $this->costPerKm = round($this->expense / $this->trip->gps_km, 2);
        }
        $this->profit = $this->income - $this->expense;
        $this->mileage = round($this->trip->gps_km == 0 ? '1' : $this->trip->gps_km /
            ($this->{"Diesel"} == 0 ? 1 : $this->{"Diesel"} / 60), 2);
        // $this->profitPerDay = round($this->profit / ($this->trip->trip_days != 0 ? $this->trip->trip_days : 1));
        // $this->costPerDay = round(($this->income / ($this->trip->trip_days != 0 ? $this->trip->trip_days : 1)), 2);
        return $this;
    }
}
