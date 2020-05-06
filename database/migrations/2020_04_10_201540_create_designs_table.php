<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDesignsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('designs', function(Blueprint $table)
		{
			$table->bigIncrements('id');
            $table->integer('user_id')->nullable();
            $table->text('img');

            $table->string('name_en')->nullable();
            $table->string('name_ar')->nullable();
            $table->text('desc_en')->nullable();
            $table->text('desc_ar')->nullable();

            $table->integer('discount')->default(0);

            $table->longText('designer_price')->nullable()->default(null); // as json

            $table->boolean('accepting')->nullable()->default(0);
            $table->softDeletes();
            $table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('designs');
	}

}
