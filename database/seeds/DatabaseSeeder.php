<?php

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
    }
}
