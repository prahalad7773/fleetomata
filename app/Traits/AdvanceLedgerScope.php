<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class AdvanceLedgerScope implements Scope
{

    public function apply(Builder $builder, Model $model)
    {
        return $builder->where('fromable_type', '=', 'App\\Models\\Trips\\Order');
    }

}
