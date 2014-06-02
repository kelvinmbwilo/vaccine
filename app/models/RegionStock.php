<?php

class RegionStock extends Eloquent  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'region_stock';

    protected $guarded = array("id");

    public function getRegion(){
        return $this->belongsTo("Region","region_id");
    }

}
