<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersCollections extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		/*
		id sengaja tidak dibuat, karena di mongodb
		id sudah dimanage sendiri dan namanya -> _id
		 */
		Schema::create('users', function($collections) {

			$collections->string('username');
			$collections->string('email');
			$collections->string('password');
			$collections->timestamps();
			
			$collections->index('username');
			$collections->index('email');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
	}

}
