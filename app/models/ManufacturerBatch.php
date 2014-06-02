<?php
/**
 * Created by PhpStorm.
 * User: hrhis
 * Date: 6/1/14
 * Time: 5:26 AM
 */

class ManufacturerBatch extends Eloquent{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'manufacturer_batch';

    protected  $guarded = array('id');
} 