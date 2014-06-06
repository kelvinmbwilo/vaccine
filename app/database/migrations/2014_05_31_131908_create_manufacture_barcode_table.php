<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateManufactureBarcodeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('manufacture_barcode', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer("manufacture_id");
            $table->string("ssc");
            $table->string("content");
            $table->integer("vaccine_id");
            $table->integer("diluent_id");
            $table->string("manufacture_date");
            $table->string("expiry_date");
            $table->string("lot_number");
            $table->string("number_of_packages");
            $table->string("number_of_doses");
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
		Schema::drop('manufacture_barcode');
	}

}
