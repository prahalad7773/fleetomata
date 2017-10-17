<?php

namespace App\Models\Trips;

use App\Models\BaseModel;

class Customer extends BaseModel
{

    public function __toString()
    {
        return $this->name;
    }

}
