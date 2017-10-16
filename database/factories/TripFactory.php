<?php

use App\Models\Trip;
use App\Models\Truck;
use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(Trip::class, function (Faker $faker) {
    return [
        'truck_id' => function () {
            return factory(Truck::class)->create()->id;
        },
        'started_at' => Carbon::now(),
    ];
});
