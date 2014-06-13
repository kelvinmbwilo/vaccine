<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFacilityTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('facility', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('district_id');
            $table->string('name');
            $table->string('contact');
            $table->string('target_population');
            $table->string('annual_birth');
            $table->string('surviving_infants');
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
		Schema::drop('facility');
	}

}
