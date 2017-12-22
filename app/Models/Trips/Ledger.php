<?php

namespace App\Models\Trips;

use App\Models\BaseModel;
use App\Models\Trip;
use App\Models\Trips\Order;
use App\User;
use Carbon\Carbon;

class Ledger extends BaseModel
{
    protected $dates = [
        'when', 'approval',
    ];

    protected $with = [
        'approvedBy',
    ];

    public function id()
    {
        return "L#" . $this->id;
    }

    public function setWhenAttribute($when)
    {
        return $this->attributes['when'] = Carbon::createFromFormat('d-m-Y g:i A', $when);
    }

    public function approvalStatus()
    {
        return $this->approval ? sprintf("Approved at %s by %s", $this->approval->toDayDateTimeString(), $this->approvedBy) : 'Not Approved';
    }

    public function isApproved()
    {
        return (boolean) $this->approval;
    }

    public function fillFrom($from)
    {
        $this->fromable_id = $from->id;
        $this->fromable_type = get_class($from);
        return $this;
    }

    public function fillTo($to)
    {
        $this->toable_id = $to->id;
        $this->toable_type = get_class($to);
        return $this;
    }

    public function fromable()
    {
        return $this->morphTo('fromable');
    }

    public function toable()
    {
        return $this->morphTo('toable');
    }

    public function approvedBy()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function trip()
    {
        return $this->belongsTo(Trip::class);
    }

    public function updateOrderBalance()
    {
        if ($this->fromable_type == 'App\Models\Trips\Order') {
            $this->fromable->update([
                'pending_balance' => ($this->fromable->pending_balance - $this->amount),
            ]);
        }
    }

    /*
    from JSM HQ -> anything else , amount = negative
    from Order -> JSM HQ, amount = positive
    from Order -> !JSM HQ, amount = negative
     */
    public function getAmount($amount)
    {
        if ($this->fromable == 'JSM HQ') {
            $amount = -1 * $amount;
        }
        if (($this->fromable instanceof Order) && ($this->toable != 'JSM HQ')) {
            $amount = -1 * $amount;
        }
        return $amount;
    }
}
