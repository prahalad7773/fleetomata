<?php

namespace App\Models;

use App\Models\Trip;
use Carbon\Carbon;

class Truck extends BaseModel
{

/*
Getters and setters
 */

    public function getActiveTripAttribute()
    {
        if ($this->relationLoaded('trips')) {
            return $this->trips->where('completed_at', null)->first();
        }
        return $this->trips()->whereNull('completed_at')->first();
    }

    public function activeTrip()
    {
        if ($this->relationLoaded('trips')) {
            return $this->trips->where('completed_at', null)->first();
        }
        return $this->trips()->whereNull('completed_at')->first();
    }

/*
Relationships
 */
    public function trips()
    {
        return $this->hasMany(Trip::class, 'truck_id', 'id');
    }

/*
Custom Methods
 */
    public function id()
    {
        return "T" . $this->id;
    }

    public function status()
    {
        return $this->activeTrip ? 'In Trip' : 'No Trip';
    }

    public function createTrip($started_at)
    {
        if (!$this->activeTrip) {
            return $this->trips()->save(
                new Trip([
                    'started_at' => Carbon::createFromFormat('d-m-Y g:i A', $started_at),
                ])
            );
        }
    }

    public function __toString()
    {
        return $this->number;
    }
}
