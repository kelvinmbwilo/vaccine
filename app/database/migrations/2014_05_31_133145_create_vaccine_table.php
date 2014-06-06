<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVaccineTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('vaccine', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string("vaccine_name");
            $table->string("GTIN");
            $table->string("doses_per_vial");
            $table->string("vials_per_box");
            $table->string("warning_period");
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
		Schema::drop('vaccine');
	}

}
