<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGamesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('games', function (Blueprint $table) {
			$table->increments('id');

			$table->string('week');
			$table->integer('team_1')->index();
			$table->integer('team_2')->index();
			$table->integer('compo_1')->index();
			$table->integer('compo_2')->index();
			$table->integer('ban_1')->index();
			$table->integer('ban_2')->index();
			$table->integer('winner');
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
		Schema::drop('games');
	}
}
