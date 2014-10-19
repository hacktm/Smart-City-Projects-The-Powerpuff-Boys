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

    /**
     * Get ticket events
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function events()
    {
        return $this->hasMany('SpreadOut\Event');
    }

    /**
     * Find all the followers
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function persons()
    {
        return $this->hasOne('SpreadOut\Person');
    }
}
