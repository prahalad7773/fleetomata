<?php

use App\Models\Truck;
use Faker\Generator as Faker;

$factory->define(Truck::class, function (Faker $faker) {
    return [
        'number' => 'UP-'.$faker->randomNumber(2).'-AZ'.$faker->randomNumber(4),
        'type' => '32ft MXL Container',
        'created_by' => function () {
            return factory(\App\User::class)->create()->id;
        },
    ];
});
