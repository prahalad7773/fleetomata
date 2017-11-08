<?php

namespace App\Models\Trips;

class ApprovalSummary
{
    private $ledgers;

    public function __construct($ledgers)
    {
        $this->ledgers = $ledgers;
        $this->diesel = 0;
        $this->fastag = 0;
        $this->happay = 0;
        $this->cash = 0;
        $this->handle();
    }

    public function handle()
    {
        $this->ledgers->each(function ($ledger) {
            switch ($ledger->toable) {
                case 'Diesel':$this->diesel += abs($ledger->amount);break;
                case 'Fastag':$this->fastag += abs($ledger->amount);break;
                case 'cash':$this->cash += abs($ledger->amount);break;
                default:$this->happay += abs($ledger->amount);break;
            }
        });
    }

}
