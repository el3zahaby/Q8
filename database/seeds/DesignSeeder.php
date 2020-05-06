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
            'user_id' => 278823,
            'img' => '/storage/uploads/designs/1588704202.jpg',
            'accepting' => 1,
            'deleted_at' => null,
        ]);
    }
}
