<?php

namespace App\Models;

use App\Models\Trips\Order;
use App\Models\Truck;

class Trip extends BaseModel
{
    protected $dates = [
        'completed_at', 'started_at',
    ];

    public function id()
    {
        return "#" . $this->id;
    }

    public function isActive()
    {
        return $this->completed_at ? false : true;
    }

    public function truck()
    {
        return $this->belongsTo(Truck::class, 'truck_id', 'id');
    }

    public function status()
    {
        return $this->completed_at ? 'Completed' : 'In Transit';
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
