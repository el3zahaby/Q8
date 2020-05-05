<?php

use Illuminate\Database\Seeder;

use App\Tsize;

class AddTsizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tsize::create([
            'name' => 'lg',
        ]);
        Tsize::create([
            'name' => 'xl',
        ]);
    }
}
