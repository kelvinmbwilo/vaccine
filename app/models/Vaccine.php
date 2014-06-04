<?php
/**
 * Created by PhpStorm.
 * User: hrhis
 * Date: 6/1/14
 * Time: 5:25 AM
 */

class Vaccine extends Eloquent {
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'vaccine';

    protected  $guarded = array('id');

    public function vaccine(){
        return $this->belongsTo("Diluent",'id',"vaccine_id");
    }

    public function manufacturer(){
        return $this->hasMany("VaccineManufacturer","vaccine_id","id");
    }
} 