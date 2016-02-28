<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBansTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('bans', function (Blueprint $table) {
			$table->increments('id');

			$table->integer('ban_1');
			$table->integer('ban_2');
			$table->integer('ban_3');

			$table->integer('team_id')->index();
			$table->integer('game_id')->index();

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
		Schema::drop('bans');
	}
}
