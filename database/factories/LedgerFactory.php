<?php

use App\Models\Trip;
use App\User;
use Faker\Generator as Faker;

$factory->define(App\Models\Trips\Ledger::class, function (Faker $faker) {
    return [
        'trip_id' => function () {
            return factory(Trip::class)->create()->id;
        },
        'amount' => 100,
        'when' => '12-12-2017 12:00 AM',
        'reason' => $faker->sentence,
        'fromable_id'=>1,
        'fromable_type'=>"APP\Models\Account",
        'toable_id'=>1,
        'toable_type'=>"APP\Models\Account",
        'created_by' => function () {
            return factory(User::class)->create()->id;
        },
    ];
});
