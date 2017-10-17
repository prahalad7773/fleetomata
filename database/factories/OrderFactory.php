<?php

use App\Models\Location;
use App\Models\Trip;
use App\Models\Trips\Customer;
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
        'customer_id' => function () {
            return factory(Customer::class)->create()->id;
        },
        'hire' => 100000,
        'when' => '12-12-2017 12:00 AM',
    ];
});
