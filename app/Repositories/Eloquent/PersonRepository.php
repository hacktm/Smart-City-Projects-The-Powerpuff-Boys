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
     * @param array $data
     * @return bool
     */
    public function create(array $data)
    {
        $person = $this->getNew();
        $person->user_id = $data['user_id'];
        $person->firstname = $data['firstname'];
        $person->lastname = $data['lastname'];
        $person->save();

        return $this->toArray($person);
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