<?php

use Illuminate\Database\Seeder;

use App\Color;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Color::create([
            'name' => 'red'
        ]);

        Color::create([
            'name' => 'blue'
        ]);
    }
}
