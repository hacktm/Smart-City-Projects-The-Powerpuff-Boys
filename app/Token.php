<?php namespace SpreadOut;

use Illuminate\Database\Eloquent\Model;

class Token extends Model {

    /**
     * @var string
     */
    protected $table = 'tokens';

    /**
     * No timestamps for persons
     *
     * @var bool
     */
    public $timestamps = false;
}