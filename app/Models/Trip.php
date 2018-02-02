<?php

namespace App\Models;

use App\Models\Trips\FinanceSummary;
use App\Models\Trips\Ledger;
use App\Models\Trips\Order;
use App\Models\Truck;
use Carbon\Carbon;

class Trip extends BaseModel
{
    protected $dates = [
        'completed_at', 'started_at',
    ];

    protected $appends = [
        'trip_days',
    ];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($trip) {
            $trip->orders()->delete();
            $trip->ledgers()->delete();
        });
    }

    /**
     * Returns in [TransitDays](Empty Days) format
     */
    public function getTripDaysAttribute()
    {
        $end = $this->completed_at ?? Carbon::today();
        $transitDays = 0;
        if ($this->orders->count() > 0) {
            $firstOrder = $this->orders->sortBy('when')->first()->when;
            $transitDays = $end->diffInDays($firstOrder);
        }
        $emptyDays = $end->diffInDays($this->started_at) - $transitDays;
        return sprintf("%s(%s)", $transitDays, $emptyDays);
    }

    public function __toString()
    {
        return $this->id();
    }

    public function id()
    {
        return "T#" . $this->id;
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

    public function ledgers()
    {
        return $this->hasMany(Ledger::class);
    }

    public function financeSummary()
    {
        $summary = new FinanceSummary($this);
        $summary->handle();
        return $summary;
    }

}
