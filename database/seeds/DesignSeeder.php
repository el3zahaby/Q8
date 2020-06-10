<?php

use Illuminate\Database\Seeder;

use App\Design;

class DesignSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Design::create([
            'name_en' => 'english name',
            'desc_en' => 'description name',
            'name_ar' => 'اسم التصميم',
            'desc_ar' => 'وصف التصميم',
            'user_id' => 278824,
            'img' => '/images/designs/crown.png',
            'accepting' => 1,
            'designer_price'=>'[{"dsize_id":1,"designer_price":32,"total":42}]',
            'deleted_at' => null,
        ]);
    }
}
