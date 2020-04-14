<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
            $table->bigIncrements('id');
			$table->string('email')->unique();
			$table->string('avatar')->nullable()->default('users/default.png');
			$table->string('password');
			$table->string('first_name')->nullable();
			$table->string('last_name')->nullable();
			$table->string('address')->nullable();
			$table->integer('age')->nullable();

			$table->string('IBAN_Bank')->nullable();
			$table->string('Bank_Name')->nullable();
			$table->string('name_on_BankCard')->nullable();
//			$table->string('random_id')->nullable();
			$table->string('phone')->nullable()->unique();

            $table->longText('settings')->nullable();

            $table->timestamp('email_verified_at')->nullable();

            $table->rememberToken();
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
		Schema::drop('users');
	}

}
