<?php namespace SpreadOut;

use Illuminate\Database\Eloquent\Model;

class County extends Model {

    /**
     * @var bool
     */
    public $timestamps = false;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'counties';
}
