<?php

use App\Models\Trip;
use App\Models\Trips\Account;
use App\User;
use Faker\Generator as Faker;

$factory->define(App\Models\Trips\Ledger::class, function (Faker $faker) {
    $from = factory(Account::class)->create();
    $to = factory(Account::class)->create();
    return [
        'trip_id' => function () {
            return factory(Trip::class)->create()->id;
        },
        'fromable_id' => $from->id,
        'fromable_type' => get_class($from),
        'toable_id' => $to->id,
        'toable_type' => get_class($to),
        'amount' => 100,
        'when' => '12-12-2017 12:00 AM',
        'reason' => $faker->title,
        'created_by' => function () {
            return factory(User::class)->create()->id;
        },
    ];
});
