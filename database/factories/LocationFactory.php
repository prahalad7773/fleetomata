<?php

use App\Models\Location;
use Faker\Generator as Faker;

$factory->define(Location::class, function (Faker $faker) {
    return [
        'state' => $faker->state,
        'district' => $faker->city,
        'formatted_address' => $faker->streetName,
        'locality' => $faker->streetName,
        'lat' => $faker->latitude,
        'lng' => $faker->longitude,
        'postal_code' => $faker->postcode,
    ];
});
