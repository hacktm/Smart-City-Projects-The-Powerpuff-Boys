<?php namespace SpreadOut\Repositories\Eloquent;

use SpreadOut\Person;

class PersonRepository extends AbstractRepository {

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