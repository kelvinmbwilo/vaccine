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
} 