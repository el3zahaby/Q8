<?php

use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $design = \App\Design::first()->toArray();
        \App\Order::create([
            'orderstatus_id' => 1,
            'user_id' => \App\User::first()->id,
        ]);
    }
}