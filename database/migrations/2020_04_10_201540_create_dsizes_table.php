<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDsizesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('dsizes', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('length')->nullable();
			$table->integer('width')->nullable();
			$table->integer('print_price')->nullable();
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
		Schema::drop('dsizes');
	}

}
