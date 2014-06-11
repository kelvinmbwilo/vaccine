<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArrivalRegionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('arrival_region', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('national_package');
            $table->integer('number_of_packages');
            $table->integer('regional_id');
            $table->string("lot_number");
            $table->string("number_as_expected");
            $table->string("coolant_type");
            $table->string("temperature_monitor");
            $table->string("labels_available");
            $table->string("condition");
            $table->string("problem");
            $table->integer('receiver');
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
		Schema::drop('arrival_region');
	}

}
