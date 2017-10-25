<?php

namespace App\Models\Trips;

use App\Models\BaseModel;
use App\User;
use Carbon\Carbon;

class Ledger extends BaseModel
{
    protected $dates = [
        'when', 'approval',
    ];

    public function setWhenAttribute($when)
    {
        return $this->attributes['when'] = Carbon::createFromFormat('d-m-Y g:i A', $when);
    }

    public function approvalStatus()
    {
        return $this->approval ? sprintf("Approved at %s by %s", $this->approval->toDayDateTimeString(), $this->approvedBy) : 'Not Approved';
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
}
