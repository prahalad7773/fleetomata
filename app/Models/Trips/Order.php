<?php

namespace App\Models\Trips;

use App\Models\BaseModel;
use App\Models\Location;

class Order extends BaseModel
{

    public function id()
    {
        return "O#{$this->id}";
    }

    public function material()
    {
        return "{$this->cargo} - {$this->weight} MT";
    }

    public function loadingPoint()
    {
        return $this->hasOne(Location::class, 'id', 'loading_point_id');
    }

    public function unloadingPoint()
    {
        return $this->hasOne(Location::class, 'id', 'unloading_point_id');
    }
}
