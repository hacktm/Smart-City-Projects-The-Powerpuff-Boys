<?php namespace SpreadOut;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model {

    /**
     * @var string
     */
    protected $table = 'branches';

    /**
     * No timestamps for persons
     *
     * @var bool
     */
    public $timestamps = false;
}