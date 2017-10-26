<?php

namespace App\Models\Trips;

use App\Models\Trip;

class FinanceSummary
{
    public $total;
    public $expense;
    public $received;
    public $trip;
    public $dieselExpense;
    public $tollExpense;
    public $enrouteExpense;

    public function __construct(Trip $trip)
    {
        $this->total = $trip->orders()->sum('hire');
        $this->expense = 0;
        $this->received = 0;
        $this->tollExpense = 0;
        $this->dieselExpense = 0;
        $this->enrouteExpense = 0;
        $this->trip = $trip;
    }

    public function handle()
    {
        foreach ($this->trip->ledgers as $ledger) {
            if ($ledger->fromable == 'JSM HQ') {
                if ($ledger->toable == 'BPCL') {
                    $this->dieselExpense += abs($ledger->amount);
                }
                if ($ledger->toable == 'Fastag') {
                    $this->tollExpense += abs($ledger->amount);
                }
                if ($ledger->toable == 'Happay') {
                    $this->enrouteExpense += abs($ledger->amount);
                }
                $this->expense += abs($ledger->amount);
            }
            if ($ledger->fromable_type == 'App\Models\Trips\Customer') {
                $this->received += abs($ledger->amount);
            }
        }
        return $this;
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
        $this->received == 0 ? $this->received = 1 : '';
        $margin = (($this->margin() / $this->received) * 100);
        return number_format((float) $margin, 2, '.', '') . "%";
    }
}
