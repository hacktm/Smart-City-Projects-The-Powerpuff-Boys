<?php namespace SpreadOut;

use Illuminate\Database\Eloquent\Model;

class Person extends Model {

    /**
     * @var string
     */
    protected $table = 'persons';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->belongsTo('SpreadOut\User');
    }
}