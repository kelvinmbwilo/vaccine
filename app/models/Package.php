<?php

class Package extends Eloquent  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'package';

    protected $guarded = array("id");

}
