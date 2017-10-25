<?php

namespace App\Models\Trips;

use App\Models\Trip;

class FinanceSummary
{
    public $total;
    public $expense;
    public $received;
    public $trip;

    public function __construct(Trip $trip)
    {
        $this->total = $trip->orders()->sum('hire');
        $this->expense = 0;
        $this->received = 0;
        $this->trip = $trip;
    }

    public function handle()
    {
        foreach ($this->trip->ledgers as $ledger) {
            if ($ledger->fromable == 'JSM HQ') {
                $this->expense += $ledger->amount;
            }
            if ($ledger->fromable_type == 'App\Models\Trips\Customer') {
                $this->received += $ledger->amount;
            }
        }
        $this->expense = abs($this->expense);
    }

    public function balance()
    {
        return $this->total - $this->received;
    }

    public function margin()
    {
        return ($this->received - $this->expense);
    }

    public function marginPercentage()
    {
        $margin = (($this->margin() / $this->received) * 100);
        return number_format((float) $margin, 2, '.', '') . "%";
    }
}
