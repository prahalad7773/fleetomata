<?php

namespace App\Traits;

use App\Models\Trips\Ledger;

trait FromTrait
{
    public function from()
    {
        return $this->morphMany(Ledger::class, 'fromable');
    }
}
