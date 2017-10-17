<?php

namespace App\Traits;

use App\Models\Trips\Ledger;

trait ToTrait
{
    public function from()
    {
        return $this->morphMany(Ledger::class, 'toable');
    }
}
