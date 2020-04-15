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
			$table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->float('discount', 10, 0)->unsigned()->default(0);
            $table->longText('des')->nullable();
            $table->integer('user_id')->nullable();
			$table->text('img');
            $table->float('price', 10, 0)->unsigned()->default(0);
            $table->boolean('accepting')->nullable()->default(0);
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
