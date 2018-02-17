<?php

namespace App\Models\Trucks;

use App\User;
use Carbon\Carbon;
use App\Models\BaseModel;

class TruckExpense extends BaseModel
{
    protected $dates = [
        'when'
    ];

    protected static $types = [
        'Driver Salary',
        'Fine',
        'Maintainance',
    ];

    public function setWhenAttribute($val)
    {
        return $this->attributes['when'] = Carbon::createFromFormat('d-m-Y', $val);
    }
    

    public function id()
    {
        return sprintf("E#%s", $this->id);
    }
    

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function approvedBy()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
}
