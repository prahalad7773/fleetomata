<?php

use App\Models\Location;
use App\Models\Trip;
use App\Models\Trips\Order;
use Faker\Generator as Faker;

$factory->define(Order::class, function (Faker $faker) {
    return [
        'trip_id' => function () {
            return factory(Trip::class)->create()->id;
        },
        'loading_point_id' => function () {
            return factory(Location::class)->create()->id;
        },
        'unloading_point_id' => function () {
            return factory(Location::class)->create()->id;
        },
        'cargo' => 'Pallets',
        'weight' => 14,
        'hire' => 100000,
    ];
});
