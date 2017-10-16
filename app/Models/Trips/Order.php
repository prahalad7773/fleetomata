<?php

namespace App\Models\Trips;

use App\Models\BaseModel;
use App\Models\Location;
use App\Trips\Customer;
use Carbon\Carbon;

class Order extends BaseModel
{
    protected $dates = [
        'when',
    ];

    public function setWhenAttribute($when)
    {
        return $this->attributes['when'] = Carbon::createFromFormat('d-m-Y g:i A', $when);
    }

    public function id()
    {
        return "O#{$this->id}";
    }

    public function when()
    {
        return $this->when->toDayDateTimeString();
    }

    public function material()
    {
        return "{$this->cargo} - {$this->weight} MT";
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
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
