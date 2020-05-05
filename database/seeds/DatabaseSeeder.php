<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call('RolesAndPermissionsSeeder');
         $this->call('UserTableSeeder');
         $this->call('UserRoleTableSeeder');
         $this->call('AddTsizeSeeder');
         $this->call('DsizeSeeder');
         $this->call('ColorSeeder');

         artisan::call('translations:import');
         artisan::call('storage:link');

    }
}
