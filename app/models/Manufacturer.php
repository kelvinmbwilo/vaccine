<?php
/**
 * Created by PhpStorm.
 * User: hrhis
 * Date: 5/31/14
 * Time: 11:12 PM
 */

class Manufacturer extends Eloquent{
    protected $table = 'manufacturer';

    protected $guarded = array("id");

    public function getBarcode(){
        return $this->hasMany("ManufacturerBarcode","manufacture_id");
    }
}