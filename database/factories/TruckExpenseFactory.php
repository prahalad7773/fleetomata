<?php

use App\User;
use Carbon\Carbon;
use App\Models\Truck;
use Faker\Generator as Faker;
use App\Models\Trucks\TruckExpense;

/* @var Illuminate\Database\Eloquent\Factory $factory */

$factory->define(TruckExpense::class, function (Faker $faker) {
    return [
        'when' => '12-07-1993',
        'amount' => '-100',
        'truck_id' => function () {
            return factory(Truck::class)->create()->id;
        },
        'type' => 'Driver Salary',
        'reason' => $faker->sentence,
        'created_by' => function () {
            return factory(User::class)->create()->id;
        },
        'approved_by' => function () {
            return factory(User::class)->create()->id;
        },
    ];
});
