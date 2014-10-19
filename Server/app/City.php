<?php namespace SpreadOut;

use Illuminate\Database\Eloquent\Model;

class City extends Model {

    /**
     * @var bool
     */
    public $timestamps = false;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'cities';
}
