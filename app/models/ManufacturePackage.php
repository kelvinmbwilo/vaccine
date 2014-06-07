<?php
/**
 * Created by PhpStorm.
 * User: kelvin
 * Date: 2/17/14
 * Time: 9:04 PM
 */
class ManufacturePackage extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'manufacture_package';

    protected  $guarded = array('id');

    public function manufacture(){
        return $this->belongsTo('ManufacturerBarcode', 'package_id', 'id');
    }

    public function vaccine(){
        return $this->belongsTo("Vaccine","vaccine_id",'id');
    }
    public function diluent(){
        return $this->belongsTo("Diluent","diluent_id",'id');
    }

}