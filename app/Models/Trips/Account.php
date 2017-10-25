<?php
namespace App\Models\Trips;

use App\Models\BaseModel;
use App\Models\Trips\Ledger;

class Account extends BaseModel
{

    public function __toString()
    {
        return $this->name;
    }

    public function from()
    {
        return $this->morphMany(Ledger::class, 'fromable');
    }

    public function to()
    {
        return $this->morphMany('App\Models\Trips\Ledgers', 'toable');
    }

}
