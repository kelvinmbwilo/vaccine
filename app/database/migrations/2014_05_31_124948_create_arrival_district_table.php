<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArrivalDistrictTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('arrival_district', function(Blueprint $table)
		{
			$table->increments('id');
            $table->date("date_of_report");
            $table->string("place_of_inspection");
            $table->date("date_of_inspection");
            $table->dateTime("time_of_inspection");
            $table->string("cold_store");
            $table->date("date_entered_cold_store");
            $table->dateTime("time_entered_cold_store");
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
		Schema::drop('arrival_district');
	}

}
