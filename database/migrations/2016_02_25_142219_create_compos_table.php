<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComposTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('compos', function (Blueprint $table) {
			$table->increments('id');

			$table->integer('top');
			$table->integer('jungle');
			$table->integer('mid');
			$table->integer('adc');
			$table->integer('support');

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
		Schema::drop('compos');
	}
}
