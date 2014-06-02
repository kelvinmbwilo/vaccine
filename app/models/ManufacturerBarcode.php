<?php
/**
 * Created by PhpStorm.
 * User: hrhis
 * Date: 6/1/14
 * Time: 5:28 AM
 */

class ManufacturerBarcode extends Eloquent{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'manufacturer_barcode';

    protected  $guarded = array('id');

    public function getManufacturer(){
        return $this->belongsTo("Manufacturer","manufacture_id");
    }
} 