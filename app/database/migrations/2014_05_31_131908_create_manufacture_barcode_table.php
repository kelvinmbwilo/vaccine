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
            $table->string("barcode");
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
