<?php

namespace App\Models\Trips;

class ApprovalSummary
{
    private $ledgers;
    public $dieselRequirement;
    public $happayRequirement;
    public $fastagRequirement;

    public function __construct($ledgers)
    {
        $this->ledgers = $ledgers;
        $this->dieselRequirement = 0;
        $this->happayRequirement = 0;
        $this->fastagRequirement = 0;
        $this->handle();
    }

    public function handle()
    {
        foreach ($this->ledgers as $ledger) {
            if ($ledger->fromable->name == 'JSM HQ' && $ledger->toable->name == 'BPCL') {
                $this->dieselRequirement += abs($ledger->amount);
            }
            if ($ledger->fromable->name == 'JSM HQ' && $ledger->toable->name == 'Happay') {
                $this->happayRequirement += abs($ledger->amount);
            }
            if ($ledger->fromable->name == 'JSM HQ' && $ledger->toable->name == 'Fastag') {
                $this->fastagRequirement += abs($ledger->amount);
            }
        }
    }

}
