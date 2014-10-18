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
     * Find user by id
     *
     * @param $id
     * @return bool
     */
    public function findById($id)
    {
        return $this->toArray($this->model->with('user')->where('user_id', $id)->get());
    }

    /**
     * Get all person
     *
     * @return bool
     */
    public function all()
    {
        return $this->toArray($this->model->with('user')->get());
    }
}