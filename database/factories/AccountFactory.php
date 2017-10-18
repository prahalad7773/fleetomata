<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Trips\Account::class, function (Faker $faker) {
    $types = [
        'JSM HQ', 'BPCL', 'ESSAR', 'Happay', 'Cash', 'Broker Commission', 'Loading Charges', 'Unloading Charges',
    ];
    return [
        'name' => $types[array_rand($types)],
    ];
});
