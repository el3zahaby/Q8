<?php

use Illuminate\Database\Seeder;

use App\Dsize;

class DsizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Dsize::create([
            'length' => '5',
            'width'  => '5',
            'print_price' => '10',
        ]);

        Dsize::create([
            'length' => '15',
            'width'  => '5',
            'print_price' => '20',
        ]);
    }
}
