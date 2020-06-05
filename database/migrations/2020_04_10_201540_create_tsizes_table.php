<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTsizesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tsizes', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name')->nullable();
			$table->timestamps();
            $table->softDeletes();

        });
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tsizes');
	}

}
