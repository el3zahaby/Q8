<?php

use Illuminate\Database\Seeder;

class OrderStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\OrderStatus::create([
            'status' => 'pending',
            'color' => 'red'
        ]);
    }
}
