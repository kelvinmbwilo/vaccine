<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDistrictPackageContentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('district_package_contents', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('package_id');
            $table->integer('number_of_boxes');
            $table->string('lot_number');
            $table->string('vaccine_id');
            $table->string('status');
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
		Schema::drop('district_package_contents');
	}

}
