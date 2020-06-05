<?php

use Illuminate\Database\Seeder;

use App\DesignSize;

class DesignDsizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DesignSize::create([
            'design_id' => 278823,
            'dsize_id' => 1,
            'designer_price' => 10
        ]);
    }
}
