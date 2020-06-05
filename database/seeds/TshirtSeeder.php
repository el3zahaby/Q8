<?php

use Illuminate\Database\Seeder;

use App\Tshirt;

class TshirtSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tshirt::create([
            'color_id' => 1,
            'tsize_id' => 1,
            'qty' => 20,
            'price' => 100
        ]);
    }
}
