<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArrivalNationalTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('arrival_national', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string("ssc");
            $table->string("number_of_packages");
            $table->string("number_as_expected");
            $table->string("problem");
            $table->string("coolant_type");
            $table->string("temperature_monitor");
            $table->string("docs_available");
            $table->string("labels_available");
            $table->dateTime("condition");
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
		Schema::drop('arrival_national');
	}

}
