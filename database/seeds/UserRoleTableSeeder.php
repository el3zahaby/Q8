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
        User::find(1)->assignRole('admin');
        User::find(2)->assignRole('designer');
//        User::find(3)->assignRole('user');

    }
}
