<?php namespace SpreadOut;

use Illuminate\Database\Eloquent\Model;

class Event extends Model {

    /**
     * @var bool
     */
    public $timestamps = false;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'ticket_events';

    /**
     * Get ticket
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function ticket()
    {
        return $this->hasOne('SpreadOut\Ticket');
    }
}
