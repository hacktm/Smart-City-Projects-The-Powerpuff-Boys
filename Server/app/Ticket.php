<?php namespace SpreadOut;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model {

    /**
     * @var bool
     */
    public $timestamps = false;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tickets';
}
