<?php
namespace App\Models\Trips;

use App\Models\BaseModel;

class Account extends BaseModel
{

    public function __toString()
    {
        return $this->name;
    }

}
