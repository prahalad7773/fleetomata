<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\BaseModel
 *
 * @mixin \Eloquent
 * @mixin \Illuminate\Database\Eloquent\Builder
 */class BaseModel extends Model
{
    protected $guarded = ['id'];
}
