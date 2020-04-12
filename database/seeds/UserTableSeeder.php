<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

/**
 * Class UserTableSeeder.
 */
class UserTableSeeder extends Seeder
{

    /**
     * Run the database seed.
     *
     * @return void
     */
    public function run()
    {

        // Add the master administrator, user id of 1
        User::create([
            'first_name'        => 'A',
            'last_name'         => 'Admin',
            'email'             => 'admin@admin.com',
            'password'          => bcrypt('password'),
            'email_verified_at' => Carbon::now(),
        ]);

        User::create([
            'first_name'        => 'b',
            'last_name'         => 'Designer',
            'email'             => 'd@d.com',
            'password'          => bcrypt('password'),
            'email_verified_at' => Carbon::now(),
        ]);

    }
}
