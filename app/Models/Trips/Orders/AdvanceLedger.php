<?php

namespace App\Models\Trips\Orders;

use App\Models\Trips\Ledger;
use App\Traits\AdvanceLedgerScope;

class AdvanceLedger extends Ledger
{
    protected $table = 'ledgers';

    public static function boot()
    {
        parent::boot();

        static::addGlobalScope(
            new AdvanceLedgerScope()
        );
    }

    public function scopePending($query)
    {
        return $query->whereNull('approval');
    }
}
