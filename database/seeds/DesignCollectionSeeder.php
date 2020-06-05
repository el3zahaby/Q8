<?php

use App\Design;
use Illuminate\Database\Seeder;

use App\DesignsCollections;

class DesignCollectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DesignsCollections::create([
            'tshirt_id' => '["1"]',
            'design_id' => Design::first()->id,
        ]);
    }
}
