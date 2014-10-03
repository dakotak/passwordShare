<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FirstMigration extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		/**
		 * Create the Users table
		 */
		Schema::create('users', function($table)
		{
			$table->increments('id');
			$table->string('firstName', 20);
			$table->string('lastName', 20);
			$table->string('username', 50)->unique();
			$table->string('password', 64);
			$table->rememberToken();
			$table->timestamps();
		});

		/**
		 * Create the passwords table
		 */
		Schema::create('passwords', function($table)
		{
			$table->increments('id');
			$table->string('title');
			$table->string('username');
			$table->text('note')->nullable();
			$table->enum('type', array('system', 'application', 'other'));
			$table->binary('encryptedPassword');
			$table->integer('addedBy');
			$table->timestamps();
		});

		/**
		 *  Create the passwordKeys table
		 *   This table will store encrypted version of the passwordKeys encrypted using the publicKey of a group.
		 */
		Schema::create('passwordKeys', function($t)
		{
			$t->integer('password_ID');
			$t->integer('group_ID');
			$t->binary('encryptedKey');
			$t->timestamps();
		});

		/**
		 * Create the groups table
		 */
		Schema::create('groups', function($t)
		{
			$t->increments('id');
			$t->string('name');
			$t->binary('publicKey');
			$t->timestamps();
		});

		/**
		 * Create the groupKeys table
		 *  This table is used to store the Group Private keys encrypted by a users public key.
		 */
		Schema::create('groupKeys', function($t)
		{
			$t->integer('user_ID');
			$t->integer('group_ID');
			$t->binary('encryptedKey');
			$t->timestamps();
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
		Schema::drop('passwords');
		Schema::drop('passwordKeys');
		Schema::drop('groups');
		Schema::drop('groupKeys');
	}

}
