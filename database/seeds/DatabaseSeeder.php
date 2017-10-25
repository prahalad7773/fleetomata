<?php

use App\Models\Trips\Account;
use App\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Younus',
            'email' => 'itsme@theyounus.com',
            'phone' => '9941691593',
            'password' => bcrypt('younus'),
        ]);

        $types = [
            'JSM HQ', 'BPCL', 'Fastag', 'Happay', 'Cash', 'Broker Commission', 'Loading Charges', 'Unloading Charges',
        ];
        foreach ($types as $type) {
            Account::create([
                'name' => $type,
            ]);
        }
    }
}
