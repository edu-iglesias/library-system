<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
			$table->increments('id');
			$table->string('UserId', 10);
			$table->string('password', 100);
			$table->string('Lname', 50);
			$table->string('Fname', 50);
			$table->string('Mname', 50);
			$table->string('ContactNo', 15);
			$table->integer('status')->default(1);
			$table->string('remember_token')->default(true);
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
