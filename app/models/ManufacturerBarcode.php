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
    protected $table = 'manufacture_barcode';

    protected  $guarded = array('id');

    public function manufacturer(){
        return $this->belongsTo("Manufacturer","manufacture_id",'id');
    }
    public function vaccine(){
        return $this->belongsTo("Vaccine","vaccine_id",'id');
    }
    public function diluent(){
        return $this->belongsTo("Diluent","diluent_id",'id');
    }

} 