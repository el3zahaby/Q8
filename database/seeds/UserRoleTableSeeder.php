<?php

use App\User;
use Illuminate\Database\Seeder;

/**
 * Class UserRoleTableSeeder.
 */
class UserRoleTableSeeder extends Seeder
{

    /**
     * Run the database seed.
     *
     * @return void
     */
    public function run()
    {
        User::find(config('app.firstId'))->assignRole('admin');
        User::find(config('app.firstId')+1)->assignRole('designer');
//        User::find(3)->assignRole('user');

    }
}
