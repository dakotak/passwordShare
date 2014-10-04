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
			$table->boolean('isAdmin')->nullable();
			$table->binary('publicKey');
			$table->binary('privateKey');
			$table->rememberToken();
			$table->timestamps();
		});

		/**
		 * Create the passwords table
		 */
		Schema::create('credentials', function($table)
		{
			$table->increments('id');
			$table->string('title');
			$table->string('username');
			$table->text('note')->nullable();
			//$table->enum('type', array('system', 'application', 'other'));
			$table->integer('type_id');
			$table->integer('addedBy');
			$table->timestamps();
		});

		/**
		 * Create table to store the credential typs.
		 */
		Schema::create('credentialTypes', function($t)
		{
			$t->increments('id');
			$t->string('name', 20);
		});

		/**
		 * Create the encryptedPasswords table
		 * This table will hold encrypted passwords, becasue this is its own table we will be able to keep history of old passwords
		 */
		Schema::create('encryptedPasswords', function($t)
		{
			$t->increments('id');
			$t->integer('credentials_id');
			$t->binary('password');
			$t->datetime('created_at');
		});

		/**
		 *  Create the passwordKeys table
		 *   This table will store encrypted version of the passwordKeys encrypted using the publicKey of a group.
		 */
		Schema::create('passwordKeys', function($t)
		{
			$t->integer('credential_id');
			$t->integer('group_id');
			$t->binary('encryptedKey');
			$t->timestamps();
		});

		/**
		 * Create the groups table
		 */
		Schema::create('groups', function($t)
		{
			$t->increments('id');
			$t->string('name')->unique();
			$t->binary('publicKey');
			$t->integer('created_by');
			$t->timestamps();
		});

		/**
		 * Create the groupKeys table
		 *  This table is used to store the Group Private keys encrypted by a users public key.
		 */
		Schema::create('groupKeys', function($t)
		{
			$t->integer('user_id');
			$t->integer('group_id');
			$t->binary('encryptedKey');
			$t->timestamps();
		});

		/**
		 * Create table to store tags for credentals
		 */
		Schema::create('tags', function($t)
		{
			$t->increments('id');
			$t->string('name', 50);
			$t->datetime('created_at');
		});

		/**
		 * Many to Many table for credentials and tags
		 */
		Schema::create('credential_tag', function($t)
		{
			$t->integer('credential_ID');
			$t->integer('tag_ID');
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
		Schema::drop('credentials');
		Schema::drop('encryptedPasswords');
		Schema::drop('passwordKeys');
		Schema::drop('groups');
		Schema::drop('groupKeys');
		Schema::drop('tags');
		Schema::drop('credential_tag');
	}

}
