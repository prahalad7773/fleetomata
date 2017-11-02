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

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($trip) {
            $trip->orders()->delete();
            $trip->ledgers()->delete();
        });
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

    public function tripDays()
    {
        $end = $this->completed_at ?? Carbon::now();
        return $end->diffInDays($this->started_at);
    }

}
