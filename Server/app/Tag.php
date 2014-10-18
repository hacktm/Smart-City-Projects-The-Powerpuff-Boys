<?php namespace SpreadOut;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model {

    /**
     * @var string
     */
    protected $table = 'tags';

    /**
     * No timestamps for persons
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * @return mixed
     */
    public function companies()
    {
        return $this->belongsToMany('SpreadOut\Companies');
    }
}