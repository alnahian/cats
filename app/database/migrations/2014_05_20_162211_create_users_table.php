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
		Schema::create('users', function($table){
			$table->increments('id');
			$table->string('remember_token')->nullable()->index();
			$table->string('username');
			$table->string('password');
			$table->boolean('is_admin');
			$table->timestamps();
		});
		Schema::table('cats', function($table){
			$table->integer('user_id')->nullable()->references('id')->on('users');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()	{
		Schema::table('cats', function($table){
			$table->dropForeign('cats_user_id_foreign');
			$table->dropColumn('user_id');
		});
		Schema::drop('users');
	}

}