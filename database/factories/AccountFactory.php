<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Trips\Account::class, function (Faker $faker) {
    $types = [
        'JSM HQ','Diesel','Fastag','Enroute','Cash','Broker Commission', 'Loading Charges', 'Unloading Charges','TDS','Guide','RTO/PC','CMS Commission','Weightment Charges'
    ];
    return [
        'name' => $types[array_rand($types)],
    ];
});
