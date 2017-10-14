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
}
