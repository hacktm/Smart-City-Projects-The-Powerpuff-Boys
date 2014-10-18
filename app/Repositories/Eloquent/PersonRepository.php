<?php namespace SpreadOut\Repositories\Eloquent;

use SpreadOut\Person;
use SpreadOut\Repositories\PersonContract;

class PersonRepository extends AbstractRepository implements PersonContract {

    /**
     * @param Person $model
     */
    public function __construct(Person $model)
    {
        $this->model = $model;
    }

    /**
     * Get all person
     *
     * @return bool
     */
    public function all()
    {
        return $this->toArray($this->model->all());
    }
}