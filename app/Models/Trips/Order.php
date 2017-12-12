<?php

namespace App\Models\Trips;

use App\Models\BaseModel;
use App\Models\Location;
use App\Models\Trip;
use App\Models\Trips\Customer;
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
        switch ($this->type) {
            case '0':return "Market Load";
            case '1':return "JSM";
            case '2':return "Empty";
        }
    }

    public function trip()
    {
        return $this->belongsTo(Trip::class);
    }

    public function loadingPoint()
    {
        return $this->hasOne(Location::class, 'id', 'loading_point_id');
    }

    public function unloadingPoint()
    {
        return $this->hasOne(Location::class, 'id', 'unloading_point_id');
    }

    public function __toString()
    {
        return $this->id() . " " . $this->loadingPoint->locality . " to " . $this->unloadingPoint->locality;
    }
}
