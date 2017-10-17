<?php

namespace App\Models\Trips;

use Illuminate\Database\Eloquent\Model;

class Ledger extends Model
{

    public function from()
    {
        return $this->morphTo('fromable');
    }

    public function to()
    {
        return $this->morphTo('toable');
    }

}
