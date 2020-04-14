<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

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
			$table->increments('id');
			$table->string('random_name')->nullable();
			$table->integer('designer_id')->nullable();
			$table->string('img')->nullable();
			$table->integer('price')->nullable();
			$table->boolean('accepting')->nullable()->default(0);
			$table->timestamps();
			$table->text('des', 65535)->nullable();
			$table->float('discount', 10, 0)->unsigned()->default(0);
			$table->boolean('removed')->default(0);
			$table->string('name')->nullable();
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
